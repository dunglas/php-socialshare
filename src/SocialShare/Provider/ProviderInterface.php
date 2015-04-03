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
 * ProviderInterface.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
interface ProviderInterface
{
    /**
     * Gets provider's name.
     *
     * @return string
     */
    public function getName();

    /**
     * Gets the share link for the URL.
     *
     * @param string $url
     * @param array  $options
     *
     * @return string
     */
    public function getLink($url, array $options = array());

    /**
     * Gets the number of shares of the URL.
     *
     * @param string $url
     *
     * @return int
     */
    public function getShares($url);
}
