CREATE DATABASE  IF NOT EXISTS `preetec` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `preetec`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: preetec
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.31-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `aluno`
--

DROP TABLE IF EXISTS `aluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aluno` (
  `id_aluno` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `id_inscricao` mediumint(8) unsigned DEFAULT NULL,
  `id_responsavel` mediumint(8) unsigned DEFAULT NULL,
  `data_nascimento_aluno` date NOT NULL,
  `rg_aluno` varchar(14) DEFAULT NULL,
  `cpf` char(11) DEFAULT NULL,
  `logradouro_aluno` varchar(100) NOT NULL,
  `bairro_aluno` varchar(60) NOT NULL,
  `cidade_aluno` varchar(60) NOT NULL,
  `complemento_aluno` varchar(100) DEFAULT NULL,
  `cep_aluno` char(8) DEFAULT NULL,
  `escolaridade` enum('Ensino fundamental cursando','Ensino fundamental concluído','Ensino médio cursando','Ensino médio concluído') NOT NULL,
  `escola` varchar(120) NOT NULL,
  `matriculado` bit(1) NOT NULL DEFAULT b'0',
  `status_aluno` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id_aluno`),
  UNIQUE KEY `cpf` (`cpf`),
  KEY `FK_inscricao_aluno` (`id_inscricao`),
  KEY `FK_responsavel_aluno` (`id_responsavel`),
  CONSTRAINT `FK_inscricao_aluno` FOREIGN KEY (`id_inscricao`) REFERENCES `inscricao` (`id_inscricao`),
  CONSTRAINT `FK_responsavel_aluno` FOREIGN KEY (`id_responsavel`) REFERENCES `responsavel` (`id_responsavel`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aluno`
--

LOCK TABLES `aluno` WRITE;
/*!40000 ALTER TABLE `aluno` DISABLE KEYS */;
INSERT INTO `aluno` VALUES (3,1,2,'2000-10-25','51635441621461','16416154747','','pari','sp','Proximo ao BrÃ¡s','15248256','','Nossa Senhora da Pari','\0','');
/*!40000 ALTER TABLE `aluno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chamada`
--

DROP TABLE IF EXISTS `chamada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chamada` (
  `id_chamada` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_turma` tinyint(3) unsigned DEFAULT NULL,
  `id_aluno` mediumint(8) unsigned DEFAULT NULL,
  `id_professor` smallint(5) unsigned DEFAULT NULL,
  `data_chamada` date NOT NULL,
  `presenca` bit(1) NOT NULL,
  PRIMARY KEY (`id_chamada`),
  KEY `FK_turma_chamada` (`id_turma`),
  KEY `FK_aluno_chamada` (`id_aluno`),
  KEY `FK_professor_chamada` (`id_professor`),
  KEY `idx_data_chamada` (`data_chamada`),
  CONSTRAINT `FK_aluno_chamada` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`),
  CONSTRAINT `FK_professor_chamada` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id_professor`),
  CONSTRAINT `FK_turma_chamada` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chamada`
--

LOCK TABLES `chamada` WRITE;
/*!40000 ALTER TABLE `chamada` DISABLE KEYS */;
INSERT INTO `chamada` VALUES (1,3,3,1,'2018-07-25','');
/*!40000 ALTER TABLE `chamada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disciplina`
--

DROP TABLE IF EXISTS `disciplina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disciplina` (
  `id_disciplina` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nome_disciplina` varchar(30) NOT NULL,
  PRIMARY KEY (`id_disciplina`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disciplina`
--

LOCK TABLES `disciplina` WRITE;
/*!40000 ALTER TABLE `disciplina` DISABLE KEYS */;
INSERT INTO `disciplina` VALUES (1,'PortuguÃªs'),(2,'Java');
/*!40000 ALTER TABLE `disciplina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disciplina_ministrada`
--

DROP TABLE IF EXISTS `disciplina_ministrada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disciplina_ministrada` (
  `id_disciplina_ministrada` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `id_professor` smallint(5) unsigned DEFAULT NULL,
  `id_disciplina` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_disciplina_ministrada`),
  KEY `FK_professor_disciplina_ministrada` (`id_professor`),
  KEY `FK_disciplina_disciplina_ministrada` (`id_disciplina`),
  CONSTRAINT `FK_disciplina_disciplina_ministrada` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`),
  CONSTRAINT `FK_professor_disciplina_ministrada` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id_professor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disciplina_ministrada`
--

LOCK TABLES `disciplina_ministrada` WRITE;
/*!40000 ALTER TABLE `disciplina_ministrada` DISABLE KEYS */;
INSERT INTO `disciplina_ministrada` VALUES (1,1,2),(2,1,1);
/*!40000 ALTER TABLE `disciplina_ministrada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscricao`
--

DROP TABLE IF EXISTS `inscricao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inscricao` (
  `id_inscricao` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `data_inscricao` datetime NOT NULL,
  `nome_aluno` varchar(120) NOT NULL,
  `sexo_aluno` enum('MASCULINO','FEMININO','OUTRO') NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `telefone_responsavel` char(10) DEFAULT NULL,
  `celular_responsavel` char(11) DEFAULT NULL,
  `inscrito` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id_inscricao`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_data_inscricao` (`data_inscricao`),
  KEY `idx_nome_aluno` (`nome_aluno`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscricao`
--

LOCK TABLES `inscricao` WRITE;
/*!40000 ALTER TABLE `inscricao` DISABLE KEYS */;
INSERT INTO `inscricao` VALUES (1,'2018-07-23 22:27:37','Andre Lucas da Silva Souza','MASCULINO','souza.andr79@gmail.com','1146092577','11961596530','\0');
/*!40000 ALTER TABLE `inscricao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `id_login` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(24) NOT NULL,
  `senha` varchar(24) NOT NULL,
  `tipo_usuario` enum('PROFESSOR','ADMINISTRADOR') NOT NULL DEFAULT 'PROFESSOR',
  `status_login` enum('ATIVO','INATIVO') NOT NULL DEFAULT 'ATIVO',
  PRIMARY KEY (`id_login`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'admin','123','ADMINISTRADOR','ATIVO');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matricula`
--

DROP TABLE IF EXISTS `matricula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matricula` (
  `id_matricula` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_turma` tinyint(3) unsigned DEFAULT NULL,
  `id_aluno` mediumint(8) unsigned DEFAULT NULL,
  `data_matricula` date NOT NULL,
  PRIMARY KEY (`id_matricula`),
  KEY `FK_turma_matricula` (`id_turma`),
  KEY `FK_aluno_matricula` (`id_aluno`),
  CONSTRAINT `FK_aluno_matricula` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`),
  CONSTRAINT `FK_turma_matricula` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matricula`
--

LOCK TABLES `matricula` WRITE;
/*!40000 ALTER TABLE `matricula` DISABLE KEYS */;
INSERT INTO `matricula` VALUES (7,3,3,'2018-07-25');
/*!40000 ALTER TABLE `matricula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professor`
--

DROP TABLE IF EXISTS `professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `professor` (
  `id_professor` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `data_nascimento_professor` date NOT NULL,
  `nome_professor` varchar(120) NOT NULL,
  `sexo_professor` enum('MASCULINO','FEMININO','OUTRO') NOT NULL,
  `cpf` char(11) DEFAULT NULL,
  `rg_professor` varchar(14) DEFAULT NULL,
  `logradouro_professor` varchar(100) NOT NULL,
  `bairro_professor` varchar(60) NOT NULL,
  `cidade_professor` varchar(60) NOT NULL,
  `complemento_professor` varchar(100) DEFAULT NULL,
  `cep_professor` char(8) DEFAULT NULL,
  `telefone_professor` char(10) DEFAULT NULL,
  `celular_professor` char(11) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `formacao` varchar(120) NOT NULL,
  PRIMARY KEY (`id_professor`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_professor_nome` (`nome_professor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professor`
--

LOCK TABLES `professor` WRITE;
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
INSERT INTO `professor` VALUES (1,'0000-00-00','Airton Teste','MASCULINO',NULL,NULL,'xcvxc','xvxcv','xcv',NULL,NULL,NULL,NULL,NULL,'cvxc');
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `responsavel`
--

DROP TABLE IF EXISTS `responsavel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `responsavel` (
  `id_responsavel` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `nome_responsavel` varchar(120) NOT NULL,
  `sexo_responsavel` enum('MASCULINO','FEMININO','OUTRO') NOT NULL,
  `cpf` char(11) DEFAULT NULL,
  `rg_responsavel` varchar(14) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id_responsavel`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responsavel`
--

LOCK TABLES `responsavel` WRITE;
/*!40000 ALTER TABLE `responsavel` DISABLE KEYS */;
INSERT INTO `responsavel` VALUES (2,'Pai do Ano','MASCULINO','10231313654','45456564564564','souomelhor@gmail.com');
/*!40000 ALTER TABLE `responsavel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turma`
--

DROP TABLE IF EXISTS `turma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `turma` (
  `id_turma` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nome_turma` varchar(2) NOT NULL,
  `quantidade_alunos` tinyint(3) unsigned NOT NULL,
  `disponivel` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id_turma`),
  KEY `idx_nome_turma` (`nome_turma`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turma`
--

LOCK TABLES `turma` WRITE;
/*!40000 ALTER TABLE `turma` DISABLE KEYS */;
INSERT INTO `turma` VALUES (1,'A',39,''),(2,'B',38,''),(3,'C',41,''),(4,'D',39,'');
/*!40000 ALTER TABLE `turma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'preetec'
--

--
-- Dumping routines for database 'preetec'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-25  2:19:26
