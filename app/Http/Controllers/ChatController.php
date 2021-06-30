<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use App\Pegawai;
use Carbon\Carbon;
use App\Tiket;
use App\Mapping;
use App\User;
use App\ChatKategori;
use App\Sponsor;
use App\RegionalSti;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $chats = Chat::all();
        $data['chats'] = $chats;
        $data['state'] = "chat";
        return view('chat.list',$data);
    }

    public function getTimeNow()
    {
        return Carbon::now()->toDateTimeString();
    }

    public function createTiket($chat)
    {
        $tiket = new Tiket();
        $tiket->start_conversation = $chat->start_conversation;
        $tiket->end_conversation = $chat->end_conversation;
        $tiket->start_date = $this->getTimeNow();
        $tiket->state = $chat->state;
        $tiket->status = $chat->status;
        $tiket->nip = $chat->nip;
        $tiket->history = $chat->history;

		$stiid = $tiket->pegawai->sti_id;
		$tiket->sti_id = $stiid;
		
        if($chat->is_autoclose == 1)
        {
            $tiket->status_tiket = "resolved";
        }
        else
        {
            $tiket->status_tiket = "open";
        }
        if(!empty($chat->chat_kategori))
        {
            $kategori = ChatKategori::where('id',$chat->chat_kategori)->first();
            if(!empty($kategori))
            {
                $tiket->kategori_id = $kategori->kategori_id;
            }
        }
        if(!empty($chat->via))
        {
        	$tiket->via = $chat->via;
        }
        $tiket->permasalahan = $chat->permasalahan;
        $tiket->chat_id = $chat->id;
        $tiket->sender = $chat->sender;
        $tiket->lokasi = $chat->lokasi;
        $tiket->is_autoclose = $chat->is_autoclose;
        $tiket->call_type = $chat->call_type;
        $tiket->save();

		return $tiket;
    }

	public function closeTicket(Request $request)
	{
		$sponsor = Sponsor::where('id',1)->first();
		$data = $request->json()->all();
		$sender = $data['query']['sender'];
		$chat = Chat::where('sender',$sender)->where('status','open')->first();
		if(!empty($chat))
		{
			$chat->status = "close_conversation";
            $chat->end_conversation = $this->getTimeNow();
			$chat->save();
		}
		$message = "Percakapan telah diakhiri. Terima kasih telah menghubungi Tiara 🙏☺️
		
".$sponsor->sponsor;

		$response = $this->getResponse($message);

		return response()->json([
            'replies' => $response,
          ], 200)->withHeaders([
            "Content-type" => "application/json",
            "Access-Control-Allow-Origin" => "*"
          ]);
	}

    public function getData(Request $request)
    {
        //dd($this->getTimeNow());
    	$data = $request->json()->all();
    	$input = $data['query']['message'];
    	$sender = $data['query']['sender'];
    	$chat = Chat::where('sender',$sender)->where('status','open')->first();
		$sponsor = Sponsor::where('id',1)->first();
    	
    	$message = "";
    	// initial state
    	if(empty($chat))
    	{
            $message = "Hai! terima kasih sudah menghubungi Tiara. Tiara siap membantu Anda. Mohon sebutkan NIP Anda";
    		$chat = new Chat();
    		$chat->sender = $sender;
    		$chat->state = 0;
    		$chat->status = "open";
            $chat->start_conversation = $this->getTimeNow();
            if(!empty($request->via))
            {
            	$chat->via = $request->via;
            }
    		$chat->save();
            $this->addHistory($chat->id,$input);
            $this->addHistory($chat->id,$message);
    	}
    	else if($chat->status == 'open' && $chat->state == 0)
    	{
    		$nip = strtoupper($data['query']['message']);
    		$pegawai = Pegawai::where('nip',$nip)->first();
    		if(!empty($pegawai))
    		{
    			$message = "Salam hangat, Bapak/ibu ".$pegawai->name.", apakah saat ini sedang WFH/WFO?
1. WFO
2. WFH
c. Untuk mengakhiri percakapan

Silahkan balas dengan 1 karakter sesuai pilihan";
				$chat->nip = $pegawai->nip;
				$chat->state = 1;
				$chat->save();

                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else
    		{
    			$message = "Mohon maaf, NIP anda tidak ditemukan, silahkan hubungi STI Regional Setempat 🙏";
    			$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
    			$chat->state = 56;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    	}
    	else if($chat->status == 'open' && $chat->state == 1)
    	{
    		if($input == 1)
    		{
				$pegawai = Pegawai::where('nip',$chat->nip)->first();
				if($pegawai->sti_id == 12)
				{
    			$message = "Layanan apa yang saat ini anda butuhkan?
1. Layanan jaringan
2. Layanan Aplikasi
3. Layanan Desktop
4. Pojok TI
5. Chat dan Layanan
6. Service Request
7. Reset Password/Permintaan VPN
8. Kembali ke menu utama
c. Untuk mengakhiri percakapan";
				}
				else
				{
				$message = "Layanan apa yang saat ini anda butuhkan?
1. Layanan jaringan
2. Layanan Aplikasi
3. Layanan Desktop
4. Pojok TI
5. Chat dan Layanan
6. Service Request
8. Kembali ke menu utama
c. Untuk mengakhiri percakapan";
				}
    			$chat->state = 2;
                $chat->lokasi = "WFO";
    			$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 2)
    		{
    			$pegawai = Pegawai::where('nip',$chat->nip)->first();
				if($pegawai->sti_id == 12)
				{
    			$message = "Layanan apa yang saat ini anda butuhkan?
1. Layanan jaringan
2. Layanan Aplikasi
3. Layanan Desktop
4. Pojok TI
5. Chat dan Layanan
6. Service Request
7. Reset Password/Permintaan VPN
8. Kembali ke menu utama
c. Untuk mengakhiri percakapan";
				}
				else
				{
				$message = "Layanan apa yang saat ini anda butuhkan?
1. Layanan jaringan
2. Layanan Aplikasi
3. Layanan Desktop
4. Pojok TI
5. Chat dan Layanan
6. Service Request
8. Kembali ke menu utama
c. Untuk mengakhiri percakapan";
				}
    			$chat->state = 3;
                $chat->lokasi = "WFH";
    			$chat->save();

                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else
    		{
    			$message = "Mohon masukkan sesuai pilihan";
    		}
    	}
    	else if($chat->status == 'open' && $chat->state == 2)
    	{
    		if($input == 1)
    		{
    			$message = "Apakah anda menggunakan LAN/Wifi
1. LAN
2. Wifi
3. Kembali
c. Untuk mengakhiri percakapan";
				$chat->state = 4;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 2)
    		{
    			$message = "Aplikasi apa yang bermasalah dan seperti apa permasalahannya?";
				$chat->state = 5;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 3)
    		{
    			$message = "Perangkat apa yang bermasalah?
1. PC
2. Printer
3. Laptop
4. Kembali
c. Untuk mengakhiri percakapan";
				$chat->state = 6;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 4)
    		{
    			$message = "silahkan akses alamat berikut https://tiara.pln.co.id/pojok-it
Terima kasih telah menghubungi Tiara 🙏😊

".$sponsor->sponsor;
    			$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
				$chat->state = 7;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 5)
    		{
    			$message = "Chat & saran silahkan mengakses laman berikut ke https://tiara.pln.co.id/saran/create
Terima kasih telah menghubungi Tiara 🙏😊

".$sponsor->sponsor;
    			$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
				$chat->state = 8;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 8)
    		{
    			$nip = $chat->nip;
    			$pegawai = Pegawai::where('nip',$nip)->first();
    			$message = "Salam hangat, Bapak/ibu ".$pegawai->name.", apakah saat ini sedang WFH/WFO?
1. WFO
2. WFH
c. Untuk mengakhiri percakapan

Silahkan balas dengan 1 karakter sesuai pilihan";
				$chat->nip = $pegawai->nip;
				$chat->state = 1;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 6)
    		{
    			$message = "Service request apa yang anda butuhkan?
Layanan apa yang anda butuhkan?
1. Laptop ICON+ 
2. PC ICON+
3. Laptop Non ICON+
4. PC Non ICON+
5. Printer ICON+
6. Printer Non ICON+
7. Smartphone
8. OS
9. MS Office
10. MS Visio
11. MS Project
12. MS Outlook
13. WPS Office
14. SAP
15. Antivirus
16. Other Applications
17. Cable
18. Wifi
19. Join Domain
";
				$chat->state = 19;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
			else if($input == 7)
    		{
    			$message = "Untuk permohonan reset password atau permintaan VPN silahkan mengakses laman berikut : https://linktr.ee/stikaltimra
Terima kasih telah menghubungi Tiara 🙏😊

".$sponsor->sponsor;
    			$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
				$chat->state = 7;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else
    		{
    			$message = "Mohon masukkan sesuai pilihan";
    		}
    	}
		
    	//wfo
    	else if($chat->status == 'open' && $chat->state == 3)
    	{
    		if($input == 1)
    		{
    			$message = "Layanan apa yang ingin anda tanyakan?
1. Panduan VPN
2. Permasalahan Login VPN
3. Kembali ke menu utama
c. Untuk mengakhiri percakapan";
    			$chat->state = 9;
    			$chat->save();

                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 2)
    		{
    			$message = "Aplikasi apa yang bermasalah dan seperti apa permasalahannya?";
    			$chat->state = 10;
    			$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 3)
    		{
                $pegawai = Pegawai::where('nip',$chat->nip)->first();
                if(!empty($pegawai))
                {
                    $kontak = RegionalSti::where('id',$pegawai->sti_id)->first();
                }
                if(!empty($kontak->wa_support))
                {
                    $message = "silahkan melakukan percakapan langsung dengan IT Support kami : 
http://wa.me/".$kontak->wa_support."
Terima kasih telah menghubungi Tiara 🙏☺️

".$sponsor->sponsor;
                }
                else
                {
                    $message = "silahkan melakukan percakapan langsung dengan IT Support kami : 
http://wa.me/6281385282208
Terima kasih telah menghubungi Tiara 🙏☺️

".$sponsor->sponsor;
                }
				$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
    			$chat->state = 11;
    			$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 4)
    		{
    			$message = "silahkan mengunjungi laman berikut : https://tiara.pln.co.id/pojok-it
Terima kasih telah menghubungi Tiara 🙏😊

".$sponsor->sponsor;
    			$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
    			$chat->state = 7;
    			$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 5)
    		{
    			$message = "Untuk keluhan dan saran, silahkan mengunjungi laman berikut : https://tiara.pln.co.id/saran/create
Terima kasih telah menghubungi Tiara 🙏😊

".$sponsor->sponsor;
				$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
    			$chat->state = 8;
    			$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 8)
    		{
    			$nip = $chat->nip;
    			$pegawai = Pegawai::where('nip',$nip)->first();
    			$message = "Salam hangat, Bapak/ibu ".$pegawai->name.", apakah saat ini sedang WFH/WFO?
1. WFO
2. WFH
c. Untuk mengakhiri percakapan

Silahkan balas dengan 1 karakter sesuai pilihan";
				$chat->nip = $pegawai->nip;
				$chat->state = 1;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 6)
    		{
    			$message = "Service request apa yang anda butuhkan?
Layanan apa yang anda butuhkan?
1. Laptop ICON+ 
2. PC ICON+
3. Laptop Non ICON+
4. PC Non ICON+
5. Printer ICON+
6. Printer Non ICON+
7. Smartphone
8. OS
9. MS Office
10. MS Visio
11. MS Project
12. MS Outlook
13. WPS Office
14. SAP
15. Antivirus
16. Other Applications
17. Cable
18. Wifi
19. Join Domain
";
				$chat->state = 19;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
			else if($input == 7)
    		{
    			$message = "Untuk permohonan reset password atau permintaan VPN silahkan mengakses laman berikut : https://linktr.ee/stikaltimra
Terima kasih telah menghubungi Tiara 🙏😊

".$sponsor->sponsor;
    			$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
				$chat->state = 7;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else
    		{
    			$message = "Mohon masukkan sesuai pilihan";
    		}
    	}

    	//wfh
    	else if($chat->status == 'open' && $chat->state == 4)
    	{
    		if($input == 1)
    		{
    			$message = "Mohon cabut dan pasang kembali LAN. Apakah masih bermasalah?
1. Masih belum connect
2. Sudah berhasil, terima kasih
c. Untuk mengakhiri percakapan";
				$chat->state = 12;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 2)
    		{
    			$message = "Apakah sudah connect SID wifi sesuai lokasi?
1. Sudah
2. Belum
c. Untuk mengakhiri percakapan";
				$chat->state = 13;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 3)
    		{
    			$nip = $chat->nip;
    			$pegawai = Pegawai::where('nip',$nip)->first();
    			$message = "Salam hangat, Bapak/ibu ".$pegawai->name.", apakah saat ini sedang WFH/WFO?
1. WFO
2. WFH
c. Untuk mengakhiri percakapan

Silahkan balas dengan 1 karakter sesuai pilihan";
				$chat->nip = $pegawai->nip;
				$chat->state = 1;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else
    		{
    			$message = "Mohon masukkan sesuai pilihan";
    		}
    	}
    	else if($chat->status == 'open' && $chat->state == 5)
    	{
    		
			$chat->status = "close-conversation";
            $chat->end_conversation = $this->getTimeNow();
            $chat->permasalahan = "Permasalahan ".$input;
    		$chat->state = 15;
            $chat->call_type = "incident";
    		$chat->save();
            $this->addHistory($chat->id,$input);
            $this->addHistory($chat->id,$message);
            $tiketku = $this->createTiket($chat);
			$message = "Mohon ditunggu, akan ada IT Support yang akan mendatangi anda.
Terima kasih telah menghubungi Tiara 🙏😊
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    	}
    	else if($chat->status == 'open' && $chat->state == 6)
    	{
    		if($input == 1)
    		{
    			$message = "Masalah apa yang dihadapi?
1. PC Lambat
2. Keyboard/Mouse tidak normal
3. PC Tidak bisa menyala
c. Untuk mengakhiri percakapan";
    			$chat->state = 16;
    			$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 2)
    		{
    			$message = "Masalah apa yang dihadapi?
1. Printer tidak menyala
2. Printer tidak bisa cetak
c. Untuk mengakhiri percakapan";
				$chat->state = 17;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 3)
    		{
    			$message = "Masalah apa yang dihadapi?
1. Laptop Lambat
2. Keyboard/Mouse tidak normal
3. Laptop Tidak bisa menyala
c. Untuk mengakhiri percakapan";
				$chat->state = 18;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 4)
    		{
    			$nip = $chat->nip;
    			$pegawai = Pegawai::where('nip',$nip)->first();
    			$message = "Salam hangat, Bapak/ibu ".$pegawai->name.", apakah saat ini sedang WFH/WFO?
1. WFO
2. WFH
c. Untuk mengakhiri percakapan

Silahkan balas dengan 1 karakter sesuai pilihan";
				$chat->nip = $pegawai->nip;
				$chat->state = 1;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else
    		{
    			$message = "Mohon masukkan sesuai pilihan";
    		}
    	}
    	else if($chat->status == 'open' && $chat->state == 7)
    	{
    		// close
    		$message = "";
    		$chat->state = 21;
    		$chat->save();
            $this->addHistory($chat->id,$input);
            $this->addHistory($chat->id,$message);
    	}
    	else if($chat->status == 'open' && $chat->state == 8)
    	{
    		$message = "";
    		$chat->state = 22;
    		$chat->save();
            $this->addHistory($chat->id,$input);
            $this->addHistory($chat->id,$message);
    	}
    	else if($chat->status == 'open' && $chat->state == 9)
    	{
    		if($input == 1)
    		{
    			$message = "Untuk panduan VPN, silahkan kunjungi link berikut : https://bit.ly/panduanvpnkaltimra";
				$chat->state = 24;
				$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 2)
    		{
    			$message = "Apakah konfigurasinya sudah benar sesuai panduan VPN?
1. Sudah
2. Belum
c. Untuk mengakhiri percakapan";
				$chat->state = 25;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 3)
    		{
    			$nip = $chat->nip;
    			$pegawai = Pegawai::where('nip',$nip)->first();
    			$message = "Salam hangat, Bapak/ibu ".$pegawai->name.", apakah saat ini sedang WFH/WFO?
1. WFO
2. WFH
c. Untuk mengakhiri percakapan

Silahkan balas dengan 1 karakter sesuai pilihan";
				$chat->nip = $pegawai->nip;
				$chat->state = 1;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else
    		{
    			$message = "Mohon masukkan sesuai pilihan";
    		}
    	}
    	else if($chat->status == 'open' && $chat->state == 10)
    	{
    		$pegawai = Pegawai::where('nip',$chat->nip)->first();
                if(!empty($pegawai))
                {
                    $kontak = RegionalSti::where('id',$pegawai->sti_id)->first();
                }
                if(!empty($kontak->wa_support))
                {
                    $message = "silahkan melakukan percakapan langsung dengan IT Support kami : 
http://wa.me/".$kontak->wa_support."
Terima kasih telah menghubungi Tiara 🙏☺️

".$sponsor->sponsor;
                }
                else
                {
                    $message = "silahkan melakukan percakapan langsung dengan IT Support kami : 
http://wa.me/6281385282208
Terima kasih telah menghubungi Tiara 🙏☺️

".$sponsor->sponsor;
                }
    		$chat->status = "close-conversation";
            $chat->end_conversation = $this->getTimeNow();
            $chat->permasalahan = "Permasalahan aplikasi ".$input;
    		$chat->state = 27;
    		$chat->save();
            $this->addHistory($chat->id,$input);
            $this->addHistory($chat->id,$message);
            $this->createTiket($chat);
    	}
    	else if($chat->status == 'open' && $chat->state == 11)
    	{
    		$message = "";
    		$chat->state = 28;
    		$chat->save();
    	}
    	else if($chat->status == 'open' && $chat->state == 12)
    	{
    		if($input == 1)
    		{
    			
    			$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
				$chat->state = 30;
                $chat->permasalahan = "Gagal connect jaringan LAN";
                $chat->call_type = "incident";
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
                $tiketku = $this->createTiket($chat);
				$message = "IT Support akan menuju ke tempat anda, mohon ditunggu.
Terima kasih telah menghubungi Tiara 🙏😊
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    		}
    		else if($input == 2)
    		{
    			
    			$chat->status = "close-conversation";
                $chat->permasalahan = "LAN Kendor";
                $chat->is_autoclose = 1;
                $chat->end_conversation = $this->getTimeNow();
    			$chat->state = 32;
                $chat->call_type = "incident";
    			$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
                $tiketku = $this->createTiket($chat);
				$message = "Terimakasih telah membantu dan menghubungi Tiara 🙏😊
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    		}
    		else
    		{
    			$message = "Mohon masukkan sesuai pilihan";
    		}
    	}
    	else if($chat->status == 'open' && $chat->state == 13)
    	{
    		if($input == 1)
    		{
    			
    			$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
				$chat->state = 34;
                $chat->permasalahan = "Sudah connect wifi, tapi belum bisa connect";
                $chat->call_type = "incident";
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
                $tiketku = $this->createTiket($chat);
				$message = "IT Support akan menuju ke tempat anda, mohon ditunggu.
Terima kasih telah menghubungi Tiara 🙏😊
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    		}
    		else if($input == 2)
    		{
    			$message = "silahkan connect ke wifi yang tersedia terlebih dahulu dengan user yang dimiliki
1. Tidak ada wifi yang tersedia
2. Masih gagal connect
3. Sudah berhasil
c. Untuk mengakhiri percakapan";
				$chat->state = 35;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else
    		{
    			$message = "Mohon masukkan sesuai pilihan";
    		}

    	}
    	else if($chat->status == 'open' && $chat->state == 14)
    	{
    		// kembali
    	}
    	else if($chat->status == 'open' && $chat->state == 15)
    	{
    		$message = "";
    		$chat->state = 42;
    		$chat->save();
    	}
    	else if($chat->status == 'open' && $chat->state == 16)
    	{
    		if($input == 2)
    		{
    			$message = "
Mohon mencabut dan pasang kembali kabel koneksi/usb dongle terlebih dahulu. Apakah masih bermasalah?
1. Sudah normal
2. Belum normal
c. Untuk mengakhiri percakapan";
				$chat->state = 43;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 1)
    		{

    			
				$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
                $chat->permasalahan = "PC Lambat";
                $chat->call_type = "incident";
    			$chat->state = 47;
    			$chat->save();                
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
				$tiketku = $this->createTiket($chat);
				$message = "Mohon ditunggu, akan ada IT Support yang akan mendatangi anda.
Terima kasih telah menghubungi Tiara 🙏😊
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    		}
    		else if($input == 3)
    		{
    			$message = "
Mohon pastikan kabel power telah terkoneksi dengan benar.
Apakah masih bermasalah?
1. Tidak, sudah bisa mneyala
2. Masih, belum bisa menyala
c. Untuk mengakhiri percakapan";
				$chat->state = 44;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else
    		{
    			$message = "Mohon masukkan sesuai pilihan";
    		}
    	}
    	else if($chat->status == 'open' && $chat->state == 17)
    	{
    		if($input == 1)
    		{
    			$message = "Mohon pastikan kabel power dan kabel printer telah terkoneksi dengan benar.
Apakah masih bermasalah?
1. sudah
2. belum
c. Untuk mengakhiri percakapan";
				$chat->state = 45;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else if($input == 2)
    		{
    			
    			$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
				$chat->state = 47;
                $chat->permasalahan = "Printer tidak bisa cetak";
                $chat->call_type = "incident";
				$chat->save();                
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
				$tiketku = $this->createTiket($chat);
				$message = "Mohon ditunggu, akan ada IT Support yang akan mendatangi anda
Terima kasih telah menghubungi Tiara 🙏😊
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    		}
    		else
    		{
    			$message = "Mohon masukkan sesuai pilihan";
    		}
    	}
    	else if($chat->status == 'open' && $chat->state == 18)
    	{
    		if($input == 1 || $input == 2)
    		{
    			
    			$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
    			$chat->state = 47;
                if($input == 1)
                {
                    $chat->permasalahan = "Laptop Lambat";
                }
                else if($input == 2)
                {
                    $chat->permasalahan = "Keyboard/mouse tidak normal";
                }
                $chat->call_type = "incident";
    			$chat->save();

                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
				$tiketku = $this->createTiket($chat);
				$message = "Mohon ditunggu, akan ada IT Support yang akan mendatangi anda
Terima kasih telah menghubungi Tiara 🙏😊
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    		}
    		else if($input == 3)
    		{
    			$message = "
Mohon pastikan kabel power telah terkoneksi dengan benar.
Apakah masih bermasalah?
1. sudah
2. belum
c. Untuk mengakhiri percakapan";
				$chat->state = 53;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else
    		{
    			$message = "Mohon masukkan sesuai pilihan";
    		}
    	}
    	else if($chat->status == 'open' && $chat->state == 19)
    	{
    		$message = "Boleh Tiara tahu detail permintaan anda?";
            $chat->chat_kategori = $input;
			$chat->state = 20;
			$chat->save();
            $this->addHistory($chat->id,$input);
            $this->addHistory($chat->id,$message);
    	}
    	else if($chat->status == 'open' && $chat->state == 20)
    	{
    		if($chat->lokasi == 'WFO')
    		{
    			
                $chat->call_type = "service_request";
    			$chat->state = 23;
    			$chat->status = "close-conversation";
                $chat->permasalahan = $input;
                $chat->end_conversation = $this->getTimeNow();
    			$chat->save();
                $tiketku = $this->createTiket($chat);
				$message = "Mohon ditunggu, akan ada IT Support yang akan mendatangi anda
Terima kasih telah menghubungi Tiara 🙏😊
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    		}
    		else if($chat->lokasi == 'WFH')
    		{
    			$pegawai = Pegawai::where('nip',$chat->nip)->first();
                if(!empty($pegawai))
                {
                    $kontak = RegionalSti::where('id',$pegawai->sti_id)->first();
                }
                if(!empty($kontak->wa_support))
                {
                    $message = "silahkan melakukan percakapan langsung dengan IT Support kami : 
http://wa.me/".$kontak->wa_support."
Terima kasih telah menghubungi Tiara 🙏☺️

".$sponsor->sponsor;
                }
                else
                {
                    $message = "silahkan melakukan percakapan langsung dengan IT Support kami : 
http://wa.me/6281385282208
Terima kasih telah menghubungi Tiara 🙏☺️

".$sponsor->sponsor;
                }
				$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
                $chat->permasalahan = $input;
    			$chat->state = 24;
                $chat->call_type = "service_request";
    			$chat->save();
                $this->createTiket($chat);
    		}
    	}
    	else if($chat->status == 'open' && $chat->state == 21)
    	{
    		//kembali
    	}
    	else if($chat->status == 'open' && $chat->state == 22)
    	{
    		// kembali
    	}
    	else if($chat->status == 'open' && $chat->state == 23)
    	{
    		// end
    	}
    	else if($chat->status == 'open' && $chat->state == 24)
    	{
    		// end
    	}
    	else if($chat->status == 'open' && $chat->state == 25)
    	{
    		if($input == 1)
    		{
    			$pegawai = Pegawai::where('nip',$chat->nip)->first();
                if(!empty($pegawai))
                {
                    $kontak = RegionalSti::where('id',$pegawai->sti_id)->first();
                }
                if(!empty($kontak->wa_support))
                {
                    $message = "silahkan melakukan percakapan langsung dengan IT Support kami : 
http://wa.me/".$kontak->wa_support."
Terima kasih telah menghubungi Tiara 🙏☺️

".$sponsor->sponsor;
                }
                else
                {
                    $message = "silahkan melakukan percakapan langsung dengan IT Support kami : 
http://wa.me/6281385282208
Terima kasih telah menghubungi Tiara 🙏☺️

".$sponsor->sponsor;
                }
				$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
    			$chat->state = 56;
                $chat->permasalahan = "VPN Bermasalah";
                $chat->call_type = "incident";
    			$chat->save();

                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
                $this->createTiket($chat);
    		}
    		else if($input == 2)
    		{
    			$message = "Untuk panduan VPN, silahkan kunjungi link berikut : https://bit.ly/panduanvpnkaltimra.
Terima kasih telah menghubungi Tiara 🙏😊

".$sponsor->sponsor;
    			$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
				$chat->state = 24;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
    		}
    		else
    		{
    			$message = "Mohon masukkan sesuai pilihan";
    		}
    	}
    	else if($chat->status == 'open' && $chat->state == 26)
    	{
    		//end
    	}
    	else if($chat->status == 'open' && $chat->state == 27)
    	{
    		//end
    	}
    	else if($chat->status == 'open' && $chat->state == 28)
    	{
    		//percakapan manual
    		$chat->state = 29;
    		$chat->save();
    	}
    	else if($chat->status == 'open' && $chat->state == 29)
    	{
    		//end
    	}
    	else if($chat->status == 'open' && $chat->state == 30)
    	{
    		
			$chat->state = 30;
			$chat->status = "close-conversation";
            $chat->end_conversation = $this->getTimeNow();
			$chat->save();	            
            $this->addHistory($chat->id,$input);
            $this->addHistory($chat->id,$message);
			$tiketku = $this->createTiket($chat);
			$message = "IT Support akan menuju ke tempat anda, mohon ditunggu.
Terima kasih telah menghubungi Tiara 🙏😊
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    	}
    	else if($chat->status == 'open' && $chat->state == 31)
    	{
    		//end
    	}
    	else if($chat->status == 'open' && $chat->state == 32)
    	{
    		//end
    	}
    	else if($chat->status == 'open' && $chat->state == 33)
    	{
    		//end
    	}
    	else if($chat->status == 'open' && $chat->state == 34)
    	{
    		
    		$chat->status = "close-conversation";
            $chat->end_conversation = $this->getTimeNow();
			$chat->state = 36;
			$chat->save();            
            $this->addHistory($chat->id,$input);
            $this->addHistory($chat->id,$message);
			$tiketku = $this->createTiket($chat);
			$message = "IT Support akan menuju ke tempat anda, mohon ditunggu
Terima kasih telah menghubungi Tiara 🙏😊
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    	}
    	else if($chat->status == 'open' && $chat->state == 35)
    	{
    		if($input == 1 || $input == 2)
    		{
    			
    			$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
    			$chat->state = 37;
                $chat->permasalahan = "Gagal connect jaringan wifi";
                $chat->call_type = "incident";
    			$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
                $tiketku = $this->createTiket($chat);
				$message = "IT Support akan menuju ke tempat anda, mohon ditunggu
Terima kasih telah menghubungi Tiara 🙏😊
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    		}
    		else if($input == 3)
    		{
    			
    			$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
                $chat->permasalahan = "Belum connect wifi";
                $chat->is_autoclose = 1;
    			$chat->state = 55;
    			$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
                $tiketku = $this->createTiket($chat);
				$message = "Terima kasih telah membantu Tiara 🙏😊
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    		}
    		else
    		{
    			$message = "Mohon masukkan sesuai pilihan";
    		}
    	}
    	else if($chat->status == 'open' && $chat->state == 36)
    	{
    		//end
    	}
    	else if($chat->status == 'open' && $chat->state == 37)
    	{
    		//end
    	}
    	else if($chat->status == 'open' && $chat->state == 38)
    	{
    		//end
    	}
    	else if($chat->status == 'open' && $chat->state == 39)
    	{
    		//end
    	}
    	else if($chat->status == 'open' && $chat->state == 40)
    	{
    		//end
    	}
    	else if($chat->status == 'open' && $chat->state == 41)
    	{
    		//end
    	}
    	else if($chat->status == 'open' && $chat->state == 42)
    	{
    		//end
    	}
    	else if($chat->status == 'open' && $chat->state == 43)
    	{
    		if($input == 1)
    		{
    			
    			$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
				$chat->state = 46;
                $chat->permasalahan = "Dongle longgar";
                $chat->is_autoclose = 1;
                $chat->call_type = "incident";
				$chat->save();    	
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);		
                $tiketku = $this->createTiket($chat);
				$message = "Terima kasih telah membantu Tiara 🙏☺️
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    		}
    		else if($input == 2)
    		{
    			
    			$chat->state = 47;
                $chat->end_conversation = $this->getTimeNow();
                $chat->permasalahan = "Permasalahan mouse/keyboard pada PC";
                $chat->call_type = "incident";
    			$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
                $tiketku = $this->createTiket($chat);
				$message = "Mohon ditunggu, akan ada IT Support yang akan mendatangi anda.
Terima kasih telah menghubungi Tiara 🙏😊
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    		}
    		else
    		{
    			$message = "Mohon masukkan sesuai pilihan";
    		}
    	}
    	else if($chat->status == 'open' && $chat->state == 44)
    	{
    		if($input == 1)
    		{
    			$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
    			$chat->state = 50;
                $chat->permasalahan = "Kabel power pc tidak terkoneksi dengan benar";
                $chat->is_autoclose = 1;
                $chat->call_type = "incident";
    			$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
                $tiketku = $this->createTiket($chat);
				$message = "Terima kasih telah menghubungi Tiara 🙏😊
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    		}
    		else if($input == 2)
    		{
    			
				$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
                $chat->permasalahan = "PC tidak bisa menyala";
				$chat->state = 47;
                $chat->call_type = "incident";
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
                $tiketku = $this->createTiket($chat);
				$message = "Mohon ditunggu, akan ada IT Support yang akan mendatangi anda
Terima kasih telah menghubungi Tiara 🙏😊
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    		}
    		else
    		{
    			$message = "Mohon masukkan sesuai pilihan";
    		}
    	}
    	else if($chat->status == 'open' && $chat->state == 45)
    	{
    		if($input == 1)
    		{
    			
    			$chat->state = 50;
    			$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
                $chat->permasalahan = "kabel power printer tidak terkoneksi dengan benar";
                $chat->is_autoclose = 1;
                $chat->call_type = "incident";
    			$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
                $tiketku = $this->createTiket($chat);
				$message = "Terima kasih telah membantu Tiara 🙏☺️
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    		}
    		else if($input == 2)
    		{
    			
    			$chat->status = "close-conversation";
                $chat->permasalahan = "Printer tidak bisa menyala";
                $chat->end_conversation = $this->getTimeNow();
                $chat->call_type = "incident";
				$chat->state = 47;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
                $tiketku = $this->createTiket($chat);				
				$message = "Mohon ditunggu, akan ada IT Support yang akan mendatangi anda
Terima kasih telah menghubungi Tiara 🙏😊
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    		}
    		else
    		{
    			$message = "Mohon masukkan sesuai pilihan";
    		}
    	}
    	else if($chat->status == 'open' && $chat->state == 46)
    	{

    	}
    	else if($chat->status == 'open' && $chat->state == 47)
    	{

    	}
    	else if($chat->status == 'open' && $chat->state == 48)
    	{

    	}
    	else if($chat->status == 'open' && $chat->state == 49)
    	{

    	}
    	else if($chat->status == 'open' && $chat->state == 50)
    	{

    	}
    	else if($chat->status == 'open' && $chat->state == 51)
    	{

    	}
    	else if($chat->status == 'open' && $chat->state == 52)
    	{

    	}
    	else if($chat->status == 'open' && $chat->state == 53)
    	{
    		if($input == 1)
    		{
    			
    			$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
    			$chat->state = 54;
                $chat->permasalahan = "Kabel power laptop";
                $chat->is_autoclose = 1;
                $chat->call_type = "incident";
    			$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
                $tiketku = $this->createTiket($chat);
				$message = "Terima kasih telah membantu Tiara 🙏☺️
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    		}
    		else if($input == 2)
    		{
    			
    			$chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
                $chat->permasalahan = "Laptop tidak menyala";
                $chat->call_type = "incident";
				$chat->state = 47;
				$chat->save();
                $this->addHistory($chat->id,$input);
                $this->addHistory($chat->id,$message);
                $tiketku = $this->createTiket($chat);
				$message = "Mohon ditunggu, akan ada IT Support yang akan mendatangi anda
Terima kasih telah menghubungi Tiara 🙏😊
Untuk memberikan feedback tiket anda silahkan mengisi link berikut : https://tiara.pln.co.id/feedback/".$tiketku->id."

".$sponsor->sponsor;
    		}
    		else
    		{
    			$message = "Mohon masukkan sesuai pilihan";
    		}
    	}
    	else if($chat->status == 'open' && $chat->state == 54)
    	{

    	}
    	else if($chat->status == 'open' && $chat->state == 55)
    	{

    	}
    	else
    	{
    		$message = "";
    	}

    	$response = $this->getResponse($message);

		return response()->json([
            'replies' => $response,
          ], 200)->withHeaders([
            "Content-type" => "application/json",
            "Access-Control-Allow-Origin" => "*"
          ]);
    }

    public function getResponse($message)
    {
    	$data = 
		  array (
		    0 => array (
		      'message' => $message
		  ),
		);

		return $data;
    }

    public function addHistory($chat_id,$message)
    {
        $chat_temp = Chat::find($chat_id);
        $history = $chat_temp->history;
        $history .= $message."<br/>";
        $chat_temp->history = $history;
        $chat_temp->save();
    }
}
