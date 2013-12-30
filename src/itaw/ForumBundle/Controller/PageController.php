<?php

namespace itaw\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{

    public function indexAction()
    {
        return $this->redirect($this->generateUrl('itaw_forum_forums'));
    }

}
