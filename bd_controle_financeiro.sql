-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: controle_financeiro
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(255) NOT NULL,
  `descricao_categoria` text,
  `usuario_id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_categoria`,`usuario_id_user`),
  KEY `fk_categoria_usuario1_idx` (`usuario_id_user`),
  CONSTRAINT `fk_categoria_usuario1` FOREIGN KEY (`usuario_id_user`) REFERENCES `usuario` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (8,'Saúde','Remédios, consultas, checkup...',2),(31,'Alimentação','Lanches, supermercado, feiras, restaurantes...',3),(32,'Moradia','Luz, água, telefone, aluguel, manutenção...',3),(33,'Saúde','Remédios, consultas, checkup...',3),(34,'Lazer','Cinema, viagens, academia...',3),(35,'Transporte','Combustível, manutenção, viagens, revisões...',3),(36,'Compras Mensais','',4),(37,'Aluguel','',4),(38,'Luz','',4),(39,'Água','',4),(40,'Alimentação','Lanches, supermercado, feiras, restaurantes...',5),(41,'Moradia','Luz, água, telefone, aluguel, manutenção...',5),(42,'Saúde','Remédios, consultas, checkup...',5),(43,'Lazer','Cinema, viagens, academia...',5),(44,'Transporte','Combustível, manutenção, viagens, revisões...',5),(45,'Alimentação','Lanches, supermercado, feiras, restaurantes...',1),(46,'Moradia','Luz, água, telefone, aluguel, manutenção...',1),(47,'Saúde','Remédios, consultas, checkup...',1),(48,'Lazer','Cinema, viagens, academia...',1),(49,'Transporte','Combustível, manutenção, viagens, revisões...',1);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `despesa`
--

