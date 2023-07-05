<?php
   if (isset($_POST['submit'])) {
      $Cname = $_POST["txtCate"];
      $Status = $_POST["rdStatus"];
      if(isset($Cname) && isset($Status)){
      $sql = "insert into categories(CateName,CateStatus) values ('" . $Cname . "'," . $Status . ")";
      $query = mysqli_query($con, $sql);
      if ($query == TRUE) {
         $_SESSION['success_message'] = "Thêm thành công!";
         header('location: admin.php?manage=categories');
      } else {
         echo "<center style='color: red;'>SửaThất Bại</center>";
      }
   }
   }

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>General Form</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">General Form</li>
               </ol>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <!-- left column -->
            <div class="col-md">
               <!-- general form elements -->
               <div class="card card-primary">
                  <div class="card-header">
                        <h3 class="card-title">Thêm Danh Mục</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form method="POST">
                     <div class="card-body">
                        <div class="form-group">
                           <label for="exampleInputEmail1">Tên Danh Mục</label>
                           <?php if (isset($_GET["Edit_id"])) {
                              $row = $rss->fetch_assoc();
                           } ?>
                           <input type="text" class="form-control" id="exampleInputEmail1" name="txtCate" value="">
                        </div>
                        <div class="form-group">
                           <label>Trạng Thái</label>
                           <div style="padding-right: 600px;display: flex;justify-content: space-evenly;">
                              <input type=radio value="1" name=rdStatus> Active
                              <input type=radio value="0" name=rdStatus> Inactive
                           </div>
                        </div>
                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- /.card -->
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
         <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
   </section>
</div>
<!-- </body> -->

</html>