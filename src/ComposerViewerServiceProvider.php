<?php

namespace YuriZoom\MoonShineComposerViewer;

use Illuminate\Support\ServiceProvider;
use MoonShine\Menu\MenuItem;
use MoonShine\MoonShine;
use YuriZoom\MoonShineComposerViewer\Pages\ComposerViewerPage;

class ComposerViewerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'moonshine-composer-viewer');
        $this->loadRoutesFrom(__DIR__.'/../routes/composer_viewer.php');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'moonshine-composer-viewer');
        $this->mergeConfigFrom(__DIR__.'/../config/composer-viewer.php', 'moonshine.composer_viewer');

        moonshine()
            ->pages([
                new ComposerViewerPage(),
            ])
            ->when(
                config('moonshine.composer_viewer.auto_menu'),
                fn (MoonShine $moonshine) => $moonshine->
                vendorsMenu([
                    MenuItem::make(
                        static fn () => __('Composer Viewer'),
                        new ComposerViewerPage(),
                    ),
                ])
            );
    }
}
