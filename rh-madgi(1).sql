-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 157.173.123.244
-- Généré le : lun. 17 mars 2025 à 10:17
-- Version du serveur : 8.0.32
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `madgi`
--

-- --------------------------------------------------------

--
-- Structure de la table `activities`
--

CREATE TABLE `activities` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `activities`
--

INSERT INTO `activities` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'AG', '2024-12-12 23:20:23', '2024-12-12 23:20:23'),
(2, 'Sécrétaire Géneral', '2024-12-12 23:20:23', '2024-12-12 23:20:23'),
(3, 'Conseiller Technique', '2024-12-12 23:20:23', '2024-12-12 23:20:23'),
(4, 'Chef de departement', '2024-12-12 23:20:23', '2024-12-12 23:20:23'),
(5, 'Chef de service', '2024-12-12 23:20:23', '2024-12-12 23:20:23'),
(6, 'Chef d\'unité', '2024-12-12 23:20:23', '2024-12-12 23:20:23'),
(7, 'Chef de cabinet', '2024-12-12 23:20:23', '2024-12-12 23:20:23'),
(8, 'Chef de sous departement', '2024-12-12 23:20:23', '2024-12-12 23:20:23');

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(16) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role_id` int UNSIGNED NOT NULL,
  `department_id` int DEFAULT NULL,
  `password` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `role_id`, `department_id`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Root', 'johndoe@gmail.com', 1, 1, '$2y$12$LiBL7yVrIMFkQi73fw1IL.oww3iu5dA6ebSAUdEjX7A8Vz/R23qHW', '2024-06-26 00:30:02', '2024-08-15 01:03:57'),
(7, 'RH', 'rh@gmail.com', 9, 1, '$2y$12$8z9SnYqpRcqew/JVEpHUhOyuCLn98cKiDMATTq9PKB5c1Igon8KBK', '2024-08-15 10:14:45', '2024-08-26 15:17:19'),
(8, 'GOYE FAE', 'faekaty@gmail.com', 1, 7, '$2y$12$e.EGMzudf5aeR0k9HP63vu.Cw0rB1FUAW9RTs8RXyzWH1vpXoqzm2', '2024-10-08 10:32:27', '2024-10-08 10:49:03'),
(10, 'ABOKON', 'a.abokon@madgi.ci', 1, 30, '$2y$12$nyikzNqCXXzWWB/FfJ6YBOCgINUcfDRB9Ieq9RURMymI4GwN/dTtG', '2024-11-20 09:55:20', '2024-12-30 11:33:01'),
(11, 'Mbra', 'k.mbra@madgi.ci', 1, NULL, '$2y$12$L4MXffHrJCiT4Gzhh3DzWurEC1i48sPnN1ljufCH4Yq9PBz16YiiG', '2024-11-22 10:20:17', '2024-11-22 10:22:43'),
(12, 'GOH', 'gedeongoh@gmail.com', 1, 3, '$2y$12$.0qpIsTfN29Qy78v84GNEeslwBO/qcIctuBGNT1.eNyNIzuyxHgYS', '2024-12-06 04:48:38', '2024-12-06 04:48:38'),
(13, 'esther', 'esthertape34@gmail.com', 1, 30, '$2y$12$XfMoH2Y5QQ7xS1Tkc9hyi.O3MmVM9RB7KpZAPFJ3.y5vCvRgw862y', '2024-12-10 14:53:52', '2024-12-16 15:06:10'),
(14, 'BOUA', 'm.boua@madgi.ci', 1, 31, '$2y$12$qFIWbTKMqKEJDTKWh2VH8.n3oaW..WzczRTIMMKaJWC6hYNo1d.Vm', '2025-01-21 14:13:13', '2025-01-21 14:13:13');

-- --------------------------------------------------------

--
-- Structure de la table `assessments`
--

CREATE TABLE `assessments` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `form_assessment_id` int NOT NULL,
  `data` json NOT NULL,
  `save` int NOT NULL DEFAULT '1',
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `assessments`
--

INSERT INTO `assessments` (`id`, `user_id`, `form_assessment_id`, `data`, `save`, `status`, `created_at`, `updated_at`) VALUES
(1, 1175, 1, '{\"note\": 16, \"total\": 32, \"coefficient\": 2, \"observation\": \"Voluptatibus obcaeca\"}', 1, NULL, '2024-08-26 08:47:34', '2024-08-26 08:47:34'),
(2, 1175, 2, '{\"note\": 19, \"total\": 57, \"coefficient\": 3, \"observation\": \"Eaque ea rerum maior\"}', 1, NULL, '2024-08-26 08:47:34', '2024-08-26 08:47:34'),
(3, 1175, 3, '{\"note\": 17, \"total\": 68, \"coefficient\": 4, \"observation\": \"Est ullam illum per\"}', 1, NULL, '2024-08-26 08:47:34', '2024-08-26 08:47:34'),
(4, 1174, 1, '{\"note\": 19, \"total\": 38, \"coefficient\": 2, \"observation\": \"Sit sunt ut sequi au\"}', 1, 'traiter', '2024-08-26 15:18:44', '2024-08-26 15:58:59'),
(5, 1174, 2, '{\"note\": 19, \"total\": 57, \"coefficient\": 3, \"observation\": \"Debitis sunt sunt c\"}', 1, 'traiter', '2024-08-26 15:18:44', '2024-08-26 15:58:59'),
(6, 1174, 3, '{\"note\": 19, \"total\": 76, \"coefficient\": 4, \"observation\": \"Molestias voluptatib\"}', 1, 'traiter', '2024-08-26 15:18:44', '2024-08-26 15:58:59'),
(7, 198, 1, '{\"note\": 20, \"total\": 40, \"coefficient\": 2, \"observation\": \"Dolorem qui aut sit\"}', 1, NULL, '2024-09-12 17:59:48', '2024-09-12 17:59:48'),
(8, 198, 2, '{\"note\": 15, \"total\": 45, \"coefficient\": 3, \"observation\": \"Modi alias reprehend\"}', 1, NULL, '2024-09-12 17:59:48', '2024-09-12 17:59:48'),
(9, 198, 3, '{\"note\": 16, \"total\": 64, \"coefficient\": 4, \"observation\": \"Sed Nam incidunt qu\"}', 1, NULL, '2024-09-12 17:59:48', '2024-09-12 17:59:48');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Agent', NULL, NULL),
(2, 'Stagiaire ', NULL, NULL),
(3, 'Vacataire ', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `certificates`
--

CREATE TABLE `certificates` (
  `id` int NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `matricule` varchar(100) NOT NULL,
  `start_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `end_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `resumption` varchar(100) DEFAULT NULL,
  `work_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `motif` text,
  `status` varchar(100) NOT NULL DEFAULT 'PENDING',
  `department_id` int NOT NULL,
  `site_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `type` varchar(100) NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `certificates`
--

INSERT INTO `certificates` (`id`, `fullname`, `matricule`, `start_date`, `end_date`, `duration`, `resumption`, `work_date`, `motif`, `status`, `department_id`, `site_id`, `user_id`, `type`, `content`, `created_at`, `updated_at`) VALUES
(3, 'ABITTHY Abroh  Luther Clément', '00804-P', '07/12/2024', '', NULL, NULL, NULL, NULL, 'PENDING', 30, NULL, 1, 'Attestation de reprise de service maternité', NULL, '2024-12-07 20:56:09', '2024-12-07 20:56:09'),
(18, 'ABITTHY Abroh  Luther Clément', '00804-P', NULL, NULL, NULL, NULL, NULL, NULL, 'PENDING', 30, NULL, 1, 'Attestation de reprise de service maternité', NULL, '2025-01-29 23:47:26', '2025-01-29 23:47:26'),
(19, 'ABITTHY Abroh  Luther Clément', '00804-P', NULL, '2025-02-01', NULL, NULL, NULL, NULL, 'PENDING', 30, NULL, 1, 'Attestation allaitement', NULL, '2025-01-30 08:45:22', '2025-01-30 08:45:22'),
(20, 'ABITTHY Abroh  Luther Clément', '00804-P', NULL, '2025-01-31', NULL, NULL, NULL, NULL, 'PENDING', 30, NULL, 1, 'Attestation allaitement', NULL, '2025-01-30 08:51:05', '2025-01-30 08:51:05'),
(21, 'ABITTHY Abroh  Luther Clément', '00804-P', NULL, NULL, NULL, NULL, NULL, NULL, 'PENDING', 30, NULL, 1, 'Attestation de reprise de service maternité', NULL, '2025-01-30 08:52:05', '2025-01-30 08:52:05'),
(22, 'ABITTHY Abroh  Luther Clément', '00804-P', NULL, NULL, NULL, NULL, '2025-01-31', NULL, 'PENDING', 30, NULL, 1, 'Attestation travail', NULL, '2025-01-30 08:53:30', '2025-01-30 08:53:30'),
(23, 'ABITTHY Abroh  Luther Clément', '00804-P', '2025-01-31', '2025-02-05', NULL, NULL, NULL, NULL, 'PENDING', 30, NULL, 1, 'Certificat de travail', NULL, '2025-01-30 08:54:14', '2025-01-30 11:54:52'),
(24, 'ABITTHY Abroh  Luther Clément', '00804-P', '2025-02-08', NULL, NULL, NULL, NULL, NULL, 'PENDING', 30, 1, 1, 'Prise de service', NULL, '2025-01-30 08:55:24', '2025-01-30 08:55:24'),
(26, 'ABITTHY Abroh  Luther Clément', '00804-P', '2025-01-31', '2025-02-01', '6', NULL, NULL, NULL, 'PENDING', 30, NULL, 1, 'Attestation allaitement', NULL, '2025-01-30 22:12:30', '2025-01-30 22:12:30'),
(27, 'ABITTHY Abroh  Luther Clément', '00804-P', NULL, '30/01/2025', NULL, NULL, '2025-01-31', NULL, 'SUCCESS', 30, NULL, 1, 'Attestation travail', 'Bien', '2025-01-30 22:17:41', '2025-01-30 22:19:12'),
(28, 'AHOUSSI Ahoussi Faustin', '330270-S', '2025-03-03', NULL, NULL, NULL, NULL, NULL, 'PENDING', 32, 6, 10, 'Prise de service', NULL, '2025-03-12 17:46:39', '2025-03-12 17:46:39'),
(29, 'AHOUSSI Ahoussi Faustin', '330270-S', '2025-03-04', '12/03/2025', NULL, NULL, NULL, NULL, 'SUCCESS', 32, NULL, 10, 'Certificat de travail', 'RAs', '2025-03-12 17:51:25', '2025-03-12 18:06:47'),
(30, 'ABITTHY Abroh  Luther Clément', '00804-P', '2025-01-06', NULL, NULL, NULL, NULL, NULL, 'PENDING', 30, 1, 1, 'Prise de service', NULL, '2025-03-13 11:45:33', '2025-03-13 11:45:33'),
(31, 'TAPE Naomi Grâce Esther épouse BAILLY', '18520-P', NULL, NULL, NULL, NULL, '2024-06-11', NULL, 'PENDING', 31, NULL, 24, 'Attestation travail', NULL, '2025-03-13 11:50:59', '2025-03-13 11:50:59');

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

CREATE TABLE `departements` (
  `id` int NOT NULL,
  `name` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `departements`
--

INSERT INTO `departements` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'SOUS-DEPARTEMENT MEDICAL', '2024-07-02 10:36:22', '2024-10-24 09:38:54'),
(4, 'SOUS-DEPARTEMENT HOSPITALIER', '2024-07-02 10:36:27', '2024-07-02 10:36:27'),
(30, 'AG', '2024-09-08 09:41:52', '2024-09-08 09:41:52'),
(31, 'RHMG', '2024-09-08 09:41:53', '2024-09-08 09:41:53'),
(32, 'HMI-KF', '2024-09-08 09:41:53', '2024-09-08 09:41:53'),
(33, 'APS', '2024-09-08 09:41:55', '2024-09-08 09:41:55'),
(36, 'CF', '2024-09-08 09:42:00', '2024-09-08 09:42:00'),
(37, 'CEC ', '2024-09-08 09:42:02', '2024-09-08 09:42:02'),
(38, 'Cabinet PCA', '2024-09-08 09:42:05', '2024-09-08 09:42:05');

-- --------------------------------------------------------

--
-- Structure de la table `devices`
--

CREATE TABLE `devices` (
  `id` int NOT NULL,
  `statut` int NOT NULL DEFAULT '2',
  `name_user` text NOT NULL,
  `user_id` int DEFAULT NULL,
  `mac_adress` text,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `emargements`
--

CREATE TABLE `emargements` (
  `id` int NOT NULL,
  `matricule` text,
  `day` varchar(100) NOT NULL,
  `heure_arrive` time DEFAULT NULL,
  `heure_depart` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `photo` text,
  `type_device` text,
  `unique_web_identifier` text,
  `type` varchar(100) NOT NULL DEFAULT 'mobile',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `statut` int DEFAULT NULL,
  `observation` text,
  `unregister_observation` text,
  `observation_depart` text,
  `device_depart` text,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `emargements`
--

INSERT INTO `emargements` (`id`, `matricule`, `day`, `heure_arrive`, `heure_depart`, `date`, `photo`, `type_device`, `unique_web_identifier`, `type`, `created_at`, `updated_at`, `statut`, `observation`, `unregister_observation`, `observation_depart`, `device_depart`, `user_id`) VALUES
(1, '313 350-M', 'lundi', '09:56:45', NULL, '2024-11-11', NULL, 'e0f6d69e-2a5b-4021-85a5-019164b2db70', NULL, 'mobile', '2024-11-11 09:56:45', '2024-11-11 09:56:45', NULL, 'ras', NULL, NULL, NULL, 62),
(2, '305 848-N', 'lundi', '10:02:37', NULL, '2024-11-11', '/images/1731319357.jpg', 'gta9p', NULL, 'mobile', '2024-11-11 10:02:37', '2024-11-11 10:02:37', NULL, 'ras', NULL, NULL, NULL, 188),
(3, '313 350-M', 'lundi', '15:11:55', NULL, '2024-11-18', '/images/1731942715.jpg', 'gta9p', NULL, 'mobile', '2024-11-18 15:11:55', '2024-11-18 15:11:55', NULL, 'ras', NULL, NULL, NULL, 62),
(4, '18520-P', 'lundi', '15:13:34', NULL, '2024-11-18', '/images/1731942814.jpg', 'gta9p', NULL, 'mobile', '2024-11-18 15:13:34', '2024-11-18 15:13:34', NULL, 'ras', NULL, NULL, NULL, 24),
(5, '313 350-M', 'mercredi', '11:58:48', NULL, '2024-11-20', '/images/1732103928.jpg', 'gta9p', NULL, 'mobile', '2024-11-20 11:58:48', '2024-11-20 11:58:48', NULL, 'rdv externe', NULL, NULL, NULL, 62),
(6, '11816-P', 'mercredi', '12:01:27', '12:04:08', '2024-11-20', '/images/1732104087.jpg', 'gta9p', NULL, 'mobile', '2024-11-20 12:01:27', '2024-11-20 12:04:08', 1, 'je suis fatigué', NULL, NULL, 'RP1A.200720.012.d2x.unknown.d2xks', 129),
(7, '245 620-Q', 'lundi', '13:58:35', NULL, '2025-01-13', '/images/1736776715.jpg', 'gta9p', NULL, 'mobile', '2025-01-13 13:58:35', '2025-01-13 13:58:35', NULL, 'azerty', NULL, NULL, NULL, 4),
(8, '245 620-Q', 'jeudi', '13:11:39', NULL, '2025-01-16', '/images/1737033099.jpg', 'gta9p', NULL, 'mobile', '2025-01-16 13:11:39', '2025-01-16 13:11:39', NULL, 'azerty', NULL, NULL, NULL, 4),
(9, '245 620-Q', 'lundi', '10:42:03', NULL, '2025-01-20', '/images/1737369723.jpg', 'gta9p', NULL, 'mobile', '2025-01-20 10:42:03', '2025-01-20 10:42:03', NULL, 'ras', NULL, NULL, NULL, 4),
(10, '245 620-Q', 'mercredi', '14:32:31', NULL, '2025-03-12', '/images/1741789951.jpg', 'gta9p', NULL, 'mobile', '2025-03-12 14:32:31', '2025-03-12 14:32:31', NULL, 'oui', NULL, NULL, NULL, 4),
(11, '00804-P', 'mercredi', '16:54:46', NULL, '2025-03-12', '/images/1741798486.jpg', 'gta9p', NULL, 'mobile', '2025-03-12 16:54:46', '2025-03-12 16:54:46', NULL, 'ras', NULL, NULL, NULL, 1),
(12, '330 270-S', 'mercredi', '17:33:55', '17:44:28', '2025-03-12', NULL, 'TP1A.220624.014.a3core.unknown.a3corexx', NULL, 'mobile', '2025-03-12 17:33:59', '2025-03-12 17:44:28', 1, NULL, NULL, NULL, 'TP1A.220624.014.a3core.unknown.a3corexx', 10),
(13, '18520-P', 'jeudi', '11:05:27', NULL, '2025-03-13', '/images/1741863927.jpg', 'gta9p', NULL, 'mobile', '2025-03-13 11:05:27', '2025-03-13 11:05:27', NULL, 'envoyé hmi', NULL, NULL, NULL, 24),
(14, '313 690-B', 'jeudi', '11:15:11', NULL, '2025-03-13', NULL, 'PPR1.180610.011.greatlte.unknown.greatltexx', NULL, 'mobile', '2025-03-13 11:15:36', '2025-03-13 11:15:36', NULL, NULL, NULL, NULL, NULL, 11),
(15, '14618-P', 'jeudi', '12:24:18', NULL, '2025-03-13', NULL, '1870da10-1ee8-45bf-8e73-91f51035c5fa', NULL, 'mobile', '2025-03-13 12:24:18', '2025-03-13 12:24:18', NULL, 'accompagner mon fils', NULL, NULL, NULL, 9);

-- --------------------------------------------------------

--
-- Structure de la table `form_assessments`
--

CREATE TABLE `form_assessments` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `department_id` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `form_assessments`
--

INSERT INTO `form_assessments` (`id`, `name`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'Respect des horaires de travail', 1, '2024-07-14 21:38:24', '2024-07-14 21:38:24'),
(2, 'Assiduité au poste de travail', 1, '2024-07-14 21:39:43', '2024-07-14 21:39:43'),
(3, 'Capacité à rendre le travail au supérieure hiérachique', 1, '2024-07-14 21:40:40', '2024-07-14 21:40:40');

-- --------------------------------------------------------

--
-- Structure de la table `form_fields`
--

CREATE TABLE `form_fields` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `label` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `value` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `options` json DEFAULT NULL,
  `form_assessment_id` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `form_fields`
--

INSERT INTO `form_fields` (`id`, `name`, `type`, `label`, `value`, `options`, `form_assessment_id`, `created_at`, `updated_at`) VALUES
(1, 'note', 'number', 'Note', NULL, NULL, 1, '2024-07-14 21:38:24', '2024-07-14 21:38:24'),
(2, 'coefficient', 'text', 'Coefficient', '2', NULL, 1, '2024-07-14 21:38:24', '2024-08-08 15:52:33'),
(3, 'total', 'text', 'Total', NULL, NULL, 1, '2024-07-14 21:38:24', '2024-07-14 21:38:24'),
(4, 'observation', 'textarea', 'Observation', NULL, NULL, 1, '2024-07-14 21:38:24', '2024-07-14 21:38:24'),
(5, 'note', 'number', 'Note', NULL, NULL, 2, '2024-07-14 21:39:43', '2024-07-14 21:39:43'),
(6, 'coefficient', 'text', 'Coefficient', '3', NULL, 2, '2024-07-14 21:39:43', '2024-08-09 14:57:43'),
(7, 'total', 'text', 'Total', NULL, NULL, 2, '2024-07-14 21:39:43', '2024-07-14 21:39:43'),
(8, 'observation', 'textarea', 'Observation', NULL, NULL, 2, '2024-07-14 21:39:43', '2024-07-14 21:39:43'),
(9, 'note', 'number', 'Note', NULL, NULL, 3, '2024-07-14 21:40:40', '2024-07-14 21:40:40'),
(10, 'coefficient', 'text', 'Coefficient', '4', NULL, 3, '2024-07-14 21:40:40', '2024-08-09 14:57:53'),
(11, 'total', 'text', 'Total', NULL, NULL, 3, '2024-07-14 21:40:40', '2024-07-14 21:40:40'),
(12, 'observation', 'textarea', 'Observation', NULL, NULL, 3, '2024-07-14 21:40:40', '2024-07-14 21:40:40');

-- --------------------------------------------------------

--
-- Structure de la table `grades`
--

CREATE TABLE `grades` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `grades`
--

INSERT INTO `grades` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'A4', NULL, NULL),
(28, 'AM', '2024-09-08 09:41:52', '2024-09-08 09:41:52'),
(29, 'B3', '2024-09-08 09:41:53', '2024-09-08 09:41:53'),
(30, 'A5', '2024-09-08 09:41:53', '2024-09-08 09:41:53'),
(31, 'C', '2024-09-08 09:41:54', '2024-09-08 09:41:54'),
(32, 'E', '2024-09-08 09:41:54', '2024-09-08 09:41:54'),
(33, 'A3', '2024-09-08 09:41:56', '2024-09-08 09:41:56'),
(34, 'B1', '2024-09-08 09:41:59', '2024-09-08 09:41:59'),
(35, 'NA', '2024-09-08 09:42:01', '2024-09-08 09:42:01'),
(36, 'C1', '2024-09-08 09:42:06', '2024-09-08 09:42:06'),
(37, 'C3', '2024-09-08 09:42:13', '2024-09-08 09:42:13'),
(38, 'D1', '2024-09-08 09:42:16', '2024-09-08 09:42:16'),
(39, 'C2', '2024-09-08 09:42:26', '2024-09-08 09:42:26'),
(40, 'A6', '2024-09-08 09:42:30', '2024-09-08 09:42:30');

-- --------------------------------------------------------

--
-- Structure de la table `holidays`
--

CREATE TABLE `holidays` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `holidays`
--

INSERT INTO `holidays` (`id`, `name`, `date`, `created_at`, `updated_at`) VALUES
(1, 'Fête d\'indépendance', '2024-08-07', '2024-10-07 14:58:20', '2024-10-07 14:59:52'),
(2, 'Nouvel an', '2024-01-01', '2024-10-07 15:00:12', '2024-10-07 15:00:12'),
(3, 'Ramadan', '2025-03-26', '2025-03-13 12:13:37', '2025-03-13 12:13:51');

-- --------------------------------------------------------

--
-- Structure de la table `infos`
--

CREATE TABLE `infos` (
  `id` int UNSIGNED NOT NULL,
  `post_name` varchar(100) NOT NULL,
  `post_phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `department_id` int DEFAULT NULL,
  `content` text NOT NULL,
  `is_read` int NOT NULL DEFAULT '0',
  `status` int DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `infos`
--

INSERT INTO `infos` (`id`, `post_name`, `post_phone`, `department_id`, `content`, `is_read`, `status`, `created_at`, `updated_at`) VALUES
(7, 'GOH', NULL, NULL, 'RAS', 0, 1, '2025-01-22 16:01:44', '2025-01-22 16:01:54'),
(8, 'GOH', NULL, 37, 'test', 0, 1, '2025-03-12 17:20:12', '2025-03-12 17:20:36'),
(9, 'Angr', NULL, 32, 'MERCI', 0, 1, '2025-03-12 17:22:13', '2025-03-12 17:22:24'),
(11, 'Test', NULL, NULL, 'RAS', 0, 1, '2025-01-22 16:01:44', '2025-01-22 16:01:54'),
(12, 'Mme Abokon', NULL, 32, 'Attention au murs dans l\'hopital', 0, 1, '2025-03-13 11:38:08', '2025-03-13 11:38:40');

-- --------------------------------------------------------

--
-- Structure de la table `leaves`
--

