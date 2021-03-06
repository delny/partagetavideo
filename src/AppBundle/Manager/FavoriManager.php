<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Favori;
use AppBundle\Entity\User;
use AppBundle\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;

class FavoriManager
{
    private $manager;

    /**
     * FavoriManager constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->manager = $entityManager;
    }

    /**
     * @return Favori
     */
    public function create()
    {
        return new Favori();
    }

    /**
     * @param Favori $favori
     */
    public function save(Favori $favori)
    {
        if($favori->getId() === null)
        {
            $this->manager->persist($favori);
        }
        $this->manager->flush();
    }

    public function delete(Favori $favori)
    {
        $this->manager->remove($favori);
        $this->manager->flush();
    }

    /**
     * @param User $user
     * @param Video $video
     */
    public function addFavoriToVideo(User $user,Video $video)
    {
        if(!$this->manager->getRepository(Favori::class)->getFavoriByUserAndVideo($user,$video))
        {
            $favori = $this->create();
            $favori->setVideo($video)
                ->setUser($user);
            $this->save($favori);
        }
    }

    public function removeFavoriToVideo(User $user,Video $video)
    {
        if ($favori = $this->manager->getRepository(Favori::class)->getFavoriByUserAndVideo($user,$video))
        {
            $this->delete($favori);
        }
    }
}
