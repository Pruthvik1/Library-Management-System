-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2022 at 12:36 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `book_img` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `summary` text NOT NULL,
  `isbn_no` varchar(100) NOT NULL,
  `auther` varchar(100) NOT NULL,
  `total_qty` int(20) NOT NULL,
  `available_qty` int(20) NOT NULL,
  `created_at` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `category_id`, `book_img`, `title`, `slug`, `summary`, `isbn_no`, `auther`, `total_qty`, `available_qty`, `created_at`) VALUES
(1, 1, 'java.jpg', 'Intro to Java', 'books/view/1', 'Java - Wikipedia\r\n\r\nJava is a high-level, class-based, object-oriented programming language that is designed to have as few implementation dependencies as possible. It is a general-purpose programming language intended to let programmers write once, run anywhere , meaning that compiled Java code can run on all platforms that support Java without the need to recompile. Java applications are typically compiled to bytecode that can run on any Java virtual machine regardless of the underlying computer architecture. The syntax of Java is similar to C and C++, but has fewer low-level facilities than either of them. The Java runtime provides dynamic capabilities that are typically not available in traditional compiled languages. As of 2019 , Java was one of the most popular programming languages in use according to GitHub, particularly for client–server web applications, with a reported 9 million developers.\r\nJava was originally developed by James Gosling at Sun Microsystems and released in May 1995 as a core component of Sun Microsystems\' Java platform. The original and reference implementation Java compilers, virtual machines, and class libraries were originally released by Sun under proprietary licenses.\r\n\r\nVersions\r\n\r\nSun has defined and supports four editions of Java targeting different application environments and segmented many of its APIs so that they belong to one of the platforms.\r\nThe classes in the Java APIs are organized into separate groups called packages.\r\n\r\nJava JVM and bytecode\r\n\r\nTypical implementations of these APIs on Application Servers or Servlet Containers use a standard servlet for handling all interactions with the HTTP requests and responses that delegate to the web service methods for the actual business logic.', '1111', 'Y. Daniel Lian', 20, 20, '2022-07-12 15:50:53'),
(2, 2, 'catch.jpg', 'Catch-22', NULL, 'The first broadly follows the story fragmented between characters, but in a single chronological time in 1944. Previously the reader had been cushioned from experiencing the full horror of events, but in the final section, the events are laid bare. The horror begins with the attack on the undefended Italian mountain village, with the following chapters involving despair , disappearance in combat , disappearance caused by the army or death of most of Yossarian\'s friends , culminating in the horrors of Chapter 39, in particular the rape and murder of the innocent young woman, Michaela. Nevertheless, the novel ends on an upbeat note with Yossarian learning of Orr\'s miraculous escape to Sweden and Yossarian\'s pledge to follow him there.\r\nMany events in the book are repeatedly described from differing points of view, so the reader learns more about each event from each iteration, with the new information often completing a joke, the setup of which was told several chapters previously. The narrative\'s events are out of sequence, but events are referred to as if the reader is already familiar with them so that the reader must ultimately piece together a timeline of events. Much of Heller\'s prose in Catch-22 is circular and repetitive, exemplifying in its form the structure of a Catch-22. Circular reasoning is widely used by some characters to justify their actions and opinions.\r\n\r\nHeller revels in paradox. « Lieutenant Scheisskopf was also the prosecutor. Clevinger had an officer defending him.', '21212121', 'Joseph Heller', 10, 10, '2022-07-12 15:50:53'),
(3, 3, 'IClaudius.jpg', 'I, Claudius', NULL, 'I, Claudius is a historical novel by English writer Robert Graves, published in 1934. Written in the form of an autobiography of the Roman Emperor Claudius, it tells the history of the Julio-Claudian dynasty and the early years of the Roman Empire, from Julius Caesar\'s assassination in 44 BC to Caligula\'s assassination in AD 41. Though the narrative is largely fictionalized, most of the events depicted are drawn from historical accounts of the same time period by the Roman historians Suetonius and Tacitus.\r\n\r\nThe \"autobiography\" continues in a sequel, Claudius the God (1935), which covers the period from Claudius\' accession to his death in AD 54. The sequel also includes a section written as a biography of Herod Agrippa, a contemporary of Claudius and a King of the Jews. The two books were adapted by the BBC into the award-winning television serial I, Claudius in 1976.\r\n\r\nGraves stated in an interview with Malcolm Muggeridge in 1965, that he wrote I, Claudius mainly because he needed the money to pay off a debt, having been let down in a land deal. He needed to raise £4000, but with the success of the books he brought in £8000 in six months, thus extricating himself from his precarious financial position. [2]\r\n\r\nIn 1998, the Modern Library ranked I, Claudius fourteenth on its list of the 100 best English-language novels of the 20th century.[3] In 2005, the novel was chosen by Time as one of the 100 best English-language novels from 1923 to the present.[4]', '31313131', 'Robert Graves', 5, 5, '2022-07-12 15:50:53'),
(4, 4, 'To Kill a Mockingbird.jpg', 'To Kill a Mockingbird', NULL, 'When he was nearly thirteen, my brother Jem got his arm badly broken at the elbow. When it healed, and Jem\'s fears of never being able to play football were assuaged, he was seldom self-conscious about his injury. His left arm was somewhat shorter than his right; when he stood or walked, the back of his hand was at right angles to his body, his thumb parallel to his thigh. He couldn\'t have cared less, so long as he could pass and punt.\r\n\r\nWhen enough years had gone by to enable us to look back on them, we sometimes discussed the events leading to his accident. I maintain that the Ewells started it all, but Jem, who was four years my senior, said it started long before that. He said it began the summer Dill came to us, when Dill first gave us the idea of making Boo Radley come out.\r\n\r\nI said if he wanted to take a broad view of the thing, it really began with Andrew Jackson. If General Jackson hadn\'t run the Creeks up the creek, Simon Finch would never have paddled up the Alabama, and where would we be if he hadn\'t? We were far too old to settle an argument with a fist-fight, so we consulted Atticus. Our father said we were both right.\r\n\r\nBeing Southerners, it was a source of shame to some members of the family that we had no recorded ancestors on either side of the Battle of Hastings. All we had was Simon Finch, a fur-trapping apothecary from Cornwall whose piety was exceeded only by his stinginess. In England, Simon was irritated by the persecution of those who called themselves Methodists at the hands of their more liberal brethren, and as Simon called himself a Methodist, he worked his way across the Atlantic to Philadelphia, thence to Jamaica, thence to Mobile, and up the Saint Stephens. Mindful of John Wesley\'s strictures on the use of many words in buying and selling, Simon made a pile practicing medicine, but in this pursuit he was unhappy lest he be tempted into doing what he knew was not for the glory of God, as the putting on of gold and costly apparel. So Simon, having forgotten his teacher\'s dictum on the possession of human chattels, bought three slaves and with their aid established a homestead on the banks of the Alabama River some forty miles above Saint Stephens. He returned to Saint Stephens only once, to find a wife, and with her established a line that ran high to daughters. Simon lived to an impressive age and died rich.\r\n\r\nIt was customary for the men in the family to remain on Simon\'s homestead, Finch\'s Landing, and make their living from cotton. The place was self-sufficient: modest in comparison with the empires around it, the Landing nevertheless produced everything required to sustain life except ice, wheat flour, and articles of clothing, supplied by river-boats from Mobile.\r\n\r\nSimon would have regarded with impotent fury the disturbance between the North and the South, as it left his descendants stripped of everything but their land, yet the tradition of living on the land remained unbroken until well into the twentieth century, when my father, Atticus Finch, went to Montgomery to read law, and his younger brother went to Boston to study medicine. Their sister Alexandra was the Finch who remained at the Landing: she married a taciturn man who spent most of his time lying in a hammock by the river wondering if his trot-lines were full.\r\n\r\nWhen my father was admitted to the bar, he returned to Maycomb and began his practice. Maycomb, some twenty miles east of Finch\'s Landing, was the county seat of Maycomb County. Atticus\'s office in the courthouse contained little more than a hat rack, a spittoon, a checkerboard and an unsullied Code of Alabama. His first two clients were the last two persons hanged in the Maycomb County jail. Atticus had urged them to accept the state\'s generosity in allowing them to plead Guilty to second-degree murder and escape with their lives, but they were Haverfords, in Maycomb County a name synonymous with jackass. The Haverfords had dispatched Maycomb\'s leading blacksmith in a misunderstanding arising from the alleged wrongful detention of a mare, were imprudent enough to do it in the presence of three witnesses, and insisted that the-son-of-a-bitch-had-it-coming-to-him was a good enough defense for anybody. They persisted in pleading Not Guilty to first-degree murder, so there was nothing much Atticus could do for his clients except be present at their departure, an occasion that was probably the beginning of my father\'s profound distaste for the practice of criminal law.', '4141414141', 'Lee, Harper', 5, 5, '2022-07-12 15:50:53'),
(5, 4, 'theHobbit.jpg', 'The Hobbit', NULL, 'The Hobbit, or There and Back Again is a children\'s fantasy novel by English author J. R. R. Tolkien. It was published in 1937 to wide critical acclaim, being nominated for the Carnegie Medal and awarded a prize from the New York Herald Tribune for best juvenile fiction. The book remains popular and is recognized as a classic in children\'s literature.\r\nBilbo Baggins, the protagonist, is a respectable, reserved hobbit—a race resembling short humans with furry, leathery feet who live in underground houses and are mainly pastoral farmers and gardeners. During his adventure, Bilbo often refers to the contents of his larder at home and wishes he had more food. Until he finds a magic ring, he is more baggage than help. Gandalf, an itinerant wizard, introduces Bilbo to a company of thirteen dwarves. During the journey the wizard.\r\nGandalf tricks Bilbo Baggins into hosting a party for Thorin Oakenshield and his band of twelve dwarves (Dwalin, Balin, Kili, Fili, Dori, Nori, Ori, Oin, Gloin, Bifur, Bofur, and Bombur), who sing of reclaiming their ancient home, Lonely Mountain, and its vast treasure from the dragon Smaug. When the music ends, Gandalf unveils Thrór\'s map showing a secret door into the Mountain', '51515151', 'Douglas A Anderson', 20, 20, '');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'study'),
(2, 'Novel'),
(3, 'Historical'),
(4, 'Classics');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(20) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `book_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `borrow_date` datetime NOT NULL DEFAULT current_timestamp(),
  `return_date` varchar(250) NOT NULL,
  `is_returned` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `book_name`, `book_id`, `user_id`, `borrow_date`, `return_date`, `is_returned`) VALUES
(1, 'Intro to Java', 1, 2, '2022-07-02 10:12:28', '2022-07-02 10:16:20', 'true'),
(2, 'Intro to Java', 1, 2, '2022-07-02 10:12:28', '2022-07-02 10:16:20', 'true'),
(3, 'Intro to Java', 1, 3, '2022-07-02 10:12:28', '2022-07-02 10:16:20', 'true'),
(4, 'Catch-22', 1, 2, '2022-07-02 10:12:28', '2022-07-02 10:16:20', 'true'),
(5, 'I, Claudius', 3, 2, '2022-07-02 10:12:28', '2022-07-02 10:16:20', 'true'),
(6, 'Catch-22', 2, 2, '2022-07-02 10:12:28', '2022-07-02 10:16:20', 'true'),
(7, 'I, Claudius', 3, 2, '2022-07-02 10:12:28', '2022-07-02 10:16:20', 'true'),
(8, 'I, Claudius', 3, 2, '2022-07-02 10:12:28', '2022-07-02 10:16:20', 'true'),
(9, 'I, Claudius', 3, 1, '2022-07-02 10:12:28', '2022-07-02 10:16:20', 'true'),
(10, 'I, Claudius', 3, 1, '2022-07-02 10:12:28', '2022-07-02 10:16:20', 'true'),
(11, 'Intro to Java', 1, 1, '2022-07-02 10:12:28', '07/02/2022 04:58:04 am', 'true'),
(12, 'Intro to Java', 1, 1, '2022-07-02 05:02:54', '07/02/2022 05:06:17 am', 'true'),
(13, 'Catch-22', 2, 1, '2022-07-02 05:04:48', '07/02/2022 05:06:23 am', 'true'),
(14, 'To Kill a Mockingbird', 4, 1, '2022-07-02 05:05:08', '07/02/2022 05:06:09 am', 'true'),
(15, 'I, Claudius', 3, 1, '2022-07-02 05:05:28', '07/02/2022 05:06:04 am', 'true'),
(16, 'Intro to Java', 1, 1, '2022-07-02 06:55:36', '07/02/2022 06:57:03 am', 'true'),
(17, 'I, Claudius', 3, 1, '2022-07-12 10:24:31', '07/12/2022 10:24:41 am', 'true'),
(18, 'I, Claudius', 3, 1, '2022-07-12 10:25:04', '07/12/2022 10:25:26 am', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_img` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `profile_img`, `role`, `email`) VALUES
(1, 'test', '$2y$10$SxyWMRMLDRNLMTAqUR7MK.hIBHcJSVN1Wn.hy8ms0wBNsQTHZajvC', 'Screenshot (14).png', 'user', 'test@lms.com'),
(2, 'root', '$2y$10$vT29IIRRhDuAFuNm5utnt.2qpeHs0U0TSd7b3nGUiWH4Wleuhm/Em', 'thumb-3@2x.jpg', 'admin', 'root@lms.com'),
(3, 'lib', '$2y$10$SxyWMRMLDRNLMTAqUR7MK.hIBHcJSVN1Wn.hy8ms0wBNsQTHZajvC', 'large-thumb-1.jpg', 'librarian', 'test@lms.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
