<?php
include("db.php");
$sql = "DELETE FROM users WHERE userId='$_GET[userId]';";
if (mysqli_query($db, $sql)) {
    echo "Record deleted successfully";
    header("location: adminpanel.php");
    
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>