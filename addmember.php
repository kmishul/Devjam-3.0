<?php

   $con = mysqli_connect('localhost','root','');     //hostname, username(default - root)
                                                                     
    if(!$con || !mysqli_select_db($con,'testdb'))
    {
        echo "Database Couldn't Be Connected";
        header("refresh:1; url = profile.php");
    }

    else if(empty($_POST["gname"])){

        exit("Enter A Valid Group Name");

    }
    else
    {
        session_start();
        $uname = $_SESSION["username"];
        $member = $_POST["membername"];
        $gname = $_POST["gname"];

        $sql = "SELECT member FROM mastergrp WHERE username='$uname' AND gname='$gname' ";
        $result = mysqli_query($con,$sql);
        if($result){

           $arr = mysqli_fetch_array($result);
           $a = array($member);
           $a1 = array_merge(unserialize($arr),$a);
           $a2 = serialize(array_unique($a1,SORT_STRING));

           $sql1 = "UPDATE mastergrp SET member=$a2 WHERE username='$uname' AND gname-'$gname' ";
           if(mysqli_query($con,$sql))
           {
              
           }
           else{
               echo "ERROR";
               header("refresh:2; url= membersgroup.php");
           }
        }
        else{
            echo "ERROR ";
            header("refresh:2; url= friends.php");
        }

        $query = "SELECT gnames FROM info WHERE username='$member' ";
        $result1 = mysqli_query($con,$query);
        if($result1){

            $arr1 = mysqli_fetch_array($result1);
            $arr2 = unserialize($arr1);
            $a3 = array_merge($arr2,$arr1);
            $a4 = serialize(array_unique($a3,SORT_STRING));

            $query1 = "UPDATE info SET gnames='$a4' WHERE username='$uname' ";
            if(mysqli_query($con,$query)){
                echo '<script type="text/javascript">alert("Member Added to '.$gname.' Successfully");</script>';
                header("refresh:0; url= membersgroup.php");
            }
            else{
                echo "Error in Adding Member";
                header("refresh:2; url= membersgroup.php");
            }

        }
    }


?>
