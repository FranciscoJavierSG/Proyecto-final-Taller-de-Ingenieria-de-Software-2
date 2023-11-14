-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 29, 2021 at 04:38 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atractivos_turisticos_bd`
--

-- --------------------------------------------------------

--
-- Table structure for table `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `comentario` varchar(1024) CHARACTER SET utf8mb4 NOT NULL,
  `id_publicacion` int(10) NOT NULL,
  `id_usuario` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comentario`
--

INSERT INTO `comentario` (`id_comentario`, `comentario`, `id_publicacion`, `id_usuario`, `likes`) VALUES
(1, 'asdasd', 5, 'abismal22', 2);

-- --------------------------------------------------------

--
-- Table structure for table `etiqueta`
--

CREATE TABLE `etiqueta` (
  `id_publicacion` int(11) NOT NULL,
  `etiqueta` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `id_etiqueta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `etiqueta`
--

INSERT INTO `etiqueta` (`id_publicacion`, `etiqueta`, `id_etiqueta`) VALUES
(4, '#ardilla', 1),
(4, '#ardillaa', 2),
(4, '#ardillaa', 3),
(29, '#GALLETAS', 7),
(29, '#SURR', 8);

-- --------------------------------------------------------

--
-- Table structure for table `guarda`
--

CREATE TABLE `guarda` (
  `id_usuario` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `id_publicacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guarda`
--

INSERT INTO `guarda` (`id_usuario`, `id_publicacion`) VALUES
('abismal13', 4),
('abismal13', 6);

-- --------------------------------------------------------

--
-- Table structure for table `historial`
--

CREATE TABLE `historial` (
  `id_usuario` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `id_publicacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `historial`
--

INSERT INTO `historial` (`id_usuario`, `id_publicacion`) VALUES
('abismal13', 4),
('abismal20', 4),
('abismal13', 5),
('abismal20', 5),
('abismal13', 6);

-- --------------------------------------------------------

--
-- Table structure for table `moderador`
--

CREATE TABLE `moderador` (
  `usuario` varchar(50) NOT NULL,
  `codigo_acceso` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `moderador`
--

INSERT INTO `moderador` (`usuario`, `codigo_acceso`) VALUES
('1', '1'),
('abismal22', '123');

-- --------------------------------------------------------

--
-- Table structure for table `oferente`
--

CREATE TABLE `oferente` (
  `usuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `oferente`
--

INSERT INTO `oferente` (`usuario`) VALUES
('1'),
('abismal20');

-- --------------------------------------------------------

--
-- Table structure for table `publica`
--

CREATE TABLE `publica` (
  `id_oferente` varchar(50) NOT NULL,
  `id_publicacion` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publica`
--

INSERT INTO `publica` (`id_oferente`, `id_publicacion`) VALUES
('1', 4),
('abismal20', 5),
('abismal20', 6),
('abismal20', 29);

-- --------------------------------------------------------

--
-- Table structure for table `publicacion`
--

CREATE TABLE `publicacion` (
  `id_publicacion` int(7) NOT NULL,
  `nombre_publicacion` varchar(50) NOT NULL,
  `descripcion_publicacion` varchar(3000) NOT NULL,
  `valor_publicacion` int(9) NOT NULL,
  `region_publicacion` varchar(40) NOT NULL,
  `tipo_publicacion` set('producto','servicio','infraestructura') NOT NULL,
  `estado` set('pendiente','aprobado','rechazado') NOT NULL,
  `tipo_turismo` set('negocios','urbano','natural','gastronomico','aventura','ecologico','cultural','lujo','diversion','religioso','espacial') NOT NULL,
  `email_contacto` varchar(100) NOT NULL,
  `telefono_contacto` int(12) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `redes_sociales` varchar(1000) NOT NULL,
  `comuna_publicacion` varchar(40) NOT NULL,
  `calificacion_publicacion` int(2) NOT NULL,
  `visitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publicacion`
--

INSERT INTO `publicacion` (`id_publicacion`, `nombre_publicacion`, `descripcion_publicacion`, `valor_publicacion`, `region_publicacion`, `tipo_publicacion`, `estado`, `tipo_turismo`, `email_contacto`, `telefono_contacto`, `direccion`, `redes_sociales`, `comuna_publicacion`, `calificacion_publicacion`, `visitas`) VALUES
(4, 'Torres del paine', 'Estas son las torres del paine, un lugar turistico muy turistiable del sur de chile', 0, 'Magallanes y de la Antártica Chilena', 'servicio', 'aprobado', 'natural', 'paine@gmail.com', 912345678, 'Magallanes y la Antartica Chilena', 'Paine', 'Torres del Paine', 0, 19),
(5, 'Ahu Tongariki', 'Este es un lugar donde se puede hacer turismo.', 0, 'Valparaíso', 'servicio', 'aprobado', 'cultural', 'pascua@gmail.com', 912345678, 'rapa nui 123', 'Isla de Pascua', 'Isla de Pascua', 10, 21),
(6, 'Termas de Chillan ', 'Las termas de chillan el mejor lugar para pasar el invierno!', 50000, 'Ñuble', 'infraestructura', 'aprobado', 'natural', 'termito@gmail.com', 978781717, 'Las trancas', 'facebook', 'Pinto', 6, 12),
(29, '13123123123123123123123123', '213123', 123213, 'Arica y Parinacota', 'producto', 'pendiente', 'natural', '123123', 123123, '123123', '123123', 'Arica', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id_review` int(11) NOT NULL,
  `review` varchar(5000) CHARACTER SET utf8mb4 NOT NULL,
  `id_publicacion` int(11) NOT NULL,
  `id_usuario` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `estado` set('pendiente','aprobado','rechazado') NOT NULL,
  `calificacion_review` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id_review`, `review`, `id_publicacion`, `id_usuario`, `estado`, `calificacion_review`) VALUES
(1, 'Ejemplo de review', 4, 'abismal13', 'aprobado', 0),
(2, 'ZXZX', 6, 'abismal13', 'aprobado', 10),
(3, 'asdasdasd', 6, 'abismal13', 'aprobado', 4),
(4, 'asdsdgsdgsfsd', 6, 'abismal13', 'aprobado', 7),
(5, 'asdasd', 6, 'abismal13', 'aprobado', 3);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` varchar(50) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `email_usuario` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `email_usuario`, `contrasena`) VALUES
('1', '1', '1', '1'),
('2', '2', '2', '2'),
('3', 'asdasdasdasdasd', 'asdasdasdasdsa', 'asd'),
('abismal12', 'Felipe Espinoza', 'fespinozamea@gmail.cl', 'f69be13983b69f2cafdc618f5a6ca9c5cdc4ddd28ff2b52e3116a6b907c4c614'),
('abismal13', 'Felipe Espinoza', 'fespinozameaa@gmail.cl', 'f69be13983b69f2cafdc618f5a6ca9c5cdc4ddd28ff2b52e3116a6b907c4c614'),
('abismal2', 'Felipe Espinoza', 'fespinozameeeee@gmail.cl', 'F1f1f2f3'),
('abismal20', 'Felipe Espinoza', 'fespinozameaaa@gmail.cl', 'f69be13983b69f2cafdc618f5a6ca9c5cdc4ddd28ff2b52e3116a6b907c4c614'),
('abismal22', 'Felipe Espinoza', 'fespinozamei@gmail.cl', 'f69be13983b69f2cafdc618f5a6ca9c5cdc4ddd28ff2b52e3116a6b907c4c614'),
('abismal3', 'Andronico', '213123123', 'F1f1f2f3'),
('abismal4', 'Felipe Espinoza', 'fespinozameeeeeee@gmail.cl', 'F1f1f2f3'),
('abismal5', 'Felipe Espinoza', 'fespinozameeeeeeee@gmail.cl', 'F1f1f2f3'),
('abismal6', 'Felipe Espinoza', 'fespinozame@gmail.cl', 'F1f1f2f3'),
('abismal7', 'Felipe Espinoza', 'fespinozamee@gmail.cl', 'F1f1f2f3'),
('abismal8', 'Felipe Espinoza', 'fespinozameee@gmail.cl', 'F1f1f2f3'),
('abismal9', 'Felipe Espinoza', 'fespinozameeee@gmail.cl', 'F1f1f2f3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `comentario_publicacion` (`id_publicacion`),
  ADD KEY `comentario_usuario` (`id_usuario`);

--
-- Indexes for table `etiqueta`
--
ALTER TABLE `etiqueta`
  ADD PRIMARY KEY (`id_etiqueta`),
  ADD KEY `id_publicacion` (`id_publicacion`);

--
-- Indexes for table `guarda`
--
ALTER TABLE `guarda`
  ADD PRIMARY KEY (`id_usuario`,`id_publicacion`),
  ADD KEY `guarda_publicacion` (`id_publicacion`);

--
-- Indexes for table `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id_usuario`,`id_publicacion`),
  ADD KEY `historial_publicacion` (`id_publicacion`);

--
-- Indexes for table `moderador`
--
ALTER TABLE `moderador`
  ADD PRIMARY KEY (`usuario`);

--
-- Indexes for table `oferente`
--
ALTER TABLE `oferente`
  ADD PRIMARY KEY (`usuario`);

--
-- Indexes for table `publica`
--
ALTER TABLE `publica`
  ADD PRIMARY KEY (`id_oferente`,`id_publicacion`),
  ADD KEY `publica_publicacion` (`id_publicacion`);

--
-- Indexes for table `publicacion`
--
ALTER TABLE `publicacion`
  ADD PRIMARY KEY (`id_publicacion`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `review_publicacion` (`id_publicacion`),
  ADD KEY `review_usuario` (`id_usuario`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `etiqueta`
--
ALTER TABLE `etiqueta`
  MODIFY `id_etiqueta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `id_publicacion` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_publicacion` FOREIGN KEY (`id_publicacion`) REFERENCES `publicacion` (`id_publicacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `etiqueta`
--
ALTER TABLE `etiqueta`
  ADD CONSTRAINT `id_publicacion` FOREIGN KEY (`id_publicacion`) REFERENCES `publicacion` (`id_publicacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `guarda`
--
ALTER TABLE `guarda`
  ADD CONSTRAINT `guarda_publicacion` FOREIGN KEY (`id_publicacion`) REFERENCES `publicacion` (`id_publicacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_guarda` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_publicacion` FOREIGN KEY (`id_publicacion`) REFERENCES `publicacion` (`id_publicacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `historial_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `moderador`
--
ALTER TABLE `moderador`
  ADD CONSTRAINT `moderador_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `oferente`
--
ALTER TABLE `oferente`
  ADD CONSTRAINT `oferente_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `publica`
--
ALTER TABLE `publica`
  ADD CONSTRAINT `publica_oferente` FOREIGN KEY (`id_oferente`) REFERENCES `oferente` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `publica_publicacion` FOREIGN KEY (`id_publicacion`) REFERENCES `publicacion` (`id_publicacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_publicacion` FOREIGN KEY (`id_publicacion`) REFERENCES `publicacion` (`id_publicacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
