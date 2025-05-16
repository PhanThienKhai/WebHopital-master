<?php
include 'components/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:home.php');
}

// Lưu thông báo thành công vào session
$_SESSION['success_message'] = "Đăng ký lịch khám thành công!";

$display_data = []; // Biến lưu dữ liệu để hiển thị

if (isset($_POST['add_date'])) {
    $maLichHen = filter_var($_POST['randomNumber'], FILTER_SANITIZE_STRING);
    $maBN = filter_var($_POST['maBN'], FILTER_SANITIZE_STRING);
    $khoa = filter_var($_POST['department'], FILTER_SANITIZE_STRING);
    $ngaykham = filter_var($_POST['appointment'], FILTER_SANITIZE_STRING);
    $gio = filter_var($_POST['time'], FILTER_SANITIZE_STRING);
    $stt = filter_var($_POST['STT'], FILTER_SANITIZE_STRING);

    $query = $conn->prepare("SELECT MaBS,Ten FROM bacsi WHERE ChuyenKhoa = ? ORDER BY RAND() LIMIT 1");
    $query->execute([$khoa]);

    $check_maBN = $conn->prepare("SELECT * FROM `benhnhan` WHERE maBN = ?");
    $check_maBN->execute([$maBN]);

    if ($check_maBN->rowCount() > 0) {
        if ($query->rowCount() > 0) {
            $bs = $query->fetch(PDO::FETCH_ASSOC);
            $doctor = $bs['MaBS'];
            $tenBs = $bs['Ten'];
            $query_phong = $conn->prepare("SELECT k.TenKhoa, p.SoPhong FROM khoakham k
                                           JOIN phongkham p ON p.MaPhong = k.MaPhong
                                           WHERE k.MaKhoa = (SELECT MaKhoa FROM bacsi WHERE MaBS = ?)");
            $query_phong->execute([$doctor]);

            if ($query_phong->rowCount() > 0) {
                $phong = $query_phong->fetch(PDO::FETCH_ASSOC);
                $tenKhoa = $phong['TenKhoa'];
                $soPhong = $phong['SoPhong'];

                $insert_date = $conn->prepare("INSERT INTO `lichhen` (MaLichHen, MaBS, MaBN, Ngay, Gio, STT, PhongKham, KhoaKham)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $insert_date->execute([$maLichHen, $doctor, $maBN, $ngaykham, $gio, $stt, $soPhong, $tenKhoa]);

                // Lưu dữ liệu để hiển thị
                $display_data = [
                    'Mã lịch hẹn' => $maLichHen,
                    'Mã bệnh nhân' => $maBN,
                    'Chuyên khoa' => $khoa,
                    'Ngày khám' => $ngaykham,
                    'Giờ khám' => $gio,
                    'STT' => $stt,
                    'Phòng khám' => $soPhong,
                    'Bác sĩ' => $tenBs
                ];
            } else {
                echo "<script>alert('Không tìm thấy phòng cho bác sĩ này.');</script>";
            }
        } else {
            echo "<script>alert('Không có bác sĩ trong khoa này');</script>";
        }
    } else {
        echo "<script>alert('Mã Bệnh nhân không tồn tại!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lịch riêng</title>
    <link rel="shortcut icon" href="./imgs/hospital-solid.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- header section starts  -->
    <?php
    if (isset($_SESSION['phanquyen'])) {
        if ($_SESSION['phanquyen'] === 'nhanvien') {
            require("components/user_header_doctor.php");
        } elseif ($_SESSION['phanquyen'] === 'bacsi') {
            require("components/user_header_doctor.php");
        } elseif ($_SESSION['phanquyen'] === 'benhnhan') {
            require("components/user_header_patient.php");
        } elseif ($_SESSION['phanquyen'] === 'tieptan') {
            require("components/user_header_tieptan.php");
        } elseif ($_SESSION['phanquyen'] === 'nhathuoc') {
            require("components/user_header_nhathuoc.php");
        }
    } else {
        include("components/user_header.php");
    }
    ?> <!-- header section ends -->

    <div class="heading">
        <h3>Đặt lịch khám riêng</h3>
        <p><a href="home.php">Trang chủ</a> <span> / Đặt lịch khám riêng</span></p>
    </div>

    <section class="products">
        <div class="box-container">
 		      <div class="service">
               <div class="working-hours">
                    <h2>Giờ làm việc</h2>
                    <ul>
                        <li>Thứ hai <span>09:00 AM - 07:00 PM</span></li>
                        <li>Thứ ba <span>09:00 AM - 07:00 PM</span></li>
                        <li>Thứ tư <span>09:00 AM - 07:00 PM</span></li>
                        <li>Thứ năm <span>09:00 AM - 07:00 PM</span></li>
                        <li>Thứ sáu <span>09:00 AM - 07:00 PM</span></li>
                        <li>Thứ bảy <span>09:00 AM - 07:00 PM</span></li>
                        <li>Chủ nhật <span>Closed</span></li>
                    </ul>
                    <div class="emergency">
                        <h3>Cấp cứu</h3>
                        <p>0384104942</p>
                    </div>
                </div>
            </div>
            <div class="register">
                <div class="form-container">
                    <form method="POST">
                        <div class="form-group">
                            <label for="randomNumber">Mã lịch hẹn</label>
                            <input type="number" id="randomNumber" name="randomNumber" style="font-size: 2rem;" readonly>
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    const randomNum = Math.floor(Math.random() * 10000) + 1;
                                    document.getElementById("randomNumber").value = randomNum;
                                });
                            </script>
                        </div>

                        <div class="form-group">
                            <label for="maBN">Mã BN</label>
                            <input type="text" name="maBN" id="maBN" required>
                        </div>

                        <div class="form-group">
                            <label for="department">Khoa khám bệnh</label>
                            <select id="department" name="department">
                                <?php
                                $query = $conn->prepare("SELECT TenKhoa FROM KhoaKham");
                                $query->execute();

                                if ($query->rowCount() > 0) {
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='" . $row['TenKhoa'] . "'>" . $row['TenKhoa'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>Không có khoa</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="STT">STT</label>
                            <input type="text" name="STT" id="STT" value="" readonly>
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    let currentSTT = parseInt(localStorage.getItem("STT")) || 1;
                                    document.getElementById("STT").value = currentSTT;

                                    localStorage.setItem("STT", currentSTT + 1);
                                });
                            </script>
                        </div>

                        <div class="form-group">
                            <label for="appointment">Ngày khám</label>
                            <input type="date" name="appointment" id="appointment" required>
                        </div>

                        <div class="form-group">
                            <label for="time">Giờ khám</label>
                            <select name="time" id="time" required>
                                <?php
                                $query = $conn->prepare("SELECT DISTINCT Gio FROM lichhen ORDER BY Gio ASC");
                                $query->execute();

                                if ($query->rowCount() > 0) {
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='" . $row['Gio'] . "'>" . $row['Gio'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>Không có giờ khám</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <button type="submit" class="submit-btn" name="add_date">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Hiển thị thông tin đã lưu -->
        <?php if (!empty($display_data)) : ?>
       <div class="display-data">
         <h4>Lưu ý! Vui lòng chụp ảnh màn hình hoặc in phiếu để lưu lại thông tin.
            <br> Đồng thời đọc số thứ tự để được khám bệnh
         </h4>
        <h2>Thông tin đã đặt:</h2>
        <table class="info-table">
            <thead>
                <tr>
                    <th>Thông tin</th>
                    <th>Giá trị</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($display_data as $key => $value) : ?>
                    <tr>
                        <td><?= htmlspecialchars($key) ?></td>
                        <td><?= htmlspecialchars($value) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
       </div>
       <?php endif; ?>
    </section>

    <?php include 'components/footer.php'; ?>

    <script src="js/script.js"></script>
</body>
</html>
