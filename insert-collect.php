<?php
include_once  "dbconnect.php";
// define variables and set to empty values
$categoryCollect = $itemCollect = $priceCollect = $commentCollect = $collectID ="";
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

  $collect_ID="";
  if (isset($_GET['collectID'])) {
    $collect_ID=$_GET['collectID'];
    $sqlLoad= "SELECT collectName, comment, collectPrice, itemID FROM collect WHERE collectID = $collectID";
    if ($sqlCollect->num_rows > 0) {
      while ($row = $sqlCollect->fetch_assoc()) {
        $nameCollect=$row['collectName'];
        $commentCollect=$row['comment'];
        $priceCollect=$row['priceCollect'];
        $itemCollect=$row['itemID'];
        //$categoryID=$row['categoryID'];
      }
    }
  }

    if ($collectID != '') {
    $sqlUpdate = "UPDATE collect SET collectName ='$nameCollect', comment='$commentCollect', collectPrice='$priceCollect', itemID='$itemCollect', categoryID='$categoryID' WHERE collectID = $collectID ";
    if (mysqli_query($conn, $sqlUpdate)) {
      header('Location: statistical-collect.php');
    } else {
      echo "ERROR: Could not able to execute $sqlInsert. " . mysqli_error($conn);
    }
    die(); 
  } else {
    $sqlInsert = "INSERT INTO collect(collectName, comment, collectPrice, itemID, categoryID) VALUES ('$nameCollect','$commentCollect','$priceCollect','$itemCollect','$categoryID')";
    if (mysqli_query($conn, $sqlInsert)) {
      header('Location: statistical-collect.php');
    } else {
      echo "ERROR: Could not able to execute $sqlInsert. " . mysqli_error($conn);
    }
    die();
  }
}
