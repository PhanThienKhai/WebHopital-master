<!-- Thao My -->
<?php
include 'components/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thanh Toán</title>
   <link rel="shortcut icon" href="./imgs/icon.png" type="image/x-icon">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/checkout.css">
</head>
<body>
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Thông tin Thanh Toán</h3>
   <p><a href="home.php">Trang chủ</a> <span> / Thanh Toán</span></p>
</div>

<section class="checkout">
   <h1 class="title">Thanh Toán</h1>

   <!-- Form chính -->
   <form action="hoadon.php" method="post" class="payment-form">
      <div class="form-group">
         <label for="patient_id">Mã bệnh nhân</label>
         <input type="text" id="patient_id" name="patient_id" placeholder="Nhập mã bệnh nhân">
      </div>

      <div class="form-group">
         <label for="name">Họ tên</label>
         <input type="text" id="name" name="name" placeholder="Nhập họ tên">
      </div>

      <div class="form-group">
         <label for="department">Khoa khám</label>
         <select id="department" name="department">
            <option value="Nội">Nội</option>
            <option value="Ngoại">Ngoại</option>
            <!-- Thêm các lựa chọn khoa khám khác nếu cần -->
         </select>
      </div>

      <div class="form-group">
         <label for="consultation_fee">Tiền khám bệnh</label>
         <input type="number" id="consultation_fee" name="consultation_fee">
      </div>

      <div class="form-group">
         <label for="medicine_fee">Tiền thuốc</label>
         <input type="number" id="medicine_fee" name="medicine_fee">
      </div>

      <div class="form-group">
         <label for="test_fee">Tiền xét nghiệm</label>
         <input type="number" id="test_fee" name="test_fee">
      </div>

      <div class="form-group">
         <label for="insurance_id">Mã BHYT</label>
         <input type="text" id="insurance_id" name="insurance_id" placeholder="Nhập mã BHYT">
      </div>

      <div class="form-group">
         <label for="total_amount">Tổng tiền</label>
         <input type="number" id="total_amount" name="total_amount">
      </div>

      <div class="form-group">
         <label for="payment_method">Hình thức thanh toán</label>
         <select id="payment_method" name="payment_method" required>
            <option value="cash">Tiền mặt</option>
            <option value="MoMo">MoMo</option>
            <option value="ZaloPay">ZaloPay</option>
            <option value="Visa">Visa</option>
            <option value="PayPal">PayPal</option>
         </select>
      </div>

      <button type="submit" name="submit" class="confirm-btn">Xác nhận</button>
   </form>
</section>

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>
