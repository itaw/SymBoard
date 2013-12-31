<?php

namespace itaw\TemplateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

const DS = DIRECTORY_SEPARATOR;

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
    
    private function getAsset($template, $filename, $type, $contentType) {
        $folder = __DIR__ . DS . '..' . DS . 'Resources' . DS . 'views' . DS . $template . DS . $type;
        $finder = new Finder();
        $finder->files()->in($folder);

        foreach ($finder as $file) {
            if (strpos($file->getRealpath(), $filename) !== false) {
                $response = new Response(file_get_contents($file->getRealpath()));
                $response->headers->set('Content-Type', $contentType);

                return $response;
            }
        }

        throw new FileNotFoundException('File "' . $filename . '" was not found in "' . $folder . '"');
    }

    public function getJsAction($templateName, $fileName)
    {
        return $this->getAsset($templateName, $fileName, 'js', 'application/javascript');
    }

    public function getCssAction($templateName, $fileName)
    {
        return $this->getAsset($templateName, $fileName, 'css', 'text/css');
    }

}
