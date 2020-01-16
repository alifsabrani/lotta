<?php
	session_start();
	include 'config.php';
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$qu = mysqli_query($con, "select * from tempat where id_tempat=$id");
		while ($result = mysqli_fetch_array($qu)) {
			echo '
			<div class="fl-8 fl pad-10 mar-20 white h-center">
				<div class="fl-10">
					<img src="assets/images/places/'.$result["id_tempat"].'.jpg" width="100%" height="auto">
				</div>
				<div class="fl-10 text-center large">
					<span class="larger">'.$result["nama_tempat"].'</span><br>
					'.$result["lokasi"].'<br>
				</div>
				<div class="fl-10">'.$result['deskripsi_tempat'].'</div>
				</div>';
				$qu = mysqli_query($con, "SELECT wisatawan.nama_wisatawan AS nama_pengguna, review.komentar, review.id_tempat, review.rating from wisatawan inner join review on review.id_pengguna=wisatawan.id_pengguna and review.id_tempat=$id");
				echo '<div class="fl-8 larger font-white">'.mysqli_num_rows($qu).' Komentar <span class="icon-bubble2"></span></div>
				<div class="fl-8 form-container sp-between">';
				while ($r = mysqli_fetch_array($qu)) {
					echo '
							<div class="fl pad-10 mar-10 white">
								<div class="fl-12 font-blue1">'.$r['nama_pengguna'].' said</div>
								<div class="fl-10 blue font-white pad-10 comment"><em>"'.$r['komentar'].'"</em></div>
								';
					$rate = array();
					$rating = $r['rating'];

					for($i = 0; $i < 5;$i++){
						if ($rating >= 1) {
							$rate[$i] = '<span class="icon-star-full"></span>';		
						}
						else if($rating > 0){
							$rate[$i] = '<span class="icon-star-half"></span>';
						}
						else{
							$rate[$i] = '<span class="icon-star-empty"></span>';
						}
						$rating--;
					}
					$rate = join($rate);

					echo '
							<div class="fl-12 font-orange">
								'.$rate.'
							</div>
						</div>			
					';
				}						
			if (isset($_SESSION['id']) && isset($_SESSION['name'])) {
					echo '<form method="POST" action="inputreview.php" role="form" class="fl sp-between">
								<input type="hidden" name="id_tempat" value ="'.$id.'" >
								<div class="fl-8 fl sp-between">
									<label for="user_id" class="fl-12">Komentar</label>
									<textarea class="fl-12" placeholder="Komentar" name="komentar" required></textarea>
								</div>
								<div class="fl-2 fl h-center">
									<label for="nama" class="fl-12 text-center">Rating</label>
									<div class="fl-12 fl h-center radio">
										<input type="radio" name="rating" value="1" id="rate1" checked>
										<label for="rate1" class="current" onclick="changeRadio(this);">
											<span class="icon-star-full"></span>
											<span class="icon-star-empty"></span>
											<span class="icon-star-empty"></span>
											<span class="icon-star-empty"></span>
											<span class="icon-star-empty"></span>
										</label>
									</div>
									<div class="fl-12 fl h-center radio">
										<input type="radio" name="rating" value="2" id="rate2">
										<label for="rate2" onclick="changeRadio(this);">
											<span class="icon-star-full"></span>
											<span class="icon-star-full"></span>
											<span class="icon-star-empty"></span>
											<span class="icon-star-empty"></span>
											<span class="icon-star-empty"></span>
										</label>
									</div>
									<div class="fl-12 fl h-center radio">
										<input type="radio" name="rating" value="3" id="rate3">
										<label for="rate3" onclick="changeRadio(this);">
										<span class="icon-star-full"></span>
										<span class="icon-star-full"></span>
										<span class="icon-star-full"></span>
										<span class="icon-star-empty"></span>
										<span class="icon-star-empty"></span>
										</label>
									</div>
									<div class="fl-12 fl h-center radio">
										<input type="radio" name="rating" value="4" id="rate4">
										<label for="rate4" onclick="changeRadio(this);">
										<span class="icon-star-full"></span>
										<span class="icon-star-full"></span>
										<span class="icon-star-full"></span>
										<span class="icon-star-full"></span>
										<span class="icon-star-empty"></span>
										<label>
									</div>
									<div class="fl-12 fl h-center radio">
										<input type="radio" name="rating" value="5" id="rate5">
										<label for="rate5" onclick="changeRadio(this);">
										<span class="icon-star-full"></span>
										<span class="icon-star-full"></span>
										<span class="icon-star-full"></span>
										<span class="icon-star-full"></span>
										<span class="icon-star-full"></span>
										</label>
									</div>
								</div>
								<div class="fl-2 fl v-center h-center">
									<button class="btn green large" name="daftar" type="submit" value="kirim">Kirim</button>
								</div>	
							</form>
					';
				}
				else if(isset($_SESSION['usaha'])){
					echo "<div>Silahkan Login atau Mendaftar sebagai wisatawan untuk meninggalkan komentar dan rating.</div>";
				}
				else{
					echo "<div class='text-center'>Silahkan <a href='login.php'>Login</a> atau <a href='register.php'>Mendaftar</a> sebagai wisatawan untuk meninggalkan komentar dan rating.</div>";
				}
				echo "
					</div>";
		}
	}
?>