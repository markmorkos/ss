#!/bin/sh
composer install && \
app/console doctrine:cache:clear-metadata && \
app/console cache:clear && \
app/console doctrine:schema:drop --force && \
app/console doctrine:schema:create && \
app/console doctrine:fixtures:load -n && \
#app/console werkint:compile && \
app/console assets:install && \
app/console assetic:dump
#redis-cli flushdb
npm install --save gulp
npm install --save bower
npm install && \
bower install && \
gulp