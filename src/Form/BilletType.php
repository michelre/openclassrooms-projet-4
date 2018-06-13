<?php

namespace App\Form;

use App\Entity\Billet;
use App\Entity\Visitor;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\MakerBundle\Doctrine\RelationOneToOne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class BilletType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type',ChoiceType::class, array('label' =>'Je souhaite une place pour:',
        'choices'  => array(
            'Journée'=> 'journée',
            'Demi-journée' => 'demi-journée',

            )))
            ->add('visit_date', DateType::class, array(
                'widget' => 'single_text',
                'label' =>'Date de visite',


                'html5' => false,


                'attr' => ['class' => 'js-datepicker'],
            ))
            ->add('is_half', CheckboxType::class, array(
                'label'    => 'Je suis: étudiant, employé du musée, d’un service du Ministère de la Culture, militaire… (un justificatif vous sera damandé)',
                'required' => false,))
            ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Billet::class,
        ]);
    }
}
