<?php

namespace YuriZoom\MoonShineComposerViewer;

use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Contracts\MenuManager\MenuManagerContract;
use MoonShine\MenuManager\MenuItem;
use YuriZoom\MoonShineComposerViewer\Pages\ComposerViewerPage;

class ComposerViewerServiceProvider extends ServiceProvider
{
    public function boot(CoreContract $core, MenuManagerContract $menu): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'moonshine-composer-viewer');
        $this->loadRoutesFrom(__DIR__.'/../routes/composer_viewer.php');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'moonshine-composer-viewer');
        $this->mergeConfigFrom(__DIR__.'/../config/composer-viewer.php', 'moonshine.composer_viewer');

        $core
            ->pages([
                ComposerViewerPage::class,
            ]);

        if (config('moonshine.composer_viewer.auto_menu')) {
            $menu->add([
                MenuItem::make(ComposerViewerPage::class),
            ]);
        }
    }
}
