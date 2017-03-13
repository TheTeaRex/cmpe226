-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 09, 2017 at 09:33 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acid`
--

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `first` varchar(20) NOT NULL,
  `last` varchar(20) NOT NULL,
  `gender` char(1) NOT NULL,
  `age` int(11) NOT NULL,
  `city_born` varchar(20) NOT NULL,
  `salary` float NOT NULL,
  `email` varchar(50) NOT NULL,
  `college` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `first`, `last`, `gender`, `age`, `city_born`, `salary`, `email`, `college`) VALUES
(1, 'John', 'Adams', 'M', 29, 'Livermore', 120000, 'john.adams@sjsu.edu', 'College of Applied  Sciences and Arts'),
(3, 'Hayley', 'Harrington', 'F', 42, 'l''Ecluse', 188869, 'hharrington@gmail.com', 'Charles W. Davidson College of Engineering'),
(4, 'Noelle', 'Castro', 'F', 47, 'Utrecht', 85141, 'noelle.castro@hotmail.com', 'College of Humanities and the Arts'),
(5, 'Madeson', 'Snider', 'M', 19, 'Ketchikan', 106838, 'madeson.j.snider@yahoo.com', 'College of Social Sciences'),
(6, 'Elaine', 'Bishop', 'F', 32, 'Santa Marina', 155221, 'ebishop@aol.com', 'College of Humanities and the Arts'),
(7, 'Joshua', 'Craft', 'M', 30, 'Hornsea', 155204, 'joshua@gmail.com', 'College of Social Sciences'),
(8, 'Lavinia', 'Vasquez', 'F', 42, 'Ichalkaranji', 73551, 'lv@hotmail.com', 'College of Applied  Sciences and Arts'),
(9, 'Amaya', 'Hawkins', 'F', 33, 'Exeter', 190168, 'ama.hawkins@outlook.com', 'College of Applied  Sciences and Arts'),
(10, 'Ferdinand', 'Hoffman', 'M', 31, 'Corswarem', 62549, 'ferdinand@gmail.com', 'Connie L. Lurie College of Education'),
(11, 'Avye', 'Molina', 'F', 43, 'Treguaco', 123235, 'avye@yahoo.com', 'Charles W. Davidson College of Engineering'),
(12, 'Sydney', 'Miles', 'F', 19, 'Calco', 135934, 'sydneym@gmail.com', 'College of International and Extended Studies'),
(13, 'Brett', 'Travis', 'M', 39, 'Kiel', 137724, 'brett.travis@yahoo.com', 'Charles W. Davidson College of Engineering'),
(14, 'Ethan', 'Hull', 'M', 34, 'Chiusanico', 151537, 'ethan@hotmail.com', 'College of International and Extended Studies'),
(15, 'Kaden', 'Moon', 'M', 23, 'Vitrival', 79470, 'kaden@microsoft.com', 'Connie L. Lurie College of Education'),
(16, 'Cynthia', 'Klein', 'F', 18, 'Springfield', 133313, 'cynthia.klein@sjsu.edu', 'College of Science'),
(17, 'Maite', 'Molina', 'F', 29, 'Westport', 63324, 'maite.molina@facebook.com', 'College of Science'),
(18, 'Thane', 'Estes', 'M', 28, 'Bischofshofen', 151253, 'te@outlook.com', 'College of Social Sciences'),
(19, 'Adrienne', 'Barnes', 'F', 29, 'Nieuwenrode', 77002, 'adrienne.barnes@sjsu.edu', 'Lucas College and Graduate School of Business'),
(20, 'Marvin', 'Lindsay', 'M', 47, 'Cranbrook', 79496, 'mlindsay@gmail.com', 'College of Applied  Sciences and Arts'),
(21, 'Ifeoma', 'Hurst', 'F', 46, 'Daknam', 182322, 'hurst@yahoo.com', 'College of Applied  Sciences and Arts'),
(22, 'Anjolie', 'Hall', 'F', 39, 'Tocopilla', 158191, 'ahall@yahoo.com', 'Lucas College and Graduate School of Business'),
(23, 'John', 'Smith', 'M', 24, 'San Jose', 100000, 'john.smith@sjsu.edu', 'Charles W. Davidson College of Engineering');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
