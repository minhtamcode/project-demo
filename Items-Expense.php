<?php
include_once "dbconnect.php";
$sqlItemExpense = mysqli_query($conn, "SELECT i.itemID,i.ItemName FROM item as i WHERE i.categoryItem like 'Chi tiêu';");
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
          <h4 style="text-align: center; font-weight: bold">Danh mục chi tiêu</h4>
          <div class="table-responsive">

            <table id="mytable" class="table table-bordred table-striped">
              <thead>
                <th width="50px"><input type="checkbox" id="checkall" /></th>
                <th>Mã loại chi tiêu</th>
                <th>Tên loại chi tiêu</th>
                <th width="110px">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPoll"><i class="far fa-edit"></i>Thêm</button>
                </th>
                <th width="100px">
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalConfirmDelete"><i class="fa fa-times"></i> Xoá</button>
                </th>
              </thead>
              <tbody>
                <?php
                if ($sqlItemExpense) {
                  // Hàm `mysql_fetch_row()` sẽ chỉ fetch dữ liệu một record mỗi lần được gọi
                  // do đó cần sử dụng vòng lặp While để lặp qua toàn bộ dữ liệu trên bảng posts
                  while ($row = mysqli_fetch_row($sqlItemExpense)) {
                    echo '<tr>
              <td><input type="checkbox" class="checkthis" /></td>
              <td>' . $row[0] . '</td>
              <td>' . $row[1] . '</td>
              <td></td>
              <td></td>
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

  <!-- Modal: modalPoll -->
  <div class="modal fade right" id="modalPoll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
          <p class="heading lead" style="font-weight: bold">Thêm mới mục chi tiêu</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">×</span>
          </button>
        </div>
        <!--Body-->
        <div class="modal-body">
          <form method="POST" action="action-submit-Items.php">
            <div class="input-group mb-3">
              <span class="input-group-text border-0" id="basic-addon1">Mục chi tiêu</span>
              <input type="text" class="form-control rounded" placeholder="Thêm mục chi tiêu........" aria-describedby="basic-addon1" name="itemName" />
            </div>

            <div class="input-group mb-3">
              <span class="input-group-text border-0" id="basic-addon3">Loại danh mục</span>
              <input type="text" class="form-control rounded" aria-describedby="basic-addon1" name="categoryItem" value="Chi tiêu" readonly />
            </div>
            <div class="modal-footer justify-content-center">
              <button type="submit" class="btn btn-primary waves-effect waves-light">
                <i class="fa fa-plus"></i>
                Thêm mới
              </button>
              <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal: modalPoll -->


  <!--Modal: modalConfirmDelete-->
  <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
      <!--Content-->
      <div class="modal-content text-center">
        <!--Header-->
        <div class="modal-header d-flex justify-content-center">
          <p class="heading"><strong>Bạn có chắc chắn muốn xoá?</strong></p>
        </div>

        <!--Body-->
        <div class="modal-body">

          <i class="fas fa-times fa-4x animated rotateIn" style="color: red;"></i>

        </div>

        <!--Footer-->
        <div class="modal-footer flex-center">
          <a href="" class="btn  btn-outline-danger">Đồng ý</a>
          <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">Huỷ bỏ</a>
        </div>
      </div>
      <!--/.Content-->
    </div>
  </div>
  <!--Modal: modalConfirmDelete-->
  <?php
  include_once("common/footer.php");
  ?>
</div>
<!-- ./wrapper -->