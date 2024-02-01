-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2023 at 01:30 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idiscuss`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `sno` int(8) NOT NULL,
  `username` varchar(30) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `loggedin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`sno`, `username`, `admin_pass`, `loggedin`) VALUES
(1, 'admin', '$2y$10$UNp15xtt1mLH3Npk0HEmCO9CDtJPcoA7okQsj/bxsR1KcmufCLNRG', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(8) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(500) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `top_cat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `created`, `top_cat`) VALUES
(1, 'Python', 'Python is a high-level, general-purpose programming language. Its design philosophy emphasizes code readability with the use of significant indentation. Python is dynamically-typed and garbage-collected. It supports multiple programming paradigms, includin', '2022-10-23 00:51:49', 1),
(2, 'Javascript', 'JavaScript, often abbreviated as JS, is a programming language that is one of the core technologies of the World Wide Web, alongside HTML and CSS. As of 2022, 98% of websites use JavaScript on the client side for webpage behavior, often incorporating thir', '2022-10-23 00:53:08', 0),
(3, 'Django', 'Django is a free and open-source, Python-based web framework that follows the model–template–views architectural pattern. It is maintained by the Django Software Foundation, an independent organization established in the US as a 501 non-profit.', '2022-10-25 00:14:13', 0),
(4, 'Flask', 'Flask is a micro web framework written in Python. It is classified as a microframework because it does not require particular tools or libraries. It has no database abstraction layer, form validation, or any other components where pre-existing third-party libraries provide common functions.', '2022-10-25 00:14:41', 0),
(5, 'C++', 'C++ is a high-level, general-purpose programming language created by Danish computer scientist Bjarne Stroustrup. First released in 1985 as an extension of the C programming language, it has since expanded significantly over time; modern C++ currently has object-oriented, generic, and functional features, in addition to facilities for low-level memory manipulation.', '2023-04-21 19:14:01', 0),
(6, 'PHP', 'PHP is a general-purpose scripting language geared toward web development. It was originally created by Danish-Canadian programmer Rasmus Lerdorf in 1993 and released in 1995. The PHP reference implementation is now produced by The PHP Group. PHP was originally an abbreviation of Personal Home Page, but it now stands for the recursive initialism PHP: Hypertext Preprocessor.', '2023-04-21 20:53:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(8) NOT NULL,
  `comment_content` text NOT NULL,
  `thread_id` int(8) NOT NULL,
  `comment_by` int(8) NOT NULL,
  `netvotes` int(7) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `comment_by`, `netvotes`, `comment_time`) VALUES
(1, 'this is a comment', 1, 1, 0, '2022-11-01 18:03:47'),
(2, 'rt', 1, 2, 0, '2022-11-01 21:12:34'),
(3, '', 1, 3, 0, '2022-11-01 21:25:49'),
(4, '', 1, 4, 0, '2022-11-01 21:34:29'),
(5, 'Somebody please fix it', 1, 1, 0, '2022-11-01 21:41:42'),
(6, 'Many of our components require the use of JavaScript to function. Specifically, they require jQuery, Popper, and our own JavaScript plugins. We use jQuery’s slim build, but the full version is also supported.\n\nPlace one of the following  tag, to enable them. jQuery must come first, then Popper, and then our JavaScript plugins.', 1, 2, 0, '2022-11-01 22:11:54'),
(7, 'Many of our components require the use of JavaScript to function. Specifically, they require jQuery, Popper, and our own JavaScript plugins. We use jQuery’s slim build, but the full version is also supported.\n\nPlace one of the following tag, to enable them. jQuery must come first, then Popper, and then our JavaScript plugins.', 8, 3, -1, '2022-11-01 22:13:07'),
(8, 'The PHP development team announces the immediate availability of PHP 8.0.25. This is a security fix release.\r\n\r\nAll PHP 8.0 users are encouraged to upgrade to this version.\r\n\r\nFor source downloads of PHP 8.0.25 please visit our downloads page, Windows source and binaries can be found on windows.php.net/download/. The list of changes is recorded in the ChangeLog.', 8, 4, -1, '2022-11-01 22:14:14'),
(9, 'The PHP development team announces the immediate availability of PHP 8.0.25. This is a security fix release.\r\n\r\nAll PHP 8.0 users are encouraged to upgrade to this version.\r\n\r\nFor source downloads of PHP 8.0.25 please visit our downloads page, Windows source and binaries can be found on windows.php.net/download/. The list of changes is recorded in the ChangeLog.', 8, 1, 1, '2022-11-01 22:14:50'),
(10, 'jskfjsfjlfaklfj', 8, 2, 0, '2022-11-01 22:15:43'),
(11, 'The PHP development team announces the immediate availability of PHP 8.0.25. This is a security fix release.\r\n\r\nAll PHP 8.0 users are encouraged to upgrade to this version.\r\n\r\nFor source downloads of PHP 8.0.25 please visit our downloads page, Windows source and binaries can be found on windows.php.net/download/. The list of changes is recorded in the ChangeLog.', 1, 3, 0, '2022-11-01 22:16:08'),
(12, 'jhhhhkyihih', 1, 4, 0, '2022-11-01 22:16:45'),
(13, 'As already mentioned \"This is a peer to peer forum. Keep it friendly. Be courteous and respectful. Appreciate that others may have an opinion different from yours. Stay on topic. Share your knowledge. Refrain from demeaning, discriminatory, or harassing behaviour and speech.\"', 8, 1, 0, '2022-11-01 22:24:47'),
(14, 'This is a peer to peer forum. Keep it friendly. Be courteous and respectful. Appreciate that others may have an opinion different from yours. Stay on topic. Share your knowledge. Refrain from demeaning, discriminatory, or harassing behaviour and speech.', 8, 2, 1, '2022-11-01 22:36:33'),
(15, 'Fix it', 1, 3, 0, '2022-11-01 22:41:48'),
(16, 'The PHP development team announces the immediate availability of PHP 8.0.25. This is a security fix release.\r\n\r\nAll PHP 8.0 users are encouraged to upgrade to this version.\r\n\r\nFor source downloads of PHP 8.0.25 please visit our downloads page, Windows source and binaries can be found on windows.php.net/download/. The list of changes is recorded in the ChangeLog.', 2, 4, 0, '2022-11-01 22:53:37'),
(17, 'The PHP development team announces the immediate availability of PHP 8.0.25. This is a security fix release.\r\n\r\nAll PHP 8.0 users are encouraged to upgrade to this version.\r\n\r\nFor source downloads of PHP 8.0.25 please visit our downloads page, Windows source and binaries can be found on windows.php.net/download/. The list of changes is recorded in the ChangeLog.\r\n\r\n\r\nThe PHP development team announces the immediate availability of PHP 8.0.25. This is a security fix release.\r\n\r\nAll PHP 8.0 users are encouraged to upgrade to this version.\r\n\r\nFor source downloads of PHP 8.0.25 please visit our downloads page, Windows source and binaries can be found on windows.php.net/download/. The list of changes is recorded in the ChangeLog.', 2, 1, 0, '2022-11-01 22:53:49'),
(20, '&lt;script&gt;alert(\"Hello\");&lt;/script&gt;', 1, 5, 0, '2022-11-04 00:30:13'),
(21, '&lt;script&gt;alert(\"Hello Comment\");&lt;/script&gt;', 15, 5, 0, '2022-11-04 12:42:46'),
(22, 'Try another way', 8, 6, 1, '2022-12-18 00:44:53'),
(24, 'Please help in installing python on mac', 2, 6, 0, '2022-12-21 14:44:25'),
(25, 'This is the answer.', 8, 7, 1, '2023-02-15 17:42:21'),
(26, 'My Comment..', 8, 6, -1, '2023-02-15 18:31:18'),
(27, '', 8, 6, -1, '2023-02-15 18:32:53'),
(28, 'This is the answer by mark..', 8, 6, 0, '2023-02-15 19:02:23'),
(29, '', 8, 6, 0, '2023-02-15 22:48:33'),
(30, '', 8, 6, 0, '2023-02-15 23:20:23'),
(31, 'Fourth comment..', 8, 6, 0, '2023-02-15 23:30:42'),
(32, '15th comment.', 8, 6, 0, '2023-02-16 21:55:53'),
(33, 'Mark comment', 8, 6, 0, '2023-02-16 21:57:39'),
(34, '{}[]|!@#$%^&*()_+-=,.', 8, 6, 0, '2023-02-16 22:08:28'),
(35, '/', 8, 6, 0, '2023-02-16 22:08:58'),
(36, 'Marks comment on 16/02/2023', 8, 6, 0, '2023-02-16 22:10:26'),
(37, '&lt;&gt;', 8, 6, 0, '2023-02-16 22:10:43'),
(38, '?', 8, 6, 0, '2023-02-16 22:11:00'),
(39, ':;', 8, 6, 0, '2023-02-16 22:11:53'),
(40, '\"', 8, 6, 0, '2023-02-16 22:15:45'),
(41, 'Mark\'s comment on 16/02/2023', 8, 6, 0, '2023-02-16 22:23:03'),
(42, '\\', 8, 6, 0, '2023-02-16 22:52:38'),
(43, '/', 8, 6, 0, '2023-02-16 23:06:45'),
(44, 'Hey there', 8, 6, 1, '2023-02-16 23:39:10'),
(45, 'Try another browser like Safari or Firefox!', 8, 7, 0, '2023-02-23 18:22:10'),
(46, 'Try another browser like Chrome or Brave!', 8, 6, 0, '2023-02-23 18:23:56'),
(47, 'Will make some tutorials on it soon.', 17, 6, 0, '2023-02-23 18:27:32'),
(48, 'Will make some tutorials on it soon.', 17, 6, 0, '2023-02-23 18:29:48'),
(49, '3rd comment from mark..', 17, 6, 0, '2023-02-23 19:17:00'),
(50, 'It can be implemented through different ways.  ', 19, 7, 0, '2023-02-23 19:44:12'),
(51, '4th comment.', 17, 6, 0, '2023-02-28 18:40:28'),
(52, '5th comment.', 17, 6, 0, '2023-02-28 22:44:30'),
(53, '6th comment.', 17, 6, 0, '2023-02-28 22:45:07'),
(54, '7th comment.', 17, 6, 0, '2023-02-28 22:45:49'),
(57, '', 17, 6, 0, '2023-03-01 13:20:52'),
(58, 'ok', 17, 6, 0, '2023-03-01 13:22:39'),
(59, 'ok', 17, 6, 0, '2023-03-01 13:23:02'),
(60, 'yes', 17, 6, 0, '2023-03-03 12:33:51'),
(61, 'Will make tutorials on it soon.', 16, 6, 0, '2023-03-11 15:04:58'),
(62, 'ok', 18, 6, 0, '2023-03-11 15:15:09'),
(63, 'Ok', 3, 6, 0, '2023-03-11 15:17:25'),
(64, 'ok', 4, 6, 0, '2023-03-11 16:11:49'),
(65, 'will make a tutorial on it', 4, 6, 0, '2023-03-11 16:13:21'),
(66, 'ok', 17, 6, 0, '2023-03-11 21:20:36'),
(67, 'ok', 16, 6, 0, '2023-03-11 23:51:48'),
(68, 'ok', 6, 6, 0, '2023-03-12 18:30:02'),
(69, 'First run your IDE or CMD as Administrator and run the following commands:\r\npip install pipwin\r\npipwin install pyaudio', 1, 27, 0, '2023-04-27 18:33:55'),
(70, 'Will make some tutorials on it.', 27, 6, 0, '2023-04-27 18:57:03');

-- --------------------------------------------------------

--
-- Table structure for table `commentsonanswers`
--

CREATE TABLE `commentsonanswers` (
  `cmtonans_id` int(8) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_id` int(8) NOT NULL,
  `comment_by` int(8) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commentsonanswers`
--

INSERT INTO `commentsonanswers` (`cmtonans_id`, `comment_content`, `comment_id`, `comment_by`, `comment_time`) VALUES
(1, 'OK', 9, 6, '2023-02-24 20:51:28'),
(2, 'yes', 9, 7, '2023-02-24 20:55:31'),
(3, 'ok', 10, 7, '2023-02-24 21:00:42'),
(4, 'ok', 25, 7, '2023-02-24 22:10:43'),
(5, 'OK', 26, 7, '2023-02-24 22:37:41'),
(6, 'OK', 28, 7, '2023-02-24 22:46:46'),
(7, 'OK', 47, 7, '2023-02-24 22:50:30'),
(8, 'yes', 48, 7, '2023-02-24 22:51:00'),
(9, 'ok', 49, 7, '2023-02-24 22:54:54'),
(10, 'ok', 1, 7, '2023-02-24 22:59:35'),
(11, 'ok', 2, 7, '2023-02-24 23:07:01'),
(12, 'ok', 32, 6, '2023-02-24 23:44:50'),
(13, 'ok', 33, 6, '2023-02-24 23:49:02'),
(14, 'ok', 14, 6, '2023-02-25 00:01:03'),
(15, 'ok', 13, 6, '2023-02-25 12:27:31'),
(16, 'ok', 22, 6, '2023-02-25 12:28:59'),
(17, 'ok', 31, 6, '2023-02-25 12:31:05'),
(18, 'ok', 36, 6, '2023-02-25 12:35:59'),
(19, 'ok', 45, 6, '2023-02-25 12:37:37'),
(20, 'ok', 8, 6, '2023-02-25 13:35:43'),
(21, 'ok', 7, 6, '2023-02-25 15:17:55'),
(22, 'ok.', 7, 6, '2023-02-25 16:17:08'),
(23, 'ok.', 8, 6, '2023-02-25 16:17:44'),
(24, 'yes', 44, 6, '2023-02-25 16:19:04'),
(25, 'ok', 34, 6, '2023-02-25 17:01:51'),
(26, 'ok', 39, 6, '2023-02-25 17:02:27'),
(27, 'ok', 46, 6, '2023-02-25 17:05:45'),
(28, 'ok', 41, 6, '2023-02-25 17:13:56'),
(29, 'ok', 43, 6, '2023-02-25 17:16:04'),
(31, 'ok', 9, 6, '2023-02-25 17:29:05'),
(32, 'ok', 10, 6, '2023-02-25 17:38:32'),
(33, 'yes', 13, 6, '2023-02-25 17:39:32'),
(34, 'ok', 13, 6, '2023-02-25 17:39:48'),
(35, 'yes', 14, 6, '2023-02-25 17:41:25'),
(36, 'yes', 25, 6, '2023-02-25 17:48:51'),
(37, 'yes', 26, 6, '2023-02-25 17:49:53'),
(38, 'yes', 28, 6, '2023-02-25 17:51:00'),
(39, 'yes', 31, 6, '2023-02-25 18:02:40'),
(40, 'yes', 32, 6, '2023-02-25 18:06:08'),
(41, 'yes', 33, 6, '2023-02-25 18:06:27'),
(42, 'ok', 31, 6, '2023-02-25 18:22:55'),
(43, 'ok', 32, 6, '2023-02-25 18:42:41'),
(44, 'ok', 33, 6, '2023-02-25 18:48:33'),
(45, 'yes', 36, 6, '2023-02-25 18:55:06'),
(46, 'yes', 41, 6, '2023-02-25 18:56:47'),
(47, 'ok', 44, 6, '2023-02-25 18:57:27'),
(48, 'ok', 36, 6, '2023-02-25 19:09:36'),
(49, 'yes', 39, 6, '2023-02-25 19:10:02'),
(50, 'yes', 43, 6, '2023-02-25 19:11:13'),
(51, 'yes', 45, 6, '2023-02-25 19:19:13'),
(52, 'yes', 46, 6, '2023-02-25 19:19:47'),
(53, 'yes', 34, 6, '2023-02-25 19:22:04'),
(54, 'ok', 34, 6, '2023-02-25 19:29:16'),
(55, 'ok', 39, 6, '2023-02-25 19:29:54'),
(56, 'ok', 41, 6, '2023-02-25 19:31:00'),
(57, 'ok', 28, 6, '2023-02-25 22:10:18'),
(58, 'yes', 41, 6, '2023-02-25 22:30:52'),
(59, 'yes', 10, 6, '2023-02-25 22:49:32'),
(60, 'ok', 14, 6, '2023-02-25 23:01:40'),
(61, 'yes', 22, 6, '2023-02-25 23:06:39'),
(62, 'ok', 22, 6, '2023-02-25 23:10:16'),
(63, 'ok', 22, 6, '2023-02-25 23:10:16'),
(64, 'ok', 25, 6, '2023-02-25 23:13:17'),
(65, 'yes', 25, 6, '2023-02-25 23:14:41'),
(66, 'OK', 26, 6, '2023-02-25 23:15:02'),
(67, 'yes', 31, 6, '2023-02-25 23:17:41'),
(68, 'yes', 33, 6, '2023-02-25 23:36:02'),
(69, 'ok', 43, 6, '2023-02-25 23:50:41'),
(70, 'yes', 44, 6, '2023-02-25 23:56:40'),
(71, 'yes', 9, 6, '2023-02-26 00:14:52'),
(72, 'yes', 10, 6, '2023-02-26 00:15:18'),
(73, 'yes', 13, 6, '2023-02-26 12:56:41'),
(74, 'yes', 28, 6, '2023-02-26 13:01:35'),
(75, 'yes', 34, 6, '2023-02-26 13:20:33'),
(76, 'yes', 36, 6, '2023-02-26 13:23:32'),
(77, 'yes', 14, 6, '2023-02-26 13:54:40'),
(78, 'yes', 26, 6, '2023-02-26 22:51:58'),
(79, 'yes', 47, 6, '2023-03-01 13:23:42'),
(80, 'yes', 47, 6, '2023-03-01 13:23:47'),
(81, 'ok', 47, 6, '2023-03-01 15:42:39'),
(82, 'ok', 48, 6, '2023-03-01 16:10:34'),
(83, 'yes', 47, 6, '2023-03-01 16:19:47'),
(84, 'yes', 48, 6, '2023-03-01 16:30:27'),
(85, 'ok', 48, 6, '2023-03-01 16:55:51'),
(86, 'yes', 49, 6, '2023-03-01 17:03:56'),
(87, 'ok', 51, 6, '2023-03-01 17:04:35'),
(88, 'yes', 51, 6, '2023-03-01 20:32:01'),
(89, 'yes', 58, 6, '2023-03-01 20:44:35'),
(90, 'ok', 58, 6, '2023-03-01 21:19:06'),
(91, 'yes', 58, 6, '2023-03-01 21:19:35'),
(92, 'ok', 58, 6, '2023-03-01 21:25:49'),
(93, 'ok', 52, 6, '2023-03-01 21:27:36'),
(94, 'yes', 52, 6, '2023-03-01 21:27:54'),
(95, 'ok', 53, 6, '2023-03-01 21:35:47'),
(96, 'yes', 53, 6, '2023-03-01 21:37:47'),
(97, 'ok', 53, 6, '2023-03-01 21:43:32'),
(98, 'ok', 49, 6, '2023-03-01 21:45:15'),
(99, 'yes', 53, 6, '2023-03-01 21:46:01'),
(100, 'ok', 51, 6, '2023-03-01 22:12:43'),
(101, 'ok', 52, 6, '2023-03-02 23:12:51'),
(102, 'yes', 49, 6, '2023-03-02 23:13:27'),
(103, 'yes', 51, 6, '2023-03-02 23:38:52'),
(104, 'yes', 52, 6, '2023-03-02 23:44:19'),
(105, 'ok', 47, 6, '2023-03-03 00:00:52'),
(106, 'ok', 49, 6, '2023-03-03 00:13:16'),
(107, 'yes', 49, 6, '2023-03-03 00:21:27'),
(108, 'good answer..', 62, 7, '2023-03-30 16:10:22'),
(109, 'yes', 32, 6, '2023-04-07 17:35:06'),
(110, 'Please make the tutorials soon. I also need them.', 65, 27, '2023-04-27 18:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `commentsonthreads`
--

CREATE TABLE `commentsonthreads` (
  `cmtonthd_id` int(8) NOT NULL,
  `comment_content` text NOT NULL,
  `thread_id` int(8) NOT NULL,
  `comment_by` int(8) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commentsonthreads`
--

INSERT INTO `commentsonthreads` (`cmtonthd_id`, `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES
(1, 'ok', 8, 6, '2023-02-26 23:21:11'),
(2, 'yes', 8, 6, '2023-02-26 23:24:23'),
(3, 'ok', 8, 6, '2023-02-26 23:38:30'),
(4, 'yes', 8, 6, '2023-02-26 23:43:20'),
(5, 'ok', 8, 6, '2023-02-26 23:47:16'),
(6, 'yes', 8, 6, '2023-02-26 23:48:12'),
(7, 'ok', 17, 6, '2023-02-26 23:49:36'),
(8, 'yes', 17, 6, '2023-03-01 13:23:23'),
(9, 'ok', 17, 6, '2023-03-01 13:40:18'),
(10, 'yes', 17, 6, '2023-03-01 15:05:46'),
(11, 'ok', 17, 6, '2023-03-01 15:42:53'),
(12, 'yes', 17, 6, '2023-03-03 00:21:50'),
(15, 'what all of the answers so far have missed is that it depends where the person was born and where they are right now.', 8, 6, '2023-03-08 13:00:50'),
(16, 'Please make some tutorials on Javascript functions.', 23, 6, '2023-04-07 23:21:51'),
(17, 'Many people face problem installing pyaudio.', 1, 27, '2023-04-27 18:35:04'),
(18, 'I am also facing the same problem.', 4, 27, '2023-04-27 18:44:33');

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `query_id` int(8) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `query` text NOT NULL,
  `submitted_on` datetime NOT NULL,
  `seen` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`query_id`, `user_email`, `query`, `submitted_on`, `seen`) VALUES
(1, 'mark@mark.com', 'Please add some new features on this forum.', '2023-04-23 00:22:13', 1),
(2, 'sean@sean.com', 'Please add a category on Java.', '2023-04-23 15:40:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(7) NOT NULL,
  `thread_title` varchar(255) NOT NULL,
  `thread_desc` text NOT NULL,
  `thread_cat_id` int(7) NOT NULL,
  `thread_user_id` int(7) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `netvotes` int(7) NOT NULL,
  `total_answers` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`, `netvotes`, `total_answers`) VALUES
(1, 'Unable to install pyaudio', 'I am not able to install pyaudio on Windows.', 1, 1, '2022-10-31 17:09:31', 2, 11),
(2, 'Not able to use python', 'please help me', 1, 3, '2022-11-01 00:10:06', 0, 3),
(3, 'sdf', 'sdf', 1, 4, '2022-11-01 16:42:22', 0, 1),
(4, 'Python Framework', 'Not able to install python framework. Please give some idea to tackle this. Using Windows 8 with Intel i3 and 4gb RAM.', 1, 4, '2022-11-01 16:48:06', 0, 2),
(5, 'New Title', 'new desc', 1, 2, '2022-11-01 16:49:08', 0, 0),
(6, 'jQuery Tutorial For Beginners', 'please give me some idea about jQuery', 1, 1, '2022-11-01 17:03:14', 1, 1),
(7, 'Python Tutorial For Beginners', 'please give me some idea about python', 1, 2, '2022-11-01 17:05:23', 0, 0),
(8, 'Fetch api not working', 'I am in trouble. Fetch api is not working in MS Edge', 2, 3, '2022-11-01 17:09:46', 1, 29),
(13, 'Django Tutorials', 'what about django tutorials', 3, 4, '2022-11-03 17:56:00', 0, 0),
(14, 'Make Python Tutorials', 'Please someone make python tutorials for beginners', 1, 5, '2022-11-03 18:11:52', 0, 0),
(15, '&lt;script&gt;alert(\"Hello In Title\");&lt;/script&gt;', '&lt;script&gt;alert(\"Hello\");&lt;/script&gt;', 1, 5, '2022-11-04 00:36:05', 0, 1),
(16, 'Lets learn Django', 'make django tutorials', 2, 5, '2022-11-04 12:55:49', 0, 2),
(17, 'Jquery Tutorials', 'please make some tutorials on jquery.', 2, 7, '2023-02-23 18:26:29', 1, 12),
(18, 'Ajax Implementation', 'How to implement ajax in php?', 2, 6, '2023-02-23 18:31:01', 0, 1),
(19, 'Django Implementation', 'How the django can be implemented ?', 3, 6, '2023-02-23 19:42:47', 0, 1),
(23, 'Javascript Functions', 'How to implement Javascript functions?', 2, 6, '2023-03-20 19:58:36', 0, 0),
(24, 'Django Fundamentals', 'Please make some tutorials on Django fundamentals.', 3, 7, '2023-04-13 20:54:12', 0, 0),
(25, 'Scripting in Python', 'Please make some tutorials on how to make scripts in python. ', 1, 7, '2023-04-14 14:09:59', 0, 0),
(26, 'Python', 'Python is a high-level, general-purpose programming language. Its design philosophy emphasizes code readability with the use of significant indentation. Python is dynamically-typed and garbage-collected. It supports multiple programming paradigms, includin', 1, 1, '2023-04-20 22:54:30', 0, 0),
(27, 'Python Memory Management', 'How is memory managed in Python?', 1, 27, '2023-04-27 18:32:09', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sno` int(8) NOT NULL,
  `username` varchar(30) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `loggedin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sno`, `username`, `user_email`, `user_pass`, `timestamp`, `loggedin`) VALUES
(1, 'this', 'this@test.com', '123', '2022-11-02 00:19:16', 0),
(2, 'test', 'test@test.com', '$2y$10$7f7M1bMlfDTRzFg9NRA/.eoGjPNWSorTh1IlIr1KqEmUsTg0TE4nS', '2022-11-02 01:00:31', 0),
(3, 'r', 'r@r.com', '$2y$10$JV6EkyI.viLlM6qch4aozueNCmiqSl.VCC4L4HYp9VgL3zLgKQ1xK', '2022-11-02 01:03:44', 0),
(4, 'tom', 'tom@tom.com', '$2y$10$K0VRKdjiJzTxRTJNKK6lD.dC89x5E18jV4E.G5itwZ27WeMYLYtpG', '2022-11-02 16:14:51', 0),
(5, 'tom2', 'tom', '$2y$10$rfTkP8cuap/q9mMEFD1GZ.6Ws9OPKVgB7D720sOiVP/X90FI7Nmsy', '2022-11-03 18:10:43', 0),
(6, 'mark', 'mark@mark.com', '$2y$10$fyUM3hGx3cR3KF7lVukvfeS.MrV.7aPVjNaOcxJcyfFSHLpjyYKrC', '2022-12-18 00:43:59', 0),
(7, 'sean', 'sean@sean.com', '$2y$10$c.TWl6vxzP73m./s0S8Rhe7T4QI5wImzDDMDWlT9NcSkBMFYLYf8u', '2023-03-03 17:38:30', 0),
(26, 'Pawan', 'pawan@pawan.com', '$2y$10$96Kh/i3ErvLRMSt0kUKHLeS1dafKDDikXYQH09LnSByBM0gwzy4NG', '2023-04-23 18:55:15', 0),
(27, 'Rajat Singh', 'rajats520@gmail.com', '$2y$10$ZlmTaZJnCp0n3uJk6tj5C.PHLuMFAyVl/xZ.UJosIm4Uha6AGN6dq', '2023-04-27 18:24:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `uservotesoncomments`
--

CREATE TABLE `uservotesoncomments` (
  `user_id` int(7) NOT NULL,
  `comment_id` int(8) NOT NULL,
  `vote_value` int(1) NOT NULL,
  `vote_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uservotesoncomments`
--

INSERT INTO `uservotesoncomments` (`user_id`, `comment_id`, `vote_value`, `vote_id`) VALUES
(6, 7, -1, 1),
(6, 8, -1, 2),
(7, 7, 0, 3),
(6, 13, -1, 4),
(7, 13, 1, 5),
(7, 8, 0, 6),
(6, 0, -1, 7),
(6, 30, 0, 9),
(6, 9, 1, 10),
(7, 9, 0, 12),
(6, 14, 1, 13),
(6, 22, 1, 14),
(6, 25, 1, 15),
(6, 26, -1, 16),
(6, 27, -1, 17),
(6, 44, 1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `uservotesonthreads`
--

CREATE TABLE `uservotesonthreads` (
  `user_id` int(7) NOT NULL,
  `thread_id` int(8) NOT NULL,
  `vote_value` int(1) NOT NULL,
  `vote_id` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uservotesonthreads`
--

INSERT INTO `uservotesonthreads` (`user_id`, `thread_id`, `vote_value`, `vote_id`) VALUES
(6, 2, 1, 4),
(6, 6, 1, 5),
(7, 2, -1, 6),
(7, 1, 1, 7),
(6, 1, 1, 8),
(6, 8, 1, 9),
(7, 8, 0, 10),
(6, 0, 1, 11),
(6, 17, 0, 12),
(6, 27, 1, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `commentsonanswers`
--
ALTER TABLE `commentsonanswers`
  ADD PRIMARY KEY (`cmtonans_id`);

--
-- Indexes for table `commentsonthreads`
--
ALTER TABLE `commentsonthreads`
  ADD PRIMARY KEY (`cmtonthd_id`);

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
  ADD PRIMARY KEY (`query_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`);
ALTER TABLE `threads` ADD FULLTEXT KEY `thread_title` (`thread_title`,`thread_desc`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sno`);
ALTER TABLE `users` ADD FULLTEXT KEY `username` (`username`,`user_email`);

--
-- Indexes for table `uservotesoncomments`
--
ALTER TABLE `uservotesoncomments`
  ADD PRIMARY KEY (`vote_id`);

--
-- Indexes for table `uservotesonthreads`
--
ALTER TABLE `uservotesonthreads`
  ADD PRIMARY KEY (`vote_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `sno` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `commentsonanswers`
--
ALTER TABLE `commentsonanswers`
  MODIFY `cmtonans_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `commentsonthreads`
--
ALTER TABLE `commentsonthreads`
  MODIFY `cmtonthd_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `query_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sno` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `uservotesoncomments`
--
ALTER TABLE `uservotesoncomments`
  MODIFY `vote_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `uservotesonthreads`
--
ALTER TABLE `uservotesonthreads`
  MODIFY `vote_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
