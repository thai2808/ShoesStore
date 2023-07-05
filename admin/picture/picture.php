<?php
$sql_count = "SELECT COUNT(*) AS total FROM picture";
$result_count = $con->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_pictures = $row_count['total'];

$pictures_per_page = 5;
$total_pages = ceil($total_pictures / $pictures_per_page);

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($current_page - 1) * $pictures_per_page;
$sql = "SELECT * FROM picture LIMIT $pictures_per_page OFFSET $offset";
$rs = $con->query($sql);
?>
<script>
   function xoabl() {
      var conf = confirm('bạn có muốn xóa ảnh này không?');
      return conf;
   }
</script>

<div class="wrapper">

   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Quản Lý Ảnh Sản Phẩm</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="../admin.php">Home</a></li>
                     <li class="breadcrumb-item active">Ảnh Sản Phẩm</li>
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
                        <a href="admin.php?manage=picture_add"><button type="submit" class="btn btn-primary">Thêm Ảnh Sản Phẩm</button></a>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <table class="table table-bordered text-center">
                           <thead>
                              <tr>
                                 <th style="width: 10px">ID</th>
                                 <th>Ảnh 1</th>
                                 <th>Ảnh 1</th>
                                 <th>Ảnh 1</th>
                                 <th>Ảnh 1</th>
                                 <th>Product ID</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php while ($row = $rs->fetch_assoc()) { ?>
                                 <tr>
                                    <td><?= $row["PicID"] ?></td>
                                    <td><img src="../img/img-pro/<?= $row["Image1"] ?>" alt="" width="200"></td>
                                    <td><img src="../img/img-pro/<?= $row["Image2"] ?>" alt="" width="200"></td>
                                    <td><img src="../img/img-pro/<?= $row["Image3"] ?>" alt="" width="200"></td>
                                    <td><img src="../img/img-pro/<?= $row["Image4"] ?>" alt="" width="200"></td>
                                    <td><?= $row["ProID"] ?></td>
                                    <td>
                                       <a href="admin.php?manage=picture_edit&PicID=<?php echo $row['PicID']; ?>"><button type="submit" class="btn btn-warning">Sửa</button>
                                          <a onclick="return xoabl();" href="picture/picture_delete.php?Del=<?= $row['PicID'] ?>"><button class="btn btn-danger">Xóa</button>
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
                              <li class="page-item"><a class="page-link" href="?manage=picture&page=1">&laquo;</a></li>
                           <?php
                           }
                           ?>
                           <?php for ($num = 1; $num <= $total_pages; $num++) { ?>
                              <?php if ($num != $current_page) { ?>
                                 <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                                    <li class="page-item"><a class="page-link" href="?manage=picture&page=<?= $num ?>"><?= $num ?></a>
                                    <?php } ?>
                                 <?php } else {
                                 ?>
                                    <li class="page-item active"><a class="page-link" href="?manage=picture&page=<?= $num ?>"><?= $num ?></a>
                                    <?php } ?>
                                 <?php } ?>
                                 <?php
                                 if ($current_page <= $total_pages - 3) {
                                 ?>
                                    <li class="page-item"><a class="page-link" href="?manage=picture&page=<?= $total_pages ?>">&raquo;</a>
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


            <!-- /.row -->
         </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->


   <!-- Control Sidebar -->
   <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
   </aside>
   <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->