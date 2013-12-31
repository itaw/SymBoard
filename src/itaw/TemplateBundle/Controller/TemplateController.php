<?php

namespace itaw\TemplateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TemplateController extends Controller
{

    /**
     * Gets the current Template and renders the given view
     * 
     * @param string $viewName
     * @param array $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function renderTemplate($viewName, $parameters)
    {
        $template = $this->getDoctrine()->getRepository('itawDataBundle:Template')->findCurrent();
        $parameters['template'] = $template;

        return $this->render('itawTemplateBundle:' . $template->getIdentifier() . ':' . $viewName, $parameters);
    }

}
