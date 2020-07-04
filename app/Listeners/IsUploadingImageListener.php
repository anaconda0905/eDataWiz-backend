<?php

namespace App\Listeners;

use UniSharp\LaravelFilemanager\Events\ImageIsUploading;
use Illuminate\Support\Facades\Auth;
use Sentinel;

class IsUploadingImageListener
{
    /**
     * Handle the event.
     *
     * @param  ImageIsUploading  $event
     * @return void
     */
    public function handle(ImageIsUploading $event)
    {
    }
}
