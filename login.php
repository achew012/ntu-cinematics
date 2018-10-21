<?php
	if (!isset($_SESSION)){
		session_start();
	}
	$servername="localhost";
	$dbusername="myuser";
	$dbpassword="xxxx";
	$dbname="user_data";

	//[name, password, email, address, cardno];
	$table_name=$_POST["table_name"];
	$password=$_POST["password"];
	$email=$_POST["email"];


	//create connection

	$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

	//$result = mysqli_query($conn, "INSERT INTO ". $table_name . "(name, password, email, cardno, address)" . " VALUES ('" . $name . "','" . $password . "','" . $email . "','" . $address . "','" . $cardno . "');");

	$result = mysqli_query($conn, "SELECT *" . " FROM " . $table_name . " WHERE (password, email) = ('" . $password . "' , '" . $email . "');");


	while($row = mysqli_fetch_assoc($result)){
		$data[]=$row;
	}

	if(!is_null($data)){
		$_SESSION["useraccount"]=json_encode($data);
		echo json_encode($data);
	}else{
		echo 'No result';
	}
		
	$conn->close();

?>

