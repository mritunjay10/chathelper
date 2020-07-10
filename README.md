# Chat

A core library for integrating Strapengine UI with your own database.

## Install

Via Composer

``` bash
$ composer require indilabz10/chat
```

## Usage

``` php

$config = array(
    'driver' 	=> 'mysql',
    'host' 		=> 'localhost',
    'database' 	=> 'chat',
    'username' 	=> 'root',
    'password' 	=> '',
    'charset' 	=> 'utf8',
    'collation'	=> 'utf8_general_ci'
);

$opr = new \Indilabz\Chat();

```

## Testing

``` bash
$ phpunit
```


The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
