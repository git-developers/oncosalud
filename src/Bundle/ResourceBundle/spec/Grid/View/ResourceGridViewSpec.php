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

namespace spec\Bundle\ResourceBundle\Grid\View;

use PhpSpec\ObjectBehavior;
use Bundle\ResourceBundle\Controller\RequestConfiguration;
use Component\Grid\Definition\Grid;
use Component\Grid\Parameters;
use Component\Grid\View\GridView;
use Component\Resource\Metadata\MetadataInterface;

final class ResourceGridViewSpec extends ObjectBehavior
{
    function let(
        Grid $gridDefinition,
        MetadataInterface $resourceMetadata,
        RequestConfiguration $requestConfiguration
    ): void {
        $this->beConstructedWith(['foo', 'bar'], $gridDefinition, new Parameters(), $resourceMetadata, $requestConfiguration);
    }

    function it_extends_default_GridView(): void
    {
        $this->shouldHaveType(GridView::class);
    }

    function it_has_resource_metadata(MetadataInterface $resourceMetadata): void
    {
        $this->getMetadata()->shouldReturn($resourceMetadata);
    }

    function it_has_request_configuration(RequestConfiguration $requestConfiguration): void
    {
        $this->getRequestConfiguration()->shouldReturn($requestConfiguration);
    }
}
