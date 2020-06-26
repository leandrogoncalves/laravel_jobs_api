#! /bin/bash

git submodule add https://github.com/Laradock/laradock.git
cd laradock
cp env-example .env

find dir -type f -exec chmod ugo-x '{}' +
find . -type f | xargs grep -L #! | xargs chmod ugo-x
find . -type f -exec grep -L #! '{}' + | xargs chmod ugo-x
