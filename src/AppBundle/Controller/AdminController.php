<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Video;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="app_admin_index")
     */
    public function AdminAction()
    {
        return $this->render(':Admin:admin.html.twig', [
            'videos' => $this->getReportingManager()->getReportedVideos(),
        ]);
    }

    /**
     * @Route("/admin/desactive/{id}", name="app_video_desactive")
     */
    public function desactiveVideoAction(Video $video)
    {
        $video->setIsActive(0);
        $this->getVideoManager()->save($video);
        return $this->redirectToRoute('app_admin_index');
    }

    /**
     * @Route("/admin/active/{id}", name="app_video_active")
     */
    public function activeVideoAction(Video $video)
    {
        $video->setIsActive(1);
        $this->getVideoManager()->save($video);
        return $this->redirectToRoute('app_admin_index');
    }

    /**
     * @return \AppBundle\Manager\VideoManager|object
     */
    private function getVideoManager()
    {
        return $this->get('app.video_manager');
    }

    /**
     * @return \AppBundle\Manager\ReportingManager|object
     */
    private function getReportingManager()
    {
        return $this->get('app.reporting_manager');
    }
}
