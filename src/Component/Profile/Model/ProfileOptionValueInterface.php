<?php

declare(strict_types=1);

namespace Component\Profile\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ProfileOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return ProfileOptionInterface
     */
    public function getOption(): ?ProfileOptionInterface;

    /**
     * @param ProfileOptionInterface $option
     */
    public function setOption(?ProfileOptionInterface $option): void;

    /**
     * @return string|null
     */
    public function getValue(): ?string;

    /**
     * @param string|null $value
     */
    public function setValue(?string $value): void;

    /**
     * @return string|null
     */
    public function getOptionCode(): ?string;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string|null $locale
     *
     * @return ProfileOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
