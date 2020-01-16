<?php
	include "config.php";
	$q = "
		select wisatawan.id_pengguna, wisatawan.nama_wisatawan as nama, ifnull((select count(*) from pesan where pesan.from = wisatawan.id_pengguna and status = 'd' group by pesan.from), 0) as unread, max(pesan.waktu) as last_msg, 'wisatawan' as tipe from wisatawan inner join pesan on wisatawan.id_pengguna = pesan.from group by id_pengguna union
		(select id_pengguna, nama_usaha, ifnull((select count(*) from pesan where pesan.from = pelaku_usaha.id_pengguna and status = 'd' group by pesan.from), 0), max(pesan.waktu), 'perusahaan' as tipe from pelaku_usaha inner join pesan on pelaku_usaha.id_pengguna = pesan.from group by id_pengguna) order by last_msg desc;
	";
	$que = mysqli_query($con, $q);
	$i = 0;
	while ($r = mysqli_fetch_array($que)) {
		$ar[$i]['id_pengguna'] = $r['id_pengguna'];
		$ar[$i]['nama'] = $r['nama'];
		$ar[$i]['unread'] = $r['unread'];
		$ar[$i]['tipe'] = $r['tipe'];
		$i++;
	}
	$z = json_encode($ar);
	echo $z;
?>