#!/bin/bash
# coded by sibero.
export PATH=/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin
home=${1}
report=$(mktemp)
full_report=$(mktemp)
chmod 600 ${report} ${full_report}

php /support_scripts/ai-bolit/ai-bolit.php -p ${home} -l ${report} -r ${full_report} ${2} ${3} ${4}
cat ${report}
echo "Список вирусов сохранен в ${report}"
echo "Полный отчет сохранен в ${full_report}"

