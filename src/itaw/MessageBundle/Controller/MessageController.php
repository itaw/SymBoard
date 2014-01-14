<?php

namespace itaw\MessageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MessageController extends Controller
{

    public function inboxAction()
    {
        $messages = $this->getDoctrine()->getRepository('itawMessageBundle:Message')->getReceivedMessages($this->get('security.context')->getToken()->getUser());

        return $this->get('template_controller')->renderTemplate('messages_inbox.html.twig', array('messages' => $messages));
    }

    public function sendAction()
    {
        $messages = $this->getDoctrine()->getRepository('itawMessageBundle:Message')->getReceivedMessages($this->get('security.context')->getToken()->getUser());

        return $this->get('template_controller')->renderTemplate('messages_send.html.twig');
    }

}
