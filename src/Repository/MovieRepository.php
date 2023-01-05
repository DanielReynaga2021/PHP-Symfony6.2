<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use DateTime;

/**
 * @extends ServiceEntityRepository<Movie>
 *
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    public function save(Movie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Movie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findMovie(array $filterAndOrder){
        $qb = $this->createQueryBuilder('mv');
        $this->addFilters($qb, $filterAndOrder);
        return $qb->getQuery()->getResult();
    }

    private function addFilters($qb, $filters)
    {        
        foreach($filters as $key => $value)
        {
            if($value !== null)
                $this->setFilter($qb, $key , $value);
        }
    }

    private function setFilter($qb, $key , $value)
    {
        switch ($key) {
            case "filter_name":
                $this->filterPerName($value, $qb);
                break;
            case "filter_release_date":
                $this->filterPerReleaseDate($value, $qb);
                break;
            case "order_release_date":
                $this->orderPerReleaseDate(strtolower($value), $qb);
                break;
            case "order_name":
                $this->orderPerName(strtolower($value), $qb);
                break;
            default:
                break;
        }
    }

    private static function filterPerName($filterValue, $qb)
    {   
            $qb->andWhere("mv.name = '".$filterValue."'");
        // other way
        // $qb->andWhere("mv.name = :name");
        // $qb->setParameter("name",$filterValue);
    }

    private static function filterPerReleaseDate($filterValue, $qb)
    {   
        $date = DateTime::createFromFormat("d-m-Y", $filterValue)->format("Y-m-d");
            $qb->andWhere("mv.releaseDate = '".$date."'");

        
    }

    private static function orderPerReleaseDate($filterValue, $qb)
    {   
        if($filterValue == 'asc' || $filterValue == 'desc'){
            $qb->orderBy('mv.releaseDate', $filterValue);
        }
    }

    private static function orderPerName($filterValue, $qb)
    {   
        if($filterValue == 'asc' || $filterValue == 'desc'){
            $qb->orderBy('mv.name', $filterValue);
        }
    }


//    /**
//     * @return Movie[] Returns an array of Movie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Movie
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
