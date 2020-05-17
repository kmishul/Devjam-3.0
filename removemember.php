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
        $member = $_POST["removed"];
        $gname = $_POST["gname"];

        $sql = "SELECT member FROM mastergrp WHERE username='$uname' AND gname='$gname' ";
        $result = mysqli_query($con,$sql);
        if($result){

           $arr = mysqli_fetch_array($result);

           $array = unserialize($arr);
          if (($key = array_search($member, $array)) !== false) {
            unset($array[$key]);


           $sql1 = "UPDATE mastergrp SET member='$array' WHERE username='$uname' AND gname='$gname' ";
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
            if (($key = array_search($gname, $arr2)) !== false) {
            unset($arr2[$key]);

            $a4 = serialize(array_unique($arr2,SORT_STRING));

            $query1 = "UPDATE info SET gnames='$a4' WHERE username='$member' ";
            if(mysqli_query($con,$query)){
                echo '<script type="text/javascript">alert("Member Removed from '.$gname.' Successfully");</script>';
                header("refresh:0; url= membersgroup.php");
            }
            else{
                echo "Error in Adding Member";
                header("refresh:2; url= membersgroup.php");
            }

        }
    }


?>