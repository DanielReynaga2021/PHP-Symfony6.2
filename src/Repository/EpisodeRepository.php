<?php

namespace App\Repository;

use App\Entity\Director;
use App\Entity\Episode;
use App\Entity\Season;
use App\Entity\Tv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Episode>
 *
 * @method Episode|null find($id, $lockMode = null, $lockVersion = null)
 * @method Episode|null findOneBy(array $criteria, array $orderBy = null)
 * @method Episode[]    findAll()
 * @method Episode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EpisodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Episode::class);
    }

    public function save(Episode $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Episode $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findEpisodeBynumberEpisodeAndNameTvShow(int $numberEpisode, string $nameTvShow){
        return $this->createQueryBuilder('e')
        ->select("e.id AS idEpisode, e.name AS nameEpisode, e.numberEpisode, e.releaseDate AS releaseDateEpisode, d.id AS idDirector, d.name AS nameDirector, d.lastName AS lastNameDirector, d.dateBirth AS dateBirthDirector")
        ->innerJoin(Season::class, 's', Join::WITH, 's.id = e.season')
        ->innerJoin(Tv::class, 't', Join::WITH, 't.id = s.tv')
        ->innerJoin(Director::class, 'd', Join::WITH, 'd.id = t.director')
        ->where('e.numberEpisode = :numberEpisode')
        ->andWhere('t.name = :nameTvShow')
        ->setParameter('numberEpisode',$numberEpisode)
        ->setParameter('nameTvShow', $nameTvShow)
        ->getQuery()
        ->getOneOrNullResult();
    }

//    /**
//     * @return Episode[] Returns an array of Episode objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Episode
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
