-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 01, 2023 at 03:28 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lapzy`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Dell'),
(2, 'Hp'),
(3, 'Zebronics'),
(4, 'SanDisk'),
(5, 'StillerSafe'),
(6, 'Lenovo'),
(7, 'Samsung'),
(8, 'Acer'),
(9, 'Asus'),
(10, 'Portronics'),
(11, 'Logitech'),
(12, 'Saco'),
(13, 'Seagate'),
(14, 'Apple'),
(15, 'Xiaomi');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(9, 3, 1, 1),
(10, 3, 19, 4),
(17, 3, 9, 1),
(20, 5, 20, 1),
(32, 2, 20, 3),
(33, 3, 20, 1),
(34, 2, 8, 1),
(35, 6, 4, 1),
(36, 6, 18, 1),
(37, 2, 1, 1),
(39, 2, 9, 3),
(40, 2, 2, 1),
(41, 2, 4, 1),
(42, 2, 3, 1),
(47, 7, 3, 1),
(48, 7, 6, 1),
(49, 4, 1, 1),
(50, 4, 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Laptop'),
(2, 'Display'),
(3, 'Mouse'),
(4, 'Keyboard'),
(5, 'Touchpad'),
(6, 'Hard Drive'),
(7, 'Pen Drive'),
(8, 'Flash Drive'),
(9, 'Joystick'),
(10, 'Keyboard Cover');

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `stock` int(11) NOT NULL,
  `from_address` varchar(200) NOT NULL,
  `to_address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id`, `product_name`, `stock`, `from_address`, `to_address`) VALUES
(1, 'Apple 2022 MacBook Air Laptop with M2 chip: 34.46 cm', 4, 'lapzymanager@gmail.com', 'dealershoplap@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `order_date`) VALUES
(1, 2, 6, 1, '2023-04-09'),
(2, 2, 20, 1, '2023-04-09'),
(3, 2, 19, 1, '2023-04-09'),
(4, 3, 4, 1, '2023-04-09'),
(5, 3, 15, 1, '2023-04-09'),
(6, 4, 4, 1, '2023-04-10'),
(7, 2, 6, 2, '2023-04-11'),
(8, 2, 8, 1, '2023-04-11'),
(9, 2, 9, 1, '2023-04-11'),
(10, 4, 7, 1, '2023-04-14'),
(11, 4, 10, 2, '2023-04-14'),
(12, 7, 9, 2, '2023-04-21'),
(13, 8, 1, 1, '2023-04-23'),
(14, 8, 2, 1, '2023-04-23'),
(15, 8, 7, 1, '2023-04-23'),
(16, 9, 5, 1, '2023-04-26'),
(17, 9, 17, 1, '2023-04-26'),
(18, 9, 19, 1, '2023-04-26'),
(19, 9, 6, 2, '2023-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `stock`, `category_id`, `brand_id`, `image`, `description`, `date`) VALUES
(1, 'Samsung Galaxy Book2 Pro 360 Intel 12th Gen i7 Thin & Light Laptop', 124490, 26, 1, 7, 'laptop-1.png', 'Processor: 12th Generation IntelEVOTM Core i7-1260P processor (2.1 GHz up to 4.6 GHz 18 MB L3 Cache) \r\nMemory: 16 GB LPDDR5 Memory (On BD 16 GB)\r\nStorage: 512 GB NVMe SSD, 1 slot for SSD storage expansion\r\nOperating System: Windows 11 Home \r\nPreinstalled Software: MS Office Home & Student 2021, Live Message, Live Wallpaper, McAfee Live Safe (Trial), Screen Recorder, Samsung Gallery, Quick Search, Samsung Flow, Samsung Notes, Samsung Recovery, Samsung Settings, Studio Plus, Samsung Update, Samsung Security, Quick Share, Galaxy Book Smart Switch Display: 15.6 inch (39.6 cm), FHD AMOLED Display (1920 x 1080)\r\nTouchscreen\r\nIntel Iris Xe Graphics\r\nDesign: Aluminum body with 11.9mm thinness and 1.41kg Ports: 1 Thunderbolt 4, 2 USB Type-C, MicroSD Multi-media Card Reader, 1 Headphone out/Mic-in Combo', '2023-04-23 14:28:32'),
(2, 'Acer Aspire 3 Intel Core i3 11th Generation - Full HD Display Laptop', 34990, 40, 1, 8, 'laptop-2.png', 'Powerful and portable, the Aspire 3 laptop delivers on every aspect of everyday computing. Featuring the new 11th Gen InteI Core i3 processor, the Aspire 3 opens more possibilities than ever before - via performance, connectivity and entertainment.\r\n11th Generation Intel Core i3-1115G4 Dual Core Processor (3.0GHz up to 4.1GHz)\r\n8GB DDR4 Memory, expandable to 12GB; 256GB SSD and supports up to 2 TB HDD to store your files and media\r\nOperating System : Windows 11 Home \r\nMicrosoft Office 2021 The Aspire 3 is the perfect laptop for every need. It packs a beautiful 15.6\" Full HD screen\r\nMaximum: 1920 X 1080\r\nResolution: 1080p\r\nSoftware Included: Microsoft Office 365', '2023-04-23 14:28:05'),
(3, 'ASUS VivoBook 14, 14.1\" Inch HD LED, Intel Core i3-10th Gen, Thin and Light Laptop', 30690, 43, 1, 9, 'laptop-3.png', 'Processor: 10th Gen Intel Core i3-1005G1, 1.2 GHz Base Speed, up to 3.4 GHz Turbo Boost Speed, 2 cores, 4 Threads, 4MB Cache\r\nMemory: 8GB (4GB onboard + 4GB SO-DIMM) DDR4 2666MHz Dual Channel RAM, Upgradeable up to 20GB using 1x SO-DIMM Slot\r\nStorage: 1 TB HDD with empty 1x M.2 Slot for SSD storage expansion\r\nGraphics: Integrated Intel UHD Graphics\r\nDisplay: 14.1-Inch (35.56 cms) LED-Backlit\r\nDesign & battery: Up to 19.9mm Thin | NanoEdge Bezels | Thin and Light Laptop | Laptop weight: 1.6 kg | 37WHrs, 2-cell Li-ion battery | Up to 6 hours’ battery life\r\nHuman Interface Input: Microphonekeyboard\r\nForm Factor: Netbook\r\nSoftware Included: Microsoft Office 365', '2023-04-21 08:22:14'),
(4, 'HP Omen 12th Gen Intel Core i7 - FHD Gaming Laptop', 150180, 21, 1, 2, 'laptop-4.png', 'Processor: Intel Core i7-12700H (up to 4.7 GHz with Intel Turbo Boost Technology(2g), 24 MB L3 cache, 14 cores, 20 threads)\r\nMemory:16 GB DDR5-4800 MHz RAM (2 x 8 GB) Upto 32 GB DDR5-4800 MHz RAM (2 x 16 GB)\r\nStorage: 1 TB PCIe NVMe TLC SSD\r\nDisplay & Graphics : 40.9 cm (16.1\") diagonal, FHD, 144 Hz, 7 ms response time, IPS, micro-edge, anti-glare, Low Blue Light, Brightness: 300 nits, 137 ppi, 1920 x 1080, 100% sRGB \r\nGraphics: NVIDIA GeForce RTX 3050 Ti Laptop GPU (4 GB GDDR6 dedicated)\r\nOperating System & Preinstalled Software: Windows 11 Home 64 Plus Single Language \r\nMicrosoft Office Home & Student 2021 McAfee LiveSafe (30 days free trial as default)', '2023-04-20 08:58:32'),
(5, 'HP ProBook 430 G3 13.3 inches Intel Laptop Core i5 6th Gen/8 GB RAM', 25998, 48, 1, 2, 'laptop-5.png', 'HP ProBook 430 G3 gives lightning fast performance at affordable Price.\r\nA proper business laptop Ideal for mobile professionals needing best-in-class,business rugged notebooks.\r\nSlim laptop which is suitable for all your requirements, weighing just 1.5 Kg,\r\nIt comes along with Intel HD Graphics 520 and 8GB RAM along with 512GB SSD Storage which enhances the overall performance of the machine.\r\nIt offers Brighter, crisper display with 13.3-inch HD AG Display along with 720p HD Webcam and Microphone which enhances your video conferencing experience.', '2023-04-26 09:12:34'),
(6, 'Lenovo IdeaPad 3 11th Gen Intel Core i3 15.6\" FHD Thin & Light Laptop', 36158, 19, 1, 6, 'laptop-6.png', 'Processor: 11th Gen Intel Core i3-1115G4 \r\nSpeed: 3.0 GHz (Base) - 4.1 GHz (Max) | 2 Cores | 4 Threads | 6MB Cache\r\nDisplay: 15.6\" FHD (1920x1080)| TN Technology | 220Nits Brightness | Anti Glare \r\nMemory: 8GB RAM DDR4-2666 | Upgradable Up to 12GB \r\nStorage: 512 GB SSD\r\nOS and Software: Windows 11 Home 64 | Office Home and Student 2021 | Xbox GamePass Ultimate 3-month subscription*\r\nGraphics: Integrated Intel UHD Graphics \r\nDesign: 1.99 cm Thin and 1.7 kg Light\r\nBattery Life: 45Wh Battery | Upto 7 Hours | Rapid Charge (Up to 80% in 1 Hour) \r\nPorts: 2x USB-A 3.2 Gen 1 | 1x USB-A 2.0 |1x Headphone / microphone combo jack (3.5mm) | 1x HDMI 1.4 |1x 4-in-1 media reader (MMC, SD, SDHC, SDXC)\r\nCamera (Built in): HD 720p | Fixed Focus | Privacy Shutter | Integrated Dual Array Microphone\r\nSmart Learning Features : Lenovo Aware | Whisper Voice | Eye Care', '2023-04-28 02:42:42'),
(7, 'HP Pavilion Gaming 5th Gen AMD Ryzen 5 Processor 15.6 inches FHD Gaming Laptop', 62900, 21, 1, 2, 'laptop-hp.png', 'Processor: 5th Gen AMD Ryzen 5 5600H (up to 4.2 GHz max boost clock, 16 MB L3 cache, 6 cores)\r\nMemory: 8 GB DDR4-3200 (1 x 8 GB), Up to 16 GB DDR4-3200 SDRAM| Storage: 512 GB PCIe NVMe M.2 SSD\r\nDisplay: 15.6-Inch FHD IPS micro-edge, anti-glare Display |Brightness: 250 nits, 141ppi, 45% NTSC (1920 x 1080) | 144 Hz Refresh Rate\r\nGraphics: NVIDIA GeForce GTX 1650 (4 GB GDDR6 dedicated)\r\nOperating System & Software: Pre-loaded Windows 10 Home with lifetime validity | Pre-installed Microsoft Office Home & Student 2019\r\nIn an unlikely case of product quality related issue, we may ask you to reach out to brand’s customer service support and seek resolution. We will require brand proof of issue to process replacement request.', '2023-04-23 14:30:36'),
(8, 'HP Pavilion 14 12th Gen Intel Core i7 1TB SSD 14 inch(35.6cm) FHD Laptop', 84490, 18, 1, 2, 'laptop-8.png', 'Processor:Intel Core i7-1255U (up to 4.7 GHz with Intel Turbo Boost Technology(2g),12 MB L3 cache, 10 cores, 12 threads)\r\nMemory & Storage: 16 GB DDR4-3200 SDRAM (2 x 8 GB)\r\nStorage: 1 TB PCIe NVMe M.2 SSD\r\nDisplay & Graphics: 35.6 cm (14\") diagonal, FHD, IPS, micro-edge, BrightView, 250 nits, 157 ppi\r\nGraphics: Intel UHD Graphics;Operating System & Pre-installed Software: Pre-loaded Windows 11 Home 64 Single Language\r\nMicrosoft Office Home & Student 2021\r\nMcAfee LiveSafe (30 days free trial as default)\r\nPre-installed Alexa built-in- Your life simplified with Alexa. Just ask Alexa to check your calendar, create to-do lists, shopping lists, play music, set reminders, get latest news and control smart home.', '2023-04-24 13:20:30'),
(9, 'Apple 2022 MacBook Air Laptop with M2 chip: 34.46 cm', 113490, 4, 1, 14, 'laptop-9.png', 'STRIKINGLY THIN DESIGN – The redesigned MacBook Air is more portable than ever and weighs just 1.24 kg (2.7 pounds). It’s the ultra-capable laptop that lets you work, play or create just about anything — anywhere.\r\nSUPERCHARGED BY M2 – Get more done faster with a next-generation 8-core CPU, up to 10-core GPU and up to 24GB of unified memory.\r\nUP TO 18 HOURS OF BATTERY LIFE – Go all day and into the night, thanks to the power-efficient performance of the Apple M2 chip.\r\nBIG, BEAUTIFUL DISPLAY – The 34.46-centimetre (13.6-inch) Liquid Retina display features over 500 nits of brightness, P3 wide colour and support for one billion colours for vibrant images and incredible detail.\r\nADVANCED CAMERA AND AUDIO – Look sharp and sound great with a 1080p FaceTime HD camera, three-mic array and four-speaker sound system with Spatial Audio.\r\nVERSATILE CONNECTIVITY – MacBook Air features a MagSafe charging port, two Thunderbolt ports and a headphone jack.\r\nEASY TO USE – Your Mac feels familiar from the moment you turn it on and works seamlessly with all your Apple devices.', '2023-04-24 13:21:01'),
(10, 'StillerSafe Brand 15.6 Inch Zero Eye Strain Anti Glare Laptop Screen', 2399, 48, 2, 5, 'display-1.png', 'This Zero Eye Strain screen is light grey in color and (without privacy) exclusively designed to protect your eyes from EXCESSIVE LAPTOP USAGE which causes headaches, fatigue, dry eyes & eye strain issues.\r\nPrivacy Screens is for data protection not for eye protection and do not have Anti-glare or Eye Protection Technology. Excess Usage of Privacy screens is not recommended due to its dark shade.\r\nThis ALCS (advanced light control) screen block blue light and keep your eyes safe from long working hours.\r\nInstallation - This is Easy Stick Removable screen with soft glue on edges only. Very easy to stick and remove anytime. Any issue with screen, size, or replacement please connect with our customer care number mentioned on our packaging.\r\nDesigned to protect your eyes from red eyes and dry eyes, an unspoken epidemic.', '2023-04-14 06:26:58'),
(11, 'Lenovo Replacement LCD Screen for Lenovo Laptop', 7999, 50, 2, 6, 'display-2.png', 'The screen is sensitive enough and precise and works perfectly\r\nMade up of durable material\r\nCompatible for Lenovo Laptop', '2023-04-07 12:16:23'),
(12, 'Dell Wired Multimedia USB Keyboard with Super Quite Plunger Keys with Spill-Resistant Black', 549, 50, 4, 1, 'keyboard-1.png', 'DEVICE TYPE: Keyboard\r\nCONNECTIVITY TECHNOLOGY: Wired\r\nINTERFACE: USB\r\nHOT KEYS FUNCTION: Volume, Mute, Play/Pause, Backward, Forward\r\nKEYS STYLE: Chiclet', '2023-04-07 12:17:24'),
(13, 'HP 150 Wired Keyboard, Quick, Comfy and Ergonomically Design, Plug and Play USB Connection and LED Indicator', 580, 39, 4, 2, 'keyboard-2.png', 'Get typing in no time – enjoy quick connectivity across USB port compatible devices with a full-frame, classic keyboard.\r\nSit in a suitable position and rest your palm and wrists easily with this height-adjustable keyboard designed for comfort.\r\nMaximize your productivity with a full range of 109 keys, including a numeric keypad for easy data-entry, 12 Function keys and 3 Hotkeys.\r\nEnjoy 3-years manufacturer warranty on the device from the date of purchase', '2023-04-09 14:55:49'),
(14, 'ZEBRONICS K24 USB Keyboard with Long Life 8 Million Keystrokes, Silent & Comfortable Use, Slim Design', 349, 60, 4, 3, 'keyboard-3.png', 'Standard keyboard layout with 104 Keys and UV coated keycaps (full size).\r\nProven durability with 8 million keystrokes for lifelong usage.\r\nThe keyboard supports the Rupee key in the layout.\r\n1.5 meter textured cable length and quality USB connector for usage with computer and laptop.\r\nSilent performance and comfortable usage with the retractable stand option.\r\nSimply plug the USB and start using the ZEB-K24 keyboard with your computer / laptop.\r\nThe keyboard has a sleek and slim design. It has comfortable chiclet style keys which are easy to type on.', '2023-04-07 12:19:06'),
(15, 'Dell USB Wireless Keyboard Anti-Fade & Spill-Resistant Keys, up to 36 Month Battery Life', 1299, 39, 4, 1, 'keyboard-4.png', 'Movement Detection Technology (Mouse): Optical Buttons Qty: 03 Movement Resolution: 1000 dpi\r\nHot Keys Function: Volume, Mute Keyboard Technology: Plunger\r\nDevice Type: Keyboard and mouse set\r\nWireless Receiver: USB Wireless Receiver Adjustable Height: Yes\r\nInterface: 2.4 GHz Type Keyboard/Mouse : Wireless', '2023-04-09 16:03:02'),
(16, 'Saco Transparent Laptop Touchpad Protector for All Laptops', 263, 70, 5, 12, 'touchpad-1.png', 'Saco Transparent Laptop\r\nTouchpad Protector for\r\nAll Laptops (Clear, 158x98 mm)', '2023-04-07 12:20:44'),
(17, 'Seagate Barracuda 1TB Internal Hard Drive HDD – 2.5 Inch (6.35 cm) SATA 6 Gb/s, 5400 RPM, 128MB Cache for Computer Desktop PC', 3790, 34, 6, 13, 'harddrive-1.png', 'Store more, compute faster, and do it confidently with the proven reliability of BarraCuda internal hard drives\r\nBuild a powerhouse gaming computer or desktop setup with a variety of capacities and form factors\r\nThe go-to SATA hard drive solution for nearly every PC application—from music to video to photo editing to PC gaming\r\nConfidently rely on internal hard drive technology backed by 20 years of innovation\r\nMigrate and clone data from old drives with ease using our free Seagate DiscWizard software tool\r\nEnjoy long-term peace of mind with the included two-year limited warranty', '2023-04-26 09:12:48'),
(18, 'SanDisk Cruzer Blade 32GB USB Flash Drive', 278, 36, 8, 4, 'pendrive-1.png', 'Compact Design for Maximum Portability.\r\nStore more with capacities up to 16gb 5-year limited warranty , High-Capacity Drive Accommodates Your Favorite Media Files. Write Speed : 20 MB/s (USB 2.0)\r\nOperating temperature: 0ºC to 45ºC , Storage temperature: -10ºC to 70ºC\r\nSanDisk SecureAccess Software Protects Drive from Unauthorized Access\r\nThe models are different because production is from different countries. Otherwise both are sandisk cruzer blade models.', '2023-04-21 13:35:49'),
(19, 'HP USB 2.0 64GB Pen Drive, Metal', 416, 39, 7, 2, 'pendrive-2.png', 'Durable metal Charming appearance which brings a great sense of style\r\nElectronic plating after printing technic (Anti-fake). Other Features : Plug & Play\r\nLidless, compact design with integrated strap-hole, Temperature Proof, Shock-Proof, and vibration-proof\r\nThis pendrive is compatible with operating systems such as Windows 2000/XP and Vista, Windows 7, 8, 10 and MAC operating systems 10.3 and above. The HP V236W 64GB Pendrive has a minimum write rate of 4MB/sec and a read rate of 14MB/sec\r\nDurable metal Charming appearance which brings a great sense of style\r\nElectronic plating after printing technic (Anti-fake). Other Features : Plug & Play', '2023-04-26 09:13:07'),
(20, 'Logitech Wireless Mouse, 2.4 GHz with USB Nano Receiver, Optical Tracking, 12-Months Battery Life', 585, 39, 3, 11, 'mouse-1.png', 'Reliable Wireless Connection : Enjoy a wireless connection up to 10m away thanks to a plug-and-forget USB mini-receiver\r\nOptical Tracking : The advanced optical tracking features enable ultra precise moves on almost any surface. Required: available USB port, Windows 7, 8, 10 or later, macOS 10.5 or later, Chrome OS, Linux Kernel 2.6+\r\n12-Month Battery Life : Don’t worry about constant battery changes as this wired Logitech mouse has a 12-month battery life.\r\nQuality Assured : Logitech are experts you can trust, and for more than 30 years we have created high-quality corded, cordless and Bluetooth products that help you get the most out of your Windows computer, laptop, Mac or Macbook\r\nReliable Wireless Connection : Enjoy a wireless connection up to 10m away thanks to a plug-and-forget USB mini-receiver\r\nNote : In case of Wireless mouse, the USB receiver will be provided inside or along with the mouse\r\nOptical Tracking : The advanced optical tracking features enable ultra precise moves on almost any surface.', '2023-04-24 13:20:25'),
(21, 'Portronics Toad 23 Wireless Optical Mouse with 2.4GHz, Click Wheel, Adjustable DPI(Black)', 349, 39, 3, 10, 'mouse-2.png', '[WIRELESS FREEDOM] - Enjoy up to a 10-meter wireless connection with the Toad 23 wireless mouse’s tiny plug-and-forget wireless receiver. No software or driver installation needed. The mouse automatically connects to your computer system. It is ready to go when you are.\r\n[CARRY IT ANYWHERE, EVERYWHERE] - Portronics Toad 23 Wireless Optical Mouse is the perfect accessory for those who travel for work, executives who give presentations, or anyone who wants greater control and freedom. With its compact design, it easily fits in pockets.\r\n[ERGONOMIC DESIGN] - Designed to keep either hand comfortable. With the click wheel, Toad 23 becomes easier to use with a third click button at your disposal.\r\n[HIGH-SPEED OPTICAL MOUSE] - The 2.4 GHz operating speed of this wireless mouse sends quick signals to the device. With the button to adjust DPI resolution, now adjust your mouse sensitivity as per your requirement.\r\n[30 LAKHS+ CLICKS] - Once you buy Toad 23 Wireless Optical Mouse, you don’t need to worry about its durability. With a life of over 30 lakhs clicks, this wireless mouse is highly durable and delivers optimal work quality to the users.', '2023-04-08 19:12:08');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `user_id`, `review_text`, `order_date`) VALUES
(1, 2, 'The Shopping experience was awesome. The site is user-friendly,secure and has quality products too. The products are comparitively cheaper and I would love to order again.', '2023-04-09'),
(2, 3, 'The cart section is interactive and easy to handle. The site has easy navigation to all pages and I am glad that my data is also held secure.', '2023-04-09'),
(3, 4, 'I enjoyed a lot shopping in this website. I would recommend having forget password option in this website, so that users don\'t have to worry if they forget their password in case. Otherwise, the site looks good and the products are affordable.', '2023-04-10'),
(4, 2, 'As already stated, the products are affordable and I would certainly recommend this ecommerce site to my dearest ones.', '2023-04-11'),
(5, 4, 'The Orders page is convenient as it pre-fills the previous billing details and I came to know this feature as this is my 2nd order in this site. As usual, the shopping experience was awesome and the description page cleared my dilemma regarding the product selection.', '2023-04-14'),
(6, 7, 'User Friendly', '2023-04-21'),
(7, 8, 'Loved the products out here. The User Interface is also awesome.', '2023-04-23'),
(8, 9, 'This is my first purchase in your site. Loved the user experience and the site looks very professional.', '2023-04-26'),
(9, 9, 'Wonderful products 👌. The UI was great and appealing to the eyes.', '2023-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `country` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pin_code` int(11) DEFAULT NULL,
  `payment_mode` varchar(100) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `country`, `city`, `address`, `pin_code`, `payment_mode`, `phone_number`) VALUES
(1, 'Sangeetha G', 'lapzymanager@gmail.com', 'e6e061838856bf47e1de730719fb2609', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Sharmila', 'sharmila@gmail.com', 'f702c1502be8e55f4208d69419f50d0a', 'India', 'Chennai', 'No.35, Nehru Street, Koyambedu', 600107, 'Cash on Delivery', '8056102733'),
(3, 'Rahul', 'rahul@gmail.com', '773c8dd9f8b8bee7fc9859ac78e36578', 'India', 'Chennai', 'No.45, Avvai Street, T.Nagar', 600006, 'UPI mode', '9710454433'),
(4, 'Dharshini', 'dharshini@gmail.com', 'a7d4a2d5669de2283f1de603c8c34036', 'India', 'Chennai', 'No.38 ,Perumal koil Street.', 600062, 'Cash on Delivery', '8056104733'),
(5, 'Shreenidhi', 'shreeni@gmail.com', 'ffa4d9a1fc7008dcb407601aeea040b1', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Sakthi', 'sakthi@gmail.com', 'cee1f86a3b75f70e97b71ad01e821a80', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Akila', 'akila@gmail.com', 'f23279073a8f9c69def114dc69f7500e', 'India', 'Chennai', '2/80 Buddhar Colony', 600105, 'Cash on Delivery', '7708807118'),
(8, 'Krupa Janani', 'krupa@gmail.com', '90780b52f66550b846c146544fcad11e', 'India', 'Chennai', 'No.50, Annai Street', 600106, 'Cash on Delivery', '9894562345'),
(9, 'Satya', 'satya@gmail.com', '40be4e59b9a2a2b5dffb918c0e86b3d7', 'India', 'Chennai', 'No.50, Gandhi Street', 600040, 'Cash on Delivery', '9840106098');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
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
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
