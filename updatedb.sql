
CREATE TABLE `product_images` (
  `product` int(11) NOT NULL,
  `i_order` int(5) NOT NULL,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`product`,`i_order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `product_detail` (
  `product` int(11) NOT NULL,
  `color` varchar(20) NOT NULL,
  `size` varchar(10) NOT NULL,
  `quantity` int(5) NOT NULL,
  PRIMARY KEY (`product`,`color`,`size`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `product_images`
  ADD COLUMN `color` varchar(20) DEFAULT NULL;


  CREATE TABLE `booking`(
  `id` int(11) NOT NULL AUTO_INCREMENT ,
  `user_id` int(11) NOT NULL,
  `payment` float DEFAULT 0,
  `quantity` int(5) NOT NULL,
  `status` int(1) NOT NULL,
  `total` float NOT NULL,
  `message` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `updated` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `booking_detail`(
  `id` int(11) NOT NULL AUTO_INCREMENT ,
  `bkId` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `color` varchar(20) NOT NULL,
  `size` varchar(10) NOT NULL,
  `quantity` int(5) NOT NULL,
  `price` float NOT NULL,
  `discount` float DEFAULT 0,
  `total_discount` float DEFAULT 0,
  `total` float NOT NULL,
  `status` int(1) NOT NULL,
  `updated` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `traveller`(
  `id` int(11) NOT NULL AUTO_INCREMENT ,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin,
  `email` varchar(100),
  `phone` varchar(20),
  `address` varchar(255),
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;