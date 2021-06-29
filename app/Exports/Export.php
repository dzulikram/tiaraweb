<?php

namespace App\Exports;

use App\Tiket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Database\Eloquent\Model;
use DB;

class Export implements WithHeadings, FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Tiket::all();
    // }

    protected $auth;

    public function __construct($auth)
    {
       $this->proj_id = $auth;
    }

    // public function collection()
    // {
    //     return Tiket::where('sti_id', $this->proj_id)->get();
    // }

    public function headings(): array
    {
        return [
            'sender',
            'assignment_date',
            'end_date',
            'no_tiket',
            'nip',
            'pegawai.name',
            'unit',
            'unit_induk',
            'call_type',
            'permasalahan',
            'kategori.name',
            'it_support',
            'resolution',
            'reason_stop',
            'stop_duration',
            'sla_duration'         
        ];
    }

    public function query()
	{
        return DB::table('tiket')
        ->join('pegawai','tiket.nip', '=','pegawai.nip')
        ->join('kategori','tiket.kategori_id', '=','kategori.id')
        ->select('tiket.sender','assignment_date','end_date','no_tiket','tiket.nip','pegawai.name','pegawai.unit','pegawai.unit_induk','call_type','permasalahan','kategori.name','it_support','resolution','reason_stop','stop_duration','sla_duration')
        ->where('tiket.sti_id','=',$this->proj_id)  
        ->orderBy('tiket.id');
	}
}