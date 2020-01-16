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
	<title>Destinasi Wisata LOTTA</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/fonts.css">
	<script src="../assets/js/jquery-2.2.3.min.js"></script>
	<script src="../assets/js/lotta.js"></script>
	<script>
		$(document).ready(function(){
			$("#btnTambah").click(function(){
				$("#formUpdate").hide(0, function(){
					$("#formTambah").show();
				});
				window.scrollBy(0, window.innerHeight*5);
			})
			$(".edit").click(function(){
				id = $(this).attr('id').substr(4);
				$("#idInput").val(id);
				$.ajax({
					url: "getDataWisata.php",
					type: "POST",
					data: "id="+id,
					success: function(data){
						value = JSON.parse(data);
						$("#gambarTempat").html('<img src="../assets/images/places/'+value.id_tempat+'.jpg" width="100%" height="auto">')
						$("#upNamaTempat").val(value.nama_tempat);
						$("#upLokasi").val(value.lokasi);
						$("#upDeskripsi").val(value.deskripsi_tempat);
					},
				})
				$("#formTambah").hide(0, function(){
					$("#formUpdate").show();
				});
				window.scrollBy(0, window.innerHeight*5);
			})
			$("#buktiUpdate, #buktiTambah").change(function(){
				$(this).prev().html("Ubah Gambar");	
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
						<div class="fl-12" >
							<div class="fl-12 text-center very-large mar-20 "><span class="large bolder">Daftar Destinasi Wisata LOTTA</span></div>
							<div class="fl-2 blue">
								<div class="fl-12 fl sp-between">
									<?php
										$sql="select id_tempat, nama_tempat, lokasi from tempat;";
										$tampil=mysqli_query($con,$sql); 
										echo "<table border='1' cellspacing=0 cellpadding=5 width=100%>";
											echo "<tr align=center>";
												echo "<td>ID Paket</td>";
												echo "<td>Nama Paket</td>";
												echo "<td>Lokasi</td>";
												echo "<td>Aksi</td>";
											echo "</tr>";
										while($baris=mysqli_fetch_array($tampil)){
											echo "<tr>";
												echo "<td>".$baris['id_tempat']."</td>";
												echo "<td>".$baris['nama_tempat']."</td>";
												echo "<td>".$baris['lokasi']."</td>";
												echo "<td><button class='edit btn green' id='edit".$baris['id_tempat']."'><span class='icon-pencil'></span> Edit</button><a href='hapusDestinasi.php?id=".$baris['id_tempat']."'><button class='btn red'><span class='icon-bin'></span> Hapus</button></a></td>";
											echo "</tr>";}
										echo "</table>";
									?>
								</div>
							</div>

							<div class="fl-12 fl h-center">
								<button class="btn blue" id="btnTambah">Tambah Destinasi</button>
							</div>
						</div>
					</div>
				</div>
				<div class="fl-12 fl">
					<div class="form-container dk-blue fl-12 h-center pad-20" id="formUpdate" style="display: none">
							<div class="fl-12 text-center very-large mar-20 "><span class="large bolder">Edit Destinasi Wisata</span></div>
							<form method="POST" action="updateDestinasi.php" enctype="multipart/form-data" class="fl h-center">
								<input type="hidden" name="id_tempat" id="idInput">
								<div class="fl-12 fl sp-between">
									<label for="user_id" class="fl-3">Nama tempat</label>
									<input type="text" class="fl-8" placeholder="Nama destinasi" name="nama_tempat" id="upNamaTempat" required>
								</div>
								<div class="fl-12 fl sp-between">
									<label for="user_id" class="fl-3">Lokasi</label>
									<input type="text" class="fl-8" placeholder="Lokasi destinasi" name="lokasi" id="upLokasi" required>
								</div>
								<div class="fl-12 fl sp-between">
									<label for="user_id" class="fl-3">Deskripsi Tempat</label>
									<textarea placeholder="Deskripsi singkat tempat" name="deskripsi_tempat" id="upDeskripsi" class="fl-8" required></textarea>
								</div>
								<div class="fl-6" id="gambarTempat">
								</div>
								<div class="fl-12 fl h-center">
									<label for="buktiUpdate" class="fl-4 font-white orange pad-10 text-center">Ubah Gambar</label>
									<input type="file" name="gambar" id="buktiUpdate" style="opacity: 0;width: 1px;height: 1px;">
								</div>
								<div class="fl-12 fl h-center">
									<button class="btn green large" name="edit" type="submit" value="kirim">Edit Destinasi</button>
								</div>	
							</form>
					</div>
					<div class="form-container dk-blue fl-12 h-center pad-20" id="formTambah"  style="display: none">
						<div class="fl-12 text-center very-large mar-20 ">
							<span class="large bolder">Tambah Destinasi Wisata</span>
						</div>		
						<form method="POST" action="inputDestinasiTambahan.php" enctype="multipart/form-data" class="fl h-center">
							<div class="fl-12 fl sp-between">
								<label for="user_id" class="fl-3">Nama Tempat</label>
								<input type="text" class="fl-8" placeholder="Nama Tempat" name="nama_tempat" required>
							</div>
							<div class="fl-12 fl sp-between">
								<label for="nama" class="fl-3">Lokasi</label>
								<input type="text" name="lokasi" placeholder="Lokasi" class="fl-8" required>
							</div>
							<div class="fl-12 fl sp-between">
								<label for="email" class="fl-3">Deskripsi tempat</label>
								<textarea placeholder="Deskripsi singkat tempat" name="deskripsi_tempat" class="fl-8" required></textarea>
							</div>
							<div class="fl-12 fl h-center">
								<label for="buktiTambah" class="fl-4 font-white orange pad-10 text-center">Upload Gambar</label>
								<input type="file" name="gambar" id="buktiTambah" style="opacity: 0;width: 1px;height: 1px;">
							</div>
							<div class="fl-12 fl h-center">
								<button class="btn green large" name="input" type="submit">Input Destinasi</button>
							</div>	
						</form>	
					</div>
				</div>
			</div>
		</div>	
	</div>
</body>
</html>