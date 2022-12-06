<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> login page </title>
    <link rel="stylesheet" href="login.css">
    <script>

    function validateFields() {
        document.getElementById("statusMsg").innerText = "";
        
        let username = document.getElementById("username").value;
        let userPassword = document.getElementById("password").value;

        if(username === ""){
            document.getElementById("statusMsg").textContent = "Please write your username";
            return false;
        }
        if(userPassword === ""){
            document.getElementById("statusMsg").textContent = "Please write a password";
            return false;
        }
        return true;
    }
    </script>
</head>


<body>
    <div class="center">
        <h1> LOGIN </h1>

        <form method="post" onsubmit="return validateFields()" action="<?=$_SERVER['PHP_SELF'];?>">
            Username: <input type="text" name="username"> <br> <br>
            Password: <input type="password" name="password"> <br> <br>
            <p id="statusMsg" style="color:red;"> </p> <br><br >
            <input type="submit" name="submit" value="LOGIN">
            <p> Not registered . <a href="register.php"> Click here to register</a> </p> <br> <br>
        </form>
    </div>
</body>

</html>

<?php



if (isset($_POST["submit"])) {
    include("db.php");
    $username = $_POST["username"];
    $userPassword = $_POST["password"];
    $hashedUserPassword = password_hash($userPassword, PASSWORD_DEFAULT);
    
    session_start();
    $query = "SELECT passwordHash FROM  users WHERE username='" . $username . "' ;";
try {
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_row($result);
    $isPasswordRight = password_verify($userPassword, $row[0]);
    $count = mysqli_num_rows($result);
    if ($count == 1 && $isPasswordRight == "success") {
        echo "success";
        $_SESSION['login_user'] = $username;
        
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