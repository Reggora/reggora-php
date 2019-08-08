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

### Loans

#### Get all loans

Any of the query parameters found on (INSERT LINK HERE)[https://sandbox.reggora.io/#get-all-loans] can be passed to the `Loan::all()` method.

```php
...

use Reggora\Entity\Lender\Loan;

$loans = Loan::all(); //returns a Collection
```

#### Get a loan by it's ID

```php
...

use Reggora\Entity\Lender\Loan;

$id = '...';
$loan = Loan::find($id);
```

#### Delete a loan

```php
...

//instance of Reggora\Entity\Lender\Loan
$loan->delete();
```

#### Create a loan

```php
...

use Reggora\Entity\Lender\Loan;

$loan = Loan::create([
	... //body found in the documentation
]);
```

#### Edit a loan

Because of our Entity style approach you can set any of a Loans elements as a property and use the `Loan::save()` method to only upadate the "dirty" data.

```php
...

$loan->due_date = '08-08-19T10:10:46Z';
$loan->save();
```

### Orders

#### Get all orders

Any of the query parameters found on (INSERT LINK HERE)[https://sandbox.reggora.io/#get-all-orders] can be passed to the `Order::all()` method.

```php
...

use Reggora\Entity\Lender\Order;

$orders = Orders::all(); //returns a Collection
```

#### Get an order by ID

```php
...

use Reggora\Entity\Lender\Order;

$id = '...';
$order = Order::find($id);
```

#### Cancel an order

```php
...

$order->cancel();
```

#### Create an order

```php
...

use Reggora\Entity\Lender\Order;

$order = Order::create([
	... //body found in the documentation
]);
```

Because of our Entity style approach you can set any of an Orders elements as a property and use the `Order::save()` method to only upadate the "dirty" data.

```php
...

$order->due_date = '08-08-19T10:10:46Z';
$order->save();
```

#### Place an order on hold

```php
...

$reason = '...';
$order->hold($reason);
```

#### Remove an order hold

```php
...

$order->unhold();
```

### eVault

#### Get an eVault by ID

```php
...

use Reggora\Entity\Lender\eVault;

$id = '...';
$evault = eVault::find($id);
```

#### Get a document from an eVault

```php
...

$id = '...';
$file = $evault->getDocument($id);
```

#### Upload a document to an eVault

```php
...

$evault->uploadDocument([
	... //body found in the documentation
]);
```

#### Upload a P&S to an eVault

```php
...

$evault->uploadPS([
	... //body found in the documentation
]);
```

#### Delete a document from an eVault

```php
...

$id = '...';
$evault->deleteDocument($id);
```