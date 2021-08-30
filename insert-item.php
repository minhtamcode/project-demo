<!-- insert Items -->

<?php
include_once "dbconnect.php";
$itemName = mysqli_real_escape_string($conn, $_REQUEST['itemName']);
$categoryItem = mysqli_real_escape_string($conn, $_REQUEST['categoryItem']);

// Attempt insert query execution
$sqlInsert = "INSERT INTO item(ItemName, categoryItem) VALUES ('$itemName ','$categoryItem')";
if (mysqli_query($conn, $sqlInsert)) {
    echo $itemName;
} else {
    echo "ERROR: Could not able to execute $sqlInsert. " . mysqli_error($conn);
}
?>


