<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favori
 *
 * @ORM\Table(name="favori")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FavoriRepository")
 */
class Favori
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
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="video_id", type="integer")
     */
    private $videoId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Video",
     *     inversedBy="favoris")
     */
    private $video;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",
     *     inversedBy="favoris")
     */
    private $user;


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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Favori
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set videoId
     *
     * @param integer $videoId
     *
     * @return Favori
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
     * @return mixed
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param mixed $video
     * @return Favori
     */
    public function setVideo($video)
    {
        $this->video = $video;
        return $this;
    }

}

