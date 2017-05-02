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

        $this->addFlash('success','Vous avez ajouté cette vidéo à vos favoris');

        return $this->redirectToRoute('app_view_video', [
           'id' => $video->getId(),
        ]);
    }

    /**
     * @Route("/removefav/{id}", name="app_remove_fav")
     */
    public function removeFavoriAction(Video $video)
    {
        //appel du favori manager
        $favoriManager = $this->get('app.favori_manager');

        $favoriManager->removeFavoriToVideo($this->getUser(),$video);

        $this->addFlash('success','Vous avez supprimé cette vidéo de vos favoris');

        return $this->redirectToRoute('app_view_video', [
            'id' => $video->getId(),
        ]);
    }
}