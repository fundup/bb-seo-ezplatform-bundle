<?php

namespace BruyereFreelance\SeoExtensionBundle\Entity\Repository;

/**
 * MetaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MetaRepository extends \Doctrine\ORM\EntityRepository
{

    public function findAllByIds($contentIds, $limit, $offset) {

        $qb = $this
            ->createQueryBuilder('a')
            ->where('a.contentId IN (:contentIds) ')
            ->setParameters([
                'contentIds'   => $contentIds,
            ]);

//            ->orderBy('a.createdAt', 'DESC');

        $qb->setFirstResult($offset)
            ->setMaxResults($limit);
        return $qb->getQuery()->getResult();
    }
}
