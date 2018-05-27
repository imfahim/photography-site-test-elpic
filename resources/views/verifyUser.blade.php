<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Verify Page</title>



  <link rel="stylesheet" href="{{asset('css/index.css')}}">


</head>

<body>
  <div class="login-page">
  <div class="form">
    <h2>Welcome to the site {{$full_name}}</h2>
<br/>
<a href="{{url('verify', $token)}}">Verify Email</a>

  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="{{asset('js/index.js')}}"></script>

</body>
</html>
