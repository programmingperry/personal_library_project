---
title: Seitenaufbau Bücherprojekt
started: 30/06/25
---
#coding #bfw #buecherprojekt

# Seitenaufbau Bücherverwaltung
## Hauptseite
Auf jeder Seite gleich:
### Menü
- [ ] Home
- [ ] Buch hinzufügen 
- [ ] Buchübersicht 
- [ ] Statistiken
- [ ] TBR Liste
- [ ] Suche

### Inhalte nachladen:
- [ ] Startseite
    - [ ] currently reading view (alle Bücher)
    - [ ] kürzlich gelesen (5 Bücher oder so)
    - [ ] TBR (5 Bücher oder so)
- [ ] Buchanzeige
    - [ ] Buch bearbeiten
- [ ] Statistiken und Filter

## Funktionen und Formulare
- [ ] Buch hinzufügen
- [ ] bestehendes Buch bearbeiten (vorhandene Informationen in neues Formular übernehmen?)

# Files in VSC
## Includes / Partials
- nav.php 
- db.php (Verbindung zur Datenbank mit PDO)
- functions.php (wiederverwendbare Funktionen: Bücher laden, speichern, suchen, etc.)
- head.html (Meta Tags)
- footer.php 

## Seiten
- index.php → Hauptseite zum Nachladen der Inhalte
- bookoverview.php → Übersicht aller Bücher mit Filter und Suchfunktion
- addbook.php → Formular um Buch hinzuzufügen
- editbook.php → Formular um vorhandenes Buch zu bearbeiten (vorhandene Informationen in Formular laden übernehmen)
- viewbook.php → Anzeige eines Buches

**Optional!** 
- statistik.php → Seite zum Anzeigen und Filtern der Statistiken (mit Charts und Diagrammen...)


## AJAX
- z.B. ajax_handler.php (Reaktion auf Anfragen von jQuery ajax() - z.B. Buch löschen, Suche, Filter)


# PHP Funktionen und Struktur
## Datenbank
- Datenbank Verbindung
- SQL Abfragen?

## 