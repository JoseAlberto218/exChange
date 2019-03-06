-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-03-2019 a las 19:47:31
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `exchange`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190222174008', '2019-02-22 17:40:52'),
('20190226193601', '2019-02-26 19:41:18'),
('20190226230136', '2019-02-26 23:02:41'),
('20190227015302', '2019-02-27 01:54:25'),
('20190227112326', '2019-02-27 11:24:27'),
('20190227122350', '2019-02-27 12:24:22'),
('20190227160359', '2019-02-27 16:05:53'),
('20190227191408', '2019-02-27 19:14:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `money_time` int(11) NOT NULL,
  `profile_pic` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`, `last_name`, `city`, `money_time`, `profile_pic`) VALUES
(1, 'jose@gmail.com', '[]', '$2y$12$7QGoSzNnTaN6ZVNfVzKyR.HOXQEdgXiPtCrmmWn5DKWTgnMdY9MMu', 'Jose', 'Sanchez', 'Granada', 600, 'https://i.ytimg.com/vi/zlwbeEFlFMk/maxresdefault.jpg'),
(2, 'antoniobb@gmail.com', '[]', '$2y$12$XVJb3.Y67toS8j7N/y.FFOoSFNTDAEd0P.4bicaHXNnYRep7v.sQq', 'Antonio', 'Mejias', 'Granada', 150, 'hola'),
(5, 'juan@gmail.com', '[]', '$2y$12$0Uy/4WhyOMF1pYXYh.N9ludz41xzFBAdW4PPAeIegEp2nQIoEjBEm', 'Hola', 'Mejias', 'Granada', 0, 'patata'),
(6, 'frun@gmail.com', '[]', '$2y$12$PNfDsGWhtPgaRjHRsSsBUeWWiJmH3x/hLR5lCw7mUEpmU8l.EUYtO', 'Frun', 'shdaba', 'Granada', 0, 'uyshfsd'),
(8, 'antonio@gmail.com', '[]', '$2y$12$i6jlCNb0TEqx8MZSZbbKMuT00Enzmn94SaSDbC28xxpdE2EDVxva2', 'Antoñete', 'Mirallas', 'Granada', 0, 'fjdghsijgj'),
(9, 'admin@gmail.com', '[]', '$2y$12$HPH8IwvAWOJ3NEiroly0Oeg7IQBNoCo05fs3CU6UKN7xqpCxfO/M2', 'admin', 'admin', 'Granada', 1000, 'admin'),
(10, 'drxfrxrf', '[]', '$2y$12$MbfQLXQV6aiFIOH1ZWkyZurMu1O3Dvyhlyp08rW93l/58RclROXba', 'dxrfx', 'xrfxrfx', 'rfxrfxrfx', 0, 'xrfxrfxfrxrf'),
(11, 'jose11@gmail.com', '[]', '$2y$12$qz/v5G8VcUoQmzyGU/MJnOY.V12nrxDfgwKwhCboNy5ecSjh6YHNy', 'hola', 'shduvbhhs', 'Granada', 0, 'hgffhg'),
(12, 'pepe@gmail.com', '[]', '$2y$12$Toxtl90RrtpK/rntPJ9O1uOgQPtSPXAAmdpPyOwepwaME3TFpliHy', 'Pepe', 'Martin', 'Murcia', 0, 'patata'),
(13, 'nacho@algo.com', '[]', '$2y$12$tKT/LGxIxdm1ZleVy.e5Hu6chcsnWvWLhrmdxhf5tg2XYzlRfuzBK', 'nacho', 'jhdsfb', 'Granada', 0, 'https://cdn1.iconfinder.com/data/icons/business-users/512/circle-512.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
