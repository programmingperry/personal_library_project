---
title: Zeitplan Bücherprojekt
started: 30/06/25
---
#coding #bfw #buecherprojekt

# Zeitplan
| Tag       | Plan                                                                                            | Gemacht |
|-----------|-------------------------------------------------------------------------------------------------|---------|
| Mo 30.06. | Zeit-/Plan erstellen, Coding Entscheidungen treffen, DB Entwurf, Projektstruktur / Seitenaufbau |         |
| Di 01.07. | Design Entwurf, Datenbank einrichten und mit ein paar Daten befüllen                            |         |
| Mi 02.07. | Projekt anlegen, Basis-Seiten und Aufbau erstellen, Datenbank Verbindung einrichten             |         |
| Do 03.07. | An PHP Code und Funktionalität arbeiten                                                         |         |
| Fr 04.07. | Design und CSS                                                                                  |         |
| Mo 07.07. |                                                                                                 |         |
| Di 08.07. |                                                                                                 |         |
| Mi 09.07. |                                                                                                 |         |
| Do 10.07. |                                                                                                 |         |
| Fr 11.07. |                                                                                                 |         |

## Gemacht
30.06.: 
- Zeitplan erstellt
- Coding Entscheidungen getroffen
- DB Entwurf erstellt
- Projektstruktur und Seitenaufbau aufgelistet
- erste Design Überlegungen
- GithubRepo angelegt
01.07.:
- Datenbank eingerichtet
- Daten befüllen erst später (erst die Buch einfügen Funktionalität erstellen)
- Files und Ordner in VSC erstellt, Buch hinzufügen Formular erstellt
- Navigation Struktur erstellt
02.07.:
- Datenbankverbindung hergestellt (wuupwuup!)
- auslesen der Auswahlmöglichkeiten für das Add Book Formular aus Datenbank mit AJAX und Json
- Datenübertragung aus Formular in addbook.php in Datenbank
- Menüfunktion und Seitenladen durch JS 
- CSS Farbanpassungen
03.07.:
- Fehler beim Seiten-laden in book.php durch JS korrigiert (js funktionen ausgelagert, js Inhalte in Formular auf index.php nachladen)
- 


# Coding Entscheidungen
## Zusammengefasst

| Technologie                | Aufgabe                                                 |
|----------------------------|---------------------------------------------------------|
| PHP (prozedural)           | Serverlogik, Formulare verarbeiten, Datenbankabfragen   |
| MySQL                      | Bücher, Autoren, Genres speichern und verknüpfen        |
| HTML                       | Seitenstruktur: Formulare, Tabellen, Überschriften      |
| CSS + Bootstrap            | Styling und Layout - schnell & individuell anpassbar    |
| JavaScript + iQuery + AJAX | Interaktive Oberfläche, dynamisches Nachladen von Daten |


## Datenbank und Backend 

### MySQL 
- Relationale Datenbank erstellen

### PHP 
- PHP prozedural verwenden
    - Einträge speichern (INSERT)
    - Daten auslesen (SELECLT - LEFT JOIN, z.B. Buch mit Autor)
    - Daten per JSON an JavaScript zurückgeben (für AJAX)
    - Daten filtern oder suchen


## Frontend

### HTML
- Struktur der Seiten (Suchfeld, Tabelle, Buttons, Navigation)

### Bootstrap
- Grid System für responsive Layouts
- vorgefertigte UI-Komponenten
- CSS-Hilfsklassen um Design zu vereinfachen
- Bootstrap anpassen für individuelles Design:
    - Klassen mit eigenem CSS überschreiben (z.B. btn-primary)
    - Farben, Fonts usw anpassen mit eigenen CSS-Regeln oder Bootstrap-Variablen


## Interaktivität
(JavaScript + jQuery + AJAX)

### jQuery
- DOM-Elemente auslesen und darauf reagieren (z.B. Klick auf Button) 
→ DOM = Document Object Model, strukturierte Darstellung einer HTML-Seite in JavaScript / die HTML-Elemente, die man mit JavaScript bearbeiten kann

### AJAX
- Daten vom PHP-Backend asynchron nachladen, ohne Seite neu zu laden
- Ideal für:
    - Filterfunktion
    - Live Suche
    - Seiteninhalte dynamisch laden (z.B. Bücherliste aktualisieren nach Filter)
- → AJAX-basiertes dynamisches Nachladen


# Ablauf
## Benutzeroberfläche 
- Suchfeld (HTML + Bootstrap)
- Filter-Dropdowns (z.B. Genre, Autor)
- Ergebnisliste (Bootstrap Cards oder Tabelle)
- Button "Neues Buch hinzufügen" → öffnet Formular in Modal

## Codefluss
1. User wählt Filter → ``onChange`` in JavaScript
2. AJAX-Call an PHP → ``filter_books.php``
3. PHP fragt SQL-Datenbank ab mit WHERE-Klausel
4. PHP liefert JSON zurück
5. JavaScript rendert Bücher neu auf der Seite