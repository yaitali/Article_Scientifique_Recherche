

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";




CREATE TABLE IF NOT EXISTS `arobases` (
  `idArobase` int(11) NOT NULL AUTO_INCREMENT,
  `Apseudonyme` varchar(21) NOT NULL,
  PRIMARY KEY (`idArobase`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `contenua` (
  `idMsg` int(11) NOT NULL,
  `idArobase` int(11) NOT NULL,
  PRIMARY KEY (`idMsg`,`idArobase`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `contenuh` (
  `idMsg` int(11) NOT NULL,
  `idHashtag` int(11) NOT NULL,
  PRIMARY KEY (`idMsg`,`idHashtag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `hashtags` (
  `idHashtag` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(140) NOT NULL,
  PRIMARY KEY (`idHashtag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `retouites` (
  `idMsgRet` int(11) NOT NULL,
  `idMsgSource` int(11) NOT NULL,
  PRIMARY KEY (`idMsgRet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `suivre` (
  `idDemandeur` int(11) NOT NULL,
  `idReceveur` int(11) NOT NULL,
  `demande` varchar(7) NOT NULL,
  PRIMARY KEY (`idDemandeur`,`idReceveur`),
  KEY `idReceveur` (`idReceveur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suivre`
--

INSERT INTO `suivre` (`idDemandeur`, `idReceveur`, `demande`) VALUES
(1, 13, 'A');



CREATE TABLE IF NOT EXISTS `touites` (
  `idMsg` int(11) NOT NULL AUTO_INCREMENT,
  `laDate` datetime NOT NULL,
  `texte` varchar(140) NOT NULL,
  PRIMARY KEY (`idMsg`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;



CREATE TABLE IF NOT EXISTS `touitesnormaux` (
  `idMsg` int(11) NOT NULL,
  PRIMARY KEY (`idMsg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `touitesprives` (
  `idMsg` int(11) NOT NULL AUTO_INCREMENT,
  `idAuteur` int(11) NOT NULL,
  `idReceveur` int(11) NOT NULL,
  `idMsgSource` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMsg`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;



INSERT INTO `touitesprives` (`idMsg`, `idAuteur`, `idReceveur`, `idMsgSource`) VALUES
(3, 13, 1, NULL),
(4, 13, 1, NULL),
(5, 1, 1, NULL),
(6, 13, 1, NULL),
(7, 13, 1, NULL),
(8, 13, 1, NULL),
(9, 13, 1, NULL),
(10, 1, 13, NULL);


CREATE TABLE IF NOT EXISTS `touitespublics` (
  `idMsg` int(11) NOT NULL,
  `idAuteur` int(11) NOT NULL,
  PRIMARY KEY (`idMsg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `touitesreponses` (
  `idMsgRep` int(11) NOT NULL,
  `idMsgSource` int(11) NOT NULL,
  PRIMARY KEY (`idMsgRep`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `touitos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudonyme` varchar(90) NOT NULL,
  `email` varchar(90) NOT NULL,
  `motPasse` varchar(300) NOT NULL,
  `photo` varchar(500) DEFAULT NULL,
  `statut` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudonyme` (`pseudonyme`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;





ALTER TABLE `suivre`
  ADD CONSTRAINT `suivre_ibfk_1` FOREIGN KEY (`idDemandeur`) REFERENCES `touitos` (`id`),
  ADD CONSTRAINT `suivre_ibfk_2` FOREIGN KEY (`idReceveur`) REFERENCES `touitos` (`id`);

