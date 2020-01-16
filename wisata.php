<?php
	session_start();
	include 'config.php';
	if (isset($_SESSION['name']) && isset($_SESSION['id'])) {
		$login = true;
		$wisata=true;}
	else if (isset($_SESSION['usaha']) && isset($_SESSION['id']) ){
		$login = true;
		$wisata = false;
	}
	else $login = false;
?>
<!DOCTYPE html>
<html>
<head>
<title>Lombok Beauty</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/fonts.css">
	<script src="assets/js/jquery-2.2.3.min.js"></script>
	<script src="assets/js/lotta.js"></script>
	<script>
		var pageTotal;
		pageTotal = 0;
		pageSize = 3;
		showedPage = 1;
		showPage = function(page) {
		    $(".place").hide();
		    $(".place").each(function(n) {
		        if (n >= pageSize * (page - 1) && n < pageSize * page)
		            $(this).show();
		    });        
		}
		function reqWisata(data){
			$.ajax({
			url: "reqWisata.php",
			type: "POST",
			data: "id="+data,
			beforeSend: function(){
				$("#chat").html("<div class='fl-12 fl v-center h-center'><div class='loader loader-40'></div></div>");
			},
			success: function(data){
				$("#showedPlace").html(data);
				//window.scrollTo(0, 634);
				$('html, body').animate({scrollTop: 634}, 500);
			}
			})
		}
		$(document).ready(function(){
			showPage(showedPage);
			<?php
				if (isset($_GET['id'])) {
					$id = $_GET['id'];
					echo "reqWisata(".$id.");";
				}
			?>
			$("#place .place").each(function(){
				pageTotal++;
			})
			x = pageTotal / 3;
			for(i = 0;i < x - 1;i++){
				y = i + 2;
				$("#page").append('<button class="btn dk-blue round" href="#">'+y+'</button>')
			}
			$("#page button").click(function() {
			    $("#page button").removeClass("current");
			    $(this).addClass("current");
			    showedPage = parseInt($(this).text());
			    showPage(showedPage);
			});
			$("#next").click(function(){
				if (showedPage == $(".place").length / pageSize) {
					showedPage = 1;
					$("#page button").first().click();
				}
				else{
					showedPage++;
					$("#page button.current").next().click();
				}
				return false;
			})
			$("#prev").click(function(){
				if (showedPage == 1) {
					showedPage = $(".place").length / pageSize;
					$("#page button").last().click();
				}
				else{
					showedPage--;
					$("#page button.current").prev().click();
				}
				return false;
			})
			$(".place a").click(function(){
				var data = $(this).attr("id").substring(5);
				reqWisata(data);
				return false;
			})
		})
	</script>
	<style type="text/css">
		#page button.current{
			background-color: white;
			color: black;
		}
	</style>
</head>
<body>
	<div class="container blue">
		<div class="fl" id="header">
			<div class="fl-12 fl v-center" id="top">
				<div class="fl-1">
					<a href="index.php" id="logo"><img src="assets/images/logo.png" width="90px" height="80px"></a>
				</div>
				<div class="fl-7">
					<p class="large">
						<span class="bolder larger">Lombok Tour and Travel Agency</span><br>
						Jln. Majapahit no.64 Kota Mataram, NTB, Indonesia (83313)<br>
						<span class="small"><span class="icon-phone"></span> 0370-88763</span>
					</p>
				</div>
				<div class="fl-4 fl right" id="user-nav">
				<?php
					if(!$login){
						echo '
								<a href="login.php" class="fl-4 fl"><button class="btn fl-12 orange">Login</button></a>
								<a href="register.php" class="fl-4 fl"><button class="btn fl-12 blue">Daftar</button></a>
						';
					}
					else{
						echo '<a href="logout.php" class="fl-4 fl"><button class="btn fl-12 red">Logout</button></a>';
					}
				?>
				</div>
			</div>
			<div class="fl-12 fl sp-between" id="nav">
				<div class="fl-2 left">
					<a href="index.php" id="small-logo"><img src="assets/images/small-logo.png" height="30px" width="auto"></a>
				</div>
				<div class="fl-10 right fl bottom" id="nav-menu">
					<?php
						if($login){
							if(!$wisata){
								echo'
									<a href="profil.php" class="fl bottom h-center">'.$_SESSION["usaha"].'</a>
									<a href="pengajuan.php" class="fl bottom h-center">Ajukan Paket</a>
									<a href="konsultasi.php" class="fl bottom h-center">Hubungi Pengelola</a>
								';
							}
							else{
								echo'
									<a href="profil.php" class="fl bottom h-center">'.$_SESSION["name"].'</a>
									<a href="konsultasi.php" class="fl bottom h-center">Konsultasi Wisata</a>
								';
							}
						}
					?>
					<a href="wisata.php" class="fl bottom h-center">Destinasi Wisata</a>
					<a href="paket.php" class="fl bottom h-center">Paket Wisata</a>
					<a href="about.php" class="fl bottom h-center">About Us</a>
				</div>
			</div>
		</div>
		<div class="fl" id="main">
			<div class="fl-12 fl text-center very-large h-center pad-20">
				<div class="fl-12 pad-20 very-large font-white" style="background-color: rgba(0,0,0,0.3);">
					Keindahan pulau lombok
				</div>
			</div>
			<div class="fl-12 sp sp-around">
				<div class="fl-12 pad-20">
					<div class="fl-12 fl h-center font-blue" id="place">
						<div class="fl-1 fl v-center very-large">
							<a href="#" id="prev" class="fl-12 text-center very-large"><span class="icon-circle-left very-large"></span></a>
						</div>
						<?php
							$q = mysqli_query($con, "select * from tempat;");
							while ($result = mysqli_fetch_array($q)) {
								echo '
									<div class="fl-3 mar-10 white fl place">
										<a href="#" class="fl-12 zoom img-container" id="place'.$result["id_tempat"].'" style="height: 80%">
											<img src="assets/images/places/'.$result["id_tempat"].'.jpg">
										</a>
										<div class="fl-12 text-center small" style="height: 20%">
											<span class="larger">'.$result["nama_tempat"].'</span><br>
											'.$result["lokasi"].'<br>
										</div>
									</div>			
								';
							}
						?>
						<div class="fl-1 fl v-center very-large">
							<a href="#" id="next" class="fl-12 text-center very-large"><span class="icon-circle-right very-large"></span></a>
						</div>
					</div>
					<div class="fl-12 fl h-center" id="page">
						<button class="btn round dk-blue current" href="#">1</button>
					</div>
					<div class="fl-12 fl h-center" id="showedPlace">
						
					</div>
				</div>
			</div>
		</div>
		<div id="footer" class="dk-blue">
			<div class="fl h-center">
				<div class="fl-7">
					Web LOTTA berada di bawah pengelolaan CV. Lombok Tour and Travel Agency. Segala aturan dan kebijakan dalam web ini sepenuhnya merupakan hak penuh dari CV. Lombok Tour and Travel Agency.
				</div>
				<div class="fl-4 text-center pad-20">
					<p>
						Find Us:
					</p>
					<div class="fl">
						<div class="fl-12 fl h-center">
							<div class="fl-6 fl sp-around">
								<a href="#"><span class="icon-facebook2 very-large"></span></a>
								<a href="#"><span class="icon-twitter very-large"></span></a>
								<a href="#"><span class="icon-instagram very-large"></span></a>
								<a href="#"><span class="icon-whatsapp very-large"></span></a>
								<a href="#"><span class="icon-location very-large"></span></a>
							</div>
						</div>
					</div>
				</div>
				<div class="fl-12 fl sp-between orange pad-10">
					<div class="fl-12 fl right">
						Copyright&copy; 2016
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>