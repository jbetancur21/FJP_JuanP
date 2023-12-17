SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `bancos` (
  `nombre` varchar(70) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `cuentas` (
  `id` int(3) NOT NULL,
  `nombre_banco` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `dinero` int(9) NOT NULL,
  `usuarios_usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `gfijos` (
  `id` int(2) NOT NULL,
  `nombre_usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `gasto` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `pago` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `valor` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `movimientos` (
  `nombre_usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `cuentas_nombre` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `id` int(9) NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `valor` int(200) NOT NULL,
  `tipos_movimientos_nombre` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `gfijos_id` int(2) DEFAULT NULL,
  `prestamos_id` int(9) DEFAULT NULL,
  `tipos_gastos_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `prestamos` (
  `id` int(9) NOT NULL,
  `nombre_usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `origen` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `prestada` int(20) NOT NULL,
  `abonada` int(3) NOT NULL,
  `pendiente` int(3) NOT NULL,
  `abonado` int(20) NOT NULL,
  `fecha` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `tipos_gastos` (
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `tipos_movimientos` (
  `nombre` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `usuarios` (
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `contraseña` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE `bancos`
  ADD PRIMARY KEY (`nombre`);

ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuentas_usuarios_fk` (`usuarios_usuario`),
  ADD KEY `nombre` (`nombre_banco`);

ALTER TABLE `gfijos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario` (`nombre_usuario`);

ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movimientos_tipos_gastos_fk` (`tipos_gastos_nombre`),
  ADD KEY `tipos_movimientos_fk` (`tipos_movimientos_nombre`),
  ADD KEY `fk_id_gfijos` (`gfijos_id`),
  ADD KEY `cuentas_nombre` (`cuentas_nombre`),
  ADD KEY `fk_nombre_usuario` (`nombre_usuario`),
  ADD KEY `prestamos_id` (`prestamos_id`);

ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario` (`nombre_usuario`);

ALTER TABLE `tipos_gastos`
  ADD PRIMARY KEY (`nombre`);

ALTER TABLE `tipos_movimientos`
  ADD PRIMARY KEY (`nombre`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);


ALTER TABLE `cuentas`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `gfijos`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;

ALTER TABLE `movimientos`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `prestamos`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


ALTER TABLE `cuentas`
  ADD CONSTRAINT `cuentas_ibfk_1` FOREIGN KEY (`nombre_banco`) REFERENCES `bancos` (`nombre`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cuentas_usuarios_fk` FOREIGN KEY (`usuarios_usuario`) REFERENCES `usuarios` (`usuario`);

ALTER TABLE `gfijos`
  ADD CONSTRAINT `gfijos_ibfk_1` FOREIGN KEY (`nombre_usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`gfijos_id`) REFERENCES `gfijos` (`id`),
  ADD CONSTRAINT `movimientos_ibfk_2` FOREIGN KEY (`cuentas_nombre`) REFERENCES `bancos` (`nombre`) ON UPDATE CASCADE,
  ADD CONSTRAINT `movimientos_ibfk_3` FOREIGN KEY (`nombre_usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movimientos_ibfk_4` FOREIGN KEY (`prestamos_id`) REFERENCES `prestamos` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `movimientos_tipos_gastos_fk` FOREIGN KEY (`tipos_gastos_nombre`) REFERENCES `tipos_gastos` (`nombre`),
  ADD CONSTRAINT `tipos_movimientos_fk` FOREIGN KEY (`tipos_movimientos_nombre`) REFERENCES `tipos_movimientos` (`nombre`);

ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`nombre_usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
