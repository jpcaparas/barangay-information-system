<?php

namespace BIS\CMSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClearanceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('issuedAt')
            ->add('requestedAt')
            ->add('notes')
            ->add('requestKey')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('resident')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BIS\CMSBundle\Entity\Clearance'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bis_cmsbundle_clearance';
    }
}
