<?php
	include "config.php";
	if(isset($_GET['id'])){
		$idpaket=$_GET['id'];
		$sql="delete from paket where id_paket=$idpaket";
		mysqli_query($con,$sql);
		mysqli_close();
		header("location:lihatPaket.php");
	}
?>