#!/bin/bash
# coded by sibero.
export PATH=/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin

path=${1}
if [ --fix = "$1" ]; then
  find /var/drupal/ -mindepth 1 -maxdepth 1 -type d | grep -v 'drupal-5' | while read drupal_path
  do
    cp -f ${drupal_path}/sites/default/default.settings.php ${drupal_path}/sites/default/settings.php
  done
  echo 'settings.php copy all to /var/drupal/'
  exit
fi

if [ -d "$path" ]; then  
  path=${1}
else
  echo "Dont't find dir ${1}"
fi

if [ -f "${path}/modules/system/system.module" ] || [ -f "${path}/includes/bootstrap.inc" ]; then
  druver=$(cat ${path}/modules/system/system.module ${path}/includes/bootstrap.inc 2>/dev/null | grep "define('VERSION'" | awk -F"'" '{print $4}')
fi

echo "$path - $druver"
echo
diff -r ${path} /var/drupal/drupal-${druver} | grep -vP '(sites/all/|sites/default: files|sites/all: libraries|modules/help: help\.api\.php|>  \*|<  \*|> \/\*\*)'
