<?php
include_once  "dbconnect.php";

?>
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/analytics.png" height="200" width="200">
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
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0" style="text-align: center; font-weight:bold;">Thống kê - báo cáo</h1>

        <div class="row">
          <div class="col-md-12">

            <h4 style="font-weight: bold">Thống kê Thu Nhập</h4>

            <?php
            $sqlCollect = mysqli_query($conn, "SELECT c.collectID,ca.categoryName,c.collectName,i.ItemName,c.comment,c.collectPrice FROM collect as c INNER JOIN item as i ON c.itemID = i.ItemID INNER JOIN categories as ca ON ca.categoryID = c.categoryID;");
            ?>

            <div class="table-responsive">
              <table id="mytable" class="table table-bordered table-striped text-center">
                <thead>
                  <th width="150px">Loại</th>
                  <th width="400px">Loại thu nhập</th>
                  <th>Mục tiêu dùng</th>
                  <th>Số tiền(VNĐ)</th>
                  <th width="200px" style="padding: 5px">
                    <a type="button" class="btn btn-primary" href="collect-mng.php"><i class="far fa-edit"></i>Thêm</a>
                  </th>
                </thead>
                <tbody>
                  <?php
                  if ($sqlCollect->num_rows > 0) {
                    while ($row = $sqlCollect->fetch_assoc()) {
                      echo '<tr>
              <td style="display:none">' . $row['collectID'] . '</td>
              <td>' . $row['categoryName'] . '</td>
              <td>' . $row['collectName'] . '</td>
              <td>' . $row['ItemName'] . '</td>
              <td>' . $row['collectPrice'] . '</td>
              <td style="padding: 5px">
                <button type="button" class="btn btn-danger" onclick="deleteCollect(' . $row['collectID'] . ')"><i class="fa fa-times"></i> Xoá</button>
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
          function deleteCollect(collectID) {
            option = confirm('Bạn có muốn xoá thu nhập này không')
            if (!option) {
              return;
            }
            console.log(collectID)
            $.post('delete-collect.php', {
              'collectID': collectID
            }, function(data) {
              alert(data)
              location.reload()
            })
          }
        </script>

        <div class="row">
          <div class="col-md-12">
            <h4 style=" font-weight: bold">Thống kê chi tiêu</h4>

            <?php
            $sqlExpense = mysqli_query($conn, "SELECT e.expenseID,ca.categoryName,e.expenseName,i.ItemName,e.comment,e.expensePrice FROM expense as e INNER JOIN item as i ON e.itemID = i.ItemID INNER JOIN categories as ca ON ca.categoryID = e.categoryID;");
            ?>

            <div class="table-responsive">
              <table id="mytable" class="table table-bordered table-striped text-center">
                <thead>
                  <th width="150px">Loại</th>
                  <th width="400px">Loại chi tiêu</th>
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
              <td>' . $row['categoryName'] . '</td>
              <td>' . $row['expenseName'] . '</td>
              <td>' . $row['ItemName'] . '</td>
              <td>' . $row['expensePrice'] . '</td>
              <td>
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

    <!-- Main content -->
    <div class="content">
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- footer -->
  <?php
  include_once("common/footer.php");
  ?>
  <!-- /.footer -->
</div>
<!-- ./wrapper -->