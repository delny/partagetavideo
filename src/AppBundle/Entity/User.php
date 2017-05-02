<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Video",
     *     mappedBy="user")
     */
    private $videos;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Favori",
     *     mappedBy="user")
     */
    private $favoris;

    public function __construct()
    {
        parent::__construct();
    }

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
     * @return mixed
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param mixed $videos
     * @return User
     */
    public function setVideos($videos)
    {
        $this->videos = $videos;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFavoris()
    {
        return $this->favoris;
    }

    /**
     * @param mixed $favoris
     * @return User
     */
    public function setFavoris($favoris)
    {
        $this->favoris = $favoris;
        return $this;
    }


}

