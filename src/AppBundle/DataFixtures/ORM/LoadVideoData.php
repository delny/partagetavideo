<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Video;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadVideoData extends AbstractFixture implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $datas = [
            [
                'user-id'=>$this->getReference('user-1'),
                'titre' => 'trop bien' ,
                'url' => 'https://www.youtube.com/watch?v=JGwWNGJdvx8',
                'count' => 5,
                'is_active' => 1,
            ],
            [
                'user-id'=>$this->getReference('user-1'),
                'titre' => 'video geniale' ,
                'url' => 'https://www.youtube.com/watch?v=papuvlVeZg8',
                'count' => 12,
                'is_active' => 1,
            ],
            [
                'user-id'=>$this->getReference('user-2'),
                'titre' => 'blabla' ,
                'url' => 'https://www.youtube.com/watch?v=34Na4j8AVgA',
                'count' => 4,
                'is_active' => 0,
            ],
            [
                'user-id'=>$this->getReference('user-2'),
                'titre' => 'trop bien' ,
                'url' => 'https://www.youtube.com/watch?v=PT2_F-1esPk',
                'count' => 12,
                'is_active' => 1,
            ],
            [
                'user-id'=>$this->getReference('user-3'),
                'titre' => 'ouais !!' ,
                'url' => 'https://www.youtube.com/watch?v=3AtDnEC4zak',
                'count' => 36,
                'is_active' => 1,
            ],
        ];

        foreach ($datas as $i => $data)
        {
            $video = new Video();
            $video->setUser($data['user-id']);
            $video->setTitre($data['titre']);
            $video->setUrl($data['url']);
            $video->setCount($data['count']);
            $video->setIsActive($data['is_active']);

            $manager->persist($video);
            $this->addReference('video-'.$i, $video);
        }
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }
}