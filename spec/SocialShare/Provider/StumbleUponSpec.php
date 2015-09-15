<?php

/*
 * This file is part of the SocialShare package.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\SocialShare\Provider;

use PhpSpec\ObjectBehavior;

/**
 * @author Morrison Laju <morrelinko@gmail.com>
 */
class StumbleUponSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('SocialShare\Provider\StumbleUpon');
        $this->shouldHaveType('SocialShare\Provider\ProviderInterface');
    }

    public function it_gets_a_valid_link()
    {
        $this->getLink('https://dunglas.fr')->shouldBe('https://www.stumbleupon.com/badge/?url=https%3A%2F%2Fdunglas.fr');
    }

    public function it_gets_a_valid_number_of_shares()
    {
        $this->getShares('https://dunglas.fr')->shouldBeInteger();
    }
}
