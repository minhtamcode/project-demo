<?php
include_once "dbconnect.php";
$expenseID = mysqli_real_escape_string($conn, $_POST['expenseID']);
// Attempt insert query execution
$sqlDelete = "DELETE FROM expense WHERE expenseID=$expenseID";
if (mysqli_query($conn, $sqlDelete)) {
    echo 'Xoá thành công';
} else {
    echo mysqli_error($conn);
}
?>