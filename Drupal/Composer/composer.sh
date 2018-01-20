# Composer template for new Drupal projects
# see https://github.com/drupal-composer/drupal-project

# Install the new packages according the composer.json
composer install

# Add modules and themes to a website
composer require drupal/<modulename>:<version>

#For example:

composer require drupal/bootstrap:8.*
composer require drupal/ds
composer require drupal/ctools:3.0.0-alpha26
composer require drupal/token:1.x-dev

# Update all
composer update --with-dependencies

# Update a core
composer update drupal/core --with-dependencies

# Update a module
composer update drupal/<modulename> 

# Delete a module (after uninstalling)
composer remove drupal/<modulename>

# Show an available package
composer show drupal/<modulename>
composer show | grep drupal/console