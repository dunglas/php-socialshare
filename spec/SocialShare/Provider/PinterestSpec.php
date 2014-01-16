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
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class PinterestSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('SocialShare\Provider\Pinterest');
        $this->shouldHaveType('SocialShare\Provider\ProviderInterface');
    }

    public function it_gets_a_valid_link()
    {
        $this->getLink('http://dunglas.fr/a-propos/', array('description' => 'Superbe avatar', 'media' => 'http://dunglas.fr/wp-content/uploads/2008/03/191x300xkeyes-191x300.png.pagespeed.ic.weNKMj-Pq4.png'))->shouldBe('https://www.pinterest.com/pin/create/link/?description=Superbe+avatar&media=http%3A%2F%2Fdunglas.fr%2Fwp-content%2Fuploads%2F2008%2F03%2F191x300xkeyes-191x300.png.pagespeed.ic.weNKMj-Pq4.png&url=http%3A%2F%2Fdunglas.fr%2Fa-propos%2F');
    }

    public function it_gets_a_valid_number_of_shares()
    {
        $this->getShares('http://dunglas.fr')->shouldBeInteger();
    }
}
