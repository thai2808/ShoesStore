<?php
$sql_count = "SELECT COUNT(*) AS total FROM admin";
$result_count = $con->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_accounts = $row_count['total'];

$accounts_per_page = 1;
$total_pages = ceil($total_accounts / $accounts_per_page);

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($current_page - 1) * $accounts_per_page;
$sql = "SELECT * FROM admin LIMIT $accounts_per_page OFFSET $offset";
$rs = $con->query($sql);
?>
<script>
   function xoabl() {
      var conf = confirm('bạn có muốn xóa tài khoản này không?');
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
                     <h1>Quản Lý Tài Khoản</h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                        <li class="breadcrumb-item active">Tài Khoản</li>
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
                           <a href="admin.php?manage=account_add"><button type="submit" class="btn btn-primary">Thêm Tài Khoản</button></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                           <table class="table table-bordered text-center">
                              <thead>
                                 <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>Tên Đăng Nhập</th>
                                    <th>Mật Khẩu</th>
                                    <th>Họ và Tên</th>
                                    <th>Thao Tác</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php while ($row = $rs->fetch_assoc()) { ?>
                                    <tr>
                                       <td><?= $row["AdID"] ?></td>
                                       <td><?= $row["Username"] ?></td>
                                       <td><?= $row["Password"] ?></td>
                                       <td><?= $row["AdName"] ?></td>
                                       <td>
                                          <a href="admin.php?manage=account_edit&AdID=<?php echo $row['AdID']; ?>"><button type="submit" class="btn btn-warning">Sửa</button>
                                             <a onclick="return xoabl();" href="account/account_delete.php?Del=<?= $row['AdID'] ?>"><button class="btn btn-danger">Xóa</button>
                                       </td>
                                    </tr>
                                 <?php } ?>
                              </tbody>
                           </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                           <ul class="pagination pagination-sm m-0 float-right">
                              <ul class="pagination pagination-sm m-0 float-right">
                                 <?php
                                 if ($current_page > 3) {
                                    $first_page = 1;
                                 ?>
                                    <li class="page-item"><a class="page-link" href="?manage=account&page=1">&laquo;</a></li>
                                 <?php
                                 }
                                 ?>
                                 <?php for ($num = 1; $num <= $total_pages; $num++) { ?>
                                    <?php if ($num != $current_page) { ?>
                                       <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                                          <li class="page-item"><a class="page-link" href="?manage=account&page=<?= $num ?>"><?= $num ?></a>
                                          <?php } ?>
                                       <?php } else { ?>
                                          <li class="page-item active"><a class="page-link" href="?manage=account&page=<?= $num ?>"><?= $num ?></a>
                                          <?php } ?>
                                       <?php } ?>
                                       <?php
                                       if ($current_page <= $total_pages - 3) {
                                       ?>
                                          <li class="page-item"><a class="page-link" href="?manage=account&page=<?= $total_pages ?>">&raquo;</a>
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
