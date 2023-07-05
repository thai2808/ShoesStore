<?php
$sql_count = "SELECT COUNT(*) AS total FROM comments";
$result_count = $con->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_comment = $row_count['total'];

$per_page = 3;
$total_pages = ceil($total_comment / $per_page);

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($current_page - 1) * $per_page;
$sql = "SELECT * FROM comments LIMIT $per_page OFFSET $offset";
$rs = $con->query($sql);
   // $sql = "select * from comments";
   // $rs = $con->query($sql);
?>
<script>
   function xoabl() {
      var conf = confirm('bạn có muốn xóa bình luận này không?');
      return conf;
   }
</script>
   <div class="wrapper">
      <!-- Navbar -->


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
                        <li class="breadcrumb-item active">Comment</li>
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
                        <!-- /.card-header -->
                        <div class="card-body">
                           <table class="table table-bordered text-center">
                              <thead>
                                 <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>Thời Gian</th>
                                    <th>Comment</th>
                                    <th>Đánh Giá (Sao)</th>
                                    <th style="width: 170px">Thao Tác</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php while($row = $rs->fetch_assoc()  ){?>
                                 <tr>
                                    <td><?=$row["ComID"]?></td>
                                    <td><?=$row["ComDate"]?></td>
                                    <td><?=$row["ComContent"]?></td>
                                    <td><?=$row["Star"]?></td>
                                    <td>
                                    <a onclick="return xoabl();" href="comment/comment_delete.php?Del=<?= $row['ComID'] ?>"><button class="btn btn-danger">Xóa</button></a>
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
                              <li class="page-item"><a class="page-link" href="?manage=comment&page=1">&laquo;</a></li>
                           <?php
                           }
                           ?>
                           <?php for ($num = 1; $num <= $total_pages; $num++) { ?>
                              <?php if ($num != $current_page) { ?>
                                 <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                                    <li class="page-item"><a class="page-link" href="?manage=comment&page=<?= $num ?>"><?= $num ?></a>
                                    <?php } ?>
                                 <?php } else {
                                 ?>
                                    <li class="page-item active"><a class="page-link" href="?manage=comment&page=<?= $num ?>"><?= $num ?></a>
                                    <?php } ?>
                                 <?php } ?>
                                 <?php
                                 if ($current_page <= $total_pages - 3) {
                                 ?>
                                    <li class="page-item"><a class="page-link" href="?manage=comment&page=<?= $total_pages ?>">&raquo;</a>
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
