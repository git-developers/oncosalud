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

namespace Bundle\ThemeBundle\Factory;

use Bundle\ThemeBundle\Model\Theme;
use Bundle\ThemeBundle\Model\ThemeInterface;

final class ThemeFactory implements ThemeFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create(string $name, string $path): ThemeInterface
    {
        return new Theme($name, $path);
    }
}
