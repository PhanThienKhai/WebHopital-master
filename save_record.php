<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lưu Trữ Hồ Sơ Bệnh Án</title>
    <link rel="stylesheet" href="css/save_record.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Quản lý hồ sơ bệnh án</h2>
            <ul>
                <li><a href="#"><span>🔍</span> Tìm kiếm hồ sơ bệnh án</a></li>
                <li><a href="#"><span>✏️</span> Cập nhật hồ sơ bệnh án</a></li>
                <li><a href="#"><span>📂</span> Lưu trữ hồ sơ bệnh án</a></li>
            </ul>
        </div>

        <div class="form-section">
            <h2>Lưu trữ hồ sơ bệnh án</h2>
            <form action="submit_record.php" method="POST">
                <label for="id">Mã định danh</label>
                <input type="text" id="id" name="id" value="21023301" readonly>

                <label for="name">Họ tên</label>
                <input type="text" id="name" name="name" value="Nguyễn Thanh Kha">

                <label for="dob">Ngày sinh</label>
                <input type="text" id="dob" name="dob" value="21/07/2003" readonly>

                <label for="gender">Giới tính</label>
                <input type="text" id="gender" name="gender" value="Nam" readonly>

                <button type="submit">Xác nhận</button>
            </form>
        </div>
    </div>
</body>
</html>
