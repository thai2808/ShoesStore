<?php
if (isset($_GET["ProID"]) && isset($_GET["ProID"])) {
   $ProID = $_GET['ProID'];
   $Size = $_GET['Size'];
   $qr = mysqli_query($con, "select * from product_sizes where ProID = '" . $ProID . "' and Size = '" . $Size . "'");

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $proid = $_POST["txtProID"];
      $size = $_POST["txtSize"];
      $sql = mysqli_query($con, "UPDATE `product_sizes` SET `ProID` = '" . $proid . "' , `Size` = '" . $size . "' where `ProID` = '" . $ProID . "' and `Size` = '" . $Size . "';");
      header('location: admin.php?manage=size');
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
               <h1>Sửa Kích Cớ</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                  <li class="breadcrumb-item active">Kích Cỡ</li>
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
                     <h3 class="card-title">Sửa Kích Cỡ</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form method="POST">
                     <div class="card-body">
                        <?php while ($row = mysqli_fetch_array($qr)) {
                        ?>
                           <div class="form-group">
                              <label for="exampleInputEmail1">Product ID</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" name="txtProID" value="<?= $row["ProID"]; ?>">
                           </div>
                           <div class="form-group">
                              <label>Size</label>
                              <input type="text" class="form-control" name="txtSize" value="<?= $row["Size"]; ?>">
                           </div>
                        <?php } ?>
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