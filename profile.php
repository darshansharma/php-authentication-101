<?php
include('session.php');
?>



<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> PROFILE </title>
    <!-- <link rel="stylesheet" href="profile.css"> -->
    <style>
        #avatar {
            width: 10%;
            height: auto;
            border-radius: 10%;
            position: relative;
            left:50%;
        }
    </style>
</head>


<body style="padding:1%; border: 1px solid black; text-align:center; width:50%; margin-left: 20%;">
    <div id="profile-page" style="display:flex; flex-direction: column;">
        <div style="display:flex; flex-direction: row;">
            <h2 style="flex:2;">Hi, <?php echo $login_session ?></h2>
            <span style="margin-top:10px; cursor: pointer;"><a href="logout.php"> <button style="cursor: pointer;"> Logout </button> </a></span>
            <div class="empty-div" style="flex: 1;"></div>
        </div>
        <h3 style="text-align:center;">Welcome to the metaverse 0.1</h3>
        <img src=<?php echo "'$user_image'" ?> id="avatar" />

        <!-- <img src = "https://cdn.pixabay.com/photo/2017/06/13/12/53/profile-2398782_1280.png" width=200, height=200> -->
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
        <p>Eget velit aliquet sagittis id consectetur purus ut. Id volutpat lacus laoreet non curabitur gravida arcu ac tortor. Nulla pellentesque dignissim enim sit amet venenatis urna. Lorem ipsum dolor sit amet consectetur adipiscing. Leo duis ut diam quam. Nunc eget lorem dolor sed viverra ipsum nunc aliquet bibendum. Nibh venenatis cras sed felis eget velit aliquet sagittis id. Pellentesque pulvinar pellentesque habitant morbi tristique senectus et. Nunc non blandit massa enim nec dui. Viverra justo nec ultrices dui sapien eget mi proin.</p>
        <p>Lobortis mattis aliquam faucibus purus in massa tempor. Amet nisl suscipit adipiscing bibendum. Volutpat odio facilisis mauris sit amet massa vitae. At elementum eu facilisis sed odio morbi quis. Congue mauris rhoncus aenean vel elit. Non consectetur a erat nam at lectus. Eu consequat ac felis donec et odio pellentesque diam. Commodo nulla facilisi nullam vehicula ipsum a. Sem fringilla ut morbi tincidunt augue. Morbi tristique senectus et netus et malesuada fames ac turpis. Molestie a iaculis at erat pellentesque adipiscing commodo elit at. Rutrum quisque non tellus orci ac. Dictum fusce ut placerat orci nulla pellentesque. A pellentesque sit amet porttitor eget dolor morbi non. Tortor aliquam nulla facilisi cras fermentum odio. Blandit cursus risus at ultrices mi tempus imperdiet nulla malesuada. Venenatis lectus magna fringilla urna porttitor rhoncus dolor. Aliquam etiam erat velit scelerisque in dictum non consectetur a. Consectetur purus ut faucibus pulvinar elementum.</p>
    </div>
</body>


</html>