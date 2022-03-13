-- phpMyAdmin SQL Dump
-- version OVH
-- https://www.phpmyadmin.net/
--
-- Host: oaicontezoagile.mysql.db
-- Generation Time: Sep 28, 2021 at 01:05 PM
-- Server version: 5.6.50-log
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oaicontezoagile`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `addQuestionnaireParticipant` (IN `nameIn` VARCHAR(50), IN `QuestionnaireIn` INT, IN `hostIn` INT)  NO SQL
BEGIN
       -- The inserting into a table SQL stuff
       INSERT INTO QuestionnaireParticipants(Username, QuestionnaireIdentifier,Host)
       VALUES
              (nameIn,QuestionnaireIn,hostIn);
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `addTag` (IN `tagName` VARCHAR(50), IN `superBool` INT)  NO SQL
BEGIN
       INSERT INTO Tags (Name, SuperOrNot)
       VALUES (tagName, superBool);
   END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `addTimestamp` (IN `videoIDIn` INT, IN `textIn` VARCHAR(50))  NO SQL
BEGIN
	INSERT INTO Timestamps(VideoID, TextComment)
	VALUES(videoIDIn,textIn);
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `ChangePassword` (IN `UsernameIn` VARCHAR(50), IN `UserPasswordIn` VARCHAR(50))  MODIFIES SQL DATA
BEGIN
       UPDATE UserTable
       SET UserPassword= UserPasswordIn
       WHERE Username = UsernameIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `ChangeRole` (IN `UsernameIn` VARCHAR(50), IN `RoleIn` VARCHAR(50))  MODIFIES SQL DATA
BEGIN
       UPDATE UserTable
       SET Role= RoleIn
       WHERE Username = UsernameIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `checkIfCreator` (IN `userIn` VARCHAR(50))  NO SQL
BEGIN 
	SELECT SUM(Creator) as creatorValue FROM CRsPRs
    WHERE CRusername = userIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `checkIfFootage` (IN `userIn` VARCHAR(50))  NO SQL
BEGIN 
	SELECT SUM(Footage) as footageValue FROM CRsPRs
    WHERE CRusername = userIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `CheckIfUserExists` (IN `UsernameIn` VARCHAR(50), IN `PasswordIn` VARCHAR(50))  MODIFIES SQL DATA
BEGIN
	SELECT Role FROM UserTable WHERE Username = UsernameIn AND UserPassword = PasswordIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `checkIfVEDF` (IN `userIn` INT)  NO SQL
BEGIN 
	SELECT SUM(Viewer) as viewerValue, SUM(Editor) as editorValue, SUM(Deleter) as deleterValue, SUM(Footage) as footageValue FROM CRsPermissions
    WHERE CRName = userIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `CheckIsUsernameExists` (IN `UsernameIn` VARCHAR(50))  MODIFIES SQL DATA
BEGIN
	SELECT Role FROM UserTable WHERE Username = UsernameIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `countAnswers` (IN `QuestionNumIn` INT)  NO SQL
BEGIN
	SELECT Answer, COUNT(*) as numResponses 
    FROM Responses 
    WHERE QuestionNum = QuestionNumIn 
    GROUP BY Answer;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `countQuestionResponses` (IN `QuestionNumIn` INT)  NO SQL
BEGIN	
	SELECT COUNT(*) AS numResponse FROM Responses WHERE Responses.QuestionNum = QuestionNumIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `CreateMultipleChoiceAnswer` (IN `QuestionNumIn` INT, IN `AnswerIn` VARCHAR(50))  NO SQL
BEGIN
       -- The inserting into a table SQL stuff
       INSERT INTO MultipleChoiceAnswers
              (QuestionNum, Answer)
       VALUES
              (QuestionNumIn, AnswerIn);
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `CreateNewQuestionnaire` (IN `NameIn` VARCHAR(50))  MODIFIES SQL DATA
BEGIN
       -- The inserting into a table SQL stuff
       INSERT INTO Questionnaire
              (Name)
       VALUES
              (NameIn);
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `CreateNewUser` (IN `UsernameIn` VARCHAR(50), IN `UserPasswordIn` VARCHAR(50), IN `RoleIn` VARCHAR(50))  MODIFIES SQL DATA
BEGIN
       INSERT INTO UserTable
       VALUES
              (UsernameIn, UserPasswordIn, RoleIn);
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `CreateQuestion` (IN `QuestionnaireNumIn` INT, IN `QuestionIn` VARCHAR(50), IN `TypeIn` VARCHAR(50))  MODIFIES SQL DATA
BEGIN
       -- The inserting into a table SQL stuff
       INSERT INTO Questions
              (QuestionnaireNum, Question, Type)
       VALUES
              (QuestionnaireNumIn, QuestionIn, TypeIn);
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `CreateResponse` (IN `UserNameIn` VARCHAR(50), IN `QuestionNumIn` INT, IN `Answer` VARCHAR(50))  NO SQL
BEGIN
	INSERT INTO Responses
    VALUES(UserNameIn, QuestionNumIn, Answer);
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `deleteCRPerms` (IN `NameIn` VARCHAR(50), IN `QuestionnaireIn` INT)  NO SQL
BEGIN
       DELETE FROM CRsPermissions
       WHERE CRName = NameIn and QuestionnaireNum = QuestionnaireIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `deleteCRPermsUsingID` (IN `IDIn` INT)  NO SQL
BEGIN
       DELETE FROM CRsPermissions
       WHERE CRPRID = IDIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `DeleteMultipleChoiceAnswer` (IN `AnswerNumIn` INT)  MODIFIES SQL DATA
BEGIN
       DELETE FROM MultipleChoiceAnswers
       WHERE Identifier = AnswerNumIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `DeleteQuestion` (IN `QuestionNumIn` INT)  MODIFIES SQL DATA
BEGIN
       DELETE FROM Questions
       WHERE Identifier = QuestionNumIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `DeleteQuestionnaire` (IN `QuestionnaireNumIn` INT)  MODIFIES SQL DATA
BEGIN
       DELETE FROM Questionnaire
       WHERE Identifier = QuestionnaireNumIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `DeleteUser` (IN `UsernameIn` VARCHAR(50))  MODIFIES SQL DATA
BEGIN
       DELETE FROM UserTable
       WHERE Username = UsernameIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `EditQuestion` (IN `QuestionNumIn` INT, IN `QuestionIn` VARCHAR(50))  MODIFIES SQL DATA
BEGIN
       UPDATE  Questions
       SET  Question= QuestionIn
       WHERE identifier = QuestionNumIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `EditQuestionAnswer` (IN `AnswerNumIn` INT, IN `AnswerIn` VARCHAR(50))  MODIFIES SQL DATA
BEGIN
       UPDATE  MultipleChoiceAnswers
       SET  Answer= AnswerIn
       WHERE identifier = AnswerNumIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `EditQuestionnaireTitle` (IN `NameIn` VARCHAR(50), IN `IdentifierIn` INT)  MODIFIES SQL DATA
BEGIN
       UPDATE  Questionnaire
       SET  name= NameIn
       WHERE identifier = IdentifierIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `FindQuestionAnswers` (IN `QuestionNumIn` INT)  MODIFIES SQL DATA
BEGIN
       SELECT Identifier, Answer FROM MultipleChoiceAnswers
       WHERE MultipleChoiceAnswers.QuestionNum = QuestionNumIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `FindQuestionAnswersID` (IN `QuestionNumIn` INT, IN `AnswerIn` VARCHAR(50))  MODIFIES SQL DATA
BEGIN
       SELECT Identifier FROM MultipleChoiceAnswers
       WHERE QuestionNum = QuestionNumIn AND Answer = AnswerIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `FindRole` (IN `UsernameIn` VARCHAR(50))  NO SQL
BEGIN
	SELECT Role from UserTable
    Where Username = UsernameIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `getAnsweredQuestionnaires` (IN `UsernameIn` VARCHAR(50))  NO SQL
BEGIN
	SELECT QuestionnaireParticipants.QuestionnaireIdentifier 
    FROM QuestionnaireParticipants
    WHERE Username = UsernameIn and Completed = 1;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `getCRPRID` (IN `CRNameIn` VARCHAR(50), IN `PRNameIn` VARCHAR(50))  NO SQL
BEGIN
	SELECT Identifier FROM CRsPRs 
    WHERE CRusername = CRNameIn and PRUsername = PRNameIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `getCRs` ()  NO SQL
BEGIN
	SELECT Username FROM UserTable WHERE Role = "CR";
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `getDeletableQuestionnaires` (IN `CRNameIn` VARCHAR(50))  NO SQL
BEGIN
	SELECT Questionnaire.Identifier, Questionnaire.Name FROM Questionnaire
    INNER JOIN CRsPermissions ON Questionnaire.Identifier=CRsPermissions.QuestionnaireNum
    WHERE CRsPermissions.CRName = CRNameIn and CRsPermissions.Deleter = 1;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `getFootagePRs` (IN `userIn` VARCHAR(50))  NO SQL
BEGIN 
	SELECT PRUsername
    FROM CRsPRs
    WHERE Footage = 1 and CRusername = userIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `getMCQuestions` (IN `QuestionnaireNumIn` INT)  NO SQL
BEGIN
	SELECT Identifier, Question 
    FROM Questions 
    WHERE (Type = "Multiple Choice" or Type = "Likert" or Type = "MC") and QuestionnaireNum = QuestionnaireNumIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `getMyVideos` (IN `NameIn` VARCHAR(50))  NO SQL
BEGIN
	SELECT videos.id, videos.name, videos.location FROM videos
    WHERE videos.Owner = NameIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `getOwnQuestionnaires` (IN `UsernameIn` VARCHAR(50))  NO SQL
BEGIN
	SELECT Questionnaire.Identifier, Questionnaire.Name FROM Questionnaire
    INNER JOIN QuestionnaireParticipants ON Questionnaire.Identifier=QuestionnaireParticipants.QuestionnaireIdentifier
    WHERE QuestionnaireParticipants.Username = UsernameIn and QuestionnaireParticipants.Host = 1;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `GetPRsCRs` (IN `UsernameIn` VARCHAR(50))  NO SQL
BEGIN
	SELECT CRUsername FROM CRsPRs where PRUsername = UsernameIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `getQuestionID` (IN `QuestionIn` VARCHAR(50), IN `QuestionnaireIn` INT)  NO SQL
BEGIN
	SELECT Identifier from Questions
    WHERE Question = QuestionIn and QuestionnaireNum = QuestionnaireIn
    ORDER BY Identifier DESC;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `getQuestionnaireIDFromName` (IN `NameIn` VARCHAR(50))  NO SQL
BEGIN
	SELECT Identifier from Questionnaire
    WHERE Name = NameIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `getQuestionnaireIDFromQuestion` (IN `QuestionNumIn` INT)  NO SQL
BEGIN
	SELECT Questions.QuestionnaireNum
    FROM Questions 
    WHERE Questions.Identifier = QuestionNumIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `getQuestionnairesQuestions` (IN `QuestionIDIn` INT)  NO SQL
BEGIN
	SELECT Questions.Identifier, Questions.Question, Questions.Type FROM Questions
    WHERE Questions.QuestionnaireNum = QuestionIDIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `getQuestionnaireTitle` (IN `IDIn` INT)  NO SQL
BEGIN
	SELECT Name from Questionnaire
    WHERE Identifier = IDIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `getTagID` (IN `tagName` VARCHAR(50), IN `superIn` INT)  NO SQL
BEGIN
	SELECT Identifier from Tags
    WHERE Name = tagName and SuperOrNot = superIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `getTimestampID` (IN `videoIDIn` INT)  NO SQL
BEGIN
	SELECT Identifier FROM Timestamps 
    WHERE VideoID = videoIDIn
    ORDER BY Identifier DESC;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `getUsers` ()  NO SQL
BEGIN	
	SELECT Username FROM UserTable;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `getVideoFromID` (IN `IDIn` INT)  NO SQL
BEGIN
	SELECT name, location FROM videos
    WHERE id = IDIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `getViewableQuestionnaires` (IN `CRNameIn` VARCHAR(50))  NO SQL
BEGIN
	SELECT Questionnaire.Identifier, Questionnaire.Name FROM Questionnaire
    INNER JOIN CRsPermissions ON Questionnaire.Identifier=CRsPermissions.QuestionnaireNum
    WHERE CRsPermissions.CRName = CRNameIn and CRsPermissions.Viewer = 1;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `getWantedCSVTable` (IN `QuestionnaireNumIn` INT)  NO SQL
BEGIN
	SELECT Responses.Username, Questions.Question,  Responses.Answer FROM Responses 
    INNER JOIN Questions ON Responses.QuestionNum=Questions.Identifier 
    WHERE Questions.QuestionnaireNum = QuestionnaireNumIn 
    ORDER BY Questions.Identifier;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `GivePRaCR` (IN `PRin` VARCHAR(50), IN `CRin` VARCHAR(50))  NO SQL
BEGIN
	INSERT INTO CRsPRs (PRUsername, CRUsername)
    VALUES (PRin, CRin);
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `linkTSandTag` (IN `TSIDIn` INT, IN `TagIDIn` INT)  NO SQL
BEGIN
	INSERT INTO TimestampsToTags(TimestampID,TagID)
    VALUES(TSIDIn, TagIDIn);
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `makeCreator` (IN `CRNameIn` VARCHAR(50), IN `PRNameIn` VARCHAR(50), IN `CreatorIn` INT, IN `FootageIn` INT)  NO SQL
BEGIN
       UPDATE  CRsPRs
       SET  Creator = CreatorIn, Footage = FootageIn
       WHERE CRusername = CRNameIn and PRUsername =PRNameIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `markCompletedQuestionnaire` (IN `nameIn` VARCHAR(50), IN `QuestionnaireIn` INT)  NO SQL
BEGIN
       INSERT INTO QuestionnaireParticipants(Username, QuestionnaireIdentifier, Completed)
       VALUES
              (nameIn, QuestionnaireIn, "1");
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `newCRPerms` (IN `NameIn` VARCHAR(50), IN `QuestionnaireIn` INT, IN `ViewerIn` INT, IN `EditorIn` INT, IN `DeleterIn` INT, IN `CRPRIDIn` INT)  NO SQL
BEGIN
       INSERT INTO CRsPermissions
       VALUES
              (CRPRIDIn, NameIn, QuestionnaireIn, ViewerIn,EditorIn,DeleterIn);
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `removeCRfromPR` (IN `IDIn` INT)  NO SQL
BEGIN
       DELETE FROM CRsPRs
       WHERE Identifier = IDIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `removeUserFromParticipants` (IN `QuestionNumIn` INT, IN `userIn` VARCHAR(50), IN `hostIn` INT)  NO SQL
BEGIN
	DELETE FROM QuestionnaireParticipants
	WHERE Username = userIn AND QuestionnaireIdentifier = QuestionNumIn AND Host = hostIn;
END$$

CREATE DEFINER=`oaicontezoagile`@`%` PROCEDURE `SetCPPermission` (IN `CRPRNumIn` INT, IN `QuestionNumIn` INT, IN `GrantedIn` INT)  NO SQL
BEGIN
	
	INSERT INTO CRsPRsPermissions(CRPRNum, PRQuestionnaireNum, GivenPermission)
    VALUES(CRPRNumIn,QuestionNumIn,GrantedIn);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `CRsPermissions`
--

CREATE TABLE `CRsPermissions` (
  `CRPRID` int(11) NOT NULL,
  `CRName` varchar(50) NOT NULL,
  `QuestionnaireNum` int(11) NOT NULL,
  `Viewer` int(11) NOT NULL DEFAULT '0',
  `Editor` int(11) NOT NULL DEFAULT '0',
  `Deleter` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CRsPermissions`
--

INSERT INTO `CRsPermissions` (`CRPRID`, `CRName`, `QuestionnaireNum`, `Viewer`, `Editor`, `Deleter`) VALUES
(12, 'Co-Researcher', 3, 1, 1, 1),
(16, 'CR', 3, 0, 0, 0),
(12, 'Co-Researcher', 14, 0, 0, 0),
(16, 'CR', 1, 1, 1, 1),
(12, 'Co-Researcher', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `CRsPRs`
--

CREATE TABLE `CRsPRs` (
  `Identifier` int(11) NOT NULL,
  `CRusername` varchar(50) NOT NULL,
  `PRUsername` varchar(50) NOT NULL,
  `Creator` int(11) NOT NULL DEFAULT '0',
  `Footage` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CRsPRs`
--

INSERT INTO `CRsPRs` (`Identifier`, `CRusername`, `PRUsername`, `Creator`, `Footage`) VALUES
(5, 'CR', 'Tester', 0, 0),
(6, 'Co-Researcher', 'Tester', 0, 0),
(8, 'CR', 'jonas', 0, 0),
(11, 'jo-researcher', 'jonas', 0, 0),
(12, 'Co-Researcher', 'Igloo', 1, 1),
(16, 'CR', 'Igloo', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `MultipleChoiceAnswers`
--

CREATE TABLE `MultipleChoiceAnswers` (
  `Identifier` int(11) NOT NULL,
  `QuestionNum` int(11) NOT NULL,
  `Answer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `MultipleChoiceAnswers`
--

INSERT INTO `MultipleChoiceAnswers` (`Identifier`, `QuestionNum`, `Answer`) VALUES
(2, 1, 'No'),
(3, 1, 'Yes'),
(10, 19, 'Yes'),
(11, 19, 'No'),
(12, 21, 'Black'),
(13, 21, 'Brown'),
(14, 21, 'White'),
(15, 22, 'Yes'),
(16, 22, 'No'),
(17, 27, 'freedom'),
(18, 27, 'power'),
(19, 27, 'food'),
(20, 27, 'good food'),
(21, 27, 'no food'),
(22, 27, 'eating anything you want and not getting fat'),
(23, 27, 'never have to go to the toilet again without any n'),
(24, 27, 'life as it is'),
(25, 27, 'teleportation that works perfectly'),
(26, 33, 'no'),
(27, 33, 'yesn\'t'),
(28, 33, 'god no'),
(29, 33, 'non\'tn\'t'),
(30, 36, 'dwasd'),
(31, 36, 'gtes'),
(32, 36, 'htf'),
(33, 39, 'Sometimes'),
(34, 39, 'Yes'),
(35, 39, 'No'),
(36, 42, 'Yes'),
(37, 42, 'No'),
(38, 42, 'Sometimes'),
(39, 46, 'asd'),
(40, 46, 'asd'),
(41, 46, 'asd'),
(42, 46, 'asd'),
(43, 47, 'blue'),
(44, 47, 'black'),
(45, 47, 'pink'),
(46, 47, 'yellow');

-- --------------------------------------------------------

--
-- Table structure for table `Questionnaire`
--

CREATE TABLE `Questionnaire` (
  `Identifier` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Questionnaire`
--

INSERT INTO `Questionnaire` (`Identifier`, `Name`) VALUES
(1, 'Why are cats great?'),
(3, 'What is the best word?'),
(14, 'Dogs! Are they great?'),
(15, 'what is best'),
(16, 'Test'),
(17, 'what'),
(21, 'Testing'),
(22, 'boi'),
(23, 'my balls');

-- --------------------------------------------------------

--
-- Table structure for table `QuestionnaireParticipants`
--

CREATE TABLE `QuestionnaireParticipants` (
  `Username` varchar(50) NOT NULL,
  `QuestionnaireIdentifier` int(11) NOT NULL,
  `Host` int(11) NOT NULL DEFAULT '0',
  `Completed` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `QuestionnaireParticipants`
--

INSERT INTO `QuestionnaireParticipants` (`Username`, `QuestionnaireIdentifier`, `Host`, `Completed`) VALUES
('Igloo', 1, 1, 0),
('Student', 3, 0, 0),
('Student', 1, 0, 0),
('Igloo', 3, 1, 0),
('Igloo', 4, 1, 0),
('Igloo', 13, 1, 0),
('Igloo', 14, 1, 0),
('CR', 1, 0, 1),
('Jonas', 15, 1, 0),
('CR', 3, 0, 0),
('CR', 3, 0, 1),
('Igloo', 3, 0, 1),
('Igloo', 1, 0, 1),
('Igloo', 1, 0, 1),
('Igloo', 16, 1, 0),
('jonas', 17, 1, 0),
('Igloo', 18, 1, 0),
('Igloo', 19, 1, 0),
('Igloo', 20, 1, 0),
('igloo', 21, 1, 0),
('jesse', 22, 1, 0),
('Igloo', 23, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Questions`
--

CREATE TABLE `Questions` (
  `Identifier` int(11) NOT NULL,
  `QuestionnaireNum` int(11) NOT NULL,
  `Question` varchar(50) NOT NULL,
  `Type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Questions`
--

INSERT INTO `Questions` (`Identifier`, `QuestionnaireNum`, `Question`, `Type`) VALUES
(1, 1, 'Are they fluffy?', 'Multiple Choice'),
(2, 1, 'Why are you in love with cats?', 'Text'),
(3, 3, 'What is it?', 'Text'),
(4, 1, 'Cats are good for the environment', 'Likert'),
(5, 0, 'test 1', 'Text'),
(6, 0, 'test 1', 'Text'),
(7, 0, 'test 2', 'Text'),
(17, 13, 'What is a good question to ask?', 'Text'),
(18, 13, 'Craig is amazing', 'Likert'),
(19, 13, 'Does this work?', 'MC'),
(20, 14, 'what are your thoughts on dogs?', 'Text'),
(21, 14, 'What is the best dog colour?', 'MC'),
(22, 14, 'Do they have tails?', 'MC'),
(23, 14, 'Dogs are best animal', 'Likert'),
(24, 15, 'how do you feel', 'Text'),
(25, 15, 'what do you like', 'Text'),
(26, 15, 'who are you', 'Text'),
(27, 15, 'what is best', 'MC'),
(28, 15, 'what is best', 'MC'),
(29, 15, 'what is best', 'MC'),
(30, 16, 'Test', 'Text'),
(31, 17, 'who', 'Text'),
(32, 17, 'when', 'Text'),
(33, 17, 'what', 'MC'),
(34, 17, 'did you like it', 'Likert'),
(35, 18, 'Random text', 'Text'),
(36, 18, 'MCQuestionTester', 'MC'),
(37, 18, 'Likert Question Potato', 'Likert'),
(38, 19, 'Your thoughts?', 'Text'),
(39, 19, 'Are they tasty?', 'MC'),
(40, 19, 'Potatoes are yellow', 'Likert'),
(41, 20, 'Give reasons', 'Text'),
(42, 20, 'Potatoes are tasty', 'MC'),
(43, 20, 'Are potatoes yellow', 'Likert'),
(44, 21, 'Hello', 'Text'),
(45, 21, 'Is this bad', 'Likert'),
(46, 21, 'Nan', 'MC'),
(47, 23, 'What colour are my balls?', 'MC');

-- --------------------------------------------------------

--
-- Table structure for table `Responses`
--

CREATE TABLE `Responses` (
  `Username` varchar(50) NOT NULL,
  `QuestionNum` int(11) NOT NULL,
  `Answer` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Responses`
--

INSERT INTO `Responses` (`Username`, `QuestionNum`, `Answer`) VALUES
('Igloo', 1, 'Yes'),
('Igloo', 2, 'Because they floof'),
('Igloo', 3, 'Flop'),
('Tony', 1, 'Yes'),
('Tony', 2, 'Because they like pets'),
('Tony', 3, 'Girder'),
('Student', 1, 'Yes'),
('Student', 2, 'They eat fish'),
('Student', 4, 'Disagree'),
('Student', 1, 'Yes'),
('Student', 2, 'The floof'),
('Student', 4, 'Disagree'),
('Student', 1, 'No'),
('Student', 2, 'They jump high'),
('Student', 4, 'Neutral'),
('Student', 1, 'Yes'),
('Student', 2, 'The floof'),
('Student', 4, 'Strongly Disagree'),
('Igloo', 3, 'fgtafgsafw'),
('Igloo', 3, 'Potatoism'),
('Igloo', 1, 'Yes'),
('Igloo', 2, 'They eat fish'),
('Igloo', 4, 'Strongly Agree'),
('Igloo', 5, 'test'),
('Igloo', 6, 'test2'),
('Igloo', 7, 'test3'),
('Igloo', 3, 'Potatoism'),
('Igloo', 1, 'No'),
('Igloo', 2, 'Yest'),
('Igloo', 4, 'Strongly Disagree'),
('Igloo', 1, 'No'),
('Igloo', 2, 'Yest'),
('Igloo', 4, 'Strongly Disagree'),
('Igloo', 5, 'Test'),
('Igloo', 6, 'test'),
('Igloo', 7, 'test'),
('jonas', 31, 'hr'),
('jonas', 32, 'jd'),
('jonas', 33, 'yesn\'t'),
('jonas', 34, 'Strongly Disagree'),
('jonas', 31, 'ASD'),
('jonas', 32, 'FQ'),
('jonas', 33, 'god'),
('jonas', 34, 'Strongly Disagree'),
('jonas', 31, 'DFA'),
('jonas', 32, 'FA'),
('jonas', 33, 'non\'tn\'t'),
('jonas', 34, 'Disagree'),
('jonas', 31, 'HE3'),
('jonas', 32, '234'),
('jonas', 33, 'non\'tn\'t'),
('jonas', 34, 'Disagree'),
('Igloo', 20, 'floof'),
('Igloo', 21, 'Brown'),
('Igloo', 22, 'Yes'),
('Igloo', 23, 'Agree'),
('jonas', 20, 'JON'),
('jonas', 21, 'Brown'),
('jonas', 22, 'Yes'),
('jonas', 23, 'Disagree'),
('jonas', 31, 'SDEGF'),
('jonas', 32, 'SDG'),
('jonas', 33, 'yesn\'t'),
('jonas', 34, 'Neutral'),
('Igloo', 35, 'Potato'),
('Igloo', 36, 'dwasd'),
('Igloo', 37, 'Neutral'),
('Igloo', 38, 'gasdfaw'),
('Igloo', 39, 'Yes'),
('Igloo', 40, 'Disagree'),
('Igloo', 41, 'they tasty'),
('Igloo', 42, 'Yes'),
('Igloo', 43, 'Strongly Disagree'),
('igloo', 44, ''),
('igloo', 45, 'Strongly Agree'),
('igloo', 46, 'asd'),
('igloo', 24, ''),
('igloo', 25, ''),
('igloo', 26, 'soy tu pesadilla'),
('igloo', 27, 'freedom');

-- --------------------------------------------------------

--
-- Table structure for table `Tags`
--

CREATE TABLE `Tags` (
  `Identifier` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `SuperOrNot` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Tags`
--

INSERT INTO `Tags` (`Identifier`, `Name`, `SuperOrNot`) VALUES
(1, 'Cool', 0),
(2, 'Interesting', 0),
(3, 'Year-1', 1),
(4, 'Year-2', 1),
(5, 'Year-3', 1),
(6, 'Savage', 0),
(8, 'Year-4', 1),
(11, 'Potato', 0),
(12, 'Fred', 0),
(14, 'Jump', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Timestamps`
--

CREATE TABLE `Timestamps` (
  `Identifier` int(11) NOT NULL,
  `VideoID` int(11) NOT NULL,
  `TextComment` varchar(50) DEFAULT NULL,
  `Time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Timestamps`
--

INSERT INTO `Timestamps` (`Identifier`, `VideoID`, `TextComment`, `Time`) VALUES
(1, 0, '', 0),
(2, 0, 'Super Interesting', 0),
(3, 0, 'Kinda Interesting', 0),
(4, 0, 'Yes', 0),
(5, 0, 'Broke his leg', 0),
(6, 0, 'Jumped twice', 0),
(7, 0, 'High 5ed', 0),
(9, 0, 'Super Interesting', 0),
(10, 0, 'Super Interesting', 0),
(11, 0, 'Super Interesting', 0),
(12, 1, 'dwads', 0),
(13, 0, 'Awesome moment', 0);

-- --------------------------------------------------------

--
-- Table structure for table `TimestampsToTags`
--

CREATE TABLE `TimestampsToTags` (
  `Identifier` int(11) NOT NULL,
  `TimestampID` int(11) NOT NULL,
  `TagID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TimestampsToTags`
--

INSERT INTO `TimestampsToTags` (`Identifier`, `TimestampID`, `TagID`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 12),
(6, 6, 14),
(7, 7, 6),
(8, 8, 1),
(9, 9, 11),
(10, 10, 11),
(11, 11, 1),
(12, 13, 11);

-- --------------------------------------------------------

--
-- Table structure for table `UserTable`
--

CREATE TABLE `UserTable` (
  `Username` varchar(50) NOT NULL,
  `UserPassword` varchar(50) NOT NULL DEFAULT 'defaultPass',
  `Role` varchar(50) NOT NULL DEFAULT 'Student'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UserTable`
--

INSERT INTO `UserTable` (`Username`, `UserPassword`, `Role`) VALUES
('Co-Researcher', 'gayboi', 'Student'),
('CR', 'Default', 'CR'),
('Igloo', 'Penguin', 'Lab Manager'),
('jeff', 'password', 'Student'),
('Jesse', '123', 'Lab Manager'),
('jo-researcher', 'password', 'CR'),
('Potato', 'Head', 'Lab Manager'),
('PR', 'Default', 'PR'),
('PrincipleResearcher', 'Default', 'PR'),
('Student', 'password', 'Student'),
('StudentTest', 'Default', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `Owner` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `Owner`, `name`, `location`) VALUES
(2, 'Igloo', 'dogBoop.mp4', 'videos/dogBoop.mp4'),
(3, 'Igloo', 'introCutscene.mp4', 'videos/introCutscene.mp4'),
(4, 'Igloo', 'introCutscene.mp4', 'videos/introCutscene.mp4'),
(6, 'Igloo', 'introCutscene.mp4', 'videos/introCutscene.mp4'),
(7, 'Igloo', 'dogBoop.mp4', 'videos/dogBoop.mp4'),
(8, 'Igloo', 'dogBoop.mp4', 'videos/dogBoop.mp4'),
(9, 'Igloo', 'introCutscene.mp4', 'videos/introCutscene.mp4'),
(10, 'Igloo', 'introCutscene.mp4', 'videos/introCutscene.mp4'),
(11, 'Igloo', 'introCutscene.mp4', 'videos/introCutscene.mp4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CRsPRs`
--
ALTER TABLE `CRsPRs`
  ADD PRIMARY KEY (`Identifier`);

--
-- Indexes for table `MultipleChoiceAnswers`
--
ALTER TABLE `MultipleChoiceAnswers`
  ADD PRIMARY KEY (`Identifier`);

--
-- Indexes for table `Questionnaire`
--
ALTER TABLE `Questionnaire`
  ADD PRIMARY KEY (`Identifier`);

--
-- Indexes for table `Questions`
--
ALTER TABLE `Questions`
  ADD PRIMARY KEY (`Identifier`);

--
-- Indexes for table `Tags`
--
ALTER TABLE `Tags`
  ADD PRIMARY KEY (`Identifier`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `Timestamps`
--
ALTER TABLE `Timestamps`
  ADD PRIMARY KEY (`Identifier`);

--
-- Indexes for table `TimestampsToTags`
--
ALTER TABLE `TimestampsToTags`
  ADD PRIMARY KEY (`Identifier`);

--
-- Indexes for table `UserTable`
--
ALTER TABLE `UserTable`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CRsPRs`
--
ALTER TABLE `CRsPRs`
  MODIFY `Identifier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `MultipleChoiceAnswers`
--
ALTER TABLE `MultipleChoiceAnswers`
  MODIFY `Identifier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `Questionnaire`
--
ALTER TABLE `Questionnaire`
  MODIFY `Identifier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `Questions`
--
ALTER TABLE `Questions`
  MODIFY `Identifier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `Tags`
--
ALTER TABLE `Tags`
  MODIFY `Identifier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `Timestamps`
--
ALTER TABLE `Timestamps`
  MODIFY `Identifier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `TimestampsToTags`
--
ALTER TABLE `TimestampsToTags`
  MODIFY `Identifier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
