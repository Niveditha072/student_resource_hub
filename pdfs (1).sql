-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2025 at 10:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dept_resource_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `pdfs`
--

CREATE TABLE `pdfs` (
  `id` int(11) NOT NULL,
  `year` varchar(20) DEFAULT NULL,
  `regulation` varchar(10) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pdfs`
--

INSERT INTO `pdfs` (`id`, `year`, `regulation`, `subject`, `file_path`) VALUES
(27, '2nd Year', 'R23', 'HCI U-1', './uploads/1743677573_HCI UNIT -1.pdf'),
(28, '2nd Year', 'R23', 'ADS short questions', './uploads/1743677919_ADS_SHORT_ANSWER_QUESTIONS.pdf'),
(29, '2nd Year', 'R23', 'MMS U-4', './uploads/1743678118_MMS UNIT 4.pdf'),
(30, '2nd Year', 'R23', 'MMS U-5', './uploads/1743678256_MMS UNIT-5.pdf'),
(31, '2nd Year', 'R23', 'MMS U-3', './uploads/1743678278_MMS UNIT-3.pdf'),
(32, '2nd Year', 'R23', 'DTI U-1', 'uploads/1743687039_DT_Unit_1_Lecture_Notes.pdf'),
(40, '2nd Year', 'R23', 'OS U-1', 'uploads/OS_UNIT-1.pdf'),
(41, '2nd Year', 'R23', 'OS U-2', 'uploads/OS_UNIT-2.pdf'),
(43, '1st Year', 'R23', 'DS stack program', 'uploads/DS stack_program.pdf'),
(44, '1st Year', 'R23', 'DS sinle linked list', 'uploads/DS sinle_linked_list.pdf'),
(45, '1st Year', 'R23', 'DS double linked list program', 'uploads/DS double_linked_list.pdf'),
(46, '1st Year', 'R23', 'DS circular sinle linked list', 'uploads/DS circular singly linked list.pdf'),
(47, '1st Year', 'R23', 'DS circular double linked list', 'uploads/DS CIRCULAR DOUBLY LINKED LIST.pdf'),
(48, '2nd Year', 'R23', 'ADS avl tree program', 'uploads/ADS avl tree program.pdf'),
(49, '1st Year', 'R23', 'BEEE U-2', 'uploads/BEEE Unit - 2.pdf'),
(50, '1st Year', 'R23', 'BEEE U-3', 'uploads/BEEE UNIT 3.pdf'),
(51, '1st Year', 'R23', 'BEEE U-4', 'uploads/BEEE Unit - 4.pdf'),
(52, '1st Year', 'R23', 'BEEE U-5', 'uploads/BEEE Unit - 5.pdf'),
(53, '1st Year', 'R23', 'BEEE U-6', 'uploads/BEEE UNIT 6.pdf'),
(54, '1st Year', 'R23', 'BEEE U-1', 'uploads/BEEE UNIT1.pdf'),
(55, '1st Year', 'R23', 'BCME U-2 (surveying)', 'uploads/BCME Unit 2 Surveying.pdf'),
(56, '1st Year', 'R23', 'BCME U-1', 'uploads/.BCME UNIT 1.pdf'),
(57, '1st Year', 'R23', 'BCME U-2', 'uploads/.BCME UNIT 2.pdf'),
(58, '1st Year', 'R23', 'BCME U-3', 'uploads/.BCME UNIT 3.pdf'),
(59, '2nd Year', 'R23', 'ADS U-1', 'uploads/ADS U-1.pdf'),
(60, '2nd Year', 'R23', 'ADS U-2', 'uploads/ADS U-2.pdf'),
(61, '2nd Year', 'R23', 'ADS U-3', 'uploads/ADS U-3.pdf'),
(62, '1st Year', 'R23', 'EG U-1', 'uploads/EG U1.pdf'),
(63, '1st Year', 'R23', 'EG U-2', 'uploads/EG u-2.pdf'),
(64, '1st Year', 'R23', 'EG U-3', 'uploads/EG U-3.pdf'),
(65, '1st Year', 'R23', 'EG U-4', 'uploads/EG U-4.pdf'),
(66, '1st Year', 'R23', 'CHEMISTRY U-1 (Electro Chemistry and Appilications)', 'uploads/Electro Chemistry and Appilications .pdf'),
(67, '2nd Year', 'R23', 'ADS U-4 (Dynamic Programming)', 'uploads/ADS unIT 4Dynamic Programming.pdf'),
(68, '2nd Year', 'R23', 'ADS U-5 (Branch and Bound-1)', 'uploads/ADS U-5Branch and Bound-1.pdf'),
(69, '1st Year', 'R23', 'M1 SHORT ANSWERS', 'uploads/M1 SHORT ANSWERS.pdf'),
(70, '1st Year', 'R23', 'M2 SHORT ANSWERS', 'uploads/M2 SHORT ANSWERS.pdf'),
(71, '1st Year', 'R23', 'CHEMISTRY U-3(structures and bonding models1) ', 'uploads/structures and bonding models1 (U3).pdf'),
(72, '1st Year', 'R23', 'CHEMISTRY U-2 (Modern Engineering materials) ', 'uploads/MODERN ENGINEERING MATERIALS (U2).pdf'),
(73, '1st Year', 'R20', 'PHYSICS U-5 (semiconductors)', 'uploads/PHY UNIT 5 SEMICONDUCTORS.pdf'),
(74, '1st Year', 'R23', 'PHYSICS U-4 (Quantum Mechanics)', 'uploads/PHY UNIT 4 QUANTUM MECHANICS.pdf'),
(75, '1st Year', 'R23', 'PHYSICS U-1 (Interference)', 'uploads/PHY UNIT 1 INTERFACE.pdf'),
(76, '1st Year', 'R23', 'PHYSICS U-2 (Crystallography)', 'uploads/PHY UNIT 2 CHYSTALLOGRAPHY.pdf'),
(77, '1st Year', 'R23', 'PHYSICS U-3 (Magnetic Materials)', 'uploads/PHY UNIT 3 MAGNETIC MATERIALS.pdf'),
(82, '4th Year', 'R20', 'Data Visualization U-3', 'uploads/Data Visualization U-3.pdf'),
(83, '4th Year', 'R20', 'Data Visualization U-2', 'uploads/Data Visualization U-2.pdf'),
(84, '4th Year', 'R20', 'Data Visualization U-1', 'uploads/Data Visualization U-1.pdf'),
(85, '4th Year', 'R20', 'UHV-2 Mid-2-Notes', 'uploads/UHV-2 Mid-2-Notes.pdf'),
(86, '4th Year', 'R20', 'UHV-2 Mid-I Notes', 'uploads/UHV-2-Mid-I Notes.pdf'),
(87, '4th Year', 'R20', 'UHV-2 CHAPTER-3', 'uploads/UHV-2 CHAPTER-3.pdf'),
(88, '4th Year', 'R20', 'UHV-2 CHAPTER-5', 'uploads/UHV-2 CHAPTER-5.pdf'),
(89, '4th Year', 'R20', 'UHV-2 CHAPTER-4', 'uploads/UHV-2 CHAPTER-4.pdf'),
(90, '4th Year', 'R20', 'UHV-2 CHAPTER-2', 'uploads/UHV-2 CHAPTER-2.pdf'),
(91, '4th Year', 'R20', 'UHV-2 CHAPTER-1', 'uploads/UHV-2 CHAPTER-1.pdf'),
(92, '1st Year', 'R23', 'C Programming U-5 (Files)', 'uploads/C Programming U-5 (Files).pdf'),
(93, '1st Year', 'R23', 'C Programming U-5 (Function)', 'uploads/C Programming U-5 (Function).pdf'),
(94, '1st Year', 'R23', 'C Programming U-2', 'uploads/C Programming U-2.pdf'),
(95, '1st Year', 'R23', 'C Programming U-3 (Structure)', 'uploads/C Programming U-3 (Structure).pdf'),
(98, '1st Year', 'R23', 'C Programming U-4 (Pointers)', 'uploads/C Programming U-4 (Pointers).pdf'),
(99, '1st Year', 'R23', 'DBMS U-5 (The Transaction Concept)', 'uploads/DBMS U-5 (The Transaction Concept).pdf'),
(100, '1st Year', 'R23', 'DBMS U-5 (indexing)', 'uploads/DBMS U-5 (indexing).pdf'),
(101, '1st Year', 'R23', 'DBMS U-5 (B- Tree)', 'uploads/DBMS U-5 (B- Tree).pdf'),
(102, '1st Year', 'R23', 'DBMS U-5 ', 'uploads/DBMS U-5 .pdf'),
(103, '1st Year', 'R23', 'DBMS U-4 (Normalization)', 'uploads/DBMS U-4 (Normalization).pdf'),
(104, '1st Year', 'R23', 'DBMS U-3', 'uploads/DBMS U-3.pdf'),
(105, '1st Year', 'R23', 'DBMS U-1(ER-Modeling Part )', 'uploads/DBMS U-1(ER-Modeling Part ).pdf'),
(106, '1st Year', 'R23', 'DBMS U-1 (Part-3)', 'uploads/DBMS U-1 (Part-3).pdf'),
(107, '1st Year', 'R23', 'DBMS U-1 (Part-2)', 'uploads/DBMS U-1 (Part-2).pdf'),
(108, '1st Year', 'R23', 'DBMS U-1 (Part-1)', 'uploads/DBMS U-1 (Part-1).pdf'),
(109, '1st Year', 'R23', 'DMBS U-2', 'uploads/DMBS U-2.pdf'),
(138, '4th Year', 'R20', 'Data Visualization U-5', 'uploads/Data Visualization U-5.pdf'),
(139, '4th Year', 'R20', 'Data Visualization U-4', 'uploads/Data Visualization U-4.pdf'),
(140, '1st Year', 'R23', 'C Programming U-3 (Arrays)', 'uploads/C Programming U-3 (Arrays).pdf'),
(141, '2nd Year', 'R23', 'MEFA Notes', 'uploads/MEFA NOTES_compressed.pdf'),
(143, '2nd Year', 'R23', 'HCI U-2', 'uploads/HCI UNIT 2.pdf'),
(144, '2nd Year', 'R23', 'HCI U-3', 'uploads/HCI UNIT 3.pdf'),
(145, '2nd Year', 'R23', 'HCI U-4', 'uploads/HCI UNIT 4.pdf'),
(146, '2nd Year', 'R23', 'HCI U-5', 'uploads/HCI UNIT 5.pdf'),
(147, '2nd Year', 'R23', 'MMS U-2', 'uploads/MMS UNIT-2.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pdfs`
--
ALTER TABLE `pdfs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pdfs`
--
ALTER TABLE `pdfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
