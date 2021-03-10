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
				<center><img src="{{asset('assets/TIARA_SECURITY2.png')}}" class="img-responsive" style="padding-top:50px;" width="100%"></center>
            </div>
            <div class="col-lg-6"></br></br>
                <center><h4 style="font-family:Bahnschrift;color:white">IT SECURITY AWARENESS</h4>	
                <h5 style="font-family:Bahnschrift;color:white">KEAMANAN WORKSPACE</h5></center></br>			
				<p style="font-family:Bahnschrift;color:white">1. Tidak meninggalkan komputer/laptop dalam keadaan hidup jika tidak digunakan</p>
                <p style="font-family:Bahnschrift;color:white">2. Pastikan untuk selalu logout semua aplikasi korporat jika tidak digunakan</p>
                <p style="font-family:Bahnschrift;color:white">3. Instal Antivirus korporat dan lakukan update secara berkala</p>
                <p style="font-family:Bahnschrift;color:white">4. Berhati-hati dalam mengunduh aplikasi yang berbahaya untuk komputer/laptop</p>
                <p style="font-family:Bahnschrift;color:white">5. Melakukan scanning antivirus setiap ingin menggunakan USB di komputer/laptop</p>
                
            </div>
		</div>
        <div class="row">
			<div class="col-lg-6"></br></br>
                <h6 style="font-family:Bahnschrift;color:white">Butuh bantuan dalam permasalahan layanan TI ?</h6>
                <h6 style="font-family:Bahnschrift;color:white">Silahkan menghubungi TIARA di nomor berikut :</h6>
                <h3 style="font-family:Bahnschrift;color:white"><img src="{{asset('assets/wa.png')}}" class="img-responsive" width="7%"> 08115430600</h3>
                </br><p style="color:white;font-size:15px;">&copy;STI Operasional Kaltimra</p>
            </div> 
            <div class="col-lg-6">
                </br></br>
                <h4 style="color:white;">Anda akan dialihkan dalam <span id="counter">10</span>...  <a href="http://10.32.1.32/portal" class="btn btn-dark btn-lg" role="button" aria-pressed="true">Skip</a></h4>
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
        }, 1000);
        </script>
</body>
</html>