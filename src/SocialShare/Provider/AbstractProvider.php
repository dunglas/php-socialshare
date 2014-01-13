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
 * AbstractProvider
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
abstract class AbstractProvider implements ProviderInterface
{

    /**
     * {@inheritDoc}
     */
    abstract public function getLink($url, array $options = array());

    /**
     * {@inheritDoc}
     */
    abstract public function getShares($url);
}