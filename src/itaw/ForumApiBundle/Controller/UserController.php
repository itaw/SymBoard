<?php

namespace itaw\ForumApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    public function getObjectAction($id)
    {
        $user = $this->getDoctrine()->getRepository('itawUserBundle:User')->findOneById($id);

        $serializer = $this->get('jms_serializer');
        $data = $serializer->serialize($user, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    
    public function getUsersLikeNameAction($username)
    {
        $user = $this->getDoctrine()->getRepository('itawUserBundle:User')->findByUsername($username);

        $serializer = $this->get('jms_serializer');
        $data = $serializer->serialize($user, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
