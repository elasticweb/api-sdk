Elasticweb API SDK
==============

Example use API:

```php
$api = new Elasticweb\Api\Client('token');
var_dump($api->user->getMe()->toJson());
```
