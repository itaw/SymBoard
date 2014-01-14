<?php

namespace itaw\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="itaw_user")
 */
class User extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="itaw\DataBundle\Entity\Post", mappedBy="user")
     */
    protected $posts;

    /**
     * @ORM\OneToMany(targetEntity="itaw\DataBundle\Entity\Thread", mappedBy="user")
     */
    protected $threads;

    /**
     * @ORM\OneToOne(targetEntity="itaw\DataBundle\Entity\UserProfile", mappedBy="user")
     * */
    private $profile;

    /**
     * @ORM\ManyToMany(targetEntity="itaw\MessageBundle\Entity\Message", mappedBy="receivers")
     */
    private $receivedMessages;

    public function __construct()
    {
        parent::__construct();
        $this->receivedMessages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPosts()
    {
        return $this->posts;
    }

    public function setPosts($posts)
    {
        $this->posts = $posts;
    }

    public function getThreads()
    {
        return $this->threads;
    }

    public function setThreads($threads)
    {
        $this->threads = $threads;
    }

    public function getProfile()
    {
        return $this->profile;
    }

    public function setProfile($profile)
    {
        $this->profile = $profile;
    }

    public function getReceivedMessages()
    {
        return $this->receivedMessages;
    }

    public function setReceivedMessages($receivedMessages)
    {
        $this->receivedMessages = $receivedMessages;
    }

}
