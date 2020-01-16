<?php
	include "config.php";
	if(isset($_POST['input'])){
		$nama=$_POST['nama_tempat'];
		$lokasi=$_POST['lokasi'];
		$deskripsi=$_POST['deskripsi_tempat'];
		$sql="insert into tempat (nama_tempat, lokasi, deskripsi_tempat) values ('$nama', '$lokasi', '$deskripsi')";
		if(mysqli_query($con,$sql)){
			$file=$_FILES['gambar']['name'];
			$ext='.jpg';
			$dir=$_FILES['gambar']['tmp_name'];
			$folder='../assets/images/places/';
			$que = "select * from tempat order by id_tempat desc limit 0,1;";
			$x = mysqli_query($con, $que);
			$r = mysqli_fetch_array($x);
			$id = $r['id_tempat'];
			if(move_uploaded_file($dir, $folder.$file)){
				$baru = rename($folder.$file, $folder.$id.$ext);
				if ($baru) {
					header("location:lihatDestinasi.php");
				}
				
			}
			else
				echo 'Format gambar tidak sesuai <a href="lihatDestinasi.php">kembali</a>';
			mysqli_close($con);
		}

	};
?>