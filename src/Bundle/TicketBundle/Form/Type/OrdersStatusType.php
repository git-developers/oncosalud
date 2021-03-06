<?php

namespace Bundle\TicketBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Bundle\TicketBundle\Entity\Orders;

class OrdersStatusType extends AbstractType
{
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('status', ChoiceType::class, [
                'label' => false,
	            'choices' => [
		            Orders::STATUS_VOIDED => Orders::STATUS_VOIDED,
		            Orders::STATUS_COMPLETED => Orders::STATUS_COMPLETED,
	            ],
	            'empty_data' => false,
	            'placeholder' => 'esta seguro',
	            'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control hide',
                ],
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
//            'data_class' => Product::class,
        ]);

        $resolver->setRequired(['form_data']);
    }

}
