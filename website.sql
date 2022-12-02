-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2017 at 06:50 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `image` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `title`, `description`, `image`) VALUES
(1, 'About Site ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum is simply dummy text of the printing and typesetting industry .\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum is simply dummy text of the printing and typesetting industry .', 'data/uploads/file_15140540199.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `accordion`
--

CREATE TABLE `accordion` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `link` longtext NOT NULL,
  `image` longtext NOT NULL,
  `activity` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accordion`
--

INSERT INTO `accordion` (`id`, `title`, `description`, `link`, `image`, `activity`) VALUES
(4, 'Third Accordion', 'Description', 'www.linkedin.com', 'data/uploads/file_15137974847.jpg', 1),
(8, 'bbbbbbbbbbb', 'fdsf', 'fdffdf-ssdassdad', 'data/uploads/file_151379749913.jpg', 1),
(9, 'sdaa', 'sas', 'sasas', 'data/uploads/file_151440209310.jpg', 0),
(10, 'sdaasas', 'sasas', 'sasas', 'data/uploads/file_15144021027.jpg', 0),
(11, 'bgbv', 'bvcbcb', 'bvcbb', 'data/uploads/file_151449180414.gif', 0),
(12, 'bgbv', 'bvcbcb', 'bvcbb', 'data/uploads/file_15144918067.gif', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `parent` int(50) NOT NULL,
  `image` longtext NOT NULL,
  `activity` tinyint(1) NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) NOT NULL DEFAULT '0',
  `allow_ads` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `parent`, `image`, `activity`, `allow_comment`, `allow_ads`) VALUES
(7, 'Electronic', 'This Is my item', 0, '', 0, 0, 0),
(8, 'Mobiles', 'This Is Mobiles', 7, '', 0, 0, 0),
(10, 'Books', 'This Is Books', 9, '', 1, 0, 0),
(13, 'pppppppppppp', 'kkkkkkkkkk', 0, 'data/uploads/file_15143196707.gif', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `image` longtext CHARACTER SET utf8 NOT NULL,
  `activity` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `image`, `activity`) VALUES
(3, '', 'data/uploads/file_14991853639.png', 0),
(4, '', 'data/uploads/file_149918534512.png', 0),
(5, '', 'data/uploads/file_149918532310.png', 0),
(6, '', 'data/uploads/file_149918530310.jpg', 0),
(7, 'wewewewe', 'data/uploads/file_149918529014.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `activity` tinyint(4) NOT NULL,
  `comment_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` longtext NOT NULL,
  `googlemap` longtext NOT NULL,
  `image` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `email`, `phone`, `address`, `googlemap`, `image`) VALUES
(1, 'm.yousef_82@outlook.com', '002 010 23 80 2442', 'Egypt - AlGharbia City - Tanta Town', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d13710.146276141875!2d30.9949921!3d30.7875838!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2seg!4v1514051084049\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', 'data/uploads/file_151404310312.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `count` int(11) NOT NULL,
  `image` longtext NOT NULL,
  `activity` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`id`, `title`, `count`, `image`, `activity`) VALUES
(2, 'Employees', 100, 'data/uploads/file_149882991914.png', 0),
(3, 'Clients', 150, 'data/uploads/file_149884197415.png', 0),
(4, 'Branchs', 10, 'data/uploads/file_149884200813.png', 0),
(5, 'Projects', 200, 'data/uploads/file_149884203710.png', 0),
(6, 'Products', 999999, 'data/uploads/file_14988424109.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `activity` tinyint(4) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `date`, `image`, `activity`, `cat_id`, `user_id`) VALUES
(132, 'third item', 'Description About This Item', '45', '2017-05-31', 'data/uploads/file_149618802610.jpg', 1, 10, 1),
(133, 'fourh item', 'Description About This Product', '33', '2017-05-31', 'data/uploads/file_149618807513.jpg', 1, 10, 1),
(134, 'five items', 'This Is Item Number One', '33', '2017-05-31', 'data/uploads/file_149618812413.jpg', 1, 10, 1),
(135, 'mmmmmmmmmm', 'oooooooooo', '50', '2017-06-28', 'data/uploads/file_151458096213.jpg', 1, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `id` int(11) NOT NULL,
  `image` longtext NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`id`, `image`, `name`) VALUES
(1, 'data/uploads/file_151409494110.png', 'Company Name');

-- --------------------------------------------------------

--
-- Table structure for table `prograss`
--

CREATE TABLE `prograss` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `count` int(11) NOT NULL,
  `activity` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prograss`
--

INSERT INTO `prograss` (`id`, `name`, `count`, `activity`) VALUES
(2, 'Web Design', 95, 0),
(3, 'Programing', 70, 0),
(4, 'Marketing', 80, 0),
(5, 'Cources', 89, 0);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `product_number` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `distance` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `name`, `mobile`, `email`, `company`, `product_number`, `description`, `distance`, `country`) VALUES
(2, 'Mohamed Yousef', '0100555445556', 'm.yousef_82@yahoo.com', 'My Company', '434344', 'Description About My Request', '23', 'Egypt'),
(3, 'Mohamed Yousef', '068767', 'm.yousef0082@gmail.com', 'My Company', '5466', '656465465666', '23', 'Egypt');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `image` longtext NOT NULL,
  `activity` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`id`, `title`, `description`, `image`, `activity`) VALUES
