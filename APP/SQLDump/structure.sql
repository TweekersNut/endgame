-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 10, 2019 at 12:26 PM
-- Server version: 5.5.60-MariaDB
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_tweekersnut-tut`
--

-- --------------------------------------------------------

--
-- Table structure for table `adverts`
--

CREATE TABLE `adverts` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `img` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `clicks` int(11) NOT NULL DEFAULT '0',
  `area` varchar(45) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adverts`
--

INSERT INTO `adverts` (`id`, `name`, `img`, `link`, `clicks`, `area`, `status`) VALUES
(1, 'home_banner_1', 'https://www.tweekersnut-tutorial.ml//img/add.jpg', 'https://google.com', 12, 'home', '1'),
(2, 'home_banner_2', 'https://www.tweekersnut-tutorial.ml//img/add.jpg', 'https://yahoo.com', 8, 'blog', '1'),
(4, 'Get_my_pc', 'https://www.tweekersnut-tutorial.ml//img/banners/get_my_pc_logo.png', 'https://getmypc.in', 3, 'home', '1');

-- --------------------------------------------------------

--
-- Table structure for table `blog_cat`
--

CREATE TABLE `blog_cat` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `status` char(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_cat`
--

INSERT INTO `blog_cat` (`id`, `name`, `desc`, `status`) VALUES
(2, 'Games', 'Games Category Created By Bot.', '1'),
(3, 'Reviews', 'Reviews Category Created By Bot.', '1'),
(5, 'News', 'News Category Created By Bot.', '1'),
(6, 'Battle Royale', 'Open world players vs players games.', '1'),
(8, 'Hello', 'World', '1');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `img` longtext,
  `summery` varchar(255) DEFAULT NULL,
  `description` longtext,
  `added_on` datetime DEFAULT NULL,
  `cat` int(11) DEFAULT NULL,
  `raiting` longtext,
  `user` int(11) DEFAULT NULL,
  `platform` int(11) DEFAULT NULL,
  `genre` int(11) DEFAULT NULL,
  `featured` int(11) DEFAULT NULL,
  `status` char(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `img`, `summery`, `description`, `added_on`, `cat`, `raiting`, `user`, `platform`, `genre`, `featured`, `status`) VALUES
(1, 'Game 1', '[\"https://www.tweekersnut-tutorial.ml/img/games/1.jpg\"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eius-mod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Lorem ipsum dolor sit amet, consecte-tur adipiscing elit, sed do eiusmod tempor ', 'i am desc', '2019-05-28 14:13:59', 2, '{\"price\":4,\"graphics\":3,\"difficulty\":2}', 1, 1, 1, 1, '1'),
(2, 'Review 1', '[\"https://www.tweekersnut-tutorial.ml/img/games/1.jpg\"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eius-mod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Lorem ipsum dolor sit amet, consecte-tur adipiscing elit, sed do eiusmod tempor ', 'i am desc', '2019-05-28 14:13:59', 3, '{\"price\":4,\"graphics\":3,\"difficulty\":2}', 1, 1, 2, 0, '1'),
(3, 'Game 2', '[\"https://www.tweekersnut-tutorial.ml/img/games/1.jpg\"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eius-mod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Lorem ipsum dolor sit amet, consecte-tur adipiscing elit, sed do eiusmod tempor ', 'i am desc', '2019-05-28 14:13:59', 2, '{\"price\":4,\"graphics\":3,\"difficulty\":2}', 1, 1, 1, 0, '1'),
(4, 'Game 3', '[\"https://www.tweekersnut-tutorial.ml/img/games/3.jpg\"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eius-mod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Lorem ipsum dolor sit amet, consecte-tur adipiscing elit, sed do eiusmod tempor ', 'i am desc', '2019-05-28 14:13:59', 2, '{\"price\":4,\"graphics\":3,\"difficulty\":2}', 1, 1, 1, 0, '1'),
(5, 'Game 4', '[\"https://www.tweekersnut-tutorial.ml/img/games/4.jpg\"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eius-mod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Lorem ipsum dolor sit amet, consecte-tur adipiscing elit, sed do eiusmod tempor ', 'i am desc', '2019-05-28 14:13:59', 2, '{\"price\":4,\"graphics\":3,\"difficulty\":2}', 1, 1, 1, 0, '1'),
(6, 'Review 2', '[\"https://www.tweekersnut-tutorial.ml/img/games/2.jpg\"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eius-mod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Lorem ipsum dolor sit amet, consecte-tur adipiscing elit, sed do eiusmod tempor ', 'i am desc', '2019-05-28 14:13:59', 3, '{\"price\":2,\"graphics\":3,\"difficulty\":2}', 1, 1, 1, 0, '1'),
(7, 'Review 3', '[\"https://www.tweekersnut-tutorial.ml/img/games/3.jpg\"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eius-mod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Lorem ipsum dolor sit amet, consecte-tur adipiscing elit, sed do eiusmod tempor ', 'i am desc', '2019-05-28 14:13:59', 3, '{\"price\":2,\"graphics\":4,\"difficulty\":2}', 1, 1, 1, 0, '1'),
(10, 'This is title from admin panel', '\"https:\\/\\/www.tweekersnut-tutorial.ml\\/\\/img\\/blog-big\\/2019-02-02.jpg\"', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et\r\ndolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.', '<p><span style=\"color: #222222; font-family: Consolas, \'Lucida Console\', \'Courier New\', monospace; font-size: 12px; white-space: pre-wrap;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</span></p>\r\n<p>&nbsp;</p>\r\n<p><strong><span style=\"color: #222222; font-family: Consolas, \'Lucida Console\', \'Courier New\', monospace; font-size: 12px; white-space: pre-wrap;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et</span></strong></p>\r\n<p><strong><span style=\"color: #222222; font-family: Consolas, \'Lucida Console\', \'Courier New\', monospace; font-size: 12px; white-space: pre-wrap;\">dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</span></strong></p>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: center;\"><span style=\"color: #222222; font-family: Consolas, \'Lucida Console\', \'Courier New\', monospace; font-size: 12px; white-space: pre-wrap;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</span></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: left;\"><span style=\"color: #222222; font-family: Consolas, \'Lucida Console\', \'Courier New\', monospace; font-size: 12px; text-align: left; white-space: pre-wrap;\"><sub>orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</sub></span></p>', '2019-06-10 15:12:39', 2, '{\"price\":\"5\",\"graphics\":\"4\",\"difficulty\":\"3\"}', 1, 2, 1, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `status` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`, `status`) VALUES
(10, 'hello', 'hello@yopmail.com', 'Hello World!', 'Hello World!', '0'),
(11, 'hello', 'hello@yopmail.com', 'Hello World!', 'Hello World!', '0'),
(13, 'Test User', 'fear126@live.com', 'i am just a subject', 'i am just a message', '0'),
(14, 'Test User', 'fear126@live.com', 'i am subject', 'i am message', '0');

