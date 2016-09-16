#!/bin/bash
# coded by sibero.
export PATH=/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin

if ! [ -d /home/${user} ]; then
        echo ==========================================================
        echo  "пользователя ${user} нет на сервере"
        echo ==========================================================
        exit 1;
fi
user=$(echo "$1" | sed 's/[*\/`~"@#\$%^&?<>"().]//g')
current_user=$(whoami)

echo "Распечатка по занимаемому месту для аккаунта ${user}."
echo 'Файлы в корневой директории и в ~/domains.'
du -sh --exclude=.. --exclude=. --exclude=.bkp --exclude=domains --exclude=du-user.sh /home/${user}/* /home/${user}/.* | grep -vP "^([0-9.]+)(K)" | grep -vP "^(0)" | sed "s#/home/${user}#~#g"
du -sh --exclude=.. --exclude=. --exclude=logs /home/${user}/domains/* /home/${user}/domains/.* | grep -vP "^([0-9.]+)(K)" | grep -vP "^(0)" | sed "s#/home/${user}#~#g"
du -shc --exclude=.. --exclude=. --exclude=.bkp --exclude=logs /home/${user}/* /home/${user}/.* | grep total | sed 's|total|всего (без учета logs)|g'
echo

echo 'Электронная почта.'
find /home/${user}/domains -maxdepth 1 -mindepth 1 -type d -name "*" | sed "s#/home/${user}/domains/##g" | grep -vP '(awstat|logs)' | while read domain
do
  if [ -d /var/vmail/${domain} ]; then
    du -sh /var/vmail/${domain}/* | awk -F'/' '{print $1 $5"@"$4;}' | grep -vP "^([0-9.]+)(K)" | grep -vP "^(0)"
  fi
done

if [ -d /var/vmail/${user} ]; then
  du -sh /var/vmail/${user} | sed "s#/var/vmail/${user}#${user}@$HOSTNAME#g" | grep -vP "^([0-9.]+)(K)" | grep -vP "^(0)"
fi
echo

echo 'Логи.'
du -shc /home/${user}/domains/logs/* | grep -vP "^([0-9.]+)(K)" | grep -vP "^(0)" | sed "s#/home/$1#~#g" | sed 's|total|всего|g' | grep -vP "^([0-9.]+)(K)" | grep -vP "^(0)"
echo
echo "В распечатке не выводятся почтовые ящики и логи занимающие менее 1мб (для удобства), но учитываются в общем подсчете."
echo

echo 'Временные файлы в директории /tmp'
echo $(echo "scale=1; $(find /tmp -name "*" -user ${user} -ls 2>/dev/null | awk '{sum = sum+$7 }; END { print sum }')/1048576" | bc 2>/dev/null) "Мб"
echo

du_mysql_db(){
echo 'Базы данных.'
if [ -S /var/lib/mysql/mysql.sock ]; then
        du -shcL /var/lib/mysql/${user}_* | sed "s#/var/lib/mysql/##g" | sed 's|total|всего|g'
else
ssh mysql.server "du -shcL /var/lib/mysql/${user}_* | sed 's#/var/lib/mysql/##g'" | sed 's|total|всего|g'
fi
}

if [ root = "$current_user" ]; then
  du_mysql_db
fi
