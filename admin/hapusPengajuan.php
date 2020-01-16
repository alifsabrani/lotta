<?php
	include "config.php";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$sql="delete from pengajuan_paket where id_pengajuan=$id";
		mysqli_query($con,$sql);
		mysqli_close();
	}
	header("location:lihatPengajuan.php");
?>