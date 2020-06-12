# Clean 'flood' table
drush php-eval 'db_query("DELETE FROM flood");'

# Change user's password
Drush < 9
`drush user-password USERNAME --password="SOMEPASSWORD"`
or abbreviated
`drush upwd USERNAME --password="SOMEPASSWORD"`
Drush 9
`drush user:password someuser "SOMEPASSWORD"`

# Reset user's password
drush uli some-username

# WatchDog
drush ws \
--extended \
--format=yaml \
--type=php \
--count=100

# Features
`features-update` (`fu`)
The update operation will produce a modified version of your feature module, which matches up with the configuration found in the database.

`features-revert` (`fr`)
Revert changes your site configuration (living in the database) to match up with the definitions in the feature module code.

Drupal 8

`features-import` (`fim`)
Import a module config into your site.

# Run a single specific Drupal update
drush php-eval "module_load_install('MYMODULE'); MYMODULE_update_NUMBER();"