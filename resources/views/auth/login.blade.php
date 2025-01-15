<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Sistem Bantuan Sosial</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('Login_v3/images/icons/favicon.png') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Login_v3/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Login_v3/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Login_v3/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Login_v3/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('Login_v3/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Login_v3/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Login_v3/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('Login_v3/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Login_v3/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('Login_v3/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('{{asset('Login_v3/images/bg-01.jpg')}}');">
			<div class="wrap-login100">
            <form action="/auth/login" method="POST">
                                        @csrf
                                        <span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>
                                        <div class="wrap-input100 validate-input" data-validate = "Enter username">
                                            <label class="form-label" for="email"><b>Email address</b></label>
                                            <input placeholder="Masukkan email anda" name="email" type="email" class="form-control" value="{{ Session::get('email') }}">
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password"><b>Password</b></label>
                                            <input placeholder="Masukkan email password" name="password" type="password" class="form-control">
                                        </div>

                                        <div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

                                        <div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

                                        @if(Session::has('error'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('error') }}
                                        </div>
                                        @endif
                                    </form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{ asset('Login_v3vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('Login_v3vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('Login_v3vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('Login_v3vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('Login_v3vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('Login_v3vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('Login_v3vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('Login_v3vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('Login_v3js/main.js') }}"></script>

</body>
</html>