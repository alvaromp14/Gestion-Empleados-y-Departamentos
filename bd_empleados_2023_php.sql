--
-- Base de datos: `bd_empleados_2023_php`
--
CREATE DATABASE IF NOT EXISTS `bd_empleados_2023_php` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bd_empleados_2023_php`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antiguos_empleados`
--

CREATE TABLE `antiguos_empleados` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nif` varchar(9) NOT NULL,
  `apellidos` varchar(25) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `profesion` varchar(15) NOT NULL,
  `salario` double NOT NULL,
  `fechaNac` date NOT NULL,
  `fechaIng` date NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `tipoBaja` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `antiguos_empleados`
--

INSERT INTO `antiguos_empleados` (`id`, `codigo`, `nif`, `apellidos`, `nombre`, `profesion`, `salario`, `fechaNac`, `fechaIng`, `idDepartamento`, `tipoBaja`) VALUES
(10, 'a12b', '12347778M', 'curso', 'prueba', 'recuperacion', 123, '2024-01-29', '2024-01-31', 12, 'despido'),
(12, '1a11a', '44312328K', 'Sesión', 'Funciona', 'sesss', 1111, '2023-05-30', '2023-09-13', 11, 'medica'),
(13, '22', '59901715H', 'Apellidez', 'Nombrecin', 'Currante', 2000, '1970-01-01', '1970-01-01', 9, 'medica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credenciales`
--

CREATE TABLE `credenciales` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `credenciales`
--

INSERT INTO `credenciales` (`id`, `usuario`, `contraseña`) VALUES
(1, 'adminEmpleados', 'admin123'),
(2, 'adminDepartamentos', 'admin123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `codigo`, `descripcion`) VALUES
(1, 'C1', 'Curso 1'),
(2, 'C2', 'Curso 2'),
(3, 'C3', 'Curso 3'),
(4, 'C4', 'Curso 4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id` int(11) NOT NULL,
  `codigo` varchar(2) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `localizacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id`, `codigo`, `descripcion`, `localizacion`) VALUES
(6, '17', 'Programación', 'Albacete'),
(8, '15', 'Ciberseguridad', 'Madrid'),
(9, '1', 'Recursos Humanos', 'Valencia'),
(11, '33', 'Examen', 'Clase'),
(12, '15', 'Vacio', 'V');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nif` varchar(9) NOT NULL,
  `apellidos` varchar(25) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `profesion` varchar(15) NOT NULL,
  `salario` double NOT NULL,
  `fechaNac` date NOT NULL,
  `fechaIng` date NOT NULL,
  `idDepartamento` int(11) DEFAULT NULL,
  `idCurso` int(11) DEFAULT NULL,
  `idSeguro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `codigo`, `nif`, `apellidos`, `nombre`, `profesion`, `salario`, `fechaNac`, `fechaIng`, `idDepartamento`, `idCurso`, `idSeguro`) VALUES
(1, '14', '49801912N', 'molina', 'alvaro', 'prog', 1200, '2001-06-04', '1970-01-01', 6, 4, 1),
(3, '2', '80197533C', 'Apellido Saz', 'Nombre', 'Profesional', 1000, '1970-01-01', '1970-01-01', 8, 2, 2),
(9, '33', '12345678M', 'Examen', 'Examen', 'Profesor', 1234, '2023-11-01', '2023-11-27', 11, NULL, 2),
(14, 'a1255', '12312378M', 'curso', 'cookie2', 'recuperacion2', 1235, '2024-01-01', '2024-02-01', 11, NULL, 2),
(15, 'a1254', '12312478M', 'curso', 'cookie3', 'recuperacion3', 1235, '2024-01-29', '2024-01-31', 11, NULL, NULL),
(18, 'a1253', '12333478M', 'curso4', 'cookie4', 'recuperacion4', 1235, '2024-01-29', '2024-01-30', 8, 1, NULL),
(22, 'a12', '12343455J', 'curso5', 'cookie5', 'recuperacion5', 1235, '2024-01-09', '2024-01-31', 11, 1, NULL),
(24, '123', '12312378K', 'Cookie', 'Funciona', 'Galleta', 1111, '2023-11-27', '2024-01-30', 9, 2, NULL),
(31, '1a123', '44312323B', 'Ses', 'Fun', 'ses', 1112, '2024-01-29', '2024-01-30', 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguros_medicos`
--

CREATE TABLE `seguros_medicos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `siglas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `seguros_medicos`
--

INSERT INTO `seguros_medicos` (`id`, `codigo`, `siglas`) VALUES
(1, 'S1', 'Seguro 1'),
(2, 'S2', 'Seguro 2'),
(3, 'S3', 'Seguro 3');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `antiguos_empleados`
--
ALTER TABLE `antiguos_empleados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD UNIQUE KEY `nif` (`nif`),
  ADD KEY `idDepartamento` (`idDepartamento`);

--
-- Indices de la tabla `credenciales`
--
ALTER TABLE `credenciales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD UNIQUE KEY `nif` (`nif`),
  ADD KEY `idDepartamento` (`idDepartamento`),
  ADD KEY `idCurso` (`idCurso`),
  ADD KEY `idSeguro` (`idSeguro`) USING BTREE;

--
-- Indices de la tabla `seguros_medicos`
--
ALTER TABLE `seguros_medicos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `antiguos_empleados`
--
ALTER TABLE `antiguos_empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `credenciales`
--
ALTER TABLE `credenciales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `seguros_medicos`
--
ALTER TABLE `seguros_medicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`id`),
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`idCurso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empleado_ibfk_3` FOREIGN KEY (`idSeguro`) REFERENCES `seguros_medicos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

