<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Video;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FavoriController extends Controller
{

    /**
     * @Route("/addfav/{id}", name="app_new_fav")
     */
    public function newFavoriAction(Video $video)
    {
        //appel du favorimanager
        $favoriManager = $this->get('app.favori_manager');

        $favoriManager->addFavoriToVideo($this->getUser(),$video);

        return $this->redirectToRoute('app_view_video', [
           'id' => $video->getId(),
        ]);
    }
}