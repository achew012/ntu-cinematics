function sendData(table_name, array){
		var ajax = new XMLHttpRequest();
		let datainput =  new FormData();
		var method = "POST";
		var url = "./php/register.php";
		var asynchronous = true;
		// Add data into packet
		name=array[0];
		password=array[1];
		email=array[2];
		address=array[3];
		cardno=array[4];
		ccv=array[5];
		cardtype=array[6];

		datainput.append("table_name", table_name);
		datainput.append("name", name);
		datainput.append("password", password);
		datainput.append("email", email);
		datainput.append("address", address);
		datainput.append("cardno", cardno);
		datainput.append("ccv", ccv);
		datainput.append("cardtype", cardtype);

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


function onRegister(){
	console.log('final input check: ');
	var name = checkname();
	var email = checkemail();
	var password1 = checkpassword();
	var password2 = checkpassword2();
	var address = checkaddress();
	var cardno = checkcardno();
	var ccv = checkccv();
	var cardtype= checkcardtype();
	var postalcode = checkpostalcode();
	//Check if there are still any mistakes before sending to DB
	var checkinput= [name, password2, email, cardno, address, ccv, cardtype, postalcode];
	console.log(checkinput);
	if(checkinput.includes(false)){
		
	} else{
		sendData('user_accounts', checkinput);
		window.location.href = './login.html';
		alert('Registration Successful!');
	}
}

function checkname() {
	var regex=/^[A-Za-z]{2,}$/;
	ele=document.getElementById('name');
	console.log(ele.value);
	if(regex.test(ele.value)){
		//alert('succeed');
		ele.style.border='1px solid #00B3B3';
		return ele.value;
	}else{
		alert('Name Error! Must be more than 2 characters');
		ele.style.border='1px solid #B91D47';
		return false;
	}
}

function checkemail(){
	var regex=/^([\w.-_]+)(\@)([A-Za-z]{2,})(\.{1}[A-Za-z]{2,}){1,3}$/;
	ele=document.getElementById('email');
	console.log(ele.value);
	if(regex.test(ele.value)){
		//alert('succeed');
		ele.style.border='1px solid #00B3B3';
		return ele.value;
	}else{
		alert('Email Invalid. Please enter email again.');
		ele.style.border='1px solid #B91D47';
		return false;
	}
}

function checkpassword(){
	var regex=/^[A-Za-z0-9]{6,}$/;
	ele=document.getElementById('password');
	console.log(ele.value);
	if(regex.test(ele.value)){
		ele.style.border='1px solid #00B3B3';
		return ele.value;
	}else{
		ele.style.border='1px solid #B91D47';
		alert('Error! Password must be at least 6 alpha-numeric characters');
		return false;
	}
}

function checkpassword2(){
	var regex=/^[A-Za-z0-9]{6,}$/;
	ele1=document.getElementById('password');
	ele2=document.getElementById('retypepassword');
	console.log(ele1.value);
	console.log(ele2.value);
	if(regex.test(ele1.value)){
		if(ele1.value==ele2.value){
			ele1.style.border='1px solid #00B3B3';
			ele2.style.border='1px solid #00B3B3';
			return ele1.value;			
		}else{
			alert('Password mismatched!');
			ele1.style.border='1px solid #B91D47';
			ele2.style.border='1px solid #B91D47';
			return false;
		}
	}else{
		ele1.style.border='1px solid #B91D47';
		ele2.style.border='1px solid #B91D47';
		alert('Error! Password must be at least 6 alpha-numeric characters');
		return false;
	}
}

function checkaddress(){
	var regex=/^[A-Za-z0-9]{5,}$/;
	ele=document.getElementById('address');
	console.log(ele.value);
	if(regex.test(ele.value)){
		ele.style.border='1px solid #00B3B3';
		return ele.value;
	}else{
		ele.style.border='1px solid #B91D47';
		alert('Address needs to be a minimum of 5 characters');
		return false;
	}
}

function checkcardno(){
	var regex=/^[0-9]{16}$/;
	ele=document.getElementById('cardno');
	console.log(ele.value);
	if(regex.test(ele.value)){
		ele.style.border='1px solid #b3b3b3';
		return ele.value;
	}else{
		ele.style.border='1px solid #B91D47';
		alert('Incorrect Card Number. Card Numbers must be 16 digits');
		return false;
	}	
}

function checkccv(){
	var regex=/^[0-9]{3}$/;
	ele=document.getElementById('ccv');
	console.log(ele.value);
	if(regex.test(ele.value)){
		ele.style.border='1px solid #b3b3b3';
		return ele.value;
	}else{
		ele.style.border='1px solid #B91D47';
		alert('Incorrect CCV. CCV Numbers must be 3 digits');
		return false;
	}	
}
function checkcardtype(){
	ele=document.getElementById('cardtype');
	console.log(ele.value);
	if(ele.value==""){
		ele.style.border='1px solid #B91D47';
		alert('Select card type');
		return false;
	}else {
		ele.style.border='1px solid #b3b3b3';
		return ele.value;
	}
		
}

function checkpostalcode(){
	const regex=/^[0-9]{6}$/;
	ele=document.getElementById('postalcode');
	console.log(ele.value);
	if(regex.test(ele.value)){
		ele.style.border='1px solid #b3b3b3';
		return ele.value;
	}else{
		ele.style.border='1px solid #B91D47';
		alert('Incorrect Postalcode. Must have 6 digits');
		return false;
	}
}