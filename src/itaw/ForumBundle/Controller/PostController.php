<?php

namespace itaw\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use itaw\DataBundle\Entity\Post;

class PostController extends Controller
{

    public function createAction(Request $request, $forum_slug, $thread_slug)
    {
        $forum = $this->getDoctrine()->getRepository('itawDataBundle:Forum')->findOneBySlug($forum_slug);
        $thread = $this->getDoctrine()->getRepository('itawDataBundle:Thread')->findOneBySlug($thread_slug);

        if ($request->get('sent') == 1) {
            $text = $request->get('text');

            if ($text !== "") {                
                $post = new Post();
                $post->setText($text);
                $post->setThread($thread);
                $post->setUser($this->get('security.context')->getToken()->getUser());
                $post->setCreationDate(new \DateTime('now'));

                $em = $this->getDoctrine()->getManager();
                $em->persist($post);
                $em->flush();

                return $this->redirect($this->generateUrl('itaw_forum_show_thread', array('forum_slug' => $forum->getSlug(), 'thread_slug' => $thread->getSlug())));
            } else {
                //TODO: InvalidArgumentException
            }
        } else {
            if (!$forum || !$thread) {
                throw $this->createNotFoundException('The requested Forum/Thread was not found!');
            } else {
                return $this->get('template_controller')->renderTemplate('post_create.html.twig', array('forum' => $forum, 'thread' => $thread));
            }
        }
    }

    public function readAction($forum_slug, $thread_slug, $post_id)
    {
        
    }

    public function updateAction($forum_slug, $thread_slug, $post_id)
    {
        
    }

    public function deleteAction($forum_slug, $thread_slug, $post_id)
    {
        
    }

}
