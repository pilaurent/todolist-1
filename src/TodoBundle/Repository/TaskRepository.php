<?php

namespace TodoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use TodoBundle\Entity\Tag;
use TodoBundle\Entity\User;

class TaskRepository extends EntityRepository
{
    private function getTasksBetweenDates($minDate, $maxDate, $user)
    {
        return $this->createQueryBuilder('t')
            ->where('t.dueDate >= :minDate')->setParameter('minDate', $minDate)
            ->andWhere('t.dueDate <= :maxDate')->setParameter('maxDate', $maxDate)
            ->andWhere('t.user = :user')->setParameter('user', $user)
            ->getQuery()
            ->getResult()
            ;
    }
    public function getAllOfTheDay(User $user)
    {
        $minDate = new \DateTime();
        $minDate->format('Y-m-d H:i:s');
        $minDate->setTime(0, 0, 0);

        $maxDate = new \DateTime();
        $maxDate->format('Y-m-d H:i:s');
        $maxDate->setTime(23, 59, 59);

        return $this->getTasksBetweenDates($minDate, $maxDate, $user);
    }

    public function getAllOfTheWeek(User $user)
    {
        return $this->getTasksBetweenDates(
            date('Y-m-d', strtotime('monday this week')),
            date('Y-m-d 23:59:59', strtotime('sunday this week')),
            $user
        );
    }

    public function getAllOfTheMonth(User $user)
    {
        return $this->getTasksBetweenDates(
            date('Y-m-01'),
            date('Y-m-t'),
            $user
        );
    }

    public function getTasksByTagAndUser(User $user, Tag $tag)
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.tag', 'tag')
            ->where('tag = :tag')->setParameter('tag', $tag)
            ->andWhere('t.user = :user')->setParameter('user', $user)
            ->getQuery()
            ->getResult()
            ;
    }
}
