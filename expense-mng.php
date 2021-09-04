<?php
include_once  "dbconnect.php";
$sqlItem = mysqli_query($conn, "SELECT itemID,itemName from item where categoryItem like 'Chi tiêu';");
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
      <h3 style="text-align: center; padding: 20px; font-weight:bold;">THÊM MỚI CHI TIÊU</h3>
      <form method="POST" action="insert-expense.php">
        <div class="input-group mb-3">
          <span class="input-group-text border-0">Loại chi tiêu</span>
          <input type="text" class="form-control rounded" placeholder="Thêm loại chi tiêu........" aria-describedby="basic-addon1" name="nameExpense" />
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text border-0">Mục chi tiêu</span>
          <select class="selectpicker form-control" name="itemExpense">
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
          <input type="text" class="form-control rounded"placeholder="Nhập số tiền chi tiêu........" name="priceExpense" />
          <span class="input-group-text border-0">VNĐ</span>
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text border-0">Ngày thêm chi tiêu</span>
          <input type="text" class="form-control rounded"placeholder="Nhập ngày........" name="priceExpense" value="<?php $time=time(); echo date("d/m/Y", $time);?>"/>
        </div>

        <div class="input-group">
          <span class="input-group-text border-0">Ghi chú</span>
          <textarea class="form-control rounded"placeholder="Ghi chú chi tiêu........" name="commentExpense"></textarea>
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
  <?php
  include_once("common/footer.php")
  ?>
</div>
<!-- ./wrapper -->