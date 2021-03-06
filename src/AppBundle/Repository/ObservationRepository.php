<?php

namespace AppBundle\Repository;

/**
 * ObservationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ObservationRepository extends \Doctrine\ORM\EntityRepository
{
    public function importerObservations(){
        return $this
            ->createQueryBuilder('observation')
            ->innerJoin('observation.espece')
            ->where('observation.active = true')
            ->getQuery()
            ->getResult()
            ;
    }

    public function importerOiseaux($famille){
        return $this
            ->createQueryBuilder('observation')
            ->addSelect('espece')
            ->leftJoin('observation.espece', 'espece')
            ->addSelect('famille')
            ->leftJoin('espece.famille', 'famille')
            ->where('observation.active = 1')
            ->andWhere('famille.nomFamille = :nom_famille')
            ->setParameter('nom_famille', $famille)
            ->getQuery()
            ->getArrayResult()
            ;
    }
}
