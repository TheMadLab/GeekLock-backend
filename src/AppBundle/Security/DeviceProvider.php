<?php

namespace  AppBundle\Security;

use AppBundle\Entity\BaseUser;
use AppBundle\Entity\Device;
use AppBundle\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class DeviceProvider implements UserProviderInterface
{
    /** @var $doctrine Registry  */
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    private function getEm()
    {
        return $this->doctrine->getManager();
    }
    
    public function loadUserByUsername($username)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->getEm()->getRepository('AppBundle:Device')->createQueryBuilder('d');
        $q = $qb
            ->andWhere('d.apikey = :apikey')
            ->setParameter('apikey', $username)
            ->getQuery();

        try {
            $user = $q->getSingleResult();
        } catch (NoResultException $e) {
            $message = sprintf('Unable to find User with username "%s".', $username);
            throw new UsernameNotFoundException($message, 0, $e);
        }

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        /** @var User $user */
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(
                sprintf(
                    'Instances of "%s" are not supported.',
                    $class
                )
            );
        }
        $user = $this->getEm()->getRepository('AppBundle:Device')->find($user->getId());
        return $user;

    }

    public function supportsClass($class)
    {
        return Device::class === $class || is_subclass_of($class, Device::class);
    }
}