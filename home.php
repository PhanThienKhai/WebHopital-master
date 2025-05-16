<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}
;

include 'components/add_cart.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Trang chủ</title>
   <link rel="shortcut icon" href="./imgs/hospital-solid.svg" type="image/x-icon">

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php
   if (isset($_SESSION['phanquyen'])) {
      if ($_SESSION['phanquyen'] === 'nhanvien') {
         require("components/user_header_doctor.php");
      } elseif ($_SESSION['phanquyen'] === 'bacsi') {
         require("components/user_header_doctor.php");
      } elseif ($_SESSION['phanquyen'] === 'benhnhan') {
         require("components/user_header_patient.php");
      }
      elseif ($_SESSION['phanquyen'] === 'tieptan') {
         require("components/user_header_tieptan.php");
      }
      elseif ($_SESSION['phanquyen'] === 'nhathuoc') {
         require("components/user_header_nhathuoc.php");
      }
   } else {
      include("components/user_header.php");
   }
   ?>

   <section class="hero">

      <div class="swiper hero-slider">

         <div class="swiper-wrapper">

            <div class="swiper-slide slide">
               <div class="content">
                  <!-- <span>mua sắm</span> -->
                  <h3>Bèo Hopital</h3>
                  <a href="./product.php" class="btn">Xem thêm</a>
               </div>
               <div class="image">
                  <img src="imgs/Raffles_Hospital.png" alt="">
               </div>
            </div>

            <div class="swiper-slide slide">
               <div class="content">
                  <!-- <span>mua sắm</span> -->
                  <h4>TỰ HÀO LÀ BỆNH VIỆN ĐA KHOA HẠNG I</h4>
                  <a href="./product.php" class="btn">Xem thêm</a>
               </div>
               <div class="image">
                  <img src="imgs/cover-home-6.jpg" alt="">
               </div>
            </div>

            <div class="swiper-slide slide">
               <div class="content">
                  <!-- <span>mua sắm</span> -->
                  <h4>"THÂN THIỆN ĐỊNH HƯỚNG HIỆN ĐẠI" <br>LÀ CHÂM NGÔN CỦA BỆNH VIỆN</h4>
                  <a href="./product.php" class="btn">Xem thêm</a>
               </div>
               <div class="image">
                  <img src="imgs/cover-home-5.jpg" alt="">
               </div>
            </div>

            <div class="swiper-slide slide">
               <div class="content">
                  <!-- <span>mua sắm</span> -->
                  <h4>TRANG THIẾT BỊ - CƠ SỞ VẬT CHẤT HIỆN ĐẠI <br> ĐÁP ỨNG NHU CẦU BỆNH NHÂN </h4>
                  <a href="./product.php" class="btn">Xem thêm</a>
               </div>
               <div class="image">
                  <img src="imgs/cover-home-3.jpg " alt="">
               </div>
            </div>

         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>

   <section class="category">

      <h1 class="title">DỊCH VỤ CỦA CHÚNG TÔI</h1>

      <div class="box-container">

         <a href="datlich.php" class="box">
            <img src="imgs/calendar-days-regular.svg" class="icon_svg" alt="">
            <h3>Đạt lịch khám</h3>
         </a>

         <a href="admin_nhathuoc.php" class="box">
            <img src="imgs/people-group-solid.svg" alt="">
            <h3>Quản lí thuốc</h3>
         </a>

         <a href="category.php?category=msi" class="box">
            <img src="imgs/money-check-dollar-solid.svg" alt="">
            <h3>Quản lý BHYT</h3>
         </a>

         <!-- <a href="category.php?category=razer" class="box">
            <img src="imgs/razer.png" alt="">
            <h3>razer</h3>
         </a> -->

      </div>

   </section>


   <section class="products">

      <h1 class="title">TIN TỨC & HOẠT ĐỘNG</h1>

      <div class="box-container">

         <?php
         $select_products = $conn->prepare("SELECT * FROM `tintuc` LIMIT 6");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
               ?>
               <form action="" method="post" class="box">

                  <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                  <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                  <input type="hidden" name="new" value="<?= $fetch_products['name1']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_products['imge']; ?>">
                  <a class="fas fa-eye"></a>

                  <img src="uploaded_img/<?= $fetch_products['imge']; ?>" alt="">
                  <div class="name">
                     <?= $fetch_products['name']; ?>
                  </div>
                  <div class="new">
                     <?= $fetch_products['name1']; ?>
                  </div>
               </form>
               <?php
            }
         } else {
            echo '<p class="empty">Không có thoong tin để hiển thị!</p>';
         }
         ?>

      </div>

      <div class="more-btn">
         <a href="#" class="btn">Xem tất cả</a>
      </div>

      <section class="content">
         <h1 class="title">THÔNG BÁO MỚI NHẤT</h1>

         <div class="box-container">

            <?php
            $select_products = $conn->prepare("SELECT * FROM `bacsi` LIMIT 6");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
               while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <form action="" method="post" class="box">
                     <input type="hidden" name="pid" value="<?= $fetch_products['MaBS']; ?>">
                     <input type="hidden" name="name" value="<?= $fetch_products['Ten']; ?>">
                     <input type="hidden" name="price" value=" <?= $fetch_products['ChuyenKhoa']; ?>">
                     <input type="hidden" name="image" value="<?= $fetch_products['imge']; ?>">
                     <a class="fas fa-eye"></a>
                     <div class="image">
                        <img id="img" src="uploaded_img/<?= $fetch_products['imge']; ?>" alt="">
                     </div>
                     <div class="name-flex">
                        <div class="name">
                           <?= $fetch_products['Ten']; ?>
                        </div>
                        <div class="flex">
                           <div class="price">
                              Chuyên Khoa :
                              <?= $fetch_products['ChuyenKhoa']; ?>
                           </div>
                        </div>


                     </div>
                     <div class="profile">
                        <h1>View Profile</h1>
                     </div>
                  </form>
                  <?php
               }
            } else {
               echo '<p class="empty">Không thông tin Bác Sĩ để hiển thị!</p>';
            }
            ?>

         </div>
      </section>

      <?php include 'components/footer.php'; ?>


      <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

      <!-- custom js file link  -->
      <script src="js/script.js"></script>

      <script>
         var swiper = new Swiper(".hero-slider", {
            loop: true,
            grabCursor: true,
            effect: "flip",
            pagination: {
               el: ".swiper-pagination",
               clickable: true,
            },
         });
      </script>

</body>

</html>