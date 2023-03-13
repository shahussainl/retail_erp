-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2020 at 09:13 PM
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

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `project_id`, `file_title`, `upload_file`, `file_upload_date`) VALUES
(1, 3, 'First File ', '4708computer-programmer-coding-on-laptop.jpg', '2019-06-12'),
(3, 3, 'pdf file', '<p>The filetype you are attempting to upload is not allowed.</p>', '2019-06-05');

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
(1, 16, 210, 0, '', 'purchase POS', 9, '2019-07-19', 1, '03:40:57'),
(2, 1, 0, 210, '', 'purchase POS', 9, '2019-07-19', 1, '03:40:57'),
(3, 16, 210, 0, '', 'purchase POS', 10, '2019-07-19', 1, '03:41:10'),
(4, 1, 0, 210, '', 'purchase POS', 10, '2019-07-19', 1, '03:41:10'),
(5, 16, 320, 0, '', 'purchase POS', 11, '2019-07-19', 1, '03:47:13'),
(6, 1, 0, 320, '', 'purchase POS', 11, '2019-07-19', 1, '03:47:13'),
(7, 16, 200, 0, '', 'purchase POS', 15, '2019-07-19', 1, '03:52:14'),
(8, 1, 0, 200, '', 'purchase POS', 15, '2019-07-19', 1, '03:52:14'),
(9, 16, 300, 0, '', 'purchase POS', 16, '2019-07-19', 1, '03:53:37'),
(10, 1, 0, 300, '', 'purchase POS', 16, '2019-07-19', 1, '03:53:37'),
(11, 16, 500, 0, '', 'purchase POS', 20, '2019-07-19', 1, '08:09:48'),
(12, 1, 0, 500, '', 'purchase POS', 20, '2019-07-19', 1, '08:09:48'),
(13, 16, 100, 0, '', 'purchase POS', 21, '2019-07-19', 1, '08:46:33'),
(14, 1, 0, 100, '', 'purchase POS', 21, '2019-07-19', 1, '08:46:33'),
(15, 16, 120, 0, '', 'purchase POS', 21, '2019-07-19', 1, '08:52:08'),
(16, 1, 0, 120, '', 'purchase POS', 21, '2019-07-19', 1, '08:52:08'),
(17, 16, 380, 0, '', 'purchase POS', 21, '2019-07-19', 1, '08:52:25'),
(18, 1, 0, 380, '', 'purchase POS', 21, '2019-07-19', 1, '08:52:25'),
(19, 16, 380, 0, '', 'purchase POS', 21, '2019-07-19', 1, '08:56:29'),
(20, 1, 0, 380, '', 'purchase POS', 21, '2019-07-19', 1, '08:56:29'),
(21, 16, 20, 0, '', 'purchase POS', 22, '2019-07-19', 1, '10:31:54'),
(22, 1, 0, 20, '', 'purchase POS', 22, '2019-07-19', 1, '10:31:54'),
(23, 16, 200, 0, '', 'purchase POS', 23, '2019-07-19', 1, '10:36:38'),
(24, 1, 0, 200, '', 'purchase POS', 23, '2019-07-19', 1, '10:36:38'),
(25, 16, 1231, 0, '', 'purchase POS', 25, '2019-07-20', 1, '10:53:52'),
(26, 1, 0, 1231, '', 'purchase POS', 25, '2019-07-20', 1, '10:53:52'),
(27, 16, 232, 0, '', 'purchase POS', 25, '2019-07-20', 1, '10:54:03'),
(28, 1, 0, 232, '', 'purchase POS', 25, '2019-07-20', 1, '10:54:03'),
(29, 16, 300, 0, '', 'purchase POS', 26, '2019-07-20', 1, '12:15:59'),
(30, 1, 0, 300, '', 'purchase POS', 26, '2019-07-20', 1, '12:15:59'),
(31, 16, 0.1, 0, '', 'purchase POS', 26, '2019-07-20', 1, '12:30:39'),
(32, 1, 0, 0.1, '', 'purchase POS', 26, '2019-07-20', 1, '12:30:39'),
(33, 16, 0.1, 0, '', 'purchase POS', 26, '2019-07-20', 1, '12:31:43'),
(34, 1, 0, 0.1, '', 'purchase POS', 26, '2019-07-20', 1, '12:31:43'),
(35, 16, 12, 0, '', 'purchase POS', 27, '2019-07-20', 1, '12:35:32'),
(36, 1, 0, 12, '', 'purchase POS', 27, '2019-07-20', 1, '12:35:32'),
(37, 16, 0, 0, '', 'purchase POS', 27, '2019-07-20', 1, '12:35:57'),
(38, 1, 0, 0, '', 'purchase POS', 27, '2019-07-20', 1, '12:35:57'),
(39, 16, 0.4, 0, '', 'purchase POS', 27, '2019-07-20', 1, '12:49:20'),
(40, 1, 0, 0.4, '', 'purchase POS', 27, '2019-07-20', 1, '12:49:20');

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
(1, 3, 'Note about testing', 'this is a description of note about the testing title. this is a description of note about the testing title.this is a description of note about the testing title.', 1),
(2, 3, 'brt note', 'this is brt project note', 1),
(3, 3, 'brt note', ' jasdjfasjdkf ', 1),
(4, 3, 'this is another note', ' hello', 1),
(5, 3, 'hey', 'hey', 1),
(6, 3, 'hey', 'hey', 1),
(7, 5, 'hey', 'hey', 1),
(8, 5, 'heyyyyy', 'heyyyyy', 1),
(9, 4, 'hello', 'hello', 1),
(10, 6, 'hey', 'hey', 1),
(11, 4, 'hey', 'hey', 1),
(12, 3, 'hey', 'hey', 1),
(14, 0, 'note', 'testing', NULL);

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
(1, '1', 'Update', 'Product', 'jlk', '2019-06-17 12:54:39', 1),
(2, '1', 'Update', 'Product', 'jlk', '2019-06-17 12:57:39', 0),
(3, '1', 'Delete', 'Product', 'jlk', '2019-06-17 13:05:22', 0),
(4, '1', 'Create', 'Product', 'triggers', '2019-06-17 13:06:43', 0),
(5, '1', 'Update', 'ProductCategory', 'testingNotificationsTriggers', '2019-06-17 13:07:22', 0),
(6, '1', 'Delete', 'ProductCategory', 'testingNotificationsTriggers', '2019-06-17 13:08:58', 0),
(7, '1', 'Create', 'ProductCategory', 'NotifyTrigger', '2019-06-17 13:09:25', 0),
(8, '1', 'session destroy', 'Logout', 'logout', '2019-06-19 11:20:33', 0),
(9, '1', 'session start', 'Login', 'login', '2019-06-19 11:21:13', 0),
(10, '1', 'session destroy', 'Logout', 'logout', '2019-06-19 12:20:48', 0),
(11, '2', 'session start', 'Login', 'login', '2019-06-19 12:20:58', 0),
(12, '2', 'session destroy', 'Logout', 'logout', '2019-06-19 12:22:52', 0),
(13, '1', 'session start', 'Login', 'login', '2019-06-19 12:23:05', 0),
(14, '1', 'session start', 'Login', 'login', '2019-06-20 06:55:06', 0),
(15, '1', 'session start', 'Login', 'login', '2019-06-22 07:14:23', 0),
(16, '1', 'session start', 'Login', 'login', '2019-06-22 19:13:59', 0),
(17, '1', 'session start', 'Login', 'login', '2019-06-24 06:17:46', 0),
(18, '1', 'session start', 'Login', 'login', '2019-06-24 16:47:10', 0),
(19, '1', 'session start', 'Login', 'login', '2019-06-25 11:33:55', 0),
(20, '1', 'session start', 'Login', 'login', '2019-06-27 21:12:42', 0),
(21, '1', 'session start', 'Login', 'login', '2019-06-28 06:16:19', 0),
(22, '1', 'session start', 'Login', 'login', '2019-06-28 11:44:41', 0),
(23, '1', 'session start', 'Login', 'login', '2019-06-29 07:26:55', 0),
(24, '1', 'session start', 'Login', 'login', '2019-06-30 13:45:04', 0),
(25, '1', 'session start', 'Login', 'login', '2019-07-01 06:20:53', 0),
(26, '1', 'session start', 'Login', 'login', '2019-07-01 12:38:14', 0),
(27, '1', 'session start', 'Login', 'login', '2019-07-02 07:14:31', 0),
(28, '1', 'session start', 'Login', 'login', '2019-07-03 06:44:00', 0),
(29, '1', 'session start', 'Login', 'login', '2019-07-03 10:18:26', 0),
(30, '1', 'session start', 'Login', 'login', '2019-07-04 06:23:18', 0),
(31, '1', 'session start', 'Login', 'login', '2019-07-04 07:30:51', 0),
(32, '1', 'session start', 'Login', 'login', '2019-07-05 06:45:15', 0),
(33, '1', 'session destroy', 'Logout', 'logout', '2019-07-05 13:19:27', 0),
(34, '1', 'session start', 'Login', 'login', '2019-07-05 13:23:37', 0),
(35, '1', 'session start', 'Login', 'login', '2019-07-06 07:11:31', 0),
(36, '1', 'session start', 'Login', 'login', '2019-07-08 06:55:59', 0),
(37, '1', 'session start', 'Login', 'login', '2019-07-09 06:08:13', 0),
(38, '1', 'session start', 'Login', 'login', '2019-07-10 06:54:38', 0),
(39, '1', 'session start', 'Login', 'login', '2019-07-10 11:31:02', 0),
(40, '1', 'session start', 'Login', 'login', '2019-07-11 06:20:28', 0),
(41, '1', 'session start', 'Login', 'login', '2019-07-11 09:04:23', 0),
(42, '1', 'session start', 'Login', 'login', '2019-07-12 06:36:13', 0),
(43, '1', 'session start', 'Login', 'login', '2019-07-12 17:41:11', 0),
(44, '1', 'session start', 'Login', 'login', '2019-07-13 06:48:20', 0),
(45, '1', 'session start', 'Login', 'login', '2019-07-13 09:30:31', 0),
(46, '1', 'session start', 'Login', 'login', '2019-07-15 06:22:02', 0),
(47, '1', 'session start', 'Login', 'login', '2019-07-15 19:10:32', 0),
(48, '1', 'session start', 'Login', 'login', '2019-07-16 07:04:27', 0),
(49, '1', 'session start', 'Login', 'login', '2019-07-17 06:47:22', 0),
(50, '1', 'session start', 'Login', 'login', '2019-07-18 06:53:01', 0),
(51, '1', 'session destroy', 'Logout', 'logout', '2019-07-18 15:37:27', 0),
(52, '1', 'session start', 'Login', 'login', '2019-07-19 07:24:43', 0),
(53, '1', 'Update', 'Product', 'triggers', '2019-07-19 11:47:54', 0),
(54, '1', 'Update', 'Product', 'Sec Category Pro', '2019-07-19 11:48:08', 0),
(55, '1', 'Update', 'Product', '', '2019-07-19 11:48:40', 0),
(56, '1', 'Update', 'Product', '', '2019-07-19 11:48:48', 0),
(57, '1', 'Update', 'Product', 'two', '2019-07-19 11:48:53', 0),
(58, '1', 'Update', 'Product', 'one', '2019-07-19 11:48:57', 0),
(59, '1', 'Update', 'Product', '', '2019-07-19 12:28:18', 0),
(60, '1', 'Update', 'Product', 'Sec Category Pro', '2019-07-19 12:28:31', 0),
(61, '1', 'Delete', 'Product', 'Product Name  123', '2019-07-19 12:28:56', 0),
(62, '1', 'session start', 'Login', 'login', '2019-07-20 07:38:51', 0),
(63, '1', 'session start', 'Login', 'login', '2020-06-27 21:11:44', 0);

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
(1, 1, 30, 'FLAT', 30, 'GST'),
(2, 2, 30, 'FLAT', 30, 'GST'),
(3, 2, 72, '%', 10, 'S CHARGES'),
(4, 3, 30, 'FLAT', 30, 'GST'),
(8, 4, 116, '%', 10, 'S CHARGES'),
(9, 5, 300, '%', 10, 'S CHARGES'),
(10, 6, 30, 'FLAT', 30, 'GST'),
(12, 7, 30, 'FLAT', 30, 'GST'),
(13, 7, 403, '%', 10, 'S CHARGES'),
(14, 8, 355, '%', 10, 'S CHARGES'),
(15, 9, 30, 'FLAT', 30, 'GST');

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
  `pos_balance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos`
