<?php

   $con = mysqli_connect('localhost','root','');     //hostname, username(default - root)
                                                                     
    if(!$con || !mysqli_select_db($con,'testdb'))
    {
        echo "Database Couldn't Be Connected";
        header("refresh:1; url = profile.php");
    }

    else if(empty($_POST["removed"])){

        exit("Enter A Valid Group Name");

    }else{
        session_start();
        $uname = $_SESSION["username"]; //Username
        $a = $_SESSION["gnames"];       //Array of group names
        $rname = $_POST["removed"];
        $array = unserialize($a);
        if (($key = array_search($rname, $array)) !== false) {
            unset($array[$key]);


            $result1 = array_unique($array,SORT_STRING);

        $a1 = serialize($result1);


        $sql = "UPDATE info SET gnames='$a1' WHERE username='$uname' ";

        $sql1="DROP TABLE ".$rname.$uname." ";

        $sql2="DELETE FROM mastergrp WHERE username='$uname' AND gname='$rname' ";

        if (mysqli_query($con, $sql) && mysqli_query($con,$sql1) && mysqli_query($con,$sql2)) {

          $_SESSION["gnames"]=$a1;

          echo '<script type="text/javascript">
          alert("Group removed Successfully :)");
        </script>';
          header("refresh:0; url= friendsgroup.php");
       } else {
         echo "Error updating record: " . mysqli_error($con);
         header("refresh:0; url= location: friendgroup.php");
       }
        }
        else{
            echo '<script type="text/javascript">
          alert("No Group With Name '.$rname.' Exist :|");
        </script>';
          header("refresh:0; url= friendgroup.php");
        }

       mysqli_close($con);


    }





?>