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
				<center><img src="{{asset('assets/land27022023.jpg')}}" class="img-responsive" style="padding-top:10px;" width="50%"></center>
            </div>
            <div class="col-lg-6"></br></br>
                <h4 style="font-family:Bahnschrift;color:white">KEAMANAN DATA RAHASIA</h4></br>		
				<p style="font-family:Bahnschrift;color:white">1. Tidak melakukan sharing data rahasia tanpa izin pemilik informasi </p>
                <p style="font-family:Bahnschrift;color:white">2. Hindari menyebarkan data-data rahasia melalui media sosial</p>
                <p style="font-family:Bahnschrift;color:white">3. Pengiriman data yang bersifat rahasia harus menggunakan amplop tertutup dan tersegel jika data dalam bentuk fisik dan enkripsi jika data dalam bentuk elektronik/digital</p>
                <p style="font-family:Bahnschrift;color:white">4. Penghapusan data rahasia dilakukan dengan cara dihancurkan jika dalam bentuk fisik dan diformat sebanyak 5 kali atau media penyimpanan dihancurkan</p>
            </div>
		</div>
        <div class="row">
			<div class="col-lg-6"></br>
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