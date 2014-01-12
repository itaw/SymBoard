<?php

namespace itaw\DataBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ThreadRepository extends EntityRepository
{

    public function findCountLikeSlug($slug)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder()
                ->add('select', 'count(t.id)')
                ->add('from', 'itawDataBundle:Thread t')
                ->add('where', "t.slug like ?1")
                ->setParameter(1, $slug . '%');
        $query = $qb->getQuery();

        return $query->getResult()[0][1];
    }

}
