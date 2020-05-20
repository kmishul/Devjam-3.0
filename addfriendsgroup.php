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
<html>
<head><title> addfriendgroup</title>
  <link rel="stylesheet" type="text/css" href="css/addfriendsgroup.css">
</head>
<body class="body">
  <div class="headerstrip"><h1 class="h1"><img src="images/SplitZ_logo.png" class="logo">SPLITZ</h1></div><br><br><center>
  <center>
                <buttton class="button"><a href="profile.html" class="link">HOME</a></buttton>
        

</center>
<div class="divstyle">
    
<form action="addexpense.php" method="POST">
<h1 class ="h2"> YOUR GROUPS</h1>
<p class="p">Start a New Group
<input type="text" name="groupname" placeholder="Enter Group Name"></p>
<center><button class="addbutton"> + ADD A GROUP</button></center></form>
</div>
    <div class="divstyle">
    
<form action="addexpense.php" method="POST">
<h1 class ="h2"> ADD EXPENSES</h1>

<select  name="month" required>
                      <option value="Jan">January</option>
                      <option value="Feb">February</option>
                      <option value="Mar">March</option>
                      <option value="Apr">April</option>
                      <option value="May">May</option>
                      <option value="Jun">June</option>
                      <option value="Jul">July</option>
                      <option value="Aug">August</option>
                      <option value="Sep" selected>September</option>
                      <option value="Oct">October</option>
                      <option value="Nov">November</option>
                      <option value="Dec">December</option>
                      </select>

<p class="p"> Enter Amount
<input type="numeric" name="" placeholder="Enter Amount"></p>
<center><button class="addbutton"> + ADD </button></center></form>
</div>



<footer >
    <div class="footerstrip" >
   <h1 class="h22">Copyright &copy; SplitItUp Inc.</h1>
    </div>
  </footer>



</body>
</html>
  