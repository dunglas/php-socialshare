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
 * Facebook.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class Facebook implements ProviderInterface
{
    const NAME = 'facebook';
    const SHARE_URL = 'https://www.facebook.com/sharer/sharer.php?u=%s';
    const API_URL = 'https://graph.facebook.com/?id=%s';

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
        $data = json_decode(file_get_contents(sprintf(self::API_URL, urlencode($url))));

        if (isset($data->likes)) {
            return intval($data->likes);
        }
        if (isset($data->shares)) {
            return intval($data->shares);
        }

        return 0;
    }
}
