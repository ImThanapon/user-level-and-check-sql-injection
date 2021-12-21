-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2021 at 05:49 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE `users_info` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `level` varchar(200) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'user.png',
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`id`, `username`, `password`, `tel`, `address`, `level`, `img`, `name`) VALUES
(1, 'admin', '12345678', '0800605960', '39/2 หมู่ 3 ต.สามพราน อ.สามพราน จ.นครปฐม 73110 ', 'admin', 'user.png', 'Admin'),
(2, 'ausiri', '123456', '0922766755', '39/2 หมู่ 3 ต.สามพราน อ.สามพราน จ.นครปฐม 73110', 'member', 'user.png', 'Siriporn Ketbunlue'),
(3, 'nackky', '12345678', '0624316818', '6/139 หมู่ 8 ตำบลอ้อมใหญ่ อำเภอสามพราน จังหวัดนครปฐม 73160', 'employee', 'user.png', 'Tanapon Visetsung');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `page` varchar(200) NOT NULL,
  `role` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `page`, `role`, `link`, `icon`) VALUES
(1, 'Profile', 'admin1,0,employee1,member1,0,admin2,0,admin3,0,employee3,0,member3,0,0,member4,0,admin5,0,employee5,0,member5', 'profile.php', 'nav-icon far fa-id-card'),
(2, 'Control Setting', 'admin1,0,employee1,member1,0,admin2,0,admin3,0,employee3,0,member3,0,0,member4,0,admin5,0,employee5,0,member5', 'control.php', 'nav-icon fas fa-cogs'),
(3, 'Orders', 'admin1,0,employee1,member1,0,admin2,0,admin3,0,employee3,0,member3,0,0,member4,0,admin5,0,employee5,0,member5', 'order.php', 'nav-icon fas fa-receipt'),
(4, 'Purchasing', 'admin1,0,employee1,0,member1,0,admin2,0,admin3,0,employee3,0,member3,0,0,employee4,0,admin5,0,employee5,0,member5,0', 'purchase.php', 'nav-icon fas fa-money-check-alt'),
(5, 'Shop Info', 'admin1,0,employee1,0,member1,0,admin2,0,admin3,0,employee3,0,member3,0,admin4,0,employee4,0,admin5,0,employee5,0,member5,0', 'shopinfo.php', 'nav-icon fas fa-store'),
(9, 'Column', 'admin1,0,employee1,0,member1,0,admin2,0,admin3,0,employee3,0,member3,0,admin4,0,employee4,0,admin5,0,employee5,0,member5,0,0', 'column.php', 'nav-icon fas fa-columns');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users_info`
--
ALTER TABLE `users_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
