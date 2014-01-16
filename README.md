# PHP SocialShare

SocialShare is a PHP library allowing to retrieve the number of shares of URLs on major social networks.
It is also able to generate valid sharing links.
It currently supports Facebook, Twitter, Google Plus and Pinterest.

[![Build Status](https://travis-ci.org/dunglas/php-socialshare.png?branch=master)](https://travis-ci.org/dunglas/php-socialshare)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/1b5e4baf-2d6d-4dd0-aa1e-9c1f7f40619d/mini.png)](https://insight.sensiolabs.com/projects/1b5e4baf-2d6d-4dd0-aa1e-9c1f7f40619d)

## Key features

* **Speed**: counts are retrieved server-side and cached; no JavaScript SDK loading; no HTTP request to social networks
* **Privacy**: therefore, no data from your visitors is send to social networks, their privacy is respected
* **Customization**: there is no need to use official social networks buttons, you can create beautiful custom buttons displaying the number of shares

## Drawback

For most social networks, the number of shares is retrieved through services not officially approved by social networks.
These services can be shut down without warning.

| Service   | Official way? |
| --------- | ------------- |
| Facebook  | yes           |
| Twitter   | no            |
| Google    | no            |
| Pinterest | no            |

## Installation

Use [Composer](http://getcomposer.org/) to install SocialShare:

    composer require dunglas/php-socialshare

# Usage

See [the example file](examples/buttons.php).

## Cache

SocialShare relies on the [Doctrine Cache](http://docs.doctrine-project.org/projects/doctrine-common/en/latest/reference/caching.html) component to store data retrieved from social networks.
Doctrine Cache supports a lot of caching systems including but limited to file, Memcache, MongoDB and Redis. Use the one that suit your needs.

## Other social networks

You can add support for new social networks by creating a class implementing the [`SocialShare\Provider\ProviderInterface`](src/SocialShare/Provider/ProviderInterface.php) interface.
Pull Requests are appreciated.

## Credits

This library has been written by [Kévin Dunglas](http://dunglas.fr).