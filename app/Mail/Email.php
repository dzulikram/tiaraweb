<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Email extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id,$call_type,$permasalahan,$nip,$name,$personnel_subarea_name,$email,$kategori)
    {
        $this->id=$id;
        $this->call_type=$call_type;
        $this->permasalahan=$permasalahan;
        $this->nip=$nip;
        $this->name=$name;
        $this->unit=$personnel_subarea_name;
        $this->email=$email;
        $this->kategori=$kategori;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->call_type=='incident')
            {
            $subject='[INC]';
            }
        else
            {
            $subject='[SRQ]';
            }
        $data['id']=$this->id;
        $data['call_type']=$this->call_type;
        $data['permasalahan']=$this->permasalahan;
        $data['nip']=$this->nip;
        $data['name']=$this->name;
        $data['unit']=$this->unit;
        $data['email']=$this->email;
        $data['kategori']=$this->kategori;
        return $this->from('tiara@pln.co.id')
                    ->cc(['tiara@pln.co.id',$this->email])
                    ->view('email',$data)
                    ->subject($subject."-IT SUPPORT-".$this->permasalahan." #T".$this->id)
                    ->with(
                        [
                            'nama' => 'STI Kaltimra',
                            'website' => 'tiara.pln.co.id',
                        ]);
    }
}