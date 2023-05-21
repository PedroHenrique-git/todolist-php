create database if not exists todolist;

use todolist;

create table if not exists user(
    id int auto_increment primary key,
    email varchar(100) not null unique,
    password varchar(255) not null
);

create table if not exists task(
    id int auto_increment primary key,
    user_id int not null,
    task varchar(255) not null,
    finish enum('yes', 'no') not null,
    foreign key (user_id) references user(id)
);
