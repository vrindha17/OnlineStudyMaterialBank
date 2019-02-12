-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2018 at 03:53 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `study_material_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Adminid` varchar(15) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `Cid` varchar(20) NOT NULL,
  `Cname` varchar(50) NOT NULL,
  `Did` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `Did` varchar(20) NOT NULL,
  `Dname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `question_paper`
--

CREATE TABLE `question_paper` (
  `Qid` int(250) NOT NULL,
  `Rid` int(255) NOT NULL,
  `Test_type` varchar(10) NOT NULL,
  `Year` varchar(10) NOT NULL,
  `Link` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_paper`
--

INSERT INTO `question_paper` (`Qid`, `Rid`, `Test_type`, `Year`, `Link`) VALUES
(1, 1, 'T1', '1998', 'http://localhost/up/moneyedthi.pdf'),
(2, 2, 'T2', '2001', 'http://localhost/up/moneyedthi.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE `resource` (
  `Rid` int(255) NOT NULL,
  `Rtype` varchar(10) NOT NULL,
  `Flag` int(10) NOT NULL,
  `Cid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`Rid`, `Rtype`, `Flag`, `Cid`) VALUES
(1, 'Q', 0, 'DSA'),
(2, 'Q', 0, 'DSA'),
(3, 'T', 0, 'DSA'),
(4, 'T', 0, 'DSA'),
(5, 'Q', 0, 'EC1');

-- --------------------------------------------------------

--
-- Table structure for table `text_book`
--

CREATE TABLE `text_book` (
  `Tid` int(255) NOT NULL,
  `Tname` varchar(100) NOT NULL,
  `Link` longtext NOT NULL,
  `Rid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `text_book`
--

INSERT INTO `text_book` (`Tid`, `Tname`, `Link`, `Rid`) VALUES
(1, 'CLRS', 'http://localhost/up/moneyedthi.pdf', '3'),
(2, 'Randomised algo', 'http://localhost/up/moneyedthi.pdf', '4');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Userid` varchar(15) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Adminid`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`Cid`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`Did`);

--
-- Indexes for table `question_paper`
--
ALTER TABLE `question_paper`
  ADD PRIMARY KEY (`Qid`),
  ADD UNIQUE KEY `Rid` (`Rid`);

--
-- Indexes for table `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`Rid`);

--
-- Indexes for table `text_book`
--
ALTER TABLE `text_book`
  ADD PRIMARY KEY (`Tid`),
  ADD UNIQUE KEY `Rid` (`Rid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Userid`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `question_paper`
--
ALTER TABLE `question_paper`
  MODIFY `Qid` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `Rid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `text_book`
--
ALTER TABLE `text_book`
  MODIFY `Tid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
