-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306:4306
-- Generation Time: Nov 06, 2024 at 04:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laptop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- Table structure for table `bacsi`
--

CREATE TABLE `bacsi` (
  `MaBS` varchar(10) NOT NULL,
  `MaKhoa` varchar(10) DEFAULT NULL,
  `Ten` varchar(50) NOT NULL,
  `SoDienThoai` int(11) DEFAULT NULL,
  `ChuyenKhoa` varchar(50) DEFAULT NULL,
  `imge` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bacsi`
--

INSERT INTO `bacsi` (`MaBS`, `MaKhoa`, `Ten`, `SoDienThoai`, `ChuyenKhoa`, `imge`) VALUES
('120H', '1', 'Ths.Bs : Trần Khôi', 866169103, 'Chuyên khoa : Nhi', 'download (2).jfif\r\n'),
('320T', '12', 'Trần Văn B', 1634052513, 'Chuyên khoa : Răng - Hàm - Mặt', 'download (2).jfif\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `benhnhan`
--

CREATE TABLE `benhnhan` (
  `MaBN` varchar(10) NOT NULL,
  `Ten` varchar(50) NOT NULL,
  `NgaySinh` date NOT NULL,
  `GioiTinh` varchar(10) DEFAULT NULL,
  `DiaChi` varchar(100) DEFAULT NULL,
  `SoDienThoai` int(11) DEFAULT NULL,
  `ThongTinBaoHiem` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `benhnhan`
--

INSERT INTO `benhnhan` (`MaBN`, `Ten`, `NgaySinh`, `GioiTinh`, `DiaChi`, `SoDienThoai`, `ThongTinBaoHiem`) VALUES
('45B', 'Phan Thiên Khải', '2024-11-03', 'Nam', '12 Nguyễn Văn Bảo', 1634052512, '12h-450-045');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(9, 3, 15, 'BSCKII. TRẦN ĐĂNG KHOA', 0, 1, 'bs-Khoa-4x6-1-433x650.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `chitiet_thuoc`
--

CREATE TABLE `chitiet_thuoc` (
  `MaThuoc` varchar(10) NOT NULL,
  `MaDonThuoc` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donthuoc`
--

CREATE TABLE `donthuoc` (
  `MaDonThuoc` varchar(10) NOT NULL,
  `Ten` varchar(10) NOT NULL,
  `LieuLuong` float NOT NULL DEFAULT 0,
  `MaGiaoDich` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `MaGiaoDich` varchar(10) NOT NULL,
  `MaThuNgan` varchar(10) NOT NULL,
  `MaBN` varchar(10) NOT NULL,
  `MaDonThuoc` varchar(10) NOT NULL,
  `Ngay` date DEFAULT curdate(),
  `SoTien` decimal(18,2) NOT NULL,
  `PhuongThucThanhToan` varchar(20) DEFAULT NULL CHECK (`PhuongThucThanhToan` in ('Pending','Approved','Rejected'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khoakham`
--

CREATE TABLE `khoakham` (
  `MaKhoa` varchar(10) NOT NULL,
  `MaPhong` varchar(10) NOT NULL,
  `TenKhoa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `khoakham`
--

INSERT INTO `khoakham` (`MaKhoa`, `MaPhong`, `TenKhoa`) VALUES
('1', '1B', 'Nhi'),
('12', '23C', 'Răng - Hàm -Mặt'),
('23', '1', 'Tim Mạch');

-- --------------------------------------------------------

--
-- Table structure for table `lichhen`
--

CREATE TABLE `lichhen` (
  `MaLichHen` varchar(10) NOT NULL,
  `MaBS` varchar(10) NOT NULL,
  `MaBN` varchar(10) NOT NULL,
  `Ngay` date NOT NULL,
  `Gio` time NOT NULL,
  `STT` int(11) NOT NULL,
  `PhongKham` varchar(15) NOT NULL,
  `KhoaKham` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `lichhen`
--

INSERT INTO `lichhen` (`MaLichHen`, `MaBS`, `MaBN`, `Ngay`, `Gio`, `STT`, `PhongKham`, `KhoaKham`) VALUES
('123', '120H', '45B', '2024-11-14', '22:19:29', 12, '12', 'răng');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(2, 0, 'Phan Thiên Khải', 'phanthienkhai111@gmail.com', '0384104942', 'Yêu em');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phieukhambenh`
--

CREATE TABLE `phieukhambenh` (
  `MaPhieu` varchar(10) NOT NULL,
  `MaBS` varchar(10) NOT NULL,
  `NgayGio` datetime NOT NULL,
  `TinhTrang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `phieukhambenh`
--

INSERT INTO `phieukhambenh` (`MaPhieu`, `MaBS`, `NgayGio`, `TinhTrang`) VALUES
('1478', '120H', '2024-11-07 21:49:00', 'ưq');

-- --------------------------------------------------------

--
-- Table structure for table `phongkham`
--

CREATE TABLE `phongkham` (
  `MaPhong` varchar(10) NOT NULL,
  `SoPhong` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `phongkham`
--

INSERT INTO `phongkham` (`MaPhong`, `SoPhong`) VALUES
('1', '013'),
('1B', '012'),
('23C', '014');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `khoa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `text`, `image`, `description`, `khoa`) VALUES
(14, 'THẠC SĨ, BS LÊ THỊ THU HÀ', 'Khoa nhi', 'Bác sĩ uy tín nhất bệnh viện', 'BS-HA-KHOA-DD.png', NULL, ''),
(15, 'BSCKII. TRẦN ĐĂNG KHOA', 'Khoa tổng quát', 'Bác sĩ uy tín nhất bệnh viện', 'bs-Khoa-4x6-1-433x650.jpg', NULL, ''),
(16, 'BSCKII ĐỖ HỮU LƯƠNG', 'Khoa tai mũi họng', 'Bác sĩ uy tín nhất bệnh viện haha', 'CNK_YHTT.jpg', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `thungan`
--

CREATE TABLE `thungan` (
  `MaThuNgan` varchar(10) NOT NULL,
  `Ten` varchar(50) NOT NULL,
  `Tien` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thuoc`
--

CREATE TABLE `thuoc` (
  `MaThuoc` varchar(10) NOT NULL,
  `Ten` varchar(50) NOT NULL,
  `DangThuoc` varchar(20) NOT NULL,
  `SoLuongTon` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tintuc`
--

CREATE TABLE `tintuc` (
  `id` int(1) NOT NULL,
  `imge` text NOT NULL,
  `name` text NOT NULL,
  `name1` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tintuc`
--

INSERT INTO `tintuc` (`id`, `imge`, `name`, `name1`) VALUES
(1, 'k.jpg', 'Khai giảng Khóa 4: Hồi sức cấp cứu cơ bản', 'Ngày 14/10/2024 Bệnh viện Nhân dân 115 tiếp tục tổ chức Khai giảng Lớp đào tạo Hồi sức cấp cứu cơ bản Khóa 4 ngắn hạn cho nhân viên y tế đang công tác tại các Cơ sở khám chữa bệnh trên địa bàn Thành phố Hồ Chí Minh.'),
(2, 'khoi1.jpg', 'Nhân 1 trường hợp đột ngột ngưng tim khi nội soi, Bác sĩ cảnh báo điều gì?', 'Tại khoa Cấp cứu BV Nhân dân 115, Người bệnh tỉnh táo, được hỗ trợ bóp bóng qua nội khí quản, sinh hiệu ổn. Điện tâm đồ đo tại Khoa Cấp cứu ghi nhận ST chênh lên ở chuyển đạo aVR....'),
(3, 'khoi2.jpg', 'Cập nhật kiến thức y khoa liên tục về Bệnh viêm ruột tại Bệnh viện  \r\n', 'Bệnh viêm ruột (IBD) là một trong những bệnh lý tiêu hóa ngày càng trở nên phổ biến và phức tạp. Để nâng cao chất lượng chẩn đoán và điều trị bệnh lý này, Bệnh viện Nhân dân 115 tổ chức chương trình cập nhật kiến thức y khoa liên tục');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(3, 'Phan Thiên Khải', 'phanthienkhai111@gmail.com', '0384104942', '722efb822db49574f7cdc65bafc8436d4b0e2acd', '12, Nguyễn Văn Bảo, Phường 4, TP.Hồ Chí Minh, Hồ Chí Minh, Việt Nam - 1234');

-- --------------------------------------------------------

--
-- Table structure for table `xetnghiem`
--

CREATE TABLE `xetnghiem` (
  `MaXetNghiem` varchar(20) NOT NULL,
  `MaPhieu` varchar(10) NOT NULL,
  `Ten` varchar(50) NOT NULL,
  `Ngay` date NOT NULL,
  `KetQua` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `yeucaubaohiem`
--

CREATE TABLE `yeucaubaohiem` (
  `MaYeuCau` varchar(10) NOT NULL,
  `MaBN` varchar(10) NOT NULL,
  `MaDonThuoc` varchar(10) NOT NULL,
  `MaXetNghiem` varchar(20) NOT NULL,
  `SoTienYeuCau` decimal(18,2) NOT NULL,
  `TinhTrang` varchar(20) DEFAULT NULL CHECK (`TinhTrang` in ('Pending','Approved','Rejected'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bacsi`
--
ALTER TABLE `bacsi`
  ADD PRIMARY KEY (`MaBS`),
  ADD KEY `MaKhoa` (`MaKhoa`);

--
-- Indexes for table `benhnhan`
--
ALTER TABLE `benhnhan`
  ADD PRIMARY KEY (`MaBN`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chitiet_thuoc`
--
ALTER TABLE `chitiet_thuoc`
  ADD PRIMARY KEY (`MaThuoc`),
  ADD KEY `MaDonThuoc` (`MaDonThuoc`);

--
-- Indexes for table `donthuoc`
--
ALTER TABLE `donthuoc`
  ADD PRIMARY KEY (`MaDonThuoc`),
  ADD KEY `MaGiaoDich` (`MaGiaoDich`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`MaGiaoDich`),
  ADD KEY `MaThuNgan` (`MaThuNgan`),
  ADD KEY `MaBN` (`MaBN`),
  ADD KEY `MaDonThuoc` (`MaDonThuoc`);

--
-- Indexes for table `khoakham`
--
ALTER TABLE `khoakham`
  ADD PRIMARY KEY (`MaKhoa`),
  ADD KEY `MaPhong` (`MaPhong`);

--
-- Indexes for table `lichhen`
--
ALTER TABLE `lichhen`
  ADD PRIMARY KEY (`MaLichHen`),
  ADD KEY `MaBS` (`MaBS`),
  ADD KEY `MaBN` (`MaBN`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phieukhambenh`
--
ALTER TABLE `phieukhambenh`
  ADD PRIMARY KEY (`MaPhieu`),
  ADD KEY `MaBS` (`MaBS`);

--
-- Indexes for table `phongkham`
--
ALTER TABLE `phongkham`
  ADD PRIMARY KEY (`MaPhong`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thungan`
--
ALTER TABLE `thungan`
  ADD PRIMARY KEY (`MaThuNgan`);

--
-- Indexes for table `thuoc`
--
ALTER TABLE `thuoc`
  ADD PRIMARY KEY (`MaThuoc`);

--
-- Indexes for table `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xetnghiem`
--
ALTER TABLE `xetnghiem`
  ADD PRIMARY KEY (`MaXetNghiem`),
  ADD KEY `MaPhieu` (`MaPhieu`);

--
-- Indexes for table `yeucaubaohiem`
--
ALTER TABLE `yeucaubaohiem`
  ADD PRIMARY KEY (`MaYeuCau`),
  ADD KEY `MaBN` (`MaBN`),
  ADD KEY `MaDonThuoc` (`MaDonThuoc`),
  ADD KEY `MaXetNghiem` (`MaXetNghiem`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bacsi`
--
ALTER TABLE `bacsi`
  ADD CONSTRAINT `bacsi_ibfk_1` FOREIGN KEY (`MaKhoa`) REFERENCES `khoakham` (`MaKhoa`);

--
-- Constraints for table `chitiet_thuoc`
--
ALTER TABLE `chitiet_thuoc`
  ADD CONSTRAINT `chitiet_thuoc_ibfk_1` FOREIGN KEY (`MaThuoc`) REFERENCES `thuoc` (`MaThuoc`),
  ADD CONSTRAINT `chitiet_thuoc_ibfk_2` FOREIGN KEY (`MaDonThuoc`) REFERENCES `donthuoc` (`MaDonThuoc`);

--
-- Constraints for table `donthuoc`
--
ALTER TABLE `donthuoc`
  ADD CONSTRAINT `donthuoc_ibfk_1` FOREIGN KEY (`MaGiaoDich`) REFERENCES `hoadon` (`MaGiaoDich`);

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`MaThuNgan`) REFERENCES `thungan` (`MaThuNgan`),
  ADD CONSTRAINT `hoadon_ibfk_2` FOREIGN KEY (`MaBN`) REFERENCES `benhnhan` (`MaBN`),
  ADD CONSTRAINT `hoadon_ibfk_3` FOREIGN KEY (`MaDonThuoc`) REFERENCES `donthuoc` (`MaDonThuoc`);

--
-- Constraints for table `khoakham`
--
ALTER TABLE `khoakham`
  ADD CONSTRAINT `khoakham_ibfk_1` FOREIGN KEY (`MaPhong`) REFERENCES `phongkham` (`MaPhong`);

--
-- Constraints for table `lichhen`
--
ALTER TABLE `lichhen`
  ADD CONSTRAINT `lichhen_ibfk_1` FOREIGN KEY (`MaBS`) REFERENCES `bacsi` (`MaBS`),
  ADD CONSTRAINT `lichhen_ibfk_2` FOREIGN KEY (`MaBN`) REFERENCES `benhnhan` (`MaBN`);

--
-- Constraints for table `phieukhambenh`
--
ALTER TABLE `phieukhambenh`
  ADD CONSTRAINT `phieukhambenh_ibfk_1` FOREIGN KEY (`MaBS`) REFERENCES `bacsi` (`MaBS`);

--
-- Constraints for table `xetnghiem`
--
ALTER TABLE `xetnghiem`
  ADD CONSTRAINT `xetnghiem_ibfk_1` FOREIGN KEY (`MaPhieu`) REFERENCES `phieukhambenh` (`MaPhieu`);

--
-- Constraints for table `yeucaubaohiem`
--
ALTER TABLE `yeucaubaohiem`
  ADD CONSTRAINT `yeucaubaohiem_ibfk_1` FOREIGN KEY (`MaBN`) REFERENCES `benhnhan` (`MaBN`),
  ADD CONSTRAINT `yeucaubaohiem_ibfk_2` FOREIGN KEY (`MaDonThuoc`) REFERENCES `donthuoc` (`MaDonThuoc`),
  ADD CONSTRAINT `yeucaubaohiem_ibfk_3` FOREIGN KEY (`MaXetNghiem`) REFERENCES `xetnghiem` (`MaXetNghiem`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
