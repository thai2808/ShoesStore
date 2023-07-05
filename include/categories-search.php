<section class="hero hero-normal">
      <div class="container">
         <div class="row">
            <div class="col-lg-3">
               <div class="hero__categories">
                  <div class="hero__categories__all">
                     <i class="fa fa-bars"></i>
                     <span>Thương Hiệu</span>
                  </div>
                  <ul>
                     <?php
                     $sql1 = "SELECT * FROM brand";
                     $result1 = $con->query($sql1) or die($con->error);
                     while ($row = $result1->fetch_assoc()) {
                     ?>
                        <li><a href="shop-grid.php?BraID=<?= $row['BraID'] ?>"><?= $row['BraName'] ?></a></li>
                     <?php
                     }
                     ?>
                  </ul>
               </div>
            </div>
            <div class="col-lg-9">
               <div class="hero__search">
                  <div class="hero__search__form">
                     <form method="GET" action="">
                        <input type="text" placeholder="What do you need?" name="search-product">
                        <button type="submit" class="site-btn">SEARCH</button>
                     </form>
                  </div>
                  <div class="hero__search__phone">
                     <div class="hero__search__phone__icon">
                        <i class="fa fa-phone"></i>
                     </div>
                     <div class="hero__search__phone__text">
                        <h5>+65 11.188.888</h5>
                        <span>support 24/7 time</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>