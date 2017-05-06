<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Video;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReportingController extends Controller
{
    /**
     * @Route("/addreporting/{id}", name="app_reporting_new")
     */
    public function addReportingAction(Video $video)
    {
        //reportingManager
        $reportingManager = $this->get('app.reporting_manager');

        $reportingManager->addSignalementToVideo($video);

        return $this->redirectToRoute('app_view_video', [
            'id' => $video->getId(),
        ]);
    }

    /**
     * @Route("/removereporting/{id}", name="app_reporting_remove")
     */
    public function removeReportingAction(Video $video)
    {
        //reportingManager
        $reportingManager = $this->get('app.reporting_manager');

        $reportingManager->removeSignalementToVideo($video);

        return $this->redirectToRoute('app_view_video', [
            'id' => $video->getId(),
        ]);
    }
}