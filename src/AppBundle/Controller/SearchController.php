<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="app_search")
     */
    public function resultAction(Request $request)
    {
        //on recupere le terme de la recherche
        $nom = $request->get('nom');

        return $this->render(':Search:results.html.twig',[
            'usersFound' => $this->getUserManager()->lookForUsers($nom),
            'videosFound' => $this->getVideoManager()->lookForVideos($nom),
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
