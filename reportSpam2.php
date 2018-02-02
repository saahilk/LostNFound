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
$vname=','.$_SESSION['user_id'].',';
$refno = filter_var($ind, FILTER_SANITIZE_NUMBER_INT);
$sql3= "UPDATE Blog SET vote=vote+1  WHERE refno=".$refno;
mysqli_query($conn,$sql3);
if (strpos($ind, 'Yes') !== false) {

    $sql= "UPDATE Blog SET spamcount=spamcount+1  WHERE refno=".$refno;
    if($conn->query($sql)===TRUE)
    {
        echo 'Marked as Spam';
    }
    $sql2= "INSERT INTO votecount (postNo,userId)  VALUES  ('".$refno."','".$_SESSION['user_id']."')";
    if($conn->query($sql2)===TRUE)
    {
        
    }

}
else {
  $sql= "INSERT INTO votecount (postNo,userId)  VALUES  ('".$refno."','".$_SESSION['user_id']."')";
  if($conn->query($sql)===TRUE)
  {
      echo 'Thanks for voting';
  }
}
 ?>

 <br />
 <br />
 <a href="index.php">Back to feed</a>