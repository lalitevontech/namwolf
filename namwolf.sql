-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 19, 2014 at 02:48 PM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `namwolf`
--

-- --------------------------------------------------------

--
-- Table structure for table `attorneys`
--

CREATE TABLE IF NOT EXISTS `attorneys` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FieldValue` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `attorneys`
--

INSERT INTO `attorneys` (`Id`, `FieldValue`) VALUES
(1, '5'),
(2, '6-10'),
(3, '11-20'),
(4, '>20');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FieldValue` varchar(255) NOT NULL,
  `StateId` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`Id`, `FieldValue`, `StateId`) VALUES
(1, 'Mountain Lakes', '1'),
(2, 'Bentonville', '52'),
(3, 'Berkeley', '5'),
(4, 'Carlsbad', '5'),
(5, 'Encinitas', '5'),
(6, 'Glendale', '5'),
(7, 'Irvine', '5'),
(8, 'Los Angeles', '5'),
(9, 'Oakland', '5'),
(10, 'Orange', '5'),
(11, 'Sacramento', '5'),
(12, 'San Diego', '5'),
(13, 'San Francisco', '5'),
(14, 'Santa Ana', '5'),
(15, 'Santa Rosa', '5'),
(16, 'Torrance', '5'),
(17, 'Walnut Creek', '5'),
(18, 'Centennial', '6'),
(19, 'Colorado Springs', '6'),
(20, 'Denver', '6'),
(21, 'Washington', '101'),
(22, 'Boca Raton', '9'),
(23, 'Coral Gables', '9'),
(24, 'Fort Lauderdale', '9'),
(25, 'Gainesville', '9'),
(26, 'Jacksonville', '9'),
(27, 'Miami', '9'),
(28, 'Atlanta', '10'),
(29, 'Antioch', '13'),
(30, 'Chicago', '13'),
(31, 'Kildeer', '13'),
(32, 'North Chicago', '13'),
(33, 'Northbrook', '13'),
(34, 'Oak Brook', '13'),
(35, 'Indianapolis', '14'),
(36, 'West Des Moines', '15'),
(37, 'Metairie', '18'),
(38, 'New Orleans', '18'),
(39, 'Columbia', '20'),
(40, 'Auburn Hills', '22'),
(41, 'Dearborn', '22'),
(42, 'Detroit', '22'),
(43, 'Troy', '22'),
(44, 'Eden Prairie', '23'),
(45, 'Golden Valley', '23'),
(46, 'Lakeville', '23'),
(47, 'Minneapolis', '23'),
(48, 'Minnetonka', '23'),
(49, 'Saint Paul', '23'),
(50, 'Richfield', '23'),
(51, 'Clayton', '25'),
(52, 'Kansas City', '25'),
(53, 'St. Louis', '25'),
(54, 'Omaha', '27'),
(55, 'Albany', '32'),
(56, 'Buffalo', '32'),
(57, 'New York', '32'),
(58, 'Rockville Centre', '32'),
(59, 'Syosset', '32'),
(60, 'Charlotte', '33'),
(61, 'Durham', '33'),
(62, 'Cleveland', '35'),
(63, 'Columbus', '35'),
(64, 'Toledo', '35'),
(65, 'Portland', '37'),
(66, 'Conshohocken', '38'),
(67, 'Media', '38'),
(68, 'North Wales', '38'),
(69, 'Philadelphia', '38'),
(70, 'Columbia', '40'),
(71, 'Dallas', '43'),
(72, 'El Paso', '43'),
(73, 'Houston', '43'),
(74, 'McAllen', '43'),
(75, 'San Antonio', '43'),
(76, 'Spring', '43'),
(77, 'Colorado Springs', '45'),
(78, 'Alexandria', '96'),
(79, 'Arlington', '96'),
(80, 'Falls Church', '96'),
(81, 'McLean', '96'),
(82, 'Madison', '99'),
(83, 'Milwaukee', '99')

-- --------------------------------------------------------

--
-- Table structure for table `ci_cookies`
--

