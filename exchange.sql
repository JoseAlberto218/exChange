-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-03-2019 a las 19:58:47
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
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Jardinería'),
(2, 'Fontanería'),
(3, 'Guardar niños'),
(4, 'Enseñanza'),
(5, 'Carpintería');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `emisor` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensaje` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receptor` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `respondido` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `emisor`, `mensaje`, `receptor`, `respondido`) VALUES
(1, 'jose@gmail.com', 'jzdnvjndf', 'admin@gmail.com', 1),
(2, 'patata@hotmail.com', 'Hola mu wenas', 'admin@gmail.com', 1),
(3, 'admin@gmail.com', 'RE: jzdnvjndf\r\n\r\noc', 'jose@gmail.com', 1),
(4, 'admin@gmail.com', 'RE: Hola mu wenas\r\n\r\nAsi e asi e', 'patata@hotmail.com', 1),
(5, 'yo@yo.com', 'Hola bb', 'admin@gmail.com', 1),
(6, 'jose@gmail.com', 'Hola soi yo', 'admin@gmail.com', 1),
(7, 'admin@gmail.com', 'RE: Hola bb\r\n\r\nHola holita vecinito', 'yo@yo.com', 1),
(8, 'admin@gmail.com', 'RE: Hola soi yo\r\n\r\nCallese hombre maduro de gustos lesbicos', 'jose@gmail.com', 1),
(9, 'erdgae@fsuh', 'Hola admin', 'admin@gmail.com', 1),
(10, 'admin@gmail.com', 'RE: Hola admin\r\n\r\njdshfvsbdufv', 'erdgae@fsuh', 1),
(11, 'jose@gmail.com', 'uahsfuivhieh nw qeruhfkj bhdsjvb akjefhj fhjav bhugadjk vkasdkjvj basdmdv hjasdb adjbv msbhdbvh sdbvjs dbbvj dsbjvh', 'admin@gmail.com', 1),
(12, 'josealberto.stf@gmail.com', 'h zhxk zvnafs kvnadskfn vjkafnvjf', 'admin@gmail.com', 0),
(13, 'yo@yo.com', 'sthfgnbv ', 'admin@gmail.com', 0),
(14, 'paco@gmail.com', 'sajfhsadhef', 'admin@gmail.com', 0),
(15, 'admin@gmail.com', 'RE: uahsfuivhieh nw qeruhfkj bhdsjvb akjefhj fhjav bhugadjk vkasdkjvj basdmdv hjasdb adjbv msbhdbvh sdbvjs dbbvj dsbjvh', 'jose@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `remitente_id` int(11) DEFAULT NULL,
  `destinatario_id` int(11) DEFAULT NULL,
  `date` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leido` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` int(11) NOT NULL,
  `availability` tinyint(1) NOT NULL,
  `completed` tinyint(1) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `city` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `solicitante_id` int(11) DEFAULT NULL,
  `num_solicit` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`id`, `user_id`, `title`, `description`, `image`, `cost`, `availability`, `completed`, `category_id`, `city`, `solicitante_id`, `num_solicit`, `accepted`) VALUES
(2, 1, 'bricomaniacos', 'dfjvsdnjavkn', 'brico.jpg', 20, 0, 0, 1, 'Granada', 9, 2, 1),
(3, 1, 'Mamporrero 24/7', 'kbadvjdfnvf rwegr', 'Mamporrero.jpg', 60, 0, 0, 3, 'Granada', 1, 1, 1),
(4, 1, 'Cuido niños. Soy muy cariñoso', 'fjbaschbdv dwbvchjd', 'descarga (1).jpg', 30, 0, 0, 3, 'Granada', 1, 1, 1),
(5, 1, 'Te dibujo como a una de mis chicas francesas', 'hbvhbrv wjrhbf', '20171110_023206.jpg', 120, 1, 0, 4, 'Granada', NULL, 0, 0),
(6, 9, 'uhfsdgiuf', 'SYIGyufdsGYF', 'hqdefault.jpg', 30, 0, 0, 1, 'Granada', 13, 1, 1);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_user`
--

CREATE TABLE `user_user` (
  `user_source` int(11) NOT NULL,
  `user_target` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B6BD307F1C3E945F` (`remitente_id`),
  ADD KEY `IDX_B6BD307FB564FBC1` (`destinatario_id`);

--
-- Indices de la tabla `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7332E169A76ED395` (`user_id`),
  ADD KEY `IDX_7332E16912469DE2` (`category_id`),
  ADD KEY `IDX_7332E169C680A87` (`solicitante_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Indices de la tabla `user_user`
--
ALTER TABLE `user_user`
  ADD PRIMARY KEY (`user_source`,`user_target`),
  ADD KEY `IDX_F7129A803AD8644E` (`user_source`),
  ADD KEY `IDX_F7129A80233D34C1` (`user_target`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_B6BD307F1C3E945F` FOREIGN KEY (`remitente_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_B6BD307FB564FBC1` FOREIGN KEY (`destinatario_id`) REFERENCES `services` (`id`);

--
-- Filtros para la tabla `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `FK_7332E16912469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `FK_7332E169A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_7332E169C680A87` FOREIGN KEY (`solicitante_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `user_user`
--
ALTER TABLE `user_user`
  ADD CONSTRAINT `FK_F7129A80233D34C1` FOREIGN KEY (`user_target`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F7129A803AD8644E` FOREIGN KEY (`user_source`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
