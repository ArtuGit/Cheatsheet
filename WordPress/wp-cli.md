### DB Backup
`wp db export - | bzip2 > ./db_backup-$(date +%Y-%m-%d-%H%M%S).sql.bz2`

### DB Restore
```
bzip2 -d filename.sql.bz2
bzip2 -d filename.sql
```

### Flush cache
wp cache flush
 