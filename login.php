<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> login page </title>
    <link rel="stylesheet" href="login.css">
</head>


<body>
    <div class ="center">
    <h1> LOGIN </h1>

    <form action="profile.php" method="post">
        Username: <input type="text" name="username"> <br> <br>
        Password: <input type="password" name="password"> <br> <br>
       <input type="submit" value="LOGIN">
        <p> Not registered . <a href="register.php"> Click here to register</a> </p>
    </form>
</div>
</body>

</html>
<?php

echo "hello";
?>