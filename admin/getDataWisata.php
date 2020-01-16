<?php
	include "config.php";
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$q = "select * from tempat where id_tempat=$id;";
		$que = mysqli_query($con, $q);
		$r = mysqli_fetch_array($que);
		$ra = json_encode($r);
		echo $ra;
	}
?>