# Getting Started

## Requirements

- PHP 7.2+
- PHP JSON Extension

## Installing

You can install the `reggora-php` library with [Composer](https://composer.org) using `composer require reggora/php --no-dev`. Composer will download all necessary dependencies. 

# Usage

To view the full documentation head over to (https://sandbox.reggora.io)[https://sandbox.reggora.io].

To use the `Vendor` or `Lender` API's you first need to get an Integration Token, you can do so at [INSERT LINK HERE](https://sandbox.reggora.io).

Both the `Lender` and `Vendor` API wrappers are built to easily integrate with popular PHP frameworks such as Symfony or Laravel. Instead of arrays of objects we use `Collections` from (Laravel)[https://laravel.com/docs/master/collections], this allows you to sort, filter, and manipulate relationships between entities with ease.

## Lender

### Authentication

To authenticate with the Lender API you need a `username`, `password`, and `integration token`. You can use the snippet below to authenticate.

```php
require 'path/to/autoload.php';

use Reggora\Lender;

$username = '...';
$password = '...';
$integration = '...';

//if set to `true` you'll use the api methods in production
$productionMode = false;

//you won't need to use $lender anywhere, it stores the credentials statically
$lender = new Lender($username, $password, $integrationToken, $productionMode);
```

### Get all loans

Any of the query parameters found on (INSERT LINK HERE)[https://sandbox.reggora.io/#get-all-loans] can be passed to the `Loan::all()` method.

```php
...

use Reggora\Entity\Lender\Loan;

$loans = Loan::all(); //returns a Collection
```

### Get a loan by it's ID

```php
...
use Reggora\Entity\Lender\Loan;

$id = '...';
$loan = Loan::find($id);
```

### Delete a loan

```php
...

//instance of Reggora\Entity\Lender\Loan
$loan->delete();
```

### Create a loan

```php
...
use Reggora\Entity\Lender\Loan;

$loan = Loan::create([
	... //body found in the documentation
]);
```

### Edit a loan

Because of our Entity style approach you can set any of a Loans elements as a property and use the `Loan::save()` method to only upadate the "dirty" data.

```php
...

$loan->due_date = '08-08-19T10:10:46Z';
$loan->save();
```

