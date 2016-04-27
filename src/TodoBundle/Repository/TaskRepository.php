<?php

namespace TodoBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TaskRepository extends EntityRepository
{
    private function getTasksBetweenDates($minDate, $maxDate)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.dueDate >= :minDate')->setParameter('minDate', $minDate)
            ->andWhere('t.dueDate <= :maxDate')->setParameter('maxDate', $maxDate)
            ->getQuery()
            ->getResult()
            ;
    }
    public function getAllOfTheDay()
    {
        $minDate = new \DateTime();
        $minDate->format('Y-m-d H:i:s');
        $minDate->setTime(0, 0, 0);

        $maxDate = new \DateTime();
        $maxDate->format('Y-m-d H:i:s');
        $maxDate->setTime(23, 59, 59);

        return $this->getTasksBetweenDates($minDate, $maxDate);
    }

    public function getAllOfTheWeek()
    {
        return $this->getTasksBetweenDates(
            date('Y-m-d', strtotime('monday this week')),
            date('Y-m-d', strtotime('sunday this week'))
        );
    }
}
