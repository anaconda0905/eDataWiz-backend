<?php

namespace App\Handlers;
use App\User;
use Sentinel;
class LfmConfigHandler extends \UniSharp\LaravelFilemanager\Handlers\ConfigHandler
{
    public function userField()
    {
        $user=Sentinel::getUser();
        
        if($user->roles()->first()->id == 1){
            return auth()->id();
        }
        else
            return Sentinel::getUser()->id;
    }
    public function baseDirectory(){
        return Sentinel::getUser()->id;
    }
}
