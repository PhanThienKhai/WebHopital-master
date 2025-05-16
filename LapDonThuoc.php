<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

include 'components/add_cart.php';
include './convert_currency.php';
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
   <link rel="stylesheet" href="css/LDT.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

    <div class="prescription-form">
    <h1 class="title"  style="text-align:center;">Lập Đơn Thuốc</h1>
    <form id="prescriptionForm">
            <div class="form-group">
                <label for="patient-id">Mã Bệnh Nhân</label>
                <input type="text" id="patient-id" name="patient-id" placeholder="Nhập mã bệnh nhân" required oninput="fetchPatientInfo()">
            </div>
            <div class="form-group">
                <label for="insurance-status">Trạng Thái Bảo Hiểm</label>
                <input type="text" id="insurance-status" name="insurance-status" placeholder="Trạng thái bảo hiểm" readonly>
            </div>
            <div class="form-group">
                <label for="patient-name">Tên Bệnh Nhân</label>
                <input type="text" id="patient-name" name="patient-name" placeholder="Tên bệnh nhân" readonly>
            </div>
            <div class="form-group">
                <label for="patient-dob">Năm Sinh</label>
                <input type="text" id="patient-dob" name="patient-dob" placeholder="Năm sinh" readonly>
            </div>
            <div class="form-group">
                <label for="patient-gender">Giới Tính</label>
                <input type="text" id="patient-gender" name="patient-gender" placeholder="Giới tính" readonly>
            </div>
            <div class="form-group">
                <label for="patient-phone">Số Điện Thoại</label>
                <input type="text" id="patient-phone" name="patient-phone" placeholder="Số điện thoại" readonly>
            </div>
            <div class="form-group">
                <label for="medicine">Chọn Thuốc</label>
                <button type="button" id="chooseMedicine" class="btn-choose">Chọn Thuốc</button>
            </div>
            <div id="selectedMedicines" class="medicine-list"></div>
            <div class="form-group">
                <label for="notes">Ghi Chú</label>
                <textarea id="notes" name="notes" rows="4" placeholder="Nhập ghi chú nếu có"></textarea>
            </div>
            <div class="form-group">
            <button type="submit" class="btn-submit">Thêm vào Đơn Thuốc</button>
            </div>
        </form>
        <div class="message" id="message"></div>
    </div>

    <script>
        // Danh sách bệnh nhân mẫu
        const patients = {
            "BN001": { name: "Nguyễn Văn A", birthYear: 1990, gender: "Nam", phone: "0123456789", insurance: "Có" },
            "BN002": { name: "Trần Thị B", birthYear: 1985, gender: "Nữ", phone: "0987654321", insurance: "Không" },
        };

        // Hàm tìm thông tin bệnh nhân
        function populatePatientInfo() {
            const patientId = document.getElementById("patient-id").value;
            const patientInfo = patientData[patientId];

            if (patientInfo) {
                document.getElementById("patient-info").style.display = "block";
                document.getElementById("patient-name").textContent = patientInfo.name;
                document.getElementById("patient-birth-year").textContent = patientInfo.birthYear;
                document.getElementById("patient-gender").textContent = patientInfo.gender;
                document.getElementById("patient-phone").textContent = patientInfo.phone;
                document.getElementById("insurance-status").value = patientInfo.insurance;
            } else {
                document.getElementById("patient-info").style.display = "none";
                document.getElementById("insurance-status").value = "";
            }
        }
    </script>
        <div class="medicine-table" id="medicineTable">
        <h3>Danh Sách Thuốc</h3>
        <div class="search-bar">
            <input type="text" id="searchMedicine" placeholder="Tìm kiếm thuốc..." onkeyup="searchMedicine()">
        </div>
        <table id="medicineList">
            <tr>
                <th>Tên Thuốc</th>
                <th>Tồn Kho</th>
                <th>Số Lượng</th>
                <th>Chọn</th>
            </tr>
            <tr class="medicine-row">
                <td>Paracetamol</td>
                <td>100</td>
                <td><input type="number" id="qty-Paracetamol" min="1" placeholder="Số lượng"></td>
                <td><button onclick="addMedicine('Paracetamol', 100)">Thêm</button></td>
            </tr>
            <tr class="medicine-row">
                <td>Ibuprofen</td>
                <td>50</td>
                <td><input type="number" id="qty-Ibuprofen" min="1" placeholder="Số lượng"></td>
                <td><button onclick="addMedicine('Ibuprofen', 50)">Thêm</button></td>
            </tr>
            <tr class="medicine-row">
                <td>Amoxicillin</td>
                <td>75</td>
                <td><input type="number" id="qty-Amoxicillin" min="1" placeholder="Số lượng"></td>
                <td><button onclick="addMedicine('Amoxicillin', 75)">Thêm</button></td>
            </tr>
        </table>
        <button class="btn-close" onclick="closeMedicineTable()">Đóng</button>
    </div>

    <script>
        document.getElementById("chooseMedicine").onclick = function() {
            document.getElementById("medicineTable").style.display = "block";
        };

        function closeMedicineTable() {
            document.getElementById("medicineTable").style.display = "none";
        }

        function addMedicine(medicineName, stock) {
            const qtyInput = document.getElementById("qty-" + medicineName);
            const quantity = parseInt(qtyInput.value);

            if (quantity && quantity <= stock) {
                const selectedMedicines = document.getElementById("selectedMedicines");
                const newItem = document.createElement("div");
                newItem.className = "medicine-item";
                newItem.innerHTML = `
                    <span>${medicineName} - ${quantity}</span>
                    <button onclick="removeMedicine(this)">Xóa</button>
                `;
                selectedMedicines.appendChild(newItem);
                qtyInput.value = ""; // Reset quantity
                closeMedicineTable();
            } else if (quantity > stock) {
                alert(`Không đủ tồn kho cho ${medicineName}. Chỉ còn ${stock} đơn vị.`);
            } else {
                alert("Vui lòng nhập số lượng cho " + medicineName);
            }
        }

        function removeMedicine(element) {
            element.parentElement.remove();
        }

        function searchMedicine() {
            const filter = document.getElementById("searchMedicine").value.toLowerCase();
            const rows = document.getElementsByClassName("medicine-row");

            for (let row of rows) {
                const medicineName = row.cells[0].textContent.toLowerCase();
                row.style.display = medicineName.includes(filter) ? "" : "none";
            }
        }

        document.getElementById("prescriptionForm").addEventListener("submit", function(event) {
            event.preventDefault();
            document.getElementById("message").textContent = "Đơn thuốc đã được thêm thành công!";
            document.getElementById("prescriptionForm").reset();
            document.getElementById("selectedMedicines").innerHTML = "";
        });
    </script>
   <?php include 'components/footer.php'; ?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>