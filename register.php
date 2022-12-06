<?php
    $statusMessage = "";
?>
<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Registration page </title>
    <link rel="stylesheet" href="register.css">
</head>


<body>
    <div class="center">
        <h1> Registration Page </h1>

        <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
            Name: &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="name"> <br> <br>
            Username: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<input type="text" name="username"> <br> <br>
            Password: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <input type="password" name="password"> <br> <br>
            Confirmpassword: &nbsp;<input type="password" name="password"> <br> <br>
            Picture: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="our_file"> <br> <br>
           <div class ="submitButton"> <input type="submit" value="Register" name = "submit"> </div> <br> <br>
           <p class="status"> <?php echo $statusMessage ?> </p> 
        </form>
    </div>
</body>

</html>

<?php

if(isset($_POST["submit"])){

    include("db.php");

    $personFullName = $_POST["name"];
    $username = $_POST["username"];
    $userPassword = $_POST["password"];
    $hashedUserPassword = password_hash($userPassword,PASSWORD_DEFAULT);
    $userimgPath = $_POST["our_file"];
    $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));
    $userId = "user_".$uuid;

    $query = "INSERT INTO users (userId,name,username,passwordHash) VALUES ('".$userId."','".$personFullName."','".$username."','".$hashedUserPassword."');";

    echo $query;

    if (mysqli_query($db, $query)) {
        $statusMessage = "New user added successfully";
        $_SESSION['login_user'] = $username;
        header("profile.php");
    } else {
        echo "Error: " .$query . "<br>" . mysqli_error($db);
        $err = mysqli_error($db);
        $statusMessage = $err;
    }
}

else {

    echo "form in progress";
}
?>