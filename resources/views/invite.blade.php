<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Invite Page</title>



  <link rel="stylesheet" href="{{asset('css/index.css')}}">


</head>

<body>
  <div class="login-page">
  <div class="form">
    <h2>User {{$full_name}} has invite you to download a image</h2>
<br/>
<a href="{{url('invite-verify', $token)}}">Click to the image</a>

  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="{{asset('js/index.js')}}"></script>

</body>
</html>
