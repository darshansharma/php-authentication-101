<?php
include("db.php");

$sql = "UPDATE users SET name='$_POST[newName]', username='$_POST[newUsername]' WHERE userId='$_POST[userId]';";
echo $sql;
if (mysqli_query($db, $sql)) {
    
    // header("location: adminpanel.php");
    echo "<script>alert(Record updated successfully);</script>";
    
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>