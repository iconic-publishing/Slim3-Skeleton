-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 05, 2018 at 09:51 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skeleton`
--

-- --------------------------------------------------------

--
-- Table structure for table `press`
--

CREATE TABLE `press` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(170) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_on` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `press`
--

INSERT INTO `press` (`id`, `slug`, `title`, `description`, `published_on`, `created_at`, `updated_at`) VALUES
(1, 'this-is-a-test-press-one', 'This is a Test Press One', 'Vel primis fastidii in, nec et enim nibh, pri cu ornatus consectetuer vituperatoribus. In his delenit appareat qualisque. Sit quas nonumy libris ea. Modo ocurreret cu duo, integre lobortis ea eam, nulla reformidans deterruisset no nec.\r\n\r\nNam ei vidisse intellegam. An electram accommodare est, per cu adhuc latine vivendo, debet ponderum voluptatibus at pri. Moderatius delicatissimi at has. Vim tritani vituperatoribus te, no suas omnesque duo.\r\n\r\nMunere putant habemus ea mel. Cu eum clita maiorum, vel ea sumo feugait prodesset, cum ferri graecis voluptaria ex. Ut ius aliquam omnesque inimicus, an vim quem adhuc. Quo amet dolorum assueverit te, mea natum invenire salutandi ut.\r\n\r\nEx putant euripidis persequeris ius, fabulas accusamus laboramus sit at, ad invenire persecuti mea. Agam aliquam minimum quo an, discere platonem ad mea. Sit dicit omittam et. Mazim audiam perpetua nam an, eam eu aliquip debitis constituam. Zril theophrastus ex sit, dicant qualisque nam te, his te vide dicam aeterno.\r\n\r\nEt mei brute tincidunt appellantur. Vel aeque offendit id, delenit meliore concludaturque vix et, fastidii noluisse tractatos quo no. Assum graecis vix ad, tantas labore labores vel et, sed hinc mollis deserunt an. Et vivendum oportere expetenda nec, ut adhuc malis torquatos ius.\r\n\r\nEx putant euripidis persequeris ius, fabulas accusamus laboramus sit at, ad invenire persecuti mea. Agam aliquam minimum quo an, discere platonem ad mea. Sit dicit omittam et. Mazim audiam perpetua nam an, eam eu aliquip debitis constituam. Zril theophrastus ex sit, dicant qualisque nam te, his te vide dicam aeterno.\r\n\r\nEt mei brute tincidunt appellantur. Vel aeque offendit id, delenit meliore concludaturque vix et, fastidii noluisse tractatos quo no. Assum graecis vix ad, tantas labore labores vel et, sed hinc mollis deserunt an. Et vivendum oportere expetenda nec, ut adhuc malis torquatos ius.', '2017-06-01', '2017-06-23 21:39:54', '0000-00-00 00:00:00'),
(2, 'this-is-a-test-press-two', 'This is a Test Press Two', 'Nam ei vidisse intellegam. An electram accommodare est, per cu adhuc latine vivendo, debet ponderum voluptatibus at pri. Moderatius delicatissimi at has. Vim tritani vituperatoribus te, no suas omnesque duo.\r\n\r\nLorem ipsum dolor sit amet, vel primis fastidii in, nec et enim nibh, pri cu ornatus consectetuer vituperatoribus. In his delenit appareat qualisque. Sit quas nonumy libris ea. Modo ocurreret cu duo, integre lobortis ea eam, nulla reformidans deterruisset no nec.\r\n\r\nNam ei vidisse intellegam. An electram accommodare est, per cu adhuc latine vivendo, debet ponderum voluptatibus at pri. Moderatius delicatissimi at has. Vim tritani vituperatoribus te, no suas omnesque duo.\r\n\r\nMunere putant habemus ea mel. Cu eum clita maiorum, vel ea sumo feugait prodesset, cum ferri graecis voluptaria ex. Ut ius aliquam omnesque inimicus, an vim quem adhuc. Quo amet dolorum assueverit te, mea natum invenire salutandi ut.\r\n\r\nEx putant euripidis persequeris ius, fabulas accusamus laboramus sit at, ad invenire persecuti mea. Agam aliquam minimum quo an, discere platonem ad mea. Sit dicit omittam et. Mazim audiam perpetua nam an, eam eu aliquip debitis constituam. Zril theophrastus ex sit, dicant qualisque nam te, his te vide dicam aeterno.\r\n\r\nEt mei brute tincidunt appellantur. Vel aeque offendit id, delenit meliore concludaturque vix et, fastidii noluisse tractatos quo no. Assum graecis vix ad, tantas labore labores vel et, sed hinc mollis deserunt an. Et vivendum oportere expetenda nec, ut adhuc malis torquatos ius.\r\n\r\nEx putant euripidis persequeris ius, fabulas accusamus laboramus sit at, ad invenire persecuti mea. Agam aliquam minimum quo an, discere platonem ad mea. Sit dicit omittam et. Mazim audiam perpetua nam an, eam eu aliquip debitis constituam. Zril theophrastus ex sit, dicant qualisque nam te, his te vide dicam aeterno.\r\n\r\nEt mei brute tincidunt appellantur. Vel aeque offendit id, delenit meliore concludaturque vix et, fastidii noluisse tractatos quo no. Assum graecis vix ad, tantas labore labores vel et, sed hinc mollis deserunt an. Et vivendum oportere expetenda nec, ut adhuc malis torquatos ius.', '2017-06-04', '2017-06-23 21:40:11', '0000-00-00 00:00:00'),
(3, 'this-is-a-test-press-three', 'This is a Test Press Three', 'Lorem ipsum dolor sit amet, vel primis fastidii in, nec et enim nibh, pri cu ornatus consectetuer vituperatoribus. In his delenit appareat qualisque. Sit quas nonumy libris ea. Modo ocurreret cu duo, integre lobortis ea eam, nulla reformidans deterruisset no nec.\r\n\r\nNam ei vidisse intellegam. An electram accommodare est, per cu adhuc latine vivendo, debet ponderum voluptatibus at pri. Moderatius delicatissimi at has. Vim tritani vituperatoribus te, no suas omnesque duo.\r\n\r\nMunere putant habemus ea mel. Cu eum clita maiorum, vel ea sumo feugait prodesset, cum ferri graecis voluptaria ex. Ut ius aliquam omnesque inimicus, an vim quem adhuc. Quo amet dolorum assueverit te, mea natum invenire salutandi ut.\r\n\r\nEx putant euripidis persequeris ius, fabulas accusamus laboramus sit at, ad invenire persecuti mea. Agam aliquam minimum quo an, discere platonem ad mea. Sit dicit omittam et. Mazim audiam perpetua nam an, eam eu aliquip debitis constituam. Zril theophrastus ex sit, dicant qualisque nam te, his te vide dicam aeterno.\r\n\r\nEt mei brute tincidunt appellantur. Vel aeque offendit id, delenit meliore concludaturque vix et, fastidii noluisse tractatos quo no. Assum graecis vix ad, tantas labore labores vel et, sed hinc mollis deserunt an. Et vivendum oportere expetenda nec, ut adhuc malis torquatos ius.\r\n\r\nEx putant euripidis persequeris ius, fabulas accusamus laboramus sit at, ad invenire persecuti mea. Agam aliquam minimum quo an, discere platonem ad mea. Sit dicit omittam et. Mazim audiam perpetua nam an, eam eu aliquip debitis constituam. Zril theophrastus ex sit, dicant qualisque nam te, his te vide dicam aeterno.\r\n\r\nEt mei brute tincidunt appellantur. Vel aeque offendit id, delenit meliore concludaturque vix et, fastidii noluisse tractatos quo no. Assum graecis vix ad, tantas labore labores vel et, sed hinc mollis deserunt an. Et vivendum oportere expetenda nec, ut adhuc malis torquatos ius.', '2017-06-06', '2017-06-23 20:40:25', '0000-00-00 00:00:00'),
(4, 'this-is-a-test-press-four', 'This is a Test Press Four', 'Nam ei vidisse intellegam. An electram accommodare est, per cu adhuc latine vivendo, debet ponderum voluptatibus at pri. Moderatius delicatissimi at has. Vim tritani vituperatoribus te, no suas omnesque duo.\r\n\r\nMunere putant habemus ea mel. Cu eum clita maiorum, vel ea sumo feugait prodesset, cum ferri graecis voluptaria ex. Ut ius aliquam omnesque inimicus, an vim quem adhuc. Quo amet dolorum assueverit te, mea natum invenire salutandi ut.\r\n\r\nEx putant euripidis persequeris ius, fabulas accusamus laboramus sit at, ad invenire persecuti mea. Agam aliquam minimum quo an, discere platonem ad mea. Sit dicit omittam et. Mazim audiam perpetua nam an, eam eu aliquip debitis constituam. Zril theophrastus ex sit, dicant qualisque nam te, his te vide dicam aeterno.\r\n\r\nEt mei brute tincidunt appellantur. Vel aeque offendit id, delenit meliore concludaturque vix et, fastidii noluisse tractatos quo no. Assum graecis vix ad, tantas labore labores vel et, sed hinc mollis deserunt an. Et vivendum oportere expetenda nec, ut adhuc malis torquatos ius.\r\n\r\nEx putant euripidis persequeris ius, fabulas accusamus laboramus sit at, ad invenire persecuti mea. Agam aliquam minimum quo an, discere platonem ad mea. Sit dicit omittam et. Mazim audiam perpetua nam an, eam eu aliquip debitis constituam. Zril theophrastus ex sit, dicant qualisque nam te, his te vide dicam aeterno.\r\n\r\nEt mei brute tincidunt appellantur. Vel aeque offendit id, delenit meliore concludaturque vix et, fastidii noluisse tractatos quo no. Assum graecis vix ad, tantas labore labores vel et, sed hinc mollis deserunt an. Et vivendum oportere expetenda nec, ut adhuc malis torquatos ius.', '2017-06-08', '2017-06-23 21:40:38', '0000-00-00 00:00:00'),
(5, 'this-is-a-test-press-five', 'This is a Test Press Five', 'Et mei brute tincidunt appellantur. Vel aeque offendit id, delenit meliore concludaturque vix et, fastidii noluisse tractatos quo no. Assum graecis vix ad, tantas labore labores vel et, sed hinc mollis deserunt an. Et vivendum oportere expetenda nec, ut adhuc malis torquatos ius.\r\n\r\nLorem ipsum dolor sit amet, vel primis fastidii in, nec et enim nibh, pri cu ornatus consectetuer vituperatoribus. In his delenit appareat qualisque. Sit quas nonumy libris ea. Modo ocurreret cu duo, integre lobortis ea eam, nulla reformidans deterruisset no nec.\r\n\r\nNam ei vidisse intellegam. An electram accommodare est, per cu adhuc latine vivendo, debet ponderum voluptatibus at pri. Moderatius delicatissimi at has. Vim tritani vituperatoribus te, no suas omnesque duo.\r\n\r\nMunere putant habemus ea mel. Cu eum clita maiorum, vel ea sumo feugait prodesset, cum ferri graecis voluptaria ex. Ut ius aliquam omnesque inimicus, an vim quem adhuc. Quo amet dolorum assueverit te, mea natum invenire salutandi ut.\r\n\r\nEx putant euripidis persequeris ius, fabulas accusamus laboramus sit at, ad invenire persecuti mea. Agam aliquam minimum quo an, discere platonem ad mea. Sit dicit omittam et. Mazim audiam perpetua nam an, eam eu aliquip debitis constituam. Zril theophrastus ex sit, dicant qualisque nam te, his te vide dicam aeterno.\r\n\r\nEx putant euripidis persequeris ius, fabulas accusamus laboramus sit at, ad invenire persecuti mea. Agam aliquam minimum quo an, discere platonem ad mea. Sit dicit omittam et. Mazim audiam perpetua nam an, eam eu aliquip debitis constituam. Zril theophrastus ex sit, dicant qualisque nam te, his te vide dicam aeterno.\r\n\r\nEt mei brute tincidunt appellantur. Vel aeque offendit id, delenit meliore concludaturque vix et, fastidii noluisse tractatos quo no. Assum graecis vix ad, tantas labore labores vel et, sed hinc mollis deserunt an. Et vivendum oportere expetenda nec, ut adhuc malis torquatos ius.', '2017-06-09', '2017-06-23 21:40:56', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `locked` tinyint(4) NOT NULL,
  `active_hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recover_hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_identifier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email_address`, `first_name`, `last_name`, `mobile_number`, `password`, `token`, `active`, `locked`, `active_hash`, `recover_hash`, `remember_identifier`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '517977', 'johndoe@domain.com', 'John', 'Doe', '+660000000000', '$2y$10$fwBVI5THInOGxScLDLERR.shGGz0h0rCJWVe0lqb7WuOwRtz7QEUu', NULL, 1, 0, '4ba28d338af47274c6cbb8298815b83ea759e975f7347248502cee0b7c4fc992', NULL, NULL, NULL, '2018-04-04 08:10:12', '2018-04-04 08:14:19'),
(2, '517978', 'jaynedoe@domain.com', 'Jayne', 'Doe', '+660000000000', '$2y$10$Z92Tm8mm0FsMbW2pS5QIauhf6zhZLf2VAqVfMUC5vslQSka5i7292', NULL, 1, 0, '77c074f17635da1f8bde3997418d77b8853a5c544e159f1579bdc0ebd20c6410', NULL, NULL, NULL, '2018-04-04 08:12:26', '2018-04-04 08:13:37');

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

CREATE TABLE `users_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `is_administrator` tinyint(4) NOT NULL,
  `is_admin` tinyint(4) NOT NULL,
  `is_staff` tinyint(4) NOT NULL,
  `is_user` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_permissions`
--

INSERT INTO `users_permissions` (`id`, `user_id`, `is_administrator`, `is_admin`, `is_staff`, `is_user`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 0, 0, '2018-04-04 08:10:12', '2018-04-04 08:10:12'),
(2, 2, 0, 0, 0, 1, '2018-04-04 08:12:26', '2018-04-04 08:12:26');

-- --------------------------------------------------------

--
-- Table structure for table `_migrations`
--

CREATE TABLE `_migrations` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_migrations`
--

INSERT INTO `_migrations` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20180404074201, 'CreateUsersTable', '2018-04-04 08:09:50', '2018-04-04 08:09:50', 0),
(20180404075706, 'CreateUsersPermissionsTable', '2018-04-04 08:09:50', '2018-04-04 08:09:50', 0),
(20180405074315, 'CreatePressTable', '2018-04-05 07:47:31', '2018-04-05 07:47:31', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `press`
--
ALTER TABLE `press`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_permissions_user_id_foreign` (`user_id`);

--
-- Indexes for table `_migrations`
--
ALTER TABLE `_migrations`
  ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `press`
--
ALTER TABLE `press`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_permissions`
--
ALTER TABLE `users_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD CONSTRAINT `users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
