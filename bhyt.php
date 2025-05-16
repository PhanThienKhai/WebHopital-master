<?php
include 'components/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
}

// Xử lý khi form được submit
if (isset($_POST['submit'])) {
   $bhyt_id = $_POST['bhyt_id'];
   $start_date = $_POST['start_date'];
   $end_date = $_POST['end_date'];
   
   // Xử lý lưu dữ liệu vào cơ sở dữ liệu nếu cần
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thêm BHYT</title>
   <link rel="shortcut icon" href="./imgs/icon.png" type="image/x-icon">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css"> 
   <!-- Đường dẫn tới CSS -->

   <!-- Custom CSS file for this specific form -->
   <link rel="stylesheet" href="css/bhyt.css"> <!-- Đường dẫn tới checkout.css -->
</head>
<body>
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <p><a href="home.php">Trang chủ</a> <span> / Quản lý BHYT</span></p>
</div>

<div class="container">
   <aside class="sidebar">
      <button onclick="window.location.href='them_bhyt.php'">Thêm BHYT</button>
      <button onclick="window.location.href='xoa_bhyt.php'">Xóa BHYT</button>
      <button onclick="window.location.href='danhsach_bhyt.php'">Danh sách BHYT</button>
   </aside>

   <section class="checkout">
     

      <form action="" method="post" class="insurance-form">
         <div class="form-group">
            <label for="bhyt_id">Số BHYT/CCCD</label>
            <input type="text" id="bhyt_id" name="bhyt_id" placeholder="Nhập số BHYT/CCCD">
         </div>

         <div class="form-group">
            <label for="start_date">Ngày bắt đầu</label>
            <input type="date" id="start_date" name="start_date">
         </div>

         <div class="form-group">
            <label for="end_date">Ngày hết hạn</label>
            <input type="date" id="end_date" name="end_date">
         </div>

         <button type="submit" name="submit" class="confirm-btn">Kiểm tra </button>
      </form>
   </section>
</div>

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html> 