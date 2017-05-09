<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements FixtureInterface,ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
       $this->container = $container;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $datas = [
            [
                'username' => 'admin' ,
                'email' => 'admin@free.fr',
                'password' => 'admin',
                'enabled' => 1,
            ],
            [
                'username' => 'toto' ,
                'email' => 'toto@free.fr',
                'password' => 'toto',
                'enabled' => 1,
            ],
            [
                'username' => 'titi' ,
                'email' => 'titi@free.fr',
                'password' => 'titi',
                'enabled' => 1,
            ],
            [
                'username' => 'pikachu' ,
                'email' => 'pikachu@free.fr',
                'password' => 'pikachu',
                'enabled' => 1,
            ],
            [
                'username' => 'carapuce' ,
                'email' => 'carapuce@free.fr',
                'password' => 'carapuce',
                'enabled' => 1,
            ],
        ];

        foreach ($datas as $i => $data)
        {
            $user = new User();
            $user->setUsername($data['username']);
            $user->setEmail($data['email']);
            $user->setEnabled($data['enabled']);
            //mot de passe
            $encoder = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $data['password']);
            $user->setPassword($password);

            //on ajoute role_admin au premier
            if ($i==0)
            {
                $user->setRoles(['ROLE_ADMIN']);
            }
            $manager->persist($user);
            $this->addReference('user-'.$i,$user);
        }
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}