CREATE DATABASE IF NOT EXISTS userCars;

CREATE TABLE IF NOT EXISTS userCars.Users(
	id int NOT NULL AUTO_INCREMENT,
	username VARCHAR(100),
    passwordHash VARCHAR(100),
	PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS userCars.Cars(
	id int NOT NULL AUTO_INCREMENT,
	make VARCHAR(50),
	model VARCHAR(50),
	year int,
	userId int,
	PRIMARY KEY(id),
	FOREIGN KEY (userId) REFERENCES Users(id)
);