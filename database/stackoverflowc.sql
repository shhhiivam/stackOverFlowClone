-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 27, 2022 at 05:26 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stackoverflowc`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `question` varchar(5000) NOT NULL,
  `upvote` int(10) DEFAULT '0',
  `downvote` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`),
  KEY `user-to-post` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `title`, `question`, `upvote`, `downvote`) VALUES
(1, 1, 'How to add a new project to Github using VS Code', 'All the tutorials ive seen till now shows to first create a repository on github, copy the link go to vscode and git clone it and from that on, you can do commits and pushes. Is that the right way ? cant I just start a project from vscode and then upload it to my git ? EDIT 2020 : You can now do it right inside vscode! just follow these steps: 1- Open your new project folder with vscode 2- click on the source conrol menu on the sidebar', 0, 0),
(8, 1, 'What is the difference between JVM, JDK, JRE & OpenJDK?', ' \r\nWhat is the difference between JVM, JDK, JRE & OpenJDK?\r\n\r\nI was programming in Java and I encountered these phrases, what are the differences among them?', 0, 0),
(9, 1, 'SQL database schema design tags', '	 \r\n						 A beer belongs in a single category.\r\nA category is composed of multiple tags.\r\nA beer is tagged by multiple tags.\r\nA tag can be used with multiple beers (many to many).\r\nConstraint: You cannot add tags to a beer that does not belong to the category those tags are associated with.\r\n\r\nIs this design correct regarding the constraint? Is this something I should handle in my code?\r\n\r\n', 0, 0),
(10, 4, 'How to Normalize the relational schema?', '	 I am trying to fully Normalize (In Third Normal Form) and determine the functional dependencies. However, with endless research, I cannot get around on how to:\r\n\r\nFully Normalize the Relational Schema\r\nDetermine the Functional Dependencies\r\nHow would I go about this?\r\n						  ', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

DROP TABLE IF EXISTS `post_comments`;
CREATE TABLE IF NOT EXISTS `post_comments` (
  `comment_id` int(10) NOT NULL AUTO_INCREMENT,
  `post_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `comment` varchar(5000) NOT NULL,
  `downvote` int(11) NOT NULL DEFAULT '0',
  `upvote` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`),
  KEY `comment-to-post` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_comments`
--

INSERT INTO `post_comments` (`comment_id`, `post_id`, `user_id`, `comment`, `downvote`, `upvote`) VALUES
(3, 8, 1, ' JVM is the virtual machine Java code executes on  JRE is the environment (standard libraries and JVM) required to run Java applications  JDK is the JRE with developer tools and documentations  OpenJDK is an open-source version of the JDK, unlike the common JDK owned by Oracle', 0, 0),
(4, 9, 4, 'Given your constraints, yes, this design is correct.  This design also requires that each tag can belong to only a single category. No many-to-many between category and tag.  You cannot add tags to a beer that does not belong to the category those tags are associated with.  This rule must be enforced through app logic. Nothing in the database design prevents a beer being assigned to tags of categories not assigned that beer. Not a flaw in your design, just the way it is. A relational database design cannot itself enforce every kind of rule or constraint.  Given how vague the idea of user, tag, and category is in your brief description, there is no further advice to be given or further thoughts to consider as we cannot understand the business problem/context.', 0, 0),
(5, 10, 4, 'please help', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `post_id` int(10) NOT NULL,
  `tag` varchar(100) NOT NULL,
  KEY `post-to-tag` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` char(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_image` blob,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `phone_number`, `password`, `profile_image`) VALUES
(1, 'Shivam Sharma', 'Shivam@gmail.com', '8839398613', '123456', NULL),
(2, 'test user', 'test@gmail.com', '889656234', '123456', NULL),
(3, 'test user', 'test@gmail.com', '889656234', '123456', NULL),
(4, 'Alen Doe', 'alen.doe@gmail.com', '6256854598', '123456', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `user-to-post` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `comment-to-post` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `post-to-tag` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
