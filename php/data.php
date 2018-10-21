<?php

$servername="localhost";
$dbusername="myuser";
$dbpassword="xxxx";
$dbname="user_data";

$table_name=$_POST["table_name"];
$condition=$_POST["condition"];
$value=$_POST["value"];
$return_column=$_POST["return_column"];


//create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if ($table_name==="current_movies"){
	$result = mysqli_query($conn, "SELECT*FROM " . $table_name);
} else if ($table_name==="unique_seats") {
	$result = mysqli_query($conn, "SELECT " .  $return_column . " FROM " . $table_name . " WHERE " . $condition . "=" . $value);
}else{
	if($condition==="UNIQUE_ID"){
		$result = mysqli_query($conn, "SELECT " .  $return_column . " FROM " . $table_name . " WHERE " . $condition . " LIKE " . "'%" . $value . "00%'");
	}else{
		$result = mysqli_query($conn, "SELECT " .  $return_column . " FROM " . $table_name . " WHERE " . $condition . "=" . $value);
	}
}

//$result = mysqli_query($conn, "INSERT INTO ". $table_name . "(" . $attribute_name . ")" . " VALUES (" . $value . ")");
//$result = mysqli_query($conn, "SELECT*FROM " . $table_name);

while($row = mysqli_fetch_assoc($result)){
	$data[]=$row;
}

//rray_unshift($data,$);

$conn->close();
echo json_encode($data);
?>

