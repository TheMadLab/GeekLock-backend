<?php

namespace AppBundle\Form;


use AppBundle\Entity\DTO\AccessDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccessType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mac')
            ->add('key')
            ->add('timestamp')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AccessDto::class,
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return 'log';
    }
}