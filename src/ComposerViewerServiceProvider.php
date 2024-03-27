<?php

namespace MoonShine\ComposerViewer;

use Illuminate\Support\ServiceProvider;
use MoonShine\ComposerViewer\Pages\ComposerViewerPage;
use MoonShine\Menu\MenuItem;
use MoonShine\MoonShine;

class ComposerViewerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'moonshine');
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
