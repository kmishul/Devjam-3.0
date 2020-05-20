<?php
  
  session_start();

  if(!isset($_SESSION["username"]))
    {
      header('location: index.html');
    }

  $fname = $_SESSION["fname"];

?>

<!DOCTYPE html>
<html>
<head><title> FRIENDS</title>
	<link rel="stylesheet" type="text/css" href="css/friends.css">
</head>
<body class="body">
	<div class="headerstrip"><h1 class="h1"><img src="images/SplitZ_logo.png" class="logo">SPLITZ</h1></div>
     <hr style="display: block; margin-top: 50px; margin-right:auto; border-style: inset; border-width: 2px; border-color: #002266 ">
     <center>



<div class="exdivstyle">
		
<form action="addexpense.php" method="POST">
<h1 class ="h2"> ADD EXPENSES </h1>
<p class="p">Enter the Name of Group
<input type="text" name="gname" class="form-control" id="amount_entry" placeholder="Name of Group" required/></p>
<p class="p">Enter Admin Username
<input type="text" name="uname" class="form-control" id="amount_entry" placeholder="Admin of Group" required/></p>
<h2> Select Month</h2>
 <select class="custom-select form-control" name="month" required>
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



<p class="p">Enter Amount
<input type="text" name="amount" class="form-control" id="amount_entry" placeholder="Amount in INR" required/></p>

<center><button class="addbutton" name="add" type="submit" value="add"> + ADD </button></center></form>
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




<footer >
    <div class="footerstrip" >
   <h1 class="h22">Copyright &copy; Splitz Inc.</h1>
    </div>
  </footer>