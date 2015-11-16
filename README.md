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
* Tumblr

[![Build Status](https://travis-ci.org/dunglas/php-socialshare.png?branch=master)](https://travis-ci.org/dunglas/php-socialshare)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/1b5e4baf-2d6d-4dd0-aa1e-9c1f7f40619d/mini.png)](https://insight.sensiolabs.com/projects/1b5e4baf-2d6d-4dd0-aa1e-9c1f7f40619d)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dunglas/php-socialshare/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dunglas/php-socialshare/?branch=master)
[![HHVM Status](http://hhvm.h4cc.de/badge/dunglas/php-socialshare.svg)](http://hhvm.h4cc.de/package/dunglas/php-socialshare)

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

Tumblr share count cannot be retrieved for an arbitrary URL, and is therefore unavailable through this library.

## Installation

Use [Composer](https://getcomposer.org/) to install SocialShare:

    composer require dunglas/php-socialshare

# Usage

* [Simple example](examples/buttons.php)
* [Using SocialShare with Wordpress](https://dunglas.fr/2014/01/using-socialshare-with-wordpress-to-create-custom-social-networks-buttons/)
* [Twig extension](https://github.com/neemzy/share-extension)

## Cache

SocialShare relies on the [Doctrine Cache](http://docs.doctrine-project.org/projects/doctrine-common/en/latest/reference/caching.html) library to store data retrieved from social networks.
Doctrine Cache supports a lot of caching systems including but not limited to file, Memcache, MongoDB, Redis and APC.
Use the one that suit your needs.

## Delayed updates

When the third parameter of the `\SocialShare\SocialShare::getShares()` method is set to true, the number of share counts is **never** retrieved from social networks:
If a value is already in the cache (how old it is doesn't matter) it is used, otherwise 0 is returned

To force the update of share counts, the `\SocialShare\SocialShare::update()` method must be called.

Thanks to this tweak, HTTP requests retrieving shares counts from social networks will be issued after the page load.
Of course, only the next visitor will see updated counts, but it allows fast pages load even in the worst case: when the data must be updated from social networks servers.

If you use PHP FPM, the call to this method should be done after the end of the network connection with the client using the [`fastcgi_finish_request()` function](http://php.net/manual/en/function.fastcgi-finish-request.php).

## Other social networks

You can add support for new social networks by creating a class implementing the [`SocialShare\Provider\ProviderInterface`](src/SocialShare/Provider/ProviderInterface.php) interface.
Pull Requests are appreciated.

## They are using PHP SocialShare

* [Lost In The Supermarket](http://lostinthesupermarket.fr/blog/)
* [Les-Tilleuls.coop](https://les-tilleuls.coop/actualites/)

## Credits

This library has been written by [Kévin Dunglas](https://dunglas.fr) and [awesome contributors](https://github.com/dunglas/php-socialshare/graphs/contributors).
