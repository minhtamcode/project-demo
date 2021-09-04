<?php
include_once  "dbconnect.php";
// define variables and set to empty values
$categoryExpense = $itemExpense = $priceExpense = $commentExpense = $timeExpense = "";
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

  if (isset($_POST['commentExpense'])) {
    $commentExpense = $_POST['commentExpense'];
  }

  if (isset($_POST['timeExpense'])) {
    $timeExpense = $_POST['timeExpense'];
  }

  $categoryExpense = str_replace('\'', '\\\'', $categoryExpense);
  $itemExpense = str_replace('\'', '\\\'', $itemExpense);
  $priceExpense      = str_replace('\'', '\\\'', $priceExpense);
  $commentExpense  = str_replace('\'', '\\\'', $commentExpense);
  $categoryID       = str_replace('\'', '\\\'', $categoryID);

  $sqlInsert = "INSERT INTO expense(expenseName, comment, itemID, expensePrice, categoryID, time) VALUES ('$nameExpense','$commentExpense','$itemExpense','$priceExpense','$categoryID','$timeExpense')";
  if (mysqli_query($conn, $sqlInsert)) {
    header('Location: statistical-expense.php');
  } else {
    echo "ERROR: Could not able to execute $sqlInsert. " . mysqli_error($conn);
  }  
  die();
}
