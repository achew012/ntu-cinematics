//const seats=[true,true,true,false,false,true,true,true,false,false,true,true,true,false,false,true,true,true,false,false,true,true,true,false,false,true,true,true,false,false];
//const seats =JSON.parse(localStorage.getItem('seatStatus'));

var obj = { 
			'seat_status': [],
			'element_id': {'1':'SelectMovie', '2':'SelectCinema','3':'SelectDate', '4':'SelectTime'}, 
			'selected_array':[],
			'timelist':['10:30','14:30','16:45','18:30'],
			'seg': ['','','',''],
			'userSelection':[],
			'getUniqueID': function (){
				return this.seg[0]+this.seg[1]+this.seg[2]+this.seg[3];
			},
			'reset_timelist': function () {
				obj.timelist = ['11:30','15:30','17:45','19:30'];
			},
			'setUniqueID': function (index, code) {
				this.seg[index-1]=code;
			},
			'getTime': function () {
				if(this.timelist.length<1){this.reset_timelist();} 
				value = this.timelist.shift(); 
				return value;},	
			'insert_seat_status': function (index, status){
				this.seat_status["S"+index]=status;
			} 
		}; 

var userSelection= JSON.parse(localStorage.getItem('userSelection'));
var userCart=localStorage.getItem('userCart');
var ID = localStorage.getItem('UniqueID');
var choosenSeats=[];
var userCartArray=0;
var isExist=false;//if the user select this timing and movie before
onInit();
function onInit(){
	isExist=false;
	getData("unique_seats",userSelection.time, ID, 'SEAT_NO');
	if(userCart=='null'||userCart==null||userCart==''){
		userCart=[];
		console.log('Empty cart',userCart);
		userCart.push(userSelection);
		userCartArray=userCart.length-1;
		console.log("No existing selection: index array=",userCartArray);
	}else{
		userCart=JSON.parse(userCart);
		console.log('Full cart',userCart);
		isExist=false;
		for(let i=0;i<userCart.length;i++){
			if(!isExist&&userCart[i].cinema==userSelection.cinema&&userCart[i].day==userSelection.day&&userCart[i].time==userSelection.time){
				console.log('Exist selection: indexarray = ',i);
				userCartArray=i;
				isExist=true;
			}
		}
		if(!isExist){
			userCart.push(userSelection);
			userCartArray=userCart.length-1;
			console.log("No existing selection: index array=",userCartArray);
		}
	}
	
	console.log('Existing userSelection',userSelection);
}
function populateTable() {
	const table = document.getElementById('table');
	const movieImage=document.getElementById('movieImage');
	const movie=document.getElementById('movie');
	const instruction=document.getElementById('instruction');
	const selectedMovie=document.getElementById('selectedMovie');
	const quantity = document.getElementById('quantity');
	const total = document.getElementById('total');
	quantity.innerText='x 0';
	total.innerText='$0.00';
	movie.innerHTML=userSelection.movie;
	selectedMovie.innerHTML=userSelection.movie;
	instruction.innerHTML= "Showing on :"+userSelection.date+"<br>Time :"+userSelection.time+"hrs <br>Venue: "+userSelection.cinema.toUpperCase();
	movieImage.src=userSelection.movieImage;
	console.log("checkimage",userSelection.movieImage);

  	//This is the code to populate the seats
  	console.log("my load",obj.seat_status);
  	for(let i =0;i<obj.seat_status.length;i++){
  		var td=document.getElementById(i);
  		td.innerText=i;
  		console.log(obj);
  		if(obj.seat_status[i]==1){
  			td.classList.add('available');
  		}else{
  			td.classList.add('taken');
  		}
  		
  	}
  	//This is the code to check if user selected the seats before
  	if(userCart[userCartArray].tickets!=''){
  		console.log("Not running");
  		for(let i=0;i<userCart[userCartArray].tickets.length;i++){
	  		choosenSeats.push(userCart[userCartArray].tickets[i]);
	  		var td=document.getElementById(userCart[userCartArray].tickets[i]);
	  		td.classList.remove('available');
	  		td.classList.add('choosen');	
	  	}
  	}
  	quantity.innerText='x '+choosenSeats.length;
	total.innerText='$'+choosenSeats.length*12+".00";
};

function repopulateTable() {
	const table = document.getElementById('table');
	const movieImage=document.getElementById('movieImage');
	const movie=document.getElementById('movie');
	const instruction=document.getElementById('instruction');
	const selectedMovie=document.getElementById('selectedMovie');
	const quantity = document.getElementById('quantity');
	const total = document.getElementById('total');
	quantity.innerText='x 0';
	total.innerText='$0.00';
	movie.innerHTML=userSelection.movie;
	selectedMovie.innerHTML=userSelection.movie;
	instruction.innerHTML= "Showing on :"+userSelection.date+"<br>Time :"+userSelection.time+"hrs <br>Venue: "+userSelection.cinema.toUpperCase();
	movieImage.src=userSelection.movieImage;
	console.log("checkimage",userSelection.movieImage);
	//Remove all classlist
	for(let i =0;i<obj.seat_status.length;i++){
  		var td=document.getElementById(i);
  		td.innerText=i;
  		console.log(obj);
  		td.classList.remove('available');
  		td.classList.remove('taken');
  		td.classList.remove('choosen');
  		console.log("TD class",td.classList);
  		
  	}

  	//This is the code to populate the seats
  	console.log("my load",obj.seat_status);
  	for(let i =0;i<obj.seat_status.length;i++){
  		var td=document.getElementById(i);
  		td.innerText=i;
  		console.log(obj);
  		if(obj.seat_status[i]==1){
  			td.classList.add('available');
  		}else{
  			td.classList.add('taken');
  		}
  		
  	}

  	quantity.innerText='x '+choosenSeats.length;
	total.innerText='$'+choosenSeats.length*12+".00";
	console.log("Checkcoosenseats",choosenSeats)
};

