## Email Blacklist package for Laravel 5.7

Simple demo test task. Allows saving, removing, filtering emails with parameter validation.

### Installation

Command line:

```bash
composer require andrewlynx/email-blacklist
```

or add to composer.json:

```json
"require": {
        ...
        "andrewlynx/email-blacklist": "dev-master",
		...
},
```
and update composer.

For publishing migrations and configs run:

```bash
php artisan vendor:publish
```
and select option:
```bash
[# ] "Provider: Andrewlynx\EmailBlacklist\Providers\EmailBlacklistServiceProvider"
```

After publishing run the migration:

```bash
php artisan migrate
```

### Public methods

```php
add(string $email): void // add email
remove(string $email): void // remove email
all(): array // get all emails
check(string $email): bool // check if email exists in db
filter(array $emails): array // filter out blacklisted emails
validate(string $email): void // throws InvalidArgumentException if $email is not valid email
```

### Usage

```php
use Andrewlynx\EmailBlacklist\Facades\EmailBlacklist;

EmailBlacklist::add('email1@domain.com'); // returns noting
EmailBlacklist::add('email2@domain.com'); // returns noting
EmailBlacklist::all(); // returns array ['email1@domain.com', 'email2@domain.com']
EmailBlacklist::check('email2@domain.com'); // returns bool true
EmailBlacklist::check('not_added_email@domain.com'); // returns bool false
EmailBlacklist::filter(['not_added_email@domain.com', 'another_not_added_email@domain.com', 'email1@domain.com']) // returns array ['not_added_email@domain.com', 'another_not_added_email@domain.com']
EmailBlacklist::remove('email2@domain.com'); // returns noting
EmailBlacklist::all(); // returns array ['email1@domain.com']
EmailBlacklist::add('some string that is not valid email'); // throws InvalidArgumentException
```

### Tests
From package root directory run:
```bash
$ ./vendor/bin/phpunit 
PHPUnit 7.5.2-28-g9394dc3eb by Sebastian Bergmann and contributors.

..                                                                  2 / 2 (100%)

Time: 73 ms, Memory: 12.00MB

OK (2 tests, 2 assertions)
```