-- --------------------------------------------------------

--
-- Table structure for table `game_genre`
--

CREATE TABLE `game_genre` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `status` char(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `game_genre`
--

INSERT INTO `game_genre` (`id`, `name`, `status`) VALUES
(1, 'F.P.S', '1'),
(2, 'Shooter', '1'),
(3, 'Racing', '1');

-- --------------------------------------------------------

--
-- Table structure for table `game_platform`
--

CREATE TABLE `game_platform` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `status` char(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `game_platform`
--

INSERT INTO `game_platform` (`id`, `name`, `status`) VALUES
(1, 'XBOX', '1'),
(2, 'P.C', '1'),
(3, 'Playstation', '1');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`, `status`) VALUES
(3, 'fear126@live.com', '1'),
(7, '226taran@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `_key` varchar(255) NOT NULL,
  `_val` longtext NOT NULL,
  `status` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `_key`, `_val`, `status`) VALUES
(1, 'contact.map', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3429.585494195883!2d76.70707871513139!3d30.730051281638133!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fee5655555555%3A0xc2418f4ab36a780!2sTweekersNut+Network!5e0!3m2!1sen!2sin!4v1558985069611!5m2!1sen!2sin', '1'),
(2, 'email.host', 'http://tweekersnut-tutorial.ml', '1'),
(3, 'email.username', 'noreply@tweekersnut-tutorial.ml', '1'),
(4, 'email.password', 'Qwerty@1234', '1'),
(5, 'email.port', '465', '1'),
(6, 'contact.address', 'Main Str, no 23, New York', '1'),
(7, 'contact.phone', '+91 9878695378', '1'),
(8, 'contact.email', 'admin@tweekersnut.com', '1'),
(9, 'pagination.perpage', '6', '1'),
(11, 'site.logo', 'https://www.tweekersnut-tutorial.ml/img/logo.png', '1'),
(12, 'site.favicon', 'https://www.tweekersnut-tutorial.ml/img/favicon.ico', '1'),
(13, 'pagination.perpage_admin', '15', '1'),
(14, 'upload.max_size', '10000', '1'),
(15, 'upload.allowed_mime', 'png,jpg,jpeg', '1'),
(16, 'editor.tinymce', 'c44n2venmge579m43f7eznie3rjra1pgyh73je7nc3y1n15b', '1');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `btn_text` varchar(20) NOT NULL,
  `type` char(1) NOT NULL DEFAULT '0' COMMENT '0 = slider | 1 = video',
  `status` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `img`, `title`, `description`, `link`, `btn_text`, `type`, `status`) VALUES
(1, 'https://www.tweekersnut-tutorial.ml/img/slider-bg-1.jpg', 'Title 1', 'i am description of the slider', '#', 'Oh Ye', '0', '1'),
(2, 'https://www.tweekersnut-tutorial.ml/img/slider-bg-2.jpg', 'title 2', 'i am description 2', '#', 'Tanvir', '0', '1'),
(5, 'https://www.tweekersnut-tutorial.ml//img/slider/mta_sa_server.jpeg', 'MTA:Game Play', 'Multi Theft Auto Game Play Video', 'https://www.youtube.com/watch?v=fniczgal2Q4', 'Watch Now', '1', '1'),
(6, 'https://www.tweekersnut-tutorial.ml//img/slider/single_blog_5.png', 'pika', 'chu', 'https://www.youtube.com/watch?v=1roy4o4tqQM', 'Watch Now', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `avatar` longtext,
  `added_on` datetime DEFAULT NULL,
  `IP` varchar(45) DEFAULT NULL,
  `acc_key` varchar(255) DEFAULT NULL,
  `bio` longtext NOT NULL,
  `status` char(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `added_on`, `IP`, `acc_key`, `bio`, `status`) VALUES
(1, 'admin', 'fear126@live.com', 'ejhoRDZCV3MvVUpoRDYyWGhHRVZGUT09', 'https://www.tweekersnut-tutorial.ml//img/avatar/team_2.png', '2019-05-30 11:21:44', '110.225.245.193', '96934777', 'I am a noob and I know it ting ting ting', '1'),
(3, 'cadell126', 'cadell126@live.com', 'ejhoRDZCV3MvVUpoRDYyWGhHRVZGUT09', 'https://www.tweekersnut-tutorial.ml/img/blank_avatar.png', '2019-06-06 16:22:44', '122.173.141.63', '43453184', '', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adverts`
--
ALTER TABLE `adverts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_cat`
--
ALTER TABLE `blog_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_genre`
--
ALTER TABLE `game_genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_platform`
--
ALTER TABLE `game_platform`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
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
-- AUTO_INCREMENT for table `adverts`
--
ALTER TABLE `adverts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog_cat`
--
ALTER TABLE `blog_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `game_genre`
--
ALTER TABLE `game_genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `game_platform`
--
ALTER TABLE `game_platform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
