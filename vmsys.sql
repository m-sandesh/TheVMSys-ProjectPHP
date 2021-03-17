-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2019 at 08:55 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vmsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_schedules`
--

CREATE TABLE `all_schedules` (
  `scheduleId` int(100) NOT NULL,
  `customerId` int(11) NOT NULL,
  `workshopId` int(11) NOT NULL,
  `vehicle_type` int(10) NOT NULL,
  `vehicle_number` varchar(100) NOT NULL,
  `odometer` bigint(20) NOT NULL,
  `est_mileage` int(11) NOT NULL,
  `problems` varchar(1000) NOT NULL,
  `schedule_date` varchar(100) NOT NULL,
  `schedule_time` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `regDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` bigint(100) NOT NULL,
  `regDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `username`, `name`, `email`, `password`, `phone`, `regDate`) VALUES
(1, 'ram', 'Ram', 'ram@ram.com', 'ram', 98002, '0000-00-00'),
(13, 'sandesh', 'Sandesh', 'sand171135@iimscollege.edu.np', 'sandesh', 9841984124, '2019-08-02');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_storage`
--

CREATE TABLE `schedule_storage` (
  `scheduleId` int(100) NOT NULL,
  `customerId` int(100) NOT NULL,
  `workshopId` int(100) NOT NULL,
  `vehicle_type` int(10) NOT NULL,
  `vehicle_number` varchar(100) NOT NULL,
  `odometer` bigint(20) NOT NULL,
  `est_mileage` int(10) NOT NULL,
  `problems` varchar(1000) NOT NULL,
  `schedule_date` varchar(100) NOT NULL,
  `schedule_time` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `regDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule_storage`
--

INSERT INTO `schedule_storage` (`scheduleId`, `customerId`, `workshopId`, `vehicle_type`, `vehicle_number`, `odometer`, `est_mileage`, `problems`, `schedule_date`, `schedule_time`, `note`, `regDate`) VALUES
(38, 1, 35, 2, 'BA 22 9999', 2500, 45, 'Brakes', '2019-08-03', '10', 'Sharp Time', '2019-08-02');

-- --------------------------------------------------------

--
-- Table structure for table `service_detail`
--

CREATE TABLE `service_detail` (
  `service_detailId` int(100) NOT NULL,
  `customerId` int(100) NOT NULL,
  `workshopId` int(100) NOT NULL,
  `vehicle_number` varchar(100) NOT NULL,
  `odometer` bigint(20) NOT NULL,
  `next_due` bigint(20) NOT NULL,
  `notification_status` varchar(100) NOT NULL,
  `service_status` varchar(100) NOT NULL,
  `scheduleId` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_detail`
--

INSERT INTO `service_detail` (`service_detailId`, `customerId`, `workshopId`, `vehicle_number`, `odometer`, `next_due`, `notification_status`, `service_status`, `scheduleId`) VALUES
(21, 1, 35, 'BA 22 9999', 2500, 4000, '1', 'Empty', 38);

-- --------------------------------------------------------

--
-- Table structure for table `workshop`
--

