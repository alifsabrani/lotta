<?php
	include "config.php";
	if(isset($_GET['id_tempat'])){
		$id=$_GET['id_tempat'];
		$tmpt=$_GET['id_paket'];
		$sql="delete from memiliki where id_tempat='$id' and id_paket='$tmpt';";
		if(mysqli_query($con,$sql)){
			mysqli_close($con);
			header("location:lihatpaket.php");
		}
	}
?>