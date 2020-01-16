<?php
	include "config.php";
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$q = "select memiliki.hari_ke, memiliki.id_tempat, tempat.nama_tempat from memiliki inner join tempat on memiliki.id_tempat = tempat.id_tempat where id_paket = '$id';";
		$que = mysqli_query($con, $q);
		echo '
			<table border=1 cellspacing=0 cellpadding=5 width=100% id="tabelPaket">
				<tr align=center>
					<td>Hari Ke</td>
					<td>Nama Tempat</td>
					<td>Aksi</td>
				</tr> 
		';
		while($baris=mysqli_fetch_array($que)){
				echo "<tr align=center>";
					echo "<td>".$baris['hari_ke']."</td>";
					echo "<td>".$baris['nama_tempat']."</td>";
					echo "<td><a href='hapusDestinasiPaket.php?id_tempat=".$baris['id_tempat']."&id_paket=".$id."'><button class='edit btn red'><span class='icon-bin'></span> Hapus</button></a></td></tr>";
		}
		echo '</table>';
	}
?>