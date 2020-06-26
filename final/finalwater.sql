-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2020 at 06:35 AM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 5.6.40-21+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finalwater`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `accId` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_type_Id` int(11) NOT NULL,
  `is_verified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`accId`, `password`, `email`, `user_type_Id`, `is_verified`) VALUES
('2020100100', 'guilaran', 'maykil@gmail.com', 1, 1),
('2020100102', '123', 'billing@gmail.com', 2, 1),
('2020218521', '1234', 'testing@gmail.com', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `account_status`
--

CREATE TABLE `account_status` (
  `account_status_id` int(11) NOT NULL,
  `account_status_date` date NOT NULL,
  `account_status_type_id` int(11) NOT NULL,
  `customer_account_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_status`
--

INSERT INTO `account_status` (`account_status_id`, `account_status_date`, `account_status_type_id`, `customer_account_id`) VALUES
(4, '2020-05-18', 1, '20200067462020-LGO'),
(5, '2020-05-18', 1, '20205212212020-POB'),
(7, '2020-05-19', 2, '20200067462020-LGO'),
(8, '2020-04-25', 7, '20200067462020-LGO'),
(9, '2020-05-28', 1, '202000674605-POB');

-- --------------------------------------------------------

--
-- Table structure for table `account_status_type`
--

CREATE TABLE `account_status_type` (
  `account_status_type_id` int(11) NOT NULL,
  `account_status_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_status_type`
--

INSERT INTO `account_status_type` (`account_status_type_id`, `account_status_desc`) VALUES
(1, 'Deactivate'),
(2, 'Active'),
(3, 'Disconnected'),
(4, 'For Disconnection'),
(5, 'For Reconnection');

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE `account_type` (
  `account_type_code` int(11) NOT NULL,
  `account_type_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`account_type_code`, `account_type_desc`) VALUES
(101, 'Residential'),
(102, 'Institutional'),
(103, 'Commercial'),
(104, 'Industrial'),
(105, 'Bulk Water');

-- --------------------------------------------------------

--
-- Table structure for table `account_type_fees`
--

