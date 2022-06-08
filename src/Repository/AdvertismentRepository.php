<?php

namespace App\Repository;

use App\Entity\Advertisment;
use App\MyClasses\AdsFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Advertisment>
 *
 * @method Advertisment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advertisment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advertisment[]    findAll()
 * @method Advertisment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertismentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Advertisment::class);
    }

    public function add(Advertisment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Advertisment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    /**
     * @return Advertisment[] Returns an array of Advertisment objects
     */
    public function findByFilters(AdsFilter $adsFilter): array
    {
        $query = $this
            ->createQueryBuilder('a')
            ->join('a.OwnedBy','OwnedBy')
            ->join('a.accommodationType','AccommodationType')
            ->join('a.RentsPeriodation','RentPeriodation')
            ->join('a.state','States')
        ;
        if(!(empty($adsFilter->BareSearch_filter))){
            $query = $query
                ->andWhere('OwnedBy.FirstName LIKE :search OR OwnedBy.LastName LIKE :search')
                ->setParameter(':search', "%{$adsFilter->BareSearch_filter}%");
        }
        if(!(empty($adsFilter->Accomodation_filter))){
            $query = $query
                ->andWhere('AccommodationType.id IN (:accommodationType)')
                ->setParameter(':accommodationType', $adsFilter->Accomodation_filter);
        }
        if(!(empty($adsFilter->RentPeriodation_filter))){
            $query = $query
                ->andWhere('RentPeriodation.id IN (:AcomodationType)')
                ->setParameter(':AcomodationType', $adsFilter->RentPeriodation_filter);
        }
        if(!(empty($adsFilter->States_filter))){
            $query = $query
                ->andWhere('States.id IN (:States)')
                ->setParameter(':States', $adsFilter->States_filter);
        }
        return $query->getQuery()->getResult();
    }

//    /**
//     * @return Advertisment[] Returns an array of Advertisment objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Advertisment
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }




}
