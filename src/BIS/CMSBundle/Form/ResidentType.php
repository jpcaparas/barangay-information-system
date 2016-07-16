<?php

namespace BIS\CMSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ResidentType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fname', 'text', array(
                'label' => 'First name'
            ))
            ->add('lname', 'text', array(
                'label' => 'Last name'
            ))
            ->add('mname', 'text', array(
                'label' => 'Middle name'
            ))
            ->add('gender', 'choice', array(
                'choices' => array(
                    'x' => 'Select a gender',
                    'm' => 'Male',
                    'f' => 'Female'
                )
            ))
            ->add('bdate', 'birthday', array(
                'label' => 'Birth date'
            ))
            ->add('phone', 'text', array(
                'label' => 'Phone number'
            ))
            ->add('address', 'textarea', array(
                'label' => 'Home address',
                'attr' => array(
                    'rows' => 4
                )
            ))
            ->add('occupation', 'text', array(
                'label' => 'Occupation'
            ))
            ->add('sitio', 'text', array(
                'label' => 'Sitio'
            ))
            ->add('photo_file', 'file', array(
                'label' => 'Photo',
                'required' => false
            ))
            // ->add('created_at')
            // ->add('updated_at')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BIS\CMSBundle\Entity\Resident'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bis_cmsbundle_resident';
    }
}
