<?php

use Doctrine\Common\Cache\PhpFileCache;
use SocialShare\SocialShare;
use SocialShare\Provider\Facebook;
use SocialShare\Provider\Twitter;
use SocialShare\Provider\Google;
use SocialShare\Provider\Pinterest;

require '../vendor/autoload.php';

$cache = new PhpFileCache(sys_get_temp_dir());
$socialShare = new SocialShare($cache);

$socialShare->registerProvider(new Facebook());
$socialShare->registerProvider(new Twitter());
$socialShare->registerProvider(new Google());
$socialShare->registerProvider(new Pinterest());
?>

<ul>
    <li>
        <a href="<?php echo htmlspecialchars($socialShare->getLink('facebook', 'http://dunglas.fr')) ?>">
            Share on Facebook (<?php echo $socialShare->getShares('facebook', 'http://dunglas.fr') ?>)
        </a>
    </li>

    <li>
        <a href="<?php echo htmlspecialchars($socialShare->getLink('twitter', 'http://dunglas.fr', array('via' => '@dunglas', 'text' => 'Kévin Dunglas\' SocialShare library'))) ?>">
            Share on Twitter (<?php echo $socialShare->getShares('twitter', 'http://dunglas.fr') ?>)
        </a>
    </li>

    <li>
        <a href="<?php echo htmlspecialchars($socialShare->getLink('google', 'http://dunglas.fr')) ?>">
            Share on Google Plus (<?php echo $socialShare->getShares('google', 'http://dunglas.fr') ?>)
        </a>
    </li>
    <li>
        <a href="<?php echo htmlspecialchars($socialShare->getLink('pinterest', 'http://dunglas.fr', array('description' => 'Kévin\'s avatar', 'http://dunglas.fr/wp-content/uploads/2008/03/191x300xkeyes-191x300.png.pagespeed.ic.weNKMj-Pq4.png'))) ?>">
            Share on Pinterest (<?php echo $socialShare->getShares('pinterest', 'http://dunglas.fr') ?>)
        </a>
    </li>
</ul>
