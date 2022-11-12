-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 12-11-2022 a las 08:03:48
-- Versión del servidor: 5.7.34
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `room-911`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Logistica', 'Descripción del departamento de logistca', '2022-11-08 04:10:15', '2022-11-08 04:10:15'),
(2, 'Logistica 2', 'Descripción del departamento de logistca', '2022-11-08 04:20:31', '2022-11-08 04:20:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`id`, `name`, `last_name`, `identification`, `department_id`, `state`, `created_at`, `updated_at`) VALUES
(1, 'Lisney', 'Sanchez', '109876562-1667873481', '2', 1, '2022-11-08 07:24:21', '2022-11-12 05:14:53'),
(2, 'Jair', 'Zea', '12345678-1667873495', '2', 1, '2022-11-08 07:24:35', '2022-11-12 01:39:18'),
(3, 'Julio', 'Lopez', '87654323-1667873495', '2', 0, '2022-11-08 07:24:35', '2022-11-11 21:40:28'),
(4, 'Lis', 'Hernand', '545672-1667873495', '2', 1, '2022-11-08 07:24:35', '2022-11-11 21:39:09'),
(11, 'Nuevo', 'Empleadoss', '98765-1668129061', '2', 1, '2022-11-11 01:27:01', '2022-11-11 01:27:01'),
(25, 'Lis', 'Hernand new', '3545672-1668219091', '2', 1, '2022-11-12 02:36:31', '2022-11-12 02:36:31'),
(26, 'My test', 'My last name', '1238757-1668219103', '1', 1, '2022-11-12 02:49:43', '2022-11-12 02:49:43'),
(29, 'Lisney', 'qw', '986377121-1668226317', '1', 1, '2022-11-12 04:14:57', '2022-11-12 04:14:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `income_records`
--

CREATE TABLE `income_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_identification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hour` time NOT NULL,
  `date` date NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `income_records`
--

INSERT INTO `income_records` (`id`, `employee_identification`, `hour`, `date`, `state`, `created_at`, `updated_at`) VALUES
(1, '109876562-1667873481', '03:11:38', '2022-11-08', 'Empleado autorizado', '2022-11-08 08:14:38', '2022-11-08 08:14:38'),
(2, '109876562-1667873481', '03:11:10', '2022-11-08', 'Empleado no autorizado', '2022-11-08 08:16:10', '2022-11-08 08:16:10'),
(3, '109876562-1667873481', '03:11:35', '2022-11-08', 'Empleado no autorizado', '2022-11-08 08:16:35', '2022-11-08 08:16:35'),
(4, '12345678-1667873495', '03:11:55', '2022-11-08', 'Empleado autorizado', '2022-11-08 08:16:55', '2022-11-08 08:16:55'),
(5, '12345678-166787349', '03:11:55', '2022-11-08', 'Empleado no registrado', '2022-11-08 08:18:55', '2022-11-08 08:18:55'),
(6, '12345678-1667873495', '03:11:06', '2022-11-08', 'Empleado autorizado', '2022-11-08 08:19:06', '2022-11-08 08:19:06'),
(7, '109876562-1667873481', '03:11:11', '2022-11-08', 'Empleado no autorizado', '2022-11-08 08:19:11', '2022-11-08 08:19:11'),
(8, '12345678-1667873495', '03:11:18', '2022-11-08', 'Empleado autorizado', '2022-11-08 08:19:18', '2022-11-08 08:19:18'),
(9, '12345678-1667873495', '22:11:26', '2022-11-07', 'Empleado autorizado', '2022-11-08 03:33:26', '2022-11-08 03:33:26'),
(10, '12345678-1667873495', '22:33:50', '2022-11-07', 'Empleado autorizado', '2022-11-08 03:33:50', '2022-11-08 03:33:50'),
(11, '12345678-1667873495', '22:36:01', '2022-11-07', 'Empleado autorizado', '2022-11-08 03:36:01', '2022-11-08 03:36:01'),
(12, '12345678-1667873495', '22:36:24', '2022-11-07', 'Empleado autorizado', '2022-11-08 03:36:24', '2022-11-08 03:36:24'),
(13, '12345678-1667873495', '03:36:44', '2022-11-08', 'Empleado autorizado', '2022-11-08 08:36:44', '2022-11-08 08:36:44'),
(14, '12345678-1667873495gb', '22:39:28', '2022-11-07', 'Empleado no registrado', '2022-11-08 03:39:28', '2022-11-08 03:39:28'),
(15, '87654323-1667873495', '22:47:08', '2022-11-11', 'Empleado no autorizado', '2022-11-12 03:47:08', '2022-11-12 03:47:08'),
(16, '12345678-1667873495', '22:47:34', '2022-11-11', 'Empleado autorizado', '2022-11-12 03:47:34', '2022-11-12 03:47:34'),
(17, '545672-1667873495', '22:55:30', '2022-11-11', 'Empleado autorizado', '2022-11-12 03:55:30', '2022-11-12 03:55:30'),
(18, '545672-1667873495', '02:03:40', '2022-11-12', 'Empleado autorizado', '2022-11-12 07:03:40', '2022-11-12 07:03:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(12, '2022_11_07_202103_create_roles_table', 3),
(17, '2022_11_07_224721_create_departments_table', 5),
(19, '2022_11_07_194650_create_employees_table', 6),
(21, '2022_11_08_023054_create_income_records_table', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0509c7de9191ba53c70ba1804904497f614e891aa1c73554e849b8005f1712ff68c672209c13aadf', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 00:02:08', '2022-11-08 00:02:08', '2023-11-07 19:02:08'),
('18491e239ee05a2b4d55a1262ad9ce0e853f7a24ad8576cf3b91804df8af4b6269ff1e29c59509da', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 02:39:49', '2022-11-08 02:39:49', '2023-11-07 21:39:49'),
('1d05e081de780250fcc7143e18162c527d891a0cc36e1a53a3921839eb06f418397e1cd66b4674ba', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 01:51:39', '2022-11-08 01:51:39', '2023-11-07 20:51:39'),
('214796641a7193e8e923eda3cd6b9feb9eaa1ab8c8538020d75eeddb60f5823b9ed22ad124d280ef', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-12 07:00:15', '2022-11-12 07:00:15', '2023-11-12 02:00:15'),
('21ef4ac89e42a229e7ee1fd92c1bae6fec35edca9ec526809aa3cd7c682d8ac5105880594a711a09', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 00:06:45', '2022-11-08 00:06:45', '2023-11-07 19:06:45'),
('3205555019e77d5a24b42aeef8f60c2eab1e04cd73994aa02fcdf360225bae87ef7e6f832ec2aff2', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 02:18:59', '2022-11-08 02:18:59', '2023-11-07 21:18:59'),
('33bd8085bbee153e85c7f9295a7bc3903653f7f157a883a07e61ed51cab02bbc463f55a786dc682f', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 06:52:44', '2022-11-08 06:52:44', '2023-11-08 01:52:44'),
('3e46127ba9f83b723632bed0e90d1391238a0f1b65cbddaf5b79651a2e1ada61c8baf985380f080c', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 02:32:48', '2022-11-08 02:32:48', '2023-11-07 21:32:48'),
('4ce3bd3b1cf580050c05ab1489bf1e8c28e74f5de0bfeaeadad9204ad4c4b7ce71031e2486cbc08a', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-10 04:44:50', '2022-11-10 04:44:50', '2023-11-09 23:44:50'),
('6b915f42af3244d732c1944d0332de51babef72a89ab47e14d010d3fac8e021b36eaabcbbab74f10', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 02:19:18', '2022-11-08 02:19:18', '2023-11-07 21:19:18'),
('72e8a2bd7df1fc8f814f9e7517acb1d179ab0409507d12b8da735a672b72e80d5f701d239a7bf70b', 2, 1, 'Personal Access Token', '[]', 0, '2022-11-12 05:35:48', '2022-11-12 05:35:48', '2023-11-12 00:35:48'),
('75816382c2bf216bc53700c37a6dee143c80331968ecb18bab3dcb003d93ba9ec6ee4e9ef082889e', 3, 1, 'Personal Access Token', '[]', 0, '2022-11-12 06:33:57', '2022-11-12 06:33:57', '2023-11-12 01:33:57'),
('8868a2285a7b3435180bcc3fcfa7825285c5eeafc9ecea1dd9e2cad06493d9a893cd2bd98d86f925', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 02:42:48', '2022-11-08 02:42:48', '2023-11-07 21:42:48'),
('8d465a07d9380a87db2c9fbe914be626ad1aaf960c0f206c0812b921a679a7141d2051786edd6c3c', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 00:02:54', '2022-11-08 00:02:54', '2023-11-07 19:02:54'),
('972f306c81681da80a24380df9dd9cd91978474233352d48f763ccd113435992c8ddfa4d7b6dc12e', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 02:40:12', '2022-11-08 02:40:12', '2023-11-07 21:40:12'),
('988841b8474bd7df17cb6f03751943fd292b09aed7caf4a4523470242abe0570e10a8790511e4a22', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-12 06:51:32', '2022-11-12 06:51:32', '2023-11-12 01:51:32'),
('998d4138b6c18409285e1e0dd6fde329426b803c50ec7f183e85093132ed386785eceb05143ecb0c', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-12 06:55:06', '2022-11-12 06:55:06', '2023-11-12 01:55:06'),
('9ff05bc32ba5c2ae3245b325b4da67f5e9240537aaec6b5c6ca9bee72908525c2bd67591b02727f4', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 02:33:22', '2022-11-08 02:33:22', '2023-11-07 21:33:22'),
('bb53fbc6bb2e138dff55fccff7a1da5d960f81a331762d3496d21021e63f4dc9c06b7a2d4abb6fc4', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 01:40:53', '2022-11-08 01:40:53', '2023-11-07 20:40:53'),
('d54a3c42341076cbffcbc774cc7e6af4a8d4b56dc27a39300f51a81920896b03b1a78b26d4f9ef42', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-10 04:47:13', '2022-11-10 04:47:13', '2023-11-09 23:47:13'),
('dc345ba043d8b0ab05d624041695a69eded52cc00291136f680a3dd7d721e7e679a506d61be0a2bd', 3, 1, 'Personal Access Token', '[]', 0, '2022-11-12 07:03:25', '2022-11-12 07:03:25', '2023-11-12 02:03:25'),
('e3803c81916e67690478f73ae00f281d71d56c26b9c1cf6a228266f260cb35b3e16bc5bc509cedbd', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 02:33:54', '2022-11-08 02:33:54', '2023-11-07 21:33:54'),
('e55cd350ef196e70303a59db09b942bbc0212d93f74fac1971828dfadb33e77c3fd2a7496d5b621c', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-10 04:44:16', '2022-11-10 04:44:16', '2023-11-09 23:44:16'),
('e591eb1431043f49f030a40206161bf68d3079e0f6a0bde3a32e08a8100ea034720dffe53d8bbd86', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 02:39:31', '2022-11-08 02:39:31', '2023-11-07 21:39:31'),
('e91d3d44a908a9aafa6e7faf54e490673406b88cec759d80a02c70575ecd141eb90544b417be1e38', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 02:45:45', '2022-11-08 02:45:45', '2023-11-07 21:45:45'),
('ec9d6a2ebaf661d501ac6e580ec0f8d11bed7d765ca3969f4fc27815833c739f65e1041a424fb067', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 02:16:15', '2022-11-08 02:16:15', '2023-11-07 21:16:15'),
('f747778bb5de7b564e93b2acca476fc7ee6bda7271c104bbabef14bfa20bbd575db5b0bb19caa3c2', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 06:47:10', '2022-11-08 06:47:10', '2023-11-08 01:47:10'),
('f9f115b5a8da6dcae7f8b824cb05d2c236686eeafc71bcb4a8070cd8f50622ade78ed16838ab5c55', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 00:03:22', '2022-11-08 00:03:22', '2023-11-07 19:03:22'),
('fc90fa2ba6a4285c724f2925259df2d389faf87b35d0a269ab8425168e314c7f8222815cc0358f74', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 02:40:28', '2022-11-08 02:40:28', '2023-11-07 21:40:28'),
('fe268e09d312616f332b82c992c8e0e62412fe62341a30a40e1bf1c18c597cee1cb495f487369737', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-12 06:54:03', '2022-11-12 06:54:03', '2023-11-12 01:54:03'),
('feefa1075949419c7d38d80dac6905a051123f38eceea6d238c9d9e5e1b025ea0f595f09a6eb9608', 1, 1, 'Personal Access Token', '[]', 0, '2022-11-08 00:55:19', '2022-11-08 00:55:19', '2023-11-07 19:55:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'QYNotn4d2qMT6NDlj0mTshRiGM0RGCOSb3PokpV6', NULL, 'http://localhost', 1, 0, 0, '2022-11-07 23:09:20', '2022-11-07 23:09:20'),
(2, NULL, 'Laravel Password Grant Client', 'RBknpshVcxGug0RBtxdA38a9yCMHp3MpCy6oPbQ7', 'users', 'http://localhost', 0, 1, 0, '2022-11-07 23:09:20', '2022-11-07 23:09:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-11-07 23:09:20', '2022-11-07 23:09:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'Personal Access Token', '6c057a0be25ef7941e86ae975ff55c5804183a0e7269941637b0d490cafc9474', '[\"*\"]', NULL, NULL, '2022-11-07 23:41:01', '2022-11-07 23:41:01'),
(2, 'App\\Models\\User', 1, 'Personal Access Token', 'b552508ef616be2ba052af49617b222bfa22ef559154c6a057b923a5566772aa', '[\"*\"]', NULL, NULL, '2022-11-07 23:49:41', '2022-11-07 23:49:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin_room_911', 'Room manager 911', '2022-11-08 02:00:14', '2022-11-08 02:00:14'),
(2, 'admin_room_912', 'Room manager 912', '2022-11-08 03:21:57', '2022-11-08 03:21:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jair Zea', 'jairzeapaez@gmail.com', NULL, '$2y$10$kNK57hhvRAJcMH8.4DugKei5Rr.VfQNfH8t97YyFqv8GGMFQmJuka', '1', NULL, '2022-11-07 23:39:45', '2022-11-07 23:39:45'),
(3, 'Lisy', 'lis@mail.com', NULL, '$2y$10$5cUvxn.29nLCC2iiKHikM.QnT0k23EclZyBk2f.HIqTZJwPI.MlR2', '1', NULL, '2022-11-12 06:18:10', '2022-11-12 06:18:10'),
(4, 'Otro user', 'jairzeapaez@gmail.comr', NULL, '$2y$10$.1pJjap0U6Os/MzEZBXh1uFnqVRixe8LJR4JREV.a2vbIUStLyvBC', '1', NULL, '2022-11-12 06:25:34', '2022-11-12 06:25:34'),
(5, 'Otro user', 'jairzeapayez@gmail.com', NULL, '$2y$10$kA4wNHtm4OvAdZ/3BSiSU.MxKtpiCNMPxPfp8RMRpCLhKOyqFaFZK', '1', NULL, '2022-11-12 06:26:32', '2022-11-12 06:26:32'),
(6, 'Otro user', 'jairzeapaez@gmail.comq', NULL, '$2y$10$T1gMpUNsZxgu7ZIYdlcrReXaAxfZTgABzj4kyrLavKiH.TceI0aUm', '1', NULL, '2022-11-12 06:33:03', '2022-11-12 06:33:03');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_last_name_unique` (`last_name`),
  ADD UNIQUE KEY `employees_identification_unique` (`identification`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `income_records`
--
ALTER TABLE `income_records`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `income_records`
--
ALTER TABLE `income_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
