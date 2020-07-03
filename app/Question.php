<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = "questions";
    protected $guarded = [];

    function general(){
        return $this->belongsTo('App\General','pd_general');
    }
    function classification(){
        return $this->belongsTo('App\Classification','pd_classification');
    }
    function header(){
        return $this->belongsTo('App\Header','pd_header');
    }
    function pdList(){
        return $this->belongsTo('App\PdList','pd_list');
    }
    function dpdList(){
        return $this->belongsTo('App\DPdList','dpd_list');
    }
    function brand(){
        return $this->belongsTo('App\Brand','pd_brand');
    }
}
