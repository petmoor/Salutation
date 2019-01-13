
DROP DATABASE IF EXISTS Salutation;
CREATE DATABASE Salutation;

USE Salutation;

CREATE TABLE FirstNames (
    fn_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname varchar(26) NOT NULL,
    shortname varchar(26) NULL,
    typ varchar(2),
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    UNIQUE INDEX idx__firstname_typ (firstname, typ),
    INDEX idx__shortname (shortname)
);

CREATE TABLE FirstNames_Typ (
    fnt_id varchar(2) NOT NULL PRIMARY KEY,
    typ_of_firstname varchar(64)
);
INSERT INTO FirstNames_Typ (fnt_id, typ_of_firstname) VALUES ( 'M', 'männlich');
INSERT INTO FirstNames_Typ (fnt_id, typ_of_firstname) VALUES ( '1M', 'männlich, wenn erster Teil des Namens, sonst meist männlich');
INSERT INTO FirstNames_Typ (fnt_id, typ_of_firstname) VALUES ( '?M', 'unisex, aber meist männlich');
INSERT INTO FirstNames_Typ (fnt_id, typ_of_firstname) VALUES ( 'F', 'weiblich');
INSERT INTO FirstNames_Typ (fnt_id, typ_of_firstname) VALUES ( '1F', 'weiblich, wenn erster Teile des Namens, sonst meist weiblich');
INSERT INTO FirstNames_Typ (fnt_id, typ_of_firstname) VALUES ( '?F', 'unisex, aber meist weiblich');
INSERT INTO FirstNames_Typ (fnt_id, typ_of_firstname) VALUES ( '?', 'unisex');

CREATE TABLE FirstNames_Country_Weight (
    fncw_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fn_id INT NOT NULL, 
    country_indicator varchar(2) NOT NULL,
    firstname_weight int,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    INDEX idx__fn_id (fn_id),
    INDEX idx__fn_id__country_indicator (fn_id, country_indicator)
);

CREATE TABLE Firstnames_Russia (
    fnr_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fn_id INT NOT NULL,
    firstname varchar(26) NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    INDEX idx__firstname (firstname)
);

CREATE TABLE Countries (
    c_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    country_indicator varchar(2) NOT NULL,
    country varchar(30) NOT NULL,
    country_weight int,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    INDEX idx__country_indicator (country_indicator)
);


CREATE TABLE Phonetic_Rules (
    pr_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    syllable varchar(3) NOT NULL,
    phonetic varchar(3) NOT NULL,
    difference int,
    hash_group int,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    INDEX idx__syllable (syllable)
);
