<?php

namespace itaw\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ThreadController extends Controller
{

    public function createAction($forum_slug)
    {
        $forum = $this->getDoctrine()->getRepository('itawDataBundle:Forum')->findOneBySlug($forum_slug);

        if (!$forum) {
            throw $this->createNotFoundException('The requested Forum was not found!');
        } else {
            return $this->get('template_controller')->renderTemplate('thread_create.html.twig', array('forum' => $forum));
        }
    }

    public function updateAction($forum_slug, $thread_slug)
    {
        
    }

    public function deleteAction($forum_slug, $thread_slug)
    {
        
    }

}
