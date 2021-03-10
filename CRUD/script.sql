create database crud;

CREATE TABLE `clientes` (
  `cliente_id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
   PRIMARY KEY (cliente_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `clientes` (`cliente_id`, `nome`, `email`, `status`) VALUES
(1, 'Ricardo Ramos', 'ricardoramos@outlook.com', 1),
(2, 'Marcos Ferreira', 'marcosferreira@gmail.com', 1);
