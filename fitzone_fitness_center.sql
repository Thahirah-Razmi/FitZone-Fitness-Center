-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 01, 2024 at 05:39 PM
-- Server version: 8.0.36
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitzone_fitness_center`
--
CREATE DATABASE IF NOT EXISTS `fitzone_fitness_center` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `fitzone_fitness_center`;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `appointment_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `username` text NOT NULL,
  `class_id` int NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` enum('Pending','Confirmed','Cancelled') NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`appointment_id`),
  KEY `user_id` (`user_id`),
  KEY `class_id` (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `user_id`, `username`, `class_id`, `appointment_date`, `appointment_time`, `status`) VALUES
(1, 17, 'Thaiba_Razmi', 27, '2024-10-25', '06:30:00', 'Pending'),
(2, 18, 'Samiha_Razmi', 45, '2024-10-26', '07:00:00', 'Confirmed'),
(3, 19, 'Saad.Razmi', 16, '2024-10-27', '08:00:00', 'Cancelled'),
(4, 19, 'Saad.Razmi', 5, '2024-10-31', '08:00:00', 'Confirmed'),
(5, 17, 'Thaiba_Razmi', 30, '2024-11-06', '10:45:00', 'Confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `class_id` int NOT NULL AUTO_INCREMENT,
  `class_name` varchar(100) NOT NULL,
  `class_type` text NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `description` text NOT NULL,
  `trainer_id` int NOT NULL,
  `trainer_name` varchar(100) NOT NULL,
  UNIQUE KEY `class_id` (`class_id`),
  KEY `fk_trainers` (`trainer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`, `class_type`, `start_time`, `end_time`, `description`, `trainer_id`, `trainer_name`) VALUES
(1, 'Cycle', 'Cardio', '07:00:00', '07:45:00', 'High-energy indoor cycling session focusing on cardio endurance, strength, and calorie burn.', 3, 'Emily Carter'),
(2, 'Blackbox', 'Cardio', '08:00:00', '08:45:00', 'Intense functional cardio workout using a combination of boxing, strength, and endurance exercises.', 7, 'William Wilson'),
(3, 'Endurance Cycle', 'Cardio', '09:00:00', '09:45:00', 'Challenging cycling workout aimed at building stamina, endurance, and cardiovascular strength.', 3, 'Emily Carter'),
(4, 'Metcon', 'Cardio', '10:00:00', '10:45:00', 'High-intensity metabolic conditioning workout designed to improve endurance, strength, and fat burning.', 7, 'William Wilson'),
(5, '40 Hard', 'Cardio', '11:00:00', '11:45:00', 'Intense 40-minute cardio session focused on maximum effort, endurance, and calorie burn.', 3, 'Emily Carter'),
(6, 'Cycle', 'Cardio', '12:00:00', '12:45:00', 'Dynamic indoor cycling class targeting cardio fitness, leg strength, and endurance.', 7, 'William Wilson'),
(7, 'Blackbox', 'Cardio', '01:00:00', '01:45:00', 'High-intensity boxing-inspired workout combining cardio, strength, and endurance exercises.', 3, 'Emily Carter'),
(8, 'Cycle', 'Cardio', '02:00:00', '02:45:00', 'Indoor cycling class focused on cardio, stamina, and lower body strength.', 3, 'Emily Carter'),
(9, 'Boxfit', 'Cardio', '03:00:00', '03:45:00', 'Cardio workout blending boxing techniques with high-energy strength and endurance training.', 7, 'William Wilson'),
(10, 'Cycle', 'Cardio', '04:00:00', '04:45:00', 'Energy-packed indoor cycling class focusing on cardio, endurance, and leg strength.', 3, 'Emily Carter'),
(11, 'Metcon', 'Cardio', '05:00:00', '05:45:00', 'High-intensity metabolic conditioning workout that boosts endurance, strength, and fat loss.', 7, 'William Wilson'),
(12, 'Cycle', 'Cardio', '06:00:00', '06:45:00', 'Intense indoor cycling class enhancing cardiovascular fitness, stamina, and leg strength.', 3, 'Emily Carter'),
(13, 'Blackbox', 'Cardio', '07:00:00', '07:45:00', 'High-energy workout combining cardio, strength training, and boxing techniques for total conditioning.', 7, 'William Wilson'),
(14, 'Boxfit', 'Cardio', '08:00:00', '08:45:00', 'Dynamic cardio workout combining boxing drills and fitness training for endurance and strength.', 3, 'Emily Carter'),
(15, 'Strength & Conditioning', 'Strength Training', '07:00:00', '08:00:00', 'Comprehensive training program focusing on building strength, power, and athletic performance.', 2, 'James Clark'),
(16, 'Grit', 'Strength Training', '08:00:00', '09:00:00', 'Challenging strength workout designed to build resilience, muscle, and overall fitness.', 8, 'Emma Taylor'),
(17, 'Grit', 'Strength Training', '09:00:00', '10:00:00', 'Intense strength training focused on building endurance, power, and mental toughness.', 2, 'James Clark'),
(18, 'CrossFit', 'Strength Training', '10:00:00', '11:00:00', 'High-intensity strength training incorporating varied functional movements for overall fitness.', 8, 'Emma Taylor'),
(19, 'Strength & Conditioning', 'Strength Training', '11:00:00', '12:00:00', 'Focused training program to enhance strength, power, agility, and overall athletic performance.', 2, 'James Clark'),
(20, 'Strength & Conditioning', 'Strength Training', '12:00:00', '01:00:00', 'Training program aimed at improving strength, endurance, and overall athletic performance.', 8, 'Emma Taylor'),
(21, 'Grit', 'Strength Training', '01:00:00', '02:00:00', 'Intense strength training emphasizing resilience, muscle building, and functional fitness.', 2, 'James Clark'),
(22, 'CrossFit', 'Strength Training', '02:00:00', '03:00:00', 'High-intensity strength training with diverse functional movements for improved fitness.', 8, 'Emma Taylor'),
(23, 'CrossFit', 'Strength Training', '03:00:00', '04:00:00', 'Dynamic strength training combining weightlifting, cardio, and functional movements for overall fitness.', 2, 'James Clark'),
(24, 'Crossfit', 'Strength Training', '04:00:00', '05:00:00', 'High-intensity training program that blends strength, endurance, and functional movements for overall fitness.', 8, 'Emma Taylor'),
(25, 'Strength & Conditioning', 'Strength Training', '05:00:00', '06:00:00', 'Program focused on improving strength, speed, agility, and overall athletic performance.', 2, 'James Clark'),
(26, 'Strength & Conditioning', 'Strength Training', '06:00:00', '07:00:00', 'Comprehensive training designed to enhance strength, power, endurance, and athletic performance.', 8, 'Emma Taylor'),
(27, 'Vinyasa Flow', 'Yoga', '06:30:00', '07:30:00', 'Dynamic yoga practice linking breath with movement through a flowing sequence of poses.', 1, 'Sarah Lee'),
(28, 'Community Yoga', 'Yoga', '07:30:00', '08:30:00', 'Inclusive yoga class promoting connection, wellness, and mindfulness for all skill levels.', 6, 'Sophia Brown'),
(29, 'Vinyasa Flow', 'Yoga', '09:00:00', '10:00:00', 'Flowing yoga practice connecting breath and movement through dynamic sequences of poses.', 1, 'Sarah Lee'),
(30, 'Vin & Yin', 'Yoga', '10:45:00', '11:45:00', 'Balanced practice combining dynamic Vinyasa flows with restorative Yin poses for harmony.', 6, 'Sophia Brown'),
(31, 'Meditation & Mindfulness', 'Yoga', '12:15:00', '01:15:00', 'Integrative practice focusing on mindfulness and meditation techniques to enhance relaxation and awareness.', 1, 'Sarah Lee'),
(32, 'Morning Flow', 'Yoga', '02:00:00', '03:00:00', 'Invigorating yoga session designed to energize the body and mind, promoting a positive start to the day.', 6, 'Sophia Brown'),
(33, 'Climbers Conditioning', 'Yoga', '03:15:00', '04:15:00', 'Specialized yoga practice enhancing flexibility, strength, and balance for climbers and outdoor athletes.', 1, 'Sarah Lee'),
(34, 'Vinyasa Flow', 'Yoga', '04:00:00', '05:00:00', 'Dynamic yoga style linking breath with movement through flowing sequences of postures.', 6, 'Sophia Brown'),
(35, 'Vin & Yin', 'Yoga', '05:00:00', '06:00:00', 'Balanced practice blending energetic Vinyasa flows with restorative Yin poses for relaxation and flexibility.', 1, 'Sarah Lee'),
(36, 'Intro Class', 'Pilates', '06:00:00', '06:45:00', 'Introduce Your Body to Pilates for Free!', 10, 'Isabella Green'),
(37, 'Reformer Flow', 'Pilates', '07:00:00', '07:45:00', 'Reformer-based Pilates with a Contemporary Approach', 11, 'Sophia Johnson'),
(38, 'Cardio Sculpt', 'Pilates', '08:00:00', '08:45:00', 'Get Moving with an Energetic Cardio Workout', 10, 'Isabella Green'),
(39, 'Center + Balance', 'Pilates', '09:00:00', '09:45:00', 'Stretch Better with Pilates Equipment', 11, 'Sophia Johnson'),
(40, 'Control', 'Pilates', '10:00:00', '10:45:00', 'Stand Up & Get Toned', 10, 'Isabella Green'),
(41, 'Restore', 'Pilates', '11:00:00', '11:45:00', 'Massage and Soothe Sore Muscles', 11, 'Sophia Johnson'),
(42, 'Suspend', 'Pilates', '12:00:00', '12:45:00', 'Defy gravity & Strengthen with Suspension Training', 10, 'Isabella Green'),
(43, 'F.I.T.', 'Pilates', '01:00:00', '01:45:00', 'Build Muscle and Stamina with Interval Training', 11, 'Sophia Johnson'),
(44, 'Teen', 'Pilates', '02:00:00', '02:45:00', 'Cross-Training for Young Athletes', 10, 'Isabella Green'),
(45, 'Zumba', 'Zumba', '07:00:00', '08:00:00', 'A total workout, combining all elements of fitness – cardio, muscle conditioning, balance and flexibility, boosted energy and a serious dose of awesome each time you leave class.', 12, 'Liam Martinez'),
(46, 'Zumba Gold', 'Zumba', '08:00:00', '09:00:00', 'Class focuses on all elements of fitness: cardiovascular, muscular conditioning, flexibility and balance!', 13, 'Olivia Brown'),
(47, 'Zumba Kids', 'Zumba', '09:00:00', '10:00:00', 'Helps develop a healthy lifestyle and incorporate fitness as a natural part of childrens lives by making fitness fun.', 12, 'Liam Martinez'),
(48, 'Zumba In The Circuit', 'Zumba', '10:00:00', '11:00:00', 'Zumba fans who want to add circuit training.', 13, 'Olivia Brown'),
(49, 'Aqua Zumba', 'Zumba', '01:00:00', '12:00:00', 'Those looking to make a splash by adding a low-impact, high-energy aquatic exercise to their fitness routine.', 12, 'Liam Martinez'),
(50, 'Zumba Sentao', 'Zumba', '12:00:00', '01:00:00', 'People who want to get some serious (core) work done. Pull up a chair and tone your entire body.', 13, 'Olivia Brown'),
(51, 'HIIT Grit Athletic', 'HIIT', '07:00:00', '07:30:00', 'Sports conditioning workout, designed to make you perform like an athlete.', 14, 'Ava Thompson'),
(52, 'HIIT Grit Cardio', 'HIIT', '08:00:00', '08:30:00', 'Workout that improves cardiovascular fitness, increases speed and maximizes calorie burn.', 15, 'William Scott'),
(53, 'HIIT Grit Strength', 'HIIT', '09:00:00', '09:30:00', 'Designed to improve strength, cardiovascular fitness and build lean muscle.', 14, 'Ava Thompson'),
(54, 'HIIT Sprint', 'HIIT', '10:00:00', '10:30:00', 'Workout drives your body to burn calories for hours by using an indoor bike to achieve fast results.', 15, 'William Scott'),
(55, 'HIIT Grit Athletic', 'HIIT', '11:00:00', '11:30:00', 'Takes cutting-edge HIIT and combines it with powerful music and inspirational coaches who will be down on the floor with you, motivating you to go harder to get fit, fast.', 14, 'Ava Thompson'),
(56, 'HIIT Grit Cardio', 'HIIT', '12:00:00', '12:30:00', 'Workout uses a variety of body weight exercises and provides the challenge and intensity you need to get results fast.', 15, 'William Scott'),
(57, 'HIIT Grit Strength', 'HIIT', '12:30:00', '01:00:00', 'Designed to improve strength', 14, 'Ava Thompson');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `message` text NOT NULL,
  `response` text,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone_number`, `message`, `response`, `status`, `created_at`) VALUES
