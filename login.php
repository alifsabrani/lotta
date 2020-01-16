<?php
	session_start();
	include 'config.php';
	if (isset($_SESSION['id'])) {
		header("location:index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login LOTTA</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/fonts.css">
	<script src="assets/js/jquery-2.2.3.min.js"></script>
	<script src="assets/js/lotta.js"></script>
</head>
<body>
	<div class="container">
		<div class="fl" id="header">
			<div class="fl-12 fl v-center" id="top">
				<div class="fl-1">
					<a href="index.php" id="logo"><img src="assets/images/logo.png" width="90px" height="80px"></a>
				</div>
				<div class="fl-7">
					<p class="large">
						<span class="bolder larger">Lombok Tour and Travel Agency</span><br>
						Jln. Majapahit no.64 Kota Mataram, NTB, Indonesia (83313)<br>
						<span class="small"><span class="icon-phone"></span> 0370-88763</span>
					</p>
				</div>
				<div class="fl-4 fl right" id="user-nav">
					<a href="login.php" class="fl-4 fl"><button class="btn fl-12 orange">Login</button></a>
					<a href="register.php" class="fl-4 fl"><button class="btn fl-12 blue">Daftar</button></a>
				</div>
			</div>
			<div class="fl-12 fl sp-between" id="nav">
				<div class="fl-2 left">
					<a href="index.php" id="small-logo"><img src="assets/images/small-logo.png" height="30px" width="auto"></a>
				</div>
				<div class="fl-10 right fl bottom" id="nav-menu">
					<a href="wisata.php" class="fl bottom h-center">Destinasi Wisata</a>
					<a href="paket.php" class="fl bottom h-center">Paket Wisata</a>
					<a href="about.php" class="fl bottom h-center">About Us</a>
				</div>
			</div>
		</div>
		<div class="fl v-center blue" id="main">
			<div id="login" class="fl-12 fl h-center">
				<div class="fl-12 text-center very-large"><span class="very-large">Login ke LOTTA</span></div>
				<div class="fl-5 form-container dk-blue">
					<p class="text-center text-warning"></p>
					<form method="POST" action="logincheck.php" role="form" class="fl h-center">
						<div class="fl-12 fl h-center">
							<label for="user_id" class="fl-3">ID Pengguna</label>
							<input type="text" class="fl-8" placeholder="ID" name="id_pengguna" pattern="[A-Za-z0-9]{6,20}" title="Format ID salah" required>
						</div>
						<div class="fl-12 fl h-center">
							<label for="password" class="fl-3">Password</label>
							<input type="password" name="password" placeholder="Password" pattern="[A-Za-z0-9]{6,30}" title="Password harus terdiri dari 6 - 20 huruf dan angka" class="fl-8" required>
						</div>
						<div class="fl-12 fl h-center">
							<button class="btn large blue" name="login" value="kirim" type="submit">Masuk</button>
						</div>	
					</form>
					<div class="fl-12">
						<p class="text-center">Belum mendaftar? <a href="register.php">daftar disni</a></p>
					</div>
				</div>
			</div>
		</div>
		<div id="footer" class="dk-blue">
			<div class="fl h-center">
				<div class="fl-7">
					Web LOTTA berada di bawah pengelolaan CV. Lombok Tour and Travel Agency. Segala aturan dan kebijakan dalam web ini sepenuhnya merupakan hak penuh dari CV. Lombok Tour and Travel Agency.
				</div>
				<div class="fl-4 text-center pad-20">
					<p>
						Find Us:
					</p>
					<div class="fl">
						<div class="fl-12 fl h-center">
							<div class="fl-6 fl sp-around">
								<a href="#"><span class="icon-facebook2 very-large"></span></a>
								<a href="#"><span class="icon-twitter very-large"></span></a>
								<a href="#"><span class="icon-instagram very-large"></span></a>
								<a href="#"><span class="icon-whatsapp very-large"></span></a>
								<a href="#"><span class="icon-location very-large"></span></a>
							</div>
						</div>
					</div>
				</div>
				<div class="fl-12 fl sp-between orange pad-10">
					<div class="fl-12 fl right">
						Copyright&copy; 2016
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>