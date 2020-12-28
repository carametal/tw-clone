#!/bin/bash
sudo yum install -y httpd
sudo amazon-linux-extras install php7.4
sudo yum localinstall https://dev.mysql.com/get/mysql80-community-release-el7-1.noarch.rpm -y
sudo yum-config-manager --disable mysql80-community
sudo yum-config-manager --enable mysql57-community
sudo yum info mysql-community-server
sudo yum install mysql-community-server -y
