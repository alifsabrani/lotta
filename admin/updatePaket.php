<?php
	include "config.php";
	if(isset($_POST['edit'])){
		$id=$_POST['id_paket'];
		$nama=$_POST['nama_paket'];
		$jadwal=$_POST['jadwal'];
		$deskripsi=$_POST['deskripsi_paket'];
		$harga=$_POST['harga'];
		$sql="UPDATE paket set nama_paket='$nama', jadwal='$jadwal', deskripsi_paket='$deskripsi', harga='$harga' where id_paket='$id'";
		if(mysqli_query($con,$sql)){
			header("location:lihatPaket.php");
			mysqli_close($con);
		}
	}
?>