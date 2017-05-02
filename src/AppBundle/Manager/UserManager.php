<?php

 namespace AppBundle\Manager;

 use AppBundle\Entity\User;
 use Doctrine\ORM\EntityManagerInterface;

 class UserManager
 {
     private $manager;

     /**
      * UserManager constructor.
      * @param EntityManagerInterface $entityManager
      */
     public function __construct(EntityManagerInterface $entityManager)
     {
         $this->manager = $entityManager;
     }

     /**
      * @return User
      */
     public function create()
     {
         return new User();
     }
 }