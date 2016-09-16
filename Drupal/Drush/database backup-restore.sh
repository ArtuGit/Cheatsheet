#backup
drush sql-dump | bzip2 > dbname_yymmdd.sql.bz2

#clean database
drush sql-drop

#restore from an archive
bunzip2 < dbname_yymmdd.sql.bz2 | `drush sql-connect`

#restore from sql dump
drush sql-cli < dbname_yymmdd.sql
