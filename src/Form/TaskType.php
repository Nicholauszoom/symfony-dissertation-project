<?php

namespace App\Form;

use App\Entity\Messages;
use App\Entity\Task;
use App\Entity\Technician;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;




class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
//            ->add('name')
//            ->add('description')
//            ->add('start_at')
//            ->add('end_at')
//        ;




        ->add('name', TextType::class, [
        // 'label' => ['title',
        //             'class'=>'peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6'
        // ],
        'attr' => [
            'autocomplete' => 'name',
            'class' => 'block py-2.5 px-0 my-5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer',
            'placeholder' => 'eg.The Task name'
        ],
    ])



        ->add('description', TextareaType::class, [
            // 'label' => ['title',
            //             'class'=>'peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6'
            // ],
            'attr' => [
                'autocomplete' => 'description',
                'class' => 'block py-2.5 my-5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer',
                'placeholder' => 'eg.The description'
            ],
        ])

         
    ->add('message', EntityType::class, [

        // looks for choices from this entity
        'class' => Messages::class,
        // uses the User.username property as the visible option string
        // 'choice_label' => 'name',
        'choice_label' => function ($message) {
            return $message->getTitle();
        }
        // used to render a select box, check boxes or radios
        // 'multiple' => true,
        // 'expanded' => true,

    ])

        ->add('techn', EntityType::class, [

            // looks for choices from this entity
            'class' => Technician::class,
            // uses the User.username property as the visible option string
            // 'choice_label' => 'name',
            'choice_label' => function ($techn) {
                return $techn->getEmail();
            }
            // used to render a select box, check boxes or radios
            // 'multiple' => true,
            // 'expanded' => true,

        ])

         


        ->add('start_at', DateType::class, [

            'widget' => 'single_text',
            // this is actually the default format for single_text
            'format' => 'yyyy-MM-dd',


        ])

        ->add('end_at', DateType::class, [

            'widget' => 'single_text',
            // this is actually the default format for single_text
            'format' => 'yyyy-MM-dd',

        ])
//
//
//            ->add('start_at', DateType::class, [
//                'widget' => 'single_text',
//                'attr' => ['class' => 'datepicker'],
//                'html5' => false,
//                'mapped' => true,
//                'format' => 'yyyy-MM-dd',
//            ])

//            ->add('end_at', DateType::class, [
//                'widget' => 'single_text',
//                'attr' => ['class' => 'datepicker'],
//                'html5' => false,
//                'mapped' => true,
//                'format' => 'yyyy-MM-dd',
//            ])




    ;

    }






    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
