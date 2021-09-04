<?php
include_once  "dbconnect.php";

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
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0" style="text-align: center; font-weight:bold; padding: 20px">Thống kê chi tiêu</h1>
        <div class="row">
          <div class="col-md-12">
            <?php
            $sqlExpense = mysqli_query($conn, "SELECT e.expenseID,ca.categoryName,e.expenseName,i.ItemName,e.comment,e.expensePrice,e.time FROM expense as e INNER JOIN item as i ON e.itemID = i.ItemID INNER JOIN categories as ca ON ca.categoryID = e.categoryID;");
            ?>

            <div class="table-responsive">
              <table id="mytable" class="table table-bordered table-hover text-center">
                <thead>
                  <th width="200px">Ngày chi tiêu</th>
                  <th width="150px">Loại</th>
                  <th>Mục tiêu dùng</th>
                  <th>Số tiền(VNĐ)</th>
                  <th width="200px" style="padding: 5px">
                    <a type="button" class="btn btn-primary" href="expense-mng.php"><i class="far fa-edit"></i>Thêm</a>
                  </th>
                </thead>
                <tbody>
                  <?php
                  if ($sqlExpense->num_rows > 0) {
                    while ($row = $sqlExpense->fetch_assoc()) {
                      echo '<tr>
              <td style="display:none">' . $row['expenseID'] . '</td>
              <td>' . $row['time'] . '</td>
              <td>' . $row['categoryName'] . '</td>
              <td>' . $row['ItemName'] . '</td>
              <td>' . number_format($row['expensePrice'], 0, '', ',') . '</td>
              <td style="padding: 5px">
                <a class="btn btn-warning" data-toggle="modal" data-target="#modalPush" onclick="getDetailExpense(' . $row['expenseID'] . ')" data-id="' . $row["expenseID"] . '"><i class="fa fa-archive"></i> Xem</a>
                <button type="button" class="btn btn-danger" onclick="deleteExpense(' . $row['expenseID'] . ')"><i class="fa fa-times"></i> Xoá</button>
              </td>
              </tr>';
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <script>
          function getDetailExpense(expenseID) {
            $('#modalPush').on("show.bs.modal", function(e) {
              expenseID = $(e.relatedTarget).attr('data-id');
              $(this).find(".expenseID").text(expenseID);
              $.ajax({
                type: "POST",
                url: 'getdetail-expense.php',
                data: {
                  expenseID: expenseID,
                },
                success: function(reponsive) {
                  var expenseID = reponsive.split(";");
                  $("#nameExpense").val(expenseID[0]);
                  $("#itemExpense").val(expenseID[1]);
                  $("#priceExpense").val(expenseID[2]);
                  $("#commentExpense").val(expenseID[3]);
                  
                }
              });
            });
          };
        </script>

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

        <script type="text/javascript">
          function deleteExpense(expenseID) {
            option = confirm('Bạn có muốn xoá thu nhập này không')
            if (!option) {
              return;
            }
            console.log(expenseID)
            $.post('delete-expense.php', {
              'expenseID': expenseID
            }, function(data) {
              alert(data)
              location.reload()
            })
          }
        </script>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<!--Modal: modalPush-->
<div class="modal fade" id="modalPush" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content text-center">
          <h3 style="text-align: center; padding: 20px; font-weight:bold;">CHI TIẾT CHI TIÊU</h3>
          <form method="POST" action="">
            <div class="input-group mb-3">
              <p style="display: none;">ID : <span class="expenseID"></span></p>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text border-0" id="basic-addon1">Loại chi tiêu</span>
              <input type="text" class="form-control rounded" name="nameExpense" id="nameExpense" readonly/>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text border-0" id="basic-addon3">Mục chi tiêu</span>
              <input class="form-control rounded" name="itemExpense" id="itemExpense" readonly/>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text border-0">Số tiền</span>
              <input type="text" class="form-control rounded" name="priceExpense" data-type="currency" id="priceExpense" readonly/>
              <span class="input-group-text border-0">VNĐ</span>
            </div>
            <div class="input-group">
              <span class="input-group-text border-0">Ghi chú</span>
              <textarea class="form-control rounded" name="commentExpense" id="commentExpense" readonly></textarea>
            </div>
            <div class="row">
              <div class="col-sm-8"></div>
              <div class="col-sm-4">
                <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>Lưu</button>
                <a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">Huỷ</a>
              </div>
            </div>
          </form>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!--Modal: modalPush-->
  </div>
  <!-- /.content-wrapper -->
  <!-- footer -->
  <?php
  include_once("common/footer.php");
  ?>
  <!-- /.footer -->
</div>
<!-- ./wrapper -->