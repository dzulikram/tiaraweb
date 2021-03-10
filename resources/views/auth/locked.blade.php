<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Tiara</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('assets/img/logo.png')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('{{asset('assets/img/img-03.jpg')}}');">
			<div class="wrap-login100">
              
                <form class="login100-form validate-form" action="{{url('/login')}}" method="post">
                @csrf
                
                    <div class="container">
                    </br></br>
						<center> <img src="{{asset('assets/img/LOGO5.png')}}" alt="Image" style="width:250px;height:260px;"> </center>
                    </div>
                    
                    <div class="text-center w-full p-t-25 p-b-230">
                        <a class="txt1" href="#">
                            <span>Akun anda sudah terkunci</span></br>
                            <span>Silahkan menghubungi STI setempat</span>
                        </a>
					</div>
                    
				</form>
			</div>
		</div>
	</div>
	
	
<!--===============================================================================================-->	
	<script src="{{asset('assets/login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets/login/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('assets/login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets/login/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets/login/js/main.js')}}"></script>

</body>
</html>