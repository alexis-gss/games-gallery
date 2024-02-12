<?php

namespace App\Providers;

use App\Lib\Helpers\ToolboxHelper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\SplFileInfo;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        foreach ($this->collectLocalesStrings() as $locale) {
            // * Suported locales.
            Cache::rememberForever(sprintf('translations.%s', $locale), function () use ($locale) {
                $phpTransFallback  = $this->phpTranslations(config('app.fallback_locale'));
                $phpTransLocale    = $this->phpTranslations($locale);
                $jsonTransFallback = $this->jsonTranslations(config('app.fallback_locale'));
                $jsonTransLocale   = $this->jsonTranslations($locale);
                $translations      = [
                    'php'  => ToolboxHelper::arrayMergeRecursiveDistinct(
                        $phpTransFallback,
                        $phpTransLocale,
                    ),
                    'json' => ToolboxHelper::arrayMergeRecursiveDistinct(
                        $jsonTransFallback,
                        $jsonTransLocale,
                    ),
                ];
                return $translations;
            });
        } //end foreach
    }

    /**
     * Gather provided langs checking from files.
     *
     * @return \Illuminate\Support\Collection<string, string>
     */
    private function collectLocalesStrings(): \Illuminate\Support\Collection
    {
        // * En dur dans ->keys array<int,string>.
        // @phpstan-ignore-next-line
        return collect(File::allFiles(resource_path('lang/')))->flatMap(function (SplFileInfo $file) {
            if ($file->getRelativePath() and \strpos($file->getRelativePath(), 'vendor') !== 0) {
                return [$file->getRelativePath() => ''];
            }
        })->keys()->merge(config('app.locales', []));
    }

    /**
     * Gather all php translations.
     *
     * @param string $locale
     * @return array<string, string>
     */
    private function phpTranslations(string $locale): array
    {
        $path = resource_path("lang/$locale");

        if (!File::exists($path) or !File::isReadable($path)) {
            return [];
        }

        return collect(File::allFiles($path))->flatMap(function ($file) use ($locale) {
            $translation = $file->getBasename('.php');
            return [$translation => trans($translation, [], $locale)];
        })->all();
    }

    /**
     * Gather json translations.
     *
     * @param string $locale
     * @return array<string, string>
     */
    private function jsonTranslations(string $locale): array
    {
        $path = resource_path("lang/$locale.json");

        if (!File::exists($path) or !File::isReadable($path)) {
            return [];
        }

        return json_decode(File::get($path), true) ?? [];
    }
}
