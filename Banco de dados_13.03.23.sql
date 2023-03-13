CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(255) DEFAULT NULL,
  `user_level` int DEFAULT '0',
  PRIMARY KEY (`id`)
);
CREATE TABLE `informativos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `usuario_id` int NOT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `data_inicio` date DEFAULT '2023-01-01',
  `hora_inicio` time DEFAULT '00:00:00',
  `hora_fim` time DEFAULT '00:00:00',
  `data_fim` date DEFAULT '2023-12-31',
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `informativos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
);
CREATE TABLE `imagens_informativos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `informativo_id` int NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `informativo_id` (`informativo_id`),
  CONSTRAINT `imagens_informativos_ibfk_1` FOREIGN KEY (`informativo_id`) REFERENCES `informativos` (`id`) ON DELETE CASCADE
);
CREATE TABLE `imagens_informativos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `informativo_id` int NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `informativo_id` (`informativo_id`),
  CONSTRAINT `imagens_informativos_ibfk_1` FOREIGN KEY (`informativo_id`) REFERENCES `informativos` (`id`) ON DELETE CASCADE
);
