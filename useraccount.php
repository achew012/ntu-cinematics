<!DOCTYPE html>
<html>
<?php
	if (!isset($_SESSION)){
		session_start();
	}
	if(isset($_SESSION["useraccount"])){
		echo "<script> 
				const useraccount=".$_SESSION["useraccount"]."[0]
				window.onload=function(){
					document.getElementById('name').value=useraccount.name;
					document.getElementById('email').value=useraccount.email;
					document.getElementById('address').value=useraccount.address;
					document.getElementById('postalcode').value=useraccount.postalcode;
					document.getElementById('cardtype').value=useraccount.cardtype;
					document.getElementById('cardno').value=useraccount.cardno;
				}
			  </script>";
	}else{
		echo "<script>const useraccount=null</script>";
		header("Location: http://localhost:1234/ntucinematics/index.php");
	}
	

?>

<head>
	<title>Movies</title>
	<link rel="stylesheet" type="text/css" href="./css/ee4717.css">
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
	<div style="height:600px;border:1px solid #b3b3b3">
		<div>
			<input id="nowShowingBtn" type="button" value="Account" class="teal-border-button" style="float:left;outline:none;border-radius:0px;width:10%" onclick="document.getElementById('nowShowing').style.visibility = 'visible';
			 document.getElementById('comingSoon').style.visibility = 'hidden';
			 document.getElementById('comingSoon').style.height = '0px';
			 document.getElementById('nowShowing').style.height = '600px';
			 this.classList.remove('grey-button');
			 this.classList.add('teal-border-button');
			 document.getElementById('comingSoonBtn').classList.remove('teal-border-button');
			 document.getElementById('comingSoonBtn').classList.add('grey-button');
			 console.log(document.getElementById('comingSoonBtn').classList);"
			 >
		<input id="comingSoonBtn" type="button" value="Purchases" class="grey-button" style="float:left;outline:none;border-radius:0px;width:10%;" onclick="document.getElementById('nowShowing').style.visibility = 'hidden';
			 document.getElementById('comingSoon').style.visibility = 'visible';
			 document.getElementById('nowShowing').style.height = '0px';
			 document.getElementById('comingSoon').style.height = '600px';
			 this.classList.remove('grey-button');
			 this.classList.add('teal-border-button');
			 document.getElementById('nowShowingBtn').classList.remove('teal-border-button');
			 document.getElementById('nowShowingBtn').classList.add('grey-button');">
		</div>
		<span id="nowShowing" class="full" style="height:600px;overflow-y:none">
			<div id='accountinfo' style="height:40%;width:50%">
				<fieldset style="margin:0px;margin-top:10px">
				    <legend>Personal Details</legend>
					<label>Name</label><br>
					<input id='name' type="text" style="height:25px;width:33.33%" class="teal-input" value=''><br>
					<label>Email</label><br>
					<input id='email'type="email" style="height:25px;width:33.33%" class="teal-input" value=''><br>
					<label>Address</label><br>
					<textarea id='address' style="height:50px;width:33.33%" class="teal-input" value=''></textarea><br>
					<label>Postalcode</label><br>
					<input id='postalcode'type="number" style="height:25px;width:33.33%" class="teal-input" value=''><br>
				</fieldset>
				<fieldset style="margin:0px;margin-top:10px">
				    <legend>Payment Details</legend>
					<label>Card type*</label><br>
					<select id="cardtype" class="grey-input" style="height:25px">
						<option value="" disabled selected>-Please Select-</option>
						<option>Mastercard</option>
						<option>VISA</option>
					</select><br>
					<label>CreditCard Number*</label><br>
					<input id='cardno' type="text" value="" class="grey-input" style="height:25px"><br>
				    <label>Card Verification Number*</label><br>
				    <input id='cardverification' type="text" name="" class="grey-input" style="height:25px"><br>
				    <input id='registerbtn' type="button" value="Register" class="teal-border-button" onclick="onRegister()" style="margin-top:10px;">
				  </fieldset>
			</div>
		</span>
		<span id="comingSoon" class="full" style="height:600px;position:relative;z-index:-2px;visibility:hidden;" >
			<div class="one-fifth">
				<img src="./img/smallfootsmall.jpg" style="height:100%;width:80%">
				<div class='movies'>
					<label style="font-size:20px">Small Foot</label><br>
					<label style="font-size:15px">(PG)</label><br>
					<label style="font-size:15px">95 Mins</label><br>
					<label style="font-size:15px">English</label>
				</div>		
			</div>
			
			
		</span>
	</div>



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