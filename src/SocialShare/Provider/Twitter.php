<?php

/*
 * This file is part of the SocialShare package.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *  &  Gabrijel Gavranović <gabrijel@gavro.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SocialShare\Provider;

use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * Twitter.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class Twitter implements ProviderInterface
{
    const NAME = 'twitter';
    const SHARE_URL = 'https://twitter.com/intent/tweet?%s';

    private $consumer_key    = null;
    private $consumer_secret = null;
    private $oauth_token     = null;
    private $oauth_secret    = null;

    public function __construct($consumerKey, $consumerSecret, $oauthToken, $oauthSecret) {
        $this->consumer_key    = $consumerKey;
        $this->consumer_secret = $consumerSecret;
        $this->oauth_token     = $oauthToken;
        $this->oauth_secret    = $oauthSecret;
    }

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
    public function getShares($url, $max_id = false) // max_id used for iterative paginated search
    {
        $params = array(
            'q'     => urlencode($url),
            'count' => 100, // increase limit to REST API maximum: 100.
        );

        if($max_id) {
            $params['max_id'] = $max_id;
        }

        if($this->oauth_token && $this->oauth_secret) {
            $connection = $this->getConnectionWithAccessToken($this->oauth_token, $this->oauth_secret);
            $content = $connection->get("search/tweets", $params);

            $this->count += count($content->statuses);

            // paginated search, are there any 'next' results?
            if(isset($content->search_metadata->next_results)) {
                if($max_id_next = $this->findNext($content->search_metadata->next_results)) {
                    $this->getShares($url, $max_id_next);
                }
            }

            return $this->count;
        }
    }

    private function getConnectionWithAccessToken($oauth_token, $oauth_secret)
    {
        if($this->consumer_key && $this->consumer_secret) {
            $connection = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $oauth_token, $oauth_secret);
            return $connection;
        }
    }

    private function findNext($haystack)
    {
        $max_id_next = false;
        $max_id_search = explode('?', $haystack);

        if(isset($max_id_search[1])) {
            $max_id_search = explode('&', $max_id_search[1]);

            foreach ($max_id_search as $key => $value) {
                if(strpos($value, 'max_id=') !== false) {
                    $max_id_found = explode('=', $value);
                    if(isset($max_id_found[1])) {
                        $max_id_next = $max_id_found[1];
                    }
                }
            }
        }

        return $max_id_next;
    }
}
