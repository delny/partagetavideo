<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Video;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReportingController extends Controller
{
    /**
     * @Route("/addreporting/{id}", name="app_reporting_new")
     */
    public function addReportingAction(Video $video,Request $request)
    {
        //reportingManager
        $reportingManager = $this->get('app.reporting_manager');

        $reportingManager->addSignalementToVideo($video,$request->getClientIp());

        return $this->redirectToRoute('app_view_video', [
            'id' => $video->getId(),
        ]);
    }

    /**
     * @Route("/removereporting/{id}", name="app_reporting_remove")
     */
    public function removeReportingAction(Video $video,Request $request)
    {
        //reportingManager
        $reportingManager = $this->get('app.reporting_manager');

        $reportingManager->removeSignalementToVideo($video,$request->getClientIp());

        return $this->redirectToRoute('app_view_video', [
            'id' => $video->getId(),
        ]);
    }
}
