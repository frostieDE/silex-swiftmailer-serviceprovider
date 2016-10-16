# Silex SwiftMailer ServiceProvider

[![Build Status](https://travis-ci.org/frostieDE/silex-swiftmailer-serviceprovider.svg?branch=master)](https://travis-ci.org/frostieDE/silex-swiftmailer-serviceprovider)
[![Code Climate](https://codeclimate.com/github/frostieDE/silex-swiftmailer-serviceprovider/badges/gpa.svg)](https://codeclimate.com/github/frostieDE/silex-swiftmailer-serviceprovider)

ServiceProvider for Silex which enables `mail()`, `sendmail` and `null` transports for SwiftMailer.

## Installation

```
$ composer require frostiede/silex-swiftmailer-serviceprovider
```

Afterwards, register the ServiceProvider:

```php
$app->register(new SwiftMailerServiceProvider(), [
    /** your options as you would provide in the Silex' SwiftMailerServiceProvider */
]);
```

**Note:** This is a replacement for the default `SwiftMailerServiceProvider` provided by Silex.
So only use one of them. 

## Configuration

In order to use one of the three new supported transports, simply provide the transport in the
constructor. Available options are:

* `null`
* `mail`
* `sendmail`

Example:

```php
$app->register(new SwiftMailerServiceProvider('null'), [
    /** your options as you would provide in the Silex' SwiftMailerServiceProvider */
]);
```

# Contribution

Any help is welcomed. Feel free to create issues and merge requests :-)

# License

MIT License