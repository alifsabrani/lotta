<?php
	session_start();
	include 'config.php';
	if (!isset($_SESSION['admin'])) {
		header("location:adminlogin.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Obrolan LOTTA</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/fonts.css">
	<script src="../assets/js/jquery-2.2.3.min.js"></script>
	<script src="../assets/js/lotta.js"></script>
	<script>
		var dataUser = "";
		var showedUser = "";
		function reqChat(data){
			if (dataUser != '') {
				$.ajax({
					url: "reqChat.php",
					type: "POST",
					data: "id="+data,
					success: function(data){
						data = JSON.parse(data);
						newChat = '';
						if (data.length > $("#chat").children().length || showedUser != dataUser) {
							$("#chat").html("<div class='fl-12 fl v-center h-center'><div class='loader loader-40'></div></div>");	
							//setTimeout(function(){
							//}, 1000)
							showedUser = data[0].id_pengguna;
							for(i = 0;i < data.length;i++){
								newChat += '<div class="fl-12 fl top pad-10">';
								if (data[i].from == 'admin') {
									newChat += '<div class="fl-2 font-blue1 text-center"><div class="very-large"><span class="icon-user"></span></div>Admin</div><div class="fl-9 fl blue">';
								}
								else{
									newChat += '<div class="fl-9 fl orange mar-10">';	
								}
								newChat += '<div class="fl-12 mar-10">'+data[i].teks+'</div><div class="fl-12 white font-blue1">'+data[i].waktu+'</div></div>';
								if (data[i].to == 'admin') {
									newChat += '<div class="fl-2 font-orange text-center"><div class="very-large"><span class="icon-user"></span></div></div>'
								}
								newChat += '</div>';
							}
							$("#chat").hide();
							$("#chat").html(newChat);
							$("#chat").css("opacity", "0");
							$("#chat").show(300, function(){
								$("#chat").scrollTop($("#chat").prop('scrollHeight'));
								$("#chat").animate({opacity:1}, 300);
							});
							$("#sendChat").show();
						}
					}
				})
			}
		}
		function reqUser(){
			$.ajax({
				url: "reqUserChat.php",
				type: "POST",
				success: function(data){
					data = JSON.parse(data);
					newUser = '';
					for(i = 0;i < data.length;i++){
						if (data[i].unread > 0) {
							newUser = newUser+'<button class="fl-12 btn pad-10 unread mar-10 blue user" id="user'+data[i].id_pengguna+'"><div class="count">'+data[i].unread+'</div>';
						}
						else{
							newUser = newUser+'<button class="fl-12 btn pad-10 mar-10 blue user" id="user'+data[i].id_pengguna+'">';	
						}
						if(data[i].tipe == 'wisatawan'){
							newUser = newUser+'<span class="icon-user large"></span> <span class="name">'+data[i].nama+'</span></button>'
						}
						else{
							newUser = newUser+'<span class="icon-office large"></span> <span class="name">'+data[i].nama+'</span></button>'	
						}
					}
					if ($("#userChat").html() !== newUser) {
						$("#userChat").html(newUser);
					}
					$(".user").click(function(){
						var currentUser = $(this).children('.name').text();
						$("#currentUser").text(currentUser);
						dataUser = $(this).attr("id").substring(4);
						$("#idUser").val(dataUser);
						reqChat(dataUser);
					})
				}
			})
		}
		$(document).ready(function(){
			reqUser();
			setInterval(function(){reqChat(dataUser), reqUser()}, 1000);
			$("#sendChat").submit(function(){
				text = $("#ta").val();
				user = $("#idUser").val();
				data = {'text': text, 'user': user};
				$.ajax({
					url: "sendChat.php",
					type: "POST",
					data: data,
					beforeSend: function(){
						$("#chat").html("<div class='fl-12 fl v-center h-center'><div class='loader loader-40'></div></div>");
					},
					success: function(data){
						$("#ta").val('');
					},

				})
				return false;	
			})
			$("#sendChat").keypress(function(e){
				if (e.which == 13 && !e.shiftKey) {
					$(this).submit();
				}
			})
		})
	</script>
</head>
<body>
	<div class="container admin white">
		<div class="fl sp-between top">
			<div class="fl-3 fl blue pad-10 v-center font-white" id="left-menu">
				<div class="fl-12 fl h-center dk-blue">
					<a href="index.php" id="logo" class="fl-4 fl v-center"><img src="../assets/images/logo.png" width="100%" height="auto"></a>
					<div class="fl-7 ">
						<p class="large text-center"><span class="very-large">LOTTA</span> <br>Admin Panel</p>
					</div>
				</div>
				<a href="index.php" class="fl-12 fl">
					<button class="large btn blue fl-12 text-left">Pemesanan</button>
				</a>
				<a href="lihatPaket.php" class="fl-12 fl">
					<button class="large btn blue fl-12 text-left">Paket</button>
				</a>
				<a href="lihatPengajuan.php" class="fl-12 fl">
					<button class="large btn blue fl-12 text-left">Pengajuan</button>
				</a>
				<a href="lihatPengguna.php" class="fl-12 fl">
					<button class="large btn blue fl-12 text-left">Pengguna</button>
				</a>
				<a href="konsultasiAdmin.php" class="fl-12 fl">
					<button class="large btn blue fl-12 text-left">Konsultasi</button>
				</a>
				<a href="lihatDestinasi.php" class="fl-12 fl">
					<button class="large btn blue fl-12 text-left">Destinasi</button>
				</a>
				<a href="logout.php" class="fl-12 fl">
					<button class="large btn red fl-12 text-center">Logout</button>
				</a>
			</div>
			<div class="fl top" id="main">
				<div class="fl-12 text-center">
					<p class="large">
						<span class="bolder larger"><span class="icon-airplane"></span> Lombok Tour and Travel Agency</span><br>
						Admin Panel
					</p>
					<div class="dk-blue fl-12 font-white h-center pad-20">
						<div class="fl-12 fl sp-between">
							<div class="fl-3 fl top">
								<div class="fl-12 text-center very-large"><span class=" bolder">Pengguna</span></div>
								<div class="fl-12 fl top large" style="overflow-y: auto; height: 85vh" id="userChat"></div>
							</div>
							<div class="form-container white fl-8 fl h-center pad-20">
									<div class="fl-12 larger font-blue1" id="currentUser">
										
									</div>
								<div class="fl-12 fl text-left" id="chat" style="height: 50vh; overflow-y: scroll;">
								</div>
								<form action="konsultasi.php" method="post" class="fl-12 fl" id="sendChat" style="display: none">
									<textarea id="ta" name="deskripsi" class="fl-12"></textarea>
									<input type="hidden" name="idUser" id="idUser" value="">
									<div class="fl-12 fl h-center">
										<button type="submit" name="kirim" value="kirim" class="btn blue"><span class="icon-checkmark"></span> Kirim</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</body>
</html>