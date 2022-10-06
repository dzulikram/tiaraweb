<!DOCTYPE html>
<html>
<head>
	<title>TIARA</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
	<link rel="icon" type="image/png" href="{{asset('assets/img/logo.png')}}">
</head>
<body style="background: #02849E;">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6">			
				<center><img src="{{asset('assets/KeamananPassword.png')}}" class="img-responsive" style="padding-top:50px;" width="100%"></center>
            </div>
            <div class="col-lg-6"></br></br>
                <center><h4 style="font-family:Bahnschrift;color:white">LANGKAH-LANGKAH</h4>	
                <h5 style="font-family:Bahnschrift;color:white">PENGAMANAN PASSWORD</h5></center></br>			
				<p style="font-family:Bahnschrift;color:white">1. Hindari menuliskan password akses aplikasi di tempat yang terlihat banyak orang</p>
                <p style="font-family:Bahnschrift;color:white">2. Tidak menggunakan default password atau password yang merepresentasikan diri anda</p>
                <p style="font-family:Bahnschrift;color:white">3. Gunakan kombinasi password sesuai dengan kebijakan korporat, minimal menggunakan gabungan dari huruf kapital,huruf kecil, dan angka. Contoh : C4ptainM4rv3L, H4wk3y3s, dll.</p>
                <p style="font-family:Bahnschrift;color:white">4. Lakukan pembaharuan password secara periodik (30 Hari)</p>
                <p style="font-family:Bahnschrift;color:white">5. Password baru tidak boleh sama dengan 15 password terakhir</p>
                
                <!-- <h6 style="color:white;">Sehubungan peningkatan kualitas organisasi dan layanan Divisi Sistem & Teknologi Informasi PT PLN (Persero), dengan ini kami mengharapkan partisipasi Bapak/Ibu/Sdr/i untuk mengikuti Survey Service Quality DIVSTI Tahun 2021.</h6><i><h8 style="color:white;">(Periode Pengisian 16 - 22 November 2021)</h8></i> <br> <a href="https://bit.ly/squa2021" class="btn btn-danger btn-lg" role="button" aria-pressed="true">Isi Survey</a></br> <h9 style="color:white;">Terima kasih atas waktu yang Bapak/Ibu/Sdr/i berikan dalam melengkapi survey ini. Untuk 10 responden yang beruntung akan mendapatkan merchandise menarik dari DIVSTI.</h9> -->
            </div>
		</div>
        <div class="row">
			<div class="col-lg-6"></br></br>
                <h6 style="font-family:Bahnschrift;color:white">Butuh bantuan dalam permasalahan layanan TI ?</h6>
                <h6 style="font-family:Bahnschrift;color:white">Silahkan menghubungi TIARA di nomor berikut :</h6>
                <h3 style="font-family:Bahnschrift;color:white"><img src="{{asset('assets/wa.png')}}" class="img-responsive" width="7%"> 08114771424</h3>
                <a href="https://wa.me/628114771424" target="_blank" class="btn btn-success btn-sm" role="button" aria-pressed="true">Klik Untuk Mengirim WA</a>
                </br><p style="color:white;font-size:15px;">&copy;STI Operasional Kaltimra</p>
            </div> 
            <div class="col-lg-6">
                </br></br>
                <h4 style="color:white;">Anda akan dialihkan dalam <span id="counter">20</span>...  <a href="http://10.37.1.251/portal" class="btn btn-dark btn-lg" role="button" aria-pressed="true">Skip</a></h4>
            </div>       
		</div>        
	</div> 
        <script>
        setInterval(function() {
            var div = document.querySelector("#counter");
            if((div.textContent) >=1)
            {
                var count = div.textContent - 1;
                div.textContent = count;
                if (count == 0) {
                    window.location.replace("http://10.37.1.251/portal");
                }
            }
        }, 1500);
        </script>
</body>
</html>