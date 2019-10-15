<?php

declare(strict_types=1);

namespace Component\Route\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface RouteInterface extends
    AttributeSubjectInterface,
    CodeAwareInterface,
    ResourceInterface,
    SlugAwareInterface,
    TimestampableInterface,
    ToggleableInterface,
    TranslatableInterface
{
    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void;

    /**
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void;

    /**
     * @return string|null
     */
    public function getMetaKeywords(): ?string;

    /**
     * @param string|null $metaKeywords
     */
    public function setMetaKeywords(?string $metaKeywords): void;

    /**
     * @return string|null
     */
    public function getMetaDescription(): ?string;

    /**
     * @param string|null $metaDescription
     */
    public function setMetaDescription(?string $metaDescription): void;

    /**
     * @return bool
     */
    public function hasVariants(): bool;

    /**
     * @return Collection|RouteVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param RouteVariantInterface $variant
     */
    public function addVariant(RouteVariantInterface $variant): void;

    /**
     * @param RouteVariantInterface $variant
     */
    public function removeVariant(RouteVariantInterface $variant): void;

    /**
     * @param RouteVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(RouteVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|RouteOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param RouteOptionInterface $option
     */
    public function addOption(RouteOptionInterface $option): void;

    /**
     * @param RouteOptionInterface $option
     */
    public function removeOption(RouteOptionInterface $option): void;

    /**
     * @param RouteOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(RouteOptionInterface $option): bool;

    /**
     * @return Collection|RouteAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param RouteAssociationInterface $association
     */
    public function addAssociation(RouteAssociationInterface $association): void;

    /**
     * @param RouteAssociationInterface $association
     */
    public function removeAssociation(RouteAssociationInterface $association): void;

    /**
     * @return bool
     */
    public function isSimple(): bool;

    /**
     * @return bool
     */
    public function isConfigurable(): bool;

    /**
     * @param string|null $locale
     *
     * @return RouteTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
