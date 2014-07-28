# PHP SocialShare

SocialShare is a PHP library allowing to retrieve the number of shares of URLs on major social networks.
It is also able to generate valid sharing links.
It currently supports:
* Facebook
* Twitter
* Google Plus
* Pinterest
* LinkedIn
* Scoop.it!
* StumbleUpon

[![Build Status](https://travis-ci.org/dunglas/php-socialshare.png?branch=master)](https://travis-ci.org/dunglas/php-socialshare)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/1b5e4baf-2d6d-4dd0-aa1e-9c1f7f40619d/mini.png)](https://insight.sensiolabs.com/projects/1b5e4baf-2d6d-4dd0-aa1e-9c1f7f40619d)

## Key features

* **Speed**: counts are retrieved server-side and cached; no JavaScript SDK loading; no HTTP request from your visitor's browser to social networks
* **Privacy**: therefore, no data from your visitors is send to social networks, their privacy is respected
* **Customization**: there is no need to use official social networks buttons, you can create beautiful custom buttons displaying the number of shares

## Drawbacks

For most social networks, the number of shares is retrieved through services not officially approved by social networks.
These services can be shut down without warning.

| Service     | Official way? |
| ----------- | ------------- |
| Facebook    | yes           |
| Twitter     | no            |
| Google      | no            |
| LinkedIn    | yes           |
| Pinterest   | no            |
| Scoop.it!   | no            |
| StumbleUpon | no            |

Google returns only an estimate when there is more than 1000 shares (something like >10K). PHP Social Share converts this estimate to an integer.

## Installation

Use [Composer](http://getcomposer.org/) to install SocialShare:

    composer require dunglas/php-socialshare

# Usage

* [Example file](examples/buttons.php)
* [Using SocialShare with Wordpress](http://dunglas.fr/2014/01/using-socialshare-with-wordpress-to-create-custom-social-networks-buttons/)

## Cache

SocialShare relies on the [Doctrine Cache](http://docs.doctrine-project.org/projects/doctrine-common/en/latest/reference/caching.html) component to store data retrieved from social networks.
Doctrine Cache supports a lot of caching systems including but not limited to file, Memcache, MongoDB and Redis. Use the one that suit your needs.

## Other social networks

You can add support for new social networks by creating a class implementing the [`SocialShare\Provider\ProviderInterface`](src/SocialShare/Provider/ProviderInterface.php) interface.
Pull Requests are appreciated.

## They are using PHP SocialShare

* [Lost In The Supermarket](http://lostinthesupermarket.fr/blog/)
* [Les-Tilleuls.coop](http://les-tilleuls.coop/actualites/)

## Credits

This library has been written by [Kévin Dunglas](http://dunglas.fr) and [awesome contributors](https://github.com/dunglas/php-socialshare/graphs/contributors).
