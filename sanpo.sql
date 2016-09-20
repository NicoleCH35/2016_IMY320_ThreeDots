-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2016 at 05:48 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sanpo`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `storyID` int(11) NOT NULL,
  `comment` text NOT NULL,
  `postedBy` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `storyID`, `comment`, `postedBy`, `date`) VALUES
(1, 1, 'Job well done!', 1, '2016-08-31 11:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `eventName` text NOT NULL,
  `location` text NOT NULL,
  `description` text NOT NULL,
  `startDateTime` datetime NOT NULL,
  `endDateTime` datetime NOT NULL,
  `photo` text NOT NULL,
  `postedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `eventName`, `location`, `description`, `startDateTime`, `endDateTime`, `photo`, `postedBy`) VALUES
(1, 'School Fundraiser', 'Lyttelton Primary School', 'We will be doing an art sale to raise funds for this school. Funds raised will go to buying textbooks and school supplies.', '2016-09-29 08:00:00', '2016-09-29 15:00:00', './images/event1.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `eventworkgroups`
--

CREATE TABLE `eventworkgroups` (
  `id` int(11) NOT NULL,
  `wgID` int(11) NOT NULL,
  `eventID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventworkgroups`
--

INSERT INTO `eventworkgroups` (`id`, `wgID`, `eventID`) VALUES
(1, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `image` text NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `email`, `password`, `image`, `admin`) VALUES
(1, 'NicoleCH', 'nicolech35@gmail.com', '123', './images/profiles/unknown.png', 1),
(2, 'keziakoko', 'keziakoko2@gmail.com', '123', './images/profiles/unknown.png', 1),
(3, 'jeff', 'janko.lilje@gmail.com', '123', 'images/profiles/unknown.png', 0),
(4, 'max', 'keziakoko@gmail.com', '123', 'images/profiles/unknown.png', 0),
(5, 'molly', 'keziakoko2@gmail.com', '123', 'images/profiles/unknown.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `news` text NOT NULL,
  `image` text NOT NULL,
  `date` datetime NOT NULL,
  `link` text NOT NULL,
  `postedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `news`, `image`, `date`, `link`, `postedBy`) VALUES
(1, '80% of South African schools are dysfunctional', 'This is why we do what we do. Helping those in need is extremely rewarding. If you are able to, please become a member today or donate so that we can help schools in need.', './images/news1.jpg', '2016-08-31 11:00:00', 'https://africacheck.org', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `story` text NOT NULL,
  `date` date NOT NULL,
  `postedBy` int(11) NOT NULL,
  `image` text NOT NULL,
  `numLikes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `title`, `description`, `story`, `date`, `postedBy`, `image`, `numLikes`) VALUES
(1, 'School Outreach Successful', 'WE MANAGED TO RAISE ENOUGH FUNDS TO BUY THE SCHOOL SOME WELL DESERVED SPORTS EQUIPTMENT', 'From soccer balls to tennis rackets, this outreach got it all. The children of the school where extremely thankful and excited about their new sports equipment. From soccer balls to tennis rackets, this outreach got it all. The children of the school where extremely thankful and excited about their new sports equipment. From soccer balls to tennis rackets, this outreach got it all. The children of the school where extremely thankful and excited about their new sports equipment. From soccer balls to tennis rackets, this outreach got it all. The children of the school where extremely thankful and excited about their new sports equipment.', '2015-11-11', 1, './images/Soccer-GlenCarrie002.jpg', 2),
(2, 'We need more members', 'If you are looking to help people in need, look no further!', 'If you are looking to help people in need, look no further! Become a member today. By becoming a member you will be able to help us fund raise for people in need.', '2016-08-31', 2, './images/join-us1.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `workgroups`
--

CREATE TABLE `workgroups` (
  `id` int(11) NOT NULL,
  `typeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workgroups`
--

INSERT INTO `workgroups` (`id`, `typeID`, `userID`) VALUES
(1, 1, 3),
(2, 2, 4),
(3, 1, 5),
(4, 2, 1),
(10, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `workgrouptypes`
--

CREATE TABLE `workgrouptypes` (
  `id` int(11) NOT NULL,
  `workgroup` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workgrouptypes`
--

INSERT INTO `workgrouptypes` (`id`, `workgroup`) VALUES
(1, 'Decor'),
(2, 'Catering'),
(3, 'Event Coordination');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventworkgroups`
--
ALTER TABLE `eventworkgroups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workgroups`
--
ALTER TABLE `workgroups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workgrouptypes`
--
ALTER TABLE `workgrouptypes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `eventworkgroups`
--
ALTER TABLE `eventworkgroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `workgroups`
--
ALTER TABLE `workgroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `workgrouptypes`
--
ALTER TABLE `workgrouptypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
