<?php

namespace itaw\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use itaw\DataBundle\Entity\Thread;
use itaw\DataBundle\Helper\ThreadHelper;
use itaw\DataBundle\Entity\Post;

class ThreadController extends Controller
{

    public function createAction(Request $request, $forum_slug)
    {
        $forum = $this->getDoctrine()->getRepository('itawDataBundle:Forum')->findOneBySlug($forum_slug);

        if ($request->get('sent') == 1) {
            $title = $request->get('title');
            $text = $request->get('text');

            if ($text !== "" && $title !== "") {
                $text = $this->get('bbcode.parser')->parse($text);
                
                $thread = new Thread();
                $thread->setTitle($title);
                $thread->setCreationDate(new \DateTime('now'));
                $thread->setForum($forum);
                $thread->setSlug(ThreadHelper::generateSlug($title, $this->getDoctrine()));
                $state = $this->getDoctrine()->getRepository('itawDataBundle:ThreadState')->findOneByTitle('Open');
                $thread->setState($state);
                $type = $this->getDoctrine()->getRepository('itawDataBundle:ThreadType')->findOneByTitle('Thread');
                $thread->setType($type);
                $thread->setUser($this->get('security.context')->getToken()->getUser());

                $em = $this->getDoctrine()->getManager();
                $em->persist($thread);
                $em->flush();

                $post = new Post();
                $post->setText($text);
                $post->setThread($thread);
                $post->setUser($this->get('security.context')->getToken()->getUser());
                $post->setCreationDate(new \DateTime('now'));

                $em->persist($post);
                $em->flush();

                return $this->redirect($this->generateUrl('itaw_forum_show_thread', array('forum_slug' => $forum->getSlug(), 'thread_slug' => $thread->getSlug())));
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
