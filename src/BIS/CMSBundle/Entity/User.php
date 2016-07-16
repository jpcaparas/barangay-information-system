<?php
namespace BIS\CMSBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * BIS\CMSBundle\Entity\User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="BIS\CMSBundle\Entity\UserRepository")
 */
class User implements AdvancedUserInterface, \Serializable {
    /**
     * @ORM\Column(
     *  type="integer"
     * ),
     * @ORM\Id,
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(
     *  type="string",
     *  length=25,
     *  unique=true
     * )
     */
    private $username;

    /**
     * @ORM\Column(
     *  type="string",
     *  length=64,
     * )
     */
    private $password;

    /**
     * @ORM\Column(
     *  type="string",
     *  length=60,
     *  unique=true
     * )
     */
    private $email;

    /**
     * @ORM\Column(
     *  name="is_active",
     *  type="boolean"
     * )
     */
    private $isActive;

    /**
     * @ORM\ManyToMany(
     *  targetEntity="Role",
     *  inversedBy="users"
     * )
     */
    private $roles;

    public function __construct() {
        $this->isActive = true;
        $this->roles = new ArrayCollection();
    }

    public function getRoles() {
        return $this->roles->toArray();
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

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->isActive;
    }

    public function isAccountNonExpired() {
        return true;
    }

    public function isAccountNonLocked() {
        return true;
    }

    public function isCredentialsNonExpired() {
        return true;
    }

    public function getSalt() {
        return null;
    }

    public function eraseCredentials() {
    }

    public function serialize() {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }

    public function unserialize($unserialized) {
        list (
            $this->id,
            $this->username,
            $this->password,
            ) = unserialize($unserialized);
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Add roles
     *
     * @param \BIS\CMSBundle\Entity\Role $roles
     * @return User
     */
    public function addRole(\BIS\CMSBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \BIS\CMSBundle\Entity\Role $roles
     */
    public function removeRole(\BIS\CMSBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }
}
