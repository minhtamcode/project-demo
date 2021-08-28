<?php
include_once("dbconnect.php");
$sqlItem = mysqli_query($conn, "SELECT itemID,itemName from item where categoryItem like 'Thu nhập';");
?>
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/self-collect.png" height="200" width="200">
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
      <form method="POST" action="action-submit.php">
        <div class="input-group mb-3">
          <span class="input-group-text border-0" id="basic-addon1">Loại thu nhập</span>
          <input type="text" class="form-control rounded" placeholder="Thêm loại thu nhập........" aria-describedby="basic-addon1" name="categoryCollect" />
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text border-0" id="basic-addon3">Mục thu nhập</span>
          <select class="selectpicker form-control" name="itemCollect">
            <option value="" aria-readonly="true">Chọn...</option>
            <?php
            if ($sqlItem->num_rows > 0) {
              // Hàm `mysql_fetch_row()` sẽ chỉ fetch dữ liệu một record mỗi lần được gọi
              // do đó cần sử dụng vòng lặp While để lặp qua toàn bộ dữ liệu trên bảng posts
              //$index = 0;
              //$itemCollect = array();
              while ($row = $sqlItem->fetch_assoc()) {
                echo '
                <option value="' . $row["itemID"] . '">' . $row["itemName"] . '</option>';
              }
              //$index++;
            }
            //echo '<option name="itemCollect">'.$itemCollect.'</option>';
            ?>
          </select>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text border-0">Số tiền</span>
          <input type="text" class="form-control rounded" aria-label="Amount (to the nearest dollar)" placeholder="Nhập số tiền thu nhập........" name="priceCollect" />
          <span class="input-group-text border-0">VNĐ</span>
        </div>

        <div class="input-group">
          <span class="input-group-text border-0">Ghi chú</span>
          <textarea class="form-control rounded" aria-label="With textarea" placeholder="Ghi chú thu nhập........" name="commentCollect"></textarea>
        </div>
        <div class="row">
          <div class="col-sm-8"></div>
          <div class="col-sm-4">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPoll"><i class="far fa-edit"></i>Lưu</button>
            <a type="button" class="btn btn-danger" href="index.php"><i class="fa fa-times"></i> Huỷ</a>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- /.content-wrapper -->
  <!-- footer -->
  <?php
  include_once("common/footer.php");
  ?>
  <!-- /.footer -->
</div>
<!-- ./wrapper -->