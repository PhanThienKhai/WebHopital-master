<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
}
?>

<header class="header">
    <section class="content_bg-white">

        <a href="home.php" class="logo"><i id="logo" class="fa-sharp-duotone fa-solid fa-hospital"></i>Bèo Hospital</a>

        <nav class="navbar">
            <a href="#"><i class="fa-duotone fa-solid fa-phone-volume"></i> KHẨN CẤP: 1900 10854</a>
            <a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i></i>GIỜ LÀM VIỆC: 27/7</a>
            <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>
                </i>VỊ TRÍ: TP.HCM</a>
        </nav>
    </section>
    <section class="flex">


        <nav class="navbar">
            <a href="home.php">Trang chủ</a>
            <a href="about.php">Về chúng tôi</a>

            <!-- Thêm menu thả xuống cho mục Bác sĩ -->
            <div class="dropdown">
                <a href="bacsi.php" class="dropdown-toggle">Bác sĩ</a>
                <div class="dropdown-content">
                     <a href="bacsi.php">Xem thông tin bác sĩ</a>
                 </div>
            </div>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle">Bệnh nhân</a>
                <div class="dropdown-content">
                    <a href="patient_access.php">Thông tin bệnh nhân</a>
                 </div>
            </div>
            <!-- <div class="dropdown">
                <a href="#" class="dropdown-toggle">Tiếp tân</a>
                <div class="dropdown-content">
                    <a href="patient_access.php">Thông tin tiếp tân</a>
                 </div>
            </div> -->
            <div class="dropdown">
                <a href="#" class="dropdown-toggle">Nhà thuốc</a>
                <div class="dropdown-content">
                    <a href="admin_nhathuoc.php">Quản lí thuốc</a>
                 </div>
            </div>
            <!-- <a href="lichhen.php">Lịch đã đặt</a> -->
             <a href="contact.php">Liên hệ</a>
        </nav>

        <div class="icons">
            <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
            ?>
            <a href="search.php"><i class="fas fa-search"></i></a>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(
                    <?= $total_cart_items; ?>)
                </span></a>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="menu-btn" class="fas fa-bars"></div>
        </div>

        <div class="profile">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if ($select_profile->rowCount() > 0) {
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
                <p class="name">
                    <?= $fetch_profile['name']; ?>
                </p>
                <div class="flex">
                    <a href="profile.php" class="btn">Thông tin</a>
                    <a href="components/user_logout.php" onclick="return confirm('Bạn có chắc muốn đăng xuất?');"
                        class="delete-btn">Đăng xuất</a>
                </div>
                <p class="account">
                    <a href="login.php">Đăng nhập</a> or
                    <a href="register.php">Đăng ký</a>
                </p>
                <?php
            } else {
                ?>
                <p class="name">Vui lòng đăng nhập!</p>
                <a href="login.php" class="btn">Đăng nhập</a>
                <?php
            }
            ?>
        </div>
    </section>

</header>

</header>