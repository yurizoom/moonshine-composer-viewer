<?php

namespace YuriZoom\MoonShineComposerViewer\Controllers;

use MoonShine\Laravel\Http\Controllers\MoonShineController;
use YuriZoom\MoonShineComposerViewer\ComposerViewer;

class ComposerViewerController extends MoonShineController
{
    public function index(): array
    {
        return [
            'packages' => ComposerViewer::getComposerPackages(),
        ];
    }
}
