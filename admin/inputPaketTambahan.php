<?php
	include "config.php";
	if(isset($_POST['nama_paket'])){
		$nama=$_POST['nama_paket'];
		$jadwal=$_POST['jadwal'];
		$deskripsi=$_POST['deskripsi_paket'];
		$harga=$_POST['harga'];
		$sql="insert into paket(`nama_paket`,`jadwal`,`deskripsi_paket`,`harga`) values ('$nama', '$jadwal', '$deskripsi', '$harga')";
		if (mysqli_query($con,$sql)) {
			$q = "select id_paket from paket where nama_paket='$nama' and jadwal='$jadwal' and deskripsi_paket='$deskripsi' and harga='$harga';";
			$que = mysqli_query($con, $q);
			while($r = mysqli_fetch_array($que)){
				echo $r['id_paket'];
			}
		}
	}
?>