   <?php
   $sql_product = mysqli_query($con, 'SELECT * FROM `product` WHERE ProBasisPrice > 0 Limit 10');
   ?>
   <!-- Sản Phẩm Bán Chạy -->
   <!-- Featured Section Begin -->
   <section class="featured spad">
      <div class="container text-center">
         <div class="row">
            <div class="col-lg-12">
               <div class="section-title">
                  <h4>Sản Phẩm Sale</h4>
               </div>
            </div>
         </div>
         <div class="row featured__filter">
            <?php
            while ($row_product = mysqli_fetch_array($sql_product)) {
            ?>
               <div class="col-lg-3 col-md-4 col-sm-4 product-box">
                  <div class="featured__item">
                     <div class="featured__item__pic">
                        <a href='shop-details.php?ProID=<?php echo $row_product['ProID']; ?> '>
                           <div class="container-zoom">
                              <img src="img/all/<?php echo $row_product['ProPicture'] ?>" alt="" class="zoom-img">
                           </div>
                           <span class="badge bg-danger dis">-<?php echo round((($row_product['ProBasisPrice'] - $row_product['ProPrice']) / $row_product['ProBasisPrice']) * 100) ?>%</span>
                           <?php
                           if ($row_product['ProHot'] > 0) {
                           ?>
                              <span class="badge bg-warning hot">Hot</span>
                           <?php
                           }
                           ?>
                        </a>
                     </div>
                     <div class="featured__item__text">
                        <h6><a href="#"><?php echo $row_product['ProName'] ?></a></h6>
                        <h5><?php echo number_format($row_product['ProPrice']) ?>₫
                           <span class="text1"><s><?php echo number_format($row_product['ProBasisPrice']) ?>₫</s></span>
                        </h5>
                     </div>
                  </div>
               </div>
            <?php
            }
            ?>
            <div class="col-lg col-md col-sm">
               <a href="shop-grid.php?Category=Sale"><button class="btn btn-primary more" type="submit">Xem Thêm Sản Phẩm</button></a>
            </div>
   </section>
   <!-- Featured Section End -->
   <!-- Sản Phẩm Mới Nhất -->
   <section class="featured spad">
      <div class="container text-center">
         <div class="row">
            <div class="col-lg-12">
               <div class="section-title">
                  <h4>Sản Phẩm Mới Nhất</h4>
               </div>
            </div>
         </div>
         <div class="row featured__filter">
            <?php
            $product_date = mysqli_query($con, 'SELECT * FROM `product` ORDER BY ProDate DESC Limit 10');
            while ($row_product = mysqli_fetch_array($product_date)) {
            ?>
               <div class="col-lg-3 col-md-4 col-sm-4 product-box">
                  <div class="featured__item">
                     <div class="featured__item__pic">
                        <a href='shop-details.php?ProID=<?php echo $row_product['ProID']; ?> '>
                           <div class="container-zoom">
                              <img src="img/all/<?php echo $row_product['ProPicture'] ?>" alt="" class="zoom-img">
                           </div>
                           <?php
                           if ($row_product['ProBasisPrice'] > 0) {
                           ?>
                              <span class="badge bg-danger dis">-<?php echo round((($row_product['ProBasisPrice'] - $row_product['ProPrice']) / $row_product['ProBasisPrice']) * 100) ?>%</span>
                           <?php
                           }
                           ?>
                           <?php
                           if ($row_product['ProHot'] > 0) {
                           ?>
                              <span class="badge bg-warning hot">Hot</span>
                           <?php
                           }
                           ?>
                        </a>
                     </div>
                     <div class="featured__item__text">
                        <h6><a href="#"><?php echo $row_product['ProName'] ?></a></h6>
                        <h5><?php echo number_format($row_product['ProPrice']) ?>₫
                           <?php if ($row_product['ProBasisPrice'] > 0) { ?>
                              <span class="text1"><s><?php echo number_format($row_product['ProBasisPrice']) ?>₫</s></span>
                           <?php } ?>
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

   <section class="featured spad">
      <div class="container text-center">
         <div class="row">
            <div class="col-lg-12">
               <div class="section-title">
                  <h4>Sản Phẩm Hot</h4>
               </div>
            </div>
         </div>
         <div class="row featured__filter">
            <?php
            $product_hot = mysqli_query($con, 'SELECT * FROM `product` Where ProHot = 1 Limit 10');
            while ($row_product = mysqli_fetch_array($product_hot)) {
            ?>
               <div class="col-lg-3 col-md-4 col-sm-4 product-box">
                  <div class="featured__item">
                     <div class="featured__item__pic">
                        <a href='shop-details.php?ProID=<?php echo $row_product['ProID']; ?> '>
                           <div class="container-zoom">
                              <img src="img/all/<?php echo $row_product['ProPicture'] ?>" alt="" class="zoom-img">
                           </div>
                           <?php
                           if ($row_product['ProBasisPrice'] > 0) {
                           ?>
                              <span class="badge bg-danger dis">-<?php echo round((($row_product['ProBasisPrice'] - $row_product['ProPrice']) / $row_product['ProBasisPrice']) * 100) ?>%</span>
                           <?php
                           }
                           ?>
                              <span class="badge bg-warning hot">Hot</span>
                        </a>
                     </div>
                     <div class="featured__item__text">
                        <h6><a href="#"><?php echo $row_product['ProName'] ?></a></h6>
                        <h5><?php echo number_format($row_product['ProPrice']) ?>₫
                           <?php if ($row_product['ProBasisPrice'] > 0) { ?>
                              <span class="text1"><s><?php echo number_format($row_product['ProBasisPrice']) ?>₫</s></span>
                           <?php } ?>
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
   <!-- Banner Begin -->
   <div class="banner">
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
   </div>
   <!-- Banner End -->