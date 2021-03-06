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

namespace spec\Bundle\ResourceBundle\Controller;

use PhpSpec\ObjectBehavior;
use Bundle\ResourceBundle\Controller\ResourceDeleteHandlerInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Repository\RepositoryInterface;

final class ResourceDeleteHandlerSpec extends ObjectBehavior
{
    function it_implements_a_resource_delete_handler_interface(): void
    {
        $this->shouldImplement(ResourceDeleteHandlerInterface::class);
    }

    function it_removes_resource_via_repository(RepositoryInterface $repository, ResourceInterface $resource): void
    {
        $repository->remove($resource)->shouldBeCalled();

        $this->handle($resource, $repository);
    }
}
