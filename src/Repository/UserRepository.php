<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }
    
    /**
     * @param $date
     * @return User[]
     */
    public function allRegisterUserByDate($date): array
    {
        $entityManager = $this->getEntityManager();
        $startDate = date('Y-m-01');

        $query = $entityManager->createQuery(
            'SELECT p.city,count(p.city) as cnt  
            FROM App\Entity\User p
            WHERE p.created_at >= :startDate
            GROUP BY p.city'
        )->setParameter('startDate', $date);

        return $query->execute();
    }

    /**
     * @param $day
     * @return User[]
     */
    public function birthdayByDate($dayBack): array
    {
        $entityManager = $this->getEntityManager();
        $startDateTimestamp = getdate(mktime(0, 0, 0, date('m'), date('d') - (int) $dayBack, date('Y')))[0];
        $startDate = date('m-d',$startDateTimestamp);

        return $qb = $this->createQueryBuilder('e')
            ->andWhere('date_format(e.birthday, \'%m-%d\') >= :birthday')
            ->setParameter('birthday', $startDate)
            ->getQuery()
            ->getResult();
    }

}
