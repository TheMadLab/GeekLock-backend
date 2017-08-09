<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Device
 *
 * @ORM\Table(name="device")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DeviceRepository")
 */
class Device implements UserInterface
{
    const ROLE_DEVICE = 'ROLE_DEVICE';
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     * @Assert\NotNull()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="apikey", type="string", length=32, unique=true)
     * @Assert\NotNull()
     */
    private $apikey;

    /**
     * @var boolean
     * @ORM\Column(name="suspended", type="boolean", nullable=true)
     */
    private $suspended = false;

    /**
     * @var \DateTime
     * @ORM\Column(name="lastLogin", type="datetimetz", nullable=true)
     */
    private $lastLogin;
    
    /**
     * Device constructor.
     */
    public function __construct()
    {
        $this->apikey = md5(time() . rand(0,9999) . substr(str_shuffle(md5(microtime())), 0, 10) . ' Gary Du' . substr(str_shuffle(MD5(microtime())), 0, 10));
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Device
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set apikey
     *
     * @param string $apikey
     *
     * @return Device
     */
    public function setApikey($apikey)
    {
        $this->apikey = $apikey;

        return $this;
    }

    /**
     * Get apikey
     *
     * @return string
     */
    public function getApikey()
    {
        return $this->apikey;
    }

    public function getRoles()
    {
        return [self::ROLE_DEVICE];
    }

    public function getPassword()
    {
        return null;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->name . ' [' . $this->apikey . ']';
    }

    public function eraseCredentials()
    {
        return null;
    }

    /**
     * Set suspended
     *
     * @param boolean $suspended
     *
     * @return Device
     */
    public function setSuspended($suspended)
    {
        $this->suspended = $suspended;

        return $this;
    }

    /**
     * Get suspended
     *
     * @return boolean
     */
    public function getSuspended()
    {
        return $this->suspended;
    }

    /**
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * @param \DateTime $lastLogin
     * @return Device
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;
        return $this;
    }

    
   
}
