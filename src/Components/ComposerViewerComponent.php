<?php

declare(strict_types=1);

namespace MoonShine\ComposerViewer\Components;

use Illuminate\Support\Str;
use MoonShine\Components\MoonShineComponent;

/**
 * @method static static make()
 */
final class ComposerViewerComponent extends MoonShineComponent
{
    protected string $view = 'moonshine::composer-viewer';

    public function __construct()
    {
        //
    }

    protected function viewData(): array
    {
        $packages = $this->getComposerPackages();

        /**
         * "name" => "2captcha/2captcha"
         * "direct-dependency" => true
         * "homepage" => null
         * "source" => "https://github.com/2captcha/2captcha-php/tree/v1.1.1"
         * "version" => "v1.1.1"
         * "latest" => "v1.1.1"
         * "latest-status" => "up-to-date"
         * "description" => "PHP package for easy integration with 2captcha API"
         * "abandoned" => false
         * "label" => "label-success"
         */

        return [
            'packages' => $packages
        ];
    }

    protected function getComposerPackages()
    {
        $composer = config('moonshine.composer_viewer.composer');
        try {
            $command = 'cd ' . base_path() . (!$this->isWin() ? ' | ' : ' && ') . $composer . ' show --latest --format=json';
            exec($command, $output);
            $packages = json_decode(implode('', $output), true)['installed'];

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
            return $packages;
        } catch (\Exception $e) {
            return [];
        }
    }

    protected function isWin(): bool
    {
        return Str::of(PHP_OS)->upper()->startsWith('WIN');
    }
}
