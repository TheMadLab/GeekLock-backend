<?php

namespace AppBundle\Entity\DTO;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

class QueueDto
{
    /**
     * @var ArrayCollection
     */
    private $queue;

    /**
     * @return ArrayCollection
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * @param ArrayCollection $queue
     * @return QueueDto
     */
    public function setQueue($queue)
    {
        $this->queue = $queue;
        return $this;
    }

    
}
