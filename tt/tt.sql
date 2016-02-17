-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 30, 2015 at 10:56 PM
-- Server version: 5.5.40-0ubuntu0.12.04.1
-- PHP Version: 5.5.30-1+deb.sury.org~precise+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tt`
--

-- --------------------------------------------------------

--
-- Table structure for table `alert_data`
--

CREATE TABLE `alert_data` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `target` varchar(200) NOT NULL DEFAULT 'All',
  `msg` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alert_data`
--

INSERT INTO `alert_data` (`id`, `type`, `target`, `msg`, `date`) VALUES
(3, 'Faculty Substitution', '1 3 5 7 IT-1 SE-1 faculty', 'Due to the absence of faculty A, faculty B will take WP class today', '2015-11-24 22:54:16'),
(4, 'Remedy Class', '1 3 5 7 IT-1 SE-1 faculty', 'There is a remedial class for Software testing at 4:45pm today', '2015-11-24 22:55:11');

-- --------------------------------------------------------

--
-- Table structure for table `alert_type`
--

CREATE TABLE `alert_type` (
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alert_type`
--

INSERT INTO `alert_type` (`name`) VALUES
('Classroom Alteration'),
('Extra Class'),
('Faculty Substitution'),
('Other'),
('Remedy Class'),
('Time Table Alteration');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `start_time` time NOT NULL DEFAULT '00:00:00',
  `end_time` time NOT NULL DEFAULT '00:00:00',
  `day` varchar(10) NOT NULL DEFAULT '',
  `s_initial` varchar(50) NOT NULL,
  `sem` varchar(6) NOT NULL,
  `room_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`start_time`, `end_time`, `day`, `s_initial`, `sem`, `room_no`) VALUES
