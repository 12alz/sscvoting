-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2022 at 06:12 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `votesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`) VALUES
(1, 'admin', '$2y$10$OZ7r11WWr0Dng0pjEpC3yOHg6d4kG.RcfJk8NyINI0u7mhrO4UHMu', 'Administrator', '', 'o.jpg', '2018-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `platform` text NOT NULL,
  `course` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `position_id`, `firstname`, `lastname`, `photo`, `platform`, `course`) VALUES
(138, 32, 'Kurt Bryan Alegre', '', 'images.jpg', '', 'BSIT'),
(139, 32, 'Ronnel Bacolod', '', 'images.jpg', '', 'BSIT'),
(141, 33, 'Richard Bracero', '', 'images.jpg', '', 'BSIT'),
(142, 33, 'Nino Jay Batiancila', '', 'images.jpg', '', 'BSIT'),
(143, 34, 'Mark Louis Cornea', '', 'images.jpg', '', 'BSIT'),
(144, 34, 'Romel Escarlan', '', 'images.jpg', '', 'BSIT'),
(145, 35, 'Jason Escobillo', '', 'images.jpg', '', 'BSIT'),
(146, 35, 'Cesar Esgana', '', 'images.jpg', '', 'BSIT'),
(147, 36, 'Marc Vincent Fariolen', '', 'images.jpg', '', 'BSIT'),
(148, 36, 'Jason Gila', '', 'images.jpg', '', 'BSIT'),
(149, 36, 'Junior Gilbuena', '', 'images.jpg', '', 'BSIT'),
(150, 37, 'John Lenard Santillan', '', 'images.jpg', '', 'BSHM'),
(151, 37, 'Jona Mae Ungon', '', 'images.jpg', '', 'BSHM'),
(152, 37, 'Nino Signo', '', 'images.jpg', '', 'BSHM'),
(153, 38, 'Alma Magallanes', '', 'images.jpg', '', 'BSBA'),
(154, 38, 'Julirose Cervantes', '', 'images.jpg', '', 'BSBA'),
(155, 38, 'John Mark Pepino', '', 'images.jpg', '', 'BSBA'),
(156, 39, 'Angelie Gilbuela', '', 'images.jpg', '', 'BEED'),
(158, 39, 'Angelica Gilbuela', '', 'images.jpg', '', 'BEED'),
(159, 39, 'Jayvee Villacarlos', '', 'images.jpg', '', 'BEED'),
(160, 40, 'Sharon Rose Tayactac', '', 'images.jpg', '', 'BSED'),
(161, 40, 'Sheena Chavez', '', 'images.jpg', '', 'BSED'),
(162, 40, 'Gia Pantaleon', '', 'images.jpg', '', 'BSBA'),
(169, 43, 'Jacklyn  Alegre', '', 'images.jpg', '', 'BSIT'),
(170, 43, 'Cynthia Dianne Aque', '', 'images.jpg', '', 'BSIT'),
(172, 43, 'Jesa Limpag', '', 'images.jpg', '', 'BSIT');

-- --------------------------------------------------------

--
-- Table structure for table `elec_date`
--

