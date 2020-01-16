<?php
	if(isset($_POST['id_voucher'])){
		$file=$_FILES['bukti']['name'];
		$ext='.jpg';
		$dir=$_FILES['bukti']['tmp_name'];
		$id=$_POST['id_voucher'];
		$folder='../assets/images/voucher/';
		if(move_uploaded_file($dir, $folder.$file))
			$baru=rename($folder.$file, $folder.$id.$ext);
		if($baru)
			header("location:index.php");
	}
?>