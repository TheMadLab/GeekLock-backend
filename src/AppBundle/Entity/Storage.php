<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Storage
 *
 * @ORM\Table(name="storage")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StorageRepository")
 */
class Storage
{
    const DB_UPDATE = 'db_update';
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
     * @ORM\Column(name="name", type="string", length=32, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", nullable=true)
     */
    private $value;

    /**
     * Storage constructor.
     * @param string $value
     */
    public function __construct($name = 'key', $value = null)
    {
        $this->key = $name;
        $this->value = serialize($value);
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
     * @return Storage
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
     * Set value
     *
     * @param string $value
     *
     * @return Storage
     */
    public function setValue($value)
    {
        $this->value = serialize($value);

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return unserialize($this->value);
    }
}

