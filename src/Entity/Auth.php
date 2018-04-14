<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Auth
 *
 * @ORM\Table(name="auth")
 * @ORM\Entity(repositoryClass="App\Repository\AuthRepository")
 */
class Auth
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $user_id;

    /**
     * @var datetime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="users")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    function __construct()
    {
        $this->created_at = new \DateTime();
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

}