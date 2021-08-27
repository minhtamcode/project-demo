<?php
include_once "dbconnect.php";
$itemName = mysqli_real_escape_string($conn, $_REQUEST['itemName']);
$categoryItem = mysqli_real_escape_string($conn, $_REQUEST['categoryItem']);

// Attempt insert query execution
$sql = "INSERT INTO item(ItemName, categoryItem) VALUES ('$itemName ','$categoryItem')";
if (mysqli_query($conn, $sql)) {
    echo $itemName;
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
