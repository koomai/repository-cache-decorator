# Repository Cache Decorator

This is a sample Laravel app to demonstrate the use of a Decorator pattern to implement caching for repositories.

## Usage

```
1. composer install
2. php artisan migrate
3. php artisan db:seed
```

Check the `Repositories` directory and `RepositoryServiceProvider` for implementation details.

## Note

Invalidating caches in the `file` or `database` is a bit clunky because you cannot use Laravel's tagging feature for caches.

You would use [Cache Tags](https://laravel.com/docs/5.5/cache#cache-tags) for Redis or Memcached drivers.