--

INSERT INTO `pos` (`pos_id`, `pos_assign_id`, `order_type_id`, `pos_date`, `pos_terminal`, `pos_created_by`, `pos_discount_price`, `pos_discounted_off`, `pos_discount_type`, `pos_discount_value`, `pos_additional_note`, `pos_bill_total`, `pos_status`, `pos_paid_amount`, `pos_balance`) VALUES
(12, NULL, 3, '2019-07-19 10:46:46', 1, 1, 2210, 0, '', 0, '', 2210, '1', 2210, 2210),
(13, NULL, 3, '2019-07-19 10:47:16', 1, 1, 5633, 0, '', 0, '', 5633, '1', 5633, 5633);

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
(1, 12, 17, 2000, 1, '1', '2019-07-19'),
(2, 12, 18, 210, 1, '2', '2019-07-19'),
(3, 13, 17, 2000, 1, '1', '2019-07-19'),
(4, 13, 22, 300, 1, '1', '2019-07-19'),
(5, 13, 24, 3333, 1, '2', '2019-07-19');

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
  `prd_unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prd_id`, `prd_prdc_id`, `prd_title`, `prd_code`, `prd_desc`, `prd_is_sale`, `prd_is_purchase`, `prd_price`, `prd_wholesales_price`, `prd_created_date`, `prd_updated_date`, `prd_status`, `prd_unit_id`) VALUES
