<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Download Page</title>



  <link rel="stylesheet" href="{{asset('css/index.css')}}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>

<body>
  <div class="login-page" style="width:auto">
  <div class="form" style="max-width:100%">

@if($visi=='public')
    <div class="panel panel-default">
      <div class="panel-heading">{{$img->title}}
        <div class="pull-right">
          {{$img->created_at}}
        </div>
      </div>
      <div class="panel-body">
        <img src="{{$url}}/show-image/{{$img->user_id}}/{{$img->title}}" oncontextmenu="return false;" style="max-width:100%" alt=""><br>
        Discription:
        {{$img->description}}<br>
        <form method="POST" action="/download">
          {{ csrf_field() }}

          <input type="hidden" name="token" value="{{$token}}">
          <button type="submit">Download</button>
        </form>
      </div>
    </div>
@else
@if(Session::has('logged_id'))
<div class="panel panel-default">
  <div class="panel-heading">{{$img->title}}
    <div class="pull-right">
      {{$img->created_at}}
    </div>
  </div>
  <div class="panel-body">
    <img src="{{$url}}/image/{{$img->user_id}}/{{$img->title}}" oncontextmenu="return false;"  style="max-width:100%" alt=""><br>
    Discription:
    {{$img->description}}<br>
    <form method="POST" action="/download">
      {{ csrf_field() }}

      <input type="hidden" name="token" value="{{$token}}">
      <button type="submit">Download</button>
    </form>  </div>
</div>
@else
<div class="well well-sm">
  This is a private picture.You need to<a href="/"> Log In</a><br>

</div>

@endif

@endif

  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="{{asset('js/index.js')}}"></script>

</body>
</html>
