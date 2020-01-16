<?php
	include "config.php";
	if (isset($_POST['id_tempat'])) {
		$id_tempat = $_POST['id_tempat'];
		$id_paket = $_POST['id_paket'];
		$hari_ke = $_POST['hari_ke'];
		$q = "insert into memiliki values ('$id_paket', '$id_tempat', '$hari_ke');";
		if (mysqli_query($con, $q)) {
			echo "1";
		}
	}
?>