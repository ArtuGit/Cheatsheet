#Clean 'flood' table
drush php-eval 'db_query("DELETE FROM flood");'