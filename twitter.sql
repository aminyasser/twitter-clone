-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2021 at 03:16 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twitter`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(140) COLLATE utf16_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `post_id`, `time`) VALUES
(44, 'great work', 25, 574, '2021-05-01 02:21:10'),
(45, 'sasa', 2, 712, '2021-05-01 05:31:56');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `following_id` int(11) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id`, `follower_id`, `following_id`, `time`) VALUES
(15, 40, 2, '2021-04-19 18:30:06'),
(16, 33, 2, '2021-04-19 18:30:56'),
(41, 37, 2, '2021-04-20 20:19:49'),
(43, 5, 2, '2021-04-20 20:20:32'),
(44, 27, 2, '2021-04-20 20:21:18'),
(45, 34, 2, '2021-04-20 20:22:07'),
(90, 41, 2, '2021-04-25 18:20:22'),
(94, 25, 27, '2021-04-27 07:07:27'),
(98, 42, 2, '2021-04-29 06:30:41'),
(99, 43, 2, '2021-04-29 06:32:50'),
(100, 44, 2, '2021-04-29 18:17:25'),
(101, 2, 25, '2021-04-30 02:16:24'),
(102, 25, 2, '2021-04-30 22:56:21'),
(120, 54, 2, '2021-05-01 06:57:13'),
(121, 55, 2, '2021-05-12 16:18:45'),
(126, 56, 2, '2021-05-12 16:35:31'),
(128, 57, 2, '2021-05-12 18:23:30'),
(129, 58, 2, '2021-05-13 14:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(192, 2, 362),
(209, 25, 573),
(211, 2, 573),
(214, 2, 574),
(224, 25, 635),
(225, 25, 712),
(227, 2, 711);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `notify_for` int(11) NOT NULL,
  `notify_from` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `type` enum('follow','like','retweet','qoute','comment','reply','mention') COLLATE utf16_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `count` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notify_for`, `notify_from`, `target`, `type`, `time`, `count`, `status`) VALUES
(30, 2, 25, 635, 'like', '2021-04-29 05:50:12', 1, 0),
(32, 2, 42, 0, 'follow', '2021-04-29 06:30:41', 1, 0),
(34, 2, 25, 711, 'qoute', '2021-04-29 18:29:24', 1, 0),
(35, 25, 2, 712, 'qoute', '2021-04-29 18:29:55', 1, 0),
(36, 2, 25, 712, 'like', '2021-04-29 18:31:11', 1, 0),
(37, 2, 25, 712, 'retweet', '2021-04-29 18:31:19', 1, 0),
(38, 25, 2, 0, 'follow', '2021-04-30 02:16:24', 1, 0),
(39, 2, 25, 0, 'follow', '2021-04-30 22:56:20', 1, 0),
(53, 2, 25, 574, 'comment', '2021-05-01 02:21:10', 1, 0),
(54, 25, 2, 574, 'reply', '2021-05-01 02:21:51', 1, 0),
(55, 2, 42, 725, 'mention', '2021-05-01 02:25:37', 1, 0),
(58, 25, 2, 711, 'like', '2021-05-01 04:32:36', 1, 0),
(67, 2, 54, 0, 'follow', '2021-05-01 06:57:13', 1, 0),
(68, 2, 55, 0, 'follow', '2021-05-12 16:18:46', 1, 0),
(73, 2, 56, 0, 'follow', '2021-05-12 16:35:31', 1, 0),
(75, 2, 57, 0, 'follow', '2021-05-12 18:23:30', 1, 0),
(76, 2, 58, 0, 'follow', '2021-05-13 14:52:58', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post_on`) VALUES
(362, 2, '2021-02-06 08:31:07'),
(573, 2, '2021-04-02 03:03:39'),
(574, 2, '2021-04-02 03:04:53'),
(635, 2, '2021-04-15 09:03:32'),
(654, 2, '2021-04-25 02:19:45'),
(711, 25, '2021-04-29 18:29:24'),
(712, 2, '2021-04-29 18:29:55');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reply` varchar(140) COLLATE utf16_unicode_ci NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `comment_id`, `user_id`, `reply`, `time`) VALUES
(11, 44, 2, 'ty', '2021-05-01 02:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `retweets`
--

CREATE TABLE `retweets` (
  `post_id` int(11) NOT NULL,
  `retweet_msg` varchar(140) COLLATE utf16_unicode_ci DEFAULT NULL,
  `tweet_id` int(11) DEFAULT NULL,
  `retweet_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `retweets`
--

INSERT INTO `retweets` (`post_id`, `retweet_msg`, `tweet_id`, `retweet_id`) VALUES
(711, 'good job', 654, NULL),
(712, '&lt;3', NULL, 711);

-- --------------------------------------------------------

--
-- Table structure for table `trends`
--

CREATE TABLE `trends` (
  `id` int(11) NOT NULL,
  `hashtag` varchar(140) COLLATE utf16_unicode_ci NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `trends`
--

INSERT INTO `trends` (`id`, `hashtag`, `created_on`) VALUES
(1, 'php', '2021-01-06 05:57:43'),
(4, 'hi', '2021-01-25 21:42:35'),
(5, 'alex', '2021-01-25 21:42:36'),
(6, '7oda', '2021-03-20 23:40:12'),
(9, 'js', '2021-04-02 03:24:28'),
(12, 'bro', '2021-04-02 03:31:38');

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE `tweets` (
  `post_id` int(11) NOT NULL,
  `status` varchar(140) COLLATE utf16_unicode_ci DEFAULT NULL,
  `img` text COLLATE utf16_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`post_id`, `status`, `img`) VALUES
(362, '@amin hello it\'s amin here!', NULL),
(573, 'one day!', 'tweet-60666d6b426a1.jpg'),
(574, '#php is fun', NULL),
(635, '', 'tweet-6077e54477f73.jpeg'),
(654, 'it\'s all about big dreams!', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(40) COLLATE utf16_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf16_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf16_unicode_ci NOT NULL,
  `name` varchar(40) COLLATE utf16_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf16_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `imgCover` varchar(255) COLLATE utf16_unicode_ci NOT NULL DEFAULT 'cover.png',
  `bio` varchar(140) COLLATE utf16_unicode_ci NOT NULL DEFAULT '',
  `location` varchar(255) COLLATE utf16_unicode_ci NOT NULL DEFAULT '',
  `website` varchar(255) COLLATE utf16_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `name`, `img`, `imgCover`, `bio`, `location`, `website`) VALUES
(2, 'amin', 'amin@twitter.com', '8e4e9b7ac6fc0df9e06f57f1c366cf8a', 'Amin.', 'user-608b4b4187b5c.JPG', 'user-607ef530bdeab.jpg', 'Undergraduate Software Engineer.', 'Alexandria,Egypt', 'https://github.com/aminyasser'),
(5, 'bodatolba', 'tolba@twitter.com', 'e10adc3949ba59abbe56e057f20f883e', 'Tolba', 'default.jpg', 'cover.png', '', '', ''),
(25, '7oda', '7oda@twitter.com', 'e10adc3949ba59abbe56e057f20f883e', '7oda', 'default.jpg', 'cover.png', '', '', ''),
(27, 'hasona', 'hasona@twitter.com', 'e10adc3949ba59abbe56e057f20f883e', 'hassan', 'default.jpg', 'cover.png', '', '', ''),
(33, '7odawael', 'wael@twitter.com', 'e10adc3949ba59abbe56e057f20f883e', 'Mahmoud', 'default.jpg', 'cover.png', '', '', ''),
(34, 'haidy', 'haidy@twitter.com', 'e10adc3949ba59abbe56e057f20f883e', 'haidy', 'default.jpg', 'cover.png', '', '', ''),
(37, 'aminn', 'amin1@twitter.com', 'e10adc3949ba59abbe56e057f20f883e', 'Amin Yasser', 'default.jpg', 'cover.png', '', '', ''),
(40, 'mohanadyasser', 'mohanad@twitter.com', 'e10adc3949ba59abbe56e057f20f883e', 'Mohanad', 'default.jpg', 'cover.png', '', '', ''),
(41, 'khaled0', 'khaled@twitter.com', 'e10adc3949ba59abbe56e057f20f883e', 'Khalid', 'default.jpg', 'cover.png', '', '', ''),
(42, 'ahmed0', 'ahmed@twitter.com', 'e10adc3949ba59abbe56e057f20f883e', 'Ahmed', 'default.jpg', 'user-609be2968c0b9.png', '', '', ''),
(43, 'samy', 'samy@twitter.com', 'e10adc3949ba59abbe56e057f20f883e', 'Samy', 'default.jpg', 'cover.png', '', '', ''),
(44, 'remo', 'remo@twitter.com', 'e10adc3949ba59abbe56e057f20f883e', 'Ramez', 'default.jpg', 'cover.png', '', '', ''),
(54, 'aminyasser', 'amino@twitter.com', 'e10adc3949ba59abbe56e057f20f883e', 'Amin Yasser', 'default.jpg', 'cover.png', '', '', ''),
(55, 'sasaa', 'aminsss@twitter.com', 'e10adc3949ba59abbe56e057f20f883e', 'Amin Yasser', 'user-609be3deec8e5.jpg', 'cover.png', '', '', ''),
(56, 'nbnbkj', 'nn@twittt.com', 'e10adc3949ba59abbe56e057f20f883e', 'Markting', 'default.jpg', 'cover.png', '', '', ''),
(57, 'sas', 'amin@ydar.com', 'e10adc3949ba59abbe56e057f20f883e', 'Amin Yasser', 'default.jpg', 'cover.png', '', '', ''),
(58, '201', 'amin111@twitter.com', 'e10adc3949ba59abbe56e057f20f883e', 'Amin1', 'default.jpg', 'cover.png', 'Hey', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `follower_id` (`follower_id`),
  ADD KEY `following_id` (`following_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `likes_ibfk_2` (`post_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_ibfk_1` (`notify_for`),
  ADD KEY `notifications_ibfk_2` (`notify_from`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `retweets`
--
ALTER TABLE `retweets`
  ADD PRIMARY KEY (`post_id`) USING BTREE,
  ADD KEY `retweet_id` (`retweet_id`),
  ADD KEY `retweets_ibfk_2` (`tweet_id`);

--
-- Indexes for table `trends`
--
ALTER TABLE `trends`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hashtag` (`hashtag`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=726;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `trends`
--
ALTER TABLE `trends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`following_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`notify_for`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`notify_from`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `replies_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `retweets`
--
ALTER TABLE `retweets`
  ADD CONSTRAINT `retweets_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `retweets_ibfk_2` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `retweets_ibfk_3` FOREIGN KEY (`retweet_id`) REFERENCES `retweets` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tweets`
--
ALTER TABLE `tweets`
  ADD CONSTRAINT `tweets_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
