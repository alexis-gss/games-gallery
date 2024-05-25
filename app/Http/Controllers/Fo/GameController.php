<?php

namespace App\Http\Controllers\Fo;

use App\Http\Controllers\Controller;
use App\Lib\Helpers\ToolboxHelper;
use App\Models\Game;
use App\Models\Rating;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class GameController extends Controller
{
    /**
     * Show a specific game.
     *
     * @param \Illuminate\Http\Request $request
     * @param string                   $slug
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(
        Request $request,
        string $slug
    ): \Illuminate\Http\JsonResponse|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse {
        if ($gameModel = Game::query()->where('published', true)->where('slug', $slug)->first()) {
            /** @var array $gamePictures */
            $gamePictures = [];
            if (count($gameModel->pictures)) {
                $gameModel->pictures->map(function ($picture) {
                    // @phpstan-ignore-next-line
                    $picture->ratings_count = count($picture->ratings);
                    return $picture;
                });
                $gamePictures = ToolboxHelper::customPaginate(
                    $gameModel->pictures,
                    (count($gameModel->pictures) <= 12) ? count($gameModel->pictures) : 12,
                    ['path' => Paginator::resolveCurrentPath()]
                );
            }

            /** @var \Illuminate\Database\Eloquent\Collection $ratingModels */
            $ratingModels = Rating::query()
                ->where('uuid', $request->cookie('rating-uuid'))
                ->get()
                ->map(function ($rating) {
                    return $rating->picture_id;
                });

            if ($request->ajax()) {
                return response()->json(['data' => $gamePictures]);
            }

            return view('front.pages.game', [
                'gameModel'    => $gameModel,
                'gamePictures' => $gamePictures,
                'ratingModels' => $ratingModels,
                'gameModels'   => $this->getGamesPublished(),
                'folderModels' => $this->getFoldersPublished(),
                'tagModels'    => $this->getTagsPublished(),
            ]);
        } else {
            return redirect()->route('fo.games.index');
        } //end if
    }

    /**
     * Return a list of games filtered.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGamesFiltered(Request $request): \Illuminate\Http\JsonResponse
    {
        $selectedFolderId = intval($request->filters_id[1] ?? 0);
        $selectedTagId    = intval($request->filters_id[0] ?? 0);
        /** @var \Illuminate\Support\Collection $gamesFiltered */
        $gamesFiltered = Game::query()->with('pictures')->where('published', true)
            ->when($selectedFolderId, function (Builder $query) use ($selectedFolderId) {
                $query->where('folder_id', $selectedFolderId);
            })
            ->when($selectedTagId, function (Builder $query) use ($selectedTagId) {
                $query->whereHas('tags', function (Builder $query) use ($selectedTagId) {
                    $query->where('id', $selectedTagId);
                });
            })
            ->orderBy('slug', 'ASC')
            ->get();
        return response()->json($gamesFiltered);
    }
}
