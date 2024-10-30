-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: database:3306
-- Tiempo de generación: 26-10-2024 a las 03:39:04
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `turnos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint UNSIGNED NOT NULL,
  `patient_id` bigint UNSIGNED NOT NULL,
  `doctor_id` bigint UNSIGNED NOT NULL,
  `medical_office_id` bigint UNSIGNED NOT NULL,
  `operator_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clinic_schedules`
--

CREATE TABLE `clinic_schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `medical_office_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `person_id` bigint UNSIGNED NOT NULL,
  `specialty_id` bigint UNSIGNED NOT NULL,
  `license_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `doctors`
--

INSERT INTO `doctors` (`id`, `user_id`, `person_id`, `specialty_id`, `license_number`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 24, 21, 16, '127647315', '2024-10-17 01:49:18', '2024-10-19 01:30:10', '2024-10-19 01:30:10'),
(2, 25, 22, 20, '002780837', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(3, 26, 23, 7, '333003431', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(4, 27, 24, 5, '501282131', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(5, 28, 25, 29, '770048101', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(6, 29, 26, 26, '511422094', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(7, 30, 27, 11, '334116716', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(8, 31, 28, 16, '996272661', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(9, 32, 29, 21, '034605759', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(10, 33, 30, 7, '802124124', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(11, 34, 31, 14, '927029150', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(12, 35, 32, 2, '291198046', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(13, 36, 33, 1, '845425448', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(14, 37, 34, 27, '043353552', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(15, 38, 35, 5, '864542625', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(16, 39, 36, 19, '432466801', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(17, 40, 37, 3, '440167183', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(18, 41, 38, 6, '267044246', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(19, 42, 39, 21, '539393567', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(20, 43, 40, 7, '564561688', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(21, 46, 85, 31, '3856', '2024-10-19 02:30:23', '2024-10-19 02:30:23', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctor_schedules`
--

CREATE TABLE `doctor_schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `doctor_id` bigint UNSIGNED NOT NULL,
  `clinic_schedule_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `appointment_duration` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `health_insurances`
--

CREATE TABLE `health_insurances` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `health_insurances`
--

INSERT INTO `health_insurances` (`id`, `name`, `business_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hammes and Sons', 'Klocko PLC Inc', '2024-10-17 01:49:18', '2024-10-19 17:34:32', NULL),
(2, 'Upton, Lemke and Lesch', 'Christiansen-Zemlak PLC', '2024-10-17 01:49:18', '2024-10-19 17:38:02', NULL),
(3, 'Schoen-Blick', 'Rau, Bode and Hermann LLC', '2024-10-17 01:49:18', '2024-10-19 17:38:13', NULL),
(4, 'Fisher, Emard and Hegmann', 'Johnston-O\'Connell LLC', '2024-10-17 01:49:18', '2024-10-19 17:44:48', NULL),
(5, 'Dickinson Ltd', 'Kessler, Weber and Lowe LLC', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(6, 'Nolan, Botsford and Carroll', 'Bayer Group PLC', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(7, 'Ward Ltd', 'Howell-Weber Group', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(8, 'Bernhard-Farrell', 'Vandervort Group LLC', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(9, 'Luettgen Ltd', 'Abbott-Berge Inc', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(10, 'Keebler LLC', 'Auer-Turner LLC', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(11, 'Wolff, Heidenreich and Wisoky', 'Russel-Lockman Group', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(12, 'Torp Inc', 'Rice, Rosenbaum and Koch and Sons', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(13, 'Moen-Luettgen', 'Cormier and Sons LLC', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(14, 'Pouros Ltd', 'McLaughlin, Krajcik and Sauer and Sons', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(15, 'Larkin-Berge', 'Satterfield Group Inc', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(16, 'Prosacco, Bogan and McKenzie', 'Johnson PLC Group', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(17, 'Bailey and Sons', 'Kessler LLC Inc', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(18, 'Ziemann, Rice and Hettinger', 'Ernser and Sons and Sons', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(19, 'Emard-Bernhard', 'Kreiger Group Ltd', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(20, 'Hintz, Wisozk and Kohler', 'Trantow-Ankunding LLC', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(21, 'Ward-Nolan', 'Kertzmann, Beer and Frami and Sons', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(22, 'Murray-Ankunding', 'Kiehn, Reilly and Erdman PLC', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(23, 'Leannon-Welch', 'Towne, Shields and Hettinger Group', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(24, 'Hoeger Inc', 'Simonis Ltd and Sons', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(25, 'Fritsch-Collier', 'Cole, Bartoletti and Collier Ltd', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(26, 'Hane-Bartoletti', 'Daugherty Ltd LLC', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(27, 'Dare-Willms', 'Pacocha, Swaniawski and Rice LLC', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(28, 'Thompson, Kemmer and Spinka', 'Larson, Orn and Parker Ltd', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(29, 'Pfeffer Group', 'Ward-Cremin Group', '2024-10-17 01:49:18', '2024-10-19 17:52:33', '2024-10-19 17:52:33'),
(30, 'Green-Zboncak', 'Reilly PLC PLC', '2024-10-17 01:49:18', '2024-10-19 17:51:50', '2024-10-19 17:51:50'),
(31, 'Sancor Salud 2', NULL, '2024-10-19 17:15:19', '2024-10-19 17:34:23', '2024-10-19 17:34:23'),
(32, '9859+59', NULL, '2024-10-19 17:51:33', '2024-10-19 17:51:40', '2024-10-19 17:51:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medical_histories`
--

CREATE TABLE `medical_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `patient_id` bigint UNSIGNED NOT NULL,
  `doctor_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medical_offices`
--

CREATE TABLE `medical_offices` (
  `id` bigint UNSIGNED NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_02_17_194354_create_sessions_table', 1),
(7, '2024_02_18_170905_create_people_table', 1),
(8, '2024_02_18_170912_create_health_insurances_table', 1),
(9, '2024_02_18_170919_create_patients_table', 1),
(10, '2024_02_18_170926_create_specialties_table', 1),
(11, '2024_02_18_170928_create_doctors_table', 1),
(12, '2024_02_18_170938_create_staff_table', 1),
(13, '2024_02_18_170946_create_medical_offices_table', 1),
(14, '2024_02_18_170956_create_clinic_schedules_table', 1),
(15, '2024_02_18_171009_create_doctor_schedules_table', 1),
(16, '2024_02_18_171026_create_appointments_table', 1),
(17, '2024_02_18_171103_create_medical_histories_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patients`
--

CREATE TABLE `patients` (
  `id` bigint UNSIGNED NOT NULL,
  `person_id` bigint UNSIGNED NOT NULL,
  `health_insurance_id` bigint UNSIGNED DEFAULT NULL,
  `affiliate_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `patients`
--

INSERT INTO `patients` (`id`, `person_id`, `health_insurance_id`, `affiliate_number`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 41, 1, '2657758861', '2024-10-17 01:49:18', '2024-10-19 17:13:25', '2024-10-19 17:13:25'),
(2, 42, 2, '8001236948', '2024-10-17 01:49:18', '2024-10-19 17:13:34', '2024-10-19 17:13:34'),
(3, 43, 3, '8861131646', '2024-10-17 01:49:18', '2024-10-19 17:13:38', '2024-10-19 17:13:38'),
(4, 44, 4, '1348642484', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(5, 45, 5, '5849614904', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(6, 46, 6, '3679906674', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(7, 47, 7, '6017471112', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(8, 48, 8, '3429589731', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(9, 49, 9, '8768670462', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(10, 50, 10, '6510741200', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(11, 51, 11, '9382052124', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(12, 52, 12, '2720168218', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(13, 53, 13, '4717159536', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(14, 54, 14, '1917628127', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(15, 55, 15, '6395595853', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(16, 56, 16, '7167325725', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(17, 57, 17, '1853955985', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(18, 58, 18, '4467335193', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(19, 59, 19, '6809786229', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(20, 60, 20, '1197509120', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(21, 61, 21, '7954393548', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(22, 62, 22, '5046586146', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(23, 63, 23, '9217642983', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(24, 64, 24, '7412910034', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(25, 65, 25, '5202410212', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(26, 66, 26, '4387703692', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(27, 67, 27, '3328574051', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(28, 68, 28, '8104265062', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(29, 69, 29, '7159532093', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(30, 70, 30, '9099582178', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(31, 81, 18, '123123123', '2024-10-19 01:41:36', '2024-10-19 01:41:36', NULL),
(32, 82, 9, '33333', '2024-10-19 01:43:37', '2024-10-19 02:08:41', NULL),
(33, 86, 19, '444444', '2024-10-19 17:09:00', '2024-10-19 17:09:20', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `people`
--

CREATE TABLE `people` (
  `id` bigint UNSIGNED NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `gender` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `people`
--

INSERT INTO `people` (`id`, `document`, `first_name`, `last_name`, `phone`, `email`, `birth_date`, `gender`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '87490773', 'Craig', 'Hoeger', '425-359-2469', 'eileen73@example.org', '2020-09-01', 'M', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(2, '95036162', 'Kaycee', 'Hayes', '+1-224-977-3391', 'ryan.deangelo@example.net', '1988-02-20', 'M', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(3, '07903134', 'Matilda', 'Heaney', '+1.828.834.4045', 'raynor.kaya@example.net', '1994-08-22', 'M', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(4, '12643921', 'Roberto', 'Rosenbaum', '779-348-1996', 'xlesch@example.com', '1985-06-26', 'M', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(5, '42661174', 'Odell', 'Padberg', '+1-336-870-5623', 'mclaughlin.derrick@example.org', '1975-06-13', 'F', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(6, '72204633', 'Humberto', 'Stiedemann', '+1-605-943-9189', 'diamond.schoen@example.net', '1988-06-09', 'M', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(7, '72511057', 'Margarete', 'Daniel', '+1-234-232-5440', 'cartwright.matteo@example.com', '2013-06-03', 'M', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(8, '61804689', 'Amelia', 'Jacobs', '+1-385-818-7042', 'chelsie.barrows@example.com', '1983-08-16', 'M', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(9, '06292871', 'Nikolas', 'Rohan', '(854) 631-5420', 'michel.friesen@example.net', '1979-11-25', 'M', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(10, '35730066', 'Ford', 'Boyle', '715.384.6866', 'gottlieb.halie@example.org', '1985-04-08', 'M', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(11, '64730997', 'Kennith', 'Corwin', '+1 (808) 973-1695', 'jeremy.spencer@example.org', '1991-09-09', 'F', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(12, '17060532', 'Ephraim', 'Hills', '+1-405-383-6383', 'blindgren@example.com', '2020-02-02', 'M', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(13, '31512938', 'Lorenza', 'Pfeffer', '984-203-3818', 'kemmer.brayan@example.com', '1999-09-14', 'F', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(14, '33607728', 'Americo', 'Stark', '1-740-423-7522', 'kilback.matteo@example.org', '2006-12-24', 'F', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(15, '70111700', 'Riley', 'Wunsch', '+19286123631', 'adrien43@example.com', '2010-01-28', 'M', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(16, '37826607', 'Laurianne', 'Jacobson', '1-743-577-2088', 'lauretta.harris@example.com', '1987-08-24', 'F', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(17, '77510031', 'Addie', 'Wolff', '(930) 467-1350', 'ondricka.tristian@example.net', '1990-06-11', 'M', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(18, '64369689', 'Alphonso', 'Daugherty', '+1-929-558-2520', 'imayer@example.net', '1978-10-05', 'F', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(19, '90270114', 'Shania', 'Welch', '+1 (934) 419-8818', 'abernathy.ella@example.net', '1988-01-02', 'M', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(20, '97213530', 'Aditya', 'Gerhold', '412.234.5644', 'jabernathy@example.com', '2022-04-01', 'F', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(21, '76959425', 'Dena', 'Halvorson', '+1 (808) 644-2946', 'umccullough@example.net', '1985-09-09', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(22, '70237340', 'Russel', 'Auer', '1-276-919-3452', 'aaufderhar@example.org', '1993-12-18', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(23, '83852620', 'Estrella', 'Donnelly', '281.364.2729', 'aletha.quigley@example.net', '2009-06-02', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(24, '78621890', 'Isac', 'Quitzon', '+1 (743) 377-7587', 'vonrueden.vergie@example.com', '1979-07-10', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(25, '19550201', 'Arielle', 'Hessel', '1-586-927-8110', 'valerie41@example.net', '1979-01-20', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(26, '29398212', 'Gwendolyn', 'Ondricka', '732-974-6106', 'crona.manuel@example.org', '1976-11-06', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(27, '80195015', 'Bernard', 'Ward', '+1.567.786.0021', 'mitchell.rodrigo@example.net', '1997-10-22', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(28, '48502312', 'Enola', 'Jast', '1-617-596-3214', 'graciela.weber@example.org', '2010-09-29', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(29, '44885878', 'Benedict', 'Bauch', '(651) 741-9661', 'nitzsche.onie@example.net', '2003-02-14', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(30, '59025165', 'Cleta', 'Borer', '+1.432.815.0337', 'easter.braun@example.org', '2009-04-17', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(31, '08883640', 'Pat', 'Halvorson', '(618) 561-5901', 'nola43@example.net', '1974-03-14', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(32, '33132684', 'Matilda', 'Hackett', '201-757-8429', 'jnienow@example.net', '1991-06-18', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(33, '57240793', 'Desmond', 'Stamm', '+1 (219) 635-4495', 'medhurst.misael@example.com', '1990-01-06', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(34, '42129032', 'Kaia', 'Lehner', '1-678-586-9926', 'maximillia81@example.org', '2021-10-16', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(35, '11310184', 'Gunner', 'Bartell', '+1 (706) 507-1643', 'bradford31@example.com', '1977-06-15', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(36, '71451350', 'Dakota', 'Labadie', '+1.312.615.7785', 'camilla08@example.org', '2022-07-30', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(37, '59916041', 'Dedric', 'Russel', '425-340-4940', 'jaren92@example.com', '1979-08-28', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(38, '58599956', 'Gilberto', 'Altenwerth', '+16288845898', 'elisha.hettinger@example.org', '1985-02-13', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(39, '36493481', 'Carissa', 'Mills', '1-352-780-3079', 'bartell.cristopher@example.org', '1977-11-10', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(40, '97469397', 'Nova', 'Lesch', '+1 (832) 245-5180', 'kristopher40@example.com', '1975-12-23', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(41, '64274224', 'Destiny', 'Witting', '1-828-752-7286', 'casper.ezra@example.org', '1974-06-18', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(42, '42027280', 'Brenden', 'Stehr', '228-788-6394', 'gklocko@example.org', '2008-06-07', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(43, '69597752', 'Coleman', 'Larson', '(240) 570-4973', 'hudson.vito@example.com', '1975-02-21', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(44, '17746379', 'Norene', 'O\'Hara', '628.568.1515', 'milan.bernhard@example.org', '1999-03-04', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(45, '44489763', 'Verona', 'Larkin', '+1-520-243-7682', 'danyka80@example.com', '2021-03-18', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(46, '55534230', 'Mikel', 'Volkman', '+1 (774) 331-5574', 'halvorson.trycia@example.net', '1996-01-10', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(47, '16501392', 'Susan', 'Medhurst', '+1-470-918-5477', 'jabari.upton@example.org', '2018-02-26', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(48, '20778522', 'Elroy', 'Ryan', '401.489.4079', 'christy.kohler@example.com', '2019-09-07', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(49, '16106699', 'Cristian', 'Hagenes', '+12296976553', 'clay18@example.net', '1981-11-02', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(50, '18979859', 'Susana', 'Cassin', '+1.848.952.1557', 'mariah.kuphal@example.com', '1974-04-24', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(51, '88510525', 'Albert', 'Nolan', '231-326-2579', 'blick.casandra@example.org', '2018-12-25', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(52, '75187784', 'Murl', 'Sanford', '1-929-420-7852', 'hyatt.raymond@example.net', '2010-09-14', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(53, '34144917', 'Francesca', 'Brekke', '+13329502337', 'karelle.bergnaum@example.com', '1980-04-06', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(54, '43250802', 'Emmie', 'Kris', '+1-626-521-3966', 'poreilly@example.com', '2017-11-25', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(55, '02793152', 'Kyler', 'Rohan', '210-238-7149', 'charlie65@example.com', '1996-11-07', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(56, '08253898', 'Aliya', 'Adams', '1-727-394-2277', 'wilton82@example.net', '2002-01-18', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(57, '50514552', 'Lavonne', 'Beahan', '+1.937.297.9199', 'megane90@example.org', '1979-08-24', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(58, '12661796', 'Willard', 'Larson', '269.324.0030', 'terrence86@example.net', '1975-05-16', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(59, '21419262', 'Laurel', 'Doyle', '1-352-789-3455', 'parker.torp@example.com', '2022-07-17', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(60, '84143340', 'Rebeka', 'Torphy', '484.988.1914', 'phowe@example.com', '2004-08-17', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(61, '62459394', 'Shawn', 'Beatty', '341.256.7456', 'mkris@example.org', '1992-10-07', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(62, '03579776', 'Alexis', 'Reichert', '+1-858-871-6834', 'palma.leffler@example.org', '1978-03-28', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(63, '16466025', 'Angeline', 'Brakus', '234-731-7574', 'aufderhar.clair@example.com', '1988-06-27', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(64, '29236402', 'Jaden', 'Towne', '1-337-490-2829', 'jessy.marks@example.com', '2015-07-29', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(65, '77752321', 'Kaylie', 'Grimes', '(838) 867-6633', 'treutel.marjolaine@example.org', '1990-03-04', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(66, '15229121', 'Braden', 'Kilback', '+13514849936', 'kreiger.braxton@example.net', '2005-03-23', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(67, '29899791', 'Dayne', 'Wiza', '(231) 505-7743', 'bward@example.com', '2018-06-07', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(68, '19161138', 'Audie', 'Jones', '1-804-226-8078', 'broderick21@example.net', '2020-01-30', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(69, '74182671', 'Andrew', 'Reilly', '+15868727766', 'fterry@example.com', '2023-02-16', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(70, '62644522', 'Cullen', 'Hane', '559.690.8121', 'whills@example.net', '1993-01-06', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(71, '49716861', 'Caesar', 'Feest', '+1.715.585.5642', 'meagan.mitchell@example.com', '2014-09-06', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(72, '68146760', 'Sheldon', 'Maggio', '+1-520-633-5371', 'odie.ward@example.net', '2011-07-08', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(73, '84118191', 'Crawford', 'Stanton', '678.470.4574', 'willis37@example.org', '1994-09-02', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(74, '23874760', 'Jermaine', 'Welch', '678.512.5350', 'hand.maximillian@example.com', '1984-12-13', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(75, '09586559', 'Devin', 'Kihn', '+1.717.830.0057', 'johnny72@example.com', '2006-05-03', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(76, '94066619', 'Kaylee', 'Pollich', '+1-971-294-9690', 'lavon25@example.net', '2001-12-30', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(77, '57639393', 'Sienna', 'Hudson', '1-304-329-1077', 'rweimann@example.org', '2019-05-13', 'M', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(78, '78011106', 'Anderson', 'Schneider', '+1-760-280-0215', 'sadye73@example.com', '2018-12-11', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(79, '90657214', 'Vickie', 'Trantow', '+1.986.643.8349', 'berry.towne@example.net', '1995-08-13', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(80, '94689007', 'Selmer', 'Koepp', '984-502-4093', 'keanu49@example.org', '2007-09-08', 'F', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(81, '134245345', 'asd', 'dsada', '123123456', 'asdasdq@dff.asd', '2024-10-02', 'M', '2024-10-19 01:41:36', '2024-10-19 01:41:36', NULL),
(82, '16189123111', 'Sonia1', 'Tkaczek1', '2625546897411', 'sonialamejor@yahoo.com', '1963-01-16', 'F', '2024-10-19 01:43:37', '2024-10-19 02:10:45', NULL),
(85, '36711419', 'Nahir', 'Abraham', '2613013795', 'nahirabraham.tk@gmail.com', '1992-10-21', 'F', '2024-10-19 02:30:23', '2024-10-19 02:30:23', NULL),
(86, '4444444', '4444', '4444', '21318164444444', '44444sd@asd.asd', '1944-02-01', 'F', '2024-10-19 17:09:00', '2024-10-19 17:09:20', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('UpzQOSMBu97r6zjwoKwNwBvIPoER86qvm4wFqQgg', 23, '172.18.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiaWZZeVRJQXZKOWhvbTJtdU5YWmtJRXp6bXhUbVBJM1N0N0o2U3NUTyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ1OiJodHRwOi8vdHVybm9zLmxvY2FsL2hlYWx0aC1pbnN1cmFuY2VzLzI4L2VkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyMztzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRUcHo4LmpHcWdJYmpXLkhqeTdvMWcuL01QLjR5SmtLOEpLckEzS1VueVdvdER2M1pzNi5aTyI7fQ==', 1729366245);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `specialties`
--

CREATE TABLE `specialties` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `specialties`
--

INSERT INTO `specialties` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Medicina General', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(2, 'Pediatría', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(3, 'Dermatología', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(4, 'Psiquiatría', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(5, 'Nutrición', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(6, 'Psicología', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(7, 'Endocrinología', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(8, 'Ginecología', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(9, 'Oftalmología', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(10, 'Otorrinolaringología', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(11, 'Reumatología', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(12, 'Cardiología', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(13, 'Gastroenterología', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(14, 'Neurología', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(15, 'Medicina Interna', '2024-10-17 01:29:44', '2024-10-17 01:29:44', NULL),
(16, 'Medicina General', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(17, 'Pediatría', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(18, 'Dermatología', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(19, 'Psiquiatría', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(20, 'Nutrición', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(21, 'Psicología', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(22, 'Endocrinología', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(23, 'Ginecología', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(24, 'Oftalmología', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(25, 'Otorrinolaringología', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(26, 'Reumatología', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(27, 'Cardiología', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(28, 'Gastroenterología', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(29, 'Neurología', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(30, 'Medicina Interna', '2024-10-17 01:49:18', '2024-10-17 01:49:18', NULL),
(31, 'Podología', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `staff`
--

CREATE TABLE `staff` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `person_id` bigint UNSIGNED NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(23, 'Andrés', 'andres.mza25@gmail.com', '2024-10-17 01:49:18', '$2y$12$Tpz8.jGqgIbjW.Hjy7o1g./MP.4yJkK8JKrA3KUnyWotDv3Zs6.ZO', NULL, NULL, NULL, 'QOEwppSLec', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(24, 'Elouise Ernser', 'jairo.windler@example.org', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'rZbfZgGks6', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(25, 'Jo Bauch III', 'baumbach.erling@example.net', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, '9rk8Fz40Ja', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(26, 'Burdette Glover', 'rau.connor@example.org', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'iXG3ZgD6Gi', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(27, 'Prof. Fidel Emmerich', 'muhammad.braun@example.net', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'Za6Pj2Im2k', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(28, 'Zion Bruen', 'kylee.pouros@example.com', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'AOTRAof3O4', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(29, 'Mrs. Sister Brekke', 'rutherford.bell@example.net', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'X12q181UC4', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(30, 'Mr. Vincenzo Mueller Jr.', 'russel.jackeline@example.com', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, '4C9qh3xXbk', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(31, 'Dr. Ahmad Mitchell', 'zboncak.marques@example.net', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'rgTHlqcFpA', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(32, 'Benjamin Larkin', 'michaela.borer@example.org', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'ICAOk0G6ip', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(33, 'Robb Crona', 'consuelo68@example.com', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'isvAMZTpiR', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(34, 'Mrs. Hailie DuBuque', 'hroberts@example.org', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'EyxA0GkPN7', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(35, 'Miss Viva Kertzmann V', 'rbode@example.org', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'rD4isITfxf', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(36, 'Oceane McGlynn', 'cgottlieb@example.net', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'SKlrg0CChF', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(37, 'Dr. Angelica Luettgen', 'qstanton@example.org', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'D4GE23yPBK', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(38, 'Brendan Wintheiser', 'marvin.elna@example.org', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'ajS3Iu9J7O', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(39, 'Chester Kuvalis', 'ejacobs@example.org', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, '1Czi778Kds', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(40, 'Maritza Balistreri', 'oreynolds@example.org', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'xwHC3BZ1gY', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(41, 'Christina Altenwerth', 'tanner.batz@example.org', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, '5hkZyHjIv2', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(42, 'Joana Anderson', 'carmella57@example.com', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'MK2eAeDWNk', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(43, 'Lyric Champlin V', 'judd.nolan@example.com', '2024-10-17 01:49:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'zbXdFgS5NX', NULL, NULL, '2024-10-17 01:49:18', '2024-10-17 01:49:18'),
(46, 'Nahir Abraham', 'nahirabraham.tk@gmail.com', NULL, '$2y$12$iGMFjn4dtFgPqW9PRDq0.uK0IP38Bq9uis4GGl5/.YqwYjtavD4gC', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-19 02:30:23', '2024-10-19 02:30:23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_patient_id_foreign` (`patient_id`),
  ADD KEY `appointments_doctor_id_foreign` (`doctor_id`),
  ADD KEY `appointments_medical_office_id_foreign` (`medical_office_id`),
  ADD KEY `appointments_operator_id_foreign` (`operator_id`);

--
-- Indices de la tabla `clinic_schedules`
--
ALTER TABLE `clinic_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clinic_schedules_medical_office_id_foreign` (`medical_office_id`);

--
-- Indices de la tabla `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_user_id_foreign` (`user_id`),
  ADD KEY `doctors_person_id_foreign` (`person_id`),
  ADD KEY `doctors_specialty_id_foreign` (`specialty_id`);

--
-- Indices de la tabla `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_schedules_doctor_id_foreign` (`doctor_id`),
  ADD KEY `doctor_schedules_clinic_schedule_id_foreign` (`clinic_schedule_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `health_insurances`
--
ALTER TABLE `health_insurances`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medical_histories`
--
ALTER TABLE `medical_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medical_histories_patient_id_foreign` (`patient_id`),
  ADD KEY `medical_histories_doctor_id_foreign` (`doctor_id`);

--
-- Indices de la tabla `medical_offices`
--
ALTER TABLE `medical_offices`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patients_person_id_foreign` (`person_id`),
  ADD KEY `patients_health_insurance_id_foreign` (`health_insurance_id`);

--
-- Indices de la tabla `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `people_document_unique` (`document`),
  ADD UNIQUE KEY `people_email_unique` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_user_id_foreign` (`user_id`),
  ADD KEY `staff_person_id_foreign` (`person_id`);

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
-- AUTO_INCREMENT de la tabla `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clinic_schedules`
--
ALTER TABLE `clinic_schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `health_insurances`
--
ALTER TABLE `health_insurances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `medical_histories`
--
ALTER TABLE `medical_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medical_offices`
--
ALTER TABLE `medical_offices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `people`
--
ALTER TABLE `people`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `specialties`
--
ALTER TABLE `specialties`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_medical_office_id_foreign` FOREIGN KEY (`medical_office_id`) REFERENCES `medical_offices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `clinic_schedules`
--
ALTER TABLE `clinic_schedules`
  ADD CONSTRAINT `clinic_schedules_medical_office_id_foreign` FOREIGN KEY (`medical_office_id`) REFERENCES `medical_offices` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctors_specialty_id_foreign` FOREIGN KEY (`specialty_id`) REFERENCES `specialties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  ADD CONSTRAINT `doctor_schedules_clinic_schedule_id_foreign` FOREIGN KEY (`clinic_schedule_id`) REFERENCES `clinic_schedules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctor_schedules_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `medical_histories`
--
ALTER TABLE `medical_histories`
  ADD CONSTRAINT `medical_histories_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medical_histories_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_health_insurance_id_foreign` FOREIGN KEY (`health_insurance_id`) REFERENCES `health_insurances` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `patients_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `staff_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
