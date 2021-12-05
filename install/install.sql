/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `closure`;
CREATE TABLE IF NOT EXISTS `closure` (
  `node_id` int(10) unsigned NOT NULL DEFAULT 0,
  `node_depth` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`node_id`,`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `closure` DISABLE KEYS */;
INSERT INTO `closure` (`node_id`, `node_depth`, `parent_id`) VALUES
	(1, 0, 1),
	(2, 1, 1),
	(2, 1, 2),
	(3, 1, 1),
	(3, 1, 3),
	(4, 1, 1),
	(4, 1, 4),
	(5, 2, 1),
	(5, 2, 3),
	(5, 2, 5),
	(6, 2, 1),
	(6, 2, 3),
	(6, 2, 6),
	(7, 2, 1),
	(7, 2, 3),
	(7, 2, 7),
	(8, 3, 1),
	(8, 3, 3),
	(8, 3, 5),
	(8, 3, 8),
	(9, 4, 1),
	(9, 4, 3),
	(9, 4, 5),
	(9, 4, 8),
	(9, 4, 9),
	(10, 4, 1),
	(10, 4, 3),
	(10, 4, 5),
	(10, 4, 8),
	(10, 4, 10),
	(11, 5, 1),
	(11, 5, 3),
	(11, 5, 5),
	(11, 5, 8),
	(11, 5, 9),
	(11, 5, 11),
	(12, 5, 1),
	(12, 5, 3),
	(12, 5, 5),
	(12, 5, 8),
	(12, 5, 9),
	(12, 5, 12),
	(13, 5, 1),
	(13, 5, 3),
	(13, 5, 5),
	(13, 5, 8),
	(13, 5, 9),
	(13, 5, 13);
/*!40000 ALTER TABLE `closure` ENABLE KEYS */;

DROP TABLE IF EXISTS `nodes`;
CREATE TABLE IF NOT EXISTS `nodes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `nodes` DISABLE KEYS */;
INSERT INTO `nodes` (`id`, `parent`, `name`) VALUES
	(1, 0, 'Главная'),
	(2, 0, 'О компании'),
	(3, 0, 'Продукция'),
	(4, 0, 'Контакты'),
	(5, 3, 'Мыло'),
	(6, 3, 'Скраб'),
	(7, 3, 'Свечи'),
	(8, 5, 'Крафтовое'),
	(9, 8, 'Лечебное'),
	(10, 8, 'Уходовое'),
	(11, 9, 'Для сухой кожи'),
	(12, 9, 'Для жирной кожи'),
	(13, 9, 'Для нормальной кожи');
/*!40000 ALTER TABLE `nodes` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
