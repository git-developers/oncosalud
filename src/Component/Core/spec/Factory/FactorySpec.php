<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\Component\Resource\Factory;

use PhpSpec\ObjectBehavior;
use Component\Resource\Factory\FactoryInterface;

final class FactorySpec extends ObjectBehavior
{
    function let(): void
    {
        $this->beConstructedWith(\stdClass::class);
    }

    function it_implements_factory_interface(): void
    {
        $this->shouldHaveType(FactoryInterface::class);
    }

    function it_creates_a_new_instance_of_a_resource(): void
    {
        $this->createNew()->shouldHaveType(\stdClass::class);
    }
}
