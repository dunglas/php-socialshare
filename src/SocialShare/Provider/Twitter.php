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
 * Twitter.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class Twitter implements ProviderInterface
{
    const NAME = 'twitter';
    const SHARE_URL = 'https://twitter.com/intent/tweet?%s';
    const API_URL = 'https://cdn.api.twitter.com/1/urls/count.json?url=%s';

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
        $options['url'] = $url;

        return sprintf(self::SHARE_URL, http_build_query($options, null, '&'));
    }

    /**
     * {@inheritdoc}
     */
    public function getShares($url)
    {
        $data = json_decode(file_get_contents(sprintf(self::API_URL, urlencode($url))));

        return intval($data->count);
    }
}
