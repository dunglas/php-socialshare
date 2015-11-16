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
 * Google.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class Google implements ProviderInterface
{
    const NAME = 'google';
    const SHARE_URL = 'https://plus.google.com/share?url=%s';
    const IFRAME_URL = 'https://plusone.google.com/_/+1/fastbutton?url=%s';

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
        $html = file_get_contents(sprintf(self::IFRAME_URL, urlencode($url)));

        // Disable libxml errors
        $internalErrors = libxml_use_internal_errors(true);
        $document = new \DOMDocument();
        $document->loadHTML($html);
        $aggregateCount = $document->getElementById('aggregateCount');

        // Restore libxml errors
        libxml_use_internal_errors($internalErrors);

        // Instead of big numbers, Google returns strings like >10K or 12M
        if (preg_match('/([0-9]+)(K|M)/', $aggregateCount->nodeValue, $matches)) {
            $multiplier = 'K' === $matches[2] ? 1000 : 1000000;

            return $matches[1] * $multiplier;
        }

        return intval($aggregateCount->nodeValue);
    }
}
