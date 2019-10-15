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

namespace Bundle\ResourceBundle\Controller;

use Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Component\Resource\Model\ResourceInterface;

interface FlashHelperInterface
{
    /**
     * @param RequestConfiguration $requestConfiguration
     * @param string $actionName
     * @param ResourceInterface|null $resource
     */
    public function addSuccessFlash(
        RequestConfiguration $requestConfiguration,
        string $actionName,
        ?ResourceInterface $resource = null
    ): void;

    /**
     * @param RequestConfiguration $requestConfiguration
     * @param string $actionName
     */
    public function addErrorFlash(RequestConfiguration $requestConfiguration, string $actionName): void;

    /**
     * @param RequestConfiguration $requestConfiguration
     * @param ResourceControllerEvent $event
     */
    public function addFlashFromEvent(RequestConfiguration $requestConfiguration, ResourceControllerEvent $event): void;
}