<?php

namespace itaw\TemplateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TemplateController extends Controller
{

    public function renderTemplate($viewName, $parameters)
    {
        $template = $this->getDoctrine()->getRepository('itawDataBundle:Template')->findCurrent();

        return $this->render('itawTemplateBundle:' . $template->getIdentifier() . ':' . $viewName, $parameters);
    }

}
