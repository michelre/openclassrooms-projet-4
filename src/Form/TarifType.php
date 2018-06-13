<?php

namespace App\Form;

use App\Entity\Tarif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TarifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', ChoiceType::class, array('label' =>'Je souhaite une place:',
                'choices'  => array(


            'Normal'=> 'Normal',
            'Enfant' => 'Enfant',
            'Senior' => 'Senior',
            'Gratuit si l enfant à moins de 4 ans' => 'Gratuit',)))
            ->add('price',TextType::class,array('label' =>'prix du billet'))


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tarif::class,
        ]);
    }
}
