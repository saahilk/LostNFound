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

if($_SESSION['user_id']=="")
{
  header('Location:http://localhost/SEPROJ/login.php');
}


$tim=''.date("h:ia d M Y ");
$sql= "INSERT INTO Blog(text,owner,timestamp) VALUES ('".$_POST['blogdesc']."','".$_SESSION['user_id']."','".$tim."')";
if($conn->query($sql)===TRUE)
{
    echo "New record created successfully";
    header('Location:http://localhost/SEPROJ/index.php');
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>

<a href="index.php">Back to feed</a>