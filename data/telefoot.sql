CREATE DATABASE telefoot;

USE telefoot;

CREATE TABLE users (
                       id SMALLINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
                       username VARCHAR(128) NOT NULL,
                       email VARCHAR(128) NOT NULL,
                       password VARCHAR(128) NOT NULL
);

CREATE TABLE reset (
                       id SMALLINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
                       email VARCHAR(128) NOT NULL,
                       selector VARCHAR(128) NOT NULL,
                       token VARCHAR(255) NOT NULL,
                       expire VARCHAR(128) NOT NULL
);

CREATE TABLE channel (
                         id SMALLINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
                         name VARCHAR(128) NOT NULL,
                         image VARCHAR(255) NOT NULL
);

CREATE TABLE replay (
                        id SMALLINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
                        name VARCHAR(128) NOT NULL,
                        image VARCHAR(255) NOT NULL
);

CREATE TABLE clubs (
                       id SMALLINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
                       name VARCHAR(128) NOT NULL,
                       image VARCHAR(255) NOT NULL,
                       category VARCHAR(128)
);

INSERT INTO channel (name, image) VALUES
                                      ("Téléfoot Stadium 1", "telefootstadium1.webp"),
                                      ("Téléfoot Stadium 2", "telefootstadium2.webp"),
                                      ("Téléfoot Stadium 3", "telefootstadium3.webp"),
                                      ("Téléfoot Stadium 4", "telefootstadium4.webp"),
                                      ("Téléfoot Stadium 5", "telefootstadium5.webp"),
                                      ("Téléfoot Stadium 6", "telefootstadium6.webp");

INSERT INTO replay (name, image) VALUES
                                     ("Ligue 1", "matchs-ligue-1.webp"),
                                     ("Ligue 2", "matchs-ligue-2.webp"),
                                     ("Champions League", "matchs-champions-league.webp"),
                                     ("Europa League", "matchs-europa-league.webp");

INSERT INTO clubs (name, image, category) VALUES
                                              ("ajaccio", "ajaccio.png", "ligue 2"),
                                              ("amiens", "amiens.png", "ligue 2"),
                                              ("angers", "angers.png", "ligue 1"),
                                              ("asse", "asse.png", "ligue 1"),
                                              ("auxerre", "auxerre.png", "ligue 1"),
                                              ("bordeaux", "bordeaux.png", "ligue 1"),
                                              ("brest", "brest.png", "ligue 1"),
                                              ("caen", "caen.png", "ligue 2"),
                                              ("chambly", "chambly.png", "ligue 2"),
                                              ("chateauroux", "chateauroux.png", "ligue 2"),
                                              ("clermont", "clermont.png", "ligue 2"),
                                              ("dijon", "dijon.png", "ligue 1"),
                                              ("dunkerque", "dunkerque.png", "ligue 2"),
                                              ("grenoble", "grenoble.png", "ligue 2"),
                                              ("guingamp", "guingamp.png", "ligue 2"),
                                              ("havre", "havre.png", "ligue 2"),
                                              ("lens", "lens.png", "ligue 1"),
                                              ("lorient", "lorient.png", "ligue 1"),
                                              ("losc", "losc.png", "ligue 1"),
                                              ("metz", "metz.png", "ligue 1"),
                                              ("monaco", "monaco.png", "ligue 1"),
                                              ("montpellier", "montpellier.png", "ligue 1"),
                                              ("nancy", "nancy.png", "ligue 2"),
                                              ("nantes", "nantes.png", "ligue 1"),
                                              ("nice", "nice.png", "ligue 1"),
                                              ("nimes", "nimes.png", "ligue 1"),
                                              ("niort", "niort.png", "ligue 2"),
                                              ("ol", "ol.png", "ligue 1"),
                                              ("om", "om.png", "ligue 1"),
                                              ("paris", "paris.png", "ligue 2"),
                                              ("pau", "pau.png", "ligue 2"),
                                              ("rodez", "rodez.png", "ligue 2");

ALTER TABLE channel RENAME TO channels;