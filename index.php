<?php
include_once "dbconnect.php";
?>
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/product-management.png" alt="AdminLTELogo" height="200" width="200">
  </div>

  <!-- Navbar -->
  <?php
  include_once("common/header.php");
  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php
    include_once("common/sidebar.php");
    ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <div class="container">

      <div class="row">
        <div class="col-md-12">
          <h4 style="text-align: center; font-weight: bold">Thống kê Thu Nhập</h4>

          <?php
          $sqlCollect = mysqli_query($conn, "SELECT c.collectID,ca.categoryName,c.collectName,i.ItemName,c.comment,c.collectPrice FROM collect as c INNER JOIN item as i ON c.itemID = i.ItemID INNER JOIN categories as ca ON ca.categoryID = c.categoryID;");
          ?>

          <div class="table-responsive">
            <table id="mytable" class="table table-bordred table-striped">
              <thead>
                <th width="50px"><input type="checkbox" id="checkall" /></th>
                <th width="150px">Loại</th>
                <th width="200px">Loại thu nhập</th>
                <th>Mục tiêu dùng</th>
                <th>Ghi chú</th>
                <th>Số tiền(VNĐ)</th>
                <th>
                  <a type="button" class="btn btn-primary" href="collect-mng.php"><i class="far fa-edit"></i>Thêm</a>
                </th>
              </thead>
              <tbody>
                <?php
                if ($sqlCollect->num_rows > 0) {
                  while ($row = $sqlCollect->fetch_assoc()) {
                    echo '<tr>
              <td><input type="checkbox" class="checkthis" value = ' . $row['collectID'] . ' name = "ID"></td>
              <td style="display:none">' . $row['collectID'] . '</td>
              <td>' . $row['categoryName'] . '</td>
              <td>' . $row['collectName'] . '</td>
              <td>' . $row['ItemName'] . '</td>
              <td>' . $row['comment'] . '</td>
              <td>' . $row['collectPrice'] . '</td>
              <td><button type="button" class="btn btn-danger"><i class="fa fa-times"></i> Xoá bỏ</button></td>
              </tr>';
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h4 style="text-align: center; font-weight: bold">Thống kê chi tiêu</h4>

          <?php
          $sqlExpense = mysqli_query($conn, "SELECT e.expenseID,ca.categoryName,e.expenseName,i.ItemName,e.comment,e.expensePrice FROM expense as e INNER JOIN item as i ON e.itemID = i.ItemID INNER JOIN categories as ca ON ca.categoryID = e.categoryID;");
          ?>

          <div class="table-responsive">
            <table id="mytable" class="table table-bordred table-striped">
              <thead>
                <th width="50px"><input type="checkbox" id="checkall" /></th>
                <th width="150px">Loại</th>
                <th width="200px">Loại chi tiêu</th>
                <th>Mục tiêu dùng</th>
                <th>Ghi chú</th>
                <th>Số tiền(VNĐ)</th>
                <th>
                  <a type="button" class="btn btn-primary" href="expense-mng.php"><i class="far fa-edit"></i>Thêm</a>
                </th>
              </thead>
              <tbody>
                <?php
                if ($sqlExpense->num_rows > 0) {
                  while ($row = $sqlExpense->fetch_assoc()) {
                    echo '<tr>
              <td><input type="checkbox" class="checkthis" value = ' . $row['expenseID'] . ' ></td>
              <td style="display:none">' . $row['expenseID'] . '</td>
              <td>' . $row['categoryName'] . '</td>
              <td>' . $row['expenseName'] . '</td>
              <td>' . $row['ItemName'] . '</td>
              <td>' . $row['comment'] . '</td>
              <td>' . $row['expensePrice'] . '</td>
              <td><button type="button" class="btn btn-danger"><i class="fa fa-times"></i> Xoá bỏ</button></td>
              </tr>';
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
  include_once("common/footer.php");
  ?>
</div>
<!-- ./wrapper -->