<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Registration page </title>
    <link rel="stylesheet" href="register.css">
    <script>
        function clearStatusMessage() {
            // document.getElementById("statusMsg").innerText = "";
        }

        function uploadPicture() {
            
            var oFileReader = new FileReader();
            oFileReader.readAsDataURL(document.getElementById("file").files[0]);

            oFileReader.onload = function(oFileReader) {
                document.getElementById("avatar").src = oFileReader.target.result;
            };
        }

        function validateFields() {
            document.getElementById("statusMsg").innerText = "";
            let isFormOk = false;
            let personName = document.getElementById("personName").value;
            let username = document.getElementById("username").value;
            let userPassword = document.getElementById("password").value;
            let userConfirmPassword = document.getElementById("confirm-password").value;
            let userProfilePicture = document.getElementById("file");

            if (personName === "") {
                document.getElementById("statusMsg").textContent = "Error: Please write your full name";
                return false;
            }
            if (username === "") {
                document.getElementById("statusMsg").textContent = "Error: Please write your username";
                return false;
            }
            if (userPassword === "") {
                document.getElementById("statusMsg").textContent = "Error: Please write a password";
                return false;
            }
            if (userPassword !== userConfirmPassword) {
                document.getElementById("statusMsg").textContent = "Error: Password and confirm password does not match";
                return false;
            }
            return true;
        }
    </script>
</head>


<body>
    <div class="center">
        <h1> Registration Page </h1>
        <div id="register-form">
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validateFields()" enctype="multipart/form-data">
                <div><label>Name:</label> <input type="text" name="name" id="personName" onclick="clearStatusMessage()"> <br> <br></div>
                <div><label>Username:</label><input type="text" name="username" id="username" onclick="clearStatusMessage()"> <br> <br></div>
                <div><label>Password:</label> <input type="password" name="password" id="password" onclick="clearStatusMessage()"> <br> <br></div>
                <div><label>Confirm password:</label> <input type="password" name="confirm-password" id="confirm-password" onclick="clearStatusMessage()"> <br> <br></div>
                <div><label>Picture: </label><input class="profile-picture" type="file" name="our_file" id="file" onchange="uploadPicture()"><br> <br></div>
                <div><label></label><img id="avatar" /><br> <br></div>
                <div><label></label><input type="submit" value="Register" name="submit" onclick="clearStatusMessage()"> <br> <br></div>
                <div><label style="width:50px;"></label>
                    <p id="statusMsg"> <br>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php


if (isset($_POST["submit"])) {

    include("db.php");

    try {
        if ($_FILES["our_file"]["size"] > 50000) {
            $statusMessage = "Sorry, your file is too large.";
            throw $statusMessage;
        }


        try {
            $target_dir = "/Library/WebServer/Documents/";
            $target_file = $target_dir . basename($_FILES["our_file"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                $statusMessage = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                throw "Sorry, only JPG, JPEG, PNG & GIF files are allowed";
                $uploadOk = 0;
            }
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
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
        $hashedUserPassword = password_hash($userPassword, PASSWORD_DEFAULT);
        $userimgPath = $_POST["our_file"];
        $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));
        $userId = "user_" . $uuid;

        $query = "INSERT INTO users (userId,name,username,passwordHash) VALUES ('" . $userId . "','" . $personFullName . "','" . $username . "','" . $hashedUserPassword . "');";

        $query2 = "INSERT INTO pictures (userId, imagePath) VALUES ('" . $userId . "','" . $target_file . "';)";

        if (mysqli_query($db, $query) && mysqli_query($db, $query2)) {
            $statusMessage = "New user added successfully";
            $_SESSION['login_user'] = $username;
            header("location: profile.php");
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($db);
            $err = mysqli_error($db);
            $statusMessage = $err;
            header("location: login.php");
        }
    } catch (\Throwable $th) {
        echo $th;
        echo "<script>alert("."'$th'".")</script>";
        $statusMessage = $th;
    }
}
?>