-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 20, 2022 at 09:41 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `purl_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `post_tb`
--

CREATE TABLE `post_tb` (
  `user_id` varchar(200) CHARACTER SET utf8 NOT NULL,
  `user_uid` int(11) NOT NULL,
  `post_uid` varchar(200) CHARACTER SET utf8 NOT NULL,
  `post_date` date NOT NULL,
  `photo_src` varchar(200) CHARACTER SET utf8 NOT NULL,
  `tags` varchar(200) CHARACTER SET utf8 NOT NULL,
  `addr` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_tb`
--

INSERT INTO `post_tb` (`user_id`, `user_uid`, `post_uid`, `post_date`, `photo_src`, `tags`, `addr`) VALUES
('cweald9', 3, '0d50d74f-b284-4fb2-9a13-52f1f9f7cfc5', '2022-05-31', '/img/cweald9/purl-601975.jpg', 'vancouver aquarium', '845 Avison Way, Vancouver, BC V6G 3E2'),
('cweald9', 3, '0d50d74f-b9a0-4fb2-9a13-52f1f9f7cfc5', '2022-09-30', '/img/cweald9/purl-068276.jpg', 'whytecliff', 'Whytecliff, West Vancouver, BC V7W 2T3'),
('egoodhew8', 5, '18ca7dbb-fa4b-4972-8ece-2da05c3ca7a4', '2022-08-02', '/img/egoodhew8/purl-106726.jpg', 'stanley park', 'Vancouver, BC V6G 1Z4'),
('dcicero2', 4, '4a0f6f46-659a-40b0-a8a2-0cf8afd58b34', '2022-05-23', '/img/dcicero2/purl-847432.jpg', 'downtown colorful', 'Vancouver, BC'),
('srapin5', 10, '4bb0ec87-1540-4f90-a078-ea8239c141de', '2022-02-15', '/img/srapin5/purl-692661.jpg', 'metropolis', '4700 Kingsway, Burnaby, BC V5H 4M5'),
('egoodhew8', 5, '4bb65f81-117e-44a2-8456-a7d728ffdca9', '2022-03-28', '/img/egoodhew8/purl-176592.jpg', 'spanish bank beach', 'Spanish Banks Beach, British Columbia'),
('iskrine3', 8, '556c1316-778b-4d4c-abae-6131c32685e9', '2022-06-10', '/img/iskrine3/purl-096624.jpg', 'white rock', 'White Rock, British Columbia'),
('bgroneway4', 2, '5d96ab2b-e85a-4749-b515-d3556cbebec1', '2022-06-16', '/img/bgroneway4/purl-105262.jpg', 'grouse mountain', '6400 Nancy Greene Way, North Vancouver, BC V7R 4K9'),
('jnewlyn1', 9, '63fc9b88-323c-4152-a6fc-2fb58da34eec', '2022-03-06', '/img/jnewlyn1/purl-345235.jpg', 'deep cove', 'North Vancouver, BC V7G 1T8'),
('cweald9', 3, '72c95f95-0a4e-479f-b9a0-fdadbaeab79f', '2022-08-01', '/img/cweald9/purl-502736.jpg', 'steam clock', '305 Water St, Vancouver, BC V6B 1B9'),
('bgroneway4', 2, '7ad8cefb-e711-465b-950e-e953c0a7efcb', '2022-03-13', '/img/bgroneway4/purl-835572.jpg', 'joffre lake', 'British Columbia V0N 2K0'),
('jnewlyn1', 9, '837161b4-714e-47ac-8b23-24121e706f88', '2022-08-20', '/img/jnewlyn1/purl-123125.jpg', 'coal harbour', 'Vancouver, BC V6G 3E2'),
('iskrine3', 8, '92186085-5c88-49cb-876c-bc37c1bdad00', '2022-05-15', '/img/iskrine3/purl-173731.jpg', 'english bay', 'Beach Ave, Vancouver, BC V6C 3C1'),
('srapin5', 10, 'bb3c601a-7686-49a3-bcc0-82de4e50b469', '2022-06-29', '/img/srapin5/purl-046286.jpg', 'kitsilno beach', 'Kitsilano Beach, Vancouver, BC'),
('cweald9', 3, 'bd854445-3282-482f-853e-03c502965908', '2022-03-26', '/img/cweald9/purl-305712.jpg', 'van dusen', '5251 Oak St, Vancouver, BC V6M 4H1'),
('egoodhew8', 5, 'c34051b2-fe7a-4cc5-a3e8-22091947d0b0', '2022-04-14', '/img/egoodhew8/purl-295629.jpg', 'seymour mountain', 'Seymour mountain Mystery Lake hike, North Vancouver, BC'),
('srapin5', 10, 'dc252d18-288f-45cf-b40b-630b7871de83', '2022-02-11', '/img/srapin5/purl-583621.jpg', 'lynn canyon', '3663 Park Rd, North Vancouver, BC V7J 3K2'),
('gsowood6', 7, 'e5a66b49-a47e-412c-b556-0f737469a30d', '2022-05-13', '/img/gsowood6/purl-027492.jpg', 'queen elizabeth park', '4600 Cambie St, Vancouver, BC V5Z 2Z1'),
('iskrine3', 8, 'ec403453-0c99-4ded-9e9d-78ecaded684d', '2022-07-28', '/img/iskrine3/purl-932862.jpg', 'caribaldi lake', 'Garibaldi Lake, British Columbia'),
('fmansion7', 6, 'f292b33b-6480-4377-9c8b-a810539390ce', '2022-06-28', '/img/fmansion7/purl-745285.jpg', 'science world', '1455 Quebec St, Vancouver, BC V6A 3Z7');

