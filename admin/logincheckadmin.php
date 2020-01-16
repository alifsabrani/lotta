<?php
	session_start();
	include "config.php";
	if (isset($_POST['login'])) {
		$username = $_POST['id_admin'];
		$password = $_POST['password'];
		$sql = "select username, password from admin where username='$username'";
		$q = mysqli_query($con, $sql);
		if (mysqli_num_rows($q) == 0) {
			echo "login gagal";
		}
		else{
			while ($result = mysqli_fetch_array($q)) {
				if ($password == $result['password']) {
					session_destroy();
					session_start();
					$_SESSION['admin'] = $result['username'];
					echo "Berhasil Masuk, beberapa saat lagi anda akan diarahkan...";
					echo "
						<script>
							setTimeout(function(){
								window.location.href = 'index.php';
							}, 5000)
						</script>
					";
				}
				else{
					echo "login gagal";
				}
			}
		}
 	}
?>