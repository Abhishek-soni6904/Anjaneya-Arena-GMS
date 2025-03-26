-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2025 at 05:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anjaneya_arena`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` enum('event','equipment_update','health_and_safety','notice','achievement') NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `membership_type` enum('Basic','Premium','Elite','Ultimate','Expired') DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `join_date` date NOT NULL DEFAULT curdate(),
  `expiration_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `membership_type`, `email`, `password`, `join_date`, `expiration_date`) VALUES
(5, 'Olivia Johnson', 'Expired', 'olivia.johnson809@gmail.com', '$2y$10$aX621IHHo6IsSjbEYMfcNO6n1.Pz83IOQ5NvTby8cI/lgY5etmyqi', '2024-04-14', '2024-09-14'),
(6, 'Alexander Rodriguez', 'Expired', 'alexander.rodriguez923@yahoo.com', '$2y$10$wcveGKBINSmFD4tjR54zVenAtWWwI8YbE3URmzsIU2LhJ6zUVguA6', '2024-05-21', '2024-10-21'),
(7, 'Alexander Davis', 'Expired', 'alexander.davis270@icloud.com', '$2y$10$i1WtFrYbb9rJFF4yIwem6e9Kbf4M1oV2GLEcwlXoFBIZ.larU.04u', '2024-11-24', '2024-12-24'),
(8, 'Isabella Martinez', 'Expired', 'isabella.martinez768@outlook.com', '$2y$10$fMAcJfJ0.ZawoWmCAlhbG.LHeezX6VUy0JJr8gQmHFE3ud1lvuMJ.', '2024-04-04', '2024-10-04'),
(9, 'Isabella Williams', 'Expired', 'isabella.williams457@hotmail.com', '$2y$10$03Hc95G3e.mKbHWXRYLHxut1OwIfbj8mYOKqtc15AUV0VuKsV9StW', '2024-03-28', '2024-04-28'),
(10, 'Alexander Jones', 'Basic', 'alexander.jones607@icloud.com', '$2y$10$EiLCT0RkmrXV.EBXfZjYPeH1R4.0/hdQ8bMjN/kUwIc5zS5fE3p/G', '2024-11-11', '2025-03-11'),
(11, 'John Brown', 'Expired', 'john.brown942@icloud.com', '$2y$10$GPSmLDV.37ifVcCOQUgpuuEngUKaphwb4kRA2o/O9zsrVqqlYaAre', '2024-08-28', '2024-09-28'),
(12, 'Ava Smith', 'Expired', 'ava.smith308@gmail.com', '$2y$10$ZSlgUByivCsNbet5zsbRgOIBHBGK/0hbwgP3/POXyXuCCqYN6SE1K', '2024-11-22', '2025-01-22'),
(13, 'James Garcia', 'Expired', 'james.garcia625@icloud.com', '$2y$10$ChCZ9y5M/fNsgG7CtYswpeDbx6k63SWbP6qFt5ii6LQs7fBcbA9OC', '2024-03-15', '2024-06-15'),
(14, 'Alexander Miller', 'Expired', 'alexander.miller755@gmail.com', '$2y$10$yQO6sZh6OihyStwwfEMp4.VxOYLu4YhfU7aKLvPE9qqmZAVLmkmcm', '2024-02-15', '2024-07-15'),
(15, 'William Miller', 'Basic', 'william.miller622@gmail.com', '$2y$10$DljsYorsO18JAOF4EdmHiuGJONK3JvDaPkXYxy6hqB2BaCtp84q4u', '2025-02-07', '2025-05-07'),
(16, 'Sophia Rodriguez', 'Elite', 'sophia.rodriguez262@yahoo.com', '$2y$10$jRzn1NxWSevVQKIVwJqWTuaJO0v21VklgQRic9fOvXgh1bQc16axa', '2025-02-07', '2025-10-07'),
(17, 'Olivia Miller', 'Elite', 'olivia.miller397@gmail.com', '$2y$10$xH6RM5dqKAJrC2YN2PUO2eQ8z8VUwHa4/luTCCUUuEmnJJXr2rMz6', '2025-02-07', '2025-08-07'),
(18, 'Olivia Johnson', 'Basic', 'olivia.johnson628@icloud.com', '$2y$10$fL5/Z5xaMLKrKtIR1FE9OOwKEMEMisZIxTP12nlsOz0FslUHCEkGG', '2025-02-07', '2025-12-07'),
(19, 'William Rodriguez', 'Basic', 'william.rodriguez980@yahoo.com', '$2y$10$PVIJUJ6s/v14Vz7jTeRYFOo2hKWkPl1dhCrXDyn..aXDeT9tYQA1O', '2025-02-07', '2026-01-07'),
(20, 'Alexander Jones', 'Premium', 'alexander.jones646@hotmail.com', '$2y$10$ZyD0PsHQ5dGE61rxs34MU.R9t9PFyiaQIVOFvL1jx/puD/oxVqktq', '2025-02-07', '2025-11-07'),
(21, 'Sophia Smith', 'Elite', 'sophia.smith968@gmail.com', '$2y$10$KrCPb0nVkBFU71ZYFOCB.O3Rql65A4x5hydp25hE5s/hqtZswx7lC', '2025-02-07', '2025-12-07'),
(22, 'William Davis', 'Basic', 'william.davis670@outlook.com', '$2y$10$PMYNShz9ioKuxcttRcT70OyqPfXSNlXDMEiHqAMeF/BNh42lkKHdC', '2025-02-07', '2025-06-07'),
(23, 'Alexander Smith', 'Basic', 'alexander.smith776@gmail.com', '$2y$10$MeUfIeFNPL1JbloVdq3wIu1oEfljkoKQ5vvaT4JY6aUP92fATTFh.', '2025-02-07', '2025-10-07'),
(24, 'James Martinez', 'Ultimate', 'james.martinez895@gmail.com', '$2y$10$gpenPXKCeDL2zwSTB4eWMetkdQOrKJQ6Cyt1HN4wq17RhzVbKOnV.', '2025-02-07', '2025-11-07'),
(25, 'John Miller', 'Ultimate', 'john.miller799@hotmail.com', '$2y$10$edPI7br0DCESG9VcKc9xXuyK5YtWi20tuWzdkAaP.XourQCKTTjma', '2025-02-07', '2025-08-07'),
(26, 'Emma Smith', 'Basic', 'emma.smith844@hotmail.com', '$2y$10$p.1CsONCw.KXfntV0c.x7OuNVdhcJiREOpNY4zRc0gMJ5te6cg6Vq', '2025-02-07', '2025-05-07'),
(27, 'Emma Miller', 'Elite', 'emma.miller633@yahoo.com', '$2y$10$2TzUVpmjQbVMkoXFzl.F2.hXnDHl3me9r3XRScuUCcXR0c1gGXXT.', '2025-02-07', '2025-10-07'),
(28, 'Ava Miller', 'Basic', 'ava.miller511@outlook.com', '$2y$10$/1spuIPQauJ3EEpxSymXjuPnw0uDj8ddnuHrmkqNJn9zvqAMsffji', '2025-02-07', '2025-03-07'),
(29, 'Ava Jones', 'Basic', 'ava.jones691@icloud.com', '$2y$10$sQRCDPNSzKwuRb0kt2Ir9.NN2eaKQhxqON8ZSyDYGuuOjjkYoU7/a', '2025-02-07', '2025-07-07'),
(30, 'William Brown', 'Elite', 'william.brown396@yahoo.com', '$2y$10$JI/uaLaGpp4GnQZlCFLQiujaYg/KgUgAJVCPRl4VpPdK/K0LoAgdK', '2025-02-07', '2025-06-07'),
(31, 'Alexander Jones', 'Basic', 'alexander.jones446@hotmail.com', '$2y$10$2sWphGnHW4T65HtGV.u23OGQrnZeFP9Bq45Bu1YCBEiaWiSYcwBbS', '2025-02-07', '2025-05-07'),
(32, 'John Brown', 'Elite', 'john.brown762@outlook.com', '$2y$10$Ff74G3nTXgNKNQJbkEh08uOdrlHv/DXCL12hC//9dflVpC.qdr6/i', '2025-02-07', '2025-09-07'),
(33, 'Sophia Davis', 'Basic', 'sophia.davis481@outlook.com', '$2y$10$x6a4dzPyzXcE7uDM9timL.QX5ng5PP/c6/ntapmRTacjOwbp87rvK', '2025-02-07', '2025-06-07'),
(34, 'Alexander Miller', 'Elite', 'alexander.miller523@hotmail.com', '$2y$10$UYP8.pcXYjIO7x9xGTXFSuq11YZGV.5NJbdU/o8vgTwWKtrAyQBBe', '2025-02-07', '2025-10-07'),
(35, 'John Miller', 'Basic', 'john.miller518@hotmail.com', '$2y$10$B9.BFzp43l7aK.oghOrDMecIv28DZpdQQ8LAMCb0sPJrxwItBvr5a', '2025-02-07', '2025-12-07'),
(36, 'Isabella Johnson', 'Basic', 'isabella.johnson266@icloud.com', '$2y$10$ZDkL9Zw/TrBHT0gs7Z109.ltbdLWiJlUHXhFl2gnmp2mF1W1vdOCe', '2025-02-07', '2025-10-07'),
(37, 'Alexander Garcia', 'Elite', 'alexander.garcia325@yahoo.com', '$2y$10$G4cEf.3HcKxt9O0KCbTzl.WBxfLmPJBvB9JzS51BTnboOk.z4dfBi', '2025-02-07', '2025-10-07'),
(38, 'Emma Jones', 'Basic', 'emma.jones578@yahoo.com', '$2y$10$Cp.TF2yWlxA.McrByWKeJOib/tuJsricZ3AUKczH2T6CLIzB9wLfa', '2025-02-07', '2025-12-07'),
(39, 'John Davis', 'Basic', 'john.davis570@hotmail.com', '$2y$10$h5QIZGye0JLqdnxaX.Tzn.nSYzHnAYJB/TRx2BmdipHLhWmhatygy', '2025-02-07', '2025-03-07'),
(40, 'William Williams', 'Basic', 'william.williams986@yahoo.com', '$2y$10$.BNC5qitH17Lj1O5wZdpxeNOSlgnqj.uFpInzIW7DIOmzHsf2ymp6', '2025-02-07', '2025-06-07'),
(41, 'John Brown', 'Basic', 'john.brown608@hotmail.com', '$2y$10$nPADUtqRvphed/WTmpiwCeSOrxCwH/bUpc4gmJqB.XqXX51u8iLca', '2025-02-07', '2025-11-07'),
(42, 'Emma Davis', 'Ultimate', 'emma.davis928@icloud.com', '$2y$10$VtAo.QcQ6TYyCiIGhmUKn.hudP.lDGRAgV8YXjaKy1rGgicsmlWQG', '2025-02-07', '2025-11-07'),
(43, 'Alexander Williams', 'Ultimate', 'alexander.williams509@icloud.com', '$2y$10$Gk2VCV8DjOn0R8V0cohlluklpwizdCtjZw4AHhTBHxnPVUdAJfR4.', '2025-02-07', '2025-08-07'),
(44, 'Emma Garcia', 'Ultimate', 'emma.garcia553@outlook.com', '$2y$10$vZdVUy5aTssvBPYdM..g8OtKLO04W2aiH9808kbqv5CZVndCmtGmO', '2025-02-07', '2025-08-07'),
(45, 'Sophia Smith', 'Basic', 'sophia.smith303@icloud.com', '$2y$10$x98t/E/ZNg187lFf7OJJXe4hNfr6r.ORwNJR5Eehb5IWfzfyiAI4y', '2025-02-07', '2026-02-07'),
(46, 'Emma Williams', 'Ultimate', 'emma.williams426@yahoo.com', '$2y$10$wyJA5Ig1wk9lKVtQ.FIQFuD.1XN6xr5.wtVhKxqOf55xR/7wmOWVq', '2025-02-07', '2025-12-07'),
(47, 'Ava Miller', 'Elite', 'ava.miller711@outlook.com', '$2y$10$nHxWq56j2vZUvGmmecuPjOu8LCm097rqndpDXH5sECV2t1ZNnQPJe', '2025-02-07', '2025-10-07'),
(48, 'Ava Davis', 'Ultimate', 'ava.davis194@yahoo.com', '$2y$10$M9c4AkRko/Hm4XjHu/B4deEN6Psw0va8jEVv93hQ80jayXdau9My2', '2025-02-07', '2025-04-07'),
(49, 'Sophia Jones', 'Premium', 'sophia.jones403@outlook.com', '$2y$10$fY81AIbVSf0B48cX.X./EOcTkTDVMMJrQB4Mg1lDKHXMmXfGfYbGK', '2025-02-07', '2026-01-07'),
(50, 'William Rodriguez', 'Premium', 'william.rodriguez790@hotmail.com', '$2y$10$hINuU8lVyO6fHoIWmFZ6bOnm45ErvqRda3EOe6L4ARq3zUPY8g.1S', '2025-02-07', '2026-01-07'),
(51, 'John Brown', 'Premium', 'john.brown793@outlook.com', '$2y$10$f29PRL8QcMcPk3f77VfzWuOfGImH8WofsAPwC1dZ9Herms/rOdT96', '2025-02-07', '2025-06-07'),
(52, 'Michael Martinez', 'Elite', 'michael.martinez825@outlook.com', '$2y$10$3uNJQ2VBGbUEj/UrW/EVs.mGbEjsj4ATV2CehCPBt.Am/plEZEKLq', '2025-02-07', '2025-05-07'),
(53, 'Ava Miller', 'Premium', 'ava.miller313@hotmail.com', '$2y$10$iKvzKA9SYMZ7QrRtCXOTLeSuofXrDkiVMyVtsFiaBjKNWuaNJ/pHe', '2025-02-07', '2025-06-07'),
(54, 'Sophia Martinez', 'Elite', 'sophia.martinez187@icloud.com', '$2y$10$gPS3X3yaSkEQE5HQT.7QbOA18bFwWo3HUFMVrgYVL2MbAtyS4.Teu', '2025-02-07', '2025-03-07'),
(55, 'Michael Johnson', 'Ultimate', 'michael.johnson993@gmail.com', '$2y$10$b1st5iWeQlkGbL8xRMYMLetJvAo7GX0fan9J.gHofcVWsVVhmPieC', '2025-02-07', '2026-01-07'),
(56, 'Michael Davis', 'Elite', 'michael.davis351@gmail.com', '$2y$10$9OwgHpFJSKbGNxzHNvqtO.x9aiSmQHr/3d6xhv/fJ4B1OGyTVZyFG', '2025-02-07', '2025-06-07'),
(57, 'Ava Williams', 'Premium', 'ava.williams389@hotmail.com', '$2y$10$BLwmOjCZvoYehnV1wiOMQ.LzOC/7/PMDp./C.IPwVNC6tNOxKDb/2', '2025-02-07', '2025-07-07'),
(58, 'Alexander Smith', 'Basic', 'alexander.smith362@hotmail.com', '$2y$10$12zoQ4WKb3DJDxbOy6X4uOFvtqwzRQAIkmBzhNIGTE84.qKocJM3e', '2025-02-07', '2025-08-07'),
(59, 'Sophia Williams', 'Elite', 'sophia.williams509@gmail.com', '$2y$10$I3UEO2BNiHwHoCXGKhQXwuQernbOUYGJS.Kki6h.LBuSd76UKPbPm', '2025-02-07', '2025-12-07'),
(60, 'Isabella Miller', 'Ultimate', 'isabella.miller933@yahoo.com', '$2y$10$.kXMITZwyo.zAUkS00dEVOD74XoTADY/ZneoDkmq0neIzyPDs3NZO', '2025-02-07', '2025-09-07'),
(61, 'William Jones', 'Ultimate', 'william.jones462@gmail.com', '$2y$10$Di6UFAQ7qR60M8shd7ntIe0kOBL6ld.gbzjwn8PTiwSx6oMU58RD.', '2025-02-07', '2025-05-07'),
(62, 'Sophia Martinez', 'Basic', 'sophia.martinez640@gmail.com', '$2y$10$LNNpZB2p4ZAxYahxyJZV.OOVohXFHF7GHJED.kr84BtzlcGQzZCMO', '2025-02-07', '2025-08-07'),
(63, 'John Garcia', 'Basic', 'john.garcia482@hotmail.com', '$2y$10$DYtDItEe/Q4R7wio.0u/.eOr1sf7FnfduCwCVCuNeOFg58Mn9erUC', '2025-02-07', '2025-03-07'),
(64, 'William Williams', 'Premium', 'william.williams789@icloud.com', '$2y$10$EptysvLTNLC09tEWqStWGOrjWSoSyUiB.1EYN.kYfzKyIiwQ5deaG', '2025-02-07', '2025-10-07'),
(65, 'Ava Garcia', 'Elite', 'ava.garcia216@hotmail.com', '$2y$10$BP3jTWkJ6B1Vuztfd.9xu.vPvVuPjTFFehblYyGtL8F5kCdUEQgZa', '2025-02-07', '2025-07-07'),
(66, 'Alexander Miller', 'Elite', 'alexander.miller534@yahoo.com', '$2y$10$QuppQgymUC6pEtbjP69.I.1siz7iK71FXOp9rETKFg.RVoe4Sc2he', '2025-02-07', '2025-11-07'),
(67, 'Michael Miller', 'Ultimate', 'michael.miller108@outlook.com', '$2y$10$09vRF4L4oIqLXSle.AyKIu/LBSUJ2t7f60tZS2AQDbWqEQiPLKXS2', '2025-02-07', '2026-02-07'),
(68, 'Sophia Jones', 'Elite', 'sophia.jones246@outlook.com', '$2y$10$xhmdDv.Bs6oiJ1elf/cXWOaOCBFcU/i9vBpn0IEbTBtSqga1Qq7E6', '2025-02-07', '2025-08-07'),
(69, 'Isabella Williams', 'Elite', 'isabella.williams520@gmail.com', '$2y$10$fhMU6yG7is08Q7eB/RFRZOmh4.IOpq/k1/mB7oIPgYAcEDO4N6soW', '2025-02-07', '2025-09-07'),
(70, 'Ava Jones', 'Premium', 'ava.jones441@hotmail.com', '$2y$10$l/xlxxsu7.fV.30rJofD8u8Ohp8.mB5N2NvXsFjbwbJ3m7n4moDaO', '2025-02-07', '2025-08-07'),
(71, 'Sophia Williams', 'Premium', 'sophia.williams299@yahoo.com', '$2y$10$ueIn4InePU4oUAC7j9UW/.FZuhcz.U1kBmGGDbmuIB8NdQmNOxOkm', '2025-02-07', '2025-10-07'),
(72, 'Sophia Williams', 'Basic', 'sophia.williams309@yahoo.com', '$2y$10$uxgtTSViRIOh0vhiO0uBbOUAyzYribogt0ZXpG0MBtWe7TF6Ts4WK', '2025-02-07', '2025-06-07'),
(73, 'William Johnson', 'Premium', 'william.johnson308@icloud.com', '$2y$10$vUVn7C.HzkZrLnJbYFY2hex9TrTdwiS2XT8GAsg9mJ1BM42ZcDX82', '2025-02-07', '2026-02-07'),
(74, 'Ava Davis', 'Basic', 'ava.davis614@outlook.com', '$2y$10$WVi5Sewd7O7AJLUGCL09I.Uw7.s13Q9nB1mchViAW2NZgOMbli.SO', '2025-02-07', '2026-02-07'),
(75, 'Ava Brown', 'Basic', 'ava.brown640@yahoo.com', '$2y$10$E74FQRNB6RLSfYXHTm47ae6911nJAbjtAfWS6pExU31Yvc0blfDEy', '2025-02-07', '2025-06-07'),
(76, 'Alexander Rodriguez', 'Premium', 'alexander.rodriguez865@outlook.com', '$2y$10$iS5S.oFGK1o5Gk0UXFuEYex0ZxB4LvmZs1R.HLVNXqU7cCOllbMxC', '2025-02-07', '2025-10-07'),
(77, 'Isabella Williams', 'Basic', 'isabella.williams929@outlook.com', '$2y$10$7uQmcrYnNRmWqnCkarnWmOEl7IRNVF2hqdGb8kHh7K1zezCO6zXGa', '2025-02-07', '2025-08-07'),
(78, 'Isabella Miller', 'Basic', 'isabella.miller592@hotmail.com', '$2y$10$avZDhVeDOL8UcKx0oP8bqu8Q1YH9TE9e9ofvGLjgHlX20oGwxDFT2', '2025-02-07', '2025-03-07'),
(79, 'William Garcia', 'Elite', 'william.garcia297@gmail.com', '$2y$10$aoF2MnNU.THgBqKxglNPkufH8wmW9oSrSALO9jyY5fe1eLj/CA87O', '2025-02-07', '2026-01-07'),
(80, 'Sophia Rodriguez', 'Elite', 'sophia.rodriguez692@gmail.com', '$2y$10$QUEcCruhejY/AZuKpPc6teuQm9no4nrlgTWeVPuSVdB13cZk7bmbG', '2025-02-07', '2025-11-07'),
(81, 'John Jones', 'Elite', 'john.jones581@icloud.com', '$2y$10$RIKX9JY8h3YlmF2646lMiudETTcwdfXCuc20.GyubpXgmxwNc2V.m', '2025-02-07', '2025-04-07'),
(82, 'Olivia Smith', 'Ultimate', 'olivia.smith737@hotmail.com', '$2y$10$pzaJId79SuObzrLnN3s6TOEXA.CmaWHABF/QVQjs3lJ9ikRjgXPbW', '2025-02-07', '2025-06-07'),
(83, 'Sophia Smith', 'Elite', 'sophia.smith907@gmail.com', '$2y$10$q18wrsvzRFxhi8z2GNW3RuiHz7tza8PQ3r85oTTm.kb1Ew4ZcIroq', '2025-02-07', '2026-02-07'),
(84, 'William Williams', 'Ultimate', 'william.williams291@gmail.com', '$2y$10$q5I7yi9t/7p7Fee9..Ttl.9XLRhpEl6BKXKGZyrr5ebGGOQlcYA4m', '2025-02-07', '2025-06-07'),
(85, 'Michael Johnson', 'Premium', 'michael.johnson791@yahoo.com', '$2y$10$ETcv2kgktAa3ONdfvi/E/OQMysXepZZgANFeSDYDwX6pKJsF.qkfq', '2025-02-07', '2025-12-07'),
(86, 'Olivia Miller', 'Elite', 'olivia.miller932@outlook.com', '$2y$10$ZkD2NQwVA/lpBW6G4NsgeOlGuajTCxC5FnriAVSEx4i5RRZVt/rba', '2025-02-07', '2025-06-07'),
(87, 'Isabella Brown', 'Elite', 'isabella.brown873@hotmail.com', '$2y$10$L8NEMOTfW/c5DEhrfEZKv.qlqtkSYCk.CFeXdfHDBh4YC6irij4pm', '2025-02-07', '2025-10-07'),
(88, 'Isabella Smith', 'Elite', 'isabella.smith505@gmail.com', '$2y$10$TiOc3QAA496gqGd7cTQDQ.b5anWJM.jYSz.RGPL7MVfMXDnNV.auW', '2025-02-07', '2025-08-07'),
(89, 'Sophia Johnson', 'Ultimate', 'sophia.johnson245@yahoo.com', '$2y$10$ytzo.a1dOBxlq9kGTkJ2Ru1TTMfIymtaoyHUIXSmV4ESdBOSbjOAy', '2025-02-07', '2025-08-07'),
(90, 'Michael Rodriguez', 'Ultimate', 'michael.rodriguez686@gmail.com', '$2y$10$ERG9oqZnDOLOC/N1g3KFFOkMx1I1M1utFBX.1wLu27CPCdW4ttesO', '2025-02-07', '2025-04-07'),
(91, 'Michael Martinez', 'Ultimate', 'michael.martinez131@yahoo.com', '$2y$10$x8pcXTXk6GL2FhEG3lfBy.g2P0iXH5LX4k4WISTozY/X0UWmMHGmi', '2025-02-07', '2026-01-07'),
(92, 'Ava Miller', 'Basic', 'ava.miller215@gmail.com', '$2y$10$vOvSVc5Q9a80jTcR3TtaiOQ32c2cLtfzKEr0KTBKVsGPs.SrfK93W', '2025-02-07', '2025-10-07'),
(93, 'John Rodriguez', 'Basic', 'john.rodriguez861@outlook.com', '$2y$10$a4WR7QhYdseP/VeOVLzUw.z9q4WYHBQFzRMQWpoBptxDVrRpCAJzS', '2025-02-07', '2025-08-07'),
(94, 'Emma Smith', 'Premium', 'emma.smith146@outlook.com', '$2y$10$c535w3SbElkyKdpXjbTssORJ11P/bMdw00ITNrX/VAw9GdGdJMjzi', '2025-02-07', '2025-06-07'),
(95, 'Sophia Garcia', 'Elite', 'sophia.garcia880@gmail.com', '$2y$10$/tbNvEauzbtbK7tI0TstgOqnZHpfXHSdb663yuGtH.rPLeAFVd/j2', '2025-02-07', '2025-11-07'),
(96, 'Emma Martinez', 'Premium', 'emma.martinez470@icloud.com', '$2y$10$WCbuz.VKK0o1T8TNd67iL.I1RsT1vDRDSb3Vx.KhfsTA7PdmprLRK', '2025-02-07', '2025-09-07'),
(97, 'William Williams', 'Elite', 'william.williams392@yahoo.com', '$2y$10$bpj2bz2N8MkU6yOY2wv2EOBkN.OTtof/t7MKj7BJMvwZlJdJfD53C', '2025-02-07', '2025-06-07'),
(98, 'Emma Williams', 'Ultimate', 'emma.williams889@icloud.com', '$2y$10$rkhlf8BAE0VuvnJxaTiiHu7VEsKVVtNih4xDrMy7vnsY2JiCPpQJK', '2025-02-07', '2026-01-07'),
(99, 'Ava Miller', 'Premium', 'ava.miller904@icloud.com', '$2y$10$eZGs5bA2LOd4bHVgJ0uLJezh0u.XQC5y5Wm0y1Cb4GxcXJy8iaOWS', '2025-02-07', '2025-04-07'),
(100, 'William Miller', 'Ultimate', 'william.miller200@yahoo.com', '$2y$10$262Bcq9/dapLQnmwQJGWvORXei7CWe0o0hMC9hZ60zNL7LfSJcJIK', '2025-02-07', '2025-12-07'),
(101, 'James Williams', 'Elite', 'james.williams630@outlook.com', '$2y$10$lvEnNNzNdnXKefEaxcLCk.nNUwCrWACXYI3sIv2hKjXiaqWbujzx.', '2025-02-07', '2025-10-07'),
(102, 'Michael Williams', 'Premium', 'michael.williams569@yahoo.com', '$2y$10$6GB5JoHB6zg.IJvGrR6hx.SMiG9sJ3QP2l5d1WiT617syWrEVt0Ri', '2025-02-07', '2025-10-07'),
(103, 'Ava Miller', 'Basic', 'ava.miller198@icloud.com', '$2y$10$E.Yxmfj7qH1.GtSlT..dZ.Ts6/5kja3230c9cdxgdfWXH5b9hne0C', '2025-02-07', '2025-05-07'),
(104, 'Isabella Brown', 'Premium', 'isabella.brown850@gmail.com', '$2y$10$zYn9jVqdojNC83.eExd4lOqFeF8uxKy.Bq7m.af4aqcyMSTY9JgsW', '2025-02-07', '2025-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `memberId` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `duration` int(11) NOT NULL,
  `new` varchar(50) NOT NULL,
  `changedFrom` varchar(50) DEFAULT NULL,
  `payMode` varchar(50) NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `payDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `memberId`, `action`, `duration`, `new`, `changedFrom`, `payMode`, `Total`, `payDate`) VALUES
