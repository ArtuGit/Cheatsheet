#!/bin/bash
export PATH=/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin
cd ~/domains/
echo Домены
echo =======================
find * -maxdepth 0 -type d  |grep -v logs|grep -v awstats | while read param
do
echo ${param}
echo drupal: `sed -n '8,8p' ~/domains/${param}/modules/system/system.info | grep "version" | awk -F'"' '{print $2;}'; sed -n '16,16p' ~/domains/${param}/modules/system/system.info | grep "version" | awk -F'"' '{print $2;}';`
cd ~/domains/${param}
echo Количество файлов: `ls -l -R|grep ^-|wc -l`
echo Количество папок: `ls -l -R| grep ^d |wc -l`
echo Занимаемое место: `du -shc ~/domains/${param} | grep "total" | sed "s#total##g"`
echo `drush st | grep "Site path" | sed "s#Site path#Путь до кофигурации:#g"`
echo `drush st | grep "Database name" | sed "s#Database name#База данных:#g"`
echo Размер базы данных \(без учета тех. данных\): `drush sql-query "show table status\G"| egrep "(Index|Data)_length" | awk 'BEGIN { rsum = 0 } { rsum += $2 } END { print rsum/1048576}' |  awk -F'.' '{print $1;}';` "Мб"
echo Пользователей: `drush sql-query "SELECT COUNT(*) FROM {users}" | grep -v "COUNT"`
echo Нод: `drush sql-query "SELECT COUNT(*) FROM {node}" | grep -v "COUNT"`
echo Комментариев: `drush sql-query "SELECT COUNT(*) FROM {comments}" | grep -v "COUNT"`
echo Включено модулей: `drush sql-query "SELECT COUNT(*) FROM {system} WHERE type = 'module' and status ='1'" | grep -v "COUNT"`
cd ~/domains/
echo =======================
done
echo Синонимы доменов
find * -maxdepth 0 -type l  |grep -v logs|grep -v awstats | while read param
do
echo ${param} | sed "s#/home/`whoami`/domains/##g"
done
echo =======================





