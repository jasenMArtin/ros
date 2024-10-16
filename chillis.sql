-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2024 at 07:03 PM
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
-- Database: `chillis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_carts`
--

CREATE TABLE `tbl_carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `spice_level` varchar(255) DEFAULT NULL,
  `added_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checkout`
--

CREATE TABLE `tbl_checkout` (
  `checkout_id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `cart_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','completed','failed') NOT NULL,
  `delivery_status` enum('pending','delivered') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE `tbl_items` (
  `item_id` int(11) NOT NULL,
  `item_title` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `item_image` varchar(255) DEFAULT NULL,
  `item_active` tinyint(1) DEFAULT NULL,
  `category` enum('Food','Drinks','Dessert','Noodles','Seafood','Paneer Tikka','Bread') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`item_id`, `item_title`, `description`, `price`, `item_image`, `item_active`, `category`) VALUES
(1, 'Margherita Pizza Jayson', 'Classic Margherita Pizza with fresh tomatoes, mozzarella cheese, and basil.', 8.99, '../images/food/burger.jpg', 1, 'Food'),
(2, 'Chicken Caesar Salad', 'Grilled chicken on a bed of romaine lettuce, croutons, and Caesar dressing.', 10.50, '../images/food/pizza.jpg', 1, 'Food'),
(3, 'Spaghetti Carbonara', 'Traditional Italian pasta with creamy egg sauce, pancetta, and Parmesan cheese.', 12.00, '../images/food/burger.jpg\r\n', 1, 'Food'),
(4, 'Veggie Burger', 'A delicious veggie patty with lettuce, tomato, and special sauce on a whole grain bun.', 19.50, '../images/food/pizza.jpg', 1, 'Food'),
(5, 'Chocolate Lava Cake', 'Warm chocolate cake with a gooey molten ', 6.75, '../images/food/plate1.png', 1, 'Food'),
(6, 'Burger', 'A delicious beef burger with cheese.', 150.00, '../images/food/pizza.jpg', 1, 'Food'),
(7, 'Pizza', 'A large pizza with various toppings.', 300.00, '../images/food/pizza.jpg', 1, 'Food'),
(8, 'Pasta', 'Pasta with marinara sauce.', 200.00, '../images/food/pizza.jpg', 1, 'Food'),
(9, 'Coke', 'A refreshing cola drink.', 50.00, '../images/food/pizza.jpg', 1, 'Drinks'),
(10, 'Orange Juice', 'Freshly squeezed orange juice.', 60.00, '../images/food/pizza.jpg', 1, 'Drinks'),
(11, 'Water', 'Bottled water.', 20.00, '../images/food/pizza.jpg', 1, 'Drinks'),
(12, 'Chocolate Cake', 'Rich chocolate cake.', 120.00, '../images/food/pizza.jpg', 1, 'Dessert'),
(13, 'Ice Cream', 'Vanilla ice cream topped with syrup.', 80.00, '../images/food/pizza.jpg', 1, 'Dessert'),
(14, 'Cheesecake', 'Creamy cheesecake with a graham cracker crust.', 90.00, '../images/food/pizza.jpg', 1, 'Dessert'),
(15, 'Paneer Noodles', 'Delicious noodles tossed with paneer and spices.', 150.00, '../images/food/noodle.jpg', 1, 'Noodles'),
(16, 'Masala Noodles', 'Spicy Indian style masala noodles with vegetables.', 120.00, 'path/to/masala_noodles_image.jpg', 1, 'Noodles'),
(17, 'Fish Curry', 'Traditional Indian fish curry made with spices and coconut milk.', 250.00, '../images/food/seafood.jpg', 1, 'Seafood'),
(18, 'Prawn Masala', 'Juicy prawns cooked in a rich and spicy masala sauce.', 300.00, 'path/to/prawn_masala_image.jpg', 1, 'Seafood'),
(19, 'Paneer Tikka', 'Marinated paneer cubes grilled to perfection.', 200.00, '../images/food/paner.jpg', 1, 'Paneer Tikka'),
(20, 'Achari Paneer Tikka', 'Paneer marinated in pickling spices and grilled.', 220.00, 'path/to/achari_paneer_tikka_image.jpg', 1, 'Paneer Tikka'),
(21, 'Naan Bread', 'Soft and fluffy Indian bread, perfect for dipping in curry.', 3.00, '../images/food/bread.jpg', 1, 'Bread'),
(22, 'Paratha', 'Deliciously flaky Indian flatbread, often stuffed with various fillings.', 4.50, '../images/bread/paratha.jpg', 1, 'Bread');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message`
--

CREATE TABLE `tbl_message` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_message`
--

INSERT INTO `tbl_message` (`message_id`, `user_id`, `datetime`, `message`) VALUES
(17, 51, '2024-10-08 00:19:23', 'Good morning'),
(67, 51, '2024-10-12 20:19:15', 'test 1'),
(68, 51, '2024-10-13 16:34:50', 'Where is your location?'),
(69, 51, '2024-10-13 16:41:20', 'dsfdf'),
(70, 51, '2024-10-13 17:20:55', 'dsfdf'),
(71, 51, '2024-10-13 17:21:03', 'hellopo\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(100) DEFAULT NULL,
  `role` enum('user','admin','staff') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `address`, `password`, `phone_number`, `created_at`, `email`, `role`) VALUES
(51, 'haha', 'haha', 'haah', '$2y$10$HyMYC/cK/SYDmAo0qf/SgOdK/.O7esB7suDWeWu5JLMbyYA0M.hjq', '09254749274', '2024-09-16 15:14:11', 'haha@gmail.com', 'user'),
(55, 'Staff', 'Sas', 'cebu', '$2y$10$u3Wcvi8HzWUZ6ku7DJSJqOVIQGAXh3N2YylgwLYb/dxARkbOXWjbi', 'ewqe', '2024-10-07 13:58:06', 'staff1@gmail.com', 'staff'),
(56, 'Admin', 'Admin', 'cebu', '$2y$10$JvQoXTzbcK2ys..ez3UWqu3mTSYmeYG34TNNZh2DoIx.KL0Mjv15G', 'wdsd', '2024-10-07 14:01:34', 'admin@gmail.com', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  ADD PRIMARY KEY (`checkout_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `secondary_email` (`email`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  MODIFY `checkout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  ADD CONSTRAINT `tbl_checkout_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_checkout_ibfk_2` FOREIGN KEY (`cart_id`) REFERENCES `tbl_carts` (`cart_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD CONSTRAINT `tbl_message_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
