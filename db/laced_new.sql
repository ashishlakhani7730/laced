-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 02, 2019 at 09:50 AM
-- Server version: 5.6.43
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laced_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `auction_admin`
--

CREATE TABLE `auction_admin` (
  `Admin_Id` int(11) NOT NULL,
  `Admin_Name` varchar(255) NOT NULL,
  `Admin_UserName` varchar(255) NOT NULL,
  `Admin_Email` varchar(255) NOT NULL,
  `Admin_Password` varchar(255) NOT NULL,
  `Admin_Phone` varchar(20) NOT NULL,
  `Admin_Address` varchar(255) NOT NULL,
  `Admin_Type` varchar(255) DEFAULT NULL,
  `Admin_Role` text NOT NULL,
  `Admin_ProfilePic` varchar(255) NOT NULL,
  `Admin_Status` int(11) NOT NULL DEFAULT '0',
  `Trade_Charge` varchar(255) NOT NULL,
  `Shipping_Charge` varchar(25) NOT NULL DEFAULT '0',
  `Processing_Free_Fixed` varchar(25) NOT NULL DEFAULT '0',
  `Processing_Free_Percentage` varchar(25) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auction_admin`
--

INSERT INTO `auction_admin` (`Admin_Id`, `Admin_Name`, `Admin_UserName`, `Admin_Email`, `Admin_Password`, `Admin_Phone`, `Admin_Address`, `Admin_Type`, `Admin_Role`, `Admin_ProfilePic`, `Admin_Status`, `Trade_Charge`, `Shipping_Charge`, `Processing_Free_Fixed`, `Processing_Free_Percentage`, `created`, `modified`) VALUES
(1, 'ryan', 'ryan', 'ryan@golaced.com', '123456', '9737134341', 'rto road bhavnagar', 'Admin', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20', '1710565639c08dcffbf988bb797db366215fd46c3f5d43b8a113e3c.jpeg', 1, '20', '18', '0.30', '2.9', '2019-07-02 05:56:08', '2019-08-02 04:14:25');

-- --------------------------------------------------------

--
-- Table structure for table `auction_bid`
--

CREATE TABLE `auction_bid` (
  `Bid_id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Item_Id` int(11) NOT NULL,
  `Bid_Price` bigint(20) NOT NULL,
  `Bid_Active` datetime DEFAULT NULL,
  `completeauction` int(11) DEFAULT '0',
  `Winner` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified1` datetime DEFAULT NULL,
  `modified2` datetime DEFAULT NULL,
  `modified3` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auction_bid`
--

INSERT INTO `auction_bid` (`Bid_id`, `User_Id`, `Item_Id`, `Bid_Price`, `Bid_Active`, `completeauction`, `Winner`, `created`, `modified1`, `modified2`, `modified3`) VALUES
(1, 3, 3, 10, NULL, 1, 1, '2019-07-03 10:32:23', NULL, NULL, NULL),
(2, 1, 5, 10, NULL, 1, 1, '2019-07-06 10:27:00', NULL, NULL, NULL),
(3, 2, 5, 9, NULL, 1, 0, '2019-07-06 10:39:09', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auction_brand`
--

CREATE TABLE `auction_brand` (
  `Brand_Id` int(11) NOT NULL,
  `Brand_Name` varchar(255) DEFAULT NULL,
  `Brand_Logo` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auction_brand`
--

INSERT INTO `auction_brand` (`Brand_Id`, `Brand_Name`, `Brand_Logo`, `created`, `modified`) VALUES
(1, 'adidas', 'uploads/brand/1562048553brandpic.jpg', '2019-07-02 06:22:33', '0000-00-00 00:00:00'),
(2, 'nike', 'uploads/brand/1562048574brandpic.jpg', '2019-07-02 06:22:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `auction_chat`
--

CREATE TABLE `auction_chat` (
  `Chat_Id` int(11) NOT NULL,
  `Converstion_Id` int(11) NOT NULL,
  `Chat_Message` longtext NOT NULL,
  `Sender_Id` int(11) NOT NULL,
  `Sender_Type` varchar(20) NOT NULL,
  `Read_Status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auction_conversation`
--

CREATE TABLE `auction_conversation` (
  `Converstion_Id` int(11) NOT NULL,
  `User_IdOne` int(11) NOT NULL,
  `User_IdTwo` int(11) NOT NULL,
  `Converstion_Time` datetime NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auction_item`
--

CREATE TABLE `auction_item` (
  `Item_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Item_Name` varchar(255) NOT NULL,
  `Item_FrontPicture` varchar(255) NOT NULL,
  `Item_BackPicture` varchar(255) NOT NULL,
  `Item_SidePicture` varchar(255) NOT NULL,
  `Item_InsideTagPicture` varchar(255) NOT NULL,
  `Item_BoxPicture` varchar(255) NOT NULL,
  `Item_Condition` varchar(255) NOT NULL,
  `Item_Size` varchar(255) NOT NULL,
  `Item_Availability` varchar(255) NOT NULL,
  `Brand_Id` int(11) NOT NULL,
  `Item_NormalPrice` int(255) NOT NULL,
  `Item_MarketPrice` int(255) DEFAULT NULL,
  `Item_Type` varchar(255) NOT NULL,
  `Flaker_Fee` int(11) NOT NULL,
  `Item_Status` int(11) NOT NULL DEFAULT '0',
  `Item_Sale_StartDate` datetime DEFAULT NULL,
  `Item_Sale_EndDate` datetime DEFAULT NULL,
  `startdateampm` varchar(50) DEFAULT NULL,
  `endddateampm` varchar(50) DEFAULT NULL,
  `RC_Status` int(11) NOT NULL DEFAULT '0',
  `Popularity` int(11) NOT NULL DEFAULT '0',
  `Item_Identity` varchar(255) NOT NULL,
  `Item_Link` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auction_item`
--

INSERT INTO `auction_item` (`Item_Id`, `User_Id`, `Item_Name`, `Item_FrontPicture`, `Item_BackPicture`, `Item_SidePicture`, `Item_InsideTagPicture`, `Item_BoxPicture`, `Item_Condition`, `Item_Size`, `Item_Availability`, `Brand_Id`, `Item_NormalPrice`, `Item_MarketPrice`, `Item_Type`, `Flaker_Fee`, `Item_Status`, `Item_Sale_StartDate`, `Item_Sale_EndDate`, `startdateampm`, `endddateampm`, `RC_Status`, `Popularity`, `Item_Identity`, `Item_Link`, `created`, `modified`) VALUES
(1, 1, 'Testing Product', '430748749f9f2dfccdea8f12b5efcd3e88dcb982a5d1aefa470898.jpg', '1137352040f9f2dfccdea8f12b5efcd3e88dcb982a5d1aefa470918.jpg', '1255495911f9f2dfccdea8f12b5efcd3e88dcb982a5d1aefa470972.jpg', '843381069f9f2dfccdea8f12b5efcd3e88dcb982a5d1aefa4709c9.jpg', '393756350f9f2dfccdea8f12b5efcd3e88dcb982a5d1aefa470a25.jpg', 'Deadstock', '1', 'Original', 1, 10, 500, '1', 0, 2, NULL, NULL, NULL, NULL, 1, 2, 'bUiWIZrhZX', 'https://853u.app.link/bUiWIZrhZX', '2019-07-02 00:46:12', '2019-07-02 01:11:05'),
(2, 1, 'Testing product', '1353538157ce0ead440652a5560d2146caffef480b5d1afa09d419c.jpg', '716835482ce0ead440652a5560d2146caffef480b5d1afa09d4255.jpg', '1421636803ce0ead440652a5560d2146caffef480b5d1afa09d42d9.jpg', '626312527ce0ead440652a5560d2146caffef480b5d1afa09d434f.jpg', '1162880464ce0ead440652a5560d2146caffef480b5d1afa09d43c2.jpg', 'Deadstock', '1.5', 'Original', 1, 10, 500, '1', 0, 2, NULL, NULL, NULL, NULL, 1, 0, 'N6d52vCkZX', 'https://853u.app.link/N6d52vCkZX', '2019-07-02 01:30:33', '2019-07-02 01:31:11'),
(3, 2, 'Testing product', '620138802b45a3d6dc3313be47e4a02e0ae9870b35d1c7d36df9fc.jpg', '2121964551b45a3d6dc3313be47e4a02e0ae9870b35d1c7d36dfa72.jpg', '1469779343b45a3d6dc3313be47e4a02e0ae9870b35d1c7d36dfac9.jpg', '993499401b45a3d6dc3313be47e4a02e0ae9870b35d1c7d36dfb1a.jpg', '1946940085b45a3d6dc3313be47e4a02e0ae9870b35d1c7d36dfb6b.jpg', 'Worn', '1', 'Original', 2, 100, 500, '3', 0, 1, '2019-07-02 10:00:00', '2019-07-04 20:30:00', '2019-07-02 10:00 AM', '2019-07-04 08:30 PM', 0, 0, 'G6zEnCFe1X', 'https://853u.app.link/G6zEnCFe1X', '2019-07-03 05:02:30', '2019-07-03 05:04:58'),
(4, 4, 'Auction Item', '6854986283f80c1b63a158ebad79a4a36bb98a8ea5d207474e957f.jpg', '6000742673f80c1b63a158ebad79a4a36bb98a8ea5d207474e95f7.jpg', '12149218593f80c1b63a158ebad79a4a36bb98a8ea5d207474e9650.jpg', '17915961013f80c1b63a158ebad79a4a36bb98a8ea5d207474e96a7.jpg', '15464658413f80c1b63a158ebad79a4a36bb98a8ea5d207474e9700.jpg', 'Deadstock', '1.5', 'Original', 2, 10, 500, '3', 0, 1, '2019-07-05 10:00:00', '2019-07-06 10:30:00', '2019-07-06 10:00 AM', '2019-07-06 10:30 AM', 0, 0, 'IF20kAde6X', 'https://853u.app.link/IF20kAde6X', '2019-07-06 05:14:12', '2019-07-06 05:16:45'),
(5, 3, 'Auction item 2', '1140837653f27cf6c2b9b5433b05478bab7d00bfdb5d2076556788b.jpg', '27224373f27cf6c2b9b5433b05478bab7d00bfdb5d207655678e6.jpg', '464880264f27cf6c2b9b5433b05478bab7d00bfdb5d20765567941.jpg', '1165375957f27cf6c2b9b5433b05478bab7d00bfdb5d20765567999.jpg', '769134154f27cf6c2b9b5433b05478bab7d00bfdb5d207655679fa.jpg', 'Deadstock', '1', 'Original', 1, 10, 500, '3', 0, 1, '2019-07-05 10:00:00', '2019-07-06 11:30:00', '2019-07-06 10:00 AM', '2019-07-06 11:30 AM', 0, 0, 'v8fa73Me6X', 'https://853u.app.link/v8fa73Me6X', '2019-07-06 05:22:13', '2019-07-06 05:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `auction_payment`
--

CREATE TABLE `auction_payment` (
  `Payment_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Info_Id` int(11) NOT NULL,
  `Info_Type` varchar(20) NOT NULL,
  `Pyment_Method` varchar(255) NOT NULL,
  `Payment_TransferNo` varchar(255) NOT NULL,
  `Payment_Amount` varchar(255) NOT NULL,
  `Processing_Fees` varchar(255) NOT NULL,
  `Reward_Price` varchar(255) NOT NULL,
  `Laced_Creadit` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Payment_Complete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auction_payment`
--

INSERT INTO `auction_payment` (`Payment_Id`, `User_Id`, `Info_Id`, `Info_Type`, `Pyment_Method`, `Payment_TransferNo`, `Payment_Amount`, `Processing_Fees`, `Reward_Price`, `Laced_Creadit`, `created`, `Payment_Complete`) VALUES
(1, 1, 1, 'Instaby', 'Stripe', 'txn_1ErivPJxauZxQaEpQvUgCALm', '28.59', '0.59', '0', '0', '2019-07-02 10:09:24', 1),
(2, 3, 1, 'Bid', 'Stripe', 'txn_1Es5lDBnFxeeHr0H0dXoC6GR', '10', '0', '0', '0', '2019-07-03 10:32:23', 0),
(3, 3, 2, 'Instaby', 'Stripe', 'txn_1Es6JqBnFxeeHr0Hvvx2mziD', '28.59', '0.59', '0', '0', '2019-07-03 11:08:11', 0),
(4, 1, 2, 'Bid', 'Stripe', 'txn_1EtB6eJxauZxQaEpqt26tBa6', '10', '0', '0', '0', '2019-07-06 10:27:00', 0),
(5, 2, 3, 'Bid', 'Stripe', 'txn_1EtBIQKOpH9RV3DrVYQs1bR8', '9', '0', '0', '0', '2019-07-06 10:39:10', 0),
(6, 1, 1, 'Raffel', 'Stripe', 'txn_1EuFFJJxauZxQaEpKyD2y7Gb', '15', '0', '0', '0', '2019-07-09 09:04:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `auction_shipping`
--

CREATE TABLE `auction_shipping` (
  `Shipping_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Item_Id` int(11) NOT NULL,
  `Shipping_Address` varchar(255) NOT NULL,
  `Shipping_Method` varchar(255) NOT NULL,
  `Tracking_No` varchar(255) NOT NULL,
  `Flaker_Fee` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `option1` varchar(255) DEFAULT NULL,
  `option2` varchar(255) DEFAULT NULL,
  `option3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auction_user`
--

CREATE TABLE `auction_user` (
  `User_Id` int(11) NOT NULL,
  `FB_Id` varchar(255) DEFAULT NULL,
  `Gmail_Id` varchar(255) DEFAULT NULL,
  `User_FullName` varchar(255) NOT NULL,
  `User_Name` varchar(255) NOT NULL,
  `User_Email` varchar(255) NOT NULL,
  `User_Password` varchar(255) NOT NULL,
  `User_Address` varchar(255) DEFAULT NULL,
  `User_UnitNo` varchar(255) DEFAULT NULL,
  `User_City` varchar(255) DEFAULT NULL,
  `User_State` varchar(255) DEFAULT NULL,
  `User_Phone` varchar(20) DEFAULT NULL,
  `User_ProfilePic` varchar(255) DEFAULT NULL,
  `User_Latitude` varchar(255) DEFAULT NULL,
  `User_Longitude` varchar(255) DEFAULT NULL,
  `User_DeviceType` varchar(255) DEFAULT NULL,
  `User_DeviceToken` longtext,
  `User_verified` int(11) NOT NULL DEFAULT '0' COMMENT 'if bank detail or credit card detail added',
  `Shipping_Address` varchar(255) DEFAULT NULL,
  `User_Url` varchar(255) DEFAULT NULL,
  `User_Identity` varchar(255) DEFAULT NULL,
  `User_Share` int(11) NOT NULL DEFAULT '0',
  `User_Install` int(11) NOT NULL DEFAULT '0',
  `User_Install_User` longtext NOT NULL,
  `User_Reward` int(11) DEFAULT NULL,
  `Is_Login` int(11) NOT NULL DEFAULT '0',
  `User_Status` int(11) NOT NULL DEFAULT '0',
  `Frist_Login` int(11) NOT NULL DEFAULT '0',
  `wallet_balance` varchar(50) NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Login_Type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auction_user`
--

INSERT INTO `auction_user` (`User_Id`, `FB_Id`, `Gmail_Id`, `User_FullName`, `User_Name`, `User_Email`, `User_Password`, `User_Address`, `User_UnitNo`, `User_City`, `User_State`, `User_Phone`, `User_ProfilePic`, `User_Latitude`, `User_Longitude`, `User_DeviceType`, `User_DeviceToken`, `User_verified`, `Shipping_Address`, `User_Url`, `User_Identity`, `User_Share`, `User_Install`, `User_Install_User`, `User_Reward`, `Is_Login`, `User_Status`, `Frist_Login`, `wallet_balance`, `created`, `modified`, `Login_Type`) VALUES
(1, NULL, NULL, 'Vivek Malani', 'vivekmalani', 'v@g.com', '123456', NULL, NULL, NULL, NULL, '9737079628', '162225854f7cc23c4d43a7025773645da05b0cd515d1aec8fe4763.jpg', NULL, NULL, 'iOS', 'fx_s21R_4QM:APA91bGDSBVNyjmfzVDBi5Zl-3WeufAPhXfAVcFixMSZsMhj6x8o7tCRwuE9dc0aR3wh5JpRo-2SvMPp4VFCe0i4X185G91r0vkTDzTGRKXH-Pyx4tqDDiAe6HNr_tdJcNgzt4GMXbH5', 1, NULL, 'https://853u.app.link/jb0R3KvgZX', 'jb0R3KvgZX', 0, 0, '', NULL, 1, 1, 0, '0', '2019-07-02 05:33:03', '2019-07-09 09:03:54', ''),
(2, NULL, NULL, 'Ashish Lakhani', 'ashish', 'a@g.com', '123456', NULL, NULL, NULL, NULL, '123456789', '1075152171399a59ba606f01db111bf839159c30605d1c7c675529c.jpg', NULL, NULL, 'iOS', 'ezVOop2xWyk:APA91bEgWA4nnMEHbHfnfvQYcFejT9iUsmGo4W7NlZiEitPgkaVmFEymzWMrG6UKtQz92VprUzDvlANT4hlyXP1ME_TCN2J2jvEiQuDk0PwPLEo2pILWVQxXvWjBQXNd1zj7-RTh81_b', 0, NULL, 'https://853u.app.link/MMTAciqe1X', 'MMTAciqe1X', 0, 0, '', NULL, 0, 0, 0, '0', '2019-07-03 09:59:03', '2019-07-06 10:43:17', ''),
(3, NULL, NULL, 'Jatin vaghasiya', 'jatin', 'j@g.com', '123456', NULL, NULL, NULL, NULL, '123456789', '1288808866142d5de21b14d6e86fc89498065c4aee5d1c801cb9f1d.jpg', NULL, NULL, 'iOS', 'ezVOop2xWyk:APA91bEgWA4nnMEHbHfnfvQYcFejT9iUsmGo4W7NlZiEitPgkaVmFEymzWMrG6UKtQz92VprUzDvlANT4hlyXP1ME_TCN2J2jvEiQuDk0PwPLEo2pILWVQxXvWjBQXNd1zj7-RTh81_b', 1, NULL, 'https://853u.app.link/aC4TYoyf1X', 'aC4TYoyf1X', 0, 0, '', NULL, 0, 1, 0, '0', '2019-07-03 10:14:52', '2019-07-06 10:30:55', ''),
(4, '1326622117506805', NULL, 'Vivek Malani', 'Vivek Malani', 'vivekmalani44@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'iOS', 'ezVOop2xWyk:APA91bEgWA4nnMEHbHfnfvQYcFejT9iUsmGo4W7NlZiEitPgkaVmFEymzWMrG6UKtQz92VprUzDvlANT4hlyXP1ME_TCN2J2jvEiQuDk0PwPLEo2pILWVQxXvWjBQXNd1zj7-RTh81_b', 0, NULL, NULL, NULL, 0, 0, '', NULL, 0, 0, 0, '0', '2019-07-06 10:12:00', '2019-07-06 10:12:00', 'facebook'),
(5, NULL, '106168613572958818005', 'vivek malani', 'vivek malani', 'vivek3693@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'iOS', 'fAivUTQu0uw:APA91bGmxt9v0IpNS0EveTnnTMWXD-KnRZ-GPdgLBZdnzhSaUnH48l1tIHc9vGnxsitoMI3mQ3Sxlmdh5_twgbxprLtKRtbFAALmGgUTkzFDaA3c4ZFDxPg8-SMgnAA_HNJCGOSOPgD1', 0, NULL, NULL, NULL, 0, 0, '', NULL, 0, 0, 0, '0', '2019-07-09 08:58:34', '2019-07-09 08:58:34', 'gmail');

-- --------------------------------------------------------

--
-- Table structure for table `auction_user_bank_info`
--

CREATE TABLE `auction_user_bank_info` (
  `Bank_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Bank_HolderName` varchar(255) NOT NULL,
  `DOB` varchar(20) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `User_UnitNo` varchar(255) NOT NULL,
  `User_State` varchar(255) NOT NULL,
  `SSN4` varchar(255) NOT NULL,
  `Routing_Number` varchar(255) NOT NULL,
  `Account_Number` varchar(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auction_user_card_detail`
--

CREATE TABLE `auction_user_card_detail` (
  `Card_Id` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Card_Type` varchar(255) DEFAULT NULL,
  `Card_Number` varchar(255) DEFAULT NULL,
  `Card_ExpDate` varchar(11) DEFAULT NULL,
  `Card_Cvv` int(3) DEFAULT NULL,
  `Card_HolderName` varchar(255) DEFAULT NULL,
  `Card_HolderAddress` varchar(255) DEFAULT NULL,
  `User_UnitNo` varchar(50) DEFAULT NULL,
  `User_State` varchar(50) DEFAULT NULL,
  `User_City` varchar(50) DEFAULT NULL,
  `Zip_Code` varchar(50) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auction_user_cart`
--

CREATE TABLE `auction_user_cart` (
  `Cart_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Item_Id` int(11) NOT NULL,
  `Purchase` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auction_user_order`
--

CREATE TABLE `auction_user_order` (
  `Order_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Seller_Id` int(11) NOT NULL COMMENT 'used as userid for product owner',
  `Item_Id` int(11) NOT NULL,
  `Items_Id` varchar(255) DEFAULT NULL,
  `Item_Name` varchar(255) NOT NULL,
  `Item_NormalPrice` varchar(255) NOT NULL,
  `Tracking_No1` varchar(255) NOT NULL,
  `Tracking_No2` varchar(255) NOT NULL,
  `Order_Type` varchar(10) DEFAULT NULL,
  `Order_Status` int(11) NOT NULL DEFAULT '0',
  `Order_Complete` int(11) NOT NULL DEFAULT '0',
  `Courier_Name` varchar(255) NOT NULL,
  `Admin_Id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auction_user_order`
--

INSERT INTO `auction_user_order` (`Order_Id`, `User_Id`, `Seller_Id`, `Item_Id`, `Items_Id`, `Item_Name`, `Item_NormalPrice`, `Tracking_No1`, `Tracking_No2`, `Order_Type`, `Order_Status`, `Order_Complete`, `Courier_Name`, `Admin_Id`, `created`) VALUES
(1, 1, 1, 1, NULL, 'Testing Product', '10', '', '', 'INSTANBY', 1, 0, '', 0, '2019-07-02 10:09:24'),
(2, 3, 1, 1, NULL, 'Testing Product', '10', '1111', '', 'INSTANBY', 1, 0, 'default', 0, '2019-07-03 11:08:11');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `Contact_Id` int(11) NOT NULL,
  `Frist_Name` varchar(255) NOT NULL,
  `Last_Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Message` longtext NOT NULL,
  `Contact_Status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifed` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contest`
--

CREATE TABLE `contest` (
  `Contest_Id` int(11) NOT NULL,
  `Item_Id` int(11) NOT NULL,
  `Contest_Status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Start_Date` datetime NOT NULL,
  `End_Date` datetime NOT NULL,
  `startdateampm` varchar(255) NOT NULL,
  `endddateampm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contest`
--

INSERT INTO `contest` (`Contest_Id`, `Item_Id`, `Contest_Status`, `created`, `Start_Date`, `End_Date`, `startdateampm`, `endddateampm`) VALUES
(1, 1, 0, '2019-07-09 09:26:55', '2019-07-08 10:00:00', '2019-07-10 08:30:00', '2019-07-08 10:00 AM', '2019-07-10 08:30 AM');

-- --------------------------------------------------------

--
-- Table structure for table `contest_user`
--

CREATE TABLE `contest_user` (
  `UserContest_Id` int(11) NOT NULL,
  `Contest_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Winner` int(11) NOT NULL DEFAULT '0',
  `Contest_Status` int(11) NOT NULL DEFAULT '0',
  `Contest_Url` varchar(255) NOT NULL,
  `Contest_Identity` varchar(255) DEFAULT NULL,
  `Contest_Share` int(11) NOT NULL DEFAULT '0',
  `Contest_Install` int(11) NOT NULL DEFAULT '0',
  `Contest_Install_User` longtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contest_user`
--

INSERT INTO `contest_user` (`UserContest_Id`, `Contest_Id`, `User_Id`, `Winner`, `Contest_Status`, `Contest_Url`, `Contest_Identity`, `Contest_Share`, `Contest_Install`, `Contest_Install_User`, `created`) VALUES
(1, 1, 1, 0, 0, 'https://853u.app.link/3X5wYFgcbY', '3X5wYFgcbY', 0, 0, '', '2019-07-09 10:04:57');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `F_Id` int(11) NOT NULL,
  `Admin_Id` int(11) DEFAULT NULL,
  `question` text,
  `answer` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `Favorite_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Item_Id` int(11) NOT NULL,
  `Favorite_Status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`Favorite_Id`, `User_Id`, `Item_Id`, `Favorite_Status`, `created`) VALUES
(1, 1, 1, 1, '2019-07-02 09:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `Feedback_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Feedback` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `flakercharge`
--

CREATE TABLE `flakercharge` (
  `Fc_ID` int(11) NOT NULL,
  `Admin_id` int(11) DEFAULT NULL,
  `flate_fee` int(11) DEFAULT NULL COMMENT 'this is the rate of percentage.',
  `option1` text,
  `option2` text,
  `option3` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `flakerfees`
--

CREATE TABLE `flakerfees` (
  `Flacker_ID` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Item_id` int(11) DEFAULT NULL,
  `product_price` varchar(255) DEFAULT NULL,
  `percentage` varchar(255) DEFAULT NULL,
  `fees` varchar(255) DEFAULT NULL,
  `cutfees` int(11) DEFAULT NULL COMMENT '0 for not cut 1 for cut fees from payment gateway.',
  `optional1` text,
  `optional2` text,
  `optional3` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flakerfees`
--

INSERT INTO `flakerfees` (`Flacker_ID`, `User_Id`, `Item_id`, `product_price`, `percentage`, `fees`, `cutfees`, `optional1`, `optional2`, `optional3`) VALUES
(1, 1, 0, '10', NULL, '0', 1, NULL, NULL, NULL),
(2, 1, 0, '10', NULL, '0', 1, NULL, NULL, NULL),
(3, 2, 0, '100', NULL, '0', 1, NULL, NULL, NULL),
(4, 4, 0, '10', NULL, '0', 1, NULL, NULL, NULL),
(5, 3, 0, '10', NULL, '0', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `Follow_Id` int(11) NOT NULL,
  `User_Id_One` int(11) NOT NULL,
  `User_Id_Two` int(11) NOT NULL,
  `Follow_Status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fpolicy`
--

CREATE TABLE `fpolicy` (
  `F_Id` int(11) NOT NULL,
  `Admin_Id` int(11) DEFAULT NULL,
  `fpolicy` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `howitworks`
--

CREATE TABLE `howitworks` (
  `H_Id` int(11) NOT NULL,
  `Admin_Id` int(11) DEFAULT NULL,
  `steps` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `Notification_Id` int(11) NOT NULL,
  `Item_Id` int(11) DEFAULT NULL,
  `Admin_Id` int(11) DEFAULT '0' COMMENT '1 for admin side notification generate',
  `User_Id` text,
  `Notification_Title` varchar(255) DEFAULT NULL,
  `Notification_Message` longtext,
  `Notification_Type` varchar(255) DEFAULT NULL,
  `Notification_Status` int(11) DEFAULT '0' COMMENT '1 for read successfully',
  `Notification_Admin` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`Notification_Id`, `Item_Id`, `Admin_Id`, `User_Id`, `Notification_Title`, `Notification_Message`, `Notification_Type`, `Notification_Status`, `Notification_Admin`, `created`, `modified`) VALUES
(1, NULL, 1, '1', 'User Register', 'vivekmalani Register in Laced', 'User Register', 1, 0, '2019-07-02 05:33:03', '2019-07-02 06:12:41'),
(2, 0, 1, '1', 'Product added', 'added Product', 'Product add', 1, 0, '2019-07-02 05:46:12', '2019-07-02 06:12:41'),
(3, 1, 0, '1', 'product approved', 'Your Added Item Accepted Successfully we get charge $0 when your product is sell Successfully.', '', 0, 0, '2019-07-02 06:11:05', '0000-00-00 00:00:00'),
(4, 0, 1, '1', 'Product added', 'added Product', 'Product add', 1, 0, '2019-07-02 06:30:33', '2019-07-02 08:41:35'),
(5, 2, 0, '1', 'product approved', 'Your Added Item Accepted Successfully we get charge $0 when your product is sell Successfully.', '', 0, 0, '2019-07-02 06:31:11', '0000-00-00 00:00:00'),
(6, NULL, 1, '2', 'User Register', 'ashish Register in Laced', 'User Register', 1, 0, '2019-07-03 09:59:03', '2019-07-03 10:03:11'),
(7, 0, 1, '2', 'Product added', 'added Product', 'Product add', 1, 0, '2019-07-03 10:02:30', '2019-07-03 10:03:11'),
(8, 3, 0, '2', 'Auction Release Date', 'Your Auction Stating Date is - 2019-07-02 10:00 AM And End Date Is - 2019-07-04 08:30 PM', '', 0, 0, '2019-07-03 10:04:33', '0000-00-00 00:00:00'),
(9, 3, 0, '2', 'product approved', 'Your Added Item Accepted Successfully we get charge $0 when your product is sell Successfully.', '', 0, 0, '2019-07-03 10:04:58', '0000-00-00 00:00:00'),
(10, NULL, 1, '3', 'User Register', 'jatin Register in Laced', 'User Register', 1, 0, '2019-07-03 10:14:52', '2019-07-05 05:42:41'),
(11, 0, 1, '4', 'Product added', 'added Product', 'Product add', 1, 0, '2019-07-06 10:14:12', '2019-07-06 10:17:02'),
(12, 4, 0, '4', 'Auction Release Date', 'Your Auction Stating Date is - 2019-07-06 10:00 AM And End Date Is - 2019-07-06 10:30 AM', '', 0, 0, '2019-07-06 10:16:12', '0000-00-00 00:00:00'),
(13, 4, 0, '4', 'product approved', 'Your Added Item Accepted Successfully we get charge $0 when your product is sell Successfully.', '', 0, 0, '2019-07-06 10:16:45', '0000-00-00 00:00:00'),
(14, 0, 1, '3', 'Product added', 'added Product', 'Product add', 1, 0, '2019-07-06 10:22:13', '2019-07-09 09:02:37'),
(15, 5, 0, '3', 'Auction Release Date', 'Your Auction Stating Date is - 2019-07-06 10:00 AM And End Date Is - 2019-07-06 11:30 AM', '', 0, 0, '2019-07-06 10:23:56', '0000-00-00 00:00:00'),
(16, 5, 0, '3', 'product approved', 'Your Added Item Accepted Successfully we get charge $0 when your product is sell Successfully.', '', 0, 0, '2019-07-06 10:25:02', '0000-00-00 00:00:00'),
(17, NULL, 0, NULL, 'Raffle Release Date', 'Your Raffle Stating Date is - 2019-07-08 10:00 AM And End Date Is - 2019-07-10 08:30 PM', '', 0, 0, '2019-07-09 09:01:22', '0000-00-00 00:00:00'),
(18, NULL, 0, NULL, 'Contest Release Date', 'Your Contest Stating Date is - 2019-07-08 10:00 AM And End Date Is - 2019-07-10 08:30 AM', '', 0, 0, '2019-07-09 09:27:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `other_item_image`
--

CREATE TABLE `other_item_image` (
  `Other_Item_Image_Id` int(11) NOT NULL,
  `Item_Id` int(11) DEFAULT NULL,
  `Other_Image` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `policy`
--

CREATE TABLE `policy` (
  `P_Id` int(11) NOT NULL,
  `Admin_Id` int(11) DEFAULT NULL,
  `policy` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_commission`
--

CREATE TABLE `product_commission` (
  `Pc_Id` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Item_Id` int(11) DEFAULT NULL,
  `product_price` varchar(50) DEFAULT NULL COMMENT 'selling price',
  `product_commission_rate` varchar(50) DEFAULT NULL COMMENT 'rate table of product_commission_charge',
  `product_commission` varchar(50) DEFAULT NULL COMMENT 'count commission (product price x rate / 100) = commission',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `option1` text,
  `option2` text,
  `option3` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_commission`
--

INSERT INTO `product_commission` (`Pc_Id`, `User_Id`, `Item_Id`, `product_price`, `product_commission_rate`, `product_commission`, `created`, `modified`, `option1`, `option2`, `option3`) VALUES
(1, 1, 1, '10', NULL, '0', '2019-07-02 01:11:05', NULL, NULL, NULL, NULL),
(2, 1, 2, '10', NULL, '0', '2019-07-02 01:31:11', NULL, NULL, NULL, NULL),
(3, 2, 3, '100', NULL, '0', '2019-07-03 05:04:58', NULL, NULL, NULL, NULL),
(4, 4, 4, '10', NULL, '0', '2019-07-06 05:16:20', NULL, NULL, NULL, NULL),
(5, 4, 4, '10', NULL, '0', '2019-07-06 05:16:28', NULL, NULL, NULL, NULL),
(6, 4, 4, '10', NULL, '0', '2019-07-06 05:16:45', NULL, NULL, NULL, NULL),
(7, 3, 5, '10', NULL, '0', '2019-07-06 05:25:02', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_commission_charge`
--

CREATE TABLE `product_commission_charge` (
  `Pcc_Id` int(11) NOT NULL,
  `comm_charge` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `option1` text,
  `option2` text,
  `option3` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `raffle`
--

CREATE TABLE `raffle` (
  `Raffle_Id` int(11) NOT NULL,
  `Item_Id` int(11) NOT NULL,
  `Raffle_Price` varchar(255) NOT NULL,
  `Raffle_Status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Start_Date` datetime NOT NULL,
  `End_Date` datetime NOT NULL,
  `startdateampm` varchar(255) NOT NULL,
  `endddateampm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `raffle`
--

INSERT INTO `raffle` (`Raffle_Id`, `Item_Id`, `Raffle_Price`, `Raffle_Status`, `created`, `Start_Date`, `End_Date`, `startdateampm`, `endddateampm`) VALUES
(1, 2, '20', 0, '2019-07-09 09:00:24', '2019-07-08 10:00:00', '2019-07-10 20:30:00', '2019-07-08 10:00 AM', '2019-07-10 08:30 PM');

-- --------------------------------------------------------

--
-- Table structure for table `raffle_user`
--

CREATE TABLE `raffle_user` (
  `UserRaffle_Id` int(11) NOT NULL,
  `Raffle_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Item_Id` int(11) NOT NULL,
  `Raffle_Price` varchar(255) NOT NULL,
  `Winner` int(11) NOT NULL DEFAULT '0',
  `Raffle_Status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `raffle_user`
--

INSERT INTO `raffle_user` (`UserRaffle_Id`, `Raffle_Id`, `User_Id`, `Item_Id`, `Raffle_Price`, `Winner`, `Raffle_Status`, `created`) VALUES
(1, 1, 1, 2, '15', 0, 1, '2019-07-09 09:04:21');

-- --------------------------------------------------------

--
-- Table structure for table `rateus`
--

CREATE TABLE `rateus` (
  `Rate_Id` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `ratingnumber` bigint(20) DEFAULT NULL,
  `Review` longtext NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `R_Id` int(11) NOT NULL,
  `Sender_User_Id` int(11) DEFAULT NULL,
  `Receiver_User_Id` int(11) DEFAULT NULL,
  `sender_email` varchar(255) DEFAULT NULL,
  `receiver_email` varchar(255) DEFAULT NULL,
  `referalcode` varchar(20) DEFAULT NULL,
  `usedcode` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `usedcodedate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reward`
--

CREATE TABLE `reward` (
  `Reward_Id` int(11) NOT NULL,
  `Reward_Name` varchar(255) NOT NULL,
  `Reward_Code` varchar(255) NOT NULL,
  `Price` int(11) NOT NULL,
  `Price_Type` varchar(255) NOT NULL,
  `Minimum_Price` varchar(255) NOT NULL,
  `Start_Date` datetime NOT NULL,
  `End_Date` datetime NOT NULL,
  `No_Of_Use` int(255) NOT NULL,
  `Condition` varchar(255) NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reward_history`
--

CREATE TABLE `reward_history` (
  `Reward_History_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Reward_Id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tandc`
--

CREATE TABLE `tandc` (
  `T_id` int(11) NOT NULL,
  `Admin_Id` int(11) DEFAULT NULL,
  `tremscondition` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trade`
--

CREATE TABLE `trade` (
  `Trade_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Receiver_Id` int(11) NOT NULL,
  `have_Item_Id` int(11) NOT NULL,
  `Item_Id` text NOT NULL,
  `Trade_Status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `Is_Verify` int(11) NOT NULL DEFAULT '0',
  `is_cancelled` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_bank_info`
--

CREATE TABLE `user_bank_info` (
  `BankInfo_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `BanInfo_Type` varchar(25) NOT NULL,
  `Bank_Name` varchar(100) DEFAULT NULL,
  `Account_Number` varchar(50) DEFAULT NULL,
  `Routing_Number` varchar(50) DEFAULT NULL,
  `Date_of_Birth` varchar(20) DEFAULT NULL,
  `Account_HolderName` varchar(100) DEFAULT NULL,
  `Card_No` varchar(20) DEFAULT NULL,
  `Expiry_Data` varchar(10) DEFAULT NULL,
  `Cvv_Code` int(3) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_purchase_item`
--

CREATE TABLE `user_purchase_item` (
  `Purchase_Id` int(11) NOT NULL,
  `Order_Id` int(11) DEFAULT NULL,
  `Seller_Id` int(11) NOT NULL COMMENT 'product owner id',
  `User_Id` int(11) NOT NULL COMMENT 'product buyer id',
  `Item_Id` int(11) NOT NULL,
  `Purchase` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_purchase_item`
--

INSERT INTO `user_purchase_item` (`Purchase_Id`, `Order_Id`, `Seller_Id`, `User_Id`, `Item_Id`, `Purchase`, `created`) VALUES
(1, 1, 1, 1, 1, 0, '0000-00-00 00:00:00'),
(2, 2, 1, 3, 1, 2, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `User_Stripe_Info`
--

CREATE TABLE `User_Stripe_Info` (
  `StripeInfo_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Stripe_User_Id` longtext NOT NULL,
  `Access_Token` longtext NOT NULL,
  `Refresh_Token` longtext NOT NULL,
  `Stripe_Publishable_Key` longtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User_Stripe_Info`
--

INSERT INTO `User_Stripe_Info` (`StripeInfo_Id`, `User_Id`, `Stripe_User_Id`, `Access_Token`, `Refresh_Token`, `Stripe_Publishable_Key`, `created`, `modified`) VALUES
(13, 1, 'acct_1EripUJxauZxQaEp', 'sk_test_h3LcQ0HpVGoTA2CfGyr1Ne3C00Cq5fAZdH', 'rt_FMRmg5MKAuoIcgRUWIX3WKTneynKocPnXvrq91IR5WRQlhDx', 'pk_test_VkaKy6ZZfp1GGH3lflaS4DH200lb5JEeMb', '2019-07-02 10:06:37', '0000-00-00 00:00:00'),
(14, 3, 'acct_1Es5YKBnFxeeHr0H', 'sk_test_gFKznVRThT05I74sOja5Qdw100VAbFMlsd', 'rt_FMpE9jUCK9q2y0XNTUYCTgs5cH7zWne9QA0NeXA7T25WIXsU', 'pk_test_fgnjlv7bipvv9OsBkLfc1qgW0045qfQ5Fk', '2019-07-03 10:20:55', '0000-00-00 00:00:00'),
(15, 2, 'acct_1EtBBtKOpH9RV3Dr', 'sk_test_v9dcbZZ2cmbGlhbteVEv5N1x00rAls3qSK', 'rt_FNx7L03H8qkRp6uIDi3Rp07lycEmLAps9K3mpzo0rfIkL3kF', 'pk_test_5ZbAhMyueAzySIdgtxhoSEHu003880CZS0', '2019-07-06 10:34:04', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_ledger`
--

CREATE TABLE `wallet_ledger` (
  `Wallet_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Wallet_Pre_Balance` int(255) NOT NULL,
  `Wallet_Post_Balance` int(255) NOT NULL,
  `Wallet_Current_Balance` int(11) NOT NULL,
  `Message` longtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auction_admin`
--
ALTER TABLE `auction_admin`
  ADD PRIMARY KEY (`Admin_Id`);

--
-- Indexes for table `auction_bid`
--
ALTER TABLE `auction_bid`
  ADD PRIMARY KEY (`Bid_id`);

--
-- Indexes for table `auction_brand`
--
ALTER TABLE `auction_brand`
  ADD PRIMARY KEY (`Brand_Id`);

--
-- Indexes for table `auction_chat`
--
ALTER TABLE `auction_chat`
  ADD PRIMARY KEY (`Chat_Id`);

--
-- Indexes for table `auction_conversation`
--
ALTER TABLE `auction_conversation`
  ADD PRIMARY KEY (`Converstion_Id`);

--
-- Indexes for table `auction_item`
--
ALTER TABLE `auction_item`
  ADD PRIMARY KEY (`Item_Id`);

--
-- Indexes for table `auction_payment`
--
ALTER TABLE `auction_payment`
  ADD PRIMARY KEY (`Payment_Id`);

--
-- Indexes for table `auction_shipping`
--
ALTER TABLE `auction_shipping`
  ADD PRIMARY KEY (`Shipping_Id`);

--
-- Indexes for table `auction_user`
--
ALTER TABLE `auction_user`
  ADD PRIMARY KEY (`User_Id`);

--
-- Indexes for table `auction_user_bank_info`
--
ALTER TABLE `auction_user_bank_info`
  ADD PRIMARY KEY (`Bank_Id`);

--
-- Indexes for table `auction_user_card_detail`
--
ALTER TABLE `auction_user_card_detail`
  ADD PRIMARY KEY (`Card_Id`);

--
-- Indexes for table `auction_user_cart`
--
ALTER TABLE `auction_user_cart`
  ADD PRIMARY KEY (`Cart_Id`);

--
-- Indexes for table `auction_user_order`
--
ALTER TABLE `auction_user_order`
  ADD PRIMARY KEY (`Order_Id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`Contact_Id`);

--
-- Indexes for table `contest`
--
ALTER TABLE `contest`
  ADD PRIMARY KEY (`Contest_Id`);

--
-- Indexes for table `contest_user`
--
ALTER TABLE `contest_user`
  ADD PRIMARY KEY (`UserContest_Id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`F_Id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`Favorite_Id`),
  ADD KEY `Item_Id` (`Item_Id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`Feedback_Id`);

--
-- Indexes for table `flakercharge`
--
ALTER TABLE `flakercharge`
  ADD PRIMARY KEY (`Fc_ID`);

--
-- Indexes for table `flakerfees`
--
ALTER TABLE `flakerfees`
  ADD PRIMARY KEY (`Flacker_ID`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`Follow_Id`);

--
-- Indexes for table `fpolicy`
--
ALTER TABLE `fpolicy`
  ADD PRIMARY KEY (`F_Id`);

--
-- Indexes for table `howitworks`
--
ALTER TABLE `howitworks`
  ADD PRIMARY KEY (`H_Id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`Notification_Id`);

--
-- Indexes for table `other_item_image`
--
ALTER TABLE `other_item_image`
  ADD PRIMARY KEY (`Other_Item_Image_Id`);

--
-- Indexes for table `policy`
--
ALTER TABLE `policy`
  ADD PRIMARY KEY (`P_Id`);

--
-- Indexes for table `product_commission`
--
ALTER TABLE `product_commission`
  ADD PRIMARY KEY (`Pc_Id`);

--
-- Indexes for table `product_commission_charge`
--
ALTER TABLE `product_commission_charge`
  ADD PRIMARY KEY (`Pcc_Id`);

--
-- Indexes for table `raffle`
--
ALTER TABLE `raffle`
  ADD PRIMARY KEY (`Raffle_Id`);

--
-- Indexes for table `raffle_user`
--
ALTER TABLE `raffle_user`
  ADD PRIMARY KEY (`UserRaffle_Id`);

--
-- Indexes for table `rateus`
--
ALTER TABLE `rateus`
  ADD PRIMARY KEY (`Rate_Id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`R_Id`);

--
-- Indexes for table `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`Reward_Id`);

--
-- Indexes for table `reward_history`
--
ALTER TABLE `reward_history`
  ADD PRIMARY KEY (`Reward_History_Id`);

--
-- Indexes for table `tandc`
--
ALTER TABLE `tandc`
  ADD PRIMARY KEY (`T_id`);

--
-- Indexes for table `trade`
--
ALTER TABLE `trade`
  ADD PRIMARY KEY (`Trade_Id`);

--
-- Indexes for table `user_bank_info`
--
ALTER TABLE `user_bank_info`
  ADD PRIMARY KEY (`BankInfo_Id`);

--
-- Indexes for table `user_purchase_item`
--
ALTER TABLE `user_purchase_item`
  ADD PRIMARY KEY (`Purchase_Id`);

--
-- Indexes for table `User_Stripe_Info`
--
ALTER TABLE `User_Stripe_Info`
  ADD PRIMARY KEY (`StripeInfo_Id`);

--
-- Indexes for table `wallet_ledger`
--
ALTER TABLE `wallet_ledger`
  ADD PRIMARY KEY (`Wallet_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auction_admin`
--
ALTER TABLE `auction_admin`
  MODIFY `Admin_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auction_bid`
--
ALTER TABLE `auction_bid`
  MODIFY `Bid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auction_brand`
--
ALTER TABLE `auction_brand`
  MODIFY `Brand_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auction_chat`
--
ALTER TABLE `auction_chat`
  MODIFY `Chat_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auction_conversation`
--
ALTER TABLE `auction_conversation`
  MODIFY `Converstion_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auction_item`
--
ALTER TABLE `auction_item`
  MODIFY `Item_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `auction_payment`
--
ALTER TABLE `auction_payment`
  MODIFY `Payment_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `auction_shipping`
--
ALTER TABLE `auction_shipping`
  MODIFY `Shipping_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auction_user`
--
ALTER TABLE `auction_user`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `auction_user_bank_info`
--
ALTER TABLE `auction_user_bank_info`
  MODIFY `Bank_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auction_user_card_detail`
--
ALTER TABLE `auction_user_card_detail`
  MODIFY `Card_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auction_user_cart`
--
ALTER TABLE `auction_user_cart`
  MODIFY `Cart_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auction_user_order`
--
ALTER TABLE `auction_user_order`
  MODIFY `Order_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `Contact_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contest`
--
ALTER TABLE `contest`
  MODIFY `Contest_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contest_user`
--
ALTER TABLE `contest_user`
  MODIFY `UserContest_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `F_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `Favorite_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `Feedback_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flakercharge`
--
ALTER TABLE `flakercharge`
  MODIFY `Fc_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flakerfees`
--
ALTER TABLE `flakerfees`
  MODIFY `Flacker_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `Follow_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fpolicy`
--
ALTER TABLE `fpolicy`
  MODIFY `F_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `howitworks`
--
ALTER TABLE `howitworks`
  MODIFY `H_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `Notification_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `other_item_image`
--
ALTER TABLE `other_item_image`
  MODIFY `Other_Item_Image_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policy`
--
ALTER TABLE `policy`
  MODIFY `P_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_commission`
--
ALTER TABLE `product_commission`
  MODIFY `Pc_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_commission_charge`
--
ALTER TABLE `product_commission_charge`
  MODIFY `Pcc_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `raffle`
--
ALTER TABLE `raffle`
  MODIFY `Raffle_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `raffle_user`
--
ALTER TABLE `raffle_user`
  MODIFY `UserRaffle_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rateus`
--
ALTER TABLE `rateus`
  MODIFY `Rate_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `R_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reward`
--
ALTER TABLE `reward`
  MODIFY `Reward_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reward_history`
--
ALTER TABLE `reward_history`
  MODIFY `Reward_History_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tandc`
--
ALTER TABLE `tandc`
  MODIFY `T_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trade`
--
ALTER TABLE `trade`
  MODIFY `Trade_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_bank_info`
--
ALTER TABLE `user_bank_info`
  MODIFY `BankInfo_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_purchase_item`
--
ALTER TABLE `user_purchase_item`
  MODIFY `Purchase_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `User_Stripe_Info`
--
ALTER TABLE `User_Stripe_Info`
  MODIFY `StripeInfo_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wallet_ledger`
--
ALTER TABLE `wallet_ledger`
  MODIFY `Wallet_Id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
