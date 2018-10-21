<?php

$servername="localhost";
$dbusername="myuser";
$dbpassword="xxxx";
$dbname="user_data";

$table_name=$_POST["table_name"];
$condition=$_POST["condition"];
$TIMESTAMP=$_POST["TIMESTAMP"];


//CONCAT DATE WITH TIMESTAMP
function datetime($date, $timeinput){
	$time = DateTime::createFromFormat('H:i:s', $timeinput);
	$merge=$date->format('Y-m-d') . ' ' . $timeinput;
	return $merge;
}

//create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);


if ($condition=="updateSeats"){

	$ID = $_POST["ID"];
	$tickets = $_POST["tickets"];

	$fp = fopen('./log.txt', 'w');

	//MOVIE DATE + GIVEN TIMESTAMP	
	$datetime=datetime(new DateTime(), $TIMESTAMP);
	$result = mysqli_query($conn, "INSERT INTO ". $table_name . "(UNIQUE_ID, SEAT_NO, DATETIME) VALUES (" . $ID . ",'" . $tickets . "','" . $datetime . "')");

	fwrite($fp, "INSERT INTO ". $table_name . " (UNIQUE_ID, SEAT_NO, DATETIME) VALUES (" . $ID . ",'" . $tickets . "','" . $datetime . "')");
			
	fclose($fp);
	$conn->close();

} else {
	//$SEAT_NO=$condition;
	$ID=$_POST["ID"];
	//MOVIE DATE + GIVEN TIMESTAMP
	$datetime=datetime(new DateTime(), $TIMESTAMP);
	$result = mysqli_query($conn, "SELECT SEAT_NO FROM " . $table_name . " WHERE UNIQUE_ID = " . $ID . " AND DATETIME >= '" . $datetime . "'");
	
	while($row = mysqli_fetch_assoc($result)){
		$data[]=$row;
	}

	for ($i=0; $i<sizeof($data); $i++){
		$data_new[]=$data[$i]['SEAT_NO'];
	}

	$fp = fopen('./log.txt', 'w');
	fwrite($fp, "SELECT SEAT_NO FROM " . $table_name . " WHERE UNIQUE_ID = " . $ID . " AND DATETIME >= '" . $datetime . "'");
	fclose($fp);

	$conn->close();
	echo json_encode($data_new);
}



?>

