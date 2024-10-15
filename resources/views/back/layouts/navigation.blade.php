@auth('backend')
    <nav class="col-12 d-lg-flex flex-column justify-content-between bg-body-tertiary collapse overflow-x-visible py-2"
        id="navigation">
        <div class="side-menu">
            {{-- HOME --}}
            <x-back.side-menu-link :label="__('bo_other_homepage')" routeName="bo.home" routeCondition="bo.home"
                icon="house" :title="__('bo_tooltip_homepage')" />
            {{-- STATISTICS --}}
            <x-back.side-menu-link :label="str(__('models.statistic'))->plural()->ucfirst()" routeName="bo.statistics.index"
                routeCondition="bo.statistics.*" icon="chart-pie" :title="__('bo_tooltip_statistics', [
                    'model' => str(__('models.statistic'))->plural()
                ])" />
            {{-- CRUDS --}}
            <button
                class="d-flex justify-content-between btn btn-primary btn-md bg-transparent rounded-0 border-top-0 border-start-0 border-end-0 border-bottom text-body text-start mt-3 w-100"
                type="button" data-bs-toggle="collapse" data-bs-target="#collapseCruds" aria-expanded="true"
                aria-controls="collapseCruds">
                <span class="navigation-label">CRUDs</span>
                <i class="fa-solid fa-sort-down"></i>
            </button>
            <div class="collapse show" id="collapseCruds">
                <ul class="m-0 p-0">
                    {{-- GAMES --}}
                    @can('viewAny', \App\Models\Game::class)
                        <li>
                            <x-back.side-menu-link :label="str(trans_choice('models.game', \INF))->ucfirst()" routeName="bo.games.index"
                                routeCondition="bo.games.*" icon="gamepad" :title="__('bo_tooltip_list_models', [
                                    'count' => isset($globalGames) ? count($globalGames) : 0,
                                    'model' => trans_choice('models.game', \INF),
                                ])" />
                        </li>
                    @endcan
                    {{-- FOLDERS --}}
                    @can('viewAny', \App\Models\Folder::class)
                        <li>
                            <x-back.side-menu-link :label="str(__('models.folder'))->ucfirst()->plural()" routeName="bo.folders.index"
                                routeCondition="bo.folders.*" icon="folder" :title="__('bo_tooltip_list_models', [
                                    'count' => isset($globalFolders) ? count($globalFolders) : 0,
                                    'model' => str(__('models.folder'))->plural(),
                                ])" />
                        </li>
                    @endcan
                    {{-- TAGS --}}
                    @can('viewAny', \App\Models\Tag::class)
                        <li>
                            <x-back.side-menu-link :label="str(__('models.tag'))->ucfirst()->plural()" routeName="bo.tags.index"
                                routeCondition="bo.tags.*" icon="tag" :title="__('bo_tooltip_list_models', [
                                    'count' => isset($globalTags) ? count($globalTags) : 0,
                                    'model' => str(__('models.tag'))->plural(),
                                ])" />
                        </li>
                    @endcan
                    {{-- RANKS --}}
                    @can('viewAny', \App\Models\Rank::class)
                        <li>
                            <x-back.side-menu-link :label="str(__('models.rank'))->ucfirst()->plural()" routeName="bo.ranks.index"
                                routeCondition="bo.ranks.*" icon="trophy" :title="__('bo_tooltip_list_models', [
                                    'count' => isset($globalRanks) ? count($globalRanks) : 0,
                                    'model' => str(__('models.rank'))->plural(),
                                ])" />
                        </li>
                    @endcan
                </ul>
            </div>
            {{-- ADMIN --}}
            @can('isConceptor')
                <button
                    class="d-flex justify-content-between btn btn-primary btn-md bg-transparent rounded-0 border-top-0 border-start-0 border-end-0 border-bottom text-body text-start mt-3 w-100"
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdmin" aria-expanded="true"
                    aria-controls="collapseAdmin">
                    <span class="navigation-label">Admin</span>
                    <i class="fa-solid fa-sort-down"></i>
                </button>
                <div class="collapse show" id="collapseAdmin">
                    <ul class="m-0 p-0">
                        {{-- STATIC PAGES --}}
                        @can('viewAny', \App\Models\StaticPage::class)
                            <li>
                                <x-back.side-menu-link :label="str(trans_choice('models.static_page', \INF))->ucfirst()" routeName="bo.static_pages.index"
                                    routeCondition="bo.static_pages.*" icon="file" :title="__('bo_tooltip_list_models', [
                                        'count' => isset($globalStaticPages) ? count($globalStaticPages) : 0,
                                        'model' => trans_choice('models.static_page', \INF),
                                    ])" />
                            </li>
                        @endcan
                        {{-- ACTIVITY LOGS --}}
                        @can('viewAny', \App\Models\ActivityLog::class)
                            <li>
                                <x-back.side-menu-link :label="str(trans_choice('models.activity_log', \INF))->ucfirst()" routeName="bo.activity_logs.index"
                                    routeCondition="bo.activity_logs.*" icon="clock-rotate-left" :title="__('bo_tooltip_list_models', [
                                        'count' => isset($globalActivities) ? count($globalActivities) : 0,
                                        'model' => trans_choice('models.activity_log', \INF),
                                    ])" />
                            </li>
                        @endcan
                        {{-- USERS --}}
                        @can('viewAny', \App\Models\User::class)
                            <li>
                                <x-back.side-menu-link :label="str(trans_choice('models.user', \INF))->ucfirst()" routeName="bo.users.index"
                                    routeCondition="bo.users.*" icon="users" :title="__('bo_tooltip_list_models', [
                                        'count' => isset($globalUsers) ? count($globalUsers) : 0,
                                        'model' => str(__('models.user'))->plural(),
                                    ])" />
                            </li>
                        @endcan
                    </ul>
                </div>
            @endcan
        </div>
        <button id="side-menu-toggle" class="btn btn-sm btn-outline-primary w-100">
            <i class="fa-solid fa-arrow-right-to-bracket"></i>
        </button>
    </nav>
@endauth
