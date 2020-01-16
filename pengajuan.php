<?php
	session_start();
	include 'config.php';
	if (isset($_SESSION['usaha']) && isset($_SESSION['id']) ){
		$login = true;
		$wisata = false;
	}
	else header("location:index.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ajukan Paket Wisata Anda</title>
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
				<a href="logout.php" class="fl-4 fl"><button class="btn fl-12 red">Logout</button></a>
			</div>
		</div>
		<div class="fl-12 fl sp-between" id="nav">
			<div class="fl-2 left">
				<a href="index.php" id="small-logo"><img src="assets/images/small-logo.png" height="30px" width="auto"></a>
			</div>
			<div class="fl-10 right fl bottom" id="nav-menu">
					<?php
						if($login){
							if(!$wisata){
								echo'
									<a href="profil.php" class="fl bottom h-center">'.$_SESSION["usaha"].'</a>
									<a href="pengajuan.php" class="fl bottom h-center">Ajukan Paket</a>
									<a href="konsultasi.php" class="fl bottom h-center">Hubungi Pengelola</a>
								';
							}
							else{
								echo'
									<a href="profil.php" class="fl bottom h-center">'.$_SESSION["name"].'</a>
									<a href="konsultasi.php" class="fl bottom h-center">Konsultasi Wisata</a>
								';
							}
						}
					?>
					<a href="wisata.php" class="fl bottom h-center">Destinasi Wisata</a>
					<a href="paket.php" class="fl bottom h-center">Paket Wisata</a>
					<a href="about.php" class="fl bottom h-center">About Us</a>
			</div>
		</div>
	</div>
	<div class="fl blue h-center pad-10" id="main">
		<div id="profil" class="fl-9 fl h-center">
			<div class="fl-12 pad-10 text-center font-white very-large">
				Ajukan paket anda untuk jangkauan lebih luas bersama kami!
			</div>
			<div class="fl-12 fl pad-20 dk-blue">
				<div class="form-container fl-12 fl h-center pad-20">
					<form action="prosesPengajuan.php" method="post" class="fl-9 fl pad-20">
						<label for="nama">Nama Paket</label>
						<input type="text" class="fl-12" placeholder="Nama Paket" name="nama"  required>
						<div class="fl-12"></div>
						<label for="harga">Harga Paket</label>
						<div class="fl-12 fl h-center bottom">
							<span class="fl-1">Rp.</span>
							<input type="text" class="fl-10" placeholder="Harga Paket" name="harga"  required>
						</div>
						<div class="fl-12"></div>
						<label for="ta">Deskripsi Paket</label>
						<textarea id="ta" name="deskripsi" class="fl-12"></textarea>
						<div class="fl-12 fl h-center">
							<div class="fl-12"></div>
							<div class="fl-12 fl h-center">
								<button type="submit" name="ajukan" value="ajukan" class="btn blue large"><span class="icon-checkmark"></span> Ajukan</button>
								<button type="reset" class="btn red large"><span class="icon-cross"></span> Reset</button>
							</div>
						</div>
					</form>
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