 DROP DATABASE IF EXISTS mydatabase;
CREATE DATABASE mydatabase;
use mydatabase;

DROP TABLE IF EXISTS account;
CREATE TABLE account (
	id integer NOT NULL auto_increment,
	username varchar(255) NOT NULL default '',
	password varchar(225) NOT NULL default '',
	type varchar(225) NOT NULL default '',
	registered datetime NOT NULL default '0000-00-00 00:00:00',
	PRIMARY KEY(id)
); 

DROP TABLE IF EXISTS cart;
-- cart can be seem as purchase
CREATE TABLE cart (
	Cid integer NOT NULL auto_increment,
	name varchar(255),
	username varchar(255),
	price integer,
	quantity integer, 
	-- consider to remove?
	purchaseDate datetime NOT NULL default '0000-00-00 00:00:00',
	PRIMARY KEY (Cid)
);
DROP TABLE IF EXISTS orderlist;
CREATE TABLE orderlist (
	ordrnumber integer,
	username varchar(255),
	product varchar(255),
	type varchar(255),
	price integer,
	quantity integer, 
	total integer,
	purchaseDate datetime NOT NULL default '0000-00-00 00:00:00'
	
);

DROP TABLE IF EXISTS purchase;
CREATE TABLE purchase (
	PurchaseId integer NOT NULL auto_increment,
	purchaseItem varchar(255),
	username varchar(255),
	total_price integer,
	purchaseDate datetime NOT NULL default '0000-00-00 00:00:00',
	PRIMARY KEY (PurchaseId)
);

 select name from mydatabase.purchase p join mydatabase.cart c on p.username=c.username;

DROP TABLE IF EXISTS product;
CREATE TABLE product(  
  id integer NOT NULL AUTO_INCREMENT,  
  name varchar(255) NOT NULL,  
  image varchar(255) NOT NULL,  
  price double(10,2) NOT NULL, 
  quantity integer,
  PRIMARY KEY (id)  
 );  


 INSERT INTO mydatabase.product (id, name, image, price) VALUES  
 (1, 'Apple', 'apple.jpg', 100.00),  
 (2, 'Strawberry', 'strawberry.jpg', 299.00),  
 (3, 'Kiwi', 'kiwi.jpg', 125.00),
 (4, 'Watermelon', 'wm.jpg', 800.00),
 (5, 'Grape', 'grape.jpg', 300.00),
 (6, 'Pineapple', 'pineapple.jpg', 600.00),
 (7, 'Lemon', 'lemon.jpg', 110.00),
 (8, 'Blueberry', 'bb.jpg', 200.00),
 (9, 'Melon', 'melon.jpeg', 650.00);

 INSERT INTO mydatabase.account (id, username, password, type,registered) VALUES 
 (1, 'administrator', 'password', 'customer','2017-04-24 00:00:00');


