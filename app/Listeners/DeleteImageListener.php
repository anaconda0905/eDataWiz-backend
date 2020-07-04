<?php
namespace App\Listeners;

use UniSharp\LaravelFilemanager\Events\ImageIsDeleting;

class DeleteImageListener
{
    /**
     * Handle the ImageIsDeleting event.
     * If the image that is to be deleted exists inside the file_paths table,
     * block the deletion of that image and show appropriate response.
     *
     * @param  ImageIsDeleting  $event
     * @return void
     */
    public function handle(ImageIsDeleting $event)
    {
    }
}
