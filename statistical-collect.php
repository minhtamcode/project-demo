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
        <h1 class="m-0" style="text-align: center; font-weight:bold; padding: 20px">Thống kê thu nhập</h1>
        <div class="row">
          <div class="col-md-12">
            <?php
            $sqlCollect = mysqli_query($conn, "SELECT c.collectID,ca.categoryName,c.collectName,i.ItemName,c.comment,c.collectPrice FROM collect as c INNER JOIN item as i ON c.itemID = i.ItemID INNER JOIN categories as ca ON ca.categoryID = c.categoryID;");
            ?>

            <div class="table-responsive">
              <table id="mytable" class="table table-bordered table-hover text-center">
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
              <td>' . number_format($row['collectPrice'], 0, '', ',') . '</td>
              <td style="padding: 5px">
                <button type="button" class="btn btn-warning" onclick="detailCollect(' . $row['collectID'] . ')"><i class="fa fa-archive"></i> Xem</button>
                <button type="button" class="btn btn-danger" onclick="deleteCollect(' . $row['collectID'] . ')"><i class="fa fa-times-circle"></i> Xoá</button>
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

        <script type="text/javascript">
          function detailCollect(collectID) {
            $.post('insert-collect.php', {
              'collectID': collectID,
              alert(collectID)
            })
          }
        </script>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  </div>
  <!-- /.content-wrapper -->
  <!-- footer -->
  <?php
  include_once("common/footer.php");
  ?>
  <!-- /.footer -->
</div>
<!-- ./wrapper -->