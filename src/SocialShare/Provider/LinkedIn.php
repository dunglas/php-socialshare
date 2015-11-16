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
 * LinkedIn.
 *
 * @author Morrison Laju <morrelinko@gmail.com>
 */
class LinkedIn implements ProviderInterface
{
    const NAME = 'linkedin';
    const SHARE_URL = 'https://www.linkedin.com/shareArticle?%s';
    const API_URL = 'https://www.linkedin.com/countserv/count/share?url=%s&format=json';

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * Gets the share link for the URL.
     *
     * @param array  $options This provider supports the following options:<pre>
     *                        title: the title
     *                        summary: the summary
     *                        source: the source
     *                        </pre>
     * @param string $url
     * @param array  $options
     *
     * @return string
     */
    public function getLink($url, array $options = array())
    {
        $options['mini'] = 'true';
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
