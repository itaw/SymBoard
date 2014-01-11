<?php

namespace itaw\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{

    public function indexAction()
    {
        return $this->redirect($this->generateUrl('itaw_forum_forums'));
    }

    public function forumsAction()
    {
        $forums = $this->getDoctrine()->getRepository('itawDataBundle:Forum')->findAllWithoutParent();
        
        return $this->get('template_controller')->renderTemplate('forums.html.twig', array('forums' => $forums));
    }

    public function showForumAction($forum_slug)
    {
        $forumHistory = $this->getDoctrine()->getRepository('itawDataBundle:ForumHistory')->findOneBySlug($forum_slug);

        if (!(!$forumHistory)) {
            return $this->redirect($this->generateUrl('itaw_forum_show_forum', array('forum_slug' => $forumHistory->getForum()->getSlug())));
        } else {
            $forum = $this->getDoctrine()->getRepository('itawDataBundle:Forum')->findOneBySlug($forum_slug);

            return $this->get('template_controller')->renderTemplate('forum_view.html.twig', array('forum' => $forum));
        }
    }

}
