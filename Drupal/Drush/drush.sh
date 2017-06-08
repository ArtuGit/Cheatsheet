#Clean 'flood' table
drush php-eval 'db_query("DELETE FROM flood");'

#Change user's password
drush user-password USERNAME --password="SOMEPASSWORD"
or abbreviated
drush upwd USERNAME --password="SOMEPASSWORD"

#Reset user's password
drush uli some-username