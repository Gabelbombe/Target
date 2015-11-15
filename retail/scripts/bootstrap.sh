#!/usr/bin/env bash

## Can also be passed via ARGV[0]
DBHOST='localhost'
DBUSER='retailuser'
DBPASS='retailpass'
DBNAME='retail'

DOCROOT='/var/www/html'

# Set Perl:locales
# http://serverfault.com/questions/500764/dpkg-reconfigure-unable-to-re-open-stdin-no-file-or-directory
# --------------------
export LANGUAGE=en_US.UTF-8
export LANG=en_US.UTF-8
export LC_ALL=en_US.UTF-8
locale-gen en_US.UTF-8
dpkg-reconfigure locales

export DEBIAN_FRONTEND=noninteractive

# Update Apt
# --------------------
apt-get update

# Install Apache & PHP
# --------------------
apt-get install -y apache2
apt-get install -y php5
apt-get install -y libapache2-mod-php5
apt-get install -y php5-mysqlnd php5-curl php5-xdebug php5-gd php5-intl php-pear php5-imap php5-mcrypt php5-ming php5-ps php5-pspell php5-recode php5-sqlite php5-tidy php5-xmlrpc php5-xsl php-soap

php5enmod mcrypt

# Install GIT
apt-get install -y git

# Delete default apache web dir and symlink mounted vagrant dir from host machine
# --------------------
rm -rf $DOCROOT ; mkdir -p /vagrant/httpdocs
ln -fs /vagrant/httpdocs $DOCROOT

# Replace contents of default Apache vhost
# --------------------
VHOST=$(cat <<EOF
Listen 8080
<VirtualHost *:80>
  DocumentRoot "$DOCROOT/public"
  ServerName localhost
  SetEnv APP_PATH $DOCROOT
  <Directory "$DOCROOT">
    AllowOverride All
  </Directory>
</VirtualHost>
<VirtualHost *:8080>
  DocumentRoot "$DOCROOT/public"
  ServerName localhost
  SetEnv APP_PATH $DOCROOT
  <Directory "$DOCROOT/public">
    AllowOverride All
  </Directory>
</VirtualHost>
EOF
)

echo "$VHOST" > /etc/apache2/sites-enabled/000-default.conf

a2enmod rewrite
service apache2 restart

# Mysql
# --------------------


# Install MySQL quietly
echo -e '--> Installing Mysql 5.6'
apt-get -q -y install mysql-server-5.6
mysql -u root -e "CREATE DATABASE IF NOT EXISTS ${DBNAME}"

mysql -u root -e "
DROP TABLE IF EXISTS \`${DBNAME}\`.\`products\` ;
CREATE TABLE \`${DBNAME}\`.\`products\` (
  \`id\`                  bigint(20)    NOT NULL AUTO_INCREMENT,
  \`title\`               varchar(50)   DEFAULT NULL,
  \`blurb\`               varchar(50)   DEFAULT NULL,
  \`description\`         varchar(255)  DEFAULT NULL,
  \`price\`               decimal(10,2) DEFAULT NULL,
  \`features\`            blob          DEFAULT NULL,
  PRIMARY KEY (\`id\`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8"

mysql -u root -e "
LOCK TABLES \`${DBNAME}\`.\`products\` WRITE ;
INSERT INTO \`${DBNAME}\`.\`products\` VALUES
  (
    1,
    'Pencil',
    'It\'s orange and slightly chewed on.',
    'Great tools inspire great ideas. Pencil by Jd is the most natural and expressive way to create on paper. Advanced technology meets beautiful design to keep you in the flow, without needing to switch to a pen. With Surface Pressure, Erase, Blend, and adaptive Palm Rejection (accidently dropping it), Pencil puts creative possibility in your hands.',
    0.25,
    '[\"It\'s Orange\",\"Slightly chewed on but still good\",\"Unlike the pen, you can write upside-down\",\"Prone to breaking\"]'
  ),

  (
    2,
    'Eraser',
    'It erases supposedly, goes well with you pencil.',
    'It leaves no marks behind and will remove some of the hardest pencil marks. you will definitely want four - if you only have one, you will be rue the day you get caught without it or leave it behind.',
    1.99,
    '[\"Goes perfectly with a pencil\",\"Removes markings\",\"Can never be found when you need it\"]'
  ),

  (
    3,
    'Pen',
    'Some say, it\'s mightier than the sword.',
    'The Retro 51 Tornado pen isn\'t new, but this Massdrop Custom Edition features a killer body design that you won\'t find anywhere else.',
    2.99,
    '[\"Amazing ability to write upside-down\",\"Never needs sharpening\",\"Last for weeks\",\"Was voted the most likely to be stolen\"]'
  ),

  (
    4,
    'Crayon',
    'Not edible, but dont tell the kids that.',
    'The only downside is that they dont come in an assortment of 72,000 colors and glitters and metallics and stuff. We can live with that.',
    0.35,
    '[\"Not edible\",\"Children like to eat them anyway\",\"Several colors\",\"Rolls\"]'
  ) ;

UNLOCK TABLES ;"
mysql -u root -e "GRANT ALL PRIVILEGES ON ${DBNAME}.* TO '${DBUSER}'@'${DBHOST}' IDENTIFIED BY '${DBPASS}'"
mysql -u root -e "FLUSH PRIVILEGES"

# Framework
# --------------------
curl -sS https://getcomposer.org/installer |sudo php -- --install-dir=/usr/local/bin --filename=composer

cd $DOCROOT ; echo -e '
{
  "name": "ehime/retail",
  "description": "Simple storefront",
  "keywords":    ["storefront", "vagrant", "aio"],
  "version":     "1.0.0",
  "type":        "library",
  "license":     "MIT",
  "authors": [
    {
      "name": "Jd Daniel",
      "email": "dodomeki@gmail.com"
    }
  ],
  "minimum-stability": "dev",
  "require": {
    "slim/slim": "2.*",
    "slimcontroller/slimcontroller": "0.4.3",
    "php":        ">=5.5.0"
  },
  "require-dev": {
    "phpunit/phpunit": "4.3.5",
    "mockery/mockery": "0.8.*"
  },
  "autoload": {
    "psr-0": {
      "Retail":     "src/",
      "Model":      "src/",
      "Controller": "src/",
      "View":       "src/",
      "Helper":     "src/"
    },
    "autoload-dev": {
      "classmap": [
        "tests/"
      ]
    },
    "config": {
      "preferred-install": "dist"
    }
  }
}
' > composer.json

composer install ; ln -fs /vagrant/payload/* $DOCROOT   ## refresh payload, but dont duplicate code...
