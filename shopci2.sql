-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2017 at 01:37 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopci2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `images` varchar(255) NOT NULL DEFAULT '10563385_813421452024692_2079232178_n_(2)20.jpg',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_description` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `category_description`, `category_image`, `created`, `date`) VALUES
(25, 'Quan', '', '', '2017-02-18 15:19:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customers_details`
--

CREATE TABLE `customers_details` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(80) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `general`
--

CREATE TABLE `general` (
  `key` varchar(50) NOT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `general`
--

INSERT INTO `general` (`key`, `value`) VALUES
('about', ''),
('address', ''),
('currency', 'VND'),
('delivery', ''),
('email', 'Email'),
('lat', ''),
('link_facebook', ''),
('link_google', ''),
('link_linkedin', ''),
('logo_file', ''),
('logo_text', 'thoi trang'),
('long', ''),
('mobile', ''),
('telephone', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(250) NOT NULL,
  `date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_array` text,
  `processed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `date`, `user_id`, `order_array`, `processed`) VALUES
(35, '', NULL, NULL, 'a:9:{s:8:"products";a:1:{i:0;a:4:{s:2:"id";i:80;s:4:"name";s:8:"Quan tay";s:8:"quantity";s:1:"1";s:5:"total";i:100;}}s:6:"prefer";a:1:{s:5:"email";s:5:"Email";}s:4:"name";s:4:"fsdf";s:5:"email";s:13:"dfd@gmail.com";s:9:"telephone";s:8:"53535354";s:7:"address";s:7:"fsdfsdf";s:7:"message";s:7:"sdfsadf";s:7:"content";s:191:"Comanda de pe site de le fsdf\nEmail: dfd@gmail.com\nTelefon: 53535354\nAdresa: fsdfsdf\n\nMesaj: sdfsadf\n\nPrefera sa fie contactat prin: Email\n\n\nComanda: \n\nQuan tay x 1 = 100 Lei \n\nTotal: 100 Lei";s:5:"total";i:100;}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `orderid` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `order` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`, `order`, `date`) VALUES
(1, 'page 1', 'asfsadfsdfsdf\r\nsd\r\nf\r\nsd\r\nf\r\nsd\r\nf\r\nsf\r\nsd', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(20) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `category` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `product_currency` varchar(255) NOT NULL,
  `merchant_email` varchar(255) NOT NULL,
  `product_description` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `image` varchar(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `views` int(11) DEFAULT NULL,
  `description` text,
  `active` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `subcategory_id`, `user_id`, `price`, `product_currency`, `merchant_email`, `product_description`, `image`, `payment_mode`, `created`, `views`, `description`, `active`, `date`) VALUES
(80, 'Quan tay', 25, 0, 0, 100, '', '', '', '660148-bo-2-quan-ao-tre-em-lullaby-trang-xanh-2292-207449-1-product.jpg', '', '2017-02-18 12:02:44', NULL, 'Quan tay cho be', 1, NULL),
(81, 'Quan 1', 25, 0, 0, 20, '', '', '', 'df0148-bo-quan-ao-carters-coc-tay-in-hinh-ca-voi-cuc-doc-danh-cho-be-trai-12-thang-tuoi.jpg', '', '2017-02-18 14:47:45', NULL, 'quan 1description', 1, '0000-00-00'),
(82, 'Quan 2', 25, 0, 0, 25, '', '', '', '532148-bo-quan-ao-dai-tay-carte-1.jpg', '', '2017-02-18 14:48:48', NULL, '', 1, '0000-00-00'),
(83, 'Quan 3', 25, 0, 0, 35, '', '', '', 'a20148-bo-quan-ao-tre-em-thai-theu-ngua-tt3-111028-2_1.jpg', '', '2017-02-18 14:50:31', NULL, '', 1, '0000-00-00'),
(84, 'Quan 4', 25, 0, 0, 22, '', '', '', 'f43148-14098_quan_ao_so_sinh.jpg', '', '2017-02-18 14:51:30', 1, '', 1, '2017-02-18');

-- --------------------------------------------------------

--
-- Table structure for table `searches`
--

CREATE TABLE `searches` (
  `search_id` int(11) NOT NULL,
  `search_content` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id_subscriptions` int(11) NOT NULL,
  `mails` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `category_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `ip` varchar(15) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `created`, `admin`, `name`, `telephone`, `address`, `ip`, `date`) VALUES
(11, 'ntnt', 'ntnt', 'admin', 'admin@gmail.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '2017-02-18 11:39:41', 1, '', NULL, NULL, '', NULL),
(12, '', '', '', 'vv@gmail.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '2017-02-18 15:38:41', 0, 'vv', '44546', '464', '127.0.0.1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `product_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `username` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers_details`
--
ALTER TABLE `customers_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general`
--
ALTER TABLE `general`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `searches`
--
ALTER TABLE `searches`
  ADD PRIMARY KEY (`search_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id_subscriptions`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `customers_details`
--
ALTER TABLE `customers_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `searches`
--
ALTER TABLE `searches`
  MODIFY `search_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id_subscriptions` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `products`
  ADD COLUMN `short_description` varchar(255) NOT NULL;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
