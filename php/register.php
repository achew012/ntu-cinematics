<?php

	$servername="localhost";
	$dbusername="myuser";
	$dbpassword="xxxx";
	$dbname="user_data";

	//[name, password, email, address, cardno];
	$table_name=$_POST["table_name"];
	$name=$_POST["name"];
	$password=$_POST["password"];
	$email=$_POST["email"];
	$address=$_POST["address"];
	$cardno=$_POST["cardno"];
	$ccv=$_POST["ccv"];
	$cardtype=$_POST["cardtype"];
	$postalcode=$_POST["postalcode"];

	//create connection  


	$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
	$result = mysqli_query($conn, "select * from user_accounts where userid = '".sha1($email))."'";
	if($result->num_rows !=0){
		echo "failed";
	}else{
		$result = mysqli_query($conn, "INSERT INTO ". $table_name . "(userid ,name, password, email, cardno, address, ccv, cardtype,postalcode)" . " VALUES ('". sha1($email) . "','" . $name . "','" . $password . "','" . $email . "','" . $cardno . "','" . $address . "','" . $ccv ."','". $cardtype  ."','".$postalcode."');");
	}




		
	$conn->close();

?>

