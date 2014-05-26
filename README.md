mon-compte
==========
Prérequis
---------
L'environnement de développement requiert les logiciels suivants:

* Node.js
  * coffee-script
  * grunt-cli
  * bower
* php et php-cgi
* mysql

### OSX
* Installer [Node.js](http://nodejs.org/) et les paquets associés
  * Installer [Homebrew](http://brew.sh/)
    * Dans le terminal, lancer la commande suivante : `ruby -e "$(curl -fsSL https://raw.github.com/Homebrew/homebrew/go/install)"`
    * Installer les outils de développement en ligne de commande de Xcode si jamais cela vous est demandé.
    * Vérifiez la bonne installation de homebrew avec la commande : `brew doctor`
    * Corrigez ce qui doit l'être le cas échéant.
  * Installez les paquets npm requis avec la commande : `npm install -g coffee-script grunt-cli bower`
* Installer [MAMP](http://www.mamp.info/)
  * Récupérer et exécuter l'installeur depuis [la page de téléchargement](http://www.mamp.info/en/downloads/).
  * Ajoutez les commandes php dans votre PATH avec la commande : `echo -e "export PHP_HOME=/Applications/MAMP/bin/php/php5.4.26\nexport PATH=$PHP_HOME/bin:$PATH" >> ~/.bash_profile`
  * Mettez à jour votre environnement courant avec la commande : `source ~/.bash_profile`

### Linux
* Utilisez le gestionnaire de paquet de votre distrib pour installer node.js, php 5.4 (avec php-cgi) et mysql.
* Installer les paquets npm requis : `sudo npm install -g coffee-script grunt-cli bower`

### Windows
* Installez Linux ;-)

Recommandations optionnelles
----------------------------
* [GitX-dev](http://rowanj.github.io/gitx/)
* [gitg](https://wiki.gnome.org/action/show/Apps/Gitg?action=show)
* [Sublime Text](http://www.sublimetext.com/)
* [Atom](https://atom.io/)

Mise en place du projet
-----------------------
1. Cloner le dépôt du projet.
2. Dans le dossier du projet, lancer les commandes suivantes :
   * `npm install`
   * `bower install`
3. *### ici ajouter la création de la base et du fichier de conf php ###*

Pour démarrer le serveur de dev, il suffit alors de lancer dans le dossier du projer la commande `grunt server`.

Celui-ci support le live reload lorsque les fichiers du projet sont modifiés.

Licence
-------
Mon-compte est distribué sous [licence publique générale GNU v2](http://www.gnu.org/licenses/gpl-2.0.html) ou supérieure.

