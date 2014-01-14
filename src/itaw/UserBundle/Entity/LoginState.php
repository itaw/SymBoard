<?php

namespace itaw\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LoginState
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class LoginState
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
     * @var \DateTime
     *
     * @ORM\Column(name="check_date", type="datetime")
     */
    private $checkDate;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set checkDate
     *
     * @param \DateTime $checkDate
     * @return LoginState
     */
    public function setCheckDate($checkDate)
    {
        $this->checkDate = $checkDate;

        return $this;
    }

    /**
     * Get checkDate
     *
     * @return \DateTime 
     */
    public function getCheckDate()
    {
        return $this->checkDate;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

}
