-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 27, 2015 at 10:24 AM
-- Server version: 5.6.27-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `product_ciblogdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE IF NOT EXISTS `assets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `primary_key` int(11) NOT NULL,
  `mime` varchar(255) NOT NULL,
  `extension` varchar(100) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `path` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `type`, `primary_key`, `mime`, `extension`, `size`, `description`, `path`, `user_id`, `created`, `modified`) VALUES
(1, 'post', 0, 'image/jpeg', '.jpg', '190.48', '10', 'assets/uploads/10.jpg', 1, '2015-12-24 23:43:29', '2015-12-24 23:43:29'),
(2, 'post', 0, 'image/jpeg', '.jpg', '305.92', '6', 'assets/uploads/6.jpg', 1, '2015-12-24 23:48:00', '2015-12-24 23:48:00'),
(3, 'post', 0, 'image/jpeg', '.jpg', '340.45', '9', 'assets/uploads/9.jpg', 1, '2015-12-24 23:48:29', '2015-12-24 23:48:29'),
(4, 'post', 0, 'image/jpeg', '.jpg', '190.48', '10', 'assets/uploads/10.jpg', 1, '2015-12-24 23:48:45', '2015-12-24 23:48:45'),
(5, 'post', 0, 'image/jpeg', '.jpg', '467.65', 'hero', 'assets/uploads/hero.jpg', 1, '2015-12-24 23:49:10', '2015-12-24 23:49:10'),
(6, 'post', 0, 'image/jpeg', '.jpg', '552.86', 'blur', 'assets/uploads/blur.jpg', 1, '2015-12-24 23:49:42', '2015-12-24 23:49:42'),
(7, 'post', 0, 'image/jpeg', '.jpg', '305.92', '6', 'assets/uploads/6.jpg', 1, '2015-12-24 23:55:13', '2015-12-24 23:55:13'),
(8, 'post', 0, 'image/jpeg', '.jpg', '186.94', '8', 'assets/uploads/8.jpg', 1, '2015-12-24 23:57:38', '2015-12-24 23:57:38'),
(9, 'post', 0, 'image/jpeg', '.jpg', '552.86', 'blur', 'assets/uploads/blur.jpg', 1, '2015-12-24 23:57:50', '2015-12-24 23:57:50'),
(10, 'post', 0, 'image/jpeg', '.jpg', '186.94', '8', 'assets/uploads/8.jpg', 1, '2015-12-24 23:57:56', '2015-12-24 23:57:56'),
(11, 'post', 0, 'image/jpeg', '.jpg', '190.48', '10', 'assets/uploads/10.jpg', 1, '2015-12-24 23:58:33', '2015-12-24 23:58:33'),
(12, 'post', 0, 'image/jpeg', '.jpg', '340.45', '9', 'assets/uploads/9.jpg', 1, '2015-12-24 23:58:58', '2015-12-24 23:58:58'),
(13, 'post', 0, 'image/jpeg', '.jpg', '305.92', '6', 'assets/uploads/6.jpg', 1, '2015-12-25 00:00:54', '2015-12-25 00:00:54'),
(14, 'post', 0, 'image/jpeg', '.jpg', '209.27', '7', 'assets/uploads/7.jpg', 1, '2015-12-25 00:02:24', '2015-12-25 00:02:24'),
(15, 'post', 0, 'image/jpeg', '.jpg', '209.27', '7', 'assets/uploads/7.jpg', 9, '2015-12-26 02:35:57', '2015-12-26 02:35:57'),
(16, 'post', 0, 'image/jpeg', '.jpg', '268.98', '5', 'assets/uploads/5.jpg', 9, '2015-12-26 02:37:39', '2015-12-26 02:37:39'),
(17, 'post', 0, 'image/jpeg', '.jpg', '238.62', '3', 'assets/uploads/3.jpg', 9, '2015-12-26 02:40:10', '2015-12-26 02:40:10'),
(18, 'post', 0, 'image/jpeg', '.jpg', '161.11', 'leaf', 'assets/uploads/leaf.jpg', 1, '2015-12-27 01:31:27', '2015-12-27 01:31:27'),
(19, 'post', 0, 'image/png', '.png', '0.96', 'header_bg', 'assets/uploads/header_bg.png', 1, '2015-12-27 01:31:59', '2015-12-27 01:31:59'),
(20, 'post', 0, 'image/jpeg', '.jpg', '32.27', 'bridge', 'assets/uploads/bridge.jpg', 1, '2015-12-27 01:32:12', '2015-12-27 01:32:12');

