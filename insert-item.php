<!-- insert Items -->
<?php
include_once "dbconnect.php";
//$itemName = mysqli_real_escape_string($conn, $_REQUEST['itemName']);
//$categoryItem = mysqli_real_escape_string($conn, $_REQUEST['categoryItem']);

$itemName = $categoryItem = "";

if (!empty($_POST)) {

	if (isset($_POST['itemName'])) {
		$itemName = $_POST['itemName'];
	}

	if (isset($_POST['categoryItem'])) {
		$categoryItem = $_POST['categoryItem'];
	}
}

// Attempt insert query execution
$sqlInsert = "INSERT INTO item(ItemName, categoryItem) VALUES ('$itemName ','$categoryItem')";
if (mysqli_query($conn, $sqlInsert)) {
    echo $itemName;
} else {
    echo "ERROR: Could not able to execute $sqlInsert. " . mysqli_error($conn);
}

if ($categoryItem == 'Thu nhập') {
    header('Location: Items-Collect.php');
} else if ($categoryItem == 'Chi tiêu') {
    header('Location: Items-Expense.php');
    die();
} else
    die()
?>