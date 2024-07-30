<?php

namespace App\Http\Controllers\Fo;

use App\Http\Controllers\Controller;
use App\Lib\Helpers\ToolboxHelper;
use App\Models\Game;
use App\Models\Rating;
use App\Models\Visit;
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
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function show(
        Request $request,
        string $slug
    ): \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse {
        $gameModel = Game::query()
            ->where('published', true)
            ->where('slug', $slug)
            ->whereHas('folder', function ($q) {
                $q->where('published', true);
            })->first();
        if ($gameModel) {
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
                return response()->json($gamePictures);
            }

            $cookie = (new Visit())->setVisit($request, $gameModel);

            return response(view('front.pages.game', [
                'gameModel'         => $gameModel,
                'gamePictures'      => $gamePictures,
                'ratingModels'      => $ratingModels,
                'gameModels'        => $this->getGamesPublished(true, $this->gamesPerPage),
                'folderModels'      => $this->getFoldersPublished(),
                'tagModels'         => $this->getTagsPublished(),
                'relatedGamesViews' => $this->getRelatedGamesViews($gameModel),
            ]))->withCookie($cookie);
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
        /** @var array<string|null> $searchSelects Selected folder/tag id */
        $searchSelects = $request->input('filters_id');
        /** @var string|null $searchText Search text */
        $searchText = $request->input('search');
        /** @var \Illuminate\Support\Collection $gamesFiltered */
        $gamesFiltered = Game::query()
            ->when(
                isset($searchSelects[1]) &&
                    !empty($searchSelects[1]),
                function (Builder $query) use ($searchSelects) {
                    $query->where('folder_id', $searchSelects[1]);
                }
            )
            ->when(
                isset($searchSelects[0]) &&
                    !empty($searchSelects[0]),
                function (Builder $query) use ($searchSelects) {
                    $query->whereHas('tags', function (Builder $query) use ($searchSelects) {
                        $query->where('id', $searchSelects[0]);
                    });
                }
            )
            ->when(!is_null($request->search), function (Builder $query) use ($searchText) {
                $query->where('name', 'LIKE', "%{$searchText}%");
            })
            ->with('pictures')
            ->where('published', true)
            ->whereHas('folder', function ($q) {
                $q->where('published', true);
            })
            ->orderBy('slug', 'ASC')
            ->paginate($this->gamesPerPage);
        return response()->json($gamesFiltered);
    }

    /**
     * Return a list of games filtered.
     *
     * @param \App\Models\Game $gameModel
     * @return array
     */
    public function getRelatedGamesViews(Game $gameModel): array
    {
        /** @var array<int, string> $relatedGamesViews */
        $relatedGamesViews = [];
        Game::query()->with('pictures', 'folder')
            ->where([['published', true], ['id', '!=', $gameModel->getKey()]])
            ->whereHas('folder', function ($q) use ($gameModel) {
                $q->where([['published', true], ['id', $gameModel->folder->getKey()]]);
            })->orderby('published_at', 'DESC')->take(6)->get()
            ->map(function (Game $randomGameModel) use (&$relatedGamesViews) {
                array_push($relatedGamesViews, [
                    view('front.partials.card-game', ['gameModel' => $randomGameModel])->render()
                ]);
            });
        return $relatedGamesViews;
    }
}
