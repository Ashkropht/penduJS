DROP DATABASE IF EXISTS pendu;
CREATE DATABASE pendu;
USE pendu;

CREATE TABLE categorie (
    id_categorie int(3) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    libelle_categorie varchar(50)
)ENGINE=InnoDB;

CREATE TABLE mot (
    libelle_mot varchar(25) NOT NULL PRIMARY KEY,
    id_categorie int(3) UNSIGNED NOT NULL,
    FOREIGN KEY(id_categorie) REFERENCES categorie(id_categorie)
)ENGINE=InnoDB;

CREATE TABLE utilisateur (
    id_utilisateur int(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pseudo_utilisateur varchar(50),
    mdp_utilisateur text,
    login_utilisateur varchar(150),
    score_max_utilisateur int(3),
    nb_essai_utilisateur int(5)
)ENGINE=InnoDB;

INSERT INTO categorie (libelle_categorie) VALUES 
("sport"),
("animal"),
("ville"),
("fruit"),
("personnages");

INSERT INTO mot (libelle_mot, id_categorie) VALUES
("Football",1),
("Basketball",1),
("Handball",1),
("Ski de fond",1),
("Equitation",1),
("Alpaga",2),
("Ornithorynque",2),
("Chien",2),
("Loutre",2),
("Chouette",2),
("Charleville-Mezieres",3),
("Paris",3),
("Rome",3),
("Thilay",3),
("Banane",4),
("Grenade",4),
("Durian",4),
("Kiwi",4),
("Jotaro Kujo",5),
("Mario",5),
("Harry Potter",5),
("Dio Brando",5),
("Link",5),
("Ganondorf",5);