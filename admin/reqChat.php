<?php
	include 'config.php';
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$upd = "update pesan set status = 'r' where pesan.from = '$id';";
		if (mysqli_query($con, $upd)) {
			$q = "select pesan.from, pesan.to, DATE_FORMAT(pesan.waktu,'%W, %b %d %Y %h:%i %p') as waktu, pesan.teks, pengguna.id_pengguna from pesan inner join pengguna on pesan.from = pengguna.id_pengguna or pesan.to = pengguna.id_pengguna where pesan.from='$id' or pesan.to='$id' order by pesan.waktu asc;";
			$que = mysqli_query($con, $q);
			$i = 0;
			while ($r = mysqli_fetch_array($que)) {
				$ar[$i]['from'] = $r['from'];
				$ar[$i]['to'] = $r['to'];
				$ar[$i]['teks'] = $r['teks'];
				$ar[$i]['waktu'] = $r['waktu'];
				$ar[$i]['id_pengguna'] = $r['id_pengguna'];
				$i++;
			}
			$z = json_encode($ar);
			echo $z;
		}
	}
?>