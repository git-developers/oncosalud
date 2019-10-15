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

namespace spec\Component\OneToMany\Sorting;

use PhpSpec\ObjectBehavior;
use Component\OneToMany\Data\DataSourceInterface;
use Component\OneToMany\Data\ExpressionBuilderInterface;
use Component\OneToMany\Definition\Field;
use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Parameters;
use Component\OneToMany\Sorting\SorterInterface;

final class SorterSpec extends ObjectBehavior
{
    function it_implements_grid_data_source_sorter_interface(): void
    {
        $this->shouldImplement(SorterInterface::class);
    }

    function it_sorts_the_data_source_via_expression_builder_based_on_the_grid_definition(
        OneToMany $grid,
        Field $nameField,
        Field $nonSortableField,
        DataSourceInterface $dataSource,
        ExpressionBuilderInterface $expressionBuilder
    ): void {
        $parameters = new Parameters();

        $dataSource->getExpressionBuilder()->willReturn($expressionBuilder);

        $grid->getSorting()->willReturn(['name' => 'desc', 'non_sortable_field' => 'asc']);

        $grid->hasField('name')->willReturn(true);
        $grid->getField('name')->willReturn($nameField);
        $nameField->isSortable()->willReturn(true);
        $nameField->getSortable()->willReturn('translation.name');

        $grid->hasField('non_sortable_field')->willReturn(true);
        $grid->getField('non_sortable_field')->willReturn($nonSortableField);
        $nonSortableField->isSortable()->willReturn(false);
        $nonSortableField->getSortable()->willReturn(null);

        $expressionBuilder->addOrderBy('translation.name', 'desc')->shouldBeCalled();
        $expressionBuilder->addOrderBy(null, 'asc')->shouldNotBeCalled();

        $this->sort($dataSource, $grid, $parameters);
    }

    function it_sorts_the_data_source_via_expression_builder_based_on_sorting_parameter(
        OneToMany $grid,
        Field $nameField,
        Field $nonSortableField,
        DataSourceInterface $dataSource,
        ExpressionBuilderInterface $expressionBuilder
    ): void {
        $parameters = new Parameters(['sorting' => ['name' => 'asc', 'non_sortable_field' => 'asc']]);

        $dataSource->getExpressionBuilder()->willReturn($expressionBuilder);

        $grid->getSorting()->willReturn(['code' => 'desc']);

        $grid->hasField('name')->willReturn(true);
        $grid->getField('name')->willReturn($nameField);
        $nameField->isSortable()->willReturn(true);
        $nameField->getSortable()->willReturn('translation.name');

        $grid->hasField('non_sortable_field')->willReturn(true);
        $grid->getField('non_sortable_field')->willReturn($nonSortableField);
        $nonSortableField->isSortable()->willReturn(false);
        $nonSortableField->getSortable()->willReturn(null);

        $expressionBuilder->addOrderBy('translation.name', 'asc')->shouldBeCalled();
        $expressionBuilder->addOrderBy(null, 'asc')->shouldNotBeCalled();

        $this->sort($dataSource, $grid, $parameters);
    }
}
