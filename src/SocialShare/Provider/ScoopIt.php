<?php

/*
 * This file is part of the SocialShare package.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SocialShare\Provider;

/**
 * Scoop.it!
 *
 * @author David Duquenoy <david@partage-it.com>
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class ScoopIt implements ProviderInterface
{
    const NAME = 'scoopit';
    const SHARE_URL = 'https://www.scoop.it/bookmarklet?url=%s';
    const BUTTON_URL = 'http://www.scoop.it/button?position=horizontal&url=%s';
    const DTD = '<!DOCTYPE html>';

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * {@inheritdoc}
     */
    public function getLink($url, array $options = array())
    {
        return sprintf(self::SHARE_URL, urlencode($url));
    }

    /**
     * {@inheritdoc}
     */
    public function getShares($url)
    {
        $html = file_get_contents(sprintf(self::BUTTON_URL, urlencode($url)));

        // Disable libxml errors
        $internalErrors = libxml_use_internal_errors(true);
        $document = new \DOMDocument();
        $document->loadHTML(self::DTD.$html);
        $aggregateCount = $document->getElementById('scoopit_count');

        // Restore libxml errors
        libxml_use_internal_errors($internalErrors);

        return intval($aggregateCount->nodeValue);
    }
}
