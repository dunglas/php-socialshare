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
 * SocialShare.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class SocialShare
{
    /**
     * @var Cache
     */
    private $cache;
    /**
     * @var ProviderInterface[]
     */
    private $providers = array();
    /**
     * @var array
     */
    private $toUpdate = array();

    /**
     * @param Cache $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Registers a provider.
     *
     * @param ProviderInterface $provider
     * @param int|\DateInterval $lifeTime Life time in seconds or a \DateInterval instance
     */
    public function registerProvider(ProviderInterface $provider, $lifeTime = 3600)
    {
        if (!$lifeTime instanceof \DateInterval) {
            $lifeTime = new \DateInterval(sprintf('PT%dS', $lifeTime));
        }

        $this->providers[$provider->getName()] = array('provider' => $provider, 'lifeTime' => $lifeTime);
    }

    /**
     * Gets the sharing links for the given provider and url.
     *
     * @param string $providerName
     * @param string $url
     * @param array  $options
     *
     * @throws \RuntimeException
     *
     * @return string
     */
    public function getLink($providerName, $url, array $options = array())
    {
        $this->checkProvider($providerName);

        return  $this->providers[$providerName]['provider']->getLink($url, $options);
    }

    /**
     * Gets the number of share of the given URL on the given provider.
     *
     * @param string $providerName
     * @param string $url
     * @param bool   $delayUpdate
     *
     * @throws \RuntimeException
     *
     * @return int
     */
    public function getShares($providerName, $url, $delayUpdate = false)
    {
        $this->checkProvider($providerName);

        $id = $this->getId($providerName, $url);
        $lifeTime = $this->providers[$providerName]['lifeTime'];
        $now = new \DateTime();

        $dataFromCache = $this->cache->fetch($id);
        $shares = isset($dataFromCache[0]) ? $dataFromCache[0] : false;
        $expired = isset($dataFromCache[1]) && $dataFromCache[1]->add($lifeTime) < $now;

        if (!$delayUpdate && (false === $shares || $expired)) {
            $shares = $this->providers[$providerName]['provider']->getShares($url);

            $this->cache->save($id, array($shares, $now));
        } else {
            if ($delayUpdate && (false === $shares || $expired)) {
                $this->toUpdate[$providerName][] = $url;
            }

            $shares = intval($shares);
        }

        return $shares;
    }

    /**
     * Gets the total number of share of the given URL for all providers.
     *
     * @param string $url
     *
     * @throws \RuntimeException
     *
     * @return int
     */
    public function getSharesTotal($url)
    {
        $shares = 0;
        foreach ($this->providers as $providerName => $provider) {
            $shares += $this->getShares($providerName, $url);
        }

        return $shares;
    }

    /**
     * Updates delayed URLs.
     */
    public function update()
    {
        $now = new \DateTime();

        foreach ($this->toUpdate as $providerName => $urls) {
            foreach ($urls as $url) {
                $shares = $this->providers[$providerName]['provider']->getShares($url);

                $this->cache->save($this->getId($providerName, $url), array($shares, $now));
            }
        }
    }

    /**
     * Checks if the provider is registered.
     *
     * @param string $providerName
     *
     * @throws \RuntimeException
     */
    private function checkProvider($providerName)
    {
        if (!isset($this->providers[$providerName])) {
            throw new \RuntimeException(sprintf('Unknown provider "%s".', $providerName));
        }
    }

    /**
     * Gets the ID corresponding to this provider name and URL.
     *
     * @param string $providerName
     * @param string $url
     *
     * @return string
     */
    private function getId($providerName, $url)
    {
        return sprintf('%s_%s', $providerName, $url);
    }
}
