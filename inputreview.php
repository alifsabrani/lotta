<?php
	session_start();
	include "config.php";
	if(isset($_POST['daftar'])){
		$pengguna = $_SESSION['id'];
		$tempat=$_POST['id_tempat'];
		$komen=$_POST['komentar'];
		$rating=$_POST['rating'];
		$ksg=true;

		if(empty($komen)||empty($rating))
			$ksg=false;
		if($ksg){
			$sql="INSERT INTO review (id_pengguna, id_tempat, komentar, rating) VALUES ('$pengguna','$tempat','$komen','$rating')";
			if (!mysqli_query($con,$sql)) {
				echo "<script>alert('GAGAL PAKK')</script>";
			}
	 		else{
	 			header("location:wisata.php?id=".$tempat);
	 		}
	 		mysqli_close($con);
	 	}
 	}
?>