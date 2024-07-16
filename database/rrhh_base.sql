-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2024 a las 17:40:31
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rrhh_base`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Recursos Humanos', 'Se encarga de encontrar, seleccionar, reclutar y capacitar a las personas que solicitan un empleo'),
(2, 'Marketing', 'Es el responsable de crear la comunicación del valor de un producto, servicio o marca, y dirigirla a un determinado segmento del público'),
(3, 'Compras', 'Determina cuáles y cuántos bienes y servicios son necesarios para el negocio, y evaluar cuáles son las medidas idóneas para garantizar una óptima gestión'),
(4, 'Sistemas', 'Se encarga de la red informática, las computadoras, las aplicaciones y programas instalados en ellas, y los servicios de uso general como el correo electrónico.'),
(5, 'Calidad', 'Se encarga de mantener y mejorar la calidad de los productos y servicios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficios`
--

CREATE TABLE `beneficios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `descuento` decimal(5,2) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `beneficios`
--

INSERT INTO `beneficios` (`id`, `nombre`, `descripcion`, `descuento`, `categoria_id`) VALUES
(1, 'Zebra', 'Descuento del 20% en juguetes', 20.00, 1),
(2, 'Burger King', 'Descuento en la cadena de comida rapida', 40.00, 7),
(5, 'Fitter', 'Descuento en cadena de gimnasios', 50.00, 6),
(6, 'Megatlon', 'Descuento en la cadena de gimnasios', 25.00, 6),
(8, 'La Farola', 'Descuento Restaurante', 10.00, 7),
(9, 'SportClub', 'Descuento Gimnasio', 10.00, 6),
(10, 'Village Cines', 'Descuento en el cine', 25.00, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(5, 'Educacion'),
(8, 'Entretenimiento'),
(7, 'Gastronomia'),
(6, 'Gimnasio'),
(1, 'Jugueteria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_vacaciones`
--

CREATE TABLE `empleado_vacaciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `vacaciones_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_vacaciones`
--

CREATE TABLE `solicitud_vacaciones` (
  `id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `motivo` text NOT NULL,
  `estado` enum('pendiente','aprobado','rechazado') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `avatar` varchar(255) DEFAULT 'img_default.png',
  `email` varchar(100) NOT NULL,
  `sueldo` decimal(10,2) NOT NULL,
  `tipo_usuario` enum('empleado','administrador') NOT NULL,
  `area_id` int(11) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `dni`, `pass`, `nombre`, `apellido`, `avatar`, `email`, `sueldo`, `tipo_usuario`, `area_id`, `fecha_registro`, `deleted_at`) VALUES
(9, '25646584', '$2y$10$4kBWasFF0qI7CkyTOH1hsuPYd.4KC47ypOl.FE2nvQYX2VNwJLkhO', 'admin', 'admin', 'img_default.png', 'administrador@gmail.com', 45000.00, 'administrador', 1, '2024-06-24 01:10:17', NULL),
(14, '1234567', '$2y$10$6piN8sc0UoRADAIrpMXns.GImO9cqlKMup.FvKo.BJn9eHQuJFzZu', 'Empleado', 'Prueba', 'img_default.png', 'empleado@gmail.com', 0.00, 'empleado', NULL, '2024-06-25 15:36:45', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `beneficios`
--
ALTER TABLE `beneficios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_beneficios_categorias` (`categoria_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `empleado_vacaciones`
--
ALTER TABLE `empleado_vacaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `vacaciones_id` (`vacaciones_id`);

--
-- Indices de la tabla `solicitud_vacaciones`
--
ALTER TABLE `solicitud_vacaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_usuarios_areas` (`area_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `beneficios`
--
ALTER TABLE `beneficios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `empleado_vacaciones`
--
ALTER TABLE `empleado_vacaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `solicitud_vacaciones`
--
ALTER TABLE `solicitud_vacaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `beneficios`
--
ALTER TABLE `beneficios`
  ADD CONSTRAINT `fk_beneficios_categorias` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `empleado_vacaciones`
--
ALTER TABLE `empleado_vacaciones`
  ADD CONSTRAINT `empleado_vacaciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `empleado_vacaciones_ibfk_2` FOREIGN KEY (`vacaciones_id`) REFERENCES `solicitud_vacaciones` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuarios_areas` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
