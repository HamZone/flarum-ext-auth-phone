经过线上的一段时间运行，发现会有一定几率的缓存失效问题，导致验证码立即失效，初步排查后是 Flarum 缓存机制存在异常。

# Flarum-ext-auth-phone

A [Flarum](http://flarum.org) extension. auth by phone sms once code

### Installation

Use [Bazaar](https://discuss.flarum.org/d/5151-flagrow-bazaar-the-extension-marketplace) or install manually with composer:

```sh
composer require hamzone/flarum-ext-auth-phone
```
  
```sh
php flarum hamzone:aesKey:build
```

### Updating

```sh
composer update hamzone/flarum-ext-auth-phone
```

### Links

- [Packagist](https://packagist.org/packages/hamzone/flarum-ext-auth-phone)

```
 "require-dev": {
        "hamzone/flarum-ext-auth-phone":"@dev"
    }
```

php flarum migrate
