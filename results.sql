-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 21, 2019 at 08:58 AM
-- Server version: 10.3.11-MariaDB-1:10.3.11+maria~bionic-log
-- PHP Version: 7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `results`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch_upload`
--

CREATE TABLE `batch_upload` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_id` int(11) NOT NULL,
  `lecturer_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `session_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `programme_id` int(10) UNSIGNED NOT NULL,
  `credit_hour` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `current_session`
--

CREATE TABLE `current_session` (
  `id` int(10) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `semester` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_on` date NOT NULL,
  `end_on` date NOT NULL,
  `department_id` int(11) NOT NULL,
  `running` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faculty_id` int(10) UNSIGNED NOT NULL,
  `short_form` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `faculty_id`, `short_form`) VALUES
(1, 'Computer Science', 1, 'CSC'),
(2, 'Geology', 1, 'GLG'),
(3, 'Mathematics', 1, 'MTH'),
(4, 'Statistics', 1, 'STA'),
(5, 'Physics', 1, 'PHY'),
(6, 'Chemistry', 1, 'CHM');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `name`) VALUES
(1, 'Physical Science');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_courses`
--

CREATE TABLE `lecturer_courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `lecturer_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `session_id` int(10) UNSIGNED NOT NULL,
  `co_ordinator` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(65, '2014_10_12_100000_create_password_resets_table', 1),
(66, '2019_05_09_142340_faculty', 1),
(67, '2019_05_09_142502_departments', 1),
(68, '2019_05_09_142630_programmes', 1),
(69, '2019_05_09_142836_courses', 1),
(70, '2019_05_11_142350_current_session', 1),
(71, '2019_05_12_142353_create_users_table', 1),
(72, '2019_05_18_142619_lecturer_courses', 1),
(73, '2019_05_18_150029_student_courses', 1),
(74, '2019_05_30_072858_results', 1),
(75, '2019_08_19_083915_batch_upload', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programmes`
--

