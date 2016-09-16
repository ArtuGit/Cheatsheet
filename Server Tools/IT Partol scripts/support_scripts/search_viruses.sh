#!/bin/bash
# coded by sibero.
export PATH=/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin
php_list=$(mktemp)
virus_list=$(mktemp)
chmod 600 ${virus_list} ${php_list}
home=${1}
user=$(echo "$home"| awk -F'/' '{print $3}')
quarantine_dir="/home/${user}/infected"

# | separator
exclude_path='themes/Avada/contact\.php|len-slider/lib/lenslider\.class\.php|gmanager/change.php|zend_gdata/tests/Zend/Pdf/DrawingTest\.php|akismet/akismet.php|com_jshopping/lib/functions\.php|civicrm/packages/ezc/Mail/src/interfaces/part\.php|drumode3/misc\.php|drumode/misc\.php|wp-content/plugins/akismet|mpdf.*/examples|mpdf.*/patterns|Zend/Mime\.php|Zend/Service/Akismet\.php|getid3/demos/demo\.browse\.php|qrcode\.php|qrspec\.php'

if [ all = "$1" ]; then
  home='/home/*/domains'
  mkdir /root/tmp 2>/dev/null
  php_list='/root/tmp/php_list.log'
  virus_list='/root/tmp/virus_list.log'
  mobile_search_redirect_list='/root/tmp/mobile_search_redirect_list.log'
  >${virus_list}
  >${mobile_search_redirect_list}
fi

find ${home} -type f -name "*.php" \! -path '*/cache/normal/*' \! -path '*/.git/*' \! -path '/home/*/infected/*' | grep -viP "(${exclude_path})" 2>/dev/null >${php_list}
echo "Search PHP files..."
echo "PHP files found: $(cat ${php_list} | wc -l)"
echo "Search viruses..."
cat "${php_list}" | while read file
do
  #user=$(echo $file| awk -F'/' '{print $3}')
  #domain=$(echo $file | awk -F'/' '{print $5}')
  grep -liP "(SimplePieCache object|package Akismet|PCT4BA6ODSE_|Obfuscation provided by FOPO|Web Shell|.?default_action.? .?.? .?FilesMan.?|strrev.*tressa|by zeura\.com)" "${file}" 2>/dev/null >>${virus_list}
  grep -lP "php.*strtoupper.*isset.*eval.*\Q?>\E" "${file}" 2>/dev/null >>${virus_list}
  grep -lP "^if \(isset\Q($\E_POST\Q['\EpasswordMW\Q'])) {\E" "${file}" 2>/dev/null >>${virus_list}
  grep -lP "php.*set_magic_quotes_runtime.*WSOsetcookie.*setcookie.*actionRC.*serialize.*function_exists.*exit;" "${file}" 2>/dev/null >>${virus_list}
  grep -lP "^(include|require)\Q('\E.*(\.css|\.js|\.jpg|\.png|\.gif|\.txt)\Q');\E" "${file}" 2>/dev/null >>${virus_list}
  #grep -lP "GLOBALS.*base64_decode.*base64_decode.*base64_decode.*while.*round.*GLOBALS.*GLOBALS" "${file}" 2>/dev/null >>${virus_list}
  grep -lP "function collectnewss.*\Q()\E" "${file}" 2>/dev/null >>${virus_list}
  grep -lP "eval\(gzuncompress\(base64_decode.*\Q)));\E" "${file}" 2>/dev/null >>${virus_list}
  grep -lP "eval\(base64_decode\(.*\Q));\E" "${file}" 2>/dev/null >>${virus_list}
  grep -lP "error_reporting.*ini_set.*ini_set.*chr.*chr.*chr.*foreach.*preg_split.*chr.*md5.*return.*preg_replace.*return" "${file}" 2>/dev/null >>${virus_list}
  grep -liP '(eval\(\$_POST|eval\(\$_GET)' "${file}" 2>/dev/null >>${virus_list}
  grep -lP "php.*file.*links\.dba.*file_get_contents.*Header.*\Q?>\E" "${file}" 2>/dev/null >>${virus_list}
  grep -lP "document.write\(.*'di' \+ 'v sty' \+ 'le.*position: absolute.*\)\;" "${file}" 2>/dev/null >>${virus_list}
  grep -lP 'GLOBALS.*base64_decode.*base64_decode.*base64_decode.*base64_decode' "${file}" 2>/dev/null >>${virus_list}
  grep -lP 'preg_replace\("/\.\*/e","\\x65\\x76\\x61\\x6C\\x28\\x67\\x7A\\x69\\x6E\\x66\\x6C\\x61\\x74\\x65\\x28\\x62\\x61\\x73\\x65\\x36\\x34\\x5F\\x64\\x65\\x63\\x6F\\x64\\x65\\x28' "${file}" 2>/dev/null >>${virus_list}
  grep -lP "move_uploaded_file\(\Q$\E_FILES\['.*'\]\['tmp_name'\], \Q$\E_POST\['Name'\]\)\;" "${file}" 2>/dev/null >>${virus_list}
  grep -lP '(\$form1=\@\$_COOKIE|if\(\@\$_COOKIE)' "${file}" 2>/dev/null >>${virus_list}
  grep -liP ".*GLOBALS.*GLOBALS.*GLOBALS.*GLOBALS.*GLOBALS.*GLOBALS.*GLOBALS.*GLOBALS.*GLOBALS.*GLOBALS.*GLOBALS" "${file}" 2>/dev/null >>${virus_list}
  grep -l '<?php $array = array(.*eval.*?>' "${file}" 2>/dev/null >>${virus_list}
  grep -lP "([A-Za-z0-9_@+-])'\^'([A-Za-z0-9_@+-])" "${file}" 2>/dev/null >>${virus_list}
  temp=$(grep -Pc '(return base64_decode\(.*\)\Q;}\E|eval\(.*\(.*\)\)\Q;?>\E)' "${file}" 2>/dev/null)
  if [ 2 = "$temp" ]; then
    echo "${file}" >>${virus_list}
  fi

  temp=$(grep -P 'COOKIE.*md5.*substr\(md5\(strrev.*gzinflate' "${file} | grep -c 'Binary file'" 2>/dev/null)
  if [ 1 = "$temp" ]; then
    echo "${file}" >>${virus_list}
  fi

  temp=$(grep -ciP '(utf8|CP1251)' "${file}" 2>/dev/null)
  if [ 0 = "$temp" ]; then
    grep -l '\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*\\x.*' "${file}" 2>/dev/null >>${virus_list}
  fi
