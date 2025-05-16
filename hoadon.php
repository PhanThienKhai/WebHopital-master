<!-- Thao My -->
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ POST
    $patient_id = $_POST['patient_id'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $consultation_fee = $_POST['consultation_fee'];
    $medicine_fee = $_POST['medicine_fee'];
    $test_fee = $_POST['test_fee'];
    $insurance_id = $_POST['insurance_id'];
    $total_amount = $_POST['total_amount'];
    $payment_method = $_POST['payment_method'];
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .invoice-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #333;
            line-height: 1.5;
        }
        .invoice-header, .invoice-footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-header h1 {
            font-size: 18px;
            margin: 5px 0;
        }
        .invoice-details, .invoice-items {
            width: 100%;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .invoice-items th, .invoice-items td {
            text-align: right;
            padding: 4px;
        }
        .invoice-items th {
            text-align: left;
            width: 70%;
        }
        .total {
            font-weight: bold;
            border-top: 1px solid #333;
        }
        .stamp {
            text-align: center;
            margin-top: 20px;
        }
        .invoice-footer {
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="invoice-container">
    <!-- Header -->
    <div class="invoice-header">
        <h1>BIÊN NHẬN THU VIỆN PHÍ</h1>
        <p>-----------------------------</p>
        <p>Ngày <?php echo date('d'); ?> Tháng <?php echo date('m'); ?> Năm <?php echo date('Y'); ?></p>
    </div>

    <!-- Patient Information -->
    <div class="invoice-details">
        <p><strong>Tên BN:</strong> <?php echo htmlspecialchars($name); ?></p>
        <p><strong>Mã bệnh nhân:</strong> <?php echo htmlspecialchars($patient_id); ?></p>
        <p><strong>Khoa khám:</strong> <?php echo htmlspecialchars($department); ?></p>
        <p><strong>Mã BHYT:</strong> <?php echo htmlspecialchars($insurance_id); ?></p>
    </div>

    <!-- Service and Fee Table -->
    <table class="invoice-items">
        <tr>
            <th></th>
            <th>Số tiền (VND)</th>
        </tr>
        <tr>
            <td>Khám bệnh</td>
            <td><?php echo number_format($consultation_fee); ?></td>
        </tr>
        <tr>
            <td>Tiền thuốc</td>
            <td><?php echo number_format($medicine_fee); ?></td>
        </tr>
        <tr>
            <td>Tiền xét nghiệm</td>
            <td><?php echo number_format($test_fee); ?></td>
        </tr>
        <tr class="total">
            <td>Tổng cộng:</td>
            <td><?php echo number_format($total_amount); ?></td>
        </tr>
    </table>

   

    <!-- Footer -->
    <div class="invoice-footer">
        <p><strong>Thực thu:</strong> <?php echo number_format($total_amount); ?> VND</p>
    
        <p><?php echo date('d/m/Y'); ?> - Thu Tiền</p>
    </div>
</div>

</body>
</html>