CREATE TABLE `programmes` (
  `id` int(10) UNSIGNED NOT NULL,
  `short_form` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_form` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_years` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programmes`
--

INSERT INTO `programmes` (`id`, `short_form`, `full_form`, `no_of_years`) VALUES
(1, 'PGD', 'Postgraduate Diploma', 1),
(2, 'M.Sc', 'Master of Science', 2),
(3, 'PhD', 'Doctor of Philosophy', 3);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_reg_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `assessment_score` int(11) NOT NULL,
  `exam_score` int(11) NOT NULL,
  `total_score` int(11) NOT NULL,
  `grade` enum('A','B','C','D','E','F') COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `session_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identification_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `programme_id` int(10) UNSIGNED DEFAULT NULL,
  `session_of_admission` int(10) UNSIGNED DEFAULT NULL,
  `rank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `middlename`, `email`, `identification_number`, `department_id`, `programme_id`, `session_of_admission`, `rank`, `specialty`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Inim', 'Andrew', 'Esiet', 'computeradmin@admin.com', 'computeradmin', 1, NULL, NULL, 'Post-Graduate Coordinator', NULL, '0', '$2y$10$EN1OMFzBPjPRihS0RSoLKumqqib0LPqagIhT9JOo9l1GqS/vtFHve', NULL, '2019-08-21 06:56:45', '2019-08-21 06:56:45'),
(2, 'Adama', 'Johnson', 'Adama', 'geologyadmin@admin.com', 'geologyadmin', 2, NULL, NULL, 'Post-Graduate Coordinator', NULL, '0', '$2y$10$qXcwobyptb9m70hlxuH9w.VkKwhmZsTliReWEtwmukvsBjpTImma6', NULL, '2019-08-21 06:56:45', '2019-08-21 06:56:45'),
(3, 'Okoro', 'Joshua', 'Okoro', 'mathematicsadmin@admin.com', 'mathematicsadmin', 3, NULL, NULL, 'Post-Graduate Coordinator', NULL, '0', '$2y$10$WunwDX0vtNpcrOlXf54m6.x97CqCmr..wKoE3OL9K3civQW/pdQbi', NULL, '2019-08-21 06:56:45', '2019-08-21 06:56:45'),
(4, 'Edidiong', 'Mathew', 'Smart', 'statisticsadmin@admin.com', 'statisticsadmin', 4, NULL, NULL, 'Post-Graduate Coordinator', NULL, '0', '$2y$10$hzs8O74L.Ex7NQoziTe7K.dhXBGjY530g03bRXpIJk4/lrUd9w3mW', NULL, '2019-08-21 06:56:45', '2019-08-21 06:56:45'),
(5, 'Ogbu', 'Dennis', 'Joshua', 'physicsadmin@admin.com', 'physicsadmin', 5, NULL, NULL, 'Post-Graduate Coordinator', NULL, '0', '$2y$10$OKYeOQtc1BJnSTf9geQnEevmX.B9Wqqe5wTLzFSsO2S2U0mKAEo56', NULL, '2019-08-21 06:56:46', '2019-08-21 06:56:46'),
(6, 'Ikpe', 'Margaret', 'Brown', 'chemistryadmin@admin.com', 'chemistryadmin', 6, NULL, NULL, 'Post-Graduate Coordinator', NULL, '0', '$2y$10$NBoCmUXR5w3jE36JmstMEOmax.rXgiGlpnaxGzqLNUDjweZGx4R8C', NULL, '2019-08-21 06:56:46', '2019-08-21 06:56:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch_upload`
--
ALTER TABLE `batch_upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batch_upload_lecturer_id_foreign` (`lecturer_id`),
  ADD KEY `batch_upload_course_id_foreign` (`course_id`),
  ADD KEY `batch_upload_session_id_foreign` (`session_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_title_unique` (`title`),
  ADD UNIQUE KEY `courses_code_unique` (`code`),
  ADD KEY `courses_department_id_foreign` (`department_id`),
  ADD KEY `courses_programme_id_foreign` (`programme_id`);

--
-- Indexes for table `current_session`
--
ALTER TABLE `current_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`),
  ADD KEY `departments_faculty_id_foreign` (`faculty_id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faculties_name_unique` (`name`);

--
-- Indexes for table `lecturer_courses`
--
ALTER TABLE `lecturer_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lecturer_courses_lecturer_id_foreign` (`lecturer_id`),
  ADD KEY `lecturer_courses_course_id_foreign` (`course_id`),
  ADD KEY `lecturer_courses_session_id_foreign` (`session_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `programmes_short_form_unique` (`short_form`),
  ADD UNIQUE KEY `programmes_full_form_unique` (`full_form`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `results_course_reg_id_foreign` (`course_reg_id`),
  ADD KEY `results_student_id_foreign` (`student_id`),
  ADD KEY `results_course_id_foreign` (`course_id`),
  ADD KEY `results_session_id_foreign` (`session_id`);

--
-- Indexes for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_courses_student_id_foreign` (`student_id`),
  ADD KEY `student_courses_course_id_foreign` (`course_id`),
  ADD KEY `student_courses_session_id_foreign` (`session_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_identification_number_unique` (`identification_number`),
  ADD KEY `users_department_id_foreign` (`department_id`),
  ADD KEY `users_programme_id_foreign` (`programme_id`),
  ADD KEY `users_session_of_admission_foreign` (`session_of_admission`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch_upload`
--
ALTER TABLE `batch_upload`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `current_session`
--
ALTER TABLE `current_session`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lecturer_courses`
--
ALTER TABLE `lecturer_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `batch_upload`
--
ALTER TABLE `batch_upload`
  ADD CONSTRAINT `batch_upload_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `batch_upload_lecturer_id_foreign` FOREIGN KEY (`lecturer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `batch_upload_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `current_session` (`id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `courses_programme_id_foreign` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lecturer_courses`
--
ALTER TABLE `lecturer_courses`
  ADD CONSTRAINT `lecturer_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lecturer_courses_lecturer_id_foreign` FOREIGN KEY (`lecturer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lecturer_courses_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `current_session` (`id`);

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `results_course_reg_id_foreign` FOREIGN KEY (`course_reg_id`) REFERENCES `student_courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `results_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `current_session` (`id`),
  ADD CONSTRAINT `results_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD CONSTRAINT `student_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_courses_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `current_session` (`id`),
  ADD CONSTRAINT `student_courses_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `users_programme_id_foreign` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`),
  ADD CONSTRAINT `users_session_of_admission_foreign` FOREIGN KEY (`session_of_admission`) REFERENCES `current_session` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
