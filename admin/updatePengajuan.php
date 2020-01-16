<?php
	include "config.php";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$sql="update pengajuan_paket set status='Sudah Diterima' where id_pengajuan=$id";
		mysqli_query($con,$sql);
		mysqli_close($con);
	}
	header("location:lihatPengajuan.php");
?>