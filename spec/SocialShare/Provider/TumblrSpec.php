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

class TumblrSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('SocialShare\Provider\Tumblr');
        $this->shouldHaveType('SocialShare\Provider\ProviderInterface');
    }

    public function it_gets_a_valid_link()
    {
        $this->getLink('http://dunglas.fr', array('name' => 'dunglas', 'description' => 'Mon super site'))->shouldBe('https://www.tumblr.com/share/link?name=dunglas&description=Mon+super+site&url=http%3A%2F%2Fdunglas.fr');
    }

    public function it_throws_an_error_when_trying_to_get_the_number_of_shares()
    {
        $this->shouldThrow('SocialShare\Exception\UnsupportedOperationException')->duringGetShares('http://dunglas.fr');
    }
}
