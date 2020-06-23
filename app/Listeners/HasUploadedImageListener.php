<?php
namespace App\Listeners;

use App\FilePath;
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
        // Get te public path to the file and save it to the database
        $publicFilePath = str_replace(storage_path(), "", $event->path());
        FilePath::create([
            'path' => $event->path(),
            'user_id' => Sentinel::getUser()->id,
            'QRcode' => $event->path(),
        ]);
    }
}
