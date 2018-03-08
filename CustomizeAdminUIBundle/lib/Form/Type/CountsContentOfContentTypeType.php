<?php
namespace EzSystems\CustomizeAdminUIBundle\lib\Form\Type;

use EzSystems\EzPlatformAdminUi\Form\Type\ContentType\ContentTypeChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountsContentOfContentTypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'content_type',
                ContentTypeChoiceType::class,
                [
                    'label' => false,
                    'multiple' => false,
                    'expanded' => false,
                ]
            );
    }
}
