-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2019 at 02:36 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp_retail`
--

-- --------------------------------------------------------

--
-- Table structure for table `accommodation`
--

CREATE TABLE `accommodation` (
  `accommodation_id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `accommodation_category` int(11) DEFAULT NULL,
  `accommodation_status` int(11) DEFAULT '0',
  `accommodation_size` int(11) DEFAULT NULL,
  `acc_price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accommodation`
--

INSERT INTO `accommodation` (`accommodation_id`, `title`, `accommodation_category`, `accommodation_status`, `accommodation_size`, `acc_price`) VALUES
(1, 'Hall 1', 1, 0, 10, 100),
(2, 'Room 2', 2, 0, 4, 200),
(3, 'testing', 2, 1, 12, NULL),
(4, 'testing', 3, 0, 11, 2000),
(5, 'rooooasdfasdf', 4, 0, 12, 12222);

-- --------------------------------------------------------

--
-- Table structure for table `accommodation_category`
--

CREATE TABLE `accommodation_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(200) DEFAULT NULL,
  `category_status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accommodation_category`
--

INSERT INTO `accommodation_category` (`category_id`, `category_name`, `category_status`) VALUES
(1, 'HALL', 0),
(2, 'ROOM', 0),
(3, 'testing', 1),
(4, 'ROOM Big', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_slider`
--

