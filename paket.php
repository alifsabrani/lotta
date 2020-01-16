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
	<title>Paket Wisata</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="assets/css/fonts.css">
		<script src="assets/js/jquery-2.2.3.min.js"></script>
		<script src="assets/js/lotta.js"></script>
		<script>
			function reqPaket(id) {
				$.ajax({
					url: "reqPaket.php",
					type: "POST",
					data: "id_paket="+id,
					success: function(data){
						$("#popup-item").html(data);
						$("#popup-container").show(100, function(){
							$("#popup-container").addClass("showed");
						});
						$(".close").click(function(){
							$("#popup-container").removeClass("showed");
							return false;
						})
					}
				})
			}
			$(document).ready(function(){
				<?php
					if (isset($_GET['id'])) {
						$id = $_GET['id'];
						echo "reqPaket(".$id.");";
					}
				?>
				$(".promo").click(function(){
					id = $(this).attr('id').substr(5);
					reqPaket(id);
					return false;
				})
			})
		</script>
</head>	
	<body>
		<div class="container blue">
		<div id="popup-container">
			<div id="popup-item" class="fl h-center v-center">
				
			</div>
		</div>
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
			<div class="fl-12 pad-20 text-center very-large font-white mar-10" style="background-color: rgba(0,0,0,0.3);">Paket wisata terbaik untuk anda</div>
			<div class="fl-12 fl sp-between">
				<?php
					$q = mysqli_query($con, "select paket.id_paket, paket.deskripsi_paket, paket.nama_paket, paket.harga, (select id_tempat from memiliki where id_paket = paket.id_paket order by rand() limit 1) as tempat from paket");
					while ($result = mysqli_fetch_array($q)) {
						echo '
							<a href="#" id="paket'.$result["id_paket"].'" class="zoom img-container fl-3 mar-10 text-center promo">
								<div class="head">
									'.$result["nama_paket"].'
								</div>
								<img src="assets/images/places/'.$result["tempat"].'.jpg">
								<div class="desc">
									Rp. '.number_format($result['harga'], 0, '', '.').',00
								</div>
							</a>';
					}
				?>
			</div>
		</div>
		<div id="footer" class="dk-blue">
			<div class="fl sp-between">
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