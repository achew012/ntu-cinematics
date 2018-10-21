
// ARRAY FORMAT [userID, Name, Password, Email, Address, CardNo, CCV]
function login(){
	var Loginbox = localStorage.getItem("loginInfo");
	var userobject=JSON.parse(Loginbox);
	var userbox = userobject.split(',');
	//document.getElementById('accountinfo').innerHTML=userbox[0];
	//document.getElementById('accountinfo');
	return userbox;
}

function init(){
	userbox=login();
	if(userbox){
		document.getElementById('welcome').innerHTML="Welcome "+userbox[1]+"!";
		document.getElementById('username').innerHTML=userbox[3];
		document.getElementById('address').innerHTML=userbox[4];
		document.getElementById('cardno').innerHTML=userbox[5];
		document.getElementById('ccv').innerHTML=userbox[6];
		document.getElementById('regdate').innerHTML=userbox[7];
	}else{
		window.location.href = './login.html';
	}
}

window.onload=init();