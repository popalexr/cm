-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: mai 24, 2019 la 09:24 PM
-- Versiune server: 10.1.40-MariaDB
-- Versiune PHP: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `lucru`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `admini`
--

CREATE TABLE `admini` (
  `id` int(4) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `last` date NOT NULL,
  `nume` varchar(100) NOT NULL,
  `prenume` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `zona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `admini`
--

INSERT INTO `admini` (`id`, `user`, `pass`, `ip`, `last`, `nume`, `prenume`, `email`, `zona`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '0.0.0.0', '0000-00-00', 'Popescu', 'Emil', 'email@email.ro', 1),
(2, 'admin2', 'c84258e9c39059a89ab77d846ddab909', '0.0.0.0', '0000-00-00', 'nume', 'prenume', '', 2);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `concurenti`
--

CREATE TABLE `concurenti` (
  `id` varchar(9) NOT NULL,
  `nume` varchar(20) NOT NULL,
  `prenume` varchar(50) NOT NULL,
  `cnp` int(13) NOT NULL,
  `seriebuletin` varchar(9) NOT NULL,
  `scoala` varchar(100) NOT NULL,
  `clasa` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `concurenti`
--

INSERT INTO `concurenti` (`id`, `nume`, `prenume`, `cnp`, `seriebuletin`, `scoala`, `clasa`) VALUES
('SM_10_01', 'Popescu', 'Emil SM', 2147483647, 'SM995331', 'Liceu SM', 10),
('MM_10_02', 'Popescu', 'Emil SM', 2147483647, 'mm99934', 'Liceu BM', 10),
('MM_9_02', 'Popescu', 'Marcel', 2147483647, 'mm99934', 'L MM', 9),
('MM_11_02', 'Pop', 'Ion', 2147483647, 'mm99934', 'Liceu SM', 11),
('MM_12_01', 'elev12', 'elev12', 2147483647, 'MM999876', 'Alt liceu BM', 12),
('MM_12_02', 'Georgescu', 'Popescu', 2147483647, 'MM999876', 'Alt liceu BM', 12),
('MM_11_03', 'elev11', 'Popescu', 2147483647, 'MM999876', 'Alt liceu BM', 11),
('MM_10_03', 'Georgescu', 'elev12', 2147483647, 'MM999876', 'Alt liceu BM', 10),
('MM_9_01', 'elev11', 'Popescu', 2147483647, 'MM999876', 'Liceu BM', 9),
('MM_9_03', 'elev12', 'elev12', 2147483647, 'MM999876', 'Un prim liceu bm', 9);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `fisiere`
--

CREATE TABLE `fisiere` (
  `idelev` int(11) NOT NULL,
  `fisier1` int(11) NOT NULL,
  `fisier2` int(11) NOT NULL,
  `fisier3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `repartizare`
--

CREATE TABLE `repartizare` (
  `idzona` text NOT NULL,
  `idelev` text NOT NULL,
  `sala` int(11) NOT NULL,
  `pozitie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `repartizare`
--

INSERT INTO `repartizare` (`idzona`, `idelev`, `sala`, `pozitie`) VALUES
('SM', 'SM_10_01', 0, 0),
('MM', 'MM_10_02', 2, 1),
('MM', 'MM_9_02', 1, 1),
('MM', 'MM_11_02', 2, 2),
('MM', 'MM_12_01', 1, 2),
('MM', 'MM_12_02', 1, 4),
('MM', 'MM_11_03', 2, 4),
('MM', 'MM_10_03', 2, 3),
('MM', 'MM_9_01', 1, 3),
('MM', 'MM_9_03', 1, 5);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `zona`
--

CREATE TABLE `zona` (
  `idzona` int(11) NOT NULL,
  `denumire` varchar(20) NOT NULL,
  `prescurtare` varchar(3) NOT NULL,
  `idadmin` int(3) NOT NULL,
  `scoala` varchar(100) NOT NULL,
  `adresa` varchar(1000) NOT NULL,
  `ipscoala` varchar(15) NOT NULL,
  `sali` int(11) NOT NULL,
  `locuri` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `zona`
--

INSERT INTO `zona` (`idzona`, `denumire`, `prescurtare`, `idadmin`, `scoala`, `adresa`, `ipscoala`, `sali`, `locuri`) VALUES
(1, 'Maramures', 'MM', 1, 'Racovita', 'RTepublicii', '82.78.33.122', 3, 20),
(2, 'Satu Mare', 'SM', 2, 'scola din SM', 'adresa din SM', '182.78.33.122', 2, 13);

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `admini`
--
ALTER TABLE `admini`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`idzona`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `admini`
--
ALTER TABLE `admini`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pentru tabele `zona`
--
ALTER TABLE `zona`
  MODIFY `idzona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
