<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VideoRepository")
 */
class Video
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
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     *
     * @Assert\Regex(
     *     pattern="/^http[s]{0,1}:\/\/www.youtube.com\/watch\?v=[a-zA-Z0-9_-]{11}$/i",
     *     match= true,
     *     message="l'url n'est pas valide!"
     * )
     */
    private $url;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="count", type="integer")
     */
    private $count;

    /**
     * @var int
     *
     * @ORM\Column(name="is_active", type="integer")
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",
     *     inversedBy="videos")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Vue",
     *     mappedBy="video"
     *     )
     */
    private $vues;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Favori",
     *     mappedBy="video")
     */
    private $favoris;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Signalement",
     *     mappedBy="video")
     */
    private $signalements;


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
     * Set titre
     *
     * @param string $titre
     *
     * @return Video
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Video
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Video
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
     * Set count
     *
     * @param integer $count
     *
     * @return Video
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set isActive
     *
     * @param integer $isActive
     *
     * @return Video
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return int
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return Video
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrlNumber()
    {
        return explode("=", $this->getUrl())[1];
    }

    /**
     * @return mixed
     */
    public function getVues()
    {
        return $this->vues;
    }

    /**
     * @param mixed $vues
     * @return Video
     */
    public function setVues($vues)
    {
        $this->vues = $vues;
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
     * @return Video
     */
    public function setFavoris($favoris)
    {
        $this->favoris = $favoris;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSignalements()
    {
        return $this->signalements;
    }

    /**
     * @param mixed $signalements
     * @return Video
     */
    public function setSignalements($signalements)
    {
        $this->signalements = $signalements;
        return $this;
    }


}

