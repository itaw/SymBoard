<?php

namespace itaw\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Forum
 *
 * @ORM\Table("itaw_forum")
 * @ORM\Entity(repositoryClass="itaw\DataBundle\Entity\ForumRepository")
 */
class Forum
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Forum")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Forum", mappedBy="parent")
     */
    protected $children;

    /**
     * @ORM\OneToMany(targetEntity="Thread", mappedBy="forum")
     */
    protected $threads;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime")
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="edit_date", type="datetime", nullable=true)
     */
    private $editDate;

    public function __construct()
    {
        $this->children = new ArrayCollection;
        $this->threads = new ArrayCollection;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function getEditDate()
    {
        return $this->editDate;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    public function setChildren($children)
    {
        $this->children = $children;
    }

    public function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function setEditDate(\DateTime $editDate)
    {
        $this->editDate = $editDate;
    }

    public function getThreads()
    {
        return $this->threads;
    }

    public function setThreads($threads)
    {
        $this->threads = $threads;
    }

}
