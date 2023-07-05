<?php

if (isset($_POST['submit'])) {
   $Proname = $_POST['txtName'];
   $Cate = $_POST['cbCate'];
   $Price = $_POST['txtPrice'];
   $Dis = $_POST['txtDis'];
   $Status = $_POST["rdStatus"];
   $Hot = $_POST["rdHot"];
   $Info = $_POST['txtInfo'];
   $Sl = $_POST['txtSl'];
   $Bra = $_POST['cbBrand'];

   if ($_FILES['fImg']['name'] == '') {
      $error = '<span style="color: red;">(*)</span>';
   } else {
      $img = $_FILES['fImg']['name'];
      $tmp_name = $_FILES['fImg']['tmp_name'];
   }

   if (isset($Proname) && isset($Cate) && isset($Price) && isset($Dis) && isset($Status) && isset($Hot) && isset($Info) && isset($Sl) && isset($Bra) && isset($img)) {
      move_uploaded_file($tmp_name, '../img/all/' . $img);
      $sql = "INSERT INTO `product`(`ProName`, `CateID`, `ProPrice`, `ProBasisPrice`, `ProHot`, `ProStatus`, `ProPicture`, `ProInfo`, `ProNumber`, `BraID`) VALUES ('" . $Proname . "','" . $Cate . "','" . $Price . "','" . $Dis . "','" . $Hot . "','" . $Status . "','" . $img . "','" . $Info . "','" . $Sl . "','" . $Bra . "')";
      $query = mysqli_query($con, $sql);
      header('location: admin.php?manage=product');
   }
}
?>
<script>
   function validateForm() {
      var fileInput = document.getElementById('fileInput');
      var file = fileInput.files[0];

      if (!file) {
         alert("Vui lòng chọn một file.");
         return false;
      }
   }
</script>
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
            <div class="col-lg-12">
               <!-- general form elements -->
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">Thêm Sản Phẩm</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                     <form onsubmit="return validateForm()" method="POST" enctype="multipart/form-data">
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                 <input type="text" class="form-control" id="exampleInputEmail1" name="txtName" value="" required>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Danh Mục</label>
                                 <select name="cbCate" class="form-control">
                                    <?php
                                    $sql_cate = "Select * from categories";
                                    $result_cate = $con->query($sql_cate) or die($con->error);
                                    while ($row_cate = $result_cate->fetch_assoc()) {
                                    ?>
                                       <option value="<?= $row_cate['CateID'] ?>"><?= $row_cate['CateName'] ?></option>
                                    <?php
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Gía Sản Phẩm</label>
                                 <input type="text" class="form-control" id="exampleInputEmail1" name="txtPrice" value="" required>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Gía Khuyến Mãi</label>
                                 <input type="text" class="form-control" id="exampleInputEmail1" name="txtDis" value="" required>
                              </div>
                              <div class="form-group">
                                 <label>Trạng Thái</label>
                                 <div style="display: flex;justify-content: space-evenly;">
                                    <input type=radio value="1" name=rdStatus checked> Active
                                    <input type=radio value="0" name=rdStatus> Inactive
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label>Sản Phẩm Hot</label>
                                 <div>
                                    <input type=radio value="1" name=rdHot> Có

                                 </div>
                                 <div><input type=radio value="0" name=rdHot checked> Không</div>
                              </div>


                              <div class="form-group">
                                 <label for="exampleInputEmail1">Thông Tin Sản Phẩm</label>
                                 <textarea class="form-control" rows="3" name="txtInfo" required></textarea>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Số Lượng Sản Phẩm</label>
                                 <input type="text" class="form-control" id="exampleInputEmail1" name="txtSl" value="" required>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Thương Hiệu</label>
                                 <select name="cbBrand" class="form-control">
                                    <?php
                                    $sql_bra = "Select * from brand";
                                    $result_bra = $con->query($sql_bra) or die($con->error);
                                    while ($row_bra = $result_bra->fetch_assoc()) {
                                    ?>
                                       <option value="<?= $row_bra['BraID'] ?>"><?= $row_bra['BraName'] ?></option>
                                    <?php
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Hình Ảnh</label>
                                 <input type="file" id="fileInput" name="fImg" value="">
                              </div>
                           </div>
                        </div>
                        <!-- /.card-body -->

                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>

                     </form>
                  </div>
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