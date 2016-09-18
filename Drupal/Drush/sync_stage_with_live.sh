#You need to setup Drush aliases in advance

#Sync DB (live to stage)
drush sql-sync @live @stage

#Sync files (live to stage)
drush rsync @live:%files @stage:%files