('11:30:00', '12:30:00', 'TUE', 'MATHS III', '3', ''),
('09:00:00', '11:00:00', 'FRI', 'JAVA', '5', ' 110'),
('09:00:00', '11:00:00', 'FRI', 'NLP', '5', ' 110'),
('09:00:00', '11:00:00', 'TUE', 'DSC', '3', ' 224'),
('09:00:00', '11:00:00', 'THU', 'ADBMS', 'SE-1', ' 304'),
('11:30:00', '13:30:00', 'MON', 'CSPA', 'SE-1', ' 304'),
('09:00:00', '11:00:00', 'THU', 'ADBMS', 'IT-1', ' 305'),
('11:30:00', '13:30:00', 'MON', 'EAP', 'IT-1', ' 305'),
('14:45:00', '16:45:00', 'FRI', 'ISM', 'IT-1', ' 305'),
('14:45:00', '16:45:00', 'WED', 'ELECTIVE', 'IT-1', ' 305'),
('09:00:00', '10:00:00', 'THU', 'EIPR', '5', '110'),
('09:00:00', '10:00:00', 'WED', 'CN I', '5', '110'),
('10:00:00', '11:00:00', 'THU', 'JAVA', '5', '110'),
('10:00:00', '11:00:00', 'THU', 'NLP', '5', '110'),
('10:00:00', '11:00:00', 'WED', 'AA', '5', '110'),
('10:00:00', '11:00:00', 'WED', 'CD', '5', '110'),
('10:00:00', '11:00:00', 'WED', 'MIS', '5', '110'),
('11:30:00', '12:30:00', 'FRI', 'M&MP', '5', '110'),
('11:30:00', '12:30:00', 'THU', 'SS', '5', '110'),
('11:30:00', '12:30:00', 'WED', 'M&MP', '5', '110'),
('12:00:00', '13:00:00', 'MON', 'SS', '5', '110'),
('12:00:00', '13:00:00', 'TUE', 'EIPR', '5', '110'),
('12:30:00', '13:30:00', 'FRI', 'CN I', '5', '110'),
('12:30:00', '13:30:00', 'THU', 'AA', '5', '110'),
('12:30:00', '13:30:00', 'THU', 'CD', '5', '110'),
('12:30:00', '13:30:00', 'THU', 'MIS', '5', '110'),
('12:30:00', '13:30:00', 'WED', 'EIPR', '5', '110'),
('13:00:00', '14:00:00', 'MON', 'CN I', '5', '110'),
('13:00:00', '14:00:00', 'TUE', 'SS', '5', '110'),
('14:15:00', '15:15:00', 'THU', 'SS', '5', '110'),
('14:15:00', '15:15:00', 'WED', 'M&MP', '5', '110'),
('14:45:00', '15:45:00', 'MON', 'AA', '5', '110'),
('14:45:00', '15:45:00', 'MON', 'CD', '5', '110'),
('14:45:00', '15:45:00', 'MON', 'MIS', '5', '110'),
('14:45:00', '15:45:00', 'TUE', 'M&MP', '5', '110'),
('15:45:00', '16:45:00', 'TUE', 'CN I', '5', '110'),
('09:00:00', '10:00:00', 'FRI', 'LS&PE', '7', '117'),
('09:00:00', '10:00:00', 'TUE', 'ST', '7', '117'),
('09:00:00', '10:00:00', 'WED', 'BDM', '7', '117'),
('09:00:00', '10:00:00', 'WED', 'CCA', '7', '117'),
('09:00:00', '10:00:00', 'WED', 'FL&GA', '7', '117'),
('09:00:00', '11:00:00', 'MON', 'Global Elective F', '7', '117'),
('10:00:00', '11:00:00', 'FRI', 'ST', '7', '117'),
('10:00:00', '11:00:00', 'TUE', 'WP', '7', '117'),
('10:00:00', '11:00:00', 'WED', 'HCI', '7', '117'),
('11:30:00', '12:30:00', 'FRI', 'WP', '7', '117'),
('11:30:00', '12:30:00', 'MON', 'HCI', '7', '117'),
('11:30:00', '12:30:00', 'WED', 'WP', '7', '117'),
('11:30:00', '13:30:00', 'TUE', 'Global Elective G', '7', '117'),
('12:00:00', '13:00:00', 'THU', 'BDM', '7', '117'),
('12:00:00', '13:00:00', 'THU', 'CCA', '7', '117'),
('12:00:00', '13:00:00', 'THU', 'FL&GA', '7', '117'),
('12:30:00', '13:30:00', 'FRI', 'BDM', '7', '117'),
('12:30:00', '13:30:00', 'FRI', 'CCA', '7', '117'),
('12:30:00', '13:30:00', 'FRI', 'FL&GA', '7', '117'),
('12:30:00', '13:30:00', 'MON', 'ST', '7', '117'),
('12:30:00', '13:30:00', 'WED', 'Global Elective G', '7', '117'),
('13:00:00', '14:00:00', 'THU', 'ST', '7', '117'),
('14:15:00', '15:15:00', 'MON', 'LS&PE', '7', '117'),
('14:15:00', '16:15:00', 'WED', 'Global Elective F', '7', '117'),
('14:45:00', '15:45:00', 'THU', 'HCI', '7', '117'),
('15:15:00', '16:15:00', 'MON', 'WP', '7', '117'),
('09:00:00', '10:00:00', 'FRI', 'BCE', '1', '204'),
('09:00:00', '10:00:00', 'MON', 'MATHS I', '1', '204'),
('09:00:00', '10:00:00', 'THU', 'BEE', '1', '204'),
('09:00:00', '10:00:00', 'WED', 'BCE', '1', '204'),
('09:00:00', '11:00:00', 'SAT', 'CAED', '1', '204'),
('09:00:00', '11:00:00', 'TUE', 'CAED', '1', '204'),
('10:00:00', '11:00:00', 'FRI', 'BEE', '1', '204'),
('10:00:00', '11:00:00', 'MON', 'BCE', '1', '204'),
('10:00:00', '11:00:00', 'THU', 'PHYSICS', '1', '204'),
('10:00:00', '11:00:00', 'WED', 'BEE', '1', '204'),
('11:30:00', '12:30:00', 'FRI', 'PHYSICS', '1', '204'),
('11:30:00', '12:30:00', 'MON', 'BEE', '1', '204'),
('11:30:00', '12:30:00', 'THU', 'MATHS I', '1', '204'),
('11:30:00', '12:30:00', 'TUE', 'KANNADA', '1', '204'),
('12:00:00', '14:00:00', 'WED', 'CAED LAB (A1)', '1', '204'),
('12:00:00', '14:00:00', 'WED', 'CAED LAB (A2)', '1', '204'),
('12:00:00', '14:00:00', 'WED', 'PHYSICS LAB (A3)', '1', '204'),
('12:30:00', '13:30:00', 'MON', 'PHYSICS', '1', '204'),
('12:30:00', '13:30:00', 'THU', 'BCE', '1', '204'),
('12:30:00', '13:30:00', 'TUE', 'PHYSICS', '1', '204'),
('14:15:00', '15:15:00', 'TUE', 'MATHS I', '1', '204'),
('14:45:00', '15:45:00', 'WED', 'MATHS I', '1', '204'),
('14:45:00', '16:45:00', 'MON', 'CAED LAB (A1)', '1', '204'),
('14:45:00', '16:45:00', 'MON', 'CAED LAB (A2)', '1', '204'),
('14:45:00', '16:45:00', 'MON', 'PHYSICS LAB (A3)', '1', '204'),
('15:15:00', '16:15:00', 'TUE', 'BCE', '1', '204'),
('15:45:00', '16:45:00', 'WED', 'BEE', '1', '204'),
('09:00:00', '10:00:00', 'FRI', 'OOPS', '3', '224'),
('09:00:00', '10:00:00', 'MON', 'MATHS III', '3', '224'),
('09:00:00', '10:00:00', 'THU', 'DMS', '3', '224'),
('09:00:00', '10:00:00', 'WED', 'DLD', '3', '224'),
('10:00:00', '11:00:00', 'FRI', 'DMS', '3', '224'),
('10:00:00', '11:00:00', 'MON', 'DLD', '3', '224'),
('10:00:00', '11:00:00', 'THU', 'OOPS', '3', '224'),
('10:00:00', '11:00:00', 'WED', 'DMS', '3', '224'),
('11:30:00', '12:30:00', 'FRI', 'DSC', '3', '224'),
('11:30:00', '12:30:00', 'MON', 'EM', '3', '224'),
('11:30:00', '12:30:00', 'THU', 'MATHS III', '3', '224'),
('12:00:00', '14:00:00', 'WED', 'DLD LAB (B2)', '3', '224'),
('12:30:00', '13:30:00', 'FRI', 'MATHS III', '3', '224'),
('12:30:00', '13:30:00', 'MON', 'OOPS', '3', '224'),
('12:30:00', '13:30:00', 'THU', 'EM', '3', '224'),
('12:30:00', '13:30:00', 'TUE', 'EM', '3', '224'),
('14:15:00', '15:15:00', 'FRI', 'DLD', '3', '224'),
('14:45:00', '15:45:00', 'WED', 'DLD', '3', '224'),
('14:45:00', '15:45:00', 'WED', 'DSC', '3', '224'),
('14:45:00', '15:45:00', 'WED', 'OOPS', '3', '224'),
('14:45:00', '16:45:00', 'MON', 'DLD LAB (B1)', '3', '224'),
('14:45:00', '16:45:00', 'THU', 'DLD LAB (B3)', '3', '224'),
('14:45:00', '16:45:00', 'TUE', 'DLD LAB (B4)', '3', '224'),
('15:15:00', '16:15:00', 'FRI', 'DMS', '3', '224'),
('09:00:00', '10:00:00', 'FRI', 'ELECTIVE', 'SE-1', '304'),
('09:00:00', '10:00:00', 'MON', 'ST', 'SE-1', '304'),
('09:00:00', '10:00:00', 'TUE', 'AA', 'SE-1', '304'),
('09:00:00', '10:00:00', 'WED', 'ELECTIVE', 'SE-1', '304'),
('10:00:00', '11:00:00', 'FRI', 'ST', 'SE-1', '304'),
('10:00:00', '11:00:00', 'MON', 'ADBMS', 'SE-1', '304'),
('10:00:00', '11:00:00', 'TUE', 'ST', 'SE-1', '304'),
('10:00:00', '11:00:00', 'WED', 'AA', 'SE-1', '304'),
('11:30:00', '12:30:00', 'FRI', 'ADBMS', 'SE-1', '304'),
('11:30:00', '12:30:00', 'THU', 'AA', 'SE-1', '304'),
('11:30:00', '12:30:00', 'TUE', 'AA', 'SE-1', '304'),
('12:30:00', '13:30:00', 'FRI', 'ELECTIVE', 'SE-1', '304'),
('12:30:00', '13:30:00', 'THU', 'ELECTIVE', 'SE-1', '304'),
('12:30:00', '13:30:00', 'TUE', 'CSPA', 'SE-1', '304'),
('14:15:00', '15:15:00', 'MON', 'CSPA', 'SE-1', '304'),
('14:15:00', '15:15:00', 'THU', 'ELECTIVE', 'SE-1', '304'),
('14:45:00', '15:45:00', 'WED', 'ST', 'SE-1', '304'),
('15:15:00', '16:15:00', 'MON', 'ELECTIVE', 'SE-1', '304'),
('15:15:00', '16:15:00', 'THU', 'CSPA', 'SE-1', '304'),
('15:45:00', '16:45:00', 'WED', 'CSPA', 'SE-1', '304'),
('09:00:00', '10:00:00', 'MON', 'ELECTIVE', 'IT-1', '305'),
('09:00:00', '10:00:00', 'TUE', 'DC', 'IT-1', '305'),
('09:00:00', '10:00:00', 'WED', 'ISM', 'IT-1', '305'),
('10:00:00', '11:00:00', 'MON', 'ADBMS', 'IT-1', '305'),
('10:00:00', '11:00:00', 'TUE', 'ELECTIVE', 'IT-1', '305'),
('10:00:00', '11:00:00', 'WED', 'DC', 'IT-1', '305'),
('11:30:00', '12:30:00', 'THU', 'EAP', 'IT-1', '305'),
('11:30:00', '12:30:00', 'TUE', 'ISM', 'IT-1', '305'),
('12:00:00', '13:00:00', 'FRI', 'ADBMS', 'IT-1', '305'),
('12:30:00', '13:30:00', 'THU', 'DC', 'IT-1', '305'),
('12:30:00', '13:30:00', 'TUE', 'EAP', 'IT-1', '305'),
('13:00:00', '14:00:00', 'FRI', 'DC', 'IT-1', '305'),
('14:15:00', '15:15:00', 'MON', 'ISM', 'IT-1', '305'),
('14:15:00', '15:15:00', 'TUE', 'ELECTIVE', 'IT-1', '305'),
('15:15:00', '16:15:00', 'MON', 'ELECTIVE', 'IT-1', '305'),
('15:15:00', '16:15:00', 'TUE', 'ISM', 'IT-1', '305'),
('09:00:00', '11:30:00', 'MON', 'M&MP LAB (B3)', '5', 'LAB 1A'),
('09:00:00', '11:30:00', 'THU', 'ST LAB (B1)', '7', 'LAB 1A'),
('09:00:00', '11:30:00', 'TUE', 'M&MP LAB (B1)', '5', 'LAB 1A'),
('12:00:00', '14:00:00', 'WED', 'DSC LAB (B1)', '3', 'LAB 1A'),
('14:45:00', '16:45:00', 'FRI', 'ST LAB (B3)', '7', 'LAB 1A'),
('14:45:00', '16:45:00', 'MON', 'DSC LAB (B2)', '3', 'LAB 1A'),
('14:45:00', '16:45:00', 'THU', 'DSC LAB (B4)', '3', 'LAB 1A'),
('14:45:00', '16:45:00', 'TUE', 'DSC LAB (B3)', '3', 'LAB 1A'),
('09:00:00', '11:30:00', 'MON', 'M&MP LAB (B4)', '5', 'LAB 1B'),
('09:00:00', '11:30:00', 'THU', 'ST LAB (B2)', '7', 'LAB 1B'),
('09:00:00', '11:30:00', 'TUE', 'M&MP LAB (B2)', '5', 'LAB 1B'),
('14:45:00', '16:45:00', 'FRI', 'ST LAB (B4)', '7', 'LAB 1B'),
('09:00:00', '11:30:00', 'MON', 'SS LAB (B1)', '5', 'LAB 2A'),
('09:00:00', '11:30:00', 'THU', 'WP LAB (B3)', '7', 'LAB 2A'),
('09:00:00', '11:30:00', 'TUE', 'SS LAB (B3)', '5', 'LAB 2A'),
('12:00:00', '14:00:00', 'WED', 'OOPS LAB (B3)', '3', 'LAB 2A'),
('14:45:00', '16:45:00', 'FRI', 'WP LAB (B1)', '7', 'LAB 2A'),
('14:45:00', '16:45:00', 'MON', 'OOPS LAB (B4)', '3', 'LAB 2A'),
('14:45:00', '16:45:00', 'THU', 'OOPS LAB (B2)', '3', 'LAB 2A'),
('14:45:00', '16:45:00', 'TUE', 'OOPS LAB (B1)', '3', 'LAB 2A'),
('09:00:00', '11:30:00', 'MON', 'SS LAB (B2)', '5', 'LAB 2B'),
('09:00:00', '11:30:00', 'THU', 'WP LAB (B4)', '7', 'LAB 2B'),
('09:00:00', '11:30:00', 'TUE', 'SS LAB (B4)', '5', 'LAB 2B'),
('14:45:00', '16:45:00', 'FRI', 'WP LAB (B2)', '7', 'LAB 2B'),
('12:00:00', '14:00:00', 'WED', 'ADBMS LAB', 'SE-1', 'LAB 3A'),
('14:45:00', '16:45:00', 'FRI', 'AA LAB', 'SE-1', 'LAB 3A'),
('14:45:00', '16:45:00', 'TUE', 'ST LAB', 'SE-1', 'LAB 3A'),
('09:00:00', '11:30:00', 'FRI', 'EAP LAB', 'IT-1', 'LAB 3B'),
('12:00:00', '14:00:00', 'WED', 'ADBMS LAB', 'IT-1', 'LAB 3B'),
('14:45:00', '16:45:00', 'THU', 'DC LAB', 'IT-1', 'LAB 3B');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `room_no` varchar(10) NOT NULL,
  `capacity` int(3) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`room_no`, `capacity`, `type`) VALUES
('109', 30, 'UG'),
('110', 70, 'UG'),
('112A', 20, 'PG'),
('112B', 70, 'UG'),
('116A', 20, 'PG'),
('117', 70, 'UG'),
('224', 70, 'UG'),
('302', 30, 'UG'),
('304', 20, 'PG'),
('305', 20, 'PG'),
('LAB-1A', 22, 'UG'),
('LAB-1B', 22, 'UG'),
('LAB-2A', 22, 'UG'),
('LAB-2B', 22, 'UG'),
('LAB-3A', 22, 'PG'),
('LAB-3B', 22, 'PG'),
('LAB-4A', 22, 'UG');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `ID` varchar(20) NOT NULL,
  `phone_no` varchar(12) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`first_name`, `last_name`, `ID`, `phone_no`, `email`) VALUES
('Anisha', 'BS', 'ABS', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Srinivas', 'BK', 'BKS', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Sagar', 'BM', 'BMS', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Chetana', 'Murthy', 'CRM', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Priya', 'D', 'DP', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Gany', 'Arkalgud', 'GA', '9743583064', 'gany.enthused@gmail.com'),
('Nagraj', 'GC', 'GCN', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Srinivasn', 'GN', 'GNS', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Smitha', 'GR', 'GRS', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Mamtha', 'GS', 'GSM', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Geetha', 'V', 'GV', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Jitendra', 'Mungara', 'JM', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Kavitha', 'SN', 'KSN', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Merin', 'Meleet', 'MM', '9472241767', 'garima.kuul@gmail.com'),
('Dr. Cauvery', 'NK', 'NKC', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Other', 'Other', 'OT', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Poornima', 'Kulkarni', 'PK', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Pawan', 'Ravi', 'PRV', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Padmashree', 'T', 'PT', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Rekha', 'BS', 'RBS', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Ramakanth', 'Kumar', 'RMP', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Rajashekhar', 'Murthy', 'RMS', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Rashmi', 'R', 'RR', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Raghvendra', 'Prasad', 'SGR', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Sushmitha', 'N', 'SN', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Shantaram', 'Nayak', 'SRN', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Shwetha', 'SN', 'SS', '9743583064', 'faculty.rvce.ise@gmail.com'),
('Vanishree', 'K', 'VK', '9743583064', 'faculty.rvce.ise@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `handles`
--

CREATE TABLE `handles` (
  `faculty_id` varchar(30) NOT NULL,
  `s_initial` varchar(50) NOT NULL,
  `sem` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `handles`
--

INSERT INTO `handles` (`faculty_id`, `s_initial`, `sem`) VALUES
('ABS', 'ISM', 'IT-1'),
('BKS', 'ADBMS LAB', 'IT-1'),
('BKS', 'SS', '5'),
('BKS', 'SS LAB (B1)', '5'),
('BKS', 'SS LAB (B3)', '5'),
('BKS', 'ST LAB (B4)', '7'),
('BMS', 'DSC LAB (B2)', '3'),
('BMS', 'DSC LAB (B3)', '3'),
('BMS', 'NLP', '5'),
('CRM', 'AA', 'SE-1'),
('CRM', 'AA LAB', 'SE-1'),
('CRM', 'OOPS LAB (B2)', '3'),
('CRM', 'OOPS LAB (B4)', '3'),
('GCN', 'OOPS', '3'),
('GCN', 'OOPS LAB (B2)', '3'),
('GCN', 'OOPS LAB (B3)', '3'),
('GCN', 'SS LAB (B4)', '5'),
('GCN', 'ST LAB', 'SE-1'),
('GCN', 'WP LAB (B2)', '7'),
('GNS', 'ADBMS LAB', 'IT-1'),
('GNS', 'ST LAB', 'SE-1'),
('GNS', 'ST LAB (B2)', '7'),
('GNS', 'ST LAB (B4)', '7'),
('GRS', 'ADBMS LAB', 'SE-1'),
('GRS', 'BDM', '7'),
('GRS', 'SS LAB (B1)', '5'),
('GRS', 'SS LAB (B3)', '5'),
('GRS', 'WP LAB (B2)', '7'),
('GRS', 'WP LAB (B4)', '7'),
('GSM', 'DLD', '3'),
('GSM', 'DLD LAB (B3)', '3'),
('GSM', 'DLD LAB (B4)', '3'),
('GV', 'AA LAB', 'SE-1'),
('GV', 'CN I', '5'),
('GV', 'DSC LAB (B1)', '3'),
('GV', 'M&MP LAB (B1)', '5'),
('GV', 'M&MP LAB (B4)', '5'),
('GV', 'ST LAB (B1)', '7'),
('JM', 'HCI', '7'),
('JM', 'M&MP LAB (B2)', '5'),
('JM', 'ST', 'SE-1'),
('JM', 'WP LAB (B3)', '7'),
('KSN', 'M&MP LAB (B3)', '5'),
('MM', 'DC LAB', 'IT-1'),
('MM', 'DLD LAB (B1)', '3'),
('MM', 'EAP LAB', 'IT-1'),
('MM', 'M&MP', '5'),
('MM', 'M&MP LAB (B1)', '5'),
('MM', 'M&MP LAB (B3)', '5'),
('MM', 'WP LAB (B1)', '7'),
('MM', 'WP LAB (B4)', '7'),
('NKC', 'ADBMS', 'IT-1'),
('NKC', 'ADBMS', 'SE-1'),
('NKC', 'ADBMS LAB', 'SE-1'),
('OT', 'BCE', '1'),
('OT', 'BEE', '1'),
('OT', 'CAED', '1'),
('OT', 'EIPR', '5'),
('OT', 'EM', '3'),
('OT', 'KANNADA', '1'),
('OT', 'LS&PE', '7'),
('OT', 'MATHS I', '1'),
('OT', 'MATHS III', '3'),
('OT', 'PHYSICS', '1'),
('PK', 'DLD LAB (B1)', '3'),
('PK', 'DLD LAB (B2)', '3'),
('PK', 'DLD LAB (B3)', '3'),
('PK', 'DLD LAB (B4)', '3'),
('PK', 'SS LAB (B2)', '5'),
('PT', 'CCA', '7'),
('PT', 'DSC LAB (B2)', '3'),
('PT', 'DSC LAB (B3)', '3'),
('PT', 'DSC LAB (B4)', '3'),
('PT', 'JAVA', '5'),
('RBS', 'DC', 'IT-1'),
('RBS', 'DC LAB', 'IT-1'),
('RBS', 'Global Elective F', '7'),
('RBS', 'OOPS LAB (B1)', '3'),
('RBS', 'OOPS LAB (B4)', '3'),
('RMP', 'EAP', 'IT-1'),
('RMP', 'EAP LAB', 'IT-1'),
('RMS', 'CD', '5'),
('RMS', 'DSC', '3'),
('RMS', 'DSC LAB (B1)', '3'),
('RMS', 'DSC LAB (B4)', '3'),
('RR', 'CSPA', 'SE-1'),
('RR', 'EAP LAB', 'IT-1'),
('RR', 'WP', '7'),
('RR', 'WP LAB (B1)', '7'),
('RR', 'WP LAB (B3)', '7'),
('SGR', 'DLD LAB (B2)', '3'),
('SGR', 'FL&GA', '7'),
('SGR', 'Global Elective G', '7'),
('SGR', 'M&MP LAB (B2)', '5'),
('SGR', 'M&MP LAB (B4)', '5'),
('SN', 'MIS', '5'),
('SN', 'OOPS LAB (B1)', '3'),
('SRN', 'ST', '7'),
('SRN', 'ST LAB (B1)', '7'),
('SRN', 'ST LAB (B3)', '7'),
('SS', 'AA', '5'),
('SS', 'ELECTIVE', 'IT-1'),
('SS', 'ST LAB (B2)', '7'),
('SS', 'ST LAB (B3)', '7'),
('VK', 'DMS', '3'),
('VK', 'OOPS LAB (B3)', '3'),
('VK', 'SS LAB (B2)', '5'),
('VK', 'SS LAB (B4)', '5');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` varchar(30) NOT NULL,
  `type` varchar(10) NOT NULL,
  `password` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `type`, `password`) VALUES
('1RV12IS012', 'student', 'a1de03359ae054f2fd1ac2e245dc64926aaaaaa54676500cac88275ac2f41919bcc0a93e9efe0764c47321e4f44a2cfe90bb45090ed12ace7980281cf65fcd5c'),
('1RV12IS018', 'student', 'effe86c0383b7444285c05437416a1022fad9189248f5103dc569a68a9f50c3c6a6d526425c7be25f6c4ff1b7ec1f97199cd4d428c426c4f0a86b135ac821a9e'),
('MM', 'faculty', '3e5703709259d1aad1ee12bf4de25c6e1ac48ad1cddc5e0c600ec9b764fb23a28b4745f82dbe38ad236ce2ffa51ee71f1aa007632e3c78ad928879574d534a7c'),
('NKC', 'admin', '48a78177eadff275454f41918e9a82b7ea054b92452717c1afb1f83d01ccdbddec7c127f3823df0df7080eef386cde68b4ba10b88a16ce1a1674aa47021ac837');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `usn` varchar(20) NOT NULL,
  `phone_no` varchar(12) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `batch` varchar(2) NOT NULL,
  `sem` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`first_name`, `last_name`, `usn`, `phone_no`, `email`, `batch`, `sem`) VALUES
('Arnab', 'Roy', '1RV12IS012', '9738487586', '36arnab@gmail.com', 'B1', '7'),
('Garima', 'Chandra', '1RV12IS018', '7406091108', 'garima.kuul@gmail.com', 'B1', '7');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `name` varchar(100) NOT NULL DEFAULT '',
  `s_initial` varchar(50) NOT NULL,
  `sem` varchar(6) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`name`, `s_initial`, `sem`, `type`) VALUES
('Advanced Algorithms', 'AA', '5', 'theory'),
('Advanced Algorithms', 'AA', 'SE-1', 'theory'),
('AA LAB', 'AA LAB', 'SE-1', 'lab'),
('Advances in Database Management Systems', 'ADBMS', 'IT-1', 'theory'),
('Advances in Database Management Systems', 'ADBMS', 'SE-1', 'theory'),
('ADBMS LAB', 'ADBMS LAB', 'IT-1', 'lab'),
('ADBMS LAB', 'ADBMS LAB', 'SE-1', 'lab'),
('Basics of Civil Engineering', 'BCE', '1', 'theory'),
('Big Data Mangaement', 'BDM', '7', 'theory'),
('Basics of Electrical Engineering', 'BEE', '1', 'theory'),
('Computer Aided Engineering Drawing', 'CAED', '1', 'theory'),
('CAED LAB (A1)', 'CAED LAB (A1)', '1', 'lab'),
('CAED LAB (A2)', 'CAED LAB (A2)', '1', 'lab'),
('Cloud Computing & Applications', 'CCA', '7', 'theory'),
('Compiler Design', 'CD', '5', 'theory'),
('Computer Networks I', 'CN I', '5', 'theory'),
('Computer Systems Performance Analysis', 'CSPA', 'SE-1', 'theory'),
('Data Compression', 'DC', 'IT-1', 'theory'),
('DC LAB', 'DC LAB', 'IT-1', 'lab'),
('Digital Logic Design', 'DLD', '3', 'theory'),
('DLD LAB (B1)', 'DLD LAB (B1)', '3', 'lab'),
('DLD LAB (B2)', 'DLD LAB (B2)', '3', 'lab'),
('DLD LAB (B3)', 'DLD LAB (B3)', '3', 'lab'),
('DLD LAB (B4)', 'DLD LAB (B4)', '3', 'lab'),
('Discrete Mathematical Structures', 'DMS', '3', 'theory'),
('Data Structures in C', 'DSC', '3', 'theory'),
('DSC LAB (B1)', 'DSC LAB (B1)', '3', 'lab'),
('DSC LAB (B2)', 'DSC LAB (B2)', '3', 'lab'),
('DSC LAB (B3)', 'DSC LAB (B3)', '3', 'lab'),
('DSC LAB (B4)', 'DSC LAB (B4)', '3', 'lab'),
('Enterprise Application Programming', 'EAP', 'IT-1', 'theory'),
('EAP LAB', 'EAP LAB', 'IT-1', 'lab'),
('Intellectual Property Rights & Entrepreneurship', 'EIPR', '5', 'theory'),
('Elective', 'ELECTIVE', 'IT-1', 'theory'),
('Engineering Materials', 'EM', '3', 'theory'),
('Fuzzy Logic and Genetic Algorithms', 'FL&GA', '7', 'theory'),
('Global Elective F JAVA', 'Global Elective F', '7', 'theory'),
('Global Elective G  Cloud Computing', 'Global Elective G', '7', 'theory'),
('Human Computer Interaction', 'HCI', '7', 'theory'),
('Information Storage Management', 'ISM', 'IT-1', 'theory'),
('Java & J2EE', 'JAVA', '5', 'theory'),
('KANNADA', 'KANNADA', '1', 'theory'),
('Legal Studies & Professional Ethics for Engineers', 'LS&PE', '7', 'theory'),
('Microprocessor & Multicore Programming', 'M&MP', '5', 'theory'),
('M&MP LAB (B1)', 'M&MP LAB (B1)', '5', 'lab'),
('M&MP LAB (B2)', 'M&MP LAB (B2)', '5', 'lab'),
('M&MP LAB (B3)', 'M&MP LAB (B3)', '5', 'lab'),
('M&MP LAB (B4)', 'M&MP LAB (B4)', '5', 'lab'),
('Applied Mathematics I', 'MATHS I', '1', 'theory'),
('Applied Mathematics III', 'MATHS III', '3', 'theory'),
('Management Information Systems', 'MIS', '5', 'theory'),
('Natural Language Processing Python', 'NLP', '5', 'theory'),
('Object Oriented programming with C++', 'OOPS', '3', 'theory'),
('OOPS LAB (B1)', 'OOPS LAB (B1)', '3', 'lab'),
('OOPS LAB (B2)', 'OOPS LAB (B2)', '3', 'lab'),
('OOPS LAB (B3)', 'OOPS LAB (B3)', '3', 'lab'),
('OOPS LAB (B4)', 'OOPS LAB (B4)', '3', 'lab'),
('Engineering Physics', 'PHYSICS', '1', 'theory'),
('PHYSICS LAB (A3)', 'PHYSICS LAB (A3)', '1', 'lab'),
('System Software', 'SS', '5', 'theory'),
('SS LAB (B1)', 'SS LAB (B1)', '5', 'lab'),
('SS LAB (B2)', 'SS LAB (B2)', '5', 'lab'),
('SS LAB (B3)', 'SS LAB (B3)', '5', 'lab'),
('SS LAB (B4)', 'SS LAB (B4)', '5', 'lab'),
('Software Testing', 'ST', '7', 'theory'),
('Software Testing', 'ST', 'SE-1', 'theory'),
('ST LAB', 'ST LAB', 'SE-1', 'lab'),
('ST LAB (B1)', 'ST LAB (B1)', '7', 'lab'),
('ST LAB (B2)', 'ST LAB (B2)', '7', 'lab'),
('ST LAB (B3)', 'ST LAB (B3)', '7', 'lab'),
('ST LAB (B4)', 'ST LAB (B4)', '7', 'lab'),
('Web Programming', 'WP', '7', 'theory'),
('WP LAB (B1)', 'WP LAB (B1)', '7', 'lab'),
('WP LAB (B2)', 'WP LAB (B2)', '7', 'lab'),
('WP LAB (B3)', 'WP LAB (B3)', '7', 'lab'),
('WP LAB (B4)', 'WP LAB (B4)', '7', 'lab');

-- --------------------------------------------------------

--
-- Table structure for table `subscribes`
--

CREATE TABLE `subscribes` (
  `ID` varchar(20) NOT NULL,
  `sms` tinyint(1) NOT NULL DEFAULT '1',
  `mail` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribes`
--

INSERT INTO `subscribes` (`ID`, `sms`, `mail`) VALUES
('1RV12IS012', 1, 1),
('1RV12IS018', 1, 1),
('MM', 1, 1),
('NKC', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alert_data`
--
ALTER TABLE `alert_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alert_type`
--
ALTER TABLE `alert_type`
  ADD PRIMARY KEY (`name`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`room_no`,`start_time`,`end_time`,`day`,`s_initial`),
  ADD KEY `s_initial` (`s_initial`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`room_no`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `handles`
--
ALTER TABLE `handles`
  ADD PRIMARY KEY (`faculty_id`,`s_initial`,`sem`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`usn`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`s_initial`,`sem`);

--
-- Indexes for table `subscribes`
--
ALTER TABLE `subscribes`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alert_data`
--
ALTER TABLE `alert_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_3` FOREIGN KEY (`s_initial`) REFERENCES `subject` (`s_initial`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `handles`
--
ALTER TABLE `handles`
  ADD CONSTRAINT `handles_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
