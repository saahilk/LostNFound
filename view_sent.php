<!DOCTYPE html>
<html>
<head>

<style>

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}



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
   margin:5px;
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

    <div>
    <div style="float:left;" ><h2 align="left">Sent Messages</h2></div>
  <div style="float:right;margin-right:15px;"><a  href='view_msg.php'><button class="subButton"><b>Check Inbox</b></button></a></div>
    <br><br><br>
  </div>
  <br>
    <?php

      $sql="SELECT User.ID,timestamp,reciever,name,text FROM message,User WHERE sender='".$_SESSION['user_id']."' AND message.reciever=User.ID ORDER BY message.ID DESC";
      $result=mysqli_query($conn,$sql);
      if($result) {
        echo "<table>
          <tr>
            <th>Reciever</th>
            <th>Content</th>
            <th>Time</th>
            <th>Message</th>
          </tr>";
        if(mysqli_num_rows($result)>0) {
          while($row = mysqli_fetch_assoc($result)) {
              $owner_id=$row['ID'];

              echo '<tr>
                <td>'.$row['name'].'</td>
                <td>'.$row['text']."</td>
                <td>".$row['timestamp'].'</td>
                <td><form method="post" action="send_msg.php" >
                <input name="'.$owner_id.'" type="hidden" >
            <input style="position:relative;right:-31%;"class="subButton" type="submit" name="'.$row['timestamp'].'" value="Message">
            </form></td>
              </tr>';
            
          }
        }
      }
      echo "</table>";


    ?>
  </div>
</center>
</body>
</html>