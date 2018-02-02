<html>
<head>
		<meta name="google-signin-client_id" content="546058867792-7tqonu5kbtni0ird2s2bgi65mld9vqt0.apps.googleusercontent.com">
	<meta name="google-signin-hosted_domain" content="nitc.ac.in" />




<?php
// session_start();
// if(isset($_SESSION["user_id"]) && $_SESSION["user_id"]!= "")
// {
// 	$_SESSION["user_id"]= "";
// }
?>

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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script>
var i =0;
function onSignIn(googleUser) {

  var profile = googleUser.getBasicProfile();
  document.getElementById("emailval").value=profile.getEmail();
  document.getElementById("nameval").value=profile.getName();
  document.getElementById("signinform").submit();
  // $("#emailval").attr('value',profile.getEmail());
  // $("#nameval").attr('value',profile.getName());
	// console.log("22");
i=1;

}

function signOut() {

	var auth2 = gapi.auth2.getAuthInstance();
	auth2.signOut().then(function () {
		console.log('User signed out.');

	});

}

function signIN(){
	if(i==1)
	document.getElementById("signinform").submit();
}
</script>

</head>
<body style="padding:0;margin:0;font-family: arial, sans-serif;">
	<div class="navBar">
    <ul class="navItemList">
      <li><div class="navtitle"><a href="#"><b>Lost & Found</b></a></div></li>
      <li style="font-family: Verdana;float:right;margin-right:5px;">
				<form action="index.php" id="signinform" method="post" style="display:none">
		 	  	<input name="user_email" id="emailval" style="display:none" required/>
					<input name="user_name" id="nameval" style="display:none" required/>
		 	 </form>
			 <div class="g-signin2" data-onsuccess="onSignIn" onclick="signIN();"></div>

			</li>
      <!-- <li style="font-family: arial, sans-serif;float:right;margin-right:5px;">
				<form action="index.php" method="post">
		 	  	<select name="user_id">
		 			<option value="1">Saahil</option>
		 			<option value="2">Husni</option>
		 			<option value="3">Vinod P</option>
		 			<option value="4">Admin</option>
		 		</select>
		 	   	<input type="submit" name="submit" value="Submit">
		 	 </form>
			</li> -->


    </ul>
  </div>
<center>

	<div style="background-color: #FFFFFF;width:70%; id="feeds">

		        <h2 align="left">Latest Posts</h2>
        <hr>
        <br>
		<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$db="SEPROJ";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $db);

		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}


		$sql = "SELECT text,timestamp,name,owner,vote,refno FROM Blog,User WHERE Blog.owner=User.id ORDER BY refno DESC";
		$result = mysqli_query($conn,$sql);
		$flag = 0;

		if($result) {

		  if(mysqli_num_rows($result)>0) {
		    while($row = mysqli_fetch_assoc($result)) {
		      $flag++;
		      $desc = $row['text'];
		      $owner = $row['name'];
		      $owner_id=$row['owner'];
		      $time = $row['timestamp'];
		      $ref_no=$row['refno'];


					echo '
	      <div align="left" class="blog">
	        <div class="blogOwner">
	          <p><b>'
	            .$owner.'
	          </b></p>
	        </div>
	         <div class="blogTime">
	          <p style="font-size:12px">'
	            .$time.'
	          </p>
	        </div>
	        <br />
	        <div class="blogdesc">
	          <p>'
	            .$desc.'
	          </p>
	        </div>

	        </div>';
				}
			}
		}


?>

	</div>
	</center>
</body>
</html>