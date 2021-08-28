<?php
include_once  "dbconnect.php";
$sqlItem = mysqli_query($conn, "SELECT itemName from item where categoryItem like 'Chi tiêu';");
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
      <img class="animation__shake" src="dist/img/expense.png" height="200" width="200">
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
        <h3 style="text-align: center; padding: 20px; font-weight:bold;">THÊM MỚI THU NHẬP</h3>
        <div class="input-group mb-3">
          <span class="input-group-text border-0" id="basic-addon1">Loại chi tiêu</span>
          <input type="text" class="form-control rounded" placeholder="Thêm loại chi tiêu........" aria-label="Username" aria-describedby="basic-addon1" />
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text border-0" id="basic-addon3">Mục chi tiêu</span>
          <select class="selectpicker form-control">
            <?php
            if ($sqlItem) {
              // Hàm `mysql_fetch_row()` sẽ chỉ fetch dữ liệu một record mỗi lần được gọi
              // do đó cần sử dụng vòng lặp While để lặp qua toàn bộ dữ liệu trên bảng posts
              $index = 0;
              while ($row = mysqli_fetch_row($sqlItem)) {
                echo
                '<option>' . $row[$index] . '</option>';
              }
              $index++;
              // Máy tính sẽ lưu kết quả từ việc truy vấn dữ liệu bảng
              // Do đó chúng ta nên giải phóng bộ nhớ sau khi hoàn tất đọc dữ liệu
              //mysqli_free_result($result);
            }
            ?>
          </select>
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text border-0">Số tiền</span>
          <input type="text" class="form-control rounded" aria-label="Amount (to the nearest dollar)" placeholder="Nhập số tiền chi tiêu........" />
          <span class="input-group-text border-0">VNĐ</span>
        </div>

        <div class="input-group">
          <span class="input-group-text border-0">Ghi chú</span>
          <textarea class="form-control rounded" aria-label="With textarea" placeholder="Ghi chú chi tiêu........"></textarea>
        </div>

        <div class="row">
          <div class="col-sm-8"></div>
          <div class="col-sm-4">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPoll"><i class="far fa-edit"></i>Lưu</button>
            <a type="button" class="btn btn-danger" href="index.php"><i class="fa fa-times"></i> Huỷ</a>
          </div>
        </div>

      </div>
    </div>
    <!-- /.content-wrapper -->
    <?php
    include_once("common/footer.php")
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