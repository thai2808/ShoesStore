<?php
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
      if (
         move_uploaded_file($tmp_name1, '../img/img-pro/' . $Image1) &&
         move_uploaded_file($tmp_name2, '../img/img-pro/' . $Image2) &&
         move_uploaded_file($tmp_name3, '../img/img-pro/' . $Image3) &&
         move_uploaded_file($tmp_name4, '../img/img-pro/' . $Image4)
      ) {
         // $sql = "INSERT INTO picture (Image1, Image2, Image3, Image4, ProID) 
         // VALUES ('$Image1', '$Image2', '$Image3', '$Image4', '$ProID')";
         $sql = "INSERT INTO picture (Image1, Image2, Image3, Image4, ProID) VALUES (?, ?, ?, ?, ?)";
         $stmt = mysqli_prepare($con, $sql);
         mysqli_stmt_bind_param($stmt, "ssssi", $Image1, $Image2, $Image3, $Image4, $ProID);

         if (mysqli_stmt_execute($stmt)) {
            header('location: admin.php?manage=picture');
         } else {
            echo "Lỗi khi thêm thông tin vào cơ sở dữ liệu: " . mysqli_error($con);
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
               <h1>Thêm Ảnh Sản Phẩm</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
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
            <!-- left column -->
            <div class="col-md">
               <!-- general form elements -->
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">Thêm Blog</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form method="POST" enctype="multipart/form-data">
                     <div class="card-body">
                        <div class="form-group">
                           <label>Ảnh 1</label>
                           <input type="file" name="fImage1">
                        </div>
                        <div class="form-group">
                           <label>Ảnh 2</label>
                           <input type="file" name="fImage2">
                        </div>
                        <div class="form-group">
                           <label>Ảnh 3</label>
                           <input type="file" name="fImage3">
                        </div>
                        <div class="form-group">
                           <label>Ảnh 4</label>
                           <input type="file" name="fImage4">
                        </div>
                        <div class="form-group">
                           <label>Sản Phẩm</label>
                           <select name="cbPro" class="form-control">
                              <?php
                              $sql_pro = "Select * from product";
                              $result_pro = $con->query($sql_pro) or die($con->error);
                              while ($row_pro = $result_pro->fetch_assoc()) {
                              ?>
                                 <option value="<?= $row_pro['ProID'] ?>"><?= $row_pro['ProName']."(". $row_pro['ProID'].")" ?></option>
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