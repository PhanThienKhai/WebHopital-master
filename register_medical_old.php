<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bệnh nhân</title>
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
   ?>  <!-- header section ends -->

    <div class="heading">
        <h3>Đăng kí khám bệnh</h3>
        <p><a href="home.php">Trang chủ</a> <span> /Tiếp tân</span><span> / Đăng kí khám bệnh</span></p>
    </div>

    <!-- menu section starts  -->
    <section class="products">
        <div class="box-container">
            <div class="service">
                <div class="box_register">
                    <div class="box-item">
                        <a href="#"><i class="fa-solid fa-gears"></i> Đăng kí khám bệnh</a>
                    </div>
                    <div class="box-item">
                        <a href="Register_medical_new.php"><i class="fa fa-plus-square" aria-hidden="true"></i> Bệnh
                            nhân mới</a>
                    </div>
                    <div class="box-item">
                        <a href="Register_medical_old.php"><i class="fa fa-plus-square" aria-hidden="true"></i> Bệnh
                            nhân cũ</a>
                    </div>
                </div>
            </div>
            <div class="register">
                <div class="form-container">
                    <div class="form-title">Đăng kí khám bệnh</div>
                    <form method="POST">
                        <div class="form-group">
                            <label for="randomNumber">Mã lịch hẹn</label>
                            <input type="number" id="randomNumber" name="randomNumber" style="font-size: 2rem;"
                                readonly>
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
                        <?php
                        $select_departments = $conn->prepare("SELECT * FROM `bacsi`");
                        $select_departments->execute();
                        ?>
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
                        
                        <div class="form-group" style="display: none;">
                            <label for="class">Phòng khám</label>
                            <input type="text" name="class" id="class" readonly>
                        </div>
                        <div class="form-group" style="display: none;">
                            <label for="doctor">Bác Sĩ</label>
                            <input type="text" name="doctor" id="doctor" value="" readonly>
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
                        <button type="submit" class="submit-btn" name="add_date">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['add_date'])) {
            $maLichHen = filter_var($_POST['randomNumber'], FILTER_SANITIZE_STRING);
            $maBN = filter_var($_POST['maBN'], FILTER_SANITIZE_STRING);
            $khoa = filter_var($_POST['department'], FILTER_SANITIZE_STRING);
            $ngaykham = filter_var($_POST['appointment'], FILTER_SANITIZE_STRING);
            $stt = filter_var($_POST['STT'], FILTER_SANITIZE_STRING);

            // chọn ngẫu nhiên bác sĩ ở khoa
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

                        echo "<script>
                            document.getElementById('doctor').value = '$doctor';
                            document.getElementById('class').value = '$soPhong';
                            alert('Bác sĩ được chọn: $tenBs,Chuyên khoa: $khoa ,Phòng khám: $soPhong');
                        </script>";
                    } else {
                        echo "<script>alert('Không tìm thấy phòng cho bác sĩ này.');</script>";
                    }
                } else {
                    echo "<script>alert('Không có bác sĩ trong khoa này');</script>";
                }

                $insert_date = $conn->prepare("INSERT INTO `lichhen` (MaLichHen, MaBS, MaBN, Ngay, STT, PhongKham, KhoaKham)
                   VALUES (?, ?, ?, ?, ?, ?, ?)");
                $insert_date->execute([$maLichHen, $doctor, $maBN, $ngaykham, $stt, $soPhong, $tenKhoa]);
                echo "<script>
                    alert('Thêm  Thành Công.');
                    window.location.href = 'xemthongtin.php'; 
                </script>";


            } else {
                echo "<script>alert('Mã Bệnh nhân  không đã tồn tại!');</script>";

            }
        }
        ?>
    </section>

    <!-- footer section starts  -->
    <?php include 'components/footer.php'; ?>
    <!-- footer section ends -->

    <script src="js/script.js"></script>
</body>

</html>