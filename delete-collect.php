<?php
include_once "dbconnect.php";
$collectID = mysqli_real_escape_string($conn, $_POST['collectID']);
// Attempt insert query execution
$sqlDelete = "DELETE FROM collect WHERE collectID=$collectID";
if (mysqli_query($conn, $sqlDelete)) {
    echo 'Xoá thành công';
} else {
    echo mysqli_error($conn);
}
?>