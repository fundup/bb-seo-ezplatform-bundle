<?php

namespace BruyereFreelance\SeoExtensionBundle\Controller;

use eZ\Bundle\EzPublishCoreBundle\Controller as BaseController;
/**
 * Class MetaController
 * @package BruyereFreelance\SeoExtensionBundle\Controller
 *
 * Define function to get metas on front-end
 */
class FrontController extends BaseController
{


    public function getMetasFromContentIdAction($contentId) {
        $em = $this->getDoctrine()->getManager();
        $metaRepository = $em->getRepository("BruyereFreelanceSeoExtensionBundle:Meta");
        //TODO : check ID and results ...
        $meta = $metaRepository->findOneBy(["contentId" => $contentId]);

        return $this->render("BruyereFreelanceSeoExtensionBundle:front:_metas.html.twig", [
            "meta" => $meta
        ]);
    }
}
