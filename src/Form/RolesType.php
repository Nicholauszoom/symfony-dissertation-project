<?php

namespace App\Form;

use App\Entity\Roles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RolesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('name')
            // ->add('status')
            // ->add('roleName')
            ->add('name', TextType::class, [
                // 'label' => ['title',
                //             'class'=>'col-sm-3 text-end control-label col-form-label'
                // ],
                'attr' => [
                    'autocomplete' => 'name',
                    'class' => 'form-control border-0',
                    'placeholder' => 'eg. name'
                ],
            ])

            // ->add('roleName', TextType::class, [
            //     // 'label' => ['title',
            //     //             'class'=>'col-sm-3 text-end control-label col-form-label'
            //     // ],
            //     'attr' => [
            //         'autocomplete' => 'roleName',
            //         'class' => 'form-control border-0',
            //         'placeholder' => 'eg. roleName'
            //     ],
            // ])



            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Yes' => true,
                    'No' => false,
                    'Maybe' => null,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Roles::class,
        ]);
    }
}
