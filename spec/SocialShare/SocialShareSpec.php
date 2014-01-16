<?php

/*
 * This file is part of the SocialShare package.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\SocialShare;

use Doctrine\Common\Cache\Cache;
use PhpSpec\ObjectBehavior;
use SocialShare\Provider\ProviderInterface;

/**
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class SocialShareSpec extends ObjectBehavior
{
    public function let(Cache $cache)
    {
        $this->beConstructedWith($cache);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('SocialShare\SocialShare');
    }

    public function it_registers_provider(ProviderInterface $provider)
    {
        $provider->getName()->shouldBeCalled();
        $this->registerProvider($provider, 1871);
    }

    public function it_gets_link(ProviderInterface $provider)
    {
        $provider->getName()->willReturn('test')->shouldBeCalled();
        $provider->getLink('http://dunglas.fr', array())->willReturn('http://example.com')->shouldBeCalled();
        $this->registerProvider($provider);
        $this->getLink('test', 'http://dunglas.fr')->shouldReturn('http://example.com');
    }

    public function it_gets_shares(ProviderInterface $provider)
    {
        $provider->getName()->willReturn('test')->shouldBeCalled();
        $provider->getShares('http://dunglas.fr')->willReturn(11)->shouldBeCalled();
        $this->registerProvider($provider);
        $this->getShares('test', 'http://dunglas.fr')->shouldReturn(11);
    }

    public function it_throws_error_when_provider_is_invalid()
    {
        $this->shouldThrow('RuntimeException')->duringGetLink('invalid', 'http://dunglas.fr', array('via' => '@dunglas'));
        $this->shouldThrow('RuntimeException')->duringGetShares('invalid', 'http://dunglas.fr');
    }
}
