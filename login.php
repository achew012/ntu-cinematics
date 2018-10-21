<!DOCTYPE html>
<html>
<?php 
	if (!isset($_SESSION)){
		session_start();
	}
	if(isset($_SESSION["useraccount"])){
		echo "<script>const useraccount=".$_SESSION["useraccount"]."[0];console.log(useraccount)</script>";
		header("Location: http://localhost:1234/ntucinematics/useraccount.php");
	}else{
		echo "<script>const useraccount=null</script>";
	}
	
?>
<head>
	<title>Movies</title>
	<link rel="stylesheet" type="text/css" href="./css/ee4717.css">
	<script type="text/javascript" src='./scripts/login.js'></script>
	<script type="text/javascript" src='./scripts/globalinit.js'></script>
</head>
<body>
	<div class="clearfix">
		<header>
			<img src="./img/logo.jpg" style="width:80%;height:100%;">
		</header>
		<nav style="text-align:right;padding-right:0px">
			<a href="./index.php" class="menu">Home</a>
			<a href="./movies.html" class="menu">Movies</a>
			<a href="./promotions.html" class="menu">Promotions</a>
			<a href="./cart.php" class="menu" > Cart</a>
			<span class="account-box" style="float:right;">
				<?php
					if (isset($_SESSION["useraccount"])){
						echo "	<span id='account' class='menu' style='padding-right:0px'> 
									Account
								</span>
								<span id='account-option' class='account-option' style='width:100%;text-align: center;''>
									<a>Profile</a>
									<a>Logout</a>
								</span>	";		
					}else{
						echo"	<span id='account' class='menu' style='padding-right:0px'> 
									Account
								</span>
								<span id='account-option' class='account-option' style='width:100%;text-align: center;''>
									<a>Login</a>
									<a>Register</a>
								</span>	";
					}
				?>
				
			</span>			
			<span class="dot" id="dot">0</span>
		</nav>
	</div>	
	<div class="container clearfix" style="margin-bottom:10px">
		<center>
			<select id="SelectMovie" class="menu-select" onchange="onClick(1,'loc_address', 'MOVIE_ID', this, ['CINEMA_ID','CINEMA'],'OPTION','SelectCinema')" style="width:40%;margin-right:1.25%">
				<option value="" disabled selected>Select movie</option>
			</select>
			<select id="SelectCinema" class="menu-select" onchange="onClick(2,'loc_address', 'CINEMA_ID', this, ['DAY','DAY'],'OPTION', 'SelectDate')" style="width:15%;margin-right:1.25%">
				<option value="" disabled selected>Select cinema</option>
			</select>
			<select id="SelectDate" class="menu-select" onchange="onClick(3,'loc_address', 'DAY', this, ['TIME','TIMESTAMP'],'OPTION', 'SelectTime')" style="width:15%;margin-right:1.25%">
				<option value="" disabled selected>Select day</option>
			</select>
			<select id="SelectTime" class="menu-select" onchange="onClick(4,'loc_address', 'TIME', this, ['UNIQUE_ID','UNIQUE_ID'], 'BUTTON', 'BOOK')" style="width:15%;margin-right:1.25%">
				<option value="" disabled selected>Select time</option>
			</select>
			<input id="BOOK" type="button" class="teal-button" value="Book now" onclick="storeSend()" style="width:10%">
		</center>
	</div>
	<span class="two-third" style="height:450px">
		<img src="./img/minions.jpg" style="height:100%;width:100%">
	</span>
	<span class="one-third" style="height:450px;border:1px solid black;border-radius:5px;">
		<div style="padding:10px;height:400px;padding:10px 10px">
			<label>Email</label><br>
			<input id = "email" type="text" style="width:100%;height:25px;" class="teal-input" required><br>
			<label>Password</label><br>
			<input id = "password" type="password" style="width:100%;height:25px;" class="teal-input" required><br><br>
			<input type="button" value="Login" class="teal-button" onclick="onlogin()" style="margin-top:5px;width:100%"><br>
			<a href="./register.html"><input type="button" value="Register" class="teal-border-button" style="margin-top:10px;width:100%"></a>
		</div>
		
	</span>
	<footer>
		<center>
			<label style="border-right:1px solid black;margin-right:10px">
				Careers
			</label>
			<label style="border-right:1px solid black;margin-right:10px">
				FAQ
			</label>
			<label>
				Contact us
			</label>	
			<br>
			<label>
				Copyright to this website belongs to MyMovie Pte Ltd. The contents of this website shall not be reproduced in any form in whole or in part. We reserve all rights.
			</label>
		</center>
	</footer>
</body>
</html>