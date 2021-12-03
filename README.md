all the database queries:

1. create database
    CREATE DATABASE restaurant;
    
2. create menu table 
    CREATE TABLE menu (
    mid INT PRIMARY KEY,
    menu_item VARCHAR(30) NOT NULL,
    des VARCHAR(150) NOT NULL,
    price INT NOT NULL
    );
    
 3. Inserting data into menu table
INSERT INTO menu VALUES(1,'Veg Burger','Veg Burger with aloo tikki, onions, tomatoes, with cheesy sauce along the sides french fries and chips.',150);
INSERT INTO menu VALUES(2,'Chefs Special Pizza','Onions, tomatoes, red paprika, olives along with cheddar cheese as toppings.',200);
INSERT INTO menu VALUES(3,'Frankie','Potaoes stuffed along with onions and capsicum in a chappati.',100);
INSERT INTO menu VALUES(4,'Brownie','Chocolate flavoured without egg brownie served with hot chocolate.',150);
INSERT INTO menu VALUES(5,'Pancakes','Vanilla pankcase served along with the chocolate chips with vanila base icecream.',200);
INSERT INTO menu VALUES(6,'Sandwiches','Onions, capsicum and tomatoes along with sauces in a multigrain bread.',100);
 
4.  create user table 
CREATE TABLE userRec (uid INT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(150) NOT NULL,
    pass VARCHAR(150) NOT NULL,
    contact INT NOT NULL);
    
5. insert data in the user table
INSERT INTO userRec VALUES(1,'Admin','admin@gmail.com','12345',999909999);
INSERT INTO userRec VALUES(2,'Uditi','uditi@gmail.com','qwerty',9726871261);
INSERT INTO userRec VALUES(3,'Khushi','khushi@gmail.com','asdfg',9971183123);

6. create bill table
CREATE TABLE restaurant.bill(
billid int primary key,
bill int,
uid int,
CONSTRAINT fk_product_1 foreign key (uid) references userRec(uid));





