<?php
   if (isset($_POST['submit'])) {
      $PayType = $_POST["txtPayType"];
      if(isset($PayType)){
      $sql = "insert into paymentmethod(PayType) values ('" . $PayType . "')";
      $query = mysqli_query($con, $sql);
      header('location: admin.php?manage=paymentmethod');}
   }

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Thêm Phương Thức Thanh Toán</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="../admin.php">Home</a></li>
                  <li class="breadcrumb-item active">Thanh Toán</li>
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
                        <h3 class="card-title">Thêm Phương Thức Thanh Toán</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form method="POST">
                     <div class="card-body">
                        <div class="form-group">
                           <label for="exampleInputEmail1">Phương Thức Thanh Toán</label>
                           <input type="text" class="form-control" id="exampleInputEmail1" name="txtPayType" value="">
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