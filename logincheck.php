<?php
	session_start();
	include "config.php";
	if (isset($_POST['login'])) {
		$username = $_POST['id_pengguna'];
		$password = $_POST['password'];
		$db = "SELECT id_pengguna, password FROM pengguna WHERE id_pengguna = '$username'";
		$q = mysqli_query($con, $db);
		if (mysqli_num_rows($q) == 0) {
			echo "<script>
					document.write('<h1>Username tidak terdaftar</h1>');
				setTimeout(function(){
					window.location.href = 'login.php'
				}, 3000);</script>
			";
		}
		else{
			while ($result = mysqli_fetch_array($q)) {
				if ($password == $result['password']) {
					echo "Berhasil login<br>";
					session_destroy();
					session_start();
					$sql="SELECT nama_wisatawan FROM wisatawan WHERE id_pengguna='$username'";
					$tes=mysqli_query($con,$sql);
					if(mysqli_num_rows($tes)==1){
						$nama=mysqli_fetch_array($tes);
						$_SESSION['name'] = $nama['nama_wisatawan'];
						echo 'wisatawan';
					}
					else{
						$sql="SELECT nama_usaha FROM pelaku_usaha WHERE id_pengguna='$username'";
						$tes=mysqli_query($con,$sql);
						$nama=mysqli_fetch_array($tes);
						$_SESSION['usaha'] = $nama['nama_usaha'];
						echo 'usaha';
					}
					$_SESSION['id'] = $result['id_pengguna'];
					echo $_SESSION['name'];
					echo $_SESSION['usaha'];
					header("location:index.php");
				}
				else{
				echo "<script>
					document.write('<h1>Password salah</h1>');
					setTimeout(function(){
						window.location.href = 'login.php'
					}, 3000);</script>
				";
				}
			}
		}
 	}
?>