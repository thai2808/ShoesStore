<?php
if (isset($_GET["PayID"])) {
   $PayID = $_GET["PayID"];
   $qr = "select * from paymentmethod where PayID =" . $PayID;
   $result = $con->query($qr) or die($con->error);

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $PayType = $_POST["txtPayType"];
      $sql = "UPDATE `paymentmethod` SET PayType = '$PayType' WHERE PayID =" . $PayID;
      $rs = $con->query($sql) or die($conn->error);

      if ($rs == TRUE) {
         echo "<center style='color: green;'>Sửa Thành Công</center>";
         header('location: admin.php?manage=paymentmethod');
      } else {
         echo "<center style='color: red;'>Sửa Thất Bại</center>";
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
               <h1>Sửa Phương Thức Thanh Toán</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="../admin.php">Home</a></li>
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
                     <h3 class="card-title">Sửa Phương Thức Thanh Toán</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form method="POST">
                     <div class="card-body">
                        <div class="form-group">
                           <label for="exampleInputEmail1">Phương Thức Thanh Toán</label>
                           <?php if (isset($_GET["PayID"])) {
                              $row = $result->fetch_assoc();
                           } ?>
                           <input type="text" class="form-control" id="exampleInputEmail1" name="txtPayType" value="<?=$row["PayType"];?>">
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