function onSeatClick(element){
	if(obj.seat_status[element.id]==1){
		if(element.classList[0]=='available'){
			//User's chose the seat
			choosenSeats.push(element.id);
			element.classList.remove('available');
			element.classList.add('choosen');
			quantity.innerText='x '+choosenSeats.length;
			total.innerText='$'+choosenSeats.length*12+".00";

		}else{
			//User's UNchose the seat
			var index = choosenSeats.indexOf(element.id);
			if (index !== -1) {
				choosenSeats.splice(index, 1);
			}
			quantity.innerText='x '+choosenSeats.length;
			total.innerText='$'+choosenSeats.length*12+".00";
			element.classList.remove('choosen');
			element.classList.add('available');
		}
	}
	console.log("Userselection",userSelection);
	console.log("choosenseats",choosenSeats);
	updateCart();
	globalInit();
}
function onCheckOut(){
	if(choosenSeats.length>0){
		updateCart();
		window.location.href="./cart.php"
	}else{
		alert("You must choose at least 1 seat to checkout!");
	}
	
}

function updateCart(){
	//Check if user select this 
	console.log("Is user selection exist: ",isExist);
	temp={"day":userSelection.day, "date":userSelection.date,"cinema":userSelection.cinema,"time":userSelection.time,"movie":userSelection.movie,"movieImage":userSelection.movieImage,"tickets":choosenSeats,"uniqueID":ID};
	userCart[parseInt(userCartArray)]=temp;
	console.log('updated cart',userCart);
	console.log(parseInt(userCartArray));
	localStorage.setItem('userCart',JSON.stringify(userCart));
	updateCartCountDisplay();

}
function updateCartCountDisplay(){
	var userCartSize=0;
	var userCartGlobal=localStorage.getItem('userCart');
	if(userCartGlobal=='null'||userCartGlobal==null||userCartGlobal==''||userCartGlobal.length==0){
		console.log('Empty cart',userCartGlobal);
	}else{
		try{	
			userCartGlobal=JSON.parse(userCartGlobal);
			for(let x=0;x<userCartGlobal.length;x++){
				userCartSize+=userCartGlobal[x].tickets.length;
			}
			console.log(userCartSize)
			console.log('Full cart',userCartGlobal);
		}catch(e){
			console.log("UserCart error",e);
		}
	}
	document.getElementById('dot').innerHTML=userCartSize;
}
function clearCart(){
	//Check if user select this
	if(choosenSeats!=[]){
		console.log("Is user selection exist: ",isExist);
		choosenSeats=[];
		temp={"day":userSelection.day, "date":userSelection.date,"cinema":userSelection.cinema,"time":userSelection.time,"movie":userSelection.movie,"movieImage":userSelection.movieImage,"tickets":choosenSeats,"uniqueID":ID};
		userCart[parseInt(userCartArray)]=temp;
		console.log('My updated cart',userCart);
		repopulateTable();
		localStorage.setItem('userCart',JSON.stringify(userCart));
		updateCartCountDisplay();
	}else{
		console.log("No seats selected")
	} 
}

//getData("unique_seats",['UNIQUE_ID','TIMESTAMP'], ID, 'SEAT_NO')
//Main Server Call - via AJAX
function getData(table_name, timestamp, value, condition){
	var ajax = new XMLHttpRequest();
	let datainput =  new FormData();
	var method = "POST";
	var url = "./php/dataCheckout.php";
	var asynchronous = true;

	//value=value.slice(3,value.length-1);

	datainput.append("table_name", table_name);
	datainput.append("TIMESTAMP", timestamp);
	datainput.append("condition", condition);
	datainput.append("ID", value); 
	
	//For posting
	ajax.open(method, url, asynchronous);	
	ajax.send(datainput);
		
	//For receiving response from data.php
	ajax.onreadystatechange= function(){
		if(this.readyState==4 && this.status ==200){
			try{
				var data = JSON.parse(this.responseText);
			}catch{
				console.log(this.responseText);
				console.log("Error occured");
			}
			if(data){
				for(let i=0;i<30;i++){
					if(data.includes(""+i)){
						obj.seat_status.push(0);
					}else{
						obj.seat_status.push(1);
					}
				}
				console.log("SEAT STATUS", obj.seat_status);
			}else{
				for(let i=0;i<30;i++){
					obj.seat_status.push(1);
				}
			}
				populateTable();
		};
	}
}


