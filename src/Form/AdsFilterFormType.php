<?php

namespace App\Form;



use App\Entity\AccomodationType;
use App\Entity\RentPeriodation;
use App\Entity\States;
use App\MyClasses\AdsFilter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdsFilterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('BareSearch_filter' ,TextType::class,[
                'required'=>false,
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Search By User'
                ],
            ])
            ->add('Accomodation_filter' ,EntityType::class,[
                'required'=>false,
                'class' => AccomodationType::class,
                'label'=>'AccomodationType',

            ])
            ->add('RentPeriodation_filter' ,EntityType::class,[
                'required'=>false,
                'class' => RentPeriodation::class,
                'label'=>'RentPeriodation',

            ])
            ->add('States_filter' ,EntityType::class,[
                'required'=>false,
                'class' => States::class,
                'label'=>'States',

            ])
            ->add('Search',SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-success MyFilterSubmitBtn '
                ],
            ])
        ;

    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AdsFilter::class,
            'method' => 'GET',
            'crsf_protection' => false,
        ]);
    }


}
