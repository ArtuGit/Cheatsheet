#Clean 'flood' table
drush php-eval 'db_query("DELETE FROM flood");'

#Change user's password
drush user-password USERNAME --password="SOMEPASSWORD"
or abbreviated
drush upwd USERNAME --password="SOMEPASSWORD"

#Reset user's password
drush uli some-username

#WatchDog
drush ws \
--extended \
--format=yaml \
--type=php \
--count=100

#Features
`features-update` (`fu`)
The update operation will produce a modified version of your feature module, which matches up with the configuration found in the database.

`features-revert` (`fr`)
Revert changes your site configuration (living in the database) to match up with the definitions in the feature module code.


