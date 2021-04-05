<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapping extends Model
{
    protected $table = "mapping";

    public function regional()
    {
        return $this->belongsTo('App\RegionalSti', 'sti_id', 'id');
    }
}
