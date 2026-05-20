#!/usr/bin/env bash

if [ ! -f "/usr/src/app/composer.json" ]; then
  composer init --name "constup/php-attributes" --autoload "src" --no-interaction
  temp_composer_file=$(mktemp)
  jq '
  if has("autoload-dev") then .
  else
    (.autoload."psr-4" | to_entries[0].key) as $ns
    | . + {
        "autoload-dev": {
          "psr-4": {
            ($ns + "Tests\\"): "tests"
          }
        }
      }
  end
' composer.json > "$temp_composer_file" && mv "$temp_composer_file" composer.json
composer require --dev --no-cache friendsofphp/php-cs-fixer
composer require --dev --no-cache phpunit/phpunit:^13
composer require --dev --no-cache fakerphp/faker
  composer dump-autoload
fi
php -S 0.0.0.0:8080 -t /usr/src/app/public /usr/src/app/public/index.php