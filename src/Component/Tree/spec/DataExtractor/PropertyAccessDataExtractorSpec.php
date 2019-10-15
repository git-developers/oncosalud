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

namespace spec\Component\Tree\DataExtractor;

use PhpSpec\ObjectBehavior;
use Component\Tree\DataExtractor\DataExtractorInterface;
use Component\Tree\Definition\Field;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

final class PropertyAccessDataExtractorSpec extends ObjectBehavior
{
    function let(PropertyAccessorInterface $propertyAccessor): void
    {
        $this->beConstructedWith($propertyAccessor);
    }

    function it_is_a_data_extractor(): void
    {
        $this->shouldImplement(DataExtractorInterface::class);
    }

    function it_uses_property_accessor_to_extract_the_data(PropertyAccessorInterface $propertyAccessor, Field $field): void
    {
        $field->getPath()->willReturn('foo');
        $propertyAccessor->getValue(['foo' => 'bar'], 'foo')->willReturn('Value');

        $this->get($field, ['foo' => 'bar'])->shouldReturn('Value');
    }
}
