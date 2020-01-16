<?php
	include "config.php";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$sql="delete from tempat where id_tempat=$id";
		mysqli_query($con,$sql);
		mysqli_close($con);
	}
	header("location:lihatDestinasi.php");
?>