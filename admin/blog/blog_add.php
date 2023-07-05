<?php
if (isset($_POST['submit'])) {
   $BlogImage = $_FILES["fBlogImage"]["name"];
   $tmp_name = $_FILES['fBlogImage']['tmp_name'];
   $BlogTittle = $_POST["txtBlogTittle"];
   $BlogDescription = $_POST["taBlogDescription"];
   $BlogContent = $_POST["taBlogContent"];
   $AdID = $_POST["cbAd"];

   if (isset($BlogImage) && isset($BlogTittle) && isset($BlogDescription) && isset($BlogContent) && isset($AdID)) {
      move_uploaded_file($tmp_name, '../blog/all/' . $BlogImage);
      $sql = "insert into blog(BlogImage, BlogTittle, BlogDescription, BlogContent, AdID) values ('" . $BlogImage . "','" . $BlogTittle . "','" . $BlogDescription . "','" . $BlogContent . "','" . $AdID . "')";
      $query = mysqli_query($con, $sql);
      header('location: admin.php?manage=blog');
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
               <h1>Thêm Blog</h1>
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
                  <form onsubmit="return validateForm()" method="POST" enctype="multipart/form-data">
                     <div class="card-body">
                        <div class="form-group">
                           <label>Ảnh</label>
                           <input type="file" id="fileInput" name="fBlogImage" >
                        </div>
                        <div class="form-group">
                           <label>Tiêu Đề</label>
                           <input type="text" class="form-control" name="txtBlogTittle" required>
                        </div>
                        <div class="form-group">
                           <label>Mô Tả</label>
                           <textarea cols=10 rows=3 class="form-control" name="taBlogDescription" required></textarea>
                        </div>
                        <div class="form-group">
                           <label>Nội Dung</label>
                           <textarea cols=25 rows=10 class="form-control" name="taBlogContent" required></textarea>
                        </div>
                        <div class="form-group">
                           <label>Admin ID</label>
                           <select name="cbAd" class="form-control">
                              <?php
                              $sql_ad = "Select * from admin";
                              $result_ad = $con->query($sql_ad) or die($con->error);
                              while ($row_ad = $result_ad->fetch_assoc()) {
                              ?>
                                 <option value="<?= $row_ad['AdID'] ?>"><?= $row_ad['AdName'] ?></option>
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