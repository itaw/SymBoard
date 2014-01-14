<?php

namespace itaw\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use itaw\UserBundle\Entity\LoginState;
use Symfony\Component\HttpFoundation\Response;

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

    public function showThreadAction($forum_slug, $thread_slug)
    {
        $forumHistory = $this->getDoctrine()->getRepository('itawDataBundle:ForumHistory')->findOneBySlug($forum_slug);
        $threadHistory = $this->getDoctrine()->getRepository('itawDataBundle:ThreadHistory')->findOneBySlug($thread_slug);
        $forum = null;
        $thread = null;
        $isForumFaulty = false;
        $isThreadFaulty = false;

        if (!(!$forumHistory)) {
            $forum = $forumHistory->getForum();
            $isForumFaulty = true;
        } else {
            $forum = $this->getDoctrine()->getRepository('itawDataBundle:Forum')->findOneBySlug($forum_slug);
        }

        if (!(!$threadHistory)) {
            $thread = $threadHistory->getForum();
            $isThreadFaulty = true;
        } else {
            $thread = $this->getDoctrine()->getRepository('itawDataBundle:Thread')->findOneBySlug($thread_slug);
        }

        if ($isForumFaulty || $isThreadFaulty) {
            return $this->redirect($this->generateUrl('itaw_forum_show_thread', array('forum_slug' => $forum->getSlug(), 'thread_slug' => $thread->getSlug())));
        } else {
            return $this->get('template_controller')->renderTemplate('thread_view.html.twig', array('forum' => $forum, 'thread' => $thread));
        }
    }

    public function loginCheckAction($username)
    {
        $user = $this->getDoctrine()->getRepository('itawUserBundle:User')->findOneByUsername($username);

        if (!(!$user)) {
            $loginState = $this->getDoctrine()->getRepository('itawUserBundle:LoginState')->findOneByUser($user);
            if (!(!$loginState)) {
                //update state
                $loginState->setCheckDate(new \DateTime('now'));
                
                $em = $this->getDoctrine()->getManager();
                $em->flush();
            } else {
                //new state
                $loginState = new LoginState();
                $loginState->setUser($user);
                $loginState->setCheckDate(new \DateTime('now'));

                $em = $this->getDoctrine()->getManager();
                $em->persist($loginState);
                $em->flush();
            }
        }

        return new Response('true');
    }

}
