#!/bin/bash
# coded by sibero.
export PATH=/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin

home=${1}
user=$(echo "$home"| awk -F'/' '{print $3}')
quarantine_dir="/home/${user}/infected"
current_user=$(whoami)

if [ root = "$current_user" ]; then
  maldet -u
fi

if [ --delete = "$2" ] || [ -d = "$2" ]; then
  exec='--remove=yes'
fi

if [ --quarantine = "$2" ] || [ -q = "$2" ] || [ --quarantine = "$3" ] || [ -q = "$3" ]; then
  mkdir ${quarantine_dir} 2>/dev/null
  if [ root = "$current_user" ]; then
    chown ${user}:${user} ${quarantine_dir}
  fi
  exec="--move=${quarantine_dir} --log=${quarantine_dir}/antivirus.log"
fi

if [ --extend = "$2" ] || [ -e = "$2" ] || [ --extend = "$3" ] || [ -e = "$3" ]; then
  exec2='-d /var/lib/maldetect/sigs/itpatrol.extend.ndb'
fi

if [ --all = "$1" ] || [ -a = "$1" ]; then
  if [ root = "$current_user" ]; then
    freshclam
  fi
  clamscan -i -r --exclude-dir='/home/.*/infected|/home/.*/\.bkp|/home/.*/domains/logs|.*/cache/normal/.*|/home/.*/drush-backup|/home/.*/backup|/home/backup' -d /var/lib/maldetect/sigs/rfxn.ndb -d /var/lib/maldetect/sigs/rfxn.hdb -d /var/lib/maldetect/sigs/itpatrol.ndb -d /var/clamav ${exec} ${exec2} ${1}| sed 's|.UNOFFICIAL FOUND||g'
else
  clamscan -i -r --include='\.php$|\.js$|\.htaccess$|\.css$' --exclude-dir='/home/.*/infected|/home/.*/\.bkp|/home/.*/domains/logs|.*/cache/normal/.*|/home/.*/drush-backup|/home/.*/backup|/home/backup' -d /var/lib/maldetect/sigs/rfxn.ndb -d /var/lib/maldetect/sigs/rfxn.hdb -d /var/lib/maldetect/sigs/itpatrol.ndb ${exec} ${exec2} ${1} | sed 's|.UNOFFICIAL FOUND||g'
fi

if [ -f ${quarantine_dir}/antivirus.log ]; then
  if [ root = "$current_user" ]; then
    chown ${user}:${user} ${quarantine_dir}/antivirus.log
  fi
fi
