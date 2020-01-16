<?php
	session_start();
	include "config.php";
	if(isset($_POST['daftar'])){
		$id = $_POST['id_pengguna'];
		$nama = $_POST['nama_pengguna'];
		$namaU = $_POST['nama_usaha'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$tlp = $_POST['telepon'];
		$q = "select * from pengguna where id_pengguna = '$id';";
		$que = mysqli_query($con, $q);
		$x = mysqli_num_rows($que);
		$KSG=FALSE;
		$registered = false;
		if ($x > 0) {
			$registered = true;
		}
		if(preg_match("([a-zA-Z0-9]{6-20})", $id))
			$ksg=TRUE;
		else{
			if(preg_match("([a-zA-Z ]{1,30})", $nama))
				$ksg=TRUE;
			else{
				if(preg_match("[a-zA-Z0-9]", $password))
					$ks=TRUE;
				else{
					if (!empty($tgl_lahir))
						$ksg=true;
					else{
						if(!empty($email))
							$ksg=true;
						else{
							if(!empty($tlp))
								$ksg=true;
						}
					}
				}
			}
		}
		if ($registered) {
			header("location:register.php?err=1");
		}
		else if($ksg){
			$sql = "INSERT INTO pengguna VALUES ('$id','$password','$email','$tlp')";
			mysqli_query($con,$sql);
			$sql = "INSERT INTO pelaku_usaha VALUES ('$id','$nama','$namaU')";
			mysqli_query($con,$sql);
	 		mysqli_close($con);
	 		echo "berhasil";
	 		session_destroy();
	 		session_start();
	 		$_SESSION['usaha'] = $namaU;
	 		$_SESSION['id'] = $id;
	 		header("location:index.php");}
	 	}
?>