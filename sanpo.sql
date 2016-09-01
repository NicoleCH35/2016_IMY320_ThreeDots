-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2016 at 09:52 PM
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
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `storyID`, `comment`, `postedBy`, `date`) VALUES
(1, 1, 'Job well done!', 1, '2016-08-31 11:49:00');

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
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `image` text NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `eventID` int(11) NOT NULL,
  `workGroupID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `email`, `password`, `image`, `admin`, `eventID`, `workGroupID`) VALUES
(1, 'NicoleCH', 'nicolech35@gmail.com', '123', './images/nicole', 1, 0, 0),
(2, 'keziakoko', 'keziakoko2@gmail.com', '123', './images/avatar.jpg', 1, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `title`, `description`, `story`, `date`, `postedBy`, `image`, `numLikes`) VALUES
(1, 'School Outreach Successful', 'WE MANAGED TO RAISE ENOUGH FUNDS TO BUY THE SCHOOL SOME WELL DESERVED SPORTS EQUIPTMENT', 'From soccer balls to tennis rackets, this outreach got it all. The children of the school where extremely thankful and excited about their new sports equipment. From soccer balls to tennis rackets, this outreach got it all. The children of the school where extremely thankful and excited about their new sports equipment. From soccer balls to tennis rackets, this outreach got it all. The children of the school where extremely thankful and excited about their new sports equipment. From soccer balls to tennis rackets, this outreach got it all. The children of the school where extremely thankful and excited about their new sports equipment.', '2015-11-11', 1, './images/Soccer-GlenCarrie002.jpg', 2),
(2, 'We need more members', 'If you are looking to help people in need, look no further!', 'If you are looking to help people in need, look no further! Become a member today. By becoming a member you will be able to help us fund raise for people in need.', '2016-08-31', 2, './images/story2.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `workgroups`
--

CREATE TABLE IF NOT EXISTS `workgroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `workgroups`
--

INSERT INTO `workgroups` (`id`, `type`) VALUES
(1, 'Decor');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
