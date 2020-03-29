-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 29, 2020 alle 16:18
-- Versione del server: 10.4.11-MariaDB
-- Versione PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_projectwork5ai`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `amministratore`
--

CREATE TABLE `amministratore` (
  `codice` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `amministratore`
--

INSERT INTO `amministratore` (`codice`) VALUES
('s31sc3m0');

-- --------------------------------------------------------

--
-- Struttura della tabella `crea`
--

CREATE TABLE `crea` (
  `codice` varchar(10) NOT NULL,
  `testoQ` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `crea`
--

INSERT INTO `crea` (`codice`, `testoQ`) VALUES
('s31sc3m0', 'Prova'),
('s31sc3m0', 'Prova2'),
('s31sc3m0', 'Prova3'),
('s31sc3m0', 'Prova4'),
('s31sc3m0', 'Prova5');

-- --------------------------------------------------------

--
-- Struttura della tabella `partecipa`
--

CREATE TABLE `partecipa` (
  `codice` varchar(10) NOT NULL,
  `testoQ` varchar(500) NOT NULL,
  `presente` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `propone`
--

CREATE TABLE `propone` (
  `codice` varchar(10) NOT NULL,
  `testoQ` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `quesito`
--

CREATE TABLE `quesito` (
  `testoQ` varchar(500) NOT NULL,
  `titolo` varchar(50) NOT NULL,
  `scadenza` datetime NOT NULL,
  `percMinima` float NOT NULL,
  `stato` tinyint(1) NOT NULL,
  `astensione` tinyint(1) NOT NULL,
  `votoChiaro` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `quesito`
--

INSERT INTO `quesito` (`testoQ`, `titolo`, `scadenza`, `percMinima`, `stato`, `astensione`, `votoChiaro`) VALUES
('Prova', 'Prova1', '2020-03-20 00:58:00', 25, 1, 0, 1),
('Prova2', 'Prova2', '2020-03-26 03:56:00', 15, 1, 1, 1),
('Prova3', 'Prova3', '2020-03-27 21:12:00', 65, 1, 1, 1),
('Prova4', 'Prova4', '2020-04-01 23:59:00', 75, 1, 1, 1),
('Prova5', 'Prova5', '2020-04-05 15:58:00', 5, 1, 1, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `risposta`
--

CREATE TABLE `risposta` (
  `testoR` varchar(50) NOT NULL,
  `voti favorevoli` int(50) NOT NULL,
  `testoQ` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `risposta`
--

INSERT INTO `risposta` (`testoR`, `voti favorevoli`, `testoQ`) VALUES
('Prova2', 0, 'Prova5'),
('Prova1', 0, 'Prova5'),
('Prova', 0, 'Prova4'),
('prova3', 0, 'Prova3'),
('prova1', 0, 'Prova'),
('ptova2', 0, 'Prova'),
('prova1', 0, 'Prova3'),
('prova2', 0, 'Prova3'),
('prova1', 0, 'Prova2');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `CF` varchar(18) DEFAULT NULL,
  `nome` varchar(10) DEFAULT NULL,
  `cognome` varchar(10) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `cancellato` tinyint(1) NOT NULL DEFAULT 0,
  `codice` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`CF`, `nome`, `cognome`, `password`, `email`, `cancellato`, `codice`) VALUES
('MSSBNC01L71D969F', 'Bianca', 'Massone', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 'biancamassone@gmail.com', 0, 'c1p0LL1n0'),
('STCNDR02A02D969D', 'Andrea', 'Stucchi', 'a0c299b71a9e59d5ebb07917e70601a3570aa103e99a7bb65a58e780ec9077b1902d1dedb31b1457beda595fe4d71d779b6ca9cad476266cc07590e31d84b206', 'andrea.stucchi02@gmail.com', 0, 's31sc3m0'),
('RDLTTR01B24D969Z', 'Ettore', 'Rodella', '0a6f9ebaa55e21ce270b6df2e7d812c987d511ab0472d24b501622b5878f9e4b03011356f3c9f85b084cf763a995a93f142d5107fa9a92d8e60e78d3c96a614a', 'ettore.rodella@gmail.com', 0, 'GIp8m3sUnT'),
('STCLCU94T22D969N', 'Luca', 'Stucchi', '77516558eb5b721f351abe23997ea152a7d4562babbafbbfeae7e84df59d1f41ce3954d8fb91f60cb1b7221c57d3d8732611d7334c5cc4dc7dfdccc01ee70e4e', 'stucchi19@gmail.com', 0, 'SoIQmACWtj'),
('CNTMTT01H06D451Y', 'Matteo', 'Conti', '3b69dac934519ed342c2a6f201249e22f6b29769c3f2974907036f3934b9527ee3b60a299272695b3bfa56e6cdcd44b4c9a7b3a717ed581195b3120dcb270a64', 'spamduemilauno@gmail.com', 0, 'm1p14c3l4');

-- --------------------------------------------------------

--
-- Struttura della tabella `vota`
--

CREATE TABLE `vota` (
  `codice` varchar(10) NOT NULL,
  `testoR` varchar(50) NOT NULL,
  `astensione` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `amministratore`
--
ALTER TABLE `amministratore`
  ADD PRIMARY KEY (`codice`);

--
-- Indici per le tabelle `crea`
--
ALTER TABLE `crea`
  ADD PRIMARY KEY (`codice`,`testoQ`);

--
-- Indici per le tabelle `partecipa`
--
ALTER TABLE `partecipa`
  ADD PRIMARY KEY (`codice`,`testoQ`);

--
-- Indici per le tabelle `propone`
--
ALTER TABLE `propone`
  ADD PRIMARY KEY (`codice`,`testoQ`);

--
-- Indici per le tabelle `quesito`
--
ALTER TABLE `quesito`
  ADD PRIMARY KEY (`testoQ`);

--
-- Indici per le tabelle `risposta`
--
ALTER TABLE `risposta`
  ADD PRIMARY KEY (`testoR`,`testoQ`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`codice`);

--
-- Indici per le tabelle `vota`
--
ALTER TABLE `vota`
  ADD PRIMARY KEY (`codice`,`testoR`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
