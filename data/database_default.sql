SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Banco de Dados: `cms`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cms_config`
--

CREATE TABLE IF NOT EXISTS `cms_config` (
  `idConfig` int(11) NOT NULL,
  `configTitle` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `configDescription` text COLLATE utf8_unicode_ci NOT NULL,
  `configEmail` text COLLATE utf8_unicode_ci NOT NULL,
  `configKeyWords` text COLLATE utf8_unicode_ci NOT NULL,
  `configScriptGA` text COLLATE utf8_unicode_ci NOT NULL,
  `configGAId` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `configGAAcc` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `configGAPassword` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  primary key (`idConfig`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `cms_config`
--

INSERT INTO `cms_config` (`configTitle`, `configDescription`, `configEmail`, `configKeyWords`, `configScriptGA`, `configGAId`, `configGAAcc`, `configGAPassword`) VALUES
('Configs iniciais', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cms_groups`
--

CREATE TABLE IF NOT EXISTS `cms_groups` (
  `idGroup` int(11) NOT NULL AUTO_INCREMENT,
  `groupName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `groupPermission` bit(3) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`idGroup`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `cms_groups`
--

INSERT INTO `cms_groups` (`idGroup`, `groupName`, `groupPermission`) VALUES
(1, 'Administrador', b'100'),
(2, 'Moderador', b'010'),
(3, 'Outros', b'001');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cms_users`
--

CREATE TABLE IF NOT EXISTS `cms_users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `idGroup` int(1) NOT NULL DEFAULT '3',
  `userName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userEmail` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `userLogin` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userPassword` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `userPhoto` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `UNIQUE` (`userEmail`,`userLogin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

insert into cms_users ( idGroup, userName, userEmail, userLogin, userPassword ) values (1, 'master', 'master@martinhagocreative.com', 'master', sha1('mastermaster'));
