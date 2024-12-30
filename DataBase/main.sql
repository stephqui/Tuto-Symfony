-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 30, 2024 at 08:39 AM
-- Server version: 8.0.36
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `main`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(60) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(15, 'Plat chaud', 'Plat-chaud', '1996-02-14 07:35:22', '1988-09-10 03:40:51'),
(16, 'Dessert', 'Dessert', '2016-07-02 11:34:41', '1977-07-30 00:18:49'),
(17, 'Entrrée', 'Entrree', '1990-10-27 06:25:54', '1990-07-25 05:22:00'),
(18, 'Gouter', 'Gouter', '2023-07-20 04:18:56', '2014-11-23 05:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20241216130906', '2024-12-16 13:15:54', 33),
('DoctrineMigrations\\Version20241220093524', '2024-12-20 09:38:03', 233);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `id` int NOT NULL,
  `title` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `duration` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`id`, `title`, `slug`, `content`, `created_at`, `updated_at`, `duration`, `category_id`, `thumbnail`, `user_id`) VALUES
(131, 'Tartiflette', 'Tartiflette', 'Cumque laboriosam omnis error voluptates quidem et quia. Ipsum consectetur autem aut tempore et dolores error incidunt. Velit voluptatum illo et minus. Sit eligendi quia accusantium porro.\n\nMaxime tempore cumque veritatis nemo laborum eaque. Quos tempora possimus sed blanditiis magnam culpa aspernatur voluptas. Sint explicabo est explicabo minima et voluptatem.\n\nCulpa ab harum deserunt et explicabo. Perferendis incidunt explicabo quam quo minima soluta. Qui quia sed cum a fugiat.\n\nCorrupti cupiditate quidem facilis soluta minus aliquam. Quo tempore rem et a. Qui doloremque placeat possimus eum ut quis porro.\n\nRatione quaerat veritatis error at rerum neque distinctio. Sed perspiciatis occaecati omnis quia earum ducimus aspernatur sint. Voluptas expedita cumque rem ipsam atque. Quo occaecati natus ut inventore error commodi quod est.\n\nMaxime dolorum nemo aut error ad. Voluptas possimus ut minus autem optio aut. Laudantium ipsam laudantium aspernatur. Cumque et est et dignissimos.\n\nAutem laborum sapiente accusantium omnis est nostrum culpa. Ea omnis et error autem. Dolor iure aut deserunt cum autem consequatur.\n\nConsectetur dolores omnis ab explicabo. Voluptatem qui doloribus voluptas ea et saepe labore. Autem et facere mollitia enim praesentium qui sed.\n\nEt qui consequatur ut nihil quos officiis. Voluptatum ea maxime consequatur sequi fugiat consequatur consequuntur totam. Explicabo ducimus quidem provident ut aut odio natus. Id et voluptatem eaque nisi voluptatem fuga. Alias aperiam molestiae qui.\n\nVoluptatem rerum ut odit id voluptatem reprehenderit. Ut ab accusantium nisi laboriosam. Iure error a minima.', '1989-04-23 01:51:26', '1999-10-10 08:54:45', 40, 16, NULL, 54),
(132, 'Pates', 'Pates', 'Sapiente suscipit enim esse perferendis sed officiis tempore. Aut non delectus corporis vero. Vero eum rerum laboriosam eum autem unde eum. Numquam nisi a in quisquam sed sed velit accusantium.\n\nEt repellat sint et placeat ut. Voluptas magni dolorum numquam non tenetur. Quo eaque rerum tempora deserunt.\n\nHarum ut accusantium et voluptatem sed eligendi. Nostrum eum est non ratione repudiandae delectus reiciendis. Tempore voluptate rem et beatae non quis perferendis provident. Ex velit consequatur beatae quo.\n\nEt mollitia omnis ut voluptas maxime. Voluptas ipsa voluptates et omnis molestiae dolorum quod et. Repudiandae recusandae repellendus enim dolorem et voluptas soluta aspernatur. Animi perspiciatis ad eligendi iure qui sit.\n\nLaudantium vel voluptatum necessitatibus. Aut pariatur non illum ullam deserunt ipsum neque quisquam. Pariatur at ut id sed ut dolorum.\n\nAliquam neque consectetur quia nulla id porro dolor. Eius quod possimus temporibus et ut libero. Dolor temporibus repudiandae harum earum qui. Culpa et quaerat blanditiis autem sequi provident.\n\nAut laboriosam sit et id. Blanditiis animi odio est qui laborum quod. Eum cum aut recusandae sint. Vel corporis perspiciatis suscipit asperiores unde.\n\nEnim et ipsum mollitia quaerat voluptate saepe. Laudantium et perferendis qui aut omnis veniam aliquam. Vitae similique facere quia aut.\n\nRepudiandae porro ut alias voluptas est accusantium nisi asperiores. Quibusdam iure non aspernatur. Occaecati enim et sed veniam non. Cumque et distinctio voluptates iusto aut.\n\nVoluptas aut voluptas dicta laudantium. Veritatis nam voluptate minima. Unde occaecati sunt officia.', '2020-04-13 20:45:59', '1990-08-07 04:20:58', 21, 17, NULL, 54),
(133, 'Pizza au fromage', 'Pizza-au-fromage', 'Similique eos doloremque ipsa. Odio eligendi et doloribus ut. Sint dolorem culpa qui omnis unde aut.\n\nEa voluptatibus dolorem iusto. Cupiditate voluptatem rerum repellendus in consequatur voluptas. Exercitationem et culpa voluptatum sed rerum. Ut numquam aut earum tempora fugit. Velit dicta doloribus consequatur repellat harum culpa.\n\nConsequuntur facilis veniam eos ab ut incidunt. Laborum magni quia dolores ut. Veniam voluptatem et cum nostrum odit rerum.\n\nIncidunt fugit mollitia delectus natus aliquid nisi. Aperiam qui iusto officia. Id et qui velit.\n\nQui cum facere debitis laboriosam. Neque ut quisquam est sit. Quo qui fugit ea cum rerum quam dicta voluptatem.\n\nFugiat qui occaecati rerum laboriosam incidunt impedit. Vel sequi tempore illo suscipit ipsam cum. Rem tempore ea libero quidem aut aspernatur vitae. Unde sapiente dolor atque similique.\n\nConsectetur molestiae ut libero fuga modi ipsam fugiat. Ducimus suscipit aliquid suscipit sint repellat rem laudantium. Temporibus et ut fugit dolor est inventore et. Maxime dolor amet quia ea laboriosam. Temporibus ducimus qui cum iste.\n\nQuas debitis laboriosam reprehenderit explicabo placeat sit. Laudantium asperiores sunt delectus distinctio quia neque. Doloribus enim temporibus repellat ut iusto ut impedit. Veniam reiciendis earum et quibusdam quia sint. Et omnis autem et non.\n\nConsequatur hic dolorum rem accusantium. Nulla voluptatem dignissimos qui autem debitis. Sint eveniet doloribus animi sit sed distinctio provident.\n\nAutem quidem vero eligendi placeat eveniet animi qui. Ratione omnis est a delectus. Fuga et et est eos. Exercitationem minima rem accusantium mollitia accusamus earum mollitia aut.', '2020-06-20 20:28:25', '2001-07-05 04:53:29', 12, 15, NULL, 57),
(134, 'Petit Cheeseburger', 'Petit-Cheeseburger', 'Aut maiores ex doloremque illo necessitatibus aut consequuntur. Maxime ut earum et aliquid odio non dolores.\n\nAb recusandae assumenda eligendi sunt non ut. Et consectetur dolorum optio. Consequatur impedit vel sed recusandae velit ducimus. Sunt odio quia hic sapiente dolorum aut dolor.\n\nFuga est quo sit culpa unde alias alias. Tempora nulla quam exercitationem. Inventore voluptatem rerum odio dicta vitae repellendus consequuntur. Dolorum qui saepe dolores quo saepe voluptatem. Eos sunt voluptatem veniam numquam non.\n\nVelit deserunt autem sit voluptatum ducimus. Fuga reiciendis voluptatem labore nemo ut exercitationem. Dolorem unde consequatur cumque.\n\nQui non expedita nobis. Quas modi adipisci blanditiis vel. Est architecto non sed.\n\nDolores aut magnam quaerat iste architecto. Voluptates nulla reiciendis minus illum iste fugiat officiis. Illum quibusdam doloremque ab eum.\n\nAccusantium porro perspiciatis suscipit nisi omnis voluptas. Iure in omnis expedita et inventore rerum eius.\n\nAut nostrum quia eligendi quia. Ut qui maiores error dignissimos repudiandae. Esse doloribus quos illum adipisci. Ipsa saepe voluptatem et adipisci alias.\n\nSed omnis reprehenderit quis. Illum non nam reprehenderit amet et et voluptas. Optio et ea nisi praesentium laudantium ut consectetur.\n\nSapiente maxime blanditiis doloremque soluta qui asperiores. Assumenda cum id rerum iusto esse facere. Libero pariatur facere accusantium non.', '1971-10-06 17:20:47', '2012-05-08 02:22:04', 27, 15, NULL, 58),
(135, 'Petit Bacon Cheeseburger', 'Petit-Bacon-Cheeseburger', 'Dolorum velit enim repudiandae hic. Voluptatum similique reprehenderit similique id sed ab dolore. Maxime totam fuga maiores recusandae molestiae sint similique. Quia praesentium voluptatem tenetur qui quod aperiam. Qui sed et commodi autem totam esse facilis perferendis.\n\nDistinctio sit qui dolor quibusdam. Accusamus aut laborum impedit officiis voluptate autem sunt. Natus non doloremque rerum fugiat voluptates occaecati ipsa vero. Explicabo necessitatibus commodi sunt sapiente minus tenetur ut.\n\nMaxime odio ut accusamus sit aut adipisci adipisci. A magnam expedita sapiente cum nostrum porro animi. Enim qui quis magnam voluptatem voluptas suscipit velit. Enim quisquam impedit ut aperiam beatae error omnis.\n\nAmet unde iusto quo deserunt maxime nesciunt dolore quaerat. Odio id mollitia ex aspernatur.\n\nId quod natus distinctio laudantium. Sit reiciendis et id eum autem.\n\nVel amet officia voluptatum ipsam qui hic corrupti. Mollitia voluptates iusto explicabo assumenda. A temporibus eos quis nemo officiis illo veniam.\n\nNam aliquid fugiat dignissimos nihil. Nobis atque ipsa non vero in doloribus. Facere neque dolorum consequatur quo. Quae illo aut quo.\n\nQui exercitationem non qui rem ad. Eum rerum rerum velit provident perferendis ex. Est et assumenda blanditiis aut. Fugiat voluptate quia illo.\n\nEt dolores vero ut quaerat nulla qui. Quo et cupiditate distinctio excepturi consequatur dolor. Quo sunt et id sit quasi.\n\nOmnis consectetur dolore voluptatibus et. Ipsam quas numquam enim nihil consequatur in. Culpa voluptatem magnam doloribus beatae pariatur. Magnam veritatis aut nihil dolores optio eos.', '1975-09-16 11:53:43', '2012-04-23 05:26:12', 21, 15, NULL, 58),
(136, 'Petit Bacon Cheeseburger', 'Petit-Bacon-Cheeseburger', 'Et eos harum consequatur voluptas explicabo incidunt. Explicabo reiciendis vel nobis fuga eos dolores. Quia quia autem ipsam sint corporis.\n\nQui eligendi labore voluptas optio quibusdam dolores voluptas. Aut commodi natus error minus delectus et ducimus sit.\n\nNecessitatibus sit similique adipisci molestias adipisci id sed. Et rerum officia non officiis nihil omnis. Rerum nihil voluptatem labore perferendis optio placeat fugit. Totam nulla non id.\n\nProvident architecto incidunt quod quia quas maxime quas. Distinctio consequatur culpa quam voluptatem velit quo. Id quis praesentium tempore qui itaque rerum et.\n\nVoluptas ut animi maiores laboriosam. Doloremque animi architecto enim fugiat ipsa corporis vel. Sed est consequatur modi ut ut. Mollitia quidem dolor cumque ea.\n\nEa enim dignissimos repudiandae eligendi est hic odio. Et et animi nesciunt eaque facilis reprehenderit quaerat. Sit iure est dicta ipsa nam vel facere omnis.\n\nConsequatur accusantium dolorum quaerat nostrum animi fugiat. Sint et culpa distinctio placeat. Et ut fuga voluptas esse.\n\nAccusantium assumenda ipsa rerum blanditiis. Voluptas aut ut corporis neque veniam repellendus adipisci ipsum.\n\nProvident et laudantium asperiores omnis. Quis eius voluptas suscipit qui nulla. Non voluptatem ducimus aut voluptatem sunt quia. Ea occaecati perferendis error corrupti quia cumque. A ut et sed sunt.\n\nNeque in dolore dolorem similique. Et fugiat voluptates fuga porro neque itaque ea. Vel alias non et omnis.', '1973-02-17 22:30:56', '2007-03-02 10:19:37', 54, 15, NULL, 55),
(137, 'Fromage grillé', 'Fromage-grille', 'Suscipit et consectetur dolore beatae sed eum. Temporibus et sequi ut in sequi nisi. Quia praesentium nesciunt quidem assumenda. Veritatis non sed ipsam eius inventore pariatur.\n\nVelit expedita excepturi impedit sunt. Qui voluptas dolore optio quis. Quod maiores suscipit quia magnam minus provident.\n\nEveniet corporis officia fugiat rerum amet numquam eos. Ab quia rem et sunt voluptate.\n\nQui perferendis et sit ut ipsa alias ut alias. Tempora dolorem ab harum recusandae repellat odit et. Nisi non et necessitatibus doloribus voluptas aut.\n\nReiciendis ea sunt sapiente nobis rem eligendi placeat quia. Provident minus enim mollitia. Dolores perspiciatis veniam ut. Minus error doloribus fugit facere sunt. Consequuntur incidunt ipsa ut magni.\n\nReiciendis modi eum et animi iure reprehenderit exercitationem. Voluptatibus mollitia voluptates et dolore ut. Accusamus dolore autem delectus omnis recusandae. Omnis eveniet quis explicabo qui.\n\nPorro consequuntur doloribus dolores saepe accusamus sed. Dignissimos aut quam culpa voluptatem.\n\nConsequuntur magni illo aut aut nulla vero dolore. Officia qui vel nam. Recusandae cupiditate id vitae fugiat quod similique placeat inventore. Voluptas qui exercitationem quia dolor accusantium quis facere.\n\nEst voluptas sed vero saepe natus. Odit architecto fugit et quis alias eos. Quia tenetur praesentium sunt est.\n\nConsectetur dicta id impedit commodi quia fuga ut. Voluptas illum aliquam ipsa sit ea qui perspiciatis. Laboriosam rerum ut culpa possimus cumque ullam non. Et similique aperiam mollitia voluptas exercitationem et blanditiis autem.', '1972-10-22 21:22:53', '2001-07-06 01:45:39', 47, 18, NULL, 50),
(138, 'Fromage grillé', 'Fromage-grille', 'Quis et nesciunt omnis laborum provident. Sint minus vel consequatur quod et iste qui. Eum iusto est quia ipsum maiores nisi reiciendis ut.\n\nEt debitis placeat error dolore et. Totam voluptatem ut sequi sapiente dolores itaque nostrum.\n\nUnde incidunt nobis optio tempora veritatis voluptate impedit pariatur. Ipsum facilis adipisci cumque facere. Non blanditiis omnis quasi impedit atque.\n\nQuidem aut aut reiciendis incidunt quaerat. In et maiores perferendis error et sit. Rerum ipsa rerum eveniet est. Eius sit voluptates rerum quas quibusdam culpa magnam.\n\nQuia ipsam suscipit reprehenderit provident sequi sunt quod. Sed velit accusamus ea eligendi consequatur. Atque praesentium consequatur neque et. Quisquam dolorem iure expedita saepe voluptatem.\n\nQuod inventore repudiandae fugiat soluta quasi eos necessitatibus. Quos perferendis facilis dolores beatae corrupti eos. Ad totam qui et voluptas voluptas adipisci. Blanditiis ut rerum adipisci.\n\nEt non magnam consequatur veniam nobis veniam fugiat est. Unde optio quas molestiae quod. Adipisci odio at molestias corrupti et necessitatibus ratione. Id voluptas molestiae quia iste sunt.\n\nNisi quis quo dolores officiis alias necessitatibus. Id et earum provident id eligendi inventore. Ut aut delectus sed culpa vero omnis est. Voluptatum quo necessitatibus iure. Laboriosam non tempore tempore ad incidunt beatae aut.\n\nNemo perspiciatis odit culpa expedita laborum neque expedita. Quo accusantium ex soluta occaecati architecto qui. Sed provident rem tempora.\n\nMolestias voluptatem debitis quaerat aut. Voluptas quia labore qui quo molestiae sed. Et modi fuga quia accusamus omnis rerum ut. Consectetur harum similique ea et.', '1976-07-04 13:57:40', '2016-10-29 15:40:55', 15, 18, NULL, 50),
(139, 'Moules Marinières', 'Moules-Marinieres', 'Voluptates ipsum voluptatum eius id. Voluptas excepturi perspiciatis placeat commodi molestiae. Repellendus qui et eum iste quia ut. Ut libero ratione corrupti deserunt praesentium.\n\nHic vitae sapiente et explicabo fuga consequatur. Ut perspiciatis nostrum corporis repudiandae tempora. Quasi beatae quibusdam dignissimos quo.\n\nQuo magnam delectus magnam earum voluptas nam. Aut est consectetur qui numquam perferendis. Ipsam fuga incidunt nesciunt dignissimos sit deleniti sunt.\n\nAdipisci deleniti ut voluptate repellat tempora alias. Excepturi similique architecto in dolorum. Deserunt voluptatem quis iure aut. Voluptate odio et vitae qui dolores.\n\nQui quis tempora eos. Molestiae rerum autem omnis quos. Numquam similique eius nostrum.\n\nEum porro quia repudiandae quo et ut dolorum. Nihil modi repellendus illo. Voluptatibus ut neque assumenda sunt odit qui consequatur.\n\nNecessitatibus eum incidunt est nobis vero eveniet et. Voluptas asperiores nesciunt sed fugiat expedita illum ut. Est sed pariatur doloremque quia sed exercitationem corrupti.\n\nModi et temporibus maxime corrupti. Modi tempora dolore quae ducimus. Sint sunt numquam et velit voluptatem ratione.\n\nDoloribus vel aperiam voluptatem maxime molestias rem. Qui tenetur veritatis rerum est nemo natus. Et officiis consequatur omnis facere.\n\nSunt autem iusto error minima. Maxime quia consequatur aut libero voluptatem tempore. Consequatur voluptates id qui repellendus quia quo. Ullam aliquid laboriosam quo dolorem ad veritatis rerum amet.', '2011-11-04 04:06:35', '2007-12-02 02:12:58', 56, 15, NULL, 50),
(140, 'Hot Dog', 'Hot-Dog', 'Tenetur corporis aliquam ut qui commodi. Ratione a quo reprehenderit quam voluptate at. Consectetur excepturi est facilis ut sit.\n\nQuod sequi adipisci maiores consectetur ipsum. Corrupti et facere in in animi nulla ut. Quo ut at molestiae omnis ratione. Perferendis distinctio sint ut est aut sint vitae fugiat. Dolorem natus facere vel ut quaerat.\n\nFacere blanditiis esse sapiente praesentium sit sit. Quidem voluptatem sit illo facilis a nostrum. Incidunt id a omnis dolores fuga facere laboriosam cumque. Earum eligendi omnis ducimus harum quo sed.\n\nDolorem nam minima perferendis porro et nulla. Hic ut atque explicabo incidunt enim. Et dolores doloremque iusto voluptatum deleniti. Illum soluta dignissimos suscipit placeat aut asperiores.\n\nNon dolor aliquid placeat commodi. Nihil sed consequuntur assumenda. Dolorum voluptas eius eius possimus qui animi aut.\n\nEsse voluptas illo architecto aut. Vel eos nostrum minus blanditiis corrupti. Illum voluptas atque nam aliquid ut omnis id nihil. Autem et qui sint voluptatem quod.\n\nEt in maxime placeat mollitia aut atque. Eveniet voluptatum quas reiciendis est. Aut ex molestiae eligendi labore vel impedit. Sunt molestias et commodi ab minima.\n\nExcepturi nihil adipisci amet non. Quis corporis ipsum et beatae vero. Perspiciatis laudantium ipsam vel in et.\n\nQuos harum voluptas et velit quia facere. Consequatur qui dolores praesentium rem. Optio voluptas minima illum dicta.\n\nConsequatur porro cupiditate consequatur aliquid et. Sit earum explicabo omnis eum. Dolorum dolores eum asperiores est voluptas. Asperiores assumenda error voluptates.', '1992-12-15 08:55:32', '1974-02-16 19:44:29', 45, 15, NULL, 53);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `phone`, `email`, `is_verified`, `api_token`) VALUES
(48, 'admin', '[\"ROLE_ADMIN\"]', '$2y$13$Snh79ik7/.OPl2tgZACwouhSAZes/8kMQcgZFjno6wCZupZpWRVCi', NULL, 'admin@doe.fr', 1, 'admin_token'),
(49, 'user1', '[]', '$2y$13$r9i7Svm1zGpj97a/KUhoVOUV0Wwlr3SAygAmkt/nJ7ytWpX1EVNnK', NULL, 'user1@doe.fr', 1, 'user1'),
(50, 'user2', '[]', '$2y$13$D6MZ9NXZlcqmKJ/SyA/hU.nX6V/JqWFg1AehufZ.VfaW3l0r/xNZC', NULL, 'user2@doe.fr', 1, 'user2'),
(51, 'user3', '[]', '$2y$13$Do6tg66T.THkDZdHgw6rQO2Wdy.w1xGHlusXcPmPEuamFO4iEMXM6', NULL, 'user3@doe.fr', 1, 'user3'),
(52, 'user4', '[]', '$2y$13$As3tjhSXYT4asTkQbkNJdO.uAHI3zameb7bcWUlMA.zo1LE3u.Maq', NULL, 'user4@doe.fr', 1, 'user4'),
(53, 'user5', '[]', '$2y$13$QAfz6pRhOOTf8hLxyQFp3.GWeblxgpuVw.R0Av5/2DMzvdqfEpUny', NULL, 'user5@doe.fr', 1, 'user5'),
(54, 'user6', '[]', '$2y$13$wYndK5IZTvk2rd6sD5Ttp.gvYm7kMHjcHowq0TSd6P9G8tBIyaCXm', NULL, 'user6@doe.fr', 1, 'user6'),
(55, 'user7', '[]', '$2y$13$9SOlxvnq1wr25Oue2ffC4erakQYWQgtK2A8c5T3RdcmNtIE8yHZ3C', NULL, 'user7@doe.fr', 1, 'user7'),
(56, 'user8', '[]', '$2y$13$t0CGCmyQ2dPvBUcwSTlJ2uSwBZc0GX/D2SaWc4vD2rOJYZEdDQQjO', NULL, 'user8@doe.fr', 1, 'user8'),
(57, 'user9', '[]', '$2y$13$pU8E8xkOqvQnAU1HVHawKO1ps86Yqc6bIOCXEmi2By7.O8pqXx1Vu', NULL, 'user9@doe.fr', 1, 'user9'),
(58, 'user10', '[]', '$2y$13$Ukks9ivjxpNyNeie3Nn10eJB4LwVIECf5mqDsr7WqUsoPJ7f2TUpW', NULL, 'user10@doe.fr', 1, 'user10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DA88B13712469DE2` (`category_id`),
  ADD KEY `IDX_DA88B137A76ED395` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_USERNAME` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `FK_DA88B13712469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_DA88B137A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
