<?php

    session_start();     // Start session to use superglobal $_SESSION

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
     echo "<script> alert(Already Logged In :| :|) </script>";
     
	  header("refresh:0; url= profile.php");
	  
	  
  }else{

    $username = $psw = "";
    $err = "";
    $param_username=$hashed_password=$id="";

    $con = mysqli_connect("localhost","root","","testdb");

    if(!$con )
    {
        echo "Database Couldn't Be Connected";
    }

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

        if(empty(trim($_POST["username"])))
        {
              $err = "Please enter Username. Go Back To Homepage";
        } 
        else
        {
             $username = trim($_POST["username"]);
        }

        if(empty(trim($_POST["psw"])))
        {
          $err = "Please enter your password. Go Back To Homepage";
        } 
        else
        {
          $psw = trim($_POST["psw"]);
        }

        if(empty($err))
        {
          $sql = "SELECT username, psw FROM info WHERE username = ?";

          if($stmt = mysqli_prepare($con, $sql))
          {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = $username;
            if(mysqli_stmt_execute($stmt))
            {
              mysqli_stmt_store_result($stmt);
              // Check if username exists, if yes then verify password
              if(mysqli_stmt_num_rows($stmt) === 1)
              {   // Bind result variables
                  mysqli_stmt_bind_result($stmt,$param_username, $hashed_password);
                  if(mysqli_stmt_fetch($stmt))
                  {
                      if(password_verify($psw, password_hash($psw, PASSWORD_DEFAULT))){
						           // Password is correct, so start a new session
						          $query = "SELECT * FROM info WHERE username='$username' AND psw='$hashed_password'";
						          $result = mysqli_query($con, $query);
                          session_start();

                          $arr = mysqli_fetch_array($result);
                          
                          // Store data in session variables
                          $_SESSION["loggedin"] = true;
                          $_SESSION["username"] = $username;
                          $_SESSION["fname"] = $arr["fname"];
                          $_SESSION["lname"] = $arr["lname"];
                          $_SESSION["email"] = $arr["email"];
                          $_SESSION["bday"] = $arr["bday"];
                          $_SESSION["gnames"] = $arr["gnames"]; 
                  

                          mysqli_free_result($result);
                          // Redirect user to welcome page
                          echo '<script type="text/javascript">
                                alert("Logged In Successfully :)");
                                </script>';
                          header("refresh:0; url= profile.php");
                      } else{
                          // Display an error message if password is not valid
                          $err = "The password you entered is not valid. Go Back To Homepage"; 
                      }
                    }
                  }else{
                    // Display an error message if username doesn't exist
                    $err = "No account found with that username. Go Back To Homepage";
                  }
                }else{
                  $err= "Oops! Something went wrong. Please try again later.";
              }
            }
          }
          if(!empty($err))
          {
            echo "<script> alert('$err') </script>";
            
          }
          mysqli_close($con);


    }
  }


?>





<!--<html>

<head>

  <title>Log in </title>

  <link rel="stylesheet" type="text/css" href="css/style.css">



<body>
  <div class="headerstrip"><h1 class="h1"><img src="images/SplitZ_logo.png" class="logo">SPLITZ</h1></div>

<div class="loginbox">
<br>
<br>
<br>
<br>
<br>
  

  <h1>Login Here</h1>

    <form action="login.php" method="POST">

      

      <p>Username</p>

      <input type="text" name="username" placeholder="Enter Username">

      <p>Password</p>

      <input type="password" name="psw" placeholder="Enter Password">   

      <input type="submit" name="" value="Login">

    

      <a href="signup.html">Don't have an account?</a>

    </form>

 <button type="link" class="homebutton" onclick="window.location.href = 'index.html'"> Home</button>  
        
  </div>

</body>

</head>

</html>