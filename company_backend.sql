-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2023 at 11:53 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company_backend`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_user_login`
--

CREATE TABLE `customer_user_login` (
  `user_login_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email_id` varchar(255) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `last_login_ip` varchar(10) DEFAULT NULL,
  `default_password_change` tinyint(1) DEFAULT NULL,
  `password_change_time` datetime DEFAULT NULL,
  `is_active` varchar(1) NOT NULL DEFAULT '1',
  `login_account` varchar(1) DEFAULT '1',
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer_user_login`
--

INSERT INTO `customer_user_login` (`user_login_id`, `user_name`, `user_email_id`, `username`, `password`, `last_login_time`, `last_login_ip`, `default_password_change`, `password_change_time`, `is_active`, `login_account`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '$2y$12$N6Bgxiy/ngMlq2TqJR64/.VI0qjBuyZpSKBjr7gtkJcwkE/uPN0fy', '2023-10-10 13:27:29', '1', 1, NULL, '1', '1', 0, '2023-05-09 12:12:47', 1, '2023-10-12 06:44:41'),
(12, 'pankaj', 'pankaj@gmail.com', 'pankaj', '$2y$12$ySwQGAh./RHlT8IzyS5.HeuLSn5Jb3D08Yfn3XSGy1rdBPe8TT.9O', '2023-10-10 13:28:33', '', 1, NULL, '1', '1', 1, '2023-10-10 16:55:29', 15, '2023-10-12 06:36:26');

-- --------------------------------------------------------

--
-- Table structure for table `fruits_categories`
--

CREATE TABLE `fruits_categories` (
  `fruits_id` int(11) NOT NULL,
  `fruits_name` varchar(1000) NOT NULL,
  `is_status` varchar(1) NOT NULL DEFAULT '1',
  `is_active` varchar(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fruits_categories`
--

INSERT INTO `fruits_categories` (`fruits_id`, `fruits_name`, `is_status`, `is_active`, `created_on`, `updated_on`) VALUES
(1, 'Apple', '2', '1', '2023-11-25 17:41:27', '2023-11-25 13:19:39'),
(2, 'Drupe', '1', '1', '2023-11-25 17:42:00', '2023-11-25 12:12:00'),
(3, 'Grape', '1', '1', '2023-11-25 17:42:14', '2023-11-25 12:12:14'),
(4, 'Mango', '1', '1', '2023-11-25 17:43:48', '2023-11-25 12:13:48'),
(5, 'Pome', '1', '1', '2023-11-25 17:44:04', '2023-11-25 12:14:04'),
(6, 'Orange', '1', '1', '2023-11-25 17:44:13', '2023-11-25 12:14:13'),
(7, 'Berry', '1', '1', '2023-11-25 17:44:45', '2023-11-25 12:14:45'),
(8, 'Pineapple', '1', '1', '2023-11-25 17:44:55', '2023-11-25 12:14:55'),
(9, 'Banana', '1', '1', '2023-11-25 17:45:22', '2023-11-25 12:15:22'),
(10, 'Strawberry', '1', '1', '2023-11-25 17:45:35', '2023-11-25 12:15:35'),
(11, 'Cherries', '1', '1', '2023-11-25 17:45:46', '2023-11-25 12:15:46'),
(12, 'Watermelon', '1', '1', '2023-11-25 17:45:56', '2023-11-25 12:15:56'),
(13, 'Aggregate fruit', '1', '1', '2023-11-25 17:46:07', '2023-11-25 13:08:09'),
(14, 'Plum', '1', '1', '2023-11-25 17:46:17', '2023-11-25 12:16:17'),
(15, 'Grapefruit', '1', '1', '2023-11-25 17:46:26', '2023-11-25 12:16:26'),
(16, 'Kiwifruit', '1', '1', '2023-11-25 17:46:36', '2023-11-25 12:16:36'),
(17, 'Peach', '1', '1', '2023-11-25 17:46:47', '2023-11-25 12:16:47'),
(18, 'Hesperidium', '1', '1', '2023-11-25 17:46:56', '2023-11-25 12:16:56'),
(19, 'Apricot', '1', '1', '2023-11-25 17:47:05', '2023-11-25 13:08:12'),
(20, 'Citrus Fruits', '1', '1', '2023-11-25 17:47:15', '2023-11-25 12:17:15'),
(21, 'Nut', '1', '1', '2023-11-25 17:47:24', '2023-11-25 12:17:24'),
(22, 'Multiple fruit', '1', '1', '2023-11-25 17:47:34', '2023-11-25 12:17:34'),
(23, 'Blueberry', '1', '1', '2023-11-25 17:47:44', '2023-11-25 12:17:44'),
(24, 'Guava', '1', '1', '2023-11-25 17:47:53', '2023-11-25 12:17:53'),
(25, 'Blackberries', '1', '1', '2023-11-25 17:49:09', '2023-11-25 12:19:09');

-- --------------------------------------------------------

--
-- Table structure for table `registerUserLogin_New`
--

CREATE TABLE `registerUserLogin_New` (
  `register_login_id` int(11) NOT NULL,
  `register_name` varchar(255) NOT NULL,
  `register_email_id` varchar(255) NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `last_login_ip` varchar(10) DEFAULT NULL,
  `password_change_time` datetime DEFAULT NULL,
  `is_active` varchar(1) NOT NULL DEFAULT '1',
  `login_account` varchar(1) DEFAULT '1',
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `registerUserLogin_New`
--

INSERT INTO `registerUserLogin_New` (`register_login_id`, `register_name`, `register_email_id`, `username`, `password`, `last_login_time`, `last_login_ip`, `password_change_time`, `is_active`, `login_account`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '$2y$12$N6Bgxiy/ngMlq2TqJR64/.VI0qjBuyZpSKBjr7gtkJcwkE/uPN0fy', '2023-10-10 13:27:29', '1', NULL, '1', '1', 0, '2023-05-09 12:12:47', 1, '2023-10-12 06:44:41');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `mobile_no` bigint(20) NOT NULL,
  `user_type_id` int(11) NOT NULL DEFAULT 0,
  `login_access` tinyint(1) NOT NULL DEFAULT 0,
  `father_name` varchar(45) DEFAULT '',
  `company_name` varchar(500) DEFAULT NULL,
  `address` varchar(200) DEFAULT '',
  `pincode` int(6) DEFAULT NULL,
  `is_active` varchar(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email_id`, `mobile_no`, `user_type_id`, `login_access`, `father_name`, `company_name`, `address`, `pincode`, `is_active`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 'admin', 'admin@gmail.com', 9685741230, 1, 0, 'admin', 'okhla phase 1', 'admin', 110020, '1', 1, '2023-05-09 12:14:15', 0, '2023-05-19 06:21:04'),
(15, 'pankaj', 'pankaj@gmail.com', 9874563210, 1, 1, 'pankaj', NULL, 'okhla', 110020, '1', 1, '2023-10-10 16:55:28', 0, '2023-10-10 11:25:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `user_login_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `last_login_ip` varchar(10) DEFAULT NULL,
  `default_password_change` tinyint(1) NOT NULL DEFAULT 0,
  `password_change_time` datetime DEFAULT NULL,
  `is_active` varchar(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`user_login_id`, `user_id`, `username`, `password`, `last_login_time`, `last_login_ip`, `default_password_change`, `password_change_time`, `is_active`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 1, 'admin', '$2y$12$N6Bgxiy/ngMlq2TqJR64/.VI0qjBuyZpSKBjr7gtkJcwkE/uPN0fy', '2023-12-12 05:24:39', '1', 1, NULL, '1', 0, '2023-05-09 12:12:47', 1, '2023-12-12 04:24:39'),
(12, 15, 'pankaj', '$2y$12$ySwQGAh./RHlT8IzyS5.HeuLSn5Jb3D08Yfn3XSGy1rdBPe8TT.9O', '2023-10-10 13:28:33', '', 1, NULL, '1', 1, '2023-10-10 16:55:29', 15, '2023-10-10 11:28:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `sort_code` varchar(50) NOT NULL DEFAULT '',
  `is_active` varchar(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type`, `sort_code`, `is_active`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 'Manager', '01', '1', 0, '2023-05-09 12:15:30', 0, '2023-05-19 12:16:10'),
(2, 'Entry Level', '02', '1', 0, '2023-05-09 17:16:02', 1, '2023-05-19 12:16:16'),
(7, 'asdd', '123', '2', 0, '2023-10-10 13:51:48', 0, '2023-10-10 08:22:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_user_login`
--
ALTER TABLE `customer_user_login`
  ADD PRIMARY KEY (`user_login_id`),
  ADD UNIQUE KEY `user_email_id` (`user_email_id`),
  ADD KEY `username_password_active` (`username`,`password`,`is_active`),
  ADD KEY `username_active` (`username`,`is_active`);

--
-- Indexes for table `fruits_categories`
--
ALTER TABLE `fruits_categories`
  ADD PRIMARY KEY (`fruits_id`),
  ADD UNIQUE KEY `fruits_name` (`fruits_name`) USING HASH;

--
-- Indexes for table `registerUserLogin_New`
--
ALTER TABLE `registerUserLogin_New`
  ADD PRIMARY KEY (`register_login_id`),
  ADD UNIQUE KEY `user_email_id` (`register_email_id`),
  ADD KEY `username_password_active` (`username`,`password`,`is_active`),
  ADD KEY `username_active` (`username`,`is_active`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`user_login_id`),
  ADD KEY `username_password_active` (`username`,`password`,`is_active`),
  ADD KEY `username_active` (`username`,`is_active`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_user_login`
--
ALTER TABLE `customer_user_login`
  MODIFY `user_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `fruits_categories`
--
ALTER TABLE `fruits_categories`
  MODIFY `fruits_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `registerUserLogin_New`
--
ALTER TABLE `registerUserLogin_New`
  MODIFY `register_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `user_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
