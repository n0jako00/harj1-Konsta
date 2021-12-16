drop database if exists n0jako00;
create database n0jako00;
use n0jako00;

CREATE TABLE IF NOT EXISTS `user`(
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    uname VARCHAR(50) PRIMARY KEY,
    passw VARCHAR(150) NOT NULL,
    INDEX user_index(uname)
);

CREATE TABLE IF NOT EXISTS info(
    info_id INT PRIMARY KEY AUTO_INCREMENT,
    uname VARCHAR(50) NOT NULL,
    infotext VARCHAR(300),
    INDEX uname_index(uname),
    FOREIGN KEY(uname) references user(uname)
    ON DELETE restrict
);