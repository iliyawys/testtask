<?php

namespace App\Repository;

use App\Entity\Auth;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class AuthRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Auth::class);
    }
    

    /**
     * @param $day
     * @return Auth[]
     */
    public function allActiveLoginByDate($dayBack): array
    {
        $entityManager = $this->getEntityManager();
        $startDateTimestamp = getdate(mktime(0, 0, 0, date('m'), date('d') - (int) $dayBack, date('Y')))[0];
        $startDate = date('Y-m-d',$startDateTimestamp);

        return $qb = $this->createQueryBuilder('e')
                    ->select('DATE(e.created_at) as dateAsMonth, count(e.uid) total')
                    ->andWhere('e.created_at >= :created_at')
                    ->setParameter('created_at', $startDate)
                    ->groupBy('dateAsMonth')
                    ->getQuery()
                    ->getResult();
    }

    

}
