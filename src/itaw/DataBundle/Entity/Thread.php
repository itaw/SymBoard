<?php

namespace itaw\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Thread
 *
 * @ORM\Table("itaw_thread")
 * @ORM\Entity(repositoryClass="itaw\DataBundle\Entity\ThreadRepository")
 */
class Thread
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="Forum", inversedBy="threads")
     * @ORM\JoinColumn(name="forum_id", referencedColumnName="id")
     */
    private $forum;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="thread")
     */
    protected $posts;

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

    /**
     * @var string
     *
     * @ORM\Column(name="prefix", type="string", length=255, nullable=true)
     */
    private $prefix;

    /**
     * @ORM\ManyToOne(targetEntity="ThreadState")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="ThreadType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $type;

    public function __construct()
    {
        $this->posts = new ArrayCollection;
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

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function getEditDate()
    {
        return $this->editDate;
    }

    public function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function setEditDate(\DateTime $editDate)
    {
        $this->editDate = $editDate;
    }

    public function getForum()
    {
        return $this->forum;
    }

    public function setForum($forum)
    {
        $this->forum = $forum;
    }

    public function getPosts()
    {
        return $this->posts;
    }

    public function setPosts($posts)
    {
        $this->posts = $posts;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

}
