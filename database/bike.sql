-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2024 at 01:59 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bike`
--

-- --------------------------------------------------------

--
-- Table structure for table `bike_list`
--

CREATE TABLE `bike_list` (
  `id` int(30) NOT NULL,
  `brand_id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `bike_model` text NOT NULL,
  `description` text NOT NULL,
  `quantity` tinyint(3) NOT NULL DEFAULT 0,
  `daily_rate` float NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bike_list`
--

INSERT INTO `bike_list` (`id`, `brand_id`, `category_id`, `bike_model`, `description`, `quantity`, `daily_rate`, `status`, `date_created`, `date_updated`) VALUES
(1, 5, 2, 'BMW R 1250 GS', '&lt;p style=\\&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;\\&quot;&gt;&lt;span style=\\&quot;color: rgb(22, 23, 26); font-family: &amp;quot;Segoe UI&amp;quot;; font-size: 1rem;\\&quot;&gt;The R 1250 GS represents unbridled curiosity and the daring to explore something new again and again. For four decades, it has been an icon, and it continues to inspire with new features. The new LED light design is bright and provides maximum visibility: The LED swivelling headlights with adjustable headlights and the Cruising Light assure this. Additional features like seat heating provide further comfort, and the seven riding modes allow you to confidently handle any driving circumstance. Your appetite for knowledge will be unquenchable with this GS&lt;/span&gt;&lt;span style=\\&quot;font-family: &amp;quot;Segoe UI&amp;quot;;\\&quot;&gt;.&lt;/span&gt;&lt;/p&gt;', 5, 2500, 1, '2021-10-13 11:22:34', '2024-05-13 12:33:50'),
(2, 2, 1, 'Honda X-ADV 2021', '&lt;p style=\\&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;\\&quot;&gt;Maecenas eget ullamcorper risus. Duis nec ligula augue. Quisque feugiat enim varius varius volutpat. Aenean et orci neque. Sed mattis consequat tortor et porta. Donec pharetra at neque non eleifend. Donec laoreet velit ut purus imperdiet rhoncus. Donec gravida eros et dignissim molestie. Sed a lorem sit amet risus ullamcorper semper. Mauris eget dolor faucibus, elementum est eu, sodales augue. Nulla sodales rutrum augue a gravida. Nulla ut arcu vel augue lobortis auctor. Quisque cursus, quam quis dictum ultricies, ligula orci dignissim libero, ut blandit lectus eros ut enim. Curabitur faucibus arcu sit amet ligula auctor finibus a eget nulla. Cras quis aliquet ipsum.&lt;/p&gt;&lt;p style=\\&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;\\&quot;&gt;Nunc aliquet lobortis viverra. Vestibulum a dignissim eros. Sed porta nisi nec ornare ultricies. Vivamus eu massa aliquam quam dignissim porttitor. Quisque semper sed libero in mattis. Proin tincidunt mauris lectus, quis rhoncus ligula egestas tempus. Nunc eu magna vel enim congue fringilla vel vitae ipsum. Proin nec ipsum et augue fringilla malesuada. Aliquam lacus dolor, venenatis et sodales eget, dapibus nec tellus.&lt;/p&gt;', 3, 1500, 1, '2021-10-13 13:11:22', '2024-05-11 17:44:55'),
(4, 2, 1, 'HONDA ACTIVA 125', '&lt;p&gt;&lt;span style=\\&quot;color: rgb(51, 51, 51); font-family: &amp;quot;Open Sans&amp;quot;; font-size: 14.4px; text-align: justify;\\&quot;&gt;Activa 125 BS-VI with Honda&rsquo;s globally acclaimed Enhanced Smart Power (eSP) technology and many first in segment features. The eSP technology combines high power and high fuel efficiency with a quiet start, and a smooth eco-friendly engine. It also helps deliver a 13% increase in mileage and is integrated with the ACG starter motor to start the engine jolt free. With the highly efficient and advanced 125cc HET BS-VI engine, it is sure to silence all doubts about an unmatched performance by delivering consistent power output and higher mileage.The Idling Stop System automatically switches the engine off at traffic lights and other brief stops to save fuel.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 10, 500, 1, '2024-05-11 17:53:30', '2024-05-11 17:54:08'),
(5, 2, 1, 'HONDA DIO REPSOLE EDITION', '&lt;p&gt;&lt;span style=\\&quot;color: rgb(51, 51, 51); font-family: &amp;quot;Open Sans&amp;quot;; font-size: 14.4px; text-align: justify;\\&quot;&gt;A new and sportier look, aggressive design and fuelled by the spirit of a true racer, the DIO Repsol Honda Edition promises to unleash your sporty side. It&rsquo;s time to &lsquo;Keep DIOing it&rsquo; the Repsol Honda way.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 8, 600, 1, '2024-05-11 18:00:35', NULL),
(6, 6, 2, 'Royal Enfield Classic 350', '&lt;p&gt;The Classic 350 isn&rsquo;t really the most feature-heavy. It gets basic bulb units for the headlight, analogue speedometer, and odometer. There are two tell-tale lights for low fuel and engine check (introduced with the BS6 updates). However, the Classic 350 finally gets closed-loop fuel injection with an oxygen sensor in the exhaust. The variants with alloy wheels get tubeless tyres at both ends, which can handle punctures much better than tubed ones.&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;span style=\\&quot;color: rgba(36, 39, 44, 0.7); font-family: &amp;quot;Segoe UI&amp;quot;; text-align: justify; white-space-collapse: preserve;\\&quot;&gt;The Classic 350 is powered by a BS6-compliant 346cc single-cylinder air-cooled UCE thumper. In transitioning to the BS6 norms, the motor has lost 0.7PS in the process, now producing only 19.3PS. Thankfully, the torquey charm of the motor remains unchanged, churning out 28Nm. A standard 5-speed gearbox is mated to the Classic 350&rsquo;s engine. &lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 12, 1500, 1, '2024-05-11 20:04:40', '2024-05-11 20:08:10'),
(7, 3, 3, 'Yamaha R15 V4', '&lt;span style=\\&quot;color: rgb(72, 72, 72); font-family: &amp;quot;Segoe UI&amp;quot;; background-color: rgb(249, 249, 249);\\&quot;&gt;The Yamaha R15 V4 is one fantastic looking motorcycle. It is loaded with lots of features this time around, and with the styling inspired from the R7, the bike is more aspirational than before. But the pricing is a bit on the higher side which could be a dealer breaker for a few.&amp;nbsp;&lt;/span&gt;', 10, 1400, 1, '2024-05-11 20:15:17', NULL),
(8, 1, 3, 'Kawasaki NINJA ZX-6R', '&lt;p&gt;&lt;span style=\\&quot;text-align: justify; font-family: &amp;quot;Segoe UI&amp;quot;;\\&quot;&gt;All-new styling is inspired by the Ninja ZX-10R while embodying the ideal supersport image. New front and side cowls create a design that flows smoothly from head to tail. Compact new headlights and an intricately layered front cowl give the Ninja ZX-6R its new &ldquo;face,&rdquo; while blacked out engine covers and silencer add to the supersport image and LED turn signals complete an all-LED lighting packa&lt;/span&gt;&lt;span style=\\&quot;text-align: justify; font-family: &amp;quot;Segoe UI&amp;quot;;\\&quot;&gt;ge.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 2, 2000, 1, '2024-05-11 20:22:35', '2024-05-11 20:24:49'),
(9, 4, 3, 'Ducati Multistrada V4', '&lt;p&gt;Ducati Multistrada V4 is a motorcycle with a starting price of Rs 21.48 Lakh. It is available in India in 5 variants and 5 colours with high end variant price starting from Rs 31.48 Lakh. Multistrada V4 is powered by a 1158 ccbs6-2.0 engine which develops a power of 172.35 PS and a torque of 125 Nm. It has front brakes and rear brakes. The weight of Ducati Multistrada V4 is 239 kg and comes with a fuel tank capacity of 22 L.&lt;br&gt;&lt;/p&gt;', 1, 3000, 1, '2024-05-11 20:31:52', '2024-05-11 20:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `brand_list`
--

CREATE TABLE `brand_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand_list`
--

INSERT INTO `brand_list` (`id`, `name`, `status`, `date_created`) VALUES
(1, 'Kawasaki', 1, '2021-10-13 09:24:03'),
(2, 'Honda', 1, '2021-10-13 09:25:37'),
(3, 'Yamaha', 1, '2021-10-13 09:26:02'),
(4, 'Ducati', 1, '2021-10-13 09:26:11'),
(5, 'BMW', 1, '2021-10-13 09:26:16'),
(6, 'Royal Enfield', 1, '2021-10-13 09:26:41');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(30) NOT NULL,
  `category` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `description`, `status`, `date_created`) VALUES
(1, 'Scooter', 'Scooter Category', 1, '2021-10-13 09:39:31'),
(2, 'Adventure Bike', 'Adventure Bike Category', 1, '2021-10-13 09:40:06'),
(3, 'Sports Bike', 'Sports Bike Category', 1, '2021-10-13 09:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(30) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `address` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `firstname`, `lastname`, `gender`, `contact`, `email`, `password`, `address`, `date_created`) VALUES
(2, 'vikas', 'kumar', 'Male', '7372886157', 'vikashkumar9238@gmail.com', 'bebe68374a49cb41b7c9219e97250044', 'srinagar', '2024-05-11 16:57:58'),
(3, 'Rakesh', 'kumar', 'Male', '0123456789', 'rakesh@gmail.com', '67a05e3822ce48a6386746388e6c81f5', 'india', '2024-05-11 21:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `rent_list`
--

CREATE TABLE `rent_list` (
  `id` int(30) NOT NULL,
  `client_id` int(30) NOT NULL,
  `bike_id` int(30) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `rent_days` int(11) NOT NULL DEFAULT 0,
  `amount` float NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Pending,1=Confirmed,2=Cancelled,3=Picked -up, 4 =Returned',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rent_list`
