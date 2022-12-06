<?php
   include('db.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select username from users where userId = '$user_check' ");
   $query2 = mysqli_query($db,"select imagePath from pictures where userId = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $row2 = mysqli_fetch_array($query2,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   $user_image = $row2['imagePath'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>