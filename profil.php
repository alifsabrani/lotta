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
	<title>Profil <?php
	if ($login && $wisata) {
		echo $_SESSION['name'];
	}
	else{
		echo $_SESSION['usaha'];
	}
	?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/fonts.css">
	<script src="assets/js/jquery-2.2.3.min.js"></script>
	<script src="assets/js/lotta.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#bukti").change(function(){
				$("#uploadBukti").submit();
			})
		})
	</script>
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
		<div class="fl blue top sp-around pad-10" id="main">
			<div id="profil" class="fl-12 fl h-center">
				<div class="fl-12 pad-10 text-center font-white very-large">
					Profil 
					<?php 
					if($wisata)
						echo $_SESSION['name']; 
					else
						echo $_SESSION['usaha'];
					?>
				</div>
				<div class="fl-12 fl pad-20 h-center">
					<div class="fl-4 pad-20">
						<?php
							$id= $_SESSION['id'];
							if($wisata){
								$sql = "select pengguna.*,wisatawan.* FROM pengguna,wisatawan where pengguna.id_pengguna=wisatawan.id_pengguna and pengguna.id_pengguna = '$id'";
								$q = mysqli_query($con, $sql);
								while ($ary = mysqli_fetch_array($q)) {
								echo '
								<div class="white fl-12 fl h-center mar-10 pad-10">
									<div class="fl-12 large text-center">Biodata</div>
									<div class="fl-3 green">
										ID
									</div>
									<div class="fl-9 green text-center">
										'.$ary['id_pengguna'].'
									</div>
									<div class="fl-12"></div>
									<div class="fl-3">
										Nama
									</div>
									<div class="fl-9 text-center">
										'.$ary['nama_wisatawan'].'
									</div>
									<div class="fl-12"></div>
									<div class="fl-3 green ">
										Tanggal lahir
									</div>
									<div class="fl-9 green text-center">
										'.$ary['tgl_lahir'].'
									</div>
									<div class="fl-12"></div>
									<div class="fl-3">
										Email
									</div>
									<div class="fl-9 text-center">
										'.$ary['email'].'
									</div>
									<div class="fl-12"></div>
									<div class="fl-3 green">
										No. Telepon
									</div>
									<div class="fl-9 green text-center">
										'.$ary['telepon'].'
									</div>
									<div class="fl-12"></div>
								</div>';
								}
								echo '<div class="fl-12 white mar-10 pad-10">
										Silahkan lakukan pemesanan paket wisata pada menu paket wisata. kemudian lakukan pembayaran melalui
										ATM atau Teller bank sebagai berikut:<br>
										<ul>
											<li>Bank BCA<dd>191874592263985 a.n Lombok Tour and Travel Agency</dd></li>
											<li>Bank Mandiri<dd>1610357489302 a.n Lombok Tour and Travel Agency</dd></li>
											<li>Bank NTB<dd>18209476289045 a.n Lombok Tour and Travel Agency</dd></li>
										</ul>
									</div>';
							}
							else{
								$sql = "select pengguna.*,pelaku_usaha.* FROM pengguna,pelaku_usaha where pengguna.id_pengguna=pelaku_usaha.id_pengguna and pengguna.id_pengguna = '$id'";
								$q = mysqli_query($con, $sql);
								while ($ary = mysqli_fetch_array($q)) {
								echo '
								<div class="white fl-12 fl h-center mar-10 pad-10">
									<div class="fl-12 large text-center">Biodata</div>
									<div class="fl-3 green">
										ID
									</div>
									<div class="fl-9 green text-center">
										'.$ary['id_pengguna'].'
									</div>
									<div class="fl-12"></div>
									<div class="fl-3">
										Nama Pemilik
									</div>
									<div class="fl-9 text-center h-center">
										'.$ary['nama_pemilik'].'
									</div>
									<div class="fl-12"></div>
									<div class="fl-4 green ">
										Nama Perusahaan
									</div>
									<div class="fl-8 green text-center">
										'.$ary['nama_usaha'].'
									</div>
									<div class="fl-12"></div>
									<div class="fl-3">
										Email
									</div>
									<div class="fl-9 text-center">
										'.$ary['email'].'
									</div>
									<div class="fl-12"></div>
									<div class="fl-3 green">
										No. Telepon
									</div>
									<div class="fl-9 green text-center">
										'.$ary['telepon'].'
									</div>
									<div class="fl-12"></div>
								</div>';
								}
							echo '<div class="fl-12 white mar-10 pad-10">
								Silahkan hubungi pengelola web jika ada sesuatu yang ingin anda tanyakan seputar paket yang anda ajukan atau hal yang belum anda pahami
							</div>';
							}
						?>
					</div>
					<div class="white fl-7 fl sp-between mar-10 pad-10">
						<?php
							if(!$wisata){
							echo '<div class="fl-12 very-large text-center">Daftar Pengajuan Paket Anda</div>
							<div class="fl-12 fl text-center top sp-between">
								<div class="fl-12 fl blue font-white">
									<table border="1" cellspacing=0 cellpadding=5 width=100%>
										<tr align=center>
											<td>Nama Paket</td>
											<td>Harga</td>
											<td>Status</td>
										</tr>';
											$id= $_SESSION['id'];
											$sql = "select * from pengajuan_paket where id_pengguna = '$id';";
											$q = mysqli_query($con, $sql);
											while ($ary = mysqli_fetch_array($q)) {
											echo '	<tr>
													<td>'.$ary['nama_pengajuan'].'</td>
													<td>'.$ary['harga'].'</td>
													<td>'.$ary['status'].'</td></tr>
												';
											}
							echo '		</table>
								</div>
							</div>';
							}
							else{
							echo '
								<div class="white fl-12 f1 sp-between mar-10 pad-10">
									<div class="fl-12 very-large text-center">Paket Saya</div>
									<div class="fl fl-12 text-center top sp-between white">';
									$id= $_SESSION['id'];
									$sql = "SELECT memesan.*, p.nama_paket as nama_paket,p.harga as harga, datediff(memesan.tgl_berangkat,now()) as batas, (select id_tempat from memiliki where id_paket = p.id_paket order by rand() limit 1) as id_tempat FROM memesan, paket p where memesan.id_pengguna = '$id' and memesan.id_paket = p.id_paket;";
									$q = mysqli_query($con, $sql);
									while ($ary = mysqli_fetch_array($q)) {
										if($ary["batas"]>=0){
										echo '						
										<div class="fl-5 fl mar-10 blue font-white">
											<img src="assets/images/places/'.$ary['id_tempat'].'.jpg" height="auto" width="100%">
											<div class="fl-12 large">
												'.$ary['id_voucher'].'
											</div>
											<div class="fl-12">
												'.$ary['nama_paket'].'
											</div>
											<div class="fl-12 large">
												Rp. '.number_format($ary['total'], 0, '', '.').'
											</div>
											<div class="fl-12 mar-10">
												'.$ary['jumlah_orang'].' Pax
											</div>
											<div class="fl-12 mar-10">
												Tanggal Pemesanan<br>
												'.$ary['tgl_pesan'].'<br>
											</div>
											<div class="fl-12 mar-10">
												Tanggal keberangkatan<br>
												<span class="font-orange">'.$ary['tgl_berangkat'].'</span>
											</div>
											<div class="fl-12 fl v-center h-center">';
											
											if($ary['status']=='Belum Bayar'){
												if (file_exists("assets/images/bukti/".$ary['id_voucher'].".jpg")) {
													echo '
													<div class="fl-6 font-white">
														Menunggu Konfirmasi Pembayaran
													</div>
													';
												}
												else{
													echo '
													<div class="fl-12 font-orange">
														'.$ary['status'].'
													</div>
											<form action="uploadBukti.php" method="post" enctype="multipart/form-data" id="uploadBukti" class="fl-6 fl mar-10">
												<input type="hidden" name="id_voucher" value='.$ary['id_voucher'].'>
												<label for="bukti" class="fl-12 font-white orange pad-10 text-center">Upload Bukti</label>
												<input type="file" name="bukti" id="bukti" style="opacity: 0;width: 1px;height: 1px;">
											</form>';
												}
											}
											else{
												if(file_exists("assets/images/voucher/".$ary['id_voucher'].".jpg")){
													echo '<a href="assets/images/voucher/'.$ary['id_voucher'].'.jpg" class="fl-6"><img src="assets/images/voucher/'.$ary['id_voucher'].'.jpg" height="auto" width="100%"></a>';
												}
												echo "<div class='fl-6 font-green large mar-10'>Sudah Bayar</div>";
											}

										echo "</div></div>";
									}
								}
							}
							?>
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

