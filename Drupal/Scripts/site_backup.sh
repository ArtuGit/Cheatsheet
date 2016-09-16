if [ -z "$1" ] || [ -z "$2" ]
then
  echo "Usage: $0 source_site_directory_name backup_file_name"
  exit 1
fi

if ! [ -d $1 ]; then
	echo "Directory '$1' not found"
	exit 1
fi

source_site_directory_name=$1
backup_file_name=$2
temp_directory="/home/u2983/_user/temp/_transit/"

echo "Drush backup '$source_site_directory_name' to '$temp_directory$backup_file_name' ..."

cd $source_site_directory_name

drush vset maintenance_mode 1
drush cron
drush cc all

drush archive-dump --tar-options="--exclude=.git --exclude=_user" --destination=$temp_directory/$backup_file_name --overwrite

drush vset maintenance_mode 0