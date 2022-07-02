CREATE DATABASE db;

USE db;

CREATE TABLE users (username varchar(255) primary key, name varchar(255), password varchar(255), email varchar(255), is_admin int DEFAULT 0);

INSERT INTO users (username,name,password,email,is_admin) VALUES ('admin','admin','admin','admin@admin.com',1);

CREATE TABLE posts (ID int primary key auto_increment, username varchar(255), title varchar(10000) default "No title", post text, date timestamp default current_timestamp);

INSERT INTO posts (username,title,post) VALUES ('admin','Notitle', 'Welcome to admin');