<?php

namespace App\Handlers;
use App\User;
use Sentinel;
class LfmConfigHandler extends \UniSharp\LaravelFilemanager\Handlers\ConfigHandler
{
    public function userField()
    {
        return Sentinel::getUser()->id;
    }
    public function baseDirectory(){
        return 'storage/'.auth()->user()->id;
    }
}
