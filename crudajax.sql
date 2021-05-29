-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2021 at 09:54 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `rollnumber` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `rollnumber`, `created_at`) VALUES
(10, 'Espoire', 'Bisimwa', '', '2021-05-27 21:17:32'),
(12, 'adolph', 'Dollard', '', '2021-05-27 21:20:49'),
(13, 'Daniel', 'Bisimwa', '', '2021-05-27 21:21:36'),
(14, 'Peter', 'Peter KAHUMUZA pierre Irah', '', '2021-05-28 15:30:08'),
(15, 'Esther23', 'Esther BISIMWA', '', '2021-05-28 15:32:10'),
(16, 'Lumiere', 'Lulu Lumiere Bisimwa', '', '2021-05-28 15:32:36'),
(17, 'Dada', 'Byenge ZABAKENGA', '', '2021-05-28 16:50:13'),
(18, 'CHIRUZA', 'BISIMWA Jean-Louis', '', '2021-05-28 16:50:43');

--
-- Indexes for dumped tables
--

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
