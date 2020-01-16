<?php
	include "config.php";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$sql="delete from memesan where id_voucher=$id";
		mysqli_query($con,$sql);
		mysqli_close($con);
	}
	header("location:index.php");
?>