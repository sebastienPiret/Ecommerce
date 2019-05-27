#####################
Projet Web: Ecommerce
#####################

Il s'agissait donc de développer un site ecommerce.
Le thème choisit est centré autours de la pâte à pain (pizzas, pains, burgers...).



*******************
Server Requirements
*******************

PHP version 5.6 or newer is recommended.
Il y a cependant certain bug avec php 7 (deprecated function).
Le serveur local utilisé est wamp, je n'ai pas testé avec d'autres.


************
Installation
************

Il faut gitClone le dossier présent à cette adresse:
https://github.com/sebastienPiret/Ecommerce
El le placer dans le répertoire correspondant à votre serveur local.

Le site est ensuite disponible simplement sur: http://localhost/ECommerce/
Et la page d'administration: http://localhost/ECommerce/index.php/admin
Pour se logger en admin, utilisez l'adresse mail@mail.com, et le mot de passe: mdp
Ce login fonctionne également pour interagir dans le site public.

Afin de tester les envois de mail, j'ai utilisé sendmail for gmail, disponible à cette adresse:
https://technology.siprep.org/configuring-sendmail-for-gmail-on-a-wamp-server/
L'installation se fait assez facilement en suivant leurs indications.



Dans la hiérarchie du dossier Git se trouve un dossier "examen", dans lequel se trouve quelques documents,
ainsi que le fichier ecommerce.sql à executer dans votre moteur de db.
Il y a également un dossier image, dans lequel se trouve qqes exemples d'images pour tester l'upload de fichiers
dans le panneau admin.

*******
License
*******

CodeIgniter: Please see the `license
agreement <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst>`_.

Deux templates ont été utilisé.
Pour le design du site:
https://colorlib.com/wp/template/bakery/
Pour le design du panneau d'admin:
https://startbootstrap.com/themes/sb-admin-2/

*********
Resources
*********

-  `User Guide <https://codeigniter.com/docs>`_
-  `Language File Translations <https://github.com/bcit-ci/codeigniter3-translations>`_
-  `Community Forums <http://forum.codeigniter.com/>`_
-  `Community Wiki <https://github.com/bcit-ci/CodeIgniter/wiki>`_
-  `Community Slack Channel <https://codeigniterchat.slack.com>`_

Report security issues to our `Security Panel <mailto:security@codeigniter.com>`_
or via our `page on HackerOne <https://hackerone.com/codeigniter>`_, thank you.

***************
Acknowledgement
***************

The CodeIgniter team would like to thank EllisLab, all the
contributors to the CodeIgniter project and you, the CodeIgniter user.
