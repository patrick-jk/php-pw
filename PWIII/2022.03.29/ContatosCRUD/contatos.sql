create database dbContatos; 

use dbContatos;

create table tbContatos(
nome varchar(100), 
email varchar(100));

insert into tbContatos values ("Maria", "maria@hotmail.com"), 
("Antonio", "antonio@hotmail.com"),
("Jose","jose@hotmail.com"), 
("Amarildo", "amarildo@hotmail.com"), 
("Noemi", "noemi@hotmail.com"), 
("Dalva","dalva@hotmail.com"), 
("Lorivaldo","lorivaldo@hotmail.com"),
("Alice", "alice@hotmail.com"), 
("Nicole", "nicole@hotmail.com"), 
("Vicente", "vicente@hotmail.com"),
("Emanuel", "emanuel@hotmail.com"), 
("Gabriela", "gabriela@hotmail.com");

select * from tbContatos;