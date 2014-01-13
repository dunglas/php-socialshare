<?php


namespace SocialShare\Provider;

/**
 * Twitter
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class Twitter extends AbstractProvider
{
    const SHARE_URL = 'https://twitter.com/intent/tweet?%s';
    const API_URL = 'https://cdn.api.twitter.com/1/urls/count.json?url=%s';

    /**
     * {@inheritDoc}
     */
    public function getLink($url, array $options = array())
    {
        $options['url'] = $url;

        return sprintf(self::SHARE_URL, http_build_query($options));
    }

    /**
     * {@inheritDoc}
     */
    public function getShares($url)
    {
        $data = json_decode(file_get_contents(sprintf(self::API_URL, urlencode($url))));

        return $data->count;
    }
}