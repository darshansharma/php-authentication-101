<?php
include('db.php');
session_start();

$user_check = $_SESSION['login_user'];

$ses_sql = mysqli_query($db, "select * from users");

$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

$login_session = $row['username'];

if (!isset($_SESSION['login_user'])) {
    header("location:login.php");
    die();
}
?>
<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> ADMIN PANEL </title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
    <script>
        var newName = "";
        var newUserName = "";

        async function getNewUserData(userId) {

            newName = await prompt('Enter new name', '');
            newUserName = await prompt('Enter new username', '');
            document.getElementById("newName").value = newName;
            document.getElementById("newUsername").value = newUserName;
            if(newName === "" || newUserName === ""){
                return false;
            }
            return true;
        }
    </script>
</head>


<body>
    <h2>Admin Panel</h2>
    <div id="all-user-data">
        <table>
            <tr>
                <th>UserID</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Update User</th>
                <th>Delete User</th>
            </tr>
            <?php
            $result = mysqli_query($db, "select * from users");

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $shouldDeleteUser = false;
                    echo "<tr>";
                    echo "<td>$row[userId]</td> ";
                    echo "<td>$row[username]</td> ";
                    echo "<td>$row[name]</td> ";
                    echo "<td><form onsubmit='return getNewUserData();' method='post' action='update-user.php'>
                    <input type='hidden' id='newName' name='newName' />
                    <input type='hidden' id='newUsername' name='newUsername' />
                    <input type='hidden' id='userId-1' name='userId' value='$row[userId]' />
                    <input type='submit' value='Update' name='submit' /></form></td>";
                    echo "<td><a href='delete-user.php?userId=$row[userId]'>Delete</a></td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>

    </div>

</body>

</html>
