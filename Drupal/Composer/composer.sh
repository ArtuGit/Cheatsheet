# Composer template for new Drupal projects
# see https://github.com/drupal-composer/drupal-project

# Install the new packages according the composer.json
composer install

# Add modules and themes to a website
composer require drupal/<modulename>

# Update a core
composer update drupal/core --with-dependencies