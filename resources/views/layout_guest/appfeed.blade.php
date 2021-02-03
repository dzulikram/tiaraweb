<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/img/logo.png')}}">
</head>

@include('layout_guest.header')

<body>
  
    
    <div>
      <!-- Navbar -->
      

        @yield('content')
        
        @include('layout_guest.footer')

    </div>
 
  
</body>

</html>