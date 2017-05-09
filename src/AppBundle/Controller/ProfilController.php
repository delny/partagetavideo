<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfilController extends Controller
{
    /**
     * @Route("/profil/{username}", name="app_profil_view")
     */
    public function viewProfilAction(User $userProfil)
    {
        return $this->render(':Profil:view.html.twig',[
            'userProfil' => $userProfil,
            'topUsers' => $this->getUserManager()->getTopUsers(),
            'topVideos' => $this->getVideoManager()->getTopVideos(),
        ]);
    }

    /**
     * @return \AppBundle\Manager\UserManager|object
     */
    private function getUserManager()
    {
        return $this->get('app.user_manager');
    }

    /**
     * @return \AppBundle\Manager\VideoManager|object
     */
    private function getVideoManager()
    {
        return $this->get('app.video_manager');
    }
}
