<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Log;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Log controller.
 *
 * @Route("log")
 */
class LogController extends Controller
{
    /**
     * Lists all log entities.
     *
     * @Route("/", name="log_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $logs = $em->getRepository('AppBundle:Log')->getOrdered();

        return $this->render('log/index.html.twig', array(
            'logs' => $logs,
        ));
    }

    /**
     * Finds and displays a log entity.
     *
     * @Route("/{id}", name="log_show")
     * @Method("GET")
     */
    public function showAction(Log $log)
    {

        return $this->render('log/show.html.twig', array(
            'log' => $log,
        ));
    }
}
