<?php

/*
 * This file is part of the SocialShare package.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SocialShare;

use Doctrine\Common\Cache\Cache;
use SocialShare\Provider\ProviderInterface;

/**
 * SocialShare
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class SocialShare
{
    /**
     * @var Cache
     */
    protected $cache;
    /**
     * @var array
     */
    protected $providers = array();

    /**
     * @param Cache $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Registers a provider
     *
     * @param ProviderInterface $provider
     * @param int               $lifeTime
     */
    public function registerProvider(ProviderInterface $provider, $lifeTime = 3600)
    {
        $this->providers[$provider->getName()] = array('provider' => $provider, 'lifeTime' => $lifeTime);
    }

    /**
     * Gets the sharing links for the given provider and url
     *
     * @param  string            $providerName
     * @param  string            $url
     * @param  array             $options
     * @throws \RuntimeException
     * @return string
     */
    public function getLink($providerName, $url, array $options = array())
    {
        $this->checkProvider($providerName);

        return  $this->providers[$providerName]['provider']->getLink($url, $options);
    }

    /**
     * Gets the number of share of the given URL on the given provider
     *
     * @param  string            $providerName
     * @param  string            $url
     * @throws \RuntimeException
     * @return int
     */
    public function getShares($providerName, $url)
    {
        $this->checkProvider($providerName);

        $id = sprintf('%s_%s', $providerName, $url);

        $shares = $this->cache->fetch($id);
        if (!$shares) {
            $shares = $this->providers[$providerName]['provider']->getShares($url);

            $this->cache->save($id, $shares, $this->providers[$providerName]['lifeTime']);
        }

        return $shares;
    }

    /**
     * Checks if the provider is registered
     *
     * @param  string            $providerName
     * @throws \RuntimeException
     */
    private function checkProvider($providerName)
    {
        if (!isset($this->providers[$providerName])) {
            throw new \RuntimeException(sprintf('Unknow provider "%s".', $providerName));
        }
    }
}
