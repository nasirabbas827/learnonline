-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 06:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learn_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `exercise_id` int(11) NOT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question_text` text NOT NULL,
  `option_one` varchar(255) NOT NULL,
  `option_two` varchar(255) NOT NULL,
  `option_three` varchar(255) NOT NULL,
  `option_four` varchar(255) NOT NULL,
  `correct_option` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`exercise_id`, `lesson_id`, `question_text`, `option_one`, `option_two`, `option_three`, `option_four`, `correct_option`, `created_at`, `updated_at`) VALUES
(1, 1, 'What is our country Name', 'Pakistan', 'India', 'Afg', 'UAE', 1, '2024-05-21 09:22:02', '2024-05-21 09:22:02'),
(2, 1, 'What is our country Name', 'Pakistan', 'India', 'Afg', 'UAE', 1, '2024-05-21 09:24:18', '2024-05-21 09:24:18'),
(3, 1, 'What is our country Name', 'Pakistan', 'India', 'Afg', 'UAE', 1, '2024-05-21 09:24:24', '2024-05-21 09:24:24'),
(4, 1, 'What is our country Name', 'Pakistan', 'India', 'Afg', 'UAE', 1, '2024-05-21 09:24:27', '2024-05-21 09:24:27'),
(5, 1, 'What is our country Name', 'Pakistan', 'India', 'Afg', 'UAE', 1, '2024-05-21 09:24:29', '2024-05-21 09:24:29'),
(6, 1, 'What is our country Name', 'Pakistan', 'India', 'Afg', 'UAE', 1, '2024-05-21 09:24:33', '2024-05-21 09:24:33'),
(7, 1, 'What is our country Name', 'Pakistan', 'India', 'Afg', 'UAE', 1, '2024-05-21 09:24:35', '2024-05-21 09:24:35'),
(8, 1, 'What is our country Name', 'Pakistan', 'India', 'Afg', 'UAE', 1, '2024-05-21 09:24:38', '2024-05-21 09:24:38'),
(9, 1, 'What is our country Name', 'Pakistan', 'India', 'Afg', 'UAE', 1, '2024-05-21 09:24:41', '2024-05-21 09:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `lesson_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`lesson_id`, `title`, `description`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 'First Lesson', 'This ', 'uploads/1716265892_INTRO.mp4', '2024-05-21 09:15:44', '2024-05-21 09:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message_text` text DEFAULT NULL,
  `sent_datetime` datetime DEFAULT current_timestamp(),
  `reply_text` text DEFAULT NULL,
  `reply_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message_text`, `sent_datetime`, `reply_text`, `reply_datetime`) VALUES
(4, 3, 0, 'Hy', '2024-05-21 09:41:54', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `result_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `correct_answers` int(11) NOT NULL,
  `score` decimal(5,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`result_id`, `user_id`, `lesson_id`, `total_questions`, `correct_answers`, `score`, `created_at`) VALUES
(1, 3, 1, 9, 3, 33.00, '2024-05-21 09:37:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `phone`, `age`) VALUES
(3, 'nasir', '$2y$10$Die7EpNreYQPzGUV4edFguKP59AJQt4YoPjz0Fdik52TDeZti1W.O', 'nasiryt.827@gmail.com', '123465432123', 23);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`exercise_id`),
  ADD KEY `lesson_id` (`lesson_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lesson_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `lesson_id` (`lesson_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `exercise_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exercises`
--
ALTER TABLE `exercises`
  ADD CONSTRAINT `exercises_ibfk_1` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`lesson_id`);

--
-- Constraints for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD CONSTRAINT `quiz_results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `quiz_results_ibfk_2` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`lesson_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
