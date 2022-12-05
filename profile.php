
<?php
   include('session.php');
   $query = "SELECT * FROM  users WHERE username='" . $_SESSION['login_user']. "' ;";
   $result = mysqli_query($db, $query);
   $row = mysqli_fetch_row($result);
   $userId = $row[0];
   $name = $row[1];
   $username = $row[2];
?>



<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> PROFILE </title>
    <link rel="stylesheet" href="profile.css">
</head>


<body>
    <h2>Hi, <?php echo $user ?></h2>
    <button> UPDATE </button> <br> <br>
    <a href="logout.php"> <button> LOGOUT </button> </a>
    <img src = "https://cdn.pixabay.com/photo/2017/06/13/12/53/profile-2398782_1280.png" width=200, height=200>
    <p> Hello sanjeev prabhakar </p>
</body>


</html>

