create database instagram;

use instagram;

create table posts (
	id int primary key auto_increment, 
    img varchar(500),
    descricao varchar(300),
    user_id int,
    foreign key (user_id) references users(id)
);

select * from posts;

create table users (
	id int primary key auto_increment, 
    imagemPerfil varchar(500),
    nomeCompleto varchar(300),
    email varchar(300),
    senha varchar(8)
);

select * from users;

drop table posts;

drop table users;
