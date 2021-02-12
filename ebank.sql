-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2021 at 11:22 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebank`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus_headers`
--

CREATE TABLE `aboutus_headers` (
  `id` int(11) NOT NULL,
  `head` text NOT NULL,
  `paragraph` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aboutus_headers`
--

INSERT INTO `aboutus_headers` (`id`, `head`, `paragraph`, `image`, `status`) VALUES
(1, 'We Solve Your Financial Problem', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.\r\nA small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', 'img_2.jpg', 1),
(2, 'We Solve Your Financial Problem', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.\r\nA small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', 'img_2.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `aboutus_shortcuts`
--

CREATE TABLE `aboutus_shortcuts` (
  `id` int(11) NOT NULL,
  `head` text NOT NULL,
  `paragraph` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aboutus_shortcuts`
--

INSERT INTO `aboutus_shortcuts` (`id`, `head`, `paragraph`, `image`, `status`) VALUES
(1, 'Money Savings', 'A small river named Duden flows by their place and supplies it with the necessary regelialia.', '001-wallet.svg', 1),
(2, 'Online Shoppings', 'A small river named Duden flows by their place and supplies it with the necessary regelialia.', '004-cart.svg', 1),
(3, 'Credit / Debit Cards', 'A small river named Duden flows by their place and supplies it with the necessary regelialia.', '006-credit-card.svg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `balance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `image` varchar(100) NOT NULL DEFAULT 'admin.jpg',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `super_admin` tinyint(4) NOT NULL DEFAULT 0,
  `type` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `password`, `email`, `mobile`, `image`, `status`, `super_admin`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Abdelrhman Genedi', 'abdoelgenedi', '$2y$10$4w3.8E5cIspM30rDJWQSkuTYdinAdwqgNL6AS4l9AiVVu06u6xTRy', 'abdoelgenedi@gmail.com', '01150911573', '11610303300w4abSLMqaIbxtqgoKYyc3BMAoxLaFUUYEGCUMnYN.png', 1, 1, 1, '2020-12-22 17:24:37', '2021-01-10 16:28:20'),
(2, 'mahmoud', 'mahmoud', '$2y$10$VbgTrco1coNu04L1wApMhuOkRCZMRYIBVayCB.bTSPs7DuX58XaLe', 'mahmoud@gmail.com', '0125648532', 'admin.jpg', 1, 0, 1, '2020-12-27 14:09:48', '2021-01-07 15:52:15'),
(4, 'ahmed', 'ahmed.ahmed', '$2y$10$VbgTrco1coNu04L1wApMhuOkRCZMRYIBVayCB.bTSPs7DuX58XaLe', 'ahmed@gmail.com', '01160277983', 'admin.jpg', 1, 0, 1, '2020-12-28 12:07:30', '2021-01-07 14:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'bank.jpg',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`, `website`, `mobile`, `email`, `image`, `status`, `created_at`, `updated_at`) VALUES
(3498, 'CIB', 'https://www.cibeg.com/', '19666', 'cib.customercareunit@cibeg.com', '3698NjiKYjmoIWq9gPUOrwRRNBx3MpzeQQGBWROciF3l.png', 1, '2020-12-23 16:20:11', '2021-01-07 13:36:25'),
(5845, 'abdo elgenedi', 'www.abdoelgenedi.com', '01150911573', 'abdoelgenedi@gmail.com', '58451609167085V8YjNAkXAI1GCrWbSm1SDFbfynbGeWkLnFQaOFLe.jpg', 1, '2020-12-24 08:28:14', '2021-01-07 13:36:29');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us_manage`
--

CREATE TABLE `contact_us_manage` (
  `id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `form_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_us_manage`
--

INSERT INTO `contact_us_manage` (`id`, `address`, `mobile`, `email`, `form_status`) VALUES
(1, '203 Fake St. Mountain View, San Francisco, California, USA', '0115498576', 'feedback@ebank.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `mobile` varchar(50) NOT NULL,
  `age` varchar(4) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `balance` float NOT NULL DEFAULT 0,
  `type` int(11) NOT NULL DEFAULT 2,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(255) DEFAULT 'user.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `username`, `password`, `email`, `email_verified_at`, `remember_token`, `mobile`, `age`, `status`, `balance`, `type`, `created_at`, `updated_at`, `image`) VALUES
(265989, 'abdo elgenedi', 'abdoelgenedi', '$2y$10$DiMM7oi3CtUz8TdqQx7tkuHwDsimLQ4oE55eK6c1BMi1VL9nVyNIC', 'abdoelgenedi@gmail.com', '2020-12-24 12:42:02', 'aTKasVnnP7zIQktvnWdi838v380feou5rjXxdyOWuoGRkb6kA8UpaOLuFK5V', '01150911573', '25', 1, 1000, 2, '2020-12-24 11:27:36', '2021-01-12 09:47:32', 'user.jpg'),
(265993, 'Mahmoud Soliman', 'mahmoud_soliman', '$2y$10$DiMM7oi3CtUz8TdqQx7tkuHwDsimLQ4oE55eK6c1BMi1VL9nVyNIC', 'mahmoudsoliman@gmail.com', '2021-01-05 15:39:46', NULL, '01150911575', '22', 1, 0, 2, '2020-12-24 11:57:23', '2021-01-06 18:05:47', 'user.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customer_accounts`
--

CREATE TABLE `customer_accounts` (
  `customer_id` int(11) NOT NULL,
  `account_id` bigint(20) NOT NULL,
  `bank_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image`, `status`) VALUES
(1, 'img_1.jpg', 1),
(2, 'img_2.jpg', 1),
(3, 'img_3.jpg', 1),
(4, 'img_4.jpg', 1),
(5, 'img_1.jpg', 1),
(6, 'img_2.jpg', 1),
(7, 'img_3.jpg', 1),
(8, 'img_4.jpg', 1),
(9, 'img_4.jpg', 1),
(10, 'img_4.jpg', 1),
(11, 'img_4.jpg', 1),
(12, 'img_4.jpg', 1),
(13, 'img_4.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `header`
--

CREATE TABLE `header` (
  `id` int(11) NOT NULL,
  `head` text NOT NULL,
  `paragraph` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `header`
--

INSERT INTO `header` (`id`, `head`, `paragraph`, `status`) VALUES
(1, 'Banking Solutions', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae minima delectus accusamus accusantium deleniti libero excepturi porro illo.', 1),
(2, 'Financing Solutions', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\r\n                            Repudiandae minima delectus accusamus accusantium deleniti libero excepturi porro illo.', 1),
(3, 'Savings Accounts', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\r\n                            Repudiandae minima delectus accusamus accusantium deleniti libero excepturi porro illo.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `howitworkscards`
--

CREATE TABLE `howitworkscards` (
  `id` int(11) NOT NULL,
  `head` text NOT NULL,
  `paragraph` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `howitworkscards`
--

INSERT INTO `howitworkscards` (`id`, `head`, `paragraph`, `image`, `status`) VALUES
(1, 'Online Applications', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque nisi, deserunt necessitatibus odio magnam nihil illum\r\n                            neque voluptas?', 'img_1.jpg', 1),
(2, 'Get an approval', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque nisi, deserunt necessitatibus odio magnam nihil illum neque voluptas?\r\n                    ', 'img_2.jpg', 1),
(3, 'Card delivery', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore sapiente labore eius ullam? Iusto?\r\n                    ', 'img_3.jpg', 1),
(4, 'Card delivery', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore sapiente labore eius ullam? Iusto?\r\n                    ', 'img_3.jpg', 1),
(5, 'Card delivery', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore sapiente labore eius ullam? Iusto?\r\n                    ', 'img_3.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `howitworksheader`
--

CREATE TABLE `howitworksheader` (
  `id` int(11) NOT NULL,
  `head` text NOT NULL,
  `paragraph` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `howitworksheader`
--

INSERT INTO `howitworksheader` (`id`, `head`, `paragraph`) VALUES
(2, 'How It Works', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptas fugiat molestiae eligendi repudiandae error?');

-- --------------------------------------------------------

--
-- Table structure for table `our_services`
--

CREATE TABLE `our_services` (
  `id` int(11) NOT NULL,
  `head` text NOT NULL,
  `paragraph` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `our_services`
--

INSERT INTO `our_services` (`id`, `head`, `paragraph`, `image`, `status`) VALUES
(1, 'Business Consulting', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione animi tempora sint hic quod!', '001-wallet.svg', 1),
(2, 'Credit Card', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores nemo beatae minus incidunt voluptates?', '006-credit-card.svg', 1),
(3, 'Income Monitoring', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores optio veritatis aperiam consequuntur qui.', '002-rich.svg', 1),
(4, 'Insurance Consulting', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia labore suscipit distinctio inventore doloribus deserunt!', '003-notes.svg', 1),
(5, 'Financial Investment', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque odio voluptatibus repellat hic officia quibusdam!', '004-cart.svg', 1),
(6, 'Financial Management', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. In, iusto eaque velit saepe nobis ipsa?', '005-megaphone.svg', 1),
(7, 'Financial Management', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. In, iusto eaque velit saepe nobis ipsa?', '005-megaphone.svg', 1),
(8, 'Financial Management', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. In, iusto eaque velit saepe nobis ipsa?', '005-megaphone.svg', 1);

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
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `opinion` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `customer_id`, `opinion`, `status`) VALUES
(1, 265989, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deleniti tenetur ad perspiciatis quam atque eius quia suscipit repudiandae animi voluptatem.', 1),
(4, 265993, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil veniam tempora beatae animi in sapiente quos maiores ex aut.', 1),
(5, 265993, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil veniam tempora beatae animi in sapiente quos maiores ex aut.', 1),
(6, 265993, 'احسن بنك في الدنيا دا ولا ايه؟', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `status` tinyint(4) NOT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `sender_id`, `receiver_id`, `amount`, `status`, `details`, `created_at`) VALUES
(1, 265989, 265993, 5000, 1, 'this transaction for the website you create it', '2020-12-27 12:33:04'),
(3, 265993, 265989, 2600, 1, 'you send a more money than we want and this is the rest of the money', '2020-12-27 12:34:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `title`) VALUES
(1, 'admin'),
(2, 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutus_headers`
--
ALTER TABLE `aboutus_headers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aboutus_shortcuts`
--
ALTER TABLE `aboutus_shortcuts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD KEY `user_fk2` (`type`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us_manage`
--
ALTER TABLE `contact_us_manage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD KEY `user_fk` (`type`);

--
-- Indexes for table `customer_accounts`
--
ALTER TABLE `customer_accounts`
  ADD PRIMARY KEY (`customer_id`,`account_id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `bank_fk` (`bank_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header`
--
ALTER TABLE `header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `howitworkscards`
--
ALTER TABLE `howitworkscards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `howitworksheader`
--
ALTER TABLE `howitworksheader`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `our_services`
--
ALTER TABLE `our_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_fk` (`customer_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sender` (`sender_id`),
  ADD KEY `fk_receiver` (`receiver_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutus_headers`
--
ALTER TABLE `aboutus_headers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `aboutus_shortcuts`
--
ALTER TABLE `aboutus_shortcuts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_us_manage`
--
ALTER TABLE `contact_us_manage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265998;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `header`
--
ALTER TABLE `header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `howitworkscards`
--
ALTER TABLE `howitworkscards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `howitworksheader`
--
ALTER TABLE `howitworksheader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `our_services`
--
ALTER TABLE `our_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `user_fk2` FOREIGN KEY (`type`) REFERENCES `users` (`id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`type`) REFERENCES `users` (`id`);

--
-- Constraints for table `customer_accounts`
--
ALTER TABLE `customer_accounts`
  ADD CONSTRAINT `bank_fk` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_accounts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_accounts_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD CONSTRAINT `customer_fk` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_receiver` FOREIGN KEY (`receiver_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sender` FOREIGN KEY (`sender_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