CREATE TABLE `elec_date` (
  `id` int(11) NOT NULL,
  `electdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `max_vote` int(11) NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `description`, `max_vote`, `priority`) VALUES
(32, 'President', 1, 1),
(33, 'Vice-President', 1, 2),
(34, 'Secretary', 1, 3),
(35, 'Treasurer', 1, 4),
(36, 'P.I.O', 2, 5),
(37, 'BSHM-Representative', 2, 6),
(38, 'BSBA-Representative', 2, 7),
(39, 'BEED-Representative', 2, 8),
(40, 'BSED-Representative', 2, 9),
(43, 'BSIT-Representative', 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `voters_id` varchar(15) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `course` varchar(60) NOT NULL,
  `recstat` int(11) NOT NULL,
  `status` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `voters_id`, `password`, `firstname`, `lastname`, `photo`, `course`, `recstat`, `status`) VALUES
(160, 'ssc-002', '$2y$10$eXbYuN0WI.tHIUVcGSs/Buu5FlxRhgBSky6ET9YiO1q1QXie1pLvm', 'Ronnel', 'Bacolod', 'FB_IMG_16106744709614043.jpg', 'BSIT', 0, 'Active'),
(161, 'ssc-003', '$2y$10$zbn0vST9Kh7DGKtHpegMk.p4rzJHzIdrBmimRDh6.pG.R2VHnfRn6', 'Nino Jay', 'Batiancila', '', 'BSIT', 0, 'Active'),
(162, 'ssc-004', '$2y$10$yjWPLdurRKHpdGQeTaia1.Yaljjc/fCqQ2MHc3yYsy55aG15Xsb9m', 'Richard', 'Bracero', '', 'BSIT', 0, 'Active'),
(163, 'ssc-005', '$2y$10$w2bxoQ1sulBZD05fSNK7KO87kY9jENPhsjdTmBr8ljRAgy1x6MWri', 'Mark Louis', 'Cornea', '', 'BSIT', 0, 'Active'),
(164, 'ssc-006', '$2y$10$xenXHlsDkKGJRmv6TYw7ReO4hR6.JRRtKCv/.7p4S/XDFVlMdX7Fy', 'Romel', 'Escarlan', '', 'BSIT', 0, 'Active'),
(165, 'ssc-007', '$2y$10$nPO.jgLoKNqClMAXu8SOsuQ7giBYa6eDm1AGPLqXk8lgmqw1ODDtS', 'Jason', 'Escobillo', '', 'BSIT', 0, '0'),
(166, 'ssc-008', '$2y$10$DY2evbYbaDYTweaw26At/O5XKdE0hC65FTIn8HVdO1BI/QjfjPR8S', 'Cesar', 'Esgana', '', 'BSIT', 0, '0'),
(167, 'ssc-009', '$2y$10$RKwPxI7w0PH9Z1sSZyaHieDNvdQ0TrSkI1HReQdMU970v57ZTyAYG', 'Marc Vincent', 'Fariolen', '', 'BSIT', 0, '0'),
(168, 'ssc-010', '$2y$10$aI94CKv7rR3MEiBGa4gEden88GOZYra9fDys5jDZ5dufNj7VayOP2', 'Jason', 'Gila', '', 'BSIT', 0, '0'),
(169, 'ssc-011', '$2y$10$56D/eSfcJ9ijuOeOnqJMlugg4CcGyM8.AAAFLtumKGUVSQKXFN1oy', 'Junior', 'Gilbuena', '', 'BSIT', 0, '0'),
(170, 'ssc-012', '$2y$10$d/n4SFkCxHzeDlvBgURAcOMyIP/fjVBCgL4N14OHtvYBNH/HWHSI2', 'Juniel', 'Marfa', '', 'BSIT', 0, '0'),
(171, 'ssc-013', '$2y$10$C4nTwgCPbmydYOdlc9i1MuAq51uiFMWqcFx0kMXqi0I38U9Nc13/G', 'Jupril', 'Quiamco', '', 'BSIT', 0, '0'),
(172, 'ssc-014', '$2y$10$Y5YI0GuqsVDf1Hkc3qcHMuhcbg8oI66VFBwgh3C3jS.36yNPvm89S', 'Antonio', 'Quezon', '', 'BSIT', 0, '0'),
(173, 'ssc-015', '$2y$10$aC8Aqoez.0GoppOuHVeG2.IULzPIRBk1hEXm96TDpZkUuWk3GU91S', 'Vincent', 'Sevilleno', '', 'BSIT', 0, '0'),
(174, 'ssc-016', '$2y$10$3Cd7MSz2WRXHMdL5b3wR0.ksf9EachlBdIG8YAG6GKnQVVd.FX.OG', 'Rene Jun', 'Taes', '', 'BSIT', 0, '0'),
(175, 'ssc-017', '$2y$10$.j.ZNwbDeP8j2b/koakwt.R2fvbAl/pA6dmfuwd.c9o0rfm7xzORK', 'Jacklyn ', 'Alegre', '', 'BSIT', 0, '0'),
(176, 'ssc-018', '$2y$10$1LdiQfDhw6TDHaTSusJLBeVKf.8YJjJhLXaUV93cqvzmE.8IpUImu', 'Cynthia Dianne', 'Aque', '', 'BSIT', 0, '0'),
(177, 'ssc-019', '$2y$10$3hwDIW./IJs8fHO9BngTLOtJIC5BzdLSGsn02lcPO09oUyeY9iuJO', 'Jona', 'Baoc', '', 'BSIT', 0, '0'),
(178, 'ssc-020', '$2y$10$HxvU1YJWYF10608A7x3FMexVIyLnj6NpLsp068ZIddH/tzfmKjBYC', 'Erika Ann', 'Cueva', '', 'BSIT', 0, '0'),
(179, 'ssc-021', '$2y$10$2SwzqElz4cvX8YpoqlzmKeJ0ce951gGo1xtmUjTl41xrZVM8VSryG', 'Renabel', 'Cueva', '', 'BSIT', 0, '0'),
(180, 'ssc-022', '$2y$10$MBgGcUisWRQGYzrMaruu/ePF9/hT9iBVabprWR5gTK7ccFFEYaft2', 'Marife', 'De Lara', '', 'BSIT', 0, '0'),
(181, 'ssc-023', '$2y$10$r2ViZUp71RaugBoJgH814.noukfr1EZsOnysgEtW.8Jt/9wu7O7/u', 'Ezel', 'Dela Pena', '', 'BSIT', 0, '0'),
(182, 'ssc-024', '$2y$10$bqEokvPQBPtV1lsTaT4wtuQ6f6qvho7ZaK1i9m2qwiTOIPWDBsEj.', 'Ranie Joy', 'Hijapon', '', 'BSIT', 0, '0'),
(183, 'ssc-025', '$2y$10$tExlvlR97YSzrLVLiKTXDewV3lwwDqzk2ZK2TGqYWHha2QchhISqi', 'Arjaylyn', 'Leones', '', 'BSIT', 0, '0'),
(184, 'ssc-026', '$2y$10$DjGTxGuYLKNauEZDwjcBKuehNdl6K8uMefzir5TQt6pB7IRzo0rhS', 'Jesa', 'Limpag', '', 'BSIT', 0, '0'),
(185, 'ssc-027', '$2y$10$JCmVv/Iat9HTOQdDYqdMbetMpm2BZ1B6fSEBDvis/j77J/sZJbDwi', 'Rezalyn', 'Mansueto', '', 'BSIT', 0, '0'),
(186, 'ssc-028', '$2y$10$CVR5ud9flmNDks2eKJpwvOWQT639UVyqcXcGe0PHh0ofbjAhkxYIC', 'Maria flor', 'Pepito', '', 'BSIT', 0, '0'),
(187, 'ssc-029', '$2y$10$XUGQl8Vu.8kO52TOjU/8huxnycduMZ.M8kijIvjc4No.W2wdA.jtO', 'Alde Kace', 'Sevilleno', '', 'BSIT', 0, '0'),
(188, 'ssc-030', '$2y$10$/wEBT82gPC54JRMVcr69bunyaksRRs3QC6iMJTdyGm0.jY3UdnAgK', 'Sherlyn', 'Sevilleno', '', 'BSIT', 0, '0'),
(189, 'ssc-031', '$2y$10$1aG87eKcQqyLZZ7s7ae8u.pH1nw4V9V6UBRGxYco6NyAo5c8zjmhy', 'Jiezela', 'Veliganio', '', 'BSIT', 0, '0'),
(190, 'ssc-032', '$2y$10$IhqMGaCb.it9nPx4aGYtdOs3vE9wa7L8jmVj5g5Xt0MqX0K8d20K2', 'Julius', 'Batayola', '', 'BSIT', 0, '0'),
(191, 'ssc-033', '$2y$10$ClBurNeZT3pfJQXr/tHXTOhLWo6GDDcj/Pqn0psrYmEK.may.M.u6', 'Jupher John', 'Otic', '', 'BSIT', 0, '0'),
(192, 'ssc-034', '$2y$10$xYU.WKyB9SHdxDjEa8DqV.HWmC6uK/8D0mwcdmOqVcQK3.C/R9G.G', 'Glores', 'Tenedo', '', 'BSIT', 0, '0'),
(193, 'ssc-035', '$2y$10$oi1BxMVWR4/fNaq5ge1OxOh4VhvpiynQ/NE97EA6qX6V3TrGmN/He', 'Art James', 'Maru', '', 'BSIT', 0, '0'),
(194, 'ssc-036', '$2y$10$8qWSpZte/fVGv9I9CVklseEsjoWfRHdy4DDWB/heNOgrXlkQ7QaAK', 'Jeanebeth', 'Corridor', '', 'BSIT', 0, '0'),
(195, 'ssc-037', '$2y$10$jLGHdkMGly9A6tThFxQOYOGhg/i.G7PdqpAaAuKYIBEVhNjolOhaq', 'Angelie', 'Gilbuela', '', 'BEED', 0, '0'),
(197, 'ssc-038', '$2y$10$SI8IoWX6KFLDPxBIRRYU0.zOam4Du8X46SR2qJwm5NT7j0QqI8OSe', 'Angelica', 'Gilbuela', '', 'BEED', 0, '0'),
(198, 'ssc-039', '$2y$10$me8/ycYVmYIgplSGArFCVeG7RNsNJaB6/fe6siCI5/g/M6p4AqZWi', 'Jayvee', 'Villacarlos', '', 'BEED', 0, '0'),
(199, 'ssc-040', '$2y$10$55I6aDzbwOgP8Fzw6D9W1.EGIUKWHrRvjNxvSwONyXYVJgBbThZFu', 'Alma', 'Magallanes', '', 'BSBA', 0, '0'),
(200, 'ssc-041', '$2y$10$MZ.uPb0l0NNg9X6rCDP5sOUtj/O.56X8fsVC3kWuDOuzDyi3UnFT2', 'Julirose', 'Cervantes', '', 'BSBA', 0, '0'),
(201, 'ssc-042', '$2y$10$12kdsfrMKMpl88IR9SIKE.5KlAPA6cQYDa8F5kHcEI0lFt5o9Cj7q', 'John Mark', 'Pepino', '', 'BSBA', 0, '0'),
(202, 'ssc-043', '$2y$10$YMnWGTsTZr5j5plB8bxJsenXjM78Jd8ogyGFNm02zPY8XdjEo4USa', 'Sharon Rose', 'Tayactac', '', 'BSED', 0, '0'),
(203, 'ssc-044', '$2y$10$QmH09yj5Bk/8CZrfholJiOiFxUZSTduEtotJDHQxSeaoGToVQT7Hq', 'Sheena', 'Chavez', '', 'BSED', 0, '0'),
(204, 'ssc-045', '$2y$10$rgvCVgPG.3PjsqXkJehu5ehPPiieqXF669wRkO6yHc54kYNaTIpvm', 'Gia', 'Pantaleon', '', 'BSED', 0, '0'),
(205, 'ssc-046', '$2y$10$idXBM/oxNeNDDFOoqZa46uz6f5w4cb./dZMzT8KObWjy1YJHT/iIa', 'John Lenard', 'Santillan', '', 'BSHM', 0, '0'),
(206, 'ssc-047', '$2y$10$Qv0.nT42Td.NuTHCozMQguthnpj.ADOaph1mLhHhtUZ5NOE1VHeC.', 'Jona Mae', 'Ungon', '', 'BSHM', 0, '0'),
(207, 'ssc-048', '$2y$10$jhfohpzc9WopCln4L.xVNuSrQ/MjHHS9sEqpY27ZC/Oy4XiGg/8.S', 'Nino', 'Signo', '', 'BSHM', 0, '0'),
(208, 'ssc-049', '$2y$10$W2G08y/io9cHblIgBYXdIOkauXnkhDDKwSjqBiiIuPAwAR1VoFU7C', 'Jimmy', 'Branzuela', '', 'BSIT', 0, '0'),
(217, 'ssc-050', '$2y$10$xosiay3D942ACfGAQXqZ.OUABKETci4ldVFDNShHbsfC7MTHRHIuS', 'Glinford', 'Buncal', 'images.jpg', 'BSIT', 0, '0'),
(228, 'ssc-001', '$2y$10$NZq3pPUpGWSH/Bi9FGIb4uWtFTlwFqHTGAqle0VhSx1WzVqhX/GcC', 'Kurt Bryan', 'Alegre', 'images.jpg', 'BSIT', 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(60) NOT NULL,
  `voters_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `stat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voters_id`, `candidate_id`, `position_id`, `stat`) VALUES
(1916, 159, 106, 18, 0),
(1917, 159, 108, 19, 0),
(1918, 159, 110, 20, 0),
(1919, 159, 112, 21, 0),
(1920, 159, 114, 22, 0),
(1921, 159, 117, 23, 0),
(1922, 159, 118, 23, 0),
(1923, 159, 120, 24, 0),
(1924, 159, 121, 24, 0),
(1925, 159, 123, 25, 0),
(1926, 159, 124, 25, 0),
(1927, 159, 126, 26, 0),
(1928, 159, 127, 26, 0),
(1929, 159, 129, 27, 0),
(1930, 159, 130, 27, 0),
(1931, 159, 132, 28, 0),
(1932, 159, 133, 28, 0),
(1933, 162, 138, 32, 0),
(1934, 162, 141, 33, 0),
(1935, 217, 138, 32, 0),
(1936, 217, 142, 33, 0),
(1937, 217, 143, 34, 0),
(1938, 217, 147, 36, 0),
(1939, 217, 148, 36, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elec_date`
--
ALTER TABLE `elec_date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `elec_date`
--
ALTER TABLE `elec_date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1940;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
