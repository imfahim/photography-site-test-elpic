<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Download Complete Mail</title>



  <link rel="stylesheet" href="{{asset('css/index.css')}}">


</head>

<body>
  <div class="login-page">
  <div class="form">
    <h2>Invitation To Download Accepted</h2>
    User:{{$full_name}}<br>
    Email:<a href="{{$email}}">{{$email}}</a><br>
    Has downloaded Image: {{$image_title}} that You invited to.
<br/>

  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="{{asset('js/index.js')}}"></script>

</body>
</html>
