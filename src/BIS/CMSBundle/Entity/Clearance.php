<?php
namespace BIS\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(
 *  name = "clearance"
 * )
 * @ORM\HasLifecycleCallbacks
 */
class Clearance {
    /**
     * @ORM\Column(
     *  type = "bigint"
     * )
     * @ORM\Id
     * @ORM\GeneratedValue(
     *  strategy = "AUTO"
     * )
     */
    protected $id;

    /**
     * @ORM\Column(
     *  type = "datetime",
     *  nullable = true,
     *  name = "issued_at"
     * )
     */
    protected $issuedAt;

    /**
     * @ORM\Column(
     *  type = "datetime",
     *  nullable = true,
     *  name = "requested_at"
     * )
     */
    protected $requestedAt;

    /**
     * @ORM\Column(
     *  type = "text",
     *  nullable = true
     * )
     */
    protected $notes;

    /**
     * @ORM\Column(
     *  type = "string",
     *  length = 20,
     *  nullable = true,
     *  name = "request_key"
     * )
     */
    protected $requestKey;

    /**
     * @ORM\ManyToOne(
     *  targetEntity = "Resident",
     *  inversedBy = "clearances"
     * )
     * @ORM\JoinColumn(
     *  name = "resident_id",
     *  referencedColumnName = "id",
     *  onDelete = "CASCADE"
     * )
     * @Assert\NotBlank(
     *  message = "This clearance must be associated with a resident."
     * )
     */
    protected $resident;

    /**
     * @ORM\Column(
     *  type = "datetime",
     *  name = "created_at",
     *  nullable = true
     * )
     */
    protected $createdAt;

    /**
     * @ORM\Column(
     *  type = "datetime",
     *  name = "updated_at",
     *  nullable = true
     * )
     */
    protected $updatedAt;

    public function __construct() {
        $this->createdAt = new \DateTime('now');
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
     * Set issuedAt
     *
     * @param \DateTime $issuedAt
     * @return Clearance
     */
    public function setIssuedAt($issuedAt)
    {
        $this->issuedAt = $issuedAt;

        return $this;
    }

    /**
     * Get issuedAt
     *
     * @return \DateTime 
     */
    public function getIssuedAt()
    {
        return $this->issuedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Clearance
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Clearance
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set resident
     *
     * @param \BIS\CMSBundle\Entity\Resident $resident
     * @return Clearance
     */
    public function setResident(\BIS\CMSBundle\Entity\Resident $resident = null)
    {
        $this->resident = $resident;

        return $this;
    }

    /**
     * Get resident
     *
     * @return \BIS\CMSBundle\Entity\Resident 
     */
    public function getResident()
    {
        return $this->resident;
    }

    /**
     * Set notes
     *
     * @param string $notes
     * @return Clearance
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string 
     */
    public function getNotes()
    {
        return $this->notes;
    }


    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps() {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    /**
     * Set requestedAt
     *
     * @param \DateTime $requestedAt
     * @return Clearance
     */
    public function setRequestedAt($requestedAt)
    {
        $this->requestedAt = $requestedAt;

        return $this;
    }

    /**
     * Get requestedAt
     *
     * @return \DateTime 
     */
    public function getRequestedAt()
    {
        return $this->requestedAt;
    }

    /**
     * Set requestKey
     *
     * @param string $requestKey
     * @return Clearance
     */
    public function setRequestKey($requestKey)
    {
        $this->requestKey = $requestKey;

        return $this;
    }

    /**
     * Get requestKey
     *
     * @return string 
     */
    public function getRequestKey()
    {
        return $this->requestKey;
    }
}
