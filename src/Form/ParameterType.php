<?php

namespace App\Form;

use App\Entity\Parameter;
use Artgris\Bundle\MediaBundle\Form\Type\MediaCollectionType;
use Artgris\Bundle\MediaBundle\Form\Type\MediaType;
use Doctrine\DBAL\Types\SimpleArrayType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParameterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code')
            ->add('labels')
            ->add("template")
            ->add('parameters', CollectionType::class, [
                'allow_add' => true,
            ])
            ->add("labels", CollectionType::class, [
                'entry_options' => [
                    'attr' => ['class' => 'email-box'],
                ],
            ])
            ->add('image', MediaType::class, [
                'conf' => 'default'
            ])
            ->add('images', MediaCollectionType::class, [
                'conf' => 'default'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Parameter::class,
            "allow_extra_fields" => true
        ]);
    }
}
