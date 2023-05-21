<?php

namespace App\Form;

use App\Entity\IndexDetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class IndexDetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', TextType::class, [
            // 'label' => ['title',
            //             'class'=>'peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6'
            // ],
            'attr' => [
                'autocomplete' => 'title',                     
                'class' => 'required form-control',
                'placeholder' => 'eg.The title'
            ],
        ])


            ->add('description', TextareaType::class, [
            // 'label' => ['decription',
            //             'class'=>'block mb-2 text-sm font-medium text-gray-900 dark:text-white'
            // ],
            'attr' => [
                'autocomplete' => 'description',                     
                'class' => 'required form-control',
                'rows'=>'4',
                'placeholder' => 'eg.The description'
            ],
        ])


        //    ->add('imagePath')
              

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => IndexDetail::class,
        ]);
    }
}
