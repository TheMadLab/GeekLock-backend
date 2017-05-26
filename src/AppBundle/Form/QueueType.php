<?php

namespace AppBundle\Form;

use AppBundle\Entity\DTO\AccessesDto;
use AppBundle\Entity\DTO\QueueDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QueueType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('queue', CollectionType::class, [
                'entry_type' => AccessType::class,
                'label' => false,
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => QueueDto::class,
            'csrf_protection' => false
        ]);
    }

    public function getName()
    {
        return null;
    }


    public function getBlockPrefix()
    {
        return null;
    }
}