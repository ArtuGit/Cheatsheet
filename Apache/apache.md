## How to check is Apache2 is stopped?
`ps aux | grep httpd | grep -v grep`
`service apache2 status`


### Start/Stop/Restart

## To Restart Apache 2 web server, enter:
`/etc/init.d/apache2 restart`
OR
`sudo /etc/init.d/apache2 restart`
OR
`sudo service apache2 restart`


## To Stop Apache 2 web server, enter:
`/etc/init.d/apache2 stop`
OR
`sudo /etc/init.d/apache2 stop`
OR
`sudo service apache2 stop`

## To Start Apache 2 web server, enter:
`/etc/init.d/apache2 start`
OR
`sudo /etc/init.d/apache2 start`
OR
`sudo service apache2 start`

## A note about Debian/Ubuntu Linux systemd users

Use the following commands on Debian Linux version 8.x+ or Ubuntu Linux version Ubuntu 15.04+ or above:
# Start command 
`systemctl start apache2.service`
# Stop command
`systemctl stop apache2.service`
# Restart command
`systemctl restart apache2.service`

https://www.cyberciti.biz/faq/star-stop-restart-apache2-webserver/


## How to disable apache2 server from auto starting on boot
`sudo update-rc.d apache2 disable`
`sudo update-rc.d apache2 enable`
`sudo update-rc.d -f apache2 remove` (!)

https://askubuntu.com/questions/170640/how-to-disable-apache2-server-from-auto-starting-on-boot
