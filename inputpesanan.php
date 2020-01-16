<?php
	include "config.php";
	session_start();
	if(isset($_POST['beli'])){
		$id_pengguna=$_SESSION['id'];
		$id_paket= $_POST['id_paket'];
		$tgl = $_POST['tgl'];
		$bln = $_POST['bln'];
		$thn = $_POST['thn'];
		$tgl_berangkat = $thn.'-'.$bln.'-'.$tgl;
		$pax = $_POST['jumlah_orang'];
		$total = "SELECT harga from paket WHERE id_paket='$id_paket'";
		$q = mysqli_query($con, $total);
		$r = mysqli_fetch_array($q);
		$totalHarga = $r['harga'];
		if($pax == 1){
		}
		elseif($pax < 5){
			$totalHarga = $pax*($totalHarga - ($totalHarga*0.15));
		}
		elseif($pax < 7){
			$totalHarga = $pax*($totalHarga - ($totalHarga*0.20));
		}
		else{
			$totalHarga = $pax*($totalHarga - ($totalHarga*0.30));
		}
		$status="Belum Bayar";
		
		if($thn > date('Y')){
			$bisa = true;
		}
		elseif($thn == date('Y')){
			if ($bln > date('n')) {
				$bisa = true;
			}
			elseif ($bln == date('n')) {
				if ($tgl > date('w')) {
					$bisa = true;
				}
				else{
					$bisa = false;
				}
			}
			else{
				$bisa = false;
			}
		}
		else{
			$bisa = false;
		}

		if ($bisa) {
			$sql="INSERT into memesan (id_pengguna,id_paket,tgl_pesan,tgl_berangkat,jumlah_orang, total,status) values ('$id_pengguna','$id_paket',now(),'$tgl_berangkat','$pax' , '$totalHarga','$status')";
			if (mysqli_query($con,$sql)) {
				mysqli_close($con);
				header("location:profil.php");
			}
		}
		else{
			echo "Tanggal berangkat sudah lewat";
					echo "
						<script>
							setTimeout(function(){
								window.location.href = 'profil.php';
							}, 800)
						</script>
					";
		}
	}
?>