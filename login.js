var loginInfo = {
	'userid': "nth",
	'name': "nth",
	'password': "nth" , 
	'email': "nth",
	'cardno': "nth",
	'address': "nth",
	'ccv': "nth",

}

var dataIn = function (responseText){
	localStorage.setItem("loginInfo", responseText); 
	console.log("SENT TO STORAGE", responseText);
	window.open('./useraccount.html');	
}

function sendData(table_name, array, dataIn) {
    // Do the usual XHR stuff
  	return new Promise(function(resolve, reject) {
		var ajax = new XMLHttpRequest();
		let datainput =  new FormData();
		var method = "POST";
		var url = "./php/login.php";
		var asynchronous = true;

		// Add data into packet
		password=array[0];
		email=array[1];

		datainput.append("table_name", table_name);
		datainput.append("password", password);
		datainput.append("email", email);

			//For posting
		ajax.open(method, url, asynchronous);
		// Make the request
		ajax.send(datainput);

	  // Return a new promise.
		ajax.onreadystatechange = function () {
			if (this.readyState==4 && this.status==200){
			    //return dataIn(this.responseText);
				try{
					var data = JSON.parse(this.responseText);
					for(let i=0;i<data.length;i++){
						userdata=""+ data[i].userid +","+ data[i].name +","+ data[i].password +","+ data[i].email +","+ data[i].cardno +","+ data[i].address +","+ data[i].ccv +","+ data[i].registerdate;
					}
					resolve(JSON.stringify(userdata));
			    		//var response = JSON.stringify(this.responseText);
					}catch{
						alert ("Data Not Found. Unknown Username/Password");
					}
				}
			} 
		
	});
}




function onlogin(){
	var email = checkemail();
	var password= checkpassword();
	//Check if there are still any mistakes before sending to DB
	var checkinput= [password, email];
	if(checkinput.includes(false)){
		alert('Try Again! Please check if your information is keyed correctly.');
	} else{
			//window.location.href = './useraccount.html';
			//sendData('user_accounts', checkinput, dataIn);
			
			sendData('user_accounts', checkinput).then(function(value) { 
			  console.log("Completed",value);
			  localStorage.setItem("loginInfo", value);
			  // expected output: "responseText"
			  location.href = "./useraccount.php";	
			});
		}
}



function checkemail(){
	var regex=/^([\w.-_]+)(\@)([A-Za-z]{2,})(\.{1}[A-Za-z]{2,}){1,3}$/;
	input=document.getElementById('email').value;
	console.log('email: ', input);
	if(regex.test(input)){
		return input;
	}else{
		alert('Email Invalid. Please enter email again.');
		return false;
	}
}

function checkpassword(){
	var regex=/^[A-Za-z0-9]{6,}$/;
	input=document.getElementById('password').value;
	console.log('password: ', input);
	if(regex.test(input)){
		return input;
	}else{
		alert('Password too short. Please try again.');
		return false;
	}
}

