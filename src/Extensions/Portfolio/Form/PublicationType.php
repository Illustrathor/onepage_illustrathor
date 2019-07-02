<?php

namespace App\Extensions\Portfolio\Form;

use App\Extensions\Portfolio\Entity\Publication;
use Artgris\Bundle\MediaBundle\Form\Type\MediaType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationType extends AbstractType
{
    const LOCALES = ["fr_FR", "en_EN"];
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code')
            ->add('labels')
            ->add("link")
            ->add('cover_image', MediaType::class, [
                'conf' => 'default'
            ])
            ->add('online')
            ->add('slug')
            ->add('tagsText', TextType::class, ['required' => false, 'label' => 'Tags'])
            ->add('descriptions', CollectionType::class, [
                // each entry in the array will be an "email" field
                'entry_type' => CKEditorType::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Publication::class,
            "allow_extra_fields" => true
        ]);
    }
}
