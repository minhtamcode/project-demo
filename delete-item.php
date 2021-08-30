<?php
include_once "dbconnect.php";
$itemID = mysqli_real_escape_string($conn, $_POST['itemID']);
// Attempt insert query execution
$sqlDelete = "DELETE FROM item WHERE ItemID=$itemID";
if (mysqli_query($conn, $sqlDelete)) {
    echo 'Xoá thành công !';
} else {
    echo mysqli_error($conn);
}
?>