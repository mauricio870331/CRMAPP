-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2020 at 10:14 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `analisis_persona`
--

CREATE TABLE `analisis_persona` (
  `id_analisis` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estados`
--

INSERT INTO `estados` (`id_estado`, `estado`) VALUES
(1, 'ACTIVO'),
(2, 'PENDIENTE CONFIRMACION'),
(3, 'CONTRATO ENVIADO'),
(4, 'DOCUMENTOS PARA DISPUTAS'),
(5, 'DOCUMENTOS INCOMPLETOS'),
(6, '1ER DISPUTA ENVIADA'),
(7, '1ER DISPUTA RECIBIDA'),
(8, 'PENDIENTE POR ANALISIS'),
(9, 'ANALISIS REALIZADO'),
(10, '2DA DISPUTA ENVIADA'),
(11, '2DA DISPUTA RECIBIDA '),
(12, 'FINALIZADO');

-- --------------------------------------------------------

--
-- Table structure for table `estados_personas`
--

CREATE TABLE `estados_personas` (
  `id_estado` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estados_personas`
--

INSERT INTO `estados_personas` (`id_estado`, `id_persona`, `fecha_registro`) VALUES
(1, 1, '2020-02-22 16:44:29'),
(1, 2, '2020-02-23 11:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `telefonos` varchar(100) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `ss` varchar(100) DEFAULT NULL COMMENT 'Seguro Social',
  `dob` date DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `asesor` int(11) DEFAULT NULL,
  `cita` date DEFAULT NULL,
  `fecha_cracion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personas`
--

INSERT INTO `personas` (`id`, `nombres`, `apellidos`, `telefonos`, `direccion`, `ss`, `dob`, `email`, `asesor`, `cita`, `fecha_cracion`) VALUES
(2, 'Camilo', 'Acosta', '3263512546', 'prueba', '111236548798', '1993-10-07', 'prueba', 8, '2020-03-03', '2020-02-23 11:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `situacion`
--

CREATE TABLE `situacion` (
  `id_situacion` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `situacion`
--

INSERT INTO `situacion` (`id_situacion`, `estado`) VALUES
(1, 'LEAD'),
(2, 'CLIENTE'),
(3, 'SUSPENDIDO'),
(4, 'FINALIZADO');

-- --------------------------------------------------------

--
-- Table structure for table `situacion_personas`
--

CREATE TABLE `situacion_personas` (
  `id_situacion` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `situacion_personas`
--

INSERT INTO `situacion_personas` (`id_situacion`, `id_persona`, `fecha_registro`) VALUES
(1, 1, '2020-02-22 16:44:29'),
(1, 2, '2020-02-23 11:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `tipo_doc` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `siglas` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_documento`
--

INSERT INTO `tipo_documento` (`tipo_doc`, `nombre`, `siglas`) VALUES
(1, 'CEDULA DE CIUDADANIA', 'CC');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `descripcion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `descripcion`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'ASESOR'),
(3, 'COACH'),
(4, 'CUSTOMER');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `tipo_doc` int(11) NOT NULL,
  `documento` varchar(20) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `telefono` text DEFAULT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `coach` int(11) DEFAULT NULL,
  `franquicia` int(11) DEFAULT NULL,
  `password` varchar(20) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `foto` longblob DEFAULT NULL,
  `ext` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `tipo_doc`, `documento`, `nombres`, `apellidos`, `telefono`, `id_tipo_usuario`, `coach`, `franquicia`, `password`, `fecha_registro`, `foto`, `ext`) VALUES
(1, 0, '1113626301', 'Mauricio', 'Hererra', '', 1, NULL, NULL, '', '2020-03-04 16:08:49', NULL, NULL),
(2, 0, '1113626301', 'Mauricio', 'Herrera', '', 1, NULL, NULL, '', '2020-03-04 16:11:21', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analisis_persona`
--
ALTER TABLE `analisis_persona`
  ADD PRIMARY KEY (`id_analisis`);

--
-- Indexes for table `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indexes for table `estados_personas`
--
ALTER TABLE `estados_personas`
  ADD PRIMARY KEY (`id_estado`,`id_persona`);

--
-- Indexes for table `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `situacion`
--
ALTER TABLE `situacion`
  ADD PRIMARY KEY (`id_situacion`);

--
-- Indexes for table `situacion_personas`
--
ALTER TABLE `situacion_personas`
  ADD PRIMARY KEY (`id_situacion`,`id_persona`);

--
-- Indexes for table `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`tipo_doc`);

--
-- Indexes for table `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analisis_persona`
--
ALTER TABLE `analisis_persona`
  MODIFY `id_analisis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `situacion`
--
ALTER TABLE `situacion`
  MODIFY `id_situacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `tipo_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
