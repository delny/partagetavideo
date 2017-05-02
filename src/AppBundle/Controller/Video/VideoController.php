<?php

namespace AppBundle\Controller\Video;

use AppBundle\Form\VideoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VideoController extends Controller
{
    /**
     * @Route("/new-video", name="app_new_video")
     */
    public function addVideoAction(Request $request)
    {
        //appel du manager
        $videoManager = $this->get('app.video_manager');

        //creation instance video
        $video = $videoManager->create();

        //creation formulaire
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $video->setUser($this->getUser());
            //si formulaire valide
            if(!$videoManager->getVideoByUrl($video->getUrl()))
            {
                $videoManager->save($video);
                $this->addFlash('success','Votre vidéo a bien été ajouté !');
                return $this->redirectToRoute('homepage');
            }

            $this->addFlash('danger', 'Erreur : cette vidéo a déjà été posté !');
        }

        //dump($form);
        //exit();
        return $this->render(':Video:new.html.twig', [
           'form' => $form->createView(),
        ]);
    }
}