<?php
namespace App\Listeners;

use Sentinel;
use UniSharp\LaravelFilemanager\Events\ImageWasUploaded;
class HasUploadedImageListener
{
    /**
     * Handle the event.
     *
     * @param  ImageWasUploaded  $event
     * @return void
     */

    public function handle(ImageWasUploaded $event)
    {
    }
}