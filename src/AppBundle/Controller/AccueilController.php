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
        //appel du video manager
        $videoManager = $this->get('app.video_manager');

        return $this->render(':Accueil:index.html.twig', [
            'videos' => $videoManager->getAllVideos(),
        ]);
    }
}