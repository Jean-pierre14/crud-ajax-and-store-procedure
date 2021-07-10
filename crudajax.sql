-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2021 at 02:07 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crudajax`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteUser` (IN `user_Id` INT(11))  BEGIN
            DELETE FROM users WHERE id = user_Id;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getUser` (IN `idGet` INT(11))  BEGIN
            SELECT * FROM users WHERE id = idGet;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertUser` (IN `username` VARCHAR(100), `fullname` VARCHAR(100))  BEGIN
            INSERT INTO users(username, fullname) VALUES(username, fullname);
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectUser` ()  BEGIN
            SELECT * FROM users ORDER BY id DESC;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateUser` (IN `user_id` INT(11), `username` VARCHAR(100), `fullname` VARCHAR(100))  BEGIN
            UPDATE users SET username = username, fullname = fullname WHERE id = user_id;
        END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attended` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `attended`, `created_at`) VALUES
(0, 10, '2021-07-09', '2021-07-09 21:37:19'),
(0, 14, '2021-07-09', '2021-07-09 21:38:42'),
(0, 18, '2021-07-09', '2021-07-09 22:13:02'),
(0, 15, '2021-07-09', '2021-07-09 22:18:55'),
(0, 13, '2021-07-10', '2021-07-10 11:26:57'),
(0, 14, '2021-07-10', '2021-07-10 11:27:10'),
(0, 15, '2021-07-10', '2021-07-10 11:39:33'),
(0, 16, '2021-07-10', '2021-07-10 11:39:49'),
(0, 16, '2021-07-10', '2021-07-10 11:39:50'),
(0, 18, '2021-07-10', '2021-07-10 12:06:42');

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `users_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`id`, `name`, `users_id`, `created_at`) VALUES
(25, 'Aline', 12, '2021-07-02 09:21:36'),
(26, 'Aaliyah', 12, '2021-07-02 09:21:36'),
(27, 'Grace', 18, '2021-07-02 09:23:53'),
(28, 'Germain', 18, '2021-07-02 09:23:53'),
(29, 'Adolf', 18, '2021-07-02 09:23:54'),
(30, 'Daniel', 18, '2021-07-02 09:23:54'),
(31, 'Espoire', 18, '2021-07-02 09:23:54'),
(32, 'Esther', 18, '2021-07-02 09:23:54'),
(33, 'Bienfait', 18, '2021-07-02 09:23:54'),
(34, 'Dieumerci', 18, '2021-07-02 09:23:54'),
(35, 'Benjamin', 18, '2021-07-02 09:23:54'),
(36, 'Lumiere', 18, '2021-07-02 09:23:54'),
(37, 'elodie', 14, '2021-07-02 13:14:13'),
(38, 'julia', 14, '2021-07-02 13:14:13'),
(39, 'lucienne', 14, '2021-07-02 13:14:13'),
(40, 'kerene', 14, '2021-07-02 13:14:13'),
(41, 'lynda', 14, '2021-07-02 13:14:14'),
(42, 'sonia', 14, '2021-07-02 13:14:14'),
(43, 'Violette', 17, '2021-07-04 08:38:24'),
(44, 'Tatyana', 17, '2021-07-04 08:38:24'),
(45, 'Aisha', 17, '2021-07-04 08:38:25'),
(46, 'Asha', 17, '2021-07-04 08:38:25'),
(47, 'Anna', 12, '2021-07-04 17:47:59'),
(48, 'Bella', 12, '2021-07-04 17:48:00'),
(49, 'AAAA aaa', 17, '2021-07-04 17:48:37'),
(50, 'AAAa a', 17, '2021-07-04 17:48:37'),
(51, 'flo', 15, '2021-07-05 14:50:33'),
(52, 'a', 13, '2021-07-05 16:12:56'),
(53, 'aa', 13, '2021-07-05 16:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `rollnumber` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `rollnumber`, `created_at`) VALUES
(10, 'Espoire', 'Bisimwa', '', '2021-05-27 19:17:32'),
(12, 'adolph', 'Dollard up', '', '2021-05-27 19:20:49'),
(13, 'Daniel', 'Bisimwa', '', '2021-05-27 19:21:36'),
(14, 'Peter', 'Peter KAHUMUZA pierre Irah', '', '2021-05-28 13:30:08'),
(15, 'Esther23', 'Esther BISIMWA', '', '2021-05-28 13:32:10'),
(16, 'Lulu', 'Lumiere Bisimwa', '', '2021-05-28 13:32:36'),
(18, 'CHIRUZA', 'BISIMWA Jean-Louis', '', '2021-05-28 14:50:43'),
(22, 'Enzo', 'Enzo Zidane', '', '2021-07-04 10:46:18'),
(23, 'christian', 'bahizichristian', '', '2021-07-05 14:40:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `children`
--
ALTER TABLE `children`
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
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
