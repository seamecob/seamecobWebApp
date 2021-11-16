<?php


//Open a new connection to the MySQL server
$mysqli = new mysqli('localhost', 'root', '', 'seamecob');

//Output any connection error
if ($mysqli->connect_error) {
    die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}


$email = mysqli_real_escape_string($mysqli, $_POST['email']);


//VALIDATION

if (strlen($email) <= 4) {
    echo 'eshort';
} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo 'eformat';
} 

else {
	
	//PASSWORD ENCRYPT
	//$spassword = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
	
	$query = "SELECT * FROM newsletter WHERE email='$email'";
	$result = mysqli_query($mysqli, $query) or die(mysqli_error());
	$num_row = mysqli_num_rows($result);
	$row = mysqli_fetch_array($result);
	
		if ($num_row < 1) {

			$insert_row = $mysqli->query("INSERT INTO newsletter (email) VALUES ('$email')");
			echo 'true';

			

		} else {

			echo 'false';

		}
		
}

?>