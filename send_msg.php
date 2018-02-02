<!DOCTYPE html>
<html>
<head>

<style>


.navBar {
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #39B7CD;
    display: block;
    align-content: flex-start;
}
.navItemList{
  list-style-type: none;
}

.navItemList li {
    float: left;
}

.navItemList li a {
    display: block;
    color: white;
    text-align: center;
    padding: 0 16px;
    text-decoration: none;
}

/* Change the link color to #111 (black) on hover */
.navItemList li a:hover {

}
.navtitle{
  font-family: arial, sans-serif;
  color: white;
  text-align: center;
  padding: 0px 200px 14px 6px;
  margin-right: 200px;
  font-size: 20px;
  text-decoration: none;
}
.navtitle a:hover{

}

#feeds{
  align-content:center;

}
#feeds{
  border-style: solid;
  border-width: 0px;
  padding:10px;
  border-color: #333;
  border-radius: 15px;
  margin: 25px 50px;
}
.subButton{
  position: relative;
  margin-top:10px;
   font-weight: bold;
 background-color: #39B7CD;;
  border: none;
  color: #fff;
  border-radius: 15px;
  width: 100px;
  height: 40px;
  cursor: pointer;
}

.blogdel{
  margin-bottom:7px;
}

.blog{
  border-style: solid;
  border-width:1px;
  border-color: #DCDCDC;
  border-radius: 15px;
  margin-top:10px;
  padding:5px;
}

</style>
</head>

<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db="SEPROJ";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
// if ($conn) {
//   echo "Connected-successfully";
// }
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// $ind=''.array_keys($_POST)[0];
$ind=array_keys($_POST);
$sql="SELECT name,ID FROM User WHERE ID=".$ind[0];
$result=mysqli_query($conn,$sql);
$row  = mysqli_fetch_array($result);
if(is_array($row)) {
    $_SESSION['reciever'] = $row['name'];
    $_SESSION['reciever_ID'] = $row['ID'];
  }

if($_SESSION['user_id']=="")
{
  header('Location:http://localhost/SEPROJ/login.php');
}

?>

<body style="padding:0;margin:0;font-family: arial, sans-serif;">


  <div class="navBar">
    <ul class="navItemList">
      <li><div class="navtitle"><a href="index.php"><b>Lost & Found</b></a></div></li>
      <li style="font-family: arial, sans-serif;float:right;margin-right:5px;"><a href="login.php"><b>Logout</b></a></li>
      <li style="font-family: arial, sans-serif;float:right;margin-right:5px;"><a href="view_msg.php"><b>Messages</b></a></li>
      <li style="font-family: arial, sans-serif;float:right;margin-right:5px;"><a href="#"><b><?php echo $_SESSION['username'] ?></b></a></li>

    </ul>
  </div>

<center>

    <div id="feeds">

      <h2 align="left">Send Message</h2>
 	<?php

      echo '<h3 align="left">To: '.$_SESSION['reciever'].'</h3>';
      ?> 
        <div align="left">
          <form id="newBlog" action="process_msg.php" method="post">
          	<?php
          echo '<input name="'.$_SESSION['reciever_ID'].'" type="hidden" >';
          ?>
          <textarea id="text" maxlength="250" name="msg" rows="6" cols="100" placeholder="Write message here" required></textarea><br />
          <input class="subButton" type="submit" name="submit-msg" value="Send"/>
          </form>
        </div>


    </div>
</center>

 </body>
</html>

