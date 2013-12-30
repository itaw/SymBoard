<?php

namespace itaw\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('itawForumBundle:Default:index.html.twig', array('name' => $name));
    }
}
