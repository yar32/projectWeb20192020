-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 04-Maio-2020 às 19:23
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.0.33

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
-- Estrutura da tabela `historygames`
--

DROP TABLE IF EXISTS `historygames`;
CREATE TABLE IF NOT EXISTS `historygames` (
  `idHistoryGame` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `GameState` tinyint(4) NOT NULL COMMENT '1-Win\n0-Lose',
  PRIMARY KEY (`idHistoryGame`,`idUser`),
  KEY `fk_HistoryGames_Users1_idx` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `idRole` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  PRIMARY KEY (`idRole`),
  UNIQUE KEY `idRole_UNIQUE` (`idRole`),
  UNIQUE KEY `Name_UNIQUE` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Activeted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1- Acount active\n0- Acount desactiveted',
  `Roles_idRole` int(11) NOT NULL,
  PRIMARY KEY (`idUser`,`Roles_idRole`),
  UNIQUE KEY `Username_UNIQUE` (`Username`),
  UNIQUE KEY `Email_UNIQUE` (`Email`),
  UNIQUE KEY `idUser_UNIQUE` (`idUser`),
  KEY `fk_Users_Roles_idx` (`Roles_idRole`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `historygames`
--
ALTER TABLE `historygames`
  ADD CONSTRAINT `fk_HistoryGames_Users1` FOREIGN KEY (`idUser`) REFERENCES `mydb`.`users` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_Users_Roles` FOREIGN KEY (`Roles_idRole`) REFERENCES `mydb`.`roles` (`idRole`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
