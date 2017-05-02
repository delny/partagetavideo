<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;

class VideoManager
{
    private $manager;

    /**
     * VideoManager constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->manager = $entityManager;
    }

    /**
     * @return Video
     */
    public function create()
    {
        return new Video();
    }

    /**
     * @param Video $video
     */
    public function save(Video $video)
    {
        if ($video->getId() === null)
        {
            $this->manager->persist($video);
        }
        $this->manager->flush();
    }

    /**
     * @return Video[]|array
     */
    public function getAllVideos()
    {
        return $this->manager->getRepository(Video::class)->findAll();
    }
}