<!DOCTYPE html>
<html>
<?php
	if (!isset($_SESSION)){
		session_start();
	}
	if(isset($_SESSION["useraccount"])){
		unset($_SESSION["useraccount"]);
		header("Location: http://localhost:1234/ntucinematics/index.php"); /* Redirect browser */
		exit();
	}

?>
<head>
	<title></title>
</head>
<body>
sadasd
</body>
</html>


