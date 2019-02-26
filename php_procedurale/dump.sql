-- MySQL dump 10.13  Distrib 8.0.12, for osx10.13 (x86_64)
--
-- Host: localhost    Database: OCPHP
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (1,'diogo','Je suis revenu de loin!','2019-02-03 01:56:42'),(2,'lamine','C\'est vrai! Il fallait etre bien parer!','2019-02-03 01:56:42'),(3,'Elhadj','Moi je suis maintenant dans une autre phase de la vie.','2019-02-03 01:56:42'),(4,'aicho','Je voudrais faire des trucs nouveaux, être libre et indépendante!','2019-02-03 01:56:42'),(6,'jean','Nous voulons vous servir un grand travail!','2019-02-03 01:56:42'),(7,'Ali','tout va bien maintenant..','2019-02-03 19:53:11'),(8,'Marc','ON se voit quand pour finir notre projet?','2019-02-05 10:36:33'),(9,'John','Tu es la?','2019-02-05 10:59:07'),(10,'m@teo21','Tu peux realiser ton TP minichat sur une seule page, comme dans les ameliorations','2019-02-05 11:07:49'),(11,'Franck','Tu viens de deplacer la page du chat?','2019-02-24 15:35:41');
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) DEFAULT NULL,
  `author` varchar(150) NOT NULL,
  `comment` text NOT NULL,
  `valid` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,11,'Diogo DIALLO','EH oui c\'est framework est merveilleux. Je l\'utilise dans tous mes projets.        ',1,'2019-02-18 02:05:21');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `object` varchar(100) NOT NULL,
  `recipient` enum('Secretaire','Developpeur','Administrateur') DEFAULT 'Secretaire',
  `message` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'salioudiallo28@yahoo.fr','DIALLO','Diogo','Gestion de projet','Secretaire','               Nous devons faire un ultime teste pour verifier notre script d\'envoi d\'email. Accrochez-vous donc!                             ','2019-02-10 18:53:14'),(2,'hadia@gmail.com','barry','Hadia','Connaissance',NULL,' Je suis venu te dire que je veux faire une connaissance avec toi et savoir si y\'a moins de se voir apr&egrave;s.                     ','2019-02-10 19:10:26'),(3,'hadia@gmail.com','barry','Hadia','Connaissance','Secretaire',' Je suis venu te dire que je veux faire une connaissance avec toi et savoir si y\'a moins de se voir apr&egrave;s.                     ','2019-02-10 19:14:44'),(4,'hadia@gmail.com','diallo','Hadiatou','Connaissance','Administrateur',' Je suis venu te dire que je veux faire une connaissance avec toi et savoir si y\'a moins de se voir apr&egrave;s.                     ','2019-02-10 19:15:32'),(5,'salioudiogo@gmail.com','DIALLO','Diogo','Gestion de projet','Secretaire','            Bonjour, je suis entrain de faire un petit teste de mon application de contact client.\r\nON y va?                                    ','2019-02-25 00:42:39'),(6,'franck@yahoo.com','doe','Franck','Verification','Secretaire','Bonjour DIALLO,\r\nJe viens pour faire une v&eacute;rification sur l\'avanc&eacute;e du projet que je t\'ai confi&eacute;.                                             ','2019-02-25 01:53:11');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `photos` varchar(255) DEFAULT 'https://via.placeholder.com/300.png/09f/fff',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (9,1,'Tableaux PHP','Une bonne maitrise de ce langage est encore très lie a une bonne maitrise des tableaux; sachant que nous ne pouvons pas le réussir sans une bonne connaissance des boucles.','3-article-image-1.jpg','2019-02-17 22:45:32','2019-02-17 22:45:32'),(10,1,'Nouveautés de PHP 7','PHP est un langage de programmation qui est en perpétuel évolution. Malgré les critiques qu\'à subit ce langage, il ne fait qu\'avancer du jour en jour et ce classe bien parmi les 10 premiers langages de programmation les plus utilisés. Avec php 7 nous avons eu un raccourcis d\'utilisation des ternaires (ex : <?= $value ?? \'default\'; ?>) et ici nous avons aussi utilisé le short code (<?php echo $machin; ?>). En plus maintenant on peut typé les fonctions et paramètres. Tant d\'autres...','8-php.jpeg','2019-02-18 00:45:38','2019-02-18 00:45:38'),(11,1,'Bootstrap 5 bientôt','Oui, vous avez bien lu; bientôt une nouvelle version du framework css bootstrap de twitter verra le jour. En ce moment nous sommes à la version 4 qui est toujours fortement dépendante de la bibliothèque jquery; et cet état de fait sera bientôt retirer afin que bootstrap ne dépende plus que de javascript natif. \r\nUn ouf de soulagement pour les développeurs qui trouvait que la bibliothèque jquery consommait beaucoup de bande passante. Nous attendons la sortie de cette version. \r\nINFO : ceux qui veulent toujours utilisé jquery le pourrons avec bootstrap mais en ajoutant une extension.','9-bootstrap.jpeg','2019-02-18 00:52:41','2019-02-18 00:52:41'),(12,1,'Html5 évolue','Le langage de balisage indispensable au développement des sites web continu son envolé. Il est a la version 5.3 et bientôt la 5.4 voir la 6 qui pourra encore beaucoup enthousiasmé les intégrateur-trice du web. Car c\'est les intégrateur-trice qui s\'occupent de la partie visible de l\'ice berg. Et ce langage  fait des exploit dans ce domaine. Bonne continuation!','1-html5.png','2019-02-18 00:59:39','2019-02-18 00:59:39'),(13,3,'SGBDR MYSQL','    Comment parler d\'un outil de programmation dynamique comme le PHP, sans parler des outils de gestion de base de données? Je dirais que la réponse peut être oui c\'est possible mais pour une bonne persistance des données les bases de données sont les plus adaptées.\r\nDans ce blog nous parlerons du SGBDR Mysql qui est très adapté au PHP et d\'autres langages de programmation (même si les autres SGBDR ne sont pas mal aussi), mais j\'ai décidé ici de parler globalement que de MYSQL; et si y\'a lieu de le signaler je l\'indiquerais pour les autres SGBDR.       ','4-mysql.png','2019-02-23 01:25:53','2019-02-23 01:25:53'),(14,2,'CSS#','Voici le grand complément du Html5, il se nomme (vous pouvez le deviné) c\'est ... CSS3.\r\n\r\nEt oui, c\'est lui qui est chargé d\'embellir nos pages web et les rendrent attractifs. La seule limite serait votre imagination. \r\n\r\nAvec cette version et les améliorations qui sont là, on peut réaliser pas mal de chose qu\'on en pouvait faire qu\'avec du javascript. Alors tenez-vous bien, on peut faire des animations avec CSS3. Je ne dis pas que javascript n\'est pas intéressant, mais le css aujourd\'hui nous offre plein de possibilité. Du coup, pour faire une veille technologique nous parlerons á chaque fois des nouveautés qu\'il y\'a á découvrir ainsi que d\'autres possibilités de ce langage.','6-css3.jpeg','2019-02-23 02:57:39','2019-02-23 02:57:39');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` enum('member','moderator','admin') DEFAULT 'member',
  `level` enum('1','2','3') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'member','1'),(2,'moderator','2'),(3,'admin','3');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_infos`