(3, 'This Slide One', 'This Description About Slide One', 'data/uploads/file_14973595999.jpg', 0),
(4, 'Slide Two', 'Description Two', 'data/uploads/file_149735958214.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `socialmedia`
--

CREATE TABLE `socialmedia` (
  `id` int(11) NOT NULL,
  `link` longtext NOT NULL,
  `icon` longtext NOT NULL,
  `activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `socialmedia`
--

INSERT INTO `socialmedia` (`id`, `link`, `icon`, `activity`) VALUES
(8, 'youtube.com', 'fa fa-youtube', 0),
(10, 'http://www.google.com', 'fa fa-google-plus', 0),
(12, 'linkedin46', 'fa fa-linkedin', 0),
(13, 'twitter.com', 'fa fa-twitter', 0),
(14, 'facebook.com', 'fa fa-facebook', 1),
(15, 'http://www.ff.com', 'fa fa-linkedin-square', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tabs`
--

CREATE TABLE `tabs` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `activity` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabs`
--

INSERT INTO `tabs` (`id`, `title`, `activity`) VALUES
(2, 'Clothes', 0),
(3, 'Shirts', 0),
(4, 'Shoes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tabsitems`
--

CREATE TABLE `tabsitems` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `image` longtext NOT NULL,
  `tab_id` int(50) NOT NULL,
  `activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabsitems`
--

INSERT INTO `tabsitems` (`id`, `title`, `description`, `image`, `tab_id`, `activity`) VALUES
(1, 'Project Name', 'Some details about this project', 'data/uploads/file_149898924014.jpg', 2, 1),
(2, 'Project Name', 'Some details about this project', 'data/uploads/file_14989892929.jpg', 3, 0),
(3, 'Project Name', 'Some details about this project', 'data/uploads/file_14989893917.jpg', 0, 0),
(4, 'Project Name', 'Some details about this project', 'data/uploads/file_14989894497.jpg', 0, 0),
(5, 'Project Name', 'Some details about this project', 'data/uploads/file_149899209913.jpg', 0, 0),
(6, 'Project Name', 'Some details about this project', 'data/uploads/file_149899214313.jpg', 0, 0),
(7, 'Project Name', 'Some details about this project', 'data/uploads/file_149918542112.jpg', 0, 0),
(8, 'Project Name', 'Some details about this project', 'data/uploads/file_149918548611.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  `activity` tinyint(4) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `image` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `level`, `activity`, `date`, `image`) VALUES
(1, 'mohamed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'm.yousef_82@yahoo.com', 0, 1, '2017-03-27', 'data/uploads/file_149364194812.jpg'),
(3, 'ahmed', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'm.yousef0082@gmail.com', 2, 1, '2017-03-27', 'data/uploads/file_14907064315.jpg'),
(12, 'islam', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'm.yousef0082@gmail.com', 1, 1, '2017-03-28', 'data/uploads/file_149364191114.png'),
(13, 'user', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'm.yousef0082@gmail.com', 1, 1, '2017-03-28', 'data/uploads/file_149364186812.png'),
(22, 'lllllll', 'c481637a900924d8505c15366361f8051db68652', 'm.yousef_82@yahoo.com', 1, 0, '2017-07-11', 'data/uploads/file_14997831906.jpg'),
(23, 'jjjj', '5a1bb7397fbac12884bd4b5e745cb336adc8f06c', 'raniaelbadawy.1985@gmail.com', 1, 0, '2017-07-11', 'data/uploads/file_14997832486.jpg'),
(25, 'oooooooooookkkkkkkkkkk', 'fdff', 'm.yousef_82@outlook.com', 1, 0, '2017-12-29', 'data/uploads/file_151457257114.gif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accordion`
--
ALTER TABLE `accordion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_comment` (`item_id`),
  ADD KEY `comment_user` (`user_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_1` (`user_id`),
  ADD KEY `Cat_1` (`cat_id`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prograss`
--
ALTER TABLE `prograss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socialmedia`
--
ALTER TABLE `socialmedia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabs`
--
ALTER TABLE `tabs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabsitems`
--
ALTER TABLE `tabsitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `accordion`
--
ALTER TABLE `accordion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `prograss`
--
ALTER TABLE `prograss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `socialmedia`
--
ALTER TABLE `socialmedia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tabs`
--
ALTER TABLE `tabs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tabsitems`
--
ALTER TABLE `tabsitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_comment` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `Cat_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
