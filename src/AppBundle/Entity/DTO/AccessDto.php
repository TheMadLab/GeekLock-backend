<?php

namespace AppBundle\Entity\DTO;

use Doctrine\ORM\Mapping as ORM;

class AccessDto
{
    private $mac;
    private $key;
    private $timestamp;

    /**
     * @return mixed
     */
    public function getMac()
    {
        return $this->mac;
    }

    /**
     * @param mixed $mac
     * @return AccessDto
     */
    public function setMac($mac)
    {
        $this->mac = strtoupper($mac);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     * @return AccessDto
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        if (!$this->timestamp instanceof \DateTime) {
            $date = new \DateTime();
            $date->setTimestamp($this->timestamp);
            $this->timestamp = $date;
        }

        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     * @return AccessDto
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    
}
