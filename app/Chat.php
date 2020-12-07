<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'nip', 'nip');
    }
}
