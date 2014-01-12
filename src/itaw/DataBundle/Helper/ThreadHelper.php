<?php

namespace itaw\DataBundle\Helper;

class ThreadHelper
{

    /**
     * 
     * @param string $title
     * @param type $doctrine
     * @return string
     */
    public static function generateSlug($title, $doctrine)
    {
        $slug = urlencode(strtolower(substr(str_replace(' ', '-', str_replace('!', '', str_replace('?', '', str_replace('.', '', str_replace(',', '', $title))))), 0, 50)));

        $thread = $doctrine->getRepository('itawDataBundle:Thread')->findOneBySlug($slug);
        if (!$thread) {
            return $slug;
        } else {
            $count = $doctrine->getRepository('itawDataBundle:Thread')->findCountLikeSlug($slug);
            $count = $count + 1;
            
            $slug .= '-' . $count;

            return $slug;
        }
    }

}
