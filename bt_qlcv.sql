-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2021 at 02:53 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bt_qlcv`
--

-- --------------------------------------------------------

--
-- Table structure for table `chucvu`
--

CREATE TABLE `chucvu` (
  `id` int(11) NOT NULL,
  `TenChucVu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chucvu`
--

INSERT INTO `chucvu` (`id`, `TenChucVu`) VALUES
(1, 'Trưởng Phòng'),
(2, 'Phó Phòng Ban'),
(3, 'Nhân Viên'),
(4, 'Marketing'),
(5, 'Kế Toán');

-- --------------------------------------------------------

--
-- Table structure for table `congviec_cn`
--

CREATE TABLE `congviec_cn` (
  `id` int(11) NOT NULL,
  `TenCongViec` varchar(50) NOT NULL,
  `MucGia` varchar(50) NOT NULL,
  `SoNguoiLam` int(11) NOT NULL,
  `LoaiCongViec` varchar(50) NOT NULL,
  `NgayBatDau` date NOT NULL,
  `NgayKetThuc` date NOT NULL,
  `TinhTrang` varchar(50) NOT NULL,
  `MaMau` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `congviec_cn`
--

INSERT INTO `congviec_cn` (`id`, `TenCongViec`, `MucGia`, `SoNguoiLam`, `LoaiCongViec`, `NgayBatDau`, `NgayKetThuc`, `TinhTrang`, `MaMau`) VALUES
(1, 'Tháng sau đi du lịch', '5000', 3, 'đi du lịch nha trang', '2021-11-18', '2021-11-19', 'Đang Tiến Hành', '#aa1d1d'),
(2, 'Làm Bài Tập Lớn Web', '72000', 5, 'Code php cho bài tập lớn', '2021-11-05', '2021-11-07', 'Đang Tiến Hành', '#2b28cc'),
(3, 'đi ngủ', '0', 1, 'Trực Ban Hàng Tuần', '2021-11-05', '2021-11-07', 'Hoàn Thành', '#696969'),
(8, 'Marketing', '10000', 1, 'Trực Ban Hàng Tuần', '2021-11-10', '2021-11-18', 'Hoàn Thành', '#696969');

-- --------------------------------------------------------

--
-- Table structure for table `duanlon`
--

CREATE TABLE `duanlon` (
  `id` int(11) NOT NULL,
  `TenDuAn` varchar(50) NOT NULL,
  `LoaiDuAn` varchar(50) NOT NULL,
  `TinhTrang` varchar(50) NOT NULL,
  `NgayBatDau` date NOT NULL,
  `NgayKetThuc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `duanlon`
--

