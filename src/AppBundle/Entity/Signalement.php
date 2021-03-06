<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Signalement
 *
 * @ORM\Table(name="signalement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SignalementRepository")
 */
class Signalement
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
     * @var Video
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Video",
     *     inversedBy="signalements")
     */
    private $video;


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
     * @return Signalement
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
     * @return Signalement
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

    /**
     * @return Video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param Video $video
     * @return Signalement
     */
    public function setVideo($video)
    {
        $this->video = $video;
        return $this;
    }

}

