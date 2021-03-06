<?php
include_once("dbconnect.php");
$sqlItem = mysqli_query($conn, "SELECT itemID,itemName from item where categoryItem like 'Thu nhập';");
// $sqlCategoty = mysqli_query($conn, "SELECT categoryID from categories;");
?>
<div class="wrapper">
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
      <form method="POST" action="insert-collect.php">
        <div class="input-group mb-3">
          <span class="input-group-text border-0" id="basic-addon1">Loại thu nhập</span>
          <input style="display: none;" name="collectID"/>
          <input type="text" class="form-control rounded" placeholder="Thêm loại thu nhập........" aria-describedby="basic-addon1" name="nameCollect" />
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text border-0" id="basic-addon3">Mục thu nhập</span>
          <select class="selectpicker form-control" name="itemCollect">
            <option value="" aria-readonly="true">Chọn...</option>
            <?php
            if ($sqlItem->num_rows > 0) {
              while ($row = $sqlItem->fetch_assoc()) {
                echo '
                <option value="' . $row["itemID"] . '">' . $row["itemName"] . '</option>';
              }
            }
            ?>
          </select>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text border-0">Số tiền</span>
          <input type="text" class="form-control rounded" placeholder="Nhập số tiền thu nhập........" name="priceCollect" data-type="currency"/>
          <span class="input-group-text border-0">VNĐ</span>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text border-0">Ngày thêm thu nhập</span>
          <input type="text" class="form-control rounded" placeholder="Nhập ngày........" name="timeCollect" value="<?php $time=time(); echo date("d/m/Y", $time); ?>"/>
        </div>
        <div class="input-group">
          <span class="input-group-text border-0">Ghi chú</span>
          <textarea class="form-control rounded" aria-label="With textarea" placeholder="Ghi chú thu nhập........" name="commentCollect"></textarea>
        </div>
        
        <div class="row">
          <div class="col-sm-8"></div>
          <div class="col-sm-4">
            <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>Lưu</button>
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