CREATE TABLE IF NOT EXISTS `ci_cookies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cookie_id` varchar(255) DEFAULT NULL,
  `netid` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `orig_page_requested` varchar(120) DEFAULT NULL,
  `php_session_id` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('0335f0dbd64cda1ae615a566ba50f615', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0', 1403169260, 'a:6:{s:9:"user_name";s:8:"rajarshi";s:12:"is_logged_in";b:1;s:20:"manufacture_selected";N;s:22:"search_string_selected";N;s:5:"order";N;s:10:"order_type";N;}');

-- --------------------------------------------------------

--
-- Table structure for table `federal_courts`
--

CREATE TABLE IF NOT EXISTS `federal_courts` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FieldValue` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=200 ;

--
-- Dumping data for table `federal_courts`
--

INSERT INTO `federal_courts` (`Id`, `FieldValue`) VALUES
(1, 'Alabama Middle District Bankruptcy Court'),
(2, 'Alabama Northern District Bankruptcy Court'),
(3, 'Alabama Southern District Bankruptcy Court'),
(4, 'Alaska Bankruptcy Court'),
(5, 'Arizona Bankruptcy Court'),
(6, 'Arkansas Eastern District Bankruptcy Court'),
(7, 'Arkansas Western District Bankruptcy Court'),
(8, 'California Central District Bankruptcy Court'),
(9, 'California Eastern District Bankruptcy Court'),
(10, 'California Northern District Bankruptcy Court'),
(11, 'California Southern District Bankruptcy Court'),
(12, 'Colorado Bankruptcy Court'),
(13, 'Connecticut Bankruptcy Court'),
(14, 'Delaware Bankruptcy Court'),
(15, 'District of Columbia Bankruptcy Court'),
(16, 'Georgia Middle District Bankruptcy Court'),
(17, 'Georgia Northern District Bankruptcy Court'),
(18, 'Georgia Southern District Bankruptcy Court'),
(19, 'Hawaii Bankruptcy Court'),
(20, 'Idaho Bankruptcy Court'),
(21, 'Illinois Central District Bankruptcy Court'),
(22, 'Illinois Northern District Bankruptcy Court'),
(23, 'Illinois Southern District Bankruptcy Court'),
(24, 'Indiana Northern District Bankruptcy Court'),
(25, 'Indiana Southern District Bankruptcy Court'),
(26, 'Iowa Northern District Bankruptcy Court'),
(27, 'Iowa Southern District Bankruptcy Court'),
(28, 'Kansas Bankruptcy Court'),
(29, 'Kentucky Eastern District Bankruptcy Court'),
(30, 'Kentucky Western District Bankruptcy Court'),
(31, 'Louisiana Eastern District Bankruptcy Court'),
(32, 'Louisiana Middle District Bankruptcy Court'),
(33, 'Louisiana Western District Bankruptcy Court'),
(34, 'Maine Bankruptcy Court'),
(35, 'Maryland Bankruptcy Court'),
(36, 'Massachusetts Bankruptcy Court'),
(37, 'Michigan Eastern District Bankruptcy Court'),
(38, 'Michigan Western District Bankruptcy Court'),
(39, 'Minnesota Bankruptcy Court'),
(40, 'Mississippi Northern District Bankruptcy Court'),
(41, 'Mississippi Southern District Bankruptcy Court'),
(42, 'Montana Bankruptcy Court'),
(43, 'Nebraska Bankruptcy Court'),
(44, 'New Hampshire Bankruptcy Court'),
(45, 'New Jersey Bankruptcy Court'),
(46, 'New Mexico Bankruptcy Court'),
(47, 'New York Eastern District Bankruptcy Court'),
(48, 'New York Northern District Bankruptcy Court'),
(49, 'New York Southern District Bankruptcy Court'),
(50, 'New York Western District Bankruptcy Court'),
(51, 'Nevada Bankruptcy Court'),
(52, 'North Carolina Eastern District Bankruptcy Court'),
(53, 'North Carolina Middle District Bankruptcy Court'),
(54, 'North Carolina Western District Bankruptcy Court'),
(55, 'North Dakota Bankruptcy Court'),
(56, 'Ohio Northern District Bankruptcy Court'),
(57, 'Ohio Southern District Bankruptcy Court'),
(58, 'Oklahoma Eastern District Bankruptcy Court'),
(59, 'Oklahoma Northern District Bankruptcy Court'),
(60, 'Oklahoma Western District Bankruptcy Court'),
(61, 'Oregon Bankruptcy Court'),
(62, 'Pennsylvania Eastern District Bankruptcy Court'),
(63, 'Pennsylvania Middle District Bankruptcy Court'),
(64, 'Pennsylvania Western District Bankruptcy Court'),
(65, 'Puerto Rico Bankruptcy Court'),
(66, 'Rhode Island Bankruptcy Court'),
(67, 'South Carolina Bankruptcy Court'),
(68, 'South Dakota Bankruptcy Court'),
(69, 'Tennessee Eastern District Bankruptcy Court'),
(70, 'Tennessee Middle District Bankruptcy Court'),
(71, 'Tennessee Western District Bankruptcy Court'),
(72, 'Texas Eastern District Bankruptcy Court'),
(73, 'Texas Northern District Bankruptcy Court'),
(74, 'Texas Southern District Bankruptcy Court'),
(75, 'Texas Western District Bankruptcy Court'),
(76, 'Utah Bankruptcy Court'),
(77, 'Vermont Bankruptcy Court'),
(78, 'Virginia Eastern District Bankruptcy Court'),
(79, 'Virginia Western District Bankruptcy Court'),
(80, 'Washington Eastern District Bankruptcy Court'),
(81, 'Washington Western District Bankruptcy Court'),
(82, 'West Virginia Northern District Court'),
(83, 'West Virginia Southern District Court'),
(84, 'Wisconsin Eastern District Bankruptcy Court'),
(85, 'Wisconsin Western District Bankruptcy Court'),
(86, 'Wyoming Bankruptcy Court'),
(87, 'U.S. Court of Appeals for the First Circuit'),
(88, 'U.S. Court of Appeals for the Second Circuit'),
(89, 'U.S. Court of Appeals for the Third Circuit'),
(90, 'U.S. Court of Appeals for the Fourth Circuit'),
(91, 'U.S. Court of Appeals for the Fifth Circuit'),
(92, 'U.S. Court of Appeals for the Sixth Circuit'),
(93, 'U.S. Court of Appeals for the Seventh Circuit'),
(94, 'U.S. Court of Appeals for the Eighth Circuit'),
(95, 'U.S. Court of Appeals for the Ninth Circuit'),
(96, 'U.S. Court of Appeals for the Tenth Circuit'),
(97, 'U.S. Court of Appeals for the Eleventh Circuit'),
(98, 'U.S. Court of Appeals for the District of Columbia'),
(99, 'U.S. Court of Appeals for the Federal Circuit'),
(100, 'U.S. District Court, Middle District of Florida'),
(101, 'U.S. District Court, Northern District of Florida'),
(102, 'U.S. District Court, Southern District of Florida'),
(103, 'U.S. District Court, District of Alaska'),
(104, 'U.S. District Court, District of Arizona'),
(105, 'U.S. District Court, District of Colorado'),
(106, 'U.S. District Court, District of Columbia'),
(107, 'U.S. District Court, District of Connecticut'),
(108, 'U.S. District Court, District of Delaware'),
(109, 'U.S. District Court, District of Guam'),
(110, 'U.S. District Court, District of Hawaii'),
(111, 'U.S. District Court, District of Idaho'),
(112, 'U.S. District Court, District of Kansas'),
(113, 'U.S. District Court, District of Maine'),
(114, 'U.S. District Court, District of Maryland'),
(115, 'U.S. District Court, District of Massachusetts'),
(116, 'U.S. District Court, District of Minnesota'),
(117, 'U.S. District Court, District of Montana'),
(118, 'U.S. District Court, District of Nebraska'),
(119, 'U.S. District Court, District of Nevada'),
(120, 'U.S. District Court, District of New Hampshire'),
(121, 'U.S. District Court, District of New Jersey'),
(122, 'U.S. District Court, District of New Mexico'),
(123, 'U.S. District Court, District of North Dakota'),
(124, 'U.S. District Court, District of the Northern Mariana Islands'),
(125, 'U.S. District Court, District of Oregon'),
(126, 'U.S. District Court, District of Puerto Rico'),
(127, 'U.S. District Court, District of Rhode Island'),
(128, 'U.S. District Court, District of South Carolina'),
(129, 'U.S. District Court, District of South Dakota'),
(130, 'U.S. District Court, District of Utah'),
(131, 'U.S. District Court, District of Vermont'),
(132, 'U.S. District Court, District of the Virgin Islands'),
(133, 'U.S. District Court, District of Wyoming'),
(134, 'U.S. District Court, Middle District of Alabama'),
(135, 'U.S. District Court, Northern District of Alabama'),
(136, 'U.S. District Court, Southern District of Alabama'),
(137, 'U.S. District Court, Eastern District of Arkansas'),
(138, 'U.S. District Court, Western District of Arkansas'),
(139, 'U.S. District Court, Central District of California'),
(140, 'U.S. District Court, Eastern District of California'),
(141, 'U.S. District Court, Northern District of California'),
(142, 'U.S. District Court, Southern District of California'),
(143, 'U.S. District Court, Middle District of Georgia'),
(144, 'U.S. District Court, Northern District of Georgia'),
(145, 'U.S. District Court, Southern District of Georgia'),
(146, 'U.S. District Court, Central District of Illinois'),
(147, 'U.S. District Court, Northern District of Illinois'),
(148, 'U.S. District Court, Southern District of Illinois'),
(149, 'U.S. District Court, Northern District of Indiana'),
(150, 'U.S. District Court, Southern District of Indiana'),
(151, 'U.S. District Court, Northern District of Iowa'),
(152, 'U.S. District Court, Southern District of Iowa'),
(153, 'U.S. District Court, Eastern District of Kentucky'),
(154, 'U.S. District Court, Western District of Kentucky'),
(155, 'U.S. District Court, Eastern District of Louisiana'),
(156, 'U.S. District Court, Middle District of Louisiana'),
(157, 'U.S. District Court, Western District of Louisiana'),
(158, 'U.S. District Court, Eastern District of Michigan'),
(159, 'U.S. District Court, Western District of Michigan'),
(160, 'U.S. District Court, Eastern District of Missouri'),
(161, 'U.S. District Court, Western District of Missouri'),
(162, 'U.S. District Court, Northern District of Mississippi'),
(163, 'U.S. District Court, Southern District of Mississippi'),
(164, 'U.S. District Court, Eastern District of NewYork'),
(165, 'U.S. District Court, Northern District of NewYork'),
(166, 'U.S. District Court, Southern District of NewYork'),
(167, 'U.S. District Court, Western District of NewYork'),
(168, 'U.S. District Court, Eastern District of North Carolina'),
(169, 'U.S. District Court, Middle District of North Carolina'),
(170, 'U.S. District Court, Western District of North Carolina'),
(171, 'U.S. District Court, Northern District of Ohio'),
(172, 'U.S. District Court, Southern District of Ohio'),
(173, 'U.S. District Court, Eastern District of Oklahoma'),
(174, 'U.S. District Court, Northern District of Oklahoma'),
(175, 'U.S. District Court, Western District of Oklahoma'),
(176, 'U.S. District Court, Eastern District of Pennsylvania'),
(177, 'U.S. District Court, Middle District of Pennsylvania'),
(178, 'U.S. District Court, Western District of Pennsylvania'),
(179, 'U.S. District Court, Eastern District of Tennessee'),
(180, 'U.S. District Court, Middle District of Tennessee'),
(181, 'U.S. District Court, Western District of Tennessee'),
(182, 'U.S. District Court, Eastern District of Texas'),
(183, 'U.S. District Court, Northern District of Texas'),
(184, 'U.S. District Court, Southern District of Texas'),
(185, 'U.S. District Court, Western District of Texas'),
(186, 'U.S. District Court, Eastern District of Virginia'),
(187, 'U.S. District Court, Western District of Virginia'),
(188, 'U.S. District Court, Eastern District of Washington'),
(189, 'U.S. District Court, Western District of Washington'),
(190, 'U.S. District Court, Northern District of West Virginia'),
(191, 'U.S. District Court, Southern District of West Virginia'),
(192, 'U.S. District Court, Eastern District of Wisconsin'),
(193, 'U.S. District Court, Western District of Wisconsin'),
(194, 'U.S. Supreme Court'),
(195, 'U.S. Tax Court'),
(196, 'U.S. Court of Federal Claims'),
(197, 'U.S. Court of International Trade'),
(198, 'U.S. Court of Appeals for Veteran Claims'),
(199, 'U.S. Court of Appeals for the Armed Forces');

-- --------------------------------------------------------

--
-- Table structure for table `firm_size`
--

CREATE TABLE IF NOT EXISTS `firm_size` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FieldValue` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `firm_size`
--

INSERT INTO `firm_size` (`Id`, `FieldValue`) VALUES
(1, '1-5'),
(2, '6-10'),
(3, '11-20'),
(4, '20-50'),
(5, '>50');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE IF NOT EXISTS `manufacturers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mbe_wbe`
--

CREATE TABLE IF NOT EXISTS `mbe_wbe` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FieldValue` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mbe_wbe`
--

INSERT INTO `mbe_wbe` (`Id`, `FieldValue`) VALUES
(1, 'MBE'),
(2, 'WBE'),
(3, 'MBE & WBE');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE IF NOT EXISTS `membership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email_addres` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `pass_word` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`id`, `first_name`, `last_name`, `email_addres`, `user_name`, `pass_word`) VALUES
(1, 'Rajarshi', 'Roy', 'roy23198702@gmail.com', 'rajarshi', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `membership_info`
--

CREATE TABLE IF NOT EXISTS `membership_info` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ConstituentId` varchar(255) NOT NULL,
  `UserId` varchar(255) NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `LastModified` date NOT NULL,
  `MemberShip` varchar(255) NOT NULL,
  `MemberType` varchar(255) NOT NULL,
  `PrimaryGroup` varchar(255) NOT NULL,
  `GameLevel` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `practice_area`
--

CREATE TABLE IF NOT EXISTS `practice_area` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FieldValue` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `practice_area`
--

INSERT INTO `practice_area` (`Id`, `FieldValue`) VALUES
(1, 'Administrative Law'),
(2, 'Admiralty and Maritime Law'),
(3, 'Adoption'),
(4, 'Advertising and Marketing'),
(5, 'Agency and Distributorships'),
(6, 'Alcohol'),
(7, 'Alternative dispute resolution'),
(8, 'Animal'),
(9, 'Antitrust'),
(10, 'Appellate practice'),
(11, 'Art'),
(12, 'Aviation'),
(13, 'Banking'),
(14, 'Bankruptcy'),
(15, 'Bioethics'),
(16, 'Bird'),
(17, 'Business'),
(18, 'Business Organizations'),
(19, 'City, County & Local Government'),
(20, 'Civil Trial'),
(21, 'ClassAction Litigation'),
(22, 'Communications'),
(23, 'Computer'),
(24, 'Conflict of Law'),
(25, 'Constitutional'),
(26, 'Construction'),
(27, 'Consumer'),
(28, 'Contract'),
(29, 'Copyright'),
(30, 'Corporate'),
(31, 'Criminal'),
(32, 'Cryptography'),
(33, 'Cultural Property'),
(34, 'Custom'),
(35, 'Cyber'),
(36, 'Defamation'),
(37, 'Derivatives and Futures'),
(38, 'Drug Control'),
(39, 'Education'),
(40, 'Elder'),
(41, 'Employee Benefits(ERISA)'),
(42, 'Employment'),
(43, 'Energy'),
(44, 'Entertainment'),
(45, 'Environmental'),
(46, 'Equipment Finance'),
(47, 'Evidence'),
(48, 'Family'),
(49, 'FDA'),
(50, 'Financial Services Regulation'),
(51, 'Firearm'),
(52, 'Food'),
(53, 'Franchise'),
(54, 'Gaming'),
(55, 'Health'),
(56, 'Health and Safety'),
(57, 'Healthcare'),
(58, 'Immigration'),
(59, 'Insurance'),
(60, 'Intellectual Property'),
(61, 'International'),
(62, 'International Trade and Finance'),
(63, 'Internet'),
(64, 'Labor'),
(65, 'Land use & Zoning'),
(66, 'Litigation'),
(67, 'Martial'),
(68, 'Media'),
(69, 'Mergers & Acquisitions'),
(70, 'Military'),
(71, 'Mining'),
(72, 'Juvenile'),
(73, 'Music'),
(74, 'Mutual Funds'),
(75, 'Nationality'),
(76, 'Native American'),
(77, 'Obscenity'),
(78, 'Oil & Gas'),
(79, 'Parliamentary'),
(80, 'Patent'),
(81, 'Poverty'),
(82, 'Privacy'),
(83, 'Private Equity'),
(84, 'Private Funds'),
(85, 'Procedural'),
(86, 'Product Liability Litigation'),
(87, 'Property'),
(88, 'Public Health'),
(89, 'Railroad'),
(90, 'Real Estate'),
(91, 'Securities'),
(92, 'Social Security Disability'),
(93, 'Space'),
(94, 'Sports'),
(95, 'State and Federal Government'),
(96, 'Statutory'),
(97, 'Tax'),
(98, 'Technology'),
(99, 'Timber'),
(100, 'Tort'),
(101, 'Trademark'),
(102, 'Transportation'),
(103, 'Trusts & Estates'),
(104, 'Utilities Regulation'),
(105, 'Venture Capital'),
(106, 'Water'),
(107, 'Worker’s Compensation');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(40) DEFAULT NULL,
  `stock` double DEFAULT NULL,
  `cost_price` double DEFAULT NULL,
  `sell_price` double DEFAULT NULL,
  `manufacture_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `search`
--

CREATE TABLE IF NOT EXISTS `search` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FieldId` varchar(255) NOT NULL,
  `FieldName` varchar(255) NOT NULL,
  `FieldLabel` varchar(255) NOT NULL,
  `FieldType` varchar(255) NOT NULL,
  `MasterTableName` varchar(255) NOT NULL,
  `FieldEvent` varchar(255) NOT NULL,
  `ConnectingMasterTable` varchar(255) NOT NULL,
  `ConnectingTableForeignkeyName` varchar(255) NOT NULL,
  `Status` enum('A','D') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `search`
--

INSERT INTO `search` (`Id`, `FieldId`, `FieldName`, `FieldLabel`, `FieldType`, `MasterTableName`, `FieldEvent`, `ConnectingMasterTable`, `ConnectingTableForeignkeyName`, `Status`) VALUES
(1, 'Sub_Practice_Areas', 'Sub_Practice_Areas', 'Sub Practice Areas', 'Multi-Dropdown', 'sub_practice_areas', 'DeActive', '', '', 'D'),
(2, 'City', 'City', 'City', 'Multi-Dropdown', 'city', 'DeActive', '', '', 'D'),
(3, 'Firm_Name', 'Firm_Name', 'Firm Name', 'Text', '', 'DeActive', '', '', 'A'),
(4, 'State', 'State', 'State', 'Multi-Dropdown', 'state', 'Active', 'city', 'StateId', 'A'),
(5, 'Practice_Area', 'Practice_Area', 'Practice Area', 'Dropdown', 'practice_area', 'Active', 'sub_practice_areas', 'PracticeAreaId', 'A'),
(6, 'Mbe_Wbe', 'Mbe_Wbe', 'MBE WBE', 'Dropdown', 'mbe_wbe', 'DeActive', '', '', 'A'),
(7, 'Firm_Size', 'Firm_Size', 'Firm Size', 'Dropdown', 'firm_size', 'DeActive', '', '', 'A'),
(8, 'Attorneys', 'Attorneys', 'Average Attorney Experience', 'Dropdown', 'attorneys', 'DeActive', '', '', 'A'),
(9, 'Representative_Transactions', 'Representative_Transactions', 'Representative Transactions', 'Text', '', 'DeActive', '', '', 'A'),
(10, 'Representative_Cases', 'Representative_Cases', 'Representative Cases', 'Text', '', 'DeActive', '', '', 'A'),
(11, 'Specific_Areas_of_Law', 'Specific_Areas_of_Law', 'Specific Areas of Law', 'Multi-Dropdown', 'specific_areas_of_law', 'DeActive', '', '', 'A'),
(12, 'Specific_Languages', 'Specific_Languages', 'Specific Languages', 'Multi-Dropdown', 'specific_languages', 'DeActive', '', '', 'A'),
(13, 'State_Courts', 'State_Courts', 'State Courts', 'Multi-Dropdown', 'state_courts', 'DeActive', '', '', 'A'),
(15, 'Federal_Courts', 'Federal_Courts', 'Federal Courts', 'Multi-Dropdown', 'federal_courts', 'DeActive', '', '', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `specific_areas_of_law`
--

CREATE TABLE IF NOT EXISTS `specific_areas_of_law` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FieldValue` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `specific_areas_of_law`
--

INSERT INTO `specific_areas_of_law` (`Id`, `FieldValue`) VALUES
(1, 'Admiralty & Maritime Law'),
(2, 'Adoption Law'),
(3, 'Antitrust & Trade Regulation Law'),
(4, 'Appellate Practice'),
(5, 'Aviation Law'),
(6, 'Business Litigation'),
(7, 'City, County & Local Government Law'),
(8, 'Civil Trial'),
(9, 'Construction Law'),
(10, 'Criminal Appellate'),
(11, 'Criminal Trial'),
(12, 'Education Law'),
(13, 'Elder Law'),
(14, 'Health Law'),
(15, 'Immigration & Nationality'),
(16, 'Intellectual Property Law'),
(17, 'International Law'),
(18, 'Labor & Employment Law'),
(19, 'Marital & Family Law'),
(20, 'Real Estate'),
(21, 'State and Federal Government and Administrative'),
(22, 'Practice'),
(23, 'Tax Law'),
(24, 'Wills, Trusts & Estates'),
(25, 'Workers Compensation');

-- --------------------------------------------------------

--
-- Table structure for table `specific_languages`
--

CREATE TABLE IF NOT EXISTS `specific_languages` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FieldValue` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `specific_languages`
--

INSERT INTO `specific_languages` (`Id`, `FieldValue`) VALUES
(1, 'Albanian'),
(2, 'American Sign'),
(3, 'Language'),
(4, 'Arabic'),
(5, 'Armenian'),
(6, 'Bosnian'),
(7, 'Bulgarian'),
(8, 'Chinese'),
(9, 'Croatian'),
(10, 'Czech'),
(11, 'Danish'),
(12, 'Dutch'),
(13, 'English'),
(14, 'Farsi'),
(15, 'Finnish'),
(16, 'French'),
(17, 'German'),
(18, 'Greek'),
(19, 'Gujarati'),
(20, 'Haitian Creole'),
(21, 'Hebrew'),
(22, 'Hindi'),
(23, 'Hungarian'),
(24, 'Indonesian'),
(25, 'Italian'),
(26, 'Japanese'),
(27, 'Korean'),
(28, 'Lithuanian'),
(29, 'Norwegian'),
(30, 'Other'),
(31, 'Polish'),
(32, 'Portuguese'),
(33, 'Quechua'),
(34, 'Romanian'),
(35, 'Russian'),
(36, 'Serbian'),
(37, 'Slovak'),
(38, 'Spanish'),
(39, 'Swedish'),
(40, 'Swiss German'),
(41, 'Taiwanese'),
(42, 'Tamil'),
(43, 'Turkish'),
(44, 'Ukrainian'),
(45, 'Urdu'),
(46, 'Vietnamese');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FieldValue` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`Id`, `FieldValue`) VALUES
(1, 'Alabama'),
(2, 'Alaska'),
(3, 'Arizona'),
(4, 'Arkansas'),
(5, 'California'),
(6, 'Colorado'),
(7, 'Connecticut'),
(8, 'Delaware'),
(9, 'Florida'),
(10, 'Georgia'),
(11, 'Hawaii'),
(12, 'Idaho'),
(13, 'Illinois'),
(14, 'Indiana'),
(15, 'Iowa'),
(16, 'Kansas'),
(17, 'Kentucky'),
(18, 'Louisiana'),
(19, 'Maine'),
(20, 'Maryland'),
(21, 'Massachusetts'),
(22, 'Michigan'),
(23, 'Minnesota'),
(24, 'Mississippi'),
(25, 'Missouri'),
(26, 'Montana'),
(27, 'Nebraska'),
(28, 'Nevada'),
(29, 'NewHampshire'),
(30, 'NewJersey'),
(31, 'NewMexico'),
(32, 'NewYork'),
(33, 'North Carolina'),
(34, 'North Dakota'),
(35, 'Ohio'),
(36, 'Oklahoma'),
(37, 'Oregon'),
(38, 'Pennsylvania'),
(39, 'Rhode Island'),
(40, 'South Carolina'),
(41, 'South Dakota'),
(42, 'Tennessee'),
(43, 'Texas'),
(44, 'Utah'),
(45, 'Vermont'),
(46, 'Virginia'),
(47, 'Washington'),
(48, 'West Virginia'),
(49, 'Wisconsin'),
(50, 'Wyoming');

-- --------------------------------------------------------

--
-- Table structure for table `state_courts`
--

CREATE TABLE IF NOT EXISTS `state_courts` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FieldValue` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `state_courts`
--

INSERT INTO `state_courts` (`Id`, `FieldValue`) VALUES
(1, 'Alabama'),
(2, 'Alaska'),
(3, 'Arizona'),
(4, 'Arkansas'),
(5, 'California'),
(6, 'Colorado'),
(7, 'Connecticut'),
(8, 'Delaware'),
(9, 'Florida'),
(10, 'Georgia'),
(11, 'Hawaii'),
(12, 'Idaho'),
(13, 'Illinois'),
(14, 'Indiana'),
(15, 'Iowa'),
(16, 'Kansas'),
(17, 'Kentucky'),
(18, 'Louisiana'),
(19, 'Maine'),
(20, 'Maryland'),
(21, 'Massachusetts'),
(22, 'Michigan'),
(23, 'Minnesota'),
(24, 'Mississippi'),
(25, 'Missouri'),
(26, 'Montana'),
(27, 'Nebraska'),
(28, 'Nevada'),
(29, 'NewHampshire'),
(30, 'NewJersey'),
(31, 'NewMexico'),
(32, 'NewYork'),
(33, 'North Carolina'),
(34, 'North Dakota'),
(35, 'Ohio'),
(36, 'Oklahoma'),
(37, 'Oregon'),
(38, 'Pennsylvania'),
(39, 'Rhode Island'),
(40, 'South Carolina'),
(41, 'South Dakota'),
(42, 'Tennessee'),
(43, 'Texas'),
(44, 'Utah'),
(45, 'Vermont'),
(46, 'Virginia'),
(47, 'Washington'),
(48, 'West Virginia'),
(49, 'Wisconsin'),
(50, 'Wyoming');

-- --------------------------------------------------------

--
-- Table structure for table `sub_practice_areas`
--

CREATE TABLE IF NOT EXISTS `sub_practice_areas` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FieldValue` varchar(255) NOT NULL,
  `PracticeAreaId` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=175 ;

--
-- Dumping data for table `sub_practice_areas`
--

INSERT INTO `sub_practice_areas` (`Id`, `FieldValue`, `PracticeAreaId`) VALUES
(1, 'Banking Regulatory & Compliance', '13'),
(2, 'Commercial Lending', '13'),
(3, 'Cross-Border Loan Transactions', '13'),
(4, 'Letters of Credit & Revolving Loans', '13'),
(5, 'Life Insurance Premium Finance', '13'),
(6, 'Mezzanine Loans & Subordinated Debt', '13'),
(7, 'Private Banking Transactions', '13'),
(8, 'Private Equity & Fund Transactions', '13'),
(9, 'Real Estate Financing', '13'),
(10, 'Swaps and Other Hedge Transactions', '13'),
(11, 'Syndicated Credit Facilities, Club Deals & Syndicated Reviews', '13'),
(12, 'Treasury Management/Deposit Account Control Agreements', '13'),
(13, 'Workouts and Restructurings', '13'),
(14, 'General Business Counseling', '17'),
(15, 'Architectural and Design Professional Agreements', '26'),
(16, 'Construction Contracts', '26'),
(17, 'Consulting Agreements', '26'),
(18, 'Equipment Procurement', '26'),
(19, 'Mechanics and Materials Lien Law', '26'),
(20, 'Contracting', '28'),
(21, 'Corporate Governance', '30'),
(22, 'Crisis Management', '30'),
(23, 'Internal Investigations', '30'),
(24, 'Logistics & Outsourcing', '30'),
(25, 'Nonprofit Formation & Governance', '30'),
(26, 'Records Retention', '30'),
(27, 'ERISA fiduciary matters', '41'),
(28, 'DOL investigations', '41'),
(29, 'Qualified retirement plans', '41'),
(30, 'Employee stock ownership plans', '41'),
(31, 'Group medical plans, health care reform', '41'),
(32, 'Code section 409A deferred compensation plans', '41'),
(33, 'Equity compensation plans for privately held and public companies', '41'),
(34, 'Oil & Gas', '43'),
(35, 'Renewal Energy Procurement', '43'),
(36, 'Environmental Transactions', '45'),
(37, 'Regulatory & Compliance', '45'),
(38, 'Healthcare Entity Regulatory & Compliance', '57'),
(39, 'Healthcare Entity Corporate Matters', '57'),
(40, 'EB5 Financing/Immigration', '58'),
(41, 'Immigration & Compliance', '58'),
(42, 'Agricultural', '59'),
(43, 'Auto', '59'),
(44, 'Bad Faith', '59'),
(45, 'Construction', '59'),
(46, 'Coverage', '59'),
(47, 'Directors and Officers', '59'),
(48, 'Directors and Officers', '59'),
(49, 'Employment Practices', '59'),
(50, 'Environmental and Toxic Tort', '59'),
(51, 'ERISA', '59'),
(52, 'Errors and Omissions', '59'),
(53, 'Errors and Omissions', '59'),
(54, 'Extra Contractual Liability', '59'),
(55, 'Farm Owners', '59'),
(56, 'General Liability', '59'),
(57, 'General Liability', '59'),
(58, 'Governmental Entity', '59'),
(59, 'Homeowners', '59'),
(60, 'Inland Marine', '59'),
(61, 'Life, Health and Disability', '59'),
(62, 'Medical Malpractice', '59'),
(63, 'Ocean Marine', '59'),
(64, 'Premises', '59'),
(65, 'Product Liability', '59'),
(66, 'Professional Liability', '59'),
(67, 'Professional Liability', '59'),
(68, 'Property', '59'),
(69, 'Recovery', '59'),
(70, 'Regulatory', '59'),
(71, 'Third Party', '59'),
(72, 'Transportation', '59'),
(73, 'Umbrella', '59'),
(74, 'Worker’s Compensation', '59'),
(75, 'Arson and Fraud', '60'),
(76, 'IP Agreements', '60'),
(77, 'Commercial Contracts', '60'),
(78, 'Commercial Leases', '60'),
(79, 'Licensing', '60'),
(80, 'Software Distribution Agreements', '60'),
(81, 'Other Transactions', '60'),
(82, 'Cross-Border Acquisitions & Sales', '61'),
(83, 'Cross-Border Lending', '61'),
(84, 'Off Shore Business Entities', '61'),
(85, 'ADA (litigation)', '64'),
(86, 'ADA (compliance)', '64'),
(87, 'Advising on Employee Matters', '64'),
(88, 'Agency Investigations', '64'),
(89, 'Arbitration', '64'),
(90, 'Class Actions', '64'),
(91, 'Counseling', '64'),
(92, 'Davis-Bacon Act (compliance)', '64'),
(93, 'Davis-Bacon Act (litigation)', '64'),
(94, 'DOL Audits', '64'),
(95, 'Drafting Employee Handbooks / Policies / Documents', '64'),
(96, 'Employee Benefits and Executive Compensation (non-litigation)', '64'),
(97, 'Employee Benefits and Executive Compensation (litigation)', '64'),
(98, 'ERISA (litigation)', '64'),
(99, 'ERISA (non-litigation)', '64'),
(100, 'ERISA (compliance)', '64'),
(101, 'FLSA (litigation)', '64'),
(102, 'FLSA (non-litigation)', '64'),
(103, 'FMLA (litigation)', '64'),
(104, 'FMLA (compliance)', '64'),
(105, 'Harassment / Discrimination / Retaliation', '64'),
(106, 'I-9 Compliance', '64'),
(107, 'Immigration', '64'),
(108, 'Internal Investigations', '64'),
(109, 'International Employment Law', '64'),
(110, 'Labor', '64'),
(111, 'Multidistrict Litigation', '64'),
(112, 'NLRB', '64'),
(113, 'OFCCP', '64'),
(114, 'OSHA (litigation)', '64'),
(115, 'OSHA (compliance)', '64'),
(116, 'OWBPA', '64'),
(117, 'Sarbanes-Oxley', '64'),
(118, 'Service Contract Act', '64'),
(119, 'Title VII', '64'),
(120, 'Trade Secret', '64'),
(121, 'Training', '64'),
(122, 'Union Campaigns', '64'),
(123, 'Union Negotiations', '64'),
(124, 'Wage & Hour (litigation)', '64'),
(125, 'Wage & Hour (compliance)', '64'),
(126, 'Walsh-Healy Act', '64'),
(127, 'Whistle Blowing', '64'),
(128, 'Asset/Stock Purchases', '69'),
(129, 'Strategic Acquisitions & Divestitures', '69'),
(130, 'Joint Ventures/Strategic Alliances', '69'),
(131, 'Leveraged Buyouts', '69'),
(132, 'Recapitalizations & Restructures', '69'),
(133, 'Real Estate Purchases & Syndications', '69'),
(134, 'Software Licensing and Development', '79'),
(135, 'SaaS and Cloud Computing', '79'),
(136, 'Mobile Applications', '79'),
(137, 'Social Media and Internet Law', '79'),
(138, 'Acquisitions, Leasing & Dispositions', '90'),
(139, 'Development', '90'),
(140, 'Eminent Doman', '90'),
(141, 'Land Use Planning & Entitlements', '90'),
(142, 'Asset Securitizations', '91'),
(143, 'Black-Out Period Management', '91'),
(144, 'Conflict Of Interest Policies', '91'),
(145, 'Forms Form 10-K 10-Q And 8-K', '91'),
(146, 'Going Private; Other Tender Offers', '91'),
(147, 'Insider Trading Policies & Reporting', '91'),
(148, 'Nasdaq, Exchange Requirements & Reporting', '91'),
(149, 'NYSE, Exchange Requirements & Reporting', '91'),
(150, 'Private Placements: Equity, Debt, & Hybrid', '91'),
(151, 'Public Finance:  Offerings & Continuing Disclosure', '91'),
(152, 'Public Offerings: Initial & Secondary', '91'),
(153, 'PIPEs, Debt Exchanges, Other Hybrids', '91'),
(154, 'Proxy Statement & Annual Report', '91'),
(155, 'Regulation FD Policies & Compliance', '91'),
(156, 'Rule 144 Transactions', '91'),
(157, 'SEC Reporting & Compliance', '91'),
(158, 'Section 16 Reporting', '91'),
(159, 'Master Supply Agreement', '96'),
(160, 'Master Services Agreement', '96'),
(161, 'Equipment Procurement', '96'),
(162, 'Equipment Lease Agreements', '96'),
(163, 'General', '97'),
(164, 'Tax Credits', '97'),
(165, 'Tax Exemptions', '97'),
(166, 'Low Income Housing Tax Credits', '97'),
(167, 'New Market Tax Credits', '97'),
(168, 'Solar Tax Credits', '97'),
(169, 'Software Licensing and Development', '98'),
(170, 'SaaS and Cloud Computing', '98'),
(171, 'Mobile Applications', '98'),
(172, 'Social Media and Internet Law', '98'),
(173, 'Compliance', '107'),
(174, 'Regulatory Investigations', '107');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `NamePrifix` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `FirmSize` varchar(255) NOT NULL,
  `FirmName` varchar(255) NOT NULL,
  `EmailId` varchar(255) NOT NULL,
  `Employer` varchar(255) NOT NULL,
  `MemberTypeCode` varchar(255) NOT NULL,
  `PhaseAreaCode` varchar(255) NOT NULL,
  `ApprovalDate` text NOT NULL,
  `LastModifiedDate` varchar(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `PostalCode` varchar(255) NOT NULL,
  `WebsiteUrl` varchar(255) NOT NULL,
  `OrgName` varchar(255) NOT NULL,
  `country` varchar(100) NOT NULL,
  `StateId` varchar(255) NOT NULL,
  `State` varchar(255) NOT NULL,
  `CityId` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `PhoneNo` varchar(255) NOT NULL,
  `FaxNo` varchar(255) NOT NULL,
  `WebsiteId` varchar(255) NOT NULL,
  `RepresentativeTransactions` varchar(255) NOT NULL,
  `RepresentativeCases` varchar(255) NOT NULL,
  `MemberId` varchar(255) NOT NULL,
  `SubPracticeAreaId` varchar(255) NOT NULL,
  `PracticeAreaId` varchar(255) NOT NULL,
  `Attorneys` varchar(255) NOT NULL,
  `SpecificAreasofLawId` varchar(255) NOT NULL,
  `SpecificLanguagesId` varchar(255) NOT NULL,
  `FederalCourtsId` varchar(255) NOT NULL,
  `MbeWbeName` varchar(255) NOT NULL,
  `Flag` enum('A','D') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_federal_courts`
--

CREATE TABLE IF NOT EXISTS `user_federal_courts` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` varchar(255) NOT NULL,
  `FederalCourtsId` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_practice_area`
--

CREATE TABLE IF NOT EXISTS `user_practice_area` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` varchar(255) NOT NULL,
  `PracticeAreaId` varchar(255) NOT NULL,
  `SubPracticeAreaId` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_specific_areas_of_law`
--

CREATE TABLE IF NOT EXISTS `user_specific_areas_of_law` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` varchar(255) NOT NULL,
  `SpecificAreasofLawId` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_specific_languages`
--

CREATE TABLE IF NOT EXISTS `user_specific_languages` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` varchar(255) NOT NULL,
  `SpecificLanguagesId` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_state`
--

CREATE TABLE IF NOT EXISTS `user_state` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `StateId` varchar(255) DEFAULT NULL,
  `UserId` varchar(255) NOT NULL,
  `CityId` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_state_courts`
--

CREATE TABLE IF NOT EXISTS `user_state_courts` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` varchar(255) NOT NULL,
  `StateCourtsId` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
