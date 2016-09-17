#Step 1. You need to download Drupal Core files using:
#Step 1.1 Drush way
drush dl drupal-7 -v -d --destination=".." --drupal-project-rename="$(basename `pwd`)"
#Step 1.2 or using Composer Install, see /Drupal/Composer/composer.sh

#Step 2. Install into a database 'some_db'. The database 'some_db' should be created in advance.
#Select Drush Call method (2.1 or 2.2) then add Drush parameters 2.3

#Step 2.1 The Drush way. From website directoty:
drush site-install standard \

#Step 2.2 Second option for Composer way. From website (/web) directory:
../vendor/drush/drush/drush site-install standard \

#Step 2.3 Parameters for Drush
--db-url='mysql://DBUSERNAME:DBPASSWORD@localhost/some_db' \
--account-mail="admin@example.com" \
--db-prefix=dX_ \
--account-name=admin \
--account-pass=some_admin_password \
--site-mail="admin@example.com" \
--site-name='Site Name'
