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

namespace Bundle\ThemeBundle\Locator;

use Bundle\ThemeBundle\Model\ThemeInterface;

final class ResourceLocator implements ResourceLocatorInterface
{
    /**
     * @var ResourceLocatorInterface
     */
    private $applicationResourceLocator;

    /**
     * @var ResourceLocatorInterface
     */
    private $bundleResourceLocator;

    /**
     * @param ResourceLocatorInterface $applicationResourceLocator
     * @param ResourceLocatorInterface $bundleResourceLocator
     */
    public function __construct(
        ResourceLocatorInterface $applicationResourceLocator,
        ResourceLocatorInterface $bundleResourceLocator
    ) {
        $this->applicationResourceLocator = $applicationResourceLocator;
        $this->bundleResourceLocator = $bundleResourceLocator;
    }

    /**
     * {@inheritdoc}
     */
    public function locateResource(string $resourcePath, ThemeInterface $theme): string
    {
        if (0 === strpos($resourcePath, '@')) {
            return $this->bundleResourceLocator->locateResource($resourcePath, $theme);
        }

        return $this->applicationResourceLocator->locateResource($resourcePath, $theme);
    }
}
