<?php

declare(strict_types=1);

namespace Component\Pointofsale\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;
use Component\Resource\Model\TranslatableTrait;
use Component\Resource\Model\TranslationInterface;

class PointofsaleOption implements PointofsaleOptionInterface
{
    use TimestampableTrait;
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
        getTranslation as private doGetTranslation;
    }

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var int
     */
    protected $position;

    /**
     * @var Collection|PointofsaleOptionValueInterface[]
     */
    protected $values;

    public function __construct()
    {
        $this->initializeTranslationsCollection();

        $this->values = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * {@inheritdoc}
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): ?string
    {
        return $this->getTranslation()->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function setName(?string $name): void
    {
        $this->getTranslation()->setName($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * {@inheritdoc}
     */
    public function setPosition(?int $position): void
    {
        $this->position = $position;
    }

    /**
     * {@inheritdoc}
     */
    public function getValues(): Collection
    {
        return $this->values;
    }

    /**
     * {@inheritdoc}
     */
    public function addValue(PointofsaleOptionValueInterface $value): void
    {
        if (!$this->hasValue($value)) {
            $value->setOption($this);
            $this->values->add($value);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeValue(PointofsaleOptionValueInterface $value): void
    {
        if ($this->hasValue($value)) {
            $this->values->removeElement($value);
            $value->setOption(null);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasValue(PointofsaleOptionValueInterface $value): bool
    {
        return $this->values->contains($value);
    }

    /**
     * @param string|null $locale
     *
     * @return PointofsaleOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface
    {
        /** @var PointofsaleOptionTranslationInterface $translation */
        $translation = $this->doGetTranslation($locale);

        return $translation;
    }

    /**
     * {@inheritdoc}
     */
    protected function createTranslation(): PointofsaleOptionTranslationInterface
    {
        return new PointofsaleOptionTranslation();
    }
}