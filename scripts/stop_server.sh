#!/bin/bash
isExistApp=`pgrep httpd`
if [[ -n  $isExistApp ]]; then
	systemctl stop httpd
fi
isExistDb=`pgrep mysqld`
if [[ -n  $isExistDb ]]; then
	systemctl stop mysqld
fi