
<?php
   include('session.php');
   if(isset($_SESSION['login_user'])) {
        header("location: profile.php");
   }
   header("location: login.php");
   
?>
