<?php

namespace ChatApiSample\Domain\Chat\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use ChatApiSample\Domain\Chat\Entity\AbstractEntity;

/**
 * @UniqueEntity("email", message = "user.email.unique")
 * @UniqueEntity("username", message = "user.username.unique")
 */
class User extends AbstractEntity implements AdvancedUserInterface
{
    /**
     * @var string $email
     *
     * @Assert\NotNull(message = "user.email.not_blank")
     */
    protected $email;

    /**
     * @var string $username
     *
     * @Assert\NotNull(message = "user.username.not_blank")
     * @Assert\Length(max=10, maxMessage = "user.username.length.max")
     * @Assert\Regex(
     *     pattern = "/^[a-zA-Z0-9|\_|-]+$/",
     *     message = "user.username.regex"
     * )
     */
    protected $username;

    /**
    * @var string $role
    *
    * @Assert\Length(max=255)
    */
   protected $role;

    /**
    * @var string $plainPassword
    *
    * @Assert\NotNull(message = "user.plainPassword.not_blank")
    * @Assert\Length(min = 10, max=32, minMessage = "user.plainPassword.length.min")
    */
    protected $plainPassword;

    protected $password;


    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setRole()
    {
        $this->role = 'ROLE_USER';
    }

    public function getRoles()
    {
        return [
            $this->role
        ];
    }

    public function setPlainPassword(string $plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return true;
    }
}
