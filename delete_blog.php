<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$db="SEPROJ";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

//Check connection
// if ($conn) {
// 	echo "Connected-successfully";
// }

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$ind=''.array_keys($_POST)[0];
$sql= "DELETE FROM Blog WHERE refno=".$ind;
if($conn->query($sql)===TRUE)
{
    echo "Record deleted";
    header('Location:http://localhost/SEPROJ/index.php');
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>

<a href="index.php">Back to feed</a>