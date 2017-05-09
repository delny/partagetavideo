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
    public function increaseCount(Video $video,$adresseIp)
    {
        $videoId = $video->getId();
        if(!$this->manager->getRepository(Vue::class)->getVueByVideoIdAndAdresseIp($videoId,$adresseIp))
        {
            $vue = $this->create();
            $vue->setVideo($video);
            $vue->setAdresseIp($adresseIp);
            $this->save($vue);
        }
    }
}