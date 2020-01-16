<?php
	session_start();
	include 'config.php';
	if (isset($_SESSION['admin'])) {
		header("location:index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/fonts.css">
	<script src="../assets/js/jquery-2.2.3.min.js"></script>
	<script src="../assets/js/lotta.js"></script>
	<style>
		#main{
			margin-top: 0;
		}
	</style>
</head>
<body>
	<div class="container white">
		<div class="fl fl-12 top" id="main">
			<div class="fl-12 text-center">
				<p class="large">
					<span class="bolder larger">Lombok Tour and Travel Agency</span><br>
					Admin Panel
				</p>
			</div>
			<div id="login" class="fl-12 fl h-center v-center">
				<div class="fl-12 text-center very-large"><span class="very-large">Administrator Login</span></div>
				<div class="fl-5 form-container blue">
					<p class="text-center text-warning"></p>
					<form method="POST" action="logincheckadmin.php" role="form" class="fl h-center">
						<div class="fl-12 fl h-center">
							<label for="id_admin" class="fl-3">ID</label>
							<input type="text" class="fl-8" placeholder="ID" name="id_admin" required>
						</div>
						<div class="fl-12 fl h-center">
							<label for="password" class="fl-3">Password</label>
							<input type="password" name="password" placeholder="Password" class="fl-8" required>
						</div>
						<div class="fl-12 fl h-center">
							<button class="btn large green" name="login" value="kirim" type="submit">Masuk</button>
						</div>	
					</form>
				</div>
			</div>
		</div>	
	</div>
</body>
</html>