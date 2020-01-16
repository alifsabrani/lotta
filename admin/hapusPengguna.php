<?php
	include "config.php";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$sql="delete from pengguna where id_pengguna='$id'";
		if (mysqli_query($con,$sql)) {
			$sql="delete from kirim_pesan where kirim_pesan.from='$id' or kirim_pesan.to='$id'";
			if (mysqli_query($con,$sql)) {
				$sql="delete from pengajuan_paket where id_pengguna='$id'";
				if (mysqli_query($con,$sql)) {
					$sql="delete from wisatawan where id_pengguna='$id'";
					if (mysqli_query($con,$sql)) {
						$sql="delete from pelaku_usaha where id_pengguna='$id'";
						if (mysqli_query($con,$sql)) {
							mysqli_close($con);
							header("location:lihatPengguna.php");				
						}					
					}				
				}	
			}
		}
	}
?>