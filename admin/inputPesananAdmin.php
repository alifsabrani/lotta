<?php
	include "config.php";
	if(isset($_POST['Pesan'])){
		$id_pengguna= $_POST['id_pengguna'];
		$id_paket= $_POST['id_paket'];
		$tgl = $_POST['tgl'];
		$bln = $_POST['bln'];
		$thn = $_POST['thn'];
		$tgl_berangkat = $thn.'-'.$bln.'-'.$tgl;
		$status="Belum Bayar";
		echo $id_pengguna;
		echo $id_paket;
		echo $tgl_berangkat;
		echo $status;
		$sql="INSERT into memesan (`id_pengguna`,`id_paket`,`tgl_pesan`,`tgl_berangkat`,`status`) values ('$id_pengguna','$id_paket',now(),'$tgl_berangkat','$status')";
		mysqli_query($con,$sql);
		mysqli_close($con);
	}
	header("location:index.php");
?>