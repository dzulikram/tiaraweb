<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = "pegawai";

    public function mapping()
    {
        return $this->belongsTo('App\Mapping', 'personnel_subarea_name', 'unit');
    }
}
