-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.38 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET NAMES utf8 */
;
/*!50503 SET NAMES utf8mb4 */
;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */
;
/*!40103 SET TIME_ZONE='+00:00' */
;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;

-- Dumping database structure for dsalms2
CREATE DATABASE IF NOT EXISTS `dsalms2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `dsalms2`;

-- Dumping structure for table dsalms2.adbanners
CREATE TABLE IF NOT EXISTS `adbanners` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `caption` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `status` tinyint(1) NOT NULL DEFAULT '1',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.adbanners: ~0 rows (approximately)

-- Dumping structure for table dsalms2.banners
CREATE TABLE IF NOT EXISTS `banners` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `status` tinyint(1) NOT NULL DEFAULT '1',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.banners: ~0 rows (approximately)

-- Dumping structure for table dsalms2.batches
CREATE TABLE IF NOT EXISTS `batches` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `course_id` bigint unsigned NOT NULL,
    `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `start_date` date DEFAULT NULL,
    `end_date` date DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `batches_course_id_foreign` (`course_id`),
    CONSTRAINT `batches_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.batches: ~0 rows (approximately)

-- Dumping structure for table dsalms2.blogs
CREATE TABLE IF NOT EXISTS `blogs` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `content` text COLLATE utf8mb4_general_ci NOT NULL,
    `media_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'image',
    `media_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `status` tinyint(1) NOT NULL DEFAULT '1',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.blogs: ~0 rows (approximately)

-- Dumping structure for table dsalms2.bookings
CREATE TABLE IF NOT EXISTS `bookings` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `customer_id` bigint unsigned NOT NULL,
    `course_id` bigint unsigned NOT NULL,
    `payment_status` enum('half', 'full') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'half',
    `payment_method` enum('Card', 'Bank Transfer') COLLATE utf8mb4_general_ci NOT NULL,
    `receipt_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `bank_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `bank_branch` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `transfer_date` date DEFAULT NULL,
    `status` enum(
        'Pending',
        'Confirmed',
        'Cancelled'
    ) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
    `admin_notes` text COLLATE utf8mb4_general_ci,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `reference` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `bookings_reference_unique` (`reference`),
    KEY `bookings_customer_id_foreign` (`customer_id`),
    KEY `bookings_course_id_foreign` (`course_id`),
    CONSTRAINT `bookings_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE,
    CONSTRAINT `bookings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`user_id`) ON DELETE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.bookings: ~0 rows (approximately)
INSERT INTO
    `bookings` (
        `id`,
        `customer_id`,
        `course_id`,
        `payment_status`,
        `payment_method`,
        `receipt_path`,
        `bank_name`,
        `bank_branch`,
        `transfer_date`,
        `status`,
        `admin_notes`,
        `created_at`,
        `updated_at`,
        `reference`
    )
VALUES (
        1,
        1,
        9,
        'half',
        'Card',
        NULL,
        NULL,
        NULL,
        NULL,
        'Pending',
        NULL,
        '2025-06-13 09:02:43',
        '2025-06-13 09:02:43',
        'DSA_684be92c20d2d'
    );

-- Dumping structure for table dsalms2.branches
CREATE TABLE IF NOT EXISTS `branches` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `phone` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.branches: ~0 rows (approximately)

-- Dumping structure for table dsalms2.cache
CREATE TABLE IF NOT EXISTS `cache` (
    `key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `value` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
    `expiration` int NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.cache: ~0 rows (approximately)

