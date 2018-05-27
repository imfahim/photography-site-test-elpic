<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Home - Elpic</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.10/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.10/angular-route.js"></script>
  <link rel="stylesheet" href="{{asset('css/index.css')}}">


  <style>
  body {
      font-family: "Lato", sans-serif;
  }

  .sidenav {
      height: 100%;
      width: 5%;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #F8F8F8;
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 0px;
  }

  .sidenav a {
      padding: 8px 8px 8px 18px;
      text-decoration: none;
      font-size: 25px;
      color: #355656;
      display: block;
      transition: 0.3s;
  }

  .sidenav a:hover {
      color: #82BD61;
  }

  .sidenav .closebtn {
      position: absolute;
      top: 0;
      right: 25px;
      font-size: 36px;
      margin-left: 50px;
  }
  #main {
      transition: margin-left .5s;
      padding: 16px;
      margin-left: 5%;
  }

  @media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
  }
  </style>

</head>

<body ng-app="myApp" ng-controller="myCtrl">
  <nav class="navbar navbar-default"style="margin-left:5%">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">ElpicLogo</a>
    </div>
    <ul class="nav navbar-nav">
      <li><span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="{{route('user.logout')}}"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
    </ul>
  </div>
</nav>
<div id="mySidenav" class="sidenav">
  <div id="side-icon-menus" class="show">
  <a href="#/!"><span class="glyphicon glyphicon-home"></span></a>
  <a href="#!my-photo"><span class="glyphicon glyphicon-th-large"></span></a>
  <a href="#!upload"><span class="glyphicon glyphicon-cloud-upload"></span></a>
  </div>
  <div id="side-menus" class="hidden">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#/!"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;&nbsp;Home</a>
  <a href="#!my-photo"><span class="glyphicon glyphicon-th-large"></span>&nbsp;&nbsp;&nbsp;My Photo</a>
  <a href="#!upload"><span class="glyphicon glyphicon-cloud-upload"></span>&nbsp;&nbsp;&nbsp;Upload Photo</a>
  </div>

</div>



<div id="main">
  @if (Session::has('success'))
  <strong>Success !</strong> {{ Session::get('success') }}
  @endif
  @if (Session::has('fail'))
      <strong>Failed !</strong> {{ Session::get('fail') }}
  @endif

  @if (Session::has('info'))
      <strong>Note !</strong> {{ Session::get('info') }}
  @endif

  @if (count($errors) > 0)
      <strong>Failed !</strong> For the following reasons -
      <ul>
        @foreach ($errors->all() as $error)
          <li>
            {{ $error }}
          </li>
        @endforeach
      </ul>
  @endif
  <main ng-view></main>
</div>


</body>
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    setTimeout(function(){

      document.getElementById("side-icon-menus").className="hidden";
      document.getElementById("side-menus").className="show";
    }, 300);


}

function closeNav() {
    document.getElementById("side-menus").className="hidden";
    document.getElementById("mySidenav").style.width = "5%";
    document.getElementById("main").style.marginLeft= "5%";
    document.getElementById("side-icon-menus").className="show";

}
</script>
<script  src="{{asset('js/index.js')}}"></script>
<script src="{{asset('js/mainApp.js')}}"></script>
</html>
