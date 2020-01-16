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
	<title>Paket on LOTTA</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/fonts.css">
	<script src="../assets/js/jquery-2.2.3.min.js"></script>
	<script src="../assets/js/lotta.js"></script>
	<script>
		var idPaketSkrg;
		option = '<?php
					$q = "select id_tempat, nama_tempat from tempat;";
					$qu = mysqli_query($con, $q);
					while ($r = mysqli_fetch_array($qu)) {
						echo '<option value="'.$r['id_tempat'].'">'.$r['nama_tempat'].'</option>';
					}
				?>';
		function getPaket(){

		}
		function inputTempat(data){
			if (typeof data !== "undefined") {
				$.ajax({
					url: "inputPaketTambahan.php",
					type: "POST",
					data: data,
					success: function(data){
						idPaketSkrg = data;
						$("#formTempat").append('<div class="fl-12 text-center mar-20 very-large">Tambahkan Destinasi</div>');
						opt = '<form method="POST" action="#" class="fl-12 fl h-center fTempat"><div class="fl-6 fl pad-10"><select name="tempat" class="tempat fl-12">'+option+'</select></div><input type="hidden" class="hidden" name="idPaket" value="'+idPaketSkrg+'"><div class="fl-5 fl"><input type="submit" class="btn blue fl-12 font-white" value="+ Tambah"></input></div></form>'
						hari = $("#jmlHari").val();
						$("#submitTambah").hide();
						$("#formTambah form input, #formTambah form textarea").prop("disabled", true);
						for (var i = 0; i < hari; i++) {
							var j = i +1;
							form = '<div class="fl-7 fl h-center" id="hari'+j+'">'+opt+'</div>';
							var top = '<div class="fl-12 text-center">Hari ke-'+j+'</div>';
							var file = top+form;
							$("#formTempat").append(file);
						}
						window.scrollBy(0, window.innerHeight*5);
					},
					complete: function(){
						inputTempat();
					}
				})
			}
			else {
				$(".fTempat").unbind('submit').bind('submit',function(){
					var form = $(this);
					fT = form.find('.tempat').val();
					idPaket = form.find('.hidden').val();
					hari = form.parent().attr('id').substr(4);
					data = {"id_paket" : idPaket, "id_tempat" : fT, "hari_ke" : hari};
					$.ajax({
						url: "inputDestinasiPaket.php",
						type: "POST",
						data: data,
						success: function(data){
							if (data == "1") {
								form.find('input, select').prop("disabled", true);
								opt = '<form method="POST" action="#" class="fl-12 fl h-center fTempat"><div class="fl-6 fl pad-10"><select name="tempat" class="tempat fl-12">'+option+'</select></div><input type="hidden" class="hidden" name="idPaket" value="'+idPaketSkrg+'"><div class="fl-5 fl"><input type="submit" class="btn blue fl-12 font-white" value="+ Tambah"></input></div></form>'
								form.parent().append(opt);
							}
							
						},
						complete: function(){
							inputTempat();
						}
					})
					return false;
				})
			}
		}
		$(document).ready(function(){
			$("#btnTambah").click(function(){
				$("#formUpdate").hide(0, function(){
					$("#formTambah").show();
				});
				window.scrollBy(0, window.innerHeight);
				
			})
			$(".edit").click(function(){
				id = $(this).attr('id').substr(4);
				$("#idInput").val(id);
				$.ajax({
					url: "getPaket.php",
					type: "POST",
					data: "id="+id,
					success: function(data){
						value = JSON.parse(data);
						nama = $("#upNamaPaket").val(value.nama_paket);
						jadwal = $("#upJadwalPaket").val(value.jadwal);
						deskripsi = $("#upDeskPaket").val(value.deskripsi_paket);
						harga = $("#upHargaPaket").val(value.harga);
						$.ajax({
							url: "getTempat.php",
							type: "POST",
							data: "id="+id,
							success: function(data){
								$("#destinasiPaket").html(data);
							},
						})
					},
				})
				$("#formTambah").hide(0, function(){
					$("#formUpdate").show(0, function(){
						window.scrollBy(0, window.innerHeight*5);
					});
				});
			})
			$("#formTambah form").submit(function(e){
				e.preventDefault();				
				nama = $("#namaPkt").val();
				jadwal = $("#jadwalPkt").val();
				deskripsi = $("#descPkt").val();
				harga = $("#hargaPkt").val();
				data = {"nama_paket" : nama, "jadwal" : jadwal, "deskripsi_paket" : deskripsi, "harga" : harga};
				inputTempat(data);
				return false;
			})
			$("#upTambahDestinasi").submit(function(e){
				e.preventDefault();
				id = $("#idInput").val();
				hari = $("#upTambahDestinasi input[name='hari_ke']").val();
				tempat = $("#upTambahDestinasi select").val();
				data = {"id_paket" : id, "id_tempat" : tempat, "hari_ke" : hari};
				$.ajax({
					url: "inputDestinasiPaket.php",
					type: "POST",
					data: data,
					success: function(data){
						if (data == "1") {
							$.ajax({
								url: "getTempat.php",
								type: "POST",
								data: "id="+id,
								success: function(data){
									$("#destinasiPaket").html(data);
								},
							})
						}	
					}
				})
			})
		})
	</script>
	<style type="text/css">
		body{
			overflow-y: scroll;
		}
	</style>
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
					<div class="dk-blue fl-12 h-center pad-20 font-white">
						<div class="fl-12" >
							<div class="fl-12 text-center very-large mar-20 ">
								<span class="large bolder">Daftar Paket Wisata LOTTA</span>
							</div>
							<div class="fl-5">
								<div class="fl-12 fl sp-between blue">
									<table border=1 cellspacing=0 cellpadding=5 width=100% id="tabelPaket">
										<tr align=center>
											<td>ID Paket</td>
											<td>Nama Paket</td>
											<td>Jadwal Paket</td>
											<td>Harga</td>
											<td>Aksi</td>
										</tr>
										<?php
										$sql="select id_paket, nama_paket, jadwal, harga from paket;";
										$tampil=mysqli_query($con,$sql); 
										while($baris=mysqli_fetch_array($tampil)){
												echo "<tr>";
													echo "<td>".$baris['id_paket']."</td>";
													echo "<td>".$baris['nama_paket']."</td>";
													echo "<td>".$baris['jadwal']."</td>";
													echo "<td>".$baris['harga']."</td>";
													echo "<td><button class='edit btn green' id='edit".$baris['id_paket']."'><span class='icon-pencil'></span> Edit</button><a href='hapusPaket.php?id=".$baris['id_paket']."'><button class='edit btn red'><span class='icon-bin'></span> Hapus</button></a></td></tr>";
										}
										?>
									</table>
								</div>
							</div>
							<div class="fl-12 fl h-center">
								<button class="btn blue" id="btnTambah">Tambah Paket</button>
							</div>
						</div>
					</div>
				</div>
				<div class="fl-12 fl h-center">
					<div class="form-container dk-blue fl-12 fl h-center pad-20" id="formUpdate" style="display: none">
							<div class="fl-12 text-center very-large mar-20 "><span class="large bolder">Edit Paket Wisata</span>
							</div>
							<form method="POST" action="updatePaket.php" role="form" class="fl h-center">
								<input type="hidden" name="id_paket" id="idInput">
								<div class="fl-12 fl sp-between">
									<label for="user_id" class="fl-3">Nama paket</label>
									<input type="text" class="fl-8" id="upNamaPaket" placeholder="Nama Paket Wisata" name="nama_paket" required>
								</div>
								<div class="fl-12 fl sp-between">
									<label for="user_id" class="fl-3">Jadwal</label>
									<input type="text" class="fl-8" id="upJadwalPaket" placeholder="Jadwal" name="jadwal" required>
								</div>
								<div class="fl-12 fl sp-between">
									<label for="user_id" class="fl-3">Deskripsi Paket</label>
									<textarea class="fl-8" id="upDeskPaket" placeholder="Deskripsi singkat paket" name="deskripsi_paket" required></textarea>
								</div>
								<div class="fl-12 fl sp-between">
									<label for="user_id" class="fl-3">Harga</label>
									<input type="text" class="fl-8" id="upHargaPaket" placeholder="harga ex. 8000000" name="harga" required>
								</div>
								<div class="fl-12 fl h-center">
									<button class="btn green large" name="edit" type="submit" value="kirim">Edit Paket</button>
								</div>	
							</form>
							<div id="destinasiPaket" class="fl-12">
								
							</div>
							<form class="fl-12 fl h-center mar-10" action="#" method="POST" id="upTambahDestinasi">
								<div class="fl-6 fl h-center">
									<label class="mar-10">Hari Ke</label>
									<input type="hidden" name="id_paket">
									<input type="text" name="hari_ke" class="mar-10">
									<select name="tempat" class="mar-10">
										<?php
											$q = "select id_tempat, nama_tempat from tempat;";
											$qu = mysqli_query($con, $q);
											while ($r = mysqli_fetch_array($qu)) {
												echo '<option value="'.$r['id_tempat'].'">'.$r['nama_tempat'].'</option>';
											}
										?>	
									</select>
									<button type="submit" class="btn blue fl-10 font-white">+ Tambah</button>
								</div>
							</form>
					</div>
					<div class="form-container dk-blue fl-12 h-center pad-10" id="formTambah" style="display: none">
						<div class="fl-12 text-center very-large mar-20 "><span class="large bolder">Tambah Paket Wisata</span></div>
						<form method="POST" action="inputPaketTambahan.php" role="form" class="fl h-center">
						<div class="fl-12 fl sp-between">
							<label for="user_id" class="fl-3">Nama paket</label>
							<input type="text" class="fl-8" placeholder="Nama Paket Wisata" name="nama_paket" id="namaPkt" required>
						</div>
						<div class="fl-12 fl sp-between">
							<label for="user_id" class="fl-3">Jadwal</label>
							<input type="text" class="fl-8" placeholder="Jadwal" name="jadwal" id="jadwalPkt" required>
						</div>
						<div class="fl-12 fl sp-between">
							<label for="user_id" class="fl-3">Deskripsi Paket</label>
							<textarea class="fl-8" placeholder="Deskripsi singkat paket" name="deskripsi_paket" id="descPkt" required></textarea>
						</div>
						<div class="fl-12 fl sp-between">
							<label for="user_id" class="fl-3">Harga</label>
							<input type="text" class="fl-8" placeholder="harga ex. 8000000" name="harga" id="hargaPkt" required>
						</div>
						<div class="fl-12 fl sp-between">
							<label class="fl-3">Lama Hari</label>
							<input type="text" name="jmlHari" id="jmlHari" class="fl-8" pattern="[0-9]" required>
						</div>		
						<div class="fl-12 fl h-center">
							<button class="btn green large" name="input" type="submit" id="submitTambah">Input Paket</button>
						</div>	
						</form>
					</div>
					<div class="form-container dk-blue fl-12 fl h-center pad-20" id="formTempat">
					</div>
				</div>
			</div>
		</div>	
	</div>
</body>
</html>