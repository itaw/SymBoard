<?php

namespace itaw\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{

    public function loginStateAction($username)
    {
        $user = $this->getDoctrine()->getRepository('itawUserBundle:User')->findOneByUsername($username);
        $loginState = $this->getDoctrine()->getRepository('itawUserBundle:LoginState')->findOneByUser($user);

        $isOnline = false;

        if (((new \DateTime('now'))->format('Y-m-d H:i:s') - $loginState->getCheckDate()->format('Y-m-d H:i:s')) < 60) {
            $isOnline = true;
        }

        return $this->get('template_controller')->renderTemplate('user_online.html.twig', array('isOnline' => $isOnline));
    }

}
