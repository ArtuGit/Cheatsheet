#You need to setup Drush aliases in advance

#Sync DB (live to stage)
drush sql-sync @source_alias @target_alias

#Sync files (live to stage)
drush rsync @source_alias:%files/ @target_alias:%files