-- --------------------------------------------------------

--
-- Table structure for table `user_tb`
--

CREATE TABLE `user_tb` (
  `user_id` varchar(200) NOT NULL,
  `user_uid` int(11) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `birthday` date NOT NULL,
  `create_id_date` date NOT NULL,
  `login_failure_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tb`
--

INSERT INTO `user_tb` (`user_id`, `user_uid`, `password`, `email`, `gender`, `birthday`, `create_id_date`, `login_failure_num`) VALUES
('admin', 1, '$2y$09$y5cu4pQtrN5z5h026OYMoe/67NfaKEGDe0vr2VOlw6rklViOWKYBG', 'Aq123456@test.te', 'Female', '2015-06-25', '2022-01-05', 0),
('bgroneway4', 2, '$2y$09$nRD/wEsxG8FXgOjgRpp4ru0eV.ag69ZB0v3e4Ib/O2sU4Rb0oqU72', 'testtest@dagondesign.com', 'Female', '1981-06-11', '2022-01-17', 0),
('cweald9', 3, '$2y$09$OL2SdohpTOr.dL5.HAIxlOv64j5jclq7nMTd0nw8Ye3Y2x5iqOBIK', 'dfarfalameev9@umich.edu', 'Female', '1988-07-19', '2022-03-30', 0),
('dcicero2', 4, '$2y$09$/Zv5SG5gpc6xd0JL4MZ1iuE62i7uiMFcQXEbs9Qxtg9wX0NAZg13W', 'kscarce2@icio.us', 'Male', '1996-08-25', '2022-02-03', 0),
('egoodhew8', 5, '$2y$09$DN.JBx04CxuyHQP0LfGooeX/s2vTZ/hvAOdx.qriPBDnYs0xbK9kC', 'edengate8@cdbaby.com', 'Male', '1991-05-20', '2022-04-11', 0),
('fmansion7', 6, '$2y$09$/ZxZaEcZZeUT2VrKQq.HS.JaoATkgsPpkTBB0NAKIJR/ZIMN/fQ66', 'kmacgregor7@reverbnation.com', 'Female', '1985-07-03', '2022-04-30', 0),
('gsowood6', 7, '$2y$09$e4xm.GMEvwipCTuLAUpe5uQR7ygE57RETn9qfkQdE63vwXeEKvzrW', 'hraithmill6@umich.edu', 'Female', '1981-11-04', '2022-07-20', 0),
('iskrine3', 8, '$2y$09$6dlNKT1..4fneO66zZh0LO4wpTVzNEZ78T9B4kGBqbHq83k9OhNZS', 'gtredwell3@oracle.com', 'Male', '1993-06-04', '2022-05-30', 0),
('jnewlyn1', 9, '$2y$09$ZfLFS4v0qBj76XIT6roSr.G/7RkX4FKd4yKaMp2tPcgo4G7xMgjoO', 'ksustin1@time.com', 'Female', '1991-01-26', '2022-03-19', 0),
('srapin5', 10, '$2y$09$CX01W5CIQVsxfHYx2nk6He0IkOSF9HTt/znVfGORvDQXqMBwtNLLW', 'gsnape5@meetup.com', 'Female', '1988-02-19', '2022-06-27', 0),
('Test**809', 11, '$2y$09$1INxAsfWASvAbybF3UZfb./QzK6.ReHrHcfUrASWUOWXV6wa2foDu', 'Test**809@ADAFLZ.CAQ', 'Female', '2022-09-11', '2022-09-01', 0),
('Test*1234', 12, '$2y$09$9ml6NnowMsYtYt7eXIw/CukdmL80NcYZYwYLE.jcdYw15qnmk9vNa', 'Test*1234@acaa.CA', 'Female', '2022-09-25', '2022-09-01', 0),
('User#1234', 13, '$2y$09$RV0YRiqRCEDln04d1NscUukuZvTZErnypl6aajl7tvMCSe9uuTrze', 'User#1234@test.com', 'Female', '2022-09-24', '2022-09-01', 0),
('User*1234', 14, '$2y$09$ehiNZhJuItNcF.n5.ca11.jmHQJFllpn7ROrZBLnxhnlWePoHvwu.', 'ji@l.aaa', 'Female', '2022-09-09', '2022-09-01', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post_tb`
--
ALTER TABLE `post_tb`
  ADD PRIMARY KEY (`post_uid`),
  ADD KEY `user_uid` (`user_uid`);

--
-- Indexes for table `user_tb`
--
ALTER TABLE `user_tb`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_idx` (`user_uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `user_uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post_tb`
--
ALTER TABLE `post_tb`
  ADD CONSTRAINT `user_uid` FOREIGN KEY (`user_uid`) REFERENCES `user_tb` (`user_uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
