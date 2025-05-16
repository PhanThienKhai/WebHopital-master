<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Hồ Sơ Bệnh Án</title>
    <link rel="stylesheet" href="css/patient.css">
</head>
<body>
    <div class="container">
        <div class="profile-section">
            <div class="profile-picture">
                <img src="imgs/kha.jpg" alt="Profile Picture">
            </div>
            <div class="profile-info">
                <h2>Thông Tin Hồ Sơ Bệnh Án</h2>
                <p><strong>Họ tên:</strong> Nguyễn Thanh Kha</p>
                <p><strong>Ngày sinh:</strong> 21/07/2003</p>
                <p><strong>Giới tính:</strong> Nam</p>
                <p><strong>Số điện thoại:</strong> 0909327750</p>
            </div>
            <div class="actions">
                <button>Tìm kiếm hồ sơ bệnh án</button>
                <button>Cập nhật hồ sơ bệnh án</button>
                <button>Lưu trữ hồ sơ bệnh án</button>
            </div>
        </div>

        <div class="filter-section">
            <label for="from-date">Từ ngày</label>
            <input type="date" id="from-date" name="from-date" value="2024-09-08">
            <label for="to-date">Đến ngày</label>
            <input type="date" id="to-date" name="to-date" value="2024-09-10">
            <button>Xem các lần khám</button>
        </div>

        <div class="results-section">
            <h3>Kết quả các lần khám chữa bệnh</h3>
            <div class="result-item">
                <h4>Ngày 09/09/2024</h4>
                <div class="diagnosis">
                    <p>Ho có đàm <span class="edit-icon">✏️</span></p>
                    <p>Sổ mũi <span class="edit-icon">✏️</span></p>
                    <p>Cao huyết áp <span class="edit-icon">✏️</span></p>
                    <p>Đau dây thần kinh tọa <span class="edit-icon">✏️</span></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

