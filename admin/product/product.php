<?php
$sql_count = "SELECT COUNT(*) AS total FROM product";
$result_count = $con->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_product = $row_count['total'];

$per_page = 5;
$total_pages = ceil($total_product / $per_page);

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($current_page - 1) * $per_page;
$sql = "SELECT * FROM product LIMIT $per_page OFFSET $offset";
$rs = $con->query($sql);
// $sql = "select * from product";
// $rs = $con->query($sql);
?>

<script>
   function xoabl() {
      var conf = confirm('bạn có muốn XÓA sản phẩm này không?');
      return conf;
   }
</script>

<div class="wrapper">

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Quản Lý Danh Mục</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item active">Sản phẩm</li>
                  </ol>
               </div>
            </div>
         </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md">
                  <div class="card">
                     <div class="card-header">
                        <a href="admin.php?manage=product_add"><button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button></a>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <table class="table table-bordered text-center">
                           <thead>
                              <tr>
                                 <th style="width: 10px">ID</th>
                                 <th>Tên Sản Phẩm</th>
                                 <th>Giá Sản Phẩm</th>
                                 <th>Giá Khuyễn Mãi</th>
                                 <th>Số Lượng</th>
                                 <th>Ảnh</th>
                                 <th>Thông Tin Sản Phẩm</th>
                                 <th style="width:130px">Thao Tác</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php while ($row = $rs->fetch_assoc()) { ?>
                                 <tr>
                                    <td><?= $row["ProID"] ?></td>
                                    <td><?= $row["ProName"] ?></td>
                                    <td><?= $row["ProPrice"] ?></td>
                                    <td><?= $row["ProBasisPrice"] ?></td>
                                    <td><?= $row["ProNumber"] ?></td>
                                    <td><img src="../img/all/<?= $row["ProPicture"] ?>" alt="" width="200"></td>
                                    <td><?= $row["ProInfo"] ?></td>
                                    <td>
                                       <a href="admin.php?manage=product_edit&ProID=<?= $row["ProID"] ?>"><button type="submit" class="btn btn-warning">Sửa</button></a>
                                       <a onclick="return xoabl();" href="product/product_delete.php?Del=<?= $row['ProID'] ?>"><button class="btn btn-danger">Xóa</button></a>
                                    </td>
                                 </tr>
                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer clearfix">
                           <ul class="pagination pagination-sm m-0 float-right">
                           <?php
                           if ($current_page > 3) {
                              $first_page = 1;
                           ?>
                              <li class="page-item"><a class="page-link" href="?manage=product&page=1">&laquo;</a></li>
                           <?php
                           }
                           ?>
                           <?php for ($num = 1; $num <= $total_pages; $num++) { ?>
                              <?php if ($num != $current_page) { ?>
                                 <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                                    <li class="page-item"><a class="page-link" href="?manage=product&page=<?= $num ?>"><?= $num ?></a>
                                    <?php } ?>
                                 <?php } else {
                                 ?>
                                    <li class="page-item active"><a class="page-link" href="?manage=product&page=<?= $num ?>"><?= $num ?></a>
                                    <?php } ?>
                                 <?php } ?>
                                 <?php
                                 if ($current_page <= $total_pages - 3) {
                                 ?>
                                    <li class="page-item"><a class="page-link" href="?manage=product&page=<?= $total_pages ?>">&raquo;</a>
                                    <?php
                                 }
                                    ?>
                           </ul>
                        </div>
                  </div>
                  <!-- /.card -->
                  <!-- /.card -->
               </div>
               <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- /.row -->

            <!-- /.row -->
         </div>
      </section>

      <!-- /.row -->

      <!-- /.container-fluid -->

      <!-- /.content -->

      <!-- /.content-wrapper -->


      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
         <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
   </div>
</div>
<!-- ./wrapper -->