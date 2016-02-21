<?php

namespace TextAnalyzerBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use TextAnalyzerBundle\Entity\TextToAnalyze;

class SavedTextLoaderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entity', EntityType::class, [
                'class' => TextToAnalyze::class,
                'choice_label' => 'name',
                'label' => 'Saved',
                'placeholder' => 'Select saved text',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.id', 'DESC');
                },
            ])
            ->add('load', SubmitType::class, [
                'label' => 'Load'
            ])
        ;
    }
}
