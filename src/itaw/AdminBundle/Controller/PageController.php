<?php

namespace itaw\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{

    public function indexAction()
    {
        return $this->render('itawAdminBundle:Page:index.html.twig');
    }

}
