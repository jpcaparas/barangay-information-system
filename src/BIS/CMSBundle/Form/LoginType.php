<?php

namespace BIS\CMSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LoginType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options ) {
        $builder
            ->add('email', 'email', array(
                'error_bubbling' => true,
            ))
            ->add('password', 'password', array(
                'error_bubbling' => true
            ))
            ->add('submit', 'submit');
    }

    public function getName() {
        return 'login';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'validation_groups' => array('Login')
        ));
    }
}