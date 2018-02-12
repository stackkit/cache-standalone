# Cache standalone
You can find the docs for the Illuminate cache here: [cache](https://laravel.com/docs/5.5/cache)

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

## Drivers
You can use different cache drivers. By setting this in the config variable.

### FileCache Driver
```php
$config = [
  'cache.default' => 'file',
  'cache.stores.file' => [
    'driver' => 'file',
    'path' => __DIR__ . '/cache'
  ]
];
```

### RedisCache Driver (not tested)
```php
$config = [
    'cache.default' => 'redis',
    'cache.stores.redis' => [
        'driver' => 'redis',
        'connection' => 'default'
    ],
    'cache.prefix' => 'illuminate_non_laravel',
    'database.redis' => [
        'cluster' => false,
        'default' => [
            'host' => '127.0.0.1',
            'port' => 6379,
            'database' => 0,
        ],
    ]
];
```

### MemeCache Driver (not tested)
```Php
$config = [
    'cache.default' => 'memcached',
    'cache.stores.memcached' => [
        'driver' => 'memcached',
        'servers' => [
            [
                'host' => '127.0.0.1',
                'port' => g11211,
                'weight' => 100,
            ],
        ],
    ],
    'cache.prefix' => 'illuminate_non_laravel'
];
```
