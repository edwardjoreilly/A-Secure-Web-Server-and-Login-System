# COMP 424 Group Project - A Secure Web Server and Login System

Run with:
chmod +x installation.sh
sudo ./installation.sh

Use this to get your ip address:
ip addr show eth0 | grep inet | awk '{ print $2; }' | sed 's/\/.*$//'

Enter returned IP address to view webpage

This program makes use of PHPMailer
https://github.com/PHPMailer/PHPMailer
The files PHPMailer.php, Exception.php, and SMTP.php are taken from their github.

Note to team members: Do not send more than 200 emails in 24 hours please. Amazon will charge me if we do. -Justin
