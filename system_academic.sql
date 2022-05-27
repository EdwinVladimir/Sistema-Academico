-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2021 a las 02:56:49
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `system_academic`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dni_al` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_al` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ape_al` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lnac_al` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fnac_al` date NOT NULL,
  `tiposangre_id` bigint(20) UNSIGNED NOT NULL,
  `tipogrado_id` bigint(20) UNSIGNED NOT NULL,
  `especialidad_id` bigint(20) UNSIGNED NOT NULL,
  `reparto_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `dni_al`, `nom_al`, `ape_al`, `lnac_al`, `fnac_al`, `tiposangre_id`, `tipogrado_id`, `especialidad_id`, `reparto_id`, `created_at`, `updated_at`) VALUES
(1, '1804777595', 'Edwin Vladimir', 'Guano Cunalata', 'Guayaquil', '2021-08-31', 1, 1, 1, 1, '2021-09-30 01:13:47', '2021-09-30 01:13:47'),
(2, '1597532587', 'Juan Gabriel', 'Yánez Ramírez', 'Guayaquil', '2021-09-08', 1, 1, 1, 1, '2021-09-30 01:14:17', '2021-09-30 01:14:17'),
(3, '8521479632', 'Andres Paul', 'Sanchez Carrasco', 'Guayaquil', '2021-09-29', 1, 1, 1, 1, '2021-09-30 01:14:49', '2021-09-30 01:14:49'),
(4, '3217894561', 'Jaime Francisco', 'Aguayo González', 'Guayaquil', '2008-06-03', 5, 1, 1, 2, '2021-10-01 06:39:34', '2021-10-01 06:39:34'),
(5, '8521597535', 'Ruth Silvana', 'Cortés Lagunes', 'Ambato', '2021-08-31', 1, 2, 1, 3, '2021-10-01 06:40:24', '2021-10-01 06:40:24'),
(6, '9871236545', 'Karla Paulette', 'García Arreguín', 'Loja', '2021-09-02', 5, 3, 3, 2, '2021-10-01 06:41:05', '2021-10-01 06:41:05'),
(7, '8521594565', 'José Ignacio', 'Gómez Vargas', 'Lago Agrio', '2021-09-09', 5, 3, 4, 5, '2021-10-01 06:41:52', '2021-10-01 06:41:52'),
(8, '1598524568', 'Jaime Daniel', 'Hernández Palacios', 'Ambato', '2021-09-17', 6, 6, 3, 2, '2021-10-01 06:42:46', '2021-10-01 06:42:46'),
(9, '1524975843', 'Eduardo Elihu', 'Nuñez Garcia', 'Quito', '2021-09-08', 3, 2, 3, 2, '2021-10-01 06:43:25', '2021-10-01 06:43:25'),
(10, '8521597534', 'Pablo Yamild', 'Rosiles Loeza', 'Guayaquil', '2021-09-30', 1, 1, 6, 2, '2021-10-01 06:47:13', '2021-10-01 06:47:13'),
(22, '47718442', 'wilber', 'cahuana moreano', 'Abancay', '2021-10-22', 1, 1, 1, 1, '2021-10-23 07:05:20', '2021-10-23 07:05:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignadocs`
--

CREATE TABLE `asignadocs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `docente_id` bigint(20) UNSIGNED NOT NULL,
  `periodo_id` bigint(20) UNSIGNED NOT NULL,
  `seccion_id` bigint(20) UNSIGNED NOT NULL,
  `curso_id` bigint(20) NOT NULL,
  `materia_id` bigint(20) UNSIGNED NOT NULL,
  `aula_id` bigint(20) UNSIGNED NOT NULL,
  `porcentaje_individual` decimal(6,2) NOT NULL,
  `porcentaje_grupal` decimal(6,2) NOT NULL,
  `porcentaje_actitudinal` decimal(6,2) NOT NULL,
  `estado` enum('Asignado','Planificado') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asignadocs`
--

INSERT INTO `asignadocs` (`id`, `docente_id`, `periodo_id`, `seccion_id`, `curso_id`, `materia_id`, `aula_id`, `porcentaje_individual`, `porcentaje_grupal`, `porcentaje_actitudinal`, `estado`, `created_at`, `updated_at`) VALUES
(6, 1, 3, 1, 4, 13, 1, '0.00', '0.00', '0.00', 'Asignado', '2021-10-01 07:14:57', '2021-10-01 07:14:57'),
(7, 2, 3, 1, 6, 11, 1, '60.00', '40.00', '10.00', 'Asignado', '2021-10-01 07:15:27', '2021-10-14 18:53:13'),
(8, 3, 3, 1, 4, 10, 1, '0.00', '0.00', '0.00', 'Asignado', '2021-10-01 07:15:53', '2021-10-01 07:15:53'),
(9, 4, 3, 1, 5, 7, 1, '0.00', '0.00', '0.00', 'Asignado', '2021-10-01 07:16:48', '2021-10-01 07:16:48'),
(10, 5, 3, 1, 5, 5, 1, '0.00', '0.00', '0.00', 'Asignado', '2021-10-01 07:18:36', '2021-10-01 07:18:36'),
(11, 6, 3, 1, 4, 4, 1, '0.00', '0.00', '0.00', 'Asignado', '2021-10-01 07:19:11', '2021-10-01 07:19:11'),
(12, 3, 3, 1, 7, 13, 2, '0.00', '0.00', '0.00', 'Asignado', '2021-10-01 07:39:24', '2021-10-01 07:39:24'),
(13, 4, 4, 1, 1, 5, 2, '0.00', '0.00', '0.00', 'Asignado', '2021-10-01 07:40:40', '2021-10-01 07:40:40'),
(14, 5, 3, 1, 7, 2, 2, '0.00', '0.00', '0.00', 'Asignado', '2021-10-01 07:41:09', '2021-10-01 07:41:09'),
(15, 1, 5, 1, 1, 2, 1, '0.00', '0.00', '0.00', 'Asignado', '2021-10-02 19:39:02', '2021-10-02 19:39:02'),
(16, 1, 5, 1, 4, 13, 2, '0.00', '0.00', '0.00', 'Asignado', '2021-10-02 19:39:30', '2021-10-02 19:39:30'),
(17, 1, 5, 1, 6, 2, 1, '0.00', '0.00', '0.00', 'Asignado', '2021-10-02 19:41:08', '2021-10-02 19:41:08'),
(18, 1, 5, 2, 7, 13, 1, '0.00', '0.00', '0.00', 'Asignado', '2021-10-02 19:42:07', '2021-10-02 19:42:07'),
(21, 13, 5, 1, 1, 2, 1, '60.00', '30.00', '10.00', 'Planificado', '2021-10-23 17:10:43', '2021-10-30 06:24:53'),
(23, 1, 5, 1, 1, 2, 1, '50.00', '45.00', '5.00', 'Asignado', '2021-10-25 21:09:12', '2021-10-25 21:09:12'),
(24, 2, 5, 3, 5, 5, 3, '60.00', '30.00', '10.00', 'Asignado', '2021-10-25 21:11:12', '2021-10-25 21:11:12'),
(25, 13, 3, 1, 1, 2, 1, '60.00', '30.00', '10.00', 'Planificado', '2021-10-27 19:51:59', '2021-10-30 06:28:05'),
(26, 13, 2, 1, 4, 13, 1, '60.00', '30.00', '10.00', 'Asignado', '2021-10-30 21:06:55', '2021-10-30 21:06:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cod_aul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_aul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`id`, `cod_aul`, `num_aul`, `created_at`, `updated_at`) VALUES
(1, 'A001', 'A1', '2021-09-30 01:10:12', '2021-09-30 01:10:12'),
(2, 'A001', 'A2', '2021-09-30 01:10:17', '2021-09-30 01:10:17'),
(3, 'A003', 'A3', '2021-10-01 06:12:06', '2021-10-01 06:12:06'),
(4, 'A004', 'A4', '2021-10-01 06:12:20', '2021-10-01 06:12:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cod_cur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_cur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `narea_cur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nhor_cur` int(11) NOT NULL,
  `ejecurso_id` bigint(20) UNSIGNED NOT NULL,
  `tipocurso_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `cod_cur`, `nom_cur`, `narea_cur`, `nhor_cur`, `ejecurso_id`, `tipocurso_id`, `created_at`, `updated_at`) VALUES
(1, 'A001', 'CURSO DE NAVEGACION AEREA', 'Sociales', 25, 1, 1, '2021-09-30 01:12:25', '2021-09-30 01:12:25'),
(4, 'A002', 'CURSO DE TRANSITO AÉREO', 'Sociales', 180, 1, 1, '2021-10-01 06:28:32', '2021-10-01 06:28:32'),
(5, 'A003', 'CURSO CONTROL DE SUPERFICIE DE AERODROMO', 'Sociales', 50, 1, 2, '2021-10-01 06:29:19', '2021-10-01 06:29:19'),
(6, 'A004', 'CURSO DE ADOCTRINAMIENTO EN EL TRABAJO', 'Sociales', 100, 1, 1, '2021-10-01 06:30:18', '2021-10-01 06:30:18'),
(7, 'A005', 'CURSO  SUPERVISORES DE AERODROMO', 'Sociales', 100, 1, 2, '2021-10-01 06:33:11', '2021-10-01 06:33:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_materia`
--

CREATE TABLE `curso_materia` (
  `materia_id` bigint(20) UNSIGNED NOT NULL,
  `curso_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `curso_materia`
--

INSERT INTO `curso_materia` (`materia_id`, `curso_id`) VALUES
(2, 1),
(1, 1),
(3, 1),
(5, 1),
(13, 4),
(11, 4),
(10, 4),
(7, 4),
(5, 4),
(4, 4),
(1, 5),
(5, 5),
(3, 5),
(7, 5),
(9, 5),
(2, 6),
(3, 6),
(8, 6),
(9, 6),
(11, 6),
(13, 7),
(5, 7),
(2, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalplanevas`
--

CREATE TABLE `detalplanevas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipoact_acti` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descrip_detac` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poreva_detac` int(11) DEFAULT 0,
  `planeva_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalplanevas`
--

INSERT INTO `detalplanevas` (`id`, `tipoact_acti`, `descrip_detac`, `poreva_detac`, `planeva_id`, `created_at`, `updated_at`) VALUES
(36, 'Aporte individual', 'tarea1', NULL, 28, '2021-10-11 20:12:05', '2021-10-11 20:12:05'),
(37, 'Aporte grupal', 'tarea1', NULL, 29, '2021-10-11 20:18:14', '2021-10-11 20:18:14'),
(38, 'Aporte individual', 'tarea2', NULL, 30, '2021-10-11 20:18:28', '2021-10-11 20:18:28'),
(39, 'Aporte grupal', 'tarea2', NULL, 31, '2021-10-11 20:18:38', '2021-10-11 20:18:38'),
(40, 'Aporte actitudinal', 'tarea', NULL, 32, '2021-10-11 20:18:58', '2021-10-11 20:18:58'),
(42, 'Aporte individual', 'tarea1', NULL, 34, '2021-10-23 17:25:59', '2021-10-23 17:25:59'),
(43, 'Aporte grupal', 'tarea1', NULL, 35, '2021-10-23 17:26:16', '2021-10-23 17:26:16'),
(44, 'Aporte grupal', 'tarea2', NULL, 36, '2021-10-23 17:26:32', '2021-10-23 17:26:32'),
(45, 'Aporte actitudinal', 'tareas', NULL, 37, '2021-10-23 17:26:46', '2021-10-23 17:26:46'),
(46, 'Aporte actitudinal', 'asistencia', NULL, 38, '2021-10-23 17:26:56', '2021-10-23 17:26:56'),
(49, 'Aporte actitudinal', 'asistencia', NULL, 41, '2021-10-28 21:34:14', '2021-10-30 06:24:09'),
(50, 'Aporte individual', 'tarea2', NULL, 42, '2021-10-30 06:24:02', '2021-10-30 06:24:02'),
(51, 'Aporte individual', 'tarea1', NULL, 43, '2021-10-30 06:24:28', '2021-10-30 06:24:28'),
(52, 'Aporte grupal', 'tarea1', NULL, 44, '2021-10-30 06:24:42', '2021-10-30 06:24:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dni_doc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_doc` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ape_doc` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instt_docp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cobt_doc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lnac_doc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fnac_doc` date NOT NULL,
  `tiposangre_id` bigint(20) UNSIGNED NOT NULL,
  `tipogrado_id` bigint(20) UNSIGNED NOT NULL,
  `especialidad_id` bigint(20) UNSIGNED NOT NULL,
  `reparto_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id`, `dni_doc`, `nom_doc`, `ape_doc`, `instt_docp`, `cobt_doc`, `lnac_doc`, `fnac_doc`, `tiposangre_id`, `tipogrado_id`, `especialidad_id`, `reparto_id`, `created_at`, `updated_at`) VALUES
(1, '8521479632', 'Elizabeth Rocio', 'Suarez Aman', 'ESPE', '19', 'Guayaquil', '2021-09-09', 1, 10, 1, 8, '2021-09-30 01:15:44', '2021-10-01 06:49:21'),
(2, '18047775455', 'Juan Carlos', 'Alvarado Carrasco', 'ESPE', '19', 'Guayaquil', '2021-09-02', 1, 1, 2, 1, '2021-09-30 01:16:28', '2021-09-30 01:16:28'),
(3, '8521597534', 'Daniela Ivette', 'Vega Hernández', 'ESPE', '20', 'Guayaquil', '2021-09-09', 2, 5, 8, 4, '2021-10-01 06:50:55', '2021-10-01 06:50:55'),
(4, '8529637535', 'Alejandra Berenice', 'Ornelas Guzmán', 'DGAC', '19', 'Guayaquil', '2021-09-01', 4, 10, 3, 8, '2021-10-01 06:52:23', '2021-10-01 06:52:23'),
(5, '8527418415', 'Jessica Liliana', 'Moreno Huitrón', 'ESPE', '19', 'Ambato', '2021-09-02', 2, 7, 6, 2, '2021-10-01 06:53:24', '2021-10-01 06:53:24'),
(6, '5000124575', 'Luis Fernando', 'Herrera Arias', 'Ninguna', '19', 'Ambato', '2021-09-23', 3, 9, 3, 2, '2021-10-01 06:54:52', '2021-10-01 06:54:52'),
(13, '47718442', 'wilber', 'cahuana moreano', 'Abancay', '----', 'Abancay', '2021-10-22', 1, 1, 1, 1, '2021-10-23 07:08:45', '2021-10-23 07:08:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejecursos`
--

CREATE TABLE `ejecursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_ejecurso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_ejecurso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ejecursos`
--

INSERT INTO `ejecursos` (`id`, `nom_ejecurso`, `desc_ejecurso`, `created_at`, `updated_at`) VALUES
(1, 'Ciencia militar', 'Ciencia militar', '2021-09-30 01:08:44', '2021-09-30 01:08:44'),
(2, 'Cultura militar', 'Cultura militar', '2021-09-30 01:09:01', '2021-09-30 01:09:01'),
(3, 'Ciencia Tecnologica', 'Tecnologia', '2021-10-01 06:09:41', '2021-10-01 06:09:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidads`
--

CREATE TABLE `especialidads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_especialidad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_especialidad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `especialidads`
--

INSERT INTO `especialidads` (`id`, `nom_especialidad`, `desc_especialidad`, `created_at`, `updated_at`) VALUES
(1, 'Defensa Aérea', 'Defensa aerea', '2021-09-30 01:06:49', '2021-09-30 01:06:49'),
(2, 'Navegación Aérea', 'Navegación', '2021-09-30 01:06:59', '2021-09-30 01:06:59'),
(3, 'Controlador de transito Aéreo', 'Controlador de transito Aéreo', '2021-10-01 06:00:47', '2021-10-01 06:00:47'),
(4, 'Navegación Aérea', 'Navegación Aérea', '2021-10-01 06:00:56', '2021-10-01 06:00:56'),
(5, 'Electrogeneradores', 'Electrogeneradores', '2021-10-01 06:03:26', '2021-10-01 06:03:26'),
(6, 'Transportación Terrestre', 'Transportación Terrestre', '2021-10-01 06:03:39', '2021-10-01 06:03:39'),
(7, 'Sanidad', 'Sanidad', '2021-10-01 06:03:50', '2021-10-01 06:03:50'),
(8, 'Comunicación Social', 'Comunicación Social', '2021-10-01 06:04:05', '2021-10-01 06:04:05'),
(9, 'Omitido', 'Ninguno', '2021-10-01 06:33:59', '2021-10-01 06:33:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacions`
--

CREATE TABLE `evaluacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecreg_eval` date NOT NULL,
  `nota_deteva` int(11) DEFAULT 0,
  `alumno_id` bigint(20) UNSIGNED NOT NULL,
  `periodo_id` bigint(20) UNSIGNED NOT NULL,
  `materia_id` bigint(20) UNSIGNED NOT NULL,
  `detalplaneva_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `evaluacions`
--

INSERT INTO `evaluacions` (`id`, `fecreg_eval`, `nota_deteva`, `alumno_id`, `periodo_id`, `materia_id`, `detalplaneva_id`, `created_at`, `updated_at`) VALUES
(160, '2021-10-30', 11, 1, 5, 2, 42, '2021-10-30 06:24:53', '2021-10-30 20:21:17'),
(161, '2021-10-30', 12, 1, 5, 2, 43, '2021-10-30 06:24:53', '2021-10-30 06:34:02'),
(162, '2021-10-30', 11, 1, 5, 2, 44, '2021-10-30 06:24:53', '2021-10-30 06:34:07'),
(163, '2021-10-30', 14, 1, 5, 2, 45, '2021-10-30 06:24:53', '2021-10-30 06:34:10'),
(164, '2021-10-30', 15, 1, 5, 2, 46, '2021-10-30 06:24:53', '2021-10-30 06:34:11'),
(165, '2021-10-30', 8, 10, 5, 2, 42, '2021-10-30 06:24:53', '2021-10-30 06:34:14'),
(166, '2021-10-30', 15, 10, 5, 2, 43, '2021-10-30 06:24:53', '2021-10-30 06:34:16'),
(167, '2021-10-30', 13, 10, 5, 2, 44, '2021-10-30 06:24:53', '2021-10-30 06:34:18'),
(168, '2021-10-30', 13, 10, 5, 2, 45, '2021-10-30 06:24:53', '2021-10-30 06:34:21'),
(169, '2021-10-30', 16, 10, 5, 2, 46, '2021-10-30 06:24:53', '2021-10-30 06:34:22'),
(170, '2021-10-30', 0, 1, 3, 2, 49, '2021-10-30 06:28:06', '2021-10-30 06:28:06'),
(171, '2021-10-30', 0, 1, 3, 2, 50, '2021-10-30 06:28:06', '2021-10-30 06:28:06'),
(172, '2021-10-30', 0, 1, 3, 2, 51, '2021-10-30 06:28:06', '2021-10-30 06:28:06'),
(173, '2021-10-30', 0, 1, 3, 2, 52, '2021-10-30 06:28:06', '2021-10-30 06:28:06'),
(174, '2021-10-30', 0, 8, 3, 2, 49, '2021-10-30 06:28:06', '2021-10-30 06:28:06'),
(175, '2021-10-30', 0, 8, 3, 2, 50, '2021-10-30 06:28:06', '2021-10-30 06:28:06'),
(176, '2021-10-30', 0, 8, 3, 2, 51, '2021-10-30 06:28:06', '2021-10-30 06:28:06'),
(177, '2021-10-30', 0, 8, 3, 2, 52, '2021-10-30 06:28:06', '2021-10-30 06:28:06');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_mat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nhor_mat` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `nom_mat`, `nhor_mat`, `created_at`, `updated_at`) VALUES
(1, 'Transito Aéreo', 25, '2021-09-30 01:11:19', '2021-09-30 01:11:19'),
(2, 'Procedimientos operaciones POV', 25, '2021-09-30 01:11:32', '2021-09-30 01:11:32'),
(3, 'Reglamento del aire', 45, '2021-09-30 01:11:55', '2021-09-30 01:11:55'),
(4, 'Servicio de control de tránsito aéreo', 2, '2021-10-01 06:15:45', '2021-10-01 06:15:45'),
(5, 'Control de aerodromo', 25, '2021-10-01 06:16:27', '2021-10-01 06:16:27'),
(6, 'Meteorología Aeronautica', 25, '2021-10-01 06:19:28', '2021-10-01 06:19:28'),
(7, 'Seguridad aérea', 25, '2021-10-01 06:19:41', '2021-10-01 06:19:41'),
(8, 'Seguridad de la aviación para tripulantes', 25, '2021-10-01 06:20:18', '2021-10-01 06:20:18'),
(9, 'Bioseguridad Aérea', 25, '2021-10-01 06:20:40', '2021-10-01 06:20:40'),
(10, 'Servicios de aeropuertos', 35, '2021-10-01 06:21:08', '2021-10-01 06:21:08'),
(11, 'Sistemas y componentes aéreos', 25, '2021-10-01 06:22:01', '2021-10-01 06:22:01'),
(12, 'Simulador de Vuelo', 25, '2021-10-01 06:22:16', '2021-10-01 06:22:16'),
(13, 'Administración de las operaciones', 25, '2021-10-01 06:22:39', '2021-10-01 06:22:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

CREATE TABLE `matriculas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feins_matri` date NOT NULL,
  `periodo_id` bigint(20) UNSIGNED NOT NULL,
  `alumno_id` bigint(20) UNSIGNED NOT NULL,
  `curso_id` bigint(20) UNSIGNED NOT NULL,
  `seccion_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `matriculas`
--

INSERT INTO `matriculas` (`id`, `feins_matri`, `periodo_id`, `alumno_id`, `curso_id`, `seccion_id`, `created_at`, `updated_at`) VALUES
(4, '2021-09-01', 5, 1, 1, 1, '2021-10-01 07:04:05', '2021-10-01 07:04:05'),
(8, '2021-09-01', 5, 10, 1, 1, '2021-10-01 07:07:09', '2021-10-01 07:07:09'),
(9, '2021-09-01', 3, 1, 1, 1, '2021-10-01 07:07:25', '2021-10-01 07:07:25'),
(10, '2021-09-01', 3, 8, 1, 1, '2021-10-01 07:08:00', '2021-10-01 07:08:00'),
(11, '2021-09-01', 3, 7, 6, 1, '2021-10-01 07:08:49', '2021-10-01 07:08:49'),
(12, '2021-09-01', 3, 6, 6, 1, '2021-10-01 07:09:06', '2021-10-01 07:09:06'),
(13, '2021-09-01', 1, 5, 4, 1, '2021-10-01 07:09:58', '2021-10-01 07:09:58'),
(15, '2021-09-30', 3, 3, 6, 1, '2021-10-01 07:10:23', '2021-10-01 07:10:23'),
(16, '2021-09-01', 3, 2, 6, 1, '2021-10-01 07:10:40', '2021-10-01 07:10:40'),
(20, '2021-09-01', 3, 4, 6, 1, '2021-10-01 07:37:00', '2021-10-01 07:37:00'),
(21, '2021-09-01', 3, 5, 6, 1, '2021-10-01 07:37:23', '2021-10-01 07:37:23');

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_03_26_005650_create_tipogrados_table', 1),
(5, '2021_03_26_005743_create_repartos_table', 1),
(6, '2021_03_26_005815_create_especialidads_table', 1),
(7, '2021_03_26_005854_create_tiposangres_table', 1),
(8, '2021_03_27_002816_create_periodos_table', 1),
(9, '2021_03_27_005717_create_tipocursos_table', 1),
(10, '2021_03_27_005922_create_ejecursos_table', 1),
(11, '2021_03_28_002151_create_docentes_table', 1),
(12, '2021_03_28_002234_create_materias_table', 1),
(13, '2021_03_28_002313_create_cursos_table', 1),
(14, '2021_03_28_002515_create_seccions_table', 1),
(15, '2021_03_28_002854_create_planestudios_table', 1),
(16, '2021_03_28_003054_create_aulas_table', 1),
(17, '2021_03_28_005959_create_modalidadcursos_table', 1),
(18, '2021_04_05_154000_create_alumnos_table', 1),
(19, '2021_05_20_185624_create_permission_tables', 1),
(20, '2021_05_21_175330_create_curso_materia_table', 1),
(21, '2021_07_03_002724_create_matriculas_table', 1),
(22, '2021_07_07_002951_create_asignadocs_table', 1),
(23, '2021_07_08_203646_create_planevas_table', 1),
(24, '2021_07_08_203738_create_detalplanevas_table', 1),
(25, '2021_07_08_203911_create_evaluacions_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidadcursos`
--

CREATE TABLE `modalidadcursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_moda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_moda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
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
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE `periodos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ano_per` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peri_per` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finic_per` date NOT NULL,
  `ffin_per` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `periodos`
--

INSERT INTO `periodos` (`id`, `ano_per`, `peri_per`, `finic_per`, `ffin_per`, `created_at`, `updated_at`) VALUES
(1, '2021', 'Abril-Agosto', '2021-09-04', '2021-09-04', '2021-09-30 01:09:47', '2021-09-30 01:09:47'),
(2, '2021', 'Enero-Febrero', '2021-09-29', '2021-09-29', '2021-09-30 01:10:01', '2021-09-30 01:10:01'),
(3, '2021', 'Septiembre-Noviembre', '2021-09-01', '2021-11-15', '2021-10-01 06:36:01', '2021-10-01 06:36:01'),
(4, '2021', 'Agosto-Agosto', '2021-08-09', '2021-08-30', '2021-10-01 06:36:22', '2021-10-01 06:36:22'),
(5, '2021', 'Octubre-Noviembre', '2021-10-01', '2021-11-15', '2021-10-01 06:37:00', '2021-10-01 06:37:00'),
(6, '2020', 'Octubre-Noviembre', '2021-11-01', '2022-01-06', '2021-11-07 21:04:38', '2021-11-07 21:04:38'),
(7, '2021', 'Octubre-Noviembre', '2021-11-07', '2021-12-10', '2021-11-07 21:04:49', '2021-11-07 21:04:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planestudios`
--

CREATE TABLE `planestudios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tit_pla` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descrip_pla` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `archi_pla` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `curso_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planevas`
--

CREATE TABLE `planevas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecent_plaeva` date NOT NULL,
  `docente_id` bigint(20) UNSIGNED NOT NULL,
  `periodo_id` bigint(20) UNSIGNED NOT NULL,
  `materia_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `planevas`
--

INSERT INTO `planevas` (`id`, `fecent_plaeva`, `docente_id`, `periodo_id`, `materia_id`, `created_at`, `updated_at`) VALUES
(28, '2021-10-18', 2, 3, 11, '2021-10-11 20:12:05', '2021-10-11 20:12:05'),
(29, '2021-10-25', 2, 3, 11, '2021-10-11 20:18:14', '2021-10-11 20:18:14'),
(30, '2021-11-01', 2, 3, 11, '2021-10-11 20:18:28', '2021-10-11 20:18:28'),
(31, '2021-11-08', 2, 3, 11, '2021-10-11 20:18:38', '2021-10-11 20:18:38'),
(32, '2021-11-09', 2, 3, 11, '2021-10-11 20:18:58', '2021-10-11 20:18:58'),
(34, '2021-10-25', 13, 5, 2, '2021-10-23 17:25:59', '2021-10-23 17:25:59'),
(35, '2021-10-26', 13, 5, 2, '2021-10-23 17:26:16', '2021-10-23 17:26:16'),
(36, '2021-10-29', 13, 5, 2, '2021-10-23 17:26:32', '2021-10-23 17:26:32'),
(37, '2021-10-30', 13, 5, 2, '2021-10-23 17:26:46', '2021-10-23 17:26:46'),
(38, '2021-10-31', 13, 5, 2, '2021-10-23 17:26:56', '2021-10-23 17:26:56'),
(41, '2021-11-05', 13, 3, 2, '2021-10-28 21:34:14', '2021-10-30 06:24:15'),
(42, '2021-10-30', 13, 3, 2, '2021-10-30 06:24:02', '2021-10-30 06:24:02'),
(43, '2021-10-29', 13, 3, 2, '2021-10-30 06:24:28', '2021-10-30 06:24:28'),
(44, '2021-11-01', 13, 3, 2, '2021-10-30 06:24:42', '2021-10-30 06:24:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `porcentaje_notas`
--

CREATE TABLE `porcentaje_notas` (
  `id` int(11) NOT NULL,
  `porcentaje_individual` decimal(6,2) NOT NULL,
  `porcentaje_grupal` decimal(6,2) NOT NULL,
  `porcentaje_actitudinal` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `porcentaje_notas`
--

INSERT INTO `porcentaje_notas` (`id`, `porcentaje_individual`, `porcentaje_grupal`, `porcentaje_actitudinal`) VALUES
(1, '60.00', '30.00', '10.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repartos`
--

CREATE TABLE `repartos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_reparto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_reparto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `repartos`
--

INSERT INTO `repartos` (`id`, `nom_reparto`, `desc_reparto`, `created_at`, `updated_at`) VALUES
(1, 'COAD', 'Comando de Educación y Doctrina', '2021-09-30 01:06:33', '2021-09-30 01:06:33'),
(2, 'COED', 'Comando de Educación y Doctrina', '2021-10-01 05:57:32', '2021-10-01 05:57:32'),
(3, 'ESMA', 'Escuela de la fuerza aerea', '2021-10-01 05:57:45', '2021-10-01 05:57:45'),
(4, 'ESPE', 'Escuela Superior Politecnica', '2021-10-01 05:57:52', '2021-10-01 05:57:52'),
(5, 'UEFAE', 'Unidad Educativa de la Fuerza Aérea', '2021-10-01 05:58:20', '2021-10-01 05:58:20'),
(6, 'Ala Nro 22', 'Ala de Combate aéreo Nro 22', '2021-10-01 05:58:41', '2021-10-01 05:58:57'),
(7, 'Comando General', 'Comando General', '2021-10-01 05:59:09', '2021-10-01 05:59:09'),
(8, 'Omitido', 'Ninguno', '2021-10-01 06:33:49', '2021-10-01 06:33:49'),
(9, 'COAD', 'wefwef', '2021-11-07 21:25:14', '2021-11-07 21:25:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccions`
--

CREATE TABLE `seccions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cod_sec` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_sec` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `seccions`
--

INSERT INTO `seccions` (`id`, `cod_sec`, `nom_sec`, `created_at`, `updated_at`) VALUES
(1, 'S001', 'OPERACIONES', '2021-09-30 01:10:28', '2021-10-01 06:12:41'),
(2, 'S002', 'LOGISTICA', '2021-09-30 01:10:42', '2021-09-30 01:10:42'),
(3, 'S003', 'ABASTECIMIENTOS', '2021-10-01 06:12:58', '2021-10-01 06:12:58'),
(4, 'S004', 'RR.HH', '2021-10-01 06:13:16', '2021-10-01 06:13:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocursos`
--

CREATE TABLE `tipocursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_curso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_curso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipocursos`
--

INSERT INTO `tipocursos` (`id`, `nom_curso`, `desc_curso`, `created_at`, `updated_at`) VALUES
(1, 'Capacitación', 'Capacitación de nuevas tripulaciones', '2021-09-30 01:08:20', '2021-09-30 01:08:20'),
(2, 'Especialización', 'Especialización de nuevas herramientas', '2021-09-30 01:08:30', '2021-09-30 01:08:30'),
(3, 'Formación', 'Formación de nuevas tripulaciones para el empleo de sistemas aéreos', '2021-10-01 06:08:36', '2021-10-01 06:08:36'),
(4, 'Seminarios', 'Seminarios para nuevas competencias', '2021-10-01 06:09:03', '2021-10-01 06:09:03'),
(5, 'Talleres', 'Talleres de conocimientos', '2021-10-01 06:09:24', '2021-10-01 06:09:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipogrados`
--

CREATE TABLE `tipogrados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_grado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_grado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipogrados`
--

INSERT INTO `tipogrados` (`id`, `nom_grado`, `desc_grado`, `created_at`, `updated_at`) VALUES
(1, 'Cbop', 'Cabo  Primero. Téc. Avc', '2021-09-30 01:07:19', '2021-09-30 01:07:19'),
(2, 'Sldo', 'Soldado. Téc. Avc', '2021-10-01 06:06:36', '2021-10-01 06:06:36'),
(3, 'Sgos', 'Sargento . Téc. Avc', '2021-10-01 06:06:44', '2021-10-01 06:06:44'),
(4, 'Subs', 'Sub Oficial Segundo. Tec. avc', '2021-10-01 06:06:57', '2021-10-01 06:06:57'),
(5, 'Tnte', 'Teniente. Téc. Avc', '2021-10-01 06:07:10', '2021-10-01 06:07:10'),
(6, 'Capt', 'Capitan. Téc. Avc', '2021-10-01 06:07:38', '2021-10-01 06:07:38'),
(7, 'Mayor', 'Mayor Tec. Avc', '2021-10-01 06:08:10', '2021-10-01 06:08:10'),
(8, 'Crnl', 'Coronel. Téc. Avc', '2021-10-01 06:34:27', '2021-10-01 06:34:27'),
(9, 'Subt', 'Subteniente. Tec. Avc', '2021-10-01 06:34:51', '2021-10-01 06:34:51'),
(10, 'Omitido', 'Ninguno', '2021-10-01 06:49:00', '2021-10-01 06:49:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposangres`
--

CREATE TABLE `tiposangres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_sangre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_sangre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tiposangres`
--

INSERT INTO `tiposangres` (`id`, `nom_sangre`, `desc_sangre`, `created_at`, `updated_at`) VALUES
(1, '+O', 'Positivo', '2021-09-30 01:09:14', '2021-09-30 01:09:14'),
(2, '-O', 'Negativo', '2021-09-30 01:09:22', '2021-09-30 01:09:22'),
(3, '+B', 'Negativo', '2021-10-01 06:09:57', '2021-10-01 06:09:57'),
(4, '-O', 'Positivo', '2021-10-01 06:10:06', '2021-10-01 06:10:06'),
(5, '-AB', 'Negativo', '2021-10-01 06:11:09', '2021-10-01 06:11:09'),
(6, '+AB', 'Positivo', '2021-10-01 06:11:24', '2021-10-01 06:11:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_aux` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` enum('Administrador','Docente','Estudiante','Técnico') COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` enum('Activo','Inactivo') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `id_aux`, `name`, `email`, `password`, `rol`, `state`, `created_at`, `updated_at`) VALUES
(8, NULL, 'administrador', 'administrador@gmail.com', '$2y$10$Wh2hD5pjkFHcBZD6f9gX9OTByo3iuSyZXt.u7iawA8e1nGeC/wvTW', 'Administrador', 'Activo', '2021-10-16 07:09:22', '2021-10-16 07:09:22'),
(13, NULL, 'técnico', 'tecnico@gmail.com', '$2y$10$zt6uSTTHeVvNaGpZt2ToZ.y32/QZZSAetNfN89lvod4sxcdLSuO.y', 'Técnico', 'Activo', '2021-10-21 20:46:45', '2021-10-27 19:49:41'),
(19, 22, 'wilber cahuana moreano', 'wilcm123@gmail.com', '$2y$10$ccwJZAfBqoGTUUlAG8013.fZJmJCcgs8j/miKO4fr1zkoAGB/OgK.', 'Estudiante', 'Activo', '2021-10-23 07:05:20', '2021-10-23 07:05:20'),
(20, 13, 'wilber cahuana moreano', 'wilcm123@gmail.com', '$2y$10$E11WWBn78qv99amjr3fOHOWPOQWJQ10kOvAdPr1e6fKlSn7T67XCy', 'Docente', 'Activo', '2021-10-23 07:08:45', '2021-10-23 07:08:45');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumnos_especialidad_id_foreign` (`especialidad_id`),
  ADD KEY `alumnos_tiposangre_id_foreign` (`tiposangre_id`),
  ADD KEY `alumnos_tipogrado_id_foreign` (`tipogrado_id`),
  ADD KEY `alumnos_reparto_id_foreign` (`reparto_id`);

--
-- Indices de la tabla `asignadocs`
--
ALTER TABLE `asignadocs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asignadocs_docente_id_foreign` (`docente_id`),
  ADD KEY `asignadocs_periodo_id_foreign` (`periodo_id`),
  ADD KEY `asignadocs_seccion_id_foreign` (`seccion_id`),
  ADD KEY `asignadocs_materia_id_foreign` (`materia_id`),
  ADD KEY `asignadocs_aula_id_foreign` (`aula_id`);

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cursos_ejecurso_id_foreign` (`ejecurso_id`),
  ADD KEY `cursos_tipocurso_id_foreign` (`tipocurso_id`);

--
-- Indices de la tabla `curso_materia`
--
ALTER TABLE `curso_materia`
  ADD KEY `curso_materia_materia_id_foreign` (`materia_id`),
  ADD KEY `curso_materia_curso_id_foreign` (`curso_id`);

--
-- Indices de la tabla `detalplanevas`
--
ALTER TABLE `detalplanevas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalplanevas_planeva_id_foreign` (`planeva_id`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `docentes_tiposangre_id_foreign` (`tiposangre_id`),
  ADD KEY `docentes_tipogrado_id_foreign` (`tipogrado_id`),
  ADD KEY `docentes_especialidad_id_foreign` (`especialidad_id`),
  ADD KEY `docentes_reparto_id_foreign` (`reparto_id`);

--
-- Indices de la tabla `ejecursos`
--
ALTER TABLE `ejecursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `especialidads`
--
ALTER TABLE `especialidads`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluacions`
--
ALTER TABLE `evaluacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluacions_alumno_id_foreign` (`alumno_id`),
  ADD KEY `evaluacions_periodo_id_foreign` (`periodo_id`),
  ADD KEY `evaluacions_materia_id_foreign` (`materia_id`),
  ADD KEY `evaluacions_detalplaneva_id_foreign` (`detalplaneva_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matriculas_periodo_id_foreign` (`periodo_id`),
  ADD KEY `matriculas_alumno_id_foreign` (`alumno_id`),
  ADD KEY `matriculas_curso_id_foreign` (`curso_id`),
  ADD KEY `matriculas_seccion_id_foreign` (`seccion_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modalidadcursos`
--
ALTER TABLE `modalidadcursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `periodos`
--
ALTER TABLE `periodos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `planestudios`
--
ALTER TABLE `planestudios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planestudios_curso_id_foreign` (`curso_id`);

--
-- Indices de la tabla `planevas`
--
ALTER TABLE `planevas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planevas_docente_id_foreign` (`docente_id`),
  ADD KEY `planevas_periodo_id_foreign` (`periodo_id`),
  ADD KEY `planevas_materia_id_foreign` (`materia_id`);

--
-- Indices de la tabla `porcentaje_notas`
--
ALTER TABLE `porcentaje_notas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `repartos`
--
ALTER TABLE `repartos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `seccions`
--
ALTER TABLE `seccions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipocursos`
--
ALTER TABLE `tipocursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipogrados`
--
ALTER TABLE `tipogrados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tiposangres`
--
ALTER TABLE `tiposangres`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `asignadocs`
--
ALTER TABLE `asignadocs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalplanevas`
--
ALTER TABLE `detalplanevas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ejecursos`
--
ALTER TABLE `ejecursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `especialidads`
--
ALTER TABLE `especialidads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `evaluacions`
--
ALTER TABLE `evaluacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `modalidadcursos`
--
ALTER TABLE `modalidadcursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `periodos`
--
ALTER TABLE `periodos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planestudios`
--
ALTER TABLE `planestudios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planevas`
--
ALTER TABLE `planevas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `porcentaje_notas`
--
ALTER TABLE `porcentaje_notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `repartos`
--
ALTER TABLE `repartos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seccions`
--
ALTER TABLE `seccions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipocursos`
--
ALTER TABLE `tipocursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipogrados`
--
ALTER TABLE `tipogrados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tiposangres`
--
ALTER TABLE `tiposangres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_especialidad_id_foreign` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidads` (`id`),
  ADD CONSTRAINT `alumnos_reparto_id_foreign` FOREIGN KEY (`reparto_id`) REFERENCES `repartos` (`id`),
  ADD CONSTRAINT `alumnos_tipogrado_id_foreign` FOREIGN KEY (`tipogrado_id`) REFERENCES `tipogrados` (`id`),
  ADD CONSTRAINT `alumnos_tiposangre_id_foreign` FOREIGN KEY (`tiposangre_id`) REFERENCES `tiposangres` (`id`);

--
-- Filtros para la tabla `asignadocs`
--
ALTER TABLE `asignadocs`
  ADD CONSTRAINT `asignadocs_aula_id_foreign` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`id`),
  ADD CONSTRAINT `asignadocs_docente_id_foreign` FOREIGN KEY (`docente_id`) REFERENCES `docentes` (`id`),
  ADD CONSTRAINT `asignadocs_materia_id_foreign` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `asignadocs_periodo_id_foreign` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`id`),
  ADD CONSTRAINT `asignadocs_seccion_id_foreign` FOREIGN KEY (`seccion_id`) REFERENCES `seccions` (`id`);

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ejecurso_id_foreign` FOREIGN KEY (`ejecurso_id`) REFERENCES `ejecursos` (`id`),
  ADD CONSTRAINT `cursos_tipocurso_id_foreign` FOREIGN KEY (`tipocurso_id`) REFERENCES `tipocursos` (`id`);

--
-- Filtros para la tabla `curso_materia`
--
ALTER TABLE `curso_materia`
  ADD CONSTRAINT `curso_materia_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `curso_materia_materia_id_foreign` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalplanevas`
--
ALTER TABLE `detalplanevas`
  ADD CONSTRAINT `detalplanevas_planeva_id_foreign` FOREIGN KEY (`planeva_id`) REFERENCES `planevas` (`id`);

--
-- Filtros para la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD CONSTRAINT `docentes_especialidad_id_foreign` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidads` (`id`),
  ADD CONSTRAINT `docentes_reparto_id_foreign` FOREIGN KEY (`reparto_id`) REFERENCES `repartos` (`id`),
  ADD CONSTRAINT `docentes_tipogrado_id_foreign` FOREIGN KEY (`tipogrado_id`) REFERENCES `tipogrados` (`id`),
  ADD CONSTRAINT `docentes_tiposangre_id_foreign` FOREIGN KEY (`tiposangre_id`) REFERENCES `tiposangres` (`id`);

--
-- Filtros para la tabla `evaluacions`
--
ALTER TABLE `evaluacions`
  ADD CONSTRAINT `evaluacions_alumno_id_foreign` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `evaluacions_detalplaneva_id_foreign` FOREIGN KEY (`detalplaneva_id`) REFERENCES `detalplanevas` (`id`),
  ADD CONSTRAINT `evaluacions_materia_id_foreign` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `evaluacions_periodo_id_foreign` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`id`);

--
-- Filtros para la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `matriculas_alumno_id_foreign` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `matriculas_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`),
  ADD CONSTRAINT `matriculas_periodo_id_foreign` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`id`),
  ADD CONSTRAINT `matriculas_seccion_id_foreign` FOREIGN KEY (`seccion_id`) REFERENCES `seccions` (`id`);

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `planestudios`
--
ALTER TABLE `planestudios`
  ADD CONSTRAINT `planestudios_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `planevas`
--
ALTER TABLE `planevas`
  ADD CONSTRAINT `planevas_docente_id_foreign` FOREIGN KEY (`docente_id`) REFERENCES `docentes` (`id`),
  ADD CONSTRAINT `planevas_materia_id_foreign` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `planevas_periodo_id_foreign` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`id`);

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