-- --------------------------------------------------------

--
-- Table structure for table `assets_posts`
--

CREATE TABLE IF NOT EXISTS `assets_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_assets_posts_posts1` (`post_id`),
  KEY `fk_assets_posts_assets1` (`asset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `status`) VALUES
(1, 'Web Programming', 'web-programming', 1),
(2, 'Web Design', 'web-design', 1),
(3, 'Network  & Security', 'network-security', 1),
(4, 'Search Engine Optimation (SEO)', 'search-engine-optimation-seo', 1),
(5, 'Tutorial Web', 'tutorial-web', 0),
(8, 'Test kategori', 'test-kategori', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL,
  `position` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `url`, `parent_id`, `status`, `position`, `type`) VALUES
(12, 'Home', 'home', 0, 1, 12, NULL),
(13, 'About', 'read/about-us', 0, 1, 13, NULL),
(14, 'Blog', 'posts', 0, 1, 14, NULL),
(15, 'Sign In', 'signin', 0, 1, 15, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `methods`
--

CREATE TABLE IF NOT EXISTS `methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `methods_groups`
--

CREATE TABLE IF NOT EXISTS `methods_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `method_id` int(11) NOT NULL DEFAULT '0',
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `allow_access` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_methods_groups_groups1` (`group_id`),
  KEY `fk_methods_groups_methods1` (`method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `body` text,
  `type` varchar(100) NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `published_at` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `body`, `type`, `featured_image`, `status`, `published_at`, `user_id`, `created`, `modified`) VALUES
(1, 'Justice Department Sets Sights on Wall Street Executives', 'justice-department-sets-sights-on-wall-street-executives', '<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p> <p> Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. <br></p><p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p> <p> Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. <br></p><img src="/product/ci-blog/assets/uploads/9.jpg" height="331" width="789"><br><br><br>', 'post', 'assets/uploads/blur.jpg', 0, '2015-12-30', 1, '2015-12-25 01:29:57', '2015-12-26 20:40:38'),
(2, 'Uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla ', 'uis-aute-irure-dolor-in-reprehenderit-in-voluptate-velit-esse-cillum-dolore-eu-fugiat-nulla', '<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p> <p> Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. <br></p><br><img src="/product/ci-blog/assets/uploads/8.jpg" height="388" width="749"><br><br><p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p> <p> Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. <br></p><p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p> <p> Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. </p><br>', 'post', 'assets/uploads/blur.jpg', 1, '2015-12-17', 1, '2015-12-25 02:11:57', '2015-12-26 02:22:06'),
(3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <br><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <br><br><img src="/product/ci-blog/assets/uploads/3.jpg" height="512" width="805"><br><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <br><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <br><br>', 'post', 'assets/uploads/3.jpg', 1, '2015-12-26', 9, '2015-12-26 02:42:38', '2015-12-26 16:37:03'),
(6, 'About Us', 'about-us', '<img src="/product/ci-blog/assets/uploads/3.jpg"><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed, lacinia in, mi. Cras vel lorem. Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam. Quisque semper justo at risus. Donec venenatis, turpis vel hendrerit interdum, dui ligula ultricies purus, sed posuere libero dui id orci. Nam congue, pede vitae dapibus aliquet, elit magna vulputate arcu, vel tempus metus leo non est. Etiam sit amet lectus quis est congue mollis. Phasellus congue lacus eget neque. Phasellus ornare, ante vitae consectetuer consequat, purus sapien ultricies dolor, et mollis pede metus eget nisi. Praesent sodales velit quis augue.<br><br><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed, lacinia in, mi. Cras vel lorem. Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam. Quisque semper justo at risus. Donec venenatis, turpis vel hendrerit interdum, dui ligula ultricies purus, sed posuere libero dui id orci. Nam congue, pede vitae dapibus aliquet, elit magna vulputate arcu, vel tempus metus leo non est. Etiam sit amet lectus quis est congue mollis. Phasellus congue lacus eget neque. Phasellus ornare, ante vitae consectetuer consequat, purus sapien ultricies dolor, et mollis pede metus eget nisi. Praesent sodales velit quis augue. <br><br><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed, lacinia in, mi. Cras vel lorem. Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam. Quisque semper justo at risus. Donec venenatis, turpis vel hendrerit interdum, dui ligula ultricies purus, sed posuere libero dui id orci. Nam congue, pede vitae dapibus aliquet, elit magna vulputate arcu, vel tempus metus leo non est. Etiam sit amet lectus quis est congue mollis. Phasellus congue lacus eget neque. Phasellus ornare, ante vitae consectetuer consequat, purus sapien ultricies dolor, et mollis pede metus eget nisi. Praesent sodales velit quis augue. <br><br>', 'page', '', 1, '2015-12-26', 1, '2015-12-26 19:08:39', '2015-12-27 01:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `posts_categories`
--

CREATE TABLE IF NOT EXISTS `posts_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_posts_categories_categories1` (`category_id`),
  KEY `fk_posts_categories_posts1` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `posts_categories`
--

INSERT INTO `posts_categories` (`id`, `post_id`, `category_id`) VALUES
(5, 1, 5),
(6, 1, 4),
(7, 2, 3),
(8, 2, 8),
(10, 3, 1),
(15, 3, 3),
(16, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `posts_tags`
--

CREATE TABLE IF NOT EXISTS `posts_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_posts_tags_tags1` (`tag_id`),
  KEY `fk_posts_tags_posts1` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `posts_tags`
--

INSERT INTO `posts_tags` (`id`, `post_id`, `tag_id`) VALUES
(5, 3, 1),
(6, 3, 6),
(7, 3, 7),
(8, 1, 7),
(9, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `description`) VALUES
(1, 'email_contact', 'sugiarto@gie-art.com', 'Email kontak form'),
(2, 'image_max_size', '2000', 'Ukuran image dalam kb (kilo byte)'),
(3, 'file_max_size', '3000', 'Ukuran file maksimal dalam kb (kilobyte)'),
(4, 'file_type', 'doc|zip|pdf|xlsx|xls|ppt|docx|pptx', 'Tipe file yang di ijinkan untk di upload'),
(5, 'image_type', 'gif|jpg|png', 'Tipe image yang diperbolehkan untuk di upload'),
(6, 'pagination_limit', '10', 'Batas list /record (artikel, file, dll) per halaman'),
(7, 'main_office', 'Company Address', ''),
(8, 'site_title', 'CI Blog - Basic CMS based on CodeIgniter 3', ''),
(18, 'pagination_limit_directory', '50', '');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `status`) VALUES
(1, 'CodeIgniter', 'codeigniter', 1),
(2, 'Responsive', 'responsive', 1),
(3, 'basic cms', 'basic-cms', 1),
(4, 'tag baru', 'tag-baru', 1),
(5, 'Simple CMS', 'simple-cms', 1),
(6, 'Security Tips', 'security-tips', 1),
(7, 'Hack & DDOS', 'hack-ddos', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1451155670, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(9, '127.0.0.1', 'members', '$2y$08$0TTfatwN6dXgJzX6RpYBzeRIrVsTEUs8ao7ldGewEyCywq4VoMXC.', NULL, 'members@website.com', '6d73486c9d4f501a24c7d9c9bfa3b47d68c471c0', NULL, NULL, NULL, 1451071829, 1451071890, 1, 'My', 'Member', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(9, 1, 1),
(10, 1, 2),
(13, 9, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assets_posts`
--
ALTER TABLE `assets_posts`
  ADD CONSTRAINT `fk_assets_posts_assets1` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_assets_posts_posts1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `methods_groups`
--
ALTER TABLE `methods_groups`
  ADD CONSTRAINT `fk_methods_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_methods_groups_methods1` FOREIGN KEY (`method_id`) REFERENCES `methods` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `posts_categories`
--
ALTER TABLE `posts_categories`
  ADD CONSTRAINT `fk_posts_categories_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_posts_categories_posts1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `posts_tags`
--
ALTER TABLE `posts_tags`
  ADD CONSTRAINT `fk_posts_tags_posts1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_posts_tags_tags1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
