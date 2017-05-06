<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Signalement;
use AppBundle\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;

class ReportingManager
{
    private $manager;

    /**
     * ReportingManager constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->manager = $entityManager;
    }

    /**
     * @return Signalement
     */
    public function create()
    {
        return new Signalement();
    }

    /**
     * @param Signalement $signalement
     */
    public function save(Signalement $signalement)
    {
        if ($signalement->getId() === null)
        {
            $this->manager->persist($signalement);
        }
        $this->manager->flush();
    }

    /**
     * @param Signalement $signalement
     */
    public function remove(Signalement $signalement)
    {
        $this->manager->remove($signalement);
        $this->manager->flush();
    }

    /**
     * @param $video
     */
    public function addSignalementToVideo(Video $video)
    {
        if (!$this->isReported($video))
        {
            $signalement = $this->create();
            $signalement->setVideo($video);
            $signalement->setAdresseIp($_SERVER['REMOTE_ADDR']);
            $this->save($signalement);
        }
    }

    /**
     * @param Video $video
     */
    public function removeSignalementToVideo(Video $video)
    {
        if ($signalement = $this->manager->getRepository(Signalement::class)->getSignalementByVideoAndAdresseIp($video,$_SERVER['REMOTE_ADDR']))
        {
            $this->remove($signalement);
        }
    }

    /**
     * @param Video $video
     * @return bool
     */
    public function isReported(Video $video)
    {
        $adresseIp = $_SERVER['REMOTE_ADDR'];
        if($this->manager->getRepository(Signalement::class)->getSignalementByVideoAndAdresseIp($video,$adresseIp))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * @return array
     */
    public function getReportedVideos()
    {
        return $this->manager->getRepository(Video::class)->getReportedVideos();
    }
}