<?php
include_once "dbconnect.php";
$sqlCollect = mysqli_query($conn, "SELECT ca.categoryName,c.collectName,i.ItemName,c.comment,c.collectPrice FROM collect as c INNER JOIN item as i ON c.itemID = i.ItemID INNER JOIN categories as ca ON ca.categoryID = c.categoryID;");
$sqlExpense = mysqli_query($conn, "SELECT ca.categoryName,e.expenseName,i.ItemName,e.comment,e.expensePrice FROM expense as e INNER JOIN item as i ON e.itemID = i.ItemID INNER JOIN categories as ca ON ca.categoryID = e.categoryID;");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>QL thu chi cá nhân</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
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
                </thead>
                <tbody>
                  <?php
                  if ($sqlCollect) {
                    // Hàm `mysql_fetch_row()` sẽ chỉ fetch dữ liệu một record mỗi lần được gọi
                    // do đó cần sử dụng vòng lặp While để lặp qua toàn bộ dữ liệu trên bảng posts
                    while ($row = mysqli_fetch_row($sqlCollect)) {
                      echo '<tr>
              <td><input type="checkbox" class="checkthis" /></td>
              <td>' . $row[0] . '</td>
              <td>' . $row[1] . '</td>
              <td>' . $row[2] . '</td>
              <td>' . $row[3] . '</td>
              <td>' . $row[4] . '</td>
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

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>