<?php
include_once  "dbconnect.php";
$sqlCollect = mysqli_query($conn, "SELECT ca.categoryName,c.collectName,i.ItemName,c.comment,c.collectPrice FROM collect as c INNER JOIN item as i ON c.itemID = i.ItemID INNER JOIN categories as ca ON ca.categoryID = c.categoryID WHERE i.ItemID = 9;");
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
    <?php
    include_once("common/sidebar.php");
    ?>
    <!-- /.sidebar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 style="text-align: center; font-weight: bold">Danh sách ghi nợ</h4>
                    <p style="color: red;">(*) Bạn còn <b>1000000000</b> số tiền nợ cần phải trả.</p>
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
              <td><input type="checkbox" class="checkthis"></td>
              <td>' . $row[0] . '</td>
              <td>' . $row[1] . '</td>
              <td>' . $row[2] . '</td>
              <td>' . $row[3] . '</td>
              <td>' . $row[4] . '</td>
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
    <!-- footer -->
    <?php
    include_once("common/footer.php");
    ?>
    <!-- /.footer -->
</div>
<!-- ./wrapper -->