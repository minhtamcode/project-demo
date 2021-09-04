<?php
include_once "dbconnect.php";
$sqlItemExpense = mysqli_query($conn, "SELECT i.itemID,i.ItemName FROM item as i WHERE i.categoryItem like 'Chi tiêu';");
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

      <div class="row">
        <div class="col-md-12">
          <h4 style="text-align: center; font-weight: bold">Danh mục chi tiêu</h4>
          <div class="table-responsive">

            <?php
            $sqlItemExpense = mysqli_query($conn, "SELECT i.itemID,i.ItemName FROM item as i WHERE i.categoryItem like 'Chi tiêu';");
            ?>

            <table id="mytable" class="table table-bordred table-striped">
              <thead>
                <th width="50px" style="display:none;"><input type="checkbox" id="checkall" /></th>
                <th>Mã loại chi tiêu</th>
                <th>Tên loại chi tiêu</th>
                <th width="110px">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPoll"><i class="far fa-edit"></i>Thêm</button>
                </th>
              </thead>
              <tbody>
                <?php
                if ($sqlItemExpense->num_rows > 0) {
                  while ($row = $sqlItemExpense->fetch_assoc()) {
                    echo '<tr>
              <td style="display:none;"><input type="checkbox" class="checkthis" name="checkthis" value="' . $row['itemID'] . '"></td>
              <td name="item-collect-id" style="padding-left: 50px" value="' . $row['itemID'] . '">' . $row['itemID'] . '</td>
              <td name="item-collect-name">' . $row['ItemName'] . '</td>
              <td style="padding: 5px">
                <button type="button" class="btn btn-danger" onclick="deleteItem(' . $row['itemID'] . ')"><i class="fa fa-times"></i> Xoá</button>
              </td>
              </tr>';
                  }
                }
                ?>
              </tbody>
            </table>
          </div>

          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
          </nav>

        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    function deleteItem(itemID) {
      option = confirm('Bạn có muốn xoá danh mục này không')
      if (!option) {
        return;
      }
      console.log(itemID)
      $.post('delete-item.php', {
        'itemID': itemID
      }, function(data) {
        alert(data)
        location.reload()
      })
    }
  </script>

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
          <form method="POST" action="insert-item.php">
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
              <a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">Huỷ</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal: modalPoll -->

  <?php
  include_once("common/footer.php");
  ?>
</div>
<!-- ./wrapper -->