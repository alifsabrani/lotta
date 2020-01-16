<?php
	if(isset($_POST['id_voucher'])){
		$file=$_FILES['bukti']['name'];
		$ext='.jpg';
		$dir=$_FILES['bukti']['tmp_name'];
		$id=$_POST['id_voucher'];
		$folder='assets/images/bukti/';
		if(move_uploaded_file($dir, $folder.$file)){
			$baru=rename($folder.$file, $folder.$id.$ext);
			if ($baru) {
				echo "<h1>Terimakasih sudah meng-upload bukti pembayaran.<br>
						Silahkan menunggu konfirmasi dari pengelola</h1>";
				echo "<script>
					setTimeout(function(){
						window.location.href = 'profil.php'
					}, 3000);</script>
				";
			}
			
		}
		else
			echo 'format gambar salah <a href="profil.php">kembali</a>';
	}
?>