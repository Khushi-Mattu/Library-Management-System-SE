all the database queries:

create database
CREATE DATABASE library;

create books table </br>
CREATE TABLE books ( bid INT PRIMARY KEY, book_item VARCHAR(30) NOT NULL, a_name varchar(30),des VARCHAR(150) NOT NULL, price INT NOT NULL );

create user table </br>
CREATE TABLE userRec (uid INT PRIMARY KEY auto_incremenet, name VARCHAR(30) NOT NULL, email VARCHAR(150) NOT NULL, pass VARCHAR(150) NOT NULL, contact INT NOT NULL);

insert data in the user table </br>
INSERT INTO userRec VALUES(1,'Admin','admin@gmail.com','12345',999909999); INSERT INTO userRec VALUES(2,'Uditi','uditi@gmail.com','qwerty',9726871261); INSERT INTO userRec VALUES(3,'Khushi','khushi@gmail.com','asdfg',9971183123);

create bill table  </br>
CREATE TABLE restaurant.bill( billid int primary key auto_increment, bill int, uid int, CONSTRAINT fk_product_1 foreign key (uid) references userRec(uid));
