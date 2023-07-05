<?php
// $_GET['search-product']="";
   if (isset($_GET['search-product'])) {
   $tukhoa = $_GET['search-product'];

   $sql_product2 = "SELECT * FROM product WHERE ProName LIKE '%$tukhoa%'";
   $rss = $con->query($sql_product2);
   // var_dump($result);
   
?>
   <!-- Sản Phẩm Bán Chạy -->
   <!-- Featured Section Begin -->
   <section class="featured spad">
      <div class="container text-center">
         <div class="row">
            <div class="col-lg-12">
               <div class="section-title">
                  <h4>Tìm Kiếm - <?php echo $tukhoa ?></h4>
               </div>
            </div>
         </div>
         <div class="row featured__filter">
            <?php
            
            while ($row_product2 = $rss->fetch_assoc()) {
            ?>
               <div class="col-lg-3 col-md-4 col-sm-4 product-box">
                  <div class="featured__item">
                     <a href='shop-details.php?ProID=<?php echo $row_product2['ProID']; ?> '>
                        <div class="featured__item__pic">
                           <div class="container-zoom">
                              <img src="img/all/<?php echo $row_product2['ProPicture'] ?>" alt="" class="zoom-img">
                           </div>
                     </a>
                  </div>
                  <div class="featured__item__text">
                     <h6><a href="#"><?php echo $row_product2['ProName'] ?></a></h6>
                     <h5><?php echo number_format($row_product2['ProPrice']) ?>₫
                     </h5>
                  </div>
               </div>
         </div>
   <?php
            }
?>

   <div class="col-lg col-md col-sm">
      <!-- <a href="#"><button class="btn btn-primary more" type="submit">Xem Thêm Sản Phẩm</button></a> -->
   </div>
   </section>
   <?php

// include('include/footer.php');
// exit;
}
?>
   <!-- Featured Section End -->


   <!-- Banner Begin -->
   <!-- <div class="banner">
      <div class="container">
         <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
               <div class="banner__pic">
                  <img src="img/banner/banner-shoe-1.jpg" alt="">
               </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
               <div class="banner__pic">
                  <img src="img/banner/banner-shoe-2.jpg" alt="">
               </div>
            </div>
         </div>
      </div>
   </div> -->
   <!-- Banner End -->