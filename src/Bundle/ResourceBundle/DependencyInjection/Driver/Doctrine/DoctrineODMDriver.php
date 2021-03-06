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

namespace Bundle\ResourceBundle\DependencyInjection\Driver\Doctrine;

use Bundle\ResourceBundle\Doctrine\ODM\MongoDB\TranslatableRepository;
use Bundle\ResourceBundle\ResourceBundle;
use Component\Resource\Metadata\MetadataInterface;
use Component\Resource\Model\TranslatableInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\Reference;

final class DoctrineODMDriver extends AbstractDoctrineDriver
{
    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return ResourceBundle::DRIVER_DOCTRINE_MONGODB_ODM;
    }

    /**
     * {@inheritdoc}
     */
    protected function addRepository(ContainerBuilder $container, MetadataInterface $metadata): void
    {
        $modelClass = $metadata->getClass('model');

        $repositoryClass = in_array(TranslatableInterface::class, class_implements($modelClass))
            ? TranslatableRepository::class
            : new Parameter('sylius.mongodb.odm.repository.class')
        ;

        if ($metadata->hasClass('repository')) {
            $repositoryClass = $metadata->getClass('repository');
        }

        $unitOfWorkDefinition = new Definition('Doctrine\\ODM\\MongoDB\\UnitOfWork');
        $unitOfWorkDefinition
            ->setFactory([new Reference($this->getManagerServiceId($metadata)), 'getUnitOfWork'])
            ->setPublic(false)
        ;

        $definition = new Definition($repositoryClass);
        $definition->setArguments([
            new Reference($metadata->getServiceId('manager')),
            $unitOfWorkDefinition,
            $this->getClassMetadataDefinition($metadata),
        ]);

        $container->setDefinition($metadata->getServiceId('repository'), $definition);
    }

    /**
     * {@inheritdoc}
     */
    protected function getManagerServiceId(MetadataInterface $metadata): string
    {
        if ($objectManagerName = $this->getObjectManagerName($metadata)) {
            return sprintf('doctrine_mongodb.odm.%s_document_manager', $objectManagerName);
        }

        return 'doctrine_mongodb.odm.document_manager';
    }

    /**
     * {@inheritdoc}
     */
    protected function getClassMetadataClassname(): string
    {
        return 'Doctrine\\ODM\\MongoDB\\Mapping\\ClassMetadata';
    }
}
