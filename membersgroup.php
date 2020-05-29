<?php
  
  session_start();

  if(!isset($_SESSION["username"]))
    {
      header('location: index.html');
    }
  $fname = $_SESSION["fname"];
  $uname = $_SESSION["username"];
  
  $con = mysqli_connect('localhost','root','');     //hostname, username(default - root)
                                                                     
  if(!$con || !mysqli_select_db($con,'testdb'))
  {
      echo "Database Couldn't Be Connected";
      header("refresh:1; url = profile.php");
  }
  else{
      $sql = "SELECT gname FROM mastergrp WHERE username='$uname' ";
      $result = mysqli_query($con, $sql);
      if($result)
      {
          $arr = mysqli_fetch_array($result);

          $myarray = array_unique($arr,SORT_STRING);

      }
      else{
          echo "Error ....";
          header("refresh:2; url = friends.php");
      }


  }
  mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="en">
<head><title>MEMBERS GROUP</title>
	<link rel="stylesheet" type="text/css" href="css/membersgroup.css">
</head>
<body class="body" style="backround-color:navyblue;">
	<div class="headerstrip"><h1 class="h1"><img src="images/SplitZ_logo.png" class="logo">SPLITZ</h1></div>
	<br><br>
<center>
                <button class="logoutbutton" onclick="window.location.href = 'friends.php'" type="link">Go Back</button>
        <button type="link" class="logoutbutton" onclick="window.location.href = 'logout.php'"> Log Out</button>  

</center>
<br><br>

		<center>
			<div class="divstyle">
				<button class="button"><a href="dashboard.html" class="link"> GO BACK TO DASHBOARD</a></button>
				
<form action="addmember.php" method="POST">
<center><h1 class="h1"> YOUR GROUP   </h1></center>
<p class="p">Add a new member
<input type="text" name="membername" class="form-control" placeholder="Username Of Member" required/></p>
<p class="p">Group Name
 <input type="text" name="gname" class="form-control" placeholder="Name of Group" required/></p>
 <button type="submit" name="add" class="addbutton" value="addgroup">+ ADD </button>
<p class="p">Remove a member
	<input type="text" name="removed" class="form-control" placeholder="Name Of You Want To Remove" required/>
</p>
	<p class="p">Group Name
<input type="text" name="gname" class="form-control" placeholder="Name Of Group" required/></p>
<button type="submit" name="remove" class="removebutton" value="addgroup"> - REMOVE</button></p>
</div>

<div class="divstyle">
                     <br>
                     <br>
                     <h2 class="h2"><strong>Active Groups</strong></h1>
                     <?php
                     $myarray = array();
                     $myarray[] = unserialize($_SESSION["gnames"]);
                     
                      echo '<table class="table table-dark table-hover">';
                     $html = "";
                     foreach($myarray as $cell) {
                         
                         foreach ($cell as $row) {
                             $html .= "<tr>";
                             $html .= "<td>" . $row . "</td>";
                             $html .= "</tr>";
                         }
                     }
                     
                     $html .= "</table>";
             
                     echo $html;

                     ?>
                     </div>



</center>
</form>




<footer >
    <div class="footerstrip" >
   <h1 class="h22">Copyright &copy; Splitz Inc.</h1>
    </div>
  </footer>
	
	</body>
	</html>