-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 31, 2016 at 03:05 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shmyde`
--

-- --------------------------------------------------------

--
-- Table structure for table `shmyde_design_main_menu`
--

CREATE TABLE `shmyde_design_main_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shmyde_design_main_menu`
--

INSERT INTO `shmyde_design_main_menu` (`id`, `name`) VALUES
(1, 'Style');

-- --------------------------------------------------------

--
-- Table structure for table `shmyde_design_option`
--

CREATE TABLE `shmyde_design_option` (
  `id` int(11) NOT NULL,
  `shmyde_design_sub_menu_id` int(11) DEFAULT NULL COMMENT 'This represents the specific design option to which this value is linked',
  `type` int(11) DEFAULT NULL COMMENT 'This represents an int value that determines what type of value this is. e.g. visual, checkbox etc. ',
  `name` varchar(45) DEFAULT NULL COMMENT 'This represents an optional name associated with this value. ',
  `price` decimal(10,0) DEFAULT '0' COMMENT 'This is an additional price required to add this attribute to a design. ',
  `description` longtext COMMENT 'A short description of the attribute to be displayed on the application. '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shmyde_design_sub_menu`
--

CREATE TABLE `shmyde_design_sub_menu` (
  `id` int(11) NOT NULL,
  `shmyde_design_main_menu_id` int(11) DEFAULT NULL,
  `shmyde_product_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT 'This represents the type of this specific option. Generally there will be two types. 0 for visual type with images and 1 for measurements. '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shmyde_design_sub_menu`
--

INSERT INTO `shmyde_design_sub_menu` (`id`, `shmyde_design_main_menu_id`, `shmyde_product_id`, `name`, `type`) VALUES
(1, 1, 4, 'Collar', NULL),
(3, 1, 1, 'Collars', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shmyde_images`
--

CREATE TABLE `shmyde_images` (
  `id` int(11) NOT NULL,
  `name` longtext,
  `shmyde_design_options_id` int(11) DEFAULT NULL,
  `z_index` int(11) DEFAULT NULL,
  `values` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shmyde_measurment`
--

CREATE TABLE `shmyde_measurment` (
  `id` int(11) NOT NULL,
  `shmyde_product_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shmyde_product`
--

CREATE TABLE `shmyde_product` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL COMMENT 'The name of the product. e.g. shirt, suit etc',
  `target` int(11) DEFAULT NULL COMMENT 'This represents the target of this product. '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shmyde_product`
--

INSERT INTO `shmyde_product` (`id`, `name`, `target`) VALUES
(1, 'Jeans', 2),
(3, 'Shirt', 0),
(4, 'Shirt', 2);

-- --------------------------------------------------------

--
-- Table structure for table `shmyde_product_image`
--

CREATE TABLE `shmyde_product_image` (
  `id` int(11) NOT NULL,
  `shmyde_product_id` int(11) DEFAULT NULL,
  `name` longtext,
  `view_type` int(11) NOT NULL COMMENT '0 for back and 1 for front',
  `z_index` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shmyde_product_image`
--

INSERT INTO `shmyde_product_image` (`id`, `shmyde_product_id`, `name`, `view_type`, `z_index`) VALUES
(1, 1, 'Jeans_front_view.png', 1, NULL),
(2, 1, 'Jeans_back_view.png', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shmyde_template_measurment`
--

CREATE TABLE `shmyde_template_measurment` (
  `id` int(11) NOT NULL,
  `shmyde_template_id` int(11) DEFAULT NULL,
  `shmyde_measurment_id` int(11) DEFAULT NULL,
  `value` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shmyde_user`
--

CREATE TABLE `shmyde_user` (
  `id` int(11) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shyme_template`
--

CREATE TABLE `shyme_template` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `shmyde_user_id` int(11) DEFAULT NULL,
  `shmyde_product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shmyde_design_main_menu`
--
ALTER TABLE `shmyde_design_main_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shmyde_design_option`
--
ALTER TABLE `shmyde_design_option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shmyde_design_option_specifics_fk_idx` (`shmyde_design_sub_menu_id`);

--
-- Indexes for table `shmyde_design_sub_menu`
--
ALTER TABLE `shmyde_design_sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shmyde_design_option_fk_idx` (`shmyde_design_main_menu_id`),
  ADD KEY `shmyde_product_id_idx` (`shmyde_product_id`);

--
-- Indexes for table `shmyde_images`
--
ALTER TABLE `shmyde_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shmyde_design_options_fk_idx` (`shmyde_design_options_id`);

--
-- Indexes for table `shmyde_measurment`
--
ALTER TABLE `shmyde_measurment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shmyde_product_fk_idx` (`shmyde_product_id`);

--
-- Indexes for table `shmyde_product`
--
ALTER TABLE `shmyde_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shmyde_product_image`
--
ALTER TABLE `shmyde_product_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shmyde_product_fk_idx` (`shmyde_product_id`);

--
-- Indexes for table `shmyde_template_measurment`
--
ALTER TABLE `shmyde_template_measurment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shmyde_template_fk_idx` (`shmyde_template_id`),
  ADD KEY `shmyde_measurment_fk_idx` (`shmyde_measurment_id`);

--
-- Indexes for table `shmyde_user`
--
ALTER TABLE `shmyde_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shyme_template`
--
ALTER TABLE `shyme_template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shmyde_measurment_product_fk_idx` (`shmyde_product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shmyde_design_main_menu`
--
ALTER TABLE `shmyde_design_main_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shmyde_design_sub_menu`
--
ALTER TABLE `shmyde_design_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `shmyde_images`
--
ALTER TABLE `shmyde_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shmyde_product_image`
--
ALTER TABLE `shmyde_product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `shmyde_user`
--
ALTER TABLE `shmyde_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `shmyde_design_option`
--
ALTER TABLE `shmyde_design_option`
  ADD CONSTRAINT `shmyde_design_option_specifics_fk` FOREIGN KEY (`shmyde_design_sub_menu_id`) REFERENCES `shmyde_design_sub_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shmyde_design_sub_menu`
--
ALTER TABLE `shmyde_design_sub_menu`
  ADD CONSTRAINT `shmyde_design_option_fk` FOREIGN KEY (`shmyde_design_main_menu_id`) REFERENCES `shmyde_design_main_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shmyde_product_id` FOREIGN KEY (`shmyde_product_id`) REFERENCES `shmyde_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shmyde_images`
--
ALTER TABLE `shmyde_images`
  ADD CONSTRAINT `shmyde_design_options_fk` FOREIGN KEY (`shmyde_design_options_id`) REFERENCES `shmyde_design_option` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shmyde_measurment`
--
ALTER TABLE `shmyde_measurment`
  ADD CONSTRAINT `shmyde_product_fk` FOREIGN KEY (`shmyde_product_id`) REFERENCES `shmyde_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shmyde_product_image`
--
ALTER TABLE `shmyde_product_image`
  ADD CONSTRAINT `shmyde_product_image_fk` FOREIGN KEY (`shmyde_product_id`) REFERENCES `shmyde_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shmyde_template_measurment`
--
ALTER TABLE `shmyde_template_measurment`
  ADD CONSTRAINT `shmyde_measurment_fk` FOREIGN KEY (`shmyde_measurment_id`) REFERENCES `shmyde_measurment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shmyde_template_fk` FOREIGN KEY (`shmyde_template_id`) REFERENCES `shyme_template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shyme_template`
--
ALTER TABLE `shyme_template`
  ADD CONSTRAINT `shmyde_measurment_product_fk` FOREIGN KEY (`shmyde_product_id`) REFERENCES `shmyde_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
