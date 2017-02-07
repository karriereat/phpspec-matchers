[![Build Status](https://travis-ci.org/fetzi/phpspec-matchers.svg?branch=master)](https://travis-ci.org/fetzi/phpspec-matchers)

# Collection of phpspec Matchers

This package contains a collection of additional phpspec matchers.

## Installation
You can install the package via composer
```
composer require karriere/phpspec-matchers
```

To be able to use the matchers you need to add the following definition to your `phpspec.yml`
```php
extensions:
    Karriere\PhpSpecMatchers\Extension: ~
```
## Matchers

### beAnyOf
This matcher allows to check the return value against a set of values. 
Assume you have some sort of random mechanism to get an integer between 2 and 4. The you can use the `shouldBeAnyOf` matcher:

```php
$this->method()->shouldBeAnyOf(2, 3, 4);
```

### beSomeOf
This matcher allows to check if the returned array values are contained in a set of values.

```php
// $this->method() may return [1, 2, 3]
$this->method()->shouldBeSomeOf(1, 2, 3, 4, 5);
```

### beJson
This matcher checks if the return value is a valid json string

```php
$this->method()->shouldBeJson();
```

### haveJsonKey
This matcher checks if the returned json string contains a json key.

```php
$this->method()->shouldHaveJsonKey('key');
```

To match against subkey you can use the dot notation.
For example let's assume the following json structure

```json
{
  "key": {
    "subkey": "value"
  }
}
```

The key for this check is 'key.subkey'

```php
$this->method()->shouldHaveJsonKey('key.subkey');
```

### haveJsonKeyWithValue
This matcher checks if the returned json string contains the json key and the desired value.
The dot syntax for subkeys can also be applied.

```php
$this->method()->shouldHaveJsonKeyWithValue('key.subkey', 'value');
```

## License

Apache License 2.0 Please see [LICENSE](LICENSE) for more information.
