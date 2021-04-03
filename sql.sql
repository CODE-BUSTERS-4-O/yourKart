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
