<?php

namespace BIS\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Default controller.
 *
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route(
     * "/",
     * name = "default"
     * )
     */
    public function indexAction()
    {
        return $this->redirect(
            $this->generateUrl('resident')
        );
    }
}
