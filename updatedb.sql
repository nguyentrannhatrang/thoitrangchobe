
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