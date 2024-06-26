<?php

use Illuminate\Support\Facades\Route;
use YuriZoom\MoonShineComposerViewer\Controllers\ComposerViewerController;

Route::group([
    'prefix' => config('moonshine.route.prefix'),
    'as' => 'moonshine.',
    'middleware' => [config('moonshine.auth.middleware'), 'web'],
], function () {
    Route::get('composer/viewer', [ComposerViewerController::class, 'index'])->name('composer.viewer.index');
});
