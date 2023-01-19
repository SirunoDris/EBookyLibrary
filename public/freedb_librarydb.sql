-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: sql.freedb.tech
-- Tiempo de generación: 17-01-2023 a las 23:38:35
-- Versión del servidor: 8.0.28
-- Versión de PHP: 8.0.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `freedb_librarydb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AUTHORS`
--

CREATE TABLE `AUTHORS` (
  `id` int NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `country` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `AUTHORS`
--

INSERT INTO `AUTHORS` (`id`, `fullname`, `country`) VALUES
(1, 'George Raymond Richard Martin ', 'Estadounidense'),
(2, 'Dante Alighieri', 'Florencia'),
(3, 'Carlos Ruiz Zafón', 'Barcelona'),
(4, 'Príncipe Harry', '​ Paddington'),
(5, 'Dan Brown', 'Estadounidense'),
(6, 'Stephen King', 'Estadounidense');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `BOOKS`
--

CREATE TABLE `BOOKS` (
  `id` int NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `title` varchar(60) NOT NULL,
  `editionName` varchar(40) NOT NULL,
  `editionDate` datetime DEFAULT NULL,
  `catalogPostDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `img` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `BOOKS`
--

INSERT INTO `BOOKS` (`id`, `isbn`, `title`, `editionName`, `editionDate`, `catalogPostDate`, `img`) VALUES
(1, '9781524796297', 'Fuego y Sangre', 'PLAZA & JANES', NULL, '2023-01-13 14:54:16', 'https://imagessl6.casadellibro.com/a/l/t7/66/9788401022166.jpg'),
(4, '9781524796285', 'la divina comedia ', 'Dante', NULL, '2023-01-16 15:36:13', 'https://www.plutonediciones.com/tienda/wp-content/uploads/2019/05/comedia.jpg'),
(5, '9788408072805', 'El príncipe de la niebla', 'Booket', NULL, '2023-01-17 22:41:07', 'https://imagessl5.casadellibro.com/a/l/t7/05/9788408072805.jpg'),
(6, '9788401029813', 'EN LA SOMBRA', 'PLAZA & JANES EDITORES', NULL, '2023-01-17 22:42:29', 'https://imagessl3.casadellibro.com/a/l/t7/13/9788401029813.jpg'),
(7, '9788408176022', 'EL CODIGO DA VINCI', 'PLANETA', NULL, '2023-01-17 22:43:05', 'https://imagessl2.casadellibro.com/a/l/t7/22/9788408176022.jpg'),
(9, '9788401027710', 'CUENTO DE HADAS', 'PLAZA & JANES EDIT', NULL, '2023-01-17 22:45:03', 'https://imagessl0.casadellibro.com/a/l/t7/10/9788401027710.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `BOOKS__AUTHORS`
--

CREATE TABLE `BOOKS__AUTHORS` (
  `bookId` int NOT NULL,
  `authorId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `BOOKS__AUTHORS`
--

INSERT INTO `BOOKS__AUTHORS` (`bookId`, `authorId`) VALUES
(1, 1),
(4, 2),
(5, 3),
(6, 4),
(7, 5),
(9, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `BOOK_RENT`
--

CREATE TABLE `BOOK_RENT` (
  `userId` int NOT NULL,
  `bookId` int NOT NULL,
  `title` varchar(225) NOT NULL,
  `initDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `returnDateScheduled` datetime DEFAULT NULL,
  `returnDateActual` datetime DEFAULT NULL,
  `returnDateExtended` datetime DEFAULT NULL,
  `price` decimal(6,2) NOT NULL DEFAULT '0.00',
  `statusId` int NOT NULL DEFAULT '0',
  `img` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `BOOK_RENT`
--

INSERT INTO `BOOK_RENT` (`userId`, `bookId`, `title`, `initDate`, `returnDateScheduled`, `returnDateActual`, `returnDateExtended`, `price`, `statusId`, `img`) VALUES
(2, 1, 'Fuego y Sangre', '2023-01-16 16:46:06', '2023-01-19 17:45:29', '2023-01-27 17:45:29', NULL, '15.00', 0, 'https://imagessl6.casadellibro.com/a/l/t7/66/9788401022166.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `BOOK_RENT_STATUSCODES`
--

CREATE TABLE `BOOK_RENT_STATUSCODES` (
  `id` int NOT NULL,
  `codeName` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `BOOK_RENT_STATUSCODES`
--

INSERT INTO `BOOK_RENT_STATUSCODES` (`id`, `codeName`) VALUES
(0, 'active'),
(1, 'finished'),
(2, 'extended'),
(3, 'delayed'),
(4, 'finishedLate');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GENRES`
--

CREATE TABLE `GENRES` (
  `id` int NOT NULL,
  `genreName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USERS`
--

CREATE TABLE `USERS` (
  `id` int NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `passwd` varchar(200) NOT NULL,
  `userRole` int NOT NULL DEFAULT '0',
  `balance` decimal(6,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `USERS`
--

INSERT INTO `USERS` (`id`, `username`, `email`, `passwd`, `userRole`, `balance`) VALUES
(1, 'msaura', 'msaura@gmail.com', '$2y$09$B/xK8.UlGxTrR.n46iGNqeKe27tzDIFUXHaFIePr95pLrheouZtLC', 2, '0.00'),
(2, 'masate', 'msate@gmail.com', '$2y$09$QngZj6L1ZXvVIWHgzgFvbu8DhL9oQqG0S77XE0AowBeTolx6aj4wG', 0, '0.00'),
(3, 'jess', 'jess@jess.com', '$2y$09$TQmrPQmDs5PTYfISIBAd8OZm7pW9wl/b407.CPoC/uSu/qB16C9Ua', 1, '0.00'),
(4, 'Kiko', 'k@falso.com', '$2y$09$q2ouUviSXav9t54955bUou3PecIg6RQgaQgt1gMnBt8wC.BNbtZj.', 1, '0.00'),
(5, 'xeno000', 'xeno000@falso.com', '$2y$09$ASVqiGw7NdWxPTzVHtImOOzq3BQa/ZQz6DD4vAW/k5t7LNsWx.kmW', 2, '0.00'),
(6, 'marc', 'timmy@gmail.com', '$2y$09$oPw07Egw2R87BRAN.Vj0XujzKckyoXiBPlvkuSj1F8YCczN.J5rJa', 0, '0.00'),
(7, 'Elma Carrón', 'e@carron.com', '$2y$09$XJA.Nwuh/XB/QsUlEFfhMeQcNgXyXylB7IQKy.Q1e.zfRuDCr94Ou', 2, '0.00'),
(8, 'TEST66', 't66@t.com', '$2y$09$ZjAo6bOcT7v64kIFfLmg8OgoxaQ9QqL2l.rdPW9VIEsGlT0C3cRom', 0, '0.00'),
(9, 'Elsa Polindo', 'elsapolindo@g.com', '$2y$09$eft.whD3j118n0agNUoqGeCNP1tju7UCGYm90LO1E6JoerHFBFVG6', 0, '0.00'),
(10, 'timmy', 'timmy2@gmail.com', '$2y$09$D/moqmjQO7LB.6aQlBYqmeT9qngrLT1ggHQOLWokdXrZXneWpBEcC', 0, '0.00'),
(11, 'AnotherAdmin', 'a@admin.lol', '$2y$09$A56kRHRD5y7Xl/CgEGdsk.YZkX/62sJ0dourm6Ngnc.Hl1UH0PSnm', 2, '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USER_SETTINGS`
--

CREATE TABLE `USER_SETTINGS` (
  `userId` int NOT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `lastLogout` datetime DEFAULT NULL,
  `lang` varchar(20) NOT NULL DEFAULT 'en',
  `colorTheme` varchar(25) NOT NULL DEFAULT 'light_default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `AUTHORS`
--
ALTER TABLE `AUTHORS`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fullname` (`fullname`);

--
-- Indices de la tabla `BOOKS`
--
ALTER TABLE `BOOKS`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`),
  ADD UNIQUE KEY `editionName` (`editionName`);

--
-- Indices de la tabla `BOOKS__AUTHORS`
--
ALTER TABLE `BOOKS__AUTHORS`
  ADD PRIMARY KEY (`bookId`,`authorId`),
  ADD KEY `authorId` (`authorId`);

--
-- Indices de la tabla `BOOK_RENT`
--
ALTER TABLE `BOOK_RENT`
  ADD PRIMARY KEY (`userId`,`bookId`),
  ADD KEY `statusId` (`statusId`),
  ADD KEY `bookId` (`bookId`);

--
-- Indices de la tabla `BOOK_RENT_STATUSCODES`
--
ALTER TABLE `BOOK_RENT_STATUSCODES`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `GENRES`
--
ALTER TABLE `GENRES`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `genreName` (`genreName`);

--
-- Indices de la tabla `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `USER_SETTINGS`
--
ALTER TABLE `USER_SETTINGS`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userId` (`userId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `AUTHORS`
--
ALTER TABLE `AUTHORS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `BOOKS`
--
ALTER TABLE `BOOKS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `GENRES`
--
ALTER TABLE `GENRES`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `USERS`
--
ALTER TABLE `USERS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `BOOKS__AUTHORS`
--
ALTER TABLE `BOOKS__AUTHORS`
  ADD CONSTRAINT `BOOKS__AUTHORS_ibfk_1` FOREIGN KEY (`bookId`) REFERENCES `BOOKS` (`id`),
  ADD CONSTRAINT `BOOKS__AUTHORS_ibfk_2` FOREIGN KEY (`authorId`) REFERENCES `AUTHORS` (`id`);

--
-- Filtros para la tabla `BOOK_RENT`
--
ALTER TABLE `BOOK_RENT`
  ADD CONSTRAINT `BOOK_RENT_ibfk_1` FOREIGN KEY (`statusId`) REFERENCES `BOOK_RENT_STATUSCODES` (`id`),
  ADD CONSTRAINT `BOOK_RENT_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `USERS` (`id`),
  ADD CONSTRAINT `BOOK_RENT_ibfk_3` FOREIGN KEY (`bookId`) REFERENCES `BOOKS` (`id`);

--
-- Filtros para la tabla `USER_SETTINGS`
--
ALTER TABLE `USER_SETTINGS`
  ADD CONSTRAINT `USER_SETTINGS_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `USERS` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