-- Dumping structure for table dsalms2.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
    `key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `owner` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `expiration` int NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.cache_locks: ~0 rows (approximately)

-- Dumping structure for table dsalms2.call_centers
CREATE TABLE IF NOT EXISTS `call_centers` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `phone_number` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.call_centers: ~0 rows (approximately)

-- Dumping structure for table dsalms2.courses
CREATE TABLE IF NOT EXISTS `courses` (
    `course_id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `description` text COLLATE utf8mb4_general_ci,
    `duration` int NOT NULL,
    `total_price` decimal(10, 2) NOT NULL,
    `first_payment` decimal(10, 2) NOT NULL,
    `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `video_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `mode` enum('online', 'offline', 'hybrid') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'online',
    `branch_id` bigint unsigned DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`course_id`),
    KEY `courses_branch_id_foreign` (`branch_id`),
    CONSTRAINT `courses_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 12 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.courses: ~0 rows (approximately)
INSERT INTO
    `courses` (
        `course_id`,
        `name`,
        `description`,
        `duration`,
        `total_price`,
        `first_payment`,
        `image`,
        `video_link`,
        `location`,
        `mode`,
        `branch_id`,
        `created_at`,
        `updated_at`
    )
VALUES (
        9,
        'Course 01',
        '<ul><li><strong>Content 01</strong></li><li><strong>Content 02</strong></li><li><strong>Content 03</strong></li><li><strong>Content 04</strong></li></ul><p><br></p><p><strong>Hello World..!  </strong><strong style="color: rgb(255, 153, 0);">This is sri Lanka</strong></p>',
        60,
        15000.00,
        10000.00,
        'uploads/courses/1743332401.jpeg',
        'https://www.youtube.com/watch?v=GlAhj5zmEAE',
        'Main Street , Moratuwa',
        'hybrid',
        2,
        '2025-03-30 05:30:01',
        '2025-05-06 03:31:20'
    ),
    (
        10,
        'Course 02',
        '<p>Hello World</p>',
        30,
        60000.00,
        15000.00,
        'uploads/courses/1743334358.jpeg',
        NULL,
        NULL,
        'online',
        NULL,
        '2025-03-30 06:02:38',
        '2025-03-30 06:02:38'
    ),
    (
        11,
        'Course 03',
        '<p><strong>Hello</strong></p>',
        32,
        95000.00,
        25000.00,
        'uploads/courses/1743344126.png',
        NULL,
        'Main Street , Moratuwa',
        'offline',
        2,
        '2025-03-30 08:45:26',
        '2025-03-30 08:45:26'
    );

-- Dumping structure for table dsalms2.course_files
CREATE TABLE IF NOT EXISTS `course_files` (
    `file_id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `course_id` bigint unsigned NOT NULL,
    `file_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `file_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`file_id`),
    KEY `course_files_course_id_foreign` (`course_id`),
    CONSTRAINT `course_files_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.course_files: ~0 rows (approximately)

-- Dumping structure for table dsalms2.course_file_batch
CREATE TABLE IF NOT EXISTS `course_file_batch` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `course_file_id` bigint unsigned NOT NULL,
    `batch_id` bigint unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `course_file_batch_course_file_id_foreign` (`course_file_id`),
    KEY `course_file_batch_batch_id_foreign` (`batch_id`),
    CONSTRAINT `course_file_batch_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
    CONSTRAINT `course_file_batch_course_file_id_foreign` FOREIGN KEY (`course_file_id`) REFERENCES `course_files` (`file_id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.course_file_batch: ~0 rows (approximately)

-- Dumping structure for table dsalms2.course_recordings
CREATE TABLE IF NOT EXISTS `course_recordings` (
    `recording_id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `course_id` bigint unsigned NOT NULL,
    `week_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `recording_url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`recording_id`),
    KEY `course_recordings_course_id_foreign` (`course_id`),
    CONSTRAINT `course_recordings_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.course_recordings: ~0 rows (approximately)

-- Dumping structure for table dsalms2.course_recording_batch
CREATE TABLE IF NOT EXISTS `course_recording_batch` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `course_recording_id` bigint unsigned NOT NULL,
    `batch_id` bigint unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `course_recording_batch_course_recording_id_foreign` (`course_recording_id`),
    KEY `course_recording_batch_batch_id_foreign` (`batch_id`),
    CONSTRAINT `course_recording_batch_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
    CONSTRAINT `course_recording_batch_course_recording_id_foreign` FOREIGN KEY (`course_recording_id`) REFERENCES `course_recordings` (`recording_id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.course_recording_batch: ~0 rows (approximately)

-- Dumping structure for table dsalms2.course_zoom_links
CREATE TABLE IF NOT EXISTS `course_zoom_links` (
    `zoom_link_id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `course_id` bigint unsigned NOT NULL,
    `week_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `zoom_link` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`zoom_link_id`),
    KEY `course_zoom_links_course_id_foreign` (`course_id`),
    CONSTRAINT `course_zoom_links_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.course_zoom_links: ~0 rows (approximately)

-- Dumping structure for table dsalms2.course_zoom_link_batch
CREATE TABLE IF NOT EXISTS `course_zoom_link_batch` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `course_zoom_link_id` bigint unsigned NOT NULL,
    `batch_id` bigint unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `course_zoom_link_batch_course_zoom_link_id_foreign` (`course_zoom_link_id`),
    KEY `course_zoom_link_batch_batch_id_foreign` (`batch_id`),
    CONSTRAINT `course_zoom_link_batch_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
    CONSTRAINT `course_zoom_link_batch_course_zoom_link_id_foreign` FOREIGN KEY (`course_zoom_link_id`) REFERENCES `course_zoom_links` (`zoom_link_id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.course_zoom_link_batch: ~0 rows (approximately)

-- Dumping structure for table dsalms2.customers
CREATE TABLE IF NOT EXISTS `customers` (
    `user_id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `fname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `lname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `sponsor_id` bigint unsigned DEFAULT NULL,
    `left_child_id` bigint unsigned DEFAULT NULL,
    `right_child_id` bigint unsigned DEFAULT NULL,
    `total_left_points` int NOT NULL DEFAULT '0',
    `total_right_points` int NOT NULL DEFAULT '0',
    `active_left_points` int NOT NULL DEFAULT '0',
    `active_right_points` int NOT NULL DEFAULT '0',
    `used_left_points` int NOT NULL DEFAULT '0',
    `used_right_points` int NOT NULL DEFAULT '0',
    `is_first_time_withdrawal` tinyint(1) NOT NULL DEFAULT '0',
    `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `contact_number` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `kyc_doc_type` enum('NIC', 'DL', 'Passport') COLLATE utf8mb4_general_ci DEFAULT NULL,
    `kyc_doc_number` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `kyc_doc_front` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `kyc_doc_back` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `kyc_status` enum(
        'pending',
        'approved',
        'rejected'
    ) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `street` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `city` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `district` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `postal_code` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `bank_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `bank_branch` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `account_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `account_number` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `account_type` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `invite_code` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `is_side_selected` tinyint(1) NOT NULL DEFAULT '0',
    `left_side_points` int NOT NULL DEFAULT '0',
    `right_side_points` int NOT NULL DEFAULT '0',
    `is_verified` tinyint(1) NOT NULL DEFAULT '0',
    `verification_code` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `stu_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `batch_id` bigint unsigned DEFAULT NULL,
    `status` tinyint(1) NOT NULL DEFAULT '0',
    `email_verified_at` timestamp NULL DEFAULT NULL,
    `remember_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`user_id`),
    UNIQUE KEY `customers_email_unique` (`email`),
    UNIQUE KEY `customers_contact_number_unique` (`contact_number`),
    UNIQUE KEY `customers_stu_id_unique` (`stu_id`),
    UNIQUE KEY `customers_invite_code_unique` (`invite_code`),
    KEY `customers_batch_id_foreign` (`batch_id`),
    CONSTRAINT `customers_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 10 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.customers: ~0 rows (approximately)
INSERT INTO
    `customers` (
        `user_id`,
        `name`,
        `fname`,
        `lname`,
        `email`,
        `password`,
        `sponsor_id`,
        `left_child_id`,
        `right_child_id`,
        `total_left_points`,
        `total_right_points`,
        `active_left_points`,
        `active_right_points`,
        `used_left_points`,
        `used_right_points`,
        `is_first_time_withdrawal`,
        `address`,
        `contact_number`,
        `kyc_doc_type`,
        `kyc_doc_number`,
        `kyc_doc_front`,
        `kyc_doc_back`,
        `kyc_status`,
        `street`,
        `city`,
        `district`,
        `postal_code`,
        `bank_name`,
        `bank_branch`,
        `account_name`,
        `account_number`,
        `account_type`,
        `invite_code`,
        `is_side_selected`,
        `left_side_points`,
        `right_side_points`,
        `is_verified`,
        `verification_code`,
        `stu_id`,
        `batch_id`,
        `status`,
        `email_verified_at`,
        `remember_token`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        'asd1',
        'Kalu',
        'asd',
        'manula@gmail.com',
        '$2y$12$Bz.xdFi98Nl7KtZS7Pb4PeN1FhIwNKgxCJJcs2VgAgwhi.Xo9JNoe',
        NULL,
        2,
        3,
        2,
        1,
        0,
        0,
        1,
        1,
        1,
        '123/ colombo1212',
        '0234234324',
        'NIC',
        '1234',
        'kyc/XDjJHMkwgWvlHire7Zs8BesbMXd0Y33D2w45kDIw.png',
        'kyc/xybFkPDJnNsV1TnpzYTey3NR1b6NcXuMU6T1OoY4.png',
        'approved',
        'fsd',
        'fsdf',
        '123',
        'fsd',
        'abc',
        'aabc',
        'abc',
        'abc',
        NULL,
        'yZfb',
        0,
        1,
        0,
        0,
        NULL,
        NULL,
        NULL,
        1,
        NULL,
        NULL,
        '2025-06-03 23:23:14',
        '2025-06-16 04:50:07'
    ),
    (
        2,
        'mm1',
        'mm',
        '11',
        'm11@gmail.com',
        '$2y$12$9qEdZEVjpTm948DpKvhcwev8Vk9VIOPLPNqOIOTjFzyK6ov/g.oY2',
        1,
        9,
        NULL,
        1,
        0,
        0,
        0,
        0,
        0,
        0,
        '123/ colombo1212',
        '0234234325',
        'NIC',
        '1234',
        NULL,
        NULL,
        'approved',
        'fsd',
        'fsdf',
        '123',
        'fsd',
        'abc',
        'aabc',
        'abc',
        'abc',
        NULL,
        'ZuGR',
        1,
        1,
        0,
        0,
        NULL,
        NULL,
        NULL,
        1,
        NULL,
        NULL,
        '2025-06-03 23:31:38',
        '2025-06-16 04:46:46'
    ),
    (
        3,
        'asd',
        'Kalu',
        'asd',
        '2@gmail.com',
        '$2y$12$0HY6w7Mx3FVPJfK0xJHLkOu9.N3t28Xqr538uPCf7oZDt2aDbeC3e',
        1,
        NULL,
        NULL,
        0,
        0,
        0,
        0,
        0,
        0,
        0,
        NULL,
        '0234234326',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        'Uvww',
        1,
        0,
        0,
        0,
        NULL,
        NULL,
        NULL,
        1,
        NULL,
        NULL,
        '2025-06-04 02:41:42',
        '2025-06-13 08:44:41'
    ),
    (
        4,
        'asd1',
        'm3',
        'asd',
        'm3@gmail.com',
        '$2y$12$3RzxlE3shBkpNOgR.kTh2ODMWdEiHNs.hdiPu0Y.vO2iCSsgng9nS',
        NULL,
        NULL,
        NULL,
        0,
        0,
        0,
        0,
        0,
        0,
        0,
        NULL,
        '0234234327',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        'xj8O',
        0,
        0,
        0,
        0,
        NULL,
        NULL,
        NULL,
        1,
        NULL,
        NULL,
        '2025-06-04 23:47:31',
        '2025-06-08 23:11:30'
    ),
    (
        5,
        'asd2',
        'Kalu',
        'asd2',
        'manula4@gmail.com',
        '$2y$12$f8DdXEv.YwlP7KDQ6zvE9.ulkOXPCvOPzjwQ9TcQyKgCBbJq0zU5e',
        NULL,
        NULL,
        NULL,
        0,
        0,
        0,
        0,
        0,
        0,
        0,
        NULL,
        '0234234354',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        '1g1F',
        0,
        0,
        0,
        0,
        NULL,
        NULL,
        NULL,
        1,
        NULL,
        NULL,
        '2025-06-05 03:42:55',
        '2025-06-08 23:18:38'
    ),
    (
        6,
        'asd',
        'Kalu',
        'asd',
        'kalu@gmail.com',
        '$2y$12$QAyHjO5v3jxWIOAoGhLbj.Ibz3dCN8FDYachvOAo4gbJF935WkQly',
        NULL,
        NULL,
        NULL,
        0,
        0,
        0,
        0,
        0,
        0,
        0,
        NULL,
        '0234234330',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        'E4y5',
        0,
        0,
        0,
        0,
        NULL,
        NULL,
        NULL,
        1,
        NULL,
        NULL,
        '2025-06-06 03:31:38',
        '2025-06-08 23:18:38'
    ),
    (
        7,
        '1g1F',
        '1g1F',
        '1g1F',
        '1g1F@gmail.com',
        '$2y$12$XC1huNAQ7D1f3zTH0JLBXOs.QODNvRpKcy8LqK4ouiZyIDWtsI8H.',
        NULL,
        NULL,
        NULL,
        0,
        0,
        0,
        0,
        0,
        0,
        0,
        NULL,
        '0234234335',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        'bPft',
        0,
        0,
        0,
        0,
        NULL,
        NULL,
        NULL,
        1,
        NULL,
        NULL,
        '2025-06-06 03:36:15',
        '2025-06-08 23:16:33'
    ),
    (
        8,
        'ZuGR',
        'ZuGR',
        'ZuGR',
        'ZuGR@gmail.com',
        '$2y$12$kqn8YvAqHnBNaZ/PiRNhL.z/ms5kl828zdTSoPyaZd/TMJR1423BO',
        NULL,
        NULL,
        NULL,
        0,
        0,
        0,
        0,
        0,
        0,
        0,
        NULL,
        '0234234329',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        'BFhR',
        0,
        0,
        0,
        0,
        NULL,
        NULL,
        NULL,
        1,
        NULL,
        NULL,
        '2025-06-06 03:46:09',
        '2025-06-08 23:18:38'
    ),
    (
        9,
        'test',
        'test',
        'one',
        'testone@gmail.com',
        '$2y$12$4TXebsJ0Htwo25JbiSxpretbxBYhXbEreMmXXpLnhj9a/FxXANEtO',
        1,
        NULL,
        NULL,
        0,
        0,
        0,
        0,
        0,
        0,
        0,
        NULL,
        '0748454547',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        '9Vto',
        1,
        0,
        0,
        0,
        NULL,
        NULL,
        NULL,
        1,
        NULL,
        NULL,
        '2025-06-13 10:08:21',
        '2025-06-16 04:46:46'
    );

-- Dumping structure for table dsalms2.customer_course_batch
CREATE TABLE IF NOT EXISTS `customer_course_batch` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `customer_id` bigint unsigned NOT NULL,
    `course_id` bigint unsigned NOT NULL,
    `batch_id` bigint unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `customer_course_batch_customer_id_foreign` (`customer_id`),
    KEY `customer_course_batch_course_id_foreign` (`course_id`),
    KEY `customer_course_batch_batch_id_foreign` (`batch_id`),
    CONSTRAINT `customer_course_batch_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
    CONSTRAINT `customer_course_batch_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE,
    CONSTRAINT `customer_course_batch_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`user_id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.customer_course_batch: ~0 rows (approximately)

-- Dumping structure for table dsalms2.employees
CREATE TABLE IF NOT EXISTS `employees` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `role` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'admin',
    `status` tinyint(1) NOT NULL DEFAULT '1',
    `remember_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `employees_email_unique` (`email`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.employees: ~0 rows (approximately)
INSERT INTO
    `employees` (
        `id`,
        `name`,
        `email`,
        `password`,
        `role`,
        `status`,
        `remember_token`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        'k.a.kavidu malshan kulathunga',
        'freelyricshub@gmail.com',
        '$2y$12$6zSCwQMbG5xtJsgHBEXbXuVevhCl7P5E.TDbYIXIiPbWqL1t4.8Wi',
        'admin',
        1,
        NULL,
        '2025-04-04 04:34:23',
        '2025-04-04 04:34:23'
    );

-- Dumping structure for table dsalms2.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `uuid` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `connection` text COLLATE utf8mb4_general_ci NOT NULL,
    `queue` text COLLATE utf8mb4_general_ci NOT NULL,
    `payload` longtext COLLATE utf8mb4_general_ci NOT NULL,
    `exception` longtext COLLATE utf8mb4_general_ci NOT NULL,
    `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table dsalms2.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `queue` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `payload` longtext COLLATE utf8mb4_general_ci NOT NULL,
    `attempts` tinyint unsigned NOT NULL,
    `reserved_at` int unsigned DEFAULT NULL,
    `available_at` int unsigned NOT NULL,
    `created_at` int unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `jobs_queue_index` (`queue`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.jobs: ~0 rows (approximately)

-- Dumping structure for table dsalms2.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
    `id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `total_jobs` int NOT NULL,
    `pending_jobs` int NOT NULL,
    `failed_jobs` int NOT NULL,
    `failed_job_ids` longtext COLLATE utf8mb4_general_ci NOT NULL,
    `options` mediumtext COLLATE utf8mb4_general_ci,
    `cancelled_at` int DEFAULT NULL,
    `created_at` int NOT NULL,
    `finished_at` int DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.job_batches: ~0 rows (approximately)

-- Dumping structure for table dsalms2.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `migration` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `batch` int NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 36 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.migrations: ~35 rows (approximately)
INSERT INTO
    `migrations` (`id`, `migration`, `batch`)
VALUES (
        1,
        '0001_01_01_000000_create_users_table',
        1
    ),
    (
        2,
        '0001_01_01_000001_create_cache_table',
        1
    ),
    (
        3,
        '0001_01_01_000002_create_jobs_table',
        1
    ),
    (
        4,
        '2024_03_30_134912_create_branches_table',
        1
    ),
    (
        5,
        '2025_03_25_090113_create_courses_table',
        1
    ),
    (
        6,
        '2025_03_25_173119_create_course_files_table',
        1
    ),
    (
        7,
        '2025_03_25_201502_create_recordings_table',
        1
    ),
    (
        8,
        '2025_03_25_203248_create_course_zoom_links_table',
        1
    ),
    (
        9,
        '2025_03_31_063838_create_vip_packages_table',
        1
    ),
    (
        10,
        '2025_04_02_062440_create_youtube_videos_table',
        1
    ),
    (
        11,
        '2025_04_02_093322_create_banners_table',
        1
    ),
    (
        12,
        '2025_04_02_114640_create_blogs_table',
        1
    ),
    (
        13,
        '2025_04_04_092139_create_employees_table',
        1
    ),
    (
        14,
        '2025_04_04_163417_create_reviews_table',
        1
    ),
    (
        15,
        '2025_04_04_170542_create_adbanners_table',
        1
    ),
    (
        16,
        '2025_04_04_210725_create_batches_table',
        1
    ),
    (
        17,
        '2025_04_04_213757_create_course_file_batch_table',
        1
    ),
    (
        18,
        '2025_04_06_100612_create_course_recording_batch_table',
        1
    ),
    (
        19,
        '2025_04_06_102210_create_course_zoom_link_batch_table',
        1
    ),
    (
        20,
        '2025_05_06_084423_add_video_link_to_courses_table',
        1
    ),
    (
        21,
        '2025_05_08_022642_add_video_link_to_vip_packages_table',
        1
    ),
    (
        22,
        '2025_05_20_045212_create_call_centers_table',
        1
    ),
    (
        23,
        '2025_05_22_020242_create_popup_contacts_table',
        1
    ),
    (
        24,
        '2025_05_25_085944_create_customers_table',
        1
    ),
    (
        25,
        '2025_05_25_171622_create_orders_table',
        1
    ),
    (
        26,
        '2025_05_25_171725_create_order_payments_table',
        1
    ),
    (
        27,
        '2025_05_31_021430_create_bookings_table',
        1
    ),
    (
        28,
        '2025_06_03_092750_update_customer_table',
        1
    ),
    (
        29,
        '2025_06_03_094337_add_new_columns_customer_table',
        1
    ),
    (
        30,
        '2025_06_03_101616_create_vip_bookings_table',
        1
    ),
    (
        31,
        '2025_06_05_090108_create_withdrawals_table',
        1
    ),
    (
        32,
        '2025_06_06_110742_create_customer_course_batch_table',
        1
    ),
    (
        33,
        '2025_06_12_112046_create_wallets_table',
        1
    ),
    (
        34,
        '2025_06_12_113110_create_wallet_transactions_table',
        1
    ),
    (
        35,
        '2025_06_28_104523_add_reference_to_bookings_table',
        1
    );

-- Dumping structure for table dsalms2.orders
CREATE TABLE IF NOT EXISTS `orders` (
    `order_id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `user_id` bigint unsigned NOT NULL,
    `course_id` bigint unsigned NOT NULL,
    `total_amount` decimal(10, 2) NOT NULL,
    `paid_amount` decimal(10, 2) NOT NULL DEFAULT '0.00',
    `status` enum(
        'Pending',
        'parcial',
        'Completed',
        'Cancelled'
    ) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
    `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`order_id`),
    KEY `orders_user_id_foreign` (`user_id`),
    KEY `orders_course_id_foreign` (`course_id`),
    CONSTRAINT `orders_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE,
    CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `customers` (`user_id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.orders: ~0 rows (approximately)

-- Dumping structure for table dsalms2.order_payments
CREATE TABLE IF NOT EXISTS `order_payments` (
    `payment_id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `order_id` bigint unsigned NOT NULL,
    `amount` decimal(10, 2) NOT NULL,
    `payment_method` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `payment_proof` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `status` enum(
        'Pending',
        'Approved',
        'Rejected'
    ) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
    `payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`payment_id`),
    KEY `order_payments_order_id_foreign` (`order_id`),
    CONSTRAINT `order_payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.order_payments: ~0 rows (approximately)

-- Dumping structure for table dsalms2.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
    `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`email`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table dsalms2.popup_contacts
CREATE TABLE IF NOT EXISTS `popup_contacts` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `phone` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.popup_contacts: ~0 rows (approximately)

-- Dumping structure for table dsalms2.reviews
CREATE TABLE IF NOT EXISTS `reviews` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `student_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `rating` tinyint unsigned NOT NULL,
    `comment` text COLLATE utf8mb4_general_ci,
    `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `status` enum('approved', 'pending') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.reviews: ~0 rows (approximately)

-- Dumping structure for table dsalms2.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
    `id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `user_id` bigint unsigned DEFAULT NULL,
    `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `user_agent` text COLLATE utf8mb4_general_ci,
    `payload` longtext COLLATE utf8mb4_general_ci NOT NULL,
    `last_activity` int NOT NULL,
    PRIMARY KEY (`id`),
    KEY `sessions_user_id_index` (`user_id`),
    KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.sessions: ~1 rows (approximately)
INSERT INTO
    `sessions` (
        `id`,
        `user_id`,
        `ip_address`,
        `user_agent`,
        `payload`,
        `last_activity`
    )
VALUES (
        'O29swviphrv6SkLQXyB7FVKUrGaxBgkbvCVVgihJ',
        NULL,
        '127.0.0.1',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36',
        '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',
        1750163066
    );

-- Dumping structure for table dsalms2.users
CREATE TABLE IF NOT EXISTS `users` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `email_verified_at` timestamp NULL DEFAULT NULL,
    `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `remember_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.users: ~0 rows (approximately)

-- Dumping structure for table dsalms2.vip_bookings
CREATE TABLE IF NOT EXISTS `vip_bookings` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `user_id` bigint unsigned NOT NULL,
    `vip_package_id` bigint unsigned NOT NULL,
    `payment_method` enum('Card', 'Bank Transfer') COLLATE utf8mb4_general_ci NOT NULL,
    `receipt` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `bank_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `bank_branch` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `transfer_date` date DEFAULT NULL,
    `status` enum('Pending', 'Confirmed') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `vip_bookings_user_id_foreign` (`user_id`),
    KEY `vip_bookings_vip_package_id_foreign` (`vip_package_id`),
    CONSTRAINT `vip_bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `customers` (`user_id`) ON DELETE CASCADE,
    CONSTRAINT `vip_bookings_vip_package_id_foreign` FOREIGN KEY (`vip_package_id`) REFERENCES `vip_packages` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.vip_bookings: ~0 rows (approximately)

-- Dumping structure for table dsalms2.vip_packages
CREATE TABLE IF NOT EXISTS `vip_packages` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `price` int NOT NULL,
    `description` text COLLATE utf8mb4_general_ci,
    `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `video_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `status` enum('active', 'inactive') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.vip_packages: ~0 rows (approximately)

-- Dumping structure for table dsalms2.wallets
CREATE TABLE IF NOT EXISTS `wallets` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `customer_id` bigint unsigned NOT NULL,
    `balance` decimal(15, 2) NOT NULL DEFAULT '0.00',
    `total_deposited` decimal(15, 2) NOT NULL DEFAULT '0.00',
    `total_withdrawn` decimal(15, 2) NOT NULL DEFAULT '0.00',
    `status` enum('active', 'inactive') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
    `currency` varchar(10) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'LKR',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `wallets_customer_id_foreign` (`customer_id`),
    CONSTRAINT `wallets_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`user_id`) ON DELETE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.wallets: ~1 rows (approximately)
INSERT INTO
    `wallets` (
        `id`,
        `customer_id`,
        `balance`,
        `total_deposited`,
        `total_withdrawn`,
        `status`,
        `currency`,
        `created_at`,
        `updated_at`
    )
VALUES (
        4,
        1,
        0.00,
        0.00,
        0.00,
        'active',
        'LKR',
        '2025-06-17 12:23:29',
        '2025-06-17 12:23:29'
    );

-- Dumping structure for table dsalms2.wallet_transactions
CREATE TABLE IF NOT EXISTS `wallet_transactions` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `wallet_id` bigint unsigned NOT NULL,
    `transaction_type` enum(
        'deposit',
        'withdrawal',
        'transfer'
    ) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'deposit',
    `amount` decimal(15, 2) NOT NULL,
    `currency` varchar(10) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'LKR',
    `description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `status` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'completed',
    `reference_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `transaction_method` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `transaction_fee` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `wallet_transactions_wallet_id_foreign` (`wallet_id`),
    CONSTRAINT `wallet_transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.wallet_transactions: ~0 rows (approximately)

-- Dumping structure for table dsalms2.withdrawals
CREATE TABLE IF NOT EXISTS `withdrawals` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `customer_id` bigint unsigned NOT NULL,
    `amount` decimal(10, 2) NOT NULL,
    `bank_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `bank_branch` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `account_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `account_number` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `status` enum(
        'pending',
        'approved',
        'rejected'
    ) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
    `left_points_used` decimal(8, 2) NOT NULL DEFAULT '0.00',
    `right_points_used` decimal(8, 2) NOT NULL DEFAULT '0.00',
    `withdrawal_date` date DEFAULT NULL,
    `withdrawal_time` time DEFAULT NULL,
    `withdrawal_type` enum('first_time', 'subsequent') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'first_time',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `withdrawals_customer_id_foreign` (`customer_id`),
    CONSTRAINT `withdrawals_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`user_id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.withdrawals: ~13 rows (approximately)

-- Dumping structure for table dsalms2.youtube_videos
CREATE TABLE IF NOT EXISTS `youtube_videos` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `youtube_url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `thumbnail` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Dumping data for table dsalms2.youtube_videos: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */
;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */
;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */
;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */
;
