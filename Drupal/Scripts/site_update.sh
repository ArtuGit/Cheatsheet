cd /full/path/to/website

drush variable-set maintenance_mode 1

drush cron
drush cache-clear all

drush pm-refresh
drush pm-update --lock=media,file_entity 
drush updatedb

drush l10n-update-refresh
drush l10n-update

drush cron
drush cache-clear all

drush variable-set maintenance_mode 0