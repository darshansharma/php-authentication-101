<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> login page </title>
    <link rel="stylesheet" href="register.css">
    <script>

    function validateFields() {
        document.getElementById("statusMsg").innerText = "";
        
        let username = document.getElementById("username").value;
        let userPassword = document.getElementById("password").value;

        if(username === ""){
            document.getElementById("statusMsg").textContent = "Error: Please write your username";
            return false;
        }
        if(userPassword === ""){
            document.getElementById("statusMsg").textContent = "Error: Please write a password";
            return false;
        }
        return true;
    }
    </script>
</head>


<body>
    <div class="center">
        <h1> LOGIN </h1>
        <div class="register-form">
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validateFields()" enctype="multipart/form-data">
            <div><label>Username: </label><input type="text" name="username" id="username"> <br> <br></div>
            <div><label>Password: </label><input type="password" name="password" id="password"> <br> <br></div>
            <div><label></label><input type="submit" name="submit" value="Login"></div>
            <div><label></label><p id="statusMsg" style="color:red;"> </p> <br><br ></div>
            <div><label></label><p> Not registered . <a href="register.php"> Click here to register</a> </p> <br> <br></div>
        </form>
        </div>
    </div>
</body>

</html>

<?php



if (isset($_POST["submit"])) {
    include("db.php");
    
try {
    $username = $_POST["username"];
    $userPassword = $_POST["password"];
    $hashedUserPassword = password_hash($userPassword, PASSWORD_DEFAULT);
    $query = "SELECT * FROM  users WHERE username='" . $username . "' ;";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    echo $query;
    $isPasswordRight = password_verify($userPassword, $row['passwordHash']);
    session_start();
    $count = mysqli_num_rows($result);
    if ($count == 1 && $isPasswordRight == "success") {
        echo "success";
        $_SESSION['login_user'] = $row['userId'];
        
          header("location: profile.php");
    } else {
        $errorMessage = "Your Login Name or Password is invalid";
    }
} catch (\Throwable $th) {
    $errorMessage = "Your Login Name or Password is invalid";
    echo $th;
}
    
}

?>