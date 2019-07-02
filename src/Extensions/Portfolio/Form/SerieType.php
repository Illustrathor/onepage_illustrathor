<?php

namespace App\Extensions\Portfolio\Form;

use App\Extensions\Portfolio\Entity\Serie;
use Artgris\Bundle\MediaBundle\Form\Type\MediaCollectionType;
use Artgris\Bundle\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code')
            ->add('labels')
            ->add('online')
            ->add('slug')
            ->add('cover_image',MediaType::class, [
                'conf' => 'default'
            ])
            ->add('images', MediaCollectionType::class, [
                'conf' => 'default'
            ])
            ->add('descriptions')
            ->add('tagsText', TextType::class, ['required' => false, 'label' => 'Tags'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
