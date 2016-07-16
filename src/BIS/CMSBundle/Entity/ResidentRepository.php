<?php

namespace BIS\CMSBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ResidentRepository extends EntityRepository {
    public function findByKeyword($keyword) {
        return $this
            ->createQueryBuilder('r')
            ->where('r.fname LIKE :keyword')
            ->orWhere('r.lname LIKE :keyword')
            ->orWhere('r.mname LIKE :keyword')
            ->setParameter('keyword', '%' . $keyword . '%')
            ->getQuery();
    }
}