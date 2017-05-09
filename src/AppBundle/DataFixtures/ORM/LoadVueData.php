<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Vue;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class  LoadVueData extends AbstractFixture implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $datas = [
            [
                'video-id'=>$this->getReference('video-0'),
                'adresseIp' => '124.125.136.23' ,
            ],
            [
                'video-id'=>$this->getReference('video-1'),
                'adresseIp' => '101.201.145.169' ,
            ],
            [
                'video-id'=>$this->getReference('video-1'),
                'adresseIp' => '142.136.145.364' ,
            ],
            [
                'video-id'=>$this->getReference('video-2'),
                'adresseIp' => 't23.25.69.78' ,
            ],
            [
                'video-id'=>$this->getReference('video-2'),
                'adresseIp' => '14.25.36.125' ,
            ],
            [
                'video-id'=>$this->getReference('video-3'),
                'adresseIp' => '221.158.136.145' ,
            ],
            [
                'video-id'=>$this->getReference('video-4'),
                'adresseIp' => '201.156.126.145' ,
            ],
            [
                'video-id'=>$this->getReference('video-4'),
                'adresseIp' => '149.145.144.100' ,
            ],
            [
                'video-id'=>$this->getReference('video-4'),
                'adresseIp' => '111.112.113.114' ,
            ],
        ];

        foreach ($datas as $i => $data)
        {
            $vue = new Vue();
            $vue->setVideo($data['video-id']);
            $vue->setAdresseIp($data['adresseIp']);

            $manager->persist($vue);
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