(16, 2, 'Product Name  123', 'Product Code123', 'This is my product a ', 0, 0, 20, 10, '2019-05-20', '2019-07-19', 1, 1),
(17, 2, 'Product Name ', '1000', 'This is my product11', 1, 1, 2000, 100, '2019-05-20', '2019-05-22', NULL, 1),
(18, 5, 'Sec Category Pro', '0007', 'this is description', 1, 1, 210.12, 12312, '2019-05-21', '2019-07-19', NULL, 2),
(19, 2, 'abc', '123123', 'desc', 1, 1, 1222, 123123, '2019-06-14', '2019-06-17', 1, 2),
(20, 7, 'product testing', 'PC123', 'This product is for sale and purchase', 0, 0, 200, 150, '2019-06-15', '2019-06-15', 1, 1),
(21, 7, 'Product testing', 'PC123', 'this product is for sale and purchase', 0, 0, 200, 150, '2019-06-15', '2019-06-15', 1, 1),
(22, 7, 'Bags', 'BG123', 'This  product is for sale and purchase.', 1, 1, 300, 200, '2019-06-15', '2019-06-17', NULL, 1),
(23, 5, 'jlk', '3', 'dddd', 1, 1, 555, 3, '2019-06-17', '2019-06-17', 1, 2),
(24, 0, 'triggers', '333', '333dsafadsf', 1, 0, 3333, 33, '2019-06-17', '2019-07-19', NULL, 2);

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
(2, 'One', '0000-00-00', '2019-05-20', NULL),
(3, 'Two', '2019-05-20', '2019-05-20', 1),
(4, 'Three', '2019-05-20', '2019-05-20', 1),
(5, 'two', '2019-05-21', NULL, NULL),
(6, 'category testing  1', '2019-06-15', '2019-06-15', 1),
(7, 'new category', '2019-06-15', NULL, NULL),
(8, 'testingNotificationsTriggers', '2019-06-17', '2019-06-17', 1),
(9, 'NotifyTrigger', '2019-06-17', NULL, NULL);

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
(7, 18, '5636avatar.png', ''),
(9, 20, '1459376047_2192550714127128_5254552552879423488_n.jpg', ''),
(10, 20, '14download.jpg', ''),
(11, 20, '14IMG_7512.JPG', ''),
(12, 21, '34552e97cb3b41c539d440cb6cf51a66b8--softball-logos-softball-bats.jpg', 'team name'),
(13, 21, '3459376047_2192550714127128_5254552552879423488_n.jpg', 'nothing'),
(15, 21, '39download.jpg', ''),
(16, 22, '05bv-civo91455c4cd67667bd15f960304f4f891b.jpg', 'Bag 1'),
(17, 22, '05images(1).jpg', 'Bag 2'),
(18, 23, '26816254ee6d697860a555d61a4c72d702.jpg', ''),
(19, 24, '43pi1.jpg', ''),
(20, 18, '3128images(1).jpg', '');

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
(3, 'BRT', 'brt@gmail.com', 'Employ One', 'Employ One : employ two', '06/06/2019', 0, '0459376047_2192550714127128_5254552552879423488_n.jpg', 'description', 2000000000, 0),
(4, 'new project', 'pro2@gmail.com', 'Employ One', 'employ two', '06/08/2019', 0, '3659376047_2192550714127128_5254552552879423488_n.jpg', 'description', 2147483647, 0),
(5, '3rd project', 'pafa@gmail.com', 'Employ One', 'employ two', '06/04/2019', 1, '', 'asdfsf', 123123, 0),
(6, 'project 4th', 'aals@gmail.com', 'Employ One', 'employ two', '06/05/2019', 2, '', 'asdasdf', 123123, 0),
(7, 'hey', 'sdjfa@gmail.com', 'Employ One', 'Employ One : employ two', '06/05/2019', 0, '', 'notes', 2147483647, 1);

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
  `is_purchase_close` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `purchase_number`, `purchase_date`, `purchase_vendor_id`, `purchase_created_by`, `purchase_created_date`, `purchase_additional_note`, `purchase_status`, `pur_ref_id`, `is_ref`, `post_status`, `pur_closing_status`, `cancel_by`, `cancel_reason`, `cancelation_date`, `purchase_bill_total`, `is_purchase_close`) VALUES
(20, '1', '2019-07-19 20:09:48', 99, 1, '2019-07-19 20:09:48', '', 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, 500, 1),
(21, '2', '2019-07-19 20:13:16', 99, 1, '2019-07-19 20:13:16', '', 1, NULL, NULL, 0, 0, NULL, NULL, NULL, 600, 1),
(22, '3', '2019-07-19 22:24:32', 99, 1, '2019-07-19 22:24:32', '', 1, NULL, NULL, 0, 0, NULL, NULL, NULL, 20, 1),
(23, '4', '2019-07-19 22:36:20', 99, 1, '2019-07-19 22:36:20', 'some additional notes', 1, NULL, NULL, 0, 0, NULL, NULL, NULL, 200, 1),
(24, '5', '2019-07-19 22:41:03', 99, 1, '2019-07-19 22:41:03', '', 0, NULL, NULL, 0, 0, NULL, NULL, NULL, 212.48, 0),
(25, '6', '2019-07-20 10:53:13', 99, 1, '2019-07-20 10:53:13', '', 0, NULL, NULL, 0, 0, NULL, NULL, NULL, 12312312, 0),
(26, '7', '2019-07-20 11:52:54', 99, 1, '2019-07-20 11:52:54', '', 1, NULL, NULL, 0, 0, NULL, NULL, NULL, 300.2, 1),
(27, '8', '2019-07-20 12:33:50', 99, 1, '2019-07-20 12:33:50', '', 1, NULL, NULL, 0, 0, NULL, NULL, NULL, 12.4, 1);

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
(21, 20, 17, 5, 1, 100, 1, '2019-07-19 20:09:48'),
(22, 21, 17, 2, 1, 100, 1, '2019-07-19 20:13:16'),
(23, 21, 22, 2, 1, 200, 1, '2019-07-19 20:13:16'),
(26, 22, 17, 1, 1, 10.09, 1, '2019-07-19 22:24:32'),
(27, 22, 18, 1, 2, 10.21, 1, '2019-07-19 22:24:32'),
(37, 23, 22, 2, 1, 100, 1, '2019-07-19 22:36:20'),
(38, 24, 17, 1, 1, 12, 1, '2019-07-19 22:41:03'),
(39, 24, 18, 2, 2, 100.24, 1, '2019-07-19 22:41:03'),
(40, 26, 17, 1, 1, 100, 1, '2019-07-20 11:52:54'),
(41, 26, 18, 1, 2, 200.2, 1, '2019-07-20 11:52:54'),
(42, 27, 17, 1, 1, 12.4, 1, '2019-07-20 12:33:50');

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
(16, 20, 500, '2019-07-19', 1, 0),
(17, 21, 100, '2019-07-19', 1, 0),
(18, 21, 120, '2019-07-19', 1, 0),
(20, 21, 380, '2019-07-19', 1, 0),
(21, 22, 20, '2019-07-19', 1, 0),
(22, 23, 200, '2019-07-19', 1, 0),
(23, 25, 1231, '2019-07-20', 1, 0),
(24, 25, 232, '2019-07-20', 1, 0),
(25, 26, 300, '2019-07-20', 1, 0),
(26, 26, 0.1, '2019-07-20', 1, 0),
(27, 26, 0.1, '2019-07-20', 1, 0),
(28, 27, 12, '2019-07-20', 1, 0),
(29, 27, 0, '2019-07-20', 1, 0),
(30, 27, 0.4, '2019-07-20', 1, 0);

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
(1, 'Buraq Technologies', '09816254ee6d697860a555d61a4c72d702.jpg', 'University Road Peshawar', '0433123123', 'company@gmail.com', '', 'BT-', 1, 'www.website.com', '123123');

