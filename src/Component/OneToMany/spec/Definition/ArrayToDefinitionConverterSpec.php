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

namespace spec\Component\OneToMany\Definition;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Component\OneToMany\Definition\Action;
use Component\OneToMany\Definition\ActionGroup;
use Component\OneToMany\Definition\ArrayToDefinitionConverterInterface;
use Component\OneToMany\Definition\Field;
use Component\OneToMany\Definition\Filter;
use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Event\OneToManyDefinitionConverterEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class ArrayToDefinitionConverterSpec extends ObjectBehavior
{
    function let(EventDispatcherInterface $eventDispatcher): void
    {
        $this->beConstructedWith($eventDispatcher);
    }

    function it_implements_array_to_definition_converter(): void
    {
        $this->shouldImplement(ArrayToDefinitionConverterInterface::class);
    }

    function it_converts_an_array_to_grid_definition(EventDispatcherInterface $eventDispatcher): void
    {
        $grid = OneToMany::fromCodeAndDriverConfiguration(
            'sylius_admin_tax_category',
            'doctrine/orm',
            ['resource' => 'sylius.tax_category']
        );

        $grid->setSorting(['code' => 'desc']);

        $grid->setLimits([9, 18]);

        $codeField = Field::fromNameAndType('code', 'string');
        $codeField->setLabel('System Code');
        $codeField->setPath('method.code');
        $codeField->setOptions(['template' => 'bar.html.twig']);
        $codeField->setSortable('code');

        $grid->addField($codeField);

        $enabledField = Field::fromNameAndType('enabled', 'boolean');
        $enabledField->setLabel('Enabled');
        $enabledField->setPath('method.enabled');
        $enabledField->setSortable('enabled');

        $grid->addField($enabledField);

        $statusField = Field::fromNameAndType('status', 'string');
        $statusField->setLabel('Status');
        $statusField->setSortable('status');

        $grid->addField($statusField);

        $nameField = Field::fromNameAndType('name', 'string');
        $nameField->setLabel('Name');
        $nameField->setSortable('name');

        $grid->addField($nameField);

        $titleField = Field::fromNameAndType('title', 'string');
        $titleField->setLabel('Title');

        $grid->addField($titleField);

        $viewAction = Action::fromNameAndType('view', 'link');
        $viewAction->setLabel('Display Tax Category');
        $viewAction->setOptions(['foo' => 'bar']);
        $defaultActionGroup = ActionGroup::named('default');
        $defaultActionGroup->addAction($viewAction);

        $grid->addActionGroup($defaultActionGroup);

        $filter = Filter::fromNameAndType('enabled', 'boolean');
        $filter->setOptions(['fields' => ['firstName', 'lastName']]);
        $filter->setCriteria('true');
        $grid->addFilter($filter);

        $eventDispatcher
            ->dispatch('sylius.grid.admin_tax_category', Argument::type(OneToManyDefinitionConverterEvent::class))
            ->shouldBeCalled()
        ;

        $definitionArray = [
            'driver' => [
                'name' => 'doctrine/orm',
                'options' => ['resource' => 'sylius.tax_category'],
            ],
            'sorting' => [
                'code' => 'desc',
            ],
            'limits' => [9, 18],
            'fields' => [
                'code' => [
                    'type' => 'string',
                    'label' => 'System Code',
                    'path' => 'method.code',
                    'sortable' => 'code',
                    'options' => [
                        'template' => 'bar.html.twig',
                    ],
                ],
                'enabled' => [
                    'type' => 'boolean',
                    'label' => 'Enabled',
                    'path' => 'method.enabled',
                    'sortable' => true,
                ],
                'status' => [
                    'type' => 'string',
                    'label' => 'Status',
                    'sortable' => true,
                ],
                'name' => [
                    'type' => 'string',
                    'label' => 'Name',
                    'sortable' => null,
                ],
                'title' => [
                    'type' => 'string',
                    'label' => 'Title',
                    'sortable' => false,
                ],
            ],
            'filters' => [
                'enabled' => [
                    'type' => 'boolean',
                    'options' => [
                        'fields' => ['firstName', 'lastName'],
                    ],
                    'default_value' => 'true',
                ],
            ],
            'actions' => [
                'default' => [
                    'view' => [
                        'type' => 'link',
                        'label' => 'Display Tax Category',
                        'options' => [
                            'foo' => 'bar',
                        ],
                    ],
                ],
            ],
        ];

        $this->convert('sylius_admin_tax_category', $definitionArray)->shouldBeLike($grid);
    }
}
