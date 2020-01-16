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
	<title>Register on LOTTA</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/fonts.css">
	<script src="assets/js/jquery-2.2.3.min.js"></script>
	<script src="assets/js/lotta.js"></script>
	<script>
		$(document).ready(function(){
			$(".back-button, #wisatawan, #perusahaan").hide();
			$("#btnPU").click(function(){
				$("#menuUser").fadeOut(300, function(){$("#perusahaan").fadeIn(300);});
				$(".back-button").show();
				$(".back-button").click(function(){
					$("#perusahaan").fadeOut(300)
					setTimeout(function(){
						$("#menuUser").fadeIn(300);
					}, 300)
					$(this).hide();
					$(this).hide();
				})
			})
			$("#btnW").click(function(){
				$("#menuUser").fadeOut(300, function(){$("#wisatawan").fadeIn(300);});
				$(".back-button").show();
				$(".back-button").click(function(){
					$("#wisatawan").fadeOut(300);
					setTimeout(function(){
						$("#menuUser").fadeIn(300);
					}, 300)
					$(this).hide();
				})
			})
		})
	</script>
</head>
<body>
	<div class="container blue">
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
		<div class="fl top" id="main">
			<div class="fl-12 text-center very-large font-white"><span class="very-large"><span class="bold">Pendaftaran</span> LOTTA</span></div>
			<div class="form-container fl-12 fl h-center pad-10">
				<button class="btn round blue back-button large"><span class="icon-circle-left very-large"></span></button>
				<div class="fl-12 fl sp-around v-center" id="menuUser">
					<div class="fl-5 fl">
						<button class="fl-12 fl btn dk-blue large" id="btnPU">
							<div class="fl-12 very-large">
								<span class="icon-office very-large"></span>
							</div>
							<div class="fl-12 very-large pad-10 text-center">
								Pelaku Usaha
							</div>
						</button>
					</div>
					<div class="fl-5 fl">
						<button class="fl-12 fl btn dk-blue large" id="btnW">
							<div class="fl-12 very-large">
								<span class="icon-user very-large"></span>
							</div>
							<div class="fl-12 very-large pad-10 text-center">
								Wisatawan
							</div>
						</button>
					</div>
				</div>
				<div id="wisatawan" class="fl-5 form-container dk-blue">
					<?php
						if (isset($_GET['err'])) {
							echo '<p class="text-center font-orange">Username Sudah Terdaftar</p>';
						}
					?>
					<div class="fl-12 larger fl v-center pad-10">
						Wisatawan
					</div>
					<form method="POST" action="daftarUser.php" role="form" class="fl h-center">
						<input type="hidden" name="pengguna" value="wisatawan">
						<div class="fl-12 fl sp-between">
							<label for="user_id" class="fl-3">ID Pengguna</label>
							<input type="text" class="fl-8" placeholder="ID" name="id_pengguna" pattern="([A-Za-z0-9]{6,20})" title="Minimal 6 karakter huruf atau angka" >
							<p class="small">ID akan digunakan untuk login</p>
						</div>
						<div class="fl-12 fl sp-between">
							<label for="nama" class="fl-3">Nama</label>
							<input type="text" name="nama_pengguna" placeholder="Nama" class="fl-8" required pattern="([A-Za-z ]{4,30})" title="Nama harus terdiri dari 4 - 30 huruf">
							<p class="small">Nama lengkap anda</p>
						</div>
						<div class="fl-12 fl sp-between">
							<label for="email" class="fl-3">Email</label>
							<input type="email" placeholder="Email" name="email" class="fl-8" required>
							<p class="small">Gunakan email yang aktif</p>
						</div>
						<div class="fl-12 fl sp-between">
							<label for="password" class="fl-3">Password</label>
							<input type="password" name="password" placeholder="Password" pattern="[A-Za-z0-9]{6,30}" title="Terdiri dari 6 - 20 karakter huruf dan angka" class="fl-8" required>
							<p class="small">Gunakan kata sandi yang mudah anda ingat</p>
						</div>
						<div class="fl-12 fl sp-between">
							<label for="tgl_lahir" class="fl-3">Tanggal Lahir</label>
							<div class="fl-8 fl sp-between">
								<select name='tgl' class="fl-2">
									<?php
										for ($i=1; $i < 32; $i++) { 
											echo '<option value="'.$i.'">'.$i.'</option>';
										}
									?>
								</select>
								<select name="bln" class="fl-3">
									<option value="1">Januari</option>
									<option value="2">Februari</option>
									<option value="3">Maret</option>
									<option value="4">April</option>
									<option value="5">Mei</option>
									<option value="6">Juni</option>
									<option value="7">Juli</option>
									<option value="8">Agustus</option>
									<option value="9">September</option>
									<option value="10">Oktober</option>
									<option value="11">November</option>
									<option value="12">Desember</option>
								</select>
								<input type="text" name="thn" placeholder="Tahun" class="fl-1" pattern="[0-9]{4}" title="Format tahun 'yyyy'">
							</div>
						</div>
						<div class="fl-12 fl sp-between">
							<label for="telepon" class="fl-3">No. Telepon</label>
							<input type="text" class="fl-8" placeholder="Nomor telepon" name="telepon" pattern="[0-9]{9,14}" title="Gunakan nomor telepon anda" required>
						</div>
						<div class="fl-12 fl h-center">
							<button class="btn green large" name="daftar" type="submit" value="kirim">Daftar</button>
						</div>	
					</form>
				</div>
				<div id="perusahaan" class="fl-5 form-container dk-blue">
					<?php
						if (isset($_GET['err'])) {
							echo '<p class="text-center font-orange">Username Sudah Terdaftar</p>';
						}
					?>
					<div class="fl-12 larger fl v-center pad-10">
						Pelaku Usaha
					</div>
					<form method="POST" action="daftarPu.php" role="form" class="fl h-center">
						<input type="hidden" name="pengguna" value="usaha">
						<div class="fl-12 fl sp-between">
							<label for="user_id" class="fl-3">ID Pengguna</label>
							<input type="text" class="fl-8" placeholder="ID" name="id_pengguna" pattern="([A-Za-z0-9]{6,20})" title="Minimal 6 karakter huruf atau angka" >
							<p class="small">ID akan digunakan untuk login</p>
						</div>
						<div class="fl-12 fl sp-between">
							<label for="nama" class="fl-3">Nama Pemilik</label>
							<input type="text" name="nama_pengguna" placeholder="Nama" class="fl-8" required pattern="([A-Za-z ]{4,30})" title="Nama harus terdiri dari 4 - 30 huruf">
							<p class="small">Nama lengkap anda</p>
						</div>
						<div class="fl-12 fl sp-between">
							<label for="nama" class="fl-3">Nama Perusahaan</label>
							<input type="text" name="nama_usaha" placeholder="Nama" class="fl-8" required pattern="([A-Za-z .,]{4,30})" title="Nama harus terdiri dari 4 - 30 huruf">
							<p class="small">Nama lengkap perusahaan</p>
						</div>
						<div class="fl-12 fl sp-between">
							<label for="email" class="fl-3">Email</label>
							<input type="email" placeholder="Email" name="email" class="fl-8" required>
							<p class="small">Gunakan email yang aktif</p>
						</div>

						<div class="fl-12 fl sp-between">
							<label for="password" class="fl-3">Password</label>
							<input type="password" name="password" placeholder="Password" pattern="[A-Za-z0-9]{6,30}" title="Terdiri dari 6 - 20 karakter huruf dan angka" class="fl-8" required>
							<p class="small">Gunakan kata sandi yang mudah anda ingat</p>
						</div>
						<div class="fl-12 fl sp-between">
							<label for="telepon" class="fl-3">No. Telepon</label>
							<input type="text" class="fl-8" placeholder="Nomor telepon" name="telepon" pattern="[0-9]{9,14}" title="Gunakan nomor telepon anda" required>
						</div>
						<div class="fl-12 fl h-center">
							<button class="btn green large" name="daftar" type="submit" value="kirim">Daftar</button>
						</div>	
					</form>
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