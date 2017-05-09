<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AccueilController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        //recup de la page
        $page = $request->get('page');

        return $this->render(':Accueil:index.html.twig', [
            'videos' => $this->getVideos($page),
            'nbPages' => $this->getNumberOfPages(),
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

    /**
     * @param $page
     * @return \AppBundle\Entity\Video[]|array
     */
    private function getVideos($page)
    {
        $page = ($page > 0) ? $page : 1;
        $nbVideosPerPage = $this->getParameter('nbVideosPerPage');
        $limit = $nbVideosPerPage;
        $offset = ($page - 1) * $nbVideosPerPage;
        return $this->getVideoManager()->getAllVideos($offset,$limit);
    }

    /**
     * @return float
     */
    private function getNumberOfPages()
    {
        $count = $this->getVideoManager()->getCountVideos();
        $nbVideosPerPage = $this->getParameter('nbVideosPerPage');
        return ceil($count/$nbVideosPerPage);
    }
}