(4, 5, 'New Member', 6, 'Elite', NULL, 'PayPal', 17994.00, '2024-04-13 18:30:00'),
(5, 6, 'New Member', 6, 'Elite', NULL, 'Debit Card', 17994.00, '2024-05-20 18:30:00'),
(6, 7, 'New Member', 1, 'Basic', NULL, 'Credit Card', 999.00, '2024-11-23 18:30:00'),
(7, 8, 'New Member', 7, 'Elite', NULL, 'Credit Card', 20993.00, '2024-04-03 18:30:00'),
(8, 9, 'New Member', 2, 'Elite', NULL, 'Bank Transfer', 5998.00, '2024-03-27 18:30:00'),
(9, 10, 'New Member', 4, 'Basic', NULL, 'Debit Card', 3996.00, '2024-11-10 18:30:00'),
(10, 11, 'New Member', 2, 'Ultimate', NULL, 'Credit Card', 7998.00, '2024-08-27 18:30:00'),
(11, 12, 'New Member', 3, 'Elite', NULL, 'Debit Card', 8997.00, '2024-11-21 18:30:00'),
(12, 13, 'New Member', 4, 'Premium', NULL, 'Credit Card', 7996.00, '2024-03-14 18:30:00'),
(13, 14, 'New Member', 6, 'Premium', NULL, 'Bank Transfer', 11994.00, '2024-02-14 18:30:00'),
(14, 15, 'New Member', 3, 'Basic', NULL, 'Debit Card', 2997.00, '2025-02-06 18:30:00'),
(15, 16, 'New Member', 9, 'Elite', NULL, 'PayPal', 26991.00, '2025-02-06 18:30:00'),
(16, 17, 'New Member', 7, 'Elite', NULL, 'PayPal', 20993.00, '2025-02-06 18:30:00'),
(17, 18, 'New Member', 11, 'Basic', NULL, 'Credit Card', 10989.00, '2025-02-06 18:30:00'),
(18, 19, 'New Member', 12, 'Basic', NULL, 'Bank Transfer', 11988.00, '2025-02-06 18:30:00'),
(19, 20, 'New Member', 10, 'Premium', NULL, 'Debit Card', 19990.00, '2025-02-06 18:30:00'),
(20, 21, 'New Member', 11, 'Elite', NULL, 'Debit Card', 32989.00, '2025-02-06 18:30:00'),
(21, 22, 'New Member', 4, 'Basic', NULL, 'Bank Transfer', 3996.00, '2025-02-06 18:30:00'),
(22, 23, 'New Member', 9, 'Basic', NULL, 'Debit Card', 8991.00, '2025-02-06 18:30:00'),
(23, 24, 'New Member', 10, 'Ultimate', NULL, 'PayPal', 39990.00, '2025-02-06 18:30:00'),
(24, 25, 'New Member', 7, 'Ultimate', NULL, 'Debit Card', 27993.00, '2025-02-06 18:30:00'),
(25, 26, 'New Member', 3, 'Basic', NULL, 'Bank Transfer', 2997.00, '2025-02-06 18:30:00'),
(26, 27, 'New Member', 9, 'Elite', NULL, 'Credit Card', 26991.00, '2025-02-06 18:30:00'),
(27, 28, 'New Member', 1, 'Basic', NULL, 'Debit Card', 999.00, '2025-02-06 18:30:00'),
(28, 29, 'New Member', 5, 'Basic', NULL, 'Bank Transfer', 4995.00, '2025-02-06 18:30:00'),
(29, 30, 'New Member', 4, 'Elite', NULL, 'Debit Card', 11996.00, '2025-02-06 18:30:00'),
(30, 31, 'New Member', 3, 'Basic', NULL, 'Credit Card', 2997.00, '2025-02-06 18:30:00'),
(31, 32, 'New Member', 8, 'Elite', NULL, 'Bank Transfer', 23992.00, '2025-02-06 18:30:00'),
(32, 33, 'New Member', 4, 'Basic', NULL, 'Debit Card', 3996.00, '2025-02-06 18:30:00'),
(33, 34, 'New Member', 9, 'Elite', NULL, 'PayPal', 26991.00, '2025-02-06 18:30:00'),
(34, 35, 'New Member', 11, 'Basic', NULL, 'Debit Card', 10989.00, '2025-02-06 18:30:00'),
(35, 36, 'New Member', 9, 'Basic', NULL, 'Credit Card', 8991.00, '2025-02-06 18:30:00'),
(36, 37, 'New Member', 9, 'Elite', NULL, 'Debit Card', 26991.00, '2025-02-06 18:30:00'),
(37, 38, 'New Member', 11, 'Basic', NULL, 'Credit Card', 10989.00, '2025-02-06 18:30:00'),
(38, 39, 'New Member', 1, 'Basic', NULL, 'Debit Card', 999.00, '2025-02-06 18:30:00'),
(39, 40, 'New Member', 4, 'Basic', NULL, 'Bank Transfer', 3996.00, '2025-02-06 18:30:00'),
(40, 41, 'New Member', 10, 'Basic', NULL, 'Credit Card', 9990.00, '2025-02-06 18:30:00'),
(41, 42, 'New Member', 10, 'Ultimate', NULL, 'PayPal', 39990.00, '2025-02-06 18:30:00'),
(42, 43, 'New Member', 7, 'Ultimate', NULL, 'PayPal', 27993.00, '2025-02-06 18:30:00'),
(43, 44, 'New Member', 7, 'Ultimate', NULL, 'Bank Transfer', 27993.00, '2025-02-06 18:30:00'),
(44, 45, 'New Member', 13, 'Basic', NULL, 'Credit Card', 12987.00, '2025-02-06 18:30:00'),
(45, 46, 'New Member', 11, 'Ultimate', NULL, 'Debit Card', 43989.00, '2025-02-06 18:30:00'),
(46, 47, 'New Member', 9, 'Elite', NULL, 'Bank Transfer', 26991.00, '2025-02-06 18:30:00'),
(47, 48, 'New Member', 2, 'Ultimate', NULL, 'PayPal', 7998.00, '2025-02-06 18:30:00'),
(48, 49, 'New Member', 12, 'Premium', NULL, 'Credit Card', 23988.00, '2025-02-06 18:30:00'),
(49, 50, 'New Member', 12, 'Premium', NULL, 'Bank Transfer', 23988.00, '2025-02-06 18:30:00'),
(50, 51, 'New Member', 4, 'Premium', NULL, 'Bank Transfer', 7996.00, '2025-02-06 18:30:00'),
(51, 52, 'New Member', 3, 'Elite', NULL, 'Credit Card', 8997.00, '2025-02-06 18:30:00'),
(52, 53, 'New Member', 4, 'Premium', NULL, 'Credit Card', 7996.00, '2025-02-06 18:30:00'),
(53, 54, 'New Member', 1, 'Elite', NULL, 'Credit Card', 2999.00, '2025-02-06 18:30:00'),
(54, 55, 'New Member', 12, 'Ultimate', NULL, 'Credit Card', 47988.00, '2025-02-06 18:30:00'),
(55, 56, 'New Member', 4, 'Elite', NULL, 'Bank Transfer', 11996.00, '2025-02-06 18:30:00'),
(56, 57, 'New Member', 5, 'Premium', NULL, 'PayPal', 9995.00, '2025-02-06 18:30:00'),
(57, 58, 'New Member', 7, 'Basic', NULL, 'Credit Card', 6993.00, '2025-02-06 18:30:00'),
(58, 59, 'New Member', 11, 'Elite', NULL, 'PayPal', 32989.00, '2025-02-06 18:30:00'),
(59, 60, 'New Member', 8, 'Ultimate', NULL, 'PayPal', 31992.00, '2025-02-06 18:30:00'),
(60, 61, 'New Member', 3, 'Ultimate', NULL, 'Bank Transfer', 11997.00, '2025-02-06 18:30:00'),
(61, 62, 'New Member', 7, 'Basic', NULL, 'PayPal', 6993.00, '2025-02-06 18:30:00'),
(62, 63, 'New Member', 1, 'Basic', NULL, 'Credit Card', 999.00, '2025-02-06 18:30:00'),
(63, 64, 'New Member', 9, 'Premium', NULL, 'Credit Card', 17991.00, '2025-02-06 18:30:00'),
(64, 65, 'New Member', 5, 'Elite', NULL, 'PayPal', 14995.00, '2025-02-06 18:30:00'),
(65, 66, 'New Member', 10, 'Elite', NULL, 'Bank Transfer', 29990.00, '2025-02-06 18:30:00'),
(66, 67, 'New Member', 13, 'Ultimate', NULL, 'PayPal', 51987.00, '2025-02-06 18:30:00'),
(67, 68, 'New Member', 7, 'Elite', NULL, 'Debit Card', 20993.00, '2025-02-06 18:30:00'),
(68, 69, 'New Member', 8, 'Elite', NULL, 'Debit Card', 23992.00, '2025-02-06 18:30:00'),
(69, 70, 'New Member', 7, 'Premium', NULL, 'Credit Card', 13993.00, '2025-02-06 18:30:00'),
(70, 71, 'New Member', 9, 'Premium', NULL, 'PayPal', 17991.00, '2025-02-06 18:30:00'),
(71, 72, 'New Member', 4, 'Basic', NULL, 'Credit Card', 3996.00, '2025-02-06 18:30:00'),
(72, 73, 'New Member', 13, 'Premium', NULL, 'Credit Card', 25987.00, '2025-02-06 18:30:00'),
(73, 74, 'New Member', 13, 'Basic', NULL, 'Debit Card', 12987.00, '2025-02-06 18:30:00'),
(74, 75, 'New Member', 4, 'Basic', NULL, 'Credit Card', 3996.00, '2025-02-06 18:30:00'),
(75, 76, 'New Member', 9, 'Premium', NULL, 'Bank Transfer', 17991.00, '2025-02-06 18:30:00'),
(76, 77, 'New Member', 7, 'Basic', NULL, 'Credit Card', 6993.00, '2025-02-06 18:30:00'),
(77, 78, 'New Member', 1, 'Basic', NULL, 'Credit Card', 999.00, '2025-02-06 18:30:00'),
(78, 79, 'New Member', 12, 'Elite', NULL, 'Debit Card', 35988.00, '2025-02-06 18:30:00'),
(79, 80, 'New Member', 10, 'Elite', NULL, 'Bank Transfer', 29990.00, '2025-02-06 18:30:00'),
(80, 81, 'New Member', 2, 'Elite', NULL, 'Credit Card', 5998.00, '2025-02-06 18:30:00'),
(81, 82, 'New Member', 4, 'Ultimate', NULL, 'Bank Transfer', 15996.00, '2025-02-06 18:30:00'),
(82, 83, 'New Member', 13, 'Elite', NULL, 'Debit Card', 38987.00, '2025-02-06 18:30:00'),
(83, 84, 'New Member', 4, 'Ultimate', NULL, 'PayPal', 15996.00, '2025-02-06 18:30:00'),
(84, 85, 'New Member', 11, 'Premium', NULL, 'Credit Card', 21989.00, '2025-02-06 18:30:00'),
(85, 86, 'New Member', 4, 'Elite', NULL, 'Credit Card', 11996.00, '2025-02-06 18:30:00'),
(86, 87, 'New Member', 9, 'Elite', NULL, 'Debit Card', 26991.00, '2025-02-06 18:30:00'),
(87, 88, 'New Member', 7, 'Elite', NULL, 'Debit Card', 20993.00, '2025-02-06 18:30:00'),
(88, 89, 'New Member', 7, 'Ultimate', NULL, 'Credit Card', 27993.00, '2025-02-06 18:30:00'),
(89, 90, 'New Member', 2, 'Ultimate', NULL, 'Debit Card', 7998.00, '2025-02-06 18:30:00'),
(90, 91, 'New Member', 12, 'Ultimate', NULL, 'Bank Transfer', 47988.00, '2025-02-06 18:30:00'),
(91, 92, 'New Member', 9, 'Basic', NULL, 'PayPal', 8991.00, '2025-02-06 18:30:00'),
(92, 93, 'New Member', 7, 'Basic', NULL, 'Credit Card', 6993.00, '2025-02-06 18:30:00'),
(93, 94, 'New Member', 4, 'Premium', NULL, 'Debit Card', 7996.00, '2025-02-06 18:30:00'),
(94, 95, 'New Member', 10, 'Elite', NULL, 'Bank Transfer', 29990.00, '2025-02-06 18:30:00'),
(95, 96, 'New Member', 8, 'Premium', NULL, 'Credit Card', 15992.00, '2025-02-06 18:30:00'),
(96, 97, 'New Member', 4, 'Elite', NULL, 'Bank Transfer', 11996.00, '2025-02-06 18:30:00'),
(97, 98, 'New Member', 12, 'Ultimate', NULL, 'Bank Transfer', 47988.00, '2025-02-06 18:30:00'),
(98, 99, 'New Member', 2, 'Premium', NULL, 'Debit Card', 3998.00, '2025-02-06 18:30:00'),
(99, 100, 'New Member', 11, 'Ultimate', NULL, 'PayPal', 43989.00, '2025-02-06 18:30:00'),
(100, 101, 'New Member', 9, 'Elite', NULL, 'Credit Card', 26991.00, '2025-02-06 18:30:00'),
(101, 102, 'New Member', 9, 'Premium', NULL, 'Credit Card', 17991.00, '2025-02-06 18:30:00'),
(102, 103, 'New Member', 3, 'Basic', NULL, 'Debit Card', 2997.00, '2025-02-06 18:30:00'),
(103, 104, 'New Member', 4, 'Premium', NULL, 'Bank Transfer', 7996.00, '2025-02-06 18:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberId` (`memberId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`memberId`) REFERENCES `members` (`id`) ON DELETE CASCADE;

DELIMITER $$
--
-- Events
--
  CREATE DEFINER=`root`@`localhost` EVENT `update_expired_memberships` ON SCHEDULE EVERY 1 SECOND STARTS '2025-02-07 22:15:11' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
      UPDATE members
      SET membership_type = 'Expired'
      WHERE expiration_date < CURDATE() AND membership_type != 'Expired';
  END$$

  DELIMITER ;
  COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
