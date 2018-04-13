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
                    ->select('DATE(e.created_at) as dateAsMonth, count(e.user_id) total')
                    ->andWhere('e.created_at >= :created_at')
                    ->setParameter('created_at', $startDate)
                    ->groupBy('dateAsMonth')
                    ->getQuery()
                    ->getResult();
    }

    /**
     * @param $day
     * @return Auth[]
     */
    public function allActiveLoginByUsername($dayBack): array
    {
        $entityManager = $this->getEntityManager();
        $startDateTimestamp = getdate(mktime(0, 0, 0, date('m'), date('d') - (int) $dayBack, date('Y')))[0];
        $startDate = date('Y-m-d',$startDateTimestamp);

        return $qb = $this->createQueryBuilder('e')
                    ->select('e.user_id, count(e.user_id) total, DATE(e.created_at) as dateAsMonth, u.firstName, u.secondName')
                    ->andWhere('e.created_at >= :created_at')
                    ->setParameter('created_at', $startDate)
                    ->groupBy('e.user_id, dateAsMonth')
                    ->join('e.user', 'u')
                    // ->addSelect('u')
                    ->getQuery()
                    ->getResult();
                    
        return [];
    }

}
