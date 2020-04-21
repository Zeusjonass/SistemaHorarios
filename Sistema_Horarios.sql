-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2020 at 08:31 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistemahorario`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumno`
--

CREATE TABLE `alumno` (
  `idAlumno` int(11) NOT NULL,
  `NomAlum` varchar(45) NOT NULL,
  `Licenciatura` varchar(15) NOT NULL,
  `idUsuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alumno`
--

INSERT INTO `alumno` (`idAlumno`, `NomAlum`, `Licenciatura`, `idUsuario`) VALUES
(1, 'Zeus', 'LIS', 'alum1'),
(2, 'Tsuki', 'LIS', 'alum2'),
(3, 'Jorge', 'LIS', 'alum3');

-- --------------------------------------------------------

--
-- Table structure for table `alumnoinscrito`
--

CREATE TABLE `alumnoinscrito` (
  `idCurso` int(11) NOT NULL,
  `idAlumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alumnoinscrito`
--

INSERT INTO `alumnoinscrito` (`idCurso`, `idAlumno`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 2),
(2, 3),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `clase`
--

CREATE TABLE `clase` (
  `idClase` int(11) NOT NULL,
  `idCurso` int(11) NOT NULL,
  `idSalon` int(11) NOT NULL,
  `Dia` varchar(10) NOT NULL,
  `HoraInicio` varchar(10) NOT NULL,
  `HoraFin` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clase`
--

INSERT INTO `clase` (`idClase`, `idCurso`, `idSalon`, `Dia`, `HoraInicio`, `HoraFin`) VALUES
(3, 1, 1, 'Viernes', '07:30', '09:00'),
(5, 2, 1, 'Martes', '07:30', '09:00'),
(6, 3, 3, 'Jueves', '08:00', '10:00'),
(7, 4, 1, 'Lunes', '09:00', '10:00'),
(8, 5, 3, 'Jueves', '07:00', '08:00'),
(9, 5, 4, 'Lunes', '07:30', '09:00');

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `idCurso` int(11) NOT NULL,
  `idMateria` int(11) NOT NULL,
  `idProfesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`idCurso`, `idMateria`, `idProfesor`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 2, 1),
(5, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `materia`
--

CREATE TABLE `materia` (
  `idMateria` int(11) NOT NULL,
  `DescMat` varchar(20) NOT NULL,
  `Creditos` int(11) NOT NULL,
  `NomMat` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `materia`
--

INSERT INTO `materia` (`idMateria`, `DescMat`, `Creditos`, `NomMat`) VALUES
(1, 'IHC', 6, 'Interaccion Humano Computadora'),
(2, 'SQA', 6, 'Aseguramiento de la Calidad de Software'),
(3, 'Requisitos', 7, 'Analisis de Requisitos de Software');

-- --------------------------------------------------------

--
-- Table structure for table `profesor`
--

CREATE TABLE `profesor` (
  `idProfesor` int(11) NOT NULL,
  `NomProf` varchar(45) NOT NULL,
  `idUsuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profesor`
--

INSERT INTO `profesor` (`idProfesor`, `NomProf`, `idUsuario`) VALUES
(1, 'Victor Hugo', 'prof1'),
(2, 'Rene', 'prof2'),
(3, 'Carlos', 'prof3');

-- --------------------------------------------------------

--
-- Table structure for table `salon`
--

CREATE TABLE `salon` (
  `idSalon` int(11) NOT NULL,
  `DescSalon` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salon`
--

INSERT INTO `salon` (`idSalon`, `DescSalon`) VALUES
(1, 'C1'),
(2, 'C2'),
(3, 'C3'),
(4, 'C4');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` varchar(20) NOT NULL,
  `Password` varchar(16) NOT NULL,
  `Rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `Password`, `Rol`) VALUES
('admin', 'admin', 1),
('alum1', 'alum1', 3),
('alum2', 'alum2', 3),
('alum3', 'alum3', 3),
('prof1', 'prof1', 2),
('prof2', 'prof2', 2),
('prof3', 'prof3', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`idAlumno`),
  ADD KEY `idUsuario_AL` (`idUsuario`);

--
-- Indexes for table `alumnoinscrito`
--
ALTER TABLE `alumnoinscrito`
  ADD KEY `idCurso_AI` (`idCurso`),
  ADD KEY `idAlumno_AI` (`idAlumno`);

--
-- Indexes for table `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`idClase`),
  ADD KEY `idCurso` (`idCurso`),
  ADD KEY `idSalon` (`idSalon`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idCurso`),
  ADD KEY `idMateria_CR` (`idMateria`),
  ADD KEY `idProfesor_CR` (`idProfesor`);

--
-- Indexes for table `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`idMateria`);

--
-- Indexes for table `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`idProfesor`),
  ADD KEY `idUsuario_PR` (`idUsuario`);

--
-- Indexes for table `salon`
--
ALTER TABLE `salon`
  ADD PRIMARY KEY (`idSalon`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumno`
--
ALTER TABLE `alumno`
  MODIFY `idAlumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clase`
--
ALTER TABLE `clase`
  MODIFY `idClase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `idCurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `materia`
--
ALTER TABLE `materia`
  MODIFY `idMateria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profesor`
--
ALTER TABLE `profesor`
  MODIFY `idProfesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salon`
--
ALTER TABLE `salon`
  MODIFY `idSalon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `idUsuario_AL` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `alumnoinscrito`
--
ALTER TABLE `alumnoinscrito`
  ADD CONSTRAINT `idAlumno_AI` FOREIGN KEY (`idAlumno`) REFERENCES `alumno` (`idAlumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idCurso_AI` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clase`
--
ALTER TABLE `clase`
  ADD CONSTRAINT `idCurso` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idSalon` FOREIGN KEY (`idSalon`) REFERENCES `salon` (`idSalon`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `idMateria` FOREIGN KEY (`idMateria`) REFERENCES `materia` (`idMateria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idProfesor` FOREIGN KEY (`idProfesor`) REFERENCES `profesor` (`idProfesor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `idUsuario_PR` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
