var userlogin=null;
var userCartGlobal;
var userCartSize=0;
var executed=false;
var loginbox;

//aaron dropdown box
var userSelectionGlobal={"day":"", "date":"","cinema":"","time":"","movie":"","movieImage":"","tickets":""};
var obj = { 'seat_status': [],
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

function globalInit(){
	//Check if first time init()
	if(executed==false){
		//loginStatus();
		onClick(0,"current_movies","","",["MOVIE_ID","MOVIE_NAME"],'OPTION',"SelectMovie");
		executed=true;
	}
	userCartSize=0;
	userCartGlobal=localStorage.getItem('userCart');
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


// Main function call for async communications at HTML element
function onClick(index,table_name, condition, element,return_column,element_tag,output_container){
	//console.log('SELECT '+ return_column + ' FROM '+ table_name + ' WHERE ' + condition + '=' + element.value);
	try{
		if(check_repeated(index)){ // Status check if segment's dropdown has been selected before, if so -> reset dependent dropdowns
			console.log('selected array', obj.selected_array); //sanity check
			obj.setUniqueID(index, element.value); // update Unique_ID 'onclick' where index is reference segment to add or update
			//=====================================================================//
			//Handle date-time unique states with unique id  - YET TO ADD DATE
			if(output_container=="SelectTime"){
				condition="UNIQUE_ID"
				value=obj.getUniqueID();
				getData(index, table_name, condition, value, return_column, element_tag ,output_container); // Main Web Server Call
			}else{
				getData(index, table_name, condition, element.value, return_column, element_tag ,output_container); // Main Web Server Call
			}
			//=====================================================================//
			//Prep and save selection
			console.log('selection',element[String(element.value).slice(2)].textContent);
			updateUserSelection(index,element[String(element.value).slice(2)].textContent);
		}
		console.log("Check element id",element.id);

	}catch(e){
		console.log('You my only exception: ',e);
	}
}


//Main Server Call - via AJAX
function getData(index, table_name, condition, value, return_column=["",""], element_tag, output_container){
	var ajax = new XMLHttpRequest();
	var datainput =  new FormData();
	var method = "POST";
	var url = "./php/data.php";
	var asynchronous = true;
	// Add data into packet
	datainput.append("table_name", table_name);
	datainput.append("condition", condition);
	datainput.append("value", value); 
	datainput.append("return_column", return_column);
	//For posting
	ajax.open(method, url, asynchronous);	
	ajax.send(datainput);			
	//For receiving response from data.php
	 ajax.onreadystatechange= function(){
		if(this.readyState==4 && this.status ==200){
			try{
			var data = JSON.parse(this.responseText);
			console.log('data',data);
			//callback.apply(data, output_container, element_tag);
			}catch{
			data = this.responseText
			console.log(this.responseText);
			}
			// -----  END OF CALL & RESPONSE -----			
			// case handling - SEND UNIQUE ID TO DB, GET SEAT STATUS, ALL OTHER CASES
			key_list=Object.keys(data[0]);
			var temp_value=[];
			var indexNum=0;
			// If retrieving Unique_ID - update (output_container)element's  value attribute to the resultant UNIQUE_ID for parameter parsing on next data call
			if(return_column[0]=="UNIQUE_ID"){
				console.log("Unique_ID = ",obj.getUniqueID());
				return;
			} 
			// if retrieving seat value & status -> for every result in response -> add a button element with corresponding seat value and status 
			else if (return_column[0]=="SEAT_NO"){
				for (element in data){
					// also update status in obj storage
					obj.insert_seat_status(data[element][key_list[0]], data[element][key_list[1]]); 
				}
			}else{
				for (element in data){
					//if value not repeated
					if(temp_value.includes(data[element][key_list[0]])==false) {
						temp_name=data[element][key_list[1]];
						//if "Select Date" Container get current and next date 
						if(output_container=="SelectDate"){
							temp_name=setDate(indexNum);
							indexNum++;
						}
						//if "Select Time" Container get time from time attribute in container 'obj' 
						if(output_container=="SelectTime"){
							temp_name=data[element][key_list[1]];
						}
						//create the element in html
						add_element(element_tag, data[element][key_list[0]],temp_name, output_container);
						//add to the 'done' list
						temp_value.push(data[element][key_list[0]]);
					}
				}
			}
			//Case end
		};
	}
}

// used to add an element into chosen container id
function add_element(element_tag,element_value,element_name, output_container, optional_arg=''){
		var x = document.createElement(element_tag);
		x.setAttribute("value", element_value);
		var t = document.createTextNode(element_name);
		x.appendChild(t);
	    document.getElementById(output_container).appendChild(x);
	    return x;
}

// Recursively delete child node of selected parent node and reset to default html
function reset_element(elementId){
	// Removes an element from the document
	var myNode = document.getElementById(elementId);
	while (myNode.lastChild && myNode.children.length>0) {
		    myNode.removeChild(myNode.lastChild);
	}
	myNode.innerHTML="<option disabled selected value> -- reselect again -- </option>";
}

// Used to replace selected segment in UNIQUE_ID string upon reselection in dropdown
function check_repeated(index){
	if(index>0){
		if((obj.selected_array).includes(index)){ // if index(particular dropdown with this.index) has been selected before - aka inside selected_array container
			console.log("ELEMENTS", obj.selected_array);
			element_reset = obj.selected_array.slice(index);
			console.log("ELEMENT RESET", element_reset);
			while(element_reset.length > 0){ 
				element=element_reset.shift()
				console.log('DELETED OBJECT', obj.element_id[element]);
				reset_element(obj.element_id[element]);
			}
			obj.selected_array=obj.selected_array.slice(0,index);
			if (index<4){
				obj.selected_array.push(index+1);
			}
			return true;
		}else{
			obj.selected_array.push(index);
			if(index<4){
				obj.selected_array.push(index+1);
			}
			return true;				
		}
	}else{
		return true;
	}
}

//used to get a date with respect to current date: return value = current date + index -> increment of current date
function setDate(index){
	var current_date = new Date();
	var new_date = new Date();
	new_date.setDate((current_date.getDate())+index);
	new_date = new_date.toISOString().slice(0,10);
	return new_date
}
function updateUserSelection(index,value){
	if(index==1){
		userSelectionGlobal['movie']=value;
		userSelectionGlobal['movieImage']="./img/"+value+".jpg";

	}else if(index==2){
		userSelectionGlobal['cinema']=value;
	}else if (index==3){
		let day = new Date(value).getDay();
		userSelectionGlobal['date']=value;
		userSelectionGlobal['day']=day;
	}else if (index==4){
		userSelectionGlobal['time']=value;
	}
	console.log('updates',userSelectionGlobal);
}
function resetUserSelection(index){
	if(index==1){
		userSelectionGlobal['movie']='';
		userSelectionGlobal['movieImage']='';

	}else if(index==2){
		userSelectionGlobal['cinema']='';
	}else if (index==3){
		//let day = new Date(value).getDay();
		userSelectionGlobal['date']='';
		userSelectionGlobal['day']='';
	}else if (index==4){
		userSelectionGlobal['time']='';
	}
	console.log('updates',userSelectionGlobal);
}

function storeSend(){
	console.log('ID',obj.getUniqueID());
	localStorage.setItem('UniqueID', JSON.stringify(obj.getUniqueID()));
	localStorage.setItem('userSelection',JSON.stringify(userSelectionGlobal));
	//window.location.href = './checkout.html';
	window.open('./checkout.html');
}

setInterval(globalInit,1000);



