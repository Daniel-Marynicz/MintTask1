# Mint Software Task1 App

[![Build Status](https://travis-ci.com/Daniel-Marynicz/MintTask1.svg?branch=master)](https://travis-ci.com/Daniel-Marynicz/MintTask1)


### Tech

App uses a number of open source projects to work properly:
* [PHP] required 7.4 version or later
* [Symfony]  - Symfony, High Performance PHP Framework for Web Development
* [Composer]    - A Dependency Manager for PHP
* [PHP_CodeSniffer] PHP_CodeSniffer tokenizes PHP, JavaScript and CSS files and detects violations of a defined set of coding standards
* [PHPUnit] The PHP Testing Framework
* [PHPStan] PHP Static Analysis Tool - discover bugs in your code without running it!

### Coding standards

The application uses the following coding standards and quality tools:
#### Doctrine Coding Standard
 The [Doctrine Coding Standard] is a set of rules for [PHP_CodeSniffer]. It is based on [PSR-1]
 and [PSR-2] , with some noticeable exceptions/differences/extensions.
 - Keep the nesting of control structures per method as small as possible
 - Abstract exception class names and exception interface names should be suffixed with ``Exception``
 - Abstract classes should not be prefixed or suffixed with ``Abstract``
 - Interfaces should not be prefixed or suffixed with ``Interface``
 - Concrete exception class names should not be prefixed or suffixed with ``Exception``
 - Align equals (``=``) signs in assignments
 - Add spaces around a concatenation operator ``$foo = 'Hello ' . 'World!';``
 - Add spaces between assignment, control and return statements
 - Add spaces after a negation operator ``if (! $cond)``
 - Add spaces around a colon in return type declaration ``function () : void {}``
 - Add spaces after a type cast ``$foo = (int) '12345';``
 - Use apostrophes for enclosing strings
 - Always use strict comparisons
 - Always add ``declare(strict_types=1)`` at the beginning of a file
 - Always add native types where possible
 - **Omit phpDoc for parameters/returns with native types, unless adding description**
 - Don't use ``@author``, ``@since`` and similar annotations that duplicate Git information
 - Assignment in condition is not allowed
 - Use parentheses when creating new instances that do not require arguments ``$foo = new Foo()``
 - Use Null Coalesce Operator ``$foo = $bar ?? $baz``
 - Prefer early exit over nesting conditions or using else
 
#### PSR-2
The [PSR-2] the most common coding standard among php programmers.
#### PHPStan at level max
[PHPStan] focuses on finding errors in your code without actually running it. It catches whole classes of bugs even before you write tests for the code. It moves PHP closer to compiled languages in the sense that the correctness of each line of the code can be checked before you run the actual line.
#### PHPUnit
Tests in directory `tests`

### Installation

App requires [Composer] to install dependencies. 

For more information about installing [Composer] please follow the documentation:
https://getcomposer.org/download/

#### Install dependencies

To install php packages you need to execute

```sh
$ composer install
```

#### Execute main console app

To show help in a main app 

```
./task1 --help
```
or to display updated json you can run

```
./task1 ./tree.json ./list.json
```

if you want save output you can do this by using pipe

```
./task1 ./tree.json ./list.json > new-tree.json
```

#### Ok, but what now?

To run all tests (phpcbf, phpcs, phpstan, phpunit) you can run

```
$ composer tests
``` 
Or for running only phpunit tests you can run

```
$ composer phpunit
> ./vendor/bin/phpunit 
PHPUnit 9.1.3 by Sebastian Bergmann and contributors.

................                                                  16 / 16 (100%)

Time: 00:00.047, Memory: 6.00 MB

OK (16 tests, 40 assertions)
```


License
----

PROPRIETARY

**Have fun!**

[//]: # 
   [PHP]: <https://www.php.net>
   [Symfony]: <http://symfony.com>
   [Docker]: <https://www.docker.com/>
   [Docker Compose]: <https://www.docker.com/>
   [PHPUnit]: <https://phpunit.de>
   [Composer]: <https://getcomposer.org>
   [PHP_CodeSniffer]:  <https://github.com/squizlabs/PHP_CodeSniffer>
   [PHPStan]:   <https://github.com/phpstan/phpstan>
   [Doctrine Coding Standard]:   <https://www.doctrine-project.org/projects/doctrine-coding-standard/en/6.0/reference/index.html#introduction>
   [PSR-2]: <https://www.php-fig.org/psr/psr-2/>
   [PSR-1]: <https://www.php-fig.org/psr/psr-1/>
   [PSR-12]: <https://www.php-fig.org/psr/psr-12/>
   [Behat]: <https://behat.org/>
   [Deptrac]: <https://github.com/sensiolabs-de/deptrac>
   [KnpPaginatorBundle]: <https://github.com/KnpLabs/KnpPaginatorBundle>
   [Behatch contexts]: https://github.com/Behatch/contexts 
    

