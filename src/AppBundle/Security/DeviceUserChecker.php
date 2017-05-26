<?php

namespace AppBundle\Security;

use AppBundle\Entity\Channel;

use AppBundle\Entity\Device;
use Symfony\Component\Security\Core\User\UserChecker;
use Symfony\Component\Security\Core\User\UserInterface;

class DeviceUserChecker extends UserChecker
{
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

        parent::checkPreAuth($device);
    }
}
