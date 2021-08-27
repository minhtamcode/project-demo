<?php
// define variables and set to empty values
$categoryCollect = $itemCollect = $priceCollect = $commentCollect = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $categoryCollect = test_input($_POST["categoryCollect"]);
  $itemCollect = test_input($_POST["itemCollect"]);
  $priceCollect = test_input($_POST["priceCollect"]);
  $commentCollect = test_input($_POST["commentCollect"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
    echo "<h2>Your Input:</h2>";
    echo $categoryCollect;
    echo "<br>";
    echo $itemCollect;
    echo "<br>";
    echo $priceCollect;
    echo "<br>";
    echo $commentCollect;
?>