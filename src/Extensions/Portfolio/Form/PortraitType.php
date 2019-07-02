<?php

namespace App\Extensions\Portfolio\Form;

use App\Extensions\Portfolio\Entity\Portrait;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Artgris\Bundle\MediaBundle\Form\Type\MediaType;

class PortraitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code')
            ->add('labels')
            ->add('descriptions')
            ->add('online')
            ->add('file', MediaType::class, [
                'conf' => 'default'
            ])
            ->add('slug')
            ->add('tagsText', TextType::class, ['required' => false, 'label' => 'Tags'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Portrait::class,
        ]);
    }
}
