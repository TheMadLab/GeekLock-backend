<?php

namespace AppBundle\Controller;

use Mcfedr\JsonFormBundle\Controller\JsonController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class ApiController extends JsonController
{
    /**
     * @Route("/api/status", name="api_status")
     */
    public function statusAction(Request $request)
    {
        // replace this example code with whatever you need
        return new JsonResponse([
            "timestamp" => time(),
            "db_update" => 312564659,
            "open" => 312594656,
            "lock" => true
        ]);
    }

    /**
     * @Route("/api/users", name="api_users")
     */
    public function usersAction(Request $request)
    {
        $offset = $request->query->get('offset', 0);
        $perPage = 10;
        $users = $this->getDoctrine()->getRepository('AppBundle:User')->paginate($offset, $perPage, $total);
        return new JsonResponse([
            'users' => $users,
            'offset' => $offset,
            'total' => $total,
            'length' => $perPage
        ]);
    }

    /**
     * @Route("/api/access-log", name="api_access")
     * @Method({"POST"})
     */
    public function accessAction(Request $request)
    {
        
        $offset = $request->query->get('offset', 0);
        $perPage = 10;
        $users = $this->getDoctrine()->getRepository('AppBundle:User')->paginate($offset, $perPage, $total);
        return new JsonResponse([
            'users' => $users,
            'offset' => $offset,
            'total' => $total,
            'length' => $perPage
        ]);
    }

   


}
