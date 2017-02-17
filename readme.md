<a href="https://www.karriere.at/" target="_blank"><img width="200" src="http://www.karriere.at/images/layout/katlogo.svg"></a>
<span>&nbsp;&nbsp;&nbsp;</span>
[![Build Status](https://travis-ci.org/karriereat/phpspec-matchers.svg?branch=master)](https://travis-ci.org/karriereat/phpspec-matchers)
[![codecov](https://codecov.io/gh/karriereat/phpspec-matchers/branch/master/graph/badge.svg)](https://codecov.io/gh/karriereat/phpspec-matchers)
[![StyleCI](https://styleci.io/repos/81121039/shield?branch=master)](https://styleci.io/repos/81121039)


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

## Matcher Usage
All custom matchers in this package implement the positive and the negative case. For example you can use:
```php
$this->method()->shouldBeAnyOf(1, 2, 3);
```
and also
```php
$this->method()->shouldNotBeAnyOf(1, 2, 3);
```

## Matchers
**General Matchers**
* [beAnyOf](#beanyof)
* [beSomeOf](#besomeof)
* [rangeBetween](#rangebetween)
* [beEmpty](#beempty)
* [beNull](#benull)
* [beLessThan](#belessthan)
* [beGreaterThan](#begreaterthan)

**Json Matchers**
* [beJson](#bejson)
* [haveJsonKey](#havejsonkey)
* [haveJsonKeyWithValue](#havejsonkeywithvalue)

### General Matchers

#### beAnyOf
This matcher allows to check the return value against a set of values. 
Assume you have some sort of random mechanism to get an integer between 2 and 4. The you can use the `shouldBeAnyOf` matcher:

```php
$this->method()->shouldBeAnyOf(2, 3, 4);
```

#### beSomeOf
This matcher allows to check if the returned array values are contained in a set of values.

```php
// $this->method() may return [1, 2, 3]
$this->method()->shouldBeSomeOf(1, 2, 3, 4, 5);
```

#### rangeBetween
This matcher allows to check if the given return value is inside a numeric range.
```php
$this->method()->shouldRangeBetween(2, 4);
$this->method()->shouldRangeBetween(0.1, 0.9);
```

#### beEmpty
This matcher allows to check if the given return value is empty. The implementation uses the [empty](http://php.net/manual/en/function.empty.php) implementation.
```php
$this->method()->shouldBeEmpty();
```

#### beNull
This matcher allows to check if the given return value is null. The implementation uses the [is_null](http://php.net/manual/en/function.is-null.php) implementation.
```php
$this->method()->shouldBeNull();
```

#### beLessThan
This matcher allows to check if the given return value is less than a specified value.
```php
$this->method()->shouldBeLessThan(10);
```

#### beGreaterThan
This matcher allows to check if the given return value is greater than a specified value.
```php
$this->method()->shouldBeGreaterThan(10);
```

### Json Matchers

#### beJson
This matcher checks if the return value is a valid json string

```php
$this->method()->shouldBeJson();
```

#### haveJsonKey
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

#### haveJsonKeyWithValue
This matcher checks if the returned json string contains the json key and the desired value.
The dot syntax for subkeys can also be applied.

```php
$this->method()->shouldHaveJsonKeyWithValue('key.subkey', 'value');
```

## License

Apache License 2.0 Please see [LICENSE](LICENSE) for more information.
