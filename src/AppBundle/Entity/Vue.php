<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vue
 *
 * @ORM\Table(name="vue")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VueRepository")
 */
class Vue
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="video_id", type="integer")
     */
    private $videoId;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_ip", type="string", length=255)
     */
    private $adresseIp;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set videoId
     *
     * @param integer $videoId
     *
     * @return Vue
     */
    public function setVideoId($videoId)
    {
        $this->videoId = $videoId;

        return $this;
    }

    /**
     * Get videoId
     *
     * @return int
     */
    public function getVideoId()
    {
        return $this->videoId;
    }

    /**
     * Set adresseIp
     *
     * @param string $adresseIp
     *
     * @return Vue
     */
    public function setAdresseIp($adresseIp)
    {
        $this->adresseIp = $adresseIp;

        return $this;
    }

    /**
     * Get adresseIp
     *
     * @return string
     */
    public function getAdresseIp()
    {
        return $this->adresseIp;
    }
}

