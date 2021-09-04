<?php
include_once  "dbconnect.php";

if (!empty($_POST)) {
    if (isset($_POST['expenseID'])) {
      $expenseID = $_POST['expenseID'];
    }
  
$sqlDetailexpense = mysqli_query($conn, "SELECT e.expenseName,i.ItemName,e.comment,e.expensePrice FROM expense as e INNER JOIN item as i ON e.itemID = i.ItemID INNER JOIN categories as ca ON ca.categoryID = e.categoryID WHERE e.expenseID = $expenseID;");
if ($sqlDetailexpense->num_rows > 0) {
    while ($row = $sqlDetailexpense->fetch_assoc()) {
      echo $row['expenseName'].';'.$row['ItemName'].';'.$row['expensePrice'].';'.$row['comment'];
    }
    }else{
    echo "ERROR: Could not able to execute $sqlDetailexpense. " . mysqli_error($conn);
    }
}
