<?php
	include "config.php";
	if(isset($_POST['edit'])){
		$id=$_POST['id_tempat'];
		$nama=$_POST['nama_tempat'];
		$lokasi=$_POST['lokasi'];
		$deskripsi=$_POST['deskripsi_tempat'];
		$sql="UPDATE tempat set nama_tempat='$nama', lokasi='$lokasi', deskripsi_tempat='$deskripsi' where id_tempat='$id'";
		if(mysqli_query($con,$sql)){
			if(!empty($_FILES['gambar'])){
				$file=$_FILES['gambar']['name'];
				$ext='.jpg';
				$dir=$_FILES['gambar']['tmp_name'];
				$folder='../assets/images/places/';
				$que = "select * from tempat where id_tempat='$id';";
				$x = mysqli_query($con, $que);
				$r = mysqli_fetch_array($x);
				$id = $r['id_tempat'];
				if(move_uploaded_file($dir, $folder.$file)){
					$baru=rename($folder.$file, $folder.$id.$ext);
					if ($baru) {
						mysqli_close($con);
					}
				}
			}
			header("location:lihatDestinasi.php");
		}
	}
?>