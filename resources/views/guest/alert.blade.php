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
				<center><img src="{{asset('assets/hoax.jpeg')}}" class="img-responsive" style="padding-top:50px;" width="50%"></center>
            </div>
            <div class="col-lg-6"></br></br>
                <h4 style="font-family:Bahnschrift;color:white">Electrizen, PLN mengajak seluruh pelanggan untuk berhati-hati terhadap berita hoax yang beredar di media sosial.</h4></br>		
				<p style="font-family:Bahnschrift;color:white">Pemberitaan yang terkait tunggakan rekening listrik disertai ajakan mendownload atau membuka aplikasi PLN.apk agar terhindar dari pemblokiran dan pemutusan listrik rumah pelanggan itu tidak benar, dan informasi tersebut bukan informasi dari PT PLN (Persero). </p>
                <p style="font-family:Bahnschrift;color:white">Untuk informasi resmi terkait layanan dan promo PLN hanya dapat dilihat melalui PLN Mobile. Pastikan Electrizen sudah mendownload PLN Mobile sebagai sumber yang terpercaya. </p>
                <p style="font-family:Bahnschrift;color:white">#PLNMobile #PLN #NoHoax #PLNUntukIndonesia</p>
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
                <h4 style="color:white;">Anda akan dialihkan dalam <span id="counter">20</span>...  <a href="http://10.32.1.32/portal" class="btn btn-dark btn-lg" role="button" aria-pressed="true">Skip</a></h4>
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
                    window.location.replace("http://10.32.1.32/portal");
                }
            }
        }, 1500);
        </script>
</body>
</html>