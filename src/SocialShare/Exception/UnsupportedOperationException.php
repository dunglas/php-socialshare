<?php

/*
 * This file is part of the SocialShare package.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SocialShare\Exception;

class UnsupportedOperationException extends \Exception
{
    /**
     * @param string $provider
     * @param string $operation
     */
    public function __construct($provider, $operation)
    {
        parent::__construct(sprintf('Provider %s does not support the %s operation', $provider, $operation));
    }
}
