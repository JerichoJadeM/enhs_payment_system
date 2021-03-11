-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2020 at 07:50 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thesis`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `user_type` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `activity_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `user_type`, `name`, `activity`, `activity_date`) VALUES
(1, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee ofJericho B. Madolid', '2020-09-23'),
(2, 'Accountant', 'admin', 'Deleted student record with LRN number of: 3463623482374', '2020-09-23'),
(3, 'Accountant', 'Gabriella V. Maningas', 'Deleted student record with LRN number of: 3463623482394', '2020-09-23'),
(4, 'Accountant', 'Gabriella V. Maningas', 'Added record of student: Jepoy B. Bermudo', '2020-09-23'),
(5, 'Accountant', 'Gabriella V. Maningas', 'Deleted student LRN number of: 2324354156674543', '2020-09-23'),
(6, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jericho B. Madolid', '2020-09-23'),
(7, 'Accountant', 'Gabriella V. Maningas', 'Added record of student: Joeren B. Cepida', '2020-09-23'),
(8, 'Adviser', 'Joy D. Lyn', 'Added record of student: Pedro C. Castro', '2020-09-23'),
(9, 'Adviser', 'Joy D. Lyn', 'Added record of student: Jazi  B. Madolid', '2020-09-23'),
(10, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jericho B. Madolid', '2020-09-24'),
(11, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jericho B. Madolid', '2020-09-24'),
(12, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jericho B. Madolid', '2020-09-24'),
(13, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jericho B. Madolid', '2020-09-24'),
(14, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Juan B B. Cruz', '2020-09-24'),
(15, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Juan B B. Cruz', '2020-09-24'),
(16, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Juan B B. Cruz', '2020-09-24'),
(17, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Juan B B. Cruz', '2020-09-24'),
(18, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Juan B B. Cruz', '2020-09-24'),
(19, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(20, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(21, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(22, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(23, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(24, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(25, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(26, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(27, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(28, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(29, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(30, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(31, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(32, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(33, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(34, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(35, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(36, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(37, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(38, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(39, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(40, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(41, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(42, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(43, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(44, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jepoy B. Bermudo', '2020-09-25'),
(45, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Pedro C. Castro', '2020-09-25'),
(46, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Pedro C. Castro', '2020-09-25'),
(47, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Pedro C. Castro', '2020-09-25'),
(48, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Pedro C. Castro', '2020-09-25'),
(49, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Joeren B.. Cepida', '2020-09-26'),
(50, 'Accountant', 'Gabriella V. Maningas', 'Deleted student record with LRN number of: 7', '2020-09-26'),
(51, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Joeren B.. Cepida', '2020-09-26'),
(52, 'Accountant', 'Gabriella V. Maningas', 'Added record of student: Derick John D. Demapanes', '2020-09-26'),
(53, 'Accountant', 'Gabriella V. Maningas', 'Added record of student: Chona C. Cartera', '2020-09-26'),
(54, 'Accountant', 'Gabriella V. Maningas', 'Added record of student: Joylyn D. De Tomas', '2020-09-26'),
(55, 'Accountant', 'Gabriella V. Maningas', 'Added record of student: Janvie A. Aloro', '2020-09-26'),
(56, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Chona C. Cartera', '2020-09-26'),
(57, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Derick John D. Demapanes', '2020-09-26'),
(58, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jericho B. Madolid', '2020-09-26'),
(59, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jericho B. Madolid', '2020-09-26'),
(60, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jericho B. Madolid', '2020-09-26'),
(61, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Janvie A. Aloro', '2020-09-26'),
(62, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Joylyn D. De Tomas', '2020-09-26'),
(63, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Derick John D. Demapanes', '2020-09-26'),
(64, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Derick John D. Demapanes', '2020-09-26'),
(65, 'Accountant', 'Gabriella V. Maningas', 'Deleted student record with LRN number of: 9', '2020-09-26'),
(66, 'Accountant', 'Gabriella V. Maningas', 'Deleted student record with LRN number of: 9', '2020-09-26'),
(67, 'Accountant', 'Gabriella V. Maningas', 'Deleted student record with LRN number of: 9', '2020-09-26'),
(68, 'Accountant', 'Gabriella V. Maningas', 'Deleted student record with LRN number of: ', '2020-09-26'),
(69, 'Accountant', 'Gabriella V. Maningas', 'Deleted student record with LRN number of: ', '2020-09-26'),
(70, 'Accountant', 'Gabriella V. Maningas', 'Deleted student record with LRN number of: ', '2020-09-26'),
(71, 'Accountant', 'Gabriella V. Maningas', 'Deleted student record with LRN number of: 9', '2020-09-26'),
(72, 'Accountant', 'Gabriella V. Maningas', 'Deleted student record with LRN number of: 7', '2020-09-27'),
(73, 'Accountant', 'Gabriella V. Maningas', 'Deleted student record with LRN number of: 7', '2020-09-27'),
(74, 'Accountant', 'Gabriella V. Maningas', 'Deleted student record with LRN number of: 7', '2020-09-27'),
(75, 'Accountant', 'Gabriella V. Maningas', 'Deleted student record with LRN number of: 7', '2020-09-27'),
(76, 'Accountant', 'Gabriella V. Maningas', 'Deleted student record with LRN number of: 3', '2020-09-27'),
(77, 'Accountant', 'Gabriella V. Maningas', 'Deleted student record with LRN number of: 3', '2020-09-27'),
(78, 'Accountant', 'Gabriella V. Maningas', 'Deleted student record with LRN number of: 3', '2020-09-27'),
(79, 'Accountant', 'Gabriella V. Maningas', 'Deleted student record with LRN number of: 123123123', '2020-09-27'),
(80, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Derick John D.. Demapanes', '2020-09-27'),
(81, 'Accountant', 'Gabriella V. Maningas', 'Added record of student: Jella Marie D. Maguale', '2020-09-29'),
(82, 'Accountant', 'Gabriella V. Maningas', 'Recieved miscellaneous fee of Jella Marie D. Maguale', '2020-09-29'),
(83, 'Accountant', 'Gabriella V. Madolid', 'Added record of student: Jessice B. Olmedo', '2020-10-01'),
(84, 'Accountant', 'Gabriella V. Madolid', 'Deleted student record with LRN number of: 2020092222222', '2020-10-01'),
(85, 'Accountant', 'Gabriella V. Madolid', 'Added record of student: Jessica B. Olmedo', '2020-10-01'),
(86, 'Accountant', 'Gabriella V. Madolid', 'Recieved miscellaneous fee of Jessica B. Olmedo', '2020-10-01'),
(87, 'Accountant', 'Gabriella V. Madolid', 'Recieved miscellaneous fee of Jessica B. Olmedo', '2020-10-01'),
(88, 'Accountant', 'Gabriella V. Madolid', 'Recieved miscellaneous fee of Jericho B...... Madolid', '2020-10-01'),
(89, 'Accountant', 'Gabriella V. Madolid', 'Recieved miscellaneous fee of Jericho B...... Madolid', '2020-10-01'),
(90, 'Accountant', 'Gabriella V. Madolid', 'Recieved miscellaneous fee of Jericho B. Madolid', '2020-10-01'),
(91, 'Adviser', 'Joy D. Lyn', 'Recieved miscellaneous fee of Jericho B. Madolid', '2020-10-03'),
(92, 'Adviser', 'Joy D. Lyn', 'Recieved miscellaneous fee of Jericho B. Madolid', '2020-10-03'),
(93, '', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Jericho B. Madolid', '2020-10-06'),
(94, '', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Jericho B. Madolid', '2020-10-06'),
(95, '', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Jericho B. Madolid', '2020-10-06'),
(96, '', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Jericho B. Madolid', '2020-10-06'),
(97, '', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Jericho B. Madolid', '2020-10-06'),
(98, 'System Administrator', 'Jericho Jade B. Madolid', 'Added record of student: Jazi B. Madolid', '2020-10-09'),
(99, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Jazi B. Madolid', '2020-10-09'),
(100, 'System Administrator', 'Jericho Jade B. Madolid', 'Deleted student record with LRN number of: 1234567891234', '2020-10-11'),
(101, 'System Administrator', 'Jericho Jade B. Madolid', 'You have deleted User Record with an id of: ', '2020-10-11'),
(102, 'System Administrator', 'Jericho Jade B. Madolid', 'You have deleted User Record with an id of: ', '2020-10-11'),
(103, 'System Administrator', 'Jericho Jade B. Madolid', 'You have deleted User Record with an id of: 4', '2020-10-11'),
(104, 'System Administrator', 'Jericho Jade B. Madolid', 'You created User: asdsad asdsadasd', '2020-10-11'),
(105, 'System Administrator', 'Jericho Jade B. Madolid', 'You have deleted User Record with an id of: 6', '2020-10-11'),
(106, 'System Administrator', 'Jericho Jade B. Madolid', 'Deleted student record with LRN number of: ', '2020-10-12'),
(107, 'System Administrator', 'Jericho Jade B. Madolid', 'You have deleted a message, message id: 5', '2020-10-12'),
(108, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Jericho B. Madolid', '2020-10-12'),
(109, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Jericho B. Madolid', '2020-10-12'),
(110, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Jericho B. Madolid', '2020-10-12'),
(111, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Jericho B. Madolid', '2020-10-12'),
(112, 'Accountant', 'Gabriella V. Madolid', 'Received miscellaneous fee of Jericho B. Madolid', '2020-10-12'),
(113, 'System Administrator', 'Jericho Jade B. Madolid', 'You have deleted a message, message id: 1', '2020-10-19'),
(114, 'System Administrator', 'Jericho Jade B. Madolid', 'You have deleted a message, message id: 2', '2020-10-19'),
(115, 'System Administrator', 'Jericho Jade B. Madolid', 'You have deleted a message, message id: 4', '2020-10-25'),
(116, 'System Administrator', 'Jericho Jade B. Madolid', 'You have deleted a message, message id: 9', '2020-11-23'),
(117, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Jericho B. Madolid', '2020-11-23'),
(118, 'System Administrator', 'Jericho Jade B. Madolid', 'You created User: Berick Demapanes', '2020-12-08'),
(119, 'System Administrator', 'Jericho Jade B. Madolid', 'You created User: Joy Lyn De Tomas', '2020-12-08'),
(120, 'Adviser', 'Berick F. Demapanes', 'Added record of student: Chona mae R. Cartera', '2020-12-08'),
(121, 'System Administrator', 'Jericho Jade B. Madolid', 'You created User: April Pancho', '2020-12-08'),
(122, 'Adviser', 'Chona May R. Cartera', 'Added record of student: Nadine F. Tupan', '2020-12-08'),
(123, 'Adviser', 'Joy Lyn B. De Tomas', 'Added record of student: April Joy P. Pancho', '2020-12-08'),
(124, 'Adviser', 'Chona May R. Cartera', 'Added record of student: Joylyn R. De Tomas', '2020-12-08'),
(125, 'System Administrator', 'Jericho Jade B. Madolid', 'You created User: Janvie Aloro', '2020-12-08'),
(126, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Joeren B... Cepida', '2020-12-09'),
(127, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Joeren B... Cepida', '2020-12-09'),
(128, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Joeren B... Cepida', '2020-12-09'),
(129, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Joeren B... Cepida', '2020-12-09'),
(130, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Joeren B... Cepida', '2020-12-09'),
(131, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Joeren B... Cepida', '2020-12-09'),
(132, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Joeren B... Cepida', '2020-12-09'),
(133, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Joeren B... Cepida', '2020-12-09'),
(134, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Joeren B... Cepida', '2020-12-09'),
(135, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Joeren B... Cepida', '2020-12-09'),
(136, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Joeren B... Cepida', '2020-12-09'),
(137, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Joeren B... Cepida', '2020-12-09'),
(138, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Joeren B... Cepida', '2020-12-09'),
(139, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Joeren B... Cepida', '2020-12-09'),
(140, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Joeren B... Cepida', '2020-12-09'),
(141, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Joeren B... Cepida', '2020-12-09'),
(142, 'System Administrator', 'Jericho Jade B. Madolid', 'You created User: jebjeb jebjeb', '2020-12-09'),
(143, 'System Administrator', 'Jericho Jade B. Madolid', 'You have deleted User Record with an id of: 11', '2020-12-09'),
(144, 'System Administrator', 'Jericho Jade B. Madolid', 'You created User: Jericho Jade', '2020-12-09'),
(145, 'System Administrator', 'Jericho Jade B. Madolid', 'You have deleted User Record with an id of: 12', '2020-12-09'),
(146, 'System Administrator', 'Jericho Jade B. Madolid', 'You created User: Jericho Madoi', '2020-12-09'),
(147, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Jericho B. Madolid', '2020-12-13'),
(148, 'System Administrator', 'Jericho Jade B. Madolid', 'Received miscellaneous fee of Jericho B. Madolid', '2020-12-13'),
(149, 'Adviser', 'Chona May R. Cartera', 'Received miscellaneous fee of Jericho B. Madolid', '2020-12-13'),
(150, 'Adviser', 'Chona May R. Cartera', 'Received miscellaneous fee of Jericho B. Madolid', '2020-12-13'),
(151, 'Adviser', 'Chona May R. Cartera', 'Received miscellaneous fee of Jericho B. Madolid', '2020-12-13'),
(152, 'Adviser', 'Chona May R. Cartera', 'Received miscellaneous fee of Jericho B. Madolid', '2020-12-13'),
(153, 'Adviser', 'Chona May R. Cartera', 'Received miscellaneous fee of Jericho B. Madolid', '2020-12-13'),
(154, 'Adviser', 'Chona May R. Cartera', 'Received miscellaneous fee of Jericho B. Madolid', '2020-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `position` varchar(20) DEFAULT NULL,
  `phone` varchar(11) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `dateRecieved` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `position`, `phone`, `Subject`, `message`, `dateRecieved`) VALUES
(3, 'Juan B Dela Cruz', 'wizardojericho@gmail.com', 'Adviser', '', 'Cant open my account!', 'Hey !!!', '2020-10-07'),
(6, 'Jethro Mondragon', 'wizardojericho@gmail.com', 'Adviser', '9978658119', 'Test Text Message', 'Test Text Message', '2020-10-12'),
(7, 'Jericho Jade B Madolid', 'wizardojericho@gmail.com', 'Accountant', '9978658119', 'Test Text Message', 'tesssssttttttttttt gumana ka na please', '2020-10-12'),
(8, 'Chona M Cartera', 'wizardojericho@gmail.com', 'Adviser', '9978658119', 'Test Text Message', 'guMana kana po please', '2020-10-12'),
(10, 'April Joy', 'wizardojericho@gmail.com', 'Adviser', '9978658119', 'Test', 'Test Lang', '2020-12-08');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(11) NOT NULL,
  `LRN` varchar(50) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `gradesection` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `payment_type` varchar(30) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `cashier` varchar(50) NOT NULL,
  `datepaid` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `LRN`, `fullname`, `gradesection`, `address`, `phone`, `payment_type`, `amount`, `cashier`, `datepaid`) VALUES
(6, '83402348234', 'Jericho B. Madolid', '8 - Awit', 'Dayhagan Carles Iloilo', '09978658119', 'Partial Payment', 600, 'Chona May R. Cartera', '2020-12-14'),
(10, '9998887755544', 'Joeren B... Cepida', '7 - Lods', 'Carles Iloilo', '09662481861', 'Full Payment', 700, 'Jericho Jade B. Madolid', '2020-12-09'),
(11, '6794232130124', 'Pedro C. Castro', '9 - Awit', 'Estancia Iloilo', '0912334456', 'Full Payment', 700, 'Gabriella V. Maningas', '2020-09-25'),
(13, '2020123456789', 'Derick John D.. Demapanes', '7 - Awit', 'Estancia Iloilo', '09565460862', 'Full Payment', 700, 'Gabriella V. Maningas', '2020-09-27'),
(15, '2020542189663', 'Joylyn D. De Tomas', '9 - Lodi', 'San Dionisio Iloilo', '09950988634', 'Full Payment', 700, 'Gabriella V. Maningas', '2020-09-26'),
(16, '2020345129009', 'Janvie A. Aloro', '10 - Goals', 'Masbate', '09636394312', 'Partial Payment', 500, 'Gabriella V. Maningas', '2020-09-26'),
(17, '2020123432567', 'Jella Marie D. Maguale', '10 - Tesla', 'Capinang San Dionisio', '09310920097', 'Partial Payment', 650, 'Gabriella V. Maningas', '2020-09-29'),
(19, '2020000000000', 'Jessica B. Olmedo', '7 - Aguinaldo', 'Dayhagan Carles Iloilo', '09978658119', 'Partial Payment', 700, 'Gabriella V. Madolid', '2020-10-01'),
(20, '2020092222222', 'Jazi B. Madolid', '9 - Eagle', 'Dayhagan Carles Iloilo', '09978658119', 'Promi', 100, 'Jericho Jade B. Madolid', '2020-10-09'),
(21, '69287276', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
(22, '0012345678987', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
(23, '012345', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
(24, '9813946483485', NULL, NULL, NULL, NULL, NULL, 0, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `LRN_number` varchar(20) NOT NULL,
  `Lname` varchar(50) DEFAULT NULL,
  `Mname` varchar(50) DEFAULT NULL,
  `Fname` varchar(50) DEFAULT NULL,
  `GradeLevel` int(11) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `GuardianName` varchar(120) DEFAULT NULL,
  `GuardianNum` varchar(20) DEFAULT NULL,
  `Address` longtext NOT NULL,
  `student_pic` varchar(255) NOT NULL,
  `dateinput` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`LRN_number`, `Lname`, `Mname`, `Fname`, `GradeLevel`, `Section`, `GuardianName`, `GuardianNum`, `Address`, `student_pic`, `dateinput`) VALUES
('0012345678987', 'Tupan', 'F', 'Nadine', 7, 'Aguinaldo', 'Liza Tupan', '09277291683', 'Brgy.Bayuyan Estancia Iloilo', '', '2020-12-08 14:51:16'),
('012345', 'Pancho', 'P', 'April Joy', 7, 'Rizal', 'Betty Pancho', '09123456789', 'Carles, Iloilo', '', '2020-12-08 14:53:56'),
('2020000000000', 'Olmedo', 'B', 'Jessica', 7, 'Aguinaldo', 'Angelica Panganiban', '09978658119', 'Dayhagan Carles Iloilo', '', '2020-10-01 22:39:25'),
('2020092222222', 'Madolid', 'B', 'Jazi', 9, 'Eagle', 'Angelica Panganiban', '09978658119', 'Dayhagan Carles Iloilo', '', '2020-10-09 21:39:19'),
('2020123432567', 'Maguale', 'D.', 'Jella Marie', 10, 'Tesla', 'Kris Bernal', '09310920097', 'Capinang San Dionisio', '', '2020-09-29 21:24:59'),
('2020123456789', 'Demapanes', 'D', 'Derick John', 7, 'Awit', 'Piolo Pascual', '09565460862', 'Estancia Iloilo', '', '2020-09-26 21:49:56'),
('2020345129009', 'Aloro', 'A', 'Janvie', 10, 'Goals', 'Sam Pinto', '09636394312', 'Masbate', 'images/student_photo/img003.jpg', '2020-09-26 21:54:44'),
('2020542189663', 'De Tomas', 'D', 'Joylyn', 9, 'Lodi', 'Angelica Panganiban', '09950988634', 'San Dionisio Iloilo', '', '2020-09-26 21:53:26'),
('20209876789876565', 'Cartera', 'C', 'Chona', 8, 'Lods', 'Kris Bernal', '09380140935', 'Estancia Iloilo', '', '2020-09-26 21:51:41'),
('6794232130124', 'Castro', 'C', 'Pedro', 9, 'Awit', 'Angel Locsin', '0912334456', 'Estancia Iloilo', 'images/student_photo/Jericho Jade Madolid.jpg', '2020-09-23 21:30:55'),
('69287276', 'Cartera', 'R', 'Chona mae', 10, 'Newton', 'Roniel Silva', '0962727', 'Tacbuyan Estancia, Iloilo ', '', '2020-12-08 14:50:09'),
('83402348234', 'Madolid', 'B', 'Jericho', 8, 'Awit', 'Gemma Madolid', '09978658119', 'Dayhagan Carles Iloilo', 'images/student_photo/IMG20200625110531.jpg', '2020-09-17 20:35:22'),
('9813946483485', 'De Tomas', 'R', 'Joylyn', 7, 'Aguinaldo', 'Joy De Tomas', '09284538956', 'San Dionisio', '', '2020-12-08 14:57:36'),
('9998887755544', 'Cepida', 'B..', 'Joeren', 7, 'Lods', 'Angel Locsin', '09662481861', 'Carles Iloilo', 'images/student_photo/img003.jpg', '2020-09-23 21:02:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `user_type` varchar(50) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `postal_code` int(11) NOT NULL,
  `about` text DEFAULT NULL,
  `photo_file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `fname`, `mname`, `lname`, `phone`, `user_type`, `grade`, `section`, `email`, `address`, `city`, `country`, `postal_code`, `about`, `photo_file`) VALUES
(1, 'admin', 'admin', 'Gabriella', 'V', 'Maningas', '09978658119', 'Accountant', NULL, NULL, 'germaine@gmail.com', 'Binon An', 'Batad', 'Philippines', 5030, 'Sample Bio here!', 'images/profile_photo/witch01.jpg'),
(3, 'admin1', 'admin1', 'Jericho Jade', 'B', 'Madolid', '09978658119', 'System Administrator', 0, 'N/A', 'wizardojericho@gmail.com', 'Dayhagan Carles Iloilo', 'Carles', 'Philippines', 5019, 'Try and try until you succeed.', 'images/profile_photo/FB_IMG_16035405450595530.jpg'),
(5, 'teacher', 'teacher', 'Chona May', 'R', 'Cartera', '09380140935', 'Adviser', 7, 'Awit', 'carterachonamay1@gmail.com', 'Estancia', 'Iloilo', 'Philippines', 5017, 'Im the adviser', 'images/profile_photo/FB_IMG_1570973808691.jpg'),
(7, 'berick', '1212', 'Berick', 'F', 'Demapanes', '09565460862', 'Adviser', 10, 'Newton', 'berickfdemapanes@gmail.com', 'Malbog', 'Iloilo ', 'Philippines ', 5017, '', 'images/profile_photo/BAF69371-97F3-463D-A206-64ADD399A4E4.jpeg'),
(8, 'joylyn', '1234', 'Joy Lyn', 'B', 'De Tomas', '09950988634', 'Adviser', 7, '', 'Joylynd651@gmail.com', 'Bondulan, San Dionisio, Iloilo', 'Iloilo City', 'PHILIPPINES ', 5015, '', 'images/profile_photo/magazine-unlock-01-2.3.6302-_BD5793A30823DD0B5BE6F0E578874B53.jpg'),
(9, 'april', '1234', 'April', 'P', 'Pancho', '123213', 'Accountant', 0, '', 'pancho@gmail.com', 'qweqwe', 'sad', 'asd', 1111, 'Neneng Pancho', 'images/profile_photo/653f17294ccf7b0bbbb3d01af12bdc75.jpg'),
(10, 'janvie', '1234', 'Janvie', 'B', 'Aloro', '09636394312', 'Adviser', 9, '', 'janviealoro28@gmail.com', 'Balud,Masbate', 'Masbate', '', 1111, '', 'images/profile_photo/IMG20201206122732.jpg'),
(13, 'jeb', '1234', 'Jericho', 'B', 'Madoi', '123123', 'Adviser', 7, 'Aguinaldo', 'wizardojericho@gmail.com', 'Dayhagan Carles Iloilo', 'asd', 'asd', 12, '', '../assets/img/+');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `payment_ibfk_1` (`LRN`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`LRN_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
