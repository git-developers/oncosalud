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

namespace spec\Component\TreeOneToMany\Filter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Component\TreeOneToMany\Data\DataSourceInterface;
use Component\TreeOneToMany\Data\ExpressionBuilderInterface;
use Component\TreeOneToMany\Filtering\FilterInterface;

final class EntityFilterSpec extends ObjectBehavior
{
    function it_implements_a_filter_interface(): void
    {
        $this->shouldImplement(FilterInterface::class);
    }

    function it_filters_by_id(
        DataSourceInterface $dataSource,
        ExpressionBuilderInterface $expressionBuilder
    ): void {
        $dataSource->getExpressionBuilder()->willReturn($expressionBuilder);

        $expressionBuilder->equals('entity', '7')->willReturn('EXPR1');
        $expressionBuilder->orX('EXPR1')->willReturn('EXPR');

        $dataSource->restrict('EXPR')->shouldBeCalled();

        $this->apply($dataSource, 'entity', '7', []);
    }

    function it_does_not_filters_when_data_id_is_not_defined(
        DataSourceInterface $dataSource,
        ExpressionBuilderInterface $expressionBuilder
    ): void {
        $dataSource->getExpressionBuilder()->willReturn($expressionBuilder);

        $expressionBuilder->equals('entity', Argument::any())->shouldNotBeCalled();
        $dataSource->restrict(Argument::any())->shouldNotBeCalled();

        $this->apply($dataSource, 'entity', '', []);
    }
}
