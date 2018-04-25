<?php

namespace Innova\MediaBornageBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Innova\MediaBornageBundle\Entity\MediaResource;

/**
 * RegionRepository.
 */
class RegionRepository extends EntityRepository
{
    /**
     * find a region according to a given time.
     */
    public function findRegionByTime(MediaResource $mr, $time)
    {
        $dql = '
          SELECT r FROM  Innova\MediaBornageBundle\Entity\Region r
          WHERE r.mediaResource = :mr
          AND r.start <= :time
          AND r.end > :time
        ';
        $query = $this->_em->createQuery($dql);
        $query->setParameter('time', $time);
        $query->setParameter('mr', $mr);

        return $query->getOneOrNullResult();
    }
}
