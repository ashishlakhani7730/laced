/*
SQLyog Community v12.4.0 (64 bit)
MySQL - 5.7.26 : Database - laced_new
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`laced_new` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `laced_new`;

/*Table structure for table `auction_admin` */

DROP TABLE IF EXISTS `auction_admin`;

CREATE TABLE `auction_admin` (
  `Admin_Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Admin_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `auction_admin` */

insert  into `auction_admin`(`Admin_Id`,`Admin_Name`,`Admin_UserName`,`Admin_Email`,`Admin_Password`,`Admin_Phone`,`Admin_Address`,`Admin_Type`,`Admin_Role`,`Admin_ProfilePic`,`Admin_Status`,`Trade_Charge`,`Shipping_Charge`,`Processing_Free_Fixed`,`Processing_Free_Percentage`,`created`,`modified`) values 
(1,'ryan','ryan','ryan@golaced.com','123456','2627656710','Surat','Admin','1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20','1710565639c08dcffbf988bb797db366215fd46c3f5d43b8a113e3c.jpeg',1,'20','18','0.30','2.9','2019-08-02 20:48:32','2019-08-02 20:50:19');

/*Table structure for table `auction_bid` */

DROP TABLE IF EXISTS `auction_bid`;

CREATE TABLE `auction_bid` (
  `Bid_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) NOT NULL,
  `Item_Id` int(11) NOT NULL,
  `Bid_Price` bigint(20) NOT NULL,
  `Bid_Active` datetime DEFAULT NULL,
  `completeauction` int(11) DEFAULT '0',
  `Winner` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified1` datetime DEFAULT NULL,
  `modified2` datetime DEFAULT NULL,
  `modified3` datetime DEFAULT NULL,
  PRIMARY KEY (`Bid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auction_bid` */

/*Table structure for table `auction_brand` */

DROP TABLE IF EXISTS `auction_brand`;

CREATE TABLE `auction_brand` (
  `Brand_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Brand_Name` varchar(255) DEFAULT NULL,
  `Brand_Logo` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`Brand_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `auction_brand` */

/*Table structure for table `auction_chat` */

DROP TABLE IF EXISTS `auction_chat`;

