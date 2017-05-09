<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\Select;

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
            $video->setCount(0);
            $video->setIsActive(1);
            $this->manager->persist($video);
        }
        $this->manager->flush();
    }

    /**
     * @param Video $video
     */
    public function delete(Video $video)
    {
        $this->manager->remove($video);
        $this->manager->flush();
    }

    /**
     * @return Video[]|array
     */
    public function getAllVideos($offset,$limit)
    {
        return $this->manager->getRepository(Video::class)->getAllVideos($offset,$limit);
    }

    /**
     * @return mixed
     */
    public function getCountVideos()
    {
        return $this->manager->getRepository(Video::class)->getCountVideos();
    }

    /**
     * @param $url
     * @return mixed
     */
    public function getVideoByUrl($url)
    {
        return $this->manager->getRepository(Video::class)->getVideoByUrl($url);
    }

    /**
     * @param $videoId
     * @return Video|null|object
     */
    public function getVideoById($videoId)
    {
        return $this->manager->getRepository(Video::class)->find($videoId);
    }

    /**
     * @param Video $video
     */
    public function increaseCount(Video $video)
    {
        $video->setCount($video->getCount()+1);
        $this->save($video);
    }

    /**
     * @return array
     */
    public function getTopVideos()
    {
        return $this->manager->getRepository(Video::class)->getTopVideos();
    }

    /**
     * @param $nom
     * @return array
     */
    public function lookForVideos($nom)
    {
        return $this->manager->getRepository(Video::class)->lookForVideos($nom);
    }
}