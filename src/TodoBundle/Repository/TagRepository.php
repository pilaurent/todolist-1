<?php

namespace TodoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use TodoBundle\Entity\Tag;
use TodoBundle\Entity\User;

class TagRepository extends EntityRepository
{
    # Calcul du nombre de tâche pour un tag
   public function getNbTasksbyTagAnduser(User $user, Tag $tag){
       return $this->createQueryBuilder('t')
           ->where('tag = :vtag')->setParameter('vtag', $tag)
           ->andWhere('t.user = :user')->setParameter('user', $user)
           ->getQuery()
           ->getSingleScalarResult()
           ;
   }
}
