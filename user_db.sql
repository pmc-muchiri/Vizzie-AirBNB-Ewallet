-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 22, 2024 at 06:55 PM
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
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(100) NOT NULL DEFAULT 0,
  `name` varchar(100) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `sname` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` int(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `name`, `fname`, `sname`, `email`, `contact`, `password`, `image`) VALUES
(0, 'admin', 'vivian', 'makena', 'admin@pmc.com', 741559992, '$2y$10$Rrr88tIJ1T3AFcOEqAYQN.XBus07FdTsF1g0JXz71WulXj9GGBvFq', 'uploaded_img/660a981564873_');

-- --------------------------------------------------------

--
-- Table structure for table `bnb_details`
--

CREATE TABLE `bnb_details` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bnb_details`
--

INSERT INTO `bnb_details` (`id`, `title`, `description`, `price`, `image_path`, `time_created`) VALUES
(15, 'ert', 'asdfgh', 1234.00, 'upload_images/6626835228be4_dining-room-3108037_1920.jpg', '2024-04-22 15:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `current_fund`
--

CREATE TABLE `current_fund` (
  `user_id` int(11) NOT NULL,
  `current_balance` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `current_money`
--

CREATE TABLE `current_money` (
  `id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(11) NOT NULL,
  `transaction_code` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `deposit_amount` decimal(10,2) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `payment_gateway` varchar(50) DEFAULT NULL,
  `status` varchar(15) NOT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `transaction_code`, `email`, `deposit_amount`, `currency`, `datetime`, `payment_gateway`, `status`, `remarks`, `created_at`, `user_id`) VALUES
(142, 'TRC5-ETY24', 'admin@gmail.com', 200.00, '', '2024-04-22 10:49:46', '', 'Paid', '', '2024-04-22 07:49:46', 22),
(143, 'TRC3-NMN24', 'admin@gmail.com', 20.00, '', '2024-04-22 10:52:39', '', 'Paid', '', '2024-04-22 07:52:39', 22),
(144, 'TRC3-NMN24', 'admin@gmail.com', 20.00, '', '2024-04-22 10:55:39', '', 'Paid', '', '2024-04-22 07:55:39', 22),
(145, 'TRC3-NMN24', 'admin@gmail.com', 20.00, '', '2024-04-22 10:55:51', '', 'Paid', '', '2024-04-22 07:55:51', 22),
(146, 'TRC8-UAT24', 'admin@gmail.com', 30000.00, '', '2024-04-22 10:58:12', '', 'Paid', '', '2024-04-22 07:58:12', 22),
(147, 'TRC1-EOY24', 'admin@gmail.com', 10000.00, '', '2024-04-22 10:58:40', '', 'Paid', '', '2024-04-22 07:58:40', 22),
(148, 'TRC6-SRK24', 'admin@gmail.com', 40.00, '', '2024-04-22 11:00:56', '', 'Paid', '', '2024-04-22 08:00:56', 22),
(149, 'TRC5-NZR24', 'admin@gmail.com', 200.00, '', '2024-04-22 11:05:29', '', 'Paid', '', '2024-04-22 08:05:29', 22),
(150, 'TRC1-JSM24', 'admin@gmail.com', 20.00, '', '2024-04-22 15:08:03', '', 'Paid', '', '2024-04-22 12:08:03', 22),
(151, 'TRC3-PIS24', 'admin@gmail.com', 30000.00, '', '2024-04-22 15:08:09', '', 'Paid', '', '2024-04-22 12:08:09', 22),
(152, 'TRC5-KSF24', 'admin@gmail.com', 200.00, '', '2024-04-22 15:18:59', '', 'Paid', '', '2024-04-22 12:18:59', 22),
(153, 'TRC9-ZGQ24', 'james@gmail.com', 30000.00, '', '2024-04-22 15:33:28', '', 'Paid', '', '2024-04-22 12:33:28', 24),
(154, 'TRC2-MCF24', 'james@gmail.com', 150.00, 'USD', '2024-04-22 15:38:18', 'M-Pesa', 'Paid', '', '2024-04-22 12:38:18', 24),
(155, 'TRC3-OWR24', 'james@gmail.com', 5000.00, '', '2024-04-22 16:12:32', '', 'Paid', '', '2024-04-22 13:12:32', 24);

-- --------------------------------------------------------

--
-- Table structure for table `user_deposit_total`
--

CREATE TABLE `user_deposit_total` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_deposit` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `current_deposit` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_deposit_total`
--

INSERT INTO `user_deposit_total` (`id`, `user_id`, `total_deposit`, `created_at`, `current_deposit`) VALUES
(21, 22, 70720.00, '2024-04-22 07:55:39', 4220.00),
(22, 24, 35150.00, '2024-04-22 12:33:28', 650.00);

--
-- Triggers `user_deposit_total`
--
DELIMITER $$
CREATE TRIGGER `initialize_current_deposit` BEFORE INSERT ON `user_deposit_total` FOR EACH ROW BEGIN
    SET NEW.current_deposit = NEW.total_deposit;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `sname` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` int(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `fname`, `sname`, `email`, `contact`, `password`, `image`) VALUES
(22, 'admin', 'admin', 'admin', 'admin@gmail.com', 98765432, '$2y$10$jdNxFnK1cCe/qoiRAZ1LvOEcrypgnEk74rfbXXO7rv/Mx283btmPC', '../assets/images/6621e58cc953c_'),
(23, 'vizzie', 'vivian', 'Makena', 'vivian.makena@gmail.com', 987654326, '$2y$10$KmjaI/ymE0l44P.uWzjyOeCnnHT0OfB/8vXiP4KCJlNnZpMCtOCKG', '../assets/images/6621e71ba0e26_'),
(24, 'mwas', 'James', 'Mwangi', 'james@gmail.com', 987654, '$2y$10$myyb6Q3m.aeX9SahKbiOreKDel7kF4.uMy/kf41.7PJLZIDriI8Qa', '../assets/images/66265900018dd_');

-- --------------------------------------------------------

--
-- Table structure for table `user_wallet`
--

CREATE TABLE `user_wallet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_withdrawal` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `transaction_code` varchar(255) DEFAULT NULL,
  `withdrawal_amount` decimal(10,2) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `user_id`, `total_withdrawal`, `created_at`, `transaction_code`, `withdrawal_amount`, `email`, `currency`, `method`, `status`, `remarks`) VALUES
(93, 22, '8500', '2024-04-22 07:58:19', NULL, NULL, 'admin@gmail.com', NULL, NULL, 'paid', NULL),
(94, 22, '4500', '2024-04-22 07:58:27', NULL, NULL, 'admin@gmail.com', NULL, NULL, 'paid', NULL),
(95, 22, '8500', '2024-04-22 07:59:16', NULL, NULL, 'admin@gmail.com', NULL, NULL, 'paid', NULL),
(96, 22, '4500', '2024-04-22 08:00:34', NULL, NULL, 'admin@gmail.com', NULL, NULL, 'paid', NULL),
(97, 22, '4500', '2024-04-22 08:03:34', NULL, NULL, 'admin@gmail.com', NULL, NULL, 'paid', NULL),
(98, 22, '4500', '2024-04-22 08:03:41', NULL, NULL, 'admin@gmail.com', NULL, NULL, 'paid', NULL),
(99, 22, '4500', '2024-04-22 08:04:22', NULL, NULL, 'admin@gmail.com', NULL, NULL, 'paid', NULL),
(100, 22, '4500', '2024-04-22 08:04:29', NULL, NULL, 'admin@gmail.com', NULL, NULL, 'paid', NULL),
(101, 22, '4500', '2024-04-22 08:04:36', NULL, NULL, 'admin@gmail.com', NULL, NULL, 'paid', NULL),
(102, 22, '8500', '2024-04-22 08:04:45', NULL, NULL, 'admin@gmail.com', NULL, NULL, 'paid', NULL),
(103, 22, '3500', '2024-04-22 08:04:57', NULL, NULL, 'admin@gmail.com', NULL, NULL, 'paid', NULL),
(104, 22, '4500', '2024-04-22 12:10:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(105, 22, '15500', '2024-04-22 12:10:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(106, 22, '8500', '2024-04-22 12:24:34', NULL, NULL, 'admin@gmail.com', NULL, NULL, 'paid', NULL),
(107, 22, '15500', '2024-04-22 12:24:49', NULL, NULL, 'admin@gmail.com', NULL, NULL, 'paid', NULL),
(108, 22, '3500', '2024-04-22 12:26:34', NULL, NULL, 'admin@gmail.com', NULL, NULL, 'paid', NULL),
(109, 24, '8500', '2024-04-22 12:38:02', NULL, NULL, 'james@gmail.com', NULL, NULL, 'paid', NULL),
(110, 24, '3500', '2024-04-22 12:38:31', NULL, NULL, 'james@gmail.com', NULL, NULL, 'paid', NULL),
(111, 24, '15500', '2024-04-22 12:38:47', NULL, NULL, 'james@gmail.com', NULL, NULL, 'paid', NULL),
(112, 24, '3500', '2024-04-22 13:12:46', NULL, NULL, 'james@gmail.com', NULL, NULL, 'paid', NULL),
(113, 24, '3500', '2024-04-22 13:24:51', NULL, NULL, 'james@gmail.com', NULL, NULL, 'paid', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bnb_details`
--
ALTER TABLE `bnb_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `current_fund`
--
ALTER TABLE `current_fund`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `current_money`
--
ALTER TABLE `current_money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `user_deposit_total`
--
ALTER TABLE `user_deposit_total`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_wallet`
--
ALTER TABLE `user_wallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bnb_details`
--
ALTER TABLE `bnb_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `current_money`
--
ALTER TABLE `current_money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `user_deposit_total`
--
ALTER TABLE `user_deposit_total`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_wallet`
--
ALTER TABLE `user_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user_form` (`id`);

--
-- Constraints for table `user_deposit_total`
--
ALTER TABLE `user_deposit_total`
  ADD CONSTRAINT `user_deposit_total_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_form` (`id`);

--
-- Constraints for table `user_wallet`
--
ALTER TABLE `user_wallet`
  ADD CONSTRAINT `user_wallet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_form` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
