<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Video;
use AppBundle\Entity\Vue;
use Doctrine\ORM\EntityManagerInterface;

class VueManager
{
    private $manager;

    /**
     * VueManager constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->manager = $entityManager;
    }

    /**
     * @return Vue
     */
    public function create()
    {
        return new Vue();
    }

    /**
     * @param Vue $vue
     */
    public function save(Vue $vue)
    {
        if($vue->getId() === null)
        {
            $this->manager->persist($vue);
        }
        $this->manager->flush();
    }

    /**
     * @param Video $video
     */
    public function increaseCount(Video $video)
    {
        $videId = $video->getId();
        $adresseIp = $_SERVER['REMOTE_ADDR'];
        if(!$this->manager->getRepository(Vue::class)->getVueByVideoIdAndAdresseIp($videId,$adresseIp))
        {
            $vue = $this->create();
            $vue->setVideoId($videId);
            $vue->setAdresseIp($adresseIp);
            $this->save($vue);
        }
    }
}