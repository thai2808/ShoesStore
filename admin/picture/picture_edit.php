<?php
if (isset($_GET["PicID"])) {
   $PicID = $_GET["PicID"];
   $qr = "SELECT * FROM picture WHERE PicID =" . $PicID;
   $result = $con->query($qr) or die($con->error);
   if (isset($_POST['submit'])) {
      $Image1 = $_FILES["fImage1"]["name"];
      $tmp_name1 = $_FILES['fImage1']['tmp_name'];
      $Image2 = $_FILES["fImage2"]["name"];
      $tmp_name2 = $_FILES['fImage2']['tmp_name'];
      $Image3 = $_FILES["fImage3"]["name"];
      $tmp_name3 = $_FILES['fImage3']['tmp_name'];
      $Image4 = $_FILES["fImage4"]["name"];
      $tmp_name4 = $_FILES['fImage4']['tmp_name'];
      $ProID = $_POST['cbPro'];

      if (isset($ProID) && isset($Image1) && isset($Image2) && isset($Image3) && isset($Image4)) {
         if ($Image1 != "" && $Image2 != "" && $Image3 != "" && $Image4 != "") {
            if (
               move_uploaded_file($tmp_name1, '../img/img-pro/' . $Image1) &&
               move_uploaded_file($tmp_name2, '../img/img-pro/' . $Image2) &&
               move_uploaded_file($tmp_name3, '../img/img-pro/' . $Image3) &&
               move_uploaded_file($tmp_name4, '../img/img-pro/' . $Image4)
            ) {
               $sql = "UPDATE picture SET Image1 = '$Image1', Image2 = '$Image2', Image3 = '$Image3', Image4 = '$Image4', ProID = '$ProID' WHERE PicID = '$PicID'";
               $query = mysqli_query($con, $sql);
               header('location: admin.php?manage=picture');
            }
         }
         else{
            $sql = "UPDATE picture SET ProID = '$ProID' WHERE PicID = '$PicID'";
               $query = mysqli_query($con, $sql);
               header('location: admin.php?manage=picture');
         }
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
               <h1>Sửa Ảnh Sản Phẩm</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
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
            <!-- left column -->
            <div class="col-md">
               <!-- general form elements -->
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">Sửa Ảnh Sản Phẩm</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form method="POST" enctype="multipart/form-data">
                     <div class="card-body">
                        <div class="form-group">
                           <?php if (isset($_GET["PicID"])) {
                              $row = $result->fetch_assoc();
                           } ?>
                           <label>Ảnh 1</label>
                           <input type="file" name="fImage1">
                           <img src="../img/img-pro/<?= $row["Image1"] ?>" alt="" width="200">
                        </div>
                        <div class="form-group">
                           <label>Ảnh 2</label>
                           <input type="file" name="fImage2">
                           <img src="../img/img-pro/<?= $row["Image2"] ?>" alt="" width="200">
                        </div>
                        <div class="form-group">
                           <label>Ảnh 3</label>
                           <input type="file" name="fImage3">
                           <img src="../img/img-pro/<?= $row["Image3"] ?>" alt="" width="200">
                        </div>
                        <div class="form-group">
                           <label>Ảnh 4</label>
                           <input type="file" name="fImage4">
                           <img src="../img/img-pro/<?= $row["Image4"] ?>" alt="" width="200">
                        </div>
                        <div class="form-group">
                           <label>Product ID</label>
                           <select name="cbPro" class="form-control">
                              <?php
                              $sql_pro = "Select * from product";
                              $result_pro = $con->query($sql_pro) or die($con->error);
                              while ($row_pro = $result_pro->fetch_assoc()) {
                              ?>
                                 <option <?php if ($row['ProID'] == $row_pro['ProID']) {
                                             echo 'selected="selected"';
                                          } ?> value="<?= $row_pro['ProID'] ?>"><?php echo $row_pro['ProName'] . "(" . $row_pro['ProID'] . ")"; ?></option>
                              <?php
                              }
                              ?>
                           </select>
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