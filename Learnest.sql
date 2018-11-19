-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 11, 2017 at 09:16 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Learnest`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `classid` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classid`, `name`) VALUES
('CS1', 'CS 1st sem'),
('CS2', 'CS 2nd sem'),
('IT1', 'IT 1st sem'),
('IT2', 'IT 2nd sem'),
('IT3', 'IT 3rd sem'),
('IT4', 'IT 4th sem');

-- --------------------------------------------------------

--
-- Table structure for table `class_degree`
--

CREATE TABLE `class_degree` (
  `classid` varchar(45) NOT NULL,
  `degreeid` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_degree`
--

INSERT INTO `class_degree` (`classid`, `degreeid`) VALUES
('CS1', 1),
('CS2', 1),
('IT1', 0),
('IT2', 0),
('IT3', 0),
('IT4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `degrees`
--

CREATE TABLE `degrees` (
  `iddegrees` int(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `degrees`
--

INSERT INTO `degrees` (`iddegrees`, `name`) VALUES
(0, 'Information Technology'),
(1, 'Computer Science'),
(2, 'Mechanical Engineering'),
(3, 'Electrical Engineering'),
(4, 'Electronics & Telecommunications');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `title` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dname` varchar(45) NOT NULL,
  `authorid` varchar(45) NOT NULL,
  `numdownloads` int(15) DEFAULT '0',
  `description` varchar(160) DEFAULT NULL,
  `subjectid` varchar(45) NOT NULL,
  `file_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`title`, `timestamp`, `dname`, `authorid`, `numdownloads`, `description`, `subjectid`, `file_type`) VALUES
('asd', '2017-04-04 09:43:00', 'alberteinstein20170404114300.png', 'alberteinstein', 9, 'asd', 'bigdata01', 'others'),
('asd', '2017-04-04 10:01:06', 'alberteinstein20170404120106.php', 'alberteinstein', 7, 'asd', 'bigdata01', 'others'),
('asdsa', '2017-04-04 12:45:54', 'alberteinstein20170404144554.php', 'alberteinstein', 2, 'asdas', 'bigdata01', 'others'),
('asdas', '2017-04-04 12:46:23', 'alberteinstein20170404144623.html', 'alberteinstein', 2, 'asdas', 'bigdata01', 'others'),
('asdasd', '2017-04-04 12:47:31', 'alberteinstein20170404144731.html', 'alberteinstein', 2, 'asdas', 'cc01', 'others'),
('asdas', '2017-04-04 19:24:46', 'alberteinstein20170404212446.php', 'alberteinstein', 1, 'adas', 'bigdata01', 'others'),
('asdasd', '2017-04-04 19:30:14', 'alberteinstein20170404213014.php', 'alberteinstein', 1, 'asd', 'bigdata01', 'others'),
('ashish', '2017-04-04 19:32:07', 'alberteinstein20170404213207.php', 'alberteinstein', 0, 'asds', 'bigdata01', 'others'),
('asdsa', '2017-04-04 19:34:15', 'alberteinstein20170404213415.sql', 'alberteinstein', 1, 'asdsa', 'bigdata01', 'others'),
('notificatoin', '2017-04-04 19:35:38', 'alberteinstein20170404213538.sql', 'alberteinstein', 1, 'asdas', 'bigdata01', 'others'),
('asdfas', '2017-04-04 19:40:02', 'alberteinstein20170404214002.png', 'alberteinstein', 0, 'undefined', 'bigdata01', 'others'),
('this should work', '2017-04-04 19:44:06', 'alberteinstein20170404214406.png', 'alberteinstein', 0, 'undefined', 'bigdata01', 'others'),
('this should definitly work', '2017-04-04 19:45:21', 'alberteinstein20170404214521.png', 'alberteinstein', 0, 'asd', 'bigdata01', 'others'),
('asd', '2017-04-04 19:47:32', 'alberteinstein20170404214732.png', 'alberteinstein', 0, 'asd', 'bigdata01', 'others'),
('asd', '2017-04-04 19:48:33', 'alberteinstein20170404214833.png', 'alberteinstein', 0, 'asd', 'bigdata01', 'others'),
('asdasd', '2017-04-04 19:51:04', 'alberteinstein20170404215104.png', 'alberteinstein', 0, 'asdasd', 'bigdata01', 'others'),
('asdsa', '2017-04-04 19:57:49', 'alberteinstein20170404215749.png', 'alberteinstein', 0, 'asdasd', 'bigdata01', 'others'),
('asdas', '2017-04-04 20:00:54', 'alberteinstein20170404220054.png', 'alberteinstein', 0, 'asdas', 'bigdata01', 'others'),
('asda', '2017-04-04 20:01:36', 'alberteinstein20170404220136.png', 'alberteinstein', 0, 'asdsa', 'bigdata01', 'others'),
('adas', '2017-04-04 20:07:27', 'alberteinstein20170404220727.png', 'alberteinstein', 0, 'asd', 'bigdata01', 'others'),
('asdasda', '2017-04-04 20:12:05', 'alberteinstein20170404221205.png', 'alberteinstein', 0, 'dasdas', 'bigdata01', 'others'),
('asda', '2017-04-04 20:15:18', 'alberteinstein20170404221518.png', 'alberteinstein', 0, 'asdsa', 'bigdata01', 'others'),
('asds', '2017-04-04 20:20:52', 'alberteinstein20170404222052.png', 'alberteinstein', 0, 'asds', 'bigdata01', 'others'),
('asds', '2017-04-04 20:25:33', 'alberteinstein20170404222533.png', 'alberteinstein', 0, 'asda', 'bigdata01', 'others'),
('asdmamn', '2017-04-04 20:28:58', 'alberteinstein20170404222858.png', 'alberteinstein', 0, 'jakdak', 'bigdata01', 'others'),
('asd', '2017-04-11 03:43:34', 'alberteinstein20170411054334.jpg', 'alberteinstein', 0, 'asd', 'bigdata01', 'others'),
('asd', '2017-04-11 03:46:01', 'alberteinstein20170411054601.pdf', 'alberteinstein', 0, 'asd', 'bigdata01', 'others'),
('asd', '2017-04-11 03:50:00', 'alberteinstein20170411055000.pdf', 'alberteinstein', 0, 'asd', 'bigdata01', 'others'),
('asd', '2017-04-11 03:53:42', 'alberteinstein20170411055342.pdf', 'alberteinstein', 1, 'asd', 'bigdata01', 'others'),
('asd', '2017-03-29 14:20:22', 'amansoni91120170329162022.html', 'amansoni911', 0, 'asd', 'bigdata01', 'others'),
('asda', '2017-04-04 11:02:05', 'amansoni91120170404130205.html', 'amansoni911', 0, 'asd', 'bigdata01', 'others'),
('afafs', '2017-04-04 11:03:36', 'amansoni91120170404130336.php', 'amansoni911', 0, 'asdasd', 'bigdata01', 'others'),
('asdasa', '2017-04-04 11:05:05', 'amansoni91120170404130505.html', 'amansoni911', 0, 'sda', 'bigdata01', 'others'),
('qweqwew', '2017-04-04 11:06:36', 'amansoni91120170404130636.html', 'amansoni911', 1, 'qweqwe', 'cc01', 'others'),
('uhuhuh', '2017-04-04 11:09:20', 'amansoni91120170404130920.php', 'amansoni911', 0, 'jiijooi', 'cc01', 'others'),
('amishi file2', '2017-03-15 14:35:55', 'amishi20170315153555.pdf', 'amishi', 2, 'undefined', 'bigdata01', 'book'),
('amishi File1', '2017-03-15 14:36:35', 'amishi20170315153635.pdf', 'amishi', 0, 'undefined', 'cc01', 'book'),
('file-2', '2017-03-15 14:39:34', 'amishi20170315153934.pdf', 'amishi', 1, 'undefined', 'cc01', 'book'),
('amishi''s new file', '2017-03-15 14:44:30', 'amishi20170315154430.png', 'amishi', 0, 'hello there', 'ssp01', 'others'),
('as', '2016-03-27 11:06:17', 'ashishmalgawa20160327130617.png', 'ashishmalgawa', 1, 'asd', 'cc01', 'others'),
('uploadagain', '2017-03-15 14:51:38', 'ashishmalgawa20170315155138.png', 'ashishmalgawa', 0, 'undefined', 'cc01', 'others'),
('upload file', '2017-03-15 14:58:19', 'ashishmalgawa20170315155819.rar', 'ashishmalgawa', 0, 'undefined', 'bigdata01', 'others'),
('upload images', '2017-03-15 15:54:50', 'ashishmalgawa20170315165450.jpg', 'ashishmalgawa', 4, 'vfbvadfv', 'cc01', 'others'),
('asd', '2017-03-27 11:00:59', 'ashishmalgawa20170327130059.png', 'ashishmalgawa', 0, 'asd', 'bigdata01', 'others'),
('as', '2017-03-27 11:06:17', 'ashishmalgawa20170327130617.png', 'ashishmalgawa', 0, 'asd', 'cc01', 'others'),
('as', '2017-03-28 06:07:12', 'ashishmalgawa20170328080712.png', 'ashishmalgawa', 0, 'asd', 'cc01', 'others'),
('asd', '2017-03-28 06:08:34', 'ashishmalgawa20170328080834.png', 'ashishmalgawa', 0, 'asd', 'bigdata01', 'others'),
('as', '2017-03-28 06:09:38', 'ashishmalgawa20170328080938.png', 'ashishmalgawa', 0, 'asd', 'bigdata01', 'others'),
('asd', '2017-03-28 06:21:07', 'ashishmalgawa20170328082107.png', 'ashishmalgawa', 1, 'asd', 'cc01', 'others'),
('asd', '2017-03-28 06:24:25', 'ashishmalgawa20170328082425.png', 'ashishmalgawa', 2, 'asd', 'bigdata01', 'others'),
('ads', '2017-03-28 06:25:33', 'ashishmalgawa20170328082533.png', 'ashishmalgawa', 0, 'asd', 'bigdata01', 'others'),
('asd', '2017-03-28 06:26:45', 'ashishmalgawa20170328082645.png', 'ashishmalgawa', 0, 'asd', 'bigdata01', 'others'),
('asd', '2017-03-28 06:27:11', 'ashishmalgawa20170328082711.png', 'ashishmalgawa', 0, 'asd', 'bigdata01', 'others'),
('asd', '2017-03-28 06:46:56', 'ashishmalgawa20170328084656.png', 'ashishmalgawa', 0, 'asd', 'bigdata01', 'others'),
('asd', '2017-03-28 06:48:56', 'ashishmalgawa20170328084856.png', 'ashishmalgawa', 0, 'asd', 'bigdata01', 'others'),
('as', '2017-03-28 06:50:01', 'ashishmalgawa20170328085001.png', 'ashishmalgawa', 0, 'asd', 'cc01', 'others'),
('asd', '2017-03-28 06:58:34', 'ashishmalgawa20170328085834.png', 'ashishmalgawa', 0, 'asd', 'bigdata01', 'others'),
('s', '2017-03-28 07:22:21', 'ashishmalgawa20170328092221.png', 'ashishmalgawa', 0, 'd', 'bigdata01', 'others'),
('asd', '2017-03-28 07:23:01', 'ashishmalgawa20170328092301.png', 'ashishmalgawa', 0, 'asd', 'cc01', 'others'),
('asd', '2017-03-29 11:37:09', 'ashishmalgawa20170329133709.png', 'ashishmalgawa', 0, 'asd', 'bigdata01', 'others'),
('asd', '2017-03-29 17:21:45', 'ashishmalgawa20170329192145.html', 'ashishmalgawa', 0, 'asd', 'bigdata01', 'others'),
('asda', '2017-03-29 17:50:12', 'ashishmalgawa20170329195012.html', 'ashishmalgawa', 0, 'sd', 'bigdata01', 'others'),
('asda', '2017-03-29 17:52:13', 'ashishmalgawa20170329195213.html', 'ashishmalgawa', 0, 'dsas', 'bigdata01', 'others'),
('asd', '2017-03-29 18:21:19', 'ashishmalgawa20170329202119.php', 'ashishmalgawa', 0, 'asd', 'cc01', 'others'),
('asd', '2017-03-29 18:21:41', 'ashishmalgawa20170329202141.html', 'ashishmalgawa', 0, 'asd', 'bigdata01', 'others'),
('dasd', '2017-04-01 08:20:14', 'ashishmalgawa20170401102014.png', 'ashishmalgawa', 0, 'undefined', 'bigdata01', 'others'),
('asd', '2017-04-01 08:24:08', 'ashishmalgawa20170401102408.png', 'ashishmalgawa', 0, 'undefined', 'bigdata01', 'others'),
('asd', '2017-04-01 08:43:26', 'ashishmalgawa20170401104326.html', 'ashishmalgawa', 0, 'asd', 'bigdata01', 'others'),
('asd', '2017-04-01 08:44:39', 'ashishmalgawa20170401104439.html', 'ashishmalgawa', 0, 'undefined', 'bigdata01', 'others'),
('sdf', '2017-04-01 08:44:58', 'ashishmalgawa20170401104458.php', 'ashishmalgawa', 0, 'asd', 'cc01', 'others'),
('asd', '2017-04-04 09:54:29', 'ashishmalgawa20170404115429.png', 'ashishmalgawa', 0, 'asd', 'bigdata02', 'others'),
('asd', '2017-04-04 09:54:47', 'ashishmalgawa20170404115447.png', 'ashishmalgawa', 1, 'asd', 'bigdata01', 'others'),
('asdafa', '2017-04-04 10:01:29', 'ashishmalgawa20170404120129.png', 'ashishmalgawa', 0, 'asdsa', 'bigdata01', 'others'),
('asasdas', '2017-04-04 10:04:30', 'ashishmalgawa20170404120430.sql', 'ashishmalgawa', 0, 'asdas', 'bigdata01', 'others'),
('sdasdas', '2017-04-04 10:52:26', 'ashishmalgawa20170404125226.png', 'ashishmalgawa', 1, 'asdas', 'cc01', 'others'),
('asdas', '2017-04-04 10:55:24', 'ashishmalgawa20170404125524.png', 'ashishmalgawa', 0, 'asda', 'bigdata01', 'others'),
('asda', '2017-04-04 19:22:04', 'ashishmalgawa20170404212204.png', 'ashishmalgawa', 0, 'asda', 'bigdata01', 'others'),
('asdsa', '2017-04-04 19:25:04', 'ashishmalgawa20170404212504.png', 'ashishmalgawa', 1, 'asdsa', 'bigdata01', 'others'),
('asd', '2017-04-04 20:07:06', 'ashishmalgawa20170404220706.png', 'ashishmalgawa', 0, 'asd', 'bigdata01', 'others'),
('asdas', '2017-04-04 20:11:48', 'ashishmalgawa20170404221148.png', 'ashishmalgawa', 1, 'adsas', 'bigdata01', 'others'),
('asdasd', '2017-04-04 20:27:38', 'ashishmalgawa20170404222738.png', 'ashishmalgawa', 2, 'asda', 'bigdata01', 'others'),
('asdsada', '2017-04-04 20:28:17', 'ashishmalgawa20170404222817.png', 'ashishmalgawa', 1, 'sada', 'cc01', 'others'),
('asda', '2017-04-04 20:28:36', 'ashishmalgawa20170404222836.png', 'ashishmalgawa', 5, 'asdas', 'bigdata01', 'others'),
('asda', '2017-04-05 11:00:07', 'ashishmalgawa20170405130007.php', 'ashishmalgawa', 0, 'asda', 'bigdata01', 'others'),
('asdsa', '2017-04-10 07:12:33', 'ashishmalgawa20170410091233.png', 'ashishmalgawa', 1, 'asdas', 'bigdata01', 'others'),
('asdas', '2017-04-10 07:12:43', 'ashishmalgawa20170410091243.png', 'ashishmalgawa', 2, 'asdas', 'bigdata01', 'others'),
('asd', '2017-04-10 09:57:20', 'ashishmalgawa20170410115720.png', 'ashishmalgawa', 0, 'asd', 'bigdata02', 'others'),
('asd', '2017-04-10 09:57:42', 'ashishmalgawa20170410115742.png', 'ashishmalgawa', 0, 'asd', 'bigdata01', 'others'),
('The book', '2017-04-10 12:16:05', 'ashishmalgawa20170410141605.pdf', 'ashishmalgawa', 0, 'undefined', 'bigdata01', 'book'),
('Peter galvin', '2017-04-10 12:18:52', 'ashishmalgawa20170410141852.pdf', 'ashishmalgawa', 3, 'undefined', 'bigdata01', 'book'),
('hello', '2017-04-11 03:55:48', 'ashishmalgawa20170411055548.pdf', 'ashishmalgawa', 0, 'asd', 'bigdata01', 'book'),
('file', '2017-03-16 13:05:51', 'fatema20170316140551.png', 'fatema', 2, 'asfds', 'cc02', 'others'),
('Hello world 2', '2017-04-11 06:45:15', 'johndoe20170411084515.jpg', 'johndoe', 0, 'undefined', 'cc01', 'others'),
('v.imp', '2017-03-29 12:56:13', 'pankhu120170329145613.jpg', 'pankhu1', 1, 'most imp file of this sem....', 'ssp01', 'others'),
('samarth''s file', '2017-03-15 14:46:23', 'samarth20170315154623.png', 'samarth', 0, 'its', 'cc01', 'others'),
('new file#', '2017-03-15 14:49:11', 'samarth20170315154911.png', 'samarth', 0, 'it''s new%', 'cc01', 'others'),
('Virtualization', '2016-04-10 07:24:56', 'vineet chitlangia20170410092456.png', 'vineet chitlangia', 1, 'Virtualization', 'cc01', 'others'),
('vivek124', '2017-03-15 16:56:01', 'vivek20170315165234.jpg', 'vivekkapoor', 0, NULL, 'ssp01', 'others'),
('vivek123', '2017-03-15 16:55:36', 'vivek20170315165450.jpg', 'vivekkapoor', 0, NULL, 'ssp01', 'others'),
('vivek222', '2017-03-15 16:57:20', 'vivek20170315165523.pdf', 'vivekkapoor', 0, 'ndhtnh', 'cc01', 'book');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `idsubjects` varchar(45) NOT NULL,
  `sname` varchar(45) NOT NULL,
  `classid` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`idsubjects`, `sname`, `classid`) VALUES
('bigdata01', 'big data', 'IT1'),
('bigdata02', 'Big Data Analytics', 'CS1'),
('cc01', 'Cloud Computing', 'IT2'),
('cc02', 'Cloud Computing', 'CS2'),
('sp01', 'System Programming', 'IT3'),
('sp02', 'System Programming', 'CS2'),
('ssp01', 'Server Side Programming', 'IT4'),
('ssp02', 'Server Side Programming', 'CS1');

-- --------------------------------------------------------

--
-- Table structure for table `subscribed`
--

CREATE TABLE `subscribed` (
  `subscriber` varchar(45) NOT NULL,
  `subscribedTo` varchar(45) NOT NULL,
  `stimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subscribedTo_type` varchar(10) NOT NULL,
  `lastCheckedTimestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribed`
--

INSERT INTO `subscribed` (`subscriber`, `subscribedTo`, `stimestamp`, `subscribedTo_type`, `lastCheckedTimestamp`) VALUES
('a', 'amishi', '2017-03-15 16:44:37', 'student', '0000-00-00 00:00:00'),
('alberteinstein', 'CS1', '2017-04-11 07:02:40', 'class', '0000-00-00 00:00:00'),
('alberteinstein', 'CS2', '2017-04-11 07:02:40', 'class', '0000-00-00 00:00:00'),
('alberteinstein', 'IT1', '2017-04-11 07:02:40', 'class', '0000-00-00 00:00:00'),
('amansoni911', 'ashishmalgawa', '2017-04-10 07:12:11', 'student', '0000-00-00 00:00:00'),
('amishi', 'fatema', '2017-03-15 16:44:37', 'student', '0000-00-00 00:00:00'),
('anantnayak', 'ashishmalgawa', '2017-03-29 12:43:36', 'student', '0000-00-00 00:00:00'),
('ashishmalgawa', 'alberteinstein', '2017-04-04 18:04:43', 'teacher', '0000-00-00 00:00:00'),
('ashishmalgawa', 'CS2', '2017-03-15 17:02:20', 'class', '0000-00-00 00:00:00'),
('ashishmalgawa', 'fatema', '2017-04-10 09:14:31', 'student', '0000-00-00 00:00:00'),
('ashishmalgawa', 'fatema2', '2017-04-04 21:44:23', 'student', '0000-00-00 00:00:00'),
('ashishmalgawa', 'fatema3', '2017-03-15 16:44:37', 'student', '0000-00-00 00:00:00'),
('ashishmalgawa', 'fatema4', '2017-03-15 16:44:37', 'student', '0000-00-00 00:00:00'),
('ashishmalgawa', 'IT1', '2017-04-05 11:00:16', 'class', '0000-00-00 00:00:00'),
('ashishmalgawa', 'IT2', '2017-03-15 17:02:20', 'class', '0000-00-00 00:00:00'),
('ashishmalgawa', 'laxmi', '2017-04-10 09:52:16', 'student', '0000-00-00 00:00:00'),
('ashishmalgawa', 'manavmodi', '2017-03-25 14:30:06', 'student', '0000-00-00 00:00:00'),
('ashishmalgawa', 'manojmalgawa', '2017-03-25 15:07:58', 'student', '0000-00-00 00:00:00'),
('ashishmalgawa', 'samarth', '2017-03-15 16:44:37', 'student', '0000-00-00 00:00:00'),
('ashishmalgawa', 'samarth2', '2017-03-15 16:44:37', 'student', '0000-00-00 00:00:00'),
('ashishmalgawa', 'samarth3', '2017-03-15 16:44:37', 'student', '0000-00-00 00:00:00'),
('ashishmalgawa', 'shreya', '2017-04-05 10:51:24', 'student', '0000-00-00 00:00:00'),
('ashishmalgawa', 'vivekkapoor', '2017-03-15 16:44:37', 'teacher', '0000-00-00 00:00:00'),
('ashishmalgawa', 'wadewilson', '2017-03-15 16:44:37', 'teacher', '0000-00-00 00:00:00'),
('fatema', 'amishi', '2017-03-15 16:44:37', 'student', '0000-00-00 00:00:00'),
('fatema', 'CS1', '2017-03-15 17:02:00', 'class', '0000-00-00 00:00:00'),
('fatema', 'CS2', '2017-03-15 17:02:20', 'class', '0000-00-00 00:00:00'),
('fatema', 'fatema2', '2017-03-15 16:44:37', 'student', '0000-00-00 00:00:00'),
('fatema', 'fatema3', '2017-03-15 16:44:37', 'student', '0000-00-00 00:00:00'),
('fatema', 'fatema4', '2017-03-15 16:44:37', 'student', '0000-00-00 00:00:00'),
('fatema', 'IT2', '2017-03-15 17:02:20', 'class', '0000-00-00 00:00:00'),
('fatema', 'laxmi', '2017-03-17 06:43:32', 'student', '0000-00-00 00:00:00'),
('fatema', 'samarth', '2017-03-15 16:44:37', 'student', '0000-00-00 00:00:00'),
('fatema', 'samarth2', '2017-03-15 16:44:37', 'student', '0000-00-00 00:00:00'),
('fatema', 'samarth3', '2017-03-15 16:44:37', 'student', '0000-00-00 00:00:00'),
('fatema', 'vivekkapoor', '2017-03-15 16:44:37', 'teacher', '0000-00-00 00:00:00'),
('fatema', 'wadewilson', '2017-03-15 16:44:37', 'teacher', '0000-00-00 00:00:00'),
('fatema110', 'ashishmalgawa', '2017-03-27 07:35:00', 'student', '0000-00-00 00:00:00'),
('fatema2', 'amishi', '2017-03-15 16:44:37', 'student', '0000-00-00 00:00:00'),
('fatema2', 'ashishmalgawa', '2017-03-15 16:44:37', 'student', '0000-00-00 00:00:00'),
('fatema2', 'vivekkapoor', '2017-03-15 16:44:37', 'teacher', '0000-00-00 00:00:00'),
('fatema2', 'wadewilson', '2017-03-15 16:44:37', 'teacher', '0000-00-00 00:00:00'),
('fatema3', 'vivekkapoor', '2017-03-15 16:44:37', 'teacher', '0000-00-00 00:00:00'),
('fatema3', 'wadewilson', '2017-03-15 16:44:37', 'teacher', '0000-00-00 00:00:00'),
('fatema4', 'vivekkapoor', '2017-03-15 16:44:37', 'teacher', '0000-00-00 00:00:00'),
('fatema4', 'wadewilson', '2017-03-15 16:44:37', 'teacher', '0000-00-00 00:00:00'),
('johndoe', 'alberteinstein', '2017-04-11 06:43:39', 'teacher', '0000-00-00 00:00:00'),
('johndoe', 'IT1', '2017-04-11 06:43:10', 'class', '0000-00-00 00:00:00'),
('johndoe', 'IT2', '2017-04-11 06:44:21', 'class', '0000-00-00 00:00:00'),
('johndoe', 'laxmi', '2017-04-11 06:43:27', 'student', '0000-00-00 00:00:00'),
('narutouzu', 'ashishmalgawa', '2017-03-27 18:04:28', 'student', '0000-00-00 00:00:00'),
('peterparker', 'ashishmalgawa', '2017-03-27 17:08:37', 'student', '0000-00-00 00:00:00'),
('peterparker', 'laxmi', '2017-03-27 16:36:40', 'student', '0000-00-00 00:00:00'),
('samarth', 'fatema', '2017-03-15 16:44:37', 'student', '0000-00-00 00:00:00'),
('shreya', 'ashishmalgawa', '2017-04-05 10:49:02', 'student', '0000-00-00 00:00:00'),
('shreya', 'laxmi', '2017-04-05 10:46:55', 'student', '0000-00-00 00:00:00'),
('vineet chitlangia', 'ashishmalgawa', '2017-04-10 07:53:42', 'student', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `idteacher` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `contact` varchar(45) DEFAULT NULL,
  `dob` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`idteacher`, `name`, `email`, `gender`, `password`, `contact`, `dob`) VALUES
('alberteinstein', 'albert einstien', 'raktdonation@gmail.com', 'male', '12345678', '7509777756', 'Fri Apr 14 2017 '),
('vivekkapoor', 'vivek kapoor', 'vivekkapoor@gmail.com', 'male', '12345678', '1234567890', NULL),
('wadewilson', 'Wade Wilson', 'wadewilson@gmail.com', 'male', '12345678', '1234567899', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject`
--

CREATE TABLE `teacher_subject` (
  `fk_idteachers` varchar(45) NOT NULL,
  `fk_idsubjects` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher_subject`
--

INSERT INTO `teacher_subject` (`fk_idteachers`, `fk_idsubjects`) VALUES
('alberteinstein', 'bigdata01'),
('alberteinstein', 'bigdata02'),
('alberteinstein', 'cc02'),
('alberteinstein', 'ssp02'),
('vivekkapoor', 'bigdata01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idusers` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `dob` varchar(15) DEFAULT NULL,
  `iddegrees` varchar(45) DEFAULT NULL,
  `contact` varchar(45) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `rep` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `email`, `dob`, `iddegrees`, `contact`, `gender`, `name`, `rep`) VALUES
('abhishek', 'abhishek.akotiya@gmail.com', 'Sun Jan 01 1995', '0', '8989505915', 'male', 'Abhishek', 0),
('amansoni911', 'Amansoni911@gmail.com', 'Sat Mar 18 2017', '0', '1239871479', 'male', 'Aman Soni', 1),
('amishi', 'amishi@gmail.com', 'Fri Feb 24 2017', '0', '7509888812', 'female', 'Amishi Singh', 2),
('anantnayak', 'kabid684@gmail.com', 'Tue Dec 28 1993', '0', '7415435158', 'male', 'anant nayak', 0),
('anitamalgawa@gmail.com', 'anitamalgawa@gmail.com', 'Sun Dec 31 2017', '0', '8827102542', 'female', 'anita malgawa', 0),
('ashishmalgaw', 'ashishmalgaa@gmail.com', 'Sun Dec 31 2017', '0', '7509888856', 'male', 'Lala', 0),
('ashishmalgawa', 'ashishmalgawa@gmail.com', 'Sun Mar 05 2017', '0', '7509888857', 'male', 'ashish malgawa', 14),
('ashishmalgawatest', 'learnestdemo@india.com', 'Mon Apr 10 2017', '0', '7509888893', 'male', 'ashish', 0),
('bhagatsingh', 'bhagatsingh123456@gmail.com', 'Sun Dec 31 2017', '0', '1239874568', 'male', 'Bhagat Singh', 0),
('chauadhar', 'asd@gmail.com', 'Sat Mar 11 2017', '0', '7509888823', 'male', 'chacha', 0),
('fatema', 'fatema@gmail.com', 'Wed Feb 15 2017', '1', '1234567890', 'female', 'Fatema', 0),
('fatema110', 'fatemae110@gmail.com', 'Thu Mar 23 2017', '0', '9424092249', 'female', 'Fatema Engineeringwala', 0),
('fatema2', 'fatema2@gmail.com', 'Wed Feb 15 2017', '3', '1234567892', 'female', 'Fatema Engineeringwala', 0),
('fatema3', 'fatema3@gmail.com', 'Wed Feb 15 2017', '4', '1234567893', 'female', 'Fatema3', 0),
('fatema4', 'fatema4@gmail.com', 'Wed Feb 15 2017', '2', '1234567894', 'female', 'Fatema4', 0),
('johndoe', 'learnest@india.com', 'Fri Apr 07 2017', '1', '8827102544', 'female', 'John Doe', 0),
('lalafa', 'laal@gmai.com', 'Sun Dec 31 2017', '0', '9876543210', 'male', 'Lala', 0),
('laxmi', 'laxmi@gamil.com', 'Fri Dec 30 2016', '2', '1234569875', 'female', 'Rani Laxmi Bai', 25000),
('manavmodi', 'manavmodi007@gmail.com', 'Sun Dec 31 2017', '1', '9876541456', 'male', 'Manav Modi', 0),
('manojmalgawa', 'manojmalgawa@gmail.com', 'Wed Mar 01 2017', '1', '9827243277', 'male', 'Manoj Malgawa', 0),
('manojmalgawa2', 'manojmalgawaoffice@gmail.com', 'Sun Dec 31 2017', '0', '9827243266', 'male', 'Manoj Malgawa', 0),
('narutouzu', 'Stelbloom@gmail.com', 'Sat Mar 18 2017', '0', '1239871478', 'male', 'Naruto Uzumaki', 0),
('nehamalgawa', 'nehamalgawa@gmail.com', 'Sun Dec 31 2017', '0', '8827544151', 'female', 'Neha Malgawa', 0),
('pankhu1', 'pankhuri.agrawal13@gmail.com', 'Wed Mar 01 1995', '0', '8982376177', 'female', 'pankhuri agrawal', 0),
('peterparker', 'learnestasf@gmail.com', 'Sun Dec 31 2017', '1', '7509888868', 'male', 'Peter Parker', 0),
('samarth', 'samarth@gmail.com', 'Wed Feb 15 2017', '0', '1234567895', 'male', 'samarth', 0),
('samarth1', 'samarth1@gmail.com', 'Wed Feb 15 2017', '1', '1234567896', 'male', 'samarth1', 0),
('samarth2', 'samarth2@gmail.com', 'Wed Feb 15 2017', '2', '1234567897', 'male', 'samarth2', 0),
('samarth3', 'samarth3@gmail.com', 'Wed Feb 15 2017', '3', '1234567898', 'male', 'samarth3', 0),
('samarth4', 'samarth4@gmail.com', 'Wed Feb 15 2017', '4', '1234567899', 'male', 'samarth4', 0),
('samarthjain', 'samarthjain1996@gmail.com', 'Thu Mar 16 2017', '0', '1234569874', 'male', 'Samarth Jain', 0),
('shreya', 'shreyaverma850@gmail.com', 'Wed Jan 16 2002', '1', '9302633299', 'female', 'shreya', 0),
('vineet chitlangia', 'chitlangiavineet09@gmail.com', 'Fri Feb 03 2017', '0', '8989617039', 'male', 'Vineet Chitlangia', 1),
('vipradubey', 'vipradubey@gmail.com', 'Thu Dec 31 2015', '1', '7509222222', 'male', 'Vipra Dubey', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classid`);

--
-- Indexes for table `class_degree`
--
ALTER TABLE `class_degree`
  ADD PRIMARY KEY (`classid`,`degreeid`);

--
-- Indexes for table `degrees`
--
ALTER TABLE `degrees`
  ADD PRIMARY KEY (`iddegrees`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`dname`),
  ADD KEY `timestamp` (`timestamp`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`idsubjects`);

--
-- Indexes for table `subscribed`
--
ALTER TABLE `subscribed`
  ADD PRIMARY KEY (`subscriber`,`subscribedTo`),
  ADD KEY `subscriber` (`subscriber`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`idteacher`);

--
-- Indexes for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD PRIMARY KEY (`fk_idteachers`,`fk_idsubjects`),
  ADD KEY `idsubjects_idx` (`fk_idsubjects`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`),
  ADD UNIQUE KEY `mobile_UNIQUE` (`contact`),
  ADD KEY `iddegrees_idx` (`iddegrees`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
