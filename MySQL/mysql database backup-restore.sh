#Backup
mysqldump -u [user_name] -p [db_name] > ~/dumpname_yymmdd.sql
#Restore
mysql -u [user_name] -p [db_name] < ~/dumpname_yymmdd.sql
