<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Video;
use AppBundle\Form\Type\VideoType;
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

        return $this->render(':Video:new.html.twig', [
           'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/video/{id}", name="app_view_video")
     */
    public function viewAction(Video $video,Request $request)
    {
        //appels des manager
        $videoManager = $this->get('app.video_manager');
        $vueManager = $this->get('app.vue_manager');
        $reportingManager = $this->get('app.reporting_manager');

        //augmentation des compteurs
        $videoManager->increaseCount($video);
        $vueManager->increaseCount($video,$request->getClientIp());

        return $this->render(':Video:view.html.twig', [
            'video' => $video,
            'isReporting' => $reportingManager->isReported($video,$request->getClientIp()),
        ]);
    }

    /**
     * @Route("/video/edit/{id}", name="app_edit_video")
     */
    public function editAction(Request $request,$id)
    {
        //appel manager
        $videoManager = $this->get('app.video_manager');
        $video = $videoManager->getVideoById($id);

        if (empty($video) || ($video->getUser() != $this->getUser()))
        {
            return $this->redirectToRoute('homepage');
        }

        //creation formulaire
        $form = $this->createForm(\AppBundle\Form\Type\VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            //si formulaire valide
            $videoManager->save($video);
            $this->addFlash('success','Votre vidéo a bien été mis à jour !');
        }

        return $this->render(':Video:edit.html.twig', [
            'form' => $form->createView(),
            'video' => $video,
        ]);
    }

    /**
     * @Route("/video/delete/{id}", name="app_delete_video")
     */
    public function deleteAction(Video $video)
    {
        if ($video->getUser() == $this->getUser())
        {
            //on supprime la video
            $this->get('app.video_manager')->delete($video);
            $this->addFlash('success','Votre vidéo a été supprimé !');
        }

        return $this->redirectToRoute('homepage');
    }
}
