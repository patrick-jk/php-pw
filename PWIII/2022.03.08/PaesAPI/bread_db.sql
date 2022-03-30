
create database android;

use android;

CREATE TABLE `bread` (
  `id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `preco` float NOT NULL,
  `datafabricacao` date NOT NULL,
  `datavalidade` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `bread` VALUES (1, 'Pão Francês', 10, '2022-03-15', '2022-03-22'),
(2, 'Pão Carteira', 15, '2022-02-17', '2022-02-27'), (3, 'Pão de Forma', 8, '2022-04-01', '2022-04-09'),
(4, 'Pão Caseiro', 5, '2022-06-22', '2022-06-23'), (5, 'Pão de Mel', 12, '2022-05-11', '2022-05-15');

ALTER TABLE `bread`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bread`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

