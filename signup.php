<?php

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $username=$psw="";
    $bday = $_POST["bday"];
    $a1 = array();
    $a = serialize($a1);
    $confirm_password = "";
    $err="";


    $con = mysqli_connect('localhost','root','');     //hostname, username(default - root)
                                                                     
    if(!$con || !mysqli_select_db($con,'testdb'))
    {
        echo "Database Couldn't Be Connected";
        header("refresh:0; url= index.html");
    }

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(empty(trim($_POST["username"]))){
            $err = "Please enter a username.";
        }
        else{
            // Prepare a select statement
            $sql = "SELECT username FROM info WHERE username = ?";
            
            if($stmt = mysqli_prepare($con, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                // Set parameters
                $param_username = trim($_POST["username"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $err = "This username is already taken.";
                    } else{
                        $username = trim($_POST["username"]);
                    }
                } 
                else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            mysqli_stmt_close($stmt);
        }

        if(empty(trim($_POST["psw"]))){
            $err = "Please Enter A Password.";     
        } elseif(strlen(trim($_POST["psw"])) <= 6){
            $err = "Password must have atleast 6 characters.";
        } else{
            $psw = trim($_POST["psw"]);
        }

        if(empty(trim($_POST["cpsw"]))){
            $err = "Please Confirm password.";     
        } else{
            $confirm_password = trim($_POST["cpsw"]);
            if(empty($err) && ($psw != $confirm_password)){
                $err = "Confirm Password did not match.";
            }
        }

        if(empty($err))
        {
            $sql = "INSERT INTO info (username, psw, email, fname, lname, bday, gnames ) VALUES (?, ?, '$email', '$fname', '$lname', '$bday', '$a')";
         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($psw, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                 
                 echo '<script type="text/javascript">
                  alert("Signed Up Successfully :)");
                </script>';
                header("refresh:0; url = index.html");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
        }
        else{
        echo $err;
        echo "Go Back To HomePage";
        header("refresh:2; url= index.html");
        }

        mysqli_close($con);
        
        header("Location:index.html");

    }

  

?>





<!--<html>
<head><title>Sign up page</title>
<link rel="stylesheet" type="text/css" href="css/style1.css">
</head>
<body class="body">
<div class="headerstrip">
<h1 class="h1"><img src="images/Splitz_logo.png" class="logo"><center> SPLITZ</center></h1>
</div><br><center>
        <button type="link" class="homebutton" onclick="window.location.href = 'index.html'"> HOME</button>  
<div class="divstyle">
<form action="signup.php" method="POST">
<center><h1 class ="h1"> JOIN US   </h1></center>
<p class="p">First Name
<input type="text" name="fname" placeholder="First Name">
<p class="p">Last Name<input type="text" name="lname" placeholder="Last Name"></p>
<p class="p">UserName
<input type="text" name="username" placeholder="Enter Username"></p>
<p class="p">Password
<input type="password" name="psw" placeholder="Password"></p>
<p class="p">Confirm Password
<input type="password" name="cpsw" placeholder="Confirm password"></p>
<p class="p">E-mail id 
<input type="text" name="email" placeholder="Enter valid E-mail"></p>
<p class="p">Date of Birth
<input type="numeric" name="bday" placeholder="DOB"></p>
<button class="button">SIGN UP</a></button></p>
</div>
</form>
<br><br><br>
<footer >
    <div class="footerstrip" >
   <h1 class="h22">Copyright &copy; Splitz.in</h1>
    </div>
  </footer>
</body>
</html>