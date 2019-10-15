<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Form\Type;

use Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

use Bundle\ProfileBundle\Entity\Profile;

class CotizacionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    $builder
		    ->add('dob', DateType::class , [
			    'label' => 'Fecha de nacimiento',
			    'required' => false,
			    'widget' => 'single_text',
			    'label_attr' => [
				    'class' => ''
			    ],
//                'format' => 'dd-MM-yyyy',
//                'years' => range(date('Y') -18, date('Y') -80),
//                'placeholder' => array(
//                    'year' => 'Año', 'month' => 'Mes', 'day' => 'Dia',
//                ),
			    'attr' => [
				    'class' => 'form-control',
				    'title'=>'',
			    ],
			    'error_bubbling' => true
		    ])
		    ->add('modalidad', ChoiceType::class, [
			    'label' => 'Genero',
			    'choices' => [
				    'Recurrente' => 1,
				    'No Recurrente' => 2
			    ],
			    'expanded' => true,
			    'label_attr' => [
				    'class' => ''
			    ],
			    'attr' => [
				    'class' => 'form-control random',
				    'placeholder' => 'modalidad',
			    ],
		    ])
		    ->add('name', TextType::class, [
			    'label' =>' Nombres',
			    'label_attr' => [
				    'class' => ''
			    ],
			    'attr' => [
				    'class' => 'form-control required',
				    'placeholder' => 'nombres',
			    ],
		    ])
		    ->add('submit', SubmitType::class, [
			    'label' => 'Guardar',
			    'attr' => [
				    'class' => 'btn btn-success',
			    ],
		    ])
	    ;
	
	
	    /*
		$builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($em) {
			$data = $event->getData();
			$form = $event->getForm();
		});
		*/
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
