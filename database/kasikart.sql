-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql203.infinityfree.com
-- Generation Time: Jun 04, 2026 at 09:58 PM
-- Server version: 11.4.12-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_42015267_kasikart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_id` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `created_id`) VALUES
(29, 3, 14, '2026-06-03 12:09:54');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `created_at`) VALUES
(1, 3, '600.00', '2026-06-01 11:17:54'),
(2, 3, '600.00', '2026-06-01 11:19:16'),
(3, 3, '1260.00', '2026-06-01 11:32:53'),
(4, 3, '860.00', '2026-06-01 11:33:42'),
(5, 3, '410.00', '2026-06-01 11:37:09'),
(6, 3, '460.00', '2026-06-01 11:39:38'),
(7, 3, '510.00', '2026-06-01 12:01:49'),
(8, 3, '510.00', '2026-06-01 21:50:36'),
(9, 3, '7060.00', '2026-06-01 22:12:21'),
(10, 3, '760.00', '2026-06-03 10:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`) VALUES
(1, 1, 33, '600.00', 1),
(2, 2, 33, '600.00', 1),
(3, 3, 33, '600.00', 1),
(4, 3, 24, '600.00', 1),
(5, 4, 39, '800.00', 1),
(6, 5, 36, '350.00', 1),
(7, 6, 34, '400.00', 1),
(8, 7, 31, '450.00', 1),
(9, 8, 31, '450.00', 1),
(10, 9, 6, '7000.00', 1),
(11, 10, 40, '700.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `price`, `description`, `image`, `created_at`, `category`, `status`) VALUES
(5, 2, 'Logik Gas Heater', '380.00', 'Logik 3-Panel Portable Gas Heater. \r\nCondition: Great. Used but well maintained.\r\nHeater only, Gas Cylinder not included.', '1779324307_heater.jpeg', '2026-05-21 00:45:07', 'Pre-Loved Items', 'available'),
(7, 2, 'Iphone 15', '9000.00', 'Iphone 15, 512 GB Storage, 92% Battery Capacity, No Cracks, Fully Functional\r\nCondition: Used - Like New', '1779324584_iphone15.jpeg', '2026-05-21 00:49:44', 'Pre-Loved Items', 'available'),
(8, 2, 'Yamaha Keyboard', '5500.00', 'Yamaha CTK-3500 Keyboard, 61-Key Keyboard + X-Stand \r\nCondition: Like new. All keys, buttons, and sounds work 100%. No faults.\r\n', '1779324817_piano.jpeg', '2026-05-21 00:53:37', 'Pre-Loved Items', 'available'),
(9, 2, 'Polaroid Camera', '950.00', 'Fujifilm Instax Mini 12 Instant Polaroid Camera + 20 Film Sheets in Blossom Pink with Original box and Manual\r\nCondition: Good. No Scratches, Fully Functional, Batteries not included (uses 2x AA batteries)', '1779325106_polaroidcam.jpeg', '2026-05-21 00:58:26', 'Pre-Loved Items', 'available'),
(10, 2, 'Soundbar', '650.00', 'Hisense AX3100Q 500W 3.1CH Soundbar with Wireless Subwoofer - Dolby Atmos, Bluetooth.\r\nIncludes remote control, HDMI cable & original box.\r\nCondition: well used but fully functional.', '1779325319_soundbar.jpeg', '2026-05-21 01:01:59', 'Pre-Loved Items', 'available'),
(11, 2, 'Canon Camera', '2000.00', 'Canon Powershot G7 X - Premium compact camera. Canon Zoom Lens 4.2x, 8.8-36.8mm with f/1.8-2.8 aperture.\r\nComes with camera body, canon box, manual, charger & wrist strap.\r\nCondition: Brand new\r\n', '1779456609_g7x.jpeg', '2026-05-22 13:30:09', 'Pre-Loved Items', 'available'),
(12, 2, 'HP Laptop', '4800.00', 'Silver HP 15 Laptop', '1779456836_hplaptop.jpeg', '2026-05-22 13:33:56', 'Pre-Loved Items', 'available'),
(13, 2, 'Bapedi Dress', '450.00', 'Bapedi Pink & Cream Pleated Traditional Gown', '1779456984_bapediattire.jpeg', '2026-05-22 13:36:24', 'Clothing', 'available'),
(14, 2, 'Hand-beaded African Serving Spoon Set with Matching Beaded Placemat', '200.00', '2-piece stainless steel serving spoon set with hand-beaded  handles with a hand-woven straw placemat with a colorful beaded border', '1779457367_beaded.cutlery.jpeg', '2026-05-22 13:42:47', 'Other', 'available'),
(15, 2, 'Hand-beaded Wall Art, Lady in a Hat', '360.00', 'Handmade beaded wall art piece featuring a stylized silhouette of a woman in a wide-brimmed hat and flowing dress', '1779457717_beaded.lady.jpeg', '2026-05-22 13:48:37', 'Home Decor', 'available'),
(16, 2, ' White Fedora Hat with African Beadwork Band', '230.00', 'White fedora hat elevated with a handmade beaded band featuring bold, colorful geometric patterns inspired by Southern African beadwork traditions.', '1779457841_beadedhat.jpeg', '2026-05-22 13:50:41', 'Accessories', 'available'),
(17, 2, 'Hand-beaded African Print High Heel Sandals', '220.00', 'Peep-toe ankle strap heels with a stiletto heel  transformed with hand-beaded African patterns in vibrant orange, blue, yellow, and white.', '1779458198_beadedheels.jpeg', '2026-05-22 13:56:38', 'Accessories', 'available'),
(18, 2, 'Africa Map Wooden Wall Bookshelf ', '540.00', 'A hand-crafted bold, wall-mountable bookshelf shaped like the continent of Africa. A piece that combines functional storage with statement decor.', '1779458359_bookshelf.jpeg', '2026-05-22 13:59:19', 'Home Decor', 'available'),
(19, 2, 'Handmade Button Art Tree Canvas', '350.00', 'A charming handmade wall art piece featuring a tree made entirely from vintage and modern buttons, with embroidered branches and a tiny wooden swing. Mounted on a natural linen canvas background for a rustic, cozy feel.', '1779458456_button.art.jpeg', '2026-05-22 14:00:56', 'Home Decor', 'available'),
(20, 2, 'Hand-Carved Wooden African Woman Sculptures', '400.00', 'A pair of hand-carved wooden sculptures depicting African women carrying water pots on their heads. Carved from richly grained hardwood, each figure showcases the natural swirls and color variations of the wood, making every piece unique.', '1779458582_decorativepieces.jpeg', '2026-05-22 14:03:02', 'Home Decor', 'available'),
(21, 2, 'African Print Fabric Tassel Earrings', '180.00', 'Bold, lightweight handmade earrings from vibrant African print fabric, topped with long green tassels', '1779458680_earings.jpeg', '2026-05-22 14:04:40', 'Accessories', 'available'),
(22, 2, 'Handmade Wooden Hexagon Wall Shelves, Set of 2', '200.00', 'A set of two geometric hexagon wall shelves handcrafted from stacked wooden popsicle sticks, perfect for displaying small plants, succulents, and decor.', '1779458803_icecreamsticks.jpeg', '2026-05-22 14:06:43', 'Home Decor', 'available'),
(23, 2, 'Hand-Carved Wooden Tree Root Pedestal Bowl ', '250.00', 'A stunning one-of-a-kind wooden bowl featuring a smooth carved bowl perched on a sculpted tree root base.', '1779458995_junkholder.jpeg', '2026-05-22 14:09:55', 'Home Decor', 'available'),
(24, 2, 'Handwoven Placemats & Basket Set with Pearl & Bow Detail, 6-Piece Table Set', '600.00', 'A rustic-chic table set featuring 6 round placemats and a matching woven basket, accented with faux pearls and bows.', '1779459076_mats.jpeg', '2026-05-22 14:11:16', 'Other', 'available'),
(25, 2, 'Handmade Pebble & Rope Round Mirror, Wall Decor', '420.00', 'A round mirror framed with natural river pebbles and thick rope, hung with a handmade rope hanger.', '1779459186_mirror.decor.jpeg', '2026-05-22 14:13:06', 'Home Decor', 'available'),
(26, 2, 'Handbeaded Zulu-Inspired Hat & Accessories Set: 4-Piece Colorful Beadwork Set', '800.00', 'A vibrant, hand-beaded 4-piece set featuring a traditional-style hat with wide brim, a beaded neck ring, and two arm cuffs. Each piece covered in colorful geometric beadwork.', '1779459270_ndebele.beads.jpeg', '2026-05-22 14:14:30', 'Accessories', 'available'),
(27, 2, 'Hand-Carved Wooden Sectional Serving Platters: Set of 3', '580.00', 'A set of 3 hand-carved wooden serving platters with organic, flowing compartments. Made from solid hardwood, designed for serving snacks, appetizers, nuts, and small bites in style.', '1779459403_platters.jpeg', '2026-05-22 14:16:43', 'Other', 'available'),
(28, 2, 'Carved Wooden Remote Control Holder  5-Slot Tabletop Organizer', '220.00', 'A stylish wooden organizer designed to keep remotes, phones, and small items off your coffee table. With 5 angled slots and decorative cut-out sides', '1779459459_remoteholder.jpeg', '2026-05-22 14:17:39', 'Home Decor', 'available'),
(29, 2, 'Sotho Off-Shoulder Corset Dress', '640.00', 'A stunning off-shoulder dress made from classic  fabric, blending traditional Sotho South African print with a modern corset silhouette. The deep navy base with white circular patterns gives it a timeless, elegant look perfect for weddings, makoti events, and celebrations.', '1779459692_sothoattire.jpeg', '2026-05-22 14:21:32', 'Clothing', 'available'),
(30, 2, 'Handcrafted Twig Stag Wall Art ', '180.00', 'A one-of-a-kind wall sculpture of a stag crafted entirely from natural twigs and branches. Each piece of wood is hand-selected and arranged to form a rustic, textured deer that brings the forest indoors.', '1779459769_stick.art.jpeg', '2026-05-22 14:22:49', 'Home Decor', 'available'),
(31, 2, 'Swati-Inspired Straples Gown', '450.00', 'A bold, regal ball gown featuring a fitted strapless white bodice paired with a voluminous printed skirt in red, blue, and yellow. The skirt showcases traditional Swati shield and spear motifs, making this dress perfect for cultural events and statement occasions.', '1779459913_swatiattire2.jpeg', '2026-05-22 14:25:13', 'Clothing', 'available'),
(32, 2, '3-Tier Round Wooden Side Table with Metal Legs, Modern Minimalist Accent Table', '250.00', 'A sleek 3-tier side table combining warm walnut wood tops with slim black metal legs. The stacked round shelves create a clean, sculptural look that works as a side table, bedside table, or display stand.\r\nCondition: Good. No scratches or dents.', '1779460008_table.jpeg', '2026-05-22 14:26:48', 'Pre-Loved Items', 'available'),
(33, 2, 'Green Tsonga-Inspired Floral Midi Dress ', '600.00', 'A vibrant, feminine midi dress in rich forest green Tsonga-inspired fabric, featuring bold pink floral prints and contrast pink chevron details. Designed with puff sleeves and a tiered skirt, it\'s perfect for weddings, Heritage Day, and festive celebrations.', '1779460255_tsongaattire.jpeg', '2026-05-22 14:30:55', 'Clothing', 'available'),
(34, 2, 'Hand-Carved Wooden Wave Wine Rack', '400.00', 'A sculptural wine rack carved from solid wood with flowing, wave-like curves that cradle 3 bottles in style.', '1779460344_wineholder.jpeg', '2026-05-22 14:32:24', 'Home Decor', 'available'),
(35, 2, 'Rustic Reclaimed Wood Wall Clock', '230.00', 'A handcrafted wall clock made from 5 staggered reclaimed wood planks, giving it a bold, rustic look. ', '1779460399_woodenclock.jpeg', '2026-05-22 14:33:19', 'Home Decor', 'available'),
(36, 2, 'Hand-Carved Wooden Afro Picks (Combs)', '350.00', 'A set of 3 hand-finished wooden Afro picks/combs. These combs are both functional for styling thick, coily, and natural hair, and beautiful as display pieces or cultural decor.', '1779460502_woodencombs.jpeg', '2026-05-22 14:35:02', 'Other', 'available'),
(37, 2, 'Black & White Xhosa-Inspired Accessories', '650.00', 'A complete handbeaded set in striking black and white, featuring geometric patterns inspired by Xhosa beadwork. Made for cultural events, weddings, and heritage celebrations, this set brings bold contrast and traditional meaning to any outfit.', '1779460645_xhosa.beads.jpeg', '2026-05-22 14:37:25', 'Accessories', 'available'),
(38, 2, 'Xhosa-Inspired Strapless Ball Gown', '580.00', 'An elegant strapless ball gown blending modern bridal silhouette with traditional Xhosa umbhaco-inspired design. The white base features bold blue, grey, and white stripes with geometric detailing, perfect for weddings and formal cultural events.', '1779460771_xhosaattire2.jpeg', '2026-05-22 14:39:31', 'Clothing', 'available'),
(39, 2, 'Red, Black & White Xhosa-Inspired Off-Shoulder Umbhaco Dress', '800.00', 'A bold, modern take on traditional Xhosa attire featuring striking red, black, and white colors with pleated detailing and beaded accents. Worn off-shoulder with a dramatic draped shawl, this dress is made for weddings and heritage celebrations.', '1779460843_xhosaattire4.jpeg', '2026-05-22 14:40:43', 'Clothing', 'available'),
(40, 2, 'Vibrant Multi-Color Ndebele Beaded Cultural Set ', '700.00', 'A hand-beaded set bursting with color and geometric patterns inspired by Ndebele beadwork. Made for cultural ceremonies, weddings, Heritage Day, and photoshoots, this set is designed to bring energy and tradition to any outfit.', '1779460944_zulubeads.jpeg', '2026-05-22 14:42:24', 'Accessories', 'available'),
(43, 8, 'Monochrome Geometric Wrap Kaftan Dress', '390.00', 'Bold black and white wrap kaftan blends minimalist design with dramatic silhouette.', '1780621112_chipo.jpeg', '2026-06-05 00:58:31', 'Clothing', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `role`, `created_at`, `profile_image`) VALUES
(1, 'Carol', 'carolelishaxo@gmail.com', '$2y$10$kuHjb7DjUhm.V5yvnshNluiurQNd1DWQlpaaxnW3vc81TRpbQRFf2', 'admin', '2026-05-13 13:20:03', ''),
(2, 'Tanyaradzwa', 'tanya31@yahoo.com', '$2y$10$TwVrPM6DfC8rRR8psSO.F.QvMN4hiDcA.hkiCeApwwfpEcmvzL44K', 'seller', '2026-05-13 20:53:26', ''),
(3, 'Nicole', 'nicolem23@gmail.com', '$2y$10$AMVs90rQtiPAHSdbxDB3W.8Mv6rBULeJ3D5Dl.HtPMHp2kSzk5ZTO', 'buyer', '2026-05-13 21:07:10', ''),
(4, 'Joe', 'josephelisha26@gmail.com', '$2y$10$puab6RV6lEVXFkhrxI5hkuIIBLEakXaIZkCZ5sX0ivcaT7W1Afmdu', 'seller', '2026-05-25 18:33:56', ''),
(6, 'Jaden ', 'josiahcrimson77@gmail.com', '$2y$10$TKb7MZhXeAvmzdSZD/XyieYGyeJsWeL2Hel980PMJssdRE6EA0wUe', 'seller', '2026-05-25 20:43:07', ''),
(8, 'Chipo', 'chipo1910@gmail.com', '$2y$10$tLpKpof7.Gw8pQB9UWkIZeAn9FcWHQaGVKr4yUsnbnMl6xTJs1whO', 'seller', '2026-06-05 00:53:47', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
