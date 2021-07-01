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
    public function __construct($id,$call_type,$permasalahan,$nip,$name,$position,$unit,$email,$kategori,$email_auth)
    {
        $this->id=$id;
        $this->call_type=$call_type;
        $this->permasalahan=$permasalahan;
        $this->nip=$nip;
        $this->name=$name;
        $this->position=$position;
        $this->unit=$unit;
        $this->email=$email;
        $this->kategori=$kategori;
        $this->email_auth=$email_auth;
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
            $subject='[RQ]';
            }
        $data['id']=$this->id;
        $data['call_type']=$this->call_type;
        $data['permasalahan']=$this->permasalahan;
        $data['nip']=$this->nip;
        $data['name']=$this->name;
        $data['position']=$this->position;
        $data['unit']=$this->unit;
        $data['email']=$this->email;
        $data['kategori']=$this->kategori;
        return $this->from($this->email)
                    ->cc(['tiara@pln.co.id',$this->email,$this->email_auth])
                    ->view('email',$data)
                    ->subject($subject."-".$this->kategori." #T".$this->id)
                    ->with(
                        [
                            'nama' => 'STI Kaltimra',
                            'website' => 'tiara.pln.co.id',
                        ]);
    }
}