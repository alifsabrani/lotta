<?php
	session_start();
	include 'config.php';
	if (!isset($_SESSION['admin'])) {
		header("location:adminlogin.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Pengajuan Paket ke LOTTA</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/fonts.css">
	<script src="../assets/js/jquery-2.2.3.min.js"></script>
	<script src="../assets/js/lotta.js"></script>
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
						<div class="fl-12" >
							<div class="fl-12 text-center mar-20 "><span class="very-large bolder">Lihat Daftar Pengajuan Paket</span></div>
							<div class="fl-5 blue">
								<div class="fl-12 fl sp-between">
									<?php
										$sql="select * from pengajuan_paket;";
										$tampil=mysqli_query($con,$sql); 
										echo "<table border='1' cellspacing=0 cellpadding=5 width=100%>";
										echo "<tr align=center>";
											echo "<td>ID</td>";
											echo "<td>Nama Paket</td>";
											echo "<td>Harga</td>";
											echo "<td>Pengaju</td>";
											echo "<td>Deskripsi</td>";
											echo "<td>Status</td>";
											echo "<td>Aksi</td>";
										echo "</tr>";
										while($baris=mysqli_fetch_array($tampil)){
										echo "<tr>";
											echo "<td>".$baris['id_pengajuan']."</td>";
											echo "<td>".$baris['nama_pengajuan']."</td>";
											echo "<td>".$baris['harga']."</td>";
											echo "<td>".$baris['id_pengguna']."</td>";
											echo "<td>".$baris['deskripsi']."</td>";
											echo "<td>".$baris['status']."</td>";
											echo "<td>";
											if(strtolower($baris['status']) == "belum diterima"){
												echo "<a href='updatePengajuan.php?id=".$baris['id_pengajuan']."'><button class='edit btn green'>Ubah Status</button></a>";
											}
											echo "
											<a href='hapusPengajuan.php?id=".$baris['id_pengajuan']."'><button class='btn red'><span class='icon-bin'></span> Hapus</button></a></td>";
										echo "</tr>";}
										echo "</table>";
									?>
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