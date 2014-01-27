<?php

use Doctrine\Common\Cache\PhpFileCache;
use SocialShare\SocialShare;
use SocialShare\Provider\Facebook;
use SocialShare\Provider\Twitter;
use SocialShare\Provider\Google;
use SocialShare\Provider\Pinterest;
use SocialShare\Provider\LinkedIn;
use SocialShare\Provider\ScoopIt;
use SocialShare\Provider\StumbleUpon;

require '../vendor/autoload.php';

$cache = new PhpFileCache(sys_get_temp_dir());
$socialShare = new SocialShare($cache);

$socialShare->registerProvider(new Facebook());
$socialShare->registerProvider(new Twitter());
$socialShare->registerProvider(new Google());
$socialShare->registerProvider(new Pinterest());
$socialShare->registerProvider(new LinkedIn());
$socialShare->registerProvider(new ScoopIt());
$socialShare->registerProvider(new StumbleUpon());
?>

<ul>
    <li>
        <a href="<?php echo htmlspecialchars($socialShare->getLink(Facebook::NAME, 'http://dunglas.fr')) ?>">
            Share on Facebook (<?php echo $socialShare->getShares(Facebook::NAME, 'http://dunglas.fr') ?>)
        </a>
    </li>

    <li>
        <a href="<?php echo htmlspecialchars($socialShare->getLink(Twitter::NAME, 'http://dunglas.fr', array('via' => '@dunglas', 'text' => 'Kévin Dunglas\' SocialShare library'))) ?>">
            Share on Twitter (<?php echo $socialShare->getShares(Twitter::NAME, 'http://dunglas.fr') ?>)
        </a>
    </li>

    <li>
        <a href="<?php echo htmlspecialchars($socialShare->getLink(Google::NAME, 'http://dunglas.fr')) ?>">
            Share on Google Plus (<?php echo $socialShare->getShares(Google::NAME, 'http://dunglas.fr') ?>)
        </a>
    </li>
    <li>
        <a href="<?php echo htmlspecialchars($socialShare->getLink(Pinterest::NAME, 'http://dunglas.fr', array('description' => 'Kévin\'s avatar', 'media' => 'http://dunglas.fr/wp-content/uploads/2008/03/191x300xkeyes-191x300.png.pagespeed.ic.weNKMj-Pq4.png'))) ?>">
            Share on Pinterest (<?php echo $socialShare->getShares(Pinterest::NAME, 'http://dunglas.fr') ?>)
        </a>
    </li>
    <li>
        <a href="<?php echo htmlspecialchars($socialShare->getLink(LinkedIn::NAME, 'http://dunglas.fr', array('title' => 'Kévin\'s website', 'summary' => 'The blog of Kévin', 'source' => 'Kévin'))) ?>">
            Share on LinkedIn (<?php echo $socialShare->getShares(LinkedIn::NAME, 'http://dunglas.fr') ?>)
        </a>
    </li>
    <li>
        <a href="<?php echo htmlspecialchars($socialShare->getLink(ScoopIt::NAME, 'http://dunglas.fr')) ?>">
            Share on Scoop.it! (<?php echo $socialShare->getShares(ScoopIt::NAME, 'http://dunglas.fr') ?>)
        </a>
    </li>
    <li>
        <a href="<?php echo htmlspecialchars($socialShare->getLink(StumbleUpon::NAME, 'http://dunglas.fr')) ?>">
            Share on StumbleUpon (<?php echo $socialShare->getShares(StumbleUpon::NAME, 'http://dunglas.fr') ?>)
        </a>
    </li>
</ul>
