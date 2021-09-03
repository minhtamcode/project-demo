<?php
include_once  "dbconnect.php";
// define variables and set to empty values
$categoryCollect = $itemCollect = $priceCollect = $commentCollect = $collectID = "";
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

  $categoryCollect = str_replace('\'', '\\\'', $categoryCollect);
  $itemCollect = str_replace('\'', '\\\'', $itemCollect);
  $priceCollect      = str_replace('\'', '\\\'', $priceCollect);
  $commentCollect  = str_replace('\'', '\\\'', $commentCollect);
  $categoryID       = str_replace('\'', '\\\'', $categoryID);

  $sqlInsert = "INSERT INTO collect(collectName, comment, collectPrice, itemID, categoryID) VALUES ('$nameCollect','$commentCollect','$priceCollect','$itemCollect','$categoryID')";
  if (mysqli_query($conn, $sqlInsert)) {
    header('Location: statistical-collect.php');
  } else {
    echo "ERROR: Could not able to execute $sqlInsert. " . mysqli_error($conn);
  }
  die();
}
