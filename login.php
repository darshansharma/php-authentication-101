<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> login page </title>
    <link rel="stylesheet" href="login.css">
</head>


<body>
    <div class="center">
        <h1> LOGIN </h1>

        <form  method="post">
            Username: <input type="text" name="username"> <br> <br>
            Password: <input type="password" name="password"> <br> <br>
            <input type="submit" name ="submit" value="LOGIN">
            <p> Not registered . <a href="register.php"> Click here to register</a> </p>
        </form>
    </div>
</body>

</html>

<?php



if (isset($_POST["submit"])) {

    include ("db.php");

    $username = $_POST["username"];
    $userPassword = $_POST["password"];
    $hashedUserPassword = password_hash($userPassword, PASSWORD_DEFAULT);

    session_start();

    $query = "SELECT passwordHash FROM  users WHERE username = '$username' ;";
    
    echo $query;

    $result = mysqli_query($db, $query);
    echo $result;
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    echo $row;
   
    $active = $row['active'];
    $count = mysqli_num_rows($result);
    if ($count == 1) {
       
        $_SESSION['login_user'] = $username;

      //  header("location: profile.php");
    } else {
        $error = "Your Login Name or Password is invalid";
    }
} else {

    echo "form in progress";
}

?>