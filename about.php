<?php
	session_start();
	include 'config.php';
	if (isset($_SESSION['name']) && isset($_SESSION['id'])) {
		$login = true;
		$wisata=true;}
	else if (isset($_SESSION['usaha']) && isset($_SESSION['id']) ){
		$login = true;
		$wisata = false;
	}
	else $login = false;
?>
<!DOCTYPE html>
<html>
<head>
	<title>LOTTA | Lombok Tour and Travel Agency</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/fonts.css">
	<script src="assets/js/jquery-2.2.3.min.js"></script>
	<script src="assets/js/lotta.js"></script>
</head>
<body>
	<div class="container blue font-white">
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
				<?php
					if(!$login){
						echo '
								<a href="login.php" class="fl-4 fl"><button class="btn fl-12 orange">Login</button></a>
								<a href="register.php" class="fl-4 fl"><button class="btn fl-12 blue">Daftar</button></a>
						';
					}
					else{
						echo '<a href="logout.php" class="fl-4 fl"><button class="btn fl-12 red">Logout</button></a>';
					}
				?>
				</div>
			</div>
			<div class="fl-12 fl sp-between" id="nav">
				<div class="fl-2 left">
					<a href="index.php" id="small-logo"><img src="assets/images/small-logo.png" height="30px" width="auto"></a>
				</div>
				<div class="fl-10 right fl bottom" id="nav-menu">
					<?php
						if($login){
							if($wisata){
								echo '
									<a href="profil.php" class="fl bottom h-center">'.$_SESSION["name"].'</a>
									<a href="konsultasi.php" class="fl bottom h-center">Konsultasi Wisata</a>
								';
							}
							else{
								echo '
									<a href="profil.php" class="fl bottom h-center">'.$_SESSION["usaha"].'</a>
									<a href="pengajuan.php" class="fl bottom h-center">Ajukan Paket</a>
									<a href="konsultasi.php" class="fl bottom h-center">Hubungi Pengelola</a>
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
		<div class="fl top h-center" id="main">
			<div class="fl-7 fl">
				<div class="fl-12 very-large">
					About Us
				</div>
				<div class="fl-12">
					<br>
					<p align="justify">
						Website Lombok Tour and Travel Agency atau dikenal dengan Web LOTTA merupakan website yang
						berada dibawah pengelolaan CV. Lombok Tour and Travel Agency. Pengembangan dari website ini dilatarbelakangi oleh pengetahuan para wisatawan mengenai destinasi wisata apa saja yang bisa ia kunjungi di pulau Lombok masih kurang. Kurangnya pengetahuan para wisatawan ini akan menjadi peluang besar bagi para oknum-oknum guide untuk melakukan penipuan terhadap wisatawan yang menjadi calon korbannya. Tidak jarang wisatawan yang kekurangan informasi akan di peras untuk membeli sebuah paket wisata dengan harga berkali-kali lipat dari harga normal.
					</p>
					<p align="justify">
						Selain itu, wisatawan yang berkunjung ke pulau Lombok sering mengalami tindak kriminal seperti perampokan, pencurian, pungli, dan pemerasan. Rata-rata, kejadian ini lebih sering terjadi pada wisatawan yang bepergian sendiri dengan cara menyewa motor. Selain itu, mereka juga tertipu dengan orang yang menawarkan transport liar yang sifatnya ilegal. Hal seperti ini tentunya akan mencoreng citra keindahan yang ada di Lombok dan bisa saja akan menurunkan jumlah wisatawan yang berkunjung ke Lombok.
					</p>
					<br>
					<p align="justify">
						Informasi lebih lanjut tentang CV. Lombok Tour and Travel Agency dapat anda dapatkan di kantor kami yaitu jln. Majapahit n0. 64 Kota Mataram, NTB, Indonesia. Kami siap menyambut baik kedatangan anda di kantor kebanggaan kami
					</p>
					<p align="justify">
						Temukan kami pada media sosial favorit anda...
						<dd>Facebook = Lombok Tour and Travel </dd>
						<dd>Twitter = @lotta</dd>
						<dd>Instagram = @lotta</dd>
						<dd>Whatsapp = 087765543321</dd>
					</p>
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