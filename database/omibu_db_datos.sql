-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2021 a las 11:43:51
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `omibu_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assign_team`
--

CREATE TABLE `assign_team` (
  `id` int(11) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `id_team` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `assign_team`
--

INSERT INTO `assign_team` (`id`, `id_user`, `id_team`, `created_at`) VALUES
(1, '1', '1', '2021-10-27 11:08:43'),
(2, '3', '1', '2021-10-27 11:11:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `id` varchar(100) NOT NULL,
  `id_location` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `cif` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id`, `id_location`, `name`, `surname`, `cif`, `description`, `status`, `created_at`, `updated_at`) VALUES
('1', 1, 'Decoraciones Alcazaba', NULL, '37520174E', NULL, 1, '2021-10-27 10:50:06', NULL),
('2', 1, 'Los Romeros de la puebla', NULL, '73048527F', NULL, 1, '2021-10-27 10:50:06', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `status`) VALUES
(1, 'Inbound', NULL, 1),
(2, 'Outbound', NULL, 1),
(3, 'Web', NULL, 1),
(4, 'Camera', NULL, 1),
(5, 'Copy', NULL, 1),
(6, 'Design', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hours`
--

CREATE TABLE `hours` (
  `id` int(11) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `id_project` varchar(100) NOT NULL,
  `assigned_hours` float DEFAULT NULL,
  `worked_hours` float DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hours_history`
--

CREATE TABLE `hours_history` (
  `id` int(11) NOT NULL,
  `id_hours` int(11) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `locations`
--

INSERT INTO `locations` (`id`, `city`, `country`, `description`, `status`, `created_at`) VALUES
(1, 'Granada', 'Spain', NULL, 1, '2021-10-27 10:20:52'),
(2, 'Malaga', 'Spain', NULL, 1, '2021-10-27 10:21:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE `projects` (
  `id` varchar(100) NOT NULL,
  `id_customer` varchar(100) NOT NULL,
  `id_team` varchar(100) NOT NULL,
  `id_project_type` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `hours_month` float NOT NULL,
  `hired_month` float NOT NULL,
  `hired_total_hours` float NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `projects`
--

INSERT INTO `projects` (`id`, `id_customer`, `id_team`, `id_project_type`, `name`, `description`, `hours_month`, `hired_month`, `hired_total_hours`, `status`, `created_at`, `updated_at`) VALUES
('1', '1', '1', 2, 'Project Web Decoraciones Alcazaba', NULL, 30, 6, 180, 1, '2021-10-27 11:12:08', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects_history`
--

CREATE TABLE `projects_history` (
  `id` int(11) NOT NULL,
  `id_project` varchar(100) NOT NULL,
  `id_team` varchar(100) NOT NULL,
  `total_hours` float NOT NULL,
  `start_hired_date` datetime NOT NULL,
  `end_hired_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects_types`
--

CREATE TABLE `projects_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `projects_types`
--

INSERT INTO `projects_types` (`id`, `name`, `description`, `status`, `created_at`) VALUES
(1, 'Full Service', NULL, 1, '2021-10-27 10:48:13'),
(2, 'One Service (web)', NULL, 1, '2021-10-27 10:47:32'),
(3, 'One Service (design)', NULL, 1, '2021-10-27 10:48:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `status`) VALUES
(1, 'Web development', NULL, '1'),
(2, 'Web design', NULL, '1'),
(3, 'Global operations', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teams`
--

CREATE TABLE `teams` (
  `id` varchar(100) NOT NULL,
  `id_user_project` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `teams`
--

INSERT INTO `teams` (`id`, `id_user_project`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
('1', '1', 'Web team', NULL, 1, '2021-10-27 11:06:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` varchar(100) NOT NULL,
  `id_location` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `hours_month` float NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `id_location`, `id_department`, `id_rol`, `name`, `surname`, `email`, `pass`, `description`, `image`, `hours_month`, `status`, `created_at`, `updated_at`) VALUES
('1', 1, 3, 1, 'Fran', 'Balinot', 'fran@gmail.com', '1234', NULL, NULL, 200, 1, '2021-10-27 10:42:12', '0000-00-00 00:00:00'),
('2', 1, 1, 3, 'David', 'Alcaucil', 'david@gmail.com', '1234', NULL, NULL, 200, 1, '2021-10-27 10:45:00', '0000-00-00 00:00:00'),
('3', 1, 3, 2, 'Juan', 'Pérez', 'juan@omibu.com', '1234', NULL, NULL, 200, 1, '2021-10-27 11:09:44', '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `assign_team`
--
ALTER TABLE `assign_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_team` (`id_team`);

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_location` (`id_location`);

--
-- Indices de la tabla `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hours`
--
ALTER TABLE `hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_project` (`id_project`);

--
-- Indices de la tabla `hours_history`
--
ALTER TABLE `hours_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_hours` (`id_hours`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_team` (`id_team`),
  ADD KEY `id_project_type` (`id_project_type`);

--
-- Indices de la tabla `projects_history`
--
ALTER TABLE `projects_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_project` (`id_project`),
  ADD KEY `id_team` (`id_team`);

--
-- Indices de la tabla `projects_types`
--
ALTER TABLE `projects_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_project` (`id_user_project`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_department` (`id_department`),
  ADD KEY `id_location` (`id_location`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `assign_team`
--
ALTER TABLE `assign_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `hours`
--
ALTER TABLE `hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hours_history`
--
ALTER TABLE `hours_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `projects_history`
--
ALTER TABLE `projects_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `projects_types`
--
ALTER TABLE `projects_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `assign_team`
--
ALTER TABLE `assign_team`
  ADD CONSTRAINT `assign_team_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `assign_team_ibfk_2` FOREIGN KEY (`id_team`) REFERENCES `teams` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`id_location`) REFERENCES `locations` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `hours`
--
ALTER TABLE `hours`
  ADD CONSTRAINT `hours_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `hours_ibfk_2` FOREIGN KEY (`id_project`) REFERENCES `projects` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `hours_history`
--
ALTER TABLE `hours_history`
  ADD CONSTRAINT `hours_history_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `hours_history_ibfk_2` FOREIGN KEY (`id_hours`) REFERENCES `hours` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`id_project_type`) REFERENCES `projects_types` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`id_team`) REFERENCES `teams` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_ibfk_3` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `projects_history`
--
ALTER TABLE `projects_history`
  ADD CONSTRAINT `projects_history_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `projects` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_history_ibfk_2` FOREIGN KEY (`id_team`) REFERENCES `teams` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`id_user_project`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_department`) REFERENCES `departments` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`id_location`) REFERENCES `locations` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
