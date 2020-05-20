<?php

   $con = mysqli_connect('localhost','root','');     //hostname, username(default - root)
                                                                     
    if(!$con || !mysqli_select_db($con,'testdb'))
    {
        echo "Database Couldn't Be Connected";
        header("refresh:1; url = profile.php");
    }

    else if(empty($_POST["groupname"])){

        exit("Enter A Valid Group Name");

    }
    else{
        session_start();
        $uname = $_SESSION["username"]; //Username
        $a = $_SESSION["gnames"];       //Array of group names
        $gname = $_POST["groupname"];
        $string1 = array($gname);       //convert input to an array
        $result = array_merge(unserialize($a),$string1);
        $result1 = array_unique($result,SORT_STRING);
        $result2 = array($uname);

        $a1 = serialize($result1);
        $a2 = serialize($result2);
        
        $table = $gname.$uname;

        $sql = "UPDATE info SET gnames='$a1' WHERE username='$uname' ";
        $sql1 ="CREATE TABLE ".$table."(
          member varchar(255),
          january int(50),
          february int(50),
          march int(50),
          april int(50),
          may int(50),
          june int(50),
          july int(50),
          august int(50),
          september int(50),
          october int(50),
          november int(50),
          december int(50)
        );";
        $sql2 = "INSERT INTO $table (member) VALUES ('$uname') " ;
        $sql3 = "INSERT INTO mastergrp (username, gname,member) VALUES ('$uname','$table','$a2')";


        if (mysqli_query($con, $sql) && mysqli_query($con, $sql1) && mysqli_query($con,$sql2) && mysqli_query($con,$sql3)) {

          $_SESSION["gnames"]=$a1;

          echo '<script type="text/javascript">
          alert("Group Added Successfully :)");
        </script>';
          header("refresh:0; url= friendgroup.php");
       } else {
         echo "Error updating record: " . mysqli_error($con);
         header("refresh:0; url= location: friendgroup.php");
       }
       mysqli_close($con);


    }




?>