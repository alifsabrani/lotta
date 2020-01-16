<?php
	session_start();
	include 'config.php';
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		if (isset($_SESSION['name'])) {
			$q = "select pesan.from, pesan.to, pesan.teks, DATE_FORMAT(pesan.waktu,'%W, %b %d %Y %h:%i %p') as waktu, pengguna.id_pengguna, wisatawan.nama_wisatawan as nama from pesan inner join pengguna on pesan.from = pengguna.id_pengguna or pesan.to = pengguna.id_pengguna inner join wisatawan on pengguna.id_pengguna = wisatawan.id_pengguna where pesan.from='$id' or pesan.to='$id'";
		}
		else{
			$q = "select pesan.from, pesan.to, pesan.teks, DATE_FORMAT(pesan.waktu,'%W, %b %d %Y %h:%i %p') as waktu, pengguna.id_pengguna, pelaku_usaha.nama_usaha as nama from pesan inner join pengguna on pesan.from = pengguna.id_pengguna or pesan.to = pengguna.id_pengguna inner join pelaku_usaha on pengguna.id_pengguna = pelaku_usaha.id_pengguna where pesan.from='$id' or pesan.to='$id'";
		}
		$que = mysqli_query($con, $q);
		$x = mysqli_num_rows($que);
		if ($x > 0) {
			while ($r = mysqli_fetch_array($que)) {
				echo '<div class="fl-12 fl top pad-10">';
				if ($r['to'] == 'admin') {
					echo '
						<div class="fl-2 font-blue1 text-center">
							<div class="very-large"><span class="icon-user"></span></div>
							'.$r['nama'].'
						</div>
						<div class="fl-9 blue">
					';
				}
				else echo '<div class="fl-9 orange">';
				echo '<div class="fl-12 mar-10">'.$r['teks'].'</div><div class="fl-12 white font-blue1">'.$r['waktu'].'</div></div>';
				if ($r['from'] == 'admin') {
					echo '
						<div class="fl-2 font-orange text-center">
							<div class="very-large"><span class="icon-user"></span></div>
							Admin</div>
					';
				}
				echo "</div>";
			}
		}
		else{
			echo '<div class="fl-12 pad-10 text-center font-blue1">Belum ada pesan</div>';
		}
	}
?>