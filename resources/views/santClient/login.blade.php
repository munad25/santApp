<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<title>Login</title>
	<link rel="stylesheet" href="assets/materialize/css/materialize.min.css">
	<link rel="stylesheet" href="assets/css/loginStyle.css">
</head>
<body>
	<section class="section logo">
		<div class="row">
			<div class="col s12 center-block">
				<img src="assets/image/AAA.jpeg" alt="logo" class="responsive-img center-block">
			</div>
		</div>
	</section>
	<section class="section">
		<div class="row">
			<div class="col s12 center-align login-label">
				<h5>Login Member</h5>
			</div>
			<form action="{{route('validate')}}" id="loginForm" role="form" method="POST">
				@csrf
				<div class="input-field col s10 offset-s1">
					<input id="username" type="text" name="username" class="validate" >
					<label for="username">Username</label>
				</div>
				<div class="input-field col s10 offset-s1">
					<input id="password" type="password" name="password" class="validate">
					<label for="password">Password</label>
				</div>
			</form>
		</div>
		<div class="row">
			<div class="col s8 offset-s2">
				<button class="btn waves-effect waves-light" type="submit" form="loginForm" id="btnLogin">Login</button>
			</div>
			<div class="col s8 offset-s2 center-align">
				<p>Belum punya akun? <a href="{{route('regist')}}">daftar</a></p>
			</div>
		</div>
	</section>

<script src="assets/js/jquery-3.4.0.min.js"></script>
<script src="assets/materialize/js/materialize.min.js"></script>
<script src="assets/js/login.js"></script>
</body>
</html>