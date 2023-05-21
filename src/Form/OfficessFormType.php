<?php

namespace App\Form;

use App\Entity\Building;
use App\Entity\Officess;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Component\Form\ChoiceList\ChoiceList;

class OfficessFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
             ->add('name', TextType::class, [
            // 'label' => ['title',
            //             'class'=>'peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6'
            // ],
            'attr' => [
                'autocomplete' => 'name',                     
                'class' => 'required form-control',
                'placeholder' => 'eg.Office name'
            ],
        ])

           
             ->add('code', IntegerType::class, [
          
            'attr' => [
                'autocomplete' => 'code',                     
                'class' => 'required form-control',
                'placeholder' => 'eg.Office number'
            ],
        ])



            ->add('building', EntityType::class, [

                // looks for choices from this entity
                'class' => Building::class,
                // uses the User.username property as the visible option string
               // 'choice_label' => 'name',
                'choice_label' => function ($building) {
                    return $building->getName();
                }
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,

            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Officess::class,
        ]);
    }
}