INSERT INTO `duanlon` (`id`, `TenDuAn`, `LoaiDuAn`, `TinhTrang`, `NgayBatDau`, `NgayKetThuc`) VALUES
(1, 'Đồ Án Web', 'Đồ Án Tốt Nghiệp', 'Đang Tiến Hành', '2021-11-07', '2021-11-08'),
(2, 'Tour Du Lịch Đà Nẵng', 'Dự án sử dụng vốn nhà nước ngoài đầu tư công', 'Đang Tiến Hành', '2021-11-07', '2021-11-08'),
(3, 'Đồ Án Java NC', 'Đồ Án Tốt Nghiệp', 'Hoàn Thành', '2021-11-07', '2021-11-08'),
(4, 'Xây Dựng Chung Cư A', 'Thầu Đồ Án', 'Đang Tiến Hành', '2021-12-06', '2021-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `loaicv`
--

CREATE TABLE `loaicv` (
  `id` int(11) NOT NULL,
  `TenLoaiCongViec` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loaicv`
--

INSERT INTO `loaicv` (`id`, `TenLoaiCongViec`) VALUES
(1, 'Trực Ban Hàng Tuần'),
(2, 'đi du lịch nha trang'),
(3, 'Code php cho bài tập lớn'),
(4, 'Code = Ngôn Ngữ JavaSwing');

-- --------------------------------------------------------

--
-- Table structure for table `loaida`
--

CREATE TABLE `loaida` (
  `id` int(11) NOT NULL,
  `TenDuAn` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loaida`
--

INSERT INTO `loaida` (`id`, `TenDuAn`) VALUES
(1, 'Thầu Đồ Án'),
(2, 'Dự án sử dụng vốn nhà nước ngoài đầu tư công'),
(3, 'Đồ Án Tốt Nghiệp');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `TenUser` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `TenUser`, `Email`, `Password`) VALUES
(1, 'admin', 'admin@admin.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `pc_congviec_dal`
--

CREATE TABLE `pc_congviec_dal` (
  `id` int(11) NOT NULL,
  `idDuAn` int(11) NOT NULL,
  `TenCongViec` varchar(50) NOT NULL,
  `MucGia` varchar(50) NOT NULL,
  `NguoiLam` varchar(50) NOT NULL,
  `LoaiCongViec` varchar(50) NOT NULL,
  `NgayBatDau` date NOT NULL,
  `NgayKetThuc` date NOT NULL,
  `TinhTrang` varchar(50) NOT NULL,
  `MaMau` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pc_congviec_dal`
--

INSERT INTO `pc_congviec_dal` (`id`, `idDuAn`, `TenCongViec`, `MucGia`, `NguoiLam`, `LoaiCongViec`, `NgayBatDau`, `NgayKetThuc`, `TinhTrang`, `MaMau`) VALUES
(1, 1, 'Thiết Kế Giao Diện', '1000', 'Nguyễn Văn Trường', 'Trực Ban Hàng Tuần', '2021-11-06', '2021-11-07', 'Hoàn Thành', '#696969'),
(3, 1, 'Code Thông Số Công Việc - Dự Án', '10000', 'Đỗ Trung Kiên', 'Trực Ban Hàng Tuần', '2021-11-07', '2021-11-08', 'Đang Tiến Hành', '#2125ab'),
(5, 1, 'Code Giao Diện Login - Logout', '2000', 'Nguyễn Đình Nguyên', 'Code php cho bài tập lớn', '2021-11-08', '2021-11-09', 'Đang Tiến Hành', '#d2d530'),
(6, 1, 'Code Check Login', '1000', 'Hứa Quang Nghĩa', 'Code php cho bài tập lớn', '2021-11-07', '2021-11-08', 'Bắt Đầu', '#14f0ec'),
(8, 3, 'Code  Giao Diện + From Kết Quả Học Tập', '10000', 'Đỗ Trung Kiên', 'Trực Ban Hàng Tuần', '2021-11-08', '2021-11-09', 'Hoàn Thành', '#696969'),
(12, 2, 'Khảo Sát Thị Trường', '2000', 'Nguyễn Văn Trường', 'đi du lịch nha trang', '2021-11-08', '2021-11-11', 'Đang Tiến Hành', '#c420d9'),
(13, 2, 'Marketing cho du khách', '10000', 'Đỗ Trung Kiên', 'đi du lịch nha trang', '2021-11-08', '2021-11-15', 'Bắt Đầu', '#647944'),
(14, 2, 'Kêu Gọi Nhà Đầu Tư Phát Triển', '72000', 'Đỗ Trung Kiên', 'Trực Ban Hàng Tuần', '2021-11-11', '2021-11-15', 'Hoàn Thành', '#696969'),
(15, 4, 'Nhận Công Nhân Xây Dựng', '72000', 'Đỗ Trung Kiên', 'Trực Ban Hàng Tuần', '2021-11-10', '2021-11-20', 'Đang Tiến Hành', '#a700f5');

-- --------------------------------------------------------

--
-- Table structure for table `tt_thanhvien`
--

CREATE TABLE `tt_thanhvien` (
  `id` int(11) NOT NULL,
  `HoTen` varchar(50) NOT NULL,
  `NgaySinh` date NOT NULL,
  `GioiTinh` varchar(50) NOT NULL,
  `TenChucVu` varchar(100) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `QueQuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tt_thanhvien`
--

INSERT INTO `tt_thanhvien` (`id`, `HoTen`, `NgaySinh`, `GioiTinh`, `TenChucVu`, `Email`, `QueQuan`) VALUES
(1, 'Đỗ Trung Kiên', '2021-11-26', 'Nam', 'Trưởng Phòng', 'kien@gmail.com', 'Nam Định'),
(21, 'Nguyễn Văn Trường', '2021-11-11', 'Nam', 'Phó Phòng Ban', 'truong@gmail.com', 'Nam Định'),
(22, 'Nguyễn Đình Nguyên', '2021-11-12', 'Nam', 'Nhân Viên', 'nguyen@gmail.com', 'Thái Bình'),
(23, 'Hứa Quang Nghĩa', '2021-11-11', 'Nam', 'Nhân Viên', 'nghia@gmail.com', 'Hòa Bình'),
(24, 'Nguyễn Kim Anh', '2021-11-18', 'Nữ', 'Kế Toán', 'anh@gmail.com', 'Nam Định'),
(25, 'Nguyễn Văn A', '2021-11-17', 'Nam', 'Marketing', 'a@gmail.com', 'Hà Nội');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `congviec_cn`
--
ALTER TABLE `congviec_cn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `duanlon`
--
ALTER TABLE `duanlon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loaicv`
--
ALTER TABLE `loaicv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loaida`
--
ALTER TABLE `loaida`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pc_congviec_dal`
--
ALTER TABLE `pc_congviec_dal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tt_thanhvien`
--
ALTER TABLE `tt_thanhvien`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `congviec_cn`
--
ALTER TABLE `congviec_cn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `duanlon`
--
ALTER TABLE `duanlon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loaicv`
--
ALTER TABLE `loaicv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loaida`
--
ALTER TABLE `loaida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pc_congviec_dal`
--
ALTER TABLE `pc_congviec_dal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tt_thanhvien`
--
ALTER TABLE `tt_thanhvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
