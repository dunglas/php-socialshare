<?php


namespace SocialShare\Provider;

/**
 * Pinterest
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class Pinterest extends AbstractProvider
{
    const SHARE_URL = 'https://www.pinterest.com/pin/create/link/?%s';
    const API_URL = 'https://api.pinterest.com/v1/urls/count.json?url=%s';

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
        $data = json_decode(preg_replace('/^receiveCount\((.*)\)$/', "\\1", file_get_contents(sprintf(self::API_URL, urlencode($url)))));

        return $data->count;
    }
}