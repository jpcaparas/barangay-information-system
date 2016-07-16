<?php

namespace BIS\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Finder\Exception\AccessDeniedException;

/**
 * Admin Controller
 *
 * @Route("/admin")
 */
class AdminController extends Controller {
    /**
     * @Route("/", name="admin")
     */
    public function adminAction() {
        if (false == $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException("Access denied");
        }

        $response = new Response(
            'test',
            200,
            array('content-type' => 'text-plain')
        );

        return $response;
    }
}