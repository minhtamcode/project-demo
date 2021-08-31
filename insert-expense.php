<?php
include_once  "dbconnect.php";
// define variables and set to empty values
$categoryExpense = $itemExpense = $priceExpense = $commentExpense = "";
$categoryID = 2;

if (!empty($_POST)) {

  if (isset($_POST['nameExpense'])) {
    $nameExpense = $_POST['nameExpense'];
  }

  if (isset($_POST['itemExpense'])) {
    $itemExpense = $_POST['itemExpense'];
  }

  if (isset($_POST['priceExpense'])) {
    $priceExpense = $_POST['priceExpense'];
  }

  if (isset($_POST['categoryID'])) {
    $categoryID = $_POST['categoryID'];
  }

  $categoryExpense = str_replace('\'', '\\\'', $categoryExpense);
  $itemExpense = str_replace('\'', '\\\'', $itemExpense);
  $priceExpense      = str_replace('\'', '\\\'', $priceExpense);
  $commentExpense  = str_replace('\'', '\\\'', $commentExpense);
  $categoryID       = str_replace('\'', '\\\'', $categoryID);

  $sqlInsert = "INSERT INTO Expense(ExpenseName, comment, ExpensePrice, itemID, categoryID) VALUES ('$nameExpense','$commentExpense','$priceExpense','$itemExpense','$categoryID')";
  if (mysqli_query($conn, $sqlInsert)) {
    header('Location: index.php');
  } else {
    echo "ERROR: Could not able to execute $sqlInsert. " . mysqli_error($conn);
  }

  
  die();
}
