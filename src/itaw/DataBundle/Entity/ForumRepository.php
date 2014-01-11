<?php

namespace itaw\DataBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ForumRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ForumRepository extends EntityRepository
{

    public function findAllWithoutParent()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder()
                ->add('select', 'f')
                ->add('from', 'itawDataBundle:Forum f')
                ->add('where', 'f.parent is null');
        $query = $qb->getQuery();

        return $query->getResult();
    }

}
