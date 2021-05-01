#!/bin/bash -

# Credentials
USERNAME=user   
PASSWORD=apple
DATABASE=users

# Prepare variables
TABLE=$1
SQL_EXISTS=$(printf 'SHOW TABLES LIKE "users"')


#sudo - used to execute command with elevated privileges
#apt - utility for managing packages
#update - updates package index
#upgrade -upgrades system packages
echo updating packages
sudo apt update
sudo apt upgrade

#Following command returns 1 if the specified package is not installed, 0 if it is
#(dpkg-query -W -f='${Status}' apache2 2>/dev/null | grep -c "ok installed")
#-eq = equals

#check if package is installed
if [ $(dpkg-query -W -f='${Status}' apache2 2>/dev/null | grep -c "ok installed") -eq 0 ];
then
    #if package is not installed
    #relay to console that the package is being installed
    echo installing apache2
    #install package
    sudo apt install apache2
fi

#check if package is installed
if [ $(dpkg-query -W -f='${Status}' mysql-server 2>/dev/null | grep -c "ok installed") -eq 0 ];
then
    #if package is not installed
    #relay to console that the package is being installed
    echo installing mysql-server
    #install package
    sudo apt install mysql-server
fi

#check if package is installed
if [ $(dpkg-query -W -f='${Status}' php 2>/dev/null | grep -c "ok installed") -eq 0 ];
then
    #if package is not installed
    #relay to console that the package is being installed
    echo installing php
    #install package
    sudo apt install php
fi

#check if package is installed
if [ $(dpkg-query -W -f='${Status}' libapache2-mod-php 2>/dev/null | grep -c "ok installed") -eq 0 ];
then
    #if package is not installed
    #relay to console that the package is being installed
    echo installing libapache2-mod-php
    #install package
    sudo apt install libapache2-mod-php
fi

#check if package is installed
if [ $(dpkg-query -W -f='${Status}' php-mysql 2>/dev/null | grep -c "ok installed") -eq 0 ];
then
    #if package is not installed
    #relay to console that the package is being installed
    echo installing php-mysql
    #install package
    sudo apt install php-mysql
fi

#check if package is installed
if [ $(dpkg-query -W -f='${Status}' openssh-server 2>/dev/null | grep -c "ok installed") -eq 0 ];
then
    #if package is not installed
    #relay to console that the package is being installed
    echo installing openssh
    #install package
    sudo apt install openssh-server
fi

#check if package is installed
if [ $(dpkg-query -W -f='${Status}' iptables 2>/dev/null | grep -c "ok installed") -eq 0 ];
then
    #if package is not installed
    #relay to console that the package is being installed
    echo installing iptables
    #install package
    sudo apt install iptables
fi

#Apache configuration
sudo ufw allow in "Apache Full"
#Start apache server
sudo service apache2 start

#MySQL configuration
#start the mysql server
sudo /etc/init.d/mysql start
#set mysql root user password
#sudo msyql -e "SET PASSWORD FOR root@localhost = PASSWORD('monkeyICECREAMballoon');FLUSH PRIVILEGES;"
#run initial mysql config sequence
#printf "monkeyICECREAMballoon\n y\n y\n y\n y\n" | 
#sudo mysql_secure_installation


mysql -u root -p$PASSWORD -e 'CREATE USER 'remote_user'@'localhost' IDENTIFIED BY 'Applebanana1!'; GRANT INSERT, SELECT, UPDATE ON users.users TO 'remote_user'@'localhost';'
# Check if table exists
if [[ $(mysql -u $USERNAME -p$PASSWORD -e "$SQL_EXISTS") ]]
then
    echo "Table exists ..."

else
    #
    #mysql -u root -p$PASSWORD 'ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'apple'; flush privileges;'
    echo "Table not exists ...\nCreating Database"
    #Create database
    mysql -u root -p$PASSWORD -e 'CREATE DATABASE users;'
    #Create table
    mysql -u root -p$PASSWORD -e 'USE users; CREATE TABLE users(user_id int unsigned NOT NULL AUTO_INCREMENT, 
                                                        user_email varchar(255) DEFAULT NULL, 
                                                        username varchar(255) NOT NULL, 
                                                        user_password varchar(255) DEFAULT NULL, 
                                                        first_name varchar(255) NOT NULL, 
                                                        last_name varchar(255) NOT NULL,
                                                        birthday DATE DEFAULT NULL,
                                                        securityq1 varchar(255) DEFAULT NULL,
                                                        securityq2 varchar(255) DEFAULT NULL,
                                                        securityq3 varchar(255) DEFAULT NULL,
                                                        number_of_logins int NOT NULL DEFAULT 1,
                                                        last_login DATETIME DEFAULT now(),
                                                        PRIMARY KEY (user_id),
                                                        UNIQUE KEY (user_email)
                                                        )'
fi


#PHP Config
#remove index.php text from the text file dir.conf
sed -i 's/index.php *//'  /etc/apache2/mods-enabled/dir.conf
#insert index.php to the front of the list, right after DirectoryIndex in dir.conf
sed -i 's/DirectoryIndex/& index.php/ '  /etc/apache2/mods-enabled/dir.conf
#move php files to /var/www/html
cp -a ./src/. /var/www/html/

#restart apache
sudo service apache2 restart
