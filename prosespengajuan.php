<?php
	include "config.php";
	session_start();
	if(isset($_POST['ajukan'])){
		$nama=$_POST['nama'];
		$harga=$_POST['harga'];
		$deskripsi=$_POST['deskripsi'];
		$id_pengguna=$_SESSION['id'];
		$status='Belum Diterima';
		$ksg=true;
		if(empty($nama)||empty($harga)||empty($deskripsi))
			$ksg=false;
		if($ksg){
			$sql="INSERT INTO pengajuan_paket (nama_pengajuan,harga,deskripsi,id_pengguna, status) VALUES ('$nama','$harga','$deskripsi','$id_pengguna','$status')";
			if(mysqli_query($con,$sql)){
	 			echo "<h1>Terimakasih telah mengajukan paket wisata anda, beberapa saat lagi anda akan diarahkan ke halaman sebelumnya</h1>";
	 			echo "<script>
	 				setTimeout(function(){
	 					window.location.href = 'pengajuan.php'
	 				}, 3000);</script>
	 			";
	 			mysqli_close($con);
	 		}
	 	}
	 	
 	}
?>