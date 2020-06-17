<?php
namespace App\Listeners;

use App\FilePath;
use Sentinel;
use UniSharp\LaravelFilemanager\Events\ImageWasUploaded;

function base64url_encode($data)
{
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data)
{
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

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
        $basePath = 'storage';
        $pattern_path = '~[\\\/]files[\\\/][\w\W]+~';
        preg_match_all($pattern_path, $publicFilePath, $matches);

        FilePath::create([
            'path' => $basePath . implode($matches[0]),
            'user_id' => Sentinel::getUser()->id,
            'QRcode' => base64url_encode($basePath . implode($matches[0])),
        ]);
    }
}
