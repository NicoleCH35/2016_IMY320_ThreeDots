-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2016 at 01:46 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sanpo`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `storyID` int(11) NOT NULL,
  `comment` text NOT NULL,
  `postedBy` int(11) NOT NULL,
  `datePosted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `storyID`, `comment`, `postedBy`, `datePosted`) VALUES
(1, 1, 'Job well done!', 1, '2016-08-31 11:49:00'),
(2, 1, 'COOL!', 2, '2016-09-08 15:36:36'),
(3, 1, 'Looks Great! Well DONE!', 0, '2016-09-20 22:13:10'),
(5, 2, 'Hello', 0, '2016-09-20 23:47:11'),
(6, 1, 'WOW', 0, '2016-09-20 23:47:25'),
(9, 2, 'sounds like a cult', 3, '2016-09-20 23:50:54'),
(11, 2, 'cool', 0, '2016-09-21 00:24:48');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventName` text NOT NULL,
  `location` text NOT NULL,
  `description` text NOT NULL,
  `startDateTime` datetime NOT NULL,
  `endDateTime` datetime NOT NULL,
  `photo` text NOT NULL,
  `postedBy` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `eventName`, `location`, `description`, `startDateTime`, `endDateTime`, `photo`, `postedBy`) VALUES
(1, 'School Fundraiser', 'Lyttelton Primary School', 'We will be doing an art sale to raise funds for this school. Funds raised will go to buying textbooks and school supplies.', '2016-09-29 08:00:00', '2016-09-29 15:00:00', './images/event1.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `eventworkgroups`
--

CREATE TABLE IF NOT EXISTS `eventworkgroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wgID` int(11) NOT NULL,
  `eventID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `image` text NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `email`, `password`, `image`, `admin`) VALUES
(1, 'NicoleCH', 'nicolech35@gmail.com', '123', './images/profiles/unknown.png', 1),
(2, 'keziakoko', 'keziakoko2@gmail.com', '123', './images/profiles/unknown.png', 1),
(3, 'jeff', 'janko.lilje@gmail.com', '123', 'images/profiles/unknown.png', 1),
(4, 'max', 'keziakoko@gmail.com', '123', 'images/profiles/unknown.png', 0),
(5, 'molly', 'keziakoko2@gmail.com', '123', 'images/profiles/unknown.png', 0),
(6, 'Zachary', 'zacharyk36@gmail.com ', '123', 'images/profiles/unknown.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `news` text NOT NULL,
  `image` text NOT NULL,
  `date` datetime NOT NULL,
  `link` text NOT NULL,
  `postedBy` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `news`, `image`, `date`, `link`, `postedBy`) VALUES
(1, '80% of South African schools are dysfunctional', 'This is why we do what we do. Helping those in need is extremely rewarding. If you are able to, please become a member today or donate so that we can help schools in need.', './images/news1.jpg', '2016-08-31 11:00:00', 'https://africacheck.org', 1);

-- --------------------------------------------------------

--
-- Table structure for table `officialfiles`
--

CREATE TABLE IF NOT EXISTS `officialfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `name` text NOT NULL,
  `filePath` text NOT NULL,
  `dateUploaded` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `officialfiles`
--

INSERT INTO `officialfiles` (`id`, `type`, `name`, `filePath`, `dateUploaded`) VALUES
(7, 'Document', 'Account Info', './images/OfficialUploads/accounting.jpg', '2016-09-21'),
(11, 'Music', 'Official Song', './images/OfficialUploads/test.wav', '2016-09-21'),
(12, 'File', 'Event Info', './images/OfficialUploads/Test.pdf', '2016-09-21');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE IF NOT EXISTS `stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `story` text NOT NULL,
  `date` date NOT NULL,
  `postedBy` int(11) NOT NULL,
  `image` text NOT NULL,
  `numLikes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `title`, `description`, `story`, `date`, `postedBy`, `image`, `numLikes`) VALUES
(1, 'School Outreach Successful', 'WE MANAGED TO RAISE ENOUGH FUNDS TO BUY THE SCHOOL SOME WELL DESERVED SPORTS EQUIPTMENT', 'From soccer balls to tennis rackets, this outreach got it all. The children of the school where extremely thankful and excited about their new sports equipment. From soccer balls to tennis rackets, this outreach got it all. The children of the school where extremely thankful and excited about their new sports equipment. From soccer balls to tennis rackets, this outreach got it all. The children of the school where extremely thankful and excited about their new sports equipment. From soccer balls to tennis rackets, this outreach got it all. The children of the school where extremely thankful and excited about their new sports equipment.', '2015-11-11', 1, './images/Soccer-GlenCarrie002.jpg', 5),
(2, 'We need more members', 'If you are looking to help people in need, look no further!', 'If you are looking to help people in need, look no further! Become a member today. By becoming a member you will be able to help us fund raise for people in need.', '2016-08-31', 2, './images/join-us1.jpg', 8);

-- --------------------------------------------------------

--
-- Table structure for table `workgroups`
--

CREATE TABLE IF NOT EXISTS `workgroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `workgroups`
--

INSERT INTO `workgroups` (`id`, `typeID`, `userID`) VALUES
(1, 1, 3),
(2, 2, 4),
(3, 2, 5),
(4, 2, 1),
(10, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `workgrouptypes`
--

CREATE TABLE IF NOT EXISTS `workgrouptypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `workgroup` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `workgrouptypes`
--

INSERT INTO `workgrouptypes` (`id`, `workgroup`) VALUES
(1, 'Decor'),
(2, 'Catering'),
(3, 'Event Coordination'),
(4, 'Design'),
(5, 'Marketing'),
(6, 'Accounts');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