CREATE TABLE `auction_chat` (
  `Chat_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Converstion_Id` int(11) NOT NULL,
  `Chat_Message` longtext NOT NULL,
  `Sender_Id` int(11) NOT NULL,
  `Sender_Type` varchar(20) NOT NULL,
  `Read_Status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Chat_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auction_chat` */

/*Table structure for table `auction_conversation` */

DROP TABLE IF EXISTS `auction_conversation`;

CREATE TABLE `auction_conversation` (
  `Converstion_Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_IdOne` int(11) NOT NULL,
  `User_IdTwo` int(11) NOT NULL,
  `Converstion_Time` datetime NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Converstion_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auction_conversation` */

/*Table structure for table `auction_item` */

DROP TABLE IF EXISTS `auction_item`;

CREATE TABLE `auction_item` (
  `Item_Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Item_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auction_item` */

/*Table structure for table `auction_payment` */

DROP TABLE IF EXISTS `auction_payment`;

CREATE TABLE `auction_payment` (
  `Payment_Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `Payment_Complete` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Payment_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auction_payment` */

/*Table structure for table `auction_shipping` */

DROP TABLE IF EXISTS `auction_shipping`;

CREATE TABLE `auction_shipping` (
  `Shipping_Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) NOT NULL,
  `Item_Id` int(11) NOT NULL,
  `Shipping_Address` varchar(255) NOT NULL,
  `Shipping_Method` varchar(255) NOT NULL,
  `Tracking_No` varchar(255) NOT NULL,
  `Flaker_Fee` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `option1` varchar(255) DEFAULT NULL,
  `option2` varchar(255) DEFAULT NULL,
  `option3` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Shipping_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auction_shipping` */

/*Table structure for table `auction_user` */

DROP TABLE IF EXISTS `auction_user`;

CREATE TABLE `auction_user` (
  `User_Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `Login_Type` varchar(255) NOT NULL,
  PRIMARY KEY (`User_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auction_user` */

/*Table structure for table `auction_user_bank_info` */

DROP TABLE IF EXISTS `auction_user_bank_info`;

CREATE TABLE `auction_user_bank_info` (
  `Bank_Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Bank_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auction_user_bank_info` */

/*Table structure for table `auction_user_card_detail` */

DROP TABLE IF EXISTS `auction_user_card_detail`;

CREATE TABLE `auction_user_card_detail` (
  `Card_Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Card_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auction_user_card_detail` */

/*Table structure for table `auction_user_cart` */

DROP TABLE IF EXISTS `auction_user_cart`;

CREATE TABLE `auction_user_cart` (
  `Cart_Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) NOT NULL,
  `Item_Id` int(11) NOT NULL,
  `Purchase` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Cart_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auction_user_cart` */

/*Table structure for table `auction_user_order` */

DROP TABLE IF EXISTS `auction_user_order`;

CREATE TABLE `auction_user_order` (
  `Order_Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Order_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auction_user_order` */

/*Table structure for table `contact` */

DROP TABLE IF EXISTS `contact`;

CREATE TABLE `contact` (
  `Contact_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Frist_Name` varchar(255) NOT NULL,
  `Last_Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Message` longtext NOT NULL,
  `Contact_Status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifed` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Contact_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `contact` */

/*Table structure for table `contest` */

DROP TABLE IF EXISTS `contest`;

CREATE TABLE `contest` (
  `Contest_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Item_Id` int(11) NOT NULL,
  `Contest_Status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Start_Date` datetime NOT NULL,
  `End_Date` datetime NOT NULL,
  `startdateampm` varchar(255) NOT NULL,
  `endddateampm` varchar(255) NOT NULL,
  PRIMARY KEY (`Contest_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `contest` */

/*Table structure for table `contest_user` */

DROP TABLE IF EXISTS `contest_user`;

CREATE TABLE `contest_user` (
  `UserContest_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Contest_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Winner` int(11) NOT NULL DEFAULT '0',
  `Contest_Status` int(11) NOT NULL DEFAULT '0',
  `Contest_Url` varchar(255) NOT NULL,
  `Contest_Identity` varchar(255) DEFAULT NULL,
  `Contest_Share` int(11) NOT NULL DEFAULT '0',
  `Contest_Install` int(11) NOT NULL DEFAULT '0',
  `Contest_Install_User` longtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`UserContest_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `contest_user` */

/*Table structure for table `faq` */

DROP TABLE IF EXISTS `faq`;

CREATE TABLE `faq` (
  `F_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Admin_Id` int(11) DEFAULT NULL,
  `question` text,
  `answer` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`F_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `faq` */

/*Table structure for table `favorite` */

DROP TABLE IF EXISTS `favorite`;

CREATE TABLE `favorite` (
  `Favorite_Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) NOT NULL,
  `Item_Id` int(11) NOT NULL,
  `Favorite_Status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Favorite_Id`),
  KEY `Item_Id` (`Item_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `favorite` */

/*Table structure for table `feedback` */

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `Feedback_Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) NOT NULL,
  `Feedback` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Feedback_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `feedback` */

/*Table structure for table `flakercharge` */

DROP TABLE IF EXISTS `flakercharge`;

CREATE TABLE `flakercharge` (
  `Fc_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Admin_id` int(11) DEFAULT NULL,
  `flate_fee` int(11) DEFAULT NULL COMMENT 'this is the rate of percentage.',
  `option1` text,
  `option2` text,
  `option3` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Fc_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `flakercharge` */

/*Table structure for table `flakerfees` */

DROP TABLE IF EXISTS `flakerfees`;

CREATE TABLE `flakerfees` (
  `Flacker_ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) DEFAULT NULL,
  `Item_id` int(11) DEFAULT NULL,
  `product_price` varchar(255) DEFAULT NULL,
  `percentage` varchar(255) DEFAULT NULL,
  `fees` varchar(255) DEFAULT NULL,
  `cutfees` int(11) DEFAULT NULL COMMENT '0 for not cut 1 for cut fees from payment gateway.',
  `optional1` text,
  `optional2` text,
  `optional3` text,
  PRIMARY KEY (`Flacker_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `flakerfees` */

/*Table structure for table `follow` */

DROP TABLE IF EXISTS `follow`;

CREATE TABLE `follow` (
  `Follow_Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id_One` int(11) NOT NULL,
  `User_Id_Two` int(11) NOT NULL,
  `Follow_Status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Follow_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `follow` */

/*Table structure for table `fpolicy` */

DROP TABLE IF EXISTS `fpolicy`;

CREATE TABLE `fpolicy` (
  `F_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Admin_Id` int(11) DEFAULT NULL,
  `fpolicy` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`F_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `fpolicy` */

/*Table structure for table `howitworks` */

DROP TABLE IF EXISTS `howitworks`;

CREATE TABLE `howitworks` (
  `H_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Admin_Id` int(11) DEFAULT NULL,
  `steps` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`H_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `howitworks` */

/*Table structure for table `notification` */

DROP TABLE IF EXISTS `notification`;

CREATE TABLE `notification` (
  `Notification_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Item_Id` int(11) DEFAULT NULL,
  `Admin_Id` int(11) DEFAULT '0' COMMENT '1 for admin side notification generate',
  `User_Id` text,
  `Notification_Title` varchar(255) DEFAULT NULL,
  `Notification_Message` longtext,
  `Notification_Type` varchar(255) DEFAULT NULL,
  `Notification_Status` int(11) DEFAULT '0' COMMENT '1 for read successfully',
  `Notification_Admin` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Notification_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `notification` */

/*Table structure for table `other_item_image` */

DROP TABLE IF EXISTS `other_item_image`;

CREATE TABLE `other_item_image` (
  `Other_Item_Image_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Item_Id` int(11) DEFAULT NULL,
  `Other_Image` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Other_Item_Image_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `other_item_image` */

/*Table structure for table `policy` */

DROP TABLE IF EXISTS `policy`;

CREATE TABLE `policy` (
  `P_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Admin_Id` int(11) DEFAULT NULL,
  `policy` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`P_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `policy` */

/*Table structure for table `product_commission` */

DROP TABLE IF EXISTS `product_commission`;

CREATE TABLE `product_commission` (
  `Pc_Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) DEFAULT NULL,
  `Item_Id` int(11) DEFAULT NULL,
  `product_price` varchar(50) DEFAULT NULL COMMENT 'selling price',
  `product_commission_rate` varchar(50) DEFAULT NULL COMMENT 'rate table of product_commission_charge',
  `product_commission` varchar(50) DEFAULT NULL COMMENT 'count commission (product price x rate / 100) = commission',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `option1` text,
  `option2` text,
  `option3` text,
  PRIMARY KEY (`Pc_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `product_commission` */

/*Table structure for table `product_commission_charge` */

DROP TABLE IF EXISTS `product_commission_charge`;

CREATE TABLE `product_commission_charge` (
  `Pcc_Id` int(11) NOT NULL AUTO_INCREMENT,
  `comm_charge` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `option1` text,
  `option2` text,
  `option3` text,
  PRIMARY KEY (`Pcc_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `product_commission_charge` */

/*Table structure for table `raffle` */

DROP TABLE IF EXISTS `raffle`;

CREATE TABLE `raffle` (
  `Raffle_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Item_Id` int(11) NOT NULL,
  `Raffle_Price` varchar(255) NOT NULL,
  `Raffle_Status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Start_Date` datetime NOT NULL,
  `End_Date` datetime NOT NULL,
  `startdateampm` varchar(255) NOT NULL,
  `endddateampm` varchar(255) NOT NULL,
  PRIMARY KEY (`Raffle_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `raffle` */

/*Table structure for table `raffle_user` */

DROP TABLE IF EXISTS `raffle_user`;

CREATE TABLE `raffle_user` (
  `UserRaffle_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Raffle_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Item_Id` int(11) NOT NULL,
  `Raffle_Price` varchar(255) NOT NULL,
  `Winner` int(11) NOT NULL DEFAULT '0',
  `Raffle_Status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`UserRaffle_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `raffle_user` */

/*Table structure for table `rateus` */

DROP TABLE IF EXISTS `rateus`;

CREATE TABLE `rateus` (
  `Rate_Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) DEFAULT NULL,
  `ratingnumber` bigint(20) DEFAULT NULL,
  `Review` longtext NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Rate_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `rateus` */

/*Table structure for table `referrals` */

DROP TABLE IF EXISTS `referrals`;

CREATE TABLE `referrals` (
  `R_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Sender_User_Id` int(11) DEFAULT NULL,
  `Receiver_User_Id` int(11) DEFAULT NULL,
  `sender_email` varchar(255) DEFAULT NULL,
  `receiver_email` varchar(255) DEFAULT NULL,
  `referalcode` varchar(20) DEFAULT NULL,
  `usedcode` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `usedcodedate` datetime DEFAULT NULL,
  PRIMARY KEY (`R_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `referrals` */

/*Table structure for table `reward` */

DROP TABLE IF EXISTS `reward`;

CREATE TABLE `reward` (
  `Reward_Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Reward_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `reward` */

/*Table structure for table `reward_history` */

DROP TABLE IF EXISTS `reward_history`;

CREATE TABLE `reward_history` (
  `Reward_History_Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) NOT NULL,
  `Reward_Id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Reward_History_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `reward_history` */

/*Table structure for table `tandc` */

DROP TABLE IF EXISTS `tandc`;

CREATE TABLE `tandc` (
  `T_id` int(11) NOT NULL AUTO_INCREMENT,
  `Admin_Id` int(11) DEFAULT NULL,
  `tremscondition` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`T_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tandc` */

/*Table structure for table `trade` */

DROP TABLE IF EXISTS `trade`;

CREATE TABLE `trade` (
  `Trade_Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) NOT NULL,
  `Receiver_Id` int(11) NOT NULL,
  `have_Item_Id` int(11) NOT NULL,
  `Item_Id` text NOT NULL,
  `Trade_Status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `Is_Verify` int(11) NOT NULL DEFAULT '0',
  `is_cancelled` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Trade_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `trade` */

/*Table structure for table `user_bank_info` */

DROP TABLE IF EXISTS `user_bank_info`;

CREATE TABLE `user_bank_info` (
  `BankInfo_Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`BankInfo_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_bank_info` */

/*Table structure for table `user_purchase_item` */

DROP TABLE IF EXISTS `user_purchase_item`;

CREATE TABLE `user_purchase_item` (
  `Purchase_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Order_Id` int(11) DEFAULT NULL,
  `Seller_Id` int(11) NOT NULL COMMENT 'product owner id',
  `User_Id` int(11) NOT NULL COMMENT 'product buyer id',
  `Item_Id` int(11) NOT NULL,
  `Purchase` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Purchase_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_purchase_item` */

/*Table structure for table `user_stripe_info` */

DROP TABLE IF EXISTS `user_stripe_info`;

CREATE TABLE `user_stripe_info` (
  `StripeInfo_Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) NOT NULL,
  `Stripe_User_Id` longtext NOT NULL,
  `Access_Token` longtext NOT NULL,
  `Refresh_Token` longtext NOT NULL,
  `Stripe_Publishable_Key` longtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`StripeInfo_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_stripe_info` */

/*Table structure for table `wallet_ledger` */

DROP TABLE IF EXISTS `wallet_ledger`;

CREATE TABLE `wallet_ledger` (
  `Wallet_Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) NOT NULL,
  `Wallet_Pre_Balance` int(255) NOT NULL,
  `Wallet_Post_Balance` int(255) NOT NULL,
  `Wallet_Current_Balance` int(11) NOT NULL,
  `Message` longtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Wallet_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `wallet_ledger` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
