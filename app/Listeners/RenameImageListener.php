<?php
namespace App\Listeners;

use UniSharp\LaravelFilemanager\Events\ImageIsRenaming;

class RenameImageListener
{
    /**
     * Handle the ImageIsRenaming event.
     * If the image that is to be renamed exists inside the file_paths table,
     * rename the file path in the database to reflect the new file name.
     *
     * @param  ImageIsRenaming  $event
     * @return void
     */
    public function handle(ImageIsRenaming $event)
    {
    }
}
