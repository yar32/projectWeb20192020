-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 28, 2020 at 04:40 PM
-- Server version: 5.7.26
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `historygames`
--

DROP TABLE IF EXISTS `historygames`;
CREATE TABLE IF NOT EXISTS `historygames` (
  `idhistorygame` int(11) NOT NULL AUTO_INCREMENT,
  `gamestate` int(4) NOT NULL COMMENT '1-Win 0-Draw (-1)-Lose',
  `date` date NOT NULL,
  `points` int(45) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`idhistorygame`,`user_id`),
  KEY `fk_historygames_users1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `idrole` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`idrole`),
  UNIQUE KEY `idRole_UNIQUE` (`idrole`),
  UNIQUE KEY `Name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`idrole`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `activeted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1- Acount active0- Acount desactiveted',
  `birthdate` date NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`iduser`,`role_id`),
  UNIQUE KEY `Username_UNIQUE` (`username`),
  UNIQUE KEY `Email_UNIQUE` (`email`),
  UNIQUE KEY `idUser_UNIQUE` (`iduser`),
  KEY `fk_users_roles1_idx` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`iduser`, `username`, `email`, `name`, `password`, `activeted`, `birthdate`, `role_id`) VALUES
(1, 'admin', 'admin@gmail.com', 'Administrador', '21232f297a57a5a743894a0e4a801fc3', 1, '2019-11-03', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `historygames`
--
ALTER TABLE `historygames`
  ADD CONSTRAINT `fk_historygames_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_roles1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`idrole`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
