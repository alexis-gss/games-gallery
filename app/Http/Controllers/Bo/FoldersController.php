<?php

namespace App\Http\Controllers\Bo;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFolderRequest;
use App\Models\Folder;
use App\Traits\Controllers\HasPicture;
use App\Traits\Models\ChangesModelOrder;

class FoldersController extends Controller
{
    use ChangesModelOrder;
    use HasPicture;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View
    {
        $folders = Folder::orderBy('order', 'ASC')->get();

        return view('bo.folders.index', compact('folders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\Folder $folder
     * @return \Illuminate\Contracts\View\View
     */
    public function create(Folder $folder): \Illuminate\Contracts\View\View
    {
        return view('bo.folders.create', compact('folder'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreFolderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreFolderRequest $request): \Illuminate\Http\RedirectResponse
    {
        $folder        = new Folder($request->validated());
        $folder->order = $this->getLastOrder();
        $folder->saveOrFail();

        return redirect()->route('bo.folders.edit', $folder->id)->with('success', 'Folder created !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Folder $folder
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Folder $folder): \Illuminate\Contracts\View\View
    {
        return view('bo.folders.edit', compact('folder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\StoreFolderRequest $request
     * @param \App\Models\Folder                    $folder
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreFolderRequest $request, Folder $folder): \Illuminate\Http\RedirectResponse
    {
        $folder->fill($request->validated());

        if (!$folder->saveOrFail()) {
            return redirect()->route('bo.folders.edit', $folder->id)
                ->with('error', trans(__('Modification_failed')));
        }
        return redirect()->route('bo.folders.edit', $folder->id)
            ->with('success', trans(__('Changes_saved')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\Folder $folder
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Folder $folder): \Illuminate\Http\RedirectResponse
    {
        if (!$folder->delete()) {
            return redirect()->route('bo.folders.index')->with('error', trans('Suppression failed'));
        }
        return redirect()->route('bo.folders.index')->with('success', trans('Successful deletion'));
    }

    /**
     * Get by order the last element of the list.
     *
     * @return integer
     */
    private function getLastOrder(): int
    {
        $order = Folder::select('order')->orderBy('order', 'DESC')->first();

        if ($order === null) {
            return 1;
        }
        return $order->order + 1;
    }
}
