<?php
if (isset($_GET["BlogID"])) {
   $BlogID = $_GET["BlogID"];
   $qr = "select * from blog where BlogID =" . $BlogID;
   $result = $con->query($qr) or die($con->error);
   if (isset($_POST['submit'])) {
      $BlogImage = $_FILES["fBlogImage"]["name"];
      $tmp_name = $_FILES['fBlogImage']['tmp_name'];
      $BlogTittle = $_POST["txtBlogTittle"];
      $BlogDescription = $_POST["taBlogDescription"];
      $BlogContent = $_POST["taBlogContent"];
      $AdID = $_POST["cbAd"];

      if (isset($BlogImage) && isset($BlogTittle) && isset($BlogDescription) && isset($BlogContent) && isset($AdID)) {
         if ($BlogImage != "") {
            move_uploaded_file($tmp_name, '../img/blog/' . $BlogImage);
            $sql = "UPDATE blog SET BlogImage = '$BlogImage', BlogTittle ='$BlogTittle', BlogDescription ='$BlogDescription', BlogContent = '$BlogContent', AdID = '$AdID' WHERE BlogID = '$BlogID'";
            $query = mysqli_query($con, $sql);
            header('location: admin.php?manage=blog');
         } else {
            $sql = "UPDATE blog SET BlogTittle ='$BlogTittle', BlogDescription ='$BlogDescription', BlogContent = '$BlogContent', AdID = '$AdID' WHERE BlogID = '$BlogID'";
            $query = mysqli_query($con, $sql);
            header('location: admin.php?manage=blog');
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
               <h1>Sửa Blog</h1>
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
            <!-- left column -->
            <div class="col-md">
               <!-- general form elements -->
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">Sửa Blog</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form method="POST" enctype="multipart/form-data">
                     <div class="card-body">
                        <div class="form-group">
                           <?php if (isset($_GET["BlogID"])) {
                              $row = $result->fetch_assoc();
                           } ?>
                           <label>Ảnh</label>
                           <input type="file" name="fBlogImage">
                           <img src="../img/blog/<?= $row['BlogImage'] ?>" alt="" width="200">
                        </div>
                        <div class="form-group">
                           <label>Tiêu Đề</label>
                           <input type="text" class="form-control" name="txtBlogTittle" value="<?= $row["BlogTittle"]; ?>">
                        </div>
                        <div class="form-group">
                           <label>Mô Tả</label>
                           <textarea cols=10 rows=3 class="form-control" name="taBlogDescription"><?= $row["BlogDescription"] ?></textarea>
                        </div>
                        <div class="form-group">
                           <label>Nội Dung</label>
                           <textarea cols=25 rows=10 class="form-control" name="taBlogContent"><?= $row["BlogContent"] ?></textarea>
                        </div>
                        <div class="form-group">
                           <label>Admin ID</label>
                           <select name="cbAd" class="form-control">
                              <?php
                              $sql_ad = "Select * from admin";
                              $result_ad = $con->query($sql_ad) or die($con->error);
                              while ($row_ad = $result_ad->fetch_assoc()) {
                              ?>
                                 <option <?php if($row['AdID'] == $row_ad['AdID']) {
                                             echo 'selected = "selected"';
                                          } ?> value="<?= $row_ad['AdID'] ?>"><?php echo  $row_ad['AdName'] . " (" . $row_ad['AdID'] . ")" ?></option>
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