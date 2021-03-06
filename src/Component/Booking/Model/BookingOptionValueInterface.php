<?php

declare(strict_types=1);

namespace Component\Booking\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface BookingOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return BookingOptionInterface
     */
    public function getOption(): ?BookingOptionInterface;

    /**
     * @param BookingOptionInterface $option
     */
    public function setOption(?BookingOptionInterface $option): void;

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
     * @return BookingOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
