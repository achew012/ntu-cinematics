<!DOCTYPE html>
<html>
<?php
	if (!isset($_SESSION)){
		session_start();
	}
	if(isset($_SESSION["useraccount"])){
		echo "<script>const useraccount=".$_SESSION["useraccount"]."[0];console.log(useraccount)</script>";
	}else{
		echo "<script>const useraccount=null</script>";
	}
?>
<head>
	<title>Movies</title>
	<link rel="stylesheet" type="text/css" href="./css/ee4717.css">
	<script type="text/javascript" src='./scripts/globalinit.js'></script>
	<script type="text/javascript">
		var totalTickets=0;
		var userCart;
		window.onload=function(){
			globalInit();
			onInit();
		}
		function onInit(){
			totalTickets=0;
			userCart = localStorage.getItem('userCart');
			const table = document.getElementById('carttable');
			const tableConfirm=document.getElementById('tableConfirm');
			const total = document.getElementById('total');
			console.log(userCart);
			if(userCart==''||userCart=='null'||userCart==null||userCart.length==0){
				alert('No items in cart.... You will be redirected');
				location.href="./index.html"	
			}else{
				userCart=JSON.parse(userCart);
				console.log("MyUser",userCart)
				while(table.hasChildNodes()){
					table.removeChild(table.firstChild);
				}
				while(tableConfirm.hasChildNodes()){
					tableConfirm.removeChild(tableConfirm.firstChild);
				}
				let row = document.createElement("tr");
				row.innerHTML="<tr><th>Movie</th><th>Venue</th><th>Date</th><th>Time</th><th>Seats</th></tr>"
				tableConfirm.appendChild(row);	
				for(let i=0;i<userCart.length;i++){
					if(userCart[i].tickets==null||userCart[i].tickets==[]){
						//do nothing
					}else{
						//Main table
						let tr = document.createElement("tr");
						let td0 = document.createElement("td");
						let td1 = document.createElement("td");
						let td2 = document.createElement("td");
						td0.innerHTML="<label style='color:red;font-size:20px;'>x</label>";
						td0.id=i;
						tr.id="tr"+i
						td0.onclick=function(td0,td1,td2,tr){
							console.log(td0);
							console.log('tr'+td0.path[1].id);
							let tempTr = document.getElementById('tr'+td0.path[1].id);
							console.log(tempTr);
							console.log('scream my name',td0.path[1].id,tempTr);
							console.log(userCart.splice(parseInt(td0.path[1].id),1));
							if(userCart.length==0){
								localStorage.setItem('userCart',null);
							}else{
								localStorage.setItem('userCart',JSON.stringify(userCart));
							}
							localStorage.setItem('userCart',JSON.stringify(userCart));
							while(table.hasChildNodes()){
								table.removeChild(table.firstChild);
							}
							onInit();
						}
						td1.innerHTML="<label style='font-size:15px'>"+userCart[i].movie+"<label><br/>"+userCart[i].cinema.toUpperCase()+", "+userCart[i].date+", "+userCart[i].time+", Seats: "+userCart[i].tickets;
						td2.innerHTML="x "+userCart[i].tickets.length;
						totalTickets+=userCart[i].tickets.length;
						tr.appendChild(td0);
						tr.appendChild(td1);
						tr.appendChild(td2);
						table.appendChild(tr);
						console.log(table);

						//Confirmation table
						let trConfirm = document.createElement("tr");
						let tdConfirm0 = document.createElement("td");
						let tdConfirm1 = document.createElement("td");
						let tdConfirm2 = document.createElement("td");
						let tdConfirm3 = document.createElement("td");
						let tdConfirm4 = document.createElement("td");
						tdConfirm0.innerHTML= userCart[i].movie+'';
						tdConfirm1.innerHTML= userCart[i].cinema.toUpperCase()+'';
						tdConfirm2.innerHTML= userCart[i].date+'';
						tdConfirm3.innerHTML= userCart[i].time+'';
						tdConfirm4.innerHTML= userCart[i].tickets+'';
						trConfirm.appendChild(tdConfirm0);
						trConfirm.appendChild(tdConfirm1);
						trConfirm.appendChild(tdConfirm2);
						trConfirm.appendChild(tdConfirm3);
						trConfirm.appendChild(tdConfirm4);
						tableConfirm.appendChild(trConfirm);
					}
					
				}
				total.innerHTML="$"+totalTickets*12+".00";
				row= document.createElement("tr");
				row.innerHTML="<tr><th></th><th></th><th></th><th>Total:</th><th>$"+totalTickets*12+".00</th></tr>";
				tableConfirm.appendChild(row);
			}
			//Check if accoun details exist
			autofill();
		}
		function onPurchase(){
			function checkName(ele){
				regex=/^[A-Za-z\s]+$/;
				if(!regex.test(ele.value)){
					console.log("name error");
					ele.style.border='1px solid #B91D47';
				}else{
					ele.style.border='1px solid #00B3B3';
				}
				return regex.test(ele.value);
			}
			function checkEmail(ele){
				regex=/^[\w.-]+@[A-Za-z](.[A-Za-z]{2,3})+$/;
				if(!regex.test(ele.value)){
					console.log("email error");
					ele.style.border='1px solid #B91D47';
				}else{
					ele.style.border='1px solid #00B3B3';
				}
				return regex.test(ele.value);
			}
			function checkAddress(ele){
				regex=/^[\w\s-.#@()]+$/;
				if(!regex.test(ele.value)){
					console.log("address error");
					ele.style.border='1px solid #B91D47';
				}else{
					ele.style.border='1px solid #00B3B3';
				}
				return regex.test(ele.value);
			}
			function checkPostal(ele){
				regex=/^[\d]{6}$/;
				if(!regex.test(ele.value)){
					console.log("postal error");
					ele.style.border='1px solid #B91D47';
				}else{
					ele.style.border='1px solid #00B3B3';
				}
				return regex.test(ele.value);
			}
			function checkCardNumber(ele){
				regex=/^[\d]{16}$/;
				if(!regex.test(ele.value)){
					console.log("cardno error");
					ele.style.border='1px solid #B91D47';
				}else{
					ele.style.border='1px solid #00B3B3';
				}
				return regex.test(ele.value); 
			}
			function checkCardVerification(ele){
				regex=/^[\d]{3}$/;
				if(!regex.test(ele.value)){
					console.log("cardveri error");
					ele.style.border='1px solid #B91D47';
				}else{
					ele.style.border='1px solid #00B3B3';
				}
				return regex.test(ele.value);
			}
			if(checkName(document.getElementById('name'))&&checkEmail(document.getElementById('email'))&&checkAddress(document.getElementById('address'))&&checkPostal(document.getElementById('postalcode'))&&checkCardNumber(document.getElementById('cardno'))&&checkCardVerification(document.getElementById('ccv'))){
				document.getElementById('confirmPage').style.display='block';
			}else{
				alert('Please check your inputs');
			};


		}

		function onConfirm(){
			document.getElementById('confirmPage').style.display='none';
			const spinner = document.getElementById('spinner');
			spinner.style.display="block";
			const confirmInterval=setInterval(function(){
				if(Math.random()>0){
					//This is the place to submit orders
					for(let i=0;i<userCart.length;i++){
						console.log('Updating server')
						console.log(userCart[i].uniqueID);
						console.log(userCart[i].tickets);
						console.log(userCart[i].time);
						for(let seat=0; seat<userCart[i].tickets.length; seat++){
							sendData("unique_seats", "updateSeats", "0", userCart[i].uniqueID, userCart[i].tickets[seat]);
						}
					}
					localStorage.setItem('userCart',null);
					localStorage.setItem('userSelection',null);
					location.href='./paymentsuccess.html';
				}else{
					spinner.style.display="none";
					alert('Payment failed... Please try again');
				}
				clearInterval(confirmInterval);
			},5000)
	
		}
		setInterval(function(){
			onInit();
		},3000)

		function autofill(){
			if(useraccount==null||useraccount==''){
				console.log("No login details");
				return;
			}
			// ARRAY FORMAT [userID, Name, Password, Email, Address, CardNo, CCV]
			document.getElementById('name').value=useraccount.name;
			document.getElementById('email').value=useraccount.email;
			document.getElementById('address').value=useraccount.address;
			//[TODO] postal code
			//[TODO] card type
			document.getElementById('cardno').value=useraccount.cardno;
			document.getElementById('ccv').value=useraccount.ccv;
		}

		// WHERE return_column= [UNIQUE_ID, SeatNumber]
		function sendData(table_name, condition, value, ID, tickets){
				var ajax = new XMLHttpRequest();
				let datainput =  new FormData();
				var method = "POST";
				var url = "./php/dataCheckout.php";
				var asynchronous = true;
				var uniqID;
				var userSelection= JSON.parse(localStorage.getItem('userSelection'));
				// Add data into packet

				//ID=ID.slice(3,ID.length-1);
				datainput.append("table_name", table_name);
				datainput.append("condition", condition);
				datainput.append("TIMESTAMP", userSelection.time);
				//datainput.append("DATE",);
				datainput.append("ID",ID);
				datainput.append("tickets",tickets);
				//console.log("USERGLOBAL ", userSelection.time);
				//For posting
				ajax.open(method, url, asynchronous);	
				ajax.send(datainput);


				ajax.onreadystatechange= function(){
					if(this.readyState==4 && this.status ==200){
						try{
							var data = JSON.parse(this.responseText);
							console.log(this.responseText);
						}catch{
							console.log(this.responseText);
							console.log("Error occured");
						}
				};
			}
		}
	</script>
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
	<span class="two-third" style="height:600px">
		<form>
		  <fieldset>
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
		  <fieldset>
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
		    <input id='ccv' type="number" name="" class="grey-input" style="height:25px"><br>

		  </fieldset>
		</form>
	</span>
	<span class="one-third" style="height:600px">
		<div style="width:90%;padding:10px;border:1px solid black;margin:auto;border-radius:5px;">
			<label style="font-size:20px;color:#008080">Your Basket</label>
			<hr>
			<div style="height:300px">
				<table style="width:100%;border:none" id='carttable'> 

				</table>
			</div>
			<table style="width:100%;border:none"> 
				<tr>
					<td>
						Total
					</td>
					<td id="total" style="text-align:right"></td>
				</tr>
			</table>
			<br><br>
			<center>
				<input type="button" class="teal-border-button" Value="Purchase" onclick="onPurchase()" style="width:80%;"><br><br>
			</center>
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
<div id='confirmPage' style="z-index:2;margin:auto;width:100%;height:100%;padding:0px;top:0px;right:0;position:absolute;background-color: white;opacity:0.9;display: none;">
	<center style="margin-top:10%">
		<h2  style="margin-bottom:15px">Tickets Confirmation</h2>
		<table id='tableConfirm' class="table" style="margin-bottom:15px">
			
		</table>
		<input type="" name="" value="Confirm" class="teal-button" style="width:100px;" onclick="onConfirm()">
		<input type="" name="" value="Cancel" class="red-button" style="width:100px" onclick="document.getElementById('confirmPage').style.display='none'; ">
	</center>
</div>
<div id='spinner' style="z-index:2;margin:auto;width:65%;height:100%;padding:0px;top:0px;position:absolute;background-color: white;opacity:0.9;display: none;">
	<center style="margin-top:20%">
		<h1 style="color:#008080;display:inline;">NTU|</h1>
		<h1 style="display:inline;">Cinematics</h1><br><br>
		<div class="spinner"></div><br>
		<p>Payment in progress...</p>
	</center>
</div>
</html>