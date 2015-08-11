-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2015 at 05:47 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sitemgmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `aliases`
--

CREATE TABLE IF NOT EXISTS `aliases` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `aliasName` varchar(30) NOT NULL,
  `folderNameID` int(6) NOT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `aliases`
--

INSERT INTO `aliases` (`id`, `aliasName`, `folderNameID`, `create_date`) VALUES
(46, 'st-dev.umn.edu', 1, '2015-07-23 04:17:27'),
(47, 'st-stg.umn.edu', 1, '2015-07-23 04:17:27'),
(48, 'wife-dev.umn.edu', 2, '2015-07-23 04:18:15'),
(49, 'wife-stg.umn.edu', 2, '2015-07-23 04:18:15'),
(50, 'site-dev.umn.edu', 3, '2015-08-10 03:20:48'),
(51, 'site-stg.umn.edu', 3, '2015-08-10 03:20:48'),
(52, 'fairy-dev.umn.edu', 4, '2015-08-10 03:32:32'),
(53, 'fairy-stg.umn.edu', 4, '2015-08-10 03:32:32'),
(54, 'fari.umn.edu', 4, '2015-08-11 02:28:25'),
(55, 'sites.umn.edu', 3, '2015-08-11 02:30:16'),
(56, 'mysite-dev.umn.edu', 5, '2015-08-11 02:32:31'),
(57, 'mysite-stg.umn.edu', 5, '2015-08-11 02:32:31'),
(58, 'adf-dev.umn.edu', 6, '2015-08-11 02:51:06'),
(59, 'adf-stg.umn.edu', 6, '2015-08-11 02:51:06'),
(60, 'bedtime-dev.umn.edu', 7, '2015-08-11 02:52:58'),
(61, 'bedtime-stg.umn.edu', 7, '2015-08-11 02:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `entityid`
--

CREATE TABLE IF NOT EXISTS `entityid` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `entityID` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `entityid`
--

INSERT INTO `entityid` (`id`, `entityID`) VALUES
(1, 'bill');

-- --------------------------------------------------------

--
-- Table structure for table `filecontents`
--

CREATE TABLE IF NOT EXISTS `filecontents` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `fileHead` longtext NOT NULL,
  `fileEnd` longtext NOT NULL,
  `fileSubstitution` longtext NOT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `filecontents`
--

INSERT INTO `filecontents` (`id`, `fileHead`, `fileEnd`, `fileSubstitution`, `create_date`, `type`) VALUES
(1, '<?xml version="1.0"?>\r\n\r\n-<md:EntityDescriptor entityID="https://drupalshib.umn.edu/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:md="urn:oasis:names:tc:SAML:2.0:metadata">\r\n\r\n\r\n-<md:SPSSODescriptor protocolSupportEnumeration="urn:oasis:names:tc:SAML:1.1:protocol urn:oasis:names:tc:SAML:2.0:protocol">\r\n\r\n\r\n-<md:KeyDescriptor use="signing">\r\n\r\n\r\n-<ds:KeyInfo xmlns:ds="http://www.w3.org/2000/09/xmldsig#">\r\n\r\n\r\n-<ds:X509Data>\r\n\r\n<ds:X509Certificate>MIIELTCCAxWgAwIBAgIJAJKYkXQVIpRmMA0GCSqGSIb3DQEBBQUAMGwxCzAJBgNVBAYTAlVTMREwDwYDVQQIEwhJbGxpbm9pczEQMA4GA1UEBxMHQ2hpY2FnbzEVMBMGA1UEChMMUGFsYW50aXIubmV0MSEwHwYJKoZIhvcNAQkBFhJhZG1pbkBwYWxhbnRpci5uZXQwHhcNMTMxMTI1MTcxOTM1WhcNMjMxMTI1MTcxOTM1WjBsMQswCQYDVQQGEwJVUzERMA8GA1UECBMISWxsaW5vaXMxEDAOBgNVBAcTB0NoaWNhZ28xFTATBgNVBAoTDFBhbGFudGlyLm5ldDEhMB8GCSqGSIb3DQEJARYSYWRtaW5AcGFsYW50aXIubmV0MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA1qAE8wVJ1a9Ks80vgMbHTTl4FlPeEvPZLLVnzvnAlmXVUjMPQgX7R88u7DdIAaIX744JB8KQfE2bJX1hbIBmDRGRnQ0EmcV+rFv1dyw/xlTcFI5rxXDn3T1vPyAOxjUTpuo8oaOB2zz9BN8B0i7AyFQ8vtjFyiG4cW63QfXQUq7sq62OF/R6KCVN+BJ0UUNf0JWrS+ytL/u/VaZUlVqUi8E3MQR6F0lnsygFitB7C4vzKURhY0/InNrtMi9wdfDdEIKtJO4J2Ardnj2Ed4liIuqEC4IcdXC8HdjAekOfUKZ7t+n+g178kKbSz3sXh4hHMCXqzMuj5jg+lXz5TwPmkwIDAQABo4HRMIHOMB0GA1UdDgQWBBQE8gQFslsLmeX5UcHHXqb1MOnTozCBngYDVR0jBIGWMIGTgBQE8gQFslsLmeX5UcHHXqb1MOnTo6FwpG4wbDELMAkGA1UEBhMCVVMxETAPBgNVBAgTCElsbGlub2lzMRAwDgYDVQQHEwdDaGljYWdvMRUwEwYDVQQKEwxQYWxhbnRpci5uZXQxITAfBgkqhkiG9w0BCQEWEmFkbWluQHBhbGFudGlyLm5ldIIJAJKYkXQVIpRmMAwGA1UdEwQFMAMBAf8wDQYJKoZIhvcNAQEFBQADggEBADWLepK0pEcIKm268gCsTqxeU84ijcmBDACTIuk9sTwnLMhfH/RBuxXZew785KRpgf99EiszhwmnrhGqqTmY5U5cpz6Fgv7JOPqVstK3BHQ/t9JzWm6yeS5WrhOM+lG12T0UgwgnaL5XHzQufsyelbxy+JaBQvI53exuzOtWitBakjyt1NzRTGJT1BU1eZPtSULGwblk2VinfWsjveyu7RGXrSE+MXdklJLR/q2ORlIL4i2QjcPg2FsA8Gd2ERTs74PnWL6ZMycuy316Y5Xu6uQZNYsLf0cS8w9YU4WqyhlxYyqtkbmOX9O/Bw1cyAcEjtsIvvJQoLW6ugIVU0QzMYQ=</ds:X509Certificate>\r\n\r\n</ds:X509Data>\r\n\r\n</ds:KeyInfo>\r\n\r\n</md:KeyDescriptor>\r\n\r\n\r\n-<md:KeyDescriptor use="encryption">\r\n\r\n\r\n-<ds:KeyInfo xmlns:ds="http://www.w3.org/2000/09/xmldsig#">\r\n\r\n\r\n-<ds:X509Data>\r\n\r\n<ds:X509Certificate>MIIELTCCAxWgAwIBAgIJAJKYkXQVIpRmMA0GCSqGSIb3DQEBBQUAMGwxCzAJBgNVBAYTAlVTMREwDwYDVQQIEwhJbGxpbm9pczEQMA4GA1UEBxMHQ2hpY2FnbzEVMBMGA1UEChMMUGFsYW50aXIubmV0MSEwHwYJKoZIhvcNAQkBFhJhZG1pbkBwYWxhbnRpci5uZXQwHhcNMTMxMTI1MTcxOTM1WhcNMjMxMTI1MTcxOTM1WjBsMQswCQYDVQQGEwJVUzERMA8GA1UECBMISWxsaW5vaXMxEDAOBgNVBAcTB0NoaWNhZ28xFTATBgNVBAoTDFBhbGFudGlyLm5ldDEhMB8GCSqGSIb3DQEJARYSYWRtaW5AcGFsYW50aXIubmV0MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA1qAE8wVJ1a9Ks80vgMbHTTl4FlPeEvPZLLVnzvnAlmXVUjMPQgX7R88u7DdIAaIX744JB8KQfE2bJX1hbIBmDRGRnQ0EmcV+rFv1dyw/xlTcFI5rxXDn3T1vPyAOxjUTpuo8oaOB2zz9BN8B0i7AyFQ8vtjFyiG4cW63QfXQUq7sq62OF/R6KCVN+BJ0UUNf0JWrS+ytL/u/VaZUlVqUi8E3MQR6F0lnsygFitB7C4vzKURhY0/InNrtMi9wdfDdEIKtJO4J2Ardnj2Ed4liIuqEC4IcdXC8HdjAekOfUKZ7t+n+g178kKbSz3sXh4hHMCXqzMuj5jg+lXz5TwPmkwIDAQABo4HRMIHOMB0GA1UdDgQWBBQE8gQFslsLmeX5UcHHXqb1MOnTozCBngYDVR0jBIGWMIGTgBQE8gQFslsLmeX5UcHHXqb1MOnTo6FwpG4wbDELMAkGA1UEBhMCVVMxETAPBgNVBAgTCElsbGlub2lzMRAwDgYDVQQHEwdDaGljYWdvMRUwEwYDVQQKEwxQYWxhbnRpci5uZXQxITAfBgkqhkiG9w0BCQEWEmFkbWluQHBhbGFudGlyLm5ldIIJAJKYkXQVIpRmMAwGA1UdEwQFMAMBAf8wDQYJKoZIhvcNAQEFBQADggEBADWLepK0pEcIKm268gCsTqxeU84ijcmBDACTIuk9sTwnLMhfH/RBuxXZew785KRpgf99EiszhwmnrhGqqTmY5U5cpz6Fgv7JOPqVstK3BHQ/t9JzWm6yeS5WrhOM+lG12T0UgwgnaL5XHzQufsyelbxy+JaBQvI53exuzOtWitBakjyt1NzRTGJT1BU1eZPtSULGwblk2VinfWsjveyu7RGXrSE+MXdklJLR/q2ORlIL4i2QjcPg2FsA8Gd2ERTs74PnWL6ZMycuy316Y5Xu6uQZNYsLf0cS8w9YU4WqyhlxYyqtkbmOX9O/Bw1cyAcEjtsIvvJQoLW6ugIVU0QzMYQ=</ds:X509Certificate>\r\n\r\n</ds:X509Data>\r\n\r\n</ds:KeyInfo>\r\n\r\n</md:KeyDescriptor>', '\r\n</md:SPSSODescriptor>\r\n\r\n</md:EntityDescriptor>', '<!-- ---SUBSTITUTION----->\r\n\r\n\r\n<md:SingleLogoutService Location="https://---SUBSTITUTION---/simplesaml/module.php/saml/sp/saml2-logout.php/default-sp" Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect"/>\r\n\r\n<md:SingleLogoutService Location="https://---SUBSTITUTION---/simplesaml/module.php/saml/sp/saml2-logout.php/default-sp" Binding="urn:oasis:names:tc:SAML:2.0:bindings:SOAP"/>\r\n\r\n<md:AssertionConsumerService Location="https://---SUBSTITUTION---/simplesaml/module.php/saml/sp/saml2-acs.php/default-sp" Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST" index="0"/>\r\n\r\n<md:AssertionConsumerService Location="https://---SUBSTITUTION---/simplesaml/module.php/saml/sp/saml1-acs.php/default-sp" Binding="urn:oasis:names:tc:SAML:1.0:profiles:browser-post" index="1"/>\r\n\r\n<md:AssertionConsumerService Location="https://---SUBSTITUTION---/simplesaml/module.php/saml/sp/saml2-acs.php/default-sp" Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Artifact" index="2"/>\r\n\r\n<md:AssertionConsumerService Location="https://---SUBSTITUTION---/simplesaml/module.php/saml/sp/saml1-acs.php/default-sp/artifact" Binding="urn:oasis:names:tc:SAML:1.0:profiles:artifact-01" index="3"/>', '2015-07-08 22:59:27', 'metadata'),
(2, '<?php\n/**\n * Update the $env_domains array with a new site entry in this form:\n * ''SITE URL / FOLDER NAME'' => array(\n *   ''db_id'' => ''DATABASE NAME'',\n *   ''aliases'' => array(\n *     ''SITE -DEV ALIAS'',\n *     ''SITE -STG ALIAS'',\n *     ''ETC'',\n *   ),\n *   ''purge_domain'' => ''SITE URL'',\n * ),\n */\nglobal $db_id;\n\n$env_domains = array(\n', '  // ''newsite'' => array(\r\n  //   ''db_id'' => ''database'',\r\n  //   ''aliases'' => array(\r\n  //     ''alias 1'',\r\n  //     ''alias 2'',\r\n  //   ),\r\n  //   ''purge_domain'' => ''primary site url'',\r\n  // ),\r\n);', '  ''---FOLDERNAME---'' => array(\r\n    ''db_id'' => ''---DBNAME---'',\r\n    ''aliases'' => array(', '2015-07-09 02:54:38', 'sites.php');

-- --------------------------------------------------------

--
-- Table structure for table `sitefolders`
--

CREATE TABLE IF NOT EXISTS `sitefolders` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `folderName` varchar(30) NOT NULL,
  `subscriptionsID` int(6) NOT NULL,
  `databaseName` varchar(30) NOT NULL,
  `repositoryName` varchar(30) DEFAULT NULL,
  `launchDate` timestamp NULL DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `sitefolders`
--

INSERT INTO `sitefolders` (`id`, `folderName`, `subscriptionsID`, `databaseName`, `repositoryName`, `launchDate`, `create_date`) VALUES
(1, 'st.umn.edu', 1, 'st', NULL, NULL, '2015-07-23 04:17:27'),
(2, 'wife.umn.edu', 3, 'wife', NULL, NULL, '2015-07-23 04:18:15'),
(3, 'site.umn.edu', 1, 'site', NULL, NULL, '2015-08-10 03:20:48'),
(4, 'fairy.umn.edu', 1, 'fairy', 'fairly.com', NULL, '2015-08-10 03:32:32'),
(5, 'mysite.umn.edu', 1, 'mysite', '', NULL, '2015-08-11 02:32:31'),
(6, 'adf.umn.edu', 2, 'adf', '', NULL, '2015-08-11 02:51:06'),
(7, 'bedtime.umn.edu', 1, 'bedtime', '', NULL, '2015-08-11 02:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `siteowners`
--

CREATE TABLE IF NOT EXISTS `siteowners` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `ownerFirstName` varchar(30) NOT NULL,
  `ownerLastName` varchar(30) NOT NULL,
  `ownerEmail` varchar(30) NOT NULL,
  `ownerDept` varchar(30) NOT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `siteowners`
--

INSERT INTO `siteowners` (`id`, `ownerFirstName`, `ownerLastName`, `ownerEmail`, `ownerDept`, `create_date`) VALUES
(1, 'John', 'Starr', 'starr027@umn.edu', 'home', '2015-08-11 03:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `subscriptionName` varchar(30) NOT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `subscriptionName`, `create_date`) VALUES
(1, 'blah', '2015-07-06 01:02:33'),
(2, 'ny', '2015-07-06 01:27:15'),
(3, 'subs', '2015-07-06 03:22:50'),
(4, 'sub2', '2015-07-06 03:24:42'),
(5, 'sub6', '2015-07-06 03:25:55'),
(6, 'ssseg', '2015-07-06 03:26:19'),
(22, 'agi', '2015-07-10 03:43:55'),
(23, 'bill', '2015-07-12 03:45:54'),
(54, 'yojohnyo', '2015-07-14 04:09:19'),
(55, 'akiss2115', '2015-07-14 04:09:37');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
