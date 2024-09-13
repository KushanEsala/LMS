-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2024 at 07:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAuthorCount` ()   BEGIN
    SELECT COUNT(*) AS author_count FROM authors;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetBookCount` ()   BEGIN
    SELECT COUNT(*) AS book_count FROM books;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetCategoryCount` ()   BEGIN
    SELECT COUNT(*) AS category_count FROM category;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetIssueBookCount` ()   BEGIN
    SELECT COUNT(*) AS issued_book_count FROM issued_books;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetRequestCount` ()   BEGIN
    SELECT COUNT(*) AS request_count FROM request_book;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetReturnBookCount` ()   BEGIN
    -- Counting all returned books from the returned_books table
    SELECT COUNT(*) AS returned_book_count FROM returned_books;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetStaffCount` ()   BEGIN
    SELECT COUNT(*) AS staff_count FROM staff;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUserCount` ()   BEGIN
    SELECT COUNT(*) AS user_count FROM users;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `mobile` int(10) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `mobile`, `photo`) VALUES
(2, 'Admin', 'admin@gmail.com', '1234', 771631321, 'uploads/img.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`) VALUES
(183, 'Achini Dilhara'),
(184, 'Sarath Kumarasiri'),
(185, 'Sadeepa Kaushika'),
(186, 'Dinitha Nipunaka'),
(187, 'Anoma Samarakoon'),
(188, 'Shiromi Dilrukshi'),
(190, 'Kushan Esala');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(250) NOT NULL,
  `author_name` varchar(50) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `isbn_no` int(11) NOT NULL,
  `book_price` decimal(10,2) NOT NULL,
  `book_quantity` int(5) NOT NULL,
  `book_availability` tinyint(1) NOT NULL,
  `book_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `author_name`, `cat_id`, `isbn_no`, `book_price`, `book_quantity`, `book_availability`, `book_image`) VALUES
(37, 'Madolduwa', 'Dinitha Nipunaka', 2, 17, 300.00, 77, 1, 'IMG-20240911-WA0016.jpg'),
(38, 'Statistic & Probabilistic', 'Sadeepa Kaushika', 4, 44, 500.00, 4, 1, '66dff31fadd7c5.01585565.jpg'),
(41, 'The History of Sri Lanka', 'Achini Dilhara', 10, 12, 30.00, 3, 1, 'images.jpeg'),
(42, 'Advanced Engineering Mathematics', 'Dinitha Nipunaka', 4, 10, 500.00, 5, 0, '66e13358e7f758.49329678.jpg'),
(43, 'Python Basics', 'Kushan Esala', 1, 9, 2550.00, 12, 1, '66e134e3db0de2.36469617.jpg'),
(44, 'Teaching and Learning Secondary School Mathematics', 'Sarath Kumarasiri', 4, 86, 5000.00, 4, 0, '66e135ea347965.14551524.jpg'),
(45, 'Gamperaliya', 'Shiromi Dilrukshi', 2, 43, 7000.00, 5, 0, '66e136dac62f46.99458974.jpg'),
(46, 'C#', 'Kushan Esala', 1, 32, 5000.00, 4, 1, '66e137442c8833.54147481.jpg'),
(47, 'Secondary School Mathematics', 'Dinitha Nipunaka', 4, 31, 2500.00, 8, 1, '66e137b036a4d3.47944516.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Computer Science Engineering'),
(2, 'Novel'),
(4, 'Maths'),
(10, 'History'),
(13, 'Love');

-- --------------------------------------------------------

--
-- Table structure for table `issued_books`
--

CREATE TABLE `issued_books` (
  `i_no` int(11) NOT NULL,
  `isbn_no` int(11) NOT NULL,
  `book_name` varchar(200) NOT NULL,
  `book_author` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `issue_date` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issued_books`
--

INSERT INTO `issued_books` (`i_no`, `isbn_no`, `book_name`, `book_author`, `user_id`, `status`, `issue_date`) VALUES
(46, 12, 'The History of Sri Lanka', 'Achini Dilhara', 13, 1, '2024-09-11');

-- --------------------------------------------------------

--
-- Table structure for table `request_book`
--

CREATE TABLE `request_book` (
  `rb_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `book_name` varchar(200) NOT NULL,
  `request_date` longtext NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_book`
--

INSERT INTO `request_book` (`rb_id`, `user_id`, `book_id`, `user_name`, `book_name`, `request_date`, `status`) VALUES
(14, 13, 37, 'Dinitha ', 'Madolduwa', '2024-09-11 06:45:06', ''),
(15, 13, 38, 'Dinitha ', 'Statistic & Probabilistic', '2024-09-11 07:14:10', '0'),
(16, 20, 41, 'Kushan Esala', 'The History of Sri Lanka', '2024-09-11 08:49:15', '0');

-- --------------------------------------------------------

--
-- Table structure for table `returned_books`
--

CREATE TABLE `returned_books` (
  `r_no` int(11) NOT NULL,
  `isbn_no` int(11) NOT NULL,
  `book_name` varchar(200) NOT NULL,
  `book_author` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `return_date` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `returned_books`
--

INSERT INTO `returned_books` (`r_no`, `isbn_no`, `book_name`, `book_author`, `user_id`, `status`, `return_date`) VALUES
(11, 12, 'The History of Sri Lanka', 'Achini Dilhara', 13, 1, '2024-09-11');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `s_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mobile` int(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `job_role` varchar(100) NOT NULL,
  `salary` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`s_id`, `name`, `email`, `password`, `mobile`, `address`, `job_role`, `salary`) VALUES
(6, 'Dinitha', 'dinitha@gmail.com', '1234', 710852093, 'NO 65, 2nd lane,Kandurata sandella,Mailapitiya', 'Library Technician', 30000.00);

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `mobile` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`id`, `name`, `email`, `password`, `mobile`) VALUES
(1, 'Tech Alliance', 'techalliance@gmail.com', '1234', 710852093);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` int(10) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `reg_date` date NOT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `mobile`, `address`, `photo`, `reg_date`, `role`) VALUES
(13, 'Dinitha ', 'dinithanipunaka181@gmail.com', '$2y$10$AuGVpVo/fjAOEFvoef4biO/M4J1mZwK.40Esj07gKgL5iXYVABY/.', 710852093, 'No 65,Kandurata Sandella,Mailapitiya', 'uploads/66e0b34852d211.15199422.jpg', '2024-09-10', 'user'),
(14, 'admin', 'admin@gmail.com', '$2y$10$Inta/rpW.zDApz.U2wlCC.BCVcqIFD/NnSAYzDaCA0J7939P2TwsK', 710852093, 'No 65,Kandurata Sandella,Mailapitiya', 'uploads/66e10f6786b6f8.61381864.jpg', '2024-09-11', 'admin'),
(15, 'kaweesha lakmali rathnasiri', 'lakmalilakmalirathnasiri717@gmail.com', '$2y$10$5yM4aLVckeE78ltqEazUseVing6gSLKjeSAWFhdugKxg3lIzeri/C', 789559783, 'melsiripura', 'uploads/66e1122d7618b1.91158501.jpg', '2024-09-11', 'admin'),
(16, 'kaweesha lakmali rathnasiri', 'lakmalilakmalirathnasiri717@gmail.com', '$2y$10$lSf5VjDpC5ZCk5LwSWrAjuPXmoqQtGivrtJRF7TxIsKSa8oTNRjeK', 789559783, 'melsiripura', 'uploads/66e12f8dad4f64.98997926.jpg', '2024-09-11', 'user'),
(17, 'kaweesha lakmali rathnasiri', 'lakmalilakmalirathnasiri717@gmail.com', '$2y$10$HwsSP3x20Qu39vijoJSnI.Y5UtbVKxOBczK7mRdYcHAvT5cvsCJFq', 789559783, 'melsiripura', 'uploads/66e1302613d966.79614419.jpg', '2024-09-11', 'user'),
(18, 'kaweesha lakmali rathnasiri', 'lakmalilakmalirathnasiri717@gmail.com', '$2y$10$Kw72DxtS29s5dg/wg/hgeeOe87YOruCFlP8BEkTOuaqrSoHufTi06', 789559783, 'melsiripura', 'uploads/66e1313135d0c5.71754970.jpg', '2024-09-11', 'user'),
(19, 'kushan esala', 'kushanesalakck@gmail.com', '$2y$10$IPeEW.DS0x3rubHDg80jYOktsG965LMCC8JJxBvkY3JRoal5cORCq', 754628289, 'No 65,Kandurata Sandella,Mailapitiya', 'uploads/66e131ac330945.59350223.jpg', '2024-09-11', 'admin'),
(20, 'Kushan Esala', 'kushan123@gmail.com', '$2y$10$iSSlIjYa6Ai4fqiLBht7E..tp1HFTP.Mvc.C/M6BXikuCUBNiGLEC', 754628289, 'No 65,Kandurata Sandella,Mailapitiya', 'uploads/66e13d533dbb03.74314293.jpg', '2024-09-11', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `issued_books`
--
ALTER TABLE `issued_books`
  ADD PRIMARY KEY (`i_no`);

--
-- Indexes for table `request_book`
--
ALTER TABLE `request_book`
  ADD PRIMARY KEY (`rb_id`);

--
-- Indexes for table `returned_books`
--
ALTER TABLE `returned_books`
  ADD PRIMARY KEY (`r_no`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `issued_books`
--
ALTER TABLE `issued_books`
  MODIFY `i_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `request_book`
--
ALTER TABLE `request_book`
  MODIFY `rb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `returned_books`
--
ALTER TABLE `returned_books`
  MODIFY `r_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
