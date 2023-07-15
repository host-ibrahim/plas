-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2023 at 08:27 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

DROP TABLE IF EXISTS `admin_login`;
CREATE TABLE `admin_login` (
  `login_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`login_id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `admission`
--

DROP TABLE IF EXISTS `admission`;
CREATE TABLE `admission` (
  `admission_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `fees` decimal(10,2) DEFAULT NULL,
  `bill_generated` tinyint(1) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `valid_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admission`
--

INSERT INTO `admission` (`admission_id`, `student_id`, `status`, `fees`, `bill_generated`, `shift_id`, `created_at`, `updated_at`, `valid_date`) VALUES
(1, 1, 'Approved', '500.00', 1, 1, '2023-06-21 18:30:00', '2023-06-22 06:22:08', '2023-07-22');

-- --------------------------------------------------------

--
-- Table structure for table `bookissues`
--

DROP TABLE IF EXISTS `bookissues`;
CREATE TABLE `bookissues` (
  `issue_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `issue_date` date NOT NULL,
  `return_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(50) NOT NULL,
  `publication_date` date NOT NULL,
  `available_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `publication_date`, `available_quantity`) VALUES
(1, 'The Great Gatsby', 'F. Scott Fitzgerald', '1925-04-10', 5),
(2, 'To Kill a Mockingbird', 'Harper Lee', '1960-07-11', 3),
(3, '1984', 'George Orwell', '1949-06-08', 7),
(4, 'Pride and Prejudice', 'Jane Austen', '1813-01-28', 2),
(5, 'The Catcher in the Rye', 'J.D. Salinger', '1951-07-16', 4),
(6, 'To the Lighthouse', 'Virginia Woolf', '1927-05-05', 6),
(7, 'Moby-Dick', 'Herman Melville', '1851-10-18', 1),
(8, 'The Hobbit', 'J.R.R. Tolkien', '1937-09-21', 9),
(9, 'The Lord of the Rings', 'J.R.R. Tolkien', '1954-07-29', 8),
(10, 'Frankenstein', 'Mary Shelley', '1818-01-01', 10);

-- --------------------------------------------------------

--
-- Table structure for table `book_requests`
--

DROP TABLE IF EXISTS `book_requests`;
CREATE TABLE `book_requests` (
  `request_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `request_date` datetime DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `designation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `name`, `email`, `phone`, `address`, `designation`) VALUES
(1, 'John Doe', 'john.doe@example.com', '1234567890', '123 Main Street', 'Manager'),
(2, 'Jane Smith', 'jane.smith@example.com', '9876543210', '456 Elm Street', 'Supervisor'),
(3, 'Michael Johnson', 'michael.johnson@example.com', '5551234567', '789 Oak Avenue', 'Assistant'),
(4, 'Sarah Williams', 'sarah.williams@example.com', '8889990000', '321 Maple Lane', 'Coordinator'),
(5, 'Robert Davis', 'robert.davis@example.com', '4445556666', '654 Pine Street', 'Analyst');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expense_id`, `description`, `amount`, `date`) VALUES
(1, 'Office supplies', '50.00', '2023-06-01'),
(2, 'Travel expenses', '200.00', '2023-06-05'),
(3, 'Internet bill', '80.00', '2023-06-10'),
(4, 'Marketing campaign', '500.00', '2023-06-15'),
(5, 'Team lunch', '100.00', '2023-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `magazines`
--

DROP TABLE IF EXISTS `magazines`;
CREATE TABLE `magazines` (
  `magazine_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `publisher` varchar(50) NOT NULL,
  `publication_date` date NOT NULL,
  `available_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `magazines`
--

INSERT INTO `magazines` (`magazine_id`, `title`, `publisher`, `publication_date`, `available_quantity`) VALUES
(1, 'National Geographic', 'National Geographic Society', '2023-06-01', 10),
(2, 'Time', 'Time USA, LLC', '2023-06-05', 8),
(3, 'Sports Illustrated', 'Meredith Corporation', '2023-06-10', 12),
(4, 'Vogue', 'Condé Nast', '2023-06-15', 6),
(5, 'The New Yorker', 'Condé Nast', '2023-06-20', 4);

-- --------------------------------------------------------

--
-- Table structure for table `newspapers`
--

DROP TABLE IF EXISTS `newspapers`;
CREATE TABLE `newspapers` (
  `newspaper_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `publisher` varchar(50) NOT NULL,
  `publication_date` date NOT NULL,
  `available_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newspapers`
--

INSERT INTO `newspapers` (`newspaper_id`, `title`, `publisher`, `publication_date`, `available_quantity`) VALUES
(1, 'The Daily Times', 'Times Media', '2023-06-01', 100),
(2, 'The Morning Herald', 'Herald Publications', '2023-06-05', 80),
(3, 'The Evening Gazette', 'Gazette Media', '2023-06-10', 120),
(4, 'The Sun Tribune', 'Sun Media Group', '2023-06-15', 70),
(5, 'The Daily Chronicle', 'Chronicle News', '2023-06-20', 90);

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

DROP TABLE IF EXISTS `shifts`;
CREATE TABLE `shifts` (
  `shift_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`shift_id`, `name`, `start_time`, `end_time`) VALUES
(1, 'Morning Shift', '09:00:00', '14:00:00'),
(2, 'Afternoon Shift', '14:00:00', '19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `imageurl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `last_name`, `email`, `phone`, `address`, `imageurl`) VALUES
(1, 'Md', 'Asif', 'mdasif9a@gmail.com', '09110036432', 'dargah road neemtal patna, bihar, india', '2166037382553800pexels-rene-asmussen-2505026.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `students_login`
--

DROP TABLE IF EXISTS `students_login`;
CREATE TABLE `students_login` (
  `login_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_login`
--

INSERT INTO `students_login` (`login_id`, `student_id`, `username`, `password`) VALUES
(1, 1, 'asif', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `admission`
--
ALTER TABLE `admission`
  ADD PRIMARY KEY (`admission_id`);

--
-- Indexes for table `bookissues`
--
ALTER TABLE `bookissues`
  ADD PRIMARY KEY (`issue_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `book_requests`
--
ALTER TABLE `book_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `magazines`
--
ALTER TABLE `magazines`
  ADD PRIMARY KEY (`magazine_id`);

--
-- Indexes for table `newspapers`
--
ALTER TABLE `newspapers`
  ADD PRIMARY KEY (`newspaper_id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`shift_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `students_login`
--
ALTER TABLE `students_login`
  ADD PRIMARY KEY (`login_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admission`
--
ALTER TABLE `admission`
  MODIFY `admission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookissues`
--
ALTER TABLE `bookissues`
  MODIFY `issue_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `book_requests`
--
ALTER TABLE `book_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `magazines`
--
ALTER TABLE `magazines`
  MODIFY `magazine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `newspapers`
--
ALTER TABLE `newspapers`
  MODIFY `newspaper_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `shift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students_login`
--
ALTER TABLE `students_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
