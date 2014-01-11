<?php

namespace itaw\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use itaw\DataBundle\Entity\Thread;

class ThreadController extends Controller
{

    public function createAction(Request $request, $forum_slug)
    {
        $forum = $this->getDoctrine()->getRepository('itawDataBundle:Forum')->findOneBySlug($forum_slug);

        if ($request->get('sent') == 1) {
            $title = $request->get('title');
            $text = $request->get('text');

            if ($text !== "" && $title !== "") {
                $thread = $this->getDoctrine()->getRepository('itawDataBundle:Thread')->findOneInForum($title, $forum->getId());

                if (!$thread) {
                    $thread = new Thread();
                    $thread->setTitle($title);
                    $thread->setCreationDate(new \DateTime('now'));
                    $thread->setForum($forum);
                    $thread->setSlug('');
                    //TODO: Type, State
                } else {
                    //TODO: title exists
                }
            } else {
                //TODO: InvalidArgumentException
            }
        } else {
            if (!$forum) {
                throw $this->createNotFoundException('The requested Forum was not found!');
            } else {
                return $this->get('template_controller')->renderTemplate('thread_create.html.twig', array('forum' => $forum));
            }
        }
    }

    public function updateAction($forum_slug, $thread_slug)
    {
        
    }

    public function deleteAction($forum_slug, $thread_slug)
    {
        
    }

}