--

INSERT INTO `rent_list` (`id`, `client_id`, `bike_id`, `date_start`, `date_end`, `rent_days`, `amount`, `status`, `date_created`, `date_updated`) VALUES
(8, 1, 6, '2024-05-08', '2024-05-30', 23, 34500, 0, '2024-05-11 20:43:38', NULL),
(10, 3, 2, '2024-05-09', '2024-05-12', 4, 6000, 2, '2024-05-11 21:07:38', '2024-05-11 21:12:38'),
(11, 3, 6, '2024-05-11', '2024-05-13', 3, 4500, 1, '2024-05-11 21:08:15', '2024-05-11 21:12:28'),
(12, 2, 8, '2024-05-12', '2024-05-13', 2, 4000, 3, '2024-05-11 21:09:17', '2024-05-11 21:12:13'),
(13, 2, 9, '2024-05-14', '2024-05-15', 2, 6000, 0, '2024-05-11 21:09:35', '2024-05-11 21:12:00'),
(14, 2, 4, '2024-05-12', '2024-05-23', 12, 6000, 1, '2024-05-11 21:10:20', '2024-05-11 21:11:17'),
(15, 2, 1, '2024-05-20', '2024-05-23', 4, 10000, 2, '2024-05-11 21:10:44', '2024-05-11 21:11:02'),
(16, 2, 2, '2024-05-14', '2024-05-30', 17, 25500, 1, '2024-05-13 10:48:49', '2024-05-13 10:49:31'),
(17, 2, 7, '2024-05-14', '2024-05-15', 2, 2800, 0, '2024-05-13 11:20:55', NULL),
(18, 1, 4, '2024-05-16', '2024-05-16', 1, 500, 0, '2024-05-14 23:19:35', NULL),
(19, 2, 5, '2024-06-12', '2024-06-28', 17, 10200, 0, '2024-06-24 01:26:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Bike Rental System'),
(6, 'short_name', 'Bike Rental'),
(11, 'logo', 'uploads/1715426760_8346259.jpg'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/1715441520_1634087520_bike-img-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/1624240500_avatar.png', NULL, 1, '2021-01-20 14:02:37', '2021-06-21 09:55:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bike_list`
--
ALTER TABLE `bike_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `brand_list`
--
ALTER TABLE `brand_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rent_list`
--
ALTER TABLE `rent_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
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
-- AUTO_INCREMENT for table `bike_list`
--
ALTER TABLE `bike_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `brand_list`
--
ALTER TABLE `brand_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rent_list`
--
ALTER TABLE `rent_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
