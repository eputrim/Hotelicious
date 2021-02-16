-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2020 at 11:15 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotelicious`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `location` varchar(256) NOT NULL,
  `star` int(1) NOT NULL,
  `image` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `name`, `city`, `location`, `star`, `image`) VALUES
(1, 'Art Deco Luxury Hotel & Residence', 'Bandung', 'Jalan Rancabentang No. 2 Ciumbuleuit, Ciumbuleuit, Bandung, Jawa Barat, Indonesia, 40142', 5, 'artdeco.jpeg'),
(2, 'JHL Solitaire Gading Serpong', 'Tangerang', 'Jl. Gading Serpong Boulevard Barat Blok.S No. 5 , Gading Serpong, Tangerang, Banten, Indonesia, 15810', 5, 'jhl.jpeg'),
(5, 'Greenhost Boutique Hotel', 'Yogyakarta', 'Jl. Prawirotaman II No. 629, Brontokusuman, Prawirotaman Street, Mergangsan, Yogyakarta, Indonesia, 55153', 3, 'greenhost1.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_detail`
--

CREATE TABLE `hotel_detail` (
  `id` int(11) NOT NULL,
  `hotel_id` int(128) NOT NULL,
  `feature_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotel_detail`
--

INSERT INTO `hotel_detail` (`id`, `hotel_id`, `feature_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 2, 1),
(7, 2, 2),
(8, 2, 3),
(9, 2, 4),
(10, 2, 5),
(11, 4, 1),
(12, 1, 1),
(13, 4, 3),
(14, 4, 1),
(15, 4, 2),
(18, 5, 4),
(19, 5, 5),
(20, 5, 3),
(21, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_feature`
--

CREATE TABLE `hotel_feature` (
  `id` int(11) NOT NULL,
  `feature` varchar(256) NOT NULL,
  `icon` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotel_feature`
--

INSERT INTO `hotel_feature` (`id`, `feature`, `icon`) VALUES
(1, 'Parking Space', 'fas fa-parking'),
(2, 'Restaurant', 'fas fa-utensils'),
(3, '24-Hour Front Desk', 'fas fa-bell'),
(4, 'Swimming Pool', 'fas fa-swimming-pool'),
(5, 'Wi-Fi', 'fas fa-wifi');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `room_id` int(255) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `duration` int(128) NOT NULL,
  `price` int(128) NOT NULL,
  `order_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `phone`, `email`, `room_id`, `check_in`, `check_out`, `duration`, `price`, `order_date`) VALUES
(1, 2, 'kesya', '1234567890', 'kesya@gmail.com', 5, '2020-05-30', '2020-06-10', 11, 48950000, 1590678961);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `hotel_id` int(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `price` int(128) NOT NULL,
  `count` int(128) NOT NULL,
  `image` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `hotel_id`, `name`, `price`, `count`, `image`) VALUES
(1, 1, 'Deluxe Twin', 999000, 10, 'artdeco_deluxe_twin.jpeg'),
(2, 1, 'Deluxe Double', 999000, 14, 'artdeco_deluxe_double.jpeg'),
(3, 1, 'Premier', 1500000, 9, 'artdeco_premier.jpeg'),
(4, 2, 'Premier', 1150000, 21, 'jhl_premier.jpeg'),
(5, 2, 'Executive Suite', 4450000, 10, 'jhl_executive_suite.jpeg'),
(8, 5, 'Artist-Designed', 488000, 15, 'greenhost_artist_designed.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `room_detail`
--

CREATE TABLE `room_detail` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_detail`
--

INSERT INTO `room_detail` (`id`, `room_id`, `feature_id`) VALUES
(1, 1, 2),
(2, 1, 4),
(3, 1, 6),
(4, 2, 2),
(5, 2, 4),
(6, 2, 6),
(7, 3, 1),
(8, 3, 2),
(9, 3, 3),
(10, 3, 4),
(11, 3, 5),
(12, 4, 1),
(13, 4, 2),
(14, 4, 3),
(15, 4, 4),
(16, 4, 5),
(17, 5, 1),
(18, 5, 2),
(19, 5, 3),
(20, 5, 4),
(21, 5, 5),
(26, 8, 4),
(27, 8, 3),
(28, 8, 5);

-- --------------------------------------------------------

--
-- Table structure for table `room_feature`
--

CREATE TABLE `room_feature` (
  `id` int(11) NOT NULL,
  `feature` varchar(256) NOT NULL,
  `icon` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_feature`
--

INSERT INTO `room_feature` (`id`, `feature`, `icon`) VALUES
(1, 'Balcony/Terrace', 'fas fa-door-open'),
(2, 'Breakfast', 'fas fa-utensils'),
(3, 'Smoking Room', 'fas fa-smoking'),
(4, 'Coffee Maker', 'fas fa-coffee'),
(5, 'Bathub', 'fas fa-bath'),
(6, 'No Smoking Room', 'fas fa-smoking-ban');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `birthdate` date NOT NULL,
  `role_id` int(1) NOT NULL,
  `password` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL,
  `date_created` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `birthdate`, `role_id`, `password`, `image`, `date_created`) VALUES
(1, 'erika putrim', 'eputrim@gmail.com', '2000-10-19', 1, '$2y$10$SKjHF4VCrp.KAhidICL3U.vqo2HJCUjC.Iih/JwsbJypIsuXqy2ES', 'default.jpg', '1590574234'),
(2, 'kesya22', 'kesya@gmail.com', '2000-11-24', 2, '$2y$10$pTQzE/vGrZaNyHSAZJpAX.GAuQBNZuoz7QqI8A7wnrOQMO4Z.1rhi', 'nefron-300x281.jpg', '1590574436');

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(1) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `role_id`, `title`, `url`, `icon`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt'),
(2, 1, 'Hotel Management', 'admin/hotel', 'fas fa-fw fa-h-square'),
(3, 1, 'Hotel Facilities', 'admin/hotelfacility', 'fas fa-fw fa-luggage-cart'),
(4, 1, 'Room Management', 'admin/room', 'fas fa-fw fa-door-closed'),
(5, 1, 'Room Facilities', 'admin/roomfacility', 'fas fa-fw fa-door-open'),
(6, 2, 'Hotel', 'user', 'fas fa-fw fa-h-square'),
(7, 2, 'Order History', 'user/orders', 'fas fa-fw fa-history'),
(8, 2, 'My Profile', 'user/profile', 'fas fa-fw fa-user'),
(9, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit'),
(10, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_detail`
--
ALTER TABLE `hotel_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_feature`
--
ALTER TABLE `hotel_feature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_detail`
--
ALTER TABLE `room_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_feature`
--
ALTER TABLE `room_feature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `hotel_detail`
--
ALTER TABLE `hotel_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `hotel_feature`
--
ALTER TABLE `hotel_feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `room_detail`
--
ALTER TABLE `room_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `room_feature`
--
ALTER TABLE `room_feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
