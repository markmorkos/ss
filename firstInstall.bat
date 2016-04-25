composer install
php app/console doctrine:cache:clear-metadata
php app/console cache:clear
php app/console doctrine:schema:drop --force
php app/console doctrine:schema:create
php app/console doctrine:fixtures:load -n
#php app/console werkint:compile
php app/console assets:install
php app/console assetic:dump
#php redis-cli flushdb
npm install --save gulp
npm install --save bower
npm install
bower install
gulp