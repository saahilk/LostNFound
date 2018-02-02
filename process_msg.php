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
$ind=''.array_keys($_POST)[0];
echo $ind[0];
$sql="INSERT INTO message(timestamp,sender,reciever,text) VALUES('".$tim."','".$_SESSION['user_id']."','".$ind[0]."','".$_POST['msg']."')";
if($conn->query($sql)===TRUE)
{
    echo "Sent message";
    header('Location:http://localhost/SEPROJ/index.php');
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>

<a href="index.php">Back to feed</a>