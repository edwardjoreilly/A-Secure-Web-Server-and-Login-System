#!/bin/bash -

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

#MySQL configuration
#start the mysql server
sudo /etc/init.d/mysql start
#run initial mysql config sequence
sudo mysql_secure_installation

#PHP Config
#remove index.php text from the text file dir.conf
sed -i 's/index.php *//'  /etc/apache2/mods-enabled/dir.conf
#insert index.php to the front of the list, right after DirectoryIndex in dir.conf
sed -i 's/DirectoryIndex/& index.php/ '  /etc/apache2/mods-enabled/dir.conf
