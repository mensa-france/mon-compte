mon-compte
==========
Prérequis
---------
L'environnement de développement requiert les logiciels suivants:

* [Node.js](http://nodejs.org/)
  * [coffee-script](http://coffeescript.org/)
  * [grunt-cli](http://gruntjs.com/)
  * [bower](http://bower.io/)
* [Compass](http://compass-style.org/)
* [php](http://www.php.net/) et php-cgi
* [composer](https://getcomposer.org/)
* [mysql](http://www.mysql.fr/) ou [MariaDb](https://mariadb.org/)

### OSX
* Installer [Node.js](http://nodejs.org/) et les paquets associés
  * Installer [Homebrew](http://brew.sh/)
    * Dans le terminal, lancer la commande suivante : `ruby -e "$(curl -fsSL https://raw.github.com/Homebrew/homebrew/go/install)"`
    * Installer les outils de développement en ligne de commande de Xcode si jamais cela vous est demandé.
    * Vérifiez la bonne installation de homebrew avec la commande : `brew doctor`
    * Corrigez ce qui doit l'être le cas échéant.
  * Installez les paquets npm requis avec la commande : `npm install -g coffee-script grunt-cli bower`
* Installer [Compass](http://compass-style.org/)
  * Lancez la commande : `sudo gem install compass`
* Installer [MAMP](http://www.mamp.info/)
  * Récupérez et exécutez l'installeur depuis [la page de téléchargement](http://www.mamp.info/en/downloads/).
  * Ajoutez les commandes php dans votre PATH avec la commande : `echo -e "\nexport PHP_HOME=/Applications/MAMP/bin/php/php5.4.26\nexport PATH=\$PHP_HOME/bin:\$PATH\n" >> ~/.bash_profile`
  * Activez l'affichage des erreurs php en éditant le fichier `/Applications/MAMP/bin/php/php5.4.26/conf/php.ini`
    * Changez les valeurs suivantes :
      * `display_errors = On`
      * `display_startup_errors = On`
* Installer [Composer](https://getcomposer.org/)
  * Lancez les commandes suivantes :
    * `mkdir ~/.bin`
    * `curl -sS https://getcomposer.org/installer | php -- --install-dir=$HOME/.bin`
    * `echo -e "\nexport PATH=\$HOME/.bin:\$PATH\n" >> ~/.bash_profile`
* Mettez à jour votre environnement courant avec la commande : `source ~/.bash_profile`

### Linux
* Utilisez le gestionnaire de paquet de votre distrib pour installer node.js, ruby gems, php 5.4 (avec php-cgi) et mysql.
* Installer les paquets npm requis : `sudo npm install -g coffee-script grunt-cli bower`
* Installer [Compass](http://compass-style.org/)
  * Lancez la commande : `sudo gem install compass`
* Installer [Composer](https://getcomposer.org/)
  * Suivez [les instructions officielles](https://getcomposer.org/download/).
  * Ajoutez le script (`composer.phar`) à votre PATH.

### Windows
* Installez Linux ;-)
  * [Ubuntu](http://www.ubuntu.com/)
  * [Ubuntu Gnome](http://ubuntugnome.org/)
  * [Debian](https://www.debian.org/)

*Plus sérieusement, si quelqu'un utilise Windows et arrive à tout installer, merci de renseigner cette section.*

*Cela dit, envisagez quand même linux ;-)*

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
   * `composer.phar install`
3. Dans le dossier `config`
   * Copiez `auth-user.json.dist` en `auth-user.json`
   * Copiez `local_doctrine.php.dist` en `local_doctrine.php`
   * Modifier les valeurs pertinentes dans les copies des fichiers précédents.

Pour démarrer le serveur de dev, il suffit alors de lancer dans le dossier du projer la commande `grunt server`.

Celui-ci supporte le live reload lorsque les fichiers du projet sont modifiés.

Pour simuler l'authentification Lemonldap, modifiez le userId contenu dans le fichier `auth-user.json`.
Celui-ci est rechargé à chaque requête, vous pouvez donc le modifier sans relancer le serveur.

License
-------
Mon-compte est distribué sous [licence publique générale GNU v2](http://www.gnu.org/licenses/gpl-2.0.html) ou supérieure.

