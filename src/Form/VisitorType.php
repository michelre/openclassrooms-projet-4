<?php

namespace App\Form;

use App\Entity\Visitor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;


class VisitorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('last_name', TextType::class, array('label' => 'Nom'))
            ->add('first_name', TextType::class, array('label' => 'Prénom'))
            ->add('country',CountryType::class, array(
                'preferred_choices' => array('FR', 'GB', 'DE', 'ES'),
                'label' => 'pays',
                'label_attr' => array('class' => 'country'),))
            ->add('bithdate', DateType::class, array(
                'widget' => 'single_text',
                'label' =>'Date de naissance',

                'html5' => false,


                'attr' => ['class' => 'js-datepicker']))
            ->add('email', EmailType::class, array('label' => 'Adresse mail'))
            ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Visitor::class,
        ]);
    }
}
