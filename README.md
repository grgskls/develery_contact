# Develery contact form task

## Installation

Make sure you have PHP, or you can download it [here](https://www.php.net/downloads.php)

Also you need composer which you can download it [here](https://getcomposer.org/download/)
OR
quick install in the current directory
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

## Usage, Running tests
This installs the dependencies:
```bash
composer install
npm i
```

You can run the server with the following command
```bash
symfony server:start
```

## Owner
Siklósi Gergely
grg.skls@gmail.com
