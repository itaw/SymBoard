<?php

namespace itaw\TemplateBundle\Twig;

class BBCodeExtension extends \Twig_Extension
{

    /**
     *
     * @var itaw\TemplateBundle\Service\BBCode 
     */
    protected $bb;

    public function __construct($bb)
    {
        $this->bb = $bb;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('bb', array($this, 'bbFilter')),
        );
    }

    public function bbFilter($text)
    {
        return $this->bb->parse($text);
    }

    public function getName()
    {
        return 'bbcode_extension';
    }

}
