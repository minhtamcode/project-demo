<?php
include_once "dbconnect.php";
$sqlCollect = mysqli_query($conn, "SELECT ca.categoryName,c.collectName,i.ItemName,c.comment,c.collectPrice FROM collect as c INNER JOIN item as i ON c.itemID = i.ItemID INNER JOIN categories as ca ON ca.categoryID = c.categoryID;");
$sqlExpense = mysqli_query($conn, "SELECT ca.categoryName,e.expenseName,i.ItemName,e.comment,e.expensePrice FROM expense as e INNER JOIN item as i ON e.itemID = i.ItemID INNER JOIN categories as ca ON ca.categoryID = e.categoryID;");
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
                if ($sqlCollect) {
                  // Hàm `mysql_fetch_row()` sẽ chỉ fetch dữ liệu một record mỗi lần được gọi
                  // do đó cần sử dụng vòng lặp While để lặp qua toàn bộ dữ liệu trên bảng posts
                  while ($row = mysqli_fetch_row($sqlCollect)) {
                    echo '<tr>
              <td><input type="checkbox" class="checkthis"></td>
              <td>' . $row[0] . '</td>
              <td>' . $row[1] . '</td>
              <td>' . $row[2] . '</td>
              <td>' . $row[3] . '</td>
              <td>' . $row[4] . '</td>
              <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalConfirmDelete"><i class="fa fa-times"></i> Xoá bỏ</button></td>
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
                if ($sqlExpense) {
                  // Hàm `mysql_fetch_row()` sẽ chỉ fetch dữ liệu một record mỗi lần được gọi
                  // do đó cần sử dụng vòng lặp While để lặp qua toàn bộ dữ liệu trên bảng posts
                  while ($row = mysqli_fetch_row($sqlExpense)) {
                    echo
                    '<tr>
              <td><input type="checkbox" class="checkthis" /></td>
              <td>' . $row[0] . '</td>
              <td>' . $row[1] . '</td>
              <td>' . $row[2] . '</td>
              <td>' . $row[3] . '</td>
              <td>' . $row[4] . '</td>
              <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalConfirmDelete"><i class="fa fa-times"></i> Xoá bỏ</button></td>
              </tr>';
                  }
                  // Máy tính sẽ lưu kết quả từ việc truy vấn dữ liệu bảng
                  // Do đó chúng ta nên giải phóng bộ nhớ sau khi hoàn tất đọc dữ liệu
                  //mysqli_free_result($result);
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