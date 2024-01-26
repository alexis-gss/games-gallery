<?php

namespace App\Providers;

use App\Models\ActivityLog;
use App\Models\Game;
use App\Models\Folder;
use App\Models\Rank;
use App\Models\StaticPage;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Get data from composer.json.
        $appInfos = Cache::remember('composer', 360, function () {
            return json_decode(File::get(\app_path('../composer.json')));
        });
        // Share composer.json infos.
        View::share('globalName', $appInfos->name);
        View::share('globalVersion', $appInfos->version);
        View::share('globalLicense', $appInfos->license);

        if (!app()->runningInConsole()) {
            // Shares this data with all views.
            if (
                Schema::hasTable('games') and
                Schema::hasTable('folders') and
                Schema::hasTable('tags') and
                Schema::hasTable('users') and
                Schema::hasTable('activity_logs') and
                Schema::hasTable('ranks') and
                Schema::hasTable('static_pages')
            ) {
                View::share('globalGames', Game::query()->with('pictures')->orderBy('name', 'ASC')->get());
                View::share('globalFolders', Folder::query()->with('games')->orderBy('name', 'ASC')->get());
                View::share('globalTags', Tag::query()->with('games')->orderBy('name', 'ASC')->get());
                View::share('globalUsers', User::query()->orderBy('last_name', 'ASC')->get());
                View::share('globalActivities', ActivityLog::query()->with('user')->get());
                View::share('globalRanks', Rank::query()->orderBy('rank', 'ASC')->get());
                View::share('globalStaticPages', StaticPage::query()->orderBy('title', 'ASC')->get());
            }

            // * FORCE BOOTSTRAP PAGINATOR (or custom if in front)
            // Early boot, request wont be filled as expected.
            if (collect(explode('/', \request()->getPathInfo()))->get(1) === 'bo') {
                Paginator::defaultView('back.modules.pagination');
            } else {
                Paginator::useBootstrapFive();
            }
        } //end if
    }
}
