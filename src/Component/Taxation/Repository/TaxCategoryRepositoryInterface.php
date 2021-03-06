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

namespace Component\Taxation\Repository;

use Component\Resource\Repository\RepositoryInterface;
use Component\Taxation\Model\TaxCategoryInterface;

interface TaxCategoryRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $name
     *
     * @return array|TaxCategoryInterface[]
     */
    public function findByName(string $name): array;
}
