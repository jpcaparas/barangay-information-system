<?php

namespace BIS\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BIS\CMSBundle\Entity\User;
use BIS\CMSBundle\Form\LoginType;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    public function setDefaultOptions() {

    }

    public function indexAction(Request $request) {
        $user = new User();

        $form = $this->createForm(new LoginType(), $user);
        $form->handleRequest($request);

        return $this->render('BISCMSBundle:Login:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}