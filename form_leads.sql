-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 09, 2020 at 02:12 PM
-- Server version: 5.7.25-0ubuntu0.16.04.2-log
-- PHP Version: 7.0.33-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contact_leads`
--

-- --------------------------------------------------------

--
-- Table structure for table `solsberry_lp_leads`
--

CREATE TABLE `solsberry_lp_leads` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `country_code` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `message` varchar(200) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `form_name` varchar(100) NOT NULL,
  `utm_source` varchar(100) NOT NULL,
  `utm_medium` varchar(100) NOT NULL,
  `utm_term` varchar(100) NOT NULL,
  `utm_content` varchar(100) NOT NULL,
  `utm_campaign` varchar(100) NOT NULL,
  `page_url` text NOT NULL,
  `ip_address` text NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `solsberry_lp_leads`
--
--
-- Indexes for dumped tables
--

--
-- Indexes for table `solsberry_lp_leads`
--
ALTER TABLE `solsberry_lp_leads`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `solsberry_lp_leads`
--
ALTER TABLE `solsberry_lp_leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
