<?php
  
  session_start();

  if(!isset($_SESSION["username"]))
    {
      header('location: index.html');
    }
  $fname = $_SESSION["fname"];
  $array = unserialize($_SESSION["gnames"]);
?>

<!DOCTYPE html>
<html lang="en">
<head><title>FRIENDS GROUP</title>
	<link rel="stylesheet" type="text/css" href="css/friendgroup.css">
</head>
<body class="body">
	<div class="headerstrip"><h1 class="h1"><img src="images/SplitZ_logo.png" class="logo">SPLITZ</h1></div>
	<br><br>
<center>
                <buttton class="button"><a href="profile.html" class="link">HOME</a></buttton>
           <buttton class="button"><a href="addfriendsgroup.html" class="link">ADD EXPENSES</a></buttton>

</center>
<br><br>

		<center>
			<div class="divstyle">
				<button class="button"><a href="dashboard.html" class="link"> GO BACK TO DASHBOARD</a></button>
<form action="addgroup.php" method="POST">
<center><h1 class="h1"> YOUR GROUP   </h1></center>
<p class="p">Add a New Group
 <input type="text" name="groupname" class="form-control" placeholder="Give A Name To Your Group" required/></p>
  <button type="submit" name="add" class="addbutton" value="addgroup">Add To Your Friends Groups</button> 
</form></div>
<div class="divstyle">
<form action="addgroup.php" method="POST">
<p class="p">Remove a Group
	<input type="text" name="removed" class="form-control" placeholder="Name Of Group You Want To Remove/Leave" required/></p>
 <button type="submit" name="remove" class="removegroup" value="addgroup">Remove/Leave Group</button></p>
</div></form>


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


<footer >
    <div class="footerstrip" >
   <h1 class="h22">Copyright &copy; Splitz Inc.</h1>
    </div>
  </footer>

	</body>
	</html>