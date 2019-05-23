DROP DATABASE IF EXISTS ecommerce;
CREATE DATABASE ecommerce CHARACTER SET 'utf8';
USE ecommerce;

DROP TABLE IF EXISTS role;
CREATE TABLE IF NOT EXISTS role
	(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(50))ENGINE=INNODB;

INSERT INTO role VALUES (1, 'customer'),(2, 'admin');  

DROP TABLE IF EXISTS adress;
CREATE TABLE IF NOT EXISTS adress
	(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    street VARCHAR(250) NOT NULL,
    numero VARCHAR(5) NOT NULL)ENGINE=INNODB;
    
INSERT INTO adress (street,numero) VALUES
	('rue des Monts','14'),
    ('Chemin Vert','58'),
    ('rue de Mencon','56'),
    ('rue de Mencon','34'),
    ('rue de bien','2'),
    ('rue paul Pastur','5');
 
DROP TABLE IF EXISTS cities;
CREATE TABLE IF NOT EXISTS cities
	(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    postal CHAR(4) NOT NULL,
    city VARCHAR(50))ENGINE=INNODB;

INSERT INTO cities (postal,city) VALUES
	('6120','Nalinnes'),
    ('6000','CHarleroi'),
    ('7100','Mons');
 
 DROP TABLE IF EXISTS utilisateur;
 CREATE TABLE IF NOT EXISTS utilisateur
	(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nom VARCHAR(100),
    prenom VARCHAR(100) NULL,
    mail VARCHAR(150) NOT NULL UNIQUE,
    adress INT NULL,
    city INT NULL,
    login VARCHAR(100) UNIQUE NOT NULL,
    mdp VARCHAR(100) NOT NULL,
    role INT DEFAULT 1,
    FOREIGN KEY (adress) REFERENCES adress(id),
    FOREIGN KEY (city) REFERENCES cities(id),
    FOREIGN KEY (role) REFERENCES role(id))ENGINE=INNODB;
    
INSERT INTO utilisateur (nom,prenom,mail,adress,city,login,mdp,role) VALUES
	('Piret','Sebastien','sebpiret@gmail.com',2,1,'login','mdp',2);

DROP TABLE IF EXISTS categories;
CREATE TABLE IF NOT EXISTS categories
	(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nom VARCHAR(100))ENGINE=INNODB;

INSERT INTO categories (nom) VALUES
	('pizzas'),('pains'),('burgers'),('viennoiseries');

DROP TABLE IF EXISTS item;
CREATE TABLE IF NOT EXISTS item
	(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nom VARCHAR(150) ,
    price FLOAT unsigned,
    path VARCHAR(200) DEFAULT 'no.png',
    categorie INT,
    FOREIGN KEY (categorie) REFERENCES categories(id))ENGINE=INNODB;

INSERT INTO item (nom,price,categorie) VALUES
	('4 fromages',10.0,1);


INSERT INTO item (nom,price,categorie,path) VALUES
    ('margherita',8.0,1,'margherita.jpg'),
    ('Napolitaine',10.0,1,'napolitaine.jpg'),
    ('Quattro stagioni',11.0,1,'4saisons.jpg'),
    ('mare nostrum',14.0,1,'fruitmer.jpg'),
    ('carré blanc',2.15,2,'carreBlanc.jpg'),
    ('carré gris',2.15,2,'carreGris.jpg'),
    ('campagnard',2.5,2,'painCampagne.jpg'),
    ('traditionnel',2.5,2,'painTradi.jpg'),
    ('beef burger',5.0,3,'hamburger.jpg'),
    ('cheese burger',6.0,3,'cheeseBurger.jpg'),
    ('double cheese burger',7.5,3,'doubleCheese.jpg'),
    ('giant',8.0,3,'giant.jpg'),
    ('croissant',1.5,4,'croissant.jpg'),
    ('pain au chocolat',1.5,4,'painChocolat.jpg');
    
DROP TABLE IF EXISTS statut;
CREATE TABLE IF NOT EXISTS statut
	(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nom VARCHAR(100))ENGINE=INNODB;

INSERT INTO statut (id,nom) VALUES
	(1,'En attente'),
    (2,'accepté'),
    (3,'refusé');
 
 DROP TABLE IF EXISTS commande;
 CREATE TABLE IF NOT EXISTS commande
	(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    utilisateur INT NOT NULL,
    statut INT DEFAULT 1,
    date_commande DATETIME,
    FOREIGN KEY (utilisateur) REFERENCES utilisateur(id),
    FOREIGN KEY (statut) REFERENCES statut(id))ENGINE=INNODB;

INSERT INTO commande (utilisateur,date_commande) VALUES
	(1,now());
    
DROP TABLE IF EXISTS commande_validee;
CREATE TABLE IF NOT EXISTS commande_validee
	(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    commande INT NOT NULL,
    item INT NOT NULL,
    price float NOT NULL,
    quantity INT unsigned DEFAULT 1,
    FOREIGN KEY (commande) REFERENCES commande(id),
    FOREIGN KEY (item) REFERENCES item(id))ENGINE=INNODB;

SET SQL_SAFE_UPDATES = 0;
UPDATE cities SET city = LOWER(city) ;
UPDATE adress SET street = LOWER(street);

-- https://jcrozier.developpez.com/articles/web/panier/
