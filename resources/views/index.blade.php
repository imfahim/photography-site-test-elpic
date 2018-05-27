<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Photography WebApp Login & Registration</title>

      <link rel="stylesheet" href="{{asset('css/index.css')}}">


</head>

<body>
  <div class="login-page">
  <div class="form">
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

    <form class="register-form" method="POST" action="{{route('user.register')}}">
      {{ csrf_field() }}
      <input type="text" placeholder="Full Name" name="full_name" ng-model="msg" required/>
      <input type="text" placeholder="Email address" name="email" required/>
      <input type="password" placeholder="Password" name="password" required/>
      <input type="password" placeholder="Confirm Password" name="cpassword" required/>
      <input type="text" placeholder="Mobile Number" name="mobile_number" required/>
      <input type="text" placeholder="Address" name="address" required/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form" method="POST" action="{{route('user.login')}}">
      {{ csrf_field() }}
      <input type="text" name="email" placeholder="Email"/>
      <input type="password" name="password" placeholder="Password"/>
      <button>login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>


  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="{{asset('js/index.js')}}"></script>

</body>

</html>
