
<?php
	session_start();
	include "config.php";
	if (isset($_POST['id_paket'])) {
		$id = $_POST['id_paket'];
		$q = "select paket.id_paket, paket.deskripsi_paket, paket.nama_paket, paket.harga, paket.jadwal, (select id_tempat from memiliki where id_paket = $id order by rand() limit 1) as tempat from paket where id_paket = $id;";
		$que = mysqli_query($con, $q);
		while($r = mysqli_fetch_array($que)){
			echo '
				<div class="fl-10 fl text-center mar-20 pad-20 white">
					<a href="#" class="close very-large"><span class="icon-cross"></span></a>
					<div class="fl-3">
						<img src="assets/images/places/'.$r["tempat"].'.jpg" width="100%" height="auto">
					</div>
					<div class="fl-9 fl h-center">
						<div class="fl-12 very-large">
							'.$r["nama_paket"].'
						</div>
						<div class="large">Rp. '.number_format($r['harga'], 0, '', '.').',00 / Pax</div>
						<div class="fl-12">
							<i>Potongan harga:<br>
							2 - 4 pax = Discount 15% /pax<br>
							5 - 6 pax = Discount 20% /pax<br>
							> 6 pax = Discount 30% /pax</i>
						</div>
						<div class="fl-12">'.$r["jadwal"].'</div>
						<div class="fl-12">'.$r["deskripsi_paket"].'</div>
						<div class="fl-12">
						<div class="mar-10 large">Destinasi</div>
			';
			$q2 = mysqli_query($con, "select memiliki.hari_ke, tempat.nama_tempat from memiliki inner join tempat on memiliki.id_tempat = tempat.id_tempat where memiliki.id_paket = $id group by memiliki.hari_ke;");
			$x = mysqli_num_rows($q2);
			for ($i = 1; $i <= $x; $i++) { 
				$q3 = mysqli_query($con, "select tempat.id_tempat, tempat.nama_tempat from memiliki inner join tempat on memiliki.id_tempat = tempat.id_tempat where memiliki.id_paket = $id and memiliki.hari_ke = $i");
				echo '<div>Hari ke-'.$i.':</div>';
				while ($res = mysqli_fetch_array($q3)) {
					echo '<div><a href="wisata.php?id='.$res['id_tempat'].'">'.$res['nama_tempat'].'</a></div>';
				}
			}	
			echo '
						</div> 
						<div class="fl-12">';	
			if (isset($_SESSION['name'])) {
				echo'	<form method="POST" action ="inputpesanan.php" class="fl h-center v-center mar-20">
							<label class="fl-8"> Jumlah pax</label>
							<input type="text" name="jumlah_orang" placeholder="Berapa pax?" class="fl-4" pattern="[0-9]" title="masukkan angka" align="center">
							<label class="fl-12">Tanggal Berangkat</label>
							<select name="tgl" class="fl-1">
							';
							for ($i=1; $i < 32; $i++) { 
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
				echo '	</select>
						<select name="bln" class="fl-2">
							<option value="1">Januari</option>
							<option value="2">Februari</option>
							<option value="3">Maret</option>
							<option value="4">April</option>
							<option value="5">Mei</option>
							<option value="6">Juni</option>
							<option value="7">Juli</option>
							<option value="8">Agustus</option>
							<option value="9">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
						</select>
						<input type="text" name="thn" placeholder="Tahun" class="fl-2" pattern="[0-9]{4}">
						<input type="hidden" name="id_paket" value='.$id.'>
						<button class="btn blue" name="beli">Pesan Sekarang</button></a>
						</form>';
			}
			else if(isset($_SESSION['usaha'])){
				echo "<div>Silahkan Login atau Mendaftar sebagai wisatawan agar dapat memesan paket.</div>";
			}
			else{
				echo "<div>Silahkan <a href='login.php'>Login</a> atau <a href='register.php'>Mendaftar</a> sebagai wisatawan agar dapat memesan paket.</div>";
			}
			echo '</div>
				</div>';
		}
	}
?>