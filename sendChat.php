<?php
	include 'config.php';
	if (isset($_POST['text'])) {
		$msg = $_POST['text'];
		$user = $_POST['user'];
		$q = "insert into pesan values ('$user', 'admin', now(), '$msg', 'd');";
		if (mysqli_query($con, $q)) {
			echo "1";
		}
	}
?>