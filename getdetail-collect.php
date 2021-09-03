<?php
include_once  "dbconnect.php";

if (!empty($_POST)) {
    if (isset($_POST['collectID'])) {
      $collectID = $_POST['collectID'];
    }
  
$sqlDetailCollect = mysqli_query($conn, "SELECT c.collectName,i.ItemName,c.comment,c.collectPrice FROM collect as c INNER JOIN item as i ON c.itemID = i.ItemID INNER JOIN categories as ca ON ca.categoryID = c.categoryID WHERE c.collectID = $collectID;");
if ($sqlDetailCollect->num_rows > 0) {
    while ($row = $sqlDetailCollect->fetch_assoc()) {
      echo $row['collectName'].';'.$row['ItemName'].';'.$row['collectPrice'].';'.$row['comment'];
    }
    }else{
    echo "ERROR: Could not able to execute $sqlDetailCollect. " . mysqli_error($conn);
    }
}
