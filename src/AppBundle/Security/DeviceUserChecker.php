<?php

namespace AppBundle\Security;

use AppBundle\Entity\Channel;

use AppBundle\Entity\Device;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Security\Core\User\UserChecker;
use Symfony\Component\Security\Core\User\UserInterface;

class DeviceUserChecker extends UserChecker
{
    /** @var $doctrine Registry  */
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * Checks the user account before authentication.
     * @param UserInterface $device a UserInterface instance
     * @throws \Exception
     */
    public function checkPreAuth(UserInterface $device)
    {
        if (!$device instanceof Device) {
            throw new \Exception('Authentication fail. Wrong user type');
        }

        if ($device->getSuspended()) {
            throw new \Exception('Device suspended. Please contact support');
        }

        $device->setLastLogin(new \DateTime());

        $device->setLastLogin(new \DateTime());
        $this->doctrine->getManager()->flush();
        
        parent::checkPreAuth($device);
    }
}
