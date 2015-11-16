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
 * StumbleUpon.
 *
 * @author Morrison Laju <morrelinko@gmail.com>
 */
class StumbleUpon implements ProviderInterface
{
    const NAME = 'stumbleupon';
    const SHARE_URL = 'https://www.stumbleupon.com/badge/?%s';
    const API_URL = 'https://www.stumbleupon.com/services/1.01/badge.getinfo?url=%s';

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
        $data = json_decode(file_get_contents(sprintf(self::API_URL, urlencode($url))), true);

        return isset($data['result']['views']) ? intval($data['result']['views']) : 0;
    }
}
