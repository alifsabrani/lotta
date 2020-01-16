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
	<div class="container gray2">
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
		<div class="fl" id="main">
			<div id="top-main" class="fl-12 h-center" <?php if ($login) echo "style='display:none'"; ?>>
				<div class="fl h-center very-large text-center bolder">Bergabung dengan kami untuk berbagai penawaran terbaik bagi wisata anda!</div>
				<div class="fl h-center">
					<a href="register.php"><button class="btn larger blue round">Bergabung Sekarang</button></a>
				</div>
			</div>
			<div id="content" class="fl-12 fl sp-around">
				<div class="fl-12" id="slideshow">
					<a href="#" id="slide1"><img src="assets/images/1.jpg" width="100%" height="auto"></a>
					<a href="#" id="slide2"><img src="assets/images/3.jpg" width="100%" height="auto"></a>
					<a href="#" id="slide3"><img src="assets/images/2.jpg" width="100%" height="auto"></a>
					<a href="#" id="slide4"><img src="assets/images/4.jpg" width="100%" height="auto"></a>
					<form class="fl h-center" id="slideBtn">
						<input type="radio" name="slide" id="slideBtn1" value="1" checked>
						<input type="radio" name="slide" id="slideBtn2" value="2">
						<input type="radio" name="slide" id="slideBtn3" value="3">
						<input type="radio" name="slide" id="slideBtn4" value="4">
					</form>
				</div>
			</div>
			<div class="fl-12 fl sp-around white pad-20">
				<div class="fl-12 fl h-center" id="paket">
					<div class="fl-12 text-center larger blue content-header">
						Rekomendasi Paket
					</div>
					<div class="fl-12 fl sp-around">
						<?php
							$q = mysqli_query($con, "select paket.id_paket, paket.nama_paket, paket.harga, memiliki.id_tempat as tempat from paket inner join memiliki on paket.id_paket = memiliki.id_paket group by paket.id_paket  order by paket.id_paket desc limit 0,3;");
							while ($result = mysqli_fetch_array($q)) {
								echo '
									<a href="paket.php?id='.$result['id_paket'].'" class="zoom img-container fl-3 text-center promo mar-20">
										<div class="head">
											'.$result["nama_paket"].'
										</div>
										<img src="assets/images/places/'.$result["tempat"].'.jpg">
										<div class="desc">
											Rp. '.$result["harga"].',00
										</div>
									</a>
								';
							}
						?>
					</div>
				</div>
				<div class="fl-12 fl">
					<div class="fl-12 orange larger text-center content-header">
						Destinasi Populer
					</div>
					<div class="fl-12 fl v-center sp-between" id="tempat">
						<?php
							$q = mysqli_query($con, " select tempat.nama_tempat as nama, tempat.id_tempat as id, tempat.lokasi as lokasi, avg(review.rating) as rating from tempat inner join review on tempat.id_tempat = review.id_tempat group by review.id_tempat order by rating desc limit 0,4 ;");
							while ($result = mysqli_fetch_array($q)) {
								$rate = array();
								$rating = $result['rating'];

								for($i = 0; $i < 5;$i++){
									if ($rating >= 1) {
										$rate[$i] = '<span class="icon-star-full"></span>';		
									}
									else if($rating > 0){
										$rate[$i] = '<span class="icon-star-half"></span>';
									}
									else{
										$rate[$i] = '<span class="icon-star-empty"></span>';
									}
									$rating--;
								}
								$rate = join($rate);

								echo '
									<div class="fl-2 fl blue mar-20">
										<a href="wisata.php?id='.$result["id"].'" class="fl-12 zoom img-container" style="height: 80%">
											<img src="assets/images/places/'.$result["id"].'.jpg">
										</a>
										<div class="fl-12 text-center small font-blue" style="height: 20%">
											<span class="larger font-orange">'.$rate.'</span><br>
											<span class="larger">'.$result["nama"].'</span><br>
											<span class="large">'.$result["lokasi"].'</span><br>
										</div>
									</div>			
								';
							}
						?>
					</div>
					<span class="icon-starfull"></span>
				</div>
			</div>
			<div class="fl-12 fl">
				<div class="fl-12 text-center larger orange content-header">
					Apa yang kami tawarkan untuk anda?
				</div>
				<div class="fl-12 pad-20 fl sp-around white">
					<div class="fl-3 text-center">
						<span class="icon icon-user-tie font-green"></span><br>
						Anda tidak perlu bingung lagi jika ingin berlibur ke Lombok karena tidak memiliki rencana yang pasti. Anda dapat mengkonsultasikan segala kebingungan anda mengenai rencana kunjungan wisata ke pulau Lombok. Cukup dengan mendaftarkan diri anda menjadi anggota dari LOTTA dan sudah bisa menikmati keuntungan ini. Jadi, bagi anda yang mengaku explorer sejati mari bergabung bersama kami. Bersama kita menjelajah pulau Lombok.
					</div>
					<div class="fl-3 text-center">
						<span class="icon icon-unlocked font-blue1"></span><br>
						Anda memiliki usaha di bidang pariwisata? Apakah anda memiliki paket wisatanya? Web LOTTA menyediakan fitur pengajuan paket wisata bagi anda yang memiliki paket wisata untuk pulau Lombok. Jadi, anda tidak perlu khawatir lagi paket wisata anda tidak laku dan tidak bisa dipromosikan. Cukup dengan mendaftarkan diri sebagai anggota dari web LOTTA anda dapat menikmati fitur pengajuan paket wisata. Mari tingkatkan kerjasama menuju Lombok surga wisatawan.
					</div>
					<div class="fl-3 text-center">
						<span class="icon icon-pie-chart font-blue2"></span><br>
						Berikan komentar anda terhadap destinasi-destinasi wisata yang ada di Pulau Lombok. Berikan pula penilaian anda dengan ratting yang web LOTTA sediakan. Dengan fitur ini anda dapat membantu wisatawan lainnya untuk mengambil keputusan wisatanya. Anda juga bisa memberikan saran agar celah kekurangan destinasi wisata bisa di evaluasi oleh pihak yang berwenang.
					</div>
					<div class="fl-3 text-center">
						<span class="icon icon-gift font-orange"></span><br>
						Ingin berwisata praktis tanpa pikir-pikir mau kemana aja? Tenang saja, web LOTTA menyediakan berbagai paket wisata yang bisa anda pilih sesuai dengan keinginan anda. Mari bergabung bersama kami dan anda dapat memilih paket wisata sesuka hati anda. Jadi, jangan berpikir panjang lagi, cukup dengan mendaftarkan diri anda sudah bisa menjelajah pulau Lombok denan paket-paket wisata yang kami tawarkan.
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