Elasticweb API SDK
==============

Install via composer:

```
composer require elasticweb/api-sdk
```

Example use API:

```php
$api = new Elasticweb\Api\Client('token');
var_dump($api->user->getMe()->toJson());
```
