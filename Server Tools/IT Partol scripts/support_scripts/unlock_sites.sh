#!/bin/bash
#### Разблокировщик сайтов. Разработано sibero для it-patrol. Версия - 1.0 ####
export PATH=/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin
#проверяем есть ли ~/dru_temp , если нет, создаем
if ! [ -d ~/dru_temp ]; then
mkdir ~/dru_temp
fi
#
cd ~/domains/
#находим все .htaccess.suspended и удаляем
find -maxdepth 2 -name '.htaccess.suspended' -exec rm -rf {} \;
#находим все директории в ~/domains/ и заносим значения в переменную
find * -maxdepth 0 -type d  |grep -v logs|grep -v awstats | while read param
#запускаем цикл
do
echo =======================
cd ~/domains/${param}
#узнаем версию друпал
dru_ver=`cat ~/domains/${param}/modules/system/system.info 2>/dev/null | grep -v "VERSION" | grep "version" | awk -F'"' '{print $2;}';`
echo "сайт - ${param}"
#узнаем размер .htaccess
size_htaccess=`ls -l .htaccess 2>/dev/null| awk -F' ' '{print $5;}';`
#
if ! [ -a .htaccess ] && ! [ -z "$dru_ver" ]; then
cd ~/dru_temp/
rm -d -r ~/dru_temp/* 2>/dev/null
wget http://ftp.drupal.org/files/projects/drupal-${dru_ver}.tar.gz 2>/dev/null
tar xf drupal-${dru_ver}.tar.gz
cp /home/`whoami`/dru_temp/drupal-${dru_ver}/.htaccess /home/`whoami`/domains/${param}/
echo "drupal - ${dru_ver}"
echo "в директории с drupal не было htaccess файла, я его скопировал из стандартной поставки drupal той же версии"
cd ~/domains/${param}
fi
# если существует htaccess и он меньше 70 байт, то удаляем его и заменяем стандартным
if [ -a .htaccess ] && (("${size_htaccess}" < "70")) 2>/dev/null; then
rm -rf .htaccess
if [ -n "${dru_ver}" ]; then
cd ~/dru_temp/
rm -d -r ~/dru_temp/* 2>/dev/null
wget http://ftp.drupal.org/files/projects/drupal-${dru_ver}.tar.gz 2>/dev/null
tar xf drupal-${dru_ver}.tar.gz
cp /home/`whoami`/dru_temp/drupal-${dru_ver}/.htaccess /home/`whoami`/domains/${param}/
echo "drupal - ${dru_ver}"
echo "Сайт разблокирован"
fi
fi
# если в переменной dru_ver нет никакого значения, значит это не drupal, сообщаем об этом
if [ -z "${dru_ver}" ] ; then
echo "Сайт либо пуст, либо там не drupal - проверьте"
echo Количество файлов: `ls -l -R|grep ^-|wc -l`
echo Занимаемое место: `du -shc ~/domains/${param} | grep "total" | sed "s#total##g"`
fi
cd ~/domains/
done
echo =======================
rm -d -r ~/dru_temp/ 2>/dev/null