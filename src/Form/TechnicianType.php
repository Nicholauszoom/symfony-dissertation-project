<?php

namespace App\Form;

use App\Entity\Technician;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class TechnicianType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        //     ->add('name')
        //     ->add('phone')
        //     ->add('email')
        //     ->add('profession')
        // ;

        ->add('name', TextType::class, [
            // 'label' => ['title',
            //             'class'=>'peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6'
            // ],
            'attr' => [
                'autocomplete' => 'name',
                'class' => 'required form-control',
                'placeholder' => 'eg.The Task name'
            ],
        ])


        ->add('phone', IntegerType::class, [
            // 'label' => ['title',
            //             'class'=>'peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6'
            // ],
            'attr' => [
                'autocomplete' => 'phone',
                'class' => 'required form-control',
                'placeholder' => 'eg.Phone eg.07...'
            ],
        ])
        ->add('email', TextType::class, [
            // 'label' => ['title',
            //             'class'=>'peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6'
            // ],
            'attr' => [
                'autocomplete' => 'email',
                'class' => 'required form-control',
                'placeholder' => 'eg.someone..@gmail.com'
            ],
        ])
        ->add('profession', TextType::class, [
            // 'label' => ['title',
            //             'class'=>'peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6'
            // ],
            'attr' => [
                'autocomplete' => 'profession',
                'class' => 'required form-control',
                'placeholder' => 'eg.tailor'
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Technician::class,
        ]);
    }
}
