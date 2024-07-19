-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 10, 2024 at 05:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE `certificate` (
  `id` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description1` varchar(255) NOT NULL,
  `description2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificate`
--

INSERT INTO `certificate` (`id`, `icon`, `title`, `description1`, `description2`) VALUES
(1, 'web-design.png', 'Update Certificate', 'Equipped with comprehensive training from Studyz Academy, I excel in professional web design, mastering WordPress, Photoshop, Canva, Illustrator, SEO, and eCommerce development.', 'With a skillset honed for success, I bring creativity, precision,                     and strategic insight to every project, ensuring impactful digital                     solutions that resonate and inspire.'),
(2, 'web-development.png', 'Web Development', 'Completing the rigorous web development program\n                    at Studyz Academy, I\'ve mastered HTML, CSS,\n                    JavaScript, Bootstrap, PHP, and Laravel.\n           ', 'My expertise combines creativity\r\n                    with technical proficiency to deliver cutting-edge\r\n                    digital solutions tailored to client needs.');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(11) NOT NULL,
  `year` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `year`, `title`, `description`, `color`) VALUES
(1, '2016', 'Ordinary Level Examination', 'Successfully Completed Ordinary Level Examination at Enasalgolla Central College', '41516C'),
(2, '2017', 'Diploma in English', 'Successfully Completed English diploma at Institute of English - NCI', 'FBCA3E'),
(3, '2019', 'Advanced Level Examination', 'Successfully Completed my Advanced Level Examination in Commerce Stream at Zahira College - Mawanalle', 'E24A68'),
(4, '2023', 'HNDIT', 'Completed Higher national Diploma in Information Technology at SLIATE - Kandy', '1B5F8C');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `projectName` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `layerTitle` varchar(255) NOT NULL,
  `layerDescription` varchar(255) NOT NULL,
  `projectLink` varchar(255) NOT NULL,
  `projectDetailsLink` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `projectName`, `image`, `layerTitle`, `layerDescription`, `projectLink`, `projectDetailsLink`) VALUES
(1, 'E-Commerce Site', 'project_cellflix.jpg', 'Wordpress Website', 'E-Commerce site of CELLFLIX Mobileshop', 'https://2138.woooo.work/', 'https://2138.woooo.work/'),
(2, 'Mobile Shop Management System', 'project_digital sreamz.jpg', 'Java Desktop Application', 'A mobileshop Management System of Digital Dreamz Mobile Shop', 'digitalDreamz.html', 'digitalDreamz.html'),
(3, 'Dynamic Portfolio', 'project_portfolio.png', 'Web Application', 'Dynamic Portfolio', '#', '#');

-- --------------------------------------------------------

--
-- Table structure for table `projecticon`
--

CREATE TABLE `projecticon` (
  `id` int(11) NOT NULL,
  `project` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projecticon`
--

INSERT INTO `projecticon` (`id`, `project`, `icon`) VALUES
(31, 'Aashiq', 'images.png'),
(32, 'Aashiq', 'global.PNG'),
(33, 'Aashiq', 'images.png'),
(34, 'Aashiq', '4.jpg'),
(35, 'asq', 'images.png'),
(36, 'asq', 'global.PNG'),
(37, 'asq', '852256.jpg'),
(38, 'asq', '4.jpg'),
(39, 'E-Commerce Site', 'elementor.png'),
(40, 'E-Commerce Site', 'wordpress.png'),
(41, 'E-Commerce Site', 'woocommerce.png'),
(43, 'Mobile Shop Management System', 'java.png'),
(44, 'Mobile Shop Management System', 'desktop.png'),
(45, 'Mobile Shop Management System', 'sql.png'),
(50, 'Dynamic Portfolio', 'html.png'),
(51, 'Dynamic Portfolio', 'css.png'),
(52, 'Dynamic Portfolio', 'js.png'),
(53, 'Dynamic Portfolio', 'sql.png'),
(62, 'sad', 'elementor.png');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `icon`, `title`, `description`) VALUES
(1, 'web-development.png', 'Web Development', 'Crafting captivating websites & applications with HTML, CSS, JavaScript, PHP, and SQL. Let us bring your online vision to life with innovation.'),
(2, 'graphic-design.png', 'Graphic Design', 'From logos to branding materials, we create visually stunning designs that captivate your audience across print and digital platforms. lorem'),
(3, 'web-design.png', 'Web Design', 'Elevate your online presence with our WordPress expertise. We create stunning, customized websites that engage your audience and drive results.');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `image`, `title`, `description`) VALUES
(1, 'html.png', 'HTML', 'HTML expertise for structuring web content effectively and efficiently'),
(2, 'css.png', 'CSS', 'CSS proficiency in styling web pages for optimal visual appeal'),
(3, 'js.png', 'JavaScript', 'JavaScript skills for dynamic and interactive web development projects'),
(4, 'php.png', 'PHP', 'JavaScript skills for dynamic and interactive web development projects'),
(5, 'bootstrap.png', 'Bootstrap', 'Bootstrap expertise for rapid development of responsive web projects'),
(6, 'sql.png', 'SQL', 'SQL mastery for efficient management and retrieval of database data'),
(7, 'wordpress.png', 'Wordpress', 'WordPress proficiency for creating customizable and dynamic website solutions'),
(8, 'canva.png', 'Canva', 'Canva skills for designing visually appealing graphics and images online'),
(9, 'photoshop.png', 'Photoshop', 'Photoshop expertise for editing and creating visually stunning digital content');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `title1` varchar(255) NOT NULL,
  `title2` varchar(255) NOT NULL,
  `intro1` varchar(255) NOT NULL,
  `intro2` varchar(255) NOT NULL,
  `intro3` varchar(255) NOT NULL,
  `facebook` text NOT NULL,
  `github` text NOT NULL,
  `instagram` text NOT NULL,
  `linkedin` text NOT NULL,
  `whatsapp` text NOT NULL,
  `gmail` text NOT NULL,
  `cv` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `title1`, `title2`, `intro1`, `intro2`, `intro3`, `facebook`, `github`, `instagram`, `linkedin`, `whatsapp`, `gmail`, `cv`) VALUES
(1, 'Aashiq', '', 'aashiq76asq@gmail.com', '123', 'Web Developer', 'Web Designer', 'I am Aashiq, As an aspiring full-stack web developer, I thrive on the dynamic nature of technology and its limitless possibilities. I completed my Higher National Diploma in Information Technology (HNDIT) at Sliate.', 'Currently, I am honing my skills as a trainee at Studyz Academy, immersing myself in real-world projects and leveraging cutting-edge technologies to bring ideas to life.', 'My ultimate goal is to evolve into a proficient full-stack web developer, adept at seamlessly integrating front-end and back-end technologies to deliver robust, user-centric solutions.', 'https://www.facebook.com/Aashiq.web/', 'https://github.com/Aashiq76', 'https://www.instagram.com/Aashiq.web/', 'https://www.linkedin.com', '0774028771', 'Aashiq76asq@gmail.com', 'CV_Aashiq.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projecticon`
--
ALTER TABLE `projecticon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `projecticon`
--
ALTER TABLE `projecticon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
