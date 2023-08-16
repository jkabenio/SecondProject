<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <link rel="icon" type="image/png"  href="{{url('/img/web_logo.png')}}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

 
</head>
<body>
  <style>
    body{
        position: static;
        background-image: url(/img/Picsart_22-12-06_10-22-15-215.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        height: 100%;
        width: 100%;
        
      }
      @media only screen and (max-width:768px){
      
        body{
        position: static;
        background-image: url(/img/20221206_104807.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        height: 100%;
        width: 100%;
        
      }
      
      
      }
    </style>
    <main>
      @include('inc.messages')
        @yield('content')
    </main>
  </div>
</body>
</html>
