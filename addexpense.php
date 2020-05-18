<?php

   $con = mysqli_connect('localhost','root','');     //hostname, username(default - root)
                                                                     
    if(!$con || !mysqli_select_db($con,'testdb'))
    {
        echo "Database Couldn't Be Connected";
        header("refresh:1; url = profile.php");
    }

    else if(empty($_POST["gname"]) || empty($_POST["uname"]) || empty($_POST["month"]) || empty($_POST["amount"])){

        exit("One Or More Fields are Empty :( ");

    }
    else{
        session_start();
        $uname = $_SESSION["username"]; //Username
        $arr = $_SESSION["gnames"];       //Array of group names
        $gname = $_POST["gname"];
        $admin = $_POST["uname"];
        $month = $_POST["month"];
        $amount = $_POST["amount"];
        
        $table = $gname.$admin;

        $sql = "SELECT ".$month." FROM ".$table." WHERE member = '$uname' ";

        $result = mysqli_query($con, $sql);
        $a = mysqli_fetch_array($result);

        $present_value = $a["$month"];

        if($a){
           
          $value = (int)$present_value + (int)$amount;

          $sql1 = "UPDATE $table SET $month='$value' WHERE member='$uname' ";
          if(mysqli_query($con, $sql1)){
            echo '<script  type="text/javascript">alert("Amount Rs. '.$amount.' Added Successfully");</script>';
            header("refresh:0; url= friends.php");
          }
          else{
            echo '<script  type="text/javascript">alert("Error In Adding Expense, Check Entries");</script>';
          }

        }
        else{
          echo "THERE IS SOME ERROR :/ ";
          header("refresh:2; url= friends.php");
        }
        
       mysqli_close($con);


    }
    mysqli_close($con);



?>

