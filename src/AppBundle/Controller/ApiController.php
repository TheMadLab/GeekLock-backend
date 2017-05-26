<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DTO\AccessDto;
use AppBundle\Entity\DTO\AccessesDto;
use AppBundle\Entity\DTO\QueueDto;
use AppBundle\Entity\Log;
use AppBundle\Form\AccessesType;
use AppBundle\Form\QueueType;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class ApiController extends CustomJsonController
{
    /**
     * @Route("/api/status", name="api_status")
     */
    public function statusAction(Request $request)
    {
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
        $accesses = new QueueDto();
        $form = $this->createForm(QueueType::class, $accesses);
        $this->handleJsonForm($form, $request);

        /** @var AccessDto $access */
        foreach ($accesses->getQueue() as $access) {
            $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(['accessKey' => $access->getKey()]);
            if ($user) {
                $user->setMac($access->getMac());
                $log = new Log();
                $log
                    ->setUser($user)
                    ->setDatetime($access->getTimestamp());
                $this->getDoctrine()->getManager()->persist($log);
            }
        }
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse([
            'accesses' => $accesses
        ]);
    }

   


}
