<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $table = 'tiket';

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'nip', 'nip');
    }

    public function its()
    {
    	return $this->belongsTo('App\User', 'it_support', 'username');
    }

    public function kategori()
    {
    	return $this->belongsTo('App\Kategori', 'kategori_id', 'id');
    }
}
