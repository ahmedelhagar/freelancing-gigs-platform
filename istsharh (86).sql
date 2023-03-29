-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2020 at 04:26 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `istsharh`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creds` text DEFAULT NULL,
  `state` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `creds`, `state`) VALUES
(1, 'Mohamed Soliman', 'admin@istsharh.com', '2d321a920a4abcfd7b33ab3370d9877ca9b3117630f499698fef521d8684ce7ec8170733b2e2e6386255df944901c5acce052e111a65c8b887a6d27042bf0587Q2WHBcpVoXpaYKdUg3wBP7ZvJO+UMNEELYVyJf9aFS0=', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `id` int(10) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `statue` int(10) NOT NULL,
  `u_id` int(10) DEFAULT NULL,
  `i_id` int(10) DEFAULT NULL,
  `bill_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`id`, `title`, `description`, `statue`, `u_id`, `i_id`, `bill_id`) VALUES
(1, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/لبييبلبيليليلي/7/\">لبييبلبيليليلي</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(2, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/لبييبلبيليليلي/7/\">لبييبلبيليليلي</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(3, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/لبييبلبيليليلي/7/\">لبييبلبيليليلي</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(4, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/لبييبلبيليليلي/7/\">لبييبلبيليليلي</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(5, 'استفسار عن خدمة', 'لقد وصلك طلب استفسار عن <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/لبييبلبيليليلي/7/\">لبييبلبيليليلي</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 5, NULL, NULL),
(6, 'رسالة', 'وصلتك رسالة يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(7, 'تهانينا', 'تم استلام المشروع <a href=\"https://prideskill.com/istsharh/istsharh/i/لبييبلبيليليلي/7/\">لبييبلبيليليلي</a> بنجاح', 1, 5, NULL, NULL),
(8, 'شكراً', 'تم استلام المشروع <a href=\"https://prideskill.com/istsharh/istsharh/i/لبييبلبيليليلي/7/\">لبييبلبيليليلي</a> بنجاح برجاء <a href=\"https://prideskill.com/istsharh/istsharh/users/rate/5/7/20/1/\">تقييم</a> المستشار', 1, 4, NULL, NULL),
(9, 'تم تقييمك', 'تم تقييمك بنجاح في  <a href=\"https://prideskill.com/istsharh/istsharh/i/لبييبلبيليليلي/7/\">لبييبلبيليليلي</a>', 1, 5, NULL, NULL),
(10, 'تمت اضافة تعليق', 'تمت اضافة تعليق على <a href=\"https://prideskill.com/istsharh/istsharh/pages/comm/1\">أريد خدمة</a>', 1, 4, NULL, NULL),
(11, 'تم نشر عنصر : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تطوير-موقع-بإطار-codeigniter/4/\">تطوير موقع بإطار codeigniter</a>', 'تم نشر عنصر ويمكنك معاينته', 1, 4, NULL, NULL),
(12, 'تم نشر عنصر : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تطوير-موقع-بإطار-codeigniter/4/\">تطوير موقع بإطار codeigniter</a>', 'تم نشر عنصر ويمكنك معاينته', 1, 4, NULL, NULL),
(13, 'استفسار عن عمل مشابه', 'لقد وصلك طلب استفسار عن <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/users/p/موقع-استشارة-للخدمات/2/\">موقع استشارة للخدمات</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(14, 'استفسار عن عمل مشابه', 'لقد وصلك طلب استفسار عن <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/users/p/موقع-استشارة-للخدمات/2/\">موقع استشارة للخدمات</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(15, 'مشروع خاص', 'تم دعوتك على مشروع خاص : <a href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-مشروع-خاص/9/\"></a>', 1, 4, NULL, NULL),
(16, 'تهانينا', 'تم استلام المشروع <a href=\"https://prideskill.com/istsharh/istsharh/i/لبييبلبيليليلي/7/\">لبييبلبيليليلي</a> بنجاح', 1, 5, NULL, NULL),
(17, 'شكراً', 'تم استلام المشروع <a href=\"https://prideskill.com/istsharh/istsharh/i/لبييبلبيليليلي/7/\">لبييبلبيليليلي</a> بنجاح برجاء <a href=\"https://prideskill.com/istsharh/istsharh/users/rate/5/7/21/1/\">تقييم</a> المستشار', 1, 4, NULL, NULL),
(18, 'تم تقييمك', 'تم تقييمك بنجاح في  <a href=\"https://prideskill.com/istsharh/istsharh/i/لبييبلبيليليلي/7/\">لبييبلبيليليلي</a>', 1, 5, NULL, NULL),
(19, 'تمت اضافة تعليق', 'تمت اضافة تعليق على <a href=\"https://prideskill.com/istsharh/istsharh/pages/ser/10\">مشكلة في كذا</a>', 1, 5, NULL, NULL),
(20, 'رسالة', 'وصلتك رسالة يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(21, 'رسالة', 'وصلتك رسالة يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(22, 'رسالة', 'وصلتك رسالة يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(23, 'رسالة', 'وصلتك رسالة يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(24, 'رسالة', 'وصلتك رسالة يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(25, 'رسالة', 'وصلتك رسالة يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(26, 'استفسار عن عمل مشابه', 'لقد وصلك طلب استفسار عن <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/users/p/لبييبلبيليليلي/7/\">لبييبلبيليليلي</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(27, 'استفسار عن عمل مشابه', 'لقد وصلك طلب استفسار عن <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/users/p/لبييبلبيليليلي/7/\">لبييبلبيليليلي</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(28, 'تم نشر عنصر : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-خدمة/14/\">تجربة خدمة</a>', 'تم نشر عنصر ويمكنك معاينته', 1, 5, NULL, NULL),
(29, 'تم نشر عنصر : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-خدمة/14/\">تجربة خدمة</a>', 'تم نشر عنصر ويمكنك معاينته', 1, 5, NULL, NULL),
(30, 'تم اغلاق موضوعك : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-خدمة/14/\">تجربة خدمة</a>', 'تم اغلاق موضوعك ', 1, 5, NULL, NULL),
(31, 'تم نشر عنصر : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-خدمة/14/\">تجربة خدمة</a>', 'تم نشر عنصر ويمكنك معاينته', 1, 5, NULL, NULL),
(32, 'تم اغلاق موضوعك : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-خدمة/14/\">تجربة خدمة</a>', 'تم اغلاق موضوعك ', 1, 5, NULL, NULL),
(33, 'تم اغلاق موضوعك : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-خدمة/14/\">تجربة خدمة</a>', 'تم اغلاق موضوعك السبب عدم الالتزام', 1, 5, NULL, NULL),
(34, 'تم نشر عنصر : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-خدمة/14/\">تجربة خدمة</a>', 'تم نشر عنصر ويمكنك معاينته', 1, 5, NULL, NULL),
(35, 'تم اغلاق موضوعك : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-خدمة/14/\">تجربة خدمة</a>', 'تم اغلاق موضوعك تجربة الشروط', 1, 5, NULL, NULL),
(36, 'تم نشر عنصر : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a>', 'تم نشر عنصر ويمكنك معاينته', 1, 5, NULL, NULL),
(37, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(38, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(39, 'تهانينا', 'تم استلام المشروع <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> بنجاح', 1, 5, NULL, NULL),
(40, 'شكراً', 'تم استلام المشروع <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> بنجاح برجاء <a href=\"https://prideskill.com/istsharh/istsharh/users/rate/5/15/22/1/\">تقييم</a> المستشار', 1, 4, NULL, NULL),
(41, 'تم تقييمك', 'تم تقييمك بنجاح في  <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a>', 1, 5, NULL, NULL),
(42, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(43, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(44, 'تهانينا', 'تم استلام المشروع <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> بنجاح', 1, 5, NULL, NULL),
(45, 'شكراً', 'تم استلام المشروع <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> بنجاح برجاء <a href=\"https://prideskill.com/istsharh/istsharh/users/rate/5/15/23/1/\">تقييم</a> المستشار', 1, 4, NULL, NULL),
(46, 'تم تقييمك', 'تم تقييمك بنجاح في  <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a>', 1, 5, NULL, NULL),
(47, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(48, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(49, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(50, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(51, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(52, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(53, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(54, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(55, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(56, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(57, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(58, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(59, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(60, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(61, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(62, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(63, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(64, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(65, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(66, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(67, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(68, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(69, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(70, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(71, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(72, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(73, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(74, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(75, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(76, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(77, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(78, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(79, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(80, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(81, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(82, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(83, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(84, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(85, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(86, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(87, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(88, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(89, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(90, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(91, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(92, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(93, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(94, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(95, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(96, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(97, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(98, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(99, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(100, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(101, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(102, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(103, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(104, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(105, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(106, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(107, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(108, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(109, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(110, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(111, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(112, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(113, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(114, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(115, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(116, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(117, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(118, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(119, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(120, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(121, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(122, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(123, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(124, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(125, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(126, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(127, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(128, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(129, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(130, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(131, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(132, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(133, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(134, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(135, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(136, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(137, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(138, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(139, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(140, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(141, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(142, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(143, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(144, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(145, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(146, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(147, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(148, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(149, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(150, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(151, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(152, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(153, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(154, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(155, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(156, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(157, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(158, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(159, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(160, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(161, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(162, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(163, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(164, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(165, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(166, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(167, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(168, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(169, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(170, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(171, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(172, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(173, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(174, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(175, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(176, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(177, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(178, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(179, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(180, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(181, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(182, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(183, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(184, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(185, 'تهانينا', 'تم استلام المشروع <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> بنجاح', 1, 5, NULL, NULL),
(186, 'شكراً', 'تم استلام المشروع <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> بنجاح برجاء <a href=\"https://prideskill.com/istsharh/istsharh/users/rate/5/15/186/1/\">تقييم</a> المستشار', 1, 4, NULL, NULL),
(187, 'تم تقييمك', 'تم تقييمك بنجاح في  <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a>', 1, 5, NULL, NULL),
(188, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(189, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(190, 'تم نشر عنصر : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-تجربة-تجربة/17/\">تجربة تجربة تجربة تجربة</a>', 'تم نشر عنصر ويمكنك معاينته', 1, 4, NULL, NULL),
(191, 'تم نشر عنصر : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a>', 'تم نشر عنصر ويمكنك معاينته', 1, 4, NULL, NULL),
(192, 'تم اغلاق موضوعك : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-تجربة-تجربة/17/\">تجربة تجربة تجربة تجربة</a>', 'تم اغلاق موضوعك fdsdsfsd', 1, 4, NULL, NULL),
(193, 'تم نشر عنصر : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a>', 'تم نشر عنصر ويمكنك معاينته', 1, 4, NULL, NULL),
(194, 'تم اضافة عرض', 'تم اضافة عرض على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a>', 1, 4, NULL, NULL),
(195, 'تم اضافة عرض', 'تم اضافة عرض على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a>', 1, 4, NULL, NULL),
(196, 'تم اضافة عرض', 'تم اضافة عرض على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a>', 1, 4, NULL, NULL),
(197, 'تم تعديل عرض', 'قام ahmed elhagar بتعديل عرضه على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a>', 1, 4, NULL, NULL),
(198, 'تم اختيارك', 'تم اختيارك لمشروع<a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(199, 'تم طلب تعديل عرض', 'تم طلب تعديل عرض على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a>', 1, 4, NULL, NULL),
(200, 'تم طلب تعديل عرض', 'تم طلب تعديل عرض على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a>', 1, 4, NULL, NULL),
(201, 'تم قبول طلبك', 'تم قبول طلبك لتعديل عرض على مشروع <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 4, NULL, NULL),
(202, 'تم طلب تعديل عرض', 'تم طلب تعديل عرض على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a>', 1, 4, NULL, NULL),
(203, 'تم قبول طلبك', 'تم قبول طلبك لتعديل عرض على مشروع <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(204, 'تم طلب تعديل عرض', 'تم طلب تعديل عرض على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a>', 1, 4, NULL, NULL),
(205, 'تم قبول طلبك', 'تم قبول طلبك لتعديل عرض على مشروع <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(206, 'تم طلب تعديل عرض', 'تم طلب تعديل عرض على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a>', 1, 4, NULL, NULL),
(207, 'تم قبول طلبك', 'تم قبول طلبك لتعديل عرض على مشروع <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(208, 'تم طلب تعديل عرض', 'تم طلب تعديل عرض على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a>', 1, 4, NULL, NULL),
(209, 'تم قبول طلبك', 'تم قبول طلبك لتعديل عرض على مشروع <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(210, 'تم عمل طلب إلغاء', 'تم عمل طلب إلغاء على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a>', 1, 4, NULL, NULL),
(211, 'تم عمل طلب إلغاء', 'تم عمل طلب إلغاء على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a>', 1, 4, NULL, NULL),
(212, 'تم قبول طلبك', 'تم قبول طلبك إلغاء المشروع <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(213, 'تم اغلاق موضوعك : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a>', 'تم اغلاق موضوعك بالبالب', 1, 5, NULL, NULL),
(214, 'تم نشر عنصر : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a>', 'تم نشر عنصر ويمكنك معاينته', 1, 5, NULL, NULL),
(215, 'تم اضافة عرض', 'تم اضافة عرض على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a>', 1, 5, NULL, NULL),
(216, 'استفسار عن عمل مشابه', 'لقد وصلك طلب استفسار عن <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/users/p/تجربة-تجربة-111/19/\">تجربة تجربة 111</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(217, 'استفسار عن عمل مشابه', 'لقد وصلك طلب استفسار عن <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/users/p/تجربة-تجربة-111/19/\">تجربة تجربة 111</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(218, 'استفسار عن عمل مشابه', 'لقد وصلك طلب استفسار عن <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/users/p/تجربة-تجربة-111/19/\">تجربة تجربة 111</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(219, 'تم اختيارك', 'تم اختيارك لمشروع<a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 5, NULL, NULL),
(220, 'تم اختيارك', 'تم اختيارك لمشروع<a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(221, 'تم طلب تعديل عرض', 'تم طلب تعديل عرض على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a>', 1, 5, NULL, NULL),
(222, 'تم طلب تعديل عرض', 'تم طلب تعديل عرض على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a>', 1, 5, NULL, NULL),
(223, 'تم قبول طلبك', 'تم قبول طلبك قبول العرض الجديد <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(224, 'تم طلب تعديل عرض', 'تم طلب تعديل عرض على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a>', 1, 5, NULL, NULL),
(225, 'تم عمل طلب إلغاء', 'تم عمل طلب إلغاء على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a>', 1, 5, NULL, NULL),
(226, 'تم قبول طلبك', 'تم قبول طلبك قبول العرض الجديد <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(227, 'تم قبول طلبك', 'تم قبول طلبك قبول العرض الجديد <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(228, 'تم قبول طلبك', 'تم قبول طلبك قبول العرض الجديد <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(229, 'تم قبول طلبك', 'تم قبول طلبك إلغاء المشروع <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(230, 'تم قبول طلبك', 'تم قبول طلبك إلغاء المشروع <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(231, 'تم قبول طلبك', 'تم قبول طلبك إلغاء المشروع <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(232, 'تم عمل طلب إلغاء', 'تم عمل طلب إلغاء على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a>', 1, 5, NULL, NULL),
(233, 'تم طلب تعديل عرض', 'تم طلب تعديل عرض على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a>', 1, 5, NULL, NULL),
(234, 'رسالة', 'وصلتك رسالة يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(235, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/تتتتتتتتتتتتتتتتتتتتت/22/\">تتتتتتتتتتتتتتتتتتتتت</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(236, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/تتتتتتتتتتتتتتتتتتتتت/22/\">تتتتتتتتتتتتتتتتتتتتت</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(237, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/تتتتتتتتتتتتتتتتتتتتت/22/\">تتتتتتتتتتتتتتتتتتتتت</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(238, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/تتتتتتتتتتتتتتتتتتتتت/22/\">تتتتتتتتتتتتتتتتتتتتت</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(239, 'تمت الموافقة على مشروعكم : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجرببببببببببب/18/\">تجرببببببببببب</a>', 'تمت الموافقة على مشروعكم ويمكنك معاينته', 1, 4, NULL, NULL),
(240, 'تم اغلاق موضوعك : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a>', 'تم اغلاق موضوعك تجربة', 1, 5, NULL, NULL),
(241, 'تمت الموافقة على مشروعكم : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a>', 'تمت الموافقة على مشروعكم ويمكنك معاينته', 1, 5, NULL, NULL),
(242, 'تم اختيارك', 'تم اختيارك لمشروع<a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(243, 'تم قبول طلبك', 'تم قبول طلبك قبول العرض الجديد <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL);
INSERT INTO `alerts` (`id`, `title`, `description`, `statue`, `u_id`, `i_id`, `bill_id`) VALUES
(244, 'تهانينا', 'تم استلام المشروع <a href=\"https://prideskill.com/istsharh/istsharh/i/تتتتتتتتتتتتتتتتتتتتت/22/\">تتتتتتتتتتتتتتتتتتتتت</a> بنجاح', 1, 5, NULL, NULL),
(245, 'شكراً', 'تم استلام المشروع <a href=\"https://prideskill.com/istsharh/istsharh/i/تتتتتتتتتتتتتتتتتتتتت/22/\">تتتتتتتتتتتتتتتتتتتتت</a> بنجاح برجاء <a href=\"https://prideskill.com/istsharh/istsharh/users/rate/5/22/192/1/\">تقييم</a> المستشار', 1, 4, NULL, NULL),
(246, 'تم تقييمك', 'تم تقييمك بنجاح في  <a href=\"https://prideskill.com/istsharh/istsharh/i/تتتتتتتتتتتتتتتتتتتتت/22/\">تتتتتتتتتتتتتتتتتتتتت</a>', 1, 5, NULL, NULL),
(247, 'تهانينا', 'تم استلام المشروع <a href=\"https://prideskill.com/istsharh/istsharh/i/تتتتتتتتتتتتتتتتتتتتت/22/\">تتتتتتتتتتتتتتتتتتتتت</a> بنجاح', 1, 5, NULL, NULL),
(248, 'شكراً', 'تم استلام المشروع <a href=\"https://prideskill.com/istsharh/istsharh/i/تتتتتتتتتتتتتتتتتتتتت/22/\">تتتتتتتتتتتتتتتتتتتتت</a> بنجاح برجاء <a href=\"https://prideskill.com/istsharh/istsharh/users/rate/5/22/193/1/\">تقييم</a> المستشار', 1, 4, NULL, NULL),
(249, 'تم تقييمك', 'تم تقييمك بنجاح في  <a href=\"https://prideskill.com/istsharh/istsharh/i/تتتتتتتتتتتتتتتتتتتتت/22/\">تتتتتتتتتتتتتتتتتتتتت</a>', 1, 5, NULL, NULL),
(250, 'تم الارسال', 'تم ارسال طلب تسليم الخدمة<a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a> | <a href=\"https://prideskill.com/istsharh/istsharh/users/acceptPro/15/\">استلام</a>', 1, 4, NULL, NULL),
(251, 'تم الارسال', 'تم ارسال طلب تسليم الخدمة<a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a> | <a href=\"https://prideskill.com/istsharh/istsharh/users/acceptPro/15/\">استلام</a>', 1, 4, NULL, NULL),
(252, 'تم الارسال', 'تم ارسال طلب تسليم الخدمة<a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a> | <a href=\"https://prideskill.com/istsharh/istsharh/users/acceptPro/15/4/132\">استلام</a>', 1, 4, NULL, NULL),
(253, 'تم الارسال', 'تم ارسال طلب تسليم الخدمة<a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a> | <a href=\"https://prideskill.com/istsharh/istsharh/users/acceptPro/15/4/132\">استلام</a>', 1, 4, NULL, NULL),
(255, 'تم رفض طلبك لتسليم الخدمة', 'fdsdsgdsds', 0, NULL, 15, 191),
(256, 'تم رفض طلبك لتسليم الخدمة', 'الاىتة رللااى', 0, NULL, 15, 191),
(257, 'تم الارسال', 'تم ارسال طلب تسليم الخدمة<a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a> | <a href=\"https://prideskill.com/istsharh/istsharh/users/acceptPro/15/4/132\">استلام</a>', 1, 4, NULL, NULL),
(258, 'تم الارسال', 'تم ارسال طلب تسليم الخدمة<a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a> | <a href=\"https://prideskill.com/istsharh/istsharh/users/acceptPro/15/4/132\">استلام</a>', 1, 4, NULL, NULL),
(259, 'تم رفض طلب تسليم الخدمة', 'تم رفض طلب تسليم الخدمة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 0, NULL, NULL, NULL),
(260, 'تم الارسال', 'تم ارسال طلب تسليم الخدمة<a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a> | <a href=\"https://prideskill.com/istsharh/istsharh/users/acceptPro/15/4/132\">استلام</a>', 1, 4, NULL, NULL),
(261, 'تم رفض طلب تسليم الخدمة', 'تم رفض طلب تسليم الخدمة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 0, NULL, NULL, NULL),
(262, 'تم الارسال', 'تم ارسال طلب تسليم الخدمة<a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a> | <a href=\"https://prideskill.com/istsharh/istsharh/users/acceptPro/15/4/132\">استلام</a>', 1, 4, NULL, NULL),
(263, 'تم رفض طلب تسليم الخدمة', 'تم رفض طلب تسليم الخدمة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 0, NULL, NULL, NULL),
(264, 'تم رفض طلب تسليم الخدمة', 'تم رفض طلب تسليم الخدمة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(265, 'تم رفض طلب تسليم الخدمة', 'تم رفض طلب تسليم الخدمة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(266, 'تم رفض طلب تسليم الخدمة', 'تم رفض طلب تسليم الخدمة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(267, 'استفسار عن عمل مشابه', 'لقد وصلك طلب استفسار عن <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/users/p/تجربة-تجربة-تجربة-تجربة-تجربة/1/\">تجربة تجربة تجربة تجربة تجربة</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(268, 'استفسار عن عمل مشابه', 'لقد وصلك طلب استفسار عن <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/users/p/تتتتتتتتتتتتتتتتتتتتت/22/\">تتتتتتتتتتتتتتتتتتتتت</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(269, 'طلب استلام', 'قام ahmedabdooooo بطلب تسليم الخدمة<a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a> | <a href=\"https://prideskill.com/istsharh/istsharh/users/acceptProConfirm/15/4/132\">استلام</a>', 1, 4, NULL, NULL),
(270, 'تهانينا', 'تم استلام المشروع <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> بنجاح', 1, 5, NULL, NULL),
(271, 'شكراً', 'تم استلام المشروع <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> بنجاح برجاء <a href=\"https://prideskill.com/istsharh/istsharh/users/rate/5/15/191/1/\">تقييم</a> المستشار', 1, 4, NULL, NULL),
(272, 'تم تقييمك', 'تم تقييمك بنجاح في  <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a>', 1, 5, NULL, NULL),
(273, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(274, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(275, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(276, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(277, 'تنبيه عملية', 'تمت عملية دفع جزء من طلبية <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/remainingPayments\">المديونيات</a>', 1, 4, NULL, NULL),
(278, 'استفسار عن عمل مشابه', 'لقد وصلك طلب استفسار عن <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/users/p/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(279, 'استفسار عن عمل مشابه', 'لقد وصلك طلب استفسار عن <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/users/p/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(280, 'استفسار عن عمل مشابه', 'لقد وصلك طلب استفسار عن <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/users/p/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(281, 'استفسار عن عمل مشابه', 'لقد وصلك طلب استفسار عن <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/users/p/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(282, 'استفسار عن عمل مشابه', 'لقد وصلك طلب استفسار عن <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/users/p/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(283, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(284, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(285, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 1, 4, NULL, NULL),
(286, 'تنبيه عملية', 'تمت عملية شراء لخدمة <a href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> تصفح <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a>', 1, 5, NULL, NULL),
(287, 'تم اغلاق خدمتك : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a>', 'تم اغلاق خدمتك dgfd', 1, 5, NULL, NULL),
(288, 'تمت الموافقة على مشروعكم : <a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-مشروع-تجربة/23/\">تجربة مشروع تجربة</a>', 'تمت الموافقة على مشروعكم ويمكنك معاينته', 1, 5, NULL, NULL),
(289, 'تم عمل طلب إلغاء', 'تم عمل طلب إلغاء على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a>', 1, 5, NULL, NULL),
(290, 'تمت اضافة تعليق', 'تمت اضافة تعليق على <a href=\"https://prideskill.com/istsharh/istsharh/pages/ser/11\">gfsfdsgdsgds</a>', 1, 4, NULL, NULL),
(291, 'تم طلب تعديل عرض', 'تم طلب تعديل عرض على <a href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a>', 1, 5, NULL, NULL),
(292, 'تم رفض طلب تعديل عرضك', 'تم رفض طلب تعديل عرضك على  <a href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a>', 1, 4, NULL, NULL),
(293, 'تم اغلاق مشروعك تجربة تجربة تجربة تجربة', 'تم اغلاق مشروعك <a href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-تجربة-تجربة/17/\">تجربة تجربة تجربة تجربة</a> والسبب : hjnm', 1, 4, NULL, NULL),
(294, 'تم الارسال', 'تم ارسال طلب تسليم المشروع<a target=\"_blank\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a> يمكنك مشاهدة <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/4/\">المحادثة</a> | <a href=\"https://prideskill.com/istsharh/istsharh/users/acceptPro/19/\">استلام</a>', 1, 5, NULL, NULL),
(295, 'تم رفض طلب تسليم المشروع', 'تم رفض طلب تسليم المشروع <a href=\"https://prideskill.com/istsharh/istsharh/users/chat/5/\">المحادثة</a>', 0, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `days` int(10) NOT NULL,
  `bid` text CHARACTER SET utf8 NOT NULL,
  `date` varchar(255) CHARACTER SET utf8 NOT NULL,
  `u_id` int(10) NOT NULL,
  `i_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `amount`, `days`, `bid`, `date`, `u_id`, `i_id`) VALUES
(3, 700, 25, 'تجربة وصف عرض على مشروع.', '2020-08-05 12:41:43', 5, 1),
(6, 0, 0, 'تالبببيايبابي', '2020-09-17 22:02:52', 5, 18),
(7, 250, 10, 'تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة.', '2020-09-23 06:58:06', 4, 19);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `i_ids` text DEFAULT NULL,
  `u_id` int(10) NOT NULL,
  `date` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `i_ids`, `u_id`, `date`) VALUES
(1, ',22,22,22,22,22,22,22,22,22,22,22,22,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15', 4, 2020);

-- --------------------------------------------------------

--
-- Table structure for table `cartgu`
--

CREATE TABLE `cartgu` (
  `id` int(10) NOT NULL,
  `gigsIds` varchar(255) DEFAULT NULL,
  `ui_rep` varchar(255) DEFAULT NULL,
  `gigsUp` varchar(255) DEFAULT NULL,
  `cart_id` int(10) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `i_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cartgu`
--

INSERT INTO `cartgu` (`id`, `gigsIds`, `ui_rep`, `gigsUp`, `cart_id`, `date`, `i_id`) VALUES
(1, NULL, NULL, NULL, 1, '2020-09-28 22:21:32', 22),
(2, NULL, NULL, NULL, 1, '2020-09-28 22:21:34', 22),
(3, NULL, NULL, NULL, 1, '2020-09-28 22:21:38', 22),
(4, NULL, NULL, NULL, 1, '2020-09-28 22:21:39', 22),
(5, NULL, NULL, NULL, 1, '2020-09-28 22:21:40', 22),
(6, NULL, NULL, NULL, 1, '2020-09-28 22:21:40', 22),
(7, NULL, NULL, NULL, 1, '2020-09-28 22:21:53', 22),
(8, NULL, NULL, NULL, 1, '2020-09-28 22:21:58', 22),
(9, NULL, NULL, NULL, 1, '2020-09-28 22:21:58', 22),
(10, NULL, NULL, NULL, 1, '2020-09-28 22:21:58', 22),
(11, NULL, NULL, NULL, 1, '2020-09-28 22:21:58', 22),
(12, NULL, NULL, NULL, 1, '2020-09-28 22:21:59', 22),
(13, NULL, NULL, NULL, 1, '2020-09-28 22:22:27', 22),
(14, NULL, NULL, NULL, 1, '2020-09-28 22:22:27', 15),
(15, NULL, NULL, NULL, 1, '2020-09-28 22:22:28', 22),
(16, NULL, NULL, NULL, 1, '2020-09-28 22:22:28', 15),
(17, NULL, NULL, NULL, 1, '2020-09-28 22:22:28', 22),
(18, NULL, NULL, NULL, 1, '2020-09-28 22:22:28', 15),
(19, NULL, NULL, NULL, 1, '2020-09-28 22:22:28', 22),
(20, NULL, NULL, NULL, 1, '2020-09-28 22:22:28', 15),
(21, NULL, NULL, NULL, 1, '2020-09-28 22:22:52', 22),
(22, NULL, NULL, NULL, 1, '2020-09-28 22:22:52', 15),
(23, NULL, NULL, NULL, 1, '2020-09-28 22:24:27', 22),
(24, NULL, NULL, NULL, 1, '2020-09-28 22:24:27', 15),
(25, NULL, NULL, NULL, 1, '2020-09-28 22:24:29', 22),
(26, NULL, NULL, NULL, 1, '2020-09-28 22:24:29', 15),
(27, '0, ', '1, ', '0', 1, '2020-09-28 22:26:03', 22),
(28, '0, ', '1, ', '15', 1, '2020-09-28 22:26:03', 15),
(29, NULL, NULL, NULL, NULL, '2020-09-28 22:28:10', 22),
(30, NULL, NULL, NULL, NULL, '2020-09-28 22:28:10', 15),
(31, NULL, NULL, NULL, 1, '2020-09-28 22:28:54', 22),
(32, NULL, NULL, NULL, 1, '2020-09-28 22:28:54', 15),
(33, NULL, NULL, NULL, 1, '2020-09-28 22:30:12', 15),
(34, NULL, NULL, NULL, 1, '2020-09-28 22:30:36', 15),
(35, NULL, NULL, NULL, 1, '2020-09-28 22:31:20', 15),
(36, NULL, NULL, NULL, 1, '2020-09-28 22:31:32', 15),
(37, NULL, NULL, NULL, 1, '2020-09-28 22:31:36', 15),
(38, NULL, NULL, NULL, 1, '2020-09-28 22:31:38', 15);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `category` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `c_id` int(10) DEFAULT NULL,
  `state` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `icon`, `c_id`, `state`) VALUES
(1, 'برمجة وتطوير', 'fa fa-code', NULL, 0),
(2, 'برمجة CSS و HTML', NULL, 1, 1),
(3, 'تسويق الكتروني', 'fa fa-bullhorn', NULL, 0),
(4, 'التسويق على انستغرام', NULL, 3, 1),
(5, 'تجربة', NULL, 3, 1),
(8, 'fffff', NULL, 1, 1),
(9, 'dfddgdgd', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cdata`
--

CREATE TABLE `cdata` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `co_id` int(11) DEFAULT NULL,
  `state` int(10) NOT NULL,
  `u_id` int(10) NOT NULL,
  `kind` int(10) DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `seen` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cdata`
--

INSERT INTO `cdata` (`id`, `title`, `content`, `co_id`, `state`, `u_id`, `kind`, `date`, `seen`) VALUES
(7, 'ادراج خدمة', '<p>ادراج خدمة&nbsp;ادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمة</p>\r\n', NULL, 0, 0, 1, '2020-09-01 02:42:50', 0),
(8, 'ادراج خدمة2', '<p>ادراج خدمة&nbsp;ادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمةادراج خدمة</p>\r\n', NULL, 0, 0, 1, '2020-09-01 03:09:40', 0),
(9, 'تتتتتتتتتتتتتتتتتتت', '<p>تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتت&nbsp;</p>\r\n', NULL, 0, 0, 2, '2020-09-01 03:42:14', 0),
(10, 'مشكلة في كذا', 'مشكلة في كذا مشكلة في كذامشكلة في كذا', NULL, 0, 5, 3, '2020-09-01 14:40:03', 1),
(11, 'gfsfdsgdsgds', 'gfsfdsgdsgdsgfsfdsgdsgdsgfsfdsgdsgdsgfsfdsgdsgdsgfsfdsgdsgdsgfsfdsgdsgds', NULL, 0, 4, 3, '2020-09-01 15:01:54', 1),
(12, NULL, 'لبببيلبي', 11, 1, 4, 3, '2020-09-01 15:12:13', 1),
(13, NULL, 'gfdgdf', 11, 1, 4, 3, '2020-09-01 15:12:20', 1),
(14, NULL, 'تجربة', 10, 1, 0, 3, '2020-09-01 19:25:10', 1),
(15, NULL, 'FGGFDDF', 10, 1, 5, 3, '2020-09-01 19:34:26', 1),
(16, 'تصميم متجاوب لمتجر منتجات إلكترونية', 'ليابياببلالبالببلتبتلب', NULL, 0, 5, 3, '2020-09-17 01:10:40', 1),
(17, 'تصميم صفحة رئيسية متجاوبة لمتجر', 'ليسليسليسليس', NULL, 0, 5, 3, '2020-09-17 01:11:30', 1),
(18, 'تصميم صفحة رئيسية متجاوبة لمتجر', 'ليسليسليسليس', NULL, 0, 5, 3, '2020-09-17 01:11:51', 1),
(19, NULL, 'لاباب\r\nابالبالبب \r\n\r\nلبتلبتلتب', 11, 1, 0, 3, '2020-10-07 13:18:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `u_id`, `s_id`) VALUES
(3, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `community`
--

CREATE TABLE `community` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `co_id` int(11) DEFAULT NULL,
  `state` int(10) NOT NULL,
  `u_id` int(10) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `community`
--

INSERT INTO `community` (`id`, `title`, `content`, `co_id`, `state`, `u_id`, `date`) VALUES
(1, 'أريد خدمة', 'أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة.', NULL, 0, 4, '2020-08-07 04:52:36'),
(2, 'أريد خدمة 2', 'أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة أريد خدمة 2222.', NULL, 0, 5, '2020-08-08 04:52:36'),
(3, NULL, 'تصفح معرض أعمالي', 1, 1, 4, '2020-08-26 04:48:20'),
(4, NULL, 'يبايابيايباسبي', 1, 1, 4, '2020-08-26 04:48:36'),
(5, NULL, 'تصفح خدماتي عرضي مقابل 20$\r\n\r\nشكراً', 2, 1, 4, '2020-08-26 16:20:25'),
(6, NULL, 'تجربة تعليق', 1, 1, 5, '2020-08-30 15:09:59'),
(7, 'تجربة تجربة', 'تجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربةتجربة تجربة', NULL, 0, 5, '2020-09-01 00:28:37');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) NOT NULL,
  `country` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country`, `code`, `tel`) VALUES
(1, 'آروبا', 'AW', '297'),
(2, 'أذربيجان', 'AZ', '994'),
(3, 'أرمينيا', 'AM', '374'),
(4, 'أسبانيا', 'ES', '34'),
(5, 'أستراليا', 'AU', '61'),
(6, 'أفغانستان', 'AF', '93'),
(7, 'ألبانيا', 'AL', '355'),
(8, 'ألمانيا', 'DE', '49'),
(9, 'أنتيجوا وبربودا', 'AG', '1268'),
(10, 'أنجولا', 'AO', '244'),
(11, 'أنجويلا', 'AI', '1264'),
(12, 'أندورا', 'AD', '376'),
(13, 'أورجواي', 'UY', '598'),
(14, 'أوزبكستان', 'UZ', '998'),
(15, 'أوغندا', 'UG', '256'),
(16, 'أوكرانيا', 'UA', '380'),
(17, 'أيرلندا', 'IE', '353'),
(18, 'أيسلندا', 'IS', '354'),
(19, 'اثيوبيا', 'ET', '251'),
(20, 'اريتريا', 'ER', '291'),
(21, 'استونيا', 'EE', '372'),
(22, 'الأرجنتين', 'AR', '54'),
(23, 'الأردن', 'JO', '962'),
(24, 'الاكوادور', 'EC', '593'),
(25, 'الامارات العربية المتحدة', 'AE', '971'),
(26, 'الباهاما', 'BS', '1242'),
(27, 'البحرين', 'BH', '973'),
(28, 'البرازيل', 'BR', '55'),
(29, 'البرتغال', 'PT', '351'),
(30, 'البوسنة والهرسك', 'BA', '387'),
(31, 'الجابون', 'GA', '241'),
(32, 'الجبل الأسود', 'ME', '382'),
(33, 'الجزائر', 'DZ', '213'),
(34, 'الدانمرك', 'DK', '45'),
(35, 'الرأس الأخضر', 'CV', '238'),
(36, 'السلفادور', 'SV', '503'),
(37, 'السنغال', 'SN', '221'),
(38, 'السودان', 'SD', '249'),
(39, 'السويد', 'SE', '46'),
(40, 'الصومال', 'SO', '252'),
(41, 'الصين', 'CN', '86'),
(42, 'العراق', 'IQ', '964'),
(43, 'الفاتيكان', 'VA', '39'),
(44, 'الفيلبين', 'PH', '63'),
(45, 'القطب الجنوبي', 'AQ', '672'),
(46, 'الكاميرون', 'CM', '237'),
(47, 'الكونغو - برازافيل', 'CG', '242'),
(48, 'الكويت', 'KW', '965'),
(49, 'المجر', 'HU', '36'),
(51, 'المغرب', 'MA', '212'),
(53, 'المكسيك', 'MX', '52'),
(54, 'المملكة العربية السعودية', 'SA', '966'),
(55, 'المملكة المتحدة', 'GB', '44'),
(56, 'النرويج', 'NO', '47'),
(57, 'النمسا', 'AT', '43'),
(58, 'النيجر', 'NE', '227'),
(59, 'الهند', 'IN', '91'),
(60, 'الولايات المتحدة الأمريكية', 'US', '1'),
(61, 'اليابان', 'JP', '81'),
(62, 'اليمن', 'YE', '967'),
(63, 'اليونان', 'GR', '30'),
(64, 'اندونيسيا', 'ID', '62'),
(65, 'ايران', 'IR', '98'),
(66, 'ايطاليا', 'IT', '39'),
(67, 'بابوا غينيا الجديدة', 'PG', '675'),
(68, 'باراجواي', 'PY', '595'),
(69, 'باكستان', 'PK', '92'),
(70, 'بالاو', 'PW', '680'),
(71, 'بتسوانا', 'BW', '267'),
(72, 'بتكايرن', 'PN', '870'),
(73, 'بربادوس', 'BB', '1246'),
(74, 'برمودا', 'BM', '1441'),
(75, 'بروناي', 'BN', '673'),
(76, 'بلجيكا', 'BE', '32'),
(77, 'بلغاريا', 'BG', '359'),
(78, 'بليز', 'BZ', '501'),
(79, 'بنجلاديش', 'BD', '880'),
(80, 'بنما', 'PA', '507'),
(81, 'بنين', 'BJ', '229'),
(82, 'بوتان', 'BT', '975'),
(83, 'بورتوريكو', 'PR', '1'),
(84, 'بوركينا فاسو', 'BF', '226'),
(85, 'بوروندي', 'BI', '257'),
(86, 'بولندا', 'PL', '48'),
(87, 'بوليفيا', 'BO', '591'),
(88, 'بولينيزيا الفرنسية', 'PF', '689'),
(89, 'بيرو', 'PE', '51'),
(90, 'تانزانيا', 'TZ', '255'),
(91, 'تايلند', 'TH', '66'),
(92, 'تايوان', 'TW', '886'),
(93, 'تركمانستان', 'TM', '993'),
(94, 'تركيا', 'TR', '90'),
(95, 'ترينيداد وتوباغو', 'TT', '1868'),
(96, 'تشاد', 'TD', '235'),
(97, 'توجو', 'TG', '228'),
(98, 'توفالو', 'TV', '688'),
(99, 'توكيلو', 'TK', '690'),
(100, 'تونجا', 'TO', '676'),
(101, 'تونس', 'TN', '216'),
(102, 'تيمور الشرقية', 'TL', '670'),
(103, 'جامايكا', 'JM', '1876'),
(104, 'جبل طارق', 'GI', '350'),
(105, 'جرينادا', 'GD', '1473'),
(106, 'جرينلاند', 'GL', '299'),
(108, 'جزر الأنتيل الهولندية', 'AN', '599'),
(109, 'جزر الترك وجايكوس', 'TC', '1649'),
(110, 'جزر القمر', 'KM', '269'),
(111, 'جزر الكايمن', 'KY', '1345'),
(112, 'جزر المارشال', 'MH', '692'),
(113, 'جزر الملديف', 'MV', '960'),
(115, 'جزر سليمان', 'SB', '677'),
(116, 'جزر فارو', 'FO', '298'),
(117, 'جزر فرجين الأمريكية', 'VI', '1340'),
(118, 'جزر فرجين البريطانية', 'VG', '1284'),
(119, 'جزر فوكلاند', 'FK', '500'),
(120, 'جزر كوك', 'CK', '682'),
(121, 'جزر كوكوس', 'CC', '61'),
(122, 'جزر ماريانا الشمالية', 'MP', '1670'),
(123, 'جزر والس وفوتونا', 'WF', '681'),
(124, 'جزيرة الكريسماس', 'CX', '61'),
(126, 'جزيرة مان', 'IM', '44'),
(129, 'جمهورية افريقيا الوسطى', 'CF', '236'),
(130, 'جمهورية التشيك', 'CZ', '420'),
(131, 'جمهورية الدومينيك', 'DO', '1809'),
(132, 'جمهورية الكونغو الديمقراطية', 'CD', '243'),
(133, 'جمهورية جنوب افريقيا', 'ZA', '27'),
(134, 'جواتيمالا', 'GT', '502'),
(136, 'جوام', 'GU', '1671'),
(137, 'جورجيا', 'GE', '995'),
(139, 'جيبوتي', 'DJ', '253'),
(141, 'دومينيكا', 'DM', '1767'),
(142, 'رواندا', 'RW', '250'),
(143, 'روسيا', 'RU', '7'),
(144, 'روسيا البيضاء', 'BY', '375'),
(145, 'رومانيا', 'RO', '40'),
(147, 'زامبيا', 'ZM', '260'),
(148, 'زيمبابوي', 'ZW', '263'),
(149, 'ساحل العاج', 'CI', '225'),
(150, 'ساموا', 'WS', '685'),
(151, 'ساموا الأمريكية', 'AS', '1684'),
(152, 'سان مارينو', 'SM', '378'),
(153, 'سانت بيير وميكولون', 'PM', '508'),
(154, 'سانت فنسنت وغرنادين', 'VC', '1784'),
(155, 'سانت كيتس ونيفيس', 'KN', '1869'),
(156, 'سانت لوسيا', 'LC', '1758'),
(157, 'سانت مارتين', 'MF', '1599'),
(158, 'سانت هيلنا', 'SH', '290'),
(159, 'ساو تومي وبرينسيبي', 'ST', '239'),
(160, 'سريلانكا', 'LK', '94'),
(162, 'سلوفاكيا', 'SK', '421'),
(163, 'سلوفينيا', 'SI', '386'),
(164, 'سنغافورة', 'SG', '65'),
(165, 'سوازيلاند', 'SZ', '268'),
(166, 'سوريا', 'SY', '963'),
(167, 'سورينام', 'SR', '597'),
(168, 'سويسرا', 'CH', '41'),
(169, 'سيراليون', 'SL', '232'),
(170, 'سيشل', 'SC', '248'),
(171, 'شيلي', 'CL', '56'),
(172, 'صربيا', 'RS', '381'),
(174, 'طاجكستان', 'TJ', '992'),
(175, 'عمان', 'OM', '968'),
(176, 'غامبيا', 'GM', '220'),
(177, 'غانا', 'GH', '233'),
(179, 'غيانا', 'GY', '592'),
(180, 'غينيا', 'GN', '224'),
(181, 'غينيا الاستوائية', 'GQ', '240'),
(182, 'غينيا بيساو', 'GW', '245'),
(183, 'فانواتو', 'VU', '678'),
(184, 'فرنسا', 'FR', '33'),
(186, 'فنزويلا', 'VE', '58'),
(187, 'فنلندا', 'FI', '358'),
(188, 'فيتنام', 'VN', '84'),
(189, 'فيجي', 'FJ', '679'),
(190, 'قبرص', 'CY', '357'),
(191, 'قرغيزستان', 'KG', '996'),
(192, 'قطر', 'QA', '974'),
(193, 'كازاخستان', 'KZ', '7'),
(194, 'كاليدونيا الجديدة', 'NC', '687'),
(195, 'كرواتيا', 'HR', '385'),
(196, 'كمبوديا', 'KH', '855'),
(197, 'كندا', 'CA', '1'),
(198, 'كوبا', 'CU', '53'),
(199, 'كوريا الجنوبية', 'KR', '82'),
(200, 'كوريا الشمالية', 'KP', '850'),
(201, 'كوستاريكا', 'CR', '506'),
(202, 'كولومبيا', 'CO', '57'),
(203, 'كيريباتي', 'KI', '686'),
(204, 'كينيا', 'KE', '254'),
(205, 'لاتفيا', 'LV', '371'),
(206, 'لاوس', 'LA', '856'),
(207, 'لبنان', 'LB', '961'),
(208, 'لوكسمبورج', 'LU', '352'),
(209, 'ليبيا', 'LY', '218'),
(210, 'ليبيريا', 'LR', '231'),
(211, 'ليتوانيا', 'LT', '370'),
(212, 'ليختنشتاين', 'LI', '423'),
(213, 'ليسوتو', 'LS', '266'),
(215, 'ماكاو الصينية', 'MO', '853'),
(216, 'مالطا', 'MT', '356'),
(217, 'مالي', 'ML', '223'),
(218, 'ماليزيا', 'MY', '60'),
(219, 'مايوت', 'YT', '262'),
(220, 'مدغشقر', 'MG', '261'),
(221, 'مصر', 'EG', '20'),
(222, 'مقدونيا', 'MK', '389'),
(223, 'ملاوي', 'MW', '265'),
(225, 'منغوليا', 'MN', '976'),
(226, 'موريتانيا', 'MR', '222'),
(227, 'موريشيوس', 'MU', '230'),
(228, 'موزمبيق', 'MZ', '258'),
(229, 'مولدافيا', 'MD', '373'),
(230, 'موناكو', 'MC', '377'),
(231, 'مونتسرات', 'MS', '1664'),
(232, 'ميانمار', 'MM', '95'),
(233, 'ميكرونيزيا', 'FM', '691'),
(234, 'ناميبيا', 'NA', '264'),
(235, 'نورو', 'NR', '674'),
(236, 'نيبال', 'NP', '977'),
(237, 'نيجيريا', 'NG', '234'),
(238, 'نيكاراجوا', 'NI', '505'),
(239, 'نيوزيلاندا', 'NZ', '64'),
(240, 'نيوي', 'NU', '683'),
(242, 'هندوراس', 'HN', '504'),
(243, 'هولندا', 'NL', '31'),
(244, 'هونج كونج الصينية', 'HK', '852'),
(245, 'فلسطين', 'PS', '');

-- --------------------------------------------------------

--
-- Table structure for table `c_balance`
--

CREATE TABLE `c_balance` (
  `id` int(10) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `i_id` int(10) NOT NULL,
  `u_id` int(10) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `c_balance`
--

INSERT INTO `c_balance` (`id`, `balance`, `i_id`, `u_id`, `date`) VALUES
(20, '8.5', 22, 5, '2020-09-25 02:51'),
(21, '8.5', 22, 5, '2020-09-25 02:53'),
(22, '112.2', 15, 5, '2020-09-29 10:25');

-- --------------------------------------------------------

--
-- Table structure for table `editedbid`
--

CREATE TABLE `editedbid` (
  `id` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `days` int(10) NOT NULL,
  `bid` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `u_id` int(10) NOT NULL,
  `i_id` int(10) NOT NULL,
  `bid_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `editedbid`
--

INSERT INTO `editedbid` (`id`, `amount`, `days`, `bid`, `date`, `u_id`, `i_id`, `bid_id`) VALUES
(15, 0, 0, 'للاة ىوة', '2020-10-06 13:04:14', 4, 19, 7);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `filesize` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `fileext` varchar(255) NOT NULL,
  `u_id` int(10) NOT NULL,
  `c_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `filename`, `client_name`, `filesize`, `date`, `fileext`, `u_id`, `c_id`) VALUES
(14, '1b4138c358ccceb469184469431b16c4.jpg', 'aa.jpg', '1895.34', '2020-08-13 02:03:28', '.jpg', 5, 4),
(15, '0f9dcc768a48e2d7292647e65459725c.jpg', 'Approach.jpg', '87.01', '2020-08-13 03:10:20', '.jpg', 5, 4),
(16, '377809d95a5db5e9e54a659804f0ce80.jpg', 'Lumion 10 Pro 正版授权ggss.jpg', '1403.2', '2020-08-13 03:17:02', '.jpg', 5, 4),
(17, '3f2325550e8b5009cd27f8df6d0a0186.jpg', 'home.jpg', '2012.49', '2020-08-13 03:18:01', '.jpg', 5, 4),
(18, 'd61f178d022f70a82e4ad863a6bc0244.jpg', 'Approach.jpg', '87.01', '2020-08-13 03:21:34', '.jpg', 5, 4),
(19, '5c7f81ba214911428fdc1c4b5681df68.jpg', 'home.jpg', '2012.49', '2020-08-13 03:22:28', '.jpg', 5, 4),
(20, 'f60ba3eccfd8ef07460a40f333155c14.jpg', 'aa.jpg', '1895.34', '2020-08-13 03:23:28', '.jpg', 5, 4),
(21, '459ab7c459a095961d65dc432d723641.jpg', 'aa.jpg', '1895.34', '2020-08-13 03:24:54', '.jpg', 5, 0),
(22, '65d1a453cc5786a08f204394b0bc3223.jpg', 'Lumion 10 Pro 正版授权jj.jpg', '2286.54', '2020-08-13 03:31:05', '.jpg', 4, 5),
(23, '94b0b2313d3868f3e70e4f2e5ef1da82.jpg', '0a095190-3422-4764-8f95-84b218bff287.jpg', '210.4', '2020-08-26 18:58:35', '.jpg', 4, 5),
(25, '1b278745976ac9af45a036ac5abb5412.jpg', 'photo-1503803548695-c2a7b4a5b875.jpg', '110.88', '2020-08-30 02:28:23', '.jpg', 5, 10),
(26, 'd0fa7eb7f5ac85aa55fd66fc38531cf6.jpg', 'photo-1503803548695-c2a7b4a5b875.jpg', '110.88', '2020-08-30 02:29:53', '.jpg', 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `gigupdates`
--

CREATE TABLE `gigupdates` (
  `id` int(10) NOT NULL,
  `content` text NOT NULL,
  `i_id` text NOT NULL,
  `amount` text NOT NULL,
  `days` text NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gigupdates`
--

INSERT INTO `gigupdates` (`id`, `content`, `i_id`, `amount`, `days`, `date`) VALUES
(3, 'تجربة 1, تجربة2', '7', '10, 15', '10, 7', '2020-09-04 14:23:58'),
(8, 'تجربة اضافة خدمة', '14', '10', '10', '2020-09-04 18:28:55'),
(9, 'خدمة خدمة, تتتتتتتتتتتت', '15', '15, 11', '2, 12', '2020-09-10 02:56:22');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `images` text NOT NULL,
  `ytlink` varchar(255) DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `duration` int(10) DEFAULT NULL,
  `tags` text NOT NULL,
  `skills` text DEFAULT NULL,
  `affiliate` int(10) NOT NULL,
  `tag_id` int(10) NOT NULL,
  `date` varchar(255) NOT NULL,
  `file_id` varchar(255) NOT NULL,
  `u_id` int(10) NOT NULL,
  `state` int(10) NOT NULL,
  `kind` int(10) NOT NULL,
  `bid_id` int(10) DEFAULT NULL,
  `s_date` varchar(255) DEFAULT NULL,
  `e_date` varchar(255) DEFAULT NULL,
  `for_user` int(10) DEFAULT NULL,
  `fight` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `title`, `content`, `images`, `ytlink`, `price`, `duration`, `tags`, `skills`, `affiliate`, `tag_id`, `date`, `file_id`, `u_id`, `state`, `kind`, `bid_id`, `s_date`, `e_date`, `for_user`, `fight`) VALUES
(1, 'تجربة تجربة تجربة تجربة تجربة', 'تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة.', 'NONE', 'NONE', '25,50', 20, 'تجربة', NULL, 0, 2, '2020-07-20 10:41:30', '0d2b6697821dd7bca3efe9d75b23427a.jpg', 4, 3, 2, 3, '2020-08-07 04:52:36', '2020-08-09 18:05:31', NULL, NULL),
(3, 'اريد تصميم موقع الكتروني لشركتي', 'ارغب بتصميم موقع الكتروني لشركتي ويحتوي على متجر الكتروني، ارغب بتصميم موقع الكتروني لشركتي ويحتوي على متجر الكتروني، ارغب بتصميم موقع الكتروني لشركتي ويحتوي على متجر الكتروني، ارغب بتصميم موقع الكتروني لشركتي ويحتوي على متجر الكتروني، \r\n\r\nارغب بتصميم موقع الكتروني لشركتي ويحتوي على متجر الكتروني، ارغب بتصميم موقع الكتروني لشركتي ويحتوي على متجر الكتروني، ارغب بتصميم موقع الكتروني لشركتي ويحتوي على متجر الكتروني، ارغب بتصميم موقع الكتروني لشركتي ويحتوي على متجر الكتروني، ارغب بتصميم موقع الكتروني لشركتي ويحتوي على متجر الكتروني، ارغب بتصميم موقع الكتروني لشركتي ويحتوي على متجر الكتروني، ارغب بتصميم موقع الكتروني لشركتي ويحتوي على متجر الكتروني، ارغب بتصميم موقع الكتروني لشركتي ويحتوي على متجر الكتروني، ارغب بتصميم موقع الكتروني لشركتي ويحتوي على متجر الكتروني، \r\nارغب بتصميم موقع الكتروني لشركتي ويحتوي على متجر الكتروني، ارغب بتصميم موقع الكتروني لشركتي ويحتوي على متجر الكتروني، ارغب بتصميم موقع الكتروني لشركتي ويحتوي على متجر الكتروني، ارغب بتصميم موقع الكتروني لشركتي ويحتوي على متجر الكتروني، \r\n\r\nارغب بتصميم موقع الكتروني لشركتي ويحتوي على متجر الكتروني، ارغب بتصميم موقع الكتروني لشركتي ويحتوي على متجر الكتروني، \r\n', 'NONE', 'NONE', '25,50', 1, 'تصميم موقع الكتروني', NULL, 0, 2, '2020-08-02 13:21:28', 'a59841e425200f9ccb8528be39dfe57b.jpg', 5, 1, 2, NULL, NULL, NULL, NULL, NULL),
(4, 'تطوير موقع بإطار codeigniter', 'مطلوب مبرمج محترف عمل سابقا على اطار العمل codeigniter\r\nطبيعة الموقع الذي سيتم انشاؤه تجارة الكترونية\r\n1- مطلوب تطوير الموقع واضافة مجموعة من الخصائص والمهام في لوحة تحكم البائع والمشتري وادمن الموقع\r\n2- اضافة مدونة\r\n3- صلاحيات للمشرفين على الموقع\r\n4- مجتمع حوار بسيط مرتبط بالموقع\r\nسيتم ارسال جميع التفاصيل على الخاص للاتفاق بشكل تفصيلي وتحديد وقت التنفيذ وقيمة المشروع المناسبة', 'NONE', 'NONE', '500,1000', 30, 'تجربة', NULL, 0, 2, '2020-08-07 05:19:45', 'NONE', 4, 1, 2, NULL, NULL, NULL, NULL, NULL),
(9, 'تجربة مشروع خاص', 'تجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاصتجربة مشروع خاص', 'NONE', 'NONE', '30,50', 10, 'تجربة مشروع خاص', NULL, 0, 2, '2020-08-31 15:53:38', 'NONE', 5, 1, 2, NULL, NULL, NULL, 4, NULL),
(15, 'خدمة خدمة خدمة خدمة', '<p>خدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمةخدمة خدمة.</p>\r\n', '2468e132278b94712ac14f19949338f9_thumb.jpg', '', '10', 5, 'خدمة خدمة', NULL, 0, 2, '2020-09-10 02:56:22', '0', 5, 1, 1, NULL, NULL, NULL, NULL, NULL),
(16, 'تجربة تجربة تجربة', '<p>تجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربةتجربة</p>\r\n', '6aa7975cf855d592c471a43b7aa92bd8_thumb.jpg', NULL, '', NULL, 'تجربة', NULL, 0, 8, '2020-09-14 05:03:40', '', 0, 1, 5, NULL, NULL, NULL, NULL, NULL),
(17, 'تجربة تجربة تجربة تجربة', 'تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة.', 'NONE', 'NONE', '500,1000', 10, 'تجربة تجربة', NULL, 0, 4, '2020-09-15 12:58:02', 'NONE', 4, 10, 2, NULL, NULL, NULL, NULL, NULL),
(18, 'تجرببببببببببب', 'تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب تجرببببببببببب.', 'NONE', 'NONE', '1000,2500', 10, 'تجرببببببببببب', 'CSS,PHP', 0, 2, '2020-09-16 03:24:09', 'f61990a511be8177e9fb4099ca9a6669.jpg', 4, 1, 2, NULL, '2020-09-16 04:02:26', NULL, NULL, 18),
(19, 'تجربة تجربة 111', 'تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111تجربة تجربة 111', 'NONE', 'NONE', '250,500', 10, 'تجربة تجربة', 'CSS,Codeigniter', 0, 2, '2020-09-19 21:19:23', 'NONE', 5, 2, 2, 7, '2020-09-23 06:57:44', NULL, NULL, NULL),
(22, 'تتتتتتتتتتتتتتتتتتتتت', '<p>تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;تتتتتتتتتتتتتتتتتتتتت&nbsp;</p>\r\n', '8c0e971b4d3bcd2a9481857336fbf6bf_thumb.PNG,8c0e971b4d3bcd2a9481857336fbf6bf_thumb.PNG', '', '1000000', 5, 'تتتتتتتتتتتتتتتتتتتتت', NULL, 0, 4, '2020-09-21 06:38:34', '0', 5, 1, 1, NULL, NULL, NULL, NULL, NULL),
(23, 'تجربة مشروع تجربة', 'تجربة مشروع تجربة\r\nتجربة مشروع تجربةتجربة مشروع تجربةتجربة مشروع تجربةتجربة مشروع تجربةتجربة مشروع تجربةتجربة مشروع تجربة\r\nتجربة مشروع تجربةتجربة مشروع تجربةتجربة مشروع تجربة\r\n\r\n\r\nتجربة مشروع تجربةتجربة مشروع تجربةتجربة مشروع تجربةتجربة مشروع تجربة\r\nتجربة مشروع تجربة', 'NONE', 'NONE', '500,1000', 15, 'تجربة مشروع تجربة', 'PHP,Codeigniter', 0, 2, '2020-10-05 13:19:35', 'NONE', 5, 1, 2, NULL, NULL, NULL, NULL, NULL),
(24, 'بيتيبابيت بيتنلبي', 'بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي بيتيبابيت بيتنلبي', 'NONE', 'NONE', '250,500', 5, 'بيتيبابيت بيتنلبي', 'HTML,Codeigniter', 0, 8, '2020-10-09 10:36:43', 'NONE', 4, 0, 2, NULL, NULL, NULL, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(10) NOT NULL,
  `link` text NOT NULL,
  `views` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `link`, `views`) VALUES
(1, 'https://mail.google.com/mail/u/0/#inbox', 0),
(2, 'https://stackoverflow.com/questions/36564293/extract-urls-from-a-string-using-php', 2),
(3, 'https://www.php.net/manual/en/function.str-replace.php', 12),
(4, 'https://www.google.com/', 0),
(5, 'https://mostaql.com/projects', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `c_id` int(10) NOT NULL,
  `f_id` int(10) NOT NULL,
  `to_id` int(10) NOT NULL,
  `date` varchar(255) NOT NULL,
  `state` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `c_id`, `f_id`, `to_id`, `date`, `state`) VALUES
(275, 'تجربة', 3, 5, 4, '2020-09-23 02:40:43', 0),
(277, 'مرحباً ... أنا قمت بشراء الخدمة التالية <a target=\"_blank\" class=\"msgState\" href=\"https://prideskill.com/istsharh/istsharh/i/تتتتتتتتتتتتتتتتتتتتت/22/\">تتتتتتتتتتتتتتتتتتتتت</a> وإجمالي ما تم دفعه هو <p class=\"p-amount\">10$</p> <p>يجب ان يراسلك البائع حتى تستطيع البدء بتنفيذ الخدمة</p> <p>هذه الرسالة تم إرسالها عن طريق نظام الموقع.</p>', 3, 4, 5, '2020-09-23 02:43:26', 1),
(278, '<p>تم بدأ مشروع</p><p><a target=\"_blank\" class=\"msgState\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19\">تجربة تجربة 111</a></p>', 3, 5, 5, '2020-09-23 06:57:44', 1),
(279, 'لقد تم رفض طلب تسليم الخدمة التالية: <a target=\"_blank\" class=\"msgState\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a><p>والسبب : تجربة تجربة</p>', 3, 4, 5, '2020-09-26 17:18:26', 1),
(280, 'لقد تم رفض طلب تسليم الخدمة التالية: <a target=\"_blank\" class=\"msgState\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a><p>والسبب : ليبلبيابيابيا يبلبيابيا</p>', 3, 4, 5, '2020-09-26 17:22:18', 1),
(281, 'لقد تم رفض طلب تسليم الخدمة التالية: <a target=\"_blank\" class=\"msgState\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a><p>والسبب : fdsfdsfds</p>', 3, 4, 5, '2020-09-26 17:26:40', 1),
(282, 'لقد تم رفض طلب تسليم الخدمة التالية: <a target=\"_blank\" class=\"msgState\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a><p>والسبب : vghbnjm</p>', 3, 4, 5, '2020-09-26 17:30:34', 1),
(283, 'لقد تم رفض طلب تسليم الخدمة التالية: <a target=\"_blank\" class=\"msgState\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a><p>والسبب : vghbnjm</p>', 3, 4, 5, '2020-09-26 17:31:12', 1),
(284, 'لقد تم رفض طلب تسليم الخدمة التالية: <a target=\"_blank\" class=\"msgState\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a><p>والسبب : vghbnjm</p>', 3, 4, 5, '2020-09-26 17:31:55', 1),
(285, 'لقد تم رفض طلب تسليم الخدمة التالية: <a target=\"_blank\" class=\"msgState\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a><p>والسبب : m,,m,m</p>', 3, 4, 5, '2020-09-26 17:32:21', 1),
(286, 'مرحباً ... أنا أود الاستفسار عن عمل مشابه لـ \" <a target=\"_blank\" class=\"msgState\" href=\"https://prideskill.com/istsharh/istsharh/users/p/تجربة-تجربة-تجربة-تجربة-تجربة/1/\">تجربة تجربة تجربة تجربة تجربة</a> \" <p>هذه الرسالة تم إرسالها عن طريق نظام الموقع.</p>', 3, 5, 4, '2020-09-26 22:45:22', 1),
(287, 'مرحباً ... أنا أود الاستفسار عن عمل مشابه لـ \" <a target=\"_blank\" class=\"msgState\" href=\"https://prideskill.com/istsharh/istsharh/users/p/تتتتتتتتتتتتتتتتتتتتت/22/\">تتتتتتتتتتتتتتتتتتتتت</a> \" <p>هذه الرسالة تم إرسالها عن طريق نظام الموقع.</p>', 3, 4, 5, '2020-09-28 22:08:32', 1),
(288, 'مرحباً ... أنا قمت بشراء الخدمة التالية <a target=\"_blank\" class=\"msgState\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> وإجمالي ما تم دفعه هو <p class=\"p-amount\">10$</p> <p>يجب ان يراسلك البائع حتى تستطيع البدء بتنفيذ الخدمة</p> <p>الادارة.</p>', 3, 4, 5, '2020-09-30 07:08:31', 1),
(289, 'مرحباً ... أنا قمت بشراء الخدمة التالية <a target=\"_blank\" class=\"msgState\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> وإجمالي ما تم دفعه هو <p class=\"p-amount\">10$</p> <p>يجب ان يراسلك البائع حتى تستطيع البدء بتنفيذ الخدمة</p> <p>الادارة.</p>', 3, 4, 5, '2020-10-01 08:04:38', 1),
(290, 'مرحباً ... أنا قمت بشراء الخدمة التالية <a target=\"_blank\" class=\"msgState\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> وإجمالي ما تم دفعه هو <p class=\"p-amount\">53$</p> <p>يجب ان يراسلك البائع حتى تستطيع البدء بتنفيذ الخدمة</p> <p>الادارة.</p>', 3, 4, 5, '2020-10-02 01:40:19', 1),
(291, 'مرحباً ... أنا قمت بشراء الخدمة التالية <a target=\"_blank\" class=\"msgState\" href=\"https://prideskill.com/istsharh/istsharh/i/خدمة-خدمة-خدمة-خدمة/15/\">خدمة خدمة خدمة خدمة</a> وإجمالي ما تم دفعه هو <p class=\"p-amount\">53$</p> <p>يجب ان يراسلك البائع حتى تستطيع البدء بتنفيذ الخدمة</p> <p>الادارة.</p>', 3, 4, 5, '2020-10-02 02:39:06', 1),
(292, 'لقد تم رفض طلب تسليم المشروع التالية: <a target=\"_blank\" class=\"msgState\" href=\"https://prideskill.com/istsharh/istsharh/i/تجربة-تجربة-111/19/\">تجربة تجربة 111</a><p>والسبب : مثال مثال</p>', 3, 4, 5, '2020-10-09 16:11:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `clearAmount` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `payerId` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `countryCode` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `u_id` int(10) NOT NULL,
  `date` varchar(255) NOT NULL,
  `paymentId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `amount`, `clearAmount`, `fullName`, `email`, `payerId`, `token`, `countryCode`, `currency`, `state`, `u_id`, `date`, `paymentId`) VALUES
(4, '102.75', '100', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-0D603453HG8218534', 'US', 'USD', 'approved', 3, '2019-09-15 00:53', 'PAYID-LV6WQKQ3LM79453XJ8848813'),
(5, '513.75', '500', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-3CF75533DH1572149', 'US', 'USD', 'approved', 3, '2019-09-15 00:55', 'PAYID-LV6W7PA8XC26903FW606602L'),
(6, '5137.50', '5000', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-2FR901981U100541R', 'US', 'USD', 'approved', 3, '2019-09-15 01:01', 'PAYID-LV6XCDI48T7180492404192M'),
(7, '1027.50', '1000', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-01T22163F0318045K', 'US', 'USD', 'approved', 3, '2019-09-15 12:50', 'PAYID-LV7BOTI1DM080284H4528053'),
(8, '5959.50', '5800', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-2W889917FK943613G', 'US', 'USD', 'approved', 3, '2019-09-15 12:54', 'PAYID-LV7BQSQ82T20090N7643741N'),
(9, '102.75', '100', 'ahmed elhagar', 'ahmed@elhagar.com', '7UPDSPLT5XUJN', 'EC-1U817780HY164441C', 'EG', 'USD', 'approved', 3, '2019-09-15 3:54', 'PAYID-LV7ECLI44201767CC953653P'),
(10, '719.25', '700', 'ahmed elhagar', 'ahmed@elhagar.com', '7UPDSPLT5XUJN', 'EC-3J650598R5526054G', 'EG', 'USD', 'approved', 3, '2019-09-15 3:57', 'PAYID-LV7EGDQ9XV309733H9810134'),
(11, '20.55', '20', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-01D32493LV370620W', 'US', 'USD', 'approved', 3, '2019-09-15 4:45', 'PAYID-LV7E4RA94S76096AD843401B'),
(12, '20.55', '20', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-9AN38543E5241240T', 'US', 'USD', 'approved', 3, '2019-09-15 4:52', 'PAYID-LV7FABQ3M088504F0692210J'),
(13, '20.55', '20', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-8NG165300R1365043', 'US', 'USD', 'approved', 3, '2019-09-15 4:58', 'PAYID-LV7FCZI6P930977E2957912T'),
(14, '20.55', '20', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-3RW85761UH561903N', 'US', 'USD', 'approved', 3, '2019-09-15 5:56', 'PAYID-LV7F6FA4NN8745178605054K'),
(15, '2055.00', '2000', 'ahmed elhagar', 'testbrnameg@email.com', 'RDSFME8AHLHJ8', 'EC-9SU90604DS486170V', 'US', 'USD', 'approved', 3, '2019-09-15 6:04', 'PAYID-LV7GARI45A34292BL411920D'),
(16, '102.75', '100', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-4UB4455046083931E', 'US', 'USD', 'approved', 4, '2019-09-15 6:13', 'PAYID-LV7GF4Q2PN23994D6861950J'),
(17, '20.55', '20', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-4BW50862J55677106', 'US', 'USD', 'approved', 4, '2019-09-15 6:16', 'PAYID-LV7GHOI08726653CN045862V'),
(18, '102.75', '100', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-60R787063Y925235Y', 'US', 'USD', 'approved', 4, '2019-09-15 11:17', 'PAYID-LV7KUGI04V3164403516514E'),
(19, '10.28', '10', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-47B85034BY0728728', 'US', 'USD', 'approved', 4, '2019-09-17 1:39', 'PAYID-LWAMLWI90D30787G9921512W'),
(20, '11.30', '11', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-1SG789331U768503J', 'US', 'USD', 'approved', 4, '2019-09-17 1:45', 'PAYID-LWAMOIA6P263620YS324182W'),
(21, '13.36', '13', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-0RY40756ML843533G', 'US', 'USD', 'approved', 4, '2019-09-17 9:59', 'PAYID-LWATV3Q8D882257KF655721C'),
(22, '1027.50', '1000', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-49K383236P558294D', 'US', 'USD', 'approved', 4, '2019-09-19 01:30', 'PAYID-LWBL3QY3MC018904U4803033'),
(23, '11.30', '11', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-5RX848770M097371X', 'US', 'USD', 'approved', 4, '2019-09-22 2:45', 'PAYID-LWDWZNI44C22585FS3752639'),
(24, '102748.97', '99999', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-80960418YJ0944832', 'US', 'USD', 'approved', 4, '2020-01-15 12:17', 'PAYID-LYPOM2Y9YK89315WC802312P'),
(25, '10.28', '10', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-9BB19745H81478126', 'US', 'USD', 'approved', 4, '2020-01-25 3:49', 'PAYID-LYWEN6A9NB68938X8048734V'),
(26, '10.28', '10', 'John Doe', 'sb-ib3ap2295822@personal.example.com', 'MP84WK93X8UAY', 'EC-3J786882MN1978946', 'JO', 'USD', 'approved', 5, '2020-08-01 5:46', 'PAYID-L4SY4IQ12G687541T998773G'),
(27, '102.75', '100', 'John Doe', 'sb-ib3ap2295822@personal.example.com', 'MP84WK93X8UAY', 'EC-0CG57884JJ0720705', 'JO', 'USD', 'approved', 6, '2020-08-02 11:38', 'PAYID-L4TISYI6PT44700TW627280S'),
(28, '20.55', '20', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-56R29673EU601342G', 'US', 'USD', 'approved', 4, '2020-10-01 12:23', 'PAYID-L5224AQ57S85275XW547520T'),
(29, '56.51', '55', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-82X26782SM217592N', 'US', 'USD', 'approved', 4, '2020-10-02 01:40', 'PAYID-L53GREQ9UX77754L06815103'),
(30, '102.75', '100', 'mohamed test', 'mohamed@brnameg.com', 'QHJVC2G5YLLWQ', 'EC-0T24720310230013R', 'US', 'USD', 'approved', 4, '2020-10-02 02:34', 'PAYID-L53HLDY3UV98803G2570400N');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `images` text NOT NULL,
  `ytlink` varchar(255) DEFAULT NULL,
  `duration` int(10) DEFAULT NULL,
  `tags` text NOT NULL,
  `affiliate` int(10) NOT NULL,
  `tag_id` int(10) NOT NULL,
  `date` varchar(255) NOT NULL,
  `file_id` varchar(255) NOT NULL,
  `u_id` int(10) NOT NULL,
  `state` int(10) NOT NULL,
  `kind` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `title`, `content`, `images`, `ytlink`, `duration`, `tags`, `affiliate`, `tag_id`, `date`, `file_id`, `u_id`, `state`, `kind`) VALUES
(1, 'موقع كذا موقع كذا', '<p>موقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذاموقع كذا</p>\r\n', 'be7254d772010f5ff5a3fa0636c9a99e_thumb.jpg,ea2ff5795fe7ac68e5fd57643a98b77c_thumb.jpg,69cab59ead9e19e93aeb7f3e89c96330_thumb.jpg,9b8936bc84188bbd399dda27ded38ca1_thumb.jpg', '', 10, 'موقع كذا', 0, 2, '2020-08-28 13:23:10', 'fdgfdgd', 4, 1, 1),
(2, 'موقع استشارة للخدمات', '<p>موقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدماتموقع استشارة للخدمات.</p>\r\n', 'e3196ec9d5c0565d70ae7356cc8001a4_thumb.jpg,f0b1a26cc4dbba2c3d02ad29ba3c7fcf_thumb.jpg,581532705b37bcc2c8c96a96e3800295_thumb.jpg,54a731192e8a77710cfde3472fbd0596_thumb.jpg', '', 10, 'موقع استشارة للخدمات', 0, 2, '2020-08-29 04:49:17', '7f5f35a07e2fe470aa44e5b7914aa4c0.jpg', 4, 1, 1),
(3, 'تجربة عمل جديد', '<p>تجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديدتجربة عمل جديد</p>\r\n', 'e9bb44041023342b88fd57e14d3114e0_thumb.jpg', '', 10, 'تجربة عمل جديد', 0, 2, '2020-09-04 22:24:01', '0', 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `promsg`
--

CREATE TABLE `promsg` (
  `id` int(10) NOT NULL,
  `caseMsg` varchar(255) NOT NULL,
  `s_id` int(10) NOT NULL COMMENT 'Project Owner',
  `u_id` int(10) NOT NULL,
  `i_id` int(10) NOT NULL,
  `date` varchar(255) NOT NULL,
  `state` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promsg`
--

INSERT INTO `promsg` (`id`, `caseMsg`, `s_id`, `u_id`, `i_id`, `date`, `state`) VALUES
(3, 'ended', 4, 5, 1, '2020-08-09 18:05:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `id` int(10) NOT NULL,
  `u_id` int(10) NOT NULL,
  `i_id` int(10) NOT NULL,
  `pro_rate` int(10) DEFAULT NULL,
  `con_rate` int(10) DEFAULT NULL,
  `qua_rate` int(10) DEFAULT NULL,
  `exp_rate` int(10) DEFAULT NULL,
  `date_rate` int(10) DEFAULT NULL,
  `again_rate` int(10) DEFAULT NULL,
  `comment` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `s_id` int(10) NOT NULL,
  `rp_id` int(10) NOT NULL COMMENT 'Requestedgigs OR Promsg id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`id`, `u_id`, `i_id`, `pro_rate`, `con_rate`, `qua_rate`, `exp_rate`, `date_rate`, `again_rate`, `comment`, `date`, `s_id`, `rp_id`) VALUES
(1, 4, 15, 5, 1, 1, 5, 1, 5, 'ممتاز', '2020-08-19 02:16:29', 5, 17),
(2, 4, 15, 1, 1, 1, 5, 5, 5, 'تجربة', '2020-08-19 17:26:23', 5, 15),
(3, 4, 15, 5, 5, 5, 5, 5, 5, 'شكراً', '2020-08-30 14:28:22', 5, 20),
(4, 4, 15, 5, 3, 5, 4, 3, 4, 'تجربة تجربة', '2020-09-01 16:43:15', 5, 21),
(5, 4, 15, 3, 3, 3, 3, 3, 3, 'شكرا', '2020-09-05 09:23:23', 5, 22),
(6, 4, 15, 1, 1, 1, 1, 1, 1, 'تمام', '2020-09-05 10:12:38', 5, 23),
(7, 4, 15, 5, 4, 5, 4, 4, 5, '', '2020-09-14 03:45:10', 5, 186),
(8, 4, 22, 5, 5, 5, 5, 5, 5, 'hjkm', '2020-09-25 02:52:19', 5, 192),
(9, 4, 22, 5, 5, 5, 5, 5, 5, 'hjnmk', '2020-09-25 02:53:33', 5, 193),
(10, 4, 15, 5, 5, 5, 5, 4, 4, '', '2020-09-29 10:25:49', 5, 191);

-- --------------------------------------------------------

--
-- Table structure for table `requestedbalance`
--

CREATE TABLE `requestedbalance` (
  `id` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `u_id` int(10) NOT NULL,
  `state` int(10) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requestedbalance`
--

INSERT INTO `requestedbalance` (`id`, `amount`, `email`, `u_id`, `state`, `date`) VALUES
(2, 500, '08.ahmed.elhagar@gmail.com', 5, 1, '2020-08-30 21:42:27'),
(3, 200, '08.ahmed.elhagar@gmail.com', 4, 0, '2020-09-01 18:33:25');

-- --------------------------------------------------------

--
-- Table structure for table `requestedgigs`
--

CREATE TABLE `requestedgigs` (
  `id` int(10) NOT NULL,
  `i_id` int(10) NOT NULL,
  `u_id` int(10) NOT NULL,
  `s_id` int(10) NOT NULL,
  `ui_ids` varchar(255) DEFAULT NULL,
  `ui_rep` varchar(255) DEFAULT NULL,
  `amount` int(10) NOT NULL,
  `date` varchar(255) NOT NULL,
  `state` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requestedgigs`
--

INSERT INTO `requestedgigs` (`id`, `i_id`, `u_id`, `s_id`, `ui_ids`, `ui_rep`, `amount`, `date`, `state`) VALUES
(191, 15, 4, 5, '0, 1, ', '3, 7, ', 132, '2020-09-29 10:25:34', 2),
(192, 22, 4, 5, NULL, NULL, 10, '2020-09-25 02:51:08', 2),
(193, 15, 4, 5, NULL, NULL, 10, '2020-09-30 07:08:35', 0),
(194, 15, 4, 5, NULL, NULL, 10, '2020-10-01 08:04:42', 0),
(195, 15, 4, 5, '0, 1, ', '2, 3, ', 53, '2020-10-02 01:40:23', 0),
(196, 15, 4, 5, '0, 1, ', '2, 3, ', 53, '2020-10-02 02:39:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `show_state` int(10) NOT NULL,
  `head` text DEFAULT NULL,
  `body` text DEFAULT NULL,
  `icon` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `percent` int(10) NOT NULL,
  `pause` int(10) NOT NULL,
  `template` text NOT NULL,
  `gigs` text DEFAULT NULL,
  `projects` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `facebook`, `twitter`, `instagram`, `email`, `show_state`, `head`, `body`, `icon`, `logo`, `percent`, `pause`, `template`, `gigs`, `projects`) VALUES
(1, '#', '#', '#', 'admin@istsharh.com', 1, '', '', 'https://prideskill.com/istsharh/istsharh/vendor/uploads/33c25014b2eeffde68eb3cfe386b29b5.ico', 'https://prideskill.com/istsharh/istsharh/vendor/uploads/789f2a86715614b27b158e464266a708.png', 15, 15, '<div style=\"border-bottom:1px solid #dddddd; font-size:18px; height:30px; margin-bottom:0px; margin-left:0px; margin-right:0px; margin-top:0px; padding:25px; text-align:left; width:90%\"><img src=\"SystemBaseUrlvendor/images/logo.png\" style=\"display:block; margin:auto; width:140px\" />\r\n<div style=\"clear:both; direction:rtl; float:right; text-align:right; width:100%\">\r\n<h4>أهلاً SystemUserName<br />\r\nSystemTitle</h4>\r\n\r\n<h5 style=\"text-align:center\">SystemDescription</h5>\r\n</div>\r\n</div>\r\n', '15,22', '3,18');

-- --------------------------------------------------------

--
-- Table structure for table `site_blocks`
--

CREATE TABLE `site_blocks` (
  `id` int(10) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` varchar(255) CHARACTER SET utf8 NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `state` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_blocks`
--

INSERT INTO `site_blocks` (`id`, `title`, `content`, `link`, `state`) VALUES
(10, 'تصميم شعارات', 'ابني علامتك التجارية', '#', 1),
(11, 'تواصل اجتماعي', 'احصل على المزيد من العملاء', '#', 1),
(12, 'تعليق صوتي', 'افضل الأصوات', '#', 1),
(13, 'الترجمة', 'كن عالمي', '#', 1),
(14, 'اعمال فنية', 'لون أحلامك', '#', 1),
(15, 'هندسة', 'ابني حياتك', '#', 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_pages`
--

CREATE TABLE `site_pages` (
  `id` int(10) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 DEFAULT NULL,
  `state` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_pages`
--

INSERT INTO `site_pages` (`id`, `title`, `content`, `state`) VALUES
(4, 'حول استشارة', 'ابالباب', 1),
(5, 'اعرف كيف نضمن حقوقك', NULL, 1),
(6, 'الأسئلة الشائعة', NULL, 1),
(7, 'المستويات', '<p>أصحاب التقييم 0 -&nbsp;لم&nbsp;يحصل&nbsp;على&nbsp;فرصة&nbsp;بعد</p>\r\n\r\n<p>أصحاب التقييم من 0.1 حتى 2 -&nbsp;بائع&nbsp;ضعيف</p>\r\n\r\n<p>أصحاب التقييم من 2.1 حتى 4 -&nbsp;بائع&nbsp;مميز</p>\r\n\r\n<p>أصحاب التقييم من 4.1 حتى 5 -&nbsp;بائع&nbsp;محترف</p>\r\n', 1),
(8, 'بيان الخصوصية', NULL, 1),
(9, 'شروط الإستخدام', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(10) NOT NULL,
  `skill` varchar(255) NOT NULL,
  `u_id` int(10) DEFAULT NULL,
  `state` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `skill`, `u_id`, `state`) VALUES
(1, 'HTML', NULL, 0),
(2, 'CSS', NULL, 0),
(3, 'PHP', NULL, 0),
(142, 'Codeigniter', NULL, 0),
(140, 'CSS', 4, 1),
(126, 'eeee', 4, 1),
(125, 'ccc', 4, 1),
(123, 'hhh', 4, 1),
(119, 'Hypre', 4, 1),
(118, 'hhhhk', 4, 1),
(68, '845h', 4, 1),
(69, 'hehe', 4, 1),
(117, 'hh22', 4, 1),
(71, 'ggg', 4, 1),
(72, 'fff', 4, 1),
(73, 'test', 4, 1),
(94, 'HTML', 4, 1),
(95, 'iii', 4, 1),
(96, 'bbb', 4, 1),
(122, 'PHP', 4, 1),
(99, 'oooo', 4, 1),
(103, 'aaa', 4, 1),
(101, 'tttt', 4, 1),
(102, 'lllll', 4, 1),
(129, 'HTML', 5, 1),
(130, 'PHP', 5, 1),
(143, 'Codeigniter', 5, 1),
(144, 'Java', NULL, 0),
(138, 'CSS', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stoppedbill`
--

CREATE TABLE `stoppedbill` (
  `id` int(10) NOT NULL,
  `i_id` int(10) NOT NULL,
  `paid` varchar(255) NOT NULL,
  `remaining` varchar(255) NOT NULL,
  `u_id` int(10) NOT NULL,
  `date` varchar(255) NOT NULL,
  `ui_ids` text DEFAULT NULL,
  `ui_rep` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stoppedbill`
--

INSERT INTO `stoppedbill` (`id`, `i_id`, `paid`, `remaining`, `u_id`, `date`, `ui_ids`, `ui_rep`) VALUES
(1, 22, '10970', '989030', 4, '2020-10-01 08:00:54', NULL, NULL),
(2, 15, '10970', '150111261', 4, '2020-10-01 08:02:12', '0, 1, ', '10000000, 11111, '),
(3, 15, '10960', '1609989050', 4, '2020-10-01 08:05:15', '0, 1, ', '100000000, 10000000, ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postal` varchar(255) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `ip` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `a_balance` varchar(255) DEFAULT NULL,
  `ads_balance` varchar(255) DEFAULT NULL,
  `c_balance` varchar(255) NOT NULL,
  `date` varchar(100) NOT NULL,
  `state` int(4) NOT NULL,
  `all_balance` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `l_logout` varchar(255) NOT NULL,
  `oauth_provider` varchar(255) DEFAULT NULL,
  `oauth_uid` varchar(255) DEFAULT NULL,
  `fb_access_token` text DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `pulse` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `password`, `email`, `country`, `mobile`, `address`, `postal`, `about`, `ip`, `balance`, `a_balance`, `ads_balance`, `c_balance`, `date`, `state`, `all_balance`, `image`, `l_logout`, `oauth_provider`, `oauth_uid`, `fb_access_token`, `created`, `modified`, `rate`, `active`, `pulse`) VALUES
(4, 'ahmedelhagar', 'Ahmed', 'Elhagar', 'fafecf1bf3ddf8d9af189a8b40989ebccaf04f4f61bd6d7824c8f84fa50938b06bffa08fc0cb7492149a8a36a25907ea8656b31a1ffa6c0ad5442b634bfa110f/gCdcVToZKe3dXztEJV/ER6TDIkEfctPOjzKq7mmDOs=', 'ahmedelhagar74@gmail.com', 'EG', '1065007516', '19 Eltahrer Street', '13763', 'مصمم و مبرمج مواقع باستخدام اطار عمل codeigniter و مسوق رقمي مُعتمد من شركة جوجل .\r\n\r\nتجربة.\r\n\r\nhttps://mail.google.com/mail/u/0/#inbox\r\n\r\nالرابط الثاني\r\nhttps://mostaql.com/projects\r\nhttps://www.php.net/manual/en/function.str-replace.php\r\n\r\nhttps://stackoverflow.com/questions/36564293/extract-urls-from-a-string-using-php\r\n\r\nالرابط الثالث\r\nhttps://www.google.com/\r\n\r\nhttps://www.php.net/manual/en/function.str-replace.php', '::1', '49', '0', '0', '11974', '2020-09-02', 1, '12023', '7062a0321e910fe33705155371d09d2d_thumb.jpg', '2020-10-09 3:02', 'google', '115600207559033304196', '', NULL, '2020-09-02 02:14:25', '0', 1, '2020-10-09 15:02:29'),
(5, 'ahmedabdooooo', 'ahmed', 'elhagar', '1274cf5787b04b2e666a6a3e5f5acb915b35b9bfadf5a930b3c3cdbc654822873f4f8f9816c96f6fc346f175fc6c83580aef644b7655cecff5b69e671ba9a087sqfAESCCclmsT3MkxiSlCKwHOBi/qEEMmJbdyLajCXQ=', '08.ahmed.elhagar@gmail.com', 'EG', '1065007516', 'Eltahrer Street', '13763', NULL, '::1', '0', '327', '0', '209.2', '2020-09-02', 1, '536.2', '', '2020-09-29 09:51', 'google', '115858266752302737005', '', NULL, '2020-09-02 13:26:58', NULL, 1, '2020-10-09 16:25:59'),
(6, 'buyerjo2020', 'محمد', 'مشتري', '86f42dab460243fbe73aeffdd24708a4bbffeb8c4620f5b1e1ae8b2c230c8961538879c20b532bd6550635956f4bed1b5818e03a94ce9180f2c08583666ba1bc2b4EW5TQKke7BQGiGyG/IAldkh0+QNMyWH9/lxryNn0=', 'mynotegigi@gmail.com', 'JO', '0', 'العنوان الاردن', '01234', 'مرحبا بكم في صفحتي\r\nأنا محمد سليمان، من المملكة الاردنية الهاشمية، هذا الحساب تجريبي، وهذه نسخة للعرض فقط، أنا محمد سليمان، من المملكة الاردنية الهاشمية، هذا الحساب تجريبي، وهذه نسخة للعرض فقط، أنا محمد سليمان، من المملكة الاردنية الهاشمية، هذا الحساب تجريبي، وهذه نسخة للعرض فقط، أنا محمد سليمان، من المملكة الاردنية الهاشمية، هذا الحساب تجريبي، وهذه نسخة للعرض فقط، أنا محمد سليمان، من المملكة الاردنية الهاشمية، هذا الحساب تجريبي، وهذه نسخة للعرض فقط، \r\nأنا محمد سليمان، من المملكة الاردنية الهاشمية، هذا الحساب تجريبي، وهذه نسخة للعرض فقط، أنا محمد سليمان، من المملكة الاردنية الهاشمية، هذا الحساب تجريبي، وهذه نسخة للعرض فقط، أنا محمد سليمان، من المملكة الاردنية الهاشمية، هذا الحساب تجريبي، وهذه نسخة للعرض فقط، \r\n\r\nأنا محمد سليمان، من المملكة الاردنية الهاشمية، هذا الحساب تجريبي، وهذه نسخة للعرض فقط، أنا محمد سليمان، من المملكة الاردنية الهاشمية، هذا الحساب تجريبي، وهذه نسخة للعرض فقط، \r\nأنا محمد سليمان، من المملكة الاردنية الهاشمية، هذا الحساب تجريبي، وهذه نسخة للعرض فقط، أنا محمد سليمان، من المملكة الاردنية الهاشمية، هذا الحساب تجريبي، وهذه نسخة للعرض فقط، أنا محمد سليمان، من المملكة الاردنية الهاشمية، هذا الحساب تجريبي، وهذه نسخة للعرض فقط، \r\n', '46.153.94.198', '100', '0', '0', '0', '2020-08-02', 1, '100', '', '2020-08-02 11:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2020-09-17 04:05:48'),
(7, 'sellerjo2020', 'بائع', 'مستقل', '634ea791df34f8b008fc17bf2e88fdfc3b666f32d459e13a6e543f9104ead9acb3fdf3b38e30bb80e36898af93ffcda429ea77c0f6e520afdd128511daa7139ad0YCPGlOZyx5OTk0fQiqu89VIpeqjcO5J3FxN2+9dv4=', 'khhawwa1@gmail.com', 'SA', '0', 'الرياض', '11535', 'مرحبا بكم، انا سامي بائع مستقل من السعودية اقدم خدمات متعددة، هذا النص تجريبي فقط لفحص النظام، انا سامي بائع مستقل من السعودية اقدم خدمات متعددة، هذا النص تجريبي فقط لفحص النظام، انا سامي بائع مستقل من السعودية اقدم خدمات متعددة، هذا النص تجريبي فقط لفحص النظام، \r\nانا سامي بائع مستقل من السعودية اقدم خدمات متعددة، هذا النص تجريبي فقط لفحص النظام، \r\nانا سامي بائع مستقل من السعودية اقدم خدمات متعددة، هذا النص تجريبي فقط لفحص النظام، انا سامي بائع مستقل من السعودية اقدم خدمات متعددة، هذا النص تجريبي فقط لفحص النظام، انا سامي بائع مستقل من السعودية اقدم خدمات متعددة، هذا النص تجريبي فقط لفحص النظام، انا سامي بائع مستقل من السعودية اقدم خدمات متعددة، هذا النص تجريبي فقط لفحص النظام، \r\nانا سامي بائع مستقل من السعودية اقدم خدمات متعددة، هذا النص تجريبي فقط لفحص النظام، انا سامي بائع مستقل من السعودية اقدم خدمات متعددة، هذا النص تجريبي فقط لفحص النظام، \r\n\r\nانا سامي بائع مستقل من السعودية اقدم خدمات متعددة، هذا النص تجريبي فقط لفحص النظام، انا سامي بائع مستقل من السعودية اقدم خدمات متعددة، هذا النص تجريبي فقط لفحص النظام، انا سامي بائع مستقل من السعودية اقدم خدمات متعددة، هذا النص تجريبي فقط لفحص النظام، انا سامي بائع مستقل من السعودية اقدم خدمات متعددة، هذا النص تجريبي فقط لفحص النظام، ', '46.153.94.198', '0', '0', '0', '0', '2020-08-02', 1, '0', '', '2020-08-02 11:02', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-09-28 09:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `users_activation`
--

CREATE TABLE `users_activation` (
  `id` int(10) NOT NULL,
  `u_id` int(10) NOT NULL,
  `code` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `state` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_activation`
--

INSERT INTO `users_activation` (`id`, `u_id`, `code`, `time`, `state`) VALUES
(16, 4, 'lxKUMChKrvaRcw8D8R5K68w03VyooqG', '2020-10-01 06:04:22', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cartgu`
--
ALTER TABLE `cartgu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cdata`
--
ALTER TABLE `cdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `community`
--
ALTER TABLE `community`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `c_balance`
--
ALTER TABLE `c_balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `editedbid`
--
ALTER TABLE `editedbid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gigupdates`
--
ALTER TABLE `gigupdates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promsg`
--
ALTER TABLE `promsg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requestedbalance`
--
ALTER TABLE `requestedbalance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requestedgigs`
--
ALTER TABLE `requestedgigs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_blocks`
--
ALTER TABLE `site_blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_pages`
--
ALTER TABLE `site_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stoppedbill`
--
ALTER TABLE `stoppedbill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_activation`
--
ALTER TABLE `users_activation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=296;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cartgu`
--
ALTER TABLE `cartgu`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cdata`
--
ALTER TABLE `cdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `community`
--
ALTER TABLE `community`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `c_balance`
--
ALTER TABLE `c_balance`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `editedbid`
--
ALTER TABLE `editedbid`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `gigupdates`
--
ALTER TABLE `gigupdates`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `promsg`
--
ALTER TABLE `promsg`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `requestedbalance`
--
ALTER TABLE `requestedbalance`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requestedgigs`
--
ALTER TABLE `requestedgigs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_blocks`
--
ALTER TABLE `site_blocks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `site_pages`
--
ALTER TABLE `site_pages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `stoppedbill`
--
ALTER TABLE `stoppedbill`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users_activation`
--
ALTER TABLE `users_activation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
