<?php
	session_start();
	include 'config.php';
	if (!isset($_SESSION['admin'])) {
		header("location:adminlogin.php");
	}
	$q="delete from memesan where datediff(tgl_berangkat,now())<0 and status='Belum Bayar'";
	mysqli_query($con,$q);
?>
<!DOCTYPE html>
<html>
<head>
	<title>LOTTA ADMIN| Lombok Tour and Travel Agency</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/fonts.css">
	<script src="../assets/js/jquery-2.2.3.min.js"></script>
	<script src="../assets/js/lotta.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#bukti").change(function(){
				$("#uploadBukti").submit();
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
					<div class="dk-blue fl-12 h-center font-white pad-20">
						<div class="fl-12 text-center very-large mar-20 ">
							<span class="large bolder">Daftar Pesanan Wisata LOTTA</span>
						</div>
						<div class="fl-5">
							<div class="fl-12 fl sp-between blue">
								<table border='1' width=100% cellspacing="0" cellpadding="5">
									<tr align=center>
										<td>ID Voucher</td>
										<td>ID User</td>
										<td>Nama User</td>
										<td>Paket</td>
										<td>Tanggal Pesan</td>
										<td>Tanggal Berangkat</td>
										<td>Pax</td>
										<td>Total</td>
										<td>Bukti Pembayaran</td>
										<td>Aksi</td>
									</tr>
									<?php
									$sql="select memesan.id_voucher, memesan.id_pengguna, wisatawan.nama_wisatawan as namaUser, paket.nama_paket as namaPaket, DATE_FORMAT(memesan.tgl_pesan,'%W, %b %d %Y') as tgl_pesan, DATE_FORMAT(memesan.tgl_berangkat,'%W, %b %d %Y') as tgl_berangkat, memesan.jumlah_orang as pax, memesan.total, memesan.status from memesan inner join wisatawan on memesan.id_pengguna = wisatawan.id_pengguna inner join paket on memesan.id_paket = paket.id_paket order by memesan.id_voucher desc;";
									$tampil=mysqli_query($con,$sql); 
									while($baris=mysqli_fetch_array($tampil)){
											echo "<tr>";
												echo "<td>".$baris['id_voucher']."</td>";
												echo "<td>".$baris['id_pengguna']."</td>";
												echo "<td>".$baris['namaUser']."</td>";
												echo "<td>".$baris['namaPaket']."</td>";
												echo "<td>".$baris['tgl_pesan']."</td>";
												echo "<td>".$baris['tgl_berangkat']."</td>";
												echo "<td>".$baris['pax']."</td>";
												echo "<td> Rp. ".number_format($baris['total'], 0, '', '.')."</td>";
												$img = "../assets/images/bukti/".$baris['id_voucher'].".jpg";
												if (file_exists($img)) {
													echo '<td><a href="'.$img.'"><img src="'.$img.'" class="mar-10" width="80%" height="auto"></a></td>';
												}
												else{
													echo "<td>Empty</td>";
												}
												echo "<td>";
												if(strtolower($baris['status']) == "belum bayar"){
													echo "<a href='updatePesanan.php?id=".$baris['id_voucher']."'><button class='edit btn green'>Sudah Bayar</button></a>";
												}
												else if(file_exists("../assets/images/voucher/".$baris['id_voucher'].".jpg")){
													echo '<a href="	../assets/images/voucher/'.$baris['id_voucher'].'.jpg" class="fl-6"><button class="btn blue">Lihat Voucher</button></a>';
												}
												else{
													echo '<form action="uploadVoucher.php" method="post" enctype="multipart/form-data" id="uploadBukti" class="fl-6 fl mar-10">
														<input type="hidden" name="id_voucher" value='.$baris['id_voucher'].'>
														<label for="bukti" class="fl-12 font-white orange pad-10  text-center">Upload Voucher</label>
														<input type="file" name="bukti" id="bukti" style="opacity: 0;width: 1px;height: 1px;">
														</form>';
												}
												echo "<a href='hapusPesanan.php?id=".$baris['id_voucher']."'><button class='edit btn red'><span class='icon-bin'></span> Hapus</button></a></td>";
											echo "</tr>";}
									?>
								</table>
							</div>
						</div>
					</div>

				</div>
				<div class="fl-12 fl">
					<div class="form-container dk-blue fl-12 fl h-center pad-20">
						<div class="fl-12 text-center very-large mar-20 "><span class="large bolder">Tambah Pesanan</span></div>
							<form method="POST" action="inputPesananAdmin.php" role="form" class="fl h-center">
								<div class="fl-12 fl sp-between">
									<label for="user_id" class="fl-3">ID Pengguna</label>
									<input type="text" class="fl-8" placeholder="ID Pengguna" name="id_pengguna" pattern="[A-Za-z0-9]{6,20}" title="Format ID salah" required>
								</div>
								<div class="fl-12 fl sp-between">
									<label for="user_id" class="fl-3">ID Paket</label>
									<input type="text" class="fl-8" placeholder="ID Paket" name="id_paket" required>
								</div>
								<div class="fl-12 fl sp-between">
									<label for="tgl_lahir" class="fl-3">Tanggal Berangkat</label>
									<div class="fl-8 fl sp-between">
										<select name='tgl' class="fl-2">
											<?php
												for ($i=1; $i < 32; $i++) { 
													echo '<option value="'.$i.'">'.$i.'</option>';
												}
											?>
										</select>
										<select name="bln" class="fl-5">
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
										<input type="text" name="thn" placeholder="Tahun" class="fl-4" pattern="[0-9]{4}">
									</div>
								</div>
								<div class="fl-12 fl h-center">
									<button class="btn green large" name="Pesan" type="submit" value="kirim">Input Pesanan</button>
								</div>	
							</form>				
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</body>
</html>