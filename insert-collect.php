<?php
include_once  "dbconnect.php";
// define variables and set to empty values
$categoryCollect = $itemCollect = $priceCollect = $commentCollect = $collectID = $timeCollect = "";
$categoryID = 1;

if (!empty($_POST)) {
  if (isset($_POST['nameCollect'])) {
    $nameCollect = $_POST['nameCollect'];
  }

  if (isset($_POST['itemCollect'])) {
    $itemCollect = $_POST['itemCollect'];
  }

  if (isset($_POST['priceCollect'])) {
    $priceCollect = $_POST['priceCollect'];
  }

  if (isset($_POST['categoryID'])) {
    $categoryID = $_POST['categoryID'];
  }

  if (isset($_POST['commentCollect'])) {
    $commentCollect = $_POST['commentCollect'];
  }

  if (isset($_POST['timeCollect'])) {
    $timeCollect = $_POST['timeCollect'];
  }

  if (isset($_POST['collectID'])) {
    $collectID = $_POST['collectID'];
  }

  $nameCollect = str_replace('\'', '\\\'', $nameCollect);
  $categoryCollect = str_replace('\'', '\\\'', $categoryCollect);
  $itemCollect = str_replace('\'', '\\\'', $itemCollect);
  $priceCollect      = str_replace('\'', '\\\'', $priceCollect);
  $commentCollect  = str_replace('\'', '\\\'', $commentCollect);
  $categoryID       = str_replace('\'', '\\\'', $categoryID);

  $sqlInsert = "INSERT INTO collect(collectName, comment, collectPrice, itemID, categoryID, time) VALUES ('$nameCollect','$commentCollect','$priceCollect','$itemCollect','$categoryID','$timeCollect')";
  if (mysqli_query($conn, $sqlInsert)) {
    header('Location: statistical-collect.php');
  } else {
    echo "ERROR: Could not able to execute $sqlInsert. " . mysqli_error($conn);
    die();
  }
}
