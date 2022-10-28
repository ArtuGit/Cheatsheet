## Local

###Backup
mysqldump -u [user_name] -p [db_name] > ~/dumpname_yymmdd.sql

###Restore
mysql -u [user_name] -p [db_name] < ~/dumpname_yymmdd.sql


# Docker

###Backup
docker exec CONTAINER /usr/bin/mysqldump -u root --password=root DATABASE > backup.sql

###Restore
cat backup.sql | docker exec -i CONTAINER /usr/bin/mysql -u root --password=root DATABASE