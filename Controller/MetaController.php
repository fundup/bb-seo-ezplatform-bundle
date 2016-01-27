<?php

namespace BruyereFreelance\SeoExtensionBundle\Controller;

use BruyereFreelance\SeoExtensionBundle\Entity\Meta;
use BruyereFreelance\SeoExtensionBundle\UI\MetaUI;
use eZ\Publish\API\Repository\ContentTypeService;
use eZ\Publish\API\Repository\SearchService;
use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\Core\Pagination\Pagerfanta\ContentSearchAdapter;
use EzSystems\PlatformUIBundle\Controller\Controller as BaseController;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MetaController
 * @package BruyereFreelance\SeoExtensionBundle\Controller
 *
 * Define function to register Meta tag (meta-description, title ...)
 */
class MetaController extends BaseController
{

    /**
     * Configuration and analyse of SEO State
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function adminViewAction()
    {
        //get contentType
        $contentType = $this->container->getParameter('bruyere_freelance_seo_extension.content_type_identifier');
        $metaUIs = $this->listMeta($contentType);
        //construct all the admin view ...
        return $this->render('BruyereFreelanceSeoExtensionBundle:Seo:admin.html.twig', [
            'metaUIs' => $metaUIs,
        ]);
    }

    /**
     * Configuration and analyse of SEO State
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboardAction()
    {
        //get all content
        return $this->render('BruyereFreelanceSeoExtensionBundle:Seo:dashboard.html.twig', [

        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \eZ\Publish\Core\Base\Exceptions\InvalidArgumentType
     * TODO : define as a service ...
     * List of content where we want to add SEO to edit
     */
    public function listMeta($contentType)
    {
        $query = new Query();
        $query->query = new Criterion\ContentTypeIdentifier( $contentType);
        $limit = 10;
        $offset = 0; //devrait etre utilisé lors de findCOntentInfo ...

        $searchService = $this->get('ezpublish.api.service.search');
        $searchHits = $searchService->findContentInfo($query)->searchHits;
        $contentIds = [];
        $metaUIs = [];
        foreach($searchHits as $searchHit) {
            $contentIds[] = $searchHit->valueObject->id;
            $metaUI= new MetaUI();
            $metaUI->setContentId($searchHit->valueObject->id);
            $metaUI->setContentName($searchHit->valueObject->name);
            $metaUI->setTitle("Undefined");
            $metaUI->setMetaDescription("Undefined");
            $metaUIs[] = $metaUI;
        }
        $em = $this->getDoctrine()->getManager();
        $metas = $em->getRepository("BruyereFreelanceSeoExtensionBundle:Meta")->findAllByIds($contentIds, $limit, $offset);
        //add Title and meta from DB
        foreach($metaUIs as $metaUI) {
            $metaUIContentId = $metaUI->getContentId();
            //if $metaUIContentId is in $metas
            $item = null;
            foreach($metas as $meta) {
                if ($metaUIContentId == $meta->getContentId()) {
                    $item = $meta;
                    break;
                }
            }
            if(!is_null($item)) {
                $metaUI->setTitle($meta->getTitle());
                $metaUI->setMetaDescription($meta->getMetaDescription());
            }
        }
//        // Initialize the pager.
//        $pager = new Pagerfanta(
//            new ContentSearchAdapter($query, $searchService)
//        );
//        $pager->setMaxPerPage( 10 );
//        $pager->setCurrentPage( $request->get( 'page', 1 ) );

//        foreach($pager as $page) {
//            var_dump($page->getContentInfo());
//        }
        //construct object for view
        return $metaUIs;
//        return $this->render('BruyereFreelanceSeoExtensionBundle:Seo:list.html.twig', [
//            'metaUIs' => $metaUIs,
//        ]);
    }

    /**
     * Store Meta Datas
     * TODO: ADD POST RESTRICTION and USER RIGHT
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function saveMetaAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        //get values from UI
        $jdata = json_decode($request->getContent());
        $contentId = $jdata->contentId;
        $inputValue = $jdata->inputValue;
        $metaType = $jdata->metaType;

        if($inputValue != "Undefined") {
            //try to find entity
            $meta = $em->getRepository("BruyereFreelanceSeoExtensionBundle:Meta")
                ->findOneBy(["contentId" => $contentId]);
            //if meta is not already in DB
            if(is_null($meta)) {
                $meta = new Meta();
            }
            $meta->setContentId($contentId);
            if($metaType == "title") {
                $meta->setTitle($inputValue);
            } elseif ($metaType == "meta-descr") {
                $meta->setMetaDescription($inputValue);
            }
            $em->persist($meta);
            $em->flush();
        }

        //sucess
        $jsonResponse = new JsonResponse();
        $jsonResponse->setStatusCode(200);
//        $jsonResponse->set
        $jsonResponse->setData('Meta is saved !');
        return $jsonResponse;
    }
}
