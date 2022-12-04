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
        </form>
    </div>
</body>

</html>

<?php

if(isset($_POST["submit"])){


    $servername = "localhost";
    $dbUsername = "sanjeev123";
    $password = "sanjeev123!@#";
    $dbname = "assignment5";

    $conn = mysqli_connect($servername, $dbUsername, $password,$dbname);


    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    // echo "Connected successfully";

   
    $personFullName = $_POST["name"];
    $username = $_POST["username"];
    $userPassword = $_POST["password"];
    $hashedUserPassword = password_hash($userPassword,PASSWORD_DEFAULT);
    $userimgPath = $_POST["our_file"];
    $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));
    $userId = "user_".$uuid;

    $query = "INSERT INTO users (userId,name,username,passwordHash) VALUES ('".$userId."','".$personFullName."','".$username."','".$hashedUserPassword."');";

    echo $query;

    if (mysqli_query($conn, $query)) {
        echo "New user added successfully";
    } else {
        echo "Error: " .$query . "<br>" . mysqli_error($conn);
    }
}

else {

    echo "form in progress";
}
// echo $personFullName;
// echo $username;
// echo $userPassword;
// echo $userimgPath;
?>