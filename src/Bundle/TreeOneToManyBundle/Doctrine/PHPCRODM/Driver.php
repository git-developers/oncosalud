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

namespace Bundle\TreeOneToManyBundle\Doctrine\PHPCRODM;

use Doctrine\ODM\PHPCR\DocumentManagerInterface;
use Component\OneToMany\Data\DataSourceInterface;
use Component\OneToMany\Data\DriverInterface;
use Component\OneToMany\Parameters;

final class Driver implements DriverInterface
{
    /**
     * Driver name
     */
    public const NAME = 'doctrine/phpcr-odm';

    /**
     * Alias to use to reference fields from the data source class.
     */
    public const QB_SOURCE_ALIAS = 'o';

    /**
     * @var DocumentManagerInterface
     */
    private $documentManager;

    /**
     * @param DocumentManagerInterface $documentManager
     */
    public function __construct(DocumentManagerInterface $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getDataSource(array $configuration, Parameters $parameters): DataSourceInterface
    {
        if (!array_key_exists('class', $configuration)) {
            throw new \InvalidArgumentException('"class" must be configured.');
        }

        $repository = $this->documentManager->getRepository($configuration['class']);
        $queryBuilder = $repository->createQueryBuilder(self::QB_SOURCE_ALIAS);

        return new DataSource($queryBuilder);
    }
}