CREATE TABLE `workshop` (
  `workshopId` int(100) NOT NULL,
  `center_username` varchar(100) NOT NULL,
  `centername` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `ownername` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `center_type` int(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `regDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workshop`
--

INSERT INTO `workshop` (`workshopId`, `center_username`, `centername`, `address`, `ownername`, `email`, `phone`, `center_type`, `password`, `regDate`) VALUES
(32, 'biker', 'Bikers Work Center', 'KTM', 'Ram', 'biker@info.com', 9841984125, 2, 'biker', '2019-08-02 00:28:26'),
(33, 'abc', 'ABC Auto Center', 'KTM', 'Ravi', 'abc@mail.com', 9841984126, 4, 'abc', '2019-08-02 00:29:55'),
(34, 'himalayan', 'Himalayan Service Center', 'LPT', 'Himal Rai', 'himal@info.com', 9841984127, 2, 'himalayan', '2019-08-02 00:30:59'),
(35, 'bell', 'Bell Bikes Service Center', 'LPT', 'Belly', 'bell@info.com', 9841984128, 2, 'bell', '2019-08-02 00:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `workshop_location`
--

CREATE TABLE `workshop_location` (
  `ws_locationId` int(100) NOT NULL,
  `workshopId` int(100) NOT NULL,
  `longitude_cord` varchar(200) NOT NULL,
  `latitude_cord` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workshop_location`
--

INSERT INTO `workshop_location` (`ws_locationId`, `workshopId`, `longitude_cord`, `latitude_cord`) VALUES
(11, 32, '27.7172453', '85.3239605'),
(12, 33, '27.7172453', '85.3239605'),
(13, 34, '27.7172453', '85.3239605'),
(14, 35, '27.7172453', '85.3239605');

-- --------------------------------------------------------

--
-- Table structure for table `workshop_setup`
--

CREATE TABLE `workshop_setup` (
  `ws_setupId` int(100) NOT NULL,
  `workshopId` int(100) NOT NULL,
  `open_time` varchar(100) NOT NULL,
  `close_time` varchar(100) NOT NULL,
  `schedule_time` int(10) NOT NULL,
  `schedule_state` int(10) NOT NULL,
  `detail` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workshop_setup`
--

INSERT INTO `workshop_setup` (`ws_setupId`, `workshopId`, `open_time`, `close_time`, `schedule_time`, `schedule_state`, `detail`) VALUES
(11, 32, '10 am', '6 pm', 2, 0, ''),
(12, 33, '10 am', '6 pm', 2, 0, ''),
(13, 34, '10 am', '6 pm', 2, 0, ''),
(14, 35, '10 am', '6 pm', 2, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_schedules`
--
ALTER TABLE `all_schedules`
  ADD PRIMARY KEY (`scheduleId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `workshopId` (`workshopId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `schedule_storage`
--
ALTER TABLE `schedule_storage`
  ADD PRIMARY KEY (`scheduleId`);

--
-- Indexes for table `service_detail`
--
ALTER TABLE `service_detail`
  ADD PRIMARY KEY (`service_detailId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `workshopId` (`workshopId`),
  ADD KEY `scheduleId` (`scheduleId`);

--
-- Indexes for table `workshop`
--
ALTER TABLE `workshop`
  ADD PRIMARY KEY (`workshopId`),
  ADD UNIQUE KEY `username` (`center_username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `workshop_location`
--
ALTER TABLE `workshop_location`
  ADD PRIMARY KEY (`ws_locationId`),
  ADD KEY `workshopId` (`workshopId`);

--
-- Indexes for table `workshop_setup`
--
ALTER TABLE `workshop_setup`
  ADD PRIMARY KEY (`ws_setupId`),
  ADD KEY `workshopId` (`workshopId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_schedules`
--
ALTER TABLE `all_schedules`
  MODIFY `scheduleId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `service_detail`
--
ALTER TABLE `service_detail`
  MODIFY `service_detailId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `workshop`
--
ALTER TABLE `workshop`
  MODIFY `workshopId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `workshop_location`
--
ALTER TABLE `workshop_location`
  MODIFY `ws_locationId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `workshop_setup`
--
ALTER TABLE `workshop_setup`
  MODIFY `ws_setupId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `all_schedules`
--
ALTER TABLE `all_schedules`
  ADD CONSTRAINT `all_schedules_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`),
  ADD CONSTRAINT `all_schedules_ibfk_2` FOREIGN KEY (`workshopId`) REFERENCES `workshop` (`workshopId`);

--
-- Constraints for table `service_detail`
--
ALTER TABLE `service_detail`
  ADD CONSTRAINT `service_detail_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`),
  ADD CONSTRAINT `service_detail_ibfk_2` FOREIGN KEY (`workshopId`) REFERENCES `workshop` (`workshopId`),
  ADD CONSTRAINT `service_detail_ibfk_3` FOREIGN KEY (`scheduleId`) REFERENCES `schedule_storage` (`scheduleId`);

--
-- Constraints for table `workshop_location`
--
ALTER TABLE `workshop_location`
  ADD CONSTRAINT `workshop_location_ibfk_1` FOREIGN KEY (`workshopId`) REFERENCES `workshop` (`workshopId`);

--
-- Constraints for table `workshop_setup`
--
ALTER TABLE `workshop_setup`
  ADD CONSTRAINT `workshop_setup_ibfk_1` FOREIGN KEY (`workshopId`) REFERENCES `workshop` (`workshopId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
