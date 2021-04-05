CREATE TABLE users( 
    userid INT PRIMARY KEY AUTO_INCREMENT, 
    fullname VARCHAR(20) NOT NULL, 
    email VARCHAR(50) NOT NULL,
    contact VARCHAR(12) NOT NULL, 
    password VARCHAR(50) NOT NULL
);
CREATE TABLE admin( 
    adminid INT PRIMARY KEY AUTO_INCREMENT, 
    fullname VARCHAR(20) NOT NULL, 
    email VARCHAR(50) NOT NULL, 
    contact VARCHAR(12) NOT NULL, 
    address VARCHAR(100) NOT NULL, 
    password VARCHAR(50) NOT NULL 
);

CREATE TABLE category(
    categoryid VARCHAR(20) PRIMARY KEY NOT NULL,
    categoryname VARCHAR(20) NOT NULL
);
INSERT INTO `category`(`categoryid`, `categoryname`) VALUES ('1', 'vegetables');
INSERT INTO `category`(`categoryid`, `categoryname`) VALUES ('2', 'groceries');
INSERT INTO `category`(`categoryid`, `categoryname`) VALUES ('3', 'electronics');
INSERT INTO `category`(`categoryid`, `categoryname`) VALUES ('4', 'arts');
INSERT INTO `category`(`categoryid`, `categoryname`) VALUES ('5', 'beauty');
INSERT INTO `category`(`categoryid`, `categoryname`) VALUES ('6', 'clothes');
INSERT INTO `category`(`categoryid`, `categoryname`) VALUES ('7', 'health');
INSERT INTO `category`(`categoryid`, `categoryname`) VALUES ('8', 'stationaries');

create table admincategoryrelation(
    admindid int,
    categoryid varchar(20),
    
    FOREIGN KEY(adminid) REFERENCES admin(adminid) ON DELETE CASCADE,
    FOREIGN KEY(categoryid) REFERENCES category(categoryid) ON DELETE CASCADE
);
CREATE TABLE brand(
    brandid VARCHAR(20) PRIMARY KEY NOT NULL,
    brandname VARCHAR(20) NOT NULL
);
CREATE TABLE product (
	productid INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    pname VARCHAR(50) NOT NULL,
    stock INT(4) NOT NULL,
    price INT(10) NOT NULL,
    categoryid VARCHAR(20) NOT NULL,
    adminid INT NOT NULL,
    brandid VARCHAR(20) NOT NULL,
    description VARCHAR(200),
    FOREIGN KEY(adminid) REFERENCES admin(adminid) ON DELETE CASCADE,
    FOREIGN KEY(categoryid) REFERENCES category(categoryid) ON DELETE CASCADE,
    FOREIGN KEY(brandid) REFERENCES brand(brandid) ON DELETE CASCADE
    
);
ALTER TABLE product ADD COLUMN image VARCHAR(100);
INSERT INTO `brand`(`brandid`, `brandname`) VALUES ('1', 'pepe jeans');
INSERT INTO `brand`(`brandid`, `brandname`) VALUES ('2', 'forever 21');
INSERT INTO `brand`(`brandid`, `brandname`) VALUES ('3', 'allen solly');
INSERT INTO `brand`(`brandid`, `brandname`) VALUES ('4', 'westside');


CREATE TABLE cart(
    userid INT,
    quantity INT,
    totalcost INT,
    FOREIGN KEY(userid) REFERENCES users(userid) ON DELETE CASCADE
);

create table cartproductrelation(
    userid int,
    productid INT,
    
    FOREIGN KEY(userid) REFERENCES users(userid) ON DELETE CASCADE,
    FOREIGN KEY(productid) REFERENCES product(productid) ON DELETE CASCADE
);

CREATE TABLE wishlist(
    userid INT,
    quantity INT,
    FOREIGN KEY(userid) REFERENCES users(userid) ON DELETE CASCADE
);

create table wishproductrelation(
    userid int,
    productid INT,
    
    FOREIGN KEY(userid) REFERENCES users(userid) ON DELETE CASCADE,
    FOREIGN KEY(productid) REFERENCES product(productid) ON DELETE CASCADE
);