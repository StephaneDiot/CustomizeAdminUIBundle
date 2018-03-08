<?php
namespace EzSystems\CustomizeAdminUIBundle\Controller;

use eZ\Publish\API\Repository\SearchService;
use eZ\Publish\API\Repository\Values\Content\Location;
use eZ\Publish\API\Repository\Values\Content\Query;
use EzSystems\EzPlatformAdminUiBundle\Controller\Controller;
use Pagerfanta\Pagerfanta;
use EzSystems\CustomizeAdminUIBundle\lib\Form\Data\CountsContentOfContentTypeData;
use EzSystems\CustomizeAdminUIBundle\lib\Form\Factory\FormFactory;
use EzSystems\EzPlatformAdminUi\FormSubmitHandler;
use EzSystems\EzPlatformAdminUi\Form\SubmitHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;

class CustomPageController extends Controller
{
    /** @var FormFactory $formFactory */
    protected $formFactory;
    /** @var SearchService $searchService */
    protected $searchService;
    /** @var SubmitHandler $submitHandler */
    protected $submitHandler;
    public function __construct(
        FormFactory $formFactory,
        SearchService $searchService,
        SubmitHandler $submitHandler
    ) {
        $this->formFactory = $formFactory;
        $this->searchService = $searchService;
        $this->submitHandler = $submitHandler;
    }

    public function menuAction(Request $request): Response
    {
        $countsContentOfContentType = $this->formFactory->countsContentOfContentType(
            new CountsContentOfContentTypeData()
        );
        $countsContentOfContentType->handleRequest($request);
        $resultCount = null;

        if ($countsContentOfContentType->isSubmitted() && $countsContentOfContentType->isValid()) {
            $result = $this->submitHandler->handle($countsContentOfContentType, function (CountsContentOfContentTypeData $data) use ($countsContentOfContentType) {

                $query = $this->buildQuery($data);

                $resultCount = $this->searchService->findContent( $query )->totalCount;

                return $this->render('EzSystemsCustomizeAdminUIBundle::customPage.html.twig', [
                    'form_counts_content_of_content_type' => $countsContentOfContentType->createView(),
                    'resultCount' => $resultCount,
                ]);


            });
                if ($result instanceof Response) {

                    return $result;
                }

        }
        return $this->render('EzSystemsCustomizeAdminUIBundle::customPage.html.twig', [
            'form_counts_content_of_content_type' => $countsContentOfContentType->createView(),
        ]);



    }

    private function buildQuery(CountsContentOfContentTypeData $data): Query
    {
        $content_type = $data->getContentType();
        $criterions = [
            new Criterion\ContentTypeIdentifier($content_type->identifier),
        ];

        $query = new Query();
        $query->filter = new Criterion\LogicalAnd($criterions);
        return $query;
    }
}