done

cat ${virus_list} | sort | uniq
echo "Virus found: $(cat ${virus_list} | sort | uniq | wc -l)"
echo "A list of infected files stored in ${virus_list}"

echo
echo "Suspected mobile / redirect search in .htaccess:"

if [ all = "$1" ]; then
  find ${home}/* -mindepth 1 -maxdepth 1 -type f -name ".htaccess" -exec grep -liP "(HTTP_USER_AGENT.*Android|HTTP_USER_AGENT.*blackberry|HTTP_USER_AGENT.*iphone|HTTP_USER_AGENT.*ipad|HTTP_USER_AGENT.*google|HTTP_USER_AGENT.*yandex|HTTP_REFERER.*yandex|HTTP_REFERER.*google)" {} \; 2>/dev/null >>${mobile_search_redirect_list}
  cat ${mobile_search_redirect_list}
  exit;
fi

find ${home}/* -mindepth 1 -maxdepth 1 -type f -name ".htaccess" -exec grep -liP "(HTTP_USER_AGENT.*Android|HTTP_USER_AGENT.*blackberry|HTTP_USER_AGENT.*iphone|HTTP_USER_AGENT.*ipad|HTTP_USER_AGENT.*google|HTTP_USER_AGENT.*yandex|HTTP_REFERER.*yandex|HTTP_REFERER.*google)" {} \; 2>/dev/null

if [ --quarantine = "$2" ] || [ -q = "$2" ] || [ --quarantine = "$3" ] || [ -q = "$3" ]; then
  log="${quarantine_dir}/antivirus.log"
  mkdir ${quarantine_dir} 2>/dev/null
  current_user=$(whoami)
  if [ root = "$current_user" ]; then
    chown ${user}:${user} ${quarantine_dir}
  fi
  cat "${virus_list}" | while read param
  do
    mv "${param}" ${quarantine_dir}/
    echo "file ${param} moved to ${quarantine_dir}" | tee -a ${log}
  done
  echo "Infected files moved to ${quarantine_dir}. Log saved -  ${log}"
fi

rm -f ${php_list}