CREATE TABLE `account_type_fees` (
  `account_type_price` float NOT NULL,
  `account_type_code` int(11) NOT NULL,
  `cubic_range_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_type_fees`
--

INSERT INTO `account_type_fees` (`account_type_price`, `account_type_code`, `cubic_range_id`) VALUES
(12, 101, 1),
(16, 101, 2),
(18, 101, 3),
(20, 101, 4),
(22, 101, 5),
(27, 102, 1),
(29, 102, 2),
(31, 102, 3),
(33, 102, 4),
(27, 103, 1),
(29, 103, 2),
(31, 103, 3),
(33, 103, 4),
(27, 104, 1),
(29, 104, 2),
(31, 104, 3),
(33, 104, 4),
(17, 105, 1),
(19, 105, 2),
(21, 105, 3),
(22, 105, 4);

-- --------------------------------------------------------

--
-- Table structure for table `admin_auth`
--

CREATE TABLE `admin_auth` (
  `ap_id` int(11) NOT NULL,
  `ap_desc` varchar(255) NOT NULL,
  `auth` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_auth`
--

INSERT INTO `admin_auth` (`ap_id`, `ap_desc`, `auth`) VALUES
(1, 'allow cashier', 0);

-- --------------------------------------------------------

--
-- Table structure for table `barangay`
--

CREATE TABLE `barangay` (
  `brgy_id` int(11) NOT NULL,
  `brgy_name` varchar(255) NOT NULL,
  `brgy_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barangay`
--

INSERT INTO `barangay` (`brgy_id`, `brgy_name`, `brgy_code`) VALUES
(1, 'Loguilo', 'LGO'),
(2, 'Poblacion', 'POB');

-- --------------------------------------------------------

--
-- Table structure for table `bulk`
--

CREATE TABLE `bulk` (
  `bulk_id` int(11) NOT NULL,
  `bulk_name` varchar(255) NOT NULL,
  `bulk_cubic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cubic_range`
--

CREATE TABLE `cubic_range` (
  `cubic_range_id` int(11) NOT NULL,
  `cubic_range_from` int(11) NOT NULL,
  `cubic_range_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cubic_range`
--

INSERT INTO `cubic_range` (`cubic_range_id`, `cubic_range_from`, `cubic_range_to`) VALUES
(1, 0, 15),
(3, 26, 35),
(4, 36, 45),
(5, 46, 55),
(2, 16, 25);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `contactNo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `contactNo`) VALUES
('2020006746', 'Michael', 'Guilaran', '12345'),
('2020521221', 'Val', 'Casiano', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `customer_account`
--

CREATE TABLE `customer_account` (
  `customer_account_id` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `account_type_code` int(11) NOT NULL,
  `admin_permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_account`
--

INSERT INTO `customer_account` (`customer_account_id`, `customer_id`, `account_type_code`, `admin_permission`) VALUES
('20200067462020-LGO', '2020006746', 101, 0),
('20205212212020-POB', '2020521221', 101, 0),
('202000674605-POB', '2020006746', 102, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_account_address`
--

CREATE TABLE `customer_account_address` (
  `customer_address_id` varchar(255) NOT NULL,
  `street_building` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `zip_postcode` int(11) NOT NULL,
  `customer_account_id` varchar(255) NOT NULL,
  `brgy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_account_address`
--

INSERT INTO `customer_account_address` (`customer_address_id`, `street_building`, `municipality`, `zip_postcode`, `customer_account_id`, `brgy_id`) VALUES
('20200067462020-LGO', 'purok 1', 'Alubijib', 1980, '20200067462020-LGO', 1),
('20205212212020-POB', 'purok 1', 'Alubijib', 1980, '20205212212020-POB', 2),
('202000674605-POB', 'purok 2', 'Alubijib', 1980, '202000674605-POB', 2);

-- --------------------------------------------------------

--
-- Table structure for table `customer_bill_record`
--

CREATE TABLE `customer_bill_record` (
  `cbrID` int(11) NOT NULL,
  `meter_reading_id` varchar(255) NOT NULL,
  `OR_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_bill_record`
--

INSERT INTO `customer_bill_record` (`cbrID`, `meter_reading_id`, `OR_number`) VALUES
(1, '2', 'sample-1'),
(2, '4', 'sample-2');

-- --------------------------------------------------------

--
-- Table structure for table `customer_payment`
--

CREATE TABLE `customer_payment` (
  `OR_number` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `customer_account_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_payment`
--

INSERT INTO `customer_payment` (`OR_number`, `amount`, `payment_type_id`, `payment_method_id`, `payment_date`, `customer_account_id`) VALUES
('12-32-1or-123', 1000, 11, 1, '2020-05-15', '20200067462020-LGO'),
('sample-1', 180, 22, 1, '2020-04-25', '20200067462020-LGO'),
('sample-2', 770, 22, 1, '2020-07-25', '20200067462020-LGO');

-- --------------------------------------------------------

--
-- Table structure for table `due_dates`
--

CREATE TABLE `due_dates` (
  `due_id` int(11) NOT NULL,
  `due_desc` varchar(255) NOT NULL,
  `due_days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `due_dates`
--

INSERT INTO `due_dates` (`due_id`, `due_desc`, `due_days`) VALUES
(1, 'billing due days', 14);

-- --------------------------------------------------------

--
-- Table structure for table `employee_profile`
--

CREATE TABLE `employee_profile` (
  `emp_id` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` text NOT NULL,
  `contactNo` int(11) NOT NULL,
  `emp_address_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_address`
--

CREATE TABLE `emp_address` (
  `emp_address_id` varchar(255) NOT NULL,
  `emp_street` varchar(255) NOT NULL,
  `emp_barangay` varchar(255) NOT NULL,
  `emp_city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `holiday_id` int(11) NOT NULL,
  `holiday_name` varchar(255) NOT NULL,
  `holiday_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`holiday_id`, `holiday_name`, `holiday_date`) VALUES
(1, 'Indpendence day', '2020-06-12'),
(2, 'Ninoy Aquino Day', '2020-08-21'),
(3, 'National Heroes Day', '2020-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `meter`
--

CREATE TABLE `meter` (
  `meter_id` int(11) NOT NULL,
  `meter_desc` varchar(255) NOT NULL,
  `customer_account_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meter_reading`
--

CREATE TABLE `meter_reading` (
  `meter_reading_id` varchar(255) NOT NULL,
  `date_of_reading` date NOT NULL,
  `reading_value` varchar(255) NOT NULL,
  `customer_account_id` varchar(255) NOT NULL,
  `print` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meter_reading`
--

INSERT INTO `meter_reading` (`meter_reading_id`, `date_of_reading`, `reading_value`, `customer_account_id`, `print`) VALUES
('1', '2020-04-20', '0', '20200067462020-LGO', 0),
('2', '2020-05-20', '15', '20200067462020-LGO', 0),
('3', '2020-06-20', '50', '20200067462020-LGO', 0),
('4', '2020-07-20', '70', '20200067462020-LGO', 0),
('5', '2020-08-20', '120', '20200067462020-LGO', 0),
('6', '2020-09-20', '150', '20200067462020-LGO', 0);

-- --------------------------------------------------------

--
-- Table structure for table `other_payment`
--

CREATE TABLE `other_payment` (
  `op_id` int(11) NOT NULL,
  `op_desc` varchar(255) NOT NULL,
  `op_value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `other_payment`
--

INSERT INTO `other_payment` (`op_id`, `op_desc`, `op_value`) VALUES
(1, 'penalty', 0.02);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `payment_method_id` int(11) NOT NULL,
  `payment_method_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`payment_method_id`, `payment_method_desc`) VALUES
(1, 'Cash'),
(2, 'Cheque');

-- --------------------------------------------------------

--
-- Table structure for table `payment_status`
--

CREATE TABLE `payment_status` (
  `payment_status_id` int(11) NOT NULL,
  `payment_status_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `payment_type_id` int(11) NOT NULL,
  `payment_type_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`payment_type_id`, `payment_type_desc`) VALUES
(11, 'Registration'),
(22, 'Monthly Bill');

-- --------------------------------------------------------

--
-- Table structure for table `registration_fees`
--

CREATE TABLE `registration_fees` (
  `application_fee` float NOT NULL,
  `advance_payments` float NOT NULL,
  `connection_fee` float NOT NULL,
  `account_type_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration_fees`
--

INSERT INTO `registration_fees` (`application_fee`, `advance_payments`, `connection_fee`, `account_type_code`) VALUES
(100, 500, 500, 101),
(100, 1000, 1000, 102),
(100, 1000, 1500, 103),
(100, 1000, 2000, 104);

-- --------------------------------------------------------

--
-- Table structure for table `review_account`
--

CREATE TABLE `review_account` (
  `review_account_id` int(11) NOT NULL,
  `street` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `type_code` int(11) NOT NULL,
  `review_status_id` int(11) NOT NULL,
  `brgy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_account`
--

INSERT INTO `review_account` (`review_account_id`, `street`, `municipality`, `zipcode`, `customer_id`, `type_code`, `review_status_id`, `brgy_id`) VALUES
(1, 'purok 2', 'Alubijib', '1980', '2020006746', 102, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `review_customer`
--

CREATE TABLE `review_customer` (
  `review_customer_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `contactNo` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `type_code` int(11) NOT NULL,
  `review_status_id` int(11) NOT NULL,
  `brgy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_customer`
--

INSERT INTO `review_customer` (`review_customer_id`, `firstname`, `lastname`, `contactNo`, `street`, `municipality`, `type_code`, `review_status_id`, `brgy_id`) VALUES
(1, 'Michael', 'Guilaran', '12345', 'purok 1', 'Alubijib', 101, 2, 1),
(2, 'Val', 'Casiano', '1234', 'purok 1', 'Alubijib', 101, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `review_status`
--

CREATE TABLE `review_status` (
  `review_status_id` int(11) NOT NULL,
  `review_status_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_status`
--

INSERT INTO `review_status` (`review_status_id`, `review_status_desc`) VALUES
(1, 'Pending'),
(2, 'Approve'),
(3, 'Denied');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type_desc`) VALUES
(1, 'Admin'),
(2, 'Billing'),
(3, 'Cashier'),
(4, 'Accounts'),
(5, 'Reader');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_status`
--
ALTER TABLE `account_status`
  ADD PRIMARY KEY (`account_status_id`);

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`account_type_code`);

--
-- Indexes for table `other_payment`
--
ALTER TABLE `other_payment`
  ADD PRIMARY KEY (`op_id`);

--
-- Indexes for table `review_account`
--
ALTER TABLE `review_account`
  ADD PRIMARY KEY (`review_account_id`);

--
-- Indexes for table `review_customer`
--
ALTER TABLE `review_customer`
  ADD PRIMARY KEY (`review_customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_status`
--
ALTER TABLE `account_status`
  MODIFY `account_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `other_payment`
--
ALTER TABLE `other_payment`
  MODIFY `op_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `review_account`
--
ALTER TABLE `review_account`
  MODIFY `review_account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `review_customer`
--
ALTER TABLE `review_customer`
  MODIFY `review_customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
