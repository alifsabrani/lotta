<?php
	session_start();
	include 'config.php';
	if (isset($_SESSION['name']) && isset($_SESSION['id'])) {
		header("location:adminlogin.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pengguna LOTTA</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/fonts.css">
	<script src="../assets/js/jquery-2.2.3.min.js"></script>
	<script src="../assets/js/lotta.js"></script>
	<script>
		$(document).ready(function(){
			$(".back-button").hide();
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
	<div class="container admin white">
		<div class="fl sp-between top">
			<div class="fl-3 fl blue pad-10 v-center font-white" id="left-menu">
				<div class="fl-12 fl h-center dk-blue">
					<a href="index.php" id="logo" class="fl-4 fl v-center"><img src="../assets/images/logo.png" width="100%" height="auto"></a>
					<div class="fl-7 ">
						<p class="large text-center"><span class="very-large">LOTTA</span> <br>Admin Panel</p>
					</div>
				</div>
				<a href="index.php" class="fl-12 fl">
					<button class="large btn blue fl-12 text-left">Pemesanan</button>
				</a>
				<a href="lihatPaket.php" class="fl-12 fl">
					<button class="large btn blue fl-12 text-left">Paket</button>
				</a>
				<a href="lihatPengajuan.php" class="fl-12 fl">
					<button class="large btn blue fl-12 text-left">Pengajuan</button>
				</a>
				<a href="lihatPengguna.php" class="fl-12 fl">
					<button class="large btn blue fl-12 text-left">Pengguna</button>
				</a>
				<a href="konsultasiAdmin.php" class="fl-12 fl">
					<button class="large btn blue fl-12 text-left">Konsultasi</button>
				</a>
				<a href="lihatDestinasi.php" class="fl-12 fl">
					<button class="large btn blue fl-12 text-left">Destinasi</button>
				</a>
				<a href="logout.php" class="fl-12 fl">
					<button class="large btn red fl-12 text-center">Logout</button>
				</a>
			</div>
			<div class="fl top" id="main">
				<div class="fl-12 text-center">
					<p class="large">
						<span class="bolder larger">Lombok Tour and Travel Agency</span><br>
						Admin Panel
					</p>
					<div class="form-container dk-blue fl-12 h-center pad-20">
						<button class="btn round blue back-button large"><span class="icon-circle-left very-large"></span></button>
						<div class="fl-12 fl sp-around v-center" id="menuUser">
							<div class="fl-5 fl">
								<button class="fl-12 fl btn blue large" id="btnPU">
									<div class="fl-12">
										<span class="icon-office  icon-large"></span>
									</div>
									<div class="fl-12 very-large pad-10 text-center">
										Pelaku Usaha
									</div>
								</button>
							</div>
							<div class="fl-5 fl">
								<button class="fl-12 fl btn blue large" id="btnW">
									<div class="fl-12">
										<span class="icon-user icon-large"></span>
									</div>
									<div class="fl-12 very-large pad-10 text-center">
										Wisatawan
									</div>
								</button>
							</div>
						</div>
						<div class="fl-12 tabelUser" id="wisatawan">
							<div class="fl-12 text-center mar-20 "><span class="very-large bolder">Daftar Wisatawan</span></div>
							<div class="fl-5 blue">
								<div class="fl-12 fl sp-between">
									<table border='1' cellspacing=0 cellpadding=5 width=100%>
										<tr align=center>
											<td>ID</td>
											<td>Nama</td>
											<td>Password</td>
											<td>Tanggal Lahir</td>
											<td>Email</td>
											<td>No. Telp</td>
										</tr>
										<?php
											$sql="select pengguna.*, DATE_FORMAT(wisatawan.tgl_lahir,'%b %d %Y') as tgl_lahir, wisatawan.nama_wisatawan from pengguna natural join wisatawan;";
											$tampil=mysqli_query($con,$sql); 
											while($baris=mysqli_fetch_array($tampil)){
											echo "<tr>";
												echo "<td>".$baris['id_pengguna']."</td>";
												echo "<td>".$baris['nama_wisatawan']."</td>";
												echo "<td>".$baris['password']."</td>";
												echo "<td>".$baris['tgl_lahir']."</td>";
												echo "<td>".$baris['email']."</td>";
												echo "<td>".$baris['telepon']."</td>";
												echo "<td><a href='hapusPengguna.php?id=".$baris['id_pengguna']."'><button class='btn red'><span class='icon-bin'></span> Hapus</button></a></td>";
											echo "</tr>";}
										?>
									</table>
								</div>
							</div>
						</div>
						<div class="fl-12 tabelUser" id="perusahaan">
							<div class="fl-12 text-center mar-20 "><span class="very-large bolder">Daftar Pelaku Usaha</span></div>
							<div class="fl-5 blue">
								<div class="fl-12 fl sp-between">
									<table border='1' cellspacing=0 cellpadding=5 width=100%>
										<tr align=center>
											<td>ID</td>
											<td>Nama Pemilik</td>
											<td>Nama Perusahaan</td>
											<td>Password</td>
											<td>Email</td>
											<td>No. Telp</td>
										</tr>
										<?php
											$sql="select pengguna.*, pelaku_usaha.* from pengguna natural join pelaku_usaha;";
											$tampil=mysqli_query($con,$sql); 
											while($baris=mysqli_fetch_array($tampil)){
											echo "<tr>";
												echo "<td>".$baris['id_pengguna']."</td>";
												echo "<td>".$baris['nama_pemilik']."</td>";
												echo "<td>".$baris['nama_usaha']."</td>";
												echo "<td>".$baris['password']."</td>";
												echo "<td>".$baris['email']."</td>";
												echo "<td>".$baris['telepon']."</td>";
												echo "<td><a href='hapusPengguna.php?id=".$baris['id_pengguna']."'><button class='btn red'><span class='icon-bin'></span>Hapus</button></a></td>";
											echo "</tr>";}
										?>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
</body>
</html>