CREATE TABLE users( 
    userid INT PRIMARY KEY AUTO_INCREMENT, 
    fullname VARCHAR(20) NOT NULL, 
    email VARCHAR(50) NOT NULL,
    contact VARCHAR(12) NOT NULL, 
    password VARCHAR(50) NOT NULL
);
