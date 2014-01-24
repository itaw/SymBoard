<?php

namespace itaw\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ForumController extends Controller
{

    public function viewAction()
    {
        return $this->render('itawAdminBundle:Forum:forums.html.twig');
    }
    
    public function createAction()
    {
        
    }

    public function updateAction($forum_slug)
    {
        
    }

    public function deleteAction($forum_slug)
    {
        
    }

}
