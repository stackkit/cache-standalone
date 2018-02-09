# Cache standalone

## Example
```php
$config = [
  'cache.default' => 'file',
  'cache.stores.file' => [
    'driver' => 'file',
    'path' => __DIR__ . '/cache'
  ]
];

$cache = new Cache($config);

$cache->put('test', 'This is loaded from cache.', 1);

echo $cache->get('test');

$value = $cache->remember('users', 1, function () {
  return 'Hallo';
});

echo $value;
```
