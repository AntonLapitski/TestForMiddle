
 CREATE DATABASE test_for_middle;

 USE test_for_middle;

CREATE TABLE people (
    id int NOT NULL AUTO_INCREMENT,
    firstname varchar(255),
    lastname varchar(255),
    date_of_birth date,
    gender int,
    city_of_birth varchar(255),
    PRIMARY KEY (id)
);