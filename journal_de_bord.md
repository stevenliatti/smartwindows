# Smart Windows - Journal de bord

#### 29.08.2016
Nous avons fait une ébauche de notre projet, réalisé la présentation powerpoint
avec le schéma de situation et avons mis en place notre repository git pour se partager
les fichiers et avoir un suivi de notre projet. Nous avons exploré les commandes git.

#### 30.08.2016
Le matin était dédié aux présentations initiales.
Orphée et Raed ont réussi à se connecter au sensor tag via la waspmote et ont tenté de
de récupérer la valeur de température, sans succès pour le moment.
Steven a commencé à lire des tutoriels sur les sockets en php, pour le serveur web qui
récupérera les données de la waspmote.
(http://www.binarytides.com/php-socket-programming-tutorial/)

#### 31.08.2016
Orphée et Raed ont continué à bosser sur la récupération des valeurs des capteurs :
ils ont réussi à capturer la température et la luminosité via la méthode de notifications et
à convertir les données hexadécimales en résultats exploitables (shift et ou bit à bit).
Steven a continué à explorer les sockets en php, plusieurs méthodes seraient envisageables.
On a configuré un Wifly sur la gateway de la salle, on pourra l'utiliser pour envoyer les
données de la waspmote. Il communique en UART avec celle-ci.
Demain on essayera de trouver le moyen pour que ces deux modules communiquent (waspmote et
wifly).

#### 01.09.2016
Nous avons passé la journée à faire marcher la communication UART. Nous avons enfin un code
qui permet d'écrire sur les port UART. On arrive à récupérer les data depuis un ordi via le
Wifly branché sur les ports UART de la Waspmote. Nous sommes heureux mais fatigués. :-)
Demain nous allons faire la fusion des codes de bluetooth et UART.

#### 02.09.2016
Ce matin nous avons réussi à envoyer une requête cliente (phpmanual/client.php) au Wifly
(Steven) pour récupérer des données formatées (Orphée : température et luminosité) : ce
n'était pas du tout optimal, nous avions les données comme sur putty, mais on arrivait au
timeout de la page. En attendant, Raed a pris en main CakePHP et a généré deux vues à partir
des tables de data et des users en base de données. L'après-midi, Orphée a réussi à lire les
données de deux sensors tag (températures internes et externes). En fin de journée, nous
avons enfin réussi à créer un socket server en python, pour lire les données envoyées depuis
le Wifly.

#### 05.09.2016
Steven a bricolé avec l'électronique : plusieurs allers-retours au LSN pour récupérer du
matériel (bargraph, résistances, etc.) et mettre en place LED et bargraph (ponts ont servi à
rien).
Orphée a amélioré le code de la waspmote : moyenne des notifications, ouverture et fermeture
de la fenêtre (LED).
Raed a fait un super boulot sur le code python pour récupérer les valeurs et enregistrer en
base de données.

#### 06.09.2016
Orphée a fait du super boulot sur l'ouverture des fenêtres et stores (représentés par la led
et le bargraph). En fin de journée, il a écrit un code qui ouvre les stores selon la
luminosité ambiante.
Raed a continué à bosser sur le socket en python : on utilise les threads pour en parallèle
lire les données provenant de la waspmote et de l'autre lui communiquer l'ouverture et
fermeture des fenêtres.
Steven a continué la partie électronique : nous avons maintenant un montage fonctionel. Il a
aidé Raed pour les threads et Orphée pour le code waspmote.

#### 07.09.2016
Nous avons mis en place l'anémomètre : nous pouvons maintenant avoir la vitesse du vent. Mode
auto/manuel implémenté. Voir [commits d'Orphée](https://githepia.hesge.ch/ors/smartwindows/commit/c863334967cf3bde06c91d5ed83bab56d2bf5323) du jour.
Nous avons aussi modifié le code python : il fonctionne maintenant en 2 threads, avec partage
de données grâce à une Queue.
Steven : j'ai commencé à chercher me documenter sur CakePHP et à chercher des solutions
javascript pour ploter nos données.

#### 08.09.2016
On a continué le code python pour recevoir les données : on réceptionne comme il faut toutes
les données, chacune a un identifiant. Il faudra juste revoir l'envoi continu de infos sur le
mode et les états. On a configuré le Raspberry aussi, a tester à l'hepia.

#### 09.09.2016
On a créé une table d'état en base de données + relation tables + amélioration structure
tables. Ajout d'une fonction en python pour sauvegarder les états en base de données.
On a configuré le Raspberry Pi, le serveur python et MySQL fonctionnent.
On commencé à prendre en main Chart.js pour les graphiques en javascript.
Début de lecture de tutos sur KiCad pour réaliser les schémas électriques du système pour
le rapport.

#### 12.09.2016
On a mis en place une page Ajax pour envoyer des contrôles à la waspmote (test_ajax).
On a fait la liaison python-waspmote pour modifier les états et la configuration. Nous 
avons adapté le code de la waspmote pour recevoir ces commandes. On a réalisé le schéma 
électrique avec KiCad. On a récupéré et ploté des données avec Chart.js.

#### 13.09.2016
On a abandonné Ajax pour le formulaire de configuration Web-> form html classique.
Du coup on a une page php qui permet de voir l'état actuel du système, de changer le mode 
(auto/manuel) et l'ouverture des stores et fenêtre. On charge et enregistre les changements vers et
depuis la base de données. On envoit les commandes manuelles à python via un socket php. 
Il manque seulement à finir le socket python qui écoute le serveur php. 
Côté chart.js, les graphiques avancent super, on affiche les températures, la luminosité et 
la vitesse du vent en fonction des données en base. Des fonctions javascript sont 
là pour choisir la période temporelle d'affichage. 
Début d'études sur bootstrap CSS, pour avoir un design de ouf. Plusieurs pages ont été codées, 
ainsi qu'un menu responsive qui déchire.

#### 14.09.2016
Nous nous sommes arrachés les cheveux à faire cohabiter l'envoi et la réception de données
en python (voir commits du jour). Finalement, nous lisons les données sur la base de donées 
en python plutôt que de les écouter via un socket relié au serveur web.
Nous avons continué les graphiques avec Chart.js et avons commencé des pages de 
connexion/gestion des users. Il faut qu'on se grouille !