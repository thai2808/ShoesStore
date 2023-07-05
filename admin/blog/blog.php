<?php
$sql_count = "SELECT COUNT(*) AS total FROM blog";
$result_count = $con->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_blogs = $row_count['total'];

$blogs_per_page = 1;
$total_pages = ceil($total_blogs / $blogs_per_page);

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($current_page - 1) * $blogs_per_page;
$sql = "SELECT * FROM blog LIMIT $blogs_per_page OFFSET $offset";
$rs = $con->query($sql);
?>
<script>
   function xoabl() {
      var conf = confirm('bạn có muốn xóa blog này không?');
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
                     <h1>Quản Lý Blog</h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../admin.php">Home</a></li>
                        <li class="breadcrumb-item active">Blog</li>
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
                           <a href="admin.php?manage=blog_add"><button type="submit" class="btn btn-primary">Thêm Blog</button></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                           <table class="table table-bordered text-center">
                              <thead>
                                 <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>Ảnh</th>
                                    <th>Tiêu Đề</th>
                                    <th>Mô Tả</th>
                                    <th>Nội Dung</th>
                                    <th>Admin ID</th>
                                    <th>Ngày Tạo</th>
                                    <th>Thao Tác</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php while ($row = $rs->fetch_assoc()) { ?>
                                    <tr>
                                       <td><?= $row["BlogID"] ?></td>
                                       <td><img src="../img/blog/<?=$row["BlogImage"]?>" alt="" width="200"></td>
                                       <td><?= $row["BlogTittle"] ?></td>
                                       <td><?= $row["BlogDescription"] ?></td>
                                       <td><?= $row["BlogContent"] ?></td>
                                       <td><?= $row["AdID"] ?></td>
                                       <td><?= $row["BlogDateCreated"] ?></td>
                                       <td>
                                          <a href="admin.php?manage=blog_edit&BlogID=<?php echo $row['BlogID']; ?>"><button type="submit" class="btn btn-warning">Sửa</button>
                                             <a onclick="return xoabl();" href="blog/blog_delete.php?Del=<?= $row['BlogID'] ?>"><button class="btn btn-danger">Xóa</button>
                                       </td>
                                    </tr>
                                 <?php } ?>
                              </tbody>
                           </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                           <ul class="pagination pagination-sm m-0 float-right">
                              <?php if ($current_page > 1) : ?>
                                 <li class="page-item"><a class="page-link" href="?manage=blog&page=1">&laquo;</a></li>
                              <?php endif; ?>
                              <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                 <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>"><a class="page-link" href="?manage=blog&page=<?= $i ?>"><?= $i ?></a></li>
                              <?php endfor; ?>
                              <?php if ($current_page < $total_pages) : ?>
                                 <li class="page-item"><a class="page-link" href="?manage=blog&page=<?=$total_pages?>">&raquo;</a></li>
                              <?php endif; ?>
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
