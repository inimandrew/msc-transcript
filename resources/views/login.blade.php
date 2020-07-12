<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{url('login_assets/images/icons/favicon.ico')}}"/>

	<link rel="stylesheet" type="text/css" href="{{url('login_assets/vendor/bootstrap/css/bootstrap.min.css')}}">

	<link rel="stylesheet" type="text/css" href="{{url('login_assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">

	<link rel="stylesheet" type="text/css" href="{{url('login_assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">

	<link rel="stylesheet" type="text/css" href="{{url('login_assets/vendor/animate/animate.css')}}">

	<link rel="stylesheet" type="text/css" href="{{url('login_assets/vendor/css-hamburgers/hamburgers.min.css')}}">

	<link rel="stylesheet" type="text/css" href="{{url('login_assets/vendor/animsition/css/animsition.min.css')}}">

	<link rel="stylesheet" type="text/css" href="{{url('login_assets/vendor/select2/select2.min.css')}}">

	<link rel="stylesheet" type="text/css" href="{{url('login_assets/vendor/daterangepicker/daterangepicker.css')}}">

	<link rel="stylesheet" type="text/css" href="{{url('login_assets/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('login_assets/css/main.css')}}">
    <style>
    .error{
        color: red;
    }</style>
</head>
<body style="background-color: #666666;">

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" autocomplete="off" action="{{route('login_user')}}" method="POST">
					<span class="login100-form-title p-b-43">
						Login
					</span>
                    {{ csrf_field() }}

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="user_id" value="{{old('user_id')}}">
						<span class="focus-input100"></span>
                        <span class="label-input100">Username/ Matriculation Number/ Staff Id</span>

					</div>
                    <center class ="error">{{ $errors->first('user_id') }}</center>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password">
						<span class="focus-input100"></span>
                        <span class="label-input100">Password</span>

					</div>
                    <center class ="error">{{ $errors->first('password_error') }}</center>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('{{url('login_assets/images/bg-01.jpg')}}');">
				</div>
			</div>
		</div>
	</div>

	<script src="{{url('login_assets/vendor/jquery/jquery-3.2.1.min.js')}}"></script>

	<script src="{{url('login_assets/vendor/animsition/js/animsition.min.js')}}"></script>

	<script src="{{url('login_assets/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{url('login_assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

	<script src="{{url('login_assets/vendor/select2/select2.min.js')}}"></script>

	<script src="{{url('login_assets/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{url('login_assets/vendor/daterangepicker/daterangepicker.js')}}"></script>

	<script src="{{url('login_assets/vendor/countdowntime/countdowntime.js')}}"></script>

	<script src="{{url('login_assets/js/main.js')}}"></script>

</body>
</html>
