DROP TABLE IF EXISTS `crud`;
CREATE TABLE `crud` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prodname` varchar(100) NOT NULL,
  `un` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `ed` date DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `file` longblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
