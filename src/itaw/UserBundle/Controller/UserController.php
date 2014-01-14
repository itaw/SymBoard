<?php

namespace itaw\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use itaw\DataBundle\Entity\UserProfile;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

    public function profileAction($username)
    {
        $user = $this->getDoctrine()->getRepository('itawUserBundle:User')->findOneByUsername($username);
        $profile = $this->getDoctrine()->getRepository('itawDataBundle:UserProfile')->findOneByUser($user);

        if (!$profile) {
            $profile = new UserProfile();
            $profile->setUser($user);
            $profile->setCreationDate(new \DateTime('now'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($profile);
            $em->flush();
        }

        return $this->get('template_controller')->renderTemplate('user_profile.html.twig', array('user' => $user));
    }

    public function editProfileAction(Request $request, $username)
    {
        $user = $this->getDoctrine()->getRepository('itawUserBundle:User')->findOneByUsername($username);

        if ($this->get('security.context')->getToken()->getUser()->getUsername() != $username) {
            return $this->redirect($this->generateUrl('itaw_user_profile', array('username' => $username)));
        }

        $profile = $this->getDoctrine()->getRepository('itawDataBundle:UserProfile')->findOneByUser($user);

        if (!$profile) {
            $profile = new UserProfile();
            $profile->setUser($user);
            $profile->setCreationDate(new \DateTime('now'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($profile);
            $em->flush();
        }

        if ($request->get('sent') == 1) {
            if ($request->get('page') == 'profile') {
                $profile->setEditDate(new \DateTime('now'));
                $profile->setFacebook($request->get('facebook'));
                $profile->setFullName($request->get('fullname'));
                $profile->setSignature($request->get('signature'));
                $profile->setWebsite($request->get('website'));
                $profile->setCity($request->get('city'));

                if ($request->get('birthdate') !== "") {
                    $profile->setBirthdate(new \DateTime($request->get('birthdate')));
                }

                $em = $this->getDoctrine()->getManager();
                $em->flush();
            }

            return $this->redirect($this->generateUrl('itaw_user_profile', array('username' => $username)));
        } else {
            return $this->get('template_controller')->renderTemplate('user_profile_edit.html.twig', array('user' => $user));
        }
    }

}
