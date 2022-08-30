if [ -z "$1" ]
then
  echo "Usage: $0 file_or_directory_name"
  exit 1
fi

phpcbf --standard=/home/u2983/.drush/coder/coder_sniffer/Drupal --extensions=php,module,inc,install,test,profile,theme,js,css,info,txt,md $1