-- --------------------------------------------------------

--
-- Table structure for table `store_items`
--

CREATE TABLE `store_items` (
  `storeitem_id` int(11) NOT NULL,
  `storeitem_item_id` int(11) DEFAULT NULL,
  `storeitem_quantity` int(11) DEFAULT NULL,
  `storeitem_updated_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_items`
--

INSERT INTO `store_items` (`storeitem_id`, `storeitem_item_id`, `storeitem_quantity`, `storeitem_updated_date`) VALUES
(4, 2, 2, '2019-07-19'),
(5, 1, 1, '2019-07-20'),
(6, 1, 1, '2019-07-20'),
(7, 1, 1, '2019-07-20');

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
(15, 12, 'hello', 'asdf', 'Low', 'employ two', '06/25/2019', 'Task', NULL, 1, '2019-06-24');

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
(1, 'Gram', 0),
(2, 'kilogram', 0),
(3, 'liter', 0),
(4, 'abc 2', 1),
(5, 'abc', 1);

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
(1, 'Super a', 'Admin12', 'admin@gmail.com', '0010231233', '     kohat mardan sawabi', '1', '1236avatar5.png', '$2y$10$aii3jSdOebQrng6WT26OQuaXdNTPt/TM51c90wB85B8m5eYUYtuYy', NULL),
(2, 'Arsalan', 'Nasir', 'ars@gmail.com', '123123123', 'kohat, peshawar', '1', '1336avatar.png', '$2y$10$aii3jSdOebQrng6WT26OQuaXdNTPt/TM51c90wB85B8m5eYUYtuYy', NULL),
(99, 'abubakkar.tahir.khan@gmail.com', NULL, NULL, '03419110453', 'nouthia jadeed peshawar', '2', NULL, NULL, NULL);

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
(1, 'PAYMENT', 'Ali', '07/19/2019', 'cash', '1220pak', 'it,s about salary', 0, '07/19/2019', 1, '1', NULL, NULL, NULL, 1, '', '0');

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
(1, 1, 1, 21, 3000);

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
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `general_journal`
--
ALTER TABLE `general_journal`
  MODIFY `general_journal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notify_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `order_tax`
--
ALTER TABLE `order_tax`
  MODIFY `order_tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pos`
--
ALTER TABLE `pos`
  MODIFY `pos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pos_assignment`
--
ALTER TABLE `pos_assignment`
  MODIFY `pos_assign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pos_items`
--
ALTER TABLE `pos_items`
  MODIFY `pos_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `prd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `prdc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `prdimg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `puritem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `purchase_payment`
--
ALTER TABLE `purchase_payment`
  MODIFY `purpayment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `rec_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `salitem_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_payment`
--
ALTER TABLE `sales_payment`
  MODIFY `salpayment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `store_items`
--
ALTER TABLE `store_items`
  MODIFY `storeitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `tax_amount_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `visitor_list`
--
ALTER TABLE `visitor_list`
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `voucher_heads`
--
ALTER TABLE `voucher_heads`
  MODIFY `voucher_h_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);

--
-- Constraints for table `tasks_record`
--
ALTER TABLE `tasks_record`
  ADD CONSTRAINT `tasks_record_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
