<html>
<body> 

<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db="SEPROJ";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn) {
	echo "Connected-successfully";   
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if(isset($_POST['submit'])){
	$selected_val = $_POST['user_id'];  // Storing Selected Value In Variable
	$qry="SELECT * FROM User WHERE id=" . $selected_val;
	echo $qry;
	$result = mysqli_query($conn,$qry);
	
	$row  = mysqli_fetch_array($result);
	if(is_array($row)) {
		$_SESSION['user_id'] = $row['id'];
	} 
}
// echo $_SESSION['user_id']
?>

</body>
</html> 