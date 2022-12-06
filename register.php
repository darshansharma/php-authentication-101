<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Registration page </title>
    <link rel="stylesheet" href="register.css">
    <script>

    function validateFields() {
        document.getElementById("statusMsg").innerText = "";
        let isFormOk = false;
        let personName = document.getElementById("personName").value;
        let username = document.getElementById("username").value;
        let userPassword = document.getElementById("password").value;
        let userConfirmPassword = document.getElementById("confirm-password").value;
        let userProfilePicture = document.getElementById("file");

        if(personName === ""){
            document.getElementById("statusMsg").textContent = "Please write your full name";
            return false;
        }
        if(username === ""){
            document.getElementById("statusMsg").textContent = "Please write your username";
            return false;
        }
        if(userPassword === ""){
            document.getElementById("statusMsg").textContent = "Please write a password";
            return false;
        }
        if(userPassword !== userConfirmPassword){
            document.getElementById("statusMsg").textContent = "Password and confirm password does not match";
            return false;
        }
        return true;
    }

</script>
</head>


<body>
    <div class="center">
        <h1> Registration Page </h1>

        <form action="<?=$_SERVER['PHP_SELF'];?>" method="post" onsubmit="return validateFields()" enctype="multipart/form-data">
            Name: &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="name" id="personName"> <br> <br>
            Username: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<input type="text" name="username" id="username"> <br> <br>
            Password: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <input type="password" name="password" id="password"> <br> <br>
            Confirm password: &nbsp;<input type="password" name="confirm-password" id="confirm-password"> <br> <br>
            Picture: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="our_file" id="file"> <br> <br>
            <p id="statusMsg" style="color:red;"> </p> <br><br >
           <div class ="submitButton"> <input type="submit" value="Register" name = "submit" > </div> <br> <br>
           
        </form>
    </div>
</body>

</html>

<?php


if(isset($_POST["submit"])){

    include("db.php");

try {
    if ($_FILES["our_file"]["size"] > 50000) {
        $statusMessage = "Sorry, your file is too large.";
        throw $statusMessage;
    }
    
        
    try {
        $target_dir = "/Users/darshan/up/";
        $target_file = $target_dir . basename($_FILES["our_file"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $statusMessage = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            throw "Sorry, only JPG, JPEG, PNG & GIF files are allowed";
            $uploadOk = 0;
        }
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $statusMessage = "File is not an image.";
            throw "File is not an image";
            $uploadOk = 0;
        }
        move_uploaded_file($_FILES["our_file"]["tmp_name"], $target_file);
    } catch (\Throwable $th) {
        echo "Error Occured while uploading image\n";
        $statusMessage = $th;
    }
        
    $personFullName = $_POST["name"];
    $username = $_POST["username"];
    $userPassword = $_POST["password"];
    $hashedUserPassword = password_hash($userPassword,PASSWORD_DEFAULT);
    $userimgPath = $_POST["our_file"];
    $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));
    $userId = "user_".$uuid;

    $query = "INSERT INTO users (userId,name,username,passwordHash) VALUES ('".$userId."','".$personFullName."','".$username."','".$hashedUserPassword."');";

    $query2 = "INSERT INTO pictures (userId, imagePath) VALUES ('".$userId."','".$target_file."';)";

    if (mysqli_query($db, $query) && mysqli_query($db, $query2)) {
        $statusMessage = "New user added successfully";
        $_SESSION['login_user'] = $username;
        header("location: profile.php");
    } else {
        echo "Error: " .$query . "<br>" . mysqli_error($db);
        $err = mysqli_error($db);
        $statusMessage = $err;
        header("location: login.php");
    }
} catch (\Throwable $th) {
    echo "Error occured - \n";
    echo $th;
    $statusMessage = $th;
}
    
}
?>