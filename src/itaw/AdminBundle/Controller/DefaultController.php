<?php

namespace itaw\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('itawAdminBundle:Default:index.html.twig', array('name' => $name));
    }
}
