<?php
if (isset($_GET["ProID"])) {
   $Pid = $_GET["ProID"];
   $qr = "select * from product where ProID =" . $Pid;
   $result = $con->query($qr) or die($con->error);
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
      $img = $_FILES['fImg']['name'];
      $tmp_name = $_FILES['fImg']['tmp_name'];
      if (isset($Proname) && isset($Cate) && isset($Price) && isset($Dis) && isset($Status) && isset($Hot) && isset($Info) && isset($Sl) && isset($Bra) && isset($img)) {
         if ($img != "") {
            move_uploaded_file($tmp_name, '../img/all/' . $img);
            $sql = "UPDATE `product` SET `ProName` = '$Proname', `CateID` = '$Cate', `ProPrice` = '$Price', `ProBasisPrice` = '$Dis', `ProHot` = '$Hot', `ProStatus`='$Status', `ProPicture`='$img', `ProInfo`='$Info', `ProNumber`='$Sl', `BraID`='$Bra' WHERE ProID ='$Pid'";
            $query = mysqli_query($con, $sql);
            header('location: admin.php?manage=product');
         } else {
            $sql = "UPDATE `product` SET `ProName` = '$Proname', `CateID` = '$Cate', `ProPrice` = '$Price', `ProBasisPrice` = '$Dis', `ProHot` = '$Hot', `ProStatus`='$Status', `ProInfo`='$Info', `ProNumber`='$Sl', `BraID`='$Bra' WHERE ProID ='$Pid'";
            $query = mysqli_query($con, $sql);
            header('location: admin.php?manage=product');
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
                     <h3 class="card-title">SửaSản Phẩm</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                     <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                           <?php if (isset($_GET["ProID"])) {
                              $row_pro = $result->fetch_assoc();
                           } ?>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                 <input type="text" class="form-control" id="exampleInputEmail1" name="txtName" value="<?= $row_pro['ProName'] ?>" required>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Danh Mục</label>
                                 <select name="cbCate" class="form-control">
                                    <?php
                                    $sql_cate = "Select * from categories";
                                    $result_cate = $con->query($sql_cate) or die($con->error);
                                    while ($row_cate = $result_cate->fetch_assoc()) {
                                    ?>
                                       <option <?php
                                                if ($row_pro['CateID'] == $row_cate['CateID']) {
                                                   echo 'selected="selected"';
                                                } ?> value="<?= $row_cate['CateID'] ?>"><?= $row_cate['CateName'] ?>
                                       </option>
                                    <?php
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Gía Sản Phẩm</label>
                                 <input type="text" class="form-control" id="exampleInputEmail1" name="txtPrice" value="<?= $row_pro['ProPrice'] ?>" required>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Gía Khuyến Mãi</label>
                                 <input type="text" class="form-control" id="exampleInputEmail1" name="txtDis" value="<?= $row_pro['ProBasisPrice'] ?>" required>
                              </div>
                              <div class="form-group">
                                 <label>Trạng Thái</label>
                                 <div style="display: flex;justify-content: space-evenly;">
                                    <input type=radio value="1" name=rdStatus <?php if ($row_pro["ProStatus"] == 1) {
                                                                                 echo "checked";
                                                                              } ?>> Active
                                    <input type=radio value="0" name=rdStatus <?php if ($row_pro["ProStatus"] == 0) {
                                                                                 echo "checked";
                                                                              } ?>> Inactive
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label>Sản Phẩm Hot</label>
                                 <div>
                                    <input type=radio value="1" name=rdHot <?php if ($row_pro["ProHot"] == 1) {
                                                                              echo "checked";
                                                                           } ?>> Có

                                 </div>
                                 <div><input type=radio value="0" name=rdHot <?php if ($row_pro["ProHot"] == 0) {
                                                                                 echo "checked";
                                                                              } ?>> Không</div>
                              </div>


                              <div class="form-group">
                                 <label for="exampleInputEmail1">Thông Tin Sản Phẩm</label>
                                 <textarea class="form-control" rows="3" name="txtInfo" required><?= $row_pro['ProInfo'] ?></textarea>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Số Lượng Sản Phẩm</label>
                                 <input type="text" class="form-control" id="exampleInputEmail1" name="txtSl" value="<?= $row_pro['ProNumber'] ?>" required>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Thương Hiệu</label>
                                 <select name="cbBrand" class="form-control">
                                    <?php
                                    $sql_bra = "Select * from brand";
                                    $result_bra = $con->query($sql_bra) or die($con->error);
                                    while ($row_bra = $result_bra->fetch_assoc()) {
                                    ?>
                                       <option <?php
                                                if ($row_pro['BraID'] == $row_bra['BraID']) {
                                                   echo 'selected="selected"';
                                                } ?> value="<?= $row_bra['BraID'] ?>"><?= $row_bra['BraName'] ?>
                                       </option>
                                    <?php
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Hình Ảnh</label>
                                 <input type="file" id="fileInput" name="fImg" value="">
                                 <img src="../img/all/<?php echo $row_pro["ProPicture"]; ?>" width=120>
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