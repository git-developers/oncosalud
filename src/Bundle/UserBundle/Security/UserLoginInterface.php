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

namespace Bundle\UserBundle\Security;

use Component\User\Model\UserInterface;

interface UserLoginInterface
{
    /**
     * @param UserInterface $user
     * @param string|null $firewallName
     */
    public function login(UserInterface $user, ?string $firewallName = null);
}
