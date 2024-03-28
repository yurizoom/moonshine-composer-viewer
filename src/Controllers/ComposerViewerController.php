<?php

namespace MoonShine\ComposerViewer\Controllers;

use MoonShine\ComposerViewer\ComposerViewer;
use MoonShine\Http\Controllers\MoonShineController;

class ComposerViewerController extends MoonShineController
{
    public function index(): array
    {
        return [
            'packages' => ComposerViewer::getComposerPackages()
        ];
    }
}