CREATE TABLE `category_slider` (
  `cat_sl_id` int(11) NOT NULL,
  `p_category_id` int(11) NOT NULL,
  `cat_sl_title` varchar(255) NOT NULL,
  `cat_sl_des` varchar(500) NOT NULL,
  `cat_sl_image` varchar(255) NOT NULL,
  `cat_sl_status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_slider`
--

INSERT INTO `category_slider` (`cat_sl_id`, `p_category_id`, `cat_sl_title`, `cat_sl_des`, `cat_sl_image`, `cat_sl_status`) VALUES
(1, 1, 'shopping bag slider', 'its shopping bag slider', '', 0),
(2, 1, 'large bags slider', 'large bags slider', '00images.png', 1),
(3, 2, 'mini soap images', 'mini soap slider images', '58download(24).jpg', 1),
(4, 2, 'large soap images', 'large soap images', '22download(25).jpg', 1),
(5, 3, 'gents shoes slider', 'its gents shoes slider', '38download(26).jpg', 1),
(6, 3, 'shoes slider', 'its latest shoes slider', '07download(27).jpg', 1),
(7, 4, 'latest shirts slider', 'its shirts slider', '10download(29).jpg', 1),
(8, 4, 'new shirts slider', 'its new shirts slider', '34download(31).jpg', 1),
(9, 5, 'garments slider', 'its garments slider', '36download(33).jpg', 1),
(10, 5, 'garmets slider', 'its garments slider', '09download(32).jpg', 1),
(11, 1, 'title', 'this is description', '', 0),
(12, 1, 'testing', 'asdfaevc as dfds sd ', '08man-156584__340.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_account`
--

CREATE TABLE `chart_of_account` (
  `coa_id` int(11) NOT NULL,
  `coa_name` varchar(255) NOT NULL,
  `coa_desc` varchar(255) NOT NULL,
  `coa_code` int(11) NOT NULL,
  `coa_parent` int(11) NOT NULL DEFAULT '0',
  `coa_subtypeid` int(11) NOT NULL,
  `coa_is_update` int(11) NOT NULL DEFAULT '1',
  `coa_level` int(11) NOT NULL DEFAULT '1',
  `coa_is_system` int(11) NOT NULL DEFAULT '0',
  `coa_created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chart_of_account`
--

INSERT INTO `chart_of_account` (`coa_id`, `coa_name`, `coa_desc`, `coa_code`, `coa_parent`, `coa_subtypeid`, `coa_is_update`, `coa_level`, `coa_is_system`, `coa_created_by`) VALUES
(1, 'Cash Balance', 'Cash in hand', 1000, 0, 1, 0, 1, 1, 0),
(2, 'Petty cash', 'Petty cash', 1100, 0, 1, 0, 1, 1, 0),
(5, 'Tax Payable', 'Tax Payable', 2000, 0, 3, 0, 0, 1, 0),
(6, 'Shipping / Delivery Charges', 'Shipping / Delivery Charges', 2100, 0, 6, 0, 0, 1, 0),
(7, 'Suppliers Payable', '', 2200, 4, 4, 0, 0, 1, 0),
(8, 'Sales Income', '', 3000, 0, 5, 0, 0, 1, 0),
(9, 'Other Income / Additional Income', '', 3100, 0, 6, 0, 0, 1, 0),
(10, 'Discount Allowed', '', 4000, 0, 7, 0, 0, 1, 0),
(13, 'Sales Receivables', '', 0, 0, 8, 0, 0, 1, 0),
(16, 'Purchase', '', 0, 0, 7, 0, 0, 1, 0),
(17, 'Askari Bank Limited', '1234566432', 0, 0, 2, 1, 0, 0, 1),
(18, 'Habib Bank Limited', 'er2345gb', 0, 0, 2, 1, 0, 0, 37),
(19, 'Chaltara', '8377#97qw', 0, 0, 2, 1, 0, 0, 111),
(20, 'United Bank', '111112223333', 0, 0, 2, 1, 0, 0, 110),
(21, 'Salary Expense', '', 4000, 0, 9, 0, 0, 1, 0),
(22, 'Cash Counter', '', 0, 0, 2, 1, 0, 0, 1),
(23, 'Allied Bank', '', 0, 0, 2, 1, 0, 0, 1),
(24, 'demo', '798797987', 0, 0, 2, 1, 0, 0, 1),
(25, 'coaHead', 'coaHeadDesc', 5, 0, 7, 1, 1, 0, 1),
(26, 'coaIncomeHead', 'coaIncomeHead', 2, 0, 5, 1, 1, 0, 1),
(27, 'coaIncomeHead', 'coaIncomeDesc', 8, 0, 6, 1, 1, 0, 1),
(28, 'coaIncome', 'coaincomeDesc', 11, 0, 5, 1, 1, 0, 1),
(29, 'new source', 'desc', 123123, 0, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_account_subtype`
--

CREATE TABLE `chart_of_account_subtype` (
  `coa_subtype_id` int(11) NOT NULL,
  `coa_subtype_name` varchar(255) NOT NULL,
  `coa_subtype_typeid` int(11) NOT NULL,
  `coa_subtype_is_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chart_of_account_subtype`
--

INSERT INTO `chart_of_account_subtype` (`coa_subtype_id`, `coa_subtype_name`, `coa_subtype_typeid`, `coa_subtype_is_update`) VALUES
(1, 'Cash', 1, 0),
(2, 'Bank', 1, 0),
(3, 'Short Term Liabilities', 3, 0),
(4, 'Account Payables', 3, 0),
(5, 'Income', 2, 0),
(6, 'Other Income', 2, 0),
(7, 'Cost Of Sale', 4, 0),
(8, 'Account Receivables', 1, 0),
(9, 'Staff Salary / Wage', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_account_type`
--

CREATE TABLE `chart_of_account_type` (
  `coa_type_id` int(11) NOT NULL,
  `coa_type_name` varchar(255) NOT NULL,
  `coa_type_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chart_of_account_type`
--

INSERT INTO `chart_of_account_type` (`coa_type_id`, `coa_type_name`, `coa_type_status`) VALUES
(1, 'Asset', 1),
(2, 'Revenue', 1),
(3, 'Liability', 1),
(4, 'Expense', 1);

-- --------------------------------------------------------

--
-- Table structure for table `consumpted_items`
--

CREATE TABLE `consumpted_items` (
  `consumpted_item_id` int(11) NOT NULL,
  `cons_id` int(11) DEFAULT NULL,
  `prd_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consumpted_items`
--

INSERT INTO `consumpted_items` (`consumpted_item_id`, `cons_id`, `prd_id`, `quantity`, `price`, `total`) VALUES
(1, 1, 1, 1, 30, 30),
(2, 1, 1, 1, 30, 30),
(3, 1, 1, 2, 30, 60),
(4, 2, 1, 1, 30, 30),
(5, 2, 1, 1, 30, 30),
(6, 3, 1, 1, 30, 30),
(7, 3, 1, 1, 30, 30),
(8, 3, 1, 1, 30, 30),
(9, 3, 5, 1, 20, 20),
(10, 3, 6, 3, 30, 90),
(11, 4, 1, 1, 1, 1),
(12, 4, 1, 2, 1, 2),
(13, 4, 1, 3, 1, 3),
(14, 4, 5, 6, 22, 132),
(15, 4, 6, 2, 10, 20),
(16, 4, 5, 3, 1, 3),
(17, 5, 1, 1, 1, 1),
(18, 5, 1, 3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `consumption`
--

CREATE TABLE `consumption` (
  `consumption_id` int(11) NOT NULL,
  `manufactor_product` int(11) DEFAULT NULL,
  `manufactor_product_price` float DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `additional_info` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consumption`
--

INSERT INTO `consumption` (`consumption_id`, `manufactor_product`, `manufactor_product_price`, `create_date`, `create_by`, `additional_info`) VALUES
(1, 4, NULL, '2019-08-01', 0, 'additional info'),
(2, 3, 100, '2019-08-01', NULL, ''),
(3, 4, 200, '2019-08-01', 1, ''),
(4, 4, 200, '2019-08-01', 1, ''),
(5, 2, 40, '2019-08-02', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `currency_id` int(11) NOT NULL,
  `currency_name` varchar(100) DEFAULT NULL,
  `symbol` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`currency_id`, `currency_name`, `symbol`, `status`) VALUES
(1, 'Dollar', '$', 0),
(2, 'Ruppee', 'Rs', 0);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `file_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `file_title` varchar(255) NOT NULL,
  `upload_file` varchar(255) NOT NULL,
  `file_upload_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `general_journal`
--

CREATE TABLE `general_journal` (
  `general_journal_id` int(11) NOT NULL,
  `general_journal_head` int(11) NOT NULL,
  `general_journal_debit` float NOT NULL,
  `general_journal_credit` float NOT NULL,
  `general_journal_particulars` varchar(255) NOT NULL,
  `general_journal_source` varchar(255) NOT NULL,
  `general_journal_source_id` int(11) NOT NULL,
  `general_journal_date` date NOT NULL,
  `general_journal_posted_by` int(11) NOT NULL,
  `general_journal_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_journal`
--

INSERT INTO `general_journal` (`general_journal_id`, `general_journal_head`, `general_journal_debit`, `general_journal_credit`, `general_journal_particulars`, `general_journal_source`, `general_journal_source_id`, `general_journal_date`, `general_journal_posted_by`, `general_journal_time`) VALUES
(1, 16, 2600, 0, '', 'purchase POS', 1, '2019-07-29', 1, '03:28:04'),
(2, 1, 0, 2600, '', 'purchase POS', 1, '2019-07-29', 1, '03:28:04'),
(3, 1, 60, 0, '', 'POS-Terminal', 1, '2019-07-29', 1, '03:29:29'),
(4, 8, 0, 60, '', 'POS-Terminal', 1, '2019-07-29', 1, '03:29:29'),
(5, 10, 0, 0, '', 'POS-Terminal', 1, '2019-07-29', 1, '03:29:29'),
(6, 5, 0, 0, '', 'POS-Terminal', 1, '2019-07-29', 1, '03:29:29'),
(7, 1, 500, 0, '', 'POS-Terminal', 2, '2019-07-29', 1, '03:29:51'),
(8, 8, 0, 500, '', 'POS-Terminal', 2, '2019-07-29', 1, '03:29:51'),
(9, 10, 0, 0, '', 'POS-Terminal', 2, '2019-07-29', 1, '03:29:51'),
(10, 5, 0, 0, '', 'POS-Terminal', 2, '2019-07-29', 1, '03:29:51'),
(11, 1, 63, 0, '', 'POS-Terminal', 3, '2019-07-29', 1, '05:07:19'),
(12, 8, 0, 30, '', 'POS-Terminal', 3, '2019-07-29', 1, '05:07:19'),
(13, 10, 0, 0, '', 'POS-Terminal', 3, '2019-07-29', 1, '05:07:20'),
(14, 5, 0, 33, '', 'POS-Terminal', 3, '2019-07-29', 1, '05:07:20'),
(15, 1, 63, 0, '', 'POS-Terminal', 5, '2019-07-29', 1, '05:40:39'),
(16, 8, 0, 30, '', 'POS-Terminal', 5, '2019-07-29', 1, '05:40:39'),
(17, 10, 0, 0, '', 'POS-Terminal', 5, '2019-07-29', 1, '05:40:39'),
(18, 5, 0, 33, '', 'POS-Terminal', 5, '2019-07-29', 1, '05:40:39'),
(19, 1, 440, 0, '', 'POS-Terminal', 6, '2019-07-29', 1, '06:04:23'),
(20, 8, 0, 400, '', 'POS-Terminal', 6, '2019-07-29', 1, '06:04:23'),
(21, 10, 0, 0, '', 'POS-Terminal', 6, '2019-07-29', 1, '06:04:23'),
(22, 5, 0, 40, '', 'POS-Terminal', 6, '2019-07-29', 1, '06:04:23'),
(23, 1, 100, 0, '', 'POS-Terminal', 9, '2019-07-30', 1, '03:13:55'),
(24, 8, 0, 100, '', 'POS-Terminal', 9, '2019-07-30', 1, '03:13:55'),
(25, 10, 0, 0, '', 'POS-Terminal', 9, '2019-07-30', 1, '03:13:55'),
(26, 5, 0, 0, '', 'POS-Terminal', 9, '2019-07-30', 1, '03:13:55'),
(27, 1, 50, 0, '', 'POS-Terminal', 10, '2019-07-30', 1, '03:32:09'),
(28, 8, 0, 50, '', 'POS-Terminal', 10, '2019-07-30', 1, '03:32:09'),
(29, 10, 0, 0, '', 'POS-Terminal', 10, '2019-07-30', 1, '03:32:09'),
(30, 5, 0, 0, '', 'POS-Terminal', 10, '2019-07-30', 1, '03:32:09'),
(31, 8, 0, 63, '', 'SALE', 1, '2019-08-28', 1, '07:16:06'),
(32, 5, 0, 33, '', 'SALE', 1, '2019-08-28', 1, '07:16:06'),
(33, 1, 63, 0, '', 'SALE', 1, '2019-08-28', 1, '07:16:06'),
(34, 13, -63, 0, '', 'SALE', 1, '2019-08-28', 1, '07:16:06'),
(35, 10, 30, 0, '', 'SALE', 1, '2019-08-28', 1, '07:16:06'),
(36, 8, 0, 30, '', 'SALE', 3, '1970-01-01', 1, '07:18:06'),
(37, 5, 0, 32, '', 'SALE', 3, '1970-01-01', 1, '07:18:06'),
(38, 1, 20, 0, '', 'SALE', 3, '1970-01-01', 1, '07:18:06'),
(39, 13, 32, 0, '', 'SALE', 3, '1970-01-01', 1, '07:18:06'),
(40, 10, 10, 0, '', 'SALE', 3, '1970-01-01', 1, '07:18:06'),
(41, 8, 0, 60, '', 'SALE', 4, '1970-01-01', 1, '07:19:24'),
(42, 5, 0, 0, '', 'SALE', 4, '1970-01-01', 1, '07:19:24'),
(43, 1, 10, 0, '', 'SALE', 4, '1970-01-01', 1, '07:19:24'),
(44, 13, 50, 0, '', 'SALE', 4, '1970-01-01', 1, '07:19:24'),
(45, 10, 0, 0, '', 'SALE', 4, '1970-01-01', 1, '07:19:24'),
(46, 8, 0, 90, '', 'SALE', 4, '2019-08-21', 1, '07:22:33'),
(47, 5, 0, 30, '', 'SALE', 4, '2019-08-21', 1, '07:22:33'),
(48, 1, 10, 0, '', 'SALE', 4, '2019-08-21', 1, '07:22:33'),
(49, 13, 110, 0, '', 'SALE', 4, '2019-08-21', 1, '07:22:33'),
(50, 10, 0, 0, '', 'SALE', 4, '2019-08-21', 1, '07:22:33'),
(51, 8, 0, 30, '', 'SALE', 6, '2019-08-22', 1, '07:23:28'),
(52, 5, 0, 0, '', 'SALE', 6, '2019-08-22', 1, '07:23:29'),
(53, 1, 10, 0, '', 'SALE', 6, '2019-08-22', 1, '07:23:29'),
(54, 13, 20, 0, '', 'SALE', 6, '2019-08-22', 1, '07:23:29'),
(55, 10, 0, 0, '', 'SALE', 6, '2019-08-22', 1, '07:23:29'),
(56, 8, 0, 30, '', 'SALE', 8, '1970-01-01', 1, '07:29:16'),
(57, 5, 0, 0, '', 'SALE', 8, '1970-01-01', 1, '07:29:16'),
(58, 1, 10, 0, '', 'SALE', 8, '1970-01-01', 1, '07:29:16'),
(59, 13, 20, 0, '', 'SALE', 8, '1970-01-01', 1, '07:29:16'),
(60, 10, 0, 0, '', 'SALE', 8, '1970-01-01', 1, '07:29:16'),
(61, 8, 0, 30, '', 'SALE', 7, '1970-01-01', 1, '07:29:53'),
(62, 5, 0, 0, '', 'SALE', 7, '1970-01-01', 1, '07:29:53'),
(63, 1, 10, 0, '', 'SALE', 7, '1970-01-01', 1, '07:29:53'),
(64, 13, 20, 0, '', 'SALE', 7, '1970-01-01', 1, '07:29:53'),
(65, 10, 0, 0, '', 'SALE', 7, '1970-01-01', 1, '07:29:53'),
(66, 8, 0, 40, '', 'SALE', 9, '1970-01-01', 1, '07:32:08'),
(67, 5, 0, 0, '', 'SALE', 9, '1970-01-01', 1, '07:32:08'),
(68, 1, 30, 0, '', 'SALE', 9, '1970-01-01', 1, '07:32:08'),
(69, 13, 10, 0, '', 'SALE', 9, '1970-01-01', 1, '07:32:08'),
(70, 10, 0, 0, '', 'SALE', 9, '1970-01-01', 1, '07:32:08'),
(71, 8, 0, 30, '', 'SALE', 10, '2019-08-29', 1, '07:51:15'),
(72, 5, 0, 0, '', 'SALE', 10, '2019-08-29', 1, '07:51:15'),
(73, 1, 30, 0, '', 'SALE', 10, '2019-08-29', 1, '07:51:15'),
(74, 13, 0, 0, '', 'SALE', 10, '2019-08-29', 1, '07:51:15'),
(75, 10, 0, 0, '', 'SALE', 10, '2019-08-29', 1, '07:51:15');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `note_title` varchar(500) NOT NULL,
  `note_description` varchar(1500) NOT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`note_id`, `project_id`, `note_title`, `note_description`, `created_by`) VALUES
(1, 1, 'asdfasd', 'asdfasdfasdf', 1),
(2, 1, 'ars', 'lkujandf asdjfk ioaj kjask loewm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notify_id` int(11) NOT NULL,
  `notify_created_for` varchar(50) NOT NULL,
  `notify_operation` varchar(255) NOT NULL,
  `notify_activity_on` varchar(255) NOT NULL,
  `activity_name` varchar(500) NOT NULL,
  `modify_date` text NOT NULL,
  `notify_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notify_id`, `notify_created_for`, `notify_operation`, `notify_activity_on`, `activity_name`, `modify_date`, `notify_status`) VALUES
(1, '1', 'Create', 'ProductCategory', 'Coca Cola', '2019-07-29 14:39:13', 0),
(2, '1', 'Create', 'ProductCategory', 'Pepsi', '2019-07-29 14:39:19', 0),
(3, '1', 'Update', 'ProductCategory', 'Beverages', '2019-07-29 14:39:37', 0),
(4, '1', 'Update', 'ProductCategory', 'Mineral Water', '2019-07-29 14:39:45', 0),
(5, '1', 'Create', 'Product', 'Cocacola 250ml Regular ', '2019-07-29 14:50:18', 0),
(6, '1', 'Update', 'Product', 'Cocacola 250ml Glass Bottle', '2019-07-29 14:50:33', 0),
(7, '1', 'Create', 'Product', 'Cocacola 250ml Can', '2019-07-29 14:51:27', 0),
(8, '1', 'Create', 'Product', 'Cocacola 1.5Liter Pet Bottle', '2019-07-29 14:52:56', 0),
(9, '1', 'Create', 'Product', 'Cocacola 2.5Liter Pet Bottle', '2019-07-29 14:53:23', 0),
(10, '1', 'session start', 'Login', 'login', '2019-07-30 06:13:19', 0),
(11, '1', 'Create', 'ProductCategory', 'Stationary', '2019-07-30 15:09:04', 0),
(12, '1', 'Create', 'Product', 'Pen', '2019-07-30 15:09:48', 0),
(13, '1', 'Create', 'Product', 'Pencil ', '2019-07-30 16:49:35', 0),
(14, '1', 'session start', 'Login', 'login', '2019-07-31 06:23:45', 0),
(15, '1', 'Create', 'Product', 'asdfsdf', '2019-08-01 14:23:25', 0),
(16, '1', 'Update', 'Product', 'Cocacola 250ml Glass Bottle', '2019-08-01 14:28:01', 0),
(17, '1', 'Update', 'Product', 'Cocacola 250ml Glass Bottle', '2019-08-01 14:29:19', 0),
(18, '1', 'Update', 'Product', 'Cocacola 250ml Glass Bottle', '2019-08-01 14:29:23', 0),
(19, '1', 'Update', 'Product', 'Cocacola 250ml Glass Bottle', '2019-08-01 14:32:31', 0),
(20, '1', 'session start', 'Login', 'login', '2019-08-02 06:30:32', 0),
(21, '1', 'session destroy', 'Logout', 'logout', '2019-08-02 08:52:43', 0),
(22, '1', 'session start', 'Login', 'login', '2019-08-02 08:52:51', 0),
(23, '1', 'session destroy', 'Logout', 'logout', '2019-08-02 08:52:56', 0),
(24, '1', 'session start', 'Login', 'login', '2019-08-02 09:00:06', 0),
(25, '1', 'session start', 'Login', 'login', '2019-08-05 07:03:38', 0),
(26, '1', 'session start', 'Login', 'login', '2019-08-05 09:43:32', 0),
(27, '1', 'session start', 'Login', 'login', '2019-08-05 12:59:08', 0),
(28, '1', 'session start', 'Login', 'login', '2019-08-05 12:59:54', 0),
(29, '1', 'session start', 'Login', 'login', '2019-08-06 07:01:05', 0),
(30, '1', 'session destroy', 'Logout', 'logout', '2019-08-06 09:54:01', 0),
(31, '1', 'session start', 'Login', 'login', '2019-08-06 10:01:28', 0),
(32, '1', 'session destroy', 'Logout', 'logout', '2019-08-06 11:24:38', 0),
(33, '1', 'session start', 'Login', 'login', '2019-08-06 13:29:15', 0),
(34, '1', 'Create', 'ProductCategory', 'New CAtegory', '2019-08-06 16:29:45', 0),
(35, '1', 'Create', 'Product', 'Nestle', '2019-08-06 16:34:03', 0),
(36, '1', 'session destroy', 'Logout', 'logout', '2019-08-06 14:45:54', 0),
(37, '1', 'session start', 'Login', 'login', '2019-08-07 06:24:03', 0),
(38, '1', 'Update', 'Product', 'Cocacola 250ml Glass Bottle', '2019-08-07 09:39:03', 0),
(39, '1', 'session start', 'Login', 'login', '2019-08-07 14:04:11', 0),
(40, '1', 'session destroy', 'Logout', 'logout', '2019-08-07 14:04:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_tax`
--

CREATE TABLE `order_tax` (
  `order_tax_id` int(11) NOT NULL,
  `pos_id` int(11) NOT NULL,
  `pos_tax_value` double DEFAULT NULL,
  `pos_tax_type` varchar(20) DEFAULT NULL,
  `pos_tax_on` double NOT NULL,
  `pos_tax_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_tax`
--

INSERT INTO `order_tax` (`order_tax_id`, `pos_id`, `pos_tax_value`, `pos_tax_type`, `pos_tax_on`, `pos_tax_title`) VALUES
(1, 3, 30, 'FLAT', 30, 'GST'),
(2, 3, 3, '%', 10, 'S CHARGES'),
(22, 4, 0, '', 0, ''),
(23, 4, 10, '%', 10, 'S CHARGES'),
(24, 5, 30, 'FLAT', 30, 'GST'),
(25, 5, 3, '%', 10, 'S CHARGES'),
(26, 6, 40, '%', 10, 'S CHARGES');

-- --------------------------------------------------------

--
-- Table structure for table `pos`
--

CREATE TABLE `pos` (
  `pos_id` int(11) NOT NULL,
  `pos_assign_id` int(11) DEFAULT NULL,
  `order_type_id` int(11) NOT NULL DEFAULT '3',
  `pos_date` text NOT NULL,
  `pos_terminal` int(11) NOT NULL DEFAULT '1',
  `pos_created_by` int(11) NOT NULL,
  `pos_discount_price` double DEFAULT NULL,
  `pos_discounted_off` double NOT NULL,
  `pos_discount_type` varchar(255) DEFAULT NULL,
  `pos_discount_value` double NOT NULL,
  `pos_additional_note` varchar(500) NOT NULL,
  `pos_bill_total` double NOT NULL,
  `pos_status` varchar(1) NOT NULL DEFAULT '1',
  `pos_paid_amount` double NOT NULL,
  `pos_balance` double NOT NULL,
  `cancel_by` int(11) NOT NULL,
  `cancelation_reason` varchar(250) NOT NULL,
  `cancelation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos`
--

INSERT INTO `pos` (`pos_id`, `pos_assign_id`, `order_type_id`, `pos_date`, `pos_terminal`, `pos_created_by`, `pos_discount_price`, `pos_discounted_off`, `pos_discount_type`, `pos_discount_value`, `pos_additional_note`, `pos_bill_total`, `pos_status`, `pos_paid_amount`, `pos_balance`, `cancel_by`, `cancelation_reason`, `cancelation_date`) VALUES
(1, NULL, 3, '2019-07-29 15:29:29', 1, 1, 60, 0, '', 0, '', 60, '1', 60, 0, 0, '', '0000-00-00'),
(2, NULL, 3, '2019-07-29 15:29:51', 1, 1, 500, 0, '', 0, '', 500, '1', 1000, -500, 0, '', '0000-00-00'),
(3, NULL, 3, '2019-07-29 17:07:19', 1, 1, 30, 0, '', 0, '', 63, '1', 63, 0, 0, '', '0000-00-00'),
(4, NULL, 3, '2019-07-29 17:13:03', 1, 1, 100, 0, '', 0, '', 110, '0', 10, 100, 0, '', '0000-00-00'),
(5, NULL, 3, '2019-07-29 17:40:39', 1, 1, 30, 0, '', 0, '', 63, '1', 63, 0, 0, '', '0000-00-00'),
(6, NULL, 3, '2019-07-29 18:04:23', 1, 1, 400, 0, '', 0, '', 440, '1', 440, 0, 0, '', '0000-00-00'),
(7, NULL, 3, '2019-07-29 18:27:02', 1, 1, 40, 0, '', 0, '', 40, '0', 0, 40, 0, '', '0000-00-00'),
(8, NULL, 3, '2019-07-30 12:53:48', 1, 1, 280, 0, '', 0, '', 280, '2', 0, 280, 1, 'asy', '2019-07-30'),
(9, NULL, 3, '2019-07-30 15:13:54', 1, 1, 100, 0, '', 0, '', 100, '1', 100, 0, 0, '', '0000-00-00'),
(10, NULL, 3, '2019-07-30 15:32:08', 1, 1, 50, 0, '', 0, '', 50, '1', 50, 0, 0, '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `pos_assignment`
--

CREATE TABLE `pos_assignment` (
  `pos_assign_id` int(11) NOT NULL,
  `pos_assign_title` varchar(500) NOT NULL,
  `pos_assign_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_assignment`
--

INSERT INTO `pos_assignment` (`pos_assign_id`, `pos_assign_title`, `pos_assign_status`) VALUES
(1, 'TABLE 1', 1),
(2, 'TABLE 2', 1),
(3, 'TABLE 3', 1),
(4, 'TABLE 4', 1),
(5, 'TABLE 5', 1),
(6, 'TABLE 6', 1),
(7, 'TABLE 7', 1),
(8, 'TABLE 8', 1),
(9, 'TABLE 9', 1),
(10, 'TABLE 10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pos_items`
--

CREATE TABLE `pos_items` (
  `pos_items_id` int(11) NOT NULL,
  `pos_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL,
  `pos_prd_price` double NOT NULL,
  `pos_prd_qty` int(11) NOT NULL,
  `pos_item_unit` varchar(50) NOT NULL,
  `pos_items_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_items`
--

INSERT INTO `pos_items` (`pos_items_id`, `pos_id`, `prd_id`, `pos_prd_price`, `pos_prd_qty`, `pos_item_unit`, `pos_items_date`) VALUES
(1, 1, 1, 30, 2, '1', '2019-07-29'),
(2, 2, 3, 100, 3, '1', '2019-07-29'),
(3, 2, 2, 40, 5, '2', '2019-07-29'),
(4, 3, 1, 30, 1, '1', '2019-07-29'),
(15, 4, 3, 100, 1, '1', '2019-07-29'),
(16, 5, 1, 30, 1, '1', '2019-07-29'),
(17, 6, 3, 100, 2, '1', '2019-07-29'),
(18, 6, 4, 200, 1, '1', '2019-07-29'),
(46, 7, 2, 40, 1, '2', '2019-07-29'),
(47, 8, 2, 40, 2, '2', '2019-07-30'),
(48, 8, 4, 200, 1, '1', '2019-07-30'),
(49, 9, 5, 20, 5, '3', '2019-07-30'),
(50, 10, 5, 10, 5, '3', '2019-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `pos_order_type`
--

CREATE TABLE `pos_order_type` (
  `order_type_id` int(11) NOT NULL,
  `order_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_order_type`
--

INSERT INTO `pos_order_type` (`order_type_id`, `order_type`) VALUES
(1, 'Delivery'),
(2, 'Takeaway'),
(3, 'Dine in');

-- --------------------------------------------------------

--
-- Table structure for table `pos_tax`
--

CREATE TABLE `pos_tax` (
  `pos_tax_id` int(11) NOT NULL,
  `pos_tax_title` varchar(255) NOT NULL,
  `pos_tax_value` double NOT NULL,
  `pos_tax_type` int(11) NOT NULL,
  `pos_tax_on` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_tax`
--

INSERT INTO `pos_tax` (`pos_tax_id`, `pos_tax_title`, `pos_tax_value`, `pos_tax_type`, `pos_tax_on`) VALUES
(1, 'GST', 30, 0, 30),
(2, 'S CHARGES', 10, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prd_id` int(11) NOT NULL,
  `prd_prdc_id` int(11) DEFAULT NULL,
  `prd_title` varchar(100) DEFAULT NULL,
  `prd_code` varchar(100) DEFAULT NULL,
  `prd_desc` varchar(100) DEFAULT NULL,
  `prd_is_sale` int(11) DEFAULT NULL,
  `prd_is_purchase` int(11) DEFAULT NULL,
  `prd_price` double DEFAULT NULL,
  `prd_wholesales_price` double DEFAULT NULL,
  `prd_created_date` date DEFAULT NULL,
  `prd_updated_date` date DEFAULT NULL,
  `prd_status` int(11) DEFAULT NULL,
  `prd_unit_id` int(11) DEFAULT NULL,
  `prd_is_raw` int(11) DEFAULT '0',
  `prd_discounted_price` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prd_id`, `prd_prdc_id`, `prd_title`, `prd_code`, `prd_desc`, `prd_is_sale`, `prd_is_purchase`, `prd_price`, `prd_wholesales_price`, `prd_created_date`, `prd_updated_date`, `prd_status`, `prd_unit_id`, `prd_is_raw`, `prd_discounted_price`) VALUES
(1, 1, 'Cocacola 250ml Glass Bottle', '0001', 'Coca cola 250ml Regular ', 1, 1, 30, 30, '2019-07-29', '2019-08-07', NULL, 1, 1, 30),
(2, 1, 'Cocacola 250ml Can', '0002', 'Cocacola 250ml Can', 1, 1, 40, 40, '2019-07-29', NULL, NULL, 2, 0, 0),
(3, 1, 'Cocacola 1.5Liter Pet Bottle', '0003', 'Cocacola 1.5Liter Pet Bottle', 1, 1, 100, 100, '2019-07-29', NULL, NULL, 1, 0, 0),
(4, 1, 'Cocacola 2.5Liter Pet Bottle', '0004', 'Cocacola 2.5Liter Pet Bottle', 1, 1, 200, 200, '2019-07-29', NULL, NULL, 1, 0, 0),
(5, 3, 'Pen', 'pen123', 'Dollor Pen', 1, 1, 20, 18, '2019-07-30', NULL, NULL, 3, 0, 0),
(6, 3, 'Pencil ', 'penc123', 'pencil', 1, 1, 30, 0, '2019-07-30', NULL, NULL, 2, 0, 0),
(7, 1, 'asdfsdf', 'asd', 'asdfasfsdfas asdfas dfasdf asd fasd fasd sdf ', 0, 0, 10, 0, '2019-08-01', NULL, NULL, 1, 1, 0),
(8, 2, 'Nestle', 'asdf123', 'Bottle of Water', 1, 1, 40, 30, '2019-08-06', NULL, NULL, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `prdc_id` int(11) NOT NULL,
  `prdc_name` varchar(100) DEFAULT NULL,
  `prdc_created_date` date DEFAULT NULL,
  `prdc_update_date` date DEFAULT NULL,
  `prdc_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`prdc_id`, `prdc_name`, `prdc_created_date`, `prdc_update_date`, `prdc_status`) VALUES
(1, 'Beverages', '2019-07-29', '2019-07-29', NULL),
(2, 'Mineral Water', '2019-07-29', '2019-07-29', NULL),
(3, 'Stationary', '2019-07-30', NULL, NULL),
(4, 'New CAtegory', '2019-08-06', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `prdimg_id` int(11) NOT NULL,
  `prdimg_prd_id` int(11) DEFAULT NULL,
  `prd_image` varchar(100) DEFAULT NULL,
  `prdimg_title` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`prdimg_id`, `prdimg_prd_id`, `prd_image`, `prdimg_title`) VALUES
(1, 8, '02man-156584__340.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_email_add` varchar(255) NOT NULL,
  `project_team_lead` varchar(255) NOT NULL,
  `project_invite_emp` varchar(255) NOT NULL,
  `project_start_date` text NOT NULL,
  `project_status` int(10) NOT NULL,
  `project_image` varchar(255) NOT NULL,
  `project_desc` varchar(200) DEFAULT NULL,
  `deal` int(11) DEFAULT NULL,
  `is_trash` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `project_email_add`, `project_team_lead`, `project_invite_emp`, `project_start_date`, `project_status`, `project_image`, `project_desc`, `deal`, `is_trash`) VALUES
(1, 'BRT', 'brt@gmail.com', '145', '146', '08/20/2019', 3, '', 'note', 2000, 0),
(2, 'jjkjk Project', '', '', '', '', 1, '', NULL, NULL, 0),
(3, 'khan afridi Project', '', '', '', '', 0, '', NULL, 60, 0),
(4, 'project 1 Project', '', '', '', '', 1, '', NULL, 90, 0),
(5, 'project 2 Project', '', '', '', '', 0, '', NULL, 30, 0),
(6, 'project%203 Project', '', '', '', '', 0, '', NULL, NULL, 0),
(7, ' Project', '', '', '', '', 0, '', NULL, NULL, 0),
(8, ' Project', '', '', '', '', 0, '', NULL, NULL, 0),
(9, 'asdfasdfasdf asdfasdf Project', '', '', '', '', 0, '', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `purchase_number` varchar(200) DEFAULT NULL,
  `purchase_date` datetime DEFAULT NULL,
  `purchase_vendor_id` int(11) DEFAULT NULL,
  `purchase_created_by` int(11) DEFAULT NULL,
  `purchase_created_date` datetime DEFAULT NULL,
  `purchase_additional_note` varchar(200) DEFAULT NULL,
  `purchase_status` int(11) DEFAULT NULL,
  `pur_ref_id` int(11) DEFAULT NULL,
  `is_ref` int(11) DEFAULT NULL,
  `post_status` int(1) DEFAULT '0',
  `pur_closing_status` int(11) DEFAULT '0',
  `cancel_by` int(11) DEFAULT NULL,
  `cancel_reason` varchar(200) DEFAULT NULL,
  `cancelation_date` datetime DEFAULT NULL,
  `purchase_bill_total` double NOT NULL,
  `is_purchase_close` int(11) NOT NULL DEFAULT '0',
  `is_stock` int(11) DEFAULT '0',
  `stock_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `purchase_number`, `purchase_date`, `purchase_vendor_id`, `purchase_created_by`, `purchase_created_date`, `purchase_additional_note`, `purchase_status`, `pur_ref_id`, `is_ref`, `post_status`, `pur_closing_status`, `cancel_by`, `cancel_reason`, `cancelation_date`, `purchase_bill_total`, `is_purchase_close`, `is_stock`, `stock_date`) VALUES
(1, '1', '2019-07-29 15:17:08', 144, 1, '2019-07-29 15:17:08', '', 1, NULL, NULL, 0, 0, NULL, NULL, NULL, 2600, 1, 1, '2019-07-29'),
(2, '2', '2019-07-29 15:36:04', 144, 1, '2019-07-29 15:36:04', '', 0, NULL, NULL, 0, 0, NULL, NULL, NULL, 12861, 0, 1, '2019-07-29'),
(3, '3', '2019-07-29 16:47:47', 144, 1, '2019-07-29 16:47:47', '', 0, NULL, NULL, 0, 0, NULL, NULL, NULL, 2426, 0, 0, NULL),
(4, '4', '2019-07-30 12:22:14', 144, 1, '2019-07-30 12:22:14', '', 1, NULL, NULL, 0, 0, NULL, NULL, NULL, 65, 1, 0, NULL),
(5, '5', '2019-07-30 15:10:20', 144, 1, '2019-07-30 15:10:20', '', 1, NULL, NULL, 0, 0, NULL, NULL, NULL, 1000, 1, 1, '2019-07-30'),
(6, '6', '2019-07-30 15:54:07', 144, 1, '2019-07-30 15:54:07', '', 0, NULL, NULL, 0, 0, NULL, NULL, NULL, 500, 0, 1, '2019-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `puritem_id` int(11) NOT NULL,
  `puritem_purchase_id` int(11) DEFAULT NULL,
  `puritem_item_id` int(11) DEFAULT NULL,
  `puritem_qty` int(11) DEFAULT NULL,
  `puritem_unit` int(11) DEFAULT NULL,
  `puritem_price` double DEFAULT NULL,
  `puritem_status` int(11) DEFAULT NULL,
  `puritem_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_items`
--

INSERT INTO `purchase_items` (`puritem_id`, `puritem_purchase_id`, `puritem_item_id`, `puritem_qty`, `puritem_unit`, `puritem_price`, `puritem_status`, `puritem_date`) VALUES
(1, 1, 1, 50, 1, 22, 1, '2019-07-29 15:17:08'),
(2, 1, 2, 50, 2, 30, 1, '2019-07-29 15:17:08'),
(3, 2, 2, 80, 2, 34, 1, '2019-07-29 15:36:04'),
(4, 2, 1, 50, 1, 22, 1, '2019-07-29 15:36:04'),
(5, 2, 3, 40, 1, 80, 1, '2019-07-29 15:36:04'),
(6, 2, 4, 33, 1, 177, 1, '2019-07-29 15:36:04'),
(16, 3, 1, 2, 1, 13, 1, '2019-07-29 16:47:47'),
(17, 4, 1, 5, 1, 13, 1, '2019-07-30 12:22:14'),
(18, 5, 5, 100, 3, 10, 1, '2019-07-30 15:10:20'),
(19, 6, 5, 10, 3, 50, 1, '2019-07-30 15:54:07');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_payment`
--

CREATE TABLE `purchase_payment` (
  `purpayment_id` int(11) NOT NULL,
  `purpayment_purchase_id` int(11) DEFAULT NULL,
  `purpayment_amount` double DEFAULT NULL,
  `purpayment_date` date DEFAULT NULL,
  `purchasepayment_by` int(11) DEFAULT NULL,
  `pur_ref_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_payment`
--

INSERT INTO `purchase_payment` (`purpayment_id`, `purpayment_purchase_id`, `purpayment_amount`, `purpayment_date`, `purchasepayment_by`, `pur_ref_id`) VALUES
(1, 1, 2600, '2019-07-29', 1, 0),
(2, 2, 10000, '2019-07-29', 1, 0),
(3, 4, 65, '2019-07-30', 1, 0),
(4, 5, 1000, '2019-07-30', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `rec_id` int(11) NOT NULL,
  `inv_id` int(11) DEFAULT NULL,
  `rec_date` date DEFAULT NULL,
  `rec_amount` double DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`rec_id`, `inv_id`, `rec_date`, `rec_amount`, `created_by`, `created_date`) VALUES
(1, 1, '2019-07-16', 63, 1, '2019-08-28'),
(2, 3, '2019-08-13', 20, 1, '1970-01-01'),
(3, 4, '2019-08-27', 10, 1, '1970-01-01'),
(4, 5, '2019-08-31', 10, 1, '2019-08-21'),
(5, 6, '2019-08-21', 10, 1, '2019-08-22'),
(6, 8, '2019-08-19', 10, 1, '1970-01-01'),
(7, 7, '2019-08-28', 10, 1, '1970-01-01'),
(8, 9, '2019-08-20', 30, 1, '1970-01-01'),
(9, 10, '2019-08-28', 30, 1, '2019-08-29');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  `accommodation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `user_id`, `created_by`, `creation_date`, `accommodation_id`) VALUES
(1, 44, 1, '2019-06-18', 1),
(2, 44, 1, '2019-06-18', 1),
(3, 45, 1, '2019-06-19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `sales_number` varchar(200) NOT NULL,
  `sales_date` date NOT NULL,
  `sales_vendor_id` int(11) NOT NULL,
  `sales_created_by` int(11) NOT NULL,
  `sales_created_date` date NOT NULL,
  `sales_additional_note` varchar(200) NOT NULL,
  `sales_discounted_price` double NOT NULL,
  `sales_discount_off` double NOT NULL,
  `sales_discount_type` varchar(100) NOT NULL,
  `sales_discount_value` double NOT NULL,
  `sales_bill_total` double NOT NULL,
  `sales_status` int(11) NOT NULL,
  `sal_ref_id` int(11) DEFAULT '0',
  `is_ref` int(11) DEFAULT NULL,
  `post_status` int(11) DEFAULT '0',
  `sale_closing_status` int(11) DEFAULT '0',
  `cancel_by` int(11) DEFAULT NULL,
  `cancel_reason` varchar(200) DEFAULT NULL,
  `cancelation_date` date DEFAULT NULL,
  `is_invoice` int(11) DEFAULT '0',
  `is_backed` int(11) DEFAULT '0',
  `posted_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `sales_number`, `sales_date`, `sales_vendor_id`, `sales_created_by`, `sales_created_date`, `sales_additional_note`, `sales_discounted_price`, `sales_discount_off`, `sales_discount_type`, `sales_discount_value`, `sales_bill_total`, `sales_status`, `sal_ref_id`, `is_ref`, `post_status`, `sale_closing_status`, `cancel_by`, `cancel_reason`, `cancelation_date`, `is_invoice`, `is_backed`, `posted_date`) VALUES
(1, '1', '2019-07-16', 144, 1, '2019-07-29', '', 30, 0, 'FLAT', 0, 63, 0, 0, NULL, 1, 1, NULL, NULL, NULL, 1, 1, '2019-08-28'),
(2, '2', '2019-07-16', 144, 1, '2019-07-30', '', 30, 0, 'FLAT', 0, 30, 1, 0, NULL, 0, 0, 1, 'asdf', '2019-07-30', 0, 1, '0000-00-00'),
(3, '3', '2019-08-13', 147, 1, '2019-08-02', '', 20, 10, 'FLAT', 10, 52, 0, 0, NULL, 1, 0, NULL, NULL, NULL, 1, 0, '1970-01-01'),
(4, '4', '2019-08-27', 148, 1, '2019-08-02', '', 60, 0, 'FLAT', 0, 60, 0, 0, NULL, 1, 0, NULL, NULL, NULL, 1, 0, '1970-01-01'),
(5, '5', '2019-08-31', 149, 1, '2019-08-02', '', 90, 0, 'FLAT', 0, 120, 0, 0, NULL, 1, 0, NULL, NULL, NULL, 1, 0, '2019-08-21'),
(6, '6', '2019-08-21', 150, 1, '2019-08-02', '', 30, 0, 'FLAT', 0, 30, 0, 0, NULL, 1, 0, NULL, NULL, NULL, 1, 0, '2019-08-22'),
(7, '7', '2019-08-28', 151, 1, '2019-08-02', '', 30, 0, 'FLAT', 0, 30, 0, 0, NULL, 1, 0, NULL, NULL, NULL, 1, 0, '1970-01-01'),
(8, '8', '2019-08-19', 152, 1, '2019-08-02', '', 30, 0, 'FLAT', 0, 30, 0, 0, NULL, 1, 0, NULL, NULL, NULL, 1, 0, '1970-01-01'),
(9, '9', '2019-08-20', 153, 1, '2019-08-02', '', 40, 0, 'FLAT', 0, 40, 0, 0, NULL, 1, 0, NULL, NULL, NULL, 1, 0, '1970-01-01'),
(10, '10', '2019-08-28', 154, 1, '2019-08-02', '', 30, 0, 'FLAT', 0, 30, 0, 0, NULL, 1, 1, NULL, NULL, NULL, 1, 0, '2019-08-29'),
(11, '11', '2019-08-28', 155, 1, '2019-08-06', '', 30, 0, 'FLAT', 0, 30, 0, 0, NULL, 0, 0, NULL, NULL, NULL, 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `sales_items`
--

CREATE TABLE `sales_items` (
  `salitem_id` int(11) NOT NULL,
  `salitem_sales_id` int(11) NOT NULL,
  `salitem_item_id` int(11) NOT NULL,
  `salitem_qty` int(11) NOT NULL,
  `salitem_unit` int(11) NOT NULL,
  `salitem_price` double NOT NULL,
  `salitem_status` int(11) NOT NULL,
  `discount_price` double NOT NULL,
  `tax_charges` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_items`
--

INSERT INTO `sales_items` (`salitem_id`, `salitem_sales_id`, `salitem_item_id`, `salitem_qty`, `salitem_unit`, `salitem_price`, `salitem_status`, `discount_price`, `tax_charges`) VALUES
(1, 1, 1, 1, 1, 30, 0, 0, ''),
(2, 2, 1, 1, 1, 30, 0, 0, ''),
(3, 3, 1, 1, 1, 30, 0, 0, ''),
(4, 4, 1, 1, 1, 30, 0, 0, ''),
(5, 4, 1, 1, 1, 30, 0, 0, ''),
(6, 5, 1, 3, 1, 30, 0, 0, ''),
(7, 6, 1, 1, 1, 30, 0, 0, ''),
(8, 7, 1, 1, 1, 30, 0, 0, ''),
(9, 8, 1, 1, 1, 30, 0, 0, ''),
(10, 9, 2, 1, 2, 40, 0, 0, ''),
(11, 10, 1, 1, 1, 30, 0, 0, ''),
(12, 11, 1, 1, 1, 30, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `sales_payment`
--

CREATE TABLE `sales_payment` (
  `salpayment_id` int(11) NOT NULL,
  `salpayment_sales_id` int(11) NOT NULL,
  `salpayment_amount` double NOT NULL,
  `salpayment_date` date NOT NULL,
  `salpayment_by` int(11) NOT NULL,
  `sal_ref_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_payment`
--

INSERT INTO `sales_payment` (`salpayment_id`, `salpayment_sales_id`, `salpayment_amount`, `salpayment_date`, `salpayment_by`, `sal_ref_id`) VALUES
(1, 1, 63, '2019-08-28', 1, 1),
(2, 3, 20, '1970-01-01', 1, 2),
(3, 4, 10, '1970-01-01', 1, 3),
(4, 5, 10, '2019-08-21', 1, 0),
(5, 6, 10, '2019-08-22', 1, 5),
(6, 8, 10, '1970-01-01', 1, 6),
(7, 7, 10, '1970-01-01', 1, 7),
(8, 9, 30, '1970-01-01', 1, 8),
(9, 10, 30, '2019-08-29', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `app_id` int(11) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_logo` varchar(255) NOT NULL,
  `app_full_address` varchar(255) NOT NULL,
  `app_contact` varchar(255) NOT NULL,
  `app_email` varchar(255) NOT NULL,
  `app_theme` varchar(255) NOT NULL,
  `bill_prefix` varchar(255) NOT NULL,
  `set_currency_id` int(11) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `ntn` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`app_id`, `app_name`, `app_logo`, `app_full_address`, `app_contact`, `app_email`, `app_theme`, `bill_prefix`, `set_currency_id`, `website`, `ntn`) VALUES
(1, 'Buraq Technologies', '30download.png', 'University Road Peshawar', '0433123123', 'company@gmail.com', '', 'BT-', 1, 'www.website.com', '123123');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `sl_id` int(11) NOT NULL,
  `sl_title` varchar(255) NOT NULL,
  `sl_description` varchar(500) NOT NULL,
  `sl_image` varchar(255) NOT NULL,
  `sl_btn1_text` varchar(255) NOT NULL,
  `sl_status` int(1) NOT NULL DEFAULT '1',
  `sl_btn1_link` varchar(255) NOT NULL,
  `sl_btn2_text` varchar(255) NOT NULL,
  `sl_btn2_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`sl_id`, `sl_title`, `sl_description`, `sl_image`, `sl_btn1_text`, `sl_status`, `sl_btn1_link`, `sl_btn2_text`, `sl_btn2_link`) VALUES
(1, 'Ladies Garments', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '44500_F_267715869_ok3kwZMSuANCIH4jTBZSPPU244l0pZcT.jpg', 'more garments', 1, 'more garments', 'more Info', 'more garments'),
(2, 'Shopping Bags', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '16500_F_233921601_vsAHfPP2OHt9ogiudw2fvKp20Bb3qzmb.jpg', 'Mini Bags', 0, 'btn link ', 'Large Bags', 'btn link 2'),
(3, 'T-Shirts ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '36main-image.png', 'Mini Shirt', 1, 'Mini Shirt', 'Large Shirt', 'Large Shirt'),
(4, 'new slider img', 'askdfjklasd klajsdklf jklasjdf klsjdfk jklsadj klasjdklkjsadljksfdjfk jskad jklsjd kjsdk jklasj fklsdjf kljsdkj saklj fksjdk fjaskldf jskdjf ksjf kljsklfj klsaj fkjsk lja skld', '', 'button 1 text', 0, 'www.facebook.com', 'button 2', 'www.twitter.com'),
(5, 'my slider', 'this is description', '57joker.jpg', 'asdf', 1, 'www.facebook.com', 'asdf', 'www.twitter.com');

-- --------------------------------------------------------

--
-- Table structure for table `spot_light`
--

CREATE TABLE `spot_light` (
  `spot_id` int(11) NOT NULL,
  `spot_image` varchar(255) NOT NULL,
  `spot_link` varchar(255) NOT NULL,
  `spot_status` int(1) DEFAULT '1',
  `spot_order` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spot_light`
--

INSERT INTO `spot_light` (`spot_id`, `spot_image`, `spot_link`, `spot_status`, `spot_order`) VALUES
(1, '48download.jpg', 'www.facebook.com', 1, 3),
(2, '52download(20).jpg', 'www.google.com', 0, 3),
(3, '11download(21).jpg', 'www.twitter.com', 0, 0),
(4, '571236avatar5.png', 'Notification', 0, 0),
(5, '', 'www.twitter.com', 0, 1),
(6, '31download.png', 'www.spotlight.com', 0, 2),
(7, '5132avatar04.png', 'www.spotlight.com', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `store_items`
--

CREATE TABLE `store_items` (
  `storeitem_id` int(11) NOT NULL,
  `storeitem_item_id` int(11) DEFAULT NULL,
  `storeitem_quantity` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_items`
--

INSERT INTO `store_items` (`storeitem_id`, `storeitem_item_id`, `storeitem_quantity`, `date`, `status`) VALUES
(2, 1, 50, '2019-07-29', '+'),
(3, 2, 50, '2019-07-31', '+'),
(4, 1, 2, '2019-07-30', '-'),
(6, 2, 5, '2019-07-30', '-'),
(7, 2, 80, '2019-07-29', '+'),
(8, 1, 50, '2019-07-29', '+'),
(9, 3, 40, '2019-07-29', '+'),
(10, 4, 33, '2019-07-29', '+'),
(11, 1, 1, '2019-07-29', '-'),
(12, 1, 1, '2019-07-29', '-'),
(13, 3, 2, '2019-07-29', '-'),
(14, 4, 1, '2019-07-29', '-'),
(15, 5, 100, '2019-07-30', '+'),
(16, 5, 5, '2019-07-30', '-'),
(17, 5, 5, '2019-07-30', '-'),
(18, 5, 10, '2019-07-30', '+'),
(19, 1, 1, '2019-08-03', '-'),
(20, 1, 1, '2019-08-04', '-'),
(21, 1, 1, '2019-08-05', '-'),
(22, NULL, NULL, '2019-08-02', '-'),
(23, 1, 1, '2019-08-06', '-'),
(24, 1, 1, '2019-08-07', '-'),
(25, 1, 1, '2019-08-08', '-'),
(26, 2, 1, '2019-08-02', '-'),
(27, 1, 1, '2019-08-02', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `task_title` varchar(500) NOT NULL,
  `task_description` varchar(1000) NOT NULL,
  `priority` varchar(30) NOT NULL,
  `task_res_person` varchar(255) NOT NULL,
  `task_deadline` text NOT NULL,
  `task_type` varchar(100) DEFAULT NULL,
  `task_status` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `project_id`, `task_title`, `task_description`, `priority`, `task_res_person`, `task_deadline`, `task_type`, `task_status`, `created_by`, `created_date`) VALUES
(5, 3, 'task 2', 'note', 'high', 'employ two', '06/25/2019', 'Bug', 'Progress', 1, '0000-00-00'),
(7, 3, 'tash 10', 'skdjfksd', 'Medium', 'Employ One', '06/24/2019', 'Bug', 'Lock', 1, '2019-06-24'),
(8, 7, 'task testing', 'hello', 'low', 'Employ One', '06/25/2019', NULL, NULL, 1, '2019-06-24'),
(9, 4, 'task two', 'asdfasfd', 'low', 'Employ One', '06/26/2019', NULL, 'Lock', 1, '2019-06-24'),
(10, 6, 'task newasfd ', 'asdfa sfd', 'low', 'Employ One', '06/17/2019', NULL, NULL, 1, '2019-06-24'),
(11, 5, 'askdfajfk', 'kjasdjfklalljfjasklfdjklasjfdkl ', 'Low', 'employ two', '06/24/2019', NULL, 'Lock', 1, '2019-06-24'),
(12, 3, 'new task', 'this is a new task', 'low', 'Employ One', '06/24/2019', 'Task', 'Progress', 1, '2019-06-24'),
(13, 3, 'check', 'asdfasfdsf', 'High', 'Employ One', '06/20/2019', 'Improvement', 'Progress', 1, '2019-06-24'),
(14, 3, 'create database', 'create database for', 'Low', 'employ two', '06/24/2019', 'Task', 'Progress', 1, '2019-06-24'),
(15, 12, 'hello', 'asdf', 'Low', 'employ two', '06/25/2019', 'Task', NULL, 1, '2019-06-24'),
(16, 1, 'new task', 'desc', 'High', 'abubakkar khan', '08/28/2019', 'Bug', NULL, 1, '2019-08-02'),
(17, 1, 'task 2', 'asdfadsff', 'Low', 'abubakkar khan', '08/27/2019', 'Task', NULL, 1, '2019-08-05'),
(18, 5, 'asdf', 'asdfasdf', 'Low', 'abubakkar khan', '08/27/2019', 'Task', NULL, 1, '2019-08-06'),
(19, 1, 'asfdf', 'asdfasdf', 'Low', 'abubakkar khan', '', 'Task', NULL, 1, '2019-08-06'),
(20, 1, 'asdf', 'asdfasdf', 'Low', 'abubakkar khan', '', 'Task', NULL, 1, '2019-08-06'),
(21, 1, 'asdfadsf', 'asdfsadf', 'Low', 'abubakkar khan', '', 'Task', NULL, 1, '2019-08-06'),
(22, 1, 'asdfasdfadsf', 'asdfasdfasdfasf asd asd fds', 'Low', 'abubakkar khan', '08/26/2019', 'Task', NULL, 1, '2019-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `tasks_record`
--

CREATE TABLE `tasks_record` (
  `task_rec_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `task_rec_date` varchar(50) NOT NULL,
  `task_updated_by` varchar(255) NOT NULL,
  `task_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks_record`
--

INSERT INTO `tasks_record` (`task_rec_id`, `task_id`, `task_rec_date`, `task_updated_by`, `task_status`) VALUES
(1, 14, '2019-06-24 10:14:39', '1', 'New'),
(2, 14, '2019-06-24 10:14:49', '1', 'Progress'),
(3, 14, '2019-06-24 10:14:58', '1', 'Done'),
(4, 13, '2019-06-24 10:23:25', '1', 'Progress'),
(5, 5, '2019-06-27 07:17:56', '1', 'Testing'),
(6, 5, '2019-06-27 07:17:57', '1', 'Lock'),
(7, 5, '2019-06-27 07:18:03', '1', 'Testing'),
(8, 5, '2019-06-27 07:18:04', '1', 'Done'),
(9, 5, '2019-06-27 07:18:05', '1', 'Progress'),
(10, 5, '2019-06-27 07:18:08', '1', 'New'),
(11, 5, '2019-06-27 07:18:14', '1', 'Progress'),
(12, 5, '2019-06-27 07:18:15', '1', 'Done'),
(13, 5, '2019-06-27 07:18:19', '1', 'Lock'),
(14, 5, '2019-06-27 07:18:26', '1', 'New'),
(15, 5, '2019-06-27 07:18:27', '1', 'Progress');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `tax_id` int(11) NOT NULL,
  `tax_title` varchar(100) NOT NULL,
  `tax_value` int(11) NOT NULL,
  `tax_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`tax_id`, `tax_title`, `tax_value`, `tax_type`) VALUES
(1, 'GST', 30, 0),
(2, 'S CHARGES', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tax_amount`
--

CREATE TABLE `tax_amount` (
  `tax_amount_id` int(11) NOT NULL,
  `sales_item_id` int(11) NOT NULL,
  `tax_name` varchar(200) NOT NULL,
  `tax_value` double NOT NULL,
  `tax_on` double NOT NULL,
  `tax_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax_amount`
--

INSERT INTO `tax_amount` (`tax_amount_id`, `sales_item_id`, `tax_name`, `tax_value`, `tax_on`, `tax_type`) VALUES
(1, 1, 'GST', 30, 30, 'FLAT'),
(2, 1, 'S CHARGES', 3, 10, '%'),
(3, 3, 'GST', 30, 30, 'FLAT'),
(4, 3, 'S CHARGES', 2, 10, '%'),
(5, 5, 'GST', 30, 30, 'FLAT');

-- --------------------------------------------------------

--
-- Table structure for table `timer`
--

CREATE TABLE `timer` (
  `timer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timer_date` text NOT NULL,
  `timer_current_day` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timer`
--

INSERT INTO `timer` (`timer_id`, `user_id`, `timer_date`, `timer_current_day`) VALUES
(3, 1, '2019-06-29 11:47:58', '2019-06-29');

-- --------------------------------------------------------

--
-- Table structure for table `timer_record`
--

CREATE TABLE `timer_record` (
  `timer_record_id` int(11) NOT NULL,
  `timer_id` int(11) NOT NULL,
  `timer_record_status` varchar(255) NOT NULL,
  `timer_record_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timer_record`
--

INSERT INTO `timer_record` (`timer_record_id`, `timer_id`, `timer_record_status`, `timer_record_date`) VALUES
(8, 3, 'start', '2019-06-29 11:47:58'),
(9, 3, 'pause', '2019-06-29 11:47:59'),
(10, 3, 'resume', '2019-06-29 11:48:10'),
(11, 3, 'pause', '2019-06-29 11:48:11'),
(12, 3, 'resume', '2019-06-29 14:25:27'),
(13, 3, 'pause', '2019-06-29 14:26:28'),
(14, 3, 'resume', '2019-06-29 14:26:29'),
(15, 3, 'close', '2019-06-29 14:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(200) DEFAULT NULL,
  `is_trash` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_name`, `is_trash`) VALUES
(1, 'Bottle', 0),
(2, 'Can', 0),
(3, 'mg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(100) DEFAULT NULL,
  `user_lname` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_contact` varchar(100) DEFAULT NULL,
  `user_address` varchar(200) DEFAULT NULL,
  `user_role` varchar(100) DEFAULT NULL,
  `users_img` varchar(100) DEFAULT NULL,
  `user_password` varchar(200) DEFAULT NULL,
  `pin_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_fname`, `user_lname`, `user_email`, `user_contact`, `user_address`, `user_role`, `users_img`, `user_password`, `pin_no`) VALUES
(1, 'Super a', 'Admin12', 'admin@gmail.com', '0010231233', '     kohat mardan sawabi', '1', '59images.png', '$2y$10$aii3jSdOebQrng6WT26OQuaXdNTPt/TM51c90wB85B8m5eYUYtuYy', NULL),
(144, 'Cocacola Psh', NULL, NULL, '03323344565', 'Ring Road Peshawar', '2', NULL, NULL, NULL),
(145, 'abubakkar', 'khan', 'abu@gmail.com', '021312341234', 'address', '4', '', '$2y$10$EGPYrTT5I3d2Fq.6bsk0ve7ONAvXSi5ACszB.uOyhGgX/GPbLsb6m', NULL),
(146, 'kamran', 'khan', 'kamran@gmail.com', '123123123', 'askdjfkalsdfkld', '4', '', '$2y$10$v0eErQTcGGxQkkrDoTU9Aen.4JmOhgJadDtwe/43rngZdYtTFQYyW', NULL),
(147, 'jjkjk', ' ', NULL, '123122312', 'address', '3', NULL, '$2y$10$xJm9WNy0lhPsO8oO0D5sreM3rI6bHGl8okEMz4Y6opPKwE7nciMVm', 147),
(148, 'khan afridi', ' ', NULL, '123132', 'asdfasdf', '3', NULL, '$2y$10$MdehV4wW1XJoOQ6XaQBLZ.F5F9gIgX9ku5H3akw0eCIPerzO87cFK', 148),
(149, 'project 1', ' ', NULL, '123123', 'akjsdfjasfdj kjsadjf', '3', NULL, '$2y$10$wULGJP4k3ZtGm2c/sZtxBucHJEzEpMAqfd/k4/Zaxq5gLZFPQW6kC', 149),
(150, 'project 2', ' ', NULL, '123123123', 'adfasdfsfd', '3', NULL, '$2y$10$vHsgTsD0DzirNoUjiT6vOuOo0ciuBpLe.BN32PQJm5jo8RxIA3/NG', 150),
(151, 'project 3', ' ', NULL, '123123', 'asdfasdf', '3', NULL, '$2y$10$i453H3fXYdIazZgTkdh72uYv61z0npDA8WzE4YW4LctOinEJSDUqy', 151),
(152, 'project', ' ', NULL, '2312321', 'address sadf klakdf', '3', NULL, '$2y$10$UQ1s3m0J6rhElgDO923XNenf869oWCLwFuTzUUlToyARP1ntrbN9G', 152),
(153, 'project testing', ' ', NULL, '123123', 'asdfsdf', '3', NULL, '$2y$10$KKiHh8MnNP7BH5cSdCQ3T.pU4aJuReerBuEteOqUxSISpSRlkzTNK', 153),
(154, 'asdfasdfasdf asdfasdf', ' ', NULL, '123123', 'aaddrreesss', '3', NULL, '$2y$10$yedXIvDsbctS5chy6FCg5OICZGvf0Gtb6Rv6tg/X5oD.//KsFH1AO', 154),
(155, 'asdasd', ' ', NULL, '2123123', 'asdasd', '3', NULL, '$2y$10$gay09E/Re2sdVtJlqhCKc.pEM5psN6RVY8oOXCTzq8J2U7kUY6B7m', 155),
(156, 'khan', NULL, 'khan@gmail.com', '123123123123', 'kohatroad', '3', NULL, '$2y$10$UY5iJEnuXmQcm3p.8nRrk.c7C8pB1y9VAsMxT2SbXCTw3RUPjl9Xm', NULL),
(157, 'khan 123', NULL, 'khan@gmail.com', '123123123123123', 'asdfasdfdsf', '3', NULL, '$2y$10$ddOHM87Sfw5Pu9Uc0KsR/uJflcd045W6gEB3U9mRGn.UmW5e7GOqG', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visitor_list`
--

CREATE TABLE `visitor_list` (
  `visitor_id` int(11) NOT NULL,
  `visitor_name` varchar(300) NOT NULL,
  `visitor_contact` varchar(30) NOT NULL,
  `visitor_purpose` varchar(1000) NOT NULL,
  `visit_created_by` int(11) NOT NULL,
  `visit_date` text NOT NULL,
  `visit_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitor_list`
--

INSERT INTO `visitor_list` (`visitor_id`, `visitor_name`, `visitor_contact`, `visitor_purpose`, `visit_created_by`, `visit_date`, `visit_status`) VALUES
(1, 'UJames', '1112345', ' UIt\'s me (James Bond). the purpose is to test the flow of the data in form.', 1, '2019-06-20 13:17:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `voucher_id` int(11) NOT NULL,
  `voucher_type` varchar(100) NOT NULL,
  `voucher_interaction` varchar(11) NOT NULL,
  `voucher_date` varchar(255) NOT NULL,
  `voucher_paying_via` varchar(11) NOT NULL,
  `voucher_particulars` varchar(200) NOT NULL,
  `voucher_desc` longtext NOT NULL,
  `voucher_status` int(11) NOT NULL,
  `voucher_post_date` varchar(255) DEFAULT NULL,
  `voucher_created_by` int(11) NOT NULL,
  `voucher_number` varchar(255) NOT NULL,
  `voucher_cancelation_reason` varchar(255) DEFAULT NULL,
  `voucher_cancelation_by` int(11) DEFAULT NULL,
  `voucher_cancelation_date` varchar(255) DEFAULT NULL,
  `post_status` int(11) DEFAULT '0',
  `voucher_img` varchar(200) DEFAULT NULL,
  `is_back` varchar(200) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`voucher_id`, `voucher_type`, `voucher_interaction`, `voucher_date`, `voucher_paying_via`, `voucher_particulars`, `voucher_desc`, `voucher_status`, `voucher_post_date`, `voucher_created_by`, `voucher_number`, `voucher_cancelation_reason`, `voucher_cancelation_by`, `voucher_cancelation_date`, `post_status`, `voucher_img`, `is_back`) VALUES
(1, 'PAYMENT', 'asdf', '', 'asdfdf', 'asdfasdfasdf', 'adfasdf', 0, NULL, 1, '1', NULL, NULL, NULL, 0, '', '1'),
(2, 'PAYMENT', 'gfd', '08/28/2019', 'dfgh', 'dfgh', 'dgfgh', 0, NULL, 1, '2', NULL, NULL, NULL, 0, '', '0'),
(3, 'PAYMENT', 'sdg', '08/27/2019', 'sdg', 'sdgsdgdg', 'sdfgsfdgsdgff dfs f sd d s d', 0, NULL, 1, '3', NULL, NULL, NULL, 0, '', '0'),
(4, 'PAYMENT', 'dfgsdg', '08/29/2019', 'sdfgdsfgs s', 'dsffgdsfg dsfg df gdf sd gdf g', 'sfgdgfsdg', 0, NULL, 1, '4', NULL, NULL, NULL, 0, '', '0'),
(5, 'PAYMENT', 'sfdgsdfg', '08/20/2019', 'sdfgsdfg', 'sdfgdfg', 'safsdfasdfasd', 0, NULL, 1, '5', NULL, NULL, NULL, 0, '', '0'),
(6, 'PAYMENT', 'asdf', '08/29/2019', 'asdfasdf', 'sadfasfds', 'sadfsdfsdf', 0, NULL, 1, '6', NULL, NULL, NULL, 0, '', '0'),
(7, 'PAYMENT', 'asdfasfd', '08/28/2019', 'asdfsaf', 'asdfsdf', 'asdfasfd', 0, NULL, 1, '7', NULL, NULL, NULL, 0, '', '0'),
(8, 'PAYMENT', 'asdfasdf', '08/27/2019', 'adfasfd', 'asdfasdfsf', '', 0, NULL, 1, '8', NULL, NULL, NULL, 0, '', '0'),
(9, 'PAYMENT', 'asdfasfd', '08/28/2019', 'asdf', 'asdf', 'asdfasdf', 0, NULL, 1, '9', NULL, NULL, NULL, 0, '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `voucher_heads`
--

CREATE TABLE `voucher_heads` (
  `voucher_h_id` int(11) NOT NULL,
  `voucher_id` int(11) DEFAULT NULL,
  `from_A_H` int(11) DEFAULT NULL,
  `for_A_H` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voucher_heads`
--

INSERT INTO `voucher_heads` (`voucher_h_id`, `voucher_id`, `from_A_H`, `for_A_H`, `amount`) VALUES
(1, 1, 1, 10, 200),
(2, 2, 1, 10, 10),
(3, 3, 1, 10, 3333),
(4, 4, 1, 10, 3333),
(5, 5, 1, 10, 22222),
(6, 6, 1, 10, 2333),
(7, 7, 1, 10, 222232),
(8, 8, 1, 10, 200),
(9, 9, 1, 10, 333223);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `warehouse_id` int(11) NOT NULL,
  `shelf_no` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accommodation`
--
ALTER TABLE `accommodation`
  ADD PRIMARY KEY (`accommodation_id`);

--
-- Indexes for table `accommodation_category`
--
ALTER TABLE `accommodation_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `category_slider`
--
ALTER TABLE `category_slider`
  ADD PRIMARY KEY (`cat_sl_id`);

--
-- Indexes for table `chart_of_account`
--
ALTER TABLE `chart_of_account`
  ADD PRIMARY KEY (`coa_id`);

--
-- Indexes for table `chart_of_account_subtype`
--
ALTER TABLE `chart_of_account_subtype`
  ADD PRIMARY KEY (`coa_subtype_id`);

--
-- Indexes for table `chart_of_account_type`
--
ALTER TABLE `chart_of_account_type`
  ADD PRIMARY KEY (`coa_type_id`);

--
-- Indexes for table `consumpted_items`
--
ALTER TABLE `consumpted_items`
  ADD PRIMARY KEY (`consumpted_item_id`);

--
-- Indexes for table `consumption`
--
ALTER TABLE `consumption`
  ADD PRIMARY KEY (`consumption_id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `general_journal`
--
ALTER TABLE `general_journal`
  ADD PRIMARY KEY (`general_journal_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `notes_ibfk_1` (`project_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notify_id`);

--
-- Indexes for table `order_tax`
--
ALTER TABLE `order_tax`
  ADD PRIMARY KEY (`order_tax_id`);

--
-- Indexes for table `pos`
--
ALTER TABLE `pos`
  ADD PRIMARY KEY (`pos_id`);

--
-- Indexes for table `pos_assignment`
--
ALTER TABLE `pos_assignment`
  ADD PRIMARY KEY (`pos_assign_id`);

--
-- Indexes for table `pos_items`
--
ALTER TABLE `pos_items`
  ADD PRIMARY KEY (`pos_items_id`);

--
-- Indexes for table `pos_order_type`
--
ALTER TABLE `pos_order_type`
  ADD PRIMARY KEY (`order_type_id`);

--
-- Indexes for table `pos_tax`
--
ALTER TABLE `pos_tax`
  ADD PRIMARY KEY (`pos_tax_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prd_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`prdc_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`prdimg_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`puritem_id`);

--
-- Indexes for table `purchase_payment`
--
ALTER TABLE `purchase_payment`
  ADD PRIMARY KEY (`purpayment_id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`rec_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD PRIMARY KEY (`salitem_id`);

--
-- Indexes for table `sales_payment`
--
ALTER TABLE `sales_payment`
  ADD PRIMARY KEY (`salpayment_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`sl_id`);

--
-- Indexes for table `spot_light`
--
ALTER TABLE `spot_light`
  ADD PRIMARY KEY (`spot_id`);

--
-- Indexes for table `store_items`
--
ALTER TABLE `store_items`
  ADD PRIMARY KEY (`storeitem_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `tasks_record`
--
ALTER TABLE `tasks_record`
  ADD PRIMARY KEY (`task_rec_id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `tax_amount`
--
ALTER TABLE `tax_amount`
  ADD PRIMARY KEY (`tax_amount_id`);

--
-- Indexes for table `timer`
--
ALTER TABLE `timer`
  ADD PRIMARY KEY (`timer_id`);

--
-- Indexes for table `timer_record`
--
ALTER TABLE `timer_record`
  ADD PRIMARY KEY (`timer_record_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `visitor_list`
--
ALTER TABLE `visitor_list`
  ADD PRIMARY KEY (`visitor_id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`voucher_id`);

--
-- Indexes for table `voucher_heads`
--
ALTER TABLE `voucher_heads`
  ADD PRIMARY KEY (`voucher_h_id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`warehouse_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accommodation`
--
ALTER TABLE `accommodation`
  MODIFY `accommodation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `accommodation_category`
--
ALTER TABLE `accommodation_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category_slider`
--
ALTER TABLE `category_slider`
  MODIFY `cat_sl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `chart_of_account`
--
ALTER TABLE `chart_of_account`
  MODIFY `coa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `chart_of_account_subtype`
--
ALTER TABLE `chart_of_account_subtype`
  MODIFY `coa_subtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `chart_of_account_type`
--
ALTER TABLE `chart_of_account_type`
  MODIFY `coa_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `consumpted_items`
--
ALTER TABLE `consumpted_items`
  MODIFY `consumpted_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `consumption`
--
ALTER TABLE `consumption`
  MODIFY `consumption_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_journal`
--
ALTER TABLE `general_journal`
  MODIFY `general_journal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notify_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `order_tax`
--
ALTER TABLE `order_tax`
  MODIFY `order_tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pos`
--
ALTER TABLE `pos`
  MODIFY `pos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pos_assignment`
--
ALTER TABLE `pos_assignment`
  MODIFY `pos_assign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pos_items`
--
ALTER TABLE `pos_items`
  MODIFY `pos_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `pos_order_type`
--
ALTER TABLE `pos_order_type`
  MODIFY `order_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pos_tax`
--
ALTER TABLE `pos_tax`
  MODIFY `pos_tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `prdc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `prdimg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `puritem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `purchase_payment`
--
ALTER TABLE `purchase_payment`
  MODIFY `purpayment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `rec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `salitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sales_payment`
--
ALTER TABLE `sales_payment`
  MODIFY `salpayment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `sl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `spot_light`
--
ALTER TABLE `spot_light`
  MODIFY `spot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `store_items`
--
ALTER TABLE `store_items`
  MODIFY `storeitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tasks_record`
--
ALTER TABLE `tasks_record`
  MODIFY `task_rec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tax_amount`
--
ALTER TABLE `tax_amount`
  MODIFY `tax_amount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `timer`
--
ALTER TABLE `timer`
  MODIFY `timer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `timer_record`
--
ALTER TABLE `timer_record`
  MODIFY `timer_record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `visitor_list`
--
ALTER TABLE `visitor_list`
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `voucher_heads`
--
ALTER TABLE `voucher_heads`
  MODIFY `voucher_h_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `warehouse_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);

--
-- Constraints for table `tasks_record`
--
ALTER TABLE `tasks_record`
  ADD CONSTRAINT `tasks_record_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
