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
        ]);
    }
}