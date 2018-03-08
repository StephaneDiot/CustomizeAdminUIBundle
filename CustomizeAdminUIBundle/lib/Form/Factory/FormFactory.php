<?php
namespace EzSystems\CustomizeAdminUIBundle\lib\Form\Factory;
use EzSystems\CustomizeAdminUIBundle\lib\Form\Data\CountsContentOfContentTypeData;
use EzSystems\CustomizeAdminUIBundle\lib\Form\Type\CountsContentOfContentTypeType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
class FormFactory
{
    /** @var FormFactoryInterface $formFactory */
    protected $formFactory;
    /**
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }
    public function countsContentOfContentType(
        CountsContentOfContentTypeData $data,
        ?string $name = null
    ): ?FormInterface {
        $name = $name ? $name : 'countscontentofcontenttype';
        return $this->formFactory->createNamed(
            $name,
            CountsContentOfContentTypeType::class,
            $data,
            [
                'method' => Request::METHOD_GET,
                'csrf_protection' => false,
            ]
        );
    }
}
