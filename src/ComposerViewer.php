<?php

namespace YuriZoom\MoonShineComposerViewer;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ComposerViewer
{
    const TTL = 300;

    public static function getComposerPackages($cache = false)
    {
        $cacheKey = 'moonshine.composer_viewer.packages';
        $returnValue = Cache::get($cacheKey);

        if ($returnValue) {
            return $returnValue;
        }

        $composer = config('moonshine.composer_viewer.composer');

        try {
            exec("cd ".base_path()." && {$composer} show --latest --format=json", $output);

            $packages = json_decode(implode("", $output), true)['installed'];

            foreach ($packages as &$package) {
                switch ($package['latest-status']) {
                    case 'up-to-date':
                        $package['badge'] = 'success';
                        break;
                    case 'update-possible':
                        $package['badge'] = 'warning';
                        break;
                    case 'semver-safe-update':
                        $package['badge'] = 'error';
                        break;
                }
            }

            Cache::set($cacheKey, $packages, self::TTL);

            return $packages;
        } catch (\Exception) {
            return [];
        }
    }

    public static function isWin(): bool
    {
        return Str::of(PHP_OS)->upper()->startsWith('WIN');
    }
}
