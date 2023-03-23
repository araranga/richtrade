-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 16, 2021 at 01:06 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kringledata`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accounts`
--

CREATE TABLE `tbl_accounts` (
  `accounts_id` int(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `activated` varchar(5) DEFAULT '0',
  `role` varchar(25) DEFAULT NULL,
  `createdby` varchar(255) DEFAULT NULL,
  `stores` int(255) DEFAULT '1',
  `balance` float DEFAULT '0',
  `fullname` varchar(255) DEFAULT NULL,
  `refer` varchar(255) DEFAULT NULL,
  `parent` varchar(255) DEFAULT NULL,
  `deadline` timestamp NULL DEFAULT NULL,
  `rate` varchar(25) DEFAULT NULL,
  `path` longtext,
  `level` int(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_accounts`
--

INSERT INTO `tbl_accounts` (`accounts_id`, `username`, `password`, `email`, `activated`, `role`, `createdby`, `stores`, `balance`, `fullname`, `refer`, `parent`, `deadline`, `rate`, `path`, `level`) VALUES
(20, 'ardeenathanraranga@gmail.com', '1234', 'ardeenathanraranga@gmail.com', '1', '1', 'ardeenathanraranga@gmail.com', 1, 0, 'Ardee Nathan Villano Rarangadasdasd', NULL, '0', '2022-11-15 00:20:26', '7', '0/20', 2),
(21, 'ardeenathanraranga555@gmail.com', '123123', 'ardeenathanraranga555@gmail.com', '0', '2', 'ardeenathanraranga555@gmail.com', 1, 0, 'Ardee Nathan Villano Raranga', '20', '20', NULL, NULL, '0/20/21', 3),
(22, 'daga@gmail.com', '1234', 'daga@gmail.com', '0', '1', 'daga@gmail.com', 1, 0, 'Daga', '20', '20', NULL, NULL, '0/20/22', 3),
(23, 'test@gmail.com.ph', '12345', 'test@gmail.com.ph', '0', '1', 'test@gmail.com.ph', 1, 338, 'King', '20', '0', NULL, NULL, '0/23', 2),
(33, 'aaaa@gmail.com', '123', 'aaaa@gmail.com', '0', '2', 'aaaa@gmail.com', 1, 0, 'Ardee Nathan Villano Raranga', '20', '21', NULL, '8', '0/20/21/33', 4),
(43, 'bbb@gmail.com', 'bbb', 'bbb@gmail.com', '0', '2', 'bbb@gmail.com', 1, 0, 'Ardee Nathan Villano Raranga', '20', '21', NULL, NULL, '0/20/21/43', 4),
(53, 'bbbb@gmail.com', '123123', 'bbbb@gmail.com', '1', '2', 'bbbb@gmail.com', 1, 0, 'buret', '20', '33', NULL, '8', '0/20/21/33/53', 5),
(63, 'ardeenathanrabbbbranga@gmail.com', '123123', 'ardeenathanrabbbbranga@gmail.com', '0', '2', 'ardeenathanrabbbbranga@gmail.com', 1, 0, 'Ardee Nathan Villano Raranga', '20', '22', NULL, NULL, '0/20/22/63', 4),
(73, 'ardeenathanrarangsda@gmail.com', '123123', 'ardeenathanrarangsda@gmail.com', '0', '1', 'ardeenathanrarangsda@gmail.com', 1, 0, 'Prince MJ', '20', '22', NULL, NULL, '0/20/22/73', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bonus_history`
--

CREATE TABLE `tbl_bonus_history` (
  `id` int(255) NOT NULL,
  `send` varchar(255) DEFAULT NULL,
  `receiver` varchar(255) DEFAULT NULL,
  `sid` varchar(255) DEFAULT NULL,
  `rid` varchar(255) DEFAULT NULL,
  `remarks` text,
  `amount` float NOT NULL DEFAULT '0',
  `ptype` varchar(255) NOT NULL,
  `history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_bonus_history`
--

INSERT INTO `tbl_bonus_history` (`id`, `send`, `receiver`, `sid`, `rid`, `remarks`, `amount`, `ptype`, `history`) VALUES
(7, 'bbbb@gmail.com', 'aaaa@gmail.com', '53', '33', 'Bonus: 25%(638.75) of 2,555.00 from aaaa@gmail.com', 638.75, 'complan', '2021-01-15 10:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exchange_history`
--

CREATE TABLE `tbl_exchange_history` (
  `id` int(255) NOT NULL,
  `accounts_id` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `current_balance` varchar(255) NOT NULL,
  `new_balance` varchar(255) NOT NULL,
  `history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `claim_status` varchar(2) NOT NULL DEFAULT '0',
  `claimtype` varchar(25) NOT NULL,
  `transnum` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `stores` varchar(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_exchange_history`
--

INSERT INTO `tbl_exchange_history` (`id`, `accounts_id`, `amount`, `current_balance`, `new_balance`, `history`, `claim_status`, `claimtype`, `transnum`, `address`, `stores`) VALUES
(2, '73', '', '0', '', '2021-01-14 06:10:26', '0', 'btc', '123', '23 A Ilang Ilang', '1'),
(3, '20', '', '0', '', '2021-01-15 10:37:35', '1', 'btc', '1234412321', '123123213', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_history`
--

CREATE TABLE `tbl_payment_history` (
  `id` int(255) NOT NULL,
  `accounts_id` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ptype` varchar(25) NOT NULL,
  `transnum` varchar(255) NOT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `remarks` longtext,
  `inv` varchar(255) DEFAULT NULL,
  `stores` varchar(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment_history`
--

INSERT INTO `tbl_payment_history` (`id`, `accounts_id`, `amount`, `history`, `ptype`, `transnum`, `rate`, `remarks`, `inv`, `stores`) VALUES
(9, '53', '2555', '2021-01-15 10:29:56', 'complan', 'txn1696596382', '8', 'Complan Payment For: bbbb@gmail.com Complan Type: Intermediate - 2555', 'CP-1879166585', '1'),
(10, '53', '2555', '2021-01-15 10:31:29', 'complan', 'txn1696596382', '8', 'Complan Payment For: bbbb@gmail.com Complan Type: Intermediate - 2555', 'CP-1879166585', '1'),
(11, '20', '25', '2021-01-15 10:36:40', 'complan', 'txn1194581769', '7', 'Complan Payment For: ardeenathanraranga@gmail.com Complan Type: Beginner - 25', 'CP-502255176', '1'),
(12, '20', '25', '2021-01-15 10:40:25', 'complan', 'txn1194581769', '7', 'Complan Payment For: ardeenathanraranga@gmail.com Complan Type: Beginner - 25', 'CP-502255176', '1'),
(13, '20', '25', '2021-01-15 10:40:33', 'complan', 'txn1194581769', '7', 'Complan Payment For: ardeenathanraranga@gmail.com Complan Type: Beginner - 25', 'CP-502255176', '1'),
(14, '20', '25', '2021-01-15 10:43:21', 'complan', 'txn1194581769', '7', 'Complan Payment For: ardeenathanraranga@gmail.com Complan Type: Beginner - 25', 'CP-502255176', '1'),
(15, '20', '25', '2021-01-15 10:44:12', 'complan', 'txn1194581769', '7', 'Complan Payment For: ardeenathanraranga@gmail.com Complan Type: Beginner - 25', 'CP-502255176', '1'),
(16, '20', '50', '2021-01-15 17:04:54', 'subscription', 'txn621806926', '5', 'Subscription Payment For: ardeenathanraranga@gmail.com -- 5 Months Subscription - 50', 'SF-1608071090', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rate`
--

CREATE TABLE `tbl_rate` (
  `rate_id` int(255) NOT NULL,
  `rate_name` varchar(255) DEFAULT NULL,
  `rate_start` int(255) DEFAULT NULL,
  `rate_end` int(255) DEFAULT NULL,
  `rate_bonus` varchar(255) DEFAULT NULL,
  `createdby` varchar(255) DEFAULT NULL,
  `stores` varchar(255) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rate`
--

INSERT INTO `tbl_rate` (`rate_id`, `rate_name`, `rate_start`, `rate_end`, `rate_bonus`, `createdby`, `stores`) VALUES
(7, 'Beginner', 25, 1, '5', 'test@gmail.com.ph', '1'),
(8, 'Intermediate', 2555, 25, '6', 'test@gmail.com.ph', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sql`
--

CREATE TABLE `tbl_sql` (
  `id` int(255) NOT NULL,
  `querydata` text,
  `querydate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stores` int(255) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sql`
--

INSERT INTO `tbl_sql` (`id`, `querydata`, `querydate`, `stores`) VALUES
(1, 'jlcadmin==INSERT INTO tbl_passbook SET createdby=\'jlcadmin\',actual=\'2021-01-01\',amount=\'225.50\',remarks=\'test\',ptype=\'withdraw\',user=\'7\',stores=\'1\'', '2021-01-08 20:51:30', 1),
(2, 'jlcadmin==INSERT INTO tbl_expenses SET amount=\'225.50\',remarks=\'Withdrawal Release 225.50 for Crisanta Flores - 2021-01-08\',passbook_id=\'11380\',actual=\'2021-01-08\',createdby=\'jlcadmin\',stores=\'1\'', '2021-01-08 20:51:30', 1),
(3, 'jlcadmin==INSERT INTO tbl_passbook SET createdby=\'jlcadmin\',actual=\'2021-01-01\',amount=\'150\',remarks=\'test\',ptype=\'savings\',user=\'7\',stores=\'1\'', '2021-01-08 20:54:21', 1),
(4, 'jlcadmin==UPDATE tbl_passbook SET createdby=\'jlcadmin\',actual=\'2021-01-01T21:03\',amount=\'225.5\',remarks=\'test\',ptype=\'withdraw\' WHERE id=\'11380\'', '2021-01-08 21:03:08', 1),
(5, 'jlcadmin==DELETE FROM tbl_expenses WHERE passbook_id = \'11380\'', '2021-01-08 21:03:08', 1),
(6, 'jlcadmin==DELETE FROM tbl_expenses WHERE passbook_id = \'11380\'', '2021-01-08 21:03:08', 1),
(7, 'jlcadmin==INSERT INTO tbl_expenses SET amount=\'225.5\',remarks=\'Withdrawal Release 225.50 for Crisanta Flores - 2021-01-08\',passbook_id=\'11380\',actual=\'2021-01-08\',createdby=\'jlcadmin\',stores=\'1\'', '2021-01-08 21:03:08', 1),
(8, '==INSERT INTO tbl_passbook SET createdby=\'system\',actual=\'2021-01-11 05:46:06\',amount=\'20\',remarks=\'n-a\',ptype=\'dividend\',user=\'903\',stores=\'2\'', '2021-01-11 17:46:22', 1),
(9, 'jlcadmin==UPDATE tbl_accounts SET accounts_id=\'15\',username=\'stanley\',email=\'badingsthanley@gmail.com\',role=\'0\',stores=\'2\' WHERE accounts_id=15', '2021-01-11 17:57:37', 1),
(10, 'ardeenathanraranga1243@gmail.com==INSERT INTO tbl_accounts SET email=\'ardeenathanraranga1243@gmail.com\',password=\'1234\',createdby=\'ardeenathanraranga1243@gmail.com\',username=\'ardeenathanraranga1243@gmail.com\',role=\'2\'', '2021-01-11 20:21:19', 1),
(11, 'ardeenathanraranga1243@gmail.com==INSERT INTO tbl_accounts SET email=\'ardeenathanraranga123@gmail.com\',password=\'1234\',createdby=\'ardeenathanraranga123@gmail.com\',username=\'ardeenathanraranga123@gmail.com\',role=\'2\'', '2021-01-11 20:22:10', 1),
(12, 'ardeenathanraranga123@gmail.com==INSERT INTO tbl_accounts SET email=\'ardeenathanraranga123566@gmail.com\',password=\'1234\',createdby=\'ardeenathanraranga123566@gmail.com\',username=\'ardeenathanraranga123566@gmail.com\',role=\'2\'', '2021-01-11 20:25:46', 1),
(13, '==INSERT INTO tbl_accounts SET fullname=\'Ardee Nathan Villano Raranga\',email=\'ardeenathanraranga@gmail.com\',password=\'1234\',createdby=\'ardeenathanraranga@gmail.com\',username=\'ardeenathanraranga@gmail.com\',role=\'2\'', '2021-01-11 20:27:41', 1),
(14, 'ardeenathanraranga@gmail.com==UPDATE tbl_accounts SET task=\'\',fullname=\'Ardee Nathan Villano Rarangad\' WHERE accounts_id=\'20\'', '2021-01-11 21:45:58', 1),
(15, 'ardeenathanraranga@gmail.com==UPDATE tbl_accounts SET task=\'\',fullname=\'Ardee Nathan Villano Rarangad\' WHERE accounts_id=\'20\'', '2021-01-11 21:46:14', 1),
(16, 'ardeenathanraranga@gmail.com==UPDATE tbl_accounts SET task=\'\',fullname=\'Ardee Nathan Villano Rarangad\' WHERE accounts_id=\'20\'', '2021-01-11 21:46:39', 1),
(17, 'ardeenathanraranga@gmail.com==UPDATE tbl_accounts SET task=\'\',fullname=\'Ardee Nathan Villano Rarangad\' WHERE accounts_id=\'20\'', '2021-01-11 21:46:40', 1),
(18, 'ardeenathanraranga@gmail.com==UPDATE tbl_accounts SET task=\'\',fullname=\'Ardee Nathan Villano Rarangad\' WHERE accounts_id=\'20\'', '2021-01-11 21:46:41', 1),
(19, 'ardeenathanraranga@gmail.com==UPDATE tbl_accounts SET task=\'\',fullname=\'Ardee Nathan Villano Rarangad\' WHERE accounts_id=\'20\'', '2021-01-11 21:46:49', 1),
(20, 'ardeenathanraranga@gmail.com==UPDATE tbl_accounts SET fullname=\'Ardee Nathan Villano Rarangad\' WHERE accounts_id=\'20\'', '2021-01-11 21:47:10', 1),
(21, 'ardeenathanraranga@gmail.com==UPDATE tbl_accounts SET fullname=\'Ardee Nathan Villano Rarangadasdasd\' WHERE accounts_id=\'20\'', '2021-01-11 21:47:12', 1),
(22, '==INSERT INTO tbl_accounts SET fullname=\'Ardee Nathan Villano Raranga\',email=\'ardeenathanraranga555@gmail.com\',password=\'123123\',createdby=\'ardeenathanraranga555@gmail.com\',username=\'ardeenathanraranga555@gmail.com\',role=\'2\'', '2021-01-13 12:56:58', 1),
(23, 'ardeenathanraranga555@gmail.com==INSERT INTO tbl_accounts SET fullname=\'Daga\',email=\'daga@gmail.com\',password=\'1234\',createdby=\'daga@gmail.com\',username=\'daga@gmail.com\',role=\'2\'', '2021-01-13 15:52:12', 1),
(24, '==INSERT INTO tbl_accounts SET fullname=\'King\',email=\'test@gmail.com.ph\',password=\'12345\',createdby=\'test@gmail.com.ph\',username=\'test@gmail.com.ph\',role=\'2\'', '2021-01-13 16:19:28', 1),
(25, 'test@gmail.com.ph==INSERT INTO tbl_accounts SET username=\'ardeenathanraranga123@gmail.com\',fullname=\'text\',wallet=\'12332\',password=\'1234\',email=\'ardeenathanraranga123@gmail.com\',role=\'0\',createdby=\'test@gmail.com.ph\'', '2021-01-13 16:25:33', 1),
(26, 'test@gmail.com.ph==UPDATE tbl_accounts SET accounts_id=\'24\',username=\'ardeenathanraranga123@gmail.com\',fullname=\'ardeenathanraranga123@gmail.com\',wallet=\'12332\',password=\'1234\',email=\'ardeenathanraranga123@gmail.com\',role=\'0\' WHERE accounts_id=24', '2021-01-13 16:25:43', 1),
(27, 'test@gmail.com.ph==DELETE FROM tbl_accounts WHERE accounts_id=24', '2021-01-13 16:26:01', 1),
(28, 'test@gmail.com.ph==INSERT INTO tbl_rate SET rate_name=\'Beginner\',rate_start=\'25\',rate_end=\'1\',rate_bonus=\'5\',createdby=\'test@gmail.com.ph\'', '2021-01-13 16:36:13', 1),
(29, 'test@gmail.com.ph==INSERT INTO tbl_rate SET rate_name=\'Beginner\',rate_start=\'25\',rate_end=\'1\',rate_bonus=\'5\',createdby=\'test@gmail.com.ph\'', '2021-01-13 16:37:49', 1),
(30, 'test@gmail.com.ph==INSERT INTO tbl_rate SET rate_name=\'Intermediate\',rate_start=\'2555\',rate_end=\'25\',rate_bonus=\'6\',createdby=\'test@gmail.com.ph\'', '2021-01-13 16:45:14', 1),
(31, 'test@gmail.com.ph==UPDATE tbl_accounts SET balance=\'475\' WHERE accounts_id=\'23\'', '2021-01-13 16:54:21', 1),
(32, 'test@gmail.com.ph==INSERT INTO tbl_withdraw_history SET address=\'\',cp_number=\'\',team_name=\'\',transnum=\'Z33TX9I637\',remit_name=\'\',smartpadala=\'\',claimtype=\'btc\',name=\'\',phone=\'\',address=\'123456132123\',accounts_id=\'23\',new_balance=\'475\',amount=\'25\',current_balance=\'500\',bank_name=\'\',bank_accountname=\'\',bank_accountnumber=\'\'', '2021-01-13 16:54:21', 1),
(33, 'test@gmail.com.ph==UPDATE tbl_accounts SET balance=\'463\' WHERE accounts_id=\'23\'', '2021-01-13 16:56:34', 1),
(34, 'test@gmail.com.ph==INSERT INTO tbl_withdraw_history SET transnum=\'UI7G1X9VAG7\',claimtype=\'btc\',address=\'1234123123\',accounts_id=\'23\',new_balance=\'463\',amount=\'12\',current_balance=\'475\'', '2021-01-13 16:56:34', 1),
(35, 'test@gmail.com.ph==UPDATE tbl_accounts SET balance=\'438\' WHERE accounts_id=\'23\'', '2021-01-13 16:57:07', 1),
(36, 'test@gmail.com.ph==INSERT INTO tbl_withdraw_history SET transnum=\'PU15TLBW5S73\',claimtype=\'btc\',address=\'123456132123\',accounts_id=\'23\',new_balance=\'438\',amount=\'25\',current_balance=\'463\'', '2021-01-13 16:57:07', 1),
(37, 'test@gmail.com.ph==UPDATE tbl_accounts SET balance=\'413\' WHERE accounts_id=\'23\'', '2021-01-13 16:57:51', 1),
(38, 'test@gmail.com.ph==INSERT INTO tbl_withdraw_history SET transnum=\'6XP9KOHWIVYI\',claimtype=\'btc\',address=\'123456132123\',accounts_id=\'23\',new_balance=\'413\',amount=\'25\',current_balance=\'438\'', '2021-01-13 16:57:51', 1),
(39, 'test@gmail.com.ph==UPDATE tbl_accounts SET balance=\'388\' WHERE accounts_id=\'23\'', '2021-01-13 16:57:57', 1),
(40, 'test@gmail.com.ph==INSERT INTO tbl_withdraw_history SET transnum=\'XD1C0XW41ETA\',claimtype=\'btc\',address=\'123456132123\',accounts_id=\'23\',new_balance=\'388\',amount=\'25\',current_balance=\'413\'', '2021-01-13 16:57:57', 1),
(41, 'test@gmail.com.ph==UPDATE tbl_accounts SET balance=\'363\' WHERE accounts_id=\'23\'', '2021-01-13 16:58:08', 1),
(42, 'test@gmail.com.ph==INSERT INTO tbl_withdraw_history SET transnum=\'XW2871RGBEJ\',claimtype=\'btc\',address=\'123456132123\',accounts_id=\'23\',new_balance=\'363\',amount=\'25\',current_balance=\'388\'', '2021-01-13 16:58:08', 1),
(43, 'test@gmail.com.ph==UPDATE tbl_accounts SET balance=\'338\' WHERE accounts_id=\'23\'', '2021-01-13 16:58:50', 1),
(44, 'test@gmail.com.ph==INSERT INTO tbl_withdraw_history SET transnum=\'HJ16SL1JT5OO\',claimtype=\'btc\',address=\'123456132123\',accounts_id=\'23\',new_balance=\'338\',amount=\'25\',current_balance=\'363\'', '2021-01-13 16:58:50', 1),
(45, 'test@gmail.com.ph==UPDATE tbl_withdraw_history SET claim_status=1 WHERE id=1', '2021-01-13 17:03:59', 1),
(46, 'test@gmail.com.ph==UPDATE tbl_withdraw_history SET claim_status=1 WHERE id=1', '2021-01-13 17:04:05', 1),
(47, 'test@gmail.com.ph==UPDATE tbl_withdraw_history SET claim_status=1 WHERE id=1', '2021-01-13 17:04:42', 1),
(48, 'test@gmail.com.ph==UPDATE tbl_withdraw_history SET claim_status=1 WHERE id=1', '2021-01-13 17:05:10', 1),
(49, 'test@gmail.com.ph==UPDATE tbl_withdraw_history SET claim_status=1 WHERE id=1', '2021-01-13 17:05:12', 1),
(50, 'test@gmail.com.ph==UPDATE tbl_withdraw_history SET claim_status=1 WHERE id=1', '2021-01-13 17:09:07', 1),
(51, 'test@gmail.com.ph==UPDATE tbl_withdraw_history SET claim_status=1 WHERE id=1', '2021-01-13 17:10:39', 1),
(52, 'test@gmail.com.ph==UPDATE tbl_withdraw_history SET claim_status=1 WHERE id=1', '2021-01-13 17:11:39', 1),
(53, 'test@gmail.com.ph==UPDATE tbl_withdraw_history SET claim_status=1 WHERE id=2', '2021-01-13 17:11:48', 1),
(54, 'test@gmail.com.ph==UPDATE tbl_withdraw_history SET claim_status=1 WHERE id=2', '2021-01-13 17:47:58', 1),
(55, '==INSERT INTO tbl_accounts SET fullname=\'Ardee Nathan Villano Raranga\',email=\'aaaa@gmail.com\',password=\'123123\',refer=\'20\',accounts_id=\'33\',parent=\'\',path=\'0/20/21/33\',createdby=\'aaaa@gmail.com\',username=\'aaaa@gmail.com\',role=\'2\'', '2021-01-13 21:15:20', 1),
(56, '==INSERT INTO tbl_accounts SET fullname=\'Ardee Nathan Villano Raranga\',email=\'aaaa@gmail.com\',password=\'123\',refer=\'20\',accounts_id=\'33\',parent=\'\',path=\'0/20/21/33\',createdby=\'aaaa@gmail.com\',username=\'aaaa@gmail.com\',role=\'2\'', '2021-01-13 21:15:42', 1),
(57, '==INSERT INTO tbl_accounts SET fullname=\'Ardee Nathan Villano Raranga\',email=\'aaaa@gmail.com\',password=\'123\',refer=\'20\',accounts_id=\'33\',parent=\'\',path=\'0/20/21/33\',createdby=\'aaaa@gmail.com\',username=\'aaaa@gmail.com\',role=\'2\'', '2021-01-13 21:16:09', 1),
(58, '==INSERT INTO tbl_accounts SET fullname=\'Ardee Nathan Villano Raranga\',email=\'aaaa@gmail.com\',password=\'123\',refer=\'20\',accounts_id=\'33\',parent=\'\',path=\'0/20/21/33\',createdby=\'aaaa@gmail.com\',username=\'aaaa@gmail.com\',role=\'2\'', '2021-01-13 21:17:06', 1),
(59, 'aaaa@gmail.com==INSERT INTO tbl_accounts SET fullname=\'Ardee Nathan Villano Raranga\',email=\'bbb@gmail.com\',password=\'bbb\',refer=\'20\',accounts_id=\'43\',parent=\'\',path=\'0/20/21/43\',createdby=\'bbb@gmail.com\',username=\'bbb@gmail.com\',role=\'2\'', '2021-01-13 21:17:45', 1),
(60, '==INSERT INTO tbl_accounts SET fullname=\'buret\',email=\'bbbb@gmail.com\',password=\'123123\',refer=\'20\',accounts_id=\'53\',parent=\'33\',path=\'0/20/21/33/53\',level=\'5\',createdby=\'bbbb@gmail.com\',username=\'bbbb@gmail.com\',role=\'2\'', '2021-01-13 21:39:53', 1),
(61, '==INSERT INTO tbl_accounts SET fullname=\'burets\',email=\'bbbbc@gmail.com\',password=\'123\',refer=\'20\',accounts_id=\'63\',parent=\'\',path=\'/63\',level=\'2\',createdby=\'bbbbc@gmail.com\',username=\'bbbbc@gmail.com\',role=\'2\'', '2021-01-13 21:41:02', 1),
(62, '==INSERT INTO tbl_accounts SET fullname=\'buretss\',email=\'bbbbcc@gmail.com\',password=\'123\',refer=\'20\',accounts_id=\'73\',parent=\'\',path=\'/73\',level=\'2\',createdby=\'bbbbcc@gmail.com\',username=\'bbbbcc@gmail.com\',role=\'2\'', '2021-01-13 21:42:04', 1),
(63, 'bbbbcc@gmail.com==INSERT INTO tbl_accounts SET fullname=\'buretsss\',email=\'bbbbcdc@gmail.com\',password=\'123\',refer=\'20\',accounts_id=\'83\',parent=\'\',path=\'/83\',level=\'2\',createdby=\'bbbbcdc@gmail.com\',username=\'bbbbcdc@gmail.com\',role=\'2\'', '2021-01-13 21:43:00', 1),
(64, 'bbbbcdc@gmail.com==INSERT INTO tbl_accounts SET fullname=\'Ardee Nathan Villano Raranga\',email=\'ardeenathanrssssaranga@gmail.com\',password=\'1234\',refer=\'20\',accounts_id=\'93\',parent=\'\',path=\'/93\',createdby=\'ardeenathanrssssaranga@gmail.com\',username=\'ardeenathanrssssaranga@gmail.com\',role=\'2\'', '2021-01-13 21:46:15', 1),
(65, 'ardeenathanrssssaranga@gmail.com==INSERT INTO tbl_accounts SET fullname=\'Ardee Nathan Villano Rarangas\',email=\'ardsseenathanrssssaranga@gmail.com\',password=\'1234\',refer=\'20\',accounts_id=\'103\',parent=\'\',path=\'/103\',createdby=\'ardsseenathanrssssaranga@gmail.com\',username=\'ardsseenathanrssssaranga@gmail.com\',role=\'2\'', '2021-01-13 21:50:12', 1),
(66, 'ardsseenathanrssssaranga@gmail.com==INSERT INTO tbl_accounts SET fullname=\'Ardee Nathan Villano Raranga\',email=\'ardeenathanrabbbbranga@gmail.com\',password=\'123123\',refer=\'20\',accounts_id=\'63\',parent=\'22\',path=\'0/20/22/63\',createdby=\'ardeenathanrabbbbranga@gmail.com\',username=\'ardeenathanrabbbbranga@gmail.com\',role=\'2\'', '2021-01-13 21:52:54', 1),
(67, 'ardeenathanrabbbbranga@gmail.com==INSERT INTO tbl_accounts SET fullname=\'Prince MJ\',email=\'ardeenathanrarangsda@gmail.com\',password=\'123123\',refer=\'20\',accounts_id=\'73\',parent=\'22\',path=\'0/20/22/73\',level=\'4\',createdby=\'ardeenathanrarangsda@gmail.com\',username=\'ardeenathanrarangsda@gmail.com\',role=\'2\'', '2021-01-13 21:54:06', 1),
(68, 'ardeenathanrarangsda@gmail.com==INSERT INTO tbl_system SET code=\'task\',value=\'configsave\' ON DUPLICATE KEY UPDATE code=\'task\',value=\'configsave\'', '2021-01-14 12:51:37', 1),
(69, 'ardeenathanrarangsda@gmail.com==INSERT INTO tbl_system SET code=\'user\',value=\'\' ON DUPLICATE KEY UPDATE code=\'user\',value=\'\'', '2021-01-14 12:51:37', 1),
(70, 'ardeenathanrarangsda@gmail.com==INSERT INTO tbl_system SET code=\'id\',value=\'\' ON DUPLICATE KEY UPDATE code=\'id\',value=\'\'', '2021-01-14 12:51:37', 1),
(71, 'ardeenathanrarangsda@gmail.com==INSERT INTO tbl_system SET code=\'email\',value=\'engineering@growth-rocket.com\' ON DUPLICATE KEY UPDATE code=\'email\',value=\'engineering@growth-rocket.com\'', '2021-01-14 12:51:37', 1),
(72, 'ardeenathanrarangsda@gmail.com==INSERT INTO tbl_system SET code=\'merchant_id\',value=\'5e6700fab444b81b5ad308759b2b88a0\' ON DUPLICATE KEY UPDATE code=\'merchant_id\',value=\'5e6700fab444b81b5ad308759b2b88a0\'', '2021-01-14 12:51:37', 1),
(73, 'ardeenathanrarangsda@gmail.com==INSERT INTO tbl_system SET code=\'submit\',value=\'Save Configuration\' ON DUPLICATE KEY UPDATE code=\'submit\',value=\'Save Configuration\'', '2021-01-14 12:51:37', 1),
(74, 'ardeenathanrarangsda@gmail.com==INSERT INTO tbl_exchange_history SET transnum=\'45412asd12312312321\',claimtype=\'btc\',address=\'1234561321233\',accounts_id=\'73\',new_balance=\'\',amount=\'\',current_balance=\'0\'', '2021-01-14 13:59:17', 1),
(75, 'ardeenathanrarangsda@gmail.com==INSERT INTO tbl_exchange_history SET transnum=\'123\',claimtype=\'btc\',address=\'23 A Ilang Ilang\',accounts_id=\'73\',new_balance=\'\',amount=\'\',current_balance=\'0\'', '2021-01-14 14:10:26', 1),
(76, 'ardeenathanrarangsda@gmail.com==UPDATE tbl_exchange_history SET claim_status=1 WHERE id=1', '2021-01-14 14:10:37', 1),
(77, 'ardeenathanrarangsda@gmail.com==DELETE FROM tbl_exchange_history WHERE id=1', '2021-01-14 14:10:51', 1),
(78, 'ardeenathanrarangsda@gmail.com==DELETE FROM tbl_exchange_history WHERE id=1', '2021-01-14 14:11:04', 1),
(79, '==INSERT INTO  tbl_payment_history SET accounts_id=\'53\',amount=\'2555\',ptype=\'complan\',transnum=\'txn1696596382\',rate=\'8\',remarks=\'Complan Payment For: bbbb@gmail.com Complan Type: Intermediate - 2555\',inv=\'CP-1879166585\'', '2021-01-15 18:16:37', 1),
(80, '==INSERT INTO  tbl_bonus_history SET sender=\'bbbb@gmail.com\',receiver=\'aaaa@gmail.com\',ptype=\'complan\',remarks=\'25%(638.75) from aaaa@gmail.com\',amount=\'638.75\'', '2021-01-15 18:23:53', 1),
(81, '==INSERT INTO  tbl_payment_history SET accounts_id=\'53\',amount=\'2555\',ptype=\'complan\',transnum=\'txn1696596382\',rate=\'8\',remarks=\'Complan Payment For: bbbb@gmail.com Complan Type: Intermediate - 2555\',inv=\'CP-1879166585\'', '2021-01-15 18:23:53', 1),
(82, '==INSERT INTO  tbl_bonus_history SET sender=\'bbbb@gmail.com\',receiver=\'aaaa@gmail.com\',ptype=\'complan\',remarks=\'25%(638.75) from aaaa@gmail.com\',amount=\'638.75\'', '2021-01-15 18:24:05', 1),
(83, '==INSERT INTO  tbl_payment_history SET accounts_id=\'53\',amount=\'2555\',ptype=\'complan\',transnum=\'txn1696596382\',rate=\'8\',remarks=\'Complan Payment For: bbbb@gmail.com Complan Type: Intermediate - 2555\',inv=\'CP-1879166585\'', '2021-01-15 18:24:05', 1),
(84, '==INSERT INTO  tbl_bonus_history SET send=\'bbbb@gmail.com\',receiver=\'aaaa@gmail.com\',ptype=\'complan\',remarks=\'25%(638.75) from aaaa@gmail.com\',amount=\'638.75\'', '2021-01-15 18:24:39', 1),
(85, '==INSERT INTO  tbl_payment_history SET accounts_id=\'53\',amount=\'2555\',ptype=\'complan\',transnum=\'txn1696596382\',rate=\'8\',remarks=\'Complan Payment For: bbbb@gmail.com Complan Type: Intermediate - 2555\',inv=\'CP-1879166585\'', '2021-01-15 18:24:39', 1),
(86, '==INSERT INTO  tbl_bonus_history SET send=\'bbbb@gmail.com\',receiver=\'aaaa@gmail.com\',ptype=\'complan\',remarks=\'25%(638.75) from aaaa@gmail.com\',amount=\'638.75\'', '2021-01-15 18:25:07', 1),
(87, '==INSERT INTO  tbl_payment_history SET accounts_id=\'53\',amount=\'2555\',ptype=\'complan\',transnum=\'txn1696596382\',rate=\'8\',remarks=\'Complan Payment For: bbbb@gmail.com Complan Type: Intermediate - 2555\',inv=\'CP-1879166585\'', '2021-01-15 18:25:07', 1),
(88, '==INSERT INTO  tbl_bonus_history SET send=\'bbbb@gmail.com\',receiver=\'aaaa@gmail.com\',ptype=\'complan\',remarks=\'25%(638.75) from aaaa@gmail.com\',amount=\'638.75\'', '2021-01-15 18:25:32', 1),
(89, '==INSERT INTO  tbl_payment_history SET accounts_id=\'53\',amount=\'2555\',ptype=\'complan\',transnum=\'txn1696596382\',rate=\'8\',remarks=\'Complan Payment For: bbbb@gmail.com Complan Type: Intermediate - 2555\',inv=\'CP-1879166585\'', '2021-01-15 18:25:32', 1),
(90, '==INSERT INTO  tbl_bonus_history SET send=\'bbbb@gmail.com\',receiver=\'aaaa@gmail.com\',ptype=\'complan\',remarks=\'25%(638.75) of 2555 from aaaa@gmail.com\',amount=\'638.75\'', '2021-01-15 18:26:13', 1),
(91, '==INSERT INTO  tbl_payment_history SET accounts_id=\'53\',amount=\'2555\',ptype=\'complan\',transnum=\'txn1696596382\',rate=\'8\',remarks=\'Complan Payment For: bbbb@gmail.com Complan Type: Intermediate - 2555\',inv=\'CP-1879166585\'', '2021-01-15 18:26:13', 1),
(92, '==INSERT INTO  tbl_bonus_history SET send=\'bbbb@gmail.com\',receiver=\'aaaa@gmail.com\',ptype=\'complan\',remarks=\'25%(638.75) of 2,555.00 from aaaa@gmail.com\',amount=\'638.75\'', '2021-01-15 18:26:59', 1),
(93, '==INSERT INTO  tbl_payment_history SET accounts_id=\'53\',amount=\'2555\',ptype=\'complan\',transnum=\'txn1696596382\',rate=\'8\',remarks=\'Complan Payment For: bbbb@gmail.com Complan Type: Intermediate - 2555\',inv=\'CP-1879166585\'', '2021-01-15 18:26:59', 1),
(94, '==INSERT INTO  tbl_bonus_history SET send=\'bbbb@gmail.com\',receiver=\'aaaa@gmail.com\',ptype=\'complan\',remarks=\'Bonus: 25%(638.75) of 2,555.00 from aaaa@gmail.com\',amount=\'638.75\'', '2021-01-15 18:29:56', 1),
(95, '==INSERT INTO  tbl_payment_history SET accounts_id=\'53\',amount=\'2555\',ptype=\'complan\',transnum=\'txn1696596382\',rate=\'8\',remarks=\'Complan Payment For: bbbb@gmail.com Complan Type: Intermediate - 2555\',inv=\'CP-1879166585\'', '2021-01-15 18:29:56', 1),
(96, '==UPDATE tbl_accounts SET activated=\'1\',rate=\'8\' WHERE accounts_id=\'53\'', '2021-01-15 18:29:56', 1),
(97, '==INSERT INTO  tbl_bonus_history SET send=\'bbbb@gmail.com\',receiver=\'aaaa@gmail.com\',sid=\'53\',rid=\'33\',ptype=\'complan\',remarks=\'Bonus: 25%(638.75) of 2,555.00 from aaaa@gmail.com\',amount=\'638.75\'', '2021-01-15 18:31:29', 1),
(98, '==INSERT INTO  tbl_payment_history SET accounts_id=\'53\',amount=\'2555\',ptype=\'complan\',transnum=\'txn1696596382\',rate=\'8\',remarks=\'Complan Payment For: bbbb@gmail.com Complan Type: Intermediate - 2555\',inv=\'CP-1879166585\'', '2021-01-15 18:31:29', 1),
(99, '==UPDATE tbl_accounts SET activated=\'1\',rate=\'8\' WHERE accounts_id=\'53\'', '2021-01-15 18:31:29', 1),
(100, 'ardeenathanraranga@gmail.com==INSERT INTO tbl_system SET code=\'task\',value=\'configsave\' ON DUPLICATE KEY UPDATE code=\'task\',value=\'configsave\'', '2021-01-15 18:35:13', 1),
(101, 'ardeenathanraranga@gmail.com==INSERT INTO tbl_system SET code=\'user\',value=\'\' ON DUPLICATE KEY UPDATE code=\'user\',value=\'\'', '2021-01-15 18:35:13', 1),
(102, 'ardeenathanraranga@gmail.com==INSERT INTO tbl_system SET code=\'id\',value=\'\' ON DUPLICATE KEY UPDATE code=\'id\',value=\'\'', '2021-01-15 18:35:13', 1),
(103, 'ardeenathanraranga@gmail.com==INSERT INTO tbl_system SET code=\'email\',value=\'engineering@growth-rocket.com\' ON DUPLICATE KEY UPDATE code=\'email\',value=\'engineering@growth-rocket.com\'', '2021-01-15 18:35:13', 1),
(104, 'ardeenathanraranga@gmail.com==INSERT INTO tbl_system SET code=\'merchant_id\',value=\'5e6700fab444b81b5ad308759b2b88a0\' ON DUPLICATE KEY UPDATE code=\'merchant_id\',value=\'5e6700fab444b81b5ad308759b2b88a0\'', '2021-01-15 18:35:13', 1),
(105, 'ardeenathanraranga@gmail.com==INSERT INTO tbl_system SET code=\'table_percent\',value=\'2\' ON DUPLICATE KEY UPDATE code=\'table_percent\',value=\'2\'', '2021-01-15 18:35:13', 1),
(106, 'ardeenathanraranga@gmail.com==INSERT INTO tbl_system SET code=\'table_amount\',value=\'10\' ON DUPLICATE KEY UPDATE code=\'table_amount\',value=\'10\'', '2021-01-15 18:35:13', 1),
(107, 'ardeenathanraranga@gmail.com==INSERT INTO tbl_system SET code=\'submit\',value=\'Save Configuration\' ON DUPLICATE KEY UPDATE code=\'submit\',value=\'Save Configuration\'', '2021-01-15 18:35:13', 1),
(108, '==INSERT INTO  tbl_payment_history SET accounts_id=\'20\',amount=\'25\',ptype=\'complan\',transnum=\'txn1194581769\',rate=\'7\',remarks=\'Complan Payment For: ardeenathanraranga@gmail.com Complan Type: Beginner - 25\',inv=\'CP-502255176\'', '2021-01-15 18:36:40', 1),
(109, '==UPDATE tbl_accounts SET activated=\'1\',rate=\'7\' WHERE accounts_id=\'20\'', '2021-01-15 18:36:40', 1),
(110, 'ardeenathanraranga@gmail.com==INSERT INTO tbl_exchange_history SET transnum=\'1234412321\',claimtype=\'btc\',address=\'123123213\',accounts_id=\'20\',new_balance=\'\',amount=\'\',current_balance=\'0\'', '2021-01-15 18:37:35', 1),
(111, 'ardeenathanraranga@gmail.com==UPDATE tbl_exchange_history SET claim_status=1 WHERE id=3', '2021-01-15 18:37:54', 1),
(112, 'ardeenathanraranga@gmail.com==UPDATE tbl_exchange_history SET claim_status=1 WHERE id=3', '2021-01-15 18:40:08', 1),
(113, '==INSERT INTO  tbl_payment_history SET accounts_id=\'20\',amount=\'25\',ptype=\'complan\',transnum=\'txn1194581769\',rate=\'7\',remarks=\'Complan Payment For: ardeenathanraranga@gmail.com Complan Type: Beginner - 25\',inv=\'CP-502255176\'', '2021-01-15 18:40:25', 1),
(114, '==UPDATE tbl_accounts SET activated=\'1\',rate=\'7\' WHERE accounts_id=\'20\'', '2021-01-15 18:40:25', 1),
(115, '==INSERT INTO  tbl_payment_history SET accounts_id=\'20\',amount=\'25\',ptype=\'complan\',transnum=\'txn1194581769\',rate=\'7\',remarks=\'Complan Payment For: ardeenathanraranga@gmail.com Complan Type: Beginner - 25\',inv=\'CP-502255176\'', '2021-01-15 18:40:33', 1),
(116, '==UPDATE tbl_accounts SET activated=\'1\',rate=\'7\' WHERE accounts_id=\'20\'', '2021-01-15 18:40:33', 1),
(117, '==INSERT INTO  tbl_payment_history SET accounts_id=\'20\',amount=\'25\',ptype=\'complan\',transnum=\'txn1194581769\',rate=\'7\',remarks=\'Complan Payment For: ardeenathanraranga@gmail.com Complan Type: Beginner - 25\',inv=\'CP-502255176\'', '2021-01-15 18:43:21', 1),
(118, '==UPDATE tbl_accounts SET activated=\'1\',rate=\'7\',deadline=\'2021-01-15 12:00:00\' WHERE accounts_id=\'20\'', '2021-01-15 18:43:21', 1),
(119, '==INSERT INTO  tbl_payment_history SET accounts_id=\'20\',amount=\'25\',ptype=\'complan\',transnum=\'txn1194581769\',rate=\'7\',remarks=\'Complan Payment For: ardeenathanraranga@gmail.com Complan Type: Beginner - 25\',inv=\'CP-502255176\'', '2021-01-15 18:44:12', 1),
(120, '==UPDATE tbl_accounts SET activated=\'1\',rate=\'7\',deadline=\'2021-06-15 12:00:00\' WHERE accounts_id=\'20\'', '2021-01-15 18:44:12', 1),
(121, '==INSERT INTO  tbl_payment_history SET accounts_id=\'20\',amount=\'50\',ptype=\'subscription\',transnum=\'txn621806926\',rate=\'5\',remarks=\'Subscription Payment For: ardeenathanraranga@gmail.com -- 5 Months Subscription - 50\',inv=\'SF-1608071090\'', '2021-01-16 01:04:54', 1),
(122, '==UPDATE tbl_accounts SET deadline=\'2022-11-15 08:20:26\' WHERE accounts_id=\'20\'', '2021-01-16 01:04:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_system`
--

CREATE TABLE `tbl_system` (
  `id` int(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `datatype` varchar(255) DEFAULT NULL,
  `stores` int(255) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_system`
--

INSERT INTO `tbl_system` (`id`, `code`, `value`, `datatype`, `stores`) VALUES
(481, 'task', 'configsave', NULL, 1),
(482, 'user', '', NULL, 1),
(483, 'id', '', NULL, 1),
(484, 'email', 'engineering@growth-rocket.com', NULL, 1),
(485, 'merchant_id', '5e6700fab444b81b5ad308759b2b88a0', NULL, 1),
(486, 'submit', 'Save Configuration', NULL, 1),
(492, 'table_percent', '2', NULL, 1),
(493, 'table_amount', '10', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_withdraw_history`
--

CREATE TABLE `tbl_withdraw_history` (
  `id` int(255) NOT NULL,
  `accounts_id` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `current_balance` varchar(255) NOT NULL,
  `new_balance` varchar(255) NOT NULL,
  `history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `claim_status` varchar(2) NOT NULL DEFAULT '0',
  `claimtype` varchar(25) NOT NULL,
  `transnum` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `stores` varchar(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_withdraw_history`
--

INSERT INTO `tbl_withdraw_history` (`id`, `accounts_id`, `amount`, `current_balance`, `new_balance`, `history`, `claim_status`, `claimtype`, `transnum`, `address`, `stores`) VALUES
(1, '22', '25', '438', '413', '2021-01-13 08:57:51', '1', 'btc', '6XP9KOHWIVYI', '123456132123', '1'),
(2, '23', '25', '413', '388', '2021-01-13 08:57:57', '1', 'btc', 'XD1C0XW41ETA', '123456132123', '1'),
(3, '23', '25', '388', '363', '2021-01-13 08:58:08', '0', 'btc', 'XW2871RGBEJ', '123456132123', '1'),
(4, '23', '25', '363', '338', '2021-01-13 08:58:50', '0', 'btc', 'HJ16SL1JT5OO', '123456132123', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  ADD PRIMARY KEY (`accounts_id`);

--
-- Indexes for table `tbl_bonus_history`
--
ALTER TABLE `tbl_bonus_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_exchange_history`
--
ALTER TABLE `tbl_exchange_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment_history`
--
ALTER TABLE `tbl_payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rate`
--
ALTER TABLE `tbl_rate`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `tbl_sql`
--
ALTER TABLE `tbl_sql`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_system`
--
ALTER TABLE `tbl_system`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `tbl_withdraw_history`
--
ALTER TABLE `tbl_withdraw_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  MODIFY `accounts_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tbl_bonus_history`
--
ALTER TABLE `tbl_bonus_history`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_exchange_history`
--
ALTER TABLE `tbl_exchange_history`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_payment_history`
--
ALTER TABLE `tbl_payment_history`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_rate`
--
ALTER TABLE `tbl_rate`
  MODIFY `rate_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_sql`
--
ALTER TABLE `tbl_sql`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `tbl_system`
--
ALTER TABLE `tbl_system`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=494;

--
-- AUTO_INCREMENT for table `tbl_withdraw_history`
--
ALTER TABLE `tbl_withdraw_history`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
