---
title: Datenbank-Abfragen Bücherprojekt
started: 02/07/25
---
#coding #bfw #buecherprojekt

# Auswahlmöglichkeiten Add Book

## Genres
```` 
SELECT genreTitle FROM genre 
ORDER BY name 

-- neue Eingabe hinzufügen
INSERT INTO genre 
````
## Buch aus DB holen
Anzeigen: 
- Titel
- Autor (aus books_authors tabelle)
- Erscheinungsjahr
- format (aus books_formats tabelle)
- entweder oder:
    - seiten
    - audio länge
- Angefangen
- Beendet
- Genres (aus books_genres tabelle)
- starrating
- review
````
SELECT book.bookTitle, author.authorName
FROM book
LEFT JOIN author ON author.aID = author.aID

````
bsp
SELECT Customers.CustomerName, Orders.OrderID\
FROM Customers\
LEFT JOIN Orders ON Customers.CustomerID = Orders.CustomerID\
ORDER BY Customers.CustomerName;
