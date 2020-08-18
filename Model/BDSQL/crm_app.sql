-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-08-2020 a las 20:38:16
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crm_app`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adjuntos`
--

CREATE TABLE `adjuntos` (
  `id_adjunto` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  `ext` varchar(10) DEFAULT NULL,
  `ss_persona` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `nombre_archivo` varchar(50) NOT NULL,
  `asesor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `analisis_persona`
--

CREATE TABLE `analisis_persona` (
  `id_analisis` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id` int(11) NOT NULL,
  `ciudad` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id`, `ciudad`) VALUES
(1, 'New York');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disputas`
--

CREATE TABLE `disputas` (
  `id_disputa` int(11) NOT NULL,
  `cuenta` varchar(50) NOT NULL,
  `num_cuenta` varchar(50) NOT NULL,
  `razon` int(11) NOT NULL,
  `observacion` text DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL,
  `creado_por` int(11) NOT NULL,
  `fecha_actualizado` datetime DEFAULT NULL,
  `actualizado_por` int(11) DEFAULT NULL,
  `ss_persona` varchar(15) NOT NULL,
  `tot_resp` int(11) NOT NULL DEFAULT 0,
  `doc_gen` tinyint(1) NOT NULL DEFAULT 0,
  `item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `disputas`
--

INSERT INTO `disputas` (`id_disputa`, `cuenta`, `num_cuenta`, `razon`, `observacion`, `fecha_creacion`, `creado_por`, `fecha_actualizado`, `actualizado_por`, `ss_persona`, `tot_resp`, `doc_gen`, `item`) VALUES
(1, 'Prueba Cuenta', '899-956-6451-11', 18, 'Prueba obs.', '2020-08-17 10:08:11', 1, NULL, NULL, '123456789', 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id_documento` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  `ext` varchar(10) DEFAULT NULL,
  `ss_persona` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `nombre_archivo` varchar(50) NOT NULL,
  `asesor` int(11) DEFAULT NULL,
  `tipo` varchar(20) NOT NULL DEFAULT 'Documento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id_documento`, `descripcion`, `ruta`, `ext`, `ss_persona`, `fecha_registro`, `nombre_archivo`, `asesor`, `tipo`) VALUES
(9, 'Contrato Greenlight', '../Documentos/123456789/', 'pdf', 123456789, '2020-07-17 09:25:14', 'Contrato_123456789.pdf', 1, 'Documento'),
(10, 'Carta de Presentación', '../Documentos/123456789/', 'pdf', 123456789, '2020-07-17 09:28:07', 'Carta_123456789.pdf', 1, 'Documento'),
(11, 'Bienvenida Greenlight', '../Documentos/123456789/', 'pdf', 123456789, '2020-07-17 09:29:16', 'Bienvenida_123456789.pdf', 1, 'Documento'),
(12, 'Acuerdo de Pagos Greenlight', '../Documentos/123456789/', 'pdf', 123456789, '2020-07-17 14:46:01', 'AcuerdoDePagos_123456789.pdf', 1, 'Documento'),
(13, 'Solicitud de Reportes', '../Documentos/123456789/', 'pdf', 123456789, '2020-07-19 12:00:44', 'SolicitudReporte_123456789.pdf', 1, 'Documento'),
(18, 'Verificacion Greenlight', '../Documentos/123456789/', 'pdf', 123456789, '2020-07-20 11:26:15', 'Verificacion_123456789.pdf', 1, 'Documento'),
(25, 'Disputa', '../Documentos/123456789/', 'docx', 123456789, '2020-08-17 10:11:18', 'Disputa1_123456789.docx', 1, 'Documento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `id_ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `estado`, `id_ciudad`) VALUES
(1, 'Nueva York', 1),
(2, '13', 123),
(3, '123', 1231);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados`
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
(12, 'FINALIZADO'),
(13, 'SUSPENDIDO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_de_pago`
--

CREATE TABLE `estados_de_pago` (
  `id_estado_pago` int(11) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `descripcion_eng` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados_de_pago`
--

INSERT INTO `estados_de_pago` (`id_estado_pago`, `codigo`, `descripcion`, `descripcion_eng`) VALUES
(1, 'R0', 'PTE POR PROCESAR', 'PENDING TO PROCESS'),
(2, 'R1', 'FONDOS INSUFUCIENTES', 'INSUFFICIENT FUNDS'),
(3, 'R2', 'CUENTA CERRADA', 'ACCOUNT CLOSED'),
(4, 'R3', 'CUENTA INVALIDA', '(NO ACCOUNT/UNABLE TO LOCATE ACCOUNT)'),
(5, 'R4', 'CUENTA INVALIDA', '(INVALID ACCOUNT NUMBER)'),
(6, 'R7', 'AUTORIZACIÓN REVOCADA', 'AUTHORIZATION REVOKED BY CUSTOMER'),
(7, 'R8', 'PAGO DETENIDO', 'PAYMENT STOPPED'),
(8, 'R9', 'FONDOS NO RECOGIDOS', 'UNCOLLECTED FUNDS'),
(9, 'R10', 'CHARGED BACK', 'CUSTOMER ADVISES NOT AUTHORIZED'),
(10, 'R15', 'FALLECIMIENTO DEL BENEFICIARIO O DEL TITULAR DE LA CUENTA', 'BENEFICIARY OR ACCOUNT HOLDER DECEASE'),
(11, 'R16', 'CUENTA FRIZADA', 'ACCOUNT FROZEN'),
(12, 'R16', 'CUENTA NO TRANSACTIVA', 'NON TRANSATION ACCOUNT'),
(13, 'APROBADO', 'APROBADO', 'APPROVED'),
(14, 'SUSPENDIDO', 'SUSPENDIDO', 'DISCONTINUED'),
(15, 'EN PROCESO', 'PAGO EN PROCESO', 'PAYMENT IN PROCESS'),
(16, 'EFECTIVO', 'EFECTIVO', 'CASH');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_personas`
--

CREATE TABLE `estados_personas` (
  `id_estado` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `update_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados_personas`
--

INSERT INTO `estados_personas` (`id_estado`, `id_persona`, `fecha_registro`, `update_by`) VALUES
(1, 1, '2020-03-19 12:00:50', 3),
(1, 1, '2020-03-19 14:29:52', 3),
(1, 1, '2020-03-27 15:14:30', 3),
(1, 1, '2020-04-16 15:19:34', 3),
(1, 1, '2020-04-16 15:26:47', 3),
(1, 1, '2020-05-04 17:51:46', 3),
(13, 1, '2020-03-19 12:00:37', 3),
(13, 1, '2020-03-19 12:01:02', 3),
(13, 1, '2020-03-27 15:14:16', 3),
(13, 1, '2020-04-16 15:19:30', 3),
(13, 1, '2020-04-16 15:26:12', 3),
(13, 1, '2020-05-04 17:51:44', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_pagos_producto`
--

CREATE TABLE `log_pagos_producto` (
  `id_log` int(11) NOT NULL,
  `id_pago` int(11) NOT NULL,
  `id_estado_pago` int(11) NOT NULL,
  `fecha_log` datetime NOT NULL,
  `id_persona` int(11) NOT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `accion` varchar(20) DEFAULT NULL,
  `sql_sentence` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id_nota` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `ss_persona` varchar(20) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id_nota`, `titulo`, `descripcion`, `ss_persona`, `fecha_registro`, `creado_por`, `modificado_por`, `fecha_modificado`) VALUES
(5, 'Seguimiento de Venta', 'gdsfgfdg', '123456789', '2020-07-12 15:22:40', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `detalle` text NOT NULL,
  `encargado` int(11) DEFAULT NULL,
  `tipo_usuario` int(11) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL,
  `creado_por` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'PENDIENTE',
  `ss_persona` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion_personas`
--

CREATE TABLE `notificacion_personas` (
  `id` int(11) NOT NULL,
  `documento_persona` varchar(20) NOT NULL,
  `cod_notificacion` varchar(20) NOT NULL,
  `fecha_envio` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_personas`
--

CREATE TABLE `pagos_personas` (
  `id_pago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_producto`
--

CREATE TABLE `pagos_producto` (
  `id_pago` int(11) NOT NULL,
  `numero_cuota` int(11) NOT NULL COMMENT 'numero de cuota de 1 a n',
  `fecha_pago_realizado` date DEFAULT NULL COMMENT 'Fecha en la que se realiza el pago',
  `valor_cuota` float NOT NULL,
  `id_estado_pago` int(11) NOT NULL,
  `fecha_pago` date DEFAULT NULL,
  `id_producto` int(11) NOT NULL,
  `creado_por` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `actualizado_por` int(11) DEFAULT NULL,
  `fecha_actualizado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pagos_producto`
--

INSERT INTO `pagos_producto` (`id_pago`, `numero_cuota`, `fecha_pago_realizado`, `valor_cuota`, `id_estado_pago`, `fecha_pago`, `id_producto`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizado`) VALUES
(1, 1, NULL, 2000000, 1, '2020-05-12', 1, 1, '2020-05-12 03:05:49', 1, '2020-07-22 15:16:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `telefonos` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `ss` varchar(100) DEFAULT NULL COMMENT 'Seguro Social',
  `dob` date DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `asesor` int(11) DEFAULT NULL,
  `cita` date DEFAULT NULL,
  `hora_cita` varchar(20) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL COMMENT 'estado como dpto',
  `fecha_cracion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombres`, `apellidos`, `telefonos`, `direccion`, `ss`, `dob`, `email`, `asesor`, `cita`, `hora_cita`, `id_ciudad`, `id_estado`, `fecha_cracion`) VALUES
(1, 'Mauricio', 'Herrera Isaac', '3156371573, 3232058854', 'calle 67, # 26-42', '123456789', '1987-03-31', 'smaurville@gmail.com', 3, '2020-03-19', '2:00 PM', 1, 1, '2020-04-16 15:18:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `banco` varchar(100) NOT NULL,
  `titular` varchar(100) NOT NULL,
  `id_tipo_cuenta` int(11) NOT NULL,
  `numero_ruta` varchar(50) DEFAULT NULL,
  `numero_cuenta` varchar(50) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  `numero_cuotas` int(11) DEFAULT NULL,
  `ss_persona` varchar(100) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_tipo_producto` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `has_contract` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `banco`, `titular`, `id_tipo_cuenta`, `numero_ruta`, `numero_cuenta`, `valor`, `numero_cuotas`, `ss_persona`, `fecha_registro`, `id_tipo_producto`, `estado`, `has_contract`) VALUES
(1, 'BANCOLOMBIA', 'ANDRES MAURICIO HERRERA ISAAC', 1, 'calle 67, # 26-42', '899-956-6451-11', 2000000, 1, '123456789', '2020-04-14 16:30:03', 1, 'Activo', 0),
(2, 'BANCOLOMBIA', 'PEDRO PEREZ', 2, '8974562132', '899-956-6451-11', 1500000, 2, '123456789', '2020-05-04 18:09:48', 1, 'Activo', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `queues`
--

CREATE TABLE `queues` (
  `id` int(11) NOT NULL,
  `job` varchar(255) NOT NULL,
  `exec` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `queues`
--

INSERT INTO `queues` (`id`, `job`, `exec`) VALUES
(1, 'java -jar C:\\xampp\\htdocs\\CRMAPP\\Model\\PDFLibrary\\dist\\Mailer.jar mauricio.herrera.ajc@gmail.com Nikol0822 smaurville@gmail.com smtp.gmail.com true 587 true Contrato_123456789 123456789', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razon_disputas`
--

CREATE TABLE `razon_disputas` (
  `id_razon` int(11) NOT NULL,
  `razon` varchar(100) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `creado_por` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `razon_disputas`
--

INSERT INTO `razon_disputas` (`id_razon`, `razon`, `fecha_creacion`, `creado_por`) VALUES
(1, 'This account is a dupicate, please fix immedeately', '2020-07-01 15:23:42', 1),
(2, 'This account was paid, please update immedeately.', '2020-07-22 15:23:50', 1),
(3, 'I never paid late on this account please fix immedeately.', '2020-07-22 15:26:35', 1),
(4, 'This account is fraudulent, it was set through identity theft.', '2020-07-22 15:26:35', 1),
(5, 'My account was included in my bankrupcy.', '2020-07-22 15:26:35', 1),
(6, 'This account does not belong to me.', '2020-07-22 15:26:35', 1),
(7, 'This is not my account, it belongs to an individual with the same or similar name.', '2020-07-22 15:26:35', 1),
(8, 'I never made a late payment on this account, please fix it.', '2020-07-22 15:26:35', 1),
(9, 'My balance history is reporting incorrectly..', '2020-07-22 15:28:21', 1),
(10, 'This is not my name, please delete it.', '2020-07-22 15:28:21', 1),
(11, 'This consult is not mine , please delete it.', '2020-07-22 15:28:21', 1),
(12, 'This is not my adress, please delete it.', '2020-07-22 15:28:21', 1),
(13, 'These are not my addresses, please delete them.', '2020-07-22 15:28:21', 1),
(14, 'This is not my phone number, please delete it.', '2020-07-22 15:28:21', 1),
(15, 'This is not my SSN, please delete it.', '2020-07-22 15:29:21', 1),
(16, 'This date of birth is not mine, please delete it.', '2020-07-22 15:29:21', 1),
(17, 'This account was illegally renewed, please delete it.', '2020-07-22 15:29:21', 1),
(18, 'This account is obsolete, please delete it.', '2020-07-22 15:29:21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recordatorios`
--

CREATE TABLE `recordatorios` (
  `id_recordatorio` int(11) NOT NULL,
  `_from` int(11) NOT NULL,
  `_to` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `vence` date NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `estado` varchar(50) NOT NULL,
  `creado_por` int(11) NOT NULL,
  `actualizado_por` int(11) DEFAULT NULL,
  `fecha_actualizado` datetime DEFAULT NULL,
  `ss_persona` varchar(20) NOT NULL,
  `pending_to` text DEFAULT NULL,
  `complete_to` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recordatorios`
--

INSERT INTO `recordatorios` (`id_recordatorio`, `_from`, `_to`, `descripcion`, `vence`, `fecha_creacion`, `estado`, `creado_por`, `actualizado_por`, `fecha_actualizado`, `ss_persona`, `pending_to`, `complete_to`) VALUES
(1, 1, 3, 'Prueba desde admin', '2020-06-11', '2020-06-09 14:32:53', 'Cancelado', 1, 3, '2020-06-09 14:36:19', '123456789', NULL, NULL),
(2, 3, 3, 'dgssdfgfdg', '2020-07-09', '2020-07-07 18:49:26', 'Completado', 3, 3, '2020-07-12 15:47:02', '123456789', NULL, NULL),
(3, 3, 4, 'Prueba recordatorio', '2020-07-13', '2020-07-12 15:34:26', 'Completado', 3, 1, '2020-08-17 11:26:16', '123456789', NULL, NULL),
(5, 1, 0, 'Prueba rec para todos', '2020-07-22', '2020-07-22 09:51:14', 'Completado', 1, 3, '2020-07-22 12:06:36', '123456789', NULL, '1,4,3,');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `id_recurso` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  `ext` varchar(10) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `nombre_archivo` varchar(50) NOT NULL,
  `create_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`id_recurso`, `descripcion`, `ruta`, `ext`, `fecha_registro`, `nombre_archivo`, `create_by`) VALUES
(5, 'prueba', '../RecursosVentas/', 'pdf', '2020-04-18 10:03:36', 'prueba.pdf', NULL),
(6, 'sfdsdgdsfg', '../RecursosVentas/', 'xlsx', '2020-05-04 18:34:16', 'sfdsdgdsfg.xlsx', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resp_disputas`
--

CREATE TABLE `resp_disputas` (
  `id_rspuesta` int(11) NOT NULL,
  `id_disputa` int(11) NOT NULL,
  `fecha_respuesta` datetime NOT NULL,
  `respuesta` varchar(25) NOT NULL,
  `create_by` int(11) NOT NULL,
  `bureau` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `resp_disputas`
--

INSERT INTO `resp_disputas` (`id_rspuesta`, `id_disputa`, `fecha_respuesta`, `respuesta`, `create_by`, `bureau`) VALUES
(1, 1, '2020-08-17 10:55:30', 'ACTUALIZADA', 1, 'EXP'),
(2, 1, '2020-08-17 11:16:57', 'NO ACTUALIZADA', 1, 'EQF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sender_mail_config`
--

CREATE TABLE `sender_mail_config` (
  `id_cong` int(11) NOT NULL,
  `email_sender` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `stmp_port` varchar(10) NOT NULL,
  `smtp_host` varchar(30) NOT NULL,
  `smtp_auth` varchar(10) NOT NULL,
  `smtp_enable` varchar(10) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sender_mail_config`
--

INSERT INTO `sender_mail_config` (`id_cong`, `email_sender`, `pass`, `stmp_port`, `smtp_host`, `smtp_auth`, `smtp_enable`, `create_at`) VALUES
(1, 'mauricio.herrera.ajc@gmail.com', 'Nikol0822', '587', 'smtp.gmail.com', 'true', 'true', '2020-08-17 12:27:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `situacion`
--

CREATE TABLE `situacion` (
  `id_situacion` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `situacion`
--

INSERT INTO `situacion` (`id_situacion`, `estado`) VALUES
(1, 'LEAD'),
(2, 'CLIENTE'),
(3, 'SUSPENDIDO'),
(4, 'FINALIZADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `situacion_personas`
--

CREATE TABLE `situacion_personas` (
  `id_situacion` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `situacion_personas`
--

INSERT INTO `situacion_personas` (`id_situacion`, `id_persona`, `fecha_registro`) VALUES
(1, 1, '2020-03-18 13:59:53'),
(2, 1, '2020-07-13 09:48:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cuenta`
--

CREATE TABLE `tipo_cuenta` (
  `id_tipo_cuenta` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `creado_por` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_cuenta`
--

INSERT INTO `tipo_cuenta` (`id_tipo_cuenta`, `descripcion`, `fecha_creacion`, `creado_por`) VALUES
(1, 'CHEQUE', '2020-03-23 16:09:21', 1),
(2, 'AHORROS', '2020-03-23 16:09:36', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `tipo_doc` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `siglas` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`tipo_doc`, `nombre`, `siglas`) VALUES
(1, 'CEDULA DE CIUDADANIA', 'CC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id_tipo_producto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `creado_por` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id_tipo_producto`, `nombre`, `fecha_creacion`, `creado_por`) VALUES
(1, 'ALERTA', '2020-03-26 08:38:12', 1),
(2, 'REPARACIÓN', '2020-03-26 08:38:12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `descripcion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `descripcion`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'ASESOR'),
(3, 'COACH'),
(4, 'CUSTOMER'),
(5, 'SISTEMA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
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
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `tipo_doc`, `documento`, `nombres`, `apellidos`, `telefono`, `id_tipo_usuario`, `coach`, `franquicia`, `password`, `fecha_registro`, `foto`, `ext`) VALUES
(1, 1, '1113626301', 'Mauricio', 'Hererra', '1113626301', 1, NULL, NULL, '456', '2020-03-04 16:08:49', NULL, NULL),
(3, 1, '123456', 'Pedro', 'perez', '3232058854', 2, NULL, NULL, '123456', '2020-03-17 13:51:31', NULL, NULL),
(4, 1, '1234567890', 'Marcela', 'Garzon', '--', 1, NULL, NULL, '123456', '2020-06-11 16:17:21', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adjuntos`
--
ALTER TABLE `adjuntos`
  ADD PRIMARY KEY (`id_adjunto`),
  ADD KEY `id_persona` (`ss_persona`);

--
-- Indices de la tabla `analisis_persona`
--
ALTER TABLE `analisis_persona`
  ADD PRIMARY KEY (`id_analisis`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `disputas`
--
ALTER TABLE `disputas`
  ADD PRIMARY KEY (`id_disputa`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `id_persona` (`ss_persona`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ciudad` (`id_ciudad`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `estados_de_pago`
--
ALTER TABLE `estados_de_pago`
  ADD PRIMARY KEY (`id_estado_pago`);

--
-- Indices de la tabla `estados_personas`
--
ALTER TABLE `estados_personas`
  ADD PRIMARY KEY (`id_estado`,`id_persona`,`fecha_registro`);

--
-- Indices de la tabla `log_pagos_producto`
--
ALTER TABLE `log_pagos_producto`
  ADD PRIMARY KEY (`id_log`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificacion`);

--
-- Indices de la tabla `notificacion_personas`
--
ALTER TABLE `notificacion_personas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documento_persona` (`documento_persona`);

--
-- Indices de la tabla `pagos_personas`
--
ALTER TABLE `pagos_personas`
  ADD PRIMARY KEY (`id_pago`);

--
-- Indices de la tabla `pagos_producto`
--
ALTER TABLE `pagos_producto`
  ADD PRIMARY KEY (`id_pago`) USING BTREE;

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ss` (`ss`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `queues`
--
ALTER TABLE `queues`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `razon_disputas`
--
ALTER TABLE `razon_disputas`
  ADD PRIMARY KEY (`id_razon`);

--
-- Indices de la tabla `recordatorios`
--
ALTER TABLE `recordatorios`
  ADD PRIMARY KEY (`id_recordatorio`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`id_recurso`);

--
-- Indices de la tabla `resp_disputas`
--
ALTER TABLE `resp_disputas`
  ADD PRIMARY KEY (`id_rspuesta`);

--
-- Indices de la tabla `sender_mail_config`
--
ALTER TABLE `sender_mail_config`
  ADD PRIMARY KEY (`id_cong`);

--
-- Indices de la tabla `situacion`
--
ALTER TABLE `situacion`
  ADD PRIMARY KEY (`id_situacion`);

--
-- Indices de la tabla `situacion_personas`
--
ALTER TABLE `situacion_personas`
  ADD PRIMARY KEY (`id_situacion`,`id_persona`);

--
-- Indices de la tabla `tipo_cuenta`
--
ALTER TABLE `tipo_cuenta`
  ADD PRIMARY KEY (`id_tipo_cuenta`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`tipo_doc`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id_tipo_producto`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adjuntos`
--
ALTER TABLE `adjuntos`
  MODIFY `id_adjunto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `analisis_persona`
--
ALTER TABLE `analisis_persona`
  MODIFY `id_analisis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `disputas`
--
ALTER TABLE `disputas`
  MODIFY `id_disputa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `estados_de_pago`
--
ALTER TABLE `estados_de_pago`
  MODIFY `id_estado_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `log_pagos_producto`
--
ALTER TABLE `log_pagos_producto`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificacion_personas`
--
ALTER TABLE `notificacion_personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos_personas`
--
ALTER TABLE `pagos_personas`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos_producto`
--
ALTER TABLE `pagos_producto`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `queues`
--
ALTER TABLE `queues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `razon_disputas`
--
ALTER TABLE `razon_disputas`
  MODIFY `id_razon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `recordatorios`
--
ALTER TABLE `recordatorios`
  MODIFY `id_recordatorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id_recurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `resp_disputas`
--
ALTER TABLE `resp_disputas`
  MODIFY `id_rspuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sender_mail_config`
--
ALTER TABLE `sender_mail_config`
  MODIFY `id_cong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `situacion`
--
ALTER TABLE `situacion`
  MODIFY `id_situacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_cuenta`
--
ALTER TABLE `tipo_cuenta`
  MODIFY `id_tipo_cuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `tipo_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id_tipo_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
