DROP DATABASE IF EXISTS ecommerce;
CREATE DATABASE ecommerce CHARACTER SET 'utf8';
USE ecommerce;

DROP TABLE IF EXISTS role;
CREATE TABLE IF NOT EXISTS role
	(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50))ENGINE=INNODB;

INSERT INTO role VALUES (1,'visitor'),(2, 'customer'),(3, 'admin');  

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
    ('7100','LaLouvière'),
    ('7000','Mons');
 
 DROP TABLE IF EXISTS utilisateur;
 CREATE TABLE IF NOT EXISTS utilisateur
	(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nom VARCHAR(100),
    prenom VARCHAR(100) NULL,
    mail VARCHAR(150) NOT NULL UNIQUE,
    adress INT NULL,
    city INT NULL,
    mdp VARCHAR(100) NOT NULL,
    link VARCHAR(22),
    role INT DEFAULT 1,
    FOREIGN KEY (adress) REFERENCES adress(id),
    FOREIGN KEY (city) REFERENCES cities(id),
    FOREIGN KEY (role) REFERENCES role(id))ENGINE=INNODB;
    
INSERT INTO utilisateur (nom,prenom,mail,adress,city,mdp,role) VALUES
	('Piret','Sebastien','sebquadris@gmail.com',2,1,'4b59e8216b8799816c3766587207846522f59f400c74ee0d0a68a45e',3),
    ('Bruynbroeck','françois','mail@mail.com',6,3,'4b59e8216b8799816c3766587207846522f59f400c74ee0d0a68a45e',3);

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
    description TEXT,
    FOREIGN KEY (categorie) REFERENCES categories(id))ENGINE=INNODB;

INSERT INTO item (nom,price,categorie,description) VALUES
	('4 fromages',10.0,1,"La pizza ai quattro formaggi si realizza stendendo la pasta sulla spianatoia in una sfoglia sottile per poi disporla in una teglia oliata.");


INSERT INTO item (nom,price,categorie,path,description) VALUES
    ('margherita',8.0,1,'margherita.jpg',"La pizza Margherita est le nom d'une spécialité culinaire traditionnelle de la ville de Naples en Italie. 
    Très populaire, cette pizza napoletana est garnie de tomates, de mozzarella, de basilic frais, de sel et d'huile d'olive."),
    ('Napolitaine',10.0,1,'napolitaine.jpg',"Excellence gastronomique célèbre dans le monde entier, la vraie pizza napolitaine possède une histoire qui en a fait une véritable icône du goût Made in Italy."),
    ('Quattro stagioni',11.0,1,'4saisons.jpg',"La pizza quatre saisons est une variété de pizza préparée en quatre portions comportant des ingrédients différents, chaque portion représentant une saison de l'année. "),
    ('mare nostrum',14.0,1,'fruitmer.jpg',"La pizza ai frutti di mare è sicuramente una delle pizze con il pesce più richieste in pizzeria."),
    ('carré blanc',2.15,2,'carreBlanc.jpg',"Pain carré , mie douce et une croûte fine. Idéal pour ceux qui cherchent un pain accessible pour toute la famille."),
    ('carré gris',2.15,2,'carreGris.jpg',"le pain gris qui y est associé est plutôt synonyme de pain du pauvre et de pain des temps difficiles..."),
    ('campagnard',2.5,2,'painCampagne.jpg',"Le pain de campagne est l'appellation donnée à certains types de pains de fabrication courante, censés posséder le goût des campagnes d'autrefois"),
    ('traditionnel',2.5,2,'painTradi.jpg',"Le pain traditionnel est donc la véritable baguette artisanale qui fait appel au savoir-faire du boulanger."),
    ('beef burger',5.0,3,'hamburger.jpg',"Un hamburger est un sandwich d'origine allemande, composé de deux pains de forme ronde généralement garnis de steak haché et de crudités, salade, tomate, oignon, cornichon, de fromage, et de sauce."),
    ('cheese burger',6.0,3,'cheeseBurger.jpg',"Un cheeseburger ou hamburger au fromage est un hamburger dans lequel une tranche de fromage accompagne la viande. "),
    ('double cheese burger',7.5,3,'doubleCheese.jpg',"Un pain rond et moelleux, deux steaks hachés, une tranche de cornichon, des oignons et surtout : deux tranches de Cheddar fondu pour un burger deux fois plus irrésistible !"),
    ('giant',8.0,3,'giant.jpg',"Rendu célèbre grâce à sa sauce Giant inimitable, à base de mayonnaise, de ketchup et de notes de câpres. "),
    ('croissant',1.5,4,'croissant.jpg',"Un croissant est une viennoiserie à base d'une pâte levée feuilletée spécifique, la pâte à croissant, qui comporte de la levure et une proportion importante de beurre. "),
    ('pain au chocolat',1.5,4,'painChocolat.jpg',"Le pain au chocolat, chocolatine ou couque au chocolat est une viennoiserie constituée d'une pâte levée feuilletée, identique à celle du croissant, rectangulaire et enroulée sur une ou plusieurs barres de chocolat. ");
    
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
    Total float(10,2) NOT NULL,
    created datetime NOT NULL,
	modified datetime NOT NULL,
    FOREIGN KEY (utilisateur) REFERENCES utilisateur(id),
    FOREIGN KEY (statut) REFERENCES statut(id))ENGINE=INNODB;
    
DROP TABLE IF EXISTS commande_item;
CREATE TABLE IF NOT EXISTS commande_item
	(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    commande_ID INT NOT NULL,
    item_ID INT NOT NULL,
    subTotal float(10,2) NOT NULL,
    quantity INT unsigned NOT NULL,
    FOREIGN KEY (item_ID) REFERENCES item(id),
    FOREIGN KEY (commande_ID) REFERENCES commande(id))ENGINE=INNODB;

SET SQL_SAFE_UPDATES = 0;
UPDATE cities SET city = LOWER(city) ;
UPDATE adress SET street = LOWER(street);

-- https://jcrozier.developpez.com/articles/web/panier/