(1, 'Anna', 'anna@gmail.com', '0734952064', 'Are you planning any special events or workshops in the upcoming months? I’d love to participate!', NULL, 'Pending', '2024-10-20 17:25:29'),
(2, 'Thaiba Razmi', 'thaibarazmi@gmail.com', '0796430852', 'Can I get a trial membership to see if the gym is right for me?', 'Certainly! We’d be happy to offer you a trial membership so you can experience our facilities, classes, and equipment firsthand. Our team believes it’s important for potential members to get a feel for the FitZone Fitness Center before committing. Please let us know how long you\'d like to try it out, and we’ll arrange the details for you. Just reach out to our front desk or sign up on our website to start your trial!', 'Responded', '2024-10-23 13:46:06'),
(3, 'Thaiba Razmi', 'thaibarazmi@gmail.com', '0796430852', 'Do you offer any corporate membership options or discounts for company groups? I’d love to bring my colleagues along.', 'Yes, we offer corporate membership options and discounts for groups. ', 'Responded', '2024-10-26 18:48:10'),
(4, 'Saad Razmi', 'saadrazmi@gmail.com', '0763189304', 'Does the gym offer any additional amenities like a sauna, pool, or smoothie bar?', '', 'Pending', '2024-10-31 18:30:10');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

DROP TABLE IF EXISTS `membership`;
CREATE TABLE IF NOT EXISTS `membership` (
  `membership_id` int NOT NULL AUTO_INCREMENT,
  `membership_name` text NOT NULL,
  `membership_type` text NOT NULL,
  `description` text,
  `price` int DEFAULT NULL,
  `duration` text,
  `benefits` text,
  PRIMARY KEY (`membership_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`membership_id`, `membership_name`, `membership_type`, `description`, `price`, `duration`, `benefits`) VALUES
(1, 'Basic Membership', 'Basic Membership - 1 Month', 'Access to the gym during off-peak hours. Access to basic gym equipment. Ideal for those starting their fitness journey on a budget.', 15000, '1 month', 'First-time members get the first week free.'),
(2, 'Basic Membership', 'Basic Membership - 6 Months', 'Same as the 1-month membership, but with a discounted rate for a longer-term commitment.', 80000, '6 months', 'Discounted rate for longer commitment, Access to gym during off-peak hours for six months, Opportunity to build a regular workout routine'),
(3, 'Basic Membership', 'Basic Membership - 1 Year', ' Access to gym facilities during off-peak hours for the full year with basic equipment.', 170000, '1 year', 'Best value for long-term users, Extended access to gym facilities during off-peak hours, Encourages long-term fitness habits'),
(4, 'Standard Membership', 'Standard Membership - 1 Month', 'Full access to all gym facilities, including peak hours and group fitness classes.', 30000, '1 month', 'Access to gym during all operational hours, Participation in group fitness classes (e.g., yoga), Ideal for short-term flexibility with extra perks'),
(5, 'Standard Membership', 'Standard Membership - 6 Months', 'Six months of full access to gym facilities, group fitness classes, and basic amenities.', 170000, '6 months', 'Full gym access, including peak hours, for six months, Discount compared to monthly renewal, Access to group fitness classes, More affordable than premium membership with essential perks'),
(6, 'Standard Membership', 'Standard Membership - 1 Year', 'Full access to gym facilities, group fitness classes, and priority booking for popular classes.', 350000, '1 year', 'Priority access to group fitness classes, Full access to gym facilities, including peak hours, More affordable yearly package with greater flexibility and perks'),
(7, 'Premium Membership', 'Premium Membership - 1 Month', 'All-inclusive access to gym facilities, group fitness classes, nutrition counseling, priority booking for personal training sessions, and access to wellness amenities like sauna and spa.\r\n', 50000, '1 month', 'Access to all gym facilities and group classes, Priority booking for personal training, Access to wellness facilities (sauna, spa), Premium perks like discounts on merchandise or services'),
(8, 'Premium Membership', 'Premium Membership - 6 Months', ' Six months of comprehensive access, including priority in personal training, nutrition counseling and wellness amenities.', 290000, '6 months', 'Full access to gym, including peak hours, Priority booking for personal training, Access to wellness and spa amenities, Exclusive member discounts (e.g., on gym products, food items)'),
(9, 'Premium Membership', 'Premium Membership - 1 Year', 'All-inclusive access to gym facilities, group fitness classes, nutrition counseling, priority booking for personal training sessions, and access to wellness amenities like sauna and spa. Members also enjoy exclusive access to premium events and workshops throughout the year.', 580000, '1 year', 'Access to all gym facilities and group classes, Priority booking for personal training, Access to wellness facilities (sauna, spa), Premium perks like discounts on merchandise or services, Exclusive invitations to special events, workshops, and fitness challenges throughout the year.');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

DROP TABLE IF EXISTS `trainers`;
CREATE TABLE IF NOT EXISTS `trainers` (
  `trainer_id` int NOT NULL AUTO_INCREMENT,
  `trainer_name` varchar(100) NOT NULL,
  `specialty` varchar(100) DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `phone_number` text NOT NULL,
  PRIMARY KEY (`trainer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`trainer_id`, `trainer_name`, `specialty`, `email`, `phone_number`) VALUES
(1, 'Sarah Lee', 'Certified Yoga Instructor', 'sarah.lee@fitness.com', '0779557057'),
(2, 'James Clark', 'Strength Training Specialist', 'james.clark@fitness.com', '0760139882'),
(3, 'Emily Carter', 'Cardio Training Expert', 'emily.carter@fitness.com', '0772726194'),
(4, 'Olivia Davis', 'Nutrition Counselor', 'olivia.davis@fitness.com', '0760198330'),
(5, 'Andre Johnson', 'Personal Trainer', 'andre.johnson@fitness.com', '0713490384'),
(6, 'Sophia Brown', 'Yoga Instructor', 'sophia.brown@fitness.com', '0793165801'),
(7, 'William Wilson', 'Cardio Training Specialist', 'william.wilson@fitness.com', '0795483015'),
(8, 'Emma Taylor', 'Strength Training Coach', 'emma.taylor@fitness.com', '0726482673'),
(9, 'Lucy Davis', 'Nutrition Expert', 'lucy.davis@fitness.com', '0763049726'),
(10, 'Isabella Green', 'Pilates Specialist', 'isabella.green@fitness.com', '0712345678'),
(11, 'Sophia Johnson', 'Pilates Expert', 'sophia.johnson@fitness.com', '0712345681'),
(12, 'Liam Martinez', 'Zumba Specialist', 'liam.martines@fitness.com', '0712345679'),
(13, 'Olivia Brown', 'Zumba Instructor', 'olivia.brown@fitness.com', '0712345682'),
(14, 'Ava Thompson', 'HIIT Specialist', 'ava.thompson@fitness.com', '0712345680'),
(15, 'William Scott', 'HIIT Trainer', 'william.scott@fitness.com', '0712345683');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `role` enum('admin','staff','trainer','nutrition counselor','customer') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `membership_type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `full_name`, `email`, `phone_number`, `role`, `created_at`, `membership_type`) VALUES
(1, 'Admin', 'admin*123', 'Thahirah Razmi', 'thairahrazmi@gmail.com', '0760139886', 'admin', '2024-10-20 09:30:01', NULL),
(2, 'Sarah_Lee', 'lee*369', 'Sarah Lee', 'sarah.lee@fitness.com', '0779557057', 'trainer', '2024-10-20 09:30:02', NULL),
(3, 'James_Clark', 'james*173', 'James Clark', 'james.clark@fitness.com', '0760139882', 'trainer', '2024-10-20 09:30:03', NULL),
(4, 'Emily_Carter', 'carter@368', 'Emily Carter', 'emily.carter@fitness.com', '0772726194', 'trainer', '2024-10-20 09:30:04', NULL),
(5, 'Olivia_Davis', 'olivia#073', 'Olivia Davis', 'olivia.davis@fitness.com', '0760198330', 'nutrition counselor', '2024-10-20 09:30:05', NULL),
(6, 'Andre_Johnson', 'johnson*349', 'Andre Johnson', 'andre.johnson@fitness.com', '0713490384', 'trainer', '2024-10-20 09:30:06', NULL),
(7, 'Sophia Brown', 'sophia@340', 'Sophia Brown', 'sophia.brown@fitness.com', '0793165801', 'trainer', '2024-10-20 09:30:07', NULL),
(8, 'William_Wilson', 'wilson*358', 'William Wilson', 'william.wilson@fitness.com', '0795483015', 'trainer', '2024-10-20 09:30:08', NULL),
(9, 'Emma_Taylor', 'emma#108', 'Emma Taylor', 'emma.taylor@fitness.com', '0726482673', 'trainer', '2024-10-20 09:30:09', NULL),
(10, 'Lucy_Davis', 'lucy*148', 'Lucy Davis', 'lucy.davis@fitness.com', '0763049726', 'nutrition counselor', '2024-10-20 09:30:10', NULL),
(11, 'Isabella_Green', 'green*348', 'Isabella Green', 'isabella.green@fitness.com', '0712345678', 'trainer', '2024-10-20 09:30:11', NULL),
(12, 'Sophia_Johnson', 'sophia@304', 'Sophia Johnson', 'sophia.johnson@fitness.com', '0712345681', 'trainer', '2024-10-20 09:30:12', NULL),
(13, 'Liam_Martinez', 'Martinez$305', 'Liam Martinez', 'liam.martines@fitness.com', '0712345679', 'trainer', '2024-10-20 09:30:13', NULL),
(14, 'Olivia_Brown', 'Olivia%92', 'Olivia Brown', 'olivia.brown@fitness.com', '0712345682', 'trainer', '2024-10-20 09:30:14', NULL),
(15, 'Ava_Thompson', 'ava_378', 'Ava Thompson', 'ava.thompson@fitness.com', '0712345680', 'trainer', '2024-10-20 09:30:15', NULL),
(16, 'William_Scott', 'scott!549', 'William Scott', 'william.scott@fitness.com', '0712345683', 'trainer', '2024-10-20 09:30:16', NULL),
(17, 'Thaiba_Razmi', 'thaiba*123', 'Thaiba Razmi', 'thaibarazmi@gmail.com', '0796430852', 'customer', '2024-10-23 12:03:52', 'Standard Membership - 1 Month'),
(18, 'Samiha_Razmi', 'sami*349', 'Samiha Razmi', 'samiharazmi@gmail.com', '0773208965', 'customer', '2024-10-23 12:03:52', 'Basic Membership - 6 Months'),
(19, 'Saad.Razmi', 'saad@876', 'Saad Razmi', 'saadrazmi@gmail.com', '0763189304', 'customer', '2024-10-23 12:05:44', 'Premium Membership - 1 Month'),
(20, 'staff1', 'staff*123', 'Staff', 'staff@gmail.com', '0760148523', 'staff', '2024-10-23 14:37:18', NULL),
(21, 'staff2', 'STAFF*549', 'Staff 2', 'staff@yahoo.com', '0732094308', 'staff', '2024-10-23 14:38:24', NULL),
(22, 'emma410', 'jack*123', 'Emma Jackson', 'emmajack@gmail.com', '0112121212', 'customer', '2024-10-26 20:03:24', 'Premium Membership - 1 Year'),
(23, 'addison943', 'rae*369', 'Addison Rae', 'rae@gmail.com', '0764830761', 'customer', '2024-10-26 20:17:07', 'Standard Membership - 6 Months'),
(24, 'Staff3', 'staff*123', 'Staff 3', 'staff3@gmail.com', '0134608762', 'staff', '2024-10-26 22:17:23', NULL),
(25, 'gracie599', 'loveu123', 'Gracie Adams', 'gracieadams@gmail.com', '0764598213', 'customer', '2024-10-27 14:44:20', 'Premium Membership - 1 Year'),
(26, 'naveed303', '8908002', 'Naveed Nazeel ', 'naveednazeel1@gmail.com', '0726305656', 'customer', '2024-11-01 06:54:23', 'Basic Membership - 1 Month'),
(27, 'sarah991', '1234', 'sarah', 'sarahmohideen10@gmail.com', '0774142141', 'customer', '2024-11-01 06:58:35', 'Basic Membership - 1 Month'),
(28, 'yeash712', '12345', 'yeash gurusinghe', 'yeashwrld@gmail.com', '0742967472', 'customer', '2024-11-01 07:00:24', 'Basic Membership - 1 Month'),
(29, 'sajidah134', '12345', 'sajidah shereen', 'sajidahshereen5@gmail.com', '0774752069', 'customer', '2024-11-01 07:02:15', 'Basic Membership - 1 Month');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `fk_trainers` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`trainer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
