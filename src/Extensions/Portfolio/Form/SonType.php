<?php

namespace App\Extensions\Portfolio\Form;

use App\Extensions\Portfolio\Entity\Son;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code')
            ->add('online')
            ->add('labels')
            ->add('type', ChoiceType::class, [
                'choices'  => Son::TYPES
            ])
            ->add('descriptions')
            ->add('link')
            ->add('slug')
            ->add('tagsText', TextType::class, ['required' => false, 'label' => 'Tags'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Son::class,
        ]);
    }
}