DROP TABLE IF EXISTS `despesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `despesa` (
  `id_desp` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_desp` text,
  `valor_desp` double DEFAULT NULL,
  `data_venc_desp` date DEFAULT NULL,
  `status_desp` int(2) DEFAULT NULL,
  `categoria_id_categoria` int(11) NOT NULL,
  `forma_pagamento_id_form_pag` int(11) NOT NULL,
  `usuario_id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_desp`),
  KEY `fk_despesa_categoria_idx` (`categoria_id_categoria`),
  KEY `fk_despesa_forma_pagamento1_idx` (`forma_pagamento_id_form_pag`),
  KEY `fk_despesa_usuario1_idx` (`usuario_id_user`),
  CONSTRAINT `fk_despesa_categoria` FOREIGN KEY (`categoria_id_categoria`) REFERENCES `categoria` (`id_categoria`) ON UPDATE CASCADE,
  CONSTRAINT `fk_despesa_forma_pagamento1` FOREIGN KEY (`forma_pagamento_id_form_pag`) REFERENCES `forma_pagamento` (`id_form_pag`) ON UPDATE NO ACTION,
  CONSTRAINT `fk_despesa_usuario1` FOREIGN KEY (`usuario_id_user`) REFERENCES `usuario` (`id_user`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despesa`
--

LOCK TABLES `despesa` WRITE;
/*!40000 ALTER TABLE `despesa` DISABLE KEYS */;
INSERT INTO `despesa` VALUES (14,'Combustível',85,'2017-06-15',1,8,6,2),(19,'cartao',5000,'2017-06-21',2,32,20,3),(20,'Supermercado',700,'2017-06-09',1,36,22,4),(21,'Residencia',100,'2017-06-21',1,38,22,4),(22,'Lanche',150,'2017-06-23',1,8,10,2),(24,'Boate',600,'2017-06-21',1,43,27,5),(25,'Cartão de Crédito',4922.88,'2017-07-01',1,45,32,1),(26,'Alimentação básica',15,'2017-06-13',1,8,6,2),(27,'Combustível',250,'2017-06-21',1,39,23,4),(28,'Roupas',59,'2017-06-20',1,8,6,2),(29,'teste',10,'2017-07-01',1,45,32,1);
/*!40000 ALTER TABLE `despesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forma_pagamento`
--

DROP TABLE IF EXISTS `forma_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forma_pagamento` (
  `id_form_pag` int(11) NOT NULL AUTO_INCREMENT,
  `nome_form_pag` varchar(65) NOT NULL,
  `descricao_form_pag` text,
  `usuario_id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_form_pag`,`usuario_id_user`),
  KEY `fk_forma_pagamento_usuario1_idx` (`usuario_id_user`),
  CONSTRAINT `fk_forma_pagamento_usuario1` FOREIGN KEY (`usuario_id_user`) REFERENCES `usuario` (`id_user`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_pagamento`
--

LOCK TABLES `forma_pagamento` WRITE;
/*!40000 ALTER TABLE `forma_pagamento` DISABLE KEYS */;
INSERT INTO `forma_pagamento` VALUES (6,'Dinheiro','Moedas, notas...',2),(10,'Cartão de Débito','Banco Itaú',2),(17,'Dinheiro','Moedas, notas...',3),(18,'Cheque','...',3),(19,'Cartão de Crédito','...',3),(20,'Débito em Conta','...',3),(21,'Boleto','...',3),(22,'Dinheiro','Moedas, notas...',4),(23,'Cheque','...',4),(24,'Cartão de Crédito','...',4),(25,'Débito em Conta','...',4),(26,'Boleto','...',4),(27,'Dinheiro','Moedas, notas...',5),(28,'Cheque','...',5),(29,'Cartão de Crédito','...',5),(30,'Débito em Conta','...',5),(31,'Boleto','...',5),(32,'Dinheiro','Moedas, notas...',1),(33,'Cheque','...',1),(34,'Cartão de Crédito','...',1),(35,'Débito em Conta','...',1),(36,'Boleto','...',1);
/*!40000 ALTER TABLE `forma_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hash`
--

DROP TABLE IF EXISTS `hash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(60) NOT NULL,
  `status` int(2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hash`
--

LOCK TABLES `hash` WRITE;
/*!40000 ALTER TABLE `hash` DISABLE KEYS */;
INSERT INTO `hash` VALUES (1,'33fff2c1b9b58aba65a853adccf7a1da81c0fe69',0,25,'2017-07-01 02:43:56'),(2,'f39c60f071d251581d51ef0b28495693c2c3fe37',0,26,'2017-07-01 03:08:17'),(3,'7ffd7a563acbb353ec22279eaff5a30dde90a19d',0,27,'2017-07-01 03:09:15'),(4,'281e1bbc3a435c2047f016ebc844ac0b71fd6bb3',0,28,'2017-07-01 03:13:44'),(5,'c58a03e5842fa1ad52d6781faaf0921bf039c2f0',0,29,'2017-07-01 03:15:44'),(6,'2a2a593a8ea4e7b91e33249de91e3c573af56115',0,30,'2017-07-01 03:21:00'),(7,'6480ac93deebb7ee97922c157deb816a255df4bd',0,31,'2017-07-01 03:24:11');
/*!40000 ALTER TABLE `hash` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receita`
--

DROP TABLE IF EXISTS `receita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receita` (
  `id_rec` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_rec` varchar(60) NOT NULL,
  `valor_rec` double NOT NULL,
  `data_lanc_rec` date NOT NULL,
  `status_rec` int(2) NOT NULL,
  `usuario_id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_rec`),
  KEY `fk_receita_usuario1_idx` (`usuario_id_user`),
  CONSTRAINT `fk_receita_usuario1` FOREIGN KEY (`usuario_id_user`) REFERENCES `usuario` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receita`
--

LOCK TABLES `receita` WRITE;
/*!40000 ALTER TABLE `receita` DISABLE KEYS */;
INSERT INTO `receita` VALUES (2,'Salário',1500,'2017-09-02',1,1),(3,'Vendas',2500,'2017-05-05',1,1),(4,'Outros',350,'2016-08-06',2,1),(5,'teste',200,'2013-10-11',1,2),(7,'Dinheiro',1563,'0123-06-17',1,2),(9,'novo',15963,'2017-02-14',1,1),(13,'Venda ',12,'1956-06-17',1,2),(15,'teste',99,'2017-06-22',1,2),(18,'test',10,'2018-05-24',1,1),(20,'salario',9000,'2017-06-06',1,3),(21,'salario',300,'2018-05-01',1,3),(22,'Salario',1000,'2017-06-01',1,4),(23,'Investimentos',300,'2017-06-20',1,4),(24,'Salario',1100,'2017-07-13',2,4),(25,'Salario',1200,'2017-06-21',1,5),(26,'Venda bike',200,'2017-06-30',2,5),(27,'Salario',1200,'2017-07-21',2,5),(28,'Combustível',156,'2017-06-22',1,2),(29,'Venda',85,'2017-11-03',1,2),(30,'Remuneracao',4421,'2017-07-01',1,1),(31,'FGTS',1400,'2017-07-01',1,1),(32,'Venda',1250,'2017-06-27',1,2),(33,'Vendas Jequiti',596,'2017-06-30',1,2),(35,'teste',15,'2017-07-01',1,1);
/*!40000 ALTER TABLE `receita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `status` int(2) DEFAULT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'nataniel','natanielsa@gmail.com','6116afedcb0bc31083935c1c262ff4c9',NULL,NULL),(2,'teste','','6116afedcb0bc31083935c1c262ff4c9',NULL,NULL),(3,'luiz','luiz','6116afedcb0bc31083935c1c262ff4c9',NULL,NULL),(4,'pauliran','pauliran','6116afedcb0bc31083935c1c262ff4c9',NULL,NULL),(5,'guedes','guedes','6116afedcb0bc31083935c1c262ff4c9',NULL,NULL),(29,'aaaa','a@a.com','77de54ccf56eb6f7dbf99e4d3be949ab',0,'2017-07-01 03:15:44'),(30,'bbb','b@b.com','7014de06693eca5c7a6f258b98fa2048',0,'2017-07-01 03:20:59'),(31,'cccc','c@c.com.br','791dd97fda69b6f7237114db1a5ade5c',0,'2017-07-01 03:24:11');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-01  0:57:48
