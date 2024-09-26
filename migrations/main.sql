-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 25, 2024 at 03:15 PM
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
('DoctrineMigrations\\Version20240924071103', '2024-09-24 07:11:14', 74);

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
  `duration` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`id`, `title`, `slug`, `content`, `created_at`, `updated_at`, `duration`) VALUES
(1, 'Pates Bolognaises', 'pate-bolognaise', 'Le soffritto de la sauce bolognaise italienne\n\nCommencez par préparer ce qu’on appelle soffritto. Le soffritto c’est la base de toutes les sauces italiennes à base de tomate ou presque. C’est un mélange de légumes et d’herbes coupés très finement, qu’on fait revenir dans de l’huile d’olive avant d’ajouter la tomate, et c’est ce qui parfume la sauce. Commencez donc par hacher très fin, le plus fin possible votre ail, l’oignon, votre échalote, votre céleri et votre carotte. En tout petits dés ! Faites revenir doucement dans une grande cocotte avec un peu d’huile d’olive quelques minutes, le temps que les parfums commencent à se dégager.\nLa cuisson de la viande pour la bolognaise\n\nEnsuite, on va ajouter les viandes pour les faire dorer légèrement. On monte un poil le feu, puis on ajoute la pancetta coupée en très petits dès, pour la faire colorer. Faites la même chose avec votre chair à saucisse, puis le bœuf haché et laissez la viande cuire quelques instants. A ce moment là, vous pouvez laisser le feu assez fort (pas trop non plus) pour caraméliser les sucs de cuisson. Ensuite déglacez avec le vin blanc, et laissez réduire : le vin va décoller les sucs de cuisson et donner encore plus de saveurs à la sauce bolognaise. Ajoutez un petit peu de lait : cela va casser l’acidité de la tomate et donner de la douceur à la sauce.\nLe mijotage de la sauce bolognaise\n\nEnsuite, c’est le moment d’ajouter la pulpe de tomate. Là vous avez deux choix : soit vous faites votre pulpe vous même. Il suffit de prendre des tomates, d’en retirer la peau, et de concasser la chair en enlevant les pépins. Deuxième solution, vous prenez de la pulpe de tomate toute faite : bien pratique quand ce n’est pas la saison des tomates. Personnellement, j’aime bien la marque Mutti, qui est de bonne qualité, pas trop acide et bien parfumée. Un conseil : évitez les sauces de grandes marques un peu industrielles qui sont souvent bourrées d’additifs inutiles et choisissez les vraies conserves (boîte en métal) qui contiennent 100% de tomate fraîche. Ajoutez donc cette pulpe, mélangez bien et terminez avec une feuille de laurier.', '2024-09-24 00:00:00', '2024-09-24 00:00:00', 15),
(2, 'Riz cantonnais', 'riz-cantonnais', 'Préparation du riz sauté au poulet façon thaï (Khao Pad Kai):\n\nAlors d’abord une petite précision. La cuisine thaïe, et en particulier les riz sautés thaïs, nécessitent une bonne rapidité d’exécution. Il vous faut un wok (ou une poêle) bien chaud, dans lequel vous allez ajouter vos ingrédients dans un ordre précis pour les cuire rapidement, comme pour la recette du poulet sauté aux noix de cajou ! Donc avant de commencer, mieux avoir tous ses ingrédients prêts.\nMise en place pour la recette du riz thaï sauté au poulet :\n\nSi vous n’avez pas de riz déjà cuit, la première chose à faire est donc de le faire cuire. Faites cuire comme vous avez l’habitude, mais cuisez le un peu moins (vu qu’il va recuire dans la poêle). Une fois cuit, mettez le environ 30 minutes à refroidir au congélateur.\n\nEnsuite, découpez en tout petits morceaux l’ail et le gingembre. Coupez vos oignons en petites lamelles (si vous l’avez, gardez la partie verte pour la fin). Découpez votre poulet en très fines lamelles (ou décortiqué votre poulet déjà cuit en lamelles). Coupez vos légumes en lamelles assez fines également. Gardez également à portée de main vos sauces.\nLa cuisson du riz sauté au poulet\n\nFaites chauffer assez fort un wok ou une grande poêle avec un peu d’huile jusqu’à ce qu’elle fume légèrement. Ensuite, ça va vite ! Ajoutez votre ail, votre gingembre et vos oignons. Laissez cuire jusqu’à ce que ça commence un peu à colorer. Écartez tout ça dans un coin de la poêle puis ajoutez vos œufs. Mélangez les grossièrement pendant 1 minute jusqu’à ce qu’ils forment de petites morceaux d’omelette. Puis ajoutez votre poulet et vos légumes.et mélangez avec le reste. Laissez cuire jusqu’à ce que ça soit pratiquement cuit, et ajoutez le riz.\n\nAugmentez la température pour être sur un feu bien fort pour faire « frire » le riz. Ajoutez les sauces et le sucre et mélangez bien tout le contenu de votre poêle. A ce moment là, éteignez le feu, et laissez finir de cuire sur feu éteint. C’est le moment d’ajouter les épices que vous voulez pour parfumer encore un peu plus votre riz sauté au poulet. Moi je mets du poivre blanc, mais il peut m’arriver d’utiliser aussi un peu de curry en poudre, un peu de piment en poudre, ou d’autres ingrédients, c’est selon l’humeur.', '2024-08-26 00:00:00', '2024-09-05 00:00:00', 25),
(3, 'Barbe à papa', 'barbe-papa', 'Mettre du sucre', '2024-09-25 14:47:02', '2024-09-25 14:47:02', 8);

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
