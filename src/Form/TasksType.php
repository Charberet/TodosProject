<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Tasks;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TasksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class,[
                'label'=>'Name',

            ])
            ->add('Date', DateType::class)
            ->add('Priority', ChoiceType::class, [
                'label'=>'Priority',
                'choices' => [
                    'Choisir...' => '',
                    'Bas' => 'Bas',
                    'Moyen' => 'Moyen',
                    'Haut' => 'Haut',
                ],
                
            ])
            ->add('TypeCategory', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'Name',
                'label' => 'Categorie'
                
            ])

            ->add('save', SubmitType::class, [
                'label' => 'Add',
                'attr'   =>  array(
                    'class'   => 'btn btn-success')
            ] );
          
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tasks::class,
        ]);
    }
}