--

DROP TABLE IF EXISTS `user_infos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user_infos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(150) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `gender` varchar(15) DEFAULT 'Homme',
  `biography` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_infos`
--

LOCK TABLES `user_infos` WRITE;
/*!40000 ALTER TABLE `user_infos` DISABLE KEYS */;
INSERT INTO `user_infos` VALUES (1,'DIALLO','Oury','Homme','Je suis le petit bébé de mon tonton chéri, qui l\'aide a tester ses applications.                                                                            ','2019-02-21 01:51:39','2019-02-21 01:51:39'),(2,' DOE','Jean','Homme','Je suis un étudiant en psychologie et grand passionné du développement web.                                                                            ','2019-02-21 01:53:01','2019-02-21 01:53:01'),(3,'DIALLO','Diogo','Homme','Je suis un autodidacte ayant une double compétence, auto-entrepreneur  et un grand amoureux du développement en général et du PHP en particulier.                                                                             ','2019-02-21 01:53:31','2019-02-21 01:53:31'),(4,'ELMAHRAB','Zenab','Femme','Je suis une fille inventée de toute pièce pour faire du teste sur cette application.                                                                            ','2019-02-22 22:56:34','2019-02-22 22:56:34');
/*!40000 ALTER TABLE `user_infos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roles_id` int(11) DEFAULT '1',
  `ui_id` int(11) DEFAULT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('on','off') DEFAULT 'off',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(100) DEFAULT '127.0.0.2',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,NULL,'oury','oury@gmail.com','$2y$12$cEiVezPLMTlZY9ZCtcDupeKaEuqriC772f9SxW11qulb7TZ1ubkQa','off','2019-02-21 01:19:33','2019-02-21 01:19:33','::1'),(2,NULL,NULL,'jean','jean.dupond@hotmail.fr','$2y$12$RpEpl/ejt9KGWqa71YvSaeLPGv.LZD.0qD3sQm4wQul9i9xNqRCFC','off','2019-02-21 01:22:07','2019-02-21 01:22:07','::1'),(3,NULL,NULL,'diogodiallo','salioudiogo@gmail.com','$2y$12$GL.79DdSh48JToZ1dV8PMupIcR1bQ1mEf0NAIeN9eX7.2bZYHjML6','off','2019-02-21 01:24:05','2019-02-21 01:24:05','::1'),(4,NULL,NULL,'zee','zee@yahoo.com','$2y$12$DdbRxHfBASWAVPzwPmuOme1.R3BHVm3LjiJdhiobrKdUhWHv2bAua','off','2019-02-21 01:55:27','2019-02-21 01:55:27','::1');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-25 20:31:59
