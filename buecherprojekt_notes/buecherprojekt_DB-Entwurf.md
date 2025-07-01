---
title: Datenbank-Entwurf Bücherprojekt
started: 30/06/25
---
#coding #bfw #buecherprojekt

# Datenbank Entwurf - Planung
![buecherprojekt_Datenbank.jpg](..\..\13_Praktikums-Projekt\buecherprojekt_Datenbank.jpg)

# Tabellen
## Buch
- bID (PK)
- buchtitel
- erscheinungsjahr
- non-/fiction 
- angefangen
- beendet
- seiten <!-- optional wenn Format = Hörbuch -->
- stunden <!-- optional wenn Format = e-Book oder Buch -->
- sprache
- image <!-- link oder upload? -->
- rating (1 to 5, in 0.5 steps)
- notes / review
- dnf (did not finish) <!-- true / false, setzt beendet automatisch auf Datum heute (?) -->
- owned 

## Autor
- aID (PK)
- autor_name
- herkunftsland

## Genre
- gID
- genretitel

## Format
- fID (PK)
- format (e-book, buch, Hörbuch )

## Tags
- tID
- tag

## Erworben
- eID (PK)
- erworben (gekauft, Geschenk, e-book store, shop, secondhand…) <!-- erweiterbar um eigene Optionen -->

# Zwischentabellen
## buecher_autoren
- bID
- aID
- PK (bID, aID)
## buecher_genres
- bID
- gID
- PK (bID, gID)
## buecher_tags
- bID
- tID
- PK (bID, tID)

# SQL Table Creation
````
CREATE DATABASE booknook;
USE booknook;

CREATE TABLE format (
	fID int NOT NULL AUTO_INCREMENT,
    formatName varchar(200) DEFAULT NULL,
    PRIMARY KEY (fID)
);

CREATE TABLE book (
	bID int NOT NULL AUTO_INCREMENT,
    fID int NOT NULL, 
    bookTitle varchar(1000) NOT NULL,
    publishingYear year DEFAULT NULL,
    nonFiction varchar(250) DEFAULT NULL, 
	dateStarted date DEFAULT NULL,
    dateFinished date DEFAULT NULL,
	pages int DEFAULT NULL, 
	hours int DEFAULT NULL,
    minutes int DEFAULT NULL,
	language varchar(250) DEFAULT NULL,
  	image varchar(3000) DEFAULT NULL,
	rating decimal(2,1) DEFAULT NULL,
	review TEXT DEFAULT NULL,
	dnf BOOLEAN DEFAULT FALSE,
    owned BOOLEAN DEFAULT FALSE,
    PRIMARY KEY (bID),
    FOREIGN KEY (fID) REFERENCES format(fID) 
);

CREATE TABLE author (
	aID int NOT NULL AUTO_INCREMENT,
    authorName varchar(1000) NOT NULL,
    country varchar(1000) DEFAULT NULL,
    PRIMARY KEY (aID)
);

CREATE TABLE books_authors (
	bID int NOT NULL,
	aID int NOT NULL,
    FOREIGN KEY (bID) REFERENCES book(bID),
    FOREIGN KEY (aID) REFERENCES author(aID),
    CONSTRAINT PK_booksAuthors PRIMARY KEY (bID, aID) 
);

CREATE TABLE genre (
	gID int NOT NULL AUTO_INCREMENT,
    genreTitle varchar(400) UNIQUE,
    PRIMARY KEY (gID)
);

CREATE TABLE books_genres (
	bID int NOT NULL,
	gID int NOT NULL,
    FOREIGN KEY (bID) REFERENCES book(bID),
    FOREIGN KEY (gID) REFERENCES genre(gID),
    CONSTRAINT PK_booksGenres PRIMARY KEY (bID, gID) 
);

CREATE TABLE tag (
	tID int NOT NULL AUTO_INCREMENT,
    tagTitle varchar(400) UNIQUE,
    PRIMARY KEY (tID)
);

CREATE TABLE books_tags (
	bID int NOT NULL,
	tID int NOT NULL,
    FOREIGN KEY (bID) REFERENCES book(bID),
    FOREIGN KEY (tID) REFERENCES tag(tID),
    CONSTRAINT PK_booksTags PRIMARY KEY (bID, tID) 
);

CREATE TABLE aquired (
	aqID int NOT NULL AUTO_INCREMENT,
    aquiredTitle varchar(2000) UNIQUE,
    PRIMARY KEY (aqID)
);

CREATE TABLE books_aquired (
	bID int NOT NULL,
	aqID int NOT NULL,
    FOREIGN KEY (bID) REFERENCES book(bID),
    FOREIGN KEY (aqID) REFERENCES aquired(aqID),
    CONSTRAINT PK_booksAquired PRIMARY KEY (bID, aqID) 
);
````

## Datenbank befüllen
````
-- Genres
INSERT INTO genre (genreTitle) VALUES
('Fantasy'),
('Science Fiction'),
('Biography'),
('Crime'),
('Romance'),
('Thriller'),
('Contemporary'),
('Young Adult'),
('Feminism'),
('LGBTQIA+'),
('Self Help'),
('Science'),
('Mystery'),
('Education'),
('Essays'),
('Religion'),
('Sociology'),
('History'),
('Philosophy'),
('Classics'),
('Gender');

-- Formate
INSERT INTO format (formatName) VALUES
('E-Book'),
('Paperback'),
('Hardcover'),
('Audiobook');

-- Tags
INSERT INTO tag (tagTitle) VALUES
('Favorite'),
('To Read'),
('Recommended'),
('New Arrival'),
('Classic'),
('Award Winner'),
('Short Reads'),
('Long Reads'),
('Series'),
('Standalone');


```
