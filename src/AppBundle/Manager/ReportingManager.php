<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Signalement;
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
     * @param $video
     */
    public function addSignalementToVideo($video)
    {
        $adresseIp = $_SERVER['REMOTE_ADDR'];
        if (!$this->manager->getRepository(Signalement::class)->getSignalementByVideoAndAdresseIp($video,$adresseIp))
        {
            $signalement = $this->create();
            $signalement->setVideo($video);
            $signalement->setAdresseIp($adresseIp);
            $this->save($signalement);
        }
    }
}