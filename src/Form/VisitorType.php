<?php

namespace App\Form;

use App\Entity\Visitor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class VisitorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('last_name', TextType::class, array('label' => 'Nom'))
            ->add('first_name', TextType::class, array('label' => 'Prénom'))
            ->add('country', TextType::class, array('label' => 'Pays'))
            ->add('bithdate', DateTimeType::class, array('label' => 'Date de naissance'))
            ->add('email', TextType::class, array('label' => 'Adresse mail'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Visitor::class,
        ]);
    }
}
