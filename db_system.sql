-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2024 at 10:05 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `name`, `email`, `password`, `image`) VALUES
(1, 'Ahmed Raza Jutt', 'ahmed@gmail.com', 'ahmed123', 'assets/imgs/admin_images/.my pic.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointment`
--

CREATE TABLE `tbl_appointment` (
  `id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `hid` int(11) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `vid` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_appointment`
--

INSERT INTO `tbl_appointment` (`id`, `pid`, `hid`, `date`, `time`, `vid`, `status`) VALUES
(1, 1, 2, '2024-02-22', '12-2', 2, 'cancelled'),
(2, 5, 1, '2024-03-20', '12-2', 2, 'cancelled'),
(3, 5, 1, '2024-03-20', '12-2', 2, 'booked');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city`
--

CREATE TABLE `tbl_city` (
  `id` int(11) NOT NULL,
  `city` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_city`
--

INSERT INTO `tbl_city` (`id`, `city`) VALUES
(1, 'Karachi'),
(2, 'Lahore'),
(3, 'Islamabad'),
(4, 'Faislabad');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'hide'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`id`, `pid`, `message`, `status`) VALUES
(1, 1, 'this is very useful webapplication', 'hide'),
(2, 3, 'Covid Vaccine ', 'hide'),
(4, 1, 'hello world', 'hide');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hospital`
--

CREATE TABLE `tbl_hospital` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `cid` varchar(50) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'deactivate'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_hospital`
--

INSERT INTO `tbl_hospital` (`id`, `name`, `email`, `password`, `contact`, `cid`, `image`, `address`, `status`) VALUES
(1, 'Jinnah Hospital', 'jinnah@gmail.com', 'jinnah123', '02476846284', '2', '..//admin_panel//assets//img//hospital//Jinnah Hospital//himage4.jpeg', 'DXDEE 1102', 'activate'),
(2, 'Agha-Khan Hospital', 'aghakhan@gmail.com', 'agh123', '03320011467', '4', '..//admin_panel//assets//img//hospital//Agha-Khan Hospital//himage3.jpeg', 'ddd 1110', 'activate'),
(3, 'Zubaida Hospital', 'zubaida@gmail.com', 'zubaida123', '02224679950', '3', '..//admin_panel//assets//img//hospital//Zubaida Hospital//himage1.jpeg', 'XXEED 551', 'activate'),
(4, 'Liaquat National Hosiptal', 'liaquat@gmail.com', 'liaquat123', '22534872456', '3', 'assets/images/patient-images/liaquat@gmail.com/himage4.jpeg', 'Xadsfa DSDW DSAFASD ', 'activate'),
(5, 'Shaista Clicnic', 'shaista@gmail.com', 'shaista123', '22545685551', '4', '..//admin_panel//assets//img//hospital//Shaista Clicnic//Cost of Many.jpg', 'dfadfdfewqewr', 'activate');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient`
--

CREATE TABLE `tbl_patient` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `cid` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'activate'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_patient`
--

INSERT INTO `tbl_patient` (`id`, `name`, `email`, `password`, `contact`, `cid`, `address`, `image`, `gender`, `status`) VALUES
(1, 'Ahmed Raza', 'ahmed@gmail.com', 'ahmed123', '02332215467', '1', 'XYZ 123 ABD', '..//admin_panel//assets//img//patients////my pic 2.jpg', 'male', 'activate'),
(3, 'Muhammad Raza', 'raza@gmail.com', 'raza123', '03269243547', '2', 'XYZ 123 ABC', '../orthoc/assets/images/patient-images/raza@gmail.com/WhatsApp Image 2023-11-04 at 22.38.03_5679082c.jpg', 'male', 'activate'),
(4, 'Wahab Khan', 'wahab@gmail.com', 'wahab123', '03278255747', '3', '00d streeet', '../orthoc/assets/images/patient-images/wahab@gmail.com/Screenshot 2024-02-16 144011.png', 'male', 'activate'),
(5, 'wahaj', 'wahaj@gmail.com', 'wahaj123', '03112544780', '2', 'asdfasdfaswe', '..//admin_panel//assets//img//patients////my pic on eid.png', 'male', 'activate');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `id` int(11) NOT NULL,
  `heading` varchar(500) NOT NULL,
  `para` text NOT NULL,
  `btn_name` varchar(200) NOT NULL,
  `btn_src` varchar(300) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'hide'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `heading`, `para`, `btn_name`, `btn_src`, `status`) VALUES
(2, 'slide heading', 'This is slide of slider', 'Covid-test', '../orthoc/covid-test.php', 'show'),
(4, 'Our Doctor\'s Says', 'Asadsf adjkflajlja  jadklfjkl naenklae klweklna', 'Book Appointment', '../orthoc/book_appointment.php', 'show');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_test`
--

CREATE TABLE `tbl_test` (
  `id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `hid` int(11) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `result` varchar(50) DEFAULT 'process'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_test`
--

INSERT INTO `tbl_test` (`id`, `pid`, `hid`, `date`, `result`) VALUES
(1, 1, 1, '2024-04-17', 'negative'),
(2, 4, 3, NULL, 'process'),
(3, 5, 1, '2024-03-29', 'positive');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vaccine`
--

CREATE TABLE `tbl_vaccine` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_vaccine`
--

INSERT INTO `tbl_vaccine` (`id`, `name`, `status`) VALUES
(1, 'Sinopharm', 'available'),
(2, 'Sinovac', 'available'),
(6, 'CanSino', 'available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_city`
--
ALTER TABLE `tbl_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_hospital`
--
ALTER TABLE `tbl_hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_test`
--
ALTER TABLE `tbl_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vaccine`
--
ALTER TABLE `tbl_vaccine`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_city`
--
ALTER TABLE `tbl_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_hospital`
--
ALTER TABLE `tbl_hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_test`
--
ALTER TABLE `tbl_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_vaccine`
--
ALTER TABLE `tbl_vaccine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
