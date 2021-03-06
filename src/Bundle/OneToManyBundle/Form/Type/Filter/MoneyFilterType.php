<?php

declare(strict_types=1);

namespace Bundle\OneToManyBundle\Form\Type\Filter;

use Bundle\CurrencyBundle\Form\Type\CurrencyChoiceType;
use Component\OneToMany\Filter\MoneyFilter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class MoneyFilterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('greaterThan', NumberType::class, [
                'label' => 'sylius.ui.greater_than',
                'required' => false,
                'scale' => $options['scale'],
            ])
            ->add('lessThan', NumberType::class, [
                'label' => 'sylius.ui.less_than',
                'required' => false,
                'scale' => $options['scale'],
            ])
            ->add('currency', CurrencyChoiceType::class, [
                'label' => 'sylius.ui.currency',
                'placeholder' => '---',
                'required' => false,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'data_class' => null,
                'scale' => MoneyFilter::DEFAULT_SCALE,
            ])
            ->setAllowedTypes('scale', ['string', 'int'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'sylius_grid_filter_money';
    }
}