CREATE TABLE `leaves` (
  `id` int NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `matricule` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(100) NOT NULL,
  `resumption` varchar(100) DEFAULT NULL,
  `number_absence` int DEFAULT NULL,
  `motif` text,
  `new_start_date` varchar(100) DEFAULT NULL,
  `new_end_date` varchar(100) DEFAULT NULL,
  `place_enjoyment` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `call_user_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `call_phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `interim` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'PENDING',
  `department_id` int NOT NULL,
  `service_id` int NOT NULL,
  `type_id` int NOT NULL,
  `user_id` int NOT NULL,
  `signatory_id` int DEFAULT NULL,
  `w_admin` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `leaves`
--

INSERT INTO `leaves` (`id`, `fullname`, `matricule`, `start_date`, `end_date`, `resumption`, `number_absence`, `motif`, `new_start_date`, `new_end_date`, `place_enjoyment`, `call_user_name`, `call_phone`, `interim`, `duration`, `status`, `department_id`, `service_id`, `type_id`, `user_id`, `signatory_id`, `w_admin`, `created_at`, `updated_at`) VALUES
(19, 'ABITTHY Abroh  Luther Clément', '00804-P', '2025-01-30', '2025-02-01', '2025-03-18', NULL, NULL, '2025-01-30', '2025-02-01', NULL, NULL, NULL, NULL, 2, 'SUCCESS', 30, 1, 3, 1, NULL, 1, '2025-01-29 23:45:52', '2025-03-16 23:18:25'),
(29, 'TAPE Naomi Grâce Esther épouse BAILLY', '18520-P', '2025-03-20', '2025-03-19', '2025-03-29', 2, NULL, '2025-03-20', '2025-03-19', 'MAN', 'GOH', '0757727688', NULL, NULL, 'SUCCESS', 31, 86, 1, 24, NULL, 1, '2025-03-16 23:14:07', '2025-03-16 23:14:46'),
(30, 'ABITTHY Abroh  Luther Clément', '00804-P', '2025-03-17', '2025-03-18', '2025-03-18', 5, 'ras', '2025-03-17', '2025-03-18', 'Assinie', 'test', '+1 (292) 101-8288', 'Kevin Mitnick', NULL, 'SUCCESS', 30, 1, 1, 1, NULL, 1, '2025-03-17 07:50:55', '2025-03-17 08:55:10'),
(31, 'ABITTHY Abroh  Luther Clément', '00804-P', '2025-03-18', '2025-03-20', '2025-03-22', 10, 'Conge', '2025-03-18', '2025-03-20', 'Man', NULL, NULL, NULL, NULL, 'SUCCESS', 30, 1, 1, 1, NULL, 1, '2025-03-17 08:58:26', '2025-03-17 08:58:44'),
(32, 'ABITTHY Abroh  Luther Clément', '00804-P', '2025-03-18', '2025-03-21', '2025-03-29', 5, NULL, '2025-03-18', '2025-03-21', NULL, NULL, NULL, NULL, NULL, 'SUCCESS', 30, 1, 1, 1, NULL, 1, '2025-03-17 09:05:56', '2025-03-17 09:06:19'),
(33, 'ABITTHY Abroh  Luther Clément', '00804-P', '2025-03-19', '2025-03-19', '2025-03-19', 20, NULL, '2025-03-19', '2025-03-19', NULL, NULL, NULL, NULL, NULL, 'SUCCESS', 30, 1, 1, 1, NULL, 1, '2025-03-17 09:07:23', '2025-03-17 09:07:35'),
(34, 'ABITTHY Abroh  Luther Clément', '00804-P', '1991-06-05', '1976-09-18', '1972-12-30', 2, 'Eu vitae cum do non', '1991-06-05', '1976-09-18', 'Laboris delectus il', 'fovugamatu', '+1 (656) 401-3708', 'Labore omnis sed est', NULL, 'SUCCESS', 30, 1, 1, 1, NULL, 1, '2025-03-17 10:07:45', '2025-03-17 10:08:07');

-- --------------------------------------------------------

--
-- Structure de la table `leave_flow`
--

CREATE TABLE `leave_flow` (
  `id` int UNSIGNED NOT NULL,
  `leave_id` int NOT NULL,
  `signatory_id` int NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `leave_flow`
--

INSERT INTO `leave_flow` (`id`, `leave_id`, `signatory_id`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 15, 1, 'RASS', 'SUCCESS', '2025-01-22 20:37:44', '2025-01-22 20:37:44'),
(2, 15, 1, 'RAS', 'SUCCESS', '2025-01-22 20:37:44', '2025-01-22 20:37:44'),
(3, 15, 1, 'RASS', 'SUCCESS', '2025-01-22 20:38:16', '2025-01-22 20:38:16'),
(4, 15, 1, 'RASS', 'SUCCESS', '2025-01-22 20:38:55', '2025-01-22 20:38:55'),
(5, 15, 1, 'RASS', 'SUCCESS', '2025-01-22 20:39:19', '2025-01-22 20:39:19'),
(6, 20, 1, 'Accepter', 'SUCCESS', '2025-03-12 18:01:08', '2025-03-12 18:01:08'),
(7, 21, 1, 'GOOD', 'SUCCESS', '2025-03-12 18:03:50', '2025-03-12 18:03:50'),
(8, 22, 1, 'test', 'SUCCESS', '2025-03-12 18:15:49', '2025-03-12 18:15:49'),
(9, 12, 1, 'ras', 'SUCCESS', '2025-03-12 22:08:24', '2025-03-12 22:08:24'),
(10, 16, 1, 'RAS', 'SUCCESS', '2025-03-12 22:29:06', '2025-03-12 22:29:06'),
(11, 23, 10, 'test', 'SUCCESS', '2025-03-12 22:45:53', '2025-03-12 22:45:53'),
(12, 23, 13, 'ras', 'SUCCESS', '2025-03-12 22:47:36', '2025-03-12 22:47:36'),
(13, 23, 1, 'ras', 'SUCCESS', '2025-03-12 22:49:09', '2025-03-12 22:49:09'),
(14, 23, 1, 'ras', 'SUCCESS', '2025-03-12 22:50:45', '2025-03-12 22:50:45'),
(15, 23, 1, 'ras', 'SUCCESS', '2025-03-12 22:54:55', '2025-03-12 22:54:55'),
(16, 23, 1, 'ras', 'SUCCESS', '2025-03-12 22:55:31', '2025-03-12 22:55:31'),
(17, 23, 1, 'ras', 'SUCCESS', '2025-03-12 22:57:42', '2025-03-12 22:57:42'),
(18, 23, 1, 'ras', 'SUCCESS', '2025-03-12 22:58:50', '2025-03-12 22:58:50'),
(19, 24, 10, 'test', 'SUCCESS', '2025-03-12 23:01:16', '2025-03-12 23:01:16'),
(20, 24, 13, 'test', 'SUCCESS', '2025-03-12 23:01:37', '2025-03-12 23:01:37'),
(21, 24, 1, 'test', 'SUCCESS', '2025-03-12 23:01:51', '2025-03-12 23:01:51'),
(22, 25, 10, 'RAS', 'SUCCESS', '2025-03-13 09:51:54', '2025-03-13 09:51:54'),
(23, 25, 13, 'RAs', 'SUCCESS', '2025-03-13 09:52:18', '2025-03-13 09:52:18'),
(24, 25, 1, 'RAS', 'SUCCESS', '2025-03-13 09:55:00', '2025-03-13 09:55:00'),
(25, 28, 14, NULL, 'SUCCESS', '2025-03-16 23:06:22', '2025-03-16 23:06:22'),
(26, 28, 1, NULL, 'SUCCESS', '2025-03-16 23:08:21', '2025-03-16 23:08:21'),
(27, 29, 14, NULL, 'SUCCESS', '2025-03-16 23:14:26', '2025-03-16 23:14:26'),
(28, 29, 1, NULL, 'SUCCESS', '2025-03-16 23:14:46', '2025-03-16 23:14:46'),
(29, 19, 1, NULL, 'SUCCESS', '2025-03-16 23:18:25', '2025-03-16 23:18:25'),
(30, 30, 10, NULL, 'SUCCESS', '2025-03-17 08:55:10', '2025-03-17 08:55:10'),
(31, 31, 1, NULL, 'SUCCESS', '2025-03-17 08:58:44', '2025-03-17 08:58:44'),
(32, 32, 1, NULL, 'SUCCESS', '2025-03-17 09:06:19', '2025-03-17 09:06:19'),
(33, 33, 1, NULL, 'SUCCESS', '2025-03-17 09:07:35', '2025-03-17 09:07:35'),
(34, 34, 1, NULL, 'SUCCESS', '2025-03-17 10:08:07', '2025-03-17 10:08:07');

-- --------------------------------------------------------

--
-- Structure de la table `medias`
--

CREATE TABLE `medias` (
  `id` int UNSIGNED NOT NULL,
  `src` varchar(100) NOT NULL,
  `source_id` int NOT NULL,
  `source` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `medias`
--

INSERT INTO `medias` (`id`, `src`, `source_id`, `source`, `created_at`, `updated_at`) VALUES
(2, '/informations/20240618181223.jpg', 7, 'info', '2024-06-18 18:12:23', '2024-06-18 18:12:23'),
(3, '/informations/20240627101141.png', 8, 'info', '2024-06-27 09:11:41', '2024-06-27 09:11:41'),
(4, '/flows/20240630124619.jpeg', 1, 'flow', '2024-06-30 12:46:19', '2024-06-30 12:46:19'),
(5, '/flows/20240630125140.jpeg', 1, 'flow', '2024-06-30 12:51:40', '2024-06-30 12:51:40'),
(6, '/flows/20240630125325.jpeg', 1, 'flow', '2024-06-30 12:53:25', '2024-06-30 12:53:25'),
(7, '/flows/20240630131510.jpeg', 1, 'flow', '2024-06-30 13:15:10', '2024-06-30 13:15:10'),
(8, '/flows/20240630131558.jpg', 2, 'flow', '2024-06-30 13:15:58', '2024-06-30 13:15:58'),
(9, '/flows/20240630131859.jpg', 3, 'flow', '2024-06-30 13:18:59', '2024-06-30 13:18:59'),
(10, '/flows/20240630202259.jpg', 5, 'flow', '2024-06-30 20:22:59', '2024-06-30 20:22:59'),
(11, '/flows/20240630232225.png', 7, 'flow', '2024-06-30 23:22:25', '2024-06-30 23:22:25'),
(12, '/flows/20240630234748.jpeg', 8, 'flow', '2024-06-30 23:47:48', '2024-06-30 23:47:48'),
(13, '/flows/20240630234853.jpg', 9, 'flow', '2024-06-30 23:48:53', '2024-06-30 23:48:53'),
(14, '/flows/20240630234906.jpg', 10, 'flow', '2024-06-30 23:49:06', '2024-06-30 23:49:06'),
(15, '/flows/20240630235318.png', 11, 'flow', '2024-06-30 23:53:18', '2024-06-30 23:53:18'),
(16, '/flows/20240701114903.jpeg', 2, 'flow', '2024-07-01 10:49:03', '2024-07-01 10:49:03'),
(17, '/flows/20240702090644.png', 1, 'flow', '2024-07-02 08:06:44', '2024-07-02 08:06:44'),
(18, '/informations/20240702091839.png', 9, 'info', '2024-07-02 08:18:39', '2024-07-02 08:18:39'),
(19, '/informations/20240702091942.png', 10, 'info', '2024-07-02 08:19:42', '2024-07-02 08:19:42'),
(20, '/flows/20240702104144.jpeg', 2, 'flow', '2024-07-02 09:41:44', '2024-07-02 09:41:44'),
(21, '/flows/20240702114433.jpeg', 3, 'flow', '2024-07-02 11:44:33', '2024-07-02 11:44:33'),
(22, '/flows/20240702114509.jpeg', 4, 'flow', '2024-07-02 11:45:09', '2024-07-02 11:45:09'),
(23, '/flows/20240702114542.jpeg', 5, 'flow', '2024-07-02 11:45:42', '2024-07-02 11:45:42'),
(24, '/flows/20240702123435.jpeg', 1, 'flow', '2024-07-02 11:34:35', '2024-07-02 11:34:35'),
(25, '/flows/20240702124156.jpeg', 2, 'flow', '2024-07-02 11:41:56', '2024-07-02 11:41:56'),
(26, '/flows/20240702124245.jpeg', 1, 'flow', '2024-07-02 11:42:45', '2024-07-02 11:42:45'),
(27, '/flows/20240702124300.jpeg', 2, 'flow', '2024-07-02 11:43:00', '2024-07-02 11:43:00'),
(28, '/flows/20240702124935.jpeg', 3, 'flow', '2024-07-02 11:49:35', '2024-07-02 11:49:35'),
(29, '/flows/20240702125018.jpeg', 4, 'flow', '2024-07-02 11:50:18', '2024-07-02 11:50:18'),
(30, '/flows/20240702125030.jpeg', 5, 'flow', '2024-07-02 11:50:30', '2024-07-02 11:50:30'),
(31, '/flows/20240702125053.jpeg', 6, 'flow', '2024-07-02 11:50:53', '2024-07-02 11:50:53'),
(32, '/flows/20240702133512.jpeg', 8, 'flow', '2024-07-02 12:35:12', '2024-07-02 12:35:12'),
(33, '/flows/20240702133552.jpeg', 9, 'flow', '2024-07-02 12:35:52', '2024-07-02 12:35:52'),
(34, '/flows/20240702133621.jpg', 10, 'flow', '2024-07-02 12:36:21', '2024-07-02 12:36:21'),
(35, '/informations/20240703112125.jpg', 11, 'info', '2024-07-03 10:21:25', '2024-07-03 10:21:25'),
(36, '/informations/20240715091249.pdf', 12, 'info', '2024-07-15 09:12:49', '2024-07-15 09:12:49'),
(37, '/flows/20240811151940.jpg', 1, 'flow', '2024-08-11 15:19:40', '2024-08-11 15:19:40'),
(38, '/flows/20240811160348.jpg', 1, 'flow', '2024-08-11 16:03:48', '2024-08-11 16:03:48'),
(39, '/flows/20240811160525.png', 2, 'flow', '2024-08-11 16:05:25', '2024-08-11 16:05:25'),
(40, '/flows/20240811160617.jpg', 3, 'flow', '2024-08-11 16:06:17', '2024-08-11 16:06:17'),
(41, '/informations/20240811162809.pdf', 13, 'info', '2024-08-11 16:28:09', '2024-08-11 16:28:09'),
(42, '/flows/20240814183552.png', 1, 'flow', '2024-08-14 18:35:53', '2024-08-14 18:35:53'),
(43, '/flows/20240814184114.png', 2, 'flow', '2024-08-14 18:41:14', '2024-08-14 18:41:14'),
(44, '/flows/20240814184145.png', 3, 'flow', '2024-08-14 18:41:45', '2024-08-14 18:41:45'),
(45, '/informations/20240818133457.jpg', 14, 'info', '2024-08-18 13:34:57', '2024-08-18 13:34:57'),
(46, '/informations/20240818135656.png', 15, 'info', '2024-08-18 13:56:56', '2024-08-18 13:56:56'),
(47, '/informations/20240818135722.jpeg', 17, 'info', '2024-08-18 13:57:22', '2024-08-18 13:57:22'),
(49, '/certificats/20240905132706.pdf', 2, 'certificat', '2024-09-05 13:27:06', '2024-09-05 13:27:06'),
(50, '/informations/20240912174138.png', 2, 'info', '2024-09-12 17:41:38', '2024-09-12 17:41:38'),
(51, '/informations/20240912174324.pdf', 3, 'info', '2024-09-12 17:43:24', '2024-09-12 17:43:24'),
(52, '/certificats/20240915090345.pdf', 4, 'certificat', '2024-09-15 09:03:45', '2024-09-15 09:03:45'),
(53, '/certificats/20240915092815.pdf', 4, 'certificat', '2024-09-15 09:28:15', '2024-09-15 09:28:15'),
(54, '/certificats/20241125221205.pdf', 1, 'certificat', '2024-11-25 22:12:05', '2024-11-25 22:12:05'),
(55, '/informations/20241206043951.jpg', 2, 'info', '2024-12-06 04:39:51', '2024-12-06 04:39:51'),
(56, '/certificats/20241206044514.pdf', 2, 'certificat', '2024-12-06 04:45:14', '2024-12-06 04:45:14'),
(57, '/certificats/20241206044614.pdf', 2, 'certificat', '2024-12-06 04:46:14', '2024-12-06 04:46:14'),
(58, '/informations/20250109145347.jpg', 5, 'info', '2025-01-09 14:53:47', '2025-01-09 14:53:47'),
(59, '/informations/20250122160144.png', 7, 'info', '2025-01-22 16:01:44', '2025-01-22 16:01:44'),
(60, '/certificats/20250130221912.pdf', 27, 'certificat', '2025-01-30 22:19:12', '2025-01-30 22:19:12'),
(61, '/informations/20250312172013.jpeg', 8, 'info', '2025-03-12 17:20:13', '2025-03-12 17:20:13'),
(62, '/informations/20250312173044.png', 10, 'info', '2025-03-12 17:30:44', '2025-03-12 17:30:44'),
(63, '/certificats/20250312180647.pdf', 29, 'certificat', '2025-03-12 18:06:47', '2025-03-12 18:06:47'),
(64, '/flows/20250312224554.png', 11, 'flow', '2025-03-12 22:45:54', '2025-03-12 22:45:54'),
(65, '/flows/20250312224736.png', 12, 'flow', '2025-03-12 22:47:36', '2025-03-12 22:47:36'),
(66, '/flows/20250312225851.png', 18, 'flow', '2025-03-12 22:58:51', '2025-03-12 22:58:51'),
(67, '/flows/20250312230116.png', 19, 'flow', '2025-03-12 23:01:16', '2025-03-12 23:01:16'),
(68, '/flows/20250312230137.png', 20, 'flow', '2025-03-12 23:01:37', '2025-03-12 23:01:37'),
(69, '/flows/20250312230152.png', 21, 'flow', '2025-03-12 23:01:52', '2025-03-12 23:01:52'),
(70, '/flows/20250313095154.png', 22, 'flow', '2025-03-13 09:51:54', '2025-03-13 09:51:54'),
(71, '/flows/20250313095218.png', 23, 'flow', '2025-03-13 09:52:18', '2025-03-13 09:52:18'),
(72, '/flows/20250313095501.png', 24, 'flow', '2025-03-13 09:55:01', '2025-03-13 09:55:01'),
(73, '/flows/20250316230622.png', 25, 'flow', '2025-03-16 23:06:22', '2025-03-16 23:06:22'),
(74, '/flows/20250316230824.png', 26, 'flow', '2025-03-16 23:08:24', '2025-03-16 23:08:24'),
(75, '/flows/20250316231426.png', 27, 'flow', '2025-03-16 23:14:26', '2025-03-16 23:14:26'),
(76, '/flows/20250316231448.png', 28, 'flow', '2025-03-16 23:14:48', '2025-03-16 23:14:48'),
(77, '/flows/20250317085512.png', 30, 'flow', '2025-03-17 08:55:12', '2025-03-17 08:55:12'),
(78, '/flows/20250317085845.png', 31, 'flow', '2025-03-17 08:58:45', '2025-03-17 08:58:45'),
(79, '/flows/20250317090621.jpeg', 32, 'flow', '2025-03-17 09:06:21', '2025-03-17 09:06:21'),
(80, '/flows/20250317090738.jpeg', 33, 'flow', '2025-03-17 09:07:38', '2025-03-17 09:07:38'),
(81, '/flows/20250317100808.png', 34, 'flow', '2025-03-17 10:08:08', '2025-03-17 10:08:08');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1),
(6, 'App\\Models\\Admin', 6),
(9, 'App\\Models\\Admin', 7),
(10, 'App\\Models\\Admin', 8),
(1, 'App\\Models\\Admin', 8),
(1, 'App\\Models\\Admin', 10),
(1, 'App\\Models\\Admin', 11),
(1, 'App\\Models\\Admin', 12),
(1, 'App\\Models\\Admin', 13),
(1, 'App\\Models\\Admin', 14);

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

CREATE TABLE `parametres` (
  `id` int NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `year` varchar(100) DEFAULT NULL,
  `value` text,
  `slug` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `parametres`
--

INSERT INTO `parametres` (`id`, `name`, `year`, `value`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Heure arrivée', NULL, '11:30', 'heure_arrive', '2025-03-13 11:10:10', '2025-03-13 11:01:24'),
(2, 'tolerance de retard', NULL, '30', 'tolerance_de_retard', '2024-12-04 10:17:37', '2024-06-27 15:23:05'),
(4, 'Deadline absence', NULL, '30', 'deadline_absence', '2024-12-04 10:17:43', '2024-10-07 15:23:19'),
(6, 'Nombre de congé annuel 2024', '2024', '30', 'nombre_de_congé_annuel_2024', '2024-12-04 10:18:07', '2024-12-03 21:20:43');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id`, `email`, `token`, `created_at`) VALUES
(12, 'test@test.fr', '$2y$12$KRp4.Mt4LmwpuC0WOjfz8egpXm8eZllHOSgkx61RLp297wU.7BJ9a', '2024-10-07 18:22:32'),
(13, 'a.abokon@madgi.ci', '$2y$12$jwdR7IXrSVy.DytTSNmXm.AmG28K6mNseho30TONrsR7ZF/G.IySq', '2024-11-25 10:15:16'),
(14, 'k.mbra@madgi.ci', '$2y$12$fL2gWmIcPxkdHY7TgHVwzuk7ZqrGWPxfQSXxtmlckXvldS.FEPgyS', '2024-11-25 21:50:58'),
(18, 'johndoe@gmail.com', '$2y$12$DZ4J8fgP/T7KCmieAttPau7dGGEoi61pMbNY8fBseCtyoyi1KtgUa', '2024-12-03 14:43:02'),
(20, 'ananieric16@gmail.com', '$2y$12$WcSlclXBB2hdGMbcExykK.Fz2lL7hSswZqF4ZH5M//jl/EmVrgRNS', '2024-12-03 14:52:28');

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'Personnel', 'IMPORT Personnel', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(3, 'settings', 'READ settings', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(4, 'settings', 'UPDATE settings', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(5, 'Emargement', 'READ Emargement', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(6, 'Emargement', 'CREATE Emargement', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(7, 'Emargement', 'DISABLE Emargement', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(8, 'Emargement', 'EXPORT Emargement', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(9, 'Rôle', 'CREATE Rôle', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(10, 'Rôle', 'READ Rôle', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(11, 'Rôle', 'UPDATE Rôle', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(12, 'Rôle', 'DELETE Rôle', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(13, 'Admin', 'CREATE Admin', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(14, 'Admin', 'READ Admin', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(15, 'Admin', 'UPDATE Admin', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(16, 'Admin', 'DELETE Admin', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(17, 'Bannière', 'CREATE Bannière', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(18, 'Bannière', 'READ Bannière', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(19, 'Bannière', 'UPDATE Bannière', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(20, 'Bannière', 'DELETE Bannière', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(21, 'Information', 'CREATE Information', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(22, 'Information', 'READ Information', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(23, 'Information', 'UPDATE Information', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(24, 'Information', 'DELETE Information', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(25, 'Agent', 'CREATE Agent', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(26, 'Agent', 'READ Agent', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(27, 'Agent', 'UPDATE Agent', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(28, 'Agent', 'DELETE Agent', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(29, 'Département', 'CREATE Département', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(30, 'Département', 'READ Département', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(31, 'Département', 'UPDATE Département', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(32, 'Département', 'DELETE Département', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(33, 'Grade', 'CREATE Grade', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(34, 'Grade', 'READ Grade', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(35, 'Grade', 'UPDATE Grade', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(36, 'Grade', 'DELETE Grade', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(37, 'Service', 'CREATE Service', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(38, 'Service', 'READ Service', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(39, 'Service', 'UPDATE Service', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(40, 'Service', 'DELETE Service', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(41, 'Site', 'CREATE Site', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(42, 'Site', 'READ Site', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(43, 'Site', 'UPDATE Site', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(44, 'Site', 'DELETE Site', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(45, 'Congé', 'CREATE Congé', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(46, 'Congé', 'READ Congé', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(47, 'Congé', 'UPDATE Congé', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(48, 'Congé', 'DELETE Congé', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(49, 'Congé', 'SIGNER Congé', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(50, 'Employé', 'READ Employé', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(51, 'Employé', 'UPDATE Employé', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(52, 'Employé', 'DISABLE Employé', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(53, 'Employé', 'DELETE Employé', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(54, 'Employé', 'EXPORT Employé', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(55, 'Stagiaire', 'READ Stagiaire', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(56, 'Stagiaire', 'UPDATE Stagiaire', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(57, 'Stagiaire', 'DISABLE Stagiaire', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(58, 'Stagiaire', 'DELETE Stagiaire', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(59, 'Stagiaire', 'EXPORT Stagiaire', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(60, 'Vacataire', 'READ Vacataire', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(61, 'Vacataire', 'UPDATE Vacataire', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(62, 'Vacataire', 'DISABLE Vacataire', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(63, 'Vacataire', 'DELETE Vacataire', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(64, 'Vacataire', 'EXPORT Vacataire', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(65, 'Evaluation', 'CREATE Evaluation', 'admin', '2024-08-15 00:42:28', '2024-08-15 00:42:28'),
(66, 'Evaluation', 'READ Evaluation', 'admin', '2024-08-15 00:42:28', '2024-08-15 00:42:28'),
(67, 'Evaluation', 'UPDATE Evaluation', 'admin', '2024-08-15 00:42:28', '2024-08-15 00:42:28'),
(68, 'Evaluation', 'DELETE Evaluation', 'admin', '2024-08-15 00:42:28', '2024-08-15 00:42:28'),
(69, 'Formulaire', 'CREATE Formulaire', 'admin', '2024-08-15 00:42:28', '2024-08-15 00:42:28'),
(70, 'Formulaire', 'READ Formulaire', 'admin', '2024-08-15 00:42:28', '2024-08-15 00:42:28'),
(71, 'Formulaire', 'UPDATE Formulaire', 'admin', '2024-08-15 00:42:28', '2024-08-15 00:42:28'),
(72, 'Formulaire', 'DELETE Formulaire', 'admin', '2024-08-15 00:42:28', '2024-08-15 00:42:28'),
(73, 'Evaluation', 'ACCESS Historique', 'admin', '2024-08-15 00:42:28', '2024-08-15 00:42:28'),
(74, 'Certificat', 'CREATE Certificat', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(75, 'Certificat', 'READ Certificat', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(76, 'Certificat', 'UPDATE Certificat', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(77, 'Certificat', 'DELETE Certificat', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(78, 'Déblocage', 'READ Déblocage', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(79, 'Déblocage', 'UPDATE Déblocage', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(80, 'Salarié', 'READ Salarié', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(81, 'Salarié', 'UPDATE Salarié', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(82, 'Salarié', 'DISABLE Salarié', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(83, 'Salarié', 'DELETE Salarié', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(84, 'Salarié', 'EXPORT Salarié', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(85, 'Fonctionnaire', 'READ Fonctionnaire', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(86, 'Fonctionnaire', 'UPDATE Fonctionnaire', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(87, 'Fonctionnaire', 'DISABLE Fonctionnaire', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(88, 'Fonctionnaire', 'DELETE Fonctionnaire', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(89, 'Fonctionnaire', 'EXPORT Fonctionnaire', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(90, 'Emargement', 'UPDATE Emargement', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(91, 'Férié', 'CREATE Férié', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(92, 'Férié', 'READ Férié', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(93, 'Férié', 'UPDATE Férié', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(94, 'Férié', 'DELETE Férié', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(95, 'Collaborateurs extérieur', 'EXPORT Collaborateurs extérieur', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(96, 'Collaborateurs extérieur', 'DELETE Collaborateurs extérieur', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(97, 'Collaborateurs extérieur', 'DISABLE Collaborateurs extérieur', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(98, 'Collaborateurs extérieur', 'UPDATE Collaborateurs extérieur', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(99, 'Collaborateurs extérieur', 'READ Collaborateurs extérieur', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(100, 'CDD', 'EXPORT CDD', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(101, 'CDD', 'DELETE CDD', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(102, 'CDD', 'DISABLE CDD', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(103, 'CDD', 'UPDATE CDD', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(104, 'CDD', 'READ CDD', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(105, 'Mise en disponibilité', 'EXPORT Mise en disponibilité', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(106, 'Mise en disponibilité', 'DELETE Mise en disponibilité', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(107, 'Mise en disponibilité', 'DISABLE Mise en disponibilité', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(108, 'Mise en disponibilité', 'UPDATE Mise en disponibilité', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(109, 'Mise en disponibilité', 'READ Mise en disponibilité', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(110, 'settings', 'CREATE settings', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50'),
(111, 'settings', 'DELETE settings', 'admin', '2024-07-02 11:25:50', '2024-07-02 11:25:50');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`, `expires_at`) VALUES
(43, 'App\\Models\\User', 200, 'auth_token', 'b6c7a2b7a6a981cce95cc7a5b4c301a8b3741f305c73628a30e53fd0727bfcaa', '[\"*\"]', '2024-10-13 12:15:00', '2024-10-13 12:15:00', '2024-10-13 12:15:00', NULL),
(44, 'App\\Models\\User', 200, 'auth_token', '722b184525e611384da5d18ff4ee6855678044f249184be877678c23d20b58c4', '[\"*\"]', '2024-10-21 10:17:20', '2024-10-13 12:19:17', '2024-10-21 10:17:20', NULL),
(45, 'App\\Models\\User', 200, 'auth_token', '80c48ed1f3e9909a97c0eca8d82eba40f6e7ee88f2efae18bc73302cf71864a7', '[\"*\"]', '2024-10-14 12:16:56', '2024-10-14 12:12:50', '2024-10-14 12:16:56', NULL),
(46, 'App\\Models\\User', 200, 'auth_token', '3dfd52e663802338b245b9657fca252163cadd3c2afe5ca5e5b6c0aa4e7a85d0', '[\"*\"]', '2024-10-14 12:26:06', '2024-10-14 12:18:45', '2024-10-14 12:26:06', NULL),
(47, 'App\\Models\\User', 200, 'auth_token', '7d7c860d77a1d7350d83e4e6c00381e948ac36fd4586c47a833384c743462609', '[\"*\"]', '2024-10-21 14:37:57', '2024-10-21 14:37:57', '2024-10-21 14:37:57', NULL),
(48, 'App\\Models\\User', 200, 'auth_token', '0cfc0df071430a11539c8c024b8980b1de71bde3ffd1359413f0a3fd6a316a17', '[\"*\"]', '2024-10-21 14:38:59', '2024-10-21 14:37:57', '2024-10-21 14:38:59', NULL),
(136, 'App\\Models\\User', 24, 'auth_token', '3f6883fc5b60714bd8386a0bc3c13219b6f3a939a0074c2146f5e5e481b1ee06', '[\"*\"]', '2025-02-15 19:53:44', '2024-11-18 15:24:53', '2025-02-15 19:53:44', NULL),
(139, 'App\\Models\\User', 129, 'auth_token', 'a78c0c1cd6de4e3b4df2df6341cc6b13defcdf650298773eb7658c1db6f33273', '[\"*\"]', NULL, '2024-11-20 10:56:15', '2024-11-20 10:56:15', NULL),
(140, 'App\\Models\\User', 129, 'auth_token', '77c6779f97bba9735bb857eb338274e6f0daa863118da3b62f2c319fec7f7fa5', '[\"*\"]', NULL, '2024-11-20 10:56:17', '2024-11-20 10:56:17', NULL),
(141, 'App\\Models\\User', 129, 'auth_token', '587db0464573c4b38c4ac25f13b614fd691407ee95710e11e6e580692c0c9921', '[\"*\"]', '2024-11-20 10:58:22', '2024-11-20 10:58:21', '2024-11-20 10:58:22', NULL),
(142, 'App\\Models\\User', 129, 'auth_token', '7e2e786678f1573d6be0bd4598b1b1924fb6e4c915e94373b4aecf70d34f5fc2', '[\"*\"]', '2024-12-23 20:29:36', '2024-11-20 10:58:22', '2024-12-23 20:29:36', NULL),
(156, 'App\\Models\\User', 10, 'auth_token', '483ca8a8579e2e8a7d9d97dd813aa3dcdf3a0f1c6e500e0da28d1b07d27ca909', '[\"*\"]', '2025-03-12 17:45:05', '2025-03-12 17:04:24', '2025-03-12 17:45:05', NULL),
(164, 'App\\Models\\User', 201, 'auth_token', '9ed21c6b50c9a2fa4eeacd48c3c077b97c81848d7545b2f7f58d17cd028046d3', '[\"*\"]', '2025-03-13 11:17:03', '2025-03-13 11:12:08', '2025-03-13 11:17:03', NULL),
(165, 'App\\Models\\User', 11, 'auth_token', '611c3b1417e52f02b4bc275067ae32254d05f8bc50ad0551d1c2501382b4cf6e', '[\"*\"]', '2025-03-13 11:38:42', '2025-03-13 11:14:26', '2025-03-13 11:38:42', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `retards`
--

CREATE TABLE `retards` (
  `id` int NOT NULL,
  `matricule` text,
  `mois` date DEFAULT NULL,
  `anne` year DEFAULT NULL,
  `quantit` int NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `retards`
--

INSERT INTO `retards` (`id`, `matricule`, `mois`, `anne`, `quantit`, `updated_at`, `created_at`) VALUES
(1, '00804-P', '2024-11-03', '2024', 1, '2024-11-03 23:57:46', '2024-11-03 23:57:46'),
(2, '00804-P', '2024-11-04', '2024', 1, '2024-11-04 23:10:38', '2024-11-04 23:10:38');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Root', 'admin', '2024-06-26 00:30:01', '2024-06-26 00:30:01'),
(4, 'Signataire', 'admin', '2024-07-02 09:49:58', '2024-07-02 09:49:58'),
(5, 'Chef de Département', 'admin', '2024-07-02 12:05:05', '2024-07-02 12:05:05'),
(9, 'RH', 'admin', '2024-08-15 10:12:09', '2024-08-15 10:12:09'),
(10, 'Responsable Cellule Gestion des Effectifs et Compétences', 'admin', '2024-10-08 10:29:19', '2024-10-08 10:29:19');

-- --------------------------------------------------------

--
-- Structure de la table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(46, 4),
(47, 4),
(49, 4),
(45, 5),
(46, 5),
(47, 5),
(48, 5),
(49, 5),
(67, 9),
(74, 9),
(75, 9),
(76, 9),
(77, 9),
(2, 10),
(6, 10),
(5, 10),
(7, 10),
(8, 10),
(90, 10),
(21, 10),
(22, 10),
(23, 10),
(24, 10),
(25, 10),
(26, 10),
(27, 10),
(28, 10),
(29, 10),
(30, 10),
(31, 10),
(32, 10),
(33, 10),
(34, 10),
(35, 10),
(36, 10),
(37, 10),
(38, 10),
(39, 10),
(40, 10),
(45, 10),
(46, 10),
(47, 10),
(48, 10),
(49, 10),
(50, 10),
(51, 10),
(52, 10),
(53, 10),
(54, 10),
(55, 10),
(56, 10),
(57, 10),
(58, 10),
(59, 10),
(60, 10),
(61, 10),
(62, 10),
(63, 10),
(64, 10),
(74, 10),
(75, 10),
(76, 10),
(77, 10),
(80, 10),
(81, 10),
(82, 10),
(83, 10),
(84, 10),
(85, 10),
(86, 10),
(87, 10),
(88, 10),
(89, 10),
(2, 1),
(3, 1),
(4, 1),
(6, 1),
(5, 1),
(7, 1),
(8, 1),
(90, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(73, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(99, 1),
(98, 1),
(97, 1),
(96, 1),
(95, 1),
(104, 1),
(103, 1),
(102, 1),
(101, 1),
(100, 1),
(109, 1),
(108, 1),
(107, 1),
(106, 1),
(105, 1);

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Bureau AG', NULL, NULL),
(3, 'Informatique', '2024-07-03 13:11:49', '2024-10-24 09:58:38'),
(85, 'Médical', '2024-09-08 09:41:53', '2024-09-08 09:41:53'),
(86, 'Ressources Humaines', '2024-09-08 09:41:53', '2024-10-24 09:59:39'),
(88, 'Administratif', '2024-09-08 09:41:54', '2024-09-08 09:41:54'),
(89, 'Technique', '2024-09-08 09:41:54', '2024-09-08 09:41:54'),
(90, 'Pharmacie', '2024-09-08 09:41:54', '2024-09-08 09:41:54'),
(92, 'Qualité', '2024-09-08 09:41:56', '2024-09-08 09:41:56'),
(93, 'Gestion des fichiers precomptes et prestations sociales', '2024-09-08 09:41:57', '2024-09-08 09:41:57'),
(96, 'Moyens Généraux', '2024-09-08 09:41:58', '2024-09-08 09:41:58'),
(97, 'Cabinet PCA', '2024-09-08 09:41:58', '2024-09-08 09:41:58'),
(99, 'Santé', '2024-09-08 09:42:00', '2024-09-08 09:42:00'),
(101, 'Médical / unité de Néphrologie', '2024-09-08 09:42:00', '2024-09-08 09:42:00'),
(102, 'Aide au diagnostic', '2024-09-08 09:42:01', '2024-09-08 09:42:01'),
(103, 'Secrétariat Général', '2024-09-08 09:42:01', '2024-10-24 09:28:03'),
(106, 'Comptabilité ', '2024-09-08 09:42:02', '2024-09-08 09:42:02'),
(107, 'Immobilier', '2024-09-08 09:42:03', '2024-09-08 09:42:03'),
(108, 'Finances et Trésorerie', '2024-09-08 09:42:05', '2024-10-24 09:26:28'),
(110, 'Médical / Unité de Surveillance Générale', '2024-09-08 09:42:06', '2024-09-08 09:42:06'),
(112, 'Communication et Relations Publiques', '2024-09-08 09:42:12', '2024-09-08 09:42:12'),
(113, 'Secrétariat général', '2024-09-08 09:42:12', '2024-09-08 09:42:12'),
(115, 'Comptabilité', '2024-09-08 09:42:14', '2024-09-08 09:42:14'),
(116, 'Juridique', '2024-09-08 09:42:16', '2024-09-08 09:42:16'),
(117, 'Prévention', '2024-09-08 09:42:20', '2024-09-08 09:42:20'),
(119, 'Suivi et de l\' Evaluation Médicale', '2024-09-08 09:42:23', '2024-09-08 09:42:23'),
(120, 'Assurances  Diverses', '2024-09-08 09:42:29', '2024-10-24 09:25:35'),
(121, 'Audit et contrôle de Gestion', '2024-09-08 09:42:32', '2024-09-08 09:42:32'),
(122, 'Sous Département Médical', '2024-09-08 09:42:33', '2024-09-08 09:42:33'),
(123, 'Sous Département Administration Hospitalière', '2024-09-08 09:42:36', '2024-09-08 09:42:36'),
(124, 'Administratif et Financier  CEC - MADGI', '2024-12-18 08:57:11', '2024-12-18 08:57:58'),
(125, 'Clientèle CEC - MADGI', '2024-12-18 08:58:29', '2024-12-18 08:58:29');

-- --------------------------------------------------------

--
-- Structure de la table `service_responsable`
--

CREATE TABLE `service_responsable` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `service_id` int DEFAULT NULL,
  `statut` int NOT NULL DEFAULT '2',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `signatories`
--

CREATE TABLE `signatories` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `department_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sites`
--

CREATE TABLE `sites` (
  `id` int NOT NULL,
  `name` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `sites`
--

INSERT INTO `sites` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Club House', '2024-11-22 01:09:01', '2024-08-18 13:25:11'),
(6, 'HMI-KF', '2024-09-08 09:41:53', '2024-09-08 09:41:53');

-- --------------------------------------------------------

--
-- Structure de la table `transmissions`
--

CREATE TABLE `transmissions` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `leave_id` int DEFAULT NULL,
  `certificate_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `transmissions`
--

INSERT INTO `transmissions` (`id`, `user_id`, `leave_id`, `certificate_id`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL, '2024-11-25 22:12:05', '2024-11-25 22:12:05'),
(2, 129, NULL, NULL, '2024-12-06 04:45:14', '2024-12-06 04:45:14'),
(3, 129, NULL, NULL, '2024-12-06 04:46:14', '2024-12-06 04:46:14'),
(4, 3, NULL, NULL, '2025-01-30 22:19:12', '2025-01-30 22:19:12'),
(5, 4, NULL, NULL, '2025-01-30 22:19:14', '2025-01-30 22:19:14'),
(6, 5, NULL, NULL, '2025-01-30 22:19:14', '2025-01-30 22:19:14'),
(7, 1, NULL, NULL, '2025-03-12 18:06:47', '2025-03-12 18:06:47'),
(8, 2, NULL, NULL, '2025-03-12 18:06:50', '2025-03-12 18:06:50');

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `id` int NOT NULL,
  `name` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'EMPLOYER', NULL, NULL),
(2, 'STAGIAIRES', NULL, NULL),
(3, 'VACCATAIRES ET CDD', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_leaves`
--

CREATE TABLE `type_leaves` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `type_leaves`
--

INSERT INTO `type_leaves` (`id`, `name`) VALUES
(1, 'Demande de conge annuel'),
(2, 'Demande d\'autorisation d\'abscence');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nom` text,
  `matricule` text,
  `mat_without_space` varchar(100) DEFAULT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `specialite` text,
  `situation_convention` text,
  `Date_validation` datetime DEFAULT NULL,
  `date_signature` datetime DEFAULT NULL,
  `fonction` text,
  `type_stage` varchar(100) DEFAULT NULL,
  `departement` int DEFAULT NULL,
  `situation_stage` text,
  `date_validations` varchar(100) DEFAULT NULL,
  `reconduction` text,
  `categorie` int DEFAULT NULL,
  `etat` int DEFAULT NULL,
  `statut` int DEFAULT '1',
  `site` int DEFAULT NULL,
  `date_occupation_p` date DEFAULT NULL,
  `grade` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `date_entre_mad` date DEFAULT NULL,
  `date_fonction` date DEFAULT NULL,
  `situation_matrim` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `nombre_enfant` int DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `statut_mad` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `service` int DEFAULT NULL,
  `genre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `diplome` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `tel` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `confession_relg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `cnps` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `type` int DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `date_debut_mise_disponibilite` varchar(100) DEFAULT NULL,
  `date_fin_mise_disponibilite` varchar(100) DEFAULT NULL,
  `lock_nb` int NOT NULL DEFAULT '0',
  `lock_date` varchar(100) DEFAULT NULL,
  `is_salarie` int NOT NULL DEFAULT '0',
  `is_register` int NOT NULL DEFAULT '0',
  `is_medical` int NOT NULL DEFAULT '0',
  `type_device` text,
  `unique_web_identifier` text,
  `activity_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `matricule`, `mat_without_space`, `email`, `specialite`, `situation_convention`, `Date_validation`, `date_signature`, `fonction`, `type_stage`, `departement`, `situation_stage`, `date_validations`, `reconduction`, `categorie`, `etat`, `statut`, `site`, `date_occupation_p`, `grade`, `date_entre_mad`, `date_fonction`, `situation_matrim`, `nombre_enfant`, `date_naissance`, `statut_mad`, `service`, `genre`, `diplome`, `tel`, `confession_relg`, `photo`, `password`, `cnps`, `slug`, `type`, `start_date`, `end_date`, `date_debut_mise_disponibilite`, `date_fin_mise_disponibilite`, `lock_nb`, `lock_date`, `is_salarie`, `is_register`, `is_medical`, `type_device`, `unique_web_identifier`, `activity_id`, `created_at`, `updated_at`) VALUES
(1, 'ABITTHY Abroh  Luther Clément', '00804-P', '00804-P', 'abitthy@gmail.com', NULL, NULL, NULL, NULL, 'Responsable Cellule Acceuil et Courrier', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2004-06-01', '28', '2004-06-01', NULL, 'Marié(e)', 4, '1973-03-07', 'P', 1, 'M', 'Master professionnel Gestion des Ressources Humaines', '01 01 37 02 37 / 07 49 49 88 11', 'C', '/images/20241008120519.jpg', '$2y$12$afnZjcAKjA/x/ReYL9bdSOwgETmZ9LFeA0RVAj.6/dbca58AS7Q/a', '173010427486', '66dd7160cb586', 1, NULL, NULL, NULL, NULL, 4, NULL, 1, 0, 0, 'TP1A.221005.003.OC101.unknown.OC101', '20872610-5180-4090-a26c-98d5f84e242d', NULL, '2024-09-08 09:41:53', '2025-03-12 17:00:44'),
(2, 'ADOU Danielle  Angèle épouse ABOKON', '345 962-F', '345962-F', 'a.abokon@madgi.ci', NULL, NULL, NULL, NULL, 'Chef de Département RHMG', NULL, 31, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-09-08', '33', '2003-07-31', '2009-08-18', 'Marié(e)', 4, '1976-01-27', 'F', 84, 'F', 'Ing. Management et marketing', '07 08 19 38 84 / 01 02 00 18 37', 'C', '/images/20241008120617.jpg', '$2y$12$yVMDAWLpIQuYO4YCt2Diz.RY8WiFK5wAGlq88vFJfykCu9AQaZmK6', NULL, '66dd716111cd4', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 1, 0, NULL, NULL, 4, '2024-09-08 09:41:53', '2024-12-16 15:08:01'),
(3, 'KOUA Kangah Aimée Gisèle épouse ACHI', '304 495-U', '304495-U', 'kouaaiméegisele@gmail.com', NULL, NULL, NULL, NULL, 'Infirmière diplomée d\'Etat', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2019-02-26', '29', '2019-02-26', '2004-11-03', 'Marié(e)', 3, '1974-12-10', 'F', 85, 'F', 'Diplôme d\'Etat d\'infirmier', '07 48 07 77 07 / 01 40 60 60 86', 'C', '/images/20241021163151.jpg', '$2y$12$Uk0RFonvYleNJY6x985S9O.ac6iWM1uFDcXZiW/ID9w02mL3Xop2m', NULL, '66dd71614edc2', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:53', '2024-11-04 01:05:54'),
(4, 'ABOA Chika Jeanne épouse ADON', '245 620-Q', '245620-Q', 'aboachika@gmail.com', NULL, NULL, NULL, NULL, 'Cadre du Social', NULL, 31, NULL, NULL, NULL, NULL, NULL, 1, 1, '2022-02-01', '30', '2022-02-01', '1993-11-01', 'Marié(e)', 4, '1965-01-24', 'F', 86, 'F', 'Inspecteur d\' Education Spécialisée', '07 08 72 12 31 / 01 02 32 61 38', 'C', '/images/20241008120746.jpg', '$2y$12$69e9.KOCuK/TYrNa7kVHP.b1Q/0zvwH2iI0Aw.kePE3VJuFjXVu92', NULL, '66dd7161883be', 1, NULL, NULL, NULL, NULL, 1, '13/01/2025 à 13:01:21', 2, 0, 0, 'web', '73ac5675-a038-40d6-97e6-9f5084d8c568', NULL, '2024-09-08 09:41:53', '2025-01-22 20:50:21'),
(5, 'SERI Marie-Christine épouse ADOU', '848 573-A', '848573-A', 'mariechristine.seri@gmail.com', NULL, NULL, NULL, NULL, 'Agent d\'Acceuil', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-11-01', 'B3', '2020-11-01', '2022-10-11', 'Marié(e)', 2, '1988-12-30', 'F', 107, 'F', 'Licence Professionnelle', '07 07 17 12 96', 'C', '/images/20241011133719.jpg', '$2y$12$rI8OhqsF1dj28uzrLkpRFuGqx8O1kAiNnzFFUYcG2/GHApsRqqNTK', NULL, '66dd7161c0eef', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:54', '2025-03-05 13:56:27'),
(6, 'BAROU Aya Léa Gertrude épouse AGNERO', '00704-P', '00704-P', 'baroulea@yahoo.fr', NULL, NULL, NULL, NULL, 'Chef de Département HMI-KF', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2020-09-08', '31', '2004-06-01', NULL, 'Marié(e)', 2, '1968-03-13', 'P', 87, 'F', 'Doctorat en médecine', '07 07 76 17 22', 'C', '/images/20241011134458.jpg', '$2y$12$ZD4.z92J0ubk4v3hjW.UceWaLGCmxtZKhrBE.dAv9520Q1bTcLxyy', '268019603317', '66dd71620567b', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 1, 0, NULL, NULL, 4, '2024-09-08 09:41:54', '2024-12-20 14:36:09'),
(7, 'MONDON  Rose Delphine Chidjé épouse AGOH-AKE', '270 059-S', '270059-S', 'mondonagoh2008@gmail.com', NULL, NULL, NULL, NULL, 'Inspecteur Principal d\'Education Spécialisée', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2019-02-26', 'A5', '2019-02-26', '1998-06-17', 'Marié', 2, '1962-11-14', 'F', 88, 'F', 'Diplôme d\' Etat d\'Education Spécialisée', '07 07 73 50 64', 'C', '/images/20241011135907.jpg', '$2y$12$aDLc7HxGAZPYZTod.yWIjOjx7P5xaOXn9kM85DmawiS/gb1XlM/N6', NULL, '66dd71623e10e', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:54', '2024-11-04 01:05:54'),
(8, 'AHOLIA Amoikon Jean Serge', '08014-P', '08014-P', 'sergeaholia85@gmail.com', NULL, NULL, NULL, NULL, 'Buandier', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2015-01-05', '32', '2014-05-02', NULL, 'Célibataire', 0, '1990-04-13', 'P', 89, 'M', 'BEPC', '07 77 05 87 21 / 01 01 64 98 37', 'C', '/images/20241129100401.jpg', '$2y$12$fpBN2nJ4ScbzTMgAPV81FuM6nLMbXAd/JuRrHKi.RFUxCwWlveXJO', '190011239953', '66dd716276889', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:54', '2024-11-29 10:04:01'),
(9, 'AHOUADJIRO Lina Ange Esther', '14618-P', '14618-P', 'lynnapahouadjiro@gmail.com', NULL, NULL, NULL, NULL, 'Assistante Pharmacie', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2018-04-01', '32', '2018-04-01', NULL, 'Célibataire', 5, '1973-06-11', 'P', 90, 'F', 'CAP Auxilliaire pharmacie', '07 07 07 01 69/01 01 01 42 03', 'C', '/images/20241011145147.jpg', '$2y$12$T.guBV/5SH9QQZQTK5ISreFu8EsWEwmjzIH9gDsbKStZVIN9/2vry', '273010014708', '66dd7162afabd', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, '1870da10-1ee8-45bf-8e73-91f51035c5fa', NULL, '2024-09-08 09:41:54', '2025-03-13 12:24:18'),
(10, 'AHOUSSI Ahoussi Faustin', '330 270-S', '330270-S', 'ahousss@yahoo.fr', NULL, NULL, NULL, NULL, 'Médecin géneraliste', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2015-01-05', '30', '2015-01-04', '2007-01-15', 'Marié(e)', 2, '1971-12-22', 'F', 85, 'M', 'Doctorat d\' Etat en médecine', '07 07 86 88 93 / 01 01 04 53 78', 'C', '/images/20241011154053.jpg', '$2y$12$SUx9j9QdAp4eYaQbAkEajuFqwAL/v3WtzVBjSEXymDKMbfno/WaeO', NULL, '66dd7162e7a59', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, 'TP1A.220624.014.a3core.unknown.a3corexx', NULL, NULL, '2024-09-08 09:41:55', '2025-03-12 17:33:59'),
(11, 'AKA Asséma Anasthasie', '313 690-B', '313690-B', 'akaanasthasie@gmail.com', NULL, NULL, NULL, NULL, 'Chef Unité Médecine Générale', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2014-08-22', '1', '2006-05-04', '2005-10-24', 'Célibataire', 1, '1971-04-17', 'F', 85, 'F', 'Doctorat d\' Etat en médecine', '05 05 67 75 46', 'C', '/images/20241011155144.jpg', '$2y$12$Jp1TPKQOr/ggRPqtS4IbyuTegnaOOBMWg74wyusCZI37Nbue8/H5K', NULL, '66dd71632cf11', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, 'PPR1.180610.011.greatlte.unknown.greatltexx', NULL, 6, '2024-09-08 09:41:55', '2025-03-13 11:15:36'),
(12, 'AKA Kouassi Tanguy Elisée', '355 342-K', '355342-K', 'akteforjesus@yahoo.fr', NULL, NULL, NULL, NULL, 'Technicien Biomédical', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2014-12-30', '29', '2014-12-30', '2010-03-22', 'Célibataire', 2, '1982-06-14', 'F', 89, 'M', 'Brevet de technicien sup Electro-Bio-Médical', '07 09 96 55 61 / 01 01 28 34 86', 'C', '/images/20241024101055.jpg', '$2y$12$la5hVdAJnUTYCT4mc1R7huTgEPvjvj3tascBDr1WZkeYupCjKso4S', NULL, '66dd7163669d6', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:55', '2024-11-04 01:05:54'),
(13, 'ECHODIE Louise Huberte épouse AKA', '15418-P', '15418-P', 'echodielouise@gmail.com', NULL, NULL, NULL, NULL, 'Agent de bureau', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2018-05-01', '32', '2018-05-01', NULL, 'Marié(e)', 3, '1975-10-06', 'P', 88, 'F', 'BTS Gestion Commerciale', '01 03 00 07 56 / 01 08 43 55 68', 'C', '/images/20241018153750.jpg', '$2y$12$YPB8qZ4hu23O0w7jy6ww9.RL7J92tUgHH4WnOu0z1B5FvckYjBT5m', '275011850533', '66dd71639edb6', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:55', '2024-11-04 01:05:54'),
(14, 'ALLA Carmelle Blanche Danielle', '17820-P', '17820-P', 'carmelleblanchalla@gmail.com', NULL, NULL, NULL, NULL, 'Responsable Cellule Assurances IARD et Autres Produits', NULL, 33, NULL, NULL, NULL, NULL, NULL, 1, 6, '2020-11-01', '28', '2020-11-01', NULL, 'Célibataire', 1, '1988-07-16', 'P', 120, 'F', 'MASTER  Affaires et  Fiscalité', '07 49 16 75 03', 'C', '/images/20241011161611.jpg', '$2y$12$FMoOrynOFzPtOZXcuUUpKuPTsMrbKYzWsiQc5vZPANSC9p15U6/uq', '288012098642', '66dd7163d73b9', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:56', '2024-11-04 01:05:54'),
(15, 'AMIN Achiepo Alphonse', '279 676-W', '279676-W', 'achiepo.amin@gmail.com', NULL, NULL, NULL, NULL, 'Ingénieur des Techniques sanitaires Option: Santé Pulique', NULL, 32, NULL, NULL, NULL, NULL, NULL, 0, 6, '2019-02-26', '1', '2019-02-26', '2000-09-05', 'Marié(e)', 3, '1971-11-30', 'F', 85, 'M', 'Diplôme d\' Ingénieur des Techniques Sanitaires', '01 02 64 15 69 / 07 88 89 97 18', 'C', '/images/20241129101515.jpg', '$2y$12$eoJLoJ9dBpe4CoIhmmmv4.BvMKEbYR93mBF7rab0uZsdGULhmQWHW', NULL, '66dd71641ad02', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:56', '2024-12-05 11:04:29'),
(16, 'AMON Kady Diane', '08914-P', '08914-P', 'akdydiane@gmail.com', NULL, NULL, NULL, NULL, 'Assistante Qualité', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2019-04-08', '28', '2014-08-25', NULL, 'Célibataire', 0, '1983-10-25', 'P', 92, 'F', 'Diplôme supérieur en Communication', '07 07 16 48 19', 'C', '/images/20241011162211.jpg', '$2y$12$Nyx8qoar.5JuMAFkwkaLOuROC9AOuHAPnXIMusjeQSw28DOnEjmnm', '283011565513', '66dd7164541e7', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:56', '2024-11-04 01:05:54'),
(17, 'YAO Adjo Martine épouse ANET', '02205-P', '02205-P', 'anetmartine07@yahoo.fr', NULL, NULL, NULL, NULL, 'Secretaire Médicale', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2005-10-31', 'E', '2005-10-31', NULL, 'Marié', 2, '1970-01-21', 'P', 88, 'F', 'Niveau première Année BTS', '01 02 14 66 78', 'C', '/images/20241014104320.jpg', '$2y$12$7s7xdbObki93f6LGWLY0jOC0m5aJkGBMLD36n4W/fqH7oxlbvHLVC', '270019613838', '66dd71648baff', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:56', '2024-11-04 01:05:54'),
(18, 'ARICKO Herbert Kevin', '421 156-L', '421156-L', 'tcheaqui@gmail.com', NULL, NULL, NULL, NULL, 'Chef Service Ressources Humaines', NULL, 31, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-09-21', '33', '2007-04-10', '2016-01-12', 'Marié(e)', 1, '1978-09-22', 'F', 86, 'M', 'Ingénieur des techniques RH', '01 01 54 97 33 / 07 49 80 62 27', 'C', '/images/20241014105047.jpg', '$2y$12$oCDveLRIDkOOwO7CO.D7nOKSpfTsBHNHBet.XfqiUE/KrKgoNhiPm', NULL, '66dd7164c3f96', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 5, '2024-09-08 09:41:57', '2024-12-20 14:25:14'),
(19, 'ASSAMOI Emma Valérie', '03206-P', '03206-P', 'assamval@yahoo.fr', NULL, NULL, NULL, NULL, 'Chef  Service de Gestion des Fichiers Précomptes et des Prestations Sociales', NULL, 33, NULL, NULL, NULL, NULL, NULL, 1, 6, '2020-09-21', '31', '2006-04-02', NULL, 'Marié(e)', 1, '1971-04-03', 'P', 93, 'F', 'Maitrise Adm. Eco et Social', '07 08 40 34 43', 'C', '/images/20241014110034.jpg', '$2y$12$AI069ToDVz24CvdZsK5zK.JCOtDd17ovHQg9b5Jp4.fEEGO1VUVKC', '271010931833', '66dd716507b0c', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, 5, '2024-09-08 09:41:57', '2024-12-20 14:34:18'),
(20, 'ASSI Eric Séverin', '474 730-C', '474730-C', 'e.assi@madgi.ci', NULL, NULL, NULL, NULL, 'Ingénieur des Techniques Informatiques', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2016-12-15', '33', '2014-08-25', '2019-04-04', 'Marié(e)', 2, '1981-11-13', 'F', 3, 'M', 'Ingénieur en Système Numérique', '07 07 91 51 72 / 07 40 56 51 02', 'C', '/images/20241014111110.jpg', '$2y$12$6TI2AMMw/M7X63r6jNBv5ej1L.7BVuoD12qaWKta2tzzkNgJp24rO', NULL, '66dd7165405b0', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:57', '2024-11-04 01:05:54'),
(21, 'ASSO Marie Danielle Bilé', '250 653-W', '250653-W', 'danielle.assobil@gmail.com', NULL, NULL, NULL, NULL, 'Médecin Conseil', NULL, 33, NULL, NULL, NULL, NULL, NULL, 1, 6, '2023-01-02', '30', '2023-01-02', '2002-08-19', 'Célibataire', 1, '1968-08-14', 'F', 99, 'F', 'Doctorat d\' Etat en Médecine', '01 01 80 14 03 / 05 05 77 17 92 / 07 59 24 29 35', 'C', '/images/20241014114221.jpg', '$2y$12$DrP9U2Ox78ucWTh2adCtr.zcMffVBMsOrgAEwDO9dI7inkX7npYoG', NULL, '66dd71657b8c9', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:57', '2024-11-04 01:05:54'),
(22, 'ASSOUMA Yéboué Florent', '05207-P', '05207-P', 'y.assouma@madgi.ci', NULL, NULL, NULL, NULL, 'Ingénieur Informaticien', NULL, 37, NULL, NULL, NULL, NULL, NULL, 1, 1, '2014-08-22', '31', '2007-03-01', NULL, 'Marié(e)', 3, '1974-11-21', 'P', 124, 'M', 'Diplôme d’Ingénieur de Conception Informatique', '07 08 20 21 08 / 05 05 01 68 67', 'C', '/images/20241014115704.jpg', '$2y$12$tm5WgK0Dn4vf.SgBbeRwxOcnN4QScxHO/QkXytRk3R5tB74xiQl8G', '174010927005', '66dd7165b48b9', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:57', '2024-12-18 09:01:59'),
(23, 'AZIA Avit Privat', '01405-P', '01405-P', NULL, NULL, NULL, NULL, NULL, 'Responsable de Cellule Maintenance Electricité et Plombier', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2005-09-05', '32', '2005-09-05', NULL, 'Célibataire', 2, '1970-08-08', 'P', 89, 'M', 'Niveau BT', '07 48 32 32 22 / 07 06 75 87 87', 'C', '/images/20241014134141.jpg', '$2y$12$QKu6rGMmiJ1Y6nafkNdkRuj5XCGYDVc9IVud5Bn5hBTDjOGINHWK6', '170010931856', '66dd7165ee5cd', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:58', '2024-11-04 01:05:54'),
(24, 'TAPE Naomi Grâce Esther épouse BAILLY', '18520-P', '18520-P', 'esthertape34@gmail.com', NULL, NULL, NULL, NULL, 'Assistante RH', NULL, 31, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-11-01', '28', '2020-11-01', NULL, 'Marié(e)', 1, '1997-12-26', 'P', 86, 'F', 'Licence Audit et Contrôle de Gestion', '07 79 59 16 22', 'C', '/images/20241014135041.jpg', '$2y$12$72T68qjFwHTPPZOx7KuAmuU/7CCK2jN3irXcURtnxvPAiXAOybSIu', '297012098614', '66dd716634e15', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:58', '2024-12-19 15:41:21'),
(25, 'BAKAYOKO Mamadou', '02405-P', '02405-P', 'bakaa73@yahoo.fr', NULL, NULL, NULL, NULL, 'Ambulancier', NULL, 31, NULL, NULL, NULL, NULL, NULL, 1, 6, '2005-11-01', '32', '2005-11-01', NULL, 'Marié(e)', 3, '1973-09-03', 'P', 96, 'M', 'CEPE', '01 02 75 78 54 / 07 07 13 30 02', 'M', '/images/20241014140247.jpg', '$2y$12$pyPWj3e3npf4pEBX4ff4EObPGyE.Y0ec9gWJmwiu/DYnQx/rXTMM6', '173010931841', '66dd71666fb77', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:58', '2024-11-04 01:05:54'),
(26, 'BAKO  Jean-Pierre', '19924-P', '19924-P', 'bakojeanpierre10@gmail.com', NULL, NULL, NULL, NULL, 'Chauffeur du PCA', NULL, 35, NULL, NULL, NULL, NULL, NULL, 1, 1, '2024-01-04', '32', '2024-01-04', NULL, 'Célibataire', 4, '1988-07-29', 'P', 97, 'M', 'NIVEAU 3ème', '07 07 00 82 87 / 05 04 63 02 05', 'C', '/images/20241014142629.jpg', '$2y$12$yIkKtWQzfs/g5uOWttlpbu5TVGQ3rlzDfiWt7u8lFSfEg8RzuglDu', '202400005637', '66dd7166ab70d', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:58', '2024-11-04 01:05:54'),
(27, 'BEUGRE Aka Paulin', '08114-P', '08114-P', 'akapaulinbeugre@gmail.com', NULL, NULL, NULL, NULL, 'Brancardier', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2014-05-02', '32', '2014-05-02', NULL, 'Marié(e)', 3, '1977-01-05', 'P', 85, 'M', 'BAC', '05 06 96 36 36', 'C', '/images/20241014143251.jpg', '$2y$12$rAJmwyvjLQ9nxR8mq2501OZU4VEBrMV564xEOnTm8H8NnUArxjjdi', '177011565177', '66dd7166e683a', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:59', '2024-11-04 01:05:54'),
(28, 'AMAN Taby Patricia épouse BILE', '01905-P', '01905-P', 'a.bile@madgi.ci', NULL, NULL, NULL, NULL, 'Responsable Cellule  Production et Sinistre', NULL, 33, NULL, NULL, NULL, NULL, NULL, 1, 6, '2014-08-26', '28', '2005-10-25', NULL, 'Marié(e)', 5, '1976-12-30', 'P', 99, 'F', 'BTS Assurances', '07 08 09 29 58', 'C', '/images/20241014143808.jpg', '$2y$12$NZ9wb2geSqP4Os9ZlCZspupbTjn8TjL/GdPsSti02d5BtY9Zp/cJ.', '276010929631', '66dd71672aee5', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:59', '2024-11-04 01:05:54'),
(29, 'BINI Abo Kouamé François', '02705-P', '02705-P', NULL, NULL, NULL, NULL, NULL, 'Ambulancier', NULL, 31, NULL, NULL, NULL, NULL, NULL, 1, 6, '2005-11-05', '32', '2005-11-05', NULL, 'Célibataire', 6, '1976-07-10', 'P', 96, 'M', 'BEPC', '07 08 46 58 02 / 01 40 88 92 06', 'C', '/images/20241014144157.jpg', '$2y$12$k0aZvmWeWV3.1Vi8/s28e.k8s1/dBwjrf6AubaLOy2U67/BiF5o/.', '176010955413', '66dd716764d67', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:59', '2024-11-04 01:05:54'),
(30, 'BIRIBI Kossia Bernadette', '829 666-C', '829666-C', 'k.biribi@madgi.ci', NULL, NULL, NULL, NULL, 'Caissière CEC-MADGI', NULL, 34, NULL, NULL, NULL, NULL, NULL, 1, 1, '2014-08-26', '34', '2008-12-02', '2022-05-18', 'Célibataire', 3, '1975-12-28', 'F', 124, 'F', 'BAC', '07 07 89 28 31 /01 03 82 53 81', 'C', '/images/20241014144722.jpg', '$2y$12$9eKo3W.MgxKcSbBwjU6QaOBwcWYZfCIHfw0k8cbDdOAJbH9vCXUzm', NULL, '66dd7167a03bd', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:41:59', '2024-12-18 09:03:17'),
(31, 'BOBI Legbé Armand Rodrigue', '01805-P', '01805-P', 'armand_bobi2003@yahoo.fr', NULL, NULL, NULL, NULL, 'Chef de Service Administratif et Financier de la CEC - MADGI', NULL, 34, NULL, NULL, NULL, NULL, NULL, 1, 1, '2014-08-22', '31', '2005-10-18', NULL, 'Marié(e)', 2, '1972-01-01', 'P', 124, 'M', 'Master Comptabilité Audit et Contrôle', '01 01 03 66 09', 'C', '/images/20241014145201.jpg', '$2y$12$AisOQ2DDUW8xxbeRqgWJG.8IQ1/GLo/sssMv1G7Xgm9.o.Lwctn2e', '172011147595', '66dd7167dc7be', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, 5, '2024-09-08 09:42:00', '2024-12-20 14:36:52'),
(32, 'BOIDY Kouakou Tably Toussaint', '329 640-Y', '329640-Y', 'toussaint.boidy@ipscnam.ci', NULL, NULL, NULL, NULL, 'Médecin Conseil', NULL, 33, NULL, NULL, NULL, NULL, NULL, 1, 6, '2023-01-02', '30', '2023-01-02', '2007-01-15', 'Marié(e)', 4, '1975-10-31', 'F', 99, 'M', 'Doctorat d\' Etat en Médecine', '07 87 25 74 85 / 01 02 60 24 24', 'C', '/images/20241014145816.jpg', '$2y$12$9Kpt4n1Z7M11DVctUQSauOTDkETUvJIBkbovrSRMxSOEU0Mn7M4um', NULL, '66dd716823f0f', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:00', '2024-11-04 01:05:54'),
(33, 'BONY Bony Mathurin', '07512-P', '07512-P', 'm.bony@madgi.ci', NULL, NULL, NULL, NULL, 'Chef Département Finances et Comptabilité', NULL, 36, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-09-08', '31', '2012-03-13', NULL, 'Célibataire', 0, '1964-11-10', 'P', 100, 'M', 'Diplôme d’Ingénieur Commercial', '07 07 69 09 59', 'C', '/images/20241014150209.jpg', '$2y$12$0k3kuoeLWHdHOEOoXQ7oQOM9on3lxlfASYgCWNyRgx5WddewtOktS', '164018925623', '66dd71685ff79', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 1, 0, NULL, NULL, 4, '2024-09-08 09:42:00', '2024-12-20 15:10:46'),
(34, 'BOUA Missati Gabriel', '09114-P', '09114-P', 'bouagabriel@yahoo.fr', NULL, NULL, NULL, NULL, 'Responsable Cellule  Gestion Administrative du Personnel et Paie', NULL, 31, NULL, NULL, NULL, NULL, NULL, 1, 1, '2014-08-25', '31', '2014-08-25', NULL, 'Marié(e)', 1, '1980-09-17', 'P', 86, 'M', 'Master GRH', '01 03 17 50 53 / 07 07 05 98 61', 'C', '/images/20241014150508.jpg', '$2y$12$aoDJUt1SRu6Kson43AH9gOfHai3/djOnmBUQJB13wYlNH05EAhofi', '180011565162', '66dd716899b93', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:00', '2024-11-04 01:05:54'),
(35, 'BROU Kouamé Arsène', '444 453 V', '444453V', 'abrou24@yahoo.com', NULL, NULL, NULL, NULL, 'Médecin Néphrologue', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2023-08-01', '1', '2016-02-09', '2016-02-18', 'Marié(e)', 0, '1983-04-24', 'F', 101, 'M', 'Doctorat d\' Etat en médecine', '07 57 99 55 88', 'C', '/images/20241014151227.jpg', '$2y$12$hK2LK2TbZRzr.XHIkotipuC7LvtZ4nQGfTI3Geg16Vq5x2uB61ju6', NULL, '66dd7168d4bad', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:01', '2024-11-04 01:05:54'),
(36, 'KOUAME Amenan Simone épouse BROU', '165 123 J', '165 123J', 'k.brou@madgi.ci', NULL, NULL, NULL, NULL, 'Chef de Service Aide au Diagnostic', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2022-08-09', '1', '2006-11-09', '1999-06-19', 'Marié(e)', 3, '1968-01-01', 'F', 102, 'F', 'Doctorat d\' Etat en médecine', '07 07 08 62 16 / 01 02 50 88 60', 'C', '/images/20241014152637.jpg', '$2y$12$q1tUQdSQkjOuUMyzR5SFI.0SaSm6.9lbRM5BuNBAmt6lRiDJE0yH.', NULL, '66dd71691b85b', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 5, '2024-09-08 09:42:01', '2024-12-20 15:21:28'),
(37, 'COULIBALY   Yedjendé', '871 088-X', '871088-X', 'yedjendecoulibaly@gmail.com', NULL, NULL, NULL, NULL, 'Assistante Administrative', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2016-06-01', '33', '2016-06-01', '2023-06-16', 'Célibataire', 3, '1981-01-17', 'F', 103, 'F', 'BTS Gestion commerciale', '07 09 46 73  43', 'C', '/images/20241014154042.jpg', '$2y$12$goIsXRaizhFeUIGh/4PuvORZur7VFI/qhLl9VFkPGIHHtFLtCUl7C', NULL, '66dd716954023', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:01', '2024-11-04 01:05:54'),
(38, 'COULIBALY Haoulah Ulrich-Vivien', '15218-P', '15218-P', 'haoulahv@gmail.com', NULL, NULL, NULL, NULL, 'Responsable Cellule Achats', NULL, 31, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-01', '28', '2018-05-01', NULL, 'Marié(e)', 4, '1984-07-03', 'P', 96, 'M', 'Licence Professionnelle Option Marketing Management', '07 07 37 56 68', 'C', '/images/20241014154529.jpg', '$2y$12$qWIAeOad1Q6qkNSMSj1Gu..GldcIT.GWid5KTkjKT7vunMW1mgjsu', '184011365879', '66dd71698cc9f', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:01', '2024-11-04 01:05:54'),
(39, 'BINATE  Massiami épouse COULIBALY', 'NA', 'NA', 'massiamibinate399@gmail.com', NULL, NULL, NULL, NULL, 'Assistante comptable', NULL, 36, NULL, NULL, NULL, NULL, NULL, 1, 1, '2023-01-11', '35', '2023-01-11', NULL, 'Marié(e)', 3, '1977-11-16', 'Contractuelle  DGI', 108, 'F', 'Dipôme d\'Etat d\'Education Spécialisée', '07 08 83 26 37 / 05 05 77 40 45', 'M', '/images/20241014155355.jpg', '$2y$12$aCYchDfnFnjgKpm8JIWsN.N69D3njrhOGRobDBqZ0H/F1hYhWi15y', NULL, '66dd7169c566e', 1, NULL, NULL, NULL, NULL, 0, NULL, 3, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:02', '2024-11-25 10:19:08'),
(40, 'CISSE Koumba épouse COULIBALY', '17920-P', '17920-P', 'koumbci@gmail.com', NULL, NULL, NULL, NULL, 'Conseiller Clientèle CEC-MADGI', NULL, 37, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-11-01', '28', '2020-11-01', NULL, 'Marié(e)', 2, '1975-05-28', 'P', 125, 'F', 'BTS  Gestion commerciale', '07 88 20 84 20/ 01 53 68 19 19', 'M', '/images/20241014160023.jpg', '$2y$12$2dV3YOlzlGw1TpLkXGAVXu1AMN7mSALGk6arCi.f1.Rtj4MF6SpGS', '202100024350', '66dd716a0976b', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:02', '2024-12-18 09:04:48'),
(41, 'COULIBALY Sangan Plinpeny  Gisèle', '848 699-R', '848699-R', 'coulgisele@yahoo.fr', NULL, NULL, NULL, NULL, 'Chef  Service Technique', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2020-09-21', '1', '2004-03-22', '2022-10-10', 'Célibataire', 1, '1974-12-12', 'F', 89, 'F', 'DESS Genie Logiciel', '07 07 64 86 10', 'C', '/images/20241014160543.jpg', '$2y$12$9GtydCbjAvXiCej8GmvIk.bOFLE1mtsQNjgJEYHPqNE6hz8XGeGJ.', NULL, '66dd716a42023', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 5, '2024-09-08 09:42:02', '2024-12-20 15:11:19'),
(42, 'COULIBALY Seydou', '00604-P', '00604-P', 'seydou32@yahoo.fr', NULL, NULL, NULL, NULL, 'Responsable Cellule Comptabilité Club House', NULL, 36, NULL, NULL, NULL, NULL, NULL, 1, 1, '2004-04-01', '28', '2004-04-01', NULL, 'Marié(e)', 1, '1974-01-01', 'P', 106, 'M', 'BTS Finances Comptabilité', '07 08 86 83 56 / 01 02  83 65 44', 'M', '/images/20241014160934.jpg', '$2y$12$CPtsrP7sys3otQ1MD.K1G.FKGtFJOyjGsLhtxJfuvH1QCFdxD0MJm', '174010408070', '66dd716a7a877', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:02', '2024-11-04 01:05:54'),
(43, 'DIABAGATE Djibril', '05907-P', '05907-P', NULL, NULL, NULL, NULL, NULL, 'Chauffeur', NULL, 31, NULL, NULL, NULL, NULL, NULL, 1, 6, '2007-09-03', '32', '2007-09-03', NULL, 'Marié(e)', 4, '1972-11-01', 'P', 88, 'M', 'CEPE', '07 07 86 57 57', 'M', '/images/20241014161517.jpg', '$2y$12$fY/S3vXC5pDx5gJjTdX7cerYv1gbua52a8WQ58mexQicC1jceX2qi', '172010927900', '66dd716ab3442', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:02', '2025-03-05 13:59:37'),
(44, 'DIABY Vakaramoko', '06107-P', '06107-P', 'diaby_vakaramoko@yahoo.fr', NULL, NULL, NULL, NULL, 'Responsable Pool Chauffeurs', NULL, 31, NULL, NULL, NULL, NULL, NULL, 1, 1, '2007-10-15', '32', '2007-10-15', NULL, 'Marié(e)', 1, '1975-12-16', 'P', 96, 'M', 'Master Professionnel Sciences de Gestion des Entreprises Option: Gestion de la Chaine Logistique', '01 03 22 12 20', 'M', '/images/20241015111743.jpg', '$2y$12$JbRxw9QY.UXi8vMnOOdnNOwwJyWm04PcVVo8LcXSWtYPwlkRn5yhq', '175010926823', '66dd716aebef9', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:03', '2024-11-04 01:05:54'),
(45, 'DIEBEY Koffi Joseph', '01105-P', '01105-P', 'k.diebey@madgi.ci', NULL, NULL, NULL, NULL, 'Directeur Général Adjoint  CEC-MADGI', NULL, 34, NULL, NULL, NULL, NULL, NULL, 1, 1, '2014-08-22', '31', '2005-05-01', NULL, 'Marié(e)', 4, '1969-09-13', 'P', 95, 'M', 'Diplôme d’Ingénieur Commercial', '01 03 35 35 47', 'C', '/images/20241015112627.jpg', '$2y$12$yZG1xM4XCfRfHKoDAfluCO1htboV8DCpunSxAg4xoDU0kVADXc5OG', '169019916780', '66dd716b3057e', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 1, 0, NULL, NULL, 4, '2024-09-08 09:42:03', '2024-12-20 15:11:54'),
(46, 'DIGBEU Sandrine Zomassa', '18920-P', '18920-P', 'sandyzomassa@yahoo.fr', NULL, NULL, NULL, NULL, 'Chargée d\'Acceuil', NULL, 30, NULL, NULL, NULL, NULL, NULL, 0, 1, '2020-11-01', '28', '2020-11-01', NULL, 'Célibataire', 1, '1983-03-28', 'P', 107, 'F', 'BTS en Communication d\'Entreprise', '07 07 63 61 08', 'C', '/images/20241015113708.jpg', '$2y$12$SVr7EWjFX80iVSNqcmlpz.7pTSaol4lprYYQ5919OpslJbhvq4CT6', '283012010068', '66dd716b6960a', 1, NULL, NULL, '2024-08-01', NULL, 0, NULL, 5, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:03', '2024-12-26 16:27:59'),
(47, 'DOGBA Tadjo', '297 055-W', '297055-W', NULL, NULL, NULL, NULL, NULL, 'Infirmier Diplomé d\'Etat', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2019-02-26', '29', '2019-02-26', '2003-09-24', 'Célibataire', 3, '1969-12-20', 'F', 85, 'M', 'Diplôme d\'Etat d\'infirmier', '07 07 70 57 40 / 01 02 04 19 20', 'C', '/images/20241018153857.jpg', '$2y$12$xFnjGD6cAYiJv8qBfRJtzOJGzWtvmuYd1J7u5mYh6wtLE5b1hOdt6', NULL, '66dd716ba2d6c', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:03', '2024-11-04 01:05:54'),
(48, 'DOGOH Rita Edwige', '15118-P', '15118-P', NULL, NULL, NULL, NULL, NULL, 'Agent d’Accueil CEC-MADGI', NULL, 37, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-05-01', '32', '2018-05-01', NULL, 'Célibataire', 1, '1981-11-10', 'P', 125, 'F', 'Niveau terminale', '07 47 75 43 73 / 01 01 94 26 06', 'C', '/images/20241015120002.jpg', '$2y$12$vMjbTpy9Wf9KFRcdfRJM0./Mi7yuBeeE1MdHCSMJ83syqhpWopOfe', '281011850574', '66dd716bdb89b', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:04', '2024-12-18 09:06:15'),
(49, 'DONGO Adja', '368 623-J', '368623-J', 'dongovirginie5@gmail.com', NULL, NULL, NULL, NULL, 'Infirmière diplomée d\'Etat', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2019-02-26', '29', '2019-02-26', '2011-07-24', 'Célibataire', 2, '1970-09-14', 'F', 85, 'F', 'Diplôme d\'Etat d\'infirmier', '07 08 36 67 15 / 01 01 64 31 58', 'C', '/images/20241015142351.jpg', '$2y$12$AupqfHNvojDLxGiYVEGFpeJmdn1AWoyx.Bd1FELf9BC3gsHr6p1z.', NULL, '66dd716c1efaf', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:04', '2024-11-04 01:05:54'),
(50, 'DOSSO Affoussiata', '425 984-F', '425984-F', 'dossoaffoussiata23@gmail.com', NULL, NULL, NULL, NULL, 'Technicien Supérieur de la Santé', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2024-04-08', '29', '2024-04-08', '2016-02-15', 'Célibataire', 1, '1989-12-23', 'F', 85, 'F', 'Diplôme de Technicien Sup. Santé Option: Hygiène et Assainissement', '07 09 41 55 00', 'M', '/images/20241015143001.jpg', '$2y$12$EHznD7KaPL/pMH3KbmEwh.LWCMWAmx7/izfvp8PMjWoPAV763XEzy', NULL, '66dd716c571d4', 1, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:04', '2024-11-04 01:05:54'),
(51, 'DOUGBO Nadège', '18020-P', '18020-P', NULL, NULL, NULL, NULL, NULL, 'Assistante Pharmacie', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2020-11-01', '32', '2020-11-01', NULL, 'Célibataire', 1, '1983-11-02', 'P', 90, 'F', 'Caissiere et Auxiliaire en Pharmacie', '07 07 17 31 27', 'C', '/images/20241015143348.jpg', '$2y$12$meEQcJh1UtYKPIEBARS/7OL5H4vjW4NyskARjSfnlouKzp.8SE47W', '283012057701', '66dd716c8f67b', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:04', '2024-11-04 01:05:54'),
(52, 'TRAORE Mamouna épouse EBE', '349 357- U', '349357-U', 'tmamouna@yahoo.fr', NULL, NULL, NULL, NULL, 'Inspecteur Principal d\'Education Spécialisée', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2019-10-21', 'A5', '2019-10-21', '2009-07-09', 'Marié', 3, '1981-05-11', 'F', 88, 'F', 'Diplôme d\'Etat d\'Educateur specialisé', '05 05 97 05 30', 'C', '/images/20241015144243.jpg', '$2y$12$e3pu0aksz5VkCxmFf2F8peHFSMsza.gn3Z/OAhI22xFLqleLXxyhy', NULL, '66dd716cc85cb', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:05', '2024-11-04 01:05:54'),
(53, 'EHOUMAN Adjoh Anick Danielle', '15518-P', '15518-P', 'ehoumananick18@gmail.com', NULL, NULL, NULL, NULL, 'Rédacteur Sinistre', NULL, 33, NULL, NULL, NULL, NULL, NULL, 1, 6, '2018-05-01', '28', '2018-05-01', NULL, 'Célibataire', 0, '1976-05-09', 'P', 99, 'F', 'BTS option: Transit / Transport', '07 09 40 08 40', 'C', '/images/20241015153432.jpg', '$2y$12$tK9UwruGTPMQtXVfBrNjXuXgO.pBTrE5nNwL93.9ly3JLz2amQ77m', '276011850588', '66dd716d0c4fe', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:05', '2024-11-04 01:05:54'),
(54, 'EHOUNOUX N\'zi  Zephyre Yobouet Samson', '290 986-W', '290986-W', NULL, NULL, NULL, NULL, NULL, 'Chef Service Santé', NULL, 33, NULL, NULL, NULL, NULL, NULL, 1, 6, '2020-09-18', '1', '2014-12-30', '2002-08-19', 'Marié(e)', 2, '1968-04-14', 'F', 99, 'M', 'Doctorat en médecine', '01 02 0378 77 / 05 06 77 12 77', 'M', '/images/20241015153700.jpg', '$2y$12$M/YlPNrlWzvvr/Rq5w6Y2uu8JJiBi3RAtW8PgA2jodwc98peymtbO', NULL, '66dd716d448fc', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 5, '2024-09-08 09:42:05', '2024-12-20 15:12:51'),
(55, 'FOFANA Mariam', '15018-P', '15018-P', NULL, NULL, NULL, NULL, NULL, 'Caissière', NULL, 36, NULL, NULL, NULL, NULL, NULL, 1, 6, '2018-05-01', '32', '2018-05-01', NULL, 'Célibataire', 1, '1974-12-23', 'P', 108, 'F', 'BTS Secretariat Bureautique', '07 07 99 90 87', 'M', '/images/20241015155019.jpg', '$2y$12$92BASnplegzRhXiBSU4U3eRBJn8NjQQvTeZOA6JtITQ6naAicYwh2', '274011850555', '66dd716d7d19e', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:05', '2024-11-04 01:05:54'),
(56, 'FOFIE Akoua Adayé Patricia épouse  ACHOU', '14718-P', '14718-P', NULL, NULL, NULL, NULL, NULL, 'Assistante Dentaire', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2018-04-01', '32', '2018-04-01', NULL, 'Marié(e)', 0, '1969-05-07', 'P', 85, 'F', 'Assistanat Dentaire', '05 05 18 67 71 /07 78 06 69 72', 'C', '/images/20241015161246.jpg', '$2y$12$CscMCoQXnG/8IEv8QgkI2.ScXd57FahROglF/DEEcBOXg.knnCfOu', '269010615934', '66dd716db5f4a', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:05', '2024-11-04 01:05:54'),
(57, 'GADEGBEKU  Sonia Pélagie', '421 274-S', '421274-S', 'akasoniag@gmail.com', NULL, NULL, NULL, NULL, 'Secretaire du PCA', NULL, 38, NULL, NULL, NULL, NULL, NULL, 1, 1, '2024-01-23', '29', '2005-12-01', '2016-01-13', 'Veu.f(ve)', 4, '1978-09-17', 'F', 97, 'F', 'BTS Assistanat de Direction', '01 01 13 42 58', 'C', '/images/20241015161928.jpg', '$2y$12$b7Yz9InYBEr99ltu05LCV.UUj8AD/xqZ7nFmeYa5ReVBa9M9b1tyu', NULL, '66dd716deefca', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:06', '2024-11-04 01:05:54'),
(58, 'GADIE Sophie', '19623-P', '19623-P', NULL, NULL, NULL, NULL, NULL, 'Aide-soignante', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2023-03-01', '32', '2023-03-01', NULL, 'Célibataire', 1, '1968-04-10', 'P', 110, 'F', 'Certificat d\'Aptitude Professionnelle Option Sanitaire et Social', '07 07 67 06 52 / 01 02 10 79 13', 'C', '/images/20241017160006.jpg', '$2y$12$NY2MokOM01PL9sBqnQ1vvekQTZH0PT2EoW466S8ctzSaDL1XK1hgW', '202300037780', '66dd716e339d0', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:06', '2024-11-04 01:05:55'),
(59, 'BABO Blah Euphrasie Marcelle épouse GBAO', '444 389 - D', '444389-D', NULL, NULL, NULL, NULL, NULL, 'Aide soignante', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2016-02-09', '36', '2016-02-09', '2016-02-09', 'Marié(e)', 1, '1988-10-15', 'F', 85, 'F', 'BEPC', '07 08 58 20 74', 'C', '/images/20241018154648.jpg', '$2y$12$kZEBfPJ8jcaKYwv5rNimn.rql.Tvi6ctdCmyE9wWhRLt82QG8F2v6', NULL, '66dd716e6c172', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:06', '2024-11-04 01:05:55'),
(60, 'OYOUROU Edwige Rachel épouse GNANCALO', '316 361-F', '316361-F', NULL, NULL, NULL, NULL, NULL, 'Infirmière diplomée d\'Etat', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2019-02-26', '29', '2019-02-26', '2006-03-13', 'Marié(e)', 2, '1972-10-17', 'F', 85, 'F', 'Diplômé d\'Etat d\'infirmier', '07 07 97 47 01 / 01 01 76 43 43', 'C', '/images/20241017161956.jpg', '$2y$12$Hj7J5kTR9q/eg.nFODkLv.9atYWzGmsnTZAPx6dSceXCAChMDv2xC', NULL, '66dd716ea57c1', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:06', '2024-11-04 01:05:55'),
(61, 'GORI Djadja Nazaire', '00905-P', '00905-P', 'd.gori@madgi.ci', NULL, NULL, NULL, NULL, 'Chef Service Assurances Diverses', NULL, 33, NULL, NULL, NULL, NULL, NULL, 1, 6, '2020-09-18', '31', '2005-01-03', NULL, 'Marié(e)', 3, '1971-09-15', 'P', 120, 'M', 'Diplôme d\' Etudes Supérieures des Professions d\' Assurances (DESPA)', '07 09 26 10 79 / 01 41 14 81 77', 'C', '/images/20241018101723.jpg', '$2y$12$WD9xOMBnlqqkfPALyoznNee/GGMKdtNNRLeHIVPoW4ncRHk/EB9OO', '171010511172', '66dd716ede0d2', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, 5, '2024-09-08 09:42:07', '2024-12-20 15:13:29'),
(62, 'GOYE Faé Gaty', '313 350-M', '313350-M', 'faekaty@gmail.com', NULL, NULL, NULL, NULL, 'Responsable Cellule Gestion des Effectifs et Compétences', NULL, 31, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-02-01', '1', '2021-02-01', '2005-12-01', 'Célibataire', 0, '1980-05-06', 'F', 86, 'F', 'Master en Gestion de l\' information', '07 09 00 14 40 / 01 03 88 18 72', 'C', '/images/20241018102020.jpg', '$2y$12$9RB3K75lKxeQ8DPzn.1hRO9eoFn3dedxLkJNUzoleG1iP/IGij4BG', NULL, '66dd716f22d72', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, 'e0f6d69e-2a5b-4021-85a5-019164b2db70', NULL, '2024-09-08 09:42:07', '2024-11-11 09:56:45'),
(63, 'GUEI André', '342 878-Q', '342878-Q', NULL, NULL, NULL, NULL, NULL, 'Technicien Supérieur Contrôle Qualité', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2017-11-24', '29', '2017-11-24', '2008-12-03', 'Marié(e)', 3, '1977-01-01', 'F', 92, 'M', 'Master en Management de la Qualité', '01 02 22 36 65 / 07 78 28 26 75', 'C', '/images/20241018102759.jpg', '$2y$12$ymJgsgd5zQLkjPIIo/3SauwUWAi/HG.ieQ.S4d0.109zoSqtFWYeO', NULL, '66dd716f5c359', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:07', '2025-03-05 13:49:38'),
(64, 'GUIKPA Armel Hugues Paterne', '11516-P', '11516-P', 'garmelhugues@gmail.com', NULL, NULL, NULL, NULL, 'Chargé d’Archives', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2016-06-01', '32', '2016-06-01', NULL, 'Marié(e)', 1, '1985-05-21', 'P', 88, 'M', 'BAC', '01 01 95 22 93 / 07 78 39 58 70', 'C', '/images/20241018103841.jpg', '$2y$12$taGWe9ZBpxAzg7cjZmRdLeeg7rSmVjRxNu4/gUW6KT1jpPUEXFWrS', '185011716973', '66dd716f953df', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:07', '2024-11-04 01:05:55'),
(65, 'GUY Annick Patricia épouse KOUASSI', '291 987 L', '291 987L', 'guyannickpatricia@gmail.com', NULL, NULL, NULL, NULL, 'Auxiliaire des Techniques Sanitaires option: Imagerie Médicale', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2014-12-30', '37', '2014-12-30', '2003-01-02', 'Marié(e)', 2, '1977-01-01', 'F', 101, 'F', 'Diplôme d\' Auxiliaire des Techniques Sanitaires option: Imagerie Médicale', '07 09 39 39 98 / 01 42 01 63 25', 'C', '/images/20241018110103.jpg', '$2y$12$rX2hWAX/LqOxaK0m9qdstO.vrY77VRhimZQney.UMui1u38XrCH3e', NULL, '66dd716fcdab4', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:08', '2025-03-05 13:54:21'),
(66, 'HARAPHAN Touré', '270 002-J', '270002-J', 'tharaphan@yahoo.fr', NULL, NULL, NULL, NULL, 'Ingénieur des Techniques Sanitaires', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2019-02-26', '33', '2019-02-26', '1998-07-08', 'Marié(e)', 5, '1968-07-07', 'F', 102, 'M', 'Diplôme d\' Ing. Tech. sanitaire option: Biologie Médicale', '07 08 26 29 99 / 01 40 09 79 15', 'C', '/images/20241018111816.jpg', '$2y$12$SqNWXAQ9sq9S56c4lN03Y.lxo5eqar8MExrCat./leaoy0VMdwqFC', NULL, '66dd717011c55', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:08', '2024-11-04 01:05:55'),
(67, 'IRIE Bi Youan', '240 806 P', '240 806P', 'irieyouan64@yahoo.fr', NULL, NULL, NULL, NULL, 'Infirmier Major', NULL, 32, NULL, NULL, NULL, NULL, NULL, 0, 6, '2015-01-12', '29', '1999-10-18', '1993-04-13', 'Marié(e)', 5, '1964-07-22', 'F', 85, 'M', 'Diplôme d\'Infirmier d\' Etat', '01 03 32 58 85 / 07 07 98 63 81', 'C', '/images/20241018112257.jpg', '$2y$12$w.dUGEhabPhZ1Ch1KVnAtu7IBfDCbY3zl182npuyRRNSgn2P0xwyu', NULL, '66dd717049ef1', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:08', '2025-01-30 08:50:51'),
(68, 'KABRAN Bomo Aline Colombe', '03006-P', '03006-P', NULL, NULL, NULL, NULL, NULL, 'Responsable Cellule Vente', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2006-01-02', '32', '2006-01-02', NULL, 'Célibataire', 2, '1974-08-16', 'P', 90, 'F', 'Gestion Pharmacie', '01 03 59 26 67 / 05 06 33 95 79', 'C', '/images/20241018114039.jpg', '$2y$12$kVAwWl3H65fCxCVlCpfu2uAagjawQ702XnwqhATd/f07GtuLKcxVW', '274010927607', '66dd7170827b3', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:08', '2024-11-04 01:05:55'),
(69, 'KACOU Aka Jean-Marc', '438 875-W', '438875-W', NULL, NULL, NULL, NULL, NULL, 'Infirmier Diplômé d’Etat', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2016-02-09', '29', '2016-02-09', '2017-04-18', 'Marié(e)', 2, '1985-10-21', 'F', 85, 'M', 'Diplôme d\'Etat d\'infirmier', '05 05 73 53 09', 'C', '/images/20241018114929.jpg', '$2y$12$hGF3IvHdrNDozCnjKCaIuOnoIK60ZmITgHJQDRThldZ4i13.erkgS', NULL, '66dd7170babf5', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:08', '2024-11-04 01:05:55'),
(70, 'KACOU Manouan Daniel', '438 876 X', '438876X', 'dnpkacou@gmail.com', NULL, NULL, NULL, NULL, 'Infirmier Diplômé d’Etat', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2016-02-09', '29', '2016-02-09', '2017-04-18', 'Marié(e)', 2, '1985-10-21', 'F', 85, 'M', 'Diplôme d\'Etat d\'infirmier', '07 47 26 86 08 / 01 02 25 80 23', 'C', '/images/20241018115227.jpg', '$2y$12$3pD7hGs5iTcxiXnjNC4JT./Wuvj2Hv4m.gTGjxjNf7Q7SMkWoEOmG', NULL, '66dd7170f32aa', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:09', '2024-11-04 01:05:55'),
(71, 'KADIO Alain César Auguste Benjamin', '230 827-Z', '230827-Z', 'alainkadio2017@gmail.com', NULL, NULL, NULL, NULL, 'Responsable Cellule Biomédicale et Technique', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2014-08-22', '29', '2006-11-09', '1989-06-08', 'Marié(e)', 1, '1965-07-09', 'F', 89, 'M', 'Brevet de Technicien Biomédical', '07 48 11 48 49 / 05 05 96 10 92', 'C', '/images/20241018120238.jpg', '$2y$12$N9YvXew0pw3gpAvN2yK0ROQlAT9Ayoy7UgMGh1g4U9.MyK9hq2jUa', NULL, '66dd717137159', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:09', '2024-11-04 01:05:55'),
(72, 'KADJO Ebi Herman', '18120-P', '18120-P', 'clarissemalan663@gmail.com', NULL, NULL, NULL, NULL, 'Chauffeur - Coursier CEC-MADGI', NULL, 37, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-11-01', '32', '2020-11-01', NULL, 'Célibataire', 3, '1990-05-03', 'P', 124, 'M', 'BEPC', '07 69 69 12 33 / 01 01 33 77 69', 'C', '/images/20241018121604.jpg', '$2y$12$fNYEnPH/KgjVgy/.YZbYwOgVSRL5uF6HrzOJlB3cnQOWtCaQqKrQO', '190012013356', '66dd717172734', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:09', '2024-12-18 09:08:12'),
(73, 'KAKOU Peggy Constantin', '438 877-Y', '438877-Y', 'peggy1er@yahoo.fr', NULL, NULL, NULL, NULL, 'Chef Cabinet PCA', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-06-01', '33', '2008-02-01', '2017-04-18', 'Marié(e)', 6, '1974-08-12', 'F', 97, 'M', 'Maitrise en droit privé', '07 08 35 41 91 / 01 01 10 08 31', 'C', '/images/20241018133459.jpg', '$2y$12$EMkyzhaNKmNZTaPcsP/EruMzyI2lcBpRaPEZyI4mW5T9P0ZmK6Cgy', NULL, '66dd7171ae325', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 7, '2024-09-08 09:42:09', '2024-12-20 15:13:59'),
(74, 'KONATE Maïmouna Intissar épouse KAMAGATE', '833 723-R', '833723-R', 'mounakonate9@gmail.com', NULL, NULL, NULL, NULL, 'Agent d\' acceuil', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2022-05-27', '34', '2022-05-27', '2022-05-27', 'Marié(e)', 4, '1989-12-12', 'F', 1, 'F', 'Baccalauréat série D', '07 07 71 84 61 / 01 01 23 63 01', 'M', '/images/20241018140120.jpg', '$2y$12$T2maeUI1uj.QPlXavswoy.sAMKXHy/43XMppHlLLij5FblvbOTUyS', NULL, '66dd7171e8a8c', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:10', '2024-11-04 01:05:55'),
(75, 'KAMENAN Noel', '251 256-M', '251256-M', 'noelkamenan@yahoo.fr', NULL, NULL, NULL, NULL, 'Ingénieur des Techniques Sanitaires', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2019-02-26', '33', '2019-02-26', '1995-03-01', 'Marié(e)', 3, '1966-01-12', 'F', 102, 'M', 'Diplôme d\'Ing des tech. Sanitaire option: imagerie médicale', '07 07 65 25 50', 'C', '/images/20241018154458.jpg', '$2y$12$.GO6hFpGIMe9TNXN6E39DecaHAZjXw7G1kZy2zOsQbf6Z3kRMVkRK', NULL, '66dd71722dad8', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:10', '2024-11-04 01:05:55'),
(76, 'KARAMOKO Issa El Habib', '00302-P', '00302-P', 'h.karamoko@madgi.ci', NULL, NULL, NULL, NULL, 'Conseiller Technique', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-09-08', '31', '2002-07-01', NULL, 'Marié(e)', 3, '1974-10-21', 'P', 111, 'M', 'Ing. de conception Option: Marketing Management', '01 01 04 49 47', 'M', '/images/20241018142126.jpg', '$2y$12$OOlQi3g1zmfIUNhONay9yeVPVR7bTR0r7DJAiFQrND.WbD0ipGujK', '174010408078', '66dd71726699e', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 1, 0, NULL, NULL, 3, '2024-09-08 09:42:10', '2024-12-20 15:14:25'),
(77, 'KIKI Sédé Cyrielle', '829 292-W', '829292-W', 'cyriellekiki@yahoo.fr', NULL, NULL, NULL, NULL, 'Conseiller Clientèle CEC-MADGI', NULL, 37, NULL, NULL, NULL, NULL, NULL, 1, 1, '2016-06-01', '33', '2016-06-01', '2022-05-11', 'Célibataire', 1, '1987-01-18', 'F', 125, 'F', 'Diplôme Sup Spécialité option:  Commerce- Communication', '07 07 39 90 95 / 01 41 23 84 80', 'C', '/images/20241018155933.jpg', '$2y$12$giZIAj9tHJv0HNCAvAZziej9r4yknGsEupDkrthE8XEUxbbx5KeLi', NULL, '66dd71729f06e', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:10', '2024-12-18 09:10:06'),
(78, 'MIEZAN Edoukou Affibah Marguerite  épouse  KOBENA', '829 294-Y', '829294-Y', 'ed_magui@yahoo.fr', NULL, NULL, NULL, NULL, 'Chef de Service Clientèle CEC-MADGI', NULL, 34, NULL, NULL, NULL, NULL, NULL, 1, 1, '2014-08-22', '29', '2007-09-03', '2022-05-11', 'Marié(e)', 1, '1977-11-16', 'F', 95, 'F', 'BTS Gestion commerciale', '01 01 58 01 48', 'C', '/images/20241018160326.jpg', '$2y$12$x1omuYZFcvCyBElZvgt0PeuEo9pF4/qK.8goIrFm47GzCCFgoGt2K', NULL, '66dd7172d7f18', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 5, '2024-09-08 09:42:11', '2024-12-20 15:23:25'),
(79, 'KOFFI épse IRIE Ahou Denise', '388 704-R', '388704-R', 'ibif_kad@hotmail.fr', NULL, NULL, NULL, NULL, 'Médecin Conseil', NULL, 33, NULL, NULL, NULL, NULL, NULL, 1, 6, '2023-01-02', '1', '2023-01-02', '2013-03-15', 'Marié(e)', 3, '1979-10-09', 'F', 99, 'F', 'Doctorat d\' Etat en Médecine', '01 02 03 34 03 / 07 48 88 29 96', 'C', '/images/20241018160807.jpg', '$2y$12$ayeKOQTNjqeLGVmS1DSxbuPJMVWsqPRvb88TV/YvpKN7aiigHQR9m', NULL, '66dd71731c5de', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:11', '2024-11-04 01:05:55'),
(80, 'KOFFI Kobenan  Sangne', '330 111-X', '330 111-X', 'drsangne5@yahoo.fr', NULL, NULL, NULL, NULL, 'Médecin Pédiatre', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2014-12-30', '30', '2014-12-30', '2007-01-15', 'Marié(e)', 3, '1973-12-23', 'F', 85, 'M', 'Doctorat en Pédiatrie', '07 07 45 69 99', 'C', '/images/20241018162313.jpg', '$2y$12$nHbGqHVeck3Z8R6HmdaZY.3K7gaeulZ0ETUuUnAU5CFR.ryDZRJGa', NULL, '66dd717355245', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:11', '2024-11-04 01:05:55'),
(81, 'KOFFI Kouadio Laurent', '10715-P', '10715-P', 'drkoffilaurent@hotmail.com', NULL, NULL, NULL, NULL, 'Médecin géneraliste', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2015-01-05', '31', '2015-01-05', NULL, 'Veu.f(ve)', 1, '1970-07-21', 'P', 85, 'M', 'Doctorat d’Etat en Médecine', '07 07 88 44 88 / 01 03 59 23 20', 'C', '/images/20241021085926.jpg', '$2y$12$0VyBdSSRcTFO3enxKMJlJOP//lyjXNWV7SuiXUiyBBc4afJq1aUpe', '170010602841', '66dd71738dcb0', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:11', '2024-11-04 01:05:55'),
(82, 'KOFFI N\'da Kouassi  Olivier', '279 520 N', '279 520N', 'litacolde@gmail.com', NULL, NULL, NULL, NULL, 'Responsable Cellule Préparation et Gestion de la Pharmacie', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2005-10-31', '29', '2005-10-31', '2000-09-19', 'Marié(e)', 2, '1975-03-02', 'F', 90, 'M', 'Diplôme de Technicien Sup. Santé', '01 02 03 84 00 / 05 05 92 33 91', 'C', '/images/20241021105642.jpg', '$2y$12$fhmBXvJQyJcoFbMC.Dml/OAURQBGIn.mJtDTRqqIaqyxqYVQTnOhK', NULL, '66dd7173c7448', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:12', '2024-11-04 01:05:55'),
(83, 'SOFFO Mélaine Prisca épouse KOFFI', '12216-P', '12216-P', 'm.soffo@madgi.ci', NULL, NULL, NULL, NULL, 'Responsable Cellule Communication Interne', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2016-05-01', '28', '2016-06-01', NULL, 'Marié(e)', 2, '1989-04-14', 'P', 112, 'F', 'Licence Prof Journaliste', '07 47 63 57 89 / 07 07 39 13 28', 'C', '/images/20241021110552.jpg', '$2y$12$hbJ.fuUUTF0vWp/jbwJ23.1h3RUZSKkS6yPWDyjvlhwo2vt.5ipUu', '289011717141', '66dd71740c40a', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:12', '2024-11-04 01:05:55'),
(84, 'KOLO SILUE', '05607-P', '05607-P', 'kolosilue70@yahoo.fr', NULL, NULL, NULL, NULL, 'Secrétaire Général', NULL, 39, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-09-08', '31', '2007-04-19', NULL, 'Marié(e)', 2, '1970-01-01', 'P', 113, 'M', 'Diplôme d’Ingénieur en TC', '01 01 12 50 83', 'C', '/images/20241021111259.jpg', '$2y$12$PBspHi66oqhpUWEIThivZ.Tq3JFb1.G3dV9DmuzTMxyqk4dAY1V5y', '170019920702', '66dd717445668', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, 2, '2024-09-08 09:42:12', '2024-12-20 15:18:28'),
(85, 'KONAN Aya Thérèsa', '848 090-E', '848090-E', 'konanaya750@gmail.com', NULL, NULL, NULL, NULL, 'Chargé Communication', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2019-10-01', '29', '2019-10-01', '2022-10-11', 'Célibataire', 0, '1997-03-07', 'F', 112, 'F', 'BTS RHCOM', '07 89 78 75 91 / 01 52 50 43 58', 'C', '/images/20241021112101.jpg', '$2y$12$hPPrtwsk3lYXLCykDPX67.vrjdqNF4i7WN0Oj1LfEhmqp1uZZtc5O', NULL, '66dd71747e5ab', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:12', '2024-11-04 01:05:55'),
(86, 'KONAN Koffi  Faustin', '329 505-E', '329505-E', 'ipouwa@yahoo.fr', NULL, NULL, NULL, NULL, 'Chef  Service Médical', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2020-09-17', '1', '2007-11-30', '2007-11-30', 'Marié(e)', 2, '1971-01-01', 'F', 85, 'M', 'Certificat d\'Etude Spécialisé en Ophtamologie', '05 06 45 71 03', 'C', '/images/20241021113507.jpg', '$2y$12$xeI/YAD1hy/Ei6MyGmk1ruaIttFf1Ju6/Eq34iPHHbv9VpVWmGBfu', NULL, '66dd7174b7047', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:12', '2024-11-04 01:05:55');
INSERT INTO `users` (`id`, `nom`, `matricule`, `mat_without_space`, `email`, `specialite`, `situation_convention`, `Date_validation`, `date_signature`, `fonction`, `type_stage`, `departement`, `situation_stage`, `date_validations`, `reconduction`, `categorie`, `etat`, `statut`, `site`, `date_occupation_p`, `grade`, `date_entre_mad`, `date_fonction`, `situation_matrim`, `nombre_enfant`, `date_naissance`, `statut_mad`, `service`, `genre`, `diplome`, `tel`, `confession_relg`, `photo`, `password`, `cnps`, `slug`, `type`, `start_date`, `end_date`, `date_debut_mise_disponibilite`, `date_fin_mise_disponibilite`, `lock_nb`, `lock_date`, `is_salarie`, `is_register`, `is_medical`, `type_device`, `unique_web_identifier`, `activity_id`, `created_at`, `updated_at`) VALUES
(87, 'KONAN Kouadio Armel', '444 391-X', '444391-X', 'k.melokouadio@gmail.com', NULL, NULL, NULL, NULL, 'Medecin Généraliste', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2016-02-09', '1', '2016-02-09', '2016-02-09', 'Célibataire', 2, '1983-08-16', 'F', 85, 'M', 'Doctorat en medecin', '07 07 16 46 04', 'C', '/images/20241021114958.jpg', '$2y$12$AFGKMGskvThaGAj0DBA6cudrKBNAJMNRo2VCAOundVXXLyci1mrp2', NULL, '66dd7174eedd7', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:13', '2024-11-04 01:05:55'),
(88, 'KONAN N’Guessan Jean Charles', '08314-P', '08314-P', NULL, NULL, NULL, NULL, NULL, 'Secretaire Médical', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2014-05-02', '32', '2014-05-02', NULL, 'Célibataire', 0, '1985-04-14', 'P', 85, 'M', 'CEPE', '01 41 75 76 21 /  07 59 99 93 72', 'C', '/images/20241021142546.jpg', '$2y$12$P5wzX7R6t7UNJh3ige48LOszAzLwH8scSG8qVwk/QmquDYIrSXam.', '185011565188', '66dd71753285a', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:13', '2024-11-04 01:05:55'),
(89, 'KONE  Gninlnankan Brice', '330 282-B', '330 282-B', 'b.kone@madgi.ci', NULL, NULL, NULL, NULL, 'Chef  Département APS', NULL, 33, NULL, NULL, NULL, NULL, NULL, 1, 6, '2020-09-08', '30', '2005-10-01', '2007-11-30', 'Marié(e)', 5, '1976-11-09', 'F', 114, 'M', 'Doctorat en medecin', '07 07 67 61 80 / 01 01 19 17 08', 'M', '/images/20241021143729.jpg', '$2y$12$E./rhQ.Z.gSuOJEoBBYxxeXCbFIUZ5cTu2OtGEyK9yT9FKC0bAHpC', NULL, '66dd71756b78b', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 4, '2024-09-08 09:42:13', '2024-12-20 15:19:00'),
(90, 'KONE Atchoumnan', '05007-P', '05007-P', 'metanmiracle@gmail.com', NULL, NULL, NULL, NULL, 'Responsable Cellule Réseau et Matériels Informatiques', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 6, '2007-02-15', '28', '2007-02-15', NULL, 'Célibataire', 1, '1974-02-12', 'P', 3, 'M', 'Diplôme Sup Spécialité Option: Réseau Informatique', '07 59 98 20 15 / 05 45 06 43 20', 'C', '/images/20241021152412.jpg', '$2y$12$ZXFsX3h3OSATDyf1uMxuWeH51iYO4sHw/FcsB6AvEGnKkiT4Vz1km', '174010927111', '66dd7175a3fae', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:13', '2024-11-04 01:05:55'),
(91, 'KONE Hamed', '429 579-C', '429579-C', 'hamed2017kone@gmail.com', NULL, NULL, NULL, NULL, 'Educateur Préscolaire Adjoint', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2020-12-07', '37', '2020-12-07', '2016-09-05', 'Célibataire', 0, '1986-11-11', 'F', 88, 'M', 'Diplôme d\'Etat d\'Educateur Prescolaire', '07 79 61 06 38 / 05 55 68 72 41', 'C', '/images/20241021153450.jpg', '$2y$12$1TqzIT7toYvkaH2k1QpsyOGztUZZFuNz22lnqLFm41QntNg73lP56', NULL, '66dd7175dd17a', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:14', '2024-11-04 01:05:55'),
(92, 'KONE Kawonama Josiane', '18220-P', '18220-P', NULL, NULL, NULL, NULL, NULL, 'Caissière', NULL, 36, NULL, NULL, NULL, NULL, NULL, 1, 6, '2020-11-01', '32', '2020-11-01', NULL, 'Célibataire', 1, '1978-11-25', 'P', 108, 'F', 'BTS Option Commerciale', '07 07 81 40 15 / 01 71 26 63 00', 'C', '/images/20241021153859.jpg', '$2y$12$qfVm8RKH7BZ6Clna0dtF6uent7aPhvKYGv/q5Vu.gXRVVXlY2zvJu', '278010634276', '66dd717621050', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:14', '2024-11-04 01:05:55'),
(93, 'KONE Mamadou', '00404-P', '00404-P', 'konepac@yahoo.fr', NULL, NULL, NULL, NULL, 'Chargé du Patrimoine', NULL, 31, NULL, NULL, NULL, NULL, NULL, 0, 6, '2014-08-26', '32', '2004-02-08', NULL, 'Célibataire', 3, '1964-05-17', 'P', 96, 'M', 'BTS F.Comptabilité', '07 07 10  90 03 / 01 40 63 42 44', 'C', '/images/20241021155719.jpg', '$2y$12$K1VFsYjtf9MYEdMJnOyIseQur6V.n.i62saN7Jy4HAvXuS4PIG2vm', '164010408083', '66dd71765ba32', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:14', '2025-02-24 13:09:46'),
(94, 'KONE Pégobanagnana', '848 091-T', '848091-T', 'pegobkone1975@gmail.com', NULL, NULL, NULL, NULL, 'Responsable Cellule Budget', NULL, 36, NULL, NULL, NULL, NULL, NULL, 1, 1, '2015-04-09', '33', '2015-04-09', '2022-10-11', 'Marié(e)', 1, '1979-12-16', 'F', 115, 'M', 'MASTER  Sciences Eco', '05 05 09 06 65 / 01 41 00 92 27', 'C', '/images/20241021160258.jpg', '$2y$12$a3HcM4ZqElHQdBdaYaVlyearW/CmdESFcTV50bMrYh2.qpFRy0o4e', NULL, '66dd717692e46', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:14', '2024-11-04 01:05:55'),
(95, 'KONE Tcheplé Fatoumata', '19723-P', '19723-P', NULL, NULL, NULL, NULL, NULL, 'Aide-soignante', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2003-03-01', '32', '2023-03-01', NULL, 'C', 4, '1987-08-16', 'P', 110, 'F', 'Certificat d\'Aptitude Professionnelle Option Sanitaire et Social', '07 78 93 86 32', 'M', '/images/20241021161257.jpg', '$2y$12$1Gi3Ik9JHbrD0.8G7uGQW.H0wgFLLohI4s961WhDsnzSLx6pGk7nC', '202300037784', '66dd7176ceaba', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:15', '2024-11-04 01:05:55'),
(96, 'KOUADIO Affoué Anne-Marie', '444 403-U', '444403-U', NULL, NULL, NULL, NULL, NULL, 'Aide soignante', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2006-05-05', '36', '2006-05-05', '2017-04-14', 'Célibataire', 1, '1988-10-22', 'F', 85, 'F', 'BEPC', '07 07 05 04 41 / 01 03 54 72 95', 'C', '/images/20241022112630.jpg', '$2y$12$9mBYm2/fiZJSYtKaoU4pxO5UPUf39ju9RFRtxS/7zGZrtj6AcmFL2', NULL, '66dd717713f97', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:15', '2024-11-04 01:05:55'),
(97, 'KOUADIO Amoin', '19823-P', '19823-P', NULL, NULL, NULL, NULL, NULL, 'Aide-soignante', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2023-03-01', '32', '2023-03-01', NULL, 'Veu.f(ve)', 3, '1965-01-24', 'P', 110, 'F', 'Certificat d\'Aptitude Professionnelle Option Sanitaire et Social', '07 57 29 34 59 / 01 03 02 36 59', 'C', '/images/20241022114350.jpg', '$2y$12$QS7CIrVOXvHHfIvZ/LZXNu/swHv1hIzway22Sa/0NXERZRtdvfr2e', '202300037793', '66dd71774be2d', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:15', '2024-11-04 01:05:55'),
(98, 'KOUADIO Kacou Uberson', '290 676 N', '290676N', 'u.kouadio@madgi.ci', NULL, NULL, NULL, NULL, 'Administrateur Général', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-01-01', '30', '2020-01-01', '2004-03-03', 'Marié(e)', 4, '1977-12-17', 'F', 111, 'M', 'Cycle Sup ENA', '07 08 36 14 27/ 01 01 52 59 21', 'C', '/images/20241022115302.jpg', '$2y$12$AO4oVDxIqHHJCPRf1lNG4.XYNMZMc/ruzGe4.olCLBriU6F9Wqrpu', NULL, '66dd717785296', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 1, '2024-09-08 09:42:15', '2024-12-19 15:10:18'),
(99, 'KOUADIO Koffi  Ferdinand', '251 502 D', '251502D', 'koffiferdinand.kouadio@yahoo.fr', NULL, NULL, NULL, NULL, 'Inspecteur de soins Infirmiers', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2014-12-30', '1', '2014-12-30', '1997-04-10', 'Marié(e)', 2, '1972-01-26', 'F', 85, 'M', 'Diplôme d\'Inspecteur de Soins Infirmiers', '05 05 71 67 62 / 01 01 33 81 61', 'C', '/images/20241022120626.jpg', '$2y$12$I6vd9LVpUOKy.VOp9Yl3zePKZTYIRa/amwxD2XIzSpMGbMmz/lQX2', NULL, '66dd7177bdceb', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:16', '2024-11-04 01:05:55'),
(100, 'KOUADIO Konan Raphaël', '19422-P', '19422-P', 'r.kouadio@madgi.ci', NULL, NULL, NULL, NULL, 'Chef de service Juridique', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2024-04-08', '31', '2022-04-01', NULL, 'Célibataire', 3, '1977-01-01', 'P', 116, 'M', 'DEA en Droit Privé', '07 07 46 61 51 / 01 02 88 51 51', 'C', '/images/20241022121036.jpg', '$2y$12$9sYWQS40zduW7Sr1udbkmOFMHNh3u2Ahm3iO09syNrXfapYEyBvBi', '177011337600', '66dd717801ba1', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, 5, '2024-09-08 09:42:16', '2024-12-18 10:17:11'),
(101, 'KOUADIO Kouamé', '373 720-L', '373 720-L', NULL, NULL, NULL, NULL, NULL, 'Brancardier', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2014-12-30', '38', '2014-12-30', '1987-01-12', 'Marié(e)', 4, '1965-11-14', 'F', 85, 'M', 'Acceuil et communication en milieu Hospitalier', '05 05 90 91 09 / 01 02 38 33 74', 'C', '/images/20241022122432.jpg', '$2y$12$6gvtRm.IwTdIMU8EAlMMku3e3I9mIGK/slkW83kdAY.60zCWaSRBW', NULL, '66dd7178397bc', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:16', '2024-11-04 01:05:55'),
(102, 'KOUADIO Kouamé  Antoine', '159 399-R', '159399-R', NULL, NULL, NULL, NULL, NULL, 'Inspecteur de Soins Infirmiers', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2006-06-06', '1', '2006-06-06', '2010-01-01', 'Marié(e)', 5, '1965-01-05', 'F', 85, 'M', 'Diplôme d\' Inspecteur de soins Infirmiers', '07 07 98 50 82 / 01 02 03 89 56', 'C', '/images/20241022123001.jpg', '$2y$12$sjztHpAxSQdzmOVyj2.gHuBRWsNd6mwE0Z9QcG3ZqlhypfZdDBLwe', NULL, '66dd717871e19', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:16', '2024-11-04 01:05:55'),
(103, 'KOUADIO Kouassi Jean Luc', '368 599-K', '368599-K', 'kouadiokjl@yahoo.fr', NULL, NULL, NULL, NULL, 'Infirmier Diplomé d\'Etat', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2019-02-26', '29', '2019-02-26', '2011-08-23', 'Marié(e)', 2, '1982-04-17', 'F', 85, 'M', 'Diplôme d\'Etat d\'infirmier', '07 07 18 06 42 / 01 02 01 65 65', 'C', '/images/20241022144119.jpg', '$2y$12$qa9Vo0tGgtLfQj1oO997w.PSEcJ986MNUDaF2jFz.M0G09XPpPP8.', NULL, '66dd7178a9c1b', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:16', '2024-11-04 01:05:55'),
(104, 'KOUASSI Aya Thérèse épouse KOUADIO', '251 258-X', '251258-X', 'koyatherese@yahoo.fr', NULL, NULL, NULL, NULL, 'Technicien Supérieur de Laboratoire', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2019-02-26', '29', '2019-02-26', '1995-03-30', 'M', 4, '1968-12-30', 'F', 85, 'F', 'Certificat de Compétence de Gestion de Projet et de Developpement Durable', '07 07 80 49 18', 'C', '/images/20241022151321.jpg', '$2y$12$Vw01hPghh3a.jbwRaiqriOrwhWDuia42v9IYhqCzTc4Ek580LRjTG', NULL, '66dd7178e1d49', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:17', '2024-11-04 01:05:55'),
(105, 'KOUADIO Yann Patrick', '13316-P', '13316-P', 'yannpatrick85@gmail.com', NULL, NULL, NULL, NULL, 'Chauffeur', NULL, 31, NULL, NULL, NULL, NULL, NULL, 1, 1, '2016-12-15', '32', '2016-12-15', NULL, 'Marié(e)', 2, '1985-10-05', 'P', 96, 'M', 'BTS Gestion commerciale', '07 09 89 83 96 / 05 06 66 42 43', 'C', '/images/20241022151738.jpg', '$2y$12$2ZR3AcogB3RK0kvZQPTxG.v1h1uLgeUMGFdGHCzduVZKphJ4bQ/dW', '185011730255', '66dd7179256a4', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:17', '2024-11-04 01:05:55'),
(106, 'KOUAKOU Adayé', '275 891-T', '275891-T', 'adaye69@yahoo.fr', NULL, NULL, NULL, NULL, 'Conseiller Technique', NULL, 30, NULL, NULL, NULL, NULL, NULL, 0, 1, '2020-09-08', '1', '2005-07-28', '1999-01-18', 'Célibataire', 5, '1969-07-02', 'F', 111, 'M', 'Diplôme de l\' Agence Japonnaise de coopération en Management', '07 08 99 17 17', 'C', '/images/20241022154859.jpg', '$2y$12$nVJCbtwFUVi4TxgkML6QMO5xyv.5fAtUwJZPLVapBS5v7MQI1s9.i', NULL, '66dd71795cfc0', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 1, 0, NULL, NULL, 3, '2024-09-08 09:42:17', '2025-01-27 12:37:53'),
(107, 'KOUAKOU Ahou Sylvie', '462 122-K', '462122-K', 'sylviamat24@gmail.com', NULL, NULL, NULL, NULL, 'Assistante Sociale', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2018-10-02', '29', '2018-10-02', '2018-10-08', 'Célibataire', 1, '1980-04-24', 'F', 88, 'F', 'Assistante sociale', '07 08 97 60 28', 'C', '/images/20241022161057.jpg', '$2y$12$2uage26PdcFyF6ZF5w.U9.kzIK9aP7KTgL/rNFR183IQAouLOUSRm', NULL, '66dd71799434a', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:17', '2024-11-04 01:05:55'),
(108, 'KOUAKOU Kouassi  Faustin', '277 358-V', '277358-V', 'faustin_kouakou@yahoo.fr', NULL, NULL, NULL, NULL, 'Surveillant d\'Unité de Soins', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2006-06-06', '33', '2006-06-06', '1999-10-05', 'Marié(e)', 4, '1973-12-30', 'F', 85, 'M', 'Surveillant d\'Unité de Soins', '07 08 45 63 64 / 01 14 85 85', 'C', '/images/20241022161440.jpg', '$2y$12$VsDJhSgsf/4iY0YQLhT4ounvQ2ezxHYskusPhWO5wWeBJmLxAtIOe', NULL, '66dd7179cc84d', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:18', '2024-11-04 01:05:55'),
(109, 'BROU Assoko Emilienne épouse KOUAKOU', '03506-P', '03506-P', 'brouassoko@yahoo.fr', NULL, NULL, NULL, NULL, 'Aide soignante', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2006-06-01', '32', '2006-06-01', NULL, 'Marié(e)', 3, '1973-12-27', 'P', 85, 'F', 'BT Sciences médico sociale', '01 01 28 17 58 / 07 57 95 00 95', 'C', '/images/20241022162326.jpg', '$2y$12$faXQtllocfnXSjatbWfmHe5d3PO55AaMmJ77AefklGaxnIuHHfWx.', NULL, '66dd717a101f0', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:18', '2024-11-04 01:05:55'),
(110, 'KOUASSI Koffi Affoué Hortense épouse KOUAKOU', '290 983-T', '290983-T', 'hortensekouassikoffi@gmail.com', NULL, NULL, NULL, NULL, 'Médecin Pédiatre', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2023-01-12', '30', '2023-01-12', '2002-09-02', 'Marié(e)', 2, '1971-02-03', 'F', 85, 'F', 'Doctorat d\' Etat en Médecine', '07 07 96 87 93 / 01 02 24 08 79', 'C', '/images/20241023114524.jpg', '$2y$12$xrA1O5EvlG2luQF0EXU72uNAQCGXG3LFHhg5UW6utAlQEsTX4N1p.', NULL, '66dd717a48292', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:18', '2024-11-04 01:05:55'),
(111, 'YOBOUE Adjo Françoise épouse KOUAKOU', '06708-P', '06708-P', 'a.yoboue@madgi.ci', NULL, NULL, NULL, NULL, 'Chef de Service  Moyens Généraux', NULL, 31, NULL, NULL, NULL, NULL, NULL, 1, 1, '2014-08-22', '31', '2008-11-02', NULL, 'Marié(e)', 2, '1977-05-24', 'P', 96, 'F', 'DESS. Ingénieur finances Contrôle de Gestion et Audit', '01 02 96 07 08 / 07 08 11 01 61', 'C', '/images/20241220142325.jpg', '$2y$12$JV2yJaJCqvkRpquctXTVJuC5CTZ9C3QZh1rtJrjaW2q2vHeuCGj.a', '277010926616', '66dd717a800a1', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, 5, '2024-09-08 09:42:18', '2024-12-20 14:23:25'),
(112, 'KOUAME Daly Amoin Marcelle', '14218-P', '14218-P', 'marcelledaly65@gmail.com', NULL, NULL, NULL, NULL, 'Assistante Pharmacie', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2018-04-01', '32', '2018-04-01', NULL, 'Célibataire', 2, '1978-01-29', 'P', 90, 'F', 'CAP Auxilliaire pharmacie', '07 47 91 62 59 / 01 01 40 03 50', 'C', '/images/20241023111851.jpg', '$2y$12$4MBZQxZn5GUMrgbyTgTKXetfVlmUb4BulRPskrCtzsEfFfAe9n0R.', '278010946396', '66dd717ab788f', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:18', '2024-11-04 01:05:55'),
(113, 'NAMIDJA Anne-Marie épouse KOUAMELAN', '871 236-X', '871236-X', 'a.namidja@madgi.ci', NULL, NULL, NULL, NULL, 'Chef Service  Finances et Trésorerie', NULL, 36, NULL, NULL, NULL, NULL, NULL, 1, 1, '2014-08-22', '33', '2005-11-02', '2023-06-16', 'Marié(e)', 4, '1978-08-14', 'F', 108, 'F', 'Maitrise en Gestion', '01 03 59 28  42', 'C', '/images/20241023114209.jpg', '$2y$12$4sWjGbj2cYcDQ8oXK1/bmOTAl/OAnZVzxM39Wa6Vr7zdmPFaZu1QW', NULL, '66dd717aef98e', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 5, '2024-09-08 09:42:19', '2024-12-20 15:25:41'),
(114, 'KOUASSI Amoin Chantale', '286 551-Z', '286551-Z', NULL, NULL, NULL, NULL, NULL, 'Technicien Supérieur de Laboratoire', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2019-02-26', '29', '2019-02-26', '2001-12-04', 'Marié(e)', 3, '1973-12-09', 'F', 102, 'F', 'Diplôme de Technicien Sup. Santé', '05 05 41 70 29 / 01 01 25 44 90', 'C', '/images/20241023115132.jpg', '$2y$12$T9PFu8DHBPF1KASFEbtraO6avxrqw9KTqEiYGN3Z.Vo4Og.YiAThW', NULL, '66dd717b32c2a', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:19', '2024-11-04 01:05:55'),
(115, 'KOUASSI Edouard', '286 212-V', '286212-V', NULL, NULL, NULL, NULL, NULL, 'Infirmier diplomé d\'Etat', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, NULL, '29', NULL, NULL, 'M', 3, NULL, 'F', 102, 'M', 'Diplôme d\'Etat d\'infirmier', '07 78 64 43 38 / 01 42 13 21 14', 'C', '/images/20241023100112.jpg', '$2y$12$oLSRGJN0RxcJR0Jkm0NK/.DfjbHevtD4fd.vyppS/rgzb2kQGF156', NULL, '66dd717b6b07a', 1, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:19', '2024-11-04 01:05:55'),
(116, 'KRA Souagah Mariette épouse KOUASSI', '14918-P', '14918-P', 'keitteram@gmail.com', NULL, NULL, NULL, NULL, 'Assistante Pharmacie', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2018-04-01', '32', '2018-04-01', NULL, 'Marié(e)', 2, '1981-05-25', 'P', 90, 'F', 'CAP Auxilliaire pharmacie', '07 08 11 16 64', 'C', '/images/20241023122124.jpg', '$2y$12$Ef7.32N1LpclvMR34/kG8e7c46SEdQBG4HZIc0tcGhi3.bEJU8Dm6', '281011834597', '66dd717ba2cde', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:19', '2024-11-04 01:05:55'),
(117, 'SANGARE Aby Myriam Lorreine épouse KOUASSI', '18720-P', '18720-P', 'myriamsangare20@gmail.com', NULL, NULL, NULL, NULL, 'Chargée d\'Acceuil', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2020-11-01', '32', '2020-11-01', NULL, 'Marié(e)', 1, '1994-05-20', 'P', 88, 'F', 'BAC', '07 47 27 52 30', 'C', '/images/20241023122924.jpg', '$2y$12$mKKeW25yAJPBiQ3u.AioZuI1eAaDs/Vsd0osomsbP7tk6HoQ8LTS2', '294012099451', '66dd717bdb3e1', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:20', '2024-11-04 01:05:55'),
(118, 'TIA Monh Odile épouse  KOUASSI', '01505-P', '01505-P', NULL, NULL, NULL, NULL, NULL, 'Aide soignante', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2005-09-15', '32', '2005-09-15', NULL, 'Marié(e)', 3, '1979-01-01', 'P', 85, 'F', 'CAP Sanitaire et Social', '05 46 81 84 34 / 01 03 80 38 24', 'C', '/images/20241023140809.jpg', '$2y$12$atsv0z/jxMJtChVfok6HienBo0OUbj0XTYzCRdBr7dC3K5CZMIMO2', '279010208358', '66dd717c1e58d', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:20', '2024-11-04 01:05:55'),
(119, 'YAO Justine N\'Dah Amenan épouse KOUASSI', '275 494-V', '275494-V', 'justineyao08@gmail.com', NULL, NULL, NULL, NULL, 'Caissière', NULL, 36, NULL, NULL, NULL, NULL, NULL, 1, 6, '2021-07-29', '33', '2021-07-29', '1998-09-19', 'Marié(e)', 3, '1973-03-28', 'F', 108, 'F', 'Licence Professionnelle Sciences d\' Education', '07 08 03 86 99 / 01 03 35 59 80', 'C', '/images/20241023142202.jpg', '$2y$12$GYOVTKxnD3qzKMyCgj6t3OjKxA4/bQZvUH9ze7norL4AMsgM1REYa', NULL, '66dd717c565be', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:20', '2024-11-04 01:05:55'),
(120, 'KOUAME Bossomalé Marie-Jeanne épouse KOUBO', '297 022-M', '297022-M', 'bossomale@gmail.com', NULL, NULL, NULL, NULL, 'Chef Unité de Prévention', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2015-01-12', '1', '2006-11-09', '2003-09-15', 'Marié(e)', 2, '1970-06-12', 'F', 85, 'F', 'Doctorat d\' Etat en médecine', '01 02 50 52 84 / 07 07 08 55 31', 'C', '/images/20241024145713.jpg', '$2y$12$MZ1qyG3Wv8I/7xOxW.CE/OoOOrr0JNOK.H84Wn9iFv3Xqy5T7Y0Mi', NULL, '66dd717c8de7c', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 6, '2024-09-08 09:42:20', '2024-12-20 15:21:56'),
(121, 'BESS Evelyne Esther épouse KOUDOU', '286 762-C', '286762-C', 'mekmarcel2000@yahoo.fr', NULL, NULL, NULL, NULL, 'Sage-Femme', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2019-02-26', '29', '2019-02-26', '2001-10-21', 'Marié(e)', 4, '1973-07-14', 'F', 85, 'F', 'Diplôme d\'Etat de Sage femme', '01 01 08 36 18 / 07 07 70 11 88', 'C', '/images/20241024150234.jpg', '$2y$12$cPgb/px8O.ao0rN2ru3LmOsA3aXAvcihQqIIMTlLPC0ww7YIqS8I6', NULL, '66dd717cc5d1b', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:21', '2024-11-04 01:05:55'),
(122, 'BAME Donwahi Gnaziadé Amandine épouse KOULAÏ', '11216-P', '11216-P', 'a.bame@madgi.ci', NULL, NULL, NULL, NULL, 'Responsable de l\'Administration CEC- MADGI', NULL, 37, NULL, NULL, NULL, NULL, NULL, 1, 1, '2016-06-01', '28', '2016-06-01', NULL, 'Marié(e)', 1, '1990-07-12', 'P', 124, 'F', 'BTS Finances Comptabilité', '07 58 73 55 33 / 01 01 44 53 23', 'C', '/images/20241024151527.jpg', '$2y$12$gE.5vvs24rffLIgzYN1idOFnsVtpSeG63i/yrKvh/l9XSvczR/LLW', '290011717136', '66dd717d08fe9', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:21', '2024-12-18 09:02:37'),
(123, 'KOUTOUAN Api Laurence Henriette', 'NA', 'NA', 'koutouanlaurence@gmail.com', NULL, NULL, NULL, NULL, 'Collaborateur Extérieur', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2023-01-12', '35', '2023-01-12', NULL, 'Célibataire', 1, '1971-12-20', 'Contractuelle  DGI', 88, 'F', 'Diplôme d\' Etat d\'Education Spécialisé', '01 02 38 52 00 / 07 07 50 21 11', 'C', '/images/20241024152439.jpg', '$2y$12$Ko3dx8SAF5Qm/qKbkD4PXuxGLbC5sAph7I1iOVJh1zVAg4bGVs0zO', NULL, '66dd717d40ddf', 1, NULL, NULL, NULL, NULL, 0, NULL, 3, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:21', '2024-12-26 08:11:30'),
(124, 'KPANGNI Kadjo Blaise', '06408-P', '06408-P', 'blaisekpangni@gmail.com', NULL, NULL, NULL, NULL, 'Comptable CEC-MADGI', NULL, 37, NULL, NULL, NULL, NULL, NULL, 1, 1, '2008-01-02', '28', '2008-01-02', NULL, 'Marié(e)', 3, '1985-11-27', 'P', 124, 'M', 'BTS Option Comptabilité', '01 01 59 00 77 / 07 08 09 97 90', 'C', '/images/20241024153337.jpg', '$2y$12$jy0xipNY/Cwa0nMzXMVdZOOOYXLPJwVOaB8YpcPDqYHBGGSpdQPNO', '177010511522', '66dd717d78cdc', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:21', '2024-12-18 09:11:48'),
(125, 'KPOKRO Loboho Stéphanie', '18620-P', '18620-P', 'stephanie.kpokro@yahoo.fr', NULL, NULL, NULL, NULL, 'Chargée d\'Acceuil', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-11-01', '28', '2020-11-01', NULL, 'Célibataire', 0, '1986-04-14', 'P', 107, 'F', 'DEUG 2 En droit', '07 47 74 75 24', 'C', '/images/20241024155021.jpg', '$2y$12$0hpw7gkhlJ6emGAbdaAuv.ErxJx1.iffR58p3MEnHoPa3yxmyyrnK', '286011639555', '66dd717db00cc', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:21', '2024-11-04 01:05:55'),
(126, 'DOUA-Bi Elodie Patricia épouse KPRAKPRA', '438 870-D', '438870-D', 'depar82@yahoo.fr', NULL, NULL, NULL, NULL, 'Chef du Bureau de l\'AG', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2014-08-22', '33', '2008-04-01', '2017-04-18', 'Marié(e)', 1, '1982-07-17', 'F', 1, 'F', 'Maitrise en espagnol', '01 01 04 55 47 /07 07 04 66 57', 'C', '/images/20241024161630.jpg', '$2y$12$FDN4oDPEMx7KLg3r5S00QeHSktaIL5ai3SGrOMz1abdiXQHh6.jrq', NULL, '66dd717de8c89', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 5, '2024-09-08 09:42:22', '2024-12-20 15:12:28'),
(127, 'OUATTARA Mariam épouse KRA', '848 096-Y', '848096-Y', NULL, NULL, NULL, NULL, NULL, 'Comptable', NULL, 36, NULL, NULL, NULL, NULL, NULL, 1, 1, '2016-06-01', '29', '2016-06-01', '2022-10-11', 'Marié(e)', 2, '1987-08-19', 'F', 108, 'F', 'BTS Finances Comptabilité', '07 47 13 69 81', 'M', '/images/20241024162245.jpg', '$2y$12$.pMxwg4ZV2m6xBin2ilUzeQ7Y2HYWP2l2FuxEYYI0g.ARIBZI8cdy', NULL, '66dd717e2c4d3', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:22', '2024-11-04 01:05:55'),
(128, 'LANGUI Kouakou John Andersen', '297 636-Z', '297636-Z', 'languijohm@yahoo.fr', NULL, NULL, NULL, NULL, 'Chef Unité Hygiène Hospitalière', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2019-02-26', '30', '2019-02-26', '2003-08-03', 'Célibataire', 2, '1971-02-04', 'F', 85, 'M', 'DESS Génie Sanitaire', '07 07 52 97 66 / 01 40 42 58 63', 'C', '/images/20241218095747.jpg', '$2y$12$wQMiI6sY3/hJilfRLoAH1e/GxiXC26BhTQFp/rjgQvxij1/ye59LK', NULL, '66dd717e64618', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 6, '2024-09-08 09:42:22', '2024-12-18 09:57:47'),
(129, 'M’BRA Konan Noël', '11816-P', '11816-P', 'k.mbra@madgi.ci', NULL, NULL, NULL, NULL, 'Chef de Service Informatique', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 6, '2024-04-08', '31', '2016-06-01', NULL, 'Marié(e)', 3, '1990-12-26', 'P', 3, 'M', 'Ingenieur de Conception informatique', '07 08 70 79 88', 'C', '/images/20241218101559.jpg', '$2y$12$ZEkJpMdFrbEJUst68M/A3e6hHeq4Nzs5XjMUop.n22jBNtYttmdaS', '190011717138', '66dd717e9beff', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, 'RP1A.200720.012.d2x.unknown.d2xks', NULL, 5, '2024-09-08 09:42:22', '2024-12-18 10:15:59'),
(130, 'MADOU Gnizako Armel', '11916-P', '11916-P', 'madougnizako@yahoo.fr', NULL, NULL, NULL, NULL, 'Chargé du Suivi-Evaluation', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-05-20', '28', '2016-06-01', NULL, 'Marié(e)', 1, '1978-10-16', 'P', 113, 'M', 'DESS Evaluation des Projets', '07 07 00 84 67', 'C', '/images/20241218110452.jpg', '$2y$12$lYFfDo7muk6X3SXiA61eY.5Gben3tl8khmUaDVpxZsRmNpcabRyXe', '178011413970', '66dd717ed5732', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:23', '2024-12-18 11:04:52'),
(131, 'MAHAN Dagui Ernest', '285 081-M', '285081-M', 'mahandagui@yahoo.fr', NULL, NULL, NULL, NULL, 'Gestionnaire du Social', NULL, 33, NULL, NULL, NULL, NULL, NULL, 1, 6, '2022-02-14', '33', '2022-02-14', '2001-07-30', 'Marié(e)', 5, '1968-12-23', 'F', 119, 'M', 'Master GRH', '07 57 95 45 03', 'C', '/images/20241218111332.jpg', '$2y$12$UmdbdReHsDv2.Q89/NzR6OOGJRL7zKURZ2V5VxlRsAGqMzCN7gXZ2', NULL, '66dd717f199a8', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:23', '2024-12-18 11:13:32'),
(132, 'TANOE Marie-Germaine épouse M\'BRA', '15318-P', '15318-P', 't.mg1@hotmail.fr', NULL, NULL, NULL, NULL, 'Responsable Cellule Gestion des Fichiers et Précomptes', NULL, 33, NULL, NULL, NULL, NULL, NULL, 1, 6, '2018-05-01', '28', '2018-05-01', NULL, 'Marié(e)', 2, '1983-08-06', 'P', 93, 'F', 'Assistante sociale', '01 03 85 92 59 / 07 07 72 91 59', 'C', '/images/20241218100725.jpg', '$2y$12$nd4QpkNmm7HUoQXpmkykiOheENAQquxaLNWvagDQ9ofLA.hrgoU.y', '283011637970', '66dd717f51d49', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:23', '2024-12-18 10:07:25'),
(133, 'MEA Bosson Claude', '270 383- L', '270 383-L', 'meabossonclaude@yahoo.fr', NULL, NULL, NULL, NULL, 'Responsable de Cellule Relations Publiques et Activités Socio-Culturelles', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-07-16', '29', '2020-07-16', '1998-06-15', 'Marié(e)', 5, '1972-02-07', 'F', 112, 'M', 'Diplôme d\'Adjoint Technique de la statistique', '01 02 15 15 15 / 07 77 55 79 84', 'C', '/images/20241218112541.jpg', '$2y$12$fL6jbSs81gWQCv8a1c.onOtsXExZ7KqZrRa2ixKfUMo5riuuuvFbK', NULL, '66dd717f89adf', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:23', '2024-12-18 11:25:41'),
(134, 'KOFFI Eliane épouse MENAN', '252 670-Z', '252670-Z', 'emenan@hotmail.com', NULL, NULL, NULL, NULL, 'Chef de Service du Suivi et de l\' Evaluation Médicale', NULL, 33, NULL, NULL, NULL, NULL, NULL, 1, 6, '2021-12-08', '30', '2006-11-09', '2001-07-21', 'Marié(e)', 3, '1971-04-29', 'F', 119, 'F', 'Doctorat en medecin', '01 02 11 76 31', 'C', '/images/20241218113856.jpg', '$2y$12$xjjr0demA2sycCfB0Ax.Tu1fkGJvgZaspN6JJIUumQ2rQ4L15E1ja', NULL, '66dd717fc26c8', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 5, '2024-09-08 09:42:24', '2024-12-18 11:38:56'),
(135, 'MIHE Téhi Ambroise', '320 628-K', '320 628-K', 'a.mihe@madgi.ci', NULL, NULL, NULL, NULL, 'Chef Service  Pharmacie', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2014-08-22', '30', '2007-06-06', '2007-02-05', 'Marié(e)', 2, '1971-12-07', 'F', 90, 'M', 'Doctorat en Pharmacie', '01 02 49 60 10', 'C', '/images/20241218115404.jpg', '$2y$12$pgi3tyjzMNItqftKD7KRJucjMge4sVnRmZLo/lH95HRt4ESi9JnVm', NULL, '66dd718006565', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 5, '2024-09-08 09:42:24', '2024-12-18 11:54:04'),
(136, 'MOUGO Affoué Jeannette', '360 628-T', '360 628-T', 'jean_mougo@yahoo.fr', NULL, NULL, NULL, NULL, 'Responsable de Cellule Secrétariat de l\' AG', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2010-10-01', '33', '2004-12-15', '2010-10-01', 'Célibataire', 0, '1972-01-01', 'F', 1, 'F', 'BTS Secrétariat', '01 01 11 24 30', 'C', '/images/20241218121753.jpg', '$2y$12$daIq694AxP6KDeAsnXo3.O0yUp5ejd5uvOOio4UJCnLRsPQlJ3Mv2', NULL, '66dd71803e0f4', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:24', '2024-12-18 12:17:53'),
(137, 'MOUROUFIE Yao Georges', '05707-P', '05707-P', NULL, NULL, NULL, NULL, NULL, 'Chauffeur', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2007-06-03', '32', '2007-06-03', NULL, 'Marié(e)', 6, '1981-04-23', 'P', 96, 'M', 'BEPC', '05 44 06 89 61 / 01 03 33 00 58', 'C', '/images/20241218122320.jpg', '$2y$12$dCMfoZXLK3dRoU6RRjVDJuYmjVJYHpjnGi8UlJ8amIh4CUiVRD9Aa', '181010927528', '66dd71807643b', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:24', '2025-03-05 14:01:29'),
(138, 'N’DRI Adjoua Véronique', '333 055-Z', '333055-Z', 'ndriveronique462@gmail.com', NULL, NULL, NULL, NULL, 'Agent du Bureau des Entrées', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2020-12-07', '33', '2020-12-07', '2009-03-31', 'Célibataire', 1, '1975-02-04', 'F', 88, 'F', 'Certificat d\'Aptitude à la maitresse d\'education permanent', '07 08 82 55 89 / 01 01 98 31 88', 'C', '/images/20241218150625.jpg', '$2y$12$BjwwJatXrwaPDOzlxH4H4eJzVe0QnHTpbRuro.7oDXcC9DG3QmXxe', NULL, '66dd7180ade0c', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:24', '2024-12-18 15:06:25'),
(139, 'N’DRI Konan Jérôme', '08414-P', '08414-P', 'jeromendri2@gmail.com', NULL, NULL, NULL, NULL, 'Brancardier', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2014-05-02', '32', '2014-05-02', NULL, 'Célibataire', 4, '1973-04-07', 'P', 85, 'M', 'CEPE', '01 03 48 52 74', 'C', '/images/20241218151246.jpg', '$2y$12$YA8NOn.lYOBCC6xv5YEIV.icrb44kJ0KKcydg6aut04rJ.hw.apNW', '173010104415', '66dd7180e5857', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:25', '2024-12-18 15:14:37'),
(140, 'NEKPEHI Bailly Serge  Pacome', '354 394-F', '354 394-F', NULL, NULL, NULL, NULL, NULL, 'Infirmier Diplômé d’Etat', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2015-01-05', '29', '2014-12-30', '2009-12-01', 'Célibataire', 2, '1978-10-24', 'F', 85, 'M', 'Diplôme d\'Etat d\'infirmier', '07 59 99 93 62', 'C', '/images/20241218151913.jpg', '$2y$12$PjgiYYUIY/uPGjfCWCuyW.2ImfAaXBgSINgOxp3qagQp88n9RAwHa', NULL, '66dd718128c8b', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:25', '2024-12-18 15:19:13'),
(141, 'NEMLIN Beklou Théodore', '19523-P', '19523-P', 'nemlinbekloutheodore@gmail.com', NULL, NULL, NULL, NULL, 'Archiviste', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2023-03-01', '28', '2023-03-01', NULL, 'Célibataire', 0, '1989-01-27', 'P', 1, 'M', 'Licence Professionnelle 3 Option: Sciencede l\'Information Documentaire', '07 79 43 08 95 / 07 49 90 27 09', 'C', '/images/20241218152951.jpg', '$2y$12$57Llu1yzybxw3Xej7yTr1Odtf5XOVeqpled9lznmXhyfIBwzvhjOu', '202300037789', '66dd71816147e', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:25', '2024-12-18 15:29:51'),
(142, 'ANGBO Judith épouse N\'GBECHE', '385 562-X', '385562-X', 'angbojudith@gmail.com', NULL, NULL, NULL, NULL, 'Sage-femme', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2023-01-12', '29', '2023-01-12', '2013-02-28', 'Marié(e)', 1, '1980-05-04', 'F', 85, 'F', 'Diplôme d\'Etat de Sage-femme', '07 09 70 98 60 / 01 02 63 52 53', 'C', '/images/20241218124755.jpg', '$2y$12$5R6k5Bg8/BDHhhyKIwrQVOsemu5E.avVcjSrlAAOCrf4qHnwnsNd6', NULL, '66dd718199297', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:25', '2024-12-18 12:47:55'),
(143, 'N\'GUESSAN Nanegnon Marc Donald', '802 889-T', '802889-T', 'docteurmarcdo@gmail.com', NULL, NULL, NULL, NULL, 'Médecin Conseil', NULL, 33, NULL, NULL, NULL, NULL, NULL, 1, 6, '2024-04-08', '1', '2024-04-08', '2020-09-11', 'Célibataire', 2, '1990-05-10', 'F', 99, 'M', 'Diplôme d\' Etat de Docteur Medecine', '01 02 18 80 43 / 07 49 69 73 22', 'C', '/images/20241218145128.jpg', '$2y$12$qhXKBXbo41ZwaPzjrXn2V.ayaImD/AUUs0wgPMNIkiKNXl5K9Xkn6', NULL, '66dd7181d1dc8', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:26', '2024-12-18 14:51:28'),
(144, 'N\'GUETTA Kodjo Mathias', '392 064-W', '392 064-W', 'nguettamathias@gmail.com', NULL, NULL, NULL, NULL, 'Chef d\' Unité Urgences', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2015-11-27', '1', '2012-05-02', '2013-06-03', 'Marié(e)', 7, '1974-05-31', 'F', 85, 'M', 'Doctorat en medecin', '07 07 68 50 10  / 01 02 31 11 30', 'C', '/images/20241218150105.jpg', '$2y$12$LQAGX3Suy2P7c8IFeo2zVO.a83fTlcR/lASeNFP63hC84t5sfmNoK', NULL, '66dd718215b12', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 6, '2024-09-08 09:42:26', '2024-12-18 15:01:05'),
(145, 'NIAMKETCHI José-Roland', '14418-P', '14418-P', 'niamketchijose@hotmail.fr', NULL, NULL, NULL, NULL, 'Responsable de la Trésorerie CEC-MADGI', NULL, 37, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-04-01', '28', '2018-04-01', NULL, 'Marié(e)', 1, '1986-09-14', 'P', 124, 'M', 'DESS Ingenierie Financier', '07 08 22 35 41 / 05 06 56 30 32', 'C', '/images/20241218153441.jpg', '$2y$12$sgSHyB5jhwH3ZCkaMw8B8.IRTyHNAoXe3XTSBEC9sM.ZP4LwkF6zS', '186011832287', '66dd71824e087', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:26', '2024-12-18 15:34:41'),
(146, 'BAHOUELI Aurélie épouse ODJE', '871 294-S', '871294-S', 'aurelieodje@yahoo.fr', NULL, NULL, NULL, NULL, 'Chef Service  Communication et Relations Publiques', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2014-08-22', '1', '2005-12-01', '2023-06-16', 'Marié(e)', 2, '1977-01-01', 'F', 112, 'F', 'DESS Communication', '07 07 06 96 19', 'C', '/images/20241218154114.jpg', '$2y$12$JqA4Wcil7o7N6qvc3a0EXe1FVjH5fzMyzZ//SKytb62brxjaPgZXy', NULL, '66dd7182860a9', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 5, '2024-09-08 09:42:26', '2024-12-18 15:41:14'),
(147, 'OKOIN Asseu Olivier', '359 611-M', '359611-M', 'olivierokoin28@gmail.com', NULL, NULL, NULL, NULL, 'Chargé de stocks', NULL, 31, NULL, NULL, NULL, NULL, NULL, 1, 6, '2015-02-18', '39', '2015-02-18', '2010-05-04', 'Célibataire', 3, '1979-03-05', 'F', 96, 'M', 'Attestation de reussite AGEFOP', '07 48 76 37 81/ 01 40 41 28 22', 'C', '/images/20241218154952.jpg', '$2y$12$jE6axgEPjBSZ1tqpI0SlY.jHH1lvZEwX6lbNZMrqXRcJNv.CXCTnq', NULL, '66dd7182beafe', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:27', '2024-12-18 15:49:52'),
(148, 'OKOUE Ohoukou Augustin', '13016-P', '13016-P', 'augustinokoue@gmail.com', NULL, NULL, NULL, NULL, 'Chargé du Patrimoine', NULL, 31, NULL, NULL, NULL, NULL, NULL, 1, 1, '2017-06-06', '28', '2016-11-03', NULL, 'Marié(e)', 5, '1979-11-18', 'P', 96, 'M', 'BAC', '07 08 05 74 38', 'C', '/images/20241218155517.jpg', '$2y$12$gp/UXM7vwMy.AXsjKAy5T.PPWLGHH8IZvrgYLe2AbjjZdIkU33.Ze', '179011954765', '66dd718302a94', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:27', '2024-12-18 15:55:17'),
(149, 'OKREME Apollinaire Ledjé', '279 728 -S', '279728-S', 'okreme68@gmail.com', NULL, NULL, NULL, NULL, 'Infirmier diplomé d\'Etat', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2019-10-15', '29', '2019-10-15', '2000-09-05', 'Marié(e)', 0, '1971-03-28', 'F', 85, 'M', 'Diplôme d\'Etat d\'infirmier', '07 07 64 54 59 / 01 02 02 04 90', 'C', '/images/20241218160422.jpg', '$2y$12$74sFgpnElHbaz06XeeBj3O/YMtRtWIxRxsMCVk3k.NFBda.Ek46Qq', NULL, '66dd71833b94f', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:27', '2024-12-18 16:04:22'),
(150, 'OUATTARA Drissa', '389 362-J', '389362-J', 'douattara2910@gmail.com', NULL, NULL, NULL, NULL, 'Infirmier Diplômé d’Etat', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2019-09-16', '29', '2019-09-16', '2013-02-20', 'Célibataire', 4, '1976-10-29', 'F', 85, 'M', 'Diplôme d\'Etat d\'Infirmier', '05 05 56 93 14 / 07 89 82 16 21', 'C', '/images/20241218160901.jpg', '$2y$12$3C0dFxhPsGBxPETP280z2uMC88CAzluxtV18BD1SiB79k1Y7L7OZy', NULL, '66dd718374cc7', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:27', '2024-12-18 16:09:01'),
(151, 'OUATTARA Hervé', '304 727-B', '304727-B', 'drouattrv@gmail.com', NULL, NULL, NULL, NULL, 'Chef Unité Odontostomatologie', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2006-11-09', '30', '2005-11-23', '2004-09-01', 'Marié(e)', 3, '1972-10-29', 'F', 85, 'M', 'Doctorat en chirurgie dentaire', '05 05 96 07 85 / 01 02 57 58 59', 'C', '/images/20241218161527.png', '$2y$12$GGxO5vnul1XPjHrWVrl2X.OYyhJ3laKx8OlVNj0Zs8EWeoQebH7ES', NULL, '66dd7183ad802', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 6, '2024-09-08 09:42:27', '2024-12-18 16:15:27'),
(152, 'OUATTARA Kati', '270 265-V', '270 265-V', NULL, NULL, NULL, NULL, NULL, 'Aide soignante', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2015-01-05', '36', '2014-12-30', '1998-07-08', 'Célibataire', 5, '1975-07-05', 'F', 85, 'F', 'CAP Sanitaire', '07 07 81 63 70 / 01 02 97 86 66', 'C', '/images/20241218162030.jpg', '$2y$12$2OZ7aFaYmbEWycCiUeu3IePVXMYp4ypVKNEZGk8kN2GgjEspFHZeu', NULL, '66dd7183e676f', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:28', '2024-12-18 16:20:30'),
(153, 'TOVIHO Fifa Esther Colombe épouse OUATTARA', '329 691-G', '329 691-G', 'colombe_toviho@yahoo.fr', NULL, NULL, NULL, NULL, 'Chef Unité Néphrologie', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2015-01-05', '1', '2014-12-30', '2007-01-15', 'Marié(e)', 1, '1976-06-16', 'F', 101, 'F', 'Diplôme Universitaire en transplantation d\'organes', '07 07 31 40 22', 'C', '/images/20241219101403.jpg', '$2y$12$ir4QfpY0OnH4XY03ZZOCEOBPK7AlXZ1WCvJJPlQ0W84WH6HIBsP72', NULL, '66dd71842bdeb', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 6, '2024-09-08 09:42:28', '2024-12-19 11:11:23'),
(154, 'OUATTARA Tieba', '18320-P', '18320-P', 'tieba_ouattara@yahoo.fr', NULL, NULL, NULL, NULL, 'Comptable', NULL, 36, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-01-02', '28', '2020-11-02', NULL, 'Célibataire', 0, '1985-02-01', 'P', 115, 'M', 'LICENCE 3 audit et contrôle de gestion', '07 57 42 62 38 / 01 02 78 05 85', 'M', '/images/20241219102128.jpg', '$2y$12$RS6YqlNUm7alMafifGSZ9uZqNTVe/RH0aY12wMXUiRGlYPxiTd6Q.', '185012058198', '66dd718465058', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:28', '2024-12-19 10:21:28'),
(155, 'OULE Stéphane', '345 961-E', '345961-E', 'ouleste@yahoo.fr', NULL, NULL, NULL, NULL, 'Responsable Cellule Gestion et Contrôle des Prestations Externes', NULL, 33, NULL, NULL, NULL, NULL, NULL, 1, 6, '2019-02-26', '29', '2019-02-26', '2009-05-25', 'Marié(e)', 3, '1974-10-10', 'F', 99, 'M', 'BTS Assurance', '07 08 90 96 10 / 01 43 18 28 41', 'C', '/images/20241219102742.jpg', '$2y$12$WStRyunBFbqZApFlYplCS.bexwx0p/I7BLF9Lu1CvJUNkDUpYXBBi', NULL, '66dd71849d8c4', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:28', '2024-12-19 10:27:42'),
(156, 'OUATTARA Gninwelé Laurette épouse SANDE', '848 565-A', '848565-A', 'lauretteouattar@yahoo.fr', NULL, NULL, NULL, NULL, 'Adjoint Administratif', NULL, 33, NULL, NULL, NULL, NULL, NULL, 1, 6, '2014-05-02', '36', '2014-05-02', '2022-10-11', 'Marié(e)', 2, '1982-01-27', 'F', 99, 'F', 'Caissière Spécialisée et Auxiliaire en Pharmacie', '07 48 06 04 80', 'C', '/images/20241219104109.jpg', '$2y$12$tUoV.bIvnnM9Ps12LifuTOkOa3APeKQ.EkgLKeveAIIIshs9R3zbO', NULL, '66dd7184d5d5f', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:29', '2024-12-19 11:12:23'),
(157, 'SANOGO Souleymane', '401 894-N', '401894-N', 'souleymansanogo@gmail.com', NULL, NULL, NULL, NULL, 'Responsable Cellule Assurances Vie', NULL, 33, NULL, NULL, NULL, NULL, NULL, 1, 6, '2021-02-01', '33', '2021-02-01', '2014-06-10', 'Célibataire', 2, '1982-02-15', 'F', 120, 'M', 'DEUG 2  Physique- Chimie', '07 59 18 06 18', 'C', '/images/20241219105100.jpg', '$2y$12$h3vQhpOtAK85dOY4ZJr2Hug/0KydMqLqtLMyouZvRgcDqZBeaHKmi', NULL, '66dd71851ac5e', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:29', '2024-12-19 10:51:00'),
(158, 'SEOUE Marie-Josée Seoué', '252 820-G', '252820-G', 'mseoue@yahoo.fr', NULL, NULL, NULL, NULL, 'Médecin Pédiatre', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2023-01-12', '30', '2022-12-15', '2003-09-12', 'Célibataire', 0, '1971-08-27', 'F', 85, 'F', 'Doctorat d\'Etat en Médecine', '05 06 00 48 42 / 07 47 47 62 73', 'C', '/images/20241219110226.jpg', '$2y$12$vJQhcsfW4628IYELShjxyua/slmvDqJWCI.a19FkqusK9SmETYJLS', NULL, '66dd718553548', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:29', '2024-12-19 11:02:26'),
(159, 'SERI Jérôme', '08614-P', '08614-P', NULL, NULL, NULL, NULL, NULL, 'Agent de bureau', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2014-05-02', '32', '2014-05-02', NULL, 'Marié(e)', 4, '1974-11-20', 'P', 85, 'M', 'BEPC', '01 01 73 75 36', 'C', '/images/20241219110957.jpg', '$2y$12$eNmFo/SyMIaVbnrAG.abQe/ZSlttvVUp4DPi2hQel23Il1vvEEvn6', '174011033078', '66dd71858b9a6', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:29', '2024-12-19 11:09:57'),
(160, 'SERY Bi Bali', '240 103-N', '240103-N', 'serybibaliphilip@gmail.com', NULL, NULL, NULL, NULL, 'Ingénieur des Techniques Sanitaires', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2024-04-08', '33', '2024-03-05', '1992-02-17', 'Marié(e)', 5, '1965-01-09', 'F', 102, 'M', 'Diplôme d\' Ingénieur de Services de Santé Option: Biologie Médicale', '07 07 80 48 24 / 01 02 36 35 58', 'C', '/images/20241219112702.jpg', '$2y$12$j83aCjeILbe5OSMiWJFy7ecszq4tJ3Y/fCQUQYTU3chI1kl3phxyW', NULL, '66dd7185c3ec8', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:30', '2024-12-19 11:27:02'),
(161, 'SILUE Namogo', '421 288-Z', '421288-Z', 'n.silue@madgi.ci', NULL, NULL, NULL, NULL, 'Chef Service Comptabilité', NULL, 36, NULL, NULL, NULL, NULL, NULL, 1, 1, '2014-08-22', '1', '2009-04-16', '2016-01-13', 'Marié(e)', 3, '1978-01-01', 'F', 115, 'M', 'Diplôme d\' Etudes Sup de Comptabilité et de Gestion Financière', '01 40 49 96 15 / 05 06 10 57 43', 'C', '/images/20241219115950.jpg', '$2y$12$ZIhtkTddwsvQ03.aVmKcLOIKX/s59VUurO6HNPm//yNaVEVCbswUq', NULL, '66dd71860985d', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 5, '2024-09-08 09:42:30', '2024-12-19 11:59:50'),
(162, 'SINDIO Kouamé Souroubi Jean Paul', '304 839-C', '304839-C', 'jeanpauldesindio@yahoo.fr', NULL, NULL, NULL, NULL, 'Technicien Supérieur de Laboratoire', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2019-02-26', '29', '2019-02-26', '2004-11-03', 'Marié(e)', 3, '1976-07-28', 'F', 85, 'M', 'Diplôme de Tehnicien Sup de la Santé', '05 05 72 75 73 / 01 01 93 60 46', 'C', '/images/20241219121130.jpg', '$2y$12$mU33l.skU/uz.E0yahn3uOdYboYwEKsO1qRtmPEr348j8YwbW3dk.', NULL, '66dd7186417cd', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:30', '2024-12-19 12:11:30'),
(163, 'AYEDZEU Apo Juliette épouse SOHOUA', '297 129 V', '297 129V', NULL, NULL, NULL, NULL, NULL, 'Aide-soignante', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2015-01-05', '36', '2014-12-30', '2003-08-12', 'Veu.f(ve)', 3, '1977-06-10', 'F', 85, 'F', 'Dipôme d\'Etat d\'Aide-soignante', '07 07 95 02 82', 'C', '/images/20241219121742.jpg', '$2y$12$u4u4TQw.z5xp.4OSHhsjCeoULL9idyFmmzSHs2QgfiNs60Bll8ONC', NULL, '66dd718679cb9', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:30', '2024-12-19 12:17:42'),
(164, 'SOKOLO Ekoa Huguette', '236 184 P', '236 184P', 'sokolohug2@gmail.com', NULL, NULL, NULL, NULL, 'Responsable Cellule Médicale', NULL, 33, NULL, NULL, NULL, NULL, NULL, 1, 6, '2019-02-26', '40', '2019-02-26', '1997-08-11', 'Célibataire', 1, '1968-05-09', 'F', 99, 'F', 'Doctorat en medecine', '07 07 81 93 98 / 01 01 80 14 09', 'C', '/images/20241219122757.jpg', '$2y$12$cnGFqUFlctUuUMKW1xHgMOkiyamAFeXUJb7kqNQOoqRJk1IoEfQj2', NULL, '66dd7186b22bd', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:30', '2024-12-19 12:27:57'),
(165, 'SORO Mamadou', '848 099-B', '848099-B', 'msoro10@gmail.com', NULL, NULL, NULL, NULL, 'Responsable Cellule Comptabilité HMI-KF', NULL, 36, NULL, NULL, NULL, NULL, NULL, 1, 1, '2014-05-12', '29', '2014-05-12', '2022-10-11', 'Marié(e)', 1, '1981-07-04', 'F', 115, 'M', 'BTS Finances Comptabilité', '07 09 08 03 14', 'M', '/images/20241219123755.jpg', '$2y$12$F/9n4SGdQgLUMx7N14IMduX3v92PHuJIrtFGxaDvullWOzmLQSzt6', NULL, '66dd7186eb441', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:31', '2024-12-19 12:37:55'),
(166, 'SORO Tiérégnimin', '848 676-R', '848676-R', 'gnimin_soro@hotmail.fr', NULL, NULL, NULL, NULL, 'Responsable Cellule Gestion de la Sécurité du Système d\'Information', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2016-06-01', '1', '2016-06-01', '2022-10-10', 'Marié(e)', 2, '1983-02-18', 'F', 3, 'M', 'Licence Prof.Technologie', '07 07 74 29 66 / 05 06 55 50 50', 'M', '/images/20241219124330.jpg', '$2y$12$KUmjJ6CJHB7TX4TwjxBzPujQCbH9OREo.eaPcSUbZsUWZOSKOrewG', NULL, '66dd71872f25a', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:31', '2024-12-19 12:43:30'),
(167, 'SOULAMA Madjaba Marthe', '14518-P', '14518-P', 'soulamarthe@yahoo.fr', NULL, NULL, NULL, NULL, 'Assistante Pharmacie', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2018-04-01', '32', '2018-04-01', NULL, 'Célibataire', 1, '1981-07-29', 'P', 90, 'F', 'CAP Auxilliaire pharmacie', '07 07 10 13 00 / 01 02 65 37 22', 'C', '/images/20241219124729.jpg', '$2y$12$A3ab3ZJsstW9koh.31SN2.6IXowgZGzIwMGzAL91C7sIBN8iAPOD.', '281011832292', '66dd718767863', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:31', '2024-12-19 12:47:30'),
(168, 'TRAORE Aminata épouse SOUMAHORO', '327 571-V', '327571-V', 'soumamy10@gmail.com', NULL, NULL, NULL, NULL, 'Chef  de  Service Administratif', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2013-01-21', '1', '2013-01-15', '2007-04-04', 'Marié(e)', 2, '1971-06-11', 'F', 88, 'F', 'Diplôme d\' Etat d\'Education Spécialisé', '05 05 05 60 99 / 07 48 43 61 69', 'C', '/images/20241219125835.jpg', '$2y$12$YL.xi64N4tpG9RxZH2LGWOkO4l2bFl0sbPgcV1NXJEABP9p.wIK2.', NULL, '66dd7187a2360', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 5, '2024-09-08 09:42:31', '2024-12-19 12:58:35'),
(169, 'SYLLA Fanta', '848 101-A', '848101-A', 'antafatimas@gmail.com', NULL, NULL, NULL, NULL, 'Responsable Cellule Gestion de la Trésorerie', NULL, 36, NULL, NULL, NULL, NULL, NULL, 1, 1, '2016-06-01', '33', '2016-06-01', '2022-10-11', 'Célibataire', 0, '1981-05-26', 'F', 108, 'F', 'Ingénieur des Techniques  option: Audit et Contrôle de Gestion', '07 49 70 67 86 / 01 02 26 12 03', 'M', '/images/20241219134748.jpg', '$2y$12$aR.bTUi85lnX1YewyyBlSu9h1.cI91TW.o9r6o1Cpm7WuML6tgK6C', NULL, '66dd7187dd595', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:32', '2024-12-19 13:47:48'),
(170, 'GNAMIEN Ahou Anne-Marie épouse TANDOH', '05307-P', '05307-P', 'tandanne@yahoo.fr', NULL, NULL, NULL, NULL, 'Responsable Cellule Sociale', NULL, 33, NULL, NULL, NULL, NULL, NULL, 1, 6, '2015-09-01', '32', '2007-03-29', NULL, 'Marié(e)', 4, '1966-07-26', 'P', 93, 'F', 'Niveau Terminale', '07 07 68 16 04 / 01 02 51 59 15', 'C', '/images/20241219135730.jpg', '$2y$12$FSB2G4oLH5IkhSlQyMqwPOKVqhX9svEl9wcJf1qRKUhqCpWYyQlk6', '266011041107', '66dd718824815', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:32', '2024-12-19 14:02:18'),
(171, 'TANO Kouakou', '252 837 V', '252837V', 'tanokouakou4@gmail.com', NULL, NULL, NULL, NULL, 'Chef d\'Unité Pédiatrie', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2022-08-09', '1', '2010-02-10', '2004-10-20', 'Marié(e)', 4, '1969-03-05', 'F', 85, 'M', 'Certificat d\'Etude Spécialisé en Pédiatrie', '07 09 89 55 54 / 01 01 50 62 61', 'C', '/images/20241219150027.jpg', '$2y$12$e3ZdDgC.Hx6pATczGnPZbeZ/VfYXUZObX48onK87XjDFHZj46N7aC', NULL, '66dd71885f7be', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 6, '2024-09-08 09:42:32', '2024-12-19 15:00:27'),
(172, 'TANO N’GUESSAN Brou Ferdinand', '10915-P', '10915-P', 'f.tano@madgi.ci', NULL, NULL, NULL, NULL, 'Chef Service Audit et Contrôle de Gestion', NULL, 30, NULL, NULL, NULL, NULL, NULL, 0, 1, '2015-05-22', '31', '2015-05-22', NULL, 'Marié(e)', 2, '1987-05-30', 'P', 121, 'M', 'Ingenieur de Conception en Comptabilité', '07 48 07 64 25 / 01 01 67 28 29', 'C', '/images/20241219150800.jpg', '$2y$12$u7f4c4wzdhssPWqHUNNs1.tfRfwSSf5RVOWX.3gP7Mq4wBYq49Zta', '187011463692', '66dd71889a80f', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, 5, '2024-09-08 09:42:32', '2024-12-19 15:10:52'),
(173, 'TANOH N’Guessan Richard', '12516-P', '12516-P', NULL, NULL, NULL, NULL, NULL, 'Electricien-Plombier', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2016-06-01', '32', '2016-06-01', NULL, 'Célibataire', 1, '1981-12-27', 'P', 89, 'M', 'Niveau CM2', '07 07 42 32 57 / 05 56 69 90 80', 'C', '/images/20241219151459.jpg', '$2y$12$Z/b/1PTYfQD72Y1bzgwfsuqzxJGeDsd7cy8lDMsaUO602r3fQErPe', '181011717094', '66dd7188d5359', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:33', '2024-12-19 15:14:59');
INSERT INTO `users` (`id`, `nom`, `matricule`, `mat_without_space`, `email`, `specialite`, `situation_convention`, `Date_validation`, `date_signature`, `fonction`, `type_stage`, `departement`, `situation_stage`, `date_validations`, `reconduction`, `categorie`, `etat`, `statut`, `site`, `date_occupation_p`, `grade`, `date_entre_mad`, `date_fonction`, `situation_matrim`, `nombre_enfant`, `date_naissance`, `statut_mad`, `service`, `genre`, `diplome`, `tel`, `confession_relg`, `photo`, `password`, `cnps`, `slug`, `type`, `start_date`, `end_date`, `date_debut_mise_disponibilite`, `date_fin_mise_disponibilite`, `lock_nb`, `lock_date`, `is_salarie`, `is_register`, `is_medical`, `type_device`, `unique_web_identifier`, `activity_id`, `created_at`, `updated_at`) VALUES
(174, 'THE-BOUE Marlène Natacha Prudence épouse TRAORE', '455 440-F', '455440-F', 'bouemarlene@gmail.com', NULL, NULL, NULL, NULL, 'Sage-femme', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2023-01-12', '29', '2022-12-15', '2018-02-08', 'Marié(e)', 3, '1988-05-16', 'F', 85, 'F', 'Diplôme d\'Etat de Sage-femme', '07 08 72 12 35', 'C', '/images/20241219152412.jpg', '$2y$12$7T4Sec4jExU/VQyh.9hHPeY5QVHohh73XPL.8WMsQjG1kH.I6S8Pe', NULL, '66dd71891bffe', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:33', '2024-12-19 15:24:12'),
(175, 'TRAORE Aminata épouse TIA', '02105-P', '02105-P', 'aminatatia@gmail.com', NULL, NULL, NULL, NULL, 'Responsable Cellule Caisse', NULL, 36, NULL, NULL, NULL, NULL, NULL, 1, 6, '2005-10-24', '28', '2005-10-24', NULL, 'Marié(e)', 3, '1975-01-07', 'P', 108, 'F', 'BT Comptabilité', '01 03 32 58 92', 'C', '/images/20241219153008.jpg', '$2y$12$cKoqrjL7fnJg87zJ/89NteDj8jDbPNBdVw3kSP50hE9HIKt4F4HJO', '275010117799', '66dd7189561c1', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:33', '2024-12-19 15:47:49'),
(176, 'YOUKOU Mélanie épouse TIA', '252 887-Y', '252 887-Y', 'youkoutia.melanie@yahoo.fr', NULL, NULL, NULL, NULL, 'Chef  Sous Département Médical', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2005-05-06', '1', '2005-05-06', '2002-01-09', 'Marié(e)', 3, '1970-01-07', 'F', 122, 'F', 'Doctorat en medecin', '01 40 49 96 56', 'C', '/images/20241219153420.jpg', '$2y$12$Gcf3akcFdnsN3ra5BXE8jO5OOwhyjSBiV0zGNVNVwUae6EMMJDq3i', NULL, '66dd71898fe7d', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 8, '2024-09-08 09:42:33', '2024-12-19 15:34:20'),
(177, 'TIA Zoh Rodrigue', '09314-P', '09314-P', 'zohrodrigue@gmail.com', NULL, NULL, NULL, NULL, 'Responsable Cellule Technique', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2014-08-25', '28', '2014-08-25', NULL, 'Marié(e)', 2, '1982-06-27', 'P', 107, 'M', 'DESS Evaluation des Projets', '07 49 01 41 83 / 01 03 21 41 58', 'C', '/images/20241219154019.jpg', '$2y$12$dEPKPTZe8X2zlX8vCb2dE.sbNemV.soXjjX0aoYtxRkrlnwzqxEeq', '182011565170', '66dd7189ca83e', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:34', '2024-12-19 15:40:19'),
(178, 'TRAORE Mamadou', '01605-P', '01605-P', NULL, NULL, NULL, NULL, NULL, 'Agent de bureau', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2017-06-06', '32', '2005-09-20', NULL, 'Célibataire', 6, '1969-06-24', 'P', 87, 'M', 'Niveau CM2', '07 59 99 93 56 / 01 01 28 83 79', 'M', '/images/20241219154640.jpg', '$2y$12$bOYdOVdgKa8/4ZzFpm/4EOcV14lRnUkTBimZTGJGKLG/m.zxGv6a.', '169010926893', '66dd718a11967', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:34', '2024-12-19 15:46:40'),
(179, 'TUO Sénakouho Amélie', '15618-P', '15618-P', NULL, NULL, NULL, NULL, NULL, 'Assistante en Ophtalmologie', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2018-05-01', '32', '2018-05-01', NULL, 'Célibataire', 0, '1985-02-17', 'P', 85, 'F', 'C A P Sanitaire', '05 06 41 86 06 / 01 01 17 67 45', 'C', '/images/20241219155833.jpg', '$2y$12$jnhwu0uaF3eByzwGB6QvZuelFqzmw2ln6dEEQrjJ200erAEACh252', '285011850598', '66dd718a4aa60', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:34', '2024-12-19 15:58:33'),
(180, 'YAO Alfred', '438 911-J', '438911-J', 'yaoalfred1982@gmail.com', NULL, NULL, NULL, NULL, 'Infirmier Diplômé d’Etat', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2017-04-18', '29', '2017-04-14', '2016-04-02', 'Célibataire', 2, '1982-09-18', 'F', 85, 'M', 'Diplôme d\'Etat d\'infirmier', '01 02 54 37 25 / 07 57 41 40 33 / 01 01 51 20 94', 'C', '/images/20241219161159.jpg', '$2y$12$q.VXdZCFF39u2oL7KSd0oeRNLWtlxrW.AARjR42eMjZoU0UhvsvbW', NULL, '66dd718a82fef', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:34', '2024-12-19 16:11:59'),
(181, 'YAO Kouadjo Samption', '11015-P', '11015-P', 'kouadjoba@yahoo.fr', NULL, NULL, NULL, NULL, 'Conseiller Clientèle CEC-MADGI', NULL, 37, NULL, NULL, NULL, NULL, NULL, 1, 1, '2017-01-25', '28', '2015-09-03', NULL, 'Marié(e)', 3, '1975-09-02', 'P', 125, 'M', 'BTS Gestion commerciale', '07 07 07 82 84 / 05 05 06 76 86', 'C', '/images/20241220124148.jpg', '$2y$12$LpNrE/6BnriJXtQAzBhAp.Oev5Ks..9puGiX6MrXk1GXJlNemJ9Am', '175011370360', '66dd718abadc2', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:34', '2024-12-20 12:58:45'),
(182, 'N\'Guessan Amoin Bertine épouse YAO', '338 257-M', '338257-M', 'nguesbert@gmail.com', NULL, NULL, NULL, NULL, 'Caissière', NULL, 36, NULL, NULL, NULL, NULL, NULL, 1, 6, '2021-02-01', '36', '2021-02-10', '2008-06-02', 'Veu.f(ve)', 4, '1978-01-15', 'F', 108, 'F', 'CEPE', '07 67 64 29 33 / 01 02 91 77 58', 'C', '/images/20241220125254.jpeg', '$2y$12$E0rkZDKcmBYIxCnNQYUxe.r4f9T5AgRVSnZEOea4qn.jvDVzakBHm', NULL, '66dd718af3b1b', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:35', '2024-12-20 12:52:54'),
(183, 'YAPO Atsé Eugène', '05507-P', '05507-P', NULL, NULL, NULL, NULL, NULL, 'Chauffeur', NULL, 31, NULL, NULL, NULL, NULL, NULL, 1, 1, '2007-04-17', '32', '2007-04-17', NULL, 'Célibataire', 3, '1965-04-25', 'P', 96, 'M', 'CEPE', '05 05 66 31 81 /01 03 39 98 52', 'C', '/images/20241220125717.jpg', '$2y$12$e40gMLKmZT2W3TyNFMzupOLUtOX1GcGXnfDFmTqFmfKkJxPLF0oJe', '165010613120', '66dd718b384c3', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:35', '2024-12-20 12:57:18'),
(184, 'YAPO Brigitte  Danielle', '286 435-M', '286 435-M', 'yapobdanielle@gmail.com', NULL, NULL, NULL, NULL, 'Chef Unité Surveillance  Générale', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2014-08-22', '1', '2011-10-25', '2001-11-13', 'Célibataire', 1, '1976-07-29', 'F', 85, 'F', 'Diplôme d\' Inspecteur des soins infirmiers', '01 02 26 87 45 / 07 49 51 52 59', 'C', '/images/20241220133657.jpg', '$2y$12$dL45S5VIWnRM6Y4X10nHcOD53gpUueX2jsqdfdfRswClHaE6pefom', NULL, '66dd718b7085e', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 6, '2024-09-08 09:42:35', '2024-12-20 13:36:57'),
(185, 'YEBARTH Marie Laure Touloh', '13116-P', '13116-P', 'marielaureyebarth@yahoo.fr', NULL, NULL, NULL, NULL, 'Responsable Cellule Commerciale et Marketing', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2016-11-02', '28', '2016-11-02', NULL, 'Célibataire', 0, '1984-07-16', 'P', 107, 'F', 'Ingenieur Commercial', '07 07 28 77 33 / 01 02 85 86 85', 'C', '/images/20241220134448.jpg', '$2y$12$A3gbf5mSzYwxInEMuWC0re2m5b5Xnew.MAlVdhXvcAo8rlc1vSai.', '284011717133', '66dd718ba91e1', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:35', '2024-12-20 13:44:48'),
(186, 'YEO Yédjoufougo', '848 642-P', '848642-P', 'yeflorence@yahoo.fr', NULL, NULL, NULL, NULL, 'Comptable CEC-MADGI', NULL, 37, NULL, NULL, NULL, NULL, NULL, 1, 1, '2016-06-01', '33', '2016-06-01', '2022-10-11', 'Célibataire', 0, '1988-12-25', 'F', 124, 'F', 'BTS Finances Comptabilité', '07 08 73 26 99 / 05 55 59 08 99', 'C', '/images/20241220135120.jpg', '$2y$12$umZEirKSAOyplx21TzUSre.j3aBFje1T9guxXI0Asd.z7RS.4IfDO', NULL, '66dd718be4196', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:36', '2024-12-20 13:51:20'),
(187, 'ZEREGBE Yokolé', '286 581-Q', '286581-Q', 'zeregbealexis@yahoo.fr', NULL, NULL, NULL, NULL, 'Ingénieur des Techniques Sanitaires', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2019-02-26', '33', '2019-02-26', '2001-11-26', 'Marié(e)', 3, '1977-01-01', 'F', 102, 'M', 'Diplôme d\'Ing des tech. Sanitaire option: imagerie médicale', '01 40 09 77 51 /  07 57 51 68 58', 'C', '/images/20241220140828.jpg', '$2y$12$uBiPvnwlRsXAGMSbmO9.Q.b4ToE8tqwl7.du8QqpzW7QjsXbcI8NC', NULL, '66dd718c27ef4', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2024-09-08 09:42:36', '2024-12-20 14:08:28'),
(188, 'ZIGUI Marc Auguste', '305 848-N', '305848-N', 'm.zigui@madgi.ci', NULL, NULL, NULL, NULL, 'Chef Sous Département Administration Hospitaliere', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2020-09-17', '40', '2019-02-26', '2006-12-08', 'Marié(e)', 3, '1971-05-06', 'F', 123, 'M', 'Cycle Sup ENA', '07 07 37 84 45', 'C', '/images/20241220141534.jpg', '$2y$12$AfiU.LHHtzzWsvzRExCXeeb.xZQ9EK5AD3DHjnlhG7gHTRSVyS6Ki', NULL, '66dd718c60cc3', 1, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, 8, '2024-09-08 09:42:36', '2025-03-05 13:57:05'),
(201, 'Admin Tablette', 'ADMIN', 'ADMIN', 'admin@gmail.com', NULL, NULL, NULL, NULL, 'ADMIN', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2004-06-01', '28', '2004-06-01', NULL, 'Marié(e)', 4, '1973-03-07', 'P', 1, 'M', 'Master professionnel Gestion des Ressources Humaines', '01 01 37 02 37 / 07 49 49 88 11', 'C', '/images/20241008120519.jpg', '$2y$12$afnZjcAKjA/x/ReYL9bdSOwgETmZ9LFeA0RVAj.6/dbca58AS7Q/a', '173010427486', '66dd7160cb586', 0, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 'TP1A.221005.003.OC101.unknown.OC101', '20872610-5180-4090-a26c-98d5f84e242d', NULL, '2024-09-08 09:41:53', '2024-11-08 06:45:23'),
(202, 'NIAKOUA GNALY JACOB FLORENTIN', NULL, NULL, NULL, 'Informatique', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/images/20241122103420.jpg', NULL, NULL, NULL, NULL, '2024-10-01 00:00:00', '2024-11-22 00:00:00', NULL, NULL, 0, NULL, 4, 0, 0, NULL, NULL, NULL, '2024-11-22 10:34:20', '2024-11-22 10:35:51'),
(206, 'DIABI Matindjé', '08214-P', '08214-P', 'matymomo89@yahoo.fr', NULL, NULL, NULL, NULL, 'Agent d\' Accueil', NULL, 32, NULL, NULL, NULL, NULL, NULL, 0, 6, '2014-05-02', '32', '2014-05-02', NULL, 'Célibataire', 1, '1991-03-08', NULL, 88, NULL, 'Aviation et tourisme (IATA)', '07 78 18 73 66 / 07 09 00 25 60', 'M', '/images/20241226155217.jpg', NULL, '291011565275', NULL, NULL, NULL, NULL, '2018-05-01', NULL, 0, NULL, 5, 0, 0, NULL, NULL, NULL, '2024-12-26 15:52:17', '2024-12-26 16:15:12'),
(207, 'DJAKO Akossi Kouassibié Katoume', '345 452-G', '345452-G', 'katoumelivia12@gmail.com', NULL, NULL, NULL, NULL, 'Aide- soignante', NULL, 32, NULL, NULL, NULL, NULL, NULL, 0, 6, '2015-01-05', '36', '2015-01-05', '2008-12-29', 'Célibataire', 1, '1986-12-30', NULL, 110, NULL, 'Attestation de réussite au Diplôme d\' Aide-Soignante', '07 08 01 92 69', 'C', '/images/20241226161037.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-01', NULL, 0, NULL, 5, 0, 0, NULL, NULL, NULL, '2024-12-26 16:10:37', '2024-12-26 16:14:11'),
(208, 'TAZERE Medebré Emmanuelle Josline épouse EPROMON', '04807-P', '04807-P', 'manutag2009@yahoo.fr', NULL, NULL, NULL, NULL, 'Assistant comptable', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2007-02-05', '32', '2007-02-05', NULL, 'Marié(e)', 1, '1975-12-30', NULL, 88, NULL, 'BTS Finance Comptabilité et Gestion d\' Entreprise', '01 01 86 18 53 / 05 05 95 49 78', 'C', '/images/20241226162619.jpg', NULL, '275010927333', NULL, NULL, NULL, NULL, '2023-11-22', NULL, 0, NULL, 5, 0, 0, NULL, NULL, NULL, '2024-12-26 16:26:19', '2025-03-12 18:19:41'),
(209, 'KONAN Aya Marthe N’Goran épouse GNAZOU', '270 270-E', '270270-E', 'marthegnazou@gmail.com', NULL, NULL, NULL, NULL, 'Aide-soignante', NULL, 32, NULL, NULL, NULL, NULL, NULL, 1, 6, '2006-11-09', '36', '2006-11-09', '1998-08-06', 'Marié(e)', 3, '1972-07-28', NULL, 110, NULL, 'Diplôme d\' Aide-soignante', '01  02 57 45 06 / 07 07 90 52 86', 'C', '/images/20241227084631.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-01', NULL, 0, NULL, 5, 0, 0, NULL, NULL, NULL, '2024-12-27 08:46:31', '2025-03-12 18:19:30'),
(210, 'KOFFI Assamoi Aya Inès épouse KOUASSI', '11716-P', '11716-P', 'king-alex@yahoo.fr', NULL, NULL, NULL, NULL, 'Conseiller clientèle', NULL, 37, NULL, NULL, NULL, NULL, NULL, 1, 1, '2016-06-01', '28', '2016-06-01', NULL, 'Marié(e)', 2, '1978-09-08', NULL, 125, NULL, 'Maitrise en Droit Carrière Entreprise', '07 58 04 45 67 / 01 41 34 73 24', 'C', '/images/20241227090740.jpg', NULL, '278011717041', NULL, NULL, NULL, NULL, '2023-08-28', NULL, 0, NULL, 5, 0, 0, NULL, NULL, NULL, '2024-12-27 09:07:40', '2025-03-12 18:19:17'),
(211, 'ACOUPO  Michelle Esther épouse SAHA', '304 721-D', '304721-D', 'acoupo@outlook.fr', NULL, NULL, NULL, NULL, 'Chirurgien - Dentiste', NULL, 3, NULL, NULL, NULL, NULL, NULL, 1, 6, '2025-01-06', '30', '2024-11-23', '2004-11-02', 'Marié(e)', 2, '1973-11-28', NULL, 85, 'F', 'Diplôme d\' Etat de Docteur en chirurgie dentaire', '07 07 68 09 50 / 05 74 07 01 14', 'C', '/images/20250127123240.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, NULL, NULL, NULL, '2025-01-27 12:32:40', '2025-01-27 12:33:22'),
(212, 'ABOUA Awo Fabrice Aristide', '20025-P', '20025-P', 'abouafabrice13@gmail.com', NULL, NULL, NULL, NULL, 'Aide-archiviste', NULL, 30, NULL, NULL, NULL, NULL, NULL, 1, 1, '2025-01-02', '32', '2023-05-02', NULL, 'Célibataire', 1, '1987-02-22', NULL, 1, 'M', 'BEPC', '01 42 07 51 65 / 07 16 88 80 39', 'C', '/images/20250219103523.jpg', NULL, '202300070768', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2025-02-19 10:35:23', '2025-02-19 11:47:03'),
(213, 'DALLE Noël Olivier', '20125-P', '20125-P', 'dallenoelolivier@gmail.com', NULL, NULL, NULL, NULL, 'Chauffeur', NULL, 31, NULL, NULL, NULL, NULL, NULL, 1, 1, '2025-01-02', '32', '2024-03-25', NULL, 'Célibataire', 0, '1985-01-13', NULL, 96, 'M', 'BACCALAUREAT  D', '07 87 06 22 00 / 05 55 11 30 92', 'C', '/images/20250219114002.jpg', NULL, '202400044352', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 0, NULL, NULL, NULL, '2025-02-19 11:40:02', '2025-02-19 11:40:02');

-- --------------------------------------------------------

--
-- Structure de la table `user_info`
--

CREATE TABLE `user_info` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `info_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user_info`
--

INSERT INTO `user_info` (`id`, `user_id`, `info_id`, `created_at`, `updated_at`) VALUES
(1, 1, 7, '2025-03-12 17:47:53', '2025-03-12 17:47:53'),
(2, 1, 11, '2025-03-12 18:02:13', '2025-03-12 18:02:13'),
(3, 11, 11, '2025-03-13 11:37:23', '2025-03-13 11:37:23'),
(4, 11, 7, '2025-03-13 11:37:26', '2025-03-13 11:37:26'),
(5, 11, 9, '2025-03-13 11:37:32', '2025-03-13 11:37:32'),
(6, 11, 12, '2025-03-13 11:38:42', '2025-03-13 11:38:42');

-- --------------------------------------------------------

--
-- Structure de la table `user_leaves`
--

CREATE TABLE `user_leaves` (
  `id` int UNSIGNED NOT NULL,
  `year` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nb_use` int NOT NULL DEFAULT '0',
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user_leaves`
--

INSERT INTO `user_leaves` (`id`, `year`, `value`, `nb_use`, `user_id`, `created_at`, `updated_at`) VALUES
(2, '2023', '30', 0, 2, '2024-12-07 20:42:39', '2025-01-07 10:58:16'),
(3, '2022', '2', 0, 2, '2024-12-09 10:02:40', '2024-12-30 10:48:58'),
(4, '2021', '30', 0, 15, '2024-12-09 10:18:33', '2024-12-09 10:27:34'),
(5, '2020', '30', 0, 15, '2024-12-09 10:27:19', '2024-12-09 10:27:19'),
(9, '2023', '35', 40, 1, '2024-12-09 11:21:32', '2025-03-17 09:07:35'),
(10, '2023', '30', 0, 4, '2024-12-09 11:22:23', '2025-01-07 10:57:31'),
(11, '2022', '15', 0, 6, '2024-12-09 11:23:35', '2024-12-09 11:23:35'),
(12, '2023', '35', 0, 6, '2024-12-09 11:23:52', '2025-01-07 11:34:37'),
(13, '2023', '30', 0, 7, '2024-12-09 11:25:29', '2024-12-09 11:25:29'),
(14, '2023', '32', 0, 8, '2024-12-09 11:26:21', '2025-01-07 10:59:21'),
(15, '2023', '33', 0, 9, '2024-12-09 11:27:39', '2025-01-07 11:00:07'),
(16, '2023', '30', 0, 11, '2024-12-09 11:28:43', '2025-01-07 11:05:51'),
(17, '2021', '30', 0, 12, '2024-12-09 11:29:45', '2024-12-09 11:29:45'),
(18, '2022', '30', 0, 12, '2024-12-09 11:29:57', '2024-12-09 11:29:57'),
(19, '2023', '30', 0, 12, '2024-12-09 11:30:10', '2024-12-09 11:30:10'),
(20, '2023', '31', 0, 13, '2024-12-09 11:31:25', '2025-01-07 12:09:31'),
(21, '2023', '30', 0, 14, '2024-12-09 11:33:14', '2025-01-07 11:07:28'),
(22, '2022', '30', 0, 15, '2024-12-09 11:38:03', '2024-12-09 11:38:03'),
(23, '2023', '30', 0, 15, '2024-12-09 11:38:18', '2024-12-09 11:38:18'),
(24, '2023', '32', 0, 16, '2024-12-09 11:42:21', '2025-01-07 11:15:25'),
(25, '2023', '30', 0, 18, '2024-12-09 11:44:13', '2025-01-07 11:19:50'),
(26, '2022', '11', 0, 19, '2024-12-09 11:44:49', '2024-12-09 11:44:49'),
(27, '2023', '33', 0, 19, '2024-12-09 11:45:01', '2024-12-09 11:45:01'),
(28, '2023', '30', 0, 20, '2024-12-09 11:46:20', '2025-01-07 11:21:29'),
(29, '2021', '8', 0, 21, '2024-12-09 11:48:08', '2024-12-09 11:48:08'),
(30, '2022', '0', 0, 21, '2024-12-09 11:48:25', '2024-12-09 11:48:25'),
(31, '2023', '30', 0, 21, '2024-12-09 11:48:42', '2024-12-09 11:48:42'),
(32, '2023', '33', 0, 22, '2024-12-09 11:49:28', '2025-01-07 11:22:50'),
(33, '2023', '33', 0, 23, '2024-12-09 11:50:50', '2024-12-09 11:50:50'),
(34, '2023', '30', 12, 24, '2024-12-09 11:51:23', '2025-03-16 23:14:46'),
(35, '2023', '33', 0, 25, '2024-12-09 11:52:02', '2024-12-09 11:52:02'),
(36, '2023', '38', 0, 28, '2024-12-09 11:55:41', '2025-01-07 11:09:14'),
(37, '2023', '33', 0, 31, '2024-12-09 11:58:41', '2025-01-07 11:42:29'),
(38, '2023', '32', 0, 34, '2024-12-09 11:59:44', '2025-01-07 11:45:13'),
(39, '2023', '30', 0, 35, '2024-12-09 12:05:48', '2024-12-09 12:05:48'),
(40, '2023', '30', 0, 37, '2024-12-09 12:06:47', '2024-12-09 12:06:47'),
(41, '2022', '30', 0, 38, '2024-12-09 12:07:51', '2024-12-09 12:07:51'),
(42, '2023', '31', 0, 38, '2024-12-09 12:08:10', '2024-12-09 12:08:10'),
(43, '2023', '30', 0, 40, '2024-12-09 12:10:28', '2025-01-07 11:49:46'),
(44, '2023', '30', 0, 41, '2024-12-09 12:14:11', '2024-12-09 12:14:11'),
(45, '2023', '35', 0, 42, '2024-12-09 12:14:49', '2025-01-07 11:56:09'),
(46, '2023', '33', 0, 43, '2024-12-09 12:16:56', '2025-01-07 11:58:48'),
(47, '2019', '28', 0, 44, '2024-12-09 12:26:54', '2024-12-09 12:26:54'),
(48, '2020', '32', 0, 44, '2024-12-09 12:27:34', '2024-12-09 12:27:34'),
(49, '2021', '32', 0, 44, '2024-12-09 12:28:20', '2024-12-09 12:28:20'),
(50, '2022', '33', 0, 44, '2024-12-09 12:28:38', '2024-12-09 12:28:38'),
(51, '2023', '33', 0, 44, '2024-12-09 12:28:53', '2024-12-09 12:28:53'),
(52, '2020', '19', 0, 45, '2024-12-09 12:31:14', '2024-12-09 12:31:14'),
(53, '2021', '33', 0, 45, '2024-12-09 12:31:36', '2024-12-09 12:31:36'),
(54, '2022', '3', 0, 45, '2024-12-09 12:31:46', '2024-12-09 12:31:46'),
(55, '2023', '33', 0, 45, '2024-12-09 12:32:15', '2024-12-09 12:32:15'),
(56, '2021', '16', 0, 122, '2024-12-09 12:37:02', '2024-12-09 12:37:02'),
(57, '2023', '31', 0, 122, '2024-12-09 12:37:19', '2024-12-09 12:37:19'),
(58, '2022', '5', 0, 48, '2024-12-09 12:49:59', '2024-12-09 12:49:59'),
(59, '2023', '31', 0, 48, '2024-12-09 12:50:12', '2024-12-09 12:50:12'),
(60, '2023', '30', 0, 47, '2024-12-09 12:51:36', '2024-12-09 12:51:36'),
(61, '2023', '30', 0, 51, '2024-12-09 12:53:40', '2025-01-07 12:08:10'),
(62, '2023', '30', 0, 126, '2024-12-09 12:57:36', '2025-01-07 12:07:09'),
(63, '2023', '33', 0, 109, '2024-12-09 13:20:52', '2025-01-07 11:47:18'),
(64, '2023', '31', 0, 53, '2024-12-09 13:25:23', '2024-12-09 13:25:23'),
(65, '2023', '30', 0, 54, '2024-12-09 13:26:22', '2025-01-07 12:10:55'),
(66, '2022', '6', 0, 55, '2024-12-09 13:27:15', '2024-12-09 13:27:15'),
(67, '2023', '31', 0, 55, '2024-12-09 13:27:28', '2024-12-09 13:27:28'),
(68, '2023', '30', 0, 52, '2024-12-09 13:30:16', '2024-12-09 13:30:16'),
(69, '2022', '2', 0, 62, '2024-12-09 13:32:51', '2024-12-09 13:32:51'),
(70, '2023', '30', 0, 62, '2024-12-09 13:33:04', '2024-12-09 13:33:04'),
(71, '2023', '30', 0, 63, '2024-12-09 13:33:54', '2024-12-09 13:33:54'),
(72, '2022', '28', 0, 67, '2024-12-09 13:35:59', '2024-12-09 13:35:59'),
(73, '2023', '30', 0, 67, '2024-12-09 13:36:13', '2024-12-09 13:36:13'),
(74, '2023', '30', 0, 68, '2024-12-09 13:37:15', '2025-01-07 12:22:58'),
(75, '2023', '30', 0, 71, '2024-12-09 13:38:27', '2024-12-09 13:38:27'),
(76, '2023', '30', 0, 72, '2024-12-09 13:39:01', '2024-12-09 13:39:01'),
(77, '2018', '26', 0, 73, '2024-12-09 13:40:53', '2024-12-09 13:40:53'),
(78, '2019', '30', 0, 73, '2024-12-09 13:41:09', '2024-12-09 13:41:09'),
(79, '2020', '30', 0, 73, '2024-12-09 13:41:30', '2024-12-09 13:41:30'),
(80, '2021', '30', 0, 73, '2024-12-09 13:41:46', '2024-12-09 13:41:46'),
(81, '2022', '30', 0, 73, '2024-12-09 13:46:08', '2024-12-09 13:46:08'),
(82, '2023', '30', 0, 73, '2024-12-09 13:46:37', '2024-12-09 13:46:37'),
(83, '2023', '30', 0, 75, '2024-12-09 13:48:04', '2024-12-09 13:48:04'),
(84, '2023', '35', 0, 76, '2024-12-09 13:50:05', '2025-01-07 12:29:24'),
(85, '2022', '26', 0, 77, '2024-12-09 13:52:06', '2025-01-07 12:32:02'),
(86, '2023', '30', 0, 74, '2024-12-09 13:53:26', '2024-12-09 13:53:26'),
(87, '2021', '1', 0, 78, '2024-12-09 13:56:10', '2024-12-09 13:56:10'),
(88, '2022', '32', 0, 78, '2024-12-09 13:56:23', '2024-12-09 13:56:23'),
(89, '2023', '30', 0, 79, '2024-12-09 13:57:47', '2024-12-09 13:57:47'),
(90, '2023', '30', 0, 80, '2024-12-09 13:58:29', '2024-12-09 13:58:29'),
(91, '2023', '30', 0, 82, '2024-12-09 14:00:15', '2024-12-09 14:00:15'),
(92, '2023', '33', 0, 84, '2024-12-09 14:02:53', '2025-01-07 12:46:24'),
(93, '2020', '29', 0, 83, '2024-12-09 14:04:49', '2024-12-09 14:04:49'),
(94, '2021', '31', 0, 83, '2024-12-09 14:05:25', '2024-12-09 14:05:25'),
(95, '2022', '31', 0, 83, '2024-12-09 14:05:40', '2024-12-09 14:05:40'),
(96, '2023', '33', 0, 83, '2024-12-09 14:05:53', '2024-12-09 14:05:53'),
(97, '2020', '30', 0, 85, '2024-12-09 14:07:06', '2024-12-09 14:07:06'),
(98, '2021', '30', 0, 85, '2024-12-09 14:07:17', '2024-12-09 14:07:17'),
(99, '2022', '30', 0, 85, '2024-12-09 14:07:28', '2024-12-09 14:07:28'),
(100, '2023', '30', 0, 85, '2024-12-09 14:07:43', '2024-12-09 14:07:43'),
(101, '2023', '30', 0, 87, '2024-12-09 14:09:08', '2024-12-09 14:09:08'),
(102, '2023', '32', 0, 88, '2024-12-09 14:10:07', '2025-01-07 12:51:12'),
(103, '2023', '33', 0, 90, '2024-12-09 14:11:45', '2024-12-09 14:11:45'),
(104, '2022', '4', 0, 92, '2024-12-09 14:14:51', '2024-12-09 14:14:51'),
(105, '2023', '30', 0, 92, '2024-12-09 14:15:12', '2024-12-09 14:15:12'),
(106, '2023', '30', 0, 94, '2024-12-09 14:17:02', '2025-01-07 12:56:25'),
(107, '2023', '30', 0, 96, '2024-12-09 14:25:42', '2024-12-09 14:25:42'),
(108, '2022', '25', 0, 98, '2024-12-09 14:26:31', '2024-12-09 14:26:31'),
(109, '2023', '30', 0, 98, '2024-12-09 14:26:43', '2024-12-09 14:26:43'),
(110, '2021', '30', 0, 99, '2024-12-09 14:27:48', '2024-12-09 14:27:48'),
(111, '2022', '30', 0, 99, '2024-12-09 14:28:03', '2024-12-09 14:28:03'),
(112, '2023', '30', 0, 99, '2024-12-09 14:28:15', '2024-12-09 14:28:15'),
(113, '2021', '30', 0, 102, '2024-12-09 14:29:31', '2024-12-09 14:29:31'),
(114, '2022', '30', 0, 102, '2024-12-09 14:29:45', '2024-12-09 14:29:45'),
(115, '2023', '30', 0, 102, '2024-12-09 14:30:03', '2024-12-09 14:30:03'),
(116, '2022', '30', 0, 103, '2024-12-09 14:32:12', '2024-12-09 14:32:12'),
(117, '2023', '30', 0, 103, '2024-12-09 14:32:25', '2024-12-09 14:32:25'),
(118, '2022', '9', 0, 105, '2024-12-09 14:34:00', '2024-12-09 14:34:00'),
(119, '2023', '31', 0, 105, '2024-12-09 14:34:14', '2024-12-09 14:34:14'),
(120, '2022', '20', 0, 106, '2024-12-09 14:35:14', '2024-12-09 14:35:14'),
(121, '2023', '30', 0, 106, '2024-12-09 14:35:27', '2024-12-09 14:35:27'),
(122, '2023', '30', 0, 107, '2024-12-09 14:37:07', '2024-12-09 14:37:07'),
(123, '2023', '30', 0, 120, '2024-12-09 14:41:25', '2025-01-07 13:09:22'),
(124, '2022', '13', 0, 113, '2024-12-09 14:44:12', '2024-12-09 14:44:12'),
(125, '2023', '30', 0, 113, '2024-12-09 14:44:28', '2025-01-07 13:32:31'),
(126, '2023', '30', 0, 115, '2024-12-09 14:48:08', '2024-12-09 14:48:08'),
(127, '2023', '33', 0, 118, '2024-12-09 14:52:31', '2025-01-07 14:16:32'),
(128, '2023', '33', 0, 124, '2024-12-09 14:55:30', '2024-12-09 14:55:30'),
(129, '2023', '30', 0, 125, '2024-12-09 14:56:26', '2025-01-07 13:17:19'),
(130, '2023', '31', 0, 116, '2024-12-09 14:57:47', '2024-12-09 14:57:47'),
(131, '2022', '5', 0, 132, '2024-12-09 15:02:48', '2024-12-09 15:02:48'),
(132, '2023', '31', 0, 132, '2024-12-09 15:03:02', '2024-12-09 15:03:02'),
(133, '2022', '16', 0, 129, '2024-12-09 15:04:21', '2024-12-09 15:04:21'),
(134, '2023', '31', 0, 129, '2024-12-09 15:04:32', '2024-12-09 15:04:32'),
(135, '2022', '1', 0, 130, '2024-12-09 15:05:40', '2024-12-09 15:05:40'),
(136, '2023', '31', 0, 130, '2024-12-09 15:05:53', '2024-12-09 15:05:53'),
(137, '2022', '30', 0, 131, '2024-12-09 15:07:38', '2024-12-09 15:07:38'),
(138, '2023', '30', 0, 131, '2024-12-09 15:08:11', '2024-12-09 15:08:11'),
(139, '2022', '30', 0, 133, '2024-12-09 15:09:08', '2024-12-09 15:09:08'),
(140, '2022', '5', 0, 134, '2024-12-09 15:10:10', '2024-12-09 15:10:10'),
(141, '2023', '30', 0, 134, '2024-12-09 15:10:29', '2024-12-09 15:10:29'),
(142, '2021', '1', 0, 135, '2024-12-09 15:11:54', '2024-12-09 15:11:54'),
(143, '2022', '30', 0, 135, '2024-12-09 15:12:05', '2024-12-09 15:12:05'),
(144, '2023', '30', 0, 135, '2024-12-09 15:12:20', '2024-12-09 15:12:20'),
(145, '2021', '2', 0, 136, '2024-12-09 15:13:18', '2024-12-09 15:13:18'),
(146, '2022', '30', 0, 136, '2024-12-09 15:13:33', '2024-12-09 15:13:33'),
(147, '2023', '30', 0, 136, '2024-12-09 15:13:44', '2024-12-09 15:13:44'),
(148, '2023', '33', 0, 137, '2024-12-09 15:15:30', '2024-12-09 15:15:30'),
(149, '2023', '22', 0, 144, '2024-12-09 15:18:11', '2024-12-09 15:18:11'),
(150, '2023', '30', 0, 140, '2024-12-09 15:20:43', '2025-01-07 13:33:22'),
(151, '2023', '30', 0, 141, '2024-12-09 15:21:55', '2025-01-07 13:37:38'),
(152, '2021', '18', 0, 145, '2024-12-09 15:23:38', '2024-12-09 15:23:38'),
(153, '2022', '30', 0, 145, '2024-12-09 15:24:04', '2024-12-09 15:24:04'),
(154, '2023', '31', 0, 145, '2024-12-09 15:24:31', '2024-12-09 15:24:31'),
(155, '2021', '30', 0, 146, '2024-12-09 15:26:02', '2024-12-09 15:26:02'),
(156, '2022', '33', 0, 146, '2024-12-09 15:26:20', '2024-12-09 15:26:20'),
(157, '2023', '30', 0, 146, '2024-12-09 15:26:55', '2024-12-09 15:26:55'),
(158, '2021', '30', 0, 147, '2024-12-09 15:28:01', '2024-12-09 15:28:01'),
(159, '2022', '30', 0, 147, '2024-12-09 15:28:14', '2024-12-09 15:28:14'),
(160, '2023', '30', 0, 147, '2024-12-09 15:28:30', '2024-12-09 15:28:30'),
(161, '2020', '20', 0, 147, '2024-12-09 15:30:20', '2024-12-09 15:30:20'),
(162, '2023', '31', 0, 148, '2024-12-09 15:31:37', '2025-01-07 13:41:09'),
(163, '2023', '30', 0, 150, '2024-12-09 15:33:06', '2024-12-09 15:33:06'),
(164, '2023', '30', 0, 153, '2024-12-09 15:35:28', '2024-12-09 15:35:28'),
(165, '2023', '30', 0, 154, '2024-12-09 15:36:24', '2024-12-09 15:36:24'),
(166, '2023', '30', 0, 155, '2024-12-09 15:37:38', '2025-01-07 13:50:32'),
(167, '2023', '30', 0, 156, '2024-12-09 15:42:44', '2025-01-07 13:43:25'),
(168, '2023', '30', 0, 117, '2024-12-09 15:44:40', '2025-01-07 13:53:35'),
(169, '2023', '30', 0, 157, '2024-12-09 15:45:55', '2025-01-07 13:54:38'),
(170, '2023', '32', 0, 159, '2024-12-09 15:47:26', '2025-01-07 13:57:06'),
(171, '2019', '8', 0, 161, '2024-12-09 15:49:26', '2024-12-09 15:49:26'),
(172, '2020', '30', 0, 161, '2024-12-09 15:50:41', '2024-12-09 15:50:41'),
(173, '2021', '30', 0, 161, '2024-12-09 15:51:04', '2024-12-09 15:51:04'),
(174, '2022', '30', 0, 161, '2024-12-09 15:51:21', '2024-12-09 15:51:21'),
(175, '2023', '30', 0, 161, '2024-12-09 15:51:44', '2024-12-09 15:51:44'),
(176, '2023', '30', 0, 164, '2024-12-09 15:55:55', '2024-12-09 15:55:55'),
(177, '2023', '30', 0, 165, '2024-12-09 15:57:03', '2024-12-09 15:57:03'),
(178, '2023', '30', 0, 166, '2024-12-09 16:01:07', '2024-12-09 16:01:07'),
(179, '2022', '29', 0, 170, '2024-12-09 16:03:35', '2024-12-09 16:03:35'),
(180, '2023', '35', 0, 170, '2024-12-09 16:03:46', '2024-12-09 16:03:46'),
(181, '2023', '30', 0, 169, '2024-12-09 16:04:48', '2024-12-09 16:04:48'),
(182, '2023', '30', 0, 171, '2024-12-09 16:07:11', '2025-01-07 14:07:02'),
(183, '2023', '31', 0, 172, '2024-12-09 16:08:20', '2025-01-07 14:08:28'),
(184, '2023', '31', 0, 173, '2024-12-09 16:09:02', '2025-01-07 14:11:15'),
(185, '2023', '30', 0, 174, '2024-12-09 16:10:23', '2024-12-09 16:10:23'),
(186, '2023', '30', 0, 176, '2024-12-09 16:11:10', '2025-01-07 14:24:16'),
(187, '2023', '32', 0, 177, '2024-12-09 16:12:00', '2025-01-07 14:18:02'),
(188, '2018', '28', 0, 178, '2024-12-09 16:14:12', '2024-12-09 16:14:12'),
(189, '2019', '30', 0, 178, '2024-12-09 16:14:25', '2024-12-09 16:14:25'),
(190, '2020', '33', 0, 178, '2024-12-09 16:14:45', '2024-12-09 16:14:45'),
(191, '2021', '33', 0, 178, '2024-12-09 16:14:58', '2024-12-09 16:14:58'),
(192, '2022', '33', 0, 178, '2024-12-09 16:15:14', '2024-12-09 16:15:14'),
(193, '2023', '33', 0, 178, '2024-12-09 16:15:26', '2024-12-09 16:15:26'),
(194, '2023', '31', 0, 179, '2024-12-09 16:17:41', '2024-12-09 16:17:41'),
(195, '2020', '8', 0, 181, '2024-12-09 16:26:06', '2024-12-09 16:26:06'),
(196, '2021', '31', 0, 181, '2024-12-09 16:26:21', '2024-12-09 16:26:21'),
(197, '2022', '31', 0, 181, '2024-12-09 16:26:37', '2024-12-09 16:26:37'),
(198, '2023', '31', 0, 181, '2024-12-09 16:26:49', '2024-12-09 16:26:49'),
(199, '2023', '30', 0, 182, '2024-12-09 16:27:52', '2024-12-09 16:27:52'),
(200, '2023', '33', 0, 183, '2024-12-09 16:29:40', '2024-12-09 16:29:40'),
(201, '2023', '30', 0, 184, '2024-12-09 16:30:25', '2025-01-07 14:33:41'),
(202, '2022', '6', 0, 185, '2024-12-09 16:31:41', '2024-12-09 16:31:41'),
(203, '2023', '31', 0, 185, '2024-12-09 16:31:56', '2024-12-09 16:31:56'),
(204, '2022', '29', 0, 186, '2024-12-09 16:33:20', '2024-12-09 16:33:20'),
(205, '2023', '30', 0, 186, '2024-12-09 16:33:41', '2024-12-09 16:33:41'),
(206, '2023', '30', 0, 188, '2024-12-09 16:38:04', '2024-12-09 16:38:04'),
(207, '2023', '30', 0, 10, '2025-01-07 11:04:42', '2025-01-07 11:04:42'),
(208, '2023', '30', 0, 142, '2025-01-07 11:18:36', '2025-01-07 11:18:36'),
(209, '2023', '30', 0, 163, '2025-01-07 11:24:20', '2025-01-07 11:24:20'),
(210, '2023', '30', 0, 59, '2025-01-07 11:29:19', '2025-01-07 11:29:19'),
(211, '2023', '30', 0, 26, '2025-01-07 11:31:54', '2025-01-07 11:31:54'),
(212, '2023', '30', 0, 121, '2025-01-07 11:36:50', '2025-01-07 11:36:50'),
(213, '2023', '32', 0, 27, '2025-01-07 11:38:01', '2025-01-07 11:38:01'),
(214, '2023', '30', 0, 39, '2025-01-07 11:39:22', '2025-01-07 11:39:22'),
(215, '2023', '33', 0, 29, '2025-01-07 11:40:27', '2025-01-07 11:40:40'),
(216, '2023', '30', 0, 30, '2025-01-07 11:41:37', '2025-01-07 11:41:37'),
(217, '2023', '30', 0, 32, '2025-01-07 11:43:34', '2025-01-07 11:43:34'),
(218, '2023', '30', 0, 46, '2025-01-07 12:01:45', '2025-01-07 12:01:45'),
(219, '2023', '30', 0, 49, '2025-01-07 12:04:56', '2025-01-07 12:04:56'),
(220, '2023', '30', 0, 50, '2025-01-07 12:05:37', '2025-01-07 12:05:37'),
(221, '2023', '31', 0, 56, '2025-01-07 12:12:49', '2025-01-07 12:12:49'),
(222, '2023', '30', 0, 57, '2025-01-07 12:13:52', '2025-01-07 12:13:52'),
(223, '2023', '30', 0, 58, '2025-01-07 12:14:48', '2025-01-07 12:14:48'),
(224, '2023', '33', 0, 61, '2025-01-07 12:16:55', '2025-01-07 12:16:55'),
(225, '2023', '31', 0, 64, '2025-01-07 12:19:02', '2025-01-07 12:19:02'),
(226, '2023', '30', 0, 65, '2025-01-07 12:20:33', '2025-01-07 12:20:33'),
(227, '2023', '30', 0, 66, '2025-01-07 12:21:28', '2025-01-07 12:21:28'),
(228, '2023', '30', 0, 69, '2025-01-07 12:24:15', '2025-01-07 12:24:15'),
(229, '2023', '30', 0, 70, '2025-01-07 12:25:06', '2025-01-07 12:25:06'),
(230, '2023', '30', 0, 77, '2025-01-07 12:32:20', '2025-01-07 12:32:20'),
(231, '2023', '31', 0, 81, '2025-01-07 12:45:10', '2025-01-07 12:45:10'),
(232, '2023', '30', 0, 86, '2025-01-07 12:50:00', '2025-01-07 12:50:00'),
(233, '2023', '30', 0, 89, '2025-01-07 12:53:02', '2025-01-07 12:53:02'),
(234, '2023', '30', 0, 91, '2025-01-07 12:54:02', '2025-01-07 12:54:02'),
(235, '2023', '30', 0, 95, '2025-01-07 12:57:09', '2025-01-07 12:57:09'),
(236, '2023', '30', 0, 3, '2025-01-07 12:58:32', '2025-01-07 12:58:32'),
(237, '2023', '30', 0, 97, '2025-01-07 12:59:50', '2025-01-07 12:59:50'),
(238, '2023', '30', 0, 100, '2025-01-07 13:01:40', '2025-01-07 13:01:40'),
(239, '2023', '30', 0, 101, '2025-01-07 13:02:45', '2025-01-07 13:02:45'),
(240, '2023', '30', 0, 108, '2025-01-07 13:04:57', '2025-01-07 13:04:57'),
(241, '2023', '30', 0, 36, '2025-01-07 13:07:54', '2025-01-07 13:07:54'),
(242, '2023', '31', 0, 112, '2025-01-07 13:10:35', '2025-01-07 13:10:35'),
(243, '2023', '30', 0, 114, '2025-01-07 13:11:21', '2025-01-07 13:11:21'),
(244, '2023', '30', 0, 104, '2025-01-07 13:12:59', '2025-01-07 13:12:59'),
(245, '2023', '30', 0, 110, '2025-01-07 13:14:49', '2025-01-07 13:14:49'),
(246, '2023', '30', 0, 123, '2025-01-07 13:15:56', '2025-01-07 13:15:56'),
(247, '2023', '30', 0, 128, '2025-01-07 13:20:02', '2025-01-07 13:20:02'),
(248, '2023', '30', 0, 78, '2025-01-07 13:23:55', '2025-01-07 13:23:55'),
(249, '2023', '30', 0, 143, '2025-01-07 13:27:35', '2025-01-07 13:27:35'),
(250, '2023', '30', 0, 138, '2025-01-07 13:30:00', '2025-01-07 13:30:00'),
(251, '2023', '32', 0, 139, '2025-01-07 13:30:45', '2025-01-07 13:30:45'),
(252, '2023', '30', 0, 149, '2025-01-07 13:42:08', '2025-01-07 13:42:08'),
(253, '2023', '30', 0, 151, '2025-01-07 13:44:35', '2025-01-07 13:44:35'),
(254, '2023', '30', 0, 152, '2025-01-07 13:45:14', '2025-01-07 13:45:14'),
(255, '2023', '30', 0, 127, '2025-01-07 13:46:40', '2025-01-07 13:46:40'),
(256, '2023', '30', 0, 60, '2025-01-07 13:52:13', '2025-01-07 13:52:13'),
(257, '2023', '30', 0, 158, '2025-01-07 13:55:58', '2025-01-07 13:55:58'),
(258, '2023', '30', 0, 5, '2025-01-07 13:58:36', '2025-01-07 13:58:36'),
(259, '2023', '30', 0, 160, '2025-01-07 13:59:31', '2025-01-07 13:59:31'),
(260, '2023', '30', 0, 162, '2025-01-07 14:01:18', '2025-01-07 14:01:18'),
(261, '2023', '31', 0, 167, '2025-01-07 14:05:25', '2025-01-07 14:05:25'),
(262, '2023', '30', 0, 168, '2025-01-07 14:20:17', '2025-01-07 14:20:17'),
(263, '2023', '33', 0, 175, '2025-01-07 14:21:22', '2025-01-07 14:21:22'),
(264, '2023', '30', 0, 187, '2025-01-07 14:23:28', '2025-01-07 14:23:28'),
(265, '2023', '33', 0, 111, '2025-01-07 14:25:58', '2025-01-07 14:25:58'),
(266, '2023', '33', 0, 17, '2025-01-07 14:29:34', '2025-01-07 14:29:34'),
(267, '2023', '30', 0, 180, '2025-01-07 14:30:33', '2025-01-07 14:30:33'),
(268, '2023', '30', 0, 119, '2025-01-07 14:31:54', '2025-01-07 14:31:54'),
(270, '2024', '30', 2, 1, '2025-03-12 18:08:15', '2025-03-17 10:08:07');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `emargements`
--
ALTER TABLE `emargements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `form_assessments`
--
ALTER TABLE `form_assessments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `form_fields`
--
ALTER TABLE `form_fields`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `leave_flow`
--
ALTER TABLE `leave_flow`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parametres`
--
ALTER TABLE `parametres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `retards`
--
ALTER TABLE `retards`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `service_responsable`
--
ALTER TABLE `service_responsable`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `signatories`
--
ALTER TABLE `signatories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transmissions`
--
ALTER TABLE `transmissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_leaves`
--
ALTER TABLE `type_leaves`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_leaves`
--
ALTER TABLE `user_leaves`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `emargements`
--
ALTER TABLE `emargements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `form_assessments`
--
ALTER TABLE `form_assessments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `form_fields`
--
ALTER TABLE `form_fields`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `infos`
--
ALTER TABLE `infos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `leave_flow`
--
ALTER TABLE `leave_flow`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `medias`
--
ALTER TABLE `medias`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `parametres`
--
ALTER TABLE `parametres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT pour la table `retards`
--
ALTER TABLE `retards`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT pour la table `service_responsable`
--
ALTER TABLE `service_responsable`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `signatories`
--
ALTER TABLE `signatories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `transmissions`
--
ALTER TABLE `transmissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `type_leaves`
--
ALTER TABLE `type_leaves`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT pour la table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user_leaves`
--
ALTER TABLE `user_